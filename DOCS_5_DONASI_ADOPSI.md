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

**Syarat utama: Shoe Workshop hanya menerima sepatu dengan kelayakan di atas 70%.** Sepatu dengan sol jebol atau lepas, upper sobek, berjamur, atau berbau menyengat belum bisa diterima.

Member mengisi formulir di **Portal Member → Donasi Saya → Donasi Baru**:

| Data             | Keterangan                                                                                                                                                                          |
| ---------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Nama/model       | Wajib, maks. 150 karakter                                                                                                                                                           |
| Brand            | Opsional, maks. 100 karakter. Otomatis terisi saat admin membuat item katalog dari donasi ini                                                                                       |
| Ukuran           | Wajib (boleh desimal, misalnya 40,5)                                                                                                                                                |
| Kondisi          | Wajib, pilih salah satu kartu: **Seperti baru (±95%)**, **Sangat layak (±85%)**, **Layak pakai (±75%)**. Kartu "Rusak berat (< 70%)" hanya menampilkan penjelasan dan mengunci tombol kirim |
| Catatan kondisi  | Opsional, maks. 2.000 karakter                                                                                                                                                      |
| Foto             | **Wajib minimal 1 foto.** Ada 4 kotak sesuai sudut: depan, samping kiri, samping kanan, dan belakang                                                                    |

Sistem menolak nilai kondisi di luar ketiga pilihan tersebut. Donasi lama yang dinilai dengan slider (0–100%) harus memilih ulang kondisinya saat diedit.

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

- **Saat ini (29 Oktober 2026) manajemen belum memberikan reward untuk donasi.** Halaman Donasi Saya hanya menampilkan ajakan klaim selama ada reward berkategori *donasi* yang aktif, ada stoknya, dan masih dalam masa berlaku. Kalau tidak ada, ajakan itu tidak muncul sama sekali.
- Setiap donasi yang sudah **diterima** (termasuk yang sudah siap rilis, masuk katalog, atau disalurkan) memberi **satu kesempatan klaim** reward berkategori *donasi* (Portal Member → Reward).
- Satu donasi = satu klaim. Klaim memakai donasi tertua yang belum dipakai.
- Reward bisa punya **stok** dan **masa berlaku**. Klaim gagal kalau stok habis atau di luar masa berlaku.
- Setiap klaim menghasilkan **kode unik** untuk ditukarkan.

---

## 4. Alur Adopsi (mengambil sepatu)

### 4.1 Prinsip utama: dikurasi admin

Mulai 29 Oktober 2026 (kebijakan sementara dari manajemen), penerima sepatu adopsi **dipilih oleh admin**:

- **Banyak orang boleh mengajukan sepatu yang sama.** Saat mengajukan, **belum ada tagihan dan belum ada pembayaran**.
- Admin meninjau semua pengajuan untuk satu sepatu, lalu **memilih satu penerima**. Bahan pertimbangannya:
  - **alasan pengajuan**;
  - **urutan waktu pengajuan** (siapa yang lebih dulu mengajukan);
  - riwayat member, yaitu jumlah sepatu yang pernah didonasikan dan jumlah adopsi sebelumnya. Data ini ditampilkan di panel admin sebagai bahan bantu.
- Pemohon terpilih mendapat tagihan dan harus membayar dalam **2×24 jam**.
- Pemohon lain **tidak langsung ditolak**. Mereka menjadi **cadangan**, sehingga kalau pemohon terpilih tidak membayar, admin tinggal memilih cadangan tanpa ada yang perlu mengajukan ulang.

Mode ini bisa dikembalikan ke **"Siapa Cepat Dia Dapat"** kapan saja lewat **Admin → Pengaturan → Mode Adopsi Sepatu**, tanpa deploy ulang (lihat 4.8). Ganti mode hanya saat tidak ada pemohon yang sedang terpilih atau menunggu pembayaran.

### 4.2 Mengajukan adopsi

Dari halaman sepatu di katalog → **Ajukan Adopsi**. Data yang diisi:

| Data              | Keterangan                                                                                                                                                       |
| ----------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Nama pemohon      | Wajib                                                                                                                                                            |
| Email             | Wajib, untuk notifikasi dan tagihan                                                                                                                              |
| Nomor WhatsApp    | Wajib. Otomatis disimpan dalam format 62…                                                                                                                       |
| Alamat pengiriman | Dipisah per bagian: nama jalan & nomor rumah, RT/RW (opsional), patokan (opsional), provinsi, kota/kabupaten, kecamatan (ketiganya dipilih dari daftar resmi Kemendagri), kelurahan/desa, dan kode pos 5 angka. Pengajuan berikutnya otomatis terisi dari alamat terakhir |
| Alasan mengadopsi | Wajib, **minimal 20 karakter**. Form memberi petunjuk: sepatu untuk siapa, akan dipakai untuk apa, dan kenapa dibutuhkan. Alasan ini jadi bahan kurasi |
| Pilihan jasa      | Jasa **wajib** otomatis tercentang dan tidak bisa dihapus. Jasa **opsional** boleh dipilih                                                          |

Batasan:

- Member boleh punya **maksimal 3 pengajuan yang sedang dikurasi** sekaligus.
- Satu member hanya bisa mengajukan **satu kali untuk sepatu yang sama**.
- Setelah mengajukan, member mendapat email **"Pengajuan Adopsi Diterima"** yang menjelaskan proses kurasi dan meminta **tidak transfer apa pun dulu**.

### 4.3 Tagihan dan pembayaran (hanya untuk pemohon terpilih)

- Tagihan terbit **saat admin memilih pemohon**, dikirim ke email, dan tombol bayar muncul di **Portal Member → Adopsi Saya**. Sebelum terpilih, tombol bayar dan nomor rekening tidak ditampilkan.
- **Batas bayar 2×24 jam** sejak terpilih. Tanggal dan jamnya tercantum di email tagihan, di halaman Adopsi Saya, dan di panel admin.
- **Tagihan = total biaya jasa restorasi** yang dipilih (wajib + opsional). Tidak ada harga untuk sepatunya sendiri.
- **Ongkos kirim tidak termasuk tagihan.** CS akan menghubungi pemohon lewat WhatsApp untuk menagih ongkir secara terpisah.
- Pembayaran dengan **transfer bank manual** ke rekening resmi:
  | Bank    | No. Rekening  | Atas Nama                 |
  | ------- | ------------- | ------------------------- |
  | BCA     | 8100978521    | PT TERANG GARAM SOLUSINDO |
  | Mandiri | 1300030119047 | PT TERANG GARAM SOLUSINDO |
- Setelah transfer, **unggah bukti transfer** di halaman Adopsi Saya (JPG/PNG, maks. 5 MB).
- **Satu pembayaran dalam satu waktu:** member tidak bisa membayar sepatu lain selama ada pesanannya yang sedang **diverifikasi** atau **diproses**.
- **Lewat batas bayar** tidak membatalkan pesanan secara otomatis. Panel admin menandainya "Lewat batas bayar", lalu admin memutuskan untuk membatalkannya atau memberi kelonggaran.
- Payment gateway (bayar otomatis) direncanakan, tapi belum tersedia.

### 4.4 Status adopsi

```
pending (kurasi) ──► menunggu_pembayaran ──► menunggu_verifikasi ──► diproses ──► dikirim ──► selesai
      │                (terpilih, 2×24 jam)           │
      │                      │                        └──► ditolak (bukti tidak valid)
      │                      └──► dibatalkan (tidak bayar) → sepatu tersedia lagi, admin pilih cadangan
      ├──► cadangan (orang lain terpilih) ──► bisa dipilih kalau yang terpilih batal
      └──► ditolak (tidak terpilih / sepatu sudah diadopsi orang lain)
```

| Status                         | Artinya                                                                       | Status sepatu di katalog                    |
| ------------------------------ | ----------------------------------------------------------------------------- | ------------------------------------------- |
| **pending (Menunggu Kurasi)**  | Pengajuan masuk, menunggu dipilih admin. **Jangan transfer.**                | Tersedia                                    |
| **cadangan**                   | Admin sudah memilih orang lain. Masih bisa dipilih kalau orang itu batal.    | Disembunyikan (dipesan)                     |
| **menunggu_pembayaran**        | Terpilih. Tagihan terbit, bayar dalam 2×24 jam                                | Disembunyikan (dipesan)                     |
| **menunggu_verifikasi**        | Bukti transfer diunggah, menunggu dicek admin                                 | Disembunyikan (dipesan)                     |
| **diproses**                   | Pembayaran terverifikasi, sepatu disiapkan                                    | Disalurkan                                  |
| **dikirim**                    | Sepatu dikirim, nomor resi diinformasikan                                     | Disalurkan                                  |
| **selesai**                    | Pemohon mengonfirmasi sepatu diterima                                         | Disalurkan                                  |
| **ditolak / dibatalkan**       | Pengajuan tidak dilanjutkan                                                   | Tersedia lagi, kecuali sudah jatuh ke orang lain |

Catatan: "cadangan" bukan status tersendiri di database. Pengajuannya tetap *pending*, tapi sepatunya sedang dipegang pemohon terpilih.

### 4.5 Keputusan admin

**Memilih pemohon** (tombol *Pilih Pemohon Ini*):

- Sepatu langsung **disembunyikan dari katalog** (status sepatu: *dipesan*), dan orang baru tidak bisa mengajukan sepatu itu.
- Pemohon terpilih menerima email tagihan dengan batas bayar 2×24 jam.
- Pemohon lain tetap *pending* sebagai cadangan, tanpa email tambahan.
- Hanya satu pemohon yang bisa dipilih pada satu waktu.

**Pemohon terpilih tidak membayar** (tombol *Batalkan (Tidak Bayar)*):

- Pesanannya dibatalkan, sepatu **kembali tersedia**, dan admin bisa memilih pemohon cadangan.

**Menyetujui pembayaran** (→ diproses):

- Sepatu resmi milik pemohon tersebut (status sepatu: *disalurkan*).
- **Semua cadangan otomatis ditolak** dan mendapat email "sepatu sudah diadopsi pemohon lain".

**Menolak pembayaran** (bukti tidak valid atau nominal tidak sesuai):

- Sepatu kembali tersedia, dan admin bisa memilih pemohon lain.

**Menolak pengajuan yang masih dikurasi** (tombol *Tolak*):

- Pemohon menerima email bahwa pengajuannya **belum terpilih**.

### 4.6 Pengiriman dan penyelesaian

1. Admin memproses pesanan, lalu mengirim sepatu lewat **ekspedisi pihak ketiga** (J&T, dll.) dan mengisi nomor resi.
2. Pemohon menerima sepatu, lalu menekan **Konfirmasi Sepatu Diterima** di Adopsi Saya dan mengunggah **foto bukti penerimaan** (JPG/PNG, maks. 5 MB).
3. Status menjadi **selesai**.

### 4.7 Email yang dikirim ke pemohon

Email hanya dikirim **saat status benar-benar berubah**.

| Kejadian                                    | Email                                                      |
| ------------------------------------------- | ---------------------------------------------------------- |
| Pengajuan dibuat                            | Pengajuan diterima, sedang dikurasi, jangan transfer dulu |
| Dipilih admin                               | Selamat terpilih + tagihan + batas bayar 2×24 jam          |
| Pembayaran disetujui                        | Pesanan diproses                                           |
| Sepatu dikirim                              | Info pengiriman + resi                                     |
| Pemohon konfirmasi diterima                 | Adopsi selesai                                             |
| Sepatu diadopsi pemohon lain (cadangan)     | Sepatu sudah diadopsi pemohon lain                         |
| Pengajuan ditolak saat kurasi               | Belum terpilih                                             |
| Bukti bayar ditolak                         | Penolakan, hubungi CS jika merasa sudah bayar benar        |

Pemohon cadangan **tidak** dikirimi email saat orang lain terpilih. Statusnya terlihat di halaman Adopsi Saya. Pembatalan karena tidak membayar hanya mengirim notifikasi di portal.

Notifikasi check-in tidak dikirim lewat email.

### 4.8 Mode alternatif: Siapa Cepat Dia Dapat

Kalau saklar di Pengaturan diubah ke **Siapa Cepat Dia Dapat**, aturan sebelum 29 Oktober 2026 berlaku lagi:

- Setiap pengajuan langsung mendapat tagihan, tanpa batas waktu bayar.
- **Pemohon pertama yang mengunggah bukti transfer** mendapatkan sepatu. Sepatu disembunyikan dari katalog dan pemohon lain **ditahan** (tidak bisa membayar) sampai admin memutuskan.
- Jika pembayaran itu ditolak, pemohon yang ditahan mendapat email "sepatu tersedia lagi" dan bisa membayar.
- Member hanya boleh punya **1 pengajuan aktif**. Pengecualiannya, member yang sedang ditahan boleh mengajukan sepatu lain.

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
| Pengajuan adopsi masuk                      | Buka **Permintaan Adopsi** → **Tinjau Pengaju**. Baca alasan, lihat urutan dan riwayat donasi → **Pilih Pemohon Ini** pada satu orang, atau **Tolak** |
| Pemohon terpilih lewat batas bayar 2×24 jam | Pastikan dulu lewat WhatsApp. Jika batal → **Batalkan (Tidak Bayar)** → pilih pemohon cadangan                         |
| Bukti transfer adopsi masuk                 | Cocokkan nominal dan rekening → **Setujui** (diproses) atau **Tolak**                                           |
| Pesanan disetujui                           | **CS hubungi pemohon via WhatsApp untuk ongkir** → kirim → isi resi (dikirim)                                        |
| Pemohon bertanya "kenapa tidak bisa bayar?" | Pengajuannya **masih dikurasi** atau ia **cadangan** (belum terpilih), atau ia punya pesanan lain yang sedang diverifikasi/diproses |

Selalu ubah status lewat tombol di panel admin, jangan langsung di database. Email dan perpindahan status sepatu hanya berjalan lewat tombol tersebut.

---

## 7. Yang belum diatur

Hal-hal berikut **belum ada aturannya**, baik di sistem maupun di Syarat & Ketentuan. Sebaiknya diputuskan dan dituliskan:

1. **Pembatalan otomatis.** Batas bayar 2×24 jam sudah berlaku, tapi pembatalannya masih manual oleh admin. Belum diputuskan apakah sistem perlu membatalkan otomatis.
2. **Pembatalan oleh pemohon.** Belum ada tombol batal untuk member. Pembatalan harus lewat CS/admin.
3. **Refund adopsi.** Bagaimana kalau pembayaran ditolak admin atau pesanan dibatalkan setelah transfer? Ketentuan refund saat ini hanya membahas reparasi.
4. **Ongkir tidak dibayar.** Belum ada aturan jika pemohon tidak membayar ongkir setelah dihubungi CS: berapa lama ditunggu, dan apakah biaya jasa dikembalikan.
5. **Garansi sepatu adopsi.** Belum jelas apakah hasil restorasi sepatu adopsi ikut garansi 100 hari seperti layanan reparasi.
6. **Syarat sepatu donasi selain kelayakan.** Batas kelayakan di atas 70% sudah berlaku. Belum ada aturan untuk jenis sepatu (misalnya sandal, sepatu anak, sepatu safety) maupun syarat kebersihan.
7. **Masa garansi di Syarat & Ketentuan.** Tertulis "sesuai masa garansi layanan masing-masing", sementara materi lain menyebut 100 hari setelah sepatu selesai. Perlu disamakan.

---

## 8. Catatan teknis (untuk developer)

- Semua perpindahan status adopsi lewat `App\Services\AdoptionService::transition()`. Jangan update kolom status langsung.
- Status donasi diatur di `App\Services\DonationService`.
- Mode adopsi dibaca dari setting `adoption_mode` (`kurasi` default, atau `cepat`) lewat `AdoptionService::curationMode()`. Di mode kurasi, *menunggu_pembayaran* ikut memegang sepatu (*dipesan*), dan batas bayar disimpan di kolom `donation_requests.batas_bayar`.
- Alamat pengajuan adopsi disimpan per kolom (`alamat_jalan` … `kode_pos`) dan juga digabung ke `alamat_pengiriman` lewat `DonationRequest::composeAddress()`. Daftar provinsi/kota/kecamatan ada di `public/data/wilayah` (sumber: github.com/cahyadsn/wilayah, MIT), dibuat ulang dengan `scripts/build_wilayah.py`, dan divalidasi oleh `App\Support\Wilayah`.
- Pengujian alur adopsi: `tests/Feature/AdoptionCurationTest.php` (mode kurasi) dan `tests/Feature/AdoptionFlowTest.php` (mode siapa cepat).
- Detail kebijakan juga tercatat di `CLAUDE.md` bagian "Siklus donasi (CSR)".
