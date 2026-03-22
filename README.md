# 🚀 Portofolio IT - Full-Stack Portfolio System

Sistem Manajemen Portofolio modern yang dibangun dengan **Laravel 11**, **Filament v3**, dan **Tailwind CSS**. Proyek ini dirancang untuk profesional IT yang ingin memamerkan karya, pengalaman, dan pencapaian mereka dengan tampilan premium serta panel admin yang informatif.

---

## 🛠 Tech Stack

- **Backend**: Laravel 11 (PHP 8.2+)
- **Admin Panel**: Filament v3 (TALL Stack)
- **Frontend**: Blade, Tailwind CSS, Vite
- **Animations**: ScrollReveal.js
- **Database**: SQLite (Default) / MySQL / PostgreSQL
- **PDF Engine**: Barryvdh DomPDF (Untuk Download CV ATS)

---

## ✨ Fitur Utama

- **Premium Landing Page**: Desain responsif dengan animasi ScrollReveal yang halus.
- **Smart Dashboard**: Widget statistik (Proyek, Skill, Sertifikasi) dan tabel akses cepat proyek terbaru.
- **Advanced Admin CRUD**: Pengelompokan navigasi yang rapi (Profil, Karir, Karya, Pencapaian).
- **CV ATS Generator**: Fitur download CV dalam format standar ATS (PDF) langsung dari landing page.
- **Profile Management**: Pengaturan data diri, foto profil, dan link media sosial secara dinamis.
- **Project Catalog**: Dokumentasi karya lengkap dengan detail tech stack dan link GitHub/Demo.

---

## 📋 Persyaratan Sistem

Pastikan lingkungan pengembangan Anda memenuhi kriteria berikut:
- **PHP** >= 8.2
- **Composer** (Dependency Manager)
- **Node.js & NPM** (Untuk kompilasi aset frontend)
- **SQLite Extension** (Atau database lain pilihan Anda)

---

## 🚀 Langkah Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek di lokal:

### 1. Klon Repositori
```bash
git clone https://github.com/syahril-akbar/portofolio.git
cd portofolio
```

### 2. Instal Dependensi PHP
```bash
composer install
```

### 3. Instal Dependensi Frontend
```bash
npm install
```

### 4. Konfigurasi Environment
Salin file `.env.example` ke `.env` dan atur konfigurasi database Anda.
```bash
cp .env.example .env
php artisan key:generate
```

*Catatan: Secara default proyek ini menggunakan SQLite. Anda tidak perlu setup database server jika tetap menggunakan SQLite.*

### 5. Migrasi & Seeding
Jalankan migrasi untuk membuat struktur tabel dan data awal.
```bash
php artisan migrate --seed
```

### 6. Storage Link
Hubungkan folder storage agar file upload (foto profil/proyek) dapat diakses publik.
```bash
php artisan storage:link
```

### 7. Jalankan Server Pengembangan
Buka dua terminal terpisah:

**Terminal 1 (Backend):**
```bash
php artisan serve
```

**Terminal 2 (Frontend/Vite):**
```bash
npm run dev
```

Akses aplikasi di `http://127.0.0.1:8000` dan Dashboard Admin di `http://127.0.0.1:8000/admin`.

---

## 🎨 Pengembangan UI
Jika Anda melakukan perubahan pada CSS atau JavaScript, pastikan untuk menjalankan build produksi untuk hasil optimal:
```bash
npm run build
```

---

## 🤝 Kontribusi
Gue sangat terbuka buat kritik dan saran. Langsung aja gas lewat Issue atau Pull Request kalau ada yang mau lu poles lagi!

**Developed with ❤️ by Syahril Akbar**
