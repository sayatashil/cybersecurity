# 🛡️ Cybersecurity Portal

## 📘 Project Description

**Cybersecurity Portal** is a modern educational web platform for learning and practicing cybersecurity.  
It is designed for students, professionals, and anyone looking to improve their knowledge in information security.  
The platform offers courses, articles, tests, forums, and a gamified achievement system to provide a comprehensive and engaging learning experience.

## 🚀 Key Features

- 🧠 Cybersecurity course catalog with progress tracking and certification  
- 📚 Knowledge base of articles and analytical content  
- 🧪 Testing and self-assessment system  
- 💬 Forum for discussion and experience sharing  
- 🙍‍♂️ User dashboard with achievements and activity logs  
- 🔍 Search across the entire platform  
- 📱 Fully responsive and modern UI

## 🛠️ Technologies and Tools

### Frontend

- **Vue 3** — Progressive JavaScript framework  
- **Vite** — Fast build tool and development server  
- **Inertia.js (Vue 3)** — SPA-like routing without an API  
- **Tailwind CSS** — Utility-first CSS framework  
- **Axios** — HTTP client for API communication  
- **paillier-bigint** — Homomorphic encryption (Paillier cryptosystem)  
- **Concurrently** — To run multiple scripts in parallel  
- **PostCSS, Autoprefixer** — CSS processing and browser compatibility  

### Backend (Expected)

- Connects to a RESTful API (e.g., Laravel, Django REST Framework, etc.)

## 📂 Project Structure

```
cybersecurity/
├── public/                     # Static assets
├── src/
│   ├── components/             # Reusable Vue components
│   ├── layouts/                # Main layout components
│   ├── pages/                  # Application pages
│   ├── styles/                 # Tailwind and global styles
│   └── main.js / App.vue       # Entry point and root component
├── package.json                # Dependencies and scripts
├── vite.config.js              # Vite configuration
├── tailwind.config.js          # Tailwind CSS config
└── README.md                   # Project documentation
```

## ⚡ Getting Started

### 1. Clone the repository:

```bash
git clone https://github.com/sayatashil/cybersecurity.git
cd cybersecurity
```

### 2. Install dependencies:

```bash
npm install
```

### 3. Run the development server:

```bash
npm run dev
```

Open your browser at: [http://localhost:5173](http://localhost:5173)

## 📦 Common npm Scripts

| Script         | Description                          |
|----------------|--------------------------------------|
| `dev`          | Run the development server           |
| `build`        | Build the app for production         |
| `preview`      | Preview the production build         |

## 🤝 Contribution & Support

Feel free to open an issue or submit a pull request!  
Please follow the code style guidelines (TailwindCSS, Prettier, etc.).  
Before committing, it's recommended to run:

```bash
npm run format
```

## 📬 Contact

- Author: **Sayat Ashil**  
- Email: [sayatashil1@gmail.com](mailto:sayatashil1@gmail.com)

## 📝 License

This project is licensed under the [MIT License](https://opensource.org/licenses/MIT).
