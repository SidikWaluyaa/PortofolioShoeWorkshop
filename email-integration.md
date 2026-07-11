Viewed 2026_06_12_133300_insert_open_donasi_hero_section.php:17-22

Ide yang sangat fantastis! Menggunakan **Resend** (lewat integrasi SMTP/API) adalah pilihan yang modern, super cepat, dan jarang masuk *spam* dibandingkan layanan lama. 

Untuk aplikasi **Shoe Workshop (Donasi & Reparasi)** ini, pengiriman email sebenarnya bisa menjadi *"Game Changer"* untuk pengalaman pengguna (UX). 

Selain untuk keamanan (1. **Verifikasi Email saat Register**, 2. **Lupa/Reset Password**), berikut adalah beberapa tambahan krusial yang menurut saya **sangat wajib** ada untuk aplikasi seperti ini:

### 3. Notifikasi Status Donasi Sepatu (Penting!)
Bayangkan kepuasan seorang donatur ketika mereka tahu sepatunya sedang diurus. Kita bisa kirim email otomatis saat Admin mengubah status donasi mereka:
- *"Hore! Sepatu donasi Anda telah kami terima dan akan segera kami restorasi."*
- *"Sepatu donasi Anda selesai direstorasi dan sudah masuk ke Katalog!"*
- *"Kabar Baik! Sepatu yang Anda donasikan baru saja disalurkan kepada yang membutuhkan."* (Ini akan membuat *member* sangat bahagia dan ingin berdonasi lagi).

### 4. Notifikasi Permohonan Katalog (Request)
Ketika *member* mengajukan permohonan untuk mengambil sepatu dari katalog, sistem akan mengirim email:
- **Ke Member:** *"Permohonan Anda untuk sepatu [Nama Sepatu] sedang kami tinjau."*
- **Jika Disetujui:** *"Selamat! Permohonan sepatu Anda disetujui, silakan hubungi admin untuk proses pengiriman."*

### 5. Welcome Email (Email Sambutan)
Setelah registrasi berhasil diverifikasi, kirimkan satu email HTML dengan desain bagus yang menyambut mereka di ekosistem Shoe Workshop, menjelaskan apa yang bisa mereka lakukan (berdonasi, *check-in* harian, klaim reward, dll).

### 6. Reward & Check-In Harian
Jika mereka berhasil mencapai *streak* 7 hari *check-in* dan mengklaim kupon servis, sistem otomatis mengirimkan kode unik/kupon tersebut ke email mereka sebagai bukti yang bisa ditunjukkan saat klaim.

---

**Bagaimana menurut Anda?** 
Apakah kita ingin mengimplementasikan semuanya (karena menggunakan Resend sangat memungkinkan untuk mengatur berbagai template email dengan mudah), atau Anda ingin kita fokus dulu ke **Auth (Register & Lupa Password)** dan **Status Donasi** sebagai langkah pertama?