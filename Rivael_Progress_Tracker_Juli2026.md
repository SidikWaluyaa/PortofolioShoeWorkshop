# Rivael – Web Developer
**Shoe Workshop – Data Analyst Team**

---

## To Do List

| Tugas / Aktivitas | Selesai | % Progress | Catatan |
|---|:---:|:---:|---|
| Selesaikan halaman inti: Home, Layanan, Company Profile, Tracking SPK | ✅ | 99% | Semua halaman inti sudah live dan fungsional: Home (hero dinamis, slider, CTA, donasi showcase, blog, review), Layanan (kategori + jasa + before-after slider), Portfolio (before-after per kategori), Tracking SPK (integrasi API eksternal + error handling), Blog (index + detail), Katalog Donasi (index + detail + request + sukses), Garansi (klaim form interaktif). Sisa 1%: Polish minor & final copywriting. |
| Pastikan mobile-friendly & tidak ada error terlihat | ✅ | 99% | Semua layout menggunakan Tailwind responsive (`sm:`, `md:`, `lg:`, `xl:`). Navbar mobile (hamburger menu) tersedia di semua layout (public, member, admin). Bug validasi "Bidang role wajib diisi" saat edit profil sudah di-fix. Standarisasi SweetAlert global menggantikan flash message bawaan Breeze. Form error handling sudah ditangani. |
| Review dengan Radit sebelum launch (sign-off QA wajib) | 🔄 | 80% | Radit sudah selesai melakukan review QA bagian **UI/UX Flow & Bug** (didokumentasikan di Figma). Dari temuan bug tersebut, ~80% sudah berhasil di-solving. Sisa: QA bagian **codingan/code review** oleh Radit + penyelesaian 20% bug minor yang tersisa. |
| Tambahkan elemen konversi (CTA WhatsApp, tombol order) di tiap halaman | ✅ | 100% | CTA WhatsApp sudah terintegrasi di: Home (section CTA), Layanan, Portfolio, Tracking (link wa.me), Blog detail, Katalog Donasi (request & success), Riwayat Reparasi member, Footer global. Tombol "Order Sekarang" / "Konsultasi Gratis" sudah ada di Home & Layanan. Tombol WhatsApp sticky/floating juga sudah aktif di pojok kanan bawah semua halaman. |
| Integrasi fitur tracking SPK (koordinasi API dengan Sidik) | ✅ | 100% | API tracking SPK sudah terintegrasi penuh. Menggunakan pola `timeout(5)->retry(3)` sesuai PRD. Endpoint API tersimpan di admin settings dan bisa dikonfigurasi. Hasil tracking menampilkan status, foto before/after, dan timeline proses. |
| Buat UI tracking SPK sederhana + handle error state | ✅ | 100% | Halaman tracking (`tracking.blade.php`, 21KB) sudah lengkap: form pencarian SPK, animasi loading, tampilan hasil detail (status, timeline, foto), dan error state (SPK tidak ditemukan, server error, timeout). UI premium dengan ikon & animasi. |
| Pasang Google Analytics / tools tracking marketing sebelum live | ✅ | 90% | Google Analytics (gtag.js) sudah terpasang di semua layout: `main.blade.php` (ID: G-SSD46ZTTY4), `member.blade.php` (ID: G-M5QQPYH1V7), `guest.blade.php` (ID: G-M5QQPYH1V7), `app.blade.php` (ID: G-M5QQPYH1V7). Dashboard admin juga sudah ada section Looker Studio embed untuk visualisasi. Sisa: Verifikasi & seragamkan ID GA di semua layout, dan pastikan tracking conversion event sudah ter-setup. |
| Berikan akses & briefing dasar ke tim marketing | 🔄 | 60% | Admin panel sudah siap (CRUD konten: Hero, Layanan, Portfolio, Blog, Review, CTA, Settings, Campaign). Sistem campaign tracking dengan URL click-tracking sudah tersedia. Akses admin bisa dibuat via User Management. Sisa: Sesi briefing langsung dengan tim marketing belum terjadwal. |
| SEO dasar: meta title, meta description, struktur heading tiap halaman | ✅ | 100% | Meta title (`@yield('seo_title')`), meta description (`@yield('seo_description')`), Open Graph tags (og:title, og:description, og:image), Twitter Card meta, dan canonical URL sudah terpasang di layout utama (`main.blade.php`). Sitemap XML (`/sitemap.xml`) sudah tersedia via `SitemapController`. Struktur heading (H1-H3) sudah konsisten di semua halaman publik. |
| Optimasi gambar & kecepatan loading mobile | ✅ | 85% | `ImageCompressionHelper` sudah digunakan di 11 controller (Donation, Checkin, Profile, Project, Hero, Layanan, DonationItem, About, Campaign, AdoptionRequest). Gambar dikompresi otomatis sebelum disimpan. Lazy loading (`loading="lazy"`) sudah diterapkan di beberapa halaman (Home, Tracking, Hero). Sisa: Audit menyeluruh lazy loading di semua gambar & tambahkan format WebP jika memungkinkan. |
| Siapkan template landing page reusable untuk campaign marketing | ❌ | 0% | Belum dimulai. Infrastruktur Campaign (CRUD, click tracking) sudah tersedia di admin, tapi template landing page reusable belum dibuat. |
| Tambahkan tombol WhatsApp sticky di semua halaman | ✅ | 100% | Tombol WhatsApp floating/sticky sudah aktif dan tampil di pojok kanan bawah semua halaman publik (Home, Layanan, Portfolio, Tracking, dll). Tombol langsung membuka chat ke CS Shoe Workshop saat diklik. |
| Buat halaman khusus Kerjasama / Partnership (B2B) | ❌ | 0% | Belum dimulai. Belum ada route, controller, ataupun view untuk halaman partnership/B2B. |
| Monitoring data analytics & lakukan iterasi perbaikan conversion | 🔄 | 30% | Infrastruktur sudah tersedia (GA terpasang, Looker Studio embed di dashboard admin, Campaign click tracking aktif). Namun belum ada proses rutin monitoring mingguan atau laporan iterasi konversi yang terdokumentasi. |

---

## Target Terukur

| Target Terukur | Target Angka | Realisasi | % Capaian |
|---|:---:|:---:|:---:|
| Website Shoe Workshop live & bisa diakses publik | 1 | 1 | 100% |
| Halaman aktif: Home, Layanan, About, Tracking SPK | 4+ | 10+ | 100% |
| Fitur tracking SPK live & terhubung database internal | 1 | 1 | 100% |
| Marketing tracking aktif sejak hari pertama launch | 1 | 1 | 90% |
| Halaman tanpa SEO dasar | 0 | 0 | 100% |

*Catatan Realisasi Halaman Aktif: Home, Layanan, Portfolio, Tracking SPK, Blog (index+detail), Katalog Donasi (index+detail+request+sukses), Garansi, Dashboard Member, Dashboard Admin = 10+ halaman publik & internal.*

*Progress Tracker Juli 2026 — Diperbarui: 14 Juli 2026*

---

## Kolaborasi Utama

| Tugas / Aktivitas | Selesai | % Progress | Catatan |
|---|:---:|:---:|---|
| Sidik – koordinasi API endpoint tracking SPK (dependency utama) | ✅ | 100% | API endpoint sudah terintegrasi dan berfungsi. Konfigurasi URL endpoint tersimpan di admin settings. Pola retry & timeout sudah diterapkan sesuai PRD. |
| Radit – review website sebelum launch (wajib QA sign-off) | 🔄 | 80% | Radit sudah selesai review UI/UX Flow & Bug (via Figma). Bug yang ditemukan ~80% sudah di-solving. Sisa: QA code review + fixing 20% bug minor. |
| PM – semua request landing page baru masuk lewat backlog PM | 🔄 | 20% | Infrastruktur campaign sudah siap di admin panel (CRUD + click tracking). Menunggu request landing page pertama dari PM melalui backlog resmi. |
