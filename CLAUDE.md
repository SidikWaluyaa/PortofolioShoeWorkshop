# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Proyek

Customer portal Shoe Workshop: aplikasi Laravel 12 (PHP 8.2+) berbasis Blade yang mencakup landing page publik, portal member (donasi, daily check-in, reward, pengajuan adopsi), dan CMS admin. Data reparasi/pesanan **tidak** disimpan di sini, melainkan diambil dari backend workshop eksternal lewat HTTP. Teks UI, nama route, kolom DB, dan nilai status sebagian besar berbahasa Indonesia (`donasi`, `layanan`, `disetujui`, `ditolak`, dll).

Dijalankan secara lokal lewat Laravel Herd (proyek ada di `~/Herd`). Dokumentasi latar belakang ada di `DOCS_1_WORKFLOW_SYSTEM.md` sampai `DOCS_4_TECH_STACK.md` dan `PRD.md`. Sebagian isinya sudah usang (lihat bagian "API Eksternal" di bawah).

## Perintah

```bash
composer setup            # instalasi pertama: deps, .env, key, migrate, npm build
composer dev              # serve + queue:listen + log pail + vite sekaligus
npm run dev               # vite saja (kalau PHP sudah dilayani Herd)
npm run build             # vite build + pwa-postbuild.js (menyalin sw.js/manifest/workbox ke public/)

composer test             # config:clear lalu seluruh suite PHPUnit
php artisan test --filter=CheckinTest                # satu kelas test
php artisan test --filter=test_method_name           # satu method test
php artisan test tests/Feature/RewardClaimTest.php   # satu file

./vendor/bin/pint         # gaya kode (Laravel Pint)
```

Test default berjalan di SQLite in-memory (`phpunit.xml`), dengan mail `array` dan queue `sync`. Saat ini beberapa migration lama memakai `ALTER TABLE … MODIFY` yang khusus MySQL, sehingga suite gagal di SQLite. Jalankan test di database MySQL terpisah:

```bash
DB_CONNECTION=mysql DB_DATABASE=shoe_workshop_testing php artisan test
```

Migration baru yang mengubah enum harus jalan di dua driver (lihat `2026_10_27_000000_add_dipesan_status_to_donation_items_table.php`). Sekitar 37 test lama memang sudah gagal karena usang. Bandingkan dengan kondisi sebelum perubahan, bukan mengharapkan semuanya hijau.

## Arsitektur

**Routing**: semuanya ada di `routes/web.php` (route auth Breeze di `routes/auth.php`). Ada tiga zona:
- Publik: home, `/layanan`, `/portfolio`, `/blog`, `/tracking`, `/klaim-garansi`, `/donasi-katalog`.
- `member.*` (`/member/...`): `auth` + `verified`. Controller-nya di `app/Http/Controllers/Member/`.
- `admin.*` (`/admin/...`): `auth` + `verified` + `admin`. Alias `admin` didaftarkan di `bootstrap/app.php` dan mengarah ke `AdminMiddleware`, yang memanggil `User::isAdmin()`. User dengan role `admin` atau `super_admin` dianggap admin, selainnya `member`. `/dashboard` me-redirect sesuai role.

**Controller → Service → Model**: logika bisnis ada di `app/Services/*Service.php` yang di-inject ke controller. Contoh: `DonationService` mengatur transisi status donasi, `CheckinService` menangani check-in dan streak, `RewardService` menangani klaim reward dan pembuatan kode. Logika baru taruh di service yang sesuai, bukan di controller.

**CMS landing page**: `HomeController` mengambil record aktif dari tiap model section (hero, trust, layanan/`LayananCategory`, projects, workflow, about, CTA, reviews, posts, `DonationItem` yang tersedia) lalu merender `home.blade.php`, yang tersusun dari partial di `resources/views/components/`. Admin mengelola tiap section lewat resource controller.
- Ada dua katalog layanan. `Service` / `admin.services` adalah versi lama. `LayananCategory` → `LayananService` (`admin.layanan-categories.services`) adalah versi yang dipakai sekarang oleh home page dan `/layanan`.

**Setting global**: tabel key/value `settings` dimuat sekali per request di `AppServiceProvider` dan dibagikan ke **semua view** sebagai `$globalSettings`. Admin mengubahnya di `admin.settings`. Info kontak, toggle, dan konfigurasi API eksternal semuanya disimpan di sini.

**API Eksternal** dikonfigurasi lewat baris di tabel `settings`, bukan `.env`. Dokumen yang menyebut `API_BASE_URL` sudah usang.
- `TrackingController` dan `Admin\TrackingController` membaca `tracking_base_url` dan memanggil `GET {base}/api/v1/public/track?spk_number=`.
- `WarrantyClaimController` mem-proxy request cek/submit garansi ke backend supaya browser tidak kena CORS. Base URL-nya juga dari `tracking_base_url`.
- `Member\ReparationHistoryController` membaca `workshop_api_base_url` dan `workshop_api_key`, memanggil `/customer-portal/orders?phone=` dengan header `X-API-KEY`, dan meng-cache hasilnya 5 menit per nomor HP.
- `Admin\AiDescriptionController` memanggil OpenRouter memakai `OPENROUTER_API_KEY` / `OPENROUTER_MODEL` dari `.env`.

**Siklus donasi (CSR)**: ini alur domain utama. Status berupa string/enum yang sudah diubah oleh banyak migration, jadi cek migration terbaru sebelum menambah nilai baru.
- `Donation` (member mendonasikan sepatu): `pending` → `disetujui` (disetujui, menunggu pengiriman/resi) → `diterima` (diterima, dengan foto bukti) → restorasi (`siap_rilis` → `masuk_katalog`) atau `disalurkan`. Bisa juga `ditolak`. Member hanya bisa mengedit donasi selama masih `pending`, dan hanya bisa mengisi resi saat `disetujui`.
- `DonationItem` adalah sepatu hasil restorasi di katalog publik: `tersedia` → `dipesan` (disembunyikan dari katalog selama pembayaran diverifikasi) → `disalurkan`, atau `arsip`. Terhubung ke `DonationItemService` / layanan reparasi.
- `DonationRequest` ("adopsi"): semua perpindahan statusnya lewat `AdoptionService::transition()`. Jangan meng-update status langsung. Ada dua mode, dipilih lewat setting `adoption_mode` (Admin → Pengaturan), dibaca dengan `AdoptionService::curationMode()`:
  - `kurasi` (default sejak 29 Okt 2026, kebijakan sementara manajemen): pengajuan dibuat sebagai `pending` tanpa tagihan (email `AdoptionSubmittedMail`), alasan minimal 20 karakter, maksimal 3 pengajuan `pending` per member. Admin memilih satu pemohon → `menunggu_pembayaran` dengan `batas_bayar` = +48 jam, sepatu langsung `dipesan`. Pemohon lain tetap `pending` sebagai cadangan (`isReserve()`). Kalau yang terpilih tidak bayar, admin membatalkan (sepatu kembali `tersedia`) lalu memilih cadangan. Tidak ada pembatalan otomatis.
  - `cepat` ("siapa cepat dia dapat", kebijakan lama): pengajuan langsung `menunggu_pembayaran` dengan email tagihan. Pemohon pertama yang mengunggah bukti bayar → `menunggu_verifikasi`, sepatu jadi `dipesan`, dan pemohon lain "ditahan" (`isOnHold()`).
  - Di kedua mode: kalau admin menyetujui pembayaran (`diproses` → `dikirim` → `selesai`), sepatu jadi `disalurkan` dan pemohon lain otomatis `ditolak`. Email ke user hanya dikirim saat status benar-benar berubah. Test: `tests/Feature/AdoptionCurationTest.php` dan `tests/Feature/AdoptionFlowTest.php` (mode `cepat`). Panduan bisnisnya ada di `DOCS_5_DONASI_ADOPSI.md`.
- Gamifikasi: check-in `DailyLogin` berupa unggahan foto yang di-approve admin. Streak yang disetujui membuka `Reward`, dan klaimnya dicatat di `UserReward` dengan kode unik. Reward punya `kategori_reward` (misalnya `donasi`), `stok` opsional, dan masa berlaku `berlaku_dari`/`berlaku_sampai`.

**Notifikasi & email**: mailable ada di `app/Mail/`, dikirim lewat Resend (`resend/resend-php`, `symfony/resend-mailer`). Notifikasi in-app memakai tabel `notifications` (`SystemNotification`, `MemberAdoptionStatusNotification`). Email reset password dan verifikasi memakai view custom di `resources/views/emails/auth/`, dipasang di `AppServiceProvider`.

**Upload**: gambar dari user dan admin disimpan di disk `public`. Sebagian besar alur upload melewati `App\Helpers\ImageCompressionHelper` sebelum disimpan, jadi pakai helper ini untuk upload gambar baru. Ekspor memakai `barryvdh/laravel-dompdf` (PDF) dan ekspor Excel buatan sendiri di `Admin\DonationItemController`.

**Frontend**: Blade, Alpine.js, dan Tailwind CSS **v3** (`tailwind.config.js`, PostCSS). `@tailwindcss/vite` v4 ada di `package.json` tapi tidak dipakai di `vite.config.js`, jadi jangan pakai sintaks v4. Font Plus Jakarta Sans dan ikon Material Symbols Outlined. Aplikasi ini PWA via `vite-plugin-pwa`; `npm run build` harus menjalankan `pwa-postbuild.js` supaya service worker dilayani dari web root. Layout ada di `resources/views/layouts/`. View admin di `resources/views/admin/` dan view member di `resources/views/member/`. Role `donatur` sudah diganti jadi `member`, tapi masih ada beberapa pemanggilan `view('donatur.…')` (misalnya di `Member\ReparationHistoryController`). Folder `resources/views/donatur/` sudah tidak ada, jadi jalur kode tersebut akan error.

## Hal yang Perlu Diwaspadai

- `Schema::defaultStringLength(191)` dipasang untuk MySQL versi lama. HTTPS dipaksa saat `APP_ENV=production`.
- `routes/web.php` masih berisi route debug tanpa autentikasi: `/api/debug-rewards`.
- File `*.md`, `*.sql`, `test_script.php`, `migrate_role.php`, dan `cleanup_alerts.*` di root adalah catatan perencanaan dan skrip sekali pakai, bukan bagian dari aplikasi.
