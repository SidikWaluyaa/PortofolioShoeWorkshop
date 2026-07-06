# Spec Section Layanan — Shoe Workshop
Handoff untuk tim developer. Baca bareng file `layanan-content.json` (isi semua teks, jangan hardcode di komponen) dan `prototype.html` (contoh visual + animasi jadi, tinggal dicontek strukturnya).

## 1. Struktur Halaman

```
[Hero Intro]
  - Headline + body + 2 value card (Nilai Material, Nilai Kehidupan)

[Nav Kategori] — sticky, 4 tab: Lem & Jahit / Sol / Upper / Treatment

[Category Section] x4, masing-masing:
  - Header kategori (nama, subtitle, deskripsi, 2 value card)
  - Grid card sub-jasa (default: tampilkan preview 1-2 card sesuai "previewServiceIds" di JSON)
  - Tombol "Lihat semua N jasa" → expand accordion sisa sub-jasa
  - CTA kategori (teksnya beda-beda, field "cta" di JSON)

[Card Sub-Jasa]
  - Before-after image slider (draggable)
  - Nama jasa + subtitle teknis (italic, abu-abu, ukuran kecil)
  - 3 baris: "Kapan kamu butuh ini?" / "Apa yang kami lakukan?" / "Kenapa penting?"
```

Semua teks di atas sudah ada di `layanan-content.json`, tinggal loop per kategori → per service. Jangan copy-paste manual dari dokumen Word/PDF, supaya kalau ada revisi teks tinggal edit satu file JSON.

## 2. Spek Foto (Before-After)

- **Rasio**: 4:5 (potrait), biar konsisten dengan foto produk sepatu yang biasanya vertikal
- **Resolusi minimum**: 800x1000px, format WebP (fallback JPG)
- **Framing**: sepatu diambil dari sudut & jarak yang sama persis untuk before & after — supaya slider perbandingan terasa akurat, bukan "before" foto asal jepret dan "after" foto studio
- **Background**: polos/netral (putih atau abu muda) di kedua foto, biar fokus ke sepatu bukan properti sekitar
- **Naming convention** (sudah dipakai di JSON): `{kategori}/{id-jasa}-before.jpg` dan `-after.jpg`
- Lazy-load semua gambar di bawah fold pakai `loading="lazy"`, kecuali gambar preview kategori pertama (bisa eager karena above the fold)
- Kalau foto real belum ada untuk sub-jasa tertentu, pakai placeholder abu-abu dengan ikon sepatu — jangan biarkan broken image

## 3. Spek Animasi

**A. Scroll reveal (per kategori section)**
- Trigger: `IntersectionObserver`, threshold ~0.15
- Efek: fade in + translateY(24px → 0), durasi 500-600ms, easing `cubic-bezier(0.16, 1, 0.3, 1)`
- Card dalam grid di-stagger 80-100ms per card (jangan muncul barengan, biar berasa "dirakit")
- Animasi jalan sekali saja per elemen (unobserve setelah trigger)

**B. Before-After Slider (elemen paling penting, bikin depan)**
- Interaksi: drag handle horizontal, foto "after" ke-reveal sesuai posisi drag
- Support mouse drag + touch drag (mobile)
- Default posisi handle: 50%
- Handle punya micro-interaction saat di-hover/di-drag (scale up dikit, kasih shadow)
- Opsional tapi disarankan: saat card pertama kali masuk viewport, handle auto-animasi geser dari 50% → 20% → balik ke 50% sekali (kasih sinyal ke user kalau ini bisa di-drag), lalu berhenti nunggu interaksi manual

**C. Hover state card**
- Card sub-jasa: elevate dikit (translateY -4px + shadow lebih tebal), transisi 200ms
- Jangan pakai efek berlebihan (rotate, scale besar) — konteksnya craftsmanship/kepercayaan, bukan produk flashy

**D. Accordion "Lihat semua jasa"**
- Expand/collapse pakai height transition (bukan display:none tiba-tiba), 300ms ease
- Icon chevron rotate 180° saat expand

**E. Reduced motion**
- Semua animasi di atas wajib fallback ke instant/no-animation kalau user punya `prefers-reduced-motion: reduce`

## 4. Referensi Visual

Lihat `prototype.html` — itu working demo dengan 1 kategori penuh + before-after slider fungsional + scroll reveal, dibuat supaya tim dev bisa langsung lihat behavior-nya (bukan cuma bayangin dari teks ini), lalu tinggal adaptasi ke stack yang dipakai (React/Vue/vanilla).

## 5. Catatan

- Harga belum dimasukkan ke JSON karena sumber PDF-nya rusak encoding-nya. Begitu ada source Excel/Sheets yang valid, tambahkan field `"price"` per service di JSON.
- Nama jasa teknis (Goodyear Welt, Midsole, dll) sudah dikasih field `subtitleTeknis` di JSON sebagai penjelasan awam — tampilkan sebagai subtitle kecil di bawah nama jasa.
