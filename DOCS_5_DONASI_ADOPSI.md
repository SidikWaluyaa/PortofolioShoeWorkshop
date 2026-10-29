# Program Donasi & Adopsi Sepatu Shoe Workshop

Panduan alur, aturan, dan ketentuan program donasi dan adopsi sepatu di shoeworkshop.id. Isinya disusun dari cara sistem bekerja saat ini (Oktober 2026) dan keputusan bisnis yang sudah disepakati.

Bagian [Yang belum diatur](#7-yang-belum-diatur) berisi kebijakan yang belum ditetapkan dan perlu diputuskan tim.

---

## 1. Gambaran singkat

Program ini menghubungkan dua pihak:

|         | **Donasi**                              | **Adopsi**                                           |
| ------- | --------------------------------------------- | ---------------------------------------------------------- |
| Siapa   | Member yang **memberikan** sepatu bekas | Member yang **mengambil** sepatu hasil restorasi     |
| Di mana | Portal member → Donasi                       | Katalog publik **/donasi** → Ajukan Adopsi          |
| Bayar?  | Tidak                                         | Ya, **hanya biaya jasa restorasi** + ongkir terpisah |
| Imbalan | Kesempatan klaim **reward donasi**      | Sepatu layak pakai dengan biaya jasa saja                  |

Alurnya: **sepatu didonasikan → diterima workshop → direstorasi → masuk katalog → diadopsi pemilik baru.**

Istilah yang dipakai di seluruh situs:

- **Donasi**: memberikan sepatu. Juga nama program dan menu "Donasi" (URL /donasi).
- **Adopsi**: mengambil sepatu dari katalog ("Katalog Adopsi", "Ajukan Adopsi", "Adopsi Saya").

---

## 2. Syarat umum

- Wajib punya **akun member** dengan **email yang sudah diverifikasi**, baik untuk donasi maupun adopsi.
- Password akun minimal 8 karakter, berisi huruf dan angka.
- Semua notifikasi penting dikirim lewat **email** yang terdaftar, dan juga muncul sebagai notifikasi di portal.

---

## 3. Alur Donasi (memberikan sepatu)

### 3.1 Mengajukan donasi

Member mengisi formulir di **Portal Member → Donasi → Donasi Baru**:

| Data            | Keterangan                      |
| --------------- | ------------------------------- |
| Nama sepatu     | Wajib, maks. 150 karakter       |
| Ukuran          | Wajib                           |
| Kondisi         | Wajib, dalam persen (0–100%)   |
| Perkiraan harga | Opsional                        |
| Deskripsi       | Opsional, maks. 2.000 karakter  |
| Foto            | **Wajib, minimal 1 foto** |

Admin mendapat notifikasi setiap ada donasi baru.

### 3.2 Status donasi

```
pending ──► disetujui ──► diterima ──► siap_rilis ──► masuk_katalog
   │                          │
   └──► ditolak               └──► disalurkan
```

| Status                  | Artinya                                  | Yang terjadi                                                                                                                                                                                                            |
| ----------------------- | ---------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| **pending**       | Menunggu verifikasi admin                | Member **masih bisa mengubah** data donasi, hanya di status ini                                                                                                                                                   |
| **disetujui**     | Donasi diterima, menunggu sepatu dikirim | Member mendapat email persetujuan berisi alamat dan jam operasional workshop, lalu **mengisi cara pengiriman**: antar langsung, atau ekspedisi + nama ekspedisi + nomor resi. Resi hanya bisa diisi di status ini |
| **diterima**      | Sepatu sudah sampai di workshop          | Admin mengunggah **foto bukti penerimaan**. Member mendapat email "donasi diterima"                                                                                                                               |
| **siap_rilis**    | Restorasi selesai                        | Sepatu siap dimasukkan ke katalog                                                                                                                                                                                       |
| **masuk_katalog** | Sepatu tampil di Katalog Adopsi          | Siap diadopsi                                                                                                                                                                                                           |
| **disalurkan**    | Sepatu langsung disalurkan               | Tanpa melalui katalog                                                                                                                                                                                                   |
| **ditolak**       | Donasi tidak diterima                    | Admin wajib menulis alasan. Member mendapat email penolakan                                                                                                                                                             |

### 3.3 Pengiriman sepatu donasi

- Dua pilihan: **antar langsung** ke workshop, atau **kirim lewat ekspedisi**.
- Alamat workshop: Jl. Kembar I No.41, Cigereleng, Kec. Regol, Kota Bandung, Jawa Barat 40253.
- Jam operasional: Senin–Sabtu, 09.00–17.00 WIB. **Minggu tutup.**
- Ongkos kirim donasi ditanggung donatur.

### 3.4 Reward untuk donatur

- Setiap donasi yang sudah **diterima** memberi **satu kesempatan klaim** reward berkategori *donasi* (Portal Member → Reward).
- Satu donasi = satu klaim. Klaim memakai donasi tertua yang belum dipakai.
- Reward bisa punya **stok** dan **masa berlaku**. Klaim gagal kalau stok habis atau di luar masa berlaku.
- Setiap klaim menghasilkan **kode unik** untuk ditukarkan.

---

## 4. Alur Adopsi (mengambil sepatu)

### 4.1 Prinsip utama: siapa cepat dia dapat

- **Banyak orang boleh mengajukan sepatu yang sama.** Setiap pengajuan langsung mendapat tagihan.
- **Sepatu menjadi milik pemohon pertama yang mengunggah bukti transfer**, bukan pemohon pertama yang mengajukan.
- Begitu ada yang membayar, sepatu **disembunyikan dari katalog** dan pemohon lain **ditahan** (tidak bisa membayar) sampai admin memutuskan.

Ini kebijakan yang disengaja, bukan kesalahan sistem.

### 4.2 Mengajukan adopsi

Dari halaman sepatu di katalog → **Ajukan Adopsi**. Data yang diisi:

| Data              | Keterangan                                                                                             |
| ----------------- | ------------------------------------------------------------------------------------------------------ |
| Nama pemohon      | Wajib                                                                                                  |
| Email             | Wajib, untuk tagihan dan notifikasi                                                                    |
| Nomor WhatsApp    | Wajib. Otomatis disimpan dalam format 62…                                                             |
| Alamat pengiriman | Wajib, minimal 10 karakter                                                                             |
| Alasan mengadopsi | Wajib                                                                                                  |
| Pilihan jasa      | Jasa **wajib** otomatis tercentang dan tidak bisa dihapus. Jasa **opsional** boleh dipilih |

Batasan:

- Member hanya boleh punya **1 pengajuan aktif** (menunggu pembayaran atau verifikasi). Pengajuan baru ditolak sampai yang lama selesai.
- **Pengecualian:** kalau pengajuan member sedang **ditahan** karena sepatunya dibayar orang lain, member tetap boleh mengajukan sepatu lain.

### 4.3 Tagihan dan pembayaran

- **Tagihan = total biaya jasa restorasi** yang dipilih (wajib + opsional). Tidak ada harga untuk sepatunya sendiri.
- **Ongkos kirim tidak termasuk tagihan.** CS akan menghubungi pemohon lewat WhatsApp untuk menagih ongkir secara terpisah.
- Tagihan dikirim ke email saat pengajuan dibuat, dan juga tampil di **Portal Member → Adopsi Saya**.
- Pembayaran dengan **transfer bank manual** ke rekening resmi:
  | Bank    | No. Rekening  | Atas Nama                 |
  | ------- | ------------- | ------------------------- |
  | BCA     | 8100978521    | PT TERANG GARAM SOLUSINDO |
  | Mandiri | 1300030119047 | PT TERANG GARAM SOLUSINDO |
- Setelah transfer, **unggah bukti transfer** di halaman Adopsi Saya (JPG/PNG, maks. 5 MB).
- **Satu pembayaran dalam satu waktu:** member tidak bisa membayar sepatu lain selama ada pesanannya yang sedang **diverifikasi** atau **diproses**.
- Payment gateway (bayar otomatis) direncanakan, tapi belum tersedia.

### 4.4 Status adopsi

```
menunggu_pembayaran ──► menunggu_verifikasi ──► diproses ──► dikirim ──► selesai
        │                        │
        │ (orang lain bayar)     └──► ditolak / dibatalkan
        ▼
     ditahan ──► ditolak (sepatu jatuh ke orang lain)
             └─► bisa bayar lagi (sepatu tersedia kembali)
```

| Status                         | Artinya                                                               | Status sepatu di katalog                             |
| ------------------------------ | --------------------------------------------------------------------- | ---------------------------------------------------- |
| **menunggu_pembayaran**  | Tagihan terbit, belum bayar                                           | Tersedia                                             |
| **ditahan**              | Orang lain sudah lebih dulu membayar. **Jangan transfer dulu.** | Disembunyikan (dipesan)                              |
| **menunggu_verifikasi**  | Bukti transfer diunggah, menunggu dicek admin                         | Disembunyikan (dipesan)                              |
| **diproses**             | Pembayaran terverifikasi, sepatu disiapkan                            | Disalurkan                                           |
| **dikirim**              | Sepatu dikirim, nomor resi diinformasikan                             | Disalurkan                                           |
| **selesai**              | Pemohon mengonfirmasi sepatu diterima                                 | Disalurkan                                           |
| **ditolak / dibatalkan** | Pengajuan tidak dilanjutkan                                           | Kembali tersedia (kecuali sudah jatuh ke orang lain) |

Catatan: "ditahan" bukan status tersendiri di database. Pengajuannya tetap *menunggu_pembayaran*, tapi tombol bayar dikunci karena sepatunya sedang dipesan orang lain.

### 4.5 Keputusan admin setelah ada yang membayar

**Admin menyetujui** pembayaran (→ diproses):

- Sepatu resmi milik pemohon tersebut (status sepatu: *disalurkan*).
- **Semua pemohon lain untuk sepatu itu otomatis ditolak** dan mendapat email "sepatu sudah diambil".

**Admin menolak** pembayaran (misalnya bukti tidak valid atau nominal tidak sesuai):

- Sepatu **kembali tersedia** di katalog.
- Pemohon yang ditahan mendapat email "sepatu tersedia lagi" dan bisa langsung membayar. Sekali lagi berlaku siapa cepat dia dapat.

### 4.6 Pengiriman dan penyelesaian

1. Admin memproses pesanan, lalu mengirim sepatu lewat **ekspedisi pihak ketiga** (J&T, dll.) dan mengisi nomor resi.
2. Pemohon menerima sepatu, lalu menekan **Konfirmasi Sepatu Diterima** di Adopsi Saya dan mengunggah **foto bukti penerimaan** (JPG/PNG, maks. 5 MB).
3. Status menjadi **selesai**.

### 4.7 Email yang dikirim ke pemohon

Email hanya dikirim **saat status benar-benar berubah**.

| Kejadian                       | Email                                       |
| ------------------------------ | ------------------------------------------- |
| Pengajuan dibuat               | Tagihan (rincian jasa + rekening)           |
| Orang lain membayar lebih dulu | Pemberitahuan ditahan, jangan transfer dulu |
| Pembayaran disetujui           | Pesanan diproses                            |
| Sepatu dikirim                 | Info pengiriman + resi                      |
| Pemohon konfirmasi diterima    | Adopsi selesai                              |
| Sepatu jatuh ke pemohon lain   | Sepatu sudah diambil                        |
| Sepatu tersedia lagi           | Sepatu tersedia, silakan bayar              |
| Pengajuan ditolak              | Penolakan                                   |

Notifikasi check-in tidak dikirim lewat email.

---

## 5. Ketentuan yang berlaku (dari Syarat & Ketentuan situs)

1. **Pembayaran** biaya jasa restorasi untuk sepatu adopsi harus **penuh** sesuai tagihan. Pesanan **hanya diproses setelah pembayaran terverifikasi.**
2. **Ongkos kirim** sepatu adopsi ditanggung pemohon dan ditagih terpisah oleh CS.
3. **Refund** hanya untuk: pembatalan sebelum pengerjaan dimulai, kesalahan fatal dari Shoe Workshop, atau kelebihan bayar karena kesalahan sistem tagihan. Ketentuan ini ditulis untuk layanan reparasi. Lihat poin 7 untuk adopsi.
4. **Pengiriman:** kerusakan atau kehilangan selama pengiriman oleh ekspedisi pihak ketiga menjadi tanggung jawab pihak ekspedisi.
5. **Barang tidak diambil** lebih dari 30 hari sejak pemberitahuan selesai berisiko disumbangkan atau tidak lagi menjadi tanggung jawab Shoe Workshop.

---

## 6. Panduan singkat untuk admin & CS

| Situasi                                     | Yang dilakukan                                                                                                               |
| ------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------- |
| Donasi baru masuk                           | Cek foto dan kondisi → **Setujui** atau **Tolak** (wajib tulis alasan)                                          |
| Sepatu donasi tiba                          | **Konfirmasi diterima** + unggah foto bukti                                                                            |
| Restorasi selesai                           | Tandai **siap rilis** → buat item katalog (kode barang, foto, jasa wajib/opsional + harga) → **masuk katalog** |
| Bukti transfer adopsi masuk                 | Cocokkan nominal dan rekening → **Setujui** (diproses) atau **Tolak**                                           |
| Pesanan disetujui                           | **CS hubungi pemohon via WhatsApp untuk ongkir** → kirim → isi resi (dikirim)                                        |
| Pemohon bertanya "kenapa tidak bisa bayar?" | Kemungkinan **ditahan** (orang lain sudah bayar) atau ia punya pesanan lain yang sedang diverifikasi/diproses          |

Selalu ubah status lewat tombol di panel admin, jangan langsung di database. Email dan perpindahan status sepatu hanya berjalan lewat tombol tersebut.

---

## 7. Yang belum diatur

Hal-hal berikut **belum ada aturannya**, baik di sistem maupun di Syarat & Ketentuan. Sebaiknya diputuskan dan dituliskan:

1. **Batas waktu pembayaran.** Tagihan adopsi yang tidak dibayar tidak pernah kedaluwarsa, sehingga satu sepatu bisa menumpuk banyak tagihan menggantung.
2. **Pembatalan oleh pemohon.** Belum ada tombol batal untuk member. Pembatalan harus lewat CS/admin.
3. **Refund adopsi.** Bagaimana kalau pembayaran ditolak admin atau pesanan dibatalkan setelah transfer? Ketentuan refund saat ini hanya membahas reparasi.
4. **Ongkir tidak dibayar.** Belum ada aturan jika pemohon tidak membayar ongkir setelah dihubungi CS: berapa lama ditunggu, dan apakah biaya jasa dikembalikan.
5. **Garansi sepatu adopsi.** Belum jelas apakah hasil restorasi sepatu adopsi ikut garansi 100 hari seperti layanan reparasi.
6. **Syarat sepatu donasi.** Belum ada kriteria tertulis (kondisi minimal, jenis sepatu yang diterima/ditolak). Saat ini sepenuhnya penilaian admin.
7. **Masa garansi di Syarat & Ketentuan.** Tertulis "sesuai masa garansi layanan masing-masing", sementara materi lain menyebut 100 hari setelah sepatu selesai. Perlu disamakan.

---

## 8. Catatan teknis (untuk developer)

- Semua perpindahan status adopsi lewat `App\Services\AdoptionService::transition()`. Jangan update kolom status langsung.
- Status donasi diatur di `App\Services\DonationService`.
- Pengujian alur adopsi: `tests/Feature/AdoptionFlowTest.php`.
- Detail kebijakan juga tercatat di `CLAUDE.md` bagian "Siklus donasi (CSR)".
