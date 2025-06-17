<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import {onMounted, ref} from "vue";
import { generateRandomKeys } from "paillier-bigint";
import axios from "axios";

const file = ref(null);
const encryptedData = ref([]);
const chunkSize = 1024 * 1024; // 1 MB
const processing = ref(false);
const currentChunk = ref(0);
const totalChunks = ref(0);

const listFiles =ref([]);

onMounted(async () => {
   getListFiles()
});

const getListFiles = async () => {
    listFiles.value = await axios.get("/api/listFiles");
};

const onFileChanged = (event) => {
    file.value = event.target.files[0];
};

const processChunk = async (chunk, publicKey) => {
    const reader = new FileReader();
    return new Promise((resolve) => {
        reader.onload = async (e) => {
            const arrayBuffer = e.target.result;
            const uint8Array = new Uint8Array(arrayBuffer);
            const hexData = Array.from(uint8Array)
                .map(byte => byte.toString(16).padStart(2, '0'))
                .join('');
            const bigIntData = BigInt(`0x${hexData}`);
            const encryptedChunk = publicKey.encrypt(bigIntData);
            resolve(encryptedChunk.toString());
        };
        reader.readAsArrayBuffer(chunk);
    });
};

const submitData = async () => {
    if (!file.value) {
        alert("Lütfen bir dosya seçin.");
        return;
    }

    processing.value = true;

    const { publicKey } = await generateRandomKeys(2048);
    const fileSize = file.value.size;
    totalChunks.value = Math.ceil(fileSize / chunkSize);

    const fileId = crypto.randomUUID(); // Benzersiz bir dosya ID'si

    const filename = file.value.name;
    const filetype =filename.substring(filename.lastIndexOf(".") + 1);

    console.log(`Dosya ${totalChunks.value} parçaya bölünecek.`);

    for (let i = 0; i < totalChunks.value; i++) {
        currentChunk.value = i + 1;
        const start = i * chunkSize;
        const end = Math.min(start + chunkSize, fileSize);
        const chunk = file.value.slice(start, end);

        const encryptedChunk = await processChunk(chunk, publicKey);

        try {
            await axios.post("/api/upload", {
                encryptedChunk,
                filename,
                filetype,
                file_id: fileId,
            });
            console.log(`Parça ${currentChunk.value} gönderildi.`);
        } catch (error) {
            console.error(`Parça ${currentChunk.value} gönderilemedi:`, error);
        }
    }

    console.log("Tüm parçalar başarıyla şifrelendi ve gönderildi.");
    processing.value = false;
    getListFiles();
};

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submitData">
                            <input
                                type="file"
                                @change="onFileChanged($event)"
                            />

                            <button class="bg-green-500 text-white p-2 px-8 rounded" type="submit">
                                Yükle
                            </button>

                            <code class="block border rounded w-full mt-4 p-4">
                                {{ file ? file.name : "Dosya seçilmedi." }}
                            </code>

                            <div v-if="processing" class="mt-4 text-blue-600">
                                Parça {{ currentChunk }} / {{ totalChunks }} işleniyor...
                            </div>

                            <div v-if="encryptedData.length && !processing" class="mt-4">
                                <h3 class="text-green-600 font-bold">Şifrelenmiş Veri ({{ encryptedData.length }} parça):</h3>
                                <textarea readonly class="w-full border p-2">{{ encryptedData }}</textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <div class="">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <table class="min-w-full border-collapse border border-gray-300">
                            <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-2">File Name</th>
                                <th class="border border-gray-300 px-4 py-2">File Type</th>
                                <th class="border border-gray-300 px-4 py-2">Download</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="item in listFiles.data" :key="item.id">
                                <td class="border border-gray-300 px-4 py-2">{{ item[0].filename }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ item[0].filetype }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <a class="text-blue-500 hover:underline">Download</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
