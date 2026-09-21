# 💳 Riset Payment Gateway — Shoe Workshop

> Dokumen ini dibuat untuk bahan pengajuan perpindahan dari sistem Transfer Manual ke Payment Gateway yang terintegrasi.

---

## 🔴 Masalah Sistem Transfer Manual (Sekarang)

Berdasarkan tampilan tagihan yang ada, saat ini pelanggan harus:

1. Melihat nomor rekening BCA / Mandiri secara manual
2. Melakukan transfer sendiri via mobile banking
3. Mengunggah **foto bukti transfer** secara manual
4. Menunggu **verifikasi manual oleh admin** sebelum pesanan dikunci

**Problem utamanya adalah:**

| # | Masalah                                                                                  | Dampak                                                      |
| - | ---------------------------------------------------------------------------------------- | ----------------------------------------------------------- |
| 1 | **Verifikasi manual** — Admin harus cek mutasi rekening satu per satu             | Lambat, rawan human error, buang waktu admin                |
| 2 | **Bukti transfer bisa dipalsukan** — Screenshot diedit menggunakan aplikasi       | Kerugian finansial bisnis                                   |
| 3 | **Tidak real-time** — Antara customer bayar dan status terupdate bisa berjam-jam  | Customer tidak sabar, experience buruk                      |
| 4 | **Tidak ada sistem otomatis** — Admin libur/tidur = pesanan numpuk                | Operasional tidak bisa berjalan tanpa manusia               |
| 5 | **Tidak ada histori transaksi terpusat** — Harus cek rekening koran secara manual | Rekonsiliasi keuangan susah, tidak scalable                 |
| 6 | **Pelanggan tidak bisa pakai dompet digital / QRIS** — Hanya bisa TF bank         | Kehilangan potensi pembeli yang biasa pakai GoPay, OVO, dll |

---

## ✅ Keuntungan Pakai Payment Gateway

- ✅ **Konfirmasi otomatis** — Begitu customer bayar, sistem langsung detect & update status
- ✅ **Tidak bisa dipalsukan** — Pembayaran terverifikasi langsung dari bank/e-wallet
- ✅ **Banyak metode pembayaran** — VA semua bank, QRIS, GoPay, OVO, ShopeePay, kartu kredit
- ✅ **Dashboard transaksi terpusat** — Rekap keuangan otomatis, laporan tinggal download
- ✅ **Admin tidak perlu standby 24 jam** — Sistem jalan otomatis
- ✅ **Lebih profesional** — Customer experience jauh lebih baik dan terpercaya

---

## 🔬 Perbandingan 4 Payment Gateway

---

### 1. 🟢 Midtrans *(Rekomendasi Utama)*

> Dimiliki oleh GoTo Group (Gojek). Paling populer dan familiar di Indonesia, khususnya untuk UMKM & toko online.

#### Keunggulan

- **Snap UI** — Halaman pembayaran sudah jadi, tinggal panggil. Tidak perlu desain UI payment dari nol
- **Dokumentasi Bahasa Indonesia** — Sangat ramah developer lokal
- **Ekosistem GoTo** — Terintegrasi langsung dengan GoPay
- **Midtrans GO** — Ada opsi untuk bisnis **perorangan (individu)** yang belum berbadan hukum
- **Payment Link** — Bisa kirim link tagihan via WhatsApp tanpa harus integrasi kode sama sekali

#### Kekurangan

- Settlement dana bisa T+2 sampai T+3 (2-3 hari kerja setelah transaksi)
- Sulit negosiasi fee jika volume masih kecil

#### Biaya Transaksi (MDR)

> Semua harga **belum termasuk PPN 11%** — PPN dihitung dari nilai *biaya*, bukan dari nilai transaksi

| Metode Pembayaran                             | Biaya                         | Total dgn PPN  |
| --------------------------------------------- | ----------------------------- | -------------- |
| Virtual Account BCA                           | Rp4.000 / transaksi           | Rp4.440        |
| Virtual Account BNI / BRI / Mandiri / Permata | Rp4.000 / transaksi           | Rp4.440        |
| QRIS                                          | 0,7% dari nilai transaksi     | 0,777%         |
| GoPay                                         | 2% dari nilai transaksi       | 2,22%          |
| ShopeePay                                     | 1,5% dari nilai transaksi     | 1,665%         |
| Kartu Kredit (MDR)                            | 2% – 3% dari nilai transaksi | 2,22% – 3,33% |
| Biaya Bulanan                                 | Rp0                           | —             |
| Biaya Settlement / Penarikan Dana             | Rp0                           | —             |

> **Simulasi:** Customer bayar Rp475.000 via VA
>
> - Biaya Rp4.000 + PPN Rp440 = **potongan Rp4.440**
> - Dana bersih diterima merchant: **Rp470.560**

#### Syarat Daftar (Midtrans)

**Individu / Perorangan (Starter Pack):**

- KTP (WNI) / Passport & KITAS (WNA)
- Email aktif
- Website/media sosial bisnis yang aktif

**Badan Usaha (PT/CV):**

- KTP Direktur
- NPWP Bisnis
- Akta Pendirian
- Akta Perubahan (jika ada)
- SK Menkumham

**Langkah Daftar:**

1. Buka [midtrans.com](https://midtrans.com) → klik "Daftar Sekarang"
2. Verifikasi email yang masuk
3. Login ke dashboard, klik tombol aktivasi
4. Upload dokumen sesuai tipe bisnis
5. Setujui Syarat & Ketentuan, klik "Ajukan"
6. Sandbox (simulasi) langsung aktif, Production aktif setelah dokumen disetujui
7. Untuk kartu kredit: tunggu ±10 hari kerja

> ⚠️ **Catatan:** Pastikan bisnis tidak masuk [kategori terlarang Midtrans](https://support.midtrans.com/hc/id/articles/204403474)

---

### 2. 🔵 Xendit

> Didirikan 2015, lebih condong ke startup & bisnis yang butuh fleksibilitas teknis tinggi. Beroperasi di Asia Tenggara.

#### Keunggulan

- API paling rapi & dokumentasi kelas dunia (cocok untuk developer yang mau kustom)
- Fitur automasi luas: disbursement (kirim dana massal), invoice otomatis, escrow untuk marketplace
- Settlement lebih cepat: T+1 hingga T+2
- Mendukung 38+ metode pembayaran
- Cocok jika bisnis Anda berkembang besar dan butuh sistem yang scalable

#### Kekurangan

- **Syarat lebih ketat** — Sangat dianjurkan berbadan hukum (PT/CV). Individu murni lebih sulit
- Lebih cocok untuk bisnis yang punya developer handal
- Support kurang responsif untuk UMKM kecil

#### Biaya Transaksi

> Biaya Xendit terdiri dari **biaya metode pembayaran + biaya pemrosesan Xendit**, belum termasuk PPN 11%

| Metode Pembayaran      | Biaya Metode  | Biaya Proses Xendit | Total Estimasi           |
| ---------------------- | ------------- | ------------------- | ------------------------ |
| VA BCA                 | Rp9.000 / trx | Rp4.000 / trx       | **Rp13.000 / trx** |
| VA BNI / BRI / Mandiri | Rp4.000 / trx | Rp4.000 / trx       | **Rp8.000 / trx**  |
| QRIS                   | 0,7%          | termasuk            | **0,7%**           |
| GoPay                  | 2,0%          | termasuk            | **2,0%**           |
| OVO / Dana / LinkAja   | 1,5% – 2,73% | termasuk            | **1,5% – 2,73%**  |
| Kartu Kredit           | 2,9%          | +Rp2.000            | **2,9% + Rp2.000** |
| Biaya Bulanan          | Rp0           | —                  | —                       |
| Sub-akun (xenPlatform) | Rp25.000/bln  | per akun aktif      | —                       |

#### Syarat Daftar (Xendit)

- **KTP** pemilik/direktur
- **NPWP** pribadi dan perusahaan
- **NIB (Nomor Induk Berusaha)** — wajib, bisa dibuat gratis di [oss.go.id](https://oss.go.id)
- **Akta Pendirian** + SK Menkumham (untuk badan hukum)
- Website/aplikasi bisnis yang sudah aktif

**Langkah Daftar:**

1. Buka [dashboard.xendit.co/register](https://dashboard.xendit.co/register)
2. Verifikasi email
3. Masuk dashboard → klik "Aktifkan Akun"
4. Upload semua dokumen legalitas
5. Tanda tangani Service Agreement Letter
6. Tim Xendit review KYC ±1 minggu

---

### 3. 🟡 Tripay *(Alternatif Simpel)*

> Lokal Indonesia, paling simpel dan tidak ribet untuk UMKM yang baru mulai.

#### Keunggulan

- **Syarat daftar paling mudah** — cukup KTP dan website
- Verifikasi 1–2 hari kerja
- Tidak ada biaya bulanan
- Mendukung QRIS, VA semua bank, Alfamart, Indomaret

#### Kekurangan

- Fitur lebih terbatas dibanding Midtrans/Xendit
- Terkadang **menutup pendaftaran** sementara untuk merchant baru (perlu pantau)
- Kurang cocok jika volume transaksi sangat tinggi
- Brand awareness lebih kecil di mata customer

#### Biaya Transaksi

> Semua belum termasuk PPN 11%

| Metode Pembayaran                       | Biaya                             | Total dgn PPN      |
| --------------------------------------- | --------------------------------- | ------------------ |
| VA BCA                                  | Rp5.500 / transaksi               | Rp6.105            |
| VA BNI / BRI / Mandiri / Permata / CIMB | Rp4.250 / transaksi               | Rp4.718            |
| QRIS                                    | Rp750 + 0,7% dari nilai transaksi | +PPN dari biayanya |
| Indomaret / Alfamart                    | +Rp3.000 (dibebankan ke customer) | —                 |
| Penarikan dana (withdrawal)             | Rp7.500 per penarikan             | —                 |
| Biaya Bulanan                           | Rp0                               | —                 |

#### Syarat Daftar (Tripay)

- Nama lengkap sesuai KTP
- Email aktif
- Nomor WhatsApp aktif
- KTP yang masih berlaku
- Website yang sudah selesai & bisa diakses publik (bukan under construction)
- Website harus memiliki: nama merchant, produk/jasa, kebijakan privasi, kontak
- ⚠️ Domain gratisan (.my.id, .xyz, .blogspot, dll.) **tidak diterima**

---

### 4. 🟠 iPaymu *(Alternatif Lokal)*

> Payment gateway lokal Indonesia, mendukung berbagai metode pembayaran dengan proses KYC yang cukup detail.

#### Keunggulan

- Mendukung KTP saja untuk individu (personal merchant)
- Fee bisa diatur: dibebankan ke merchant atau ke pembeli
- Ada sertifikasi "Belanja Aman" untuk meningkatkan kepercayaan customer
- Aktivasi 1–2 hari kerja

#### Kekurangan

- Kurang sepopuler Midtrans/Xendit di kalangan developer Laravel
- Butuh SIUP/NIB bahkan untuk merchant personal
- Support kurang fast-response dibanding Midtrans

#### Biaya Transaksi

> Semua belum termasuk PPN 11%

| Metode Pembayaran                            | Biaya                          | Total dgn PPN      |
| -------------------------------------------- | ------------------------------ | ------------------ |
| VA Bank Umum (BNI, BRI, CIMB, Permata, dll.) | Rp3.500 / transaksi            | Rp3.885            |
| VA Mandiri                                   | Rp4.000 / transaksi            | Rp4.440            |
| VA BCA                                       | Rp3.500 – Rp4.500 / transaksi | Rp3.885 – Rp4.995 |
| QRIS (UMKM)                                  | 0,3% dari nilai transaksi      | 0,333%             |
| QRIS (Reguler / Non-UMKM)                    | 0,7% dari nilai transaksi      | 0,777%             |
| Biaya Bulanan                                | Rp0                            | —                 |
| Biaya Aktivasi                               | Rp0                            | —                 |

> 💡 **Bonus:** Mulai Desember 2024, transaksi QRIS s.d. Rp500.000 untuk usaha mikro = **MDR 0% (gratis)** sesuai kebijakan Bank Indonesia

#### Syarat Daftar (iPaymu)

**Personal:**

- KTP + swafoto bersama KTP
- Foto buku rekening (nama harus sama dengan KTP)
- NPWP / NIK
- SIUP / NIB
- Website/toko online aktif dengan minimal 5 produk (bisa ujicoba checkout sampai pembayaran)

**Perusahaan/Yayasan:**

- KTP + swafoto PIC/Direktur
- Rekening bank atas nama PT/CV/Yayasan
- NPWP perusahaan
- NIB / SIUP
- Akta pendirian

---

## ⚖️ Tabel Perbandingan Biaya Per Metode Pembayaran

> Semua angka **belum termasuk PPN 11%**. Diurutkan dari yang paling murah.

### Virtual Account (Metode paling populer di Indonesia)

| Bank                       | Midtrans | Xendit             | Tripay                  | iPaymu         |
| -------------------------- | -------- | ------------------ | ----------------------- | -------------- |
| **BCA VA**           | Rp4.000  | **Rp13.000** | Rp5.500                 | Rp3.500–4.500 |
| **BNI VA**           | Rp4.000  | Rp8.000            | Rp4.250                 | Rp3.500        |
| **BRI VA**           | Rp4.000  | Rp8.000            | Rp4.250                 | Rp3.500        |
| **Mandiri VA**       | Rp4.000  | Rp8.000            | Rp4.250                 | Rp4.000        |
| **Permata VA**       | Rp4.000  | Rp8.000            | Rp4.250                 | Rp3.500        |
| **Biaya Settlement** | Rp0      | Rp0                | **Rp7.500/tarik** | Rp0            |

### QRIS & E-Wallet

| Metode                 | Midtrans | Xendit         | Tripay         | iPaymu             |
| ---------------------- | -------- | -------------- | -------------- | ------------------ |
| **QRIS**         | 0,7%     | 0,7%           | Rp750 + 0,7%   | 0,3% (UMKM) / 0,7% |
| **GoPay**        | 2,0%     | 2,0%           | — (tidak ada) | via QRIS           |
| **ShopeePay**    | 1,5%     | —             | —             | via QRIS           |
| **OVO / Dana**   | —       | 1,5%–2,73%    | —             | via QRIS           |
| **Kartu Kredit** | 2–3%    | 2,9% + Rp2.000 | —             | —                 |

---

## 🧮 Simulasi Potongan Nyata (Transaksi VA BNI / Metode Paling Umum)

> Setelah PPN 11% sudah dihitung

| Nilai Transaksi       | Midtrans                                    | Xendit                                      | Tripay                                      | iPaymu                                      |
| --------------------- | ------------------------------------------- | ------------------------------------------- | ------------------------------------------- | ------------------------------------------- |
| **Rp100.000**   | Potong Rp4.440 → terima**Rp95.560**  | Potong Rp8.880 → terima**Rp91.120**  | Potong Rp4.718 → terima**Rp95.283**  | Potong Rp3.885 → terima**Rp96.115**  |
| **Rp200.000**   | Potong Rp4.440 → terima**Rp195.560** | Potong Rp8.880 → terima**Rp191.120** | Potong Rp4.718 → terima**Rp195.283** | Potong Rp3.885 → terima**Rp196.115** |
| **Rp475.000**   | Potong Rp4.440 → terima**Rp470.560** | Potong Rp8.880 → terima**Rp466.120** | Potong Rp4.718 → terima**Rp470.283** | Potong Rp3.885 → terima**Rp471.115** |
| **Rp1.000.000** | Potong Rp4.440 → terima**Rp995.560** | Potong Rp8.880 → terima**Rp991.120** | Potong Rp4.718 → terima**Rp995.283** | Potong Rp3.885 → terima**Rp996.115** |

> 💡 **Catatan:** Untuk VA, biaya bersifat **flat (tetap)** — tidak peduli transaksinya Rp100rb atau Rp1jt, potongannya sama!
> Xendit jauh lebih mahal untuk VA karena ada **biaya metode BNI Rp4.000 + biaya proses Xendit Rp4.000** = dobel.

---

## 🧮 Simulasi Potongan QRIS (Nominal transaksi Rp475.000)

| Platform                   | Rumus                         | Potongan          | Dana Diterima       |
| -------------------------- | ----------------------------- | ----------------- | ------------------- |
| **Midtrans**         | 0,7% × 475.000 = 3.325 + PPN | **Rp3.691** | **Rp471.309** |
| **Xendit**           | 0,7% × 475.000 = 3.325 + PPN | **Rp3.691** | **Rp471.309** |
| **Tripay**           | (Rp750 + 0,7%×475.000) + PPN | **Rp4.524** | **Rp470.476** |
| **iPaymu (UMKM)**    | 0,3% × 475.000 = 1.425 + PPN | **Rp1.582** | **Rp473.418** |
| **iPaymu (Reguler)** | 0,7% × 475.000 = 3.325 + PPN | **Rp3.691** | **Rp471.309** |

---

## 📈 Kestabilan & Skalabilitas Biaya Admin (Transaksi Skala Besar vs Kecil)

> Berdasarkan pola perhitungan tarif, ini adalah kelebihan dan kelemahan masing-masing platform jika bisnis Anda mengalami lonjakan transaksi besar (misal: pesanan *borongan* atau *b2b*).

| Payment Gateway    | Plus (Kelebihan Skalabilitas)                                                                                                                                                                  | Minus (Kekurangan Skalabilitas)                                                                                                                                         | Kesimpulan Stabilitas                                                                                                                     |
| ------------------ | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------- |
| **Midtrans** | **✅ Paling Stabil.** Biaya VA bersifat FLAT mutlak (selalu Rp4.440/trx) baik transaksi Rp50rb maupun Rp10Juta. Tidak ada pemotongan biaya *settlement* saat menarik dana ke rekening. | ❌ Kurang ramah untuk transaksi mikro di bawah Rp20rb jika pembeli memaksa pakai VA (karena potongan terasa mahal persentasenya).                                       | **Sangat Stabil.** Tidak akan ada "biaya kaget" saat transaksi meledak besar.                                                       |
| **Xendit**   | ✅ Biaya VA FLAT. Sangat andal untuk volume super besar karena infrastrukturnya skala enterprise.                                                                                              | ❌ Biaya dasar paling mahal untuk bank umum (dobel*charge* biaya metode + biaya pemrosesan).                                                                          | **Stabil tapi Mahal.** Anda tidak akan rugi persentase, tapi modal biaya dasarnya sudah tinggi.                                     |
| **Tripay**   | ✅ Tidak ada biaya bulanan. Cocok untuk toko yang transaksinya masih sedikit/fluktuatif.                                                                                                       | ❌ Ada biaya tambahan (Rp7.500) SETIAP kali menarik dana (*withdrawal*) ke rekening bank. Jika narik tiap hari, sebulan habis Rp225.000 hanya untuk admin tarik dana. | **Tidak Stabil untuk Volume Tinggi.** Biaya *withdrawal* akan sangat menggerus profit jika intensitas pencairan tinggi.           |
| **iPaymu**   | ✅ Memiliki opsi fleksibel di mana biaya transaksi (VA/QRIS) bisa otomatis dibebankan 100% ke pembeli, sehingga merchant terima bersih.                                                        | ❌ Memiliki syarat verifikasi yang kadang menahan dana (*hold*) lebih lama jika ada lonjakan transaksi tiba-tiba yang dianggap mencurigakan (*fraud review*).       | **Cukup Stabil.** Namun kurang *smooth* dibanding Midtrans dalam menangani *spike* (lonjakan) transaksi skala menengah ke atas. |

---

## ⚖️ Perbandingan Umum

| Kriteria                           | Midtrans           | Xendit                 | Tripay             | iPaymu              |
| ---------------------------------- | ------------------ | ---------------------- | ------------------ | ------------------- |
| **Target**                   | UMKM & e-commerce  | Startup & enterprise   | UMKM kecil         | UMKM lokal          |
| **Syarat Individu**          | ✅ Bisa (KTP saja) | ⚠️ Perlu badan usaha | ✅ Bisa (KTP saja) | ✅ Bisa (KTP + NIB) |
| **Kemudahan Integrasi**      | ⭐⭐⭐⭐⭐         | ⭐⭐⭐⭐               | ⭐⭐⭐             | ⭐⭐⭐              |
| **Metode Pembayaran**        | 25+                | 38+                    | 15+                | 20+                 |
| **Dokumentasi (ID)**         | ✅ Lengkap         | ✅ Ada                 | ⚠️ Terbatas      | ⚠️ Terbatas       |
| **Settlement**               | T+2 – T+3         | T+1 – T+2             | T+1 – T+2         | T+1 – T+2          |
| **Biaya VA**                 | ±Rp4.000/trx      | ±Rp4.000/trx          | Cek dashboard      | Cek pricing         |
| **Biaya QRIS**               | ±0,7%             | Cek pricing            | Ada                | Ada                 |
| **Biaya Bulanan**            | Rp0                | Rp0                    | Rp0                | Rp0                 |
| **Popularitas di Indonesia** | ⭐⭐⭐⭐⭐         | ⭐⭐⭐⭐               | ⭐⭐⭐             | ⭐⭐                |
| **Plugin/Library Laravel**   | Banyak tersedia    | Tersedia               | Tersedia           | Terbatas            |

---

## 🏁 Rekomendasi untuk Shoe Workshop

> Berdasarkan kondisi bisnis Shoe Workshop saat ini (UMKM jasa reparasi, baru merintis sistem digital):

### 🥇 Pilihan Utama: **Midtrans**

- Paling mudah didaftarkan bahkan sebagai **individu perorangan** (cukup KTP)
- Snap UI sudah siap pakai, tidak perlu bangun halaman pembayaran dari nol
- Familiar di kalangan pelanggan Indonesia
- Dokumentasi Laravel/PHP lengkap dan banyak komunitas
- Cocok untuk skala bisnis saat ini

### 🥈 Pilihan Cadangan: **Tripay**

- Jika ingin yang paling simpel tanpa syarat berlebihan
- Cocok jika hanya butuh VA + QRIS saja
- Tapi pantau apakah pendaftaran sedang dibuka

### ❌ Kenapa Tidak Xendit (untuk sekarang)?

- Xendit **sangat menganjurkan** bisnis berbadan hukum (PT/CV). Jika belum punya, prosesnya lebih rumit
- Lebih cocok jika nanti bisnis sudah lebih besar dan butuh fitur disbursement/marketplace

### ❌ Kenapa Tidak iPaymu?

- Butuh SIUP/NIB bahkan untuk personal, sedikit lebih ribet dari Midtrans
- Kurang populer di komunitas developer Laravel Indonesia
- Plugin/package pihak ketiga lebih sedikit

---

## 📋 Checklist Persiapan Sebelum Daftar Midtrans

- [ ] Siapkan **KTP** yang masih berlaku (jika individu)
- [ ] Pastikan **website shoeworkshop.id sudah live** dan dapat diakses publik
- [ ] Pastikan website memiliki: halaman produk/layanan, kontak, kebijakan privasi
- [ ] Siapkan **rekening bank aktif** atas nama yang sama dengan KTP
- [ ] Siapkan **NPWP** (jika ada — untuk badan usaha wajib, individu opsional)
- [ ] Daftar di [midtrans.com](https://midtrans.com) → verifikasi email → upload dokumen

---

*Riset dibuat: 20 Agustus 2026 — Antigravity IDE*
