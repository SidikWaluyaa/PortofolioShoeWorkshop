# PRD & Dokumen Spesifikasi API: Klaim Garansi Eksternal

Dokumen ini ditujukan untuk memandu Developer atau AI Agent dalam membangun UI Form Klaim Garansi di website eksternal (client-side) dan menghubungkannya dengan API backend **SistemWorkshop**.

---

## 1. Ringkasan Fitur
Fitur ini memindahkan Form Klaim Garansi yang sebelumnya hanya ada di internal portal ke website eksternal. Alur pengajuan klaim garansi dibagi menjadi 2 tahap (2-Step Form):
* **Tahap 1 (Validasi):** Validasi nomor SPK dan nomor WhatsApp. Jika valid, tampilkan detail data pelanggan dan detail sepatu.
* **Tahap 2 (Pengiriman):** Isi formulir keluhan, penggunaan, upload gambar kerusakan (1-3 foto), serta upload bukti review bintang 5 di Google Maps.

---

## 2. Base URL & Konfigurasi CORS
* **Base URL:** `http://info.shoeworkshop.id/api/v1/public/warranty-claims`
  *(Di lokal laragon biasanya menggunakan: `http://localhost:8000/api/v1/public/warranty-claims` atau sesuai virtual host host backend)*
* **CORS Access:** Domain frontend **wajib** didaftarkan pada konfigurasi `allowed_origins` di file `config/cors.php` backend. (Saat ini origin `http://portofolioshoeworkshop.test` sudah diizinkan).

---

## 3. Spesifikasi Endpoint

### Endpoint A: Cek Ketersediaan Garansi (Step 1)
Digunakan untuk memvalidasi apakah kombinasi SPK dan Nomor Telepon memiliki garansi aktif dan berhak melakukan klaim.

* **URL Path:** `/check`
* **Method:** `POST`
* **Headers:**
  ```http
  Content-Type: application/json
  Accept: application/json
  ```
* **Request Body (JSON):**
  | Parameter | Tipe | Wajib | Keterangan |
  | :--- | :--- | :--- | :--- |
  | `spk_number` | String | Ya | Nomor SPK pengerjaan (contoh: `SPK-XXXXX`) |
  | `customer_phone` | String | Ya | Nomor telepon/WhatsApp customer yang terdaftar |

* **Aturan Validasi Backend:**
  1. Nomor WhatsApp dicocokkan secara longgar (9 digit terakhir harus sama dengan data di DB) untuk meminimalisir kesalahan format input (e.g. penggunaan +62 atau 08).
  2. Status pengerjaan SPK tersebut harus sudah **`SELESAI`**.
  3. Memiliki masa garansi aktif (`warranty_expires_at` belum terlewati).
  4. Tidak ada klaim dengan SPK yang sama yang berstatus **`PENDING`** atau **`APPROVED`** (tidak boleh mengajukan double claim).

* **Respon Sukses (HTTP 200):**
  ```json
  {
      "success": true,
      "message": "Layanan garansi tersedia dan aktif.",
      "data": {
          "work_order_id": 142,
          "customer_name": "Budi Santoso",
          "shoe_brand": "Nike",
          "shoe_type": "Air Jordan 1",
          "shoe_color": "Red/Black",
          "warranty_expires_at": "25 Dec 2026",
          "days_left": 198
      }
  }
  ```

* **Respon Gagal (Contoh HTTP 400 / 404 / 422):**
  ```json
  {
      "success": false,
      "message": "Kombinasi Nomor SPK dan Nomor WhatsApp tidak ditemukan di sistem."
  }
  ```

---

### Endpoint B: Kirim Formulir Klaim Garansi (Step 2)
Mengajukan data klaim beserta foto-foto kerusakan dan bukti review Google Maps.

* **URL Path:** `/submit`
* **Method:** `POST`
* **Headers:**
  ```http
  Accept: application/json
  ```
  *(Catatan: Jangan tentukan `Content-Type` secara manual jika menggunakan `FormData` di browser. Biarkan browser menentukan pembatas multipart otomatis).*
* **Request Body (Multipart Form Data):**
  | Parameter | Tipe | Wajib | Keterangan |
  | :--- | :--- | :--- | :--- |
  | `spk_number` | String | Ya | Nomor SPK pengerjaan |
  | `customer_phone` | String | Ya | Nomor WhatsApp customer |
  | `problem_description` | String | Ya | Detail keluhan kerusakan (minimal 10 karakter, maks 1000) |
  | `penggunaan` | String | Ya | Keterangan penggunaan sepatu (minimal 5 karakter, maks 100) |
  | `problem_photos[]` | File (Array) | Ya | File gambar bukti kerusakan. Minimal 1 file, Maksimal 3 file. Ukuran maks per file: 20MB. |
  | `google_review_photo` | File (Single) | Ya | File gambar screenshot bukti review Google. Ukuran maks: 20MB. |

* **Aturan Pemrosesan Gambar di Backend:**
  Backend secara otomatis mengompres gambar yang dikirimkan dengan memperkecil ukurannya (scale down) maksimal ke resolusi 800x800 px dengan format `.jpg` (quality 60%). Hal ini dilakukan agar ukuran file yang disimpan sangat ringan tanpa mengurangi fungsi detail gambar.

* **Respon Sukses (HTTP 201):**
  ```json
  {
      "success": true,
      "message": "Klaim garansi berhasil diajukan.",
      "data": {
          "work_order_id": 142,
          "customer_name": "Budi Santoso",
          "customer_phone": "08123456789",
          "spk_number": "SPK-XXXXX",
          "problem_description": "Sol sepatu kanan lepas kembali.",
          "penggunaan": "Dipakai lari pagi sekali",
          "problem_photo": [
              "storage/warranty-claims/CLAIM_PROB_SPK-XXXXX_178491823_1.jpg"
          ],
          "google_review_photo": "storage/warranty-claims/CLAIM_REV_SPK-XXXXX_178491823.jpg",
          "status": "PENDING",
          "updated_at": "2026-06-10T04:22:00.000000Z",
          "created_at": "2026-06-10T04:22:00.000000Z",
          "id": 15
      }
  }
  ```

* **Respon Gagal (HTTP 422 - Validasi Gagal):**
  ```json
  {
      "success": false,
      "message": "Deskripsi keluhan minimal 10 karakter.",
      "errors": {
          "problem_description": [
              "Deskripsi keluhan minimal 10 karakter."
          ]
      }
  }
  ```

---

## 4. Alur Integrasi yang Direkomendasikan pada Frontend
1. **Buat Form 2 Tahap (Multi-step form):**
   * **Layar 1:** Input SPK dan Nomor WhatsApp. Sediakan tombol "Cek Garansi".
   * Ketika tombol ditekan, panggil `POST /check`.
   * Jika sukses, simpan detail data (`customer_name`, `shoe_brand`, dll) di state, lalu ganti layar ke **Layar 2**.
   * **Layar 2:** Tampilkan data pelanggan sebagai ringkasan (Read-Only) agar pengguna yakin data mereka benar. Sediakan form input untuk Deskripsi Keluhan, Penggunaan Sepatu, File upload bukti kerusakan (multiple, maks 3), dan File upload screenshot Google Review.
   * Sediakan tombol "Kirim Klaim".
   * Ketika tombol ditekan, buat objek `FormData`, masukkan semua data, lalu panggil `POST /submit`.
   * Jika sukses, arahkan ke **Layar 3 (Sukses)**.
