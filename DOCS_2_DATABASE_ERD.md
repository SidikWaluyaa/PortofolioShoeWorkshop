# Dokumentasi Database & ERD

Sistem Shoe Workshop menggunakan MySQL/MariaDB dengan struktur tabel yang dibagi menjadi 3 kelompok besar: **CMS (Konten), Pengguna & Donasi, serta Log Sistem**.

---

## 1. Kelompok Pengguna & Autentikasi (Users)
Menyimpan data pengguna, baik admin maupun pelanggan (opsional jika login).

*   **`users`**
    *   `id` (PK)
    *   `name`, `email`, `password`, `phone`
    *   `role` (enum: 'admin', 'user') - Menentukan akses ke halaman *dashboard*.
    *   `avatar` (string)
*   **`daily_logins`**, **`rewards`**, **`user_rewards`** (Sistem *Gamification* / Reward).

---

## 2. Kelompok Katalog Donasi (CSR)
Sistem relasional untuk mengelola barang donasi dan pengajuannya.

*   **`campaigns`** (Program Kampanye Donasi)
    *   `id` (PK)
    *   `title`, `description`, `status`
*   **`donations`** (Data Penerimaan Donasi Sepatu dari Donatur)
    *   `id` (PK)
    *   `user_id` (FK to users)
    *   `spk` (Nomor Referensi)
*   **`donation_items`** (Item Barang Sepatu yang Siap Didonasikan)
    *   `id` (PK)
    *   `donation_id` (FK to donations)
    *   `kode_barang` (Unik)
    *   `name`, `brand`, `ukuran`, `kondisi`
    *   `foto_path`, `details`
*   **`donation_item_services`** (Layanan reparasi apa saja yang sudah dilakukan pada sepatu tersebut sebelum didonasikan).
*   **`donation_requests`** (Formulir pengajuan dari orang yang membutuhkan)
    *   `id` (PK)
    *   `donation_item_id` (FK to donation_items)
    *   `name`, `email`, `phone`, `alasan`
    *   `status` (enum: 'pending', 'approved', 'rejected')

**Relasi:** 
- `donations` (1) memiliki banyak `donation_items` (N).
- `donation_items` (1) memiliki banyak `donation_requests` (N).

---

## 3. Kelompok CMS & Landing Page (Konten Dinamis)
Tabel-tabel independen yang datanya dikontrol melalui *Dashboard Admin* untuk ditampilkan di *Landing Page*.

*   **`hero_sections`**: Banner utama (Headline, subheadline, gambar).
*   **`trust_items`**: Logo *brand* atau partner.
*   **`services`**: Daftar layanan reparasi (Nama, icon, deskripsi, harga).
*   **`projects`**: Portfolio perbandingan sepatu (Before & After).
*   **`workflows`**: Langkah-langkah / alur kerja reparasi.
*   **`reviews`**: Testimoni pelanggan.
*   **`posts`**: Artikel Blog & Edukasi (termasuk *slug* dan *author*).
*   **`settings`**: Pengaturan global (Nomor WhatsApp, link sosmed, alamat).

---

## 4. Tabel Eksternal (API Integration)
Untuk fitur **Tracking Pesanan** dan **Klaim Garansi**, sistem *frontend* ini **TIDAK** menyimpan datanya di database lokal.
Data SPK, status pengerjaan, dan foto *progress* ditarik secara *real-time* dari server pusat (*Backend Core API*) Shoe Workshop.

*(Detail mengenai integrasi ini ada di dokumen `DOCS_3_API_INTEGRATION.md`)*
