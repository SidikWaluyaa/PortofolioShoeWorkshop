<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Klinik Sepatu content:
     * - tag the two existing articles with a keluhan,
     * - unpublish the expired Ramadhan promo,
     * - add new articles as DRAFT so the workshop team reviews them before publishing.
     */
    public function up(): void
    {
        DB::table('posts')->where('slug', 'mengapa-sol-sepatu-sering-lepas')->update(['keluhan' => 'sol-lepas']);
        DB::table('posts')->where('slug', 'cara-merawat-sepatu-leather-agar-tetap-mengkilap')->update(['keluhan' => 'warna-pudar']);
        DB::table('posts')->where('slug', 'promo-ramadhan-deep-clean-3-sepatu-gratis-1')->update(['status' => 'draft']);

        foreach ($this->articles() as $article) {
            if (DB::table('posts')->where('slug', $article['slug'])->exists()) {
                continue;
            }

            DB::table('posts')->insert($article + [
                'status' => 'draft',
                'published_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        DB::table('posts')->whereIn('slug', array_column($this->articles(), 'slug'))->where('status', 'draft')->delete();
        DB::table('posts')->where('slug', 'promo-ramadhan-deep-clean-3-sepatu-gratis-1')->update(['status' => 'published']);
    }

    private function articles(): array
    {
        return [
            [
                'title' => 'Sol Sepatu Mangap: Penyebab, Cara Mencegah, dan Kapan Harus ke Workshop',
                'slug' => 'sol-sepatu-mangap-penyebab-dan-cara-mencegah',
                'category' => 'Shoe Care',
                'keluhan' => 'sol-lepas',
                'thumbnail' => 'images/tentang-kami/pengerjaan.webp',
                'content' => <<<'MD'
Sol yang mulai "mangap" biasanya terlihat dari celah kecil di ujung depan sepatu. Awalnya hanya beberapa milimeter, tapi kalau dibiarkan celahnya cepat melebar karena setiap langkah menekuk bagian itu.

## Kenapa sol bisa lepas?

- **Usia lem.** Lem sepatu bisa melemah seiring waktu, apalagi pada sepatu yang jarang dipakai lalu tiba-tiba dipakai lagi.
- **Lembap dan panas.** Sepatu yang disimpan di tempat lembap, kena hujan lalu dijemur langsung di bawah terik matahari, membuat ikatan lem lebih cepat rusak.
- **Cara mencuci yang kurang tepat.** Merendam sepatu terlalu lama atau mencucinya dengan mesin cuci bisa melemahkan lem di sambungan sol.
- **Pemakaian berat.** Olahraga, jalan jauh, atau gaya jalan yang menyeret membuat bagian depan sol lebih sering tertekuk.

## Cara mencegahnya

- Simpan sepatu di tempat kering dengan sirkulasi udara yang baik.
- Kalau sepatu basah, keringkan di tempat teduh, bukan di bawah sinar matahari langsung.
- Hindari merendam atau mencuci sepatu di mesin cuci.
- Pakai sepatu sesuai fungsinya. Sepatu kasual tidak dirancang untuk olahraga berat.

## Kapan harus dibawa ke workshop?

Begitu celahnya terlihat, lebih baik segera diperbaiki. Menambal sendiri dengan lem serbaguna sering hanya bertahan sebentar dan sisa lemnya justru menyulitkan pengeleman ulang yang benar.

Di workshop, sol biasanya dibersihkan dari sisa lem lama dulu, baru dilem ulang dan dipress. Untuk sepatu yang dipakai berat, sambungan sol bisa diperkuat dengan jahitan.

Belum yakin sepatumu perlu lem ulang, jahit, atau ganti sol? Kirim foto sepatunya lewat WhatsApp, tim kami bantu cek dulu.
MD,
            ],
            [
                'title' => 'Sol Sepatu Menguning: Kenapa Terjadi dan Apa yang Bisa Dilakukan',
                'slug' => 'sol-sepatu-menguning-kenapa-terjadi',
                'category' => 'Shoe Care',
                'keluhan' => 'menguning',
                'thumbnail' => 'images/tentang-kami/pengerjaan2.webp',
                'content' => <<<'MD'
Sol putih atau bening yang perlahan berubah kekuningan adalah keluhan yang sangat umum, terutama pada sneakers. Kabar baiknya, menguning tidak berarti solnya rusak. Yang berubah adalah warna permukaannya.

## Kenapa sol bisa menguning?

- **Oksidasi.** Bahan karet dan busa pada sol bereaksi dengan udara seiring waktu, sehingga warnanya bergeser ke kuning.
- **Sinar matahari dan panas.** Menjemur sepatu langsung di bawah terik matahari mempercepat perubahan warna.
- **Sisa sabun atau deterjen.** Sabun yang tidak terbilas bersih bisa meninggalkan noda kekuningan setelah sepatu kering.
- **Usia sepatu.** Sepatu yang lama tersimpan di dalam kotak pun bisa menguning dengan sendirinya.

## Cara memperlambatnya

- Keringkan sepatu di tempat teduh dan berangin.
- Bilas sampai bersih setiap kali membersihkan sol, jangan sampai ada sisa sabun.
- Simpan di tempat kering dan tidak terkena sinar matahari langsung.

## Bisakah kembali putih?

Sol yang menguning bisa dicerahkan kembali dengan perawatan unyellowing. Hasilnya tergantung bahan sol dan seberapa dalam warnanya berubah. Pada sebagian sepatu warnanya bisa kembali cerah, tapi pada sol yang sudah sangat tua hasilnya mungkin tidak 100% seperti baru.

Supaya ekspektasinya jelas, kirim foto solnya lewat WhatsApp dulu. Tim kami bisa memberi gambaran hasil yang realistis sebelum sepatu dikerjakan.
MD,
            ],
            [
                'title' => 'Warna Sepatu Pudar: Kapan Cukup Dirawat, Kapan Perlu Repaint',
                'slug' => 'warna-sepatu-pudar-kapan-perlu-repaint',
                'category' => 'Shoe Care',
                'keluhan' => 'warna-pudar',
                'thumbnail' => 'images/tentang-kami/pengerjaan3.webp',
                'content' => <<<'MD'
Sepatu yang warnanya mulai pudar atau kusam sering membuat pemiliknya ragu: cukup dibersihkan saja, atau harus dicat ulang? Jawabannya tergantung penyebab pudarnya.

## Cukup dirawat kalau...

- Warnanya terlihat kusam karena **kotoran dan debu** yang menempel. Setelah dibersihkan, warna aslinya biasanya muncul lagi.
- Sepatu kulit terlihat **kering dan tidak berkilau**. Perawatan rutin dengan pembersih dan pelembap kulit sering sudah cukup.

## Perlu repaint kalau...

- Warnanya **memudar tidak merata**, misalnya belang di bagian yang sering tertekuk atau terkena sinar matahari.
- Ada **goresan atau lecet** yang membuat warna dasar bahan terlihat.
- Kamu ingin **mengganti warna** sepatu, misalnya dari satu warna menjadi dua warna.

## Bedanya dengan cat sendiri

Repaint yang awet butuh persiapan: bahan dibersihkan dan disiapkan dulu supaya cat menempel, lalu diwarnai berlapis dan diberi finishing. Cat yang langsung disemprot ke permukaan yang belum disiapkan cenderung mudah retak atau mengelupas saat sepatu ditekuk.

Di Shoe Workshop ada beberapa pilihan repaint, mulai dari satu warna, multicolor, sampai patina untuk sepatu kulit. Kirim foto sepatumu lewat WhatsApp untuk tahu pilihan yang paling cocok.
MD,
            ],
            [
                'title' => '3 Tahap QC di Shoe Workshop: Apa Saja yang Kami Cek',
                'slug' => '3-tahap-qc-di-shoe-workshop',
                'category' => 'Workshop Stories',
                'keluhan' => null,
                'thumbnail' => 'images/tentang-kami/qc-awal.webp',
                'content' => <<<'MD'
Setiap sepatu yang masuk ke Shoe Workshop melewati tiga kali pemeriksaan kualitas (QC) sebelum kembali ke pemiliknya. Tujuannya sederhana: masalahnya tercatat jelas sejak awal, pengerjaannya sesuai, dan tidak ada yang terlewat sebelum dikirim.

## 1. QC awal

Saat sepatu tiba, kondisinya dicek dan dicatat: bagian yang rusak, kondisi bahan, dan hal lain yang perlu diperhatikan. Hasil pengecekan ini menjadi dasar pekerjaan yang tertulis di SPK (Surat Perintah Kerja).

## 2. QC hasil pengerjaan

Setelah teknisi selesai mengerjakan, hasilnya diperiksa lagi dan dicocokkan dengan pekerjaan yang tertulis di SPK.

## 3. QC akhir

Sebelum dikemas dan dikirim, sepatu dicek sekali lagi secara menyeluruh supaya yang sampai ke tangan pelanggan benar-benar siap dipakai.

## Foto sebelum dan sesudah

Kamu akan menerima foto sepatu sebelum dan sesudah dikerjakan, jadi bisa melihat sendiri perubahannya.

Status pengerjaan sepatumu juga bisa dipantau kapan saja lewat halaman **Tracking Pesanan** dengan nomor SPK.
MD,
            ],
            [
                'title' => 'Cara Kirim Sepatu ke Shoe Workshop Lewat Ekspedisi',
                'slug' => 'cara-kirim-sepatu-ke-shoe-workshop',
                'category' => 'General',
                'keluhan' => null,
                'thumbnail' => 'images/tentang-kami/front-office.webp',
                'content' => <<<'MD'
Tidak tinggal di Bandung? Sepatumu tetap bisa diperbaiki di Shoe Workshop. Sepatu cukup dikirim lewat jasa ekspedisi, lalu kami kirim kembali setelah selesai.

## Langkah-langkahnya

1. **Konsultasi dulu lewat WhatsApp.** Kirim foto sepatu dan ceritakan keluhannya, supaya layanan yang dibutuhkan jelas sejak awal.
2. **Kemas sepatu dengan aman.** Masukkan ke dalam kotak sepatu atau kardus supaya bentuknya tidak tertekan selama perjalanan.
3. **Sertakan catatan di dalam paket.** Tulis nama, nomor WhatsApp, dan keluhan atau layanan yang diinginkan.
4. **Kirim ke alamat workshop:**
   Shoe Workshop, Jl. Kembar I No.41, Cigereleng, Kec. Regol, Kota Bandung, Jawa Barat 40253
5. **Kirim nomor resi ke WhatsApp kami**, supaya paketmu bisa dipantau dan langsung dikenali saat tiba.

## Setelah sepatu sampai

Sepatu akan dicek terlebih dahulu (QC awal) dan kamu akan dihubungi untuk konfirmasi pekerjaan. Setelah selesai, sepatu dikirim kembali lewat ekspedisi.

Workshop buka Senin sampai Sabtu, pukul 09.00 sampai 17.00 WIB. Hari Minggu tutup.
MD,
            ],
            [
                'title' => 'Cara Klaim Garansi Reparasi di Shoe Workshop',
                'slug' => 'cara-klaim-garansi-reparasi',
                'category' => 'General',
                'keluhan' => null,
                'thumbnail' => 'images/tentang-kami/customer-care.webp',
                'content' => <<<'MD'
Hasil reparasi di Shoe Workshop dilindungi garansi selama 100 hari sejak sepatu selesai dikerjakan. Kalau dalam masa itu ada bagian hasil perbaikan yang bermasalah, kamu bisa mengajukan klaim secara online.

## Yang perlu disiapkan

- **Nomor SPK** dari pesananmu.
- **Nomor WhatsApp** yang dipakai saat memesan.
- Foto bagian sepatu yang bermasalah.

## Langkah klaim

1. Buka halaman **Klaim Garansi** di website ini.
2. Masukkan nomor SPK dan nomor WhatsApp untuk validasi.
3. Isi formulir klaim: jelaskan masalahnya dan lampirkan fotonya.
4. Tim kami akan meninjau klaimmu dan menghubungi lewat WhatsApp.

## Kapan garansi tidak berlaku?

Garansi tidak berlaku jika kerusakan disebabkan oleh kelalaian penggunaan, cuaca ekstrem, atau sepatu dicuci sendiri dengan cara yang salah setelah dikembalikan. Ketentuan lengkapnya ada di halaman Syarat & Ketentuan.
MD,
            ],
        ];
    }
};
