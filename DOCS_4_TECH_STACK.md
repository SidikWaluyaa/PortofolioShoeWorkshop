# Dokumentasi Tech Stack & Developer Guide

Dokumen ini ditujukan untuk *Software Engineer* atau *Developer* yang akan merawat (*maintenance*) atau mengembangkan proyek Shoe Workshop lebih lanjut.

---

## 1. Tech Stack (Teknologi yang Digunakan)

Proyek ini dibangun menggunakan arsitektur modern berbasis PHP dan JavaScript:

### Backend & Framework Inti
*   **Framework:** Laravel (PHP)
*   **Database:** MySQL / MariaDB
*   **Autentikasi:** Laravel Breeze / Sanctum (untuk session management)

### Frontend & UI/UX
*   **Templating Engine:** Laravel Blade (Komponen modular, misal: `<x-hero>`, `@include('partials...')`).
*   **CSS Framework:** Tailwind CSS v3 (Konfigurasi via `tailwind.config.js`).
*   **UI Components:** 
    *   Penggunaan custom utility classes (seperti `bg-primary`, `text-on-surface`).
    *   Animasi *micro-interactions* (hover, scale, bounce) menggunakan utilitas Tailwind.
*   **JavaScript Logic:** Alpine.js (Digunakan secara ekstensif untuk memanipulasi *state UI* tanpa jQuery. Contoh: *Slider* testimoni, modal pop-up, fitur filter pencarian di Katalog Donasi).
*   **Icons:** Google Material Symbols Outlined.

---

## 2. Struktur Proyek Penting
Jika Anda ingin mengubah tampilan atau logika, berikut adalah *folder-folder* utamanya:
*   `app/Http/Controllers/`: Logika sistem (e.g. `DonationCatalogController`, `TrackingController`).
*   `resources/views/`: Berisi semua file *frontend* HTML/Blade.
    *   `resources/views/components/`: Potongan kode (*partials*) seperti `hero`, `about`, `services` yang dipakai di halaman utama.
    *   `resources/views/layouts/`: Kerangka dasar *website* (Navbar, Footer, penempatan `<head>`).
*   `routes/web.php`: Tempat semua URL/Routing *website* didaftarkan.
*   `public/`: Tempat menyimpan aset statis seperti gambar (`/images`) dan *file* *build* CSS/JS.

---

## 3. Panduan Instalasi (Setup Guide)
Jika proyek ini dipindahkan ke komputer baru atau *server*, ikuti langkah berikut:

**Prasyarat:**
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL

**Langkah Instalasi:**
1. **Clone & Install Dependensi PHP:**
   ```bash
   git clone [URL_REPO_ANDA]
   cd PortofolioShoeWorkshop
   composer install
   ```
2. **Setup File Environment:**
   Copy file `.env.example` menjadi `.env`.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Atur koneksi database (`DB_DATABASE`, `DB_USERNAME`, dll) di file `.env` yang baru.
3. **Migrasi Database:**
   ```bash
   php artisan migrate
   ```
4. **Install Dependensi Frontend & Build Aset:**
   ```bash
   npm install
   npm run build
   ```
5. **Jalankan Server Lokal:**
   ```bash
   php artisan serve
   ```
   Akses `http://127.0.0.1:8000` di browser Anda.

---

## 4. Perintah (Commands) Sehari-hari
Saat Anda (developer) sedang bekerja mengubah desain atau CSS, Anda **WAJIB** membuka dua terminal sekaligus:
1. Terminal 1: `php artisan serve` (Menjalankan server backend).
2. Terminal 2: `npm run dev` (Memantau perubahan *class* Tailwind dan me-*recompile* CSS secara *real-time*).
