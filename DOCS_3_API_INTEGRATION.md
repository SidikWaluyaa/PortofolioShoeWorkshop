# Dokumentasi Spesifikasi API & Integrasi

Aplikasi *Customer Portal* (Frontend) ini dirancang untuk berkomunikasi dengan sistem utama (*Core Backend*) Shoe Workshop melalui RESTful API. Integrasi ini memastikan data operasional (seperti SPK dan klaim garansi) selalu tersinkronisasi.

---

## 1. Konfigurasi Dasar (Base Configuration)
*   **API Base URL:** `https://admin.shoeworkshop.id/api/v1` (Didefinisikan di `.env` sebagai `API_BASE_URL`).
*   **Authentication:** Menggunakan *Bearer Token* atau *API Key* statis (tergantung konfigurasi `.env` `API_BEARER_TOKEN`).
*   **Headers Default:**
    *   `Accept: application/json`
    *   `Content-Type: application/json`

---

## 2. API: Lacak Pesanan (Tracking SPK)
Berfungsi untuk mengambil data progres reparasi berdasarkan nomor SPK.

*   **Endpoint:** `GET /tracking/{spk_number}`
*   **Parameter URL:**
    *   `spk_number` (String, Required) - Nomor Surat Perintah Kerja.
*   **Response Sukses (200 OK):**
    ```json
    {
      "success": true,
      "data": {
        "spk_number": "S-2603-28-0882-IK",
        "customer_name": "John Doe",
        "service_name": "Deep Clean & Repaint",
        "current_status": {
          "code": "IN_PROGRESS",
          "label": "Sedang Dikerjakan",
          "description": "Sepatu sedang dalam tahap repainting."
        },
        "visual_photos": {
          "before_photo_url": "https://...",
          "after_photo_url": "https://..."
        },
        "timeline": [
          { "status": "RECEIVED", "time": "2024-03-26T10:00:00Z" },
          { "status": "IN_PROGRESS", "time": "2024-03-27T14:30:00Z" }
        ]
      }
    }
    ```
*   **Error Handling:** Jika SPK tidak ada, API mengembalikan `404 Not Found`.

---

## 3. API: Klaim Garansi (Warranty Claims)
Berfungsi untuk memvalidasi kelayakan garansi dan mengirimkan formulir komplain.

### A. Validasi Status Garansi
Mengecek apakah nomor SPK masih berlaku untuk garansi (100 hari kerja).
*   **Endpoint:** `GET /warranty-check/{spk_number}`
*   **Response Sukses (200 OK):**
    ```json
    {
      "success": true,
      "data": {
        "is_eligible": true,
        "days_remaining": 85,
        "customer": { "name": "John Doe", "phone": "0812..." },
        "order": { "service": "Unyellowing", "completed_at": "..." }
      }
    }
    ```

### B. Submit Klaim Garansi
Mengirim data form dari pelanggan ke *backend*.
*   **Endpoint:** `POST /warranty-claims`
*   **Payload (Request Body):**
    ```json
    {
      "spk_number": "S-2603-28-0882-IK",
      "issue_category": "Jahitan Lepas",
      "issue_description": "Bagian samping kiri jahitan terbuka setelah 2 hari dipakai.",
      "photos": ["data:image/jpeg;base64,...", "..."]
    }
    ```
*   **Response Sukses (201 Created):** Mengembalikan nomor tiket (Claim ID) untuk direferensikan pelanggan.
