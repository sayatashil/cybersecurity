<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaveController extends Controller
{
    public function upload(Request $request)
    {
        // Şifrelenmiş veri
        $data = $request->input('encryptedChunk');

        // Ek veriler (filename, filetype, file_id)
        $filename = $request->input('filename');
        $filetype = $request->input('filetype');
        $fileId = $request->input('file_id'); // Her dosya için benzersiz bir ID


        if (!$data || !$filename || !$filetype || !$fileId) {
            return response()->json(['error' => 'Eksik veri.'], 400);
        }

        // Yeni dosya parçası kaydı oluştur
        $file = new \App\Models\File();
        $file->data = $data;
        $file->filename = $filename;
        $file->filetype = $filetype;
        $file->file_id = $fileId;
        $file->save();

        return response()->json(['success' => true, 'file' => $file]);
    }
    public function listFiles()
    {
        $files = \App\Models\File::get()->groupBy('file_id');

        return response()->json($files);
    }



}
