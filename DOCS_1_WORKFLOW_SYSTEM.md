# Dokumentasi Workflow & Fitur Sistem Shoe Workshop

Dokumen ini menjelaskan alur kerja (workflow) dari fitur-fitur utama yang ada di dalam proyek aplikasi **Shoe Workshop**. Sistem ini dirancang sebagai *landing page* interaktif sekaligus portal pelanggan (*customer portal*) yang terintegrasi dengan sistem backend bengkel reparasi.

---

## 1. Modul Lacak Pesanan (Tracking SPK)
Fitur ini memungkinkan pelanggan untuk memantau progres pengerjaan sepatu mereka secara *real-time* menggunakan nomor SPK (Surat Perintah Kerja).

**Alur Kerja (Workflow):**
1. **Input Resi:** Pelanggan mengunjungi `/tracking` dan memasukkan nomor SPK (contoh: `S-2603-28-0882-IK`).
2. **Pencarian Data (API Call):** `TrackingController` menerima *input* dan melakukan *request* ke API Backend eksternal (menggunakan `Http::get` ke `API_BASE_URL/tracking`).
3. **Validasi:** 
   - Jika SPK tidak ditemukan, sistem menampilkan halaman "Pesanan Tidak Ditemukan" beserta form pencarian ulang.
   - Jika SPK valid, API mengembalikan data detail pesanan, nama pelanggan, foto *Before-After*, dan *Timeline* pengerjaan.
4. **Tampilan (View):** Halaman merender *Timeline* vertikal. Status yang sedang berjalan ditandai dengan warna kuning (Sedang Berjalan), dan yang sudah selesai dengan warna hijau (Selesai). Terdapat juga tombol aksi untuk langsung *Chat Konsultan* via WhatsApp.

---

## 2. Modul Klaim Garansi
Fitur yang memfasilitasi pelanggan untuk mengajukan komplain atau perbaikan ulang jika hasil reparasi tidak sesuai standar.

**Alur Kerja (Workflow):**
1. **Validasi SPK (Tahap 1):** Pelanggan masuk ke `/warranty` dan memasukkan nomor SPK. Sistem (`WarrantyClaimController`) akan mengecek ke API Backend apakah pesanan ini *Eligible* (masih dalam masa garansi 100 hari).
2. **Pengisian Form (Tahap 2):** Jika valid, pelanggan dihadapkan pada formulir detail. Mereka wajib mengisi:
   - Kategori masalah (Lem terbuka, jahitan lepas, warna luntur, dll).
   - Deskripsi kendala.
   - Unggah foto bukti (maksimal 3 foto).
3. **Submit (Tahap 3):** Data dikirim via `POST` ke API Backend `/api/v1/warranty-claims`.
4. **Selesai:** Pelanggan menerima ID Tiket Klaim dan instruksi pengiriman sepatu kembali ke bengkel.

---

## 3. Modul Katalog Donasi
Platform CSR (Corporate Social Responsibility) dimana Shoe Workshop merestorasi sepatu bekas dan mendonasikannya kepada yang membutuhkan.

**Alur Kerja (Workflow):**
1. **Manajemen Admin:** Admin (*backend*) memasukkan data `donation_items` (sepatu yang sudah direstorasi, ukuran, kondisi) dan membuat program `campaigns`.
2. **Katalog Publik:** Pelanggan mengunjungi `/katalog` dan melihat daftar sepatu (Grid/List View). Fitur pencarian menggunakan Alpine.js memfilter data berdasarkan nama, brand, ukuran, dan kondisi secara *real-time* di *client-side*.
3. **Pengajuan Donasi:** Pengunjung yang membutuhkan sepatu mengklik tombol "Ajukan Sepatu Ini", mengisi formulir identitas (`donation_requests`) berisi nama, email, no. WA, dan alasan membutuhkan.
4. **Kurasi Admin:** Admin menyeleksi pengajuan (Approve/Reject) melalui *dashboard* Admin.

---

## 4. Modul CMS (Content Management System) Halaman Utama
Seluruh konten *landing page* bersifat dinamis dan ditarik dari *database*.

**Alur Kerja (Workflow):**
1. `HomeController` dipanggil saat *user* mengakses `/` (Beranda).
2. Controller mengambil data dari berbagai tabel:
   - `hero_sections` (Banner utama)
   - `trust_items` (Logo partner/kepercayaan)
   - `services` (Layanan reparasi)
   - `projects` (Portfolio Before/After)
   - `workflows` (Cara kerja)
   - `reviews` (Testimoni pelanggan)
   - `posts` (Artikel blog)
   - `donations` / `campaigns` (Program sosial)
3. Data dilempar ke `home.blade.php` yang disusun menggunakan komponen modular Blade (contoh: `@include('components.hero')`, `@include('components.services')`).

---

## 5. Modul Blog & Edukasi
Media untuk membagikan tips perawatan sepatu dan artikel SEO.

**Alur Kerja (Workflow):**
1. Admin mempublikasikan artikel di tabel `posts`.
2. Halaman `/blog` (`BlogController`) menampilkan daftar artikel terbaru.
3. Halaman `/blog/{slug}` menampilkan detail konten artikel lengkap dengan *meta tags* dinamis untuk keperluan SEO (Search Engine Optimization).

---

## 6. Portal Donatur & Gamification (Dashboard Donatur)
Modul interaktif khusus bagi pengguna yang telah *login* (berperan sebagai donatur atau pelanggan terdaftar) untuk melacak riwayat interaksi dan mendapatkan *rewards*.

**A. Daily Check-In & Verifikasi Foto**
*Tujuan: Membangun kebiasaan pengguna merawat sepatu dengan memberikan insentif.*
1. **Upload Aktivitas:** Pengguna mengakses menu "Daily Check-In" di *Dashboard* dan mengunggah foto (`foto_sepatu`) yang menunjukkan aktivitas mereka merawat sepatu hari itu.
2. **Validasi (Backend):** Sistem memproses data via `CheckinController` dan menggunakan `CheckinService` untuk mencatat aktivitas. Status default dari sistem adalah "Menunggu Verifikasi Admin".
3. **Pencatatan Streak:** Sistem akan menghitung rentetan hari beruntun (*streak*) dari aktivitas *check-in* yang disetujui (misal: Streak Minggu 1 = 7 hari).

**B. Sistem Klaim Reward (Hadiah)**
*Tujuan: Memberikan diskon atau layanan gratis atas konsistensi pengguna.*
1. **Cek Progres:** Pengguna masuk ke halaman "Rewards Saya". Sistem menampilkan status *streak* saat ini beserta daftar hadiah (contoh: *Voucher Sepatu Gratis* atau Diskon 20%).
2. **Klaim Hadiah:** Jika pengguna telah menyelesaikan syarat *streak* (misal: sukses *check-in* 7 hari penuh di `minggu_ke`), mereka dapat menekan tombol Klaim.
3. **Penerbitan Kode (Backend):** `RewardController` memvalidasi syarat tersebut. Jika valid, sistem (via `RewardService`) akan meng- *generate* kode unik (`unique_code`) dan menyimpannya di tabel `user_rewards`. Kode ini bisa digunakan saat bertransaksi di Shoe Workshop.

**C. Riwayat & Interaksi Lainnya**
Selain Gamification, *Dashboard Donatur* juga merangkum:
- **Riwayat Reparasi:** Menampilkan daftar SPK pesanan reparasi pelanggan secara terpusat tanpa harus mengetik manual di halaman lacak publik.
- **Donasi Saya:** Menampilkan daftar riwayat donasi sepatu yang pernah dilakukan oleh *user* tersebut.
