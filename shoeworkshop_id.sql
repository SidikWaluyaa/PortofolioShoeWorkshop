-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 21, 2026 at 02:28 PM
-- Server version: 5.5.62-log
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoeworkshop_id`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_sections`
--

CREATE TABLE `about_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_sections`
--

INSERT INTO `about_sections` (`id`, `title`, `description`, `image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Berdiri Sejak 2017', 'Shoe Workshop adalah spesialis reparasi dan perawatan sepatu yang berdiri sejak 2017, berfokus pada craftsmanship, presisi, dan tanggung jawab dalam setiap pengerjaan. Berbasis di Bandung, kami menangani berbagai jenis perbaikan dan restorasi sepatu melalui proses evaluasi, pengerjaan, dan quality control yang terukur, dengan pendekatan yang transparan dan dapat dipertanggungjawabkan. Bagi kami, sepatu bukan sekadar alas kaki, melainkan aset bernilai yang layak dirawat dengan standar kualitas tinggi dan konsistensi jangka panjang.', 'about/SUMXT8q7I8V801BldaRP9QYI06hI4c24eZEcSZUz.jpg', 1, '2026-01-26 18:56:35', '2026-01-26 19:54:18');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('shoeworkshop-cache-fe2ef495a1152561572949784c16bf23abb28057', 'i:2;', 1789362506),
('shoeworkshop-cache-fe2ef495a1152561572949784c16bf23abb28057:timer', 'i:1789362506;', 1789362506),
('shoeworkshop-cache-hophinasan1970@op.pl|162.158.19.59', 'i:1;', 1789339133),
('shoeworkshop-cache-hophinasan1970@op.pl|162.158.19.59:timer', 'i:1789339133;', 1789339133),
('shoeworkshop-cache-indra@shoeworkshop.com|162.158.88.12', 'i:4;', 1789176869),
('shoeworkshop-cache-indra@shoeworkshop.com|162.158.88.12:timer', 'i:1789176869;', 1789176869),
('shoeworkshop-cache-indra@workshop.com|104.23.232.38', 'i:1;', 1789694492),
('shoeworkshop-cache-indra@workshop.com|104.23.232.38:timer', 'i:1789694492;', 1789694492),
('shoeworkshop-cache-indra@workshop.com|162.158.88.12', 'i:3;', 1789176845),
('shoeworkshop-cache-indra@workshop.com|162.158.88.12:timer', 'i:1789176845;', 1789176845),
('shoeworkshop-cache-indra@workshop.com|172.68.164.33', 'i:4;', 1789353896),
('shoeworkshop-cache-indra@workshop.com|172.68.164.33:timer', 'i:1789353896;', 1789353896),
('shoeworkshop-cache-indra@workshop.com|172.71.124.232', 'i:1;', 1789694492),
('shoeworkshop-cache-indra@workshop.com|172.71.124.232:timer', 'i:1789694492;', 1789694492),
('shoeworkshop-cache-laras@shoeworkshop.com|172.71.152.97', 'i:1;', 1789787293),
('shoeworkshop-cache-laras@shoeworkshop.com|172.71.152.97:timer', 'i:1789787293;', 1789787293),
('shoeworkshop-cache-laras@workshop.com|104.23.175.226', 'i:3;', 1789787037),
('shoeworkshop-cache-laras@workshop.com|104.23.175.226:timer', 'i:1789787037;', 1789787037),
('shoeworkshop-cache-laras@workshop.com|104.23.175.227', 'i:1;', 1789787464),
('shoeworkshop-cache-laras@workshop.com|104.23.175.227:timer', 'i:1789787464;', 1789787464),
('shoeworkshop-cache-laras@workshop.com|162.158.108.62', 'i:1;', 1789785980),
('shoeworkshop-cache-laras@workshop.com|162.158.108.62:timer', 'i:1789785980;', 1789785980),
('shoeworkshop-cache-laras@workshop.com|172.71.152.97', 'i:2;', 1789787271),
('shoeworkshop-cache-laras@workshop.com|172.71.152.97:timer', 'i:1789787271;', 1789787271),
('shoeworkshop-cache-ls@workshop.com|162.158.88.12', 'i:1;', 1789787157),
('shoeworkshop-cache-ls@workshop.com|162.158.88.12:timer', 'i:1789787157;', 1789787157),
('shoeworkshop-cache-yaya@shoeworkshop.com|162.158.88.12', 'i:1;', 1789560589),
('shoeworkshop-cache-yaya@shoeworkshop.com|162.158.88.12:timer', 'i:1789560589;', 1789560589);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'catalog_top',
  `type` enum('image_upload','image_url','text_only') COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `promo_text` text COLLATE utf8mb4_unicode_ci,
  `cta_text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Info Selengkapnya',
  `target_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `views_count` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `clicks_count` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`id`, `title`, `position`, `type`, `image_path`, `image_url`, `promo_text`, `cta_text`, `target_url`, `is_active`, `start_date`, `end_date`, `views_count`, `clicks_count`, `created_at`, `updated_at`) VALUES
(1, 'Reparasi Sepatu untuk Donatur', 'catalog_top', 'image_upload', 'campaigns/reparasi_promo.png', NULL, NULL, 'Pesan Reparasi', 'https://wa.me/628123456789', 1, '2026-06-21 11:11:19', '2026-07-23 11:11:19', 650, 50, '2026-06-23 04:11:19', '2026-08-30 11:57:18'),
(2, 'Voucher Gratis Cuci Sepatu', 'catalog_top', 'image_upload', 'campaigns/voucher_promo.png', NULL, NULL, 'Klaim Voucher', 'https://wa.me/628123456789', 1, '2026-06-22 11:11:19', '2026-07-23 11:11:19', 650, 45, '2026-06-23 04:11:19', '2026-08-31 05:06:58');

-- --------------------------------------------------------

--
-- Table structure for table `cta_sections`
--

CREATE TABLE `cta_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` text COLLATE utf8mb4_unicode_ci,
  `button_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cta_sections`
--

INSERT INTO `cta_sections` (`id`, `title`, `subtitle`, `button_text`, `button_link`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Siap dicek dulu sepatunya?', 'Kirim foto sekarang, kami bantu analisa.', 'Konsultasi via WhatsApp', 'https://wa.me/62895339939800', 1, '2026-01-26 18:56:35', '2026-01-26 19:30:26');

-- --------------------------------------------------------

--
-- Table structure for table `daily_logins`
--

CREATE TABLE `daily_logins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_checkin` date NOT NULL,
  `foto_sepatu_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `minggu_ke` int(10) UNSIGNED NOT NULL,
  `hari_ke` tinyint(3) UNSIGNED NOT NULL,
  `status` enum('pending','approved','rejected','failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `reward_claimed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daily_logins`
--

INSERT INTO `daily_logins` (`id`, `user_id`, `tanggal_checkin`, `foto_sepatu_path`, `minggu_ke`, `hari_ke`, `status`, `reward_claimed`, `created_at`) VALUES
(1, 4, '2026-06-11', 'checkins/4c90402b-cda3-40c4-bf8a-e21f82d5c328.jpg', 1, 1, 'approved', 0, '2026-06-11 09:12:58'),
(2, 4, '2026-07-01', 'checkins/0da028a0-1c2e-49f9-b0d3-40ebdf6ec561.jpg', 1, 1, 'approved', 0, '2026-07-01 08:49:11'),
(3, 12, '2026-07-04', 'checkins/3e2ad695-924e-477e-8ea1-546b7feb106c.jpg', 1, 1, 'approved', 0, '2026-07-04 03:24:42'),
(4, 27, '2026-07-16', 'checkins/21a2e4b4-d513-4438-ad1c-7a1ecf2ed90c.jpg', 1, 1, 'approved', 0, '2026-07-16 08:44:29'),
(5, 18, '2026-07-16', 'checkins/3ddf5b9a-3fee-4388-84f8-5916eefdc632.jpg', 1, 1, 'failed', 0, '2026-07-16 08:46:14'),
(6, 18, '2026-07-18', 'checkins/df11a531-adb3-4b6a-a2dc-d816442c14b4.jpg', 1, 1, 'approved', 0, '2026-07-18 03:49:42');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `spk` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_sepatu` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ukuran` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kondisi` tinyint(3) UNSIGNED NOT NULL,
  `harga` bigint(20) UNSIGNED DEFAULT '0',
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `foto_path` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_bukti_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metode_pengiriman` enum('antar_langsung','ekspedisi') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ekspedisi',
  `nama_ekspedisi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_resi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','disetujui','diterima','disalurkan','ditolak','siap_rilis','masuk_katalog') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `is_reward_claimed` tinyint(1) NOT NULL DEFAULT '0',
  `catatan_admin` text COLLATE utf8mb4_unicode_ci,
  `verified_by` bigint(20) UNSIGNED DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `user_id`, `spk`, `nama_sepatu`, `ukuran`, `kondisi`, `harga`, `deskripsi`, `foto_path`, `foto_bukti_path`, `metode_pengiriman`, `nama_ekspedisi`, `no_resi`, `status`, `is_reward_claimed`, `catatan_admin`, `verified_by`, `verified_at`, `created_at`, `updated_at`) VALUES
(1, 4, NULL, 'Nike', '40', 68, 0, 'Masih Baguss', 'donations/sepatu/612a3a57-75f6-43e2-90f7-8c159d3e9c98.jpg', 'donations/bukti/ad7a444a-138a-4357-b044-fb0c8001dad4.jpg', 'antar_langsung', NULL, NULL, 'disalurkan', 0, NULL, 1, '2026-06-11 02:19:32', '2026-06-11 02:18:29', '2026-06-11 02:20:00'),
(2, 4, NULL, 'nike', '43', 59, 0, NULL, 'donations/sepatu/7b191a2e-7868-49d4-89be-0142022b0c12.jpg', NULL, 'ekspedisi', NULL, NULL, 'ditolak', 0, 'kureng ah', 16, '2026-07-13 04:18:58', '2026-06-11 03:39:38', '2026-07-13 04:18:58'),
(3, 19, 'SPK-DN-20260711-1973', 'New Balance', '43', 50, 0, 'Masih bagus lah', '[\"donations\\/sepatu\\/24384caa-1fe3-4715-b7b1-7b79940a623c.jpg\",\"donations\\/sepatu\\/0d8502e0-1a4c-41c3-83e8-c6f89a3ec2ac.jpg\",\"donations\\/sepatu\\/25e20b02-3c20-4d31-a2eb-7859d41335c3.jpg\",\"donations\\/sepatu\\/c22dac8a-e9d1-43c1-b78e-ef31e9c2bdd5.jpg\"]', 'donations/bukti/b14a2dd3-bcd6-4644-a516-d5cd187e6845.jpg', 'ekspedisi', NULL, NULL, 'masuk_katalog', 0, NULL, 16, '2026-07-13 04:14:07', '2026-07-11 09:32:56', '2026-07-13 04:27:08'),
(4, 18, 'SPK-DN-20260716-9975', 'Timberland', '45', 57, 0, NULL, '[\"donations\\/sepatu\\/44e15ca1-ed06-4fee-9270-8740e5e309a8.jpg\"]', NULL, 'ekspedisi', NULL, NULL, 'pending', 0, NULL, NULL, NULL, '2026-07-16 08:49:42', '2026-07-16 08:49:42'),
(5, 18, 'SPK-DN-20260718-5321', 'Timberland', '43', 55, 0, 'sol nya copot, dan membutuhkan deep clean', '[\"donations\\/sepatu\\/2ad99566-4b32-4619-b3b5-5edce2f6053c.jpg\",\"donations\\/sepatu\\/2c517f9c-b603-4e9e-84c7-c7e516636ac9.jpg\"]', NULL, 'ekspedisi', NULL, NULL, 'ditolak', 0, 'sangat tidak layak', 16, '2026-07-18 01:50:50', '2026-07-18 01:49:34', '2026-07-18 01:50:50');

-- --------------------------------------------------------

--
-- Table structure for table `donation_items`
--

CREATE TABLE `donation_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_barang` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `donation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori` enum('sepatu','tas','topi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `kondisi` enum('baru','seperti_baru','sudah_diperbaiki') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sudah_diperbaiki',
  `ukuran` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warna` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `berat` int(10) UNSIGNED DEFAULT NULL,
  `score_kelayakan` tinyint(3) UNSIGNED DEFAULT NULL,
  `status` enum('tersedia','disalurkan','arsip') COLLATE utf8mb4_unicode_ci DEFAULT 'tersedia',
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `foto_utama_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_detail` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donation_items`
--

INSERT INTO `donation_items` (`id`, `kode_barang`, `donation_id`, `nama`, `brand`, `kategori`, `kondisi`, `ukuran`, `warna`, `berat`, `score_kelayakan`, `status`, `deskripsi`, `foto_utama_path`, `foto_detail`, `created_at`, `updated_at`) VALUES
(2, '002-DS', NULL, 'Sepatu Sneakers Hitam Putih Casual Sport', 'Everbest', 'sepatu', 'sudah_diperbaiki', '42', NULL, NULL, 72, 'tersedia', 'Sepatu sneakers casual sport dari brand Everbest berwarna dominan hitam dengan kombinasi sol/heel counter berwarna putih.\r\n\r\nKondisi & Hasil Reparasi:\r\n\r\nDeep Cleaning: Sepatu telah dibersihkan secara menyeluruh pada area upper, midsole, hingga outsole.\r\n\r\nTouch-up / Repaint Minor: Perbaikan minor pada bagian kosmetik/warna yang pudar untuk mengembalikan tampilan optimalnya.\r\n\r\nKondisi Fisik: Secara keseluruhan struktur sepatu masih sangat kokoh, siap pakai, dengan sedikit minus minor berupa kikis/lecet halus pemakaian wajar di area karet depan dekat outsole (bisa cek detail pada foto produk).', 'katalog/fed6af6b-65d8-42a5-b61c-708bcd9869c8.jpg', '[\"katalog\\/496c3a36-17b6-4768-ba0a-d5a996c2616b.jpg\",\"katalog\\/fda77bd8-048c-4440-89e7-3800e9e94ac9.jpg\",\"katalog\\/7d3a63ad-35cf-4057-a9c3-4fefbf939093.jpg\"]', '2026-06-18 02:52:24', '2026-07-05 14:20:41'),
(3, '003-DS', NULL, 'Sandal Slop Transparan Jelly Wanita (Slide Sandals)', NULL, 'sepatu', 'sudah_diperbaiki', '37', NULL, NULL, 81, 'tersedia', 'Sandal slop (slide sandals) wanita dengan model minimalis modern. Memiliki strap atas berbahan jelly transparan (clear/light green tint) dan insole empuk berwarna biru muda (light blue). Desain sol bagian bawah tebal dan transparan.\r\n\r\nKondisi & Hasil Reparasi:\r\n\r\nDeep Cleaning: Sandal telah melalui proses pencucian menyeluruh untuk membersihkan debu, noda kusam, dan kotoran pada seluruh bagian jelly, insole, serta outsole.\r\n\r\nKondisi Fisik: Bahan jelly masih lentur, warna insole bersih dan cerah kembali, serta kondisi fisik secara keseluruhan sangat baik, mulus, dan siap untuk digunakan kembali.', 'katalog/e5a7b82e-1f0b-4907-a60d-552931332d34.jpg', '[\"katalog\\/fec9dd5c-f3d9-48d2-a6fa-b463fdb3d4ad.jpg\",\"katalog\\/f5d39891-2e4e-4b0d-ac76-70da07dac01b.jpg\",\"katalog\\/47104456-87cf-4104-8219-7a5cc35a192a.jpg\"]', '2026-06-18 02:54:36', '2026-07-05 14:21:29'),
(4, '004-DS', NULL, 'Sepatu Sneakers Slip On Wanita Casual Running', 'Skechers', 'sepatu', 'sudah_diperbaiki', '36,5', NULL, NULL, 85, 'tersedia', 'Sepatu sneakers slip-on wanita dari brand Skechers berwarna soft pink / peach lembut dengan kombinasi sol putih. Menggunakan material upper rajut (knit mesh) yang breathable, ringan, dan fleksibel untuk kenyamanan aktivitas sehari-hari maupun olahraga ringan.\r\n\r\nKondisi & Hasil Reparasi:\r\n\r\nDeep Cleaning: Sepatu telah melalui treatment pencucian menyeluruh. Seluruh noda tanah dan debu pada material rajut (upper) serta noda gesekan pada sol putih (midsole/outsole) telah dibersihkan secara maksimal.\r\n\r\nKondisi Fisik: Kain rajut atas sangat baik dan tidak ada robek, logo S samping masih mulus, bentuk sepatu tetap proporsional, serta sol bawah masih tebal dengan grip yang baik. Produk dalam kondisi sangat bersih, segar, dan siap langsung dipakai.', 'katalog/251d2e10-a0df-4f09-b719-dc7019b18961.jpg', '[\"katalog\\/1af1aa9e-c842-482c-8af0-5dbc333d73de.jpg\",\"katalog\\/ace5545b-343f-4f55-8662-a652b5a2a818.jpg\",\"katalog\\/0e38910d-e458-4582-9e20-7f615e98f252.jpg\"]', '2026-06-18 02:56:15', '2026-07-05 14:22:52'),
(5, '005-DS', NULL, 'Sepatu Sneakers Hitam Putih Sport Running Casual', 'Nike', 'sepatu', 'sudah_diperbaiki', '39', NULL, NULL, 88, 'tersedia', 'Sepatu sneakers sport running dari brand Nike (model Air Max 270 React) berwarna dominan hitam dengan kombinasi logo Swoosh dan bagian midsole berwarna putih, serta memiliki unit bantalan udara (air unit) hitam transparan di area tumit.\r\n\r\nKondisi & Hasil Reparasi:\r\n\r\nDeep Cleaning: Sepatu telah melalui proses pencucian menyeluruh (treatment cuci premium) pada seluruh area upper mesh/suede, tali sepatu, insole, hingga bagian sol bawah untuk memastikan bebas dari debu dan noda bekas pemakaian.\r\n\r\nKondisi Fisik: Material kain upper dan suede masih sangat baik, tidak ada robek. Bantalan udara (air bubble) di bagian tumit masih utuh, padat, dan tidak bocor. Secara keseluruhan struktur sepatu kokoh, bersih luar-dalam, dan siap langsung dipakai.', 'katalog/70e6d35e-2917-4b9b-a8c1-44710f7d8758.jpg', '[\"katalog\\/b117de77-2c1d-426f-84da-ad2adf99e074.jpg\",\"katalog\\/a2ad816e-e08b-4c4b-be0d-8368d89b6d51.jpg\",\"katalog\\/318776a5-f34b-413e-83df-a6e7bece0ef4.jpg\"]', '2026-06-18 03:00:20', '2026-07-05 14:23:14'),
(6, '006-DS', NULL, 'Sepatu Sneakers Slip On Luxury Hitam Putih Zipper', 'Giuseppe Zanotti', 'sepatu', 'sudah_diperbaiki', '44', NULL, NULL, 73, 'tersedia', 'Sepatu sneakers model slip-on luxury dari brand Giuseppe Zanotti. Desain kombinasi dua warna (blocking color) yang kontras, yaitu putih di bagian depan dan hitam di bagian belakang, dilengkapi dengan detail ritsleting (zipper) di bagian samping serta plat logo tanda tangan berwarna perak/emas di bagian depan.\r\n\r\nKondisi & Hasil Reparasi:\r\n\r\nDeep Cleaning: Seluruh bagian sepatu mulai dari upper leather (kulit), bagian dalam (insole), hingga sol karet putih (midsole/outsole) telah dibersihkan secara intensif dari noda dan debu.\r\n\r\nKondisi Fisik: Bahan kulit (leather upper) masih sangat bagus dan kokoh dengan kerutan halus pemakaian wajar. Detail ritsleting dan ornamen logam logo masih terpasang kuat. Kondisi sol bawah masih tebal dan siap digunakan untuk menunjang penampilan casual premium Anda.', 'katalog/bfc97ea8-8ecc-403f-9d1d-adc481625a1b.jpg', '[\"katalog\\/d10564e4-052e-4ec1-9814-08bd993934f5.jpg\",\"katalog\\/abe2c7c3-1de8-4768-b2a2-0e661bb7baed.jpg\",\"katalog\\/5c16d855-3f05-4d95-baae-5dfe85720af3.jpg\"]', '2026-06-18 03:02:15', '2026-07-05 14:24:34'),
(7, '007-DS', NULL, 'Sepatu Espadrilles Slip On Casual Navy Orange', 'TOMS', 'sepatu', 'sudah_diperbaiki', '43', NULL, NULL, 85, 'tersedia', 'Sepatu slip-on model espadrilles/alpargata dari brand TOMS. Memiliki desain kasual dengan kombinasi warna dua nada (two-tone), yaitu warna biru dongker (navy) pada bagian depan dan warna jingga (orange) pada bagian belakang/tumit, serta dilengkapi dengan insole kain yang nyaman untuk penggunaan santai sehari-hari.\r\n\r\nKondisi & Hasil Reparasi:\r\n\r\nDeep Cleaning: Sepatu telah melalui proses pencucian dan pembersihan menyeluruh. Material kain canvas luar, bagian insole, serta outsole karet bawah telah dibersihkan secara maksimal dari noda kotoran bekas pemakaian.\r\n\r\nKondisi Fisik: Bahan kain canvas masih fleksibel dan nyaman dipakai, jahitan sambungan orisinal masih kokoh, dan patch logo berbahan kulit/karet di bagian tumit belakang terpasang dengan baik. Kondisi sol bawah masih rata dan siap untuk langsung digunakan kembali.', 'katalog/1d66f811-cd23-42bb-a204-ccaf40ae6237.jpg', '[\"katalog\\/45a9a9ad-e6ef-41ae-94d1-618db39d2c4b.jpg\",\"katalog\\/8be54785-bc02-4634-8a50-0ce8d4b66020.jpg\",\"katalog\\/59d21b6c-bce7-4627-88e0-00b55ea381eb.jpg\"]', '2026-06-18 03:05:44', '2026-07-05 14:25:31'),
(8, '008-DS', NULL, 'Sepatu Boots Kulit Pria Casual Work Boots Moc Toe (Tanpa Tali)', 'Red Wing', 'sepatu', 'sudah_diperbaiki', '42', NULL, NULL, 78, 'tersedia', 'Sepatu boots kulit model Classic Moc Toe pria bermodel high-cut. Terbuat dari material kulit asli (genuine leather) tebal berwarna cokelat tan (brown leather) dengan sol karet berwarna putih (traction tred sole). Dilengkapi dengan lubang tali (eyelets) berbahan logam kuningan/perunggu yang kokoh.\r\n\r\nKondisi & Hasil Reparasi:\r\n\r\nDeep Cleaning & Leather Conditioning: Sepatu telah melalui proses pencucian khusus material kulit, dilanjutkan dengan pemberian leather conditioner untuk menjaga kelembapan, melembutkan kembali struktur kulit, serta memunculkan kembali kilau alami warna aslinya.\r\n\r\nKondisi Fisik: Material kulit asli sangat tebal, kuat, dan berkarakter, menampilkan gurat patina alami yang estetik. Jahitan moc toe di bagian depan masih utuh dan sangat kokoh. Kondisi sol bawah putih telah dibersihkan secara maksimal dan siap digunakan kembali untuk gaya kasual, vintage, maupun kebutuhan workwear. (Catatan: Dijual dalam kondisi tanpa tali sepatu)', 'katalog/8a00ea5b-6b49-4022-9af1-b296f7c82aa9.jpg', '[\"katalog\\/f862824f-c5ac-42a1-b272-43f020391159.jpg\",\"katalog\\/e944b56e-aa80-4f96-b3e5-c26498973cb3.jpg\",\"katalog\\/4dbc7c27-caee-42b2-8d6d-a8a292f5e2c9.jpg\"]', '2026-06-18 03:07:28', '2026-07-05 14:26:15'),
(9, '009-DS', NULL, 'Sepatu Futsal / Badminton Court Shoes PRISMA White Blue Green', 'Munich', 'sepatu', 'sudah_diperbaiki', '41', NULL, NULL, 87, 'tersedia', 'Sepatu olahraga court shoes (futsal/badminton/tenis) dari brand Munich seri PRISMA. Desainnya sangat khas dengan kombinasi multi-warna, yaitu dasar putih dengan aksen biru berbentuk logo \'X\' di bagian samping, kerah pergelangan kaki berwarna hijau, serta sol karet bagian bawah dengan variasi warna oranye/merah. Menggunakan perpaduan material mesh berpori agar adem saat dipakai dan lapisan sintetis/kulit untuk memperkuat struktur sepatu.\r\n\r\nKondisi & Hasil Reparasi:\r\n\r\nDeep Cleaning: Sepatu telah melalui proses pencucian menyeluruh. Bagian rajutan mesh depan yang sempat kusam telah dibersihkan, serta area midsole dan outsole karetnya telah dibersihkan secara intensif dari sisa kotoran lapangan.\r\n\r\nKondisi Fisik: Seluruh struktur jahitan dan lem sepatu masih sangat kokoh, siap digunakan untuk performa olahraga di lapangan indoor. Kondisi karet sol bawah masih memiliki grip/cengkeraman yang baik. Produk sudah bersih, higienis, dan siap pakai.', 'katalog/79d072ae-e0ed-485b-a0e8-f101661dd08b.jpg', '[\"katalog\\/778f4cf7-09d9-41cd-a1b5-6a135f477065.jpg\",\"katalog\\/5323d8ac-d6d1-4559-b561-52cc114baaf6.jpg\",\"katalog\\/04bd7791-57e5-4d78-a756-634e644189f0.jpg\"]', '2026-06-18 03:09:16', '2026-07-05 14:27:27'),
(11, '011-DS', NULL, 'Sepatu Flat Shoes Wanita Casual Hitam Ornamen Pita (Low Heels)', NULL, 'sepatu', 'sudah_diperbaiki', '38', NULL, NULL, 88, 'tersedia', 'Sepatu flat shoes / ballerina flats wanita model kasual formal dengan hak sangat rendah (low heels). Desain menggunakan bahan suede hitam pekat yang elegan, dipercantik dengan hiasan ornamen pita kain serta aksen logam berwarna emas (gold) di bagian depan dan bagian dalam hak belakang.\r\n\r\nKondisi & Hasil Reparasi:\r\n\r\nDeep Cleaning & Suede Care: Sepatu telah melalui proses pembersihan menyeluruh. Material suede luar telah di-treatment khusus untuk mengangkat debu dan mengembalikan kepekatan warna hitamnya agar tidak terlihat kusam. Bagian insole dalam berwarna krem juga telah dibersihkan secara higienis.\r\n\r\nKondisi Fisik: Tekstur suede masih halus dan terjaga dengan baik, aksen logam emas masih mengilap, serta struktur sol bawah dan hak kecilnya masih sangat stabil dan kokoh. Produk sudah dalam kondisi bersih, rapi, dan siap digunakan untuk kerja, kuliah, maupun acara formal.', 'katalog/8847dfd4-f441-4088-b6f8-77fca2a684d1.jpg', '[\"katalog\\/844f6122-17c2-4e86-adff-3de49ee60849.jpg\",\"katalog\\/7d625456-041e-4872-972a-1bfc70d30723.jpg\",\"katalog\\/f90e1934-488e-472c-8b32-d0f23a446964.jpg\"]', '2026-06-18 03:14:32', '2026-07-05 14:28:40'),
(12, '012-DS', NULL, 'Sepatu Sneakers Wanita Casual Sport Running (Tanpa Tali)', 'New Balance', 'sepatu', 'sudah_diperbaiki', '39', NULL, NULL, 71, 'tersedia', 'Sepatu sneakers casual running wanita dari brand New Balance (seri klasik seperti 574). Memiliki kombinasi warna yang unik dan manis, yaitu warna dasar cokelat tua (dark brown) dengan aksen merah muda pastel / salem (peach/pink) pada logo \'X\' dan sol bawah, serta kerah pergelangan kaki berwarna kuning pastel lembut.\r\n\r\nKondisi & Hasil Reparasi:\r\n\r\nDeep Cleaning: Sepatu telah melalui proses pencucian intensif. Bagian upper kain/suede cokelat telah dibersihkan, area warna pastel yang sempat kusam telah dicuci hingga kembali cerah, serta bagian midsole dan outsole karet bawah telah dibersihkan secara maksimal.\r\n\r\nKondisi Fisik: Seluruh struktur jahitan dan sol karet masih sangat kokoh serta memiliki kelenturan yang baik untuk aktivitas harian. Kondisi karet sol bawah bermotif gerigi (waffle sole) masih tebal dan memiliki cengkeraman yang baik. Produk sudah dalam kondisi bersih, higienis, dan siap pakai. (Catatan: Dijual dalam kondisi tanpa tali sepatu)', 'katalog/f0c9b093-4b40-43e0-8300-0de0e5751e3f.jpg', '[\"katalog\\/e5c2252a-1269-4bb4-8b73-e79120f2dc33.jpg\",\"katalog\\/fdb76910-4c0d-4e19-b994-455be11ec7ef.jpg\",\"katalog\\/2032090d-03e9-4338-a3ec-4f7fb18b0108.jpg\"]', '2026-06-18 03:16:33', '2026-07-05 14:30:30'),
(13, '013-DS', NULL, 'Sepatu Sneakers Casual Slip On Unisex Grey White (Tanpa Tali)', 'Onitsuka Tiger', 'sepatu', 'sudah_diperbaiki', '45', NULL, NULL, 85, 'tersedia', 'Sepatu sneakers casual model slip-on dari brand Onitsuka Tiger (seri ikonik Mexico 66 Slip-On). Memiliki warna dasar abu-abu (grey) dengan kombinasi garis (stripes) legendaris berwarna krem/putih tulang, serta desain bagian belakang tumit bertanda silang khas Onitsuka Tiger. Sepatu ini dirancang tanpa menggunakan tali sehingga sangat praktis untuk penggunaan sehari-hari.\r\n\r\nKondisi & Hasil Reparasi:\r\n\r\nDeep Cleaning: Sepatu telah melalui proses pencucian menyeluruh. Area kanvas/kulit upper abu-abu dan garis putih yang sebelumnya kusam akibat debu telah dibersihkan secara intensif hingga warnanya kembali bersih dan segar.\r\n\r\nKondisi Fisik: Seluruh struktur kain upper, jahitan, dan sol karet tipis khas Onitsuka masih sangat fleksibel, utuh, dan kuat. Bagian karet pelindung depan (toe cap) dan sol bawah masih terpasang rapi dan memiliki tapak yang baik. Produk sudah dalam kondisi bersih luar-dalam, higienis, dan langsung siap untuk dipakai santai.', 'katalog/655a19bb-d147-4d1d-9b85-30bc6c94c74f.jpg', '[\"katalog\\/a61d9404-0b3d-4298-b7e7-3166302b2354.jpg\",\"katalog\\/ff2d2e7d-9181-4df2-8f37-6c6ea5257e96.jpg\",\"katalog\\/ab5eacd5-a8ab-4420-aa34-497eaaaef6ef.jpg\"]', '2026-06-18 03:18:23', '2026-07-05 14:31:13'),
(14, '014-DS', NULL, 'Sepatu Gunung / Hiking Boots Leather Brown (Tanpa Tali)', 'Quechua', 'sepatu', 'sudah_diperbaiki', '41', NULL, NULL, 87, 'tersedia', 'Sepatu boots gunung / hiking pria model mid-to-high cut dari brand outdoor Quechua. Desain tangguh menggunakan material dominan nubuck/suede leather berwarna cokelat muda (light brown) yang dikombinasikan dengan kerah pergelangan kaki berbahan kulit sintetis cokelat tua, serta lapisan pelindung karet hitam pekat (rubber rand) mengelilingi area bawah sepatu. Dilengkapi dengan pengait tali logam (speed hooks dan d-rings) perak yang sangat kokoh.\r\n\r\nKondisi & Hasil Reparasi:\r\n\r\nDeep Cleaning & Leather Treatment: Sepatu telah melalui proses pencucian intensif khusus material nubuck/suede untuk mengangkat sisa noda tanah atau debu jalur pendakian. Suede telah di-treatment kembali agar seratnya tetap halus dan warnanya terjaga dengan baik.\r\n\r\nKondisi Fisik: Material kulit dan jahitan luar secara keseluruhan masih sangat tebal, rapat, dan kuat tanpa ada bagian yang robek. Karet pelindung bawah menempel dengan sempurna dan sol karet bermotif traksi (rugged outsole) masih sangat tebal, siap memberikan cengkeraman maksimal di medan outdoor yang ekstrem. Produk dikirim dalam kondisi sangat bersih, higienis, dan siap pakai. (Catatan: Dijual dalam kondisi tanpa tali sepatu)', 'katalog/b7978479-c06d-4b30-813f-f03efcda9e58.jpg', '[\"katalog\\/9422b9f9-e9c7-4647-b1fa-595205bd4e41.jpg\",\"katalog\\/3aa2abac-41c8-41b5-af2c-90ea616fc78c.jpg\",\"katalog\\/3c7f063d-1a3b-4c3e-a9c6-51ed99c8c8ac.jpg\"]', '2026-06-18 03:19:55', '2026-07-05 14:32:14'),
(15, '015-DS', NULL, 'Sepatu Boots Leather Premium High-Cut White Black (Tanpa Tali)', 'Timberland', 'sepatu', 'sudah_diperbaiki', '41', NULL, NULL, 91, 'tersedia', 'Sepatu boots model 6-inch premium boots dari brand ikonik Timberland. Memiliki warna dominan putih bersih (all-white leather) yang dipadukan dengan sol bawah (outsole) berwarna hitam kontras. Menggunakan material kulit asli bertekstur (textured genuine leather) dengan bantalan kerah pergelangan kaki (padded collar) berwarna putih empuk serta lubang tali (eyelets) logam berwarna putih senada.\r\n\r\nKondisi & Hasil Reparasi:\r\n\r\nDeep Cleaning: Sepatu telah melalui proses treatment pencucian intensif khusus untuk material kulit putih. Seluruh sisa noda, debu, atau kekusaman telah dibersihkan secara menyeluruh sehingga tampilan kulit kembali cerah dan bersih maksimal.\r\n\r\nKondisi Fisik: Struktur dan ketebalan kulit masih sangat kokoh tanpa ada robekan atau jahitan yang lepas. Bantalan kerah atas masih sangat empuk dan simetris, serta sol karet bagian bawah masih sangat tebal dengan alur grip yang utuh. Produk diproses secara higienis, bersih luar-dalam, dan siap pakai. (Catatan: Dijual dalam kondisi tanpa tali sepatu)', 'katalog/91478416-148f-41ff-afba-651cd6fce814.jpg', '[\"katalog\\/a62d0dc7-9171-47bc-9c3e-d39b4dd89bf6.jpg\",\"katalog\\/a29f35db-3b5e-442b-a03e-59a263126b74.jpg\",\"katalog\\/9132df6a-23ac-41f0-8b3c-fac6b6671a48.jpg\"]', '2026-06-18 03:22:55', '2026-07-05 14:33:28'),
(16, '016-DS', NULL, 'Sepatu Sneakers Wanita Nike Air Force 1 Shadow Pastel White Blue', 'Nike (Seri Air Force 1 Shadow)', 'sepatu', 'sudah_diperbaiki', '37', NULL, NULL, 70, 'tersedia', 'Rangkaian sepatu sneakers wanita Nike Air Force 1 Shadow original dengan tema warna pastel estetik yang memadukan dasar putih (white leather), aksen abu-abu (grey), hijau mint muda (light mint), serta sentuhan biru muda (light blue) pada bagian outsole bawah dan detail bordir tulisan Nike di bagian tumit belakang. Desain Shadow ini dicirikan dengan tumpukan layer ganda (overlay) pada logo Swoosh dan panel tumit.\r\n\r\nKondisi & Hasil Reparasi:\r\n\r\nDeep Cleaning: Sepatu telah melalui proses cuci menyeluruh (treatment cuci premium). Seluruh noda debu pada material kulit putih, tali sepatu, serta bagian midsole dan outsole karet bawah berwarna mint/biru telah dibersihkan secara intensif hingga kembali cerah.\r\n\r\nKondisi Fisik: Material kulit (leather upper) masih sangat bagus dan kokoh tanpa ada bagian yang sobek. Detail tumpukan layer orisinal khas seri Shadow masih rapi. Kondisi sol bawah masih tebal dengan alur karet (grip) yang sangat baik. Produk sudah dalam kondisi bersih luar-dalam, higienis, wangi, dan langsung siap digunakan.', 'katalog/ad131f81-68bd-403e-aa1b-f4f81e57046a.jpg', '[\"katalog\\/9650fcff-5c7b-4b22-a9fe-982831ea56de.jpg\",\"katalog\\/b78d38de-7866-46a6-928b-3ed4b0ceef3b.jpg\",\"katalog\\/dab93d72-8875-47d9-b886-618540ca1f4e.jpg\"]', '2026-06-18 03:24:24', '2026-07-16 07:41:08'),
(17, '017-DS', NULL, 'Sepatu Sneakers Slip On Knit Running Casual Sport', 'Nike', 'sepatu', 'sudah_diperbaiki', '41', NULL, NULL, 84, 'tersedia', 'Sepatu sneakers model slip-on / sock-like running dari brand Nike. Desain upper menggunakan material rajut fleksibel (knit upper) bermotif corak abu-abu hitam melange, dipadukan dengan panel kerah elastis hitam pekat yang menutup rapat pergelangan kaki. Sepatu ini dirancang tanpa tali (laceless) dengan variasi strap/pull tab minimalis, serta didukung sol busa (midsole) putih-hitam yang tebal untuk kenyamanan ekstra.\r\n\r\nKondisi & Hasil Reparasi:\r\n\r\nDeep Cleaning: Sepatu telah melalui proses pencucian intensif. Material rajut luar telah dibersihkan secara merata, area midsole putih telah dibersihkan hingga kembali cerah, serta bagian dalam sepatu telah diproses secara higienis.\r\n\r\nKondisi Fisik: Kerapatan material rajut (knit) masih sangat baik, elastis, dan tidak ada bagian yang koyak atau robek. Struktur sol busa dan karet bawah (outsole) masih sangat tebal dan siap memberikan redaman yang empuk untuk aktivitas olahraga ringan maupun kasual harian. Produk sudah dalam kondisi bersih, segar, dan siap pakai.', 'katalog/477a3c54-71d2-4938-8d1a-255d8c38e890.jpg', '[\"katalog\\/21a6e83c-274a-427a-823e-37814e055fe7.jpg\",\"katalog\\/3e78cd47-8882-4a62-8d74-51b80cb17bf9.jpg\",\"katalog\\/0e10e81e-40eb-431f-8a60-0653eb8cac59.jpg\"]', '2026-06-18 03:26:06', '2026-07-16 07:43:22'),
(18, '018-DS', NULL, 'Sepatu Boots Wanita Suede Ankle Boots Zipper Cream Casual', NULL, 'sepatu', 'sudah_diperbaiki', '38', NULL, NULL, 79, 'tersedia', 'Sepatu ankle boots wanita model kasual dengan ritsleting (zipper) di bagian samping dalam. Desain menggunakan bahan suede lembut berwarna krem (cream/tan) yang elegan dengan model kerah atas yang agak longgar (slouchy style) memberikan kesan santai namun tetap modis, serta didukung dengan hak tahu (chunky heels) pendek bermotif kayu yang stabil saat digunakan.\r\n\r\nKondisi & Hasil Reparasi:\r\n\r\nDeep Cleaning & Suede Care: Sepatu telah melalui proses pembersihan menyeluruh. Material suede luar telah di-treatment khusus untuk mengangkat debu dan noda ringan agar teksturnya kembali halus dan warnanya merata kembali. Bagian ritsleting logam juga telah dibersihkan agar dapat berfungsi dengan lancar.\r\n\r\nKondisi Fisik: Tekstur suede masih baik dan tidak ada robekan, ritsleting samping berfungsi dengan normal, serta struktur sol bawah dan hak tahu (chunky heels) masih sangat stabil dan kokoh. Produk sudah dalam kondisi bersih, rapi, dan siap digunakan untuk jalan-jalan santai maupun acara kasual.', 'katalog/d825fdba-e3df-44dc-909c-bc5eef6a6661.jpg', '[\"katalog\\/a583c53d-f60b-4e31-9ca1-6ecadc874cc1.jpg\",\"katalog\\/71b463f9-31c5-472c-a32b-4111ea44c143.jpg\",\"katalog\\/1cbaa5b9-2c58-46c6-b410-2e63fa7fa6fc.jpg\"]', '2026-06-18 03:27:25', '2026-07-16 07:47:05'),
(19, '019-DS', NULL, 'Sepatu Sneakers Vintage Grey Orange Casual (Tanpa Tali)', 'Adidas', 'sepatu', 'sudah_diperbaiki', '42', NULL, NULL, 79, 'tersedia', 'Sepatu sneakers bergaya kasual klasik (vintage/retro style) dari brand Adidas. Desain sepatu ini menggunakan warna dasar abu-abu (grey) berbahan suede/kain yang dikombinasikan dengan 3 garis (three stripes) khas Adidas berwarna oranye cerah (orange). Bagian tumit belakang dilengkapi dengan panel oranye berlogo Adidas Trefoil klasik.\r\n\r\nKondisi & Hasil Reparasi:\r\n\r\nDeep Cleaning: Sepatu telah melalui proses pencucian menyeluruh. Noda debu kusam pada material kain upper, area suede abu-abu, serta bagian sol karet bawahnya telah dibersihkan secara intensif hingga warnanya kembali bersih dan segar.\r\n\r\nKondisi Fisik: Material kain, suede, dan jahitan luar secara keseluruhan masih fleksibel dan kuat. Bagian sol karet tipis bermotif gerigi (retro outsole) masih menempel dengan sangat rapi dan memiliki tapak yang baik. Produk dikirim dalam kondisi bersih luar-dalam, higienis, dan langsung siap untuk dipakai santai. (Catatan: Dijual dalam kondisi tanpa tali sepatu)', 'katalog/f6d9f380-fc42-45f3-b7fe-10cd42f86f3d.jpg', '[\"katalog\\/be58c6aa-8a34-4d4d-be55-8c150ae1be3f.jpg\",\"katalog\\/3c488f6d-2c51-4579-87b6-97bc5d319828.jpg\",\"katalog\\/793cfc10-95ed-4263-b14f-e4f8f40b07fb.jpg\"]', '2026-06-18 03:28:57', '2026-07-16 08:02:00'),
(20, '020-DS', NULL, 'Sepatu Sneakers Basket Pria Air Jordan 6 Retro Suede Khaki (Tanpa Tali)', 'Air Jordan / Nike', 'sepatu', 'sudah_diperbaiki', '42', NULL, NULL, 89, 'tersedia', 'Sepatu sneakers basket model high-top legendaris Air Jordan 6 Retro. Menggunakan material premium suede atau nubuck berwarna krem/khaki (light khaki/wheat) di seluruh bagian upper, dipadukan dengan sol tengah (midsole) berwarna putih bersih serta aksen karet transparan (icy sole) kecokelatan di bagian tumit dan bawah. Sepatu ini mempertahankan desain khas AJ6 seperti lubang-lubang ventilasi geometris di sisi samping, lidah sepatu yang tinggi, serta pull tab karet ikonik di bagian belakang.\r\n\r\nKondisi & Hasil Reparasi:\r\n\r\nDeep Cleaning & Suede Care: Sepatu telah melalui proses pencucian menyeluruh yang disesuaikan khusus untuk material suede/nubuck sensitif guna mengangkat debu dan noda gesekan ringan tanpa merusak tekstur aslinya. Bagian sol putih juga telah dibersihkan agar kembali kontras dan bersih.\r\n\r\nKondisi Fisik: Tekstur suede luar masih sangat baik dan berkarakter, seluruh jahitan rapi, ornamen karet pull tab belakang utuh, serta logo bordir Jumpman di tumit terpasang sempurna. Bagian sol bawah masih memiliki ketebalan yang sangat baik dengan traksi yang optimal. Kondisi produk bersih luar-dalam, higienis, dan siap pakai untuk melengkapi koleksi sneakers atau gaya streetwear Anda. (Catatan: Dijual dalam kondisi tanpa tali sepatu dan tanpa kancing tali/lace toggle)', 'katalog/fb09a88d-0384-4475-9cf7-501681d933bc.jpg', '[\"katalog\\/d427f05a-cc84-43cc-be1d-f0203de2891d.jpg\",\"katalog\\/aa534f3d-286b-46cd-a856-a7f59b577dcc.jpg\",\"katalog\\/05f04510-4e8c-4900-9895-c4ba0ab608bd.jpg\"]', '2026-06-18 03:39:21', '2026-07-16 07:58:22'),
(21, '021-DS', NULL, 'Sepatu Safety Boots Low-Cut Leather Brown Composite Toe (Termasuk Tali Cadangan)', NULL, 'sepatu', 'sudah_diperbaiki', '42', NULL, NULL, 84, 'tersedia', 'Sepatu keselamatan (safety shoes/boots) model potongan rendah (low-cut) yang dirancang tangguh untuk kebutuhan kerja industri atau lapangan. Sepatu ini menggunakan material kulit halus berkualitas (smooth leather) berwarna cokelat tua (dark brown) dengan pelindung jari kaki non-logam (composite toe guard) yang kuat namun ringan. Dilengkapi juga dengan aksen pelindung hitam di sekeliling pergelangan kaki serta outsole karet tebal anti-selip. Pembelian sudah termasuk satu paket tali sepatu cadangan baru yang masih terbungkus plastik.\r\n\r\nKondisi & Hasil Reparasi:\r\n\r\nDeep Cleaning & Leather Treatment: Sepatu telah dibersihkan secara menyeluruh dari sisa debu atau noda pemakaian. Material kulit luar telah dirawat dengan cairan khusus (leather conditioner) untuk menjaga kelembapan kulit, menyamarkan goresan halus, serta mengembalikan kilau alaminya.\r\n\r\nKondisi Fisik: Material kulit masih sangat tebal dan tidak ada bagian yang sobek. Pelindung jari depan (composite toe) masih utuh dan aman, lubang tali (eyelets) kokoh, serta sol karet bawah bermotif traksi tinggi masih tebal dan bebas kikis. Produk dikirim dalam kondisi sangat bersih luar-dalam, higienis, dan langsung siap dipakai bekerja.', 'katalog/3d0fef5a-0375-44a1-a7bd-464381ef59cd.jpg', '[\"katalog\\/02841524-81dd-4375-8ef6-7ad5aa87e7ef.jpg\",\"katalog\\/f489cfb8-d616-48ff-8adc-67169475f67c.jpg\",\"katalog\\/484286f5-5b54-41dc-96e4-3a9e65ccf2df.jpg\"]', '2026-06-18 03:42:03', '2026-07-16 08:02:35'),
(22, '022-DS', NULL, 'Sepatu Sneakers Slip On All Black Sport Casual (Tanpa Tali)', 'Prada', 'sepatu', 'sudah_diperbaiki', '43', NULL, NULL, 89, 'tersedia', 'Sepatu sneakers model slip-on pria dari brand luxury Prada (lini sport Linea Rossa). Desain sepatu hadir dengan warna hitam pekat secara menyeluruh (all black) menggunakan kombinasi material kain mesh rajut berpori yang ringan dan dilapisi panel karet tipis bergelombang (wavy overlay) di bagian atas. Sepatu ini dirancang praktis tanpa tali, mengutamakan konsep minimalis-sporty, serta memiliki ciri khas berupa aksen strip berwarna merah (iconic red stripe) pada bagian sol samping luar dan bawah. Sol karetnya tebal dengan pola gerigi (chunky outsole) yang memberikan traksi kuat sekaligus kesan modern.\r\n\r\nKondisi & Hasil Reparasi:\r\n\r\nDeep Cleaning: Sepatu telah melalui proses pencucian intensif secara menyeluruh. Noda debu kusam pada rajutan kain luar, insole bagian dalam, serta sisa kotoran pada sol luar (outsole) hitam tebal telah dibersihkan secara maksimal hingga kembali bersih mengilap.\r\n\r\nKondisi Fisik: Material rajutan luar masih sangat kencang, elastis, dan tidak ada bagian yang sobek. Detail karet pelindung eksternal, tab tumit belakang, serta aksen strip merah khas Prada masih dalam kondisi utuh dan terpasang sempurna. Sol bawah masih tebal dengan kembangan yang utuh tanpa kikis berarti. Produk sudah diproses secara higienis, bersih luar-dalam, dan langsung siap digunakan.', 'katalog/4540904a-7065-429e-90ad-eb5c788822ef.jpg', '[\"katalog\\/f0479d4f-a43f-4b22-b7f0-24f063536a62.jpg\",\"katalog\\/94cfd6ec-1d64-4714-b7a5-526f6de4ec21.jpg\",\"katalog\\/41c59c73-a9dd-408b-9431-29481d0acce8.jpg\"]', '2026-06-18 03:44:32', '2026-07-16 08:02:58'),
(23, '023-DS', NULL, 'Sepatu Sneakers Vintage Nike Air Max Black White (Tanpa Tali)', 'Nike', 'sepatu', 'sudah_diperbaiki', '38', NULL, NULL, 91, 'tersedia', 'Sepatu sneakers sport kasual bergaya vintage dari brand Nike (model classic Air Max/running series). Memiliki kombinasi warna lawas yang ikonis, yaitu perpaduan panel kulit sintetis hitam pekat dan rajutan mesh berpori di area atas (upper), dengan lekukan gelombang panel kulit sintetis berwarna putih bersih di bagian samping hingga depan. Sol tengah (midsole) mengusung desain tebal berwarna putih-hitam dengan gelembung udara (air bubble unit) berjejer di sepanjang sisi luar tumit bawah. Panel tumit belakang dipercantik dengan badge logo bulat \"Air\" bernuansa oranye-biru retro.\r\n\r\nKondisi & Hasil Reparasi:\r\n\r\nDeep Cleaning: Sepatu telah melalui proses pencucian intensif secara menyeluruh. Noda debu kusam pada rajutan kain mesh, insole bagian dalam, serta sisa kotoran pada sol luar (outsole) putih tebal telah dibersihkan secara maksimal hingga kembali bersih dan kontras.\r\n\r\nKondisi Fisik: Material kulit sintetis dan rajutan luar secara keseluruhan masih kokoh. Unit bantalan udara (air bubble) di sepanjang sol tumit masih padat dan berfungsi dengan baik. Bagian outsole bawah masih tebal dengan alur karet (grip) yang utuh. Produk sudah dalam kondisi bersih luar-dalam, higienis, dan langsung siap untuk dipakai santai atau melengkapi koleksi sneakers lawas Anda. (Catatan: Dijual dalam kondisi tanpa tali sepatu)', 'katalog/8cb5f356-7c77-4245-a5d7-d611ea64919c.jpg', '[\"katalog\\/da903f40-e623-41e5-b7c7-09a274dae07e.jpg\",\"katalog\\/4f56fb5a-ac07-4d6b-8fe4-79ae2199b8cb.jpg\",\"katalog\\/e0a7980b-1078-4d77-a2fc-89bb2607d23c.jpg\"]', '2026-06-18 03:46:03', '2026-07-16 08:04:17'),
(24, '024-DS', NULL, 'Sepatu Sneakers Boots Pria Outdoor Casual High-Top Tan', 'Timberland', 'sepatu', 'sudah_diperbaiki', '43', NULL, NULL, 91, 'arsip', 'Sepatu sneakers boots model high-top modern dari brand Timberland (seri Euro Swift / Madbury Boot). Memiliki warna dominan cokelat muda (tan/wheat) dengan material perpaduan kulit nubuck premium dan panel tekstil fabric yang kokoh. Kerah pergelangan kaki (padded collar) menggunakan bahan empuk berwarna hitam pekat yang kontras, dipadukan dengan sol tengah (midsole) bermodel chunky geometri berwarna putih serta outsole karet hitam di bagian bawah. Tali sepatu bercorak orisinal bawaan pabrik juga masih terpasang rapi menggunakan kombinasi pengait logam (speed hooks) di bagian atas.\r\n\r\nKondisi & Hasil Reparasi:\r\n\r\nDeep Cleaning & Nubuck Care: Sepatu telah melalui proses pencucian intensif secara menyeluruh. Noda debu kusam pada material kulit nubuck luar telah dibersihkan dan dirawat khusus agar teksturnya tetap lembut serta warnanya kembali segar. Area sol putih yang berlekuk juga telah dibersihkan secara maksimal.\r\n\r\nKondisi Fisik: Seluruh struktur jahitan, lem, dan rajutan tekstil masih sangat kuat dan utuh tanpa ada robekan. Pengait tali logam lengkap dan bebas karat. Bagian outsole bawah bermotif traksi tinggi masih tebal dan kokoh, siap memberikan cengkeraman optimal. Produk sudah dalam kondisi bersih luar-dalam, higienis, dan langsung siap digunakan untuk aktivitas outdoor maupun kasual harian.', 'katalog/a5a77ced-ad85-4c07-a788-8858c53b9548.jpg', '[\"katalog\\/e71bd097-b5d7-4e08-84c6-9ba2c8f6ee9a.jpg\",\"katalog\\/71c83ad4-235c-4d6d-a45f-461c6f46dfe2.jpg\",\"katalog\\/dec7c21a-e7d1-45ec-b21e-65483ac0a080.jpg\"]', '2026-06-18 03:47:38', '2026-08-14 06:41:57'),
(25, '025-DS', NULL, 'Sepatu Sneakers Reebok Zig Kinetica All Black Sport Running Casual', 'Reebok', 'sepatu', 'sudah_diperbaiki', '42', NULL, NULL, 91, 'tersedia', 'Sepatu sneakers sport running kasual dari brand Reebok (seri ikonik Zig Kinetica / Zig Elusion). Desain sepatu hadir dengan warna hitam pekat (all black) yang dipadukan dengan aksen abu-abu gelap pada bagian logo samping serta sol bawah. Keunikan utama sepatu ini terletak pada bagian sol tengah (midsole) bermodel zigzag bergelombang yang khas, memberikan kesan futuristik sekaligus performa peredaman yang maksimal. Upper sepatu menggunakan material kain mesh rajut yang ringan dan berpori untuk sirkulasi udara yang baik.\r\n\r\nKondisi & Hasil Reparasi:\r\n\r\nDeep Cleaning: Sepatu telah melalui proses pencucian intensif secara menyeluruh. Noda debu kusam pada material rajutan kain luar, insole bagian dalam, serta sisa kotoran pada sol luar zigzag yang tebal telah dibersihkan secara maksimal hingga kembali bersih kembali.\r\n\r\nKondisi Fisik: Material rajutan luar masih sangat kencang, tidak ada bagian yang sobek, tali sepatu orisinal terpasang rapi, dan seluruh struktur sol zigzag masih utuh serta sangat kokoh. Bagian outsole bawah masih tebal dengan alur karet (grip) yang baik. Produk sudah diproses secara higienis, bersih luar-dalam, dan langsung siap digunakan untuk berolahraga maupun aktivitas kasual harian.', 'katalog/9248a730-a3bd-4125-b8b8-d6a7eec89f75.jpg', '[\"katalog\\/0b0c4664-79fc-45eb-bede-d7022afc6e11.jpg\",\"katalog\\/e58e54ed-dc44-4214-b25f-06c8b2479889.jpg\",\"katalog\\/466d617e-6d82-4d8a-afd3-98f2c0a019ca.jpg\"]', '2026-06-18 03:49:16', '2026-07-16 08:06:54'),
(26, '026-DS', NULL, 'Sepatu Sneakers Vintage Blue White Casual Sport (Tanpa Tali)', 'Puma', 'sepatu', 'sudah_diperbaiki', '40', NULL, NULL, 89, 'tersedia', 'Sepatu sneakers bergaya kasual klasik (vintage retro sport) dari brand Puma. Desain sepatu ini menggunakan warna dominan biru tua (blue) berbahan suede/kulit yang dipadukan dengan garis Formstrip khas Puma berwarna putih di bagian samping. Area tumit belakang berbahan suede biru dilengkapi dengan bordir logo Puma berwarna putih, sementara bagian lidah sepatu memiliki label tenun orisinal Puma berwarna hijau-putih. Desain lubang tali sepatu ini menggunakan panel loop kain yang unik.\r\n\r\nKondisi & Hasil Reparasi:\r\n\r\nDeep Cleaning: Sepatu telah melalui proses pencucian intensif secara menyeluruh. Noda debu kusam pada material kain/kulit luar, area suede biru, insole bagian dalam, serta sisa kotoran pada sol luar karetnya telah dibersihkan secara maksimal hingga kembali bersih dan segar kembali.\r\n\r\nKondisi Fisik: Material kulit, suede, dan jahitan luar secara keseluruhan masih fleksibel dan sangat kuat. Bagian midsole karet berwarna krem (off-white/cream) memberikan kesan estetika vintage/classic yang kental. Kondisi sol bawah masih tebal dengan tapak yang baik. Produk dikirim dalam kondisi bersih luar-dalam, higienis, dan langsung siap untuk dipakai santai. (Catatan: Dijual dalam kondisi tanpa tali sepatu)', 'katalog/9b783e32-aa85-4a37-bfa7-609e7e7fdfbd.jpg', '[\"katalog\\/926d0d5d-2787-4bc9-9ce3-adf07a48447d.jpg\",\"katalog\\/83906613-d104-4755-beed-d7e58d5d06aa.jpg\",\"katalog\\/01c466dd-fc98-4994-a0a5-d8c4db11c576.jpg\"]', '2026-06-18 03:50:40', '2026-07-16 08:08:11'),
(27, '027-DS', NULL, 'Sepatu Sneakers Reebok Black White Sport Running Casual (Tanpa Tali)', 'Reebok', 'sepatu', 'sudah_diperbaiki', '40', NULL, NULL, 89, 'tersedia', 'Sepatu sneakers sport running kasual dari brand Reebok. Desain sepatu ini hadir dengan warna dominan hitam pekat (black) berbahan kain mesh berpori ringan, dipadukan dengan logo delta khas Reebok berwarna putih kontras di bagian samping. Sol tengah (midsole) dirancang tebal berwarna putih bersih untuk memberikan peredaman yang empuk, sementara panel belakang tumit dilengkapi dengan pelindung tambahan berlogo Reebok kecil.\r\n\r\nKondisi & Hasil Reparasi:\r\n\r\nDeep Cleaning: Sepatu telah melalui proses pencucian intensif secara menyeluruh. Noda debu kusam pada material kain upper luar, insole bagian dalam, serta kekusaman pada sol luar karet putih (midsole/outsole) telah dibersihkan secara maksimal hingga kembali bersih dan kontras.\r\n\r\nKondisi Fisik: Material rajutan kain mesh luar masih sangat bagus, tidak ada bagian yang sobek, seluruh struktur jahitan dan sol karet masih sangat kokoh serta elastis untuk menunjang aktivitas harian. Kondisi karet sol bawah masih tebal dengan tapak yang baik. Produk sudah diproses secara higienis, bersih luar-dalam, dan langsung siap digunakan. (Catatan: Dijual dalam kondisi tanpa tali sepatu)', 'katalog/8e4a036d-4113-44ca-92b6-f1843a0179ed.jpg', '[\"katalog\\/9c7f339e-9ae5-4b52-b099-acb7f2068596.jpg\",\"katalog\\/4a1044f5-928b-4ac4-9462-f889028f41e4.jpg\",\"katalog\\/d5bee52a-bfe6-4ba8-9846-ebe65ae513ef.jpg\"]', '2026-06-18 03:52:05', '2026-07-16 08:09:03'),
(28, '028-DS', NULL, 'Sepatu Sneakers Slip On Rajut Wanita Casual Full Black', 'Skechers', 'sepatu', 'sudah_diperbaiki', '44', NULL, NULL, 89, 'tersedia', 'Sepatu sneakers model slip-on wanita dari brand Skechers. Desain sepatu hadir dengan warna hitam pekat secara menyeluruh (full black/all black) menggunakan material kain mesh rajut (knit upper) yang ringan, elastis, dan memiliki sirkulasi udara yang baik. Dirancang tanpa tali (laceless) dengan model kerah pergelangan kaki yang pas seperti kaus kaki (sock-like fit) serta dilengkapi pull tab di bagian tumit belakang untuk kemudahan pemakaian. Sol bawah dirancang empuk dan ringan, sangat ideal untuk jalan santai maupun aktivitas kasual harian.\r\n\r\nKondisi & Hasil Reparasi:\r\n\r\nDeep Cleaning: Sepatu telah melalui proses pencucian intensif. Area kain rajut upper, bagian dalam (insole), serta seluruh permukaan sol karet hitam telah dibersihkan secara maksimal dari noda debu pemakaian agar kembali bersih pekat.\r\n\r\nKondisi Fisik: Kerapatan material rajutan masih sangat baik, tidak ada bagian yang robek, kendur, atau bolong. Logo minimalis Skechers di bagian samping luar dan tumit belakang masih utuh. Kondisi sol bawah masih tebal dengan alur karet yang baik dan siap langsung digunakan.', 'katalog/d62c51f9-c9fc-4805-b847-692a3d234282.jpg', '[\"katalog\\/fa1c4627-59b7-4f86-9898-6161c6d8adae.jpg\",\"katalog\\/ba95a114-5637-4760-a378-e0daf7264430.jpg\",\"katalog\\/fdfe9b6e-ed34-4a67-8a67-cd351888a5a2.jpg\"]', '2026-06-18 03:53:40', '2026-07-16 08:10:07'),
(29, '029-DS', NULL, 'Sepatu Outdoor Hiking Trail Running Black BOA System Waterproof', 'Treksta', 'sepatu', 'sudah_diperbaiki', '42', NULL, NULL, 90, 'tersedia', 'Sepatu olahraga outdoor / hiking / trail running dari brand Treksta. Desain sepatu hadir dengan warna hitam pekat secara menyeluruh (all black) menggunakan kombinasi material kain mesh rajut berpori tebal dan lapisan sintetis pelindung yang kokoh. Keunggulan utama sepatu ini adalah penggunaan mekanisme tali putar BOA Fit System yang praktis untuk mengencangkan sepatu tanpa tali konvensional, serta didukung teknologi kain Gore-Tex (waterproof) untuk ketahanan terhadap air. Sol karetnya dirancang tebal dengan pola tapak kasar (rugged outsole) khas medan terjal.\r\n\r\nKondisi & Hasil Reparasi:\r\n\r\nDeep Cleaning: Sepatu telah melalui proses pencucian intensif secara menyeluruh. Sisa tanah, debu jalur outdoor, noda pada mesh luar, serta kotoran pada sol karet bawah yang tebal telah dibersihkan secara maksimal hingga kembali bersih pekat.\r\n\r\nKondisi Fisik: Material upper kain mesh dan pelindung sintetis masih sangat kokoh tanpa ada bagian yang sobek. Sistem kawat putar BOA berfungsi normal, lancar, dan mengunci dengan baik. Kondisi sol karet bawah masih tebal dengan alur grip yang sangat tajam tanpa kikis berarti. Produk sudah diproses secara higienis, bersih luar-dalam, dan langsung siap digunakan untuk berpetualang.', 'katalog/7dfd7190-b2c0-420e-bbaa-fff1edbce94c.jpg', '[\"katalog\\/59fc70cf-2398-424d-82a2-92f0d95f064e.jpg\",\"katalog\\/6c3c2612-1692-4e15-9143-e060b7c3485e.jpg\",\"katalog\\/113ee922-db48-42ef-8a0e-a351f76dcfd3.jpg\"]', '2026-06-18 03:55:02', '2026-07-16 08:10:51'),
(30, '030-DS', NULL, 'Sepatu Basket Pria Nike Kyrie 6 Pre-Heat Tokyo Light Blue Orange', 'Nike', 'sepatu', 'sudah_diperbaiki', '43', NULL, NULL, 41, 'tersedia', 'Sepatu basket pria high-top premium Nike Kyrie 6 edisi spesial \"Pre-Heat Tokyo\". Sepatu ini hadir dengan kombinasi warna yang sangat mencolok dan unik, didominasi warna biru muda langit (light blue/cyan) pada bagian upper, sol, dan lidah sepatu. Dilengkapi dengan strap midfoot ikonik bercorak harimau/serat kayu bernuansa jingga (orange tiger-stripe strap) serta panel tumit belakang melengkung berwarna jingga cerah dengan logo mata batin (all-seeing eye) khas lini Kyrie. Logo Swoosh Nike berwarna hitam tegas menghiasi sisi samping sepatu, sementara logo inisial Kyrie Irving terbordir di bagian lidah sepatu.\r\n\r\nKondisi & Hasil Reparasi:\r\n\r\nDeep Cleaning: Sepatu telah melalui proses pencucian intensif secara menyeluruh. Noda debu lapangan pada material mesh dan nubuck luar telah dibersihkan, warna biru muda dan jingga yang sempat kusam telah disegarkan kembali, serta bagian sol karet bawah (outsole) telah dicuci bersih secara higienis.\r\n\r\nKondisi Fisik: Seluruh struktur jahitan, lem sepatu, serta fungsi strap velcro pengunci di bagian tengah masih sangat rekat dan kokoh. Kondisi sol bawah karet melengkung (curved outsole) khas lini Kyrie masih tebal dengan pola cengkeraman (grip) yang sangat baik untuk pergerakan lincah di lapangan. Produk dalam kondisi sangat bersih luar-dalam, segar, dan siap untuk langsung digunakan bertanding atau melengkapi koleksi sneakers basket Anda. (Catatan: Dijual dalam kondisi tanpa tali sepatu)', 'katalog/fe88e23a-4efc-4064-b185-8ba1ccc0a2b0.jpg', '[\"katalog\\/16994477-9795-47df-ae16-01b81d0c5973.jpg\",\"katalog\\/f880afdf-925c-4730-a765-744e6088ffc8.jpg\",\"katalog\\/9dc1975c-8fdd-4140-a1e1-3b3631391bdd.jpg\"]', '2026-06-18 03:56:46', '2026-07-16 08:14:30'),
(32, '032-DS', NULL, 'Sepatu Sneakers Nike Air Max 97 White Light Blue Waves (Tanpa Tali)', 'Nike', 'sepatu', 'sudah_diperbaiki', '41', NULL, NULL, 89, 'tersedia', 'Sepatu sneakers sport kasual ikonik Nike Air Max 97 original. Desain legendaris yang terinspirasi dari kereta cepat Jepang ini hadir dengan warna dasar putih bersih (white leather), berpadu manis dengan aksen garis bergelombang (waves) kombinasi warna biru muda (light blue) dan emas/kuning pastel di area upper. Bagian tumit belakang dilengkapi dengan pull tab kain hitam bertuliskan aksen \"VIDE\", serta didukung sol tebal dengan teknologi bantalan udara Full-length Air Max unit di sepanjang sol bawah.\r\n\r\nKondisi & Hasil Reparasi:\r\n\r\nDeep Cleaning: Sepatu telah melalui proses pencucian premium yang intensif. Sisa debu kusam pada rajutan kain upper, sela-sela garis bergelombang, serta area sol karet putih (midsole) telah dibersihkan secara menyeluruh hingga warnanya kembali cerah dan segar.\r\n\r\nKondisi Fisik: Material kulit, rajutan, dan jahitan luar secara keseluruhan masih sangat kokoh tanpa ada robekan. Unit jendela bantalan udara transparan (visible Air unit) di sepanjang sol bawah masih berfungsi baik, padat, dan stabil. Produk sudah diproses secara higienis, bersih luar-dalam, dan siap pakai. (Catatan: Dijual dalam kondisi tanpa tali sepatu)', 'katalog/ddb21064-5f0d-42bc-988c-bfe736ea991b.jpg', '[\"katalog\\/1ee9f261-b73b-4141-ba0d-1741aa0a03c5.jpg\",\"katalog\\/205375aa-1ef8-4f32-a79a-1ba2b120710f.jpg\",\"katalog\\/a62ac357-43a9-4550-9556-1a0b2fcde027.jpg\"]', '2026-06-18 04:02:40', '2026-07-16 08:17:18'),
(33, '033-DS', NULL, 'Sepatu Sneakers Casual Adidas Neo Leather Black Blue Stripes (Tanpa Tali)', 'Adidas', 'sepatu', 'sudah_diperbaiki', '41', NULL, NULL, 79, 'tersedia', 'Sepatu sneakers bergaya kasual minimalis (skate/court style) dari brand Adidas. Desain sepatu hadir menggunakan material dominan kulit sintetis halus (smooth faux leather) berwarna hitam pekat, dipadukan dengan variasi 3 garis (three stripes) khas Adidas berwarna kombinasi biru tua, abu-abu, dan biru muda di bagian samping. Area tumit belakang dilengkapi dengan detail cetakan tulisan merek Adidas serta aksen vertikal garis putih-hitam, serasi dengan bagian sol karet (midsole) putih bermotif garis biru tipis di sekelilingnya.\r\n\r\nKondisi & Hasil Reparasi:\r\n\r\nDeep Cleaning & Leather Care: Sepatu telah melalui proses pencucian menyeluruh. Bagian upper kulit sintetis hitam telah dibersihkan secara maksimal dan dirawat menggunakan kondisioner khusus agar kilau alaminya kembali serta teksturnya tetap lentur. Bagian midsole karet putih yang semula kusam dan berdebu telah disikat bersih hingga kembali cerah kontras.\r\n\r\nKondisi Fisik: Ketebalan leather upper masih sangat baik, jahitan luar rapat, dan tidak ada bagian yang mengelupas atau sobek. Struktur sol karet bawah (cupsole) menempel dengan sangat rapi dan memiliki tapak yang stabil tanpa kikis berarti. Produk sudah diproses secara higienis, bersih luar-dalam, wangi, dan langsung siap pakai untuk beraktivitas harian. (Catatan: Dijual dalam kondisi tanpa tali sepatu)', 'katalog/e6a1cae6-0d60-4a83-966f-d1240d28446c.jpg', '[\"katalog\\/f5bc12da-5712-42c5-a9aa-f6b55f4ea740.jpg\",\"katalog\\/e386849b-cce1-468e-9bda-06a933082d84.jpg\",\"katalog\\/33865e21-7cf8-46e0-bf13-2c31248a849c.jpg\"]', '2026-06-18 04:34:45', '2026-07-16 08:20:27'),
(34, '034-DS', NULL, 'Sepatu Sneakers Skechers Go Run White Grey Blue (Tanpa Tali)', 'Skechers', 'sepatu', 'sudah_diperbaiki', '42', NULL, NULL, 79, 'tersedia', 'Sepatu sneakers sport running dari brand Skechers seri Go Run. Desainnya hadir dengan warna dominan putih abu-abu (white grey) menggunakan material mesh nilon berpori yang ringan dan sejuk, dipadukan dengan aksen strip bertuliskan \"SKX\" di sepanjang sisi samping luar dan kerah tumit belakang. Didukung sol tengah (midsole) busa tebal khas Skechers Go Run untuk peredaman maksimal saat melangkah atau berlari, serta sentuhan warna biru firus (turquoise blue) pada bagian ujung karet sol bawah.\r\n\r\nKondisi & Hasil Reparasi:\r\n\r\nDeep Cleaning: Sepatu telah melalui proses pencucian intensif. Noda debu kehitaman dan kekusaman pada material mesh putih, lidah sepatu, serta sol busa (midsole) bawah telah dibersihkan secara maksimal hingga tampilannya kembali cerah dan segar.\r\n\r\nKondisi Fisik: Material rajutan kain mesh upper dan seluruh jahitan luar-dalam masih sangat kokoh tanpa ada bagian yang robek. Struktur sol busa masih sangat empuk, responsif, dan karet sol bawah memiliki ketebalan yang baik untuk traksi harian. Produk sudah diproses secara higienis, bersih, wangi, dan langsung siap pakai untuk berolahraga maupun aktivitas kasual harian. (Catatan: Dijual dalam kondisi tanpa tali sepatu)', 'katalog/f7fe29ff-b869-4d93-b7c8-eb9b277daba0.jpg', '[\"katalog\\/1fb4fe75-8295-4879-a354-921fe74e5267.jpg\",\"katalog\\/86b4ce4d-abe7-4c82-8786-3dc37f62a949.jpg\",\"katalog\\/5fac9927-919a-42fd-83c5-9abf4d6c25b2.jpg\"]', '2026-06-18 04:36:01', '2026-07-16 08:31:16'),
(35, '035-DS', NULL, 'Sepatu Olahraga/Running Camouflage Blue', NULL, 'sepatu', 'sudah_diperbaiki', '41', NULL, 700, 85, 'tersedia', NULL, 'katalog/c0c6483a-b789-494c-a2a6-d11f17a435cc.jpg', '[\"katalog\\/0c6fb93b-fc4d-4a60-9573-8e5ba7a1aba7.jpg\",\"katalog\\/c17d7bf4-1f41-4cd9-b83c-888389edd3f3.jpg\",\"katalog\\/4e5546d3-1feb-462d-9b28-489176643e2b.jpg\"]', '2026-06-19 01:13:31', '2026-07-16 08:32:36'),
(36, '036-DS', NULL, 'Sepatu Sneakers Kasual Suede Low-Top Cream/Grey', NULL, 'sepatu', 'sudah_diperbaiki', '41', NULL, 650, 65, 'tersedia', NULL, 'katalog/8b324f50-cf72-47d4-b114-47224b271686.jpg', '[\"katalog\\/5be3d82f-236a-4451-b591-8a25cdf55837.jpg\",\"katalog\\/948d5b86-26c6-45fd-a3bb-991788b8d87a.jpg\",\"katalog\\/0d04e7e5-4dfc-4ae9-8460-cdbe64f82d3d.jpg\"]', '2026-06-19 01:14:56', '2026-07-16 08:36:05'),
(37, '037-DS', NULL, 'Sepatu Lari Flyknit Blue Orange', 'Nike', 'sepatu', 'sudah_diperbaiki', '40', NULL, 400, 80, 'tersedia', NULL, 'katalog/fc450e50-ac93-4d3d-be1c-7e2c9550a270.jpg', '[\"katalog\\/bb50247e-860f-41e6-8548-00d33f3329af.jpg\",\"katalog\\/1d5ed93b-c2a6-4232-ba6d-8a57c4aec6a1.jpg\",\"katalog\\/86c0d212-94ca-471a-8b0f-7e9bf5bc3d52.jpg\"]', '2026-06-19 01:16:59', '2026-07-16 08:33:34'),
(38, '038-DS', NULL, 'Sepatu Boots Kulit Mid-Cut Black Moccasin Toe', NULL, 'sepatu', 'sudah_diperbaiki', '43', NULL, 950, 80, 'tersedia', NULL, 'katalog/6a0a5599-c54c-40c2-8e81-ee075973f367.jpg', '[\"katalog\\/373752d9-ecfc-49b2-885e-cc3be3267ee1.jpg\",\"katalog\\/575169c4-3550-437b-9afe-1d33512541ce.jpg\",\"katalog\\/9e458b80-6c7e-4f68-80b1-ded08b81994e.jpg\"]', '2026-06-19 01:18:16', '2026-07-16 08:34:43'),
(39, '039-DS', NULL, 'Sepatu Sneakers New Balance 574 Dark Grey/Black Leather', 'New Balance', 'sepatu', 'sudah_diperbaiki', '41', NULL, 750, 85, 'tersedia', NULL, 'katalog/bdf53592-9261-4a42-b49f-eca631b55f82.jpg', '[\"katalog\\/e121fbb2-4c83-4bd3-81c1-1345a7e85485.jpg\",\"katalog\\/00b9c4eb-5304-4e2d-b74e-fe644da9ea80.jpg\",\"katalog\\/30f174a8-93b1-490f-b37c-959c6cc4ead3.jpg\"]', '2026-06-19 01:20:14', '2026-07-16 08:35:43'),
(40, '040-DS', NULL, 'Sepatu Running Knit Beige / Light Pink', NULL, 'sepatu', 'sudah_diperbaiki', '37', NULL, 550, 85, 'tersedia', NULL, 'katalog/af764707-6933-4702-82f8-106ebb16ed47.jpg', '[\"katalog\\/b3477856-a59b-4764-a74c-befd8850c680.jpg\",\"katalog\\/1e9a3917-6844-46d5-b88b-784618e94000.jpg\",\"katalog\\/00b4423a-d153-431e-b9e5-8ac8cfb5a1a1.jpg\"]', '2026-06-19 01:21:50', '2026-07-16 08:36:48'),
(41, '041-DS', NULL, 'Sepatu Sneakers New Balance 878 Grey White Black', 'New Balance', 'sepatu', 'sudah_diperbaiki', '42', NULL, 800, 70, 'tersedia', NULL, 'katalog/1446abd5-6090-41da-a17a-d05518557ef6.jpg', '[\"katalog\\/86a8e6d0-b0ac-4a05-86bf-f2fef353762a.jpg\",\"katalog\\/bcc7f874-2449-416c-895c-1f5aa4a3269d.jpg\",\"katalog\\/6b435a92-cc75-40de-8c46-f1d5c53f4b00.jpg\"]', '2026-06-20 01:06:05', '2026-07-16 08:38:29');
INSERT INTO `donation_items` (`id`, `kode_barang`, `donation_id`, `nama`, `brand`, `kategori`, `kondisi`, `ukuran`, `warna`, `berat`, `score_kelayakan`, `status`, `deskripsi`, `foto_utama_path`, `foto_detail`, `created_at`, `updated_at`) VALUES
(42, '042-DS', NULL, 'Sepatu Sneakers Adidas Gazelle Blue Suede', 'Adidas', 'sepatu', 'sudah_diperbaiki', '38', NULL, 700, 75, 'tersedia', NULL, 'katalog/19d40349-5dec-4a6a-a2f4-80ac0ccb4b26.jpg', '[\"katalog\\/8d90a344-3228-4a41-b815-2b092df0885a.jpg\",\"katalog\\/4ea03f34-80ac-4a75-b191-6420716350c1.jpg\",\"katalog\\/5bafbd80-3db0-41c3-af82-60e5d065e647.jpg\"]', '2026-06-20 01:07:58', '2026-07-16 08:39:19'),
(43, '043-DS', NULL, 'Sepatu Sneakers Converse Pro Leather Mid Navy Blue Gold', 'Convers', 'sepatu', 'sudah_diperbaiki', '40', NULL, 850, 78, 'tersedia', NULL, 'katalog/11a00ecf-6840-49da-be51-1e0c3d7e10a1.jpg', '[\"katalog\\/e82bb182-375e-4224-a95b-018d6897b73a.jpg\",\"katalog\\/aeaadf25-c39b-4bc9-8d9a-3112e342f286.jpg\",\"katalog\\/85b673ac-f4b5-427a-b66b-22947a6c30b3.jpg\"]', '2026-06-20 01:10:09', '2026-07-16 08:42:23'),
(45, '045-DS', NULL, 'Sepatu Sneakers Adidas Retro Running Red White', 'Adidas', 'sepatu', 'sudah_diperbaiki', '42', NULL, 650, 75, 'tersedia', NULL, 'katalog/6277881a-7813-42d0-8f94-76f3826f48a6.jpg', '[\"katalog\\/c4a95974-0199-4826-8674-186facf42979.jpg\",\"katalog\\/7a8fe579-8875-4ed5-9162-ea3ca0bd9dae.jpg\",\"katalog\\/5f530c8b-2540-4127-9ca6-9418d479c8c2.jpg\"]', '2026-06-20 01:13:35', '2026-07-16 08:43:49'),
(46, '046-DS', NULL, 'Sneaker Classic Nike Shox Ride', 'Nike', 'sepatu', 'sudah_diperbaiki', '42', NULL, NULL, 95, 'tersedia', 'Sepatu Nike unisex ukuran 42 berbahan kanvas ini dalam kondisi refurbished dengan bagian upper yang bersih tanpa noda. Meskipun jahitan dan lem sudah diperbaiki, bagian insole dan interior sudah mulai menipis serta tali sepatu sudah rusak. Kelengkapan produk adalah sepasang lengkap, namun sangat disarankan untuk melakukan ganti sol menjadi cupsole dengan estimasi biaya sekitar Rp250.000 agar kembali optimal.', 'katalog/6df1173a-ad0c-42a6-8587-923946a3607c.jpg', '[\"katalog\\/3cf4ffa8-c33c-4063-9bab-b3f44984c829.jpg\",\"katalog\\/40ae107d-399f-4af4-aad0-de90606393d0.jpg\",\"katalog\\/83c5c064-cff0-4154-9ff4-774ecf7705da.jpg\"]', '2026-07-16 09:12:18', '2026-07-16 12:57:23'),
(47, '047-DS', NULL, 'Balenciaga Tripel S', 'Balenciaga', 'sepatu', 'sudah_diperbaiki', '38', 'Whitw and Cream', NULL, 91, 'tersedia', 'Sepatu wanita/pria merek Balenciaga ukuran 38 dengan bahan upper kanvas berwarna netral. Kondisi barang telah melalui refurbishment, termasuk perbaikan jahitan dan lemma, sehingga terlihat bersih dan utuh. Sol (outsole) tebal dengan grip yang masih baik, cocok untuk penggunaan sehari-hari. Namun, memerlukan perbaikan lem jahit (Rp210.000) dan lapis kulit keliling (Rp125.000) untuk memastikan kelangsgaran penggunaan. Tidak ada kelengkapan tambahan disertai.', 'katalog/dc32e468-2139-4d22-85df-03ffb87e477b.jpg', '[\"katalog\\/940ae3f8-6ff0-4a3b-9d90-871a213efea2.jpg\",\"katalog\\/18aa74b2-dbe3-49ed-aba7-a6554a8b1375.jpg\",\"katalog\\/255d3746-00c1-4510-9869-7edc40e474d8.jpg\"]', '2026-07-16 13:04:08', '2026-07-16 13:04:08'),
(48, '048-DS', NULL, 'Balenciaga Speed Runners', 'Balenciaga', 'sepatu', 'sudah_diperbaiki', '39', 'Hitam', NULL, 93, 'tersedia', 'Balenciaga Speed Runners ukuran 39 warna hitam dari merek Balenciaga ini terbuat dari kain canvas dengan desain unisex. Kondisi umum refurbished, dengan sol tebal dan grip yang masih baik, serta upper bersih tanpa noda. Meskipun jahitan dan lem sudah diperbaiki, rekomendasi perlu memperbaiki lem jahit dengan biaya Rp 210.000 untuk hasil lebih optimal. Barang ini siap digunakan dengan perbaikan yang perlu dilakukan.', 'katalog/7cfa4c72-b4bd-46e2-884f-03b0c69afe6e.jpg', '[\"katalog\\/6f610b24-ea59-42fe-9110-3c223c6ee4a8.jpg\",\"katalog\\/bfc99338-e7b5-479b-bedc-f5ca35b4cae6.jpg\",\"katalog\\/d64e630d-e4fd-481c-8dd7-f309d77ebbcb.jpg\"]', '2026-07-16 13:08:24', '2026-07-16 13:08:24'),
(49, '049-DS', NULL, 'Sepatu Pantofel', NULL, 'sepatu', 'sudah_diperbaiki', '45', NULL, NULL, 90, 'tersedia', 'Sepatu pantofel pria ukuran 45 dari kulit asli ini berstatus refurbished dengan upper yang masih utuh serta jahitan dan lem yang sudah diperbaiki. Sol sebelumnya sudah pernah diganti (resole), namun saat ini direkomendasikan untuk mengganti sol penuh (cupsole) agar lebih kuat dan nyaman dipakai jangka panjang. Perbaikan sol jadi ini diperkirakan memerlukan biaya sekitar Rp 250.000. Barang dikirimkan tanpa kelengkapan kotak atau dustbag asli. Cocok bagi Anda yang mencari sepatu formal berkualitas dengan potensi upgrade sol yang terjangkau.', 'katalog/79313359-561d-40bd-a980-44b018383363.jpg', '[\"katalog\\/290759c5-60e2-4f9c-b199-9ae1518cc74a.jpg\",\"katalog\\/90eef9eb-59dc-4589-998f-64dc9cdaa218.jpg\",\"katalog\\/30042e7e-65fc-48fc-bf8d-b03e497d81ee.jpg\"]', '2026-07-16 13:15:58', '2026-07-17 07:19:18'),
(50, '050-DS', NULL, 'Sneakers', NULL, 'sepatu', 'sudah_diperbaiki', '44', NULL, NULL, 75, 'tersedia', 'Sneakers ini merupakan barang bekas yang telah diperbarui (refurbished) dengan ukuran 44 dan bahan upper berupa kanvas. Sol (outsole) sudah diganti baru, sementara jahitan dan lem di bagian upper telah diperbaiki kembali. Warna, merek, serta kategori gender tidak diketahui karena informasi tersebut tidak tersedia. Barang ini tidak dilengkapi dengan kelengkapan tambahan seperti kotak atau label asli. Untuk menjaga kualitasnya, disarankan mengganti sol menjadi cupsole dengan biaya sekitar Rp250.000 yang perlu dilakukan.', 'katalog/cf8e7cbd-0128-49f3-8eb0-c0720344d1bf.jpg', '[\"katalog\\/13ae95af-27d1-4b8a-bf1b-a71cc7e72aae.jpg\",\"katalog\\/10672a29-0fb0-4434-85b6-b2a22ba86ecb.jpg\",\"katalog\\/90ec91ab-2977-41c0-91be-f1594e38fd85.jpg\"]', '2026-07-16 13:19:24', '2026-07-17 07:18:01'),
(51, '051-DS', NULL, 'Chiara Ferragni', NULL, 'sepatu', 'sudah_diperbaiki', '36', NULL, NULL, 79, 'tersedia', 'Sepatu Chiara Ferragni ini merupakan produk refurbished dengan ukuran 36, dirancang khusus untuk wanita. Upper menggunakan bahan kulit sintetis yang kondisinya umum, sementara warna tidak tersedia. Sepatu ini tidak dilengkapi dengan aksesori tambahan, namun memerlukan perbaikan wajib berupa Repaint Spesial Bahan Spesial seharga Rp 245.000 untuk memperbaiki tampilan agar kembali segar. Kondisi sol, jahitan, insole, dan interior belum diketahui secara detail, tetapi sepatu ini siap didonasikan setelah proses refurbishment.', 'katalog/d03c8c62-92e8-4434-a5ce-df4953998490.jpg', '[\"katalog\\/78307d26-4239-4882-9cfa-0189858cda98.jpg\",\"katalog\\/85285b33-8833-4315-9039-02156bcafe94.jpg\",\"katalog\\/8d29cc94-6608-4df8-a261-368c9fc6fa0c.jpg\"]', '2026-07-16 13:21:22', '2026-07-17 07:16:46'),
(52, '052-DS', NULL, 'Onitsuka Tiger', NULL, 'sepatu', 'sudah_diperbaiki', NULL, '41', NULL, NULL, 'tersedia', 'Onitsuka Tiger sepatu ukuran 41 dengan upper kulit sintetis, kondisi umum refurbished. Outsole tebal dan grip masih bagus, sementara upper telah dijahit ulang/dilem. Barang ini memerlukan perbaikan wajib, yaitu penggantian upper pola sedang (Quarter‑M) sebesar Rp225.000 dan pembongkaran sole sebesar Rp125.000. Sepatu tidak disertai dengan kelengkapan apa pun.', 'katalog/14bd66d2-c96a-4629-80f2-c22692e3325d.jpg', '[\"katalog\\/0f94de22-9260-49c1-a039-7f4ff109e44c.jpg\",\"katalog\\/ef3b9509-84c3-42ed-a56e-32bb35ff5c21.jpg\",\"katalog\\/1e86fb34-0872-4882-9047-1beb47dbdf30.jpg\"]', '2026-07-16 13:24:28', '2026-07-17 07:15:23'),
(53, '053-DS', NULL, 'Sepatu Kulit', 'Obermain', 'sepatu', 'sudah_diperbaiki', '43', NULL, NULL, 87, 'disalurkan', 'Sepatu Kulit merek Obermain ini ukuran 43 menggunakan bahan upper kulit asli berkualitas, kondisi refurbished dengan sol (outsole) yang masih tebal dan grip bagus. Sepatu ini telah melalui proses perbaikan pada jahitan dan lem, namun masih memerlukan jasa tambahan seperti Lem Press (Rp210.000) dan Repaint Standard (Rp170.000) agar kembali seperti semula. Interior serta tali dan aksesoris tidak dilengkapi, sehingga cocok bagi yang ingin merawat atau memodifikasinya kembali.', 'katalog/18d27aeb-306a-41f8-a086-45e2db07c548.jpg', '[\"katalog\\/22d5ac3d-d13b-4ac6-a300-38ba6e1a5be0.jpg\",\"katalog\\/f01f719b-21a5-4f25-888b-b03c4ae8c253.jpg\",\"katalog\\/598a106e-6c36-4dc4-a262-7d00e4489e9c.jpg\"]', '2026-07-16 13:26:25', '2026-08-03 07:45:14'),
(54, '054-DS', NULL, 'Puma X Ferarri', 'Puma', 'sepatu', 'sudah_diperbaiki', '44', 'Merah', NULL, 44, 'tersedia', 'Sepatu Puma X Ferarri ini memiliki ukuran 44, warna merah, dan bahan upper berupa kulit sintetis. Barang ini dikategorikan sebagai refurbished, dengan kondisi umum yang sudah melalui proses perawatan. Sol (outsole) mulai tipis atau aus di bagian tertentu, seperti tumit, serta warna upper mulai pudar. Jahitan dan lem telah diperbaiki ulang, tetapi latex pada upper menelupas. Untuk memperpanjang umur pemakaian, disarankan melakukan perbaikan lem jahit dengan biaya sekitar Rp 210.000.', 'katalog/fddae028-9126-4dc9-a2c5-4ab2ab9e3dbd.jpg', '[\"katalog\\/6bcb9d6f-a509-42c1-aa32-fdd022de8b4a.jpg\",\"katalog\\/7402db27-20c6-47fc-bed4-ed945eec2461.jpg\",\"katalog\\/a9719081-bffa-43bc-ad9d-6e4a25fe299c.jpg\"]', '2026-07-16 13:30:14', '2026-07-16 13:30:14'),
(55, '055-DS', NULL, 'Sepatu Running', NULL, 'sepatu', 'sudah_diperbaiki', '45', 'Abu', NULL, 94, 'tersedia', 'Sepatu donasi dengan bahan upper kanvas, tersedia ukuran dan warna sesuai pilihan. Kondisinya refurbished dengan sol (outsole) sudah diganti baru, upper bersih tanpa noda, serta jahitan dan lem telah diperbaiki. Bagian interior dan tali/aksesoris tidak meliputi kelengkapan tambahan. Perlu diperhatikan bahwa barang memerlukan perbaikan midsole non flat (Rp 355.000), lapis kulit keliling (Rp 125.000), dan ganti alas polos (Rp 225.000) sesuai rekomendasi.', 'katalog/a04b9456-ad5f-4006-8a0a-c6d47edff8c3.jpg', '[\"katalog\\/cfdc6746-ec26-49dc-a2a7-f748f7300ab2.jpg\",\"katalog\\/64575d1a-09c6-4da8-a1e8-a6aebc0aa623.jpg\",\"katalog\\/44f20925-e40c-4987-a1d1-ec86d1feeeab.jpg\"]', '2026-07-16 13:35:09', '2026-07-16 13:35:09'),
(56, '056-DS', NULL, 'On Cloudmonster Black Magnet', 'On Cloud', 'sepatu', 'sudah_diperbaiki', '44', 'Hitam', NULL, 95, 'tersedia', 'Sepatu On Cloudmonster Black Magnet ukuran 44 dengan bahan upper mesh berwarna hitam, cocok untuk pria. Barang berada dalam kondisi refurbished, sol tebal dengan grip masih bagus, upper bersih tanpa noda, dan sudah direparasi pada jahitan serta lem. Perbaikan tambahan yang wajib dilakukan adalah lem press seharga Rp210.000 untuk memastikan daya tahan lama. Setelah perbaikan ini, sepatu siap pakai dan tidak dilengkapi dengan aksesoris tambahan.', 'katalog/653de204-cfed-4494-955b-db3db1772718.jpg', '[\"katalog\\/e128e5cd-84c0-4e55-991b-0f85e936fccd.jpg\",\"katalog\\/e5ed4601-cd7a-469e-b598-e7b425be1cc4.jpg\",\"katalog\\/f766e41d-cad4-4056-bfdb-49a8fb25036f.jpg\"]', '2026-07-16 13:40:11', '2026-07-16 13:40:11'),
(57, '057-DS', NULL, 'Sneakers', 'Everbest', 'sepatu', 'sudah_diperbaiki', '39', NULL, NULL, 83, 'tersedia', 'Sneakers merk Everbest ukuran 39 dengan upper kain dan kondisi refurbished, telah melalui perbaikan sol yang diganti baru (reglue/resole) serta jahitan dan lem yang diperbaiki. Barang ini memerlukan reparasi tambahan: penggantian sol menjadi cupsole (Rp 250.000) dan penambahan lapis kulit keliling (Rp 125.000) untuk memastikan kualitas dan keamanan. Tidak ada aksesoris atau kelengkapan yang disertai.', 'katalog/a02a1682-f406-4bda-bce2-dc8b41e62733.jpg', '[\"katalog\\/780ed5ab-fce2-4fda-a712-16d2ed932f57.jpg\",\"katalog\\/8e2c9a9a-a167-4397-a427-ba23f3d69ca1.jpg\",\"katalog\\/eef6c04a-25cc-4357-bfde-0370e4c55af8.jpg\"]', '2026-07-16 13:42:42', '2026-07-17 07:11:12'),
(58, '058-DS', NULL, 'Sepatu Kulit', NULL, 'sepatu', 'sudah_diperbaiki', '42', 'Coklat', NULL, 81, 'tersedia', 'Sepatu Kulit ukuran 42 berwarna coklat terbuat dari kulit asli, dalam kondisi refurbished. Sol sepatu sudah diganti baru, upper bersih tanpa noda, jahitan dan lem telah diperbaiki. Barang ini tidak disertakan dengan kelengkapan apa pun dan masih memerlukan pengganti sol menjadi cupsole (biaya Rp250.000) serta repaint standar (biaya Rp170.000) sebelum siap digunakan.', 'katalog/daf25cb4-1163-482e-a8ed-9609f1de2dfe.jpg', '[\"katalog\\/1c833e5e-c58a-431d-9ba9-1e592791a3d4.jpg\",\"katalog\\/14044296-9b65-4a20-9ce9-9403d051de37.jpg\",\"katalog\\/8ac08c82-36d5-400c-9b18-2d9eca40d483.jpg\"]', '2026-07-16 13:44:17', '2026-07-17 07:08:04'),
(59, '059-DS', NULL, 'Sepatu Outdoor', 'The North Face', 'sepatu', 'sudah_diperbaiki', '40', NULL, NULL, 90, 'tersedia', 'Sepatu Outdoor dari The North Face ini berukuran 40 dengan kondisi Refurbished, cocok untuk aktivitas luar ruangan. Sol (outsole) masih tebal dan memiliki grip yang bagus, sementara bagian upper dan insole/interior tidak disebutkan kondisinya. Jahitan dan lem telah diperbaiki (reparasi) untuk meningkatkan ketahanan, tetapi tidak ada kelengkapan tambahan yang disertakan. Barang ini memerlukan perbaikan tambahan berupa Lem Jahit seharga Rp 210.000 yang wajib dilakukan agar kualitasnya tetap terjaga.', 'katalog/880cab0a-7229-49c6-8009-4698a3d40d78.jpg', '[\"katalog\\/889f027b-4416-4f5b-8704-62be1915cb52.jpg\",\"katalog\\/67285f99-f9f3-435a-b138-5d7637aeae15.jpg\",\"katalog\\/792491a6-028d-4841-91d8-363c040c8771.jpg\"]', '2026-07-16 13:47:10', '2026-07-17 07:39:40'),
(60, '060-DS', NULL, 'NIke Air Max 720', 'Nike', 'sepatu', 'sudah_diperbaiki', '44', 'Putih', NULL, 71, 'tersedia', 'Donasi sepatu Nike Air Max 720 ukuran 44 warna putih dengan bahan upper kanvas, kategori unisex dan dalam kondisi refurbished. Sepatu ini sudah melalui reparasi jahitan dan lem pada bagian upper yang masih bersih tanpa noda, namun sol mulai tipis dan aus di area tumit serta tidak menyertakan kelengkapan tambahan. Barang ini wajib diperbaiki dengan layanan midsole non flat (Rp 355.000) dan lapis kulit depan/belakang (Rp 75.000) agar kembali layak pakai secara maksimal.', 'katalog/98210b54-4457-47a8-931a-7d35f4e3b01b.jpg', '[\"katalog\\/408965b8-3525-47e8-b19b-27cbe61187e0.jpg\",\"katalog\\/6df71864-ec2f-4e9a-874c-4c14364b54dd.jpg\",\"katalog\\/dfd3bacd-226a-417b-99ac-6c5021925bce.jpg\"]', '2026-07-16 13:51:16', '2026-07-16 13:51:16'),
(61, '061-DS', NULL, 'Balenciaga Speed Runners', 'Balenciaga', 'sepatu', 'sudah_diperbaiki', '39', NULL, NULL, 95, 'tersedia', 'Balenciaga Speed Runners ukuran 39 dengan bahan upper kanvas, kini dalam kondisi refurbished. Sol tebalnya masih memiliki grip yang baik, sementara bagian atas dan interior terlihat bersih, tetapi jahitan sudah diperbaiki ulang. Untuk memastikan kestabilan, barang ini membutuhkan perbaikan lem jahit seharga Rp210.000, yang wajib dilakukan. Dengan perbaikan tersebut, sepatu dapat kembali dipakai dengan kualitas optimal.', 'katalog/bdbbf89d-80af-4303-bd7d-45a55f8ba66e.jpg', '[\"katalog\\/ca95c2ee-14fc-4b3e-8635-4d11ec089b01.jpg\",\"katalog\\/b1a0493c-cffb-466c-bfcb-7bce047ee199.jpg\",\"katalog\\/719f5ed0-28e8-4915-984f-f233c141f1c5.jpg\"]', '2026-07-16 13:53:40', '2026-07-17 06:35:27'),
(62, '062-DS', NULL, 'Flat Shoes', 'Kickers', 'sepatu', 'sudah_diperbaiki', '40', NULL, NULL, 83, 'tersedia', 'Sepatu flat merek Kickers ukuran 40 ini adalah sepatu pria berbahan kulit asli yang kini dalam kondisi refurbished. Bagian upper mengalami sedikit pudar, sol mulai tipis di area tumit dan menguning, sementara jahitan dan lemnya telah diperbaiki. Insole dan aksesoris seperti tali tidak disertakan. Namun, sepatu ini masih memerlukan reparasi wajib berupa lem jahit senilai Rp210.000 untuk memastikan kenyamanan pemakaian.', 'katalog/0b155e97-c190-4e1e-9b2d-49ac3120014a.jpg', '[\"katalog\\/8b40d55b-fab7-477c-ae21-d6c09993d3c6.jpg\",\"katalog\\/2e86cf97-098b-4cab-b376-1ddfb61b5000.jpg\",\"katalog\\/e27d0363-44cb-436f-832d-77ec05b2c7d6.jpg\"]', '2026-07-16 13:58:40', '2026-07-16 13:58:40'),
(63, '063-DS', NULL, 'Nike CTR 360', 'Nike', 'sepatu', 'sudah_diperbaiki', '42', 'Orange', NULL, 71, 'tersedia', 'Sepatu pria merek Nike berukuran 42 dengan warna oranye dan bahan upper kulit sintetis dalam kondisi refurbished. Sol (outsole) tebal dengan grip masih baik, sementara upper sudah dijahit ulang dan dilem untuk perbaikan. Namun, catatan tambahan menunjukkan latex mengelupas, sehingga memerlukan perbaikan lem Jahit sebesar Rp 210.000 sebagai langkah wajib agar kondisinya dapat lebih stabil. Tidak ada kelengkapan tambahan yang disertakan pada barang ini.', 'katalog/1f567935-890f-4bb0-b151-a9f0b2b2f2f7.jpg', '[\"katalog\\/dafba90d-cfd0-4e54-ab1d-06f5b5581b2a.jpg\",\"katalog\\/c9b73561-d010-46cb-8c31-8b684829f52f.jpg\",\"katalog\\/8ae5e4d8-f880-46f7-b1fa-18c57887b0f1.jpg\"]', '2026-07-16 14:01:52', '2026-07-16 14:01:52'),
(64, '064-DS', NULL, 'Sepatu Outdoor', NULL, 'sepatu', 'sudah_diperbaiki', '45', NULL, NULL, 82, 'tersedia', 'Sepatu outdoor ukuran 45 ini berbahan kulit asli dan dalam kondisi refurbished, dengan sol luar yang sudah diganti baru serta jahitan dan lem yang telah diperbaiki ulang. Barang tidak menyertakan kelengkapan tambahan dan hanya tersedia unit sepatu saja. Sepatu ini masih perlu dilakukan ganti sol potong (Rp 300.000) dan repaint spesial (Rp 195.000) sebagai perbaikan wajib sebelum digunakan.', 'katalog/6b26c450-8c08-4c9b-bd54-ddb2c5b2d5ef.jpg', '[\"katalog\\/9a82ca25-4991-451b-bf1b-0f637bdd4850.jpg\",\"katalog\\/3cfdd016-f53c-4359-8302-4fd98d22599f.jpg\",\"katalog\\/000a59e2-8165-4857-9ab5-44e4c0e07873.jpg\"]', '2026-07-16 14:03:51', '2026-07-17 06:32:12'),
(65, '065-DS', NULL, 'Skechers Street Arcadia', 'Skechers', 'sepatu', 'sudah_diperbaiki', '39', 'Pink', NULL, 85, 'tersedia', 'Sepatu Skechers ukuran 39 berwarna pink dengan bahan upper kulit sintetis. Kondisi umum refurbished, sol outsole retak, upper memiliki noda ringan yang bisa dibersihkan, serta jahitan sudah diperbaiki. Perbaikan lem jahit diperlukan dengan biaya Rp 210.000 (wajib) dan penggantian sol Foxing dengan biaya Rp 225.000 (opsional).', 'katalog/8e0a99e5-a55f-4ab5-b977-10ceeafd2bee.jpg', '[\"katalog\\/5e4e1153-4be0-45ef-b4ce-8eb205f8ff8b.jpg\",\"katalog\\/27450140-1b34-4a6c-9190-5b47d7ae75f4.jpg\",\"katalog\\/d60a5676-f1b5-46ee-802f-91b974b05e16.jpg\"]', '2026-07-16 14:09:49', '2026-07-16 14:09:49'),
(66, '066-DS', NULL, 'Adidas', NULL, 'sepatu', 'sudah_diperbaiki', '44', NULL, NULL, 85, 'tersedia', 'Sepatu Adidas ukuran 44 terbuat dari bahan kanvas, dalam kondisi refurbished. Sol sudah diganti baru (reglue/resole) dan jahitan serta lem telah diperbaiki, namun tidak ada kelengkapan seperti tali. Untuk memastikan performa yang optimal, disarankan mengganti sol menjadi cupsole seharga Rp250.000 dan melapis kulit keliling seharga Rp125.000. Dengan perbaikan tersebut, sepatu ini akan siap dipakai kembali.', 'katalog/53ea21ac-8976-41b2-baf6-b0bd3cf9a7b2.jpg', '[\"katalog\\/a50e12f2-b5bd-4955-9a07-fb8d21c8785e.jpg\",\"katalog\\/cd678ccf-087a-460b-a64d-1badfdeb3de8.jpg\",\"katalog\\/d5c184ad-8199-4f42-95e6-1ab433dab375.jpg\"]', '2026-07-16 14:11:43', '2026-07-17 06:28:55'),
(67, '067-DS', NULL, 'Sepatu Hak', NULL, 'sepatu', 'sudah_diperbaiki', '39', NULL, NULL, 81, 'tersedia', 'Sepatu Hak wanita ukuran 39 ini terbuat dari kulit sintetis dan telah melalui proses restorasi. Sol bawahnya telah diganti baru, bagian atas bersih tanpa noda, dan jahitan serta lem diperbaiki ulang. Midsole tidak rata sehingga perlu perbaikan dengan biaya sekitar Rp 355.000. Cocok untuk yang mencari sepatu hak refurbished siap pakai dengan sedikit sentuhan akhir.', 'katalog/749f5932-90b9-4f0f-8e82-93f788f273a1.jpg', '[\"katalog\\/151a262e-de3d-411b-890c-e266430c006f.jpg\",\"katalog\\/f15854b6-c57b-4140-8408-1869b5d62c74.jpg\",\"katalog\\/d77dba9d-1bc6-4637-b54f-eb2d5a64ee2a.jpg\"]', '2026-07-16 14:15:40', '2026-07-16 14:15:40'),
(68, '068-DT', NULL, 'Tas Wanita', NULL, 'tas', 'sudah_diperbaiki', NULL, NULL, NULL, 89, 'tersedia', NULL, 'katalog/b18a23ad-454c-4e4f-9a02-8f5bb2474196.jpg', '[\"katalog\\/1f48e6e1-ea4c-4482-bc58-fec6fba16238.jpg\",\"katalog\\/fca03d4f-fd99-484f-8f1c-ab0c415318b8.jpg\",\"katalog\\/09cef5a6-af84-4c90-be1f-855f15243ce6.jpg\"]', '2026-07-16 14:17:53', '2026-07-18 03:27:52'),
(69, '069-DS', NULL, 'nike', 'Nike', 'sepatu', 'sudah_diperbaiki', '39', NULL, NULL, 86, 'tersedia', 'Sepatu Nike ukuran 39 dengan bahan upper kulit sintetis ini dalam kondisi *refurbished*. Seluruh bagian jahitan dan lem sudah diperbaiki ulang, serta bagian sol (*outsole*) juga sudah diganti dengan yang baru. Perlu diketahui bahwa sepatu ini tidak memiliki kelengkapan tambahan. Untuk penggunaan optimal, diperlukan perbaikan pada bagian *midsole non-flat* dengan estimasi biaya sekitar Rp355.000.', 'katalog/24eff432-97a7-4b31-935d-431c671d5140.jpg', '[\"katalog\\/b8ddee60-4c53-4fd1-a066-fe1236632314.jpg\",\"katalog\\/299e8501-72c7-46b1-a668-2ef0da9e631b.jpg\",\"katalog\\/50a00caa-f13d-4ab0-9dab-71ade627ba0e.jpg\"]', '2026-07-16 14:19:51', '2026-07-17 06:26:45'),
(70, '070-DS', NULL, 'Sendal', 'Caterpilar', 'sepatu', 'sudah_diperbaiki', '42', NULL, NULL, 86, 'tersedia', 'Sendal pria merek Caterpilar ukuran 42 dengan upper bahan kulit asli. Kondisinya refurbished dengan sol tebal dan grip masih baik, serta jahitan sudah dijahit ulang. Perlu perbaikan lem jahit dengan biaya Rp 210.000 untuk memastikan kekuatan dan kenyamanan. Tidak ada kelengkapan tambahan, namun tetap dapat dipakai dengan baik setelah reparasi.', 'katalog/9c7b10a5-eccb-43a7-9800-3b2e95b1e513.jpg', '[\"katalog\\/3f5423a2-678d-44fa-b4af-e5d80497c85b.jpg\",\"katalog\\/0241937a-47f9-4b02-8afb-927f5d282780.jpg\",\"katalog\\/cce137ea-d175-41c0-8592-5997d5c91b8f.jpg\"]', '2026-07-16 14:20:45', '2026-07-17 06:22:37'),
(71, '071-DT', NULL, 'Tas Wanita', NULL, 'tas', 'sudah_diperbaiki', NULL, 'Hitam', NULL, 89, 'tersedia', NULL, 'katalog/7dbf4b6e-ce00-483f-8b39-d039fe20e991.jpg', '[\"katalog\\/6adad915-38e9-4cb9-82c9-50f10d8e30ec.jpg\",\"katalog\\/622b14ab-ef1d-421e-bd9f-8eefa970d3b0.jpg\",\"katalog\\/34e4a337-45de-4e21-be84-391b67b6983a.jpg\"]', '2026-07-17 01:12:23', '2026-07-18 03:27:18'),
(72, '072-DS', NULL, 'Adidas Gazelle', 'Adidas', 'sepatu', 'sudah_diperbaiki', '43', 'Hitam', NULL, 89, 'tersedia', 'Sepatu wanita/pria Adidas Gazelle ukuran 43 warna hitam dengan bahan upper kulit sintetis dalam kondisi refurbished. Sol telah diganti baru (reglue/resole), sementara upper sudah dijahit ulang dan dilem perbaiki. Tidak ada kelengkapan tambahan seperti tali atau aksesori. Untuk kondisi optimal, disarankan mengganti sol menjadi cupsole dengan biaya Rp 250.000 (wajib dilakukan). Kondisi fisik masih dapat dipakai dengan baik meski memerlukan perbaikan tambahan.', 'katalog/e126fba3-b427-4e64-a1b4-18fe5df3cd29.jpg', '[\"katalog\\/925d029a-36fe-43ef-b226-23c4773fc763.jpg\",\"katalog\\/e936f585-e565-403c-9aa4-1578c77711d3.jpg\",\"katalog\\/702e62f0-b746-47a9-a85c-fb5cad88fddd.jpg\"]', '2026-07-17 01:16:03', '2026-07-17 01:16:03'),
(73, '073-DS', NULL, 'Adidas NMD R1', 'Adidas', 'sepatu', 'sudah_diperbaiki', '43', NULL, NULL, 95, 'tersedia', 'Sepatu Adidas NMD R1 ukuran 40 ini adalah sepatu rekondisi dengan upper mesh dan sol tebal yang masih memiliki grip bagus. Kondisi jahitan dan lem sudah diperbaiki, namun masih perlu perbaikan jahitan/gelim (Rp 210.000) untuk memastikan kenyamanan maksimal. Barang ini tidak dilengkapi aksesori tambahan. Cocok untuk donasi bagi yang membutuhkan sepatu stylish namun terjangkau.', 'katalog/c55689c9-ccee-4a6c-a3f5-d618feb39df9.jpg', '[\"katalog\\/e1fa8743-ba6a-4765-8c18-e2281a042c56.jpg\",\"katalog\\/7909ffa6-c101-4fe9-aebe-3d575f8a244f.jpg\",\"katalog\\/c174a373-482a-4e84-bbcb-fb2b6a34367e.jpg\"]', '2026-07-17 01:18:03', '2026-07-17 06:19:15'),
(74, '074-DS', NULL, 'Adidas EQT Support ADV', 'Adidas', 'sepatu', 'sudah_diperbaiki', '43', NULL, NULL, 87, 'tersedia', 'Ini adalah sepatu Adidas EQT Support ADV ukuran 43, merek Adidas, dengan bahan upper kulit sintetis dan kondisi refurbished. Sepatu ini memiliki sol tebal dengan grip yang masih bagus, meskipun jahitan dan lemnya telah diperbaiki dengan jemput ulang. Namun, rekomendasi wajib untuk meningkatkan kualitas dan kelengkapan adalah penggantian upper pola sedang (Quarter-M) dengan biaya Rp 225.000. Seperti yang disebut, kelengkapan aksesori tidak terkandung.', 'katalog/bb47306f-b8c2-47b2-b5b5-bdcf637212d3.jpg', '[\"katalog\\/918a40da-b451-4741-9606-224dbfb3b38b.jpg\",\"katalog\\/8591292f-ef66-4fcd-b76a-119507ae031d.jpg\",\"katalog\\/bd203fdd-c335-439a-8160-24737932270b.jpg\"]', '2026-07-17 01:20:07', '2026-07-17 06:14:28'),
(75, '075-DS', NULL, 'Prada', NULL, 'sepatu', 'sudah_diperbaiki', '44', NULL, NULL, 81, 'tersedia', 'Sepatu Prada ukuran 44 ini merupakan barang refurbished dengan sol (outsole) yang sudah diganti baru serta jahitan dan lem yang telah dijahit ulang dan direparasi. Barang tidak memiliki kelengkapan tambahan dan diberikan apa adanya sesuai kondisi fisik saat ini. Untuk penggunaan optimal, sepatu ini masih perlu perbaikan berupa ganti sol jadi (cupsole) sekitar Rp 250.000 dan lapis kulit keliling sekitar Rp 125.000 yang wajib dilakukan.', 'katalog/c21d9839-e878-45c1-94e3-d577dc521c90.jpg', '[\"katalog\\/b8de4123-385c-454e-be20-42c128fe2ba2.jpg\",\"katalog\\/307f33ca-598e-42d1-99ff-f1265602d6cc.jpg\",\"katalog\\/86913b3f-bd11-43cb-8bf5-9445e7811b03.jpg\"]', '2026-07-17 01:21:08', '2026-07-17 07:41:41'),
(76, '076-DS', NULL, 'Adidas Prophere', 'Adidas', 'sepatu', 'sudah_diperbaiki', '44', 'Army', NULL, 89, 'tersedia', 'Adidas Prophere ukuran 44, warna Army, dengan upper kanvas, ditujukan untuk pria dan berada dalam kondisi refurbished. Sol luar telah diganti baru (reglue/resole), upper bersih tanpa noda, serta jahitan dan lem telah diperbaiki ulang. Barang ini tidak dilengkapi dengan kotak atau aksesoris tambahan, dan detail insole, interior, tali serta aksesoris tidak disebutkan dalam data yang diberikan. Untuk memastikan kenyamanan maksimal, disarankan melakukan perbaikan midsole non flat dengan biaya sekitar Rp355.000.', 'katalog/92eef7b6-c99b-4ff6-9605-6619d0b04186.jpg', '[\"katalog\\/1f5e8eec-62a0-423b-94ce-d5eeea22f9cb.jpg\",\"katalog\\/ae712be3-229f-4121-93d1-ab4e9c8482c1.jpg\",\"katalog\\/58d92722-7c26-4048-ba35-29d5590ae344.jpg\"]', '2026-07-17 01:36:07', '2026-07-17 01:36:07'),
(77, '077-DS', NULL, 'Sepatu Bola', NULL, 'sepatu', 'sudah_diperbaiki', '41', NULL, NULL, 81, 'tersedia', NULL, 'katalog/accb5941-0232-4c59-a86d-443a9a64970a.jpg', '[\"katalog\\/1a0ef9c6-d025-4358-a6c2-e807585e1e19.jpg\",\"katalog\\/e8c4b5d4-c5db-47fb-8d38-77ba9376f740.jpg\",\"katalog\\/0b0cd0be-bbaa-4cbb-9958-ddb0250e3cca.jpg\"]', '2026-07-17 01:37:58', '2026-07-17 02:16:02'),
(78, '078-DS', NULL, 'Sandal Wanita Hak Tinggi', NULL, 'sepatu', 'sudah_diperbaiki', '38', NULL, NULL, 84, 'tersedia', 'Sandal Wanita Hak Tinggi ukuran 38 dengan bahan upper kulit sintetis, kondisi refurbished dan terawat. Sol outsole tebal dengan grip masih bagus, upper bersih tanpa noda, serta sudah melalui perbaikan jahitan dan dilem. Tidak terdapat aksesoris atau kelengkapan tambahan. Perbaikan yang wajib dilakukan adalah penggantian alas hak cewe dengan biaya sekitar Rp 75.000.', 'katalog/3c708912-7837-464f-98ee-8e379381f37b.jpg', '[\"katalog\\/3865d8cc-2d30-49f9-b8bf-759cad893794.jpg\",\"katalog\\/62109f95-2cbf-4f79-b08a-e65c50f9033d.jpg\",\"katalog\\/848ef2e2-a6c2-4934-9561-ca71d66ade3c.jpg\"]', '2026-07-17 01:40:40', '2026-07-17 01:40:40'),
(79, '079-DS', NULL, 'Nike', NULL, 'sepatu', 'sudah_diperbaiki', '43', NULL, NULL, 79, 'tersedia', 'Sepatu Nike ukuran 43 dengan upper berbahan kanvas berupa sepatu donasi dalam kondisi refurbished. Sol sudah diganti baru melalui proses reglue/resole, sementara jahitan dan lem telah dijahit ulang serta dilem. Tidak ada kelengkapan tambahan, namun sepatu ini memerlukan perbaikan ganti sol menjadi Cupsole dengan biaya Rp 250.000 untuk memastikan kelangsungan penggunaan.', 'katalog/c75c5550-2153-4c26-9790-1f4a8bd08d51.jpg', '[\"katalog\\/4dc12642-3448-4bdf-8924-c3c46cb9e22b.jpg\",\"katalog\\/78e1d680-29df-4536-a702-618192dba823.jpg\",\"katalog\\/45627a1e-f3b6-4dfc-bc99-f913a139c3c2.jpg\"]', '2026-07-17 01:42:46', '2026-07-17 06:10:43'),
(80, '080-DS', NULL, 'Converse Chuck Taylor All Star', 'Converse', 'sepatu', 'sudah_diperbaiki', '42', 'Hitam', NULL, 92, 'tersedia', NULL, 'katalog/e4e831be-387b-4ca0-9265-5e5c23fd4468.jpg', '[\"katalog\\/ab218c6e-aa2f-4687-bee5-48b7f6d4db44.jpg\",\"katalog\\/17df11e3-6916-4578-bc39-520a8785ee26.jpg\",\"katalog\\/3cf3d8a1-3c02-45dd-8ef0-abd47be95dd1.jpg\"]', '2026-07-17 01:46:05', '2026-07-17 01:46:05'),
(81, '081-DS', NULL, 'Nike Flex Run', 'Nike', 'sepatu', 'sudah_diperbaiki', '42', NULL, NULL, 76, 'tersedia', 'Sepatu Nike Flex Run ukuran 42 dalam kondisi refurbished. Outsole mulai tipis dan aus di bagian tumit, sementara bahan upper mesh masih utuh namun terdapat lapisan latex yang mengelupas. Sepatu ini tidak disertakan aksesoris tambahan. Untuk menjaga kenyamanan dan daya pakai, perbaikan lem jahitan (biaya Rp 210.000) sangat disarankan.', 'katalog/9df1e367-1295-416e-9a74-1a38ae57eeed.jpg', '[\"katalog\\/e4ccbd1e-9732-4ffe-adab-312c20b94743.jpg\",\"katalog\\/62a78f2b-d247-459b-89c2-73d00c31c10e.jpg\",\"katalog\\/2139a9db-146f-433d-ab6d-077167daa78c.jpg\"]', '2026-07-17 01:52:16', '2026-07-17 07:38:09'),
(82, '082-DS', NULL, 'Ecco', NULL, 'sepatu', 'sudah_diperbaiki', '42', NULL, NULL, 87, 'tersedia', 'Sepatu Ecco ukuran 42 dengan bahan upper kanvas, dalam kondisi refurbished. Sol sudah diganti baru, namun memerlukan penggantian midsole non flat (Rp355.000) dan ganti alas polos (Rp225.000) agar memenuhi standar kualitas. Dengan perbaikan tersebut, sepattu ini siap dipakai kembali dengan nyaman dan aman.', 'katalog/b1aa3651-050d-4d2a-b618-1de2d5934202.jpg', '[\"katalog\\/04ea4bd2-5387-4d6b-972b-a18d23e4e9f9.jpg\",\"katalog\\/3a1744dd-8399-4e65-8e05-ec6a34b5d05c.jpg\",\"katalog\\/332b9023-e208-4040-bd41-8dcfd89e99fd.jpg\"]', '2026-07-17 01:54:35', '2026-07-17 06:09:02'),
(83, '083-DS', NULL, 'Sandal Pria', 'Birkenstock', 'sepatu', 'sudah_diperbaiki', '43', NULL, NULL, 82, 'tersedia', 'Sandal pria merek Birkenstock ukuran 43 dalam kondisi refurbished. Sol bagian luar mulai tipis dan aus di beberapa area, seperti tumit, sementara upper, jahitan, dan lem telah diperbaiki (jahit ulang dan dilem). Tidak ada informasi yang diberikan tentang bahan upper, insole, interior, tali, atau aksesoris, dan barang ini tidak dilengkapi dengan apa pun. Untuk memastikan keawetan, disarankan melakukan perbaikan lem jahit dengan biaya Rp210.000.', 'katalog/247b880f-cdf7-45a9-ab7c-4f11954d7865.jpg', '[\"katalog\\/cb0dea86-7346-4bf2-af7c-d310fa0b6fcb.jpg\",\"katalog\\/71ff88d3-2fb1-42e9-8da4-48bca29433fc.jpg\",\"katalog\\/2e77d892-6cab-4712-9770-b40e56f80045.jpg\"]', '2026-07-17 01:57:43', '2026-07-17 01:57:43'),
(84, '084-DS', NULL, 'Skechers Go Walk', 'Skechers', 'sepatu', 'sudah_diperbaiki', '46', 'Abu', NULL, 81, 'tersedia', 'Sepatu Skechers Go Walk ukuran 46 warna abu untuk pria ini berbahan kanvas dengan kondisi refurbished, di mana jahitan dan lem sudah dilakukan reparasi ulang meski logo pada bagian upper terlihat retak (crack). Sol sepatu masih tebal dengan grip yang bagus, namun barang tidak menyertakan kelengkapan apa pun. Sepatu ini masih perlu perbaikan wajib berupa lem jahit (Rp 210.000) dan penambahan alas komponen plus lem (Rp 180.000) agar lebih layak pakai.', 'katalog/577f9145-1492-4904-bb22-fac61e929d09.jpg', '[\"katalog\\/9a1a3c7b-574b-4a01-ad6b-14f09b047bc1.jpg\",\"katalog\\/00b5d721-bb6c-45dd-beec-ecd35afe5b1c.jpg\",\"katalog\\/e3b67bf9-0fa2-4671-b6ce-edce5dfdb681.jpg\"]', '2026-07-17 02:02:07', '2026-07-17 02:02:07'),
(85, '085-DS', NULL, 'Everbest', NULL, 'sepatu', 'sudah_diperbaiki', '42', 'Hitam', NULL, 87, 'tersedia', 'Everbest sepatu pria ukuran 42 berwarna hitam, terbuat dari kulit sintetis. Kondisi fisiknya sudah diperbaiki: sol tebal dengan grip masih bagus, jahitan dan lem telah diperbaiki, namun stabilizer ada retakan kecil. Barang tidak lengkap, tidak ada kotak atau aksesoris tambahan. Untuk memastikan kenyamanan penggunaan, disarankan mengganti midsole dengan biaya Rp 305.000, yang wajib dilakukan.', 'katalog/ab91e8e6-2859-491e-afe6-0e2e37971306.jpg', '[\"katalog\\/86b93844-c1bf-44d4-b3d3-5b4055203536.jpg\",\"katalog\\/0f289dde-1fab-4179-9b08-c22a6cff747b.jpg\",\"katalog\\/fc6da23d-d6e0-4f0e-b319-0dccc9e64e6c.jpg\"]', '2026-07-17 02:03:35', '2026-07-17 06:06:57'),
(86, '086-DS', NULL, 'Boss', NULL, 'sepatu', 'sudah_diperbaiki', '42', NULL, NULL, 96, 'tersedia', 'Sepatu Boss ini merupakan produk refurbished untuk pria dengan ukuran 42, terbuat dari bahan upper kulit asli. Sol sudah diganti baru, upper bersih tanpa noda, serta jahitan dan lem telah diperbaiki kembali. Meski sudah dilakukan lapis kulit, barang ini masih memerlukan perbaikan wajib seperti ganti sol jadi (cupsole) seharga Rp250.000 dan lapis kulit keliling seharga Rp125.000 untuk menjamin kualitas dan kenyamanan penggunaan.', 'katalog/ae2d4aed-bec0-4577-a9fc-180e4450e5de.jpg', '[\"katalog\\/8fdaffb0-80f2-496a-a596-b3c7c2d9df63.jpg\",\"katalog\\/a966d996-8368-48c6-86d9-6a3c39aecbc3.jpg\",\"katalog\\/1e214b33-6408-4d34-a758-02b958f10623.jpg\"]', '2026-07-17 02:08:21', '2026-07-17 02:08:21'),
(87, '087-DS', NULL, 'Adidas Gazelle', 'Adidas', 'sepatu', 'sudah_diperbaiki', '41', 'Abu', NULL, 86, 'tersedia', 'Sepatu Adidas Gazelle warna abu-abu ini tersedia dalam ukuran 41 dan cocok untuk unisex. Kondisi barang sudah di-*refurbished* dengan bagian sol yang sudah diganti baru (*resole*) serta jahitan dan lem pada bagian *upper suede* yang sudah diperbaiki. Saat ini barang dalam kondisi siap pakai, namun tidak menyertakan kelengkapan lainnya.', 'katalog/177310cc-d183-41f3-937c-a5e8a76390ea.jpg', '[\"katalog\\/e6462849-88cc-4b1b-91ff-e2fbc959a178.jpg\",\"katalog\\/f628c583-2921-4354-bbb6-8011a70184e8.jpg\",\"katalog\\/98d7ceff-d5a7-4ef4-8e3b-ce3d1cee35af.jpg\"]', '2026-07-17 02:10:06', '2026-07-17 06:05:03'),
(88, '088-DS', NULL, 'Sandal Hak', NULL, 'sepatu', 'sudah_diperbaiki', '38', 'Hitam', NULL, 85, 'tersedia', 'Sepatu Hak untuk disewa atau disetor. Sepatu ini memiliki ukuran 38 dengan warna hitam dan bahan upper kulit sintetis. Kondisinya refurbished, yaitu sudah digunakan namun dalam kondisi baik. Sol (outsole) telah diganti baru (reglue/resole), upper bersih tanpa noda, serta jahitan dan lem telah dijahit ulang/dilem. Sepatu ini tidak memiliki kelengkapan. Rekomendasi perbaikan yang perlu dilakukan adalah penggantian alas hak cewe dengan biaya Rp 75.000.', 'katalog/7ff2b15b-6c72-4f01-b523-79bd96082a13.jpg', '[\"katalog\\/5edd16cc-7237-4780-83f0-de9959096ab6.jpg\",\"katalog\\/d98177f4-5a3e-4c29-a23c-a46271c7c236.jpg\",\"katalog\\/7c113089-15c7-48cf-85aa-3a6a8a32447f.jpg\"]', '2026-07-17 02:12:48', '2026-07-17 02:23:52'),
(89, '089-DS', NULL, 'Sandal Hak', NULL, 'sepatu', 'sudah_diperbaiki', '38', NULL, NULL, 85, 'tersedia', 'Sepatu Hak ukuran 38 dari bahan upper kulit sintetis dalam kondisi refurbished dengan perawatan total. Sol (outsole) telah diganti baru dan upper serta jahitan sudah dilem ulang untuk memperbaiki keausan. Namun, insole, interior, tali, serta aksesoris tidak lengkap. Untuk kelengkapan optimal, disarankan mengganti alas hak cewe dengan biaya Rp75.000. Barang ini siap dikirim dengan catatan bahwa perbaikan tertentu masih diperlukan.', 'katalog/3574255f-7859-4e05-abe3-af9e9f86f6c9.jpg', '[\"katalog\\/90f9c0fb-9086-4af9-97b1-fcabf8bfe3c1.jpg\",\"katalog\\/5408be65-0699-4d6e-a0b2-a590af54c121.jpg\",\"katalog\\/76946521-0d9e-4fdb-8080-277a42c2dcb4.jpg\"]', '2026-07-17 02:15:12', '2026-07-17 02:23:37'),
(90, '090-DS', NULL, 'Pantofel', NULL, 'sepatu', 'sudah_diperbaiki', '40', 'Coklat', NULL, 86, 'tersedia', NULL, 'katalog/49b9683b-ed4f-4a4c-9adb-2e046e53418d.jpg', '[\"katalog\\/c697d7cb-276c-40ef-99e9-875d21be5be3.jpg\",\"katalog\\/7e5e4ca9-2905-4598-8280-2eb1cfd1c386.jpg\",\"katalog\\/099aaa5a-522b-4ead-99c9-4b54d437ad63.jpg\"]', '2026-07-17 02:19:06', '2026-07-17 02:19:06'),
(91, '091-DS', NULL, 'Sandal Hak', NULL, 'sepatu', 'sudah_diperbaiki', '38', NULL, NULL, 85, 'tersedia', 'Ini adalah sandal hak ukuran 38 berbahan kulit sintetis yang sudah melalui proses refurbishing. Outsole telah diganti baru dan jahitan serta lem-nya diperbaiki, sehingga kondisinya siap pakai. Namun, alas haknya masih perlu diganti dengan biaya sekitar Rp75.000. Barang ini cocok untuk donasi bagi yang membutuhkan sandal hak yang sudah diperbaiki.', 'katalog/14f95f12-6ea6-41f9-ae4b-9c41a6044742.jpg', '[\"katalog\\/155662ef-c7da-4ca8-b2f6-2d541572bb4b.jpg\",\"katalog\\/37cbfcd8-b31c-4063-be3f-69211af755e9.jpg\",\"katalog\\/f64e813b-e072-4bc9-9ff8-51fcea8ea35b.jpg\"]', '2026-07-17 02:21:37', '2026-07-17 02:25:47'),
(92, '092-DS', NULL, 'Sandal Wanita', NULL, 'sepatu', 'sudah_diperbaiki', '38', NULL, NULL, 85, 'tersedia', NULL, 'katalog/e7597abc-316c-4389-b22a-f88a3b5f6e33.jpg', '[\"katalog\\/ce6fe150-b0c6-4f7f-9639-2a01cc3b4349.jpg\",\"katalog\\/09f41268-8fb4-4f3b-8be1-1f6c059fec2d.jpg\",\"katalog\\/c43927ba-f856-473c-a44d-83fcfddec44e.jpg\"]', '2026-07-17 02:23:14', '2026-07-17 02:23:14'),
(93, '093-DS', NULL, 'Adidas Ozweego', 'Adidas', 'sepatu', 'sudah_diperbaiki', '40', 'Hijau', NULL, 82, 'tersedia', 'Adidas Ozweego merupakan sepatu bekas kondisi refurbished dengan ukuran 40 dan warna hijau. Upper menggunakan bahan kanvas yang masih utuh, sementara sol (outsole) tebal dengan grip yang tetap bagus. Terdapat bagian lem yang mulai lepas pada jahitan, sehingga sepatu ini memerlukan perbaikan lem jahit seharga Rp210.000 untuk memperbaiki kondisi tersebut. Barang tidak dilengkapi dengan aksesoris tambahan. Rekomendasi: Lakukan perbaikan lem jahit agar sepatu dapat kembali optimal digunakan.', 'katalog/8498760b-efb1-4b12-a4b0-f7d347ee7a86.jpg', '[\"katalog\\/f891bed5-2dc0-473e-a3b7-16de6f5f627c.jpg\",\"katalog\\/eacc99df-1f69-4901-968c-b35c23ed99d7.jpg\",\"katalog\\/5627b5cf-55f5-41a6-ab43-6d6a71cb0b99.jpg\"]', '2026-07-17 13:02:59', '2026-07-17 13:02:59'),
(94, '094-DS', NULL, 'Nike', NULL, 'sepatu', 'sudah_diperbaiki', '44', 'Coklat', NULL, 71, 'tersedia', 'Sepatu sport casual untuk pria, model ini memiliki desain modern dengan upper dari bahan mesh yang nyaman dipakai. Ukuran 44 dengan warna hitam yang stylish, cocok untuk berbagai jenis aktivitas sehari-hari. Bagian sol saat ini mengalami retak/getas, sehingga perlu diganti menjadi sol cupsole dengan biaya Rp 250.000. Selain itu, ada beberapa sobek dan lubang kecil di upper, serta bagian lem yang mulai lepas, sehingga perlu diperbaiki dengan rapikan jahitan untuk menjaga struktur sepatu. Rekomendasi perbaikan ini wajib dilakukan agar sepatu dapat digunakan kembali dengan kondisi optimal.', 'katalog/c6582166-5fb4-4d28-8b81-136fd0a36a76.jpg', '[\"katalog\\/8ec0ba82-5486-4abe-9418-31f30f185b5a.jpg\",\"katalog\\/8b1cbd8f-3056-4477-afdb-d88254e3ca3d.jpg\",\"katalog\\/20f9a39a-d788-4524-8d1e-5505e71c40e5.jpg\"]', '2026-07-17 13:07:51', '2026-07-17 13:07:51'),
(95, '095-DS', NULL, 'Converse CT Low Bubble', 'Converse', 'sepatu', 'sudah_diperbaiki', '85', NULL, NULL, 84, 'tersedia', 'Converse CT Low Bubble berwarna putih dengan upper kanvas, memiliki tampilan casual dan nyaman. Sebagai barang refurbished, sepatu ini memiliki beberapa kerusakan fisik seperti sol yang retak, warna upper mulai pudar, serta bagian lem yang mulai lepas. Di dalamnya, insole dan interior masih dalam kondisi pasable. Untuk memulihkan kualitas dan kenyamanan penggunaan, sebutuhnya Ganti Sol Foxing + Alas dengan biaya Rp 275.000.', 'katalog/fc8fc501-2a46-45c3-9f65-41f878c35df2.jpg', '[\"katalog\\/578ef2a3-5240-4dc0-ac71-55a302dffbfe.jpg\",\"katalog\\/ed0d4f82-c721-4370-a4c5-2ffad39093e0.jpg\",\"katalog\\/0062a51d-7d76-474e-95a5-1d4bd34c3650.jpg\"]', '2026-07-17 13:10:37', '2026-07-17 13:10:37'),
(96, '096-DS', NULL, 'Work Shoes', NULL, 'sepatu', 'sudah_diperbaiki', '45', 'Coklat', NULL, 86, 'tersedia', 'Sepatu kerja donasi ini berukuran 45, berwarna coklat, dan telah direnovasi. Sol luarnya retak dan getas, dengan jahitan renggang, sementara bagian dalamnya tidak memiliki lapisan dan aksesori. Untuk membuatnya layak pakai lagi, sol harus diganti dengan cupsole (Rp 250.000) dan lapisan mesh diganti (Rp 175.000). Barang ini memerlukan perbaikan tersebut sebelum dapat digunakan.', 'katalog/3ba8ee7d-2e44-4d72-bba2-8b9fbd6cfc71.jpg', '[\"katalog\\/c21d0b60-82ce-4636-9fd6-83ffd8bf5907.jpg\",\"katalog\\/55c33795-069e-4cc0-9e41-d4f53e82fcba.jpg\",\"katalog\\/0fc5effe-8e1c-48d1-9f7c-a00242ba9f30.jpg\"]', '2026-07-17 13:13:45', '2026-07-17 13:13:45'),
(97, '097-DS', NULL, 'Vans', NULL, 'sepatu', 'sudah_diperbaiki', '41', 'Hitam', NULL, 87, 'tersedia', 'Sepatu Vans berukuran 41 dengan warna hitam ini menggunakan bahan upper kanvas. Barang dalam kondisi refurbished, tetapi memiliki beberapa kekurangan seperti sol yang retak/getas, warna upper mulai pudar, serta jahitan renggang di beberapa bagian. Tidak ada kelengkapan tambahan yang disertakan. Barang ini memerlukan perbaikan wajib yaitu penggantian sol foxing dan alas sebesar Rp275.000 agar dapat kembali optimal digunakan.', 'katalog/d5948fc4-3525-44dc-88d2-3123edff9b28.jpg', '[\"katalog\\/839f69fb-0f40-4893-8ab4-c8696df97fb0.jpg\",\"katalog\\/952cfb91-9ebb-4890-8393-9a0c7a58b7ce.jpg\",\"katalog\\/ae04d290-2253-4dc9-86a2-ad9a2056aa1b.jpg\"]', '2026-07-17 13:16:22', '2026-07-17 13:16:22'),
(98, '098-DS', NULL, 'Skechers Chile', 'Skechers', 'sepatu', 'sudah_diperbaiki', '78', 'Orange', NULL, 78, 'tersedia', 'Sepatu donasi merek Skechers seri Chile ini berukuran 78 dengan warna orange cerah. Kondisi secara umum masih refurbished, namun terdapat beberapa kekurangan seperti sol yang sudah mulai tipis di bagian tumit serta jahitan upper yang renggang. Selain itu, terdapat catatan tambahan bahwa bahan latex pada sepatu ini mengelupas. Barang ini memerlukan perbaikan wajib, yaitu Lem Jahit (Rp 210.000) dan Alas Komponen + Lem (Rp 180.000) agar kembali ke kondisi optimal.', 'katalog/2fcb1d53-677b-437e-a881-71677126882e.jpg', '[\"katalog\\/f3d50e26-19a4-4aa0-a751-055d5d3725f5.jpg\",\"katalog\\/4b5ab84d-d739-44eb-8dbc-4dd2e66e2957.jpg\",\"katalog\\/6f914bd5-f91b-45c9-82c4-b38269cfad48.jpg\"]', '2026-07-17 13:19:26', '2026-07-17 13:19:26'),
(99, '099-DS', NULL, 'Adidas Dragon', 'Adidas', 'sepatu', 'sudah_diperbaiki', '43', 'Hitam', NULL, 81, 'tersedia', 'Donasi sepatu Adidas Dragon berwarna hitam dengan ukuran 43 ini memiliki kondisi umum refurbished. Secara fisik, bagian sol sudah mulai menipis atau aus di area tertentu dan terdapat jahitan yang sedikit renggang. Barang ini tidak dilengkapi dengan kelengkapan lainnya. Agar dapat digunakan kembali dengan layak, sepatu ini memerlukan perbaikan wajib berupa penggantian upper pola standard (Quarter-S) seharga Rp 175.000 dan penggantian alas polos seharga Rp 225.000.', 'katalog/8ecfccfb-140a-4130-af22-7f6c9240400f.jpg', '[\"katalog\\/cf0d3f16-79fc-4865-b9a6-c19fd52073c1.jpg\",\"katalog\\/ad8667b3-3a97-458c-b95c-17d2c3174c02.jpg\",\"katalog\\/ceb2d12a-f20a-471e-973b-9f31c3afddf5.jpg\"]', '2026-07-17 13:22:19', '2026-07-17 13:22:19'),
(100, '100-DS', NULL, 'Reebok Court Retro', 'Reebok', 'sepatu', 'sudah_diperbaiki', '40', 'Hitam', NULL, 88, 'tersedia', 'Sepatu Reebok Court Retro ukuran 40 berwarna hitam, dalam kondisi refurbished. Sol scorch tebal dengan grip masih bagus, namun bagian jahitan dan lem mulai lepas, sehingga memerlukan perbaikan. Tidak ada kelengkapan tambahan seperti tali atau aksesoris. Perbaikan wajib: pengikatan lem jahitan seharga Rp 210.000.', 'katalog/0879e4c0-deb9-479f-b68f-845b95426e19.jpg', '[\"katalog\\/44d09164-5d53-44d6-8b33-3ea100042e01.jpg\",\"katalog\\/c5648c16-e539-41dc-b8fb-da638c6850e6.jpg\",\"katalog\\/e958f9bf-6c6a-4305-89a9-acd0f3c558f4.jpg\"]', '2026-07-17 13:25:42', '2026-07-17 13:25:42'),
(101, '101-DS', NULL, 'Nike Blazer Mid 77', 'Nike', 'sepatu', 'sudah_diperbaiki', '43', 'Navy', NULL, 82, 'tersedia', 'Nike Blazer Mid 77 ukuran 43 berwarna navy, kondisi refurbished. Sol bagian outsole tebal dan grip masih bagus, namun terdapat bagian lem yang mulai lepas pada jahitan. Barang ini tidak dilengkapi dengan tali atau aksesoris lain. Sebaiknya dilakukan perbaikan lem jahit dengan biaya sekitar Rp210.000.', 'katalog/f8859523-6ba3-4900-b780-a57ce96376dd.jpg', '[\"katalog\\/f0ead9fd-ab31-438d-89ae-d0b734095d4f.jpg\",\"katalog\\/cb48ce36-7879-4b07-ad3d-ab2877ba5ddc.jpg\",\"katalog\\/0fb7b407-f472-4fac-bf25-c264a01052e9.jpg\"]', '2026-07-17 13:28:02', '2026-07-17 13:28:02'),
(102, '102-DS', NULL, 'Nike Air Flight', 'Nike', 'sepatu', 'sudah_diperbaiki', '44', 'Hitam', NULL, 85, 'tersedia', 'Nike Air Flight, warna hitam, ukuran 44, memiliki upper bersih tanpa noda. Kondisi umum refurbished, dengan sol (outsole) retak/getas. Barang ini memerlukan perbaikan ganti sol jadi (cupsole) sebesar Rp 250.000 dan lapis kulit keliling Rp 125.000 yang wajib dilakukan. Tidak terdapat kelengkapan.', 'katalog/a2881fc0-77e4-4a4b-b977-2d1ce2318434.jpg', '[\"katalog\\/0c864a49-e12a-4d44-9f02-28cdeef8a1e7.jpg\",\"katalog\\/b94add51-38ac-45ed-8ee8-a0de71aa4f9e.jpg\",\"katalog\\/1c792578-604f-4fd6-aee3-4a75ba16ad3d.jpg\"]', '2026-07-17 13:30:36', '2026-07-17 13:30:36'),
(103, '103-DS', NULL, 'Nike PG 2.5', 'Nike', 'sepatu', 'sudah_diperbaiki', '42', 'Hitam', NULL, 76, 'tersedia', 'Nike PG 2.5 sepatu sneaker ukuran 42 dengan warna hitam, kini dijual sebagai barang donasi. Bahan atas terbuat dari tekstil, namun sol sudah mulai terkelupas dan velcrow lepas, sehingga memerlukan perbaikan. Kami merekomendasikan ganti sol berpola seharga Rp275.000 dan penggantian velcrow seharga Rp175.000 untuk memulihkan kualitas sepatu. Sekarang sepatu berada dalam kondisi refurbished tanpa kelengkapan tambahan.', 'katalog/398dea90-91fe-4855-ada9-d2258161ab46.jpg', '[\"katalog\\/17a79a75-35f0-4b84-9a96-437498fb5611.jpg\",\"katalog\\/fd687299-5a09-439e-b19d-abeb256b3e72.jpg\",\"katalog\\/4f6c29e7-e244-48ba-9f81-adf297d441cb.jpg\"]', '2026-07-17 13:33:33', '2026-07-17 13:33:33'),
(104, '104-DS', NULL, 'Work Shoes', NULL, 'sepatu', 'sudah_diperbaiki', '41', 'Coklat', NULL, 81, 'tersedia', 'Sepatu kerja Work Shoes ukuran 41 warna coklat dalam kondisi refurbished, cocok untuk pemakaian sehari-hari. Upper sepatu memiliki noda ringan yang dapat dibersihkan kembali, sementara sol (outsole) mengalami retak/getas. Sepatu ini tidak dilengkapi dengan aksesori tambahan. Perlu perbaikan wajib berupa penggantian sol jadi (cupsole) sebesar Rp 250.000 dan penggantian lining kulit senilai Rp 225.000 untuk memastikan kenyamanan dan kekuatan penggunaan.', 'katalog/d865c897-21d0-4f52-aebb-f4d863d724fb.jpg', '[\"katalog\\/42fcce07-6e94-431e-9769-573b7a0056c0.jpg\",\"katalog\\/71262053-d1e0-4410-a266-0fc704bdd05a.jpg\",\"katalog\\/25df7c8a-b05a-4b36-ba21-9c58e6d702e7.jpg\"]', '2026-07-17 13:36:18', '2026-07-17 13:36:18'),
(105, '105-DS', NULL, 'Adidas All Count', 'Adidas', 'sepatu', 'sudah_diperbaiki', '43', 'Hitam', NULL, 87, 'tersedia', 'Adidas All Count ukuran 43, warna hitam, kondisi refurbished. Terlihat ada jahitan renggang yang memerlukan perbaikan lem jahit dengan estimasi biaya Rp210.000. Barang ini tidak disertai dengan tali, aksesoris atau kelengkapan lain.', 'katalog/0fe127a7-9654-4b14-b871-e8ac024595cd.jpg', '[\"katalog\\/98fe8246-9da4-425c-acd0-61245851003f.jpg\",\"katalog\\/bc41cc4e-256a-4fb6-8d0d-cda02a0fa842.jpg\",\"katalog\\/63f32ce9-ec41-4fd1-b4b8-59b48d100384.jpg\"]', '2026-07-17 13:40:33', '2026-07-17 13:40:33'),
(106, '106-DS', NULL, 'Adidas Backenbauer Allround', 'Adidas', 'sepatu', 'sudah_diperbaiki', '42', 'Hitam', NULL, 81, 'tersedia', 'Adidas Backenbauer Allround, merek Adidas, ukuran 42, warna hitam, dalam kondisi refurbished. Kondisi fisik menunjukkan bahwa sol (outsole) retak/getas, sementara detail upper, jahitan & lem, insole & interior, tali & aksesoris tidak tertera dalam data yang diberikan. Barang ini tidak dilengkapi dengan aksesori atau kemasan tambahan. Direkomendasikan mengganti sol menjadi cupsole dengan biaya sekitar Rp250.000, yang merupakan perbaikan wajib sebelum penggunaan.', 'katalog/2097ccfa-7892-4109-9eec-52401df12f2c.jpg', '[\"katalog\\/6bb946e3-37ad-4e7e-b897-9392d4cde793.jpg\",\"katalog\\/cd258570-0aa0-4640-9589-4226d23894c9.jpg\",\"katalog\\/0b8eb2bc-59ea-4a40-92bc-ee2e436b6b79.jpg\"]', '2026-07-17 13:43:52', '2026-07-17 13:43:52'),
(107, '107-DS', NULL, 'Adidas Hamburg', 'Adidas', 'sepatu', 'sudah_diperbaiki', '41', 'Hitam', NULL, 86, 'tersedia', 'Barang donasi ini adalah sepatu Adidas Hamburg dari merek Adidas, ukuran 41, warna hitam. Sebagai barang refurbished, sepatu ini memiliki kondisi umum yang masih gunakan, meskipun ada bagian lem dijahitan yang mulai lepas. Rekomendasi untuk memastikan kenyamanan dan keamanan penggunaan adalah melakukan repaire lem jahit dengan biaya Rp 210.000. Tidak termasuk kelengkapan aksesoris seperti tali atau pouch. Cocok untuk donasi dengan penyesuaian reparation.', 'katalog/93b9bfe7-522a-4ebb-8fbb-5ff295a550ad.jpg', '[\"katalog\\/66621a9b-c517-424b-934c-18bf585d4a68.jpg\",\"katalog\\/855f9b05-e612-42e9-90e3-eeb8a7914ab7.jpg\",\"katalog\\/371b508d-c4aa-4fca-b597-afefe59b6781.jpg\"]', '2026-07-17 13:45:29', '2026-07-17 13:45:29'),
(108, '108-DS', NULL, 'Ortuseight Revive', 'Ortuseight', 'sepatu', 'sudah_diperbaiki', '44', 'Hitam', NULL, 75, 'tersedia', 'Sepatu ukuran 44 berwarna hitam, dalam kondisi refurbished. Sol luar retak dan terasa getas, bagian atas (upper) memiliki lubang kecil serta sobek. Barang memerlukan penggantian sol cupsole (Rp 250.000), penggantian lining mesh (Rp 175.000), dan rapihkan jahitan (Rp 125.000) untuk memenuhi standar penggunaan. Kelengkapan hanya berupa sepatu tanpa aksesoris tambahan.', 'katalog/0d636e18-2fdc-4d17-8c16-c5c4924547ea.jpg', '[\"katalog\\/2980b5fc-d584-47e9-a83c-1236ce26697f.jpg\",\"katalog\\/1598a501-58a6-4098-b3b2-56caa41a0563.jpg\",\"katalog\\/3ba21641-9a53-43c9-aa4e-47bb576f3e37.jpg\"]', '2026-07-17 13:49:30', '2026-07-17 13:49:30');
INSERT INTO `donation_items` (`id`, `kode_barang`, `donation_id`, `nama`, `brand`, `kategori`, `kondisi`, `ukuran`, `warna`, `berat`, `score_kelayakan`, `status`, `deskripsi`, `foto_utama_path`, `foto_detail`, `created_at`, `updated_at`) VALUES
(109, '109-DS', NULL, 'Asics Fuzex Lyte', 'Asics', 'sepatu', 'sudah_diperbaiki', '42', 'BIru', NULL, 91, 'tersedia', 'Sepatu Asics Fuzex Lyte ukuran 42 berwarna biru, condition refurbished dengan beberapa retakan pada sol. Saat ini tidak ada kelengkapan lain selain kalo yang retak, sehingga diperlukan penggantian sol cupsole dengan biaya sekitar Rp250.000. Setelah perbaikan, sepatu ini siap pakai kembali dengan tampilan yang lebih rapi. Produk ini cocok untuk yang mencari sepatu sport murah tapi masih layak dipakai.', 'katalog/60fb341c-8eb7-4470-a72f-b53405e02b0e.jpg', '[\"katalog\\/3bc75bd2-26f8-4869-86e5-4709d2c577ed.jpg\",\"katalog\\/8b390df5-7fce-4297-897b-35ec8da21cb8.jpg\",\"katalog\\/e463d585-0712-4d42-bef4-aed91ca6d149.jpg\"]', '2026-07-17 13:51:33', '2026-07-17 13:51:33'),
(110, '110-DS', NULL, 'Converse Jack Purcell', 'Converse', 'sepatu', 'sudah_diperbaiki', '42', 'Putih', NULL, 87, 'tersedia', 'Sepatu Converse Jack Purcell warna putih ukuran 42 ini merupakan hasil refurbish dengan kondisi umum yang baik. Upper dan solnya masih tampak layak pakai, namun lem pada jahitannya mulai lepas sehingga memerlukan perbaikan. Untuk memperbaikinya, Anda perlu mengganti lem jahit dengan biaya sekitar Rp 210.000. Barang ini cocok untuk penggunaan sehari-hari dan akan terlihat seperti baru setelah diperbaiki.', 'katalog/e9db0aa1-cd49-41eb-86d1-f78824a3f217.jpg', '[\"katalog\\/a8de55c6-cb06-4556-a9d2-a9b72ca84dbf.jpg\",\"katalog\\/d0aea404-38c2-4210-aef9-d0942161e935.jpg\",\"katalog\\/9948ba33-2cd1-4be1-8c63-3dac91813d55.jpg\"]', '2026-07-17 13:53:38', '2026-07-17 13:53:38'),
(111, '111-DS', NULL, 'Flatshoes', NULL, 'sepatu', 'sudah_diperbaiki', '42', 'Hitam', NULL, 84, 'tersedia', 'Flatshoes ukuran 42 warna hitam ini merupakan barang refurbished dengan kondisi upper yang warna mulai pudar. Pada bagian sol (outsole) terdapat retak dan getas, serta tidak tersedia kelengkapan apa pun. Barang ini wajib diperbaiki dengan mengganti sol jadi (cupsole) yang diperkirakan menelan biaya sekitar Rp 250.000. Cocok untuk donasi bagi penerima yang bersedia melakukan reparasi terlebih dahulu sebelum digunakan.', 'katalog/76b35077-991a-42b3-8167-02516bf7a94f.jpg', '[\"katalog\\/530b2316-d5ea-4a31-a8e1-9b2502b6e3c8.jpg\",\"katalog\\/79fec71b-c334-4a9d-ac60-f699788b7c0e.jpg\",\"katalog\\/532d438b-c74e-48af-9cba-0dc003c36582.jpg\"]', '2026-07-17 13:55:51', '2026-07-17 13:55:51'),
(112, '112-DS', NULL, 'Eiger Z-Anaconda 2.5 Camouflage', 'Eiger', 'sepatu', 'sudah_diperbaiki', '43', 'Hitam', NULL, 89, 'tersedia', 'Sepatu Eiger Z-Anaconda 2.5 Camouflage ukuran 43 warna hitam ini dalam kondisi refurbished dengan outsole tebal dan grip yang masih bagus. Bagian upper terdapat noda ringan yang masih bisa dibersihkan, namun barang tidak dilengkapi aksesoris atau kelengkapan lainnya. Sepatu ini wajib dilakukan perbaikan midsole non flat dengan estimasi biaya Rp 355.000 agar kembali nyaman digunakan.', 'katalog/8d4268e8-b359-48a1-afb6-a6c65e16f808.jpg', '[\"katalog\\/7b9384e3-0507-4974-8f3c-762c669fdc9b.jpg\",\"katalog\\/23da5f73-3d45-4c5b-88df-06c4b3bd9085.jpg\",\"katalog\\/1ac1be30-de72-470c-ad1d-3731abfd4364.jpg\"]', '2026-07-17 13:58:21', '2026-07-17 13:58:21'),
(113, '113-DS', NULL, 'Salomon X-Scream 3D Gore-tex Trail Run', 'Salomon', 'sepatu', 'sudah_diperbaiki', '45', 'Biru', NULL, 81, 'tersedia', 'Sepatu trail run Salomon X-Scream 3D Gore-tex ukuran 45 warna biru ini merupakan barang refurbished dengan bagian upper yang masih memiliki noda ringan namun dapat dibersihkan. Barang tidak dilengkapi dengan aksesoris tambahan dan hadir tanpa kelengkapan lainnya. Untuk penggunaan yang optimal, sepatu ini wajib dilakukan perbaikan pada alas komponen dan lem dengan estimasi biaya Rp 180.000.', 'katalog/56c7e8f0-52b5-4f1b-a52c-4fdaf142a2d0.jpg', '[\"katalog\\/53a69094-5dac-4d1c-bd1d-d2d1137bda52.jpg\",\"katalog\\/e78245e5-d142-48a3-a10d-e6158ea68a82.jpg\",\"katalog\\/1aa6dd63-99c8-4ed3-b0aa-6c5463e6cfcc.jpg\"]', '2026-07-17 14:01:25', '2026-07-17 14:01:25'),
(114, '114-DS', NULL, 'Vans Old School', 'Vans', 'sepatu', 'sudah_diperbaiki', '39', 'Hitam', NULL, 84, 'tersedia', 'Sepatu donasi merek Vans warna hitam ukuran 39 dengan bahan upper kanvas, kondisi refurbished dan tanpa kelengkapan tambahan. Bagian sol luar (outsole) mengalami retak dan getas sehingga perlu diganti sol foxing beserta alas dengan estimasi biaya Rp 275.000. Barang ini masih layak digunakan setelah dilakukan perbaikan pada sol tersebut.', 'katalog/d0fa1065-0127-42be-9c8d-1d102620a11e.jpg', '[\"katalog\\/9338a0b0-2146-468e-a6b6-90f71049d384.jpg\",\"katalog\\/0971a03e-a9ab-46f8-a021-31410671f8b0.jpg\",\"katalog\\/c0305e6c-a3fc-4f50-a0a6-2124d5ce2258.jpg\"]', '2026-07-17 14:04:47', '2026-07-17 14:04:47'),
(115, '115-DS', NULL, 'Flatshoes', NULL, 'sepatu', 'sudah_diperbaiki', '38', 'Putih', NULL, 86, 'tersedia', 'Flatshoes ukuran 38 warna putih ini hadir dalam kondisi refurbished dengan sol luar (outsole) yang retak dan getas. Barang tidak memiliki kelengkapan tambahan apa pun. Untuk penggunaan yang aman dan nyaman, sepatu ini wajib diperbaiki dengan mengganti sol jadi (cupsole) dengan estimasi biaya reparasi sekitar Rp 250.000.', 'katalog/646727ca-e4aa-4d94-bae8-cc95f49c2b0d.jpg', '[\"katalog\\/fd90f83a-2e29-4e89-aed2-9855e56d1db6.jpg\",\"katalog\\/a5f5d901-ab4e-4152-8630-4d689bd9a3fc.jpg\",\"katalog\\/c72b2a88-24dc-42f4-ad46-4a064f05b7c6.jpg\"]', '2026-07-17 14:06:42', '2026-07-17 14:06:42'),
(116, '116-DS', NULL, 'Sandal Pria', NULL, 'sepatu', 'sudah_diperbaiki', '42', 'Coklat', NULL, 61, 'tersedia', 'Sandal pria ukuran 42 warna coklat ini diberikan dalam kondisi refurbished tanpa kelengkapan tambahan. Bagian sol luar (outsole) terlihat retak dan getas sehingga perlu penanganan lebih lanjut. Barang ini wajib diperbaiki dengan layanan midsole flat (Rp 305.000) dan ganti alas polos (Rp 225.000) agar kembali layak pakai.', 'katalog/20758ef4-ac35-41e0-9a02-45da559dbd26.jpg', '[\"katalog\\/4a44080d-824b-44c0-a25c-20cdea39f3af.jpg\",\"katalog\\/5bb9b1d7-815d-48ce-b68c-fc1d1f7d9748.jpg\",\"katalog\\/89c9dc12-8ef2-40c5-abbf-4bfb179fc1c5.jpg\"]', '2026-07-17 14:08:28', '2026-07-17 14:08:28'),
(117, '117-DS', NULL, 'Sandal Pria', NULL, 'sepatu', 'sudah_diperbaiki', '42', 'Hitam', NULL, 69, 'tersedia', 'Sandal pria warna hitam ukuran 42 ini hadir dalam kondisi refurbished dengan sol luar (outsole) yang retak dan getas. Barang tidak dilengkapi dengan aksesoris atau kelengkapan lainnya. Sandal ini wajib diperbaiki melalui penambahan insole kulit (Rp 125.000), midsole flat (Rp 305.000), dan penggantian alas polos (Rp 225.000) agar layak dan nyaman digunakan.', 'katalog/354c1fac-ccfb-4978-8f97-9836c6bb8eda.jpg', '[\"katalog\\/5f42d5ad-56ab-49dc-9842-13b8cf1a9606.jpg\",\"katalog\\/fa68d5b5-55e7-490a-8542-53f9fdb872c1.jpg\",\"katalog\\/25927191-4b51-4a67-97fd-46b8a4a21926.jpg\"]', '2026-07-17 14:10:32', '2026-07-17 14:10:32'),
(118, '118-DS', NULL, 'Red Wing Safety Shoes Model 3228', 'Red Wing', 'sepatu', 'sudah_diperbaiki', '40', 'Coklat', NULL, 86, 'tersedia', 'Sepatu donasi merek Red Wing warna coklat ukuran 40 dalam kondisi refurbished, tanpa kelengkapan tambahan dan tali/aksesoris. Outsole mengalami retak dan getas sehingga perlu perbaikan menyeluruh. Barang ini wajib diperbaiki dengan ganti upper pola standard (Quarter-S) Rp 175.000, ganti sol jadi cupsole Rp 250.000, dan ganti paded Rp 175.000. Total estimasi reparasi wajib sekitar Rp 600.000 sebelum sepatu layak pakai kembali.', 'katalog/8f766d77-92f9-46c9-bae6-3becd48e8090.jpg', '[\"katalog\\/5a517cd4-2e5d-4f4f-b3ba-bd65a077b876.jpg\",\"katalog\\/d80b48cb-1af2-486e-9459-2c0efa1ec2c4.jpg\",\"katalog\\/a951bc5f-9d3d-4a5e-a06d-c0b4526c5ed1.jpg\"]', '2026-07-17 14:13:52', '2026-07-17 14:13:52'),
(119, '119-DS', NULL, 'Birkenstock', NULL, 'sepatu', 'sudah_diperbaiki', '36', 'Merah', NULL, 81, 'tersedia', 'Sepatu Birkenstock ukuran 36 berwarna merah, dalam kondisi refurbished dengan sol yang mulai terkelupas dan warna atas yang sudah pudar. Bahan upper tidak tercatat, namun celah dan retak pada sol serta penurunan warna pada bagian atas terlihat jelas. Sebelum dipakai kembali, sepattu ini membutuhkan perbaikan Midsole Flat dengan biaya Rp 305.000. Tidak termasuk kelengkapan tambahan.', 'katalog/550727c7-8eff-4334-9e6c-14ee483e6bea.jpg', '[\"katalog\\/2bad8732-4c3e-494e-9b37-fcf1da4bb60d.jpg\",\"katalog\\/eff168c2-0112-408a-87d5-dd2493ceb751.jpg\",\"katalog\\/8a1c5eb2-3294-4b8f-8fb8-0b917d8f5581.jpg\"]', '2026-07-18 03:08:02', '2026-07-18 03:08:02'),
(120, '120-DS', NULL, 'Skechers Skech-Air Court', 'Skechers', 'sepatu', 'sudah_diperbaiki', '40', 'Putih', NULL, 82, 'tersedia', 'Sepatu wanita pria Skechers Skech-Air Court ukuran 40 berwarna putih dengan bahan upper yang kuat. Kondisi barang dalam kondisi refurbished namun membutuhkan perbaikan sol (cupsole) sebesar Rp 250.000 serta penggantian lining mesh sebesar Rp 175.000 karena sol berkerut/getas. Upper, jahitan, lemen, insole, serta aksesoris seperti tali tidak melengkapi. Meski begitu, desain stylish dan kualitas awal Skechers tetap mendukung kebutuhan aktivitas sehari-hari setelah perbaikan.', 'katalog/709e18ce-0b17-4a45-9f0d-fa8bb85465cb.jpg', '[\"katalog\\/cca8930f-5577-4294-bdfe-17ddd8847599.jpg\",\"katalog\\/5a6e75bc-41e4-4c6c-baba-39848f840011.jpg\",\"katalog\\/d317c4d5-b726-425e-af06-237d922a7f11.jpg\"]', '2026-07-18 03:18:40', '2026-07-18 03:18:40'),
(121, '121-DS', NULL, 'Nike E-Series AD', 'Nike', 'sepatu', 'sudah_diperbaiki', '44', 'Hitam', NULL, 86, 'tersedia', 'Sepatu Nike E-Series AD ukuran 44 warna hitam ini berstatus refurbished dengan kondisi umum layak pakai. Upper dan sol masih dalam kondisi cukup baik, namun terdapat bagian lem yang mulai lepas dan memerlukan penanganan segera. Tali sepatu masih utuh, namun barang tidak dilengkapi kotak atau aksesoris tambahan. Agar optimal digunakan, wajib melakukan perbaikan lem jahit dengan biaya perkiraan Rp 210.000.', 'katalog/d8eff0e4-0a44-466d-a662-e49bcc8c01e7.jpg', '[\"katalog\\/dc225799-cdb9-43a4-bc55-3dbb29661f13.jpg\",\"katalog\\/06294c53-a9ff-4849-8b3c-396fd4b65634.jpg\",\"katalog\\/6f0cfcba-0672-4e26-aeb8-73b9c8603654.jpg\"]', '2026-07-18 03:20:46', '2026-07-18 03:20:46'),
(122, '122-DS', NULL, 'Slip On', 'Airwalk', 'sepatu', 'sudah_diperbaiki', '44', 'Hitam', NULL, 84, 'tersedia', 'Slip On merek Airwalk ukuran 44 berwarna hitam ini berada dalam kondisi refurbished. Pada saat inspeksi terlihat ada bagian lem yang mulai lepas pada jahitan, sementara bagian lain seperti sol dan interior tidak menunjukkan kerusakan signifikan. Barang ini tidak disertai dengan alcun kelengkapan tambahan. Untuk mengembalikan fungsinya sepenuhnya, diperlukan perbaikan lem jahit dengan estimasi biaya Rp210.000.', 'katalog/afb482ee-985a-4b6c-a74c-ad74348ea05f.jpg', '[\"katalog\\/e8b52ef3-3632-46c8-b0f8-74f2808c765e.jpg\",\"katalog\\/65bab7a4-232e-434a-aa55-dc7fd2b7199f.jpg\",\"katalog\\/09454fc2-938f-4e4b-8338-f0f7da7e88b3.jpg\"]', '2026-07-18 03:23:07', '2026-07-18 03:23:27'),
(123, '123-DS', NULL, 'Converse Chuck Taylor All Star Slip-On', 'Converse', 'sepatu', 'sudah_diperbaiki', '42', 'Putih', NULL, 82, 'tersedia', 'Sepatu Converse Chuck Taylor All Star Slip-On ukuran 42 berwarna putih ini merupakan barang refurbished dengan kondisi umum yang baik namun bagian atasnya mulai pudar dan beberapa bagian lem mulai lepas. Sepatu ini memerlukan perbaikan berupa lem jahit dengan biaya sekitar Rp 210.000 untuk mengembalikan kondisinya. Tanpa aksesori dan kelengkapan tambahan, sepatu ini siap diperbaiki dan digunakan kembali.', 'katalog/ca7233b9-1efb-4ff4-acb5-4ff4f67f5c43.jpg', '[\"katalog\\/1d59708f-d310-4065-9191-6c6d16103d23.jpg\",\"katalog\\/94740497-d720-42ae-84bb-29d2649dac2b.jpg\",\"katalog\\/c281aada-0748-43e9-82f1-d909e0d29d4d.jpg\"]', '2026-07-18 03:26:28', '2026-07-18 03:26:28'),
(124, '124-DS', NULL, 'Vans Slip-On', 'Vans', 'sepatu', 'sudah_diperbaiki', '42', 'Hijau', NULL, 86, 'tersedia', 'Sepatu Vans Slip-On merupakan sepatu slip-on dari merek Vans dengan ukuran 42 dan warna hijau. Kondisi sepatu ini telah melalui proses refurbish, namun terdapat keausan di bagian tumit pada sol (outsole). Upper, jahitan, lem, insole, interior, serta tali dan aksesoris tidak melibatkan perbaikan khusus. Untuk menjamin kelancaran penggunaan, sepatu ini memerlukan penggantian alas polos (outsole) dengan biaya sebesar Rp 225.000, yang merupakan perbaikan yang wajib dilakukan.', 'katalog/1900eea2-b5f9-4d8c-a28d-874b5fac4663.jpg', '[\"katalog\\/46c2b089-dea5-4b90-9150-34bddffe55b6.jpg\",\"katalog\\/e2eea491-df6e-442f-9e40-c70396acf78e.jpg\",\"katalog\\/9e25ecaf-74a4-4426-93e7-32c263d10619.jpg\"]', '2026-07-18 03:30:30', '2026-07-18 03:30:30'),
(125, '125-DS', NULL, 'Adidas NMD R1', 'Adidas', 'sepatu', 'sudah_diperbaiki', '43', 'Hitam', NULL, 78, 'tersedia', 'Adidas NMD R1 ukuran 43 berwarna hitam dalam kondisi refurbished. Jahitan pada upper mulai lepas, sehingga memerlukan perbaikan lem. Sepatu tidak dilengkapi aksesoris tambahan. Diperlukan jasa Lem Jahit dengan biaya Rp 210.000.', 'katalog/73be0f63-9524-4ffd-870a-810bbb0ee19c.jpg', '[\"katalog\\/f9e45881-2b78-44ed-8763-8eb3e4d934e3.jpg\",\"katalog\\/5ad5626a-6516-4fea-bc38-16efcfd58caf.jpg\",\"katalog\\/4c67f341-adb1-4d88-929a-072f2f9369a4.jpg\"]', '2026-07-18 03:48:19', '2026-07-18 03:48:19'),
(126, '126-DS', NULL, 'Ripcurl', NULL, 'sepatu', 'sudah_diperbaiki', '41', 'Hitam', NULL, 79, 'tersedia', 'Sepatu Ripcurl size 41 warna hitam dengan kondisi refurbished, tampak cukup baik meskipun lem pada bagian sol mulai lepas. Tidak termasuk kelengkapan tambahan. Untuk memastikan kestabilan, perbaikan lem jahit sebesar Rp 210.000 wajib dilakukan. Harga tersebut mencakup servis reparasi yang diperlukan.', 'katalog/20a1d4ac-77e2-4133-9974-37470fad948c.jpg', '[\"katalog\\/1a05ec3e-39bd-4287-a61a-72efbe67cd6b.jpg\",\"katalog\\/a75af746-6da7-496b-ba75-9162ab834fc5.jpg\",\"katalog\\/8efabeb6-6298-498c-8d84-e61836389c58.jpg\"]', '2026-07-18 03:51:08', '2026-07-18 03:51:08'),
(127, '127-DS', NULL, 'Sandal Wanita', 'Andrew', 'sepatu', 'sudah_diperbaiki', '38', 'Hitam', NULL, 78, 'tersedia', 'Sandal Wanita merek Andrew ukuran 38 berwarna hitam ini berada dalam kondisi refurbished. Terlihat bahwa bagian lem pada jahitan sudah mulai lepas, sementara data mengenai sol, upper, insole, tali dan aksesoris tidak tersedia. Barang ini tidak disertai dengan kelengkapan apa pun. Untuk mengembalikan fungsinya sepenuhnya, diperlukan perbaikan lem jahit dengan estimasi biaya Rp210.000.', 'katalog/882ed3c5-de31-4794-a729-9e84dd311f5c.jpg', '[\"katalog\\/107a310e-1478-413c-ad5c-74de7ab34abe.jpg\",\"katalog\\/6da0449b-937d-4da2-8a56-fb698f05b98e.jpg\",\"katalog\\/08fe5f43-decd-4832-8796-1c06f2015576.jpg\"]', '2026-07-18 03:53:09', '2026-07-18 03:53:09'),
(128, '128-DS', NULL, 'Skechers Go Walk Lite', 'Skechers', 'sepatu', 'sudah_diperbaiki', '40', 'Navy', NULL, 81, 'tersedia', 'Skechers Go Walk Lite ukuran 40 berwarna navy, berstatus refurbished. Kondisi fisik menunjukkan retakan pada sol luar, sementara bagian atas, jahitan, interior, tali, aksesoris, serta kelengkapan tidak ada. Barang ini memerlukan perbaikan ganti sol cupsole dengan biaya sekitar Rp 250.000. Setelah perbaikan, shoes siap dipakai kembali.', 'katalog/d1437dff-0dc3-4fb6-b6aa-c768df798886.jpg', '[\"katalog\\/732f56f1-929f-4fdf-9e2e-2297462c56d9.jpg\",\"katalog\\/c5539e17-77f1-4010-89d9-a0cd40aa00ea.jpg\",\"katalog\\/67f86215-fc64-4522-a8e1-f4b888691c52.jpg\"]', '2026-07-18 03:55:29', '2026-07-18 03:55:29'),
(129, '129-DS', NULL, 'Casual Shoes', NULL, 'sepatu', 'sudah_diperbaiki', '44', 'Abu', NULL, 76, 'tersedia', 'Casual Shoes ukuran 44 berwarna abu dalam kondisi refurbished. Terlihat ada bagian lem yang mulai lepas pada jahitan, dan barang ini tidak dilengkapi dengan tali atau aksesoris lain. Disarankan melakukan perbaikan lem jahit dengan biaya sekitar Rp210.000.', 'katalog/11562375-5593-4dc4-ba90-ae5b83b75ca9.jpg', '[\"katalog\\/5b9b3611-af4a-45c6-8b80-9cd557261a64.jpg\",\"katalog\\/963a8837-0d67-42f5-9112-ee6671ebc47e.jpg\",\"katalog\\/53d12808-1559-425d-8ba1-e9b0585e0ecc.jpg\"]', '2026-07-18 03:57:05', '2026-07-18 03:57:05'),
(130, '130-DS', NULL, 'DC Shoes Central', 'DC', 'sepatu', 'sudah_diperbaiki', '41', 'Abu', NULL, 79, 'tersedia', 'Sepatu donasi ini adalah DC Shoes Central dengan merek DC, ukuran 41, dan warna abu. Sepatu dalam kondisi refurbished, namun memiliki beberapa kekurangan pada detail fisik seperti bagian lem yang mulai lepas di area jahitan. Upper dan insole tidak diketahui kondisinya, serta tidak ada aksesoris atau kelengkapan tambahan yang disertakan. Untuk memperbaiki kondisi, sepatu ini memerlukan jasa lem jahit (Rp210.000) dan penggantian upper pola standard Quarter-S (Rp175.000), keduanya wajib dilakukan agar sepatu kembali ke fungsi optimal. Barang cocok untuk disumbangkan setelah perbaikan dilakukan.', 'katalog/ff404be1-2fa1-4155-8e06-15c09d71e8e2.jpg', '[\"katalog\\/fddc6316-2cd1-47a6-9292-7c766e089d48.jpg\",\"katalog\\/85abd380-feeb-4ab5-93a5-5eb7a49e54a2.jpg\",\"katalog\\/bb6acbbe-91c9-4292-98ed-f355afd2eee4.jpg\"]', '2026-07-18 04:00:18', '2026-07-18 04:00:18'),
(131, '131-DS', NULL, 'Nike Air Max', 'Nike', 'sepatu', 'sudah_diperbaiki', '43', 'Hitam', NULL, 82, 'tersedia', NULL, 'katalog/5c38a828-6b94-4616-ba03-41e4a69e07e4.jpg', '[\"katalog\\/dcded064-c2fa-4a50-804f-b7a8577b0eed.jpg\",\"katalog\\/c9e7b6ec-20f2-489b-a7bd-8dd3642b1861.jpg\",\"katalog\\/4bd23d1e-cab5-4ae3-ad96-9a8c21504a9b.jpg\"]', '2026-07-18 04:03:42', '2026-07-18 04:03:42'),
(132, '132-DS', NULL, 'Adidas Ultraboost Reflective EG8105', 'Adidas', 'sepatu', 'sudah_diperbaiki', '43', 'Hitam', NULL, 83, 'tersedia', 'Donasi sepatu Adidas Ultraboost Reflective EG8105 berwarna hitam dengan ukuran 43. Kondisi barang adalah *refurbished* dengan catatan bagian sol mulai aus atau menipis di bagian tertentu seperti tumit. Barang ini tidak memiliki kelengkapan tambahan dan memerlukan perbaikan wajib berupa lem dan jahit dengan estimasi biaya sekitar Rp210.000.', 'katalog/ed48af13-9bb1-421c-a1ae-1c43bf4c4167.jpg', '[\"katalog\\/4e18da01-ea59-4928-a3b8-1e9a5b3c5eca.jpg\",\"katalog\\/4b9b60d9-56d4-42d6-bbd3-8a28c3026164.jpg\",\"katalog\\/55d76359-b7d0-419d-9839-c75914ed11d8.jpg\"]', '2026-07-18 04:09:21', '2026-07-18 04:09:21'),
(133, '133-DS', NULL, 'Adidas Y3', 'Adidas', 'sepatu', 'sudah_diperbaiki', '43', 'Merah', NULL, 84, 'tersedia', 'Sepatu Adidas Y3 ukuran 43 warna merah ini berstatus refurbished dengan sol yang telah pernah direglue/resole, namun upper memerlukan penanganan serius pada area quarter kiri. Barang dikirimkan tanpa kelengkapan kotak maupun dustbag. Untuk memastikan sepatu layak pakai dan nyaman, diperlukan dua perbaikan wajib: penggantian sol cupsole penuh sebesar Rp250.000 dan penggantian upper pola besar (quarter-L) sebesar Rp325.000. Cocok untuk pembeli yang siap menginvestasikan biaya perbaikan agar unit ini kembali berfungsi optimal.', 'katalog/29d5a7cb-be82-4c8d-adff-497c49eed172.jpg', '[\"katalog\\/5155f67e-4150-4ad1-a64d-540b1132b6f3.jpg\",\"katalog\\/457f6660-59cd-49a7-94c9-647dfcff359b.jpg\",\"katalog\\/3a39ee77-3652-4361-9ad9-5eb54f2200e3.jpg\"]', '2026-07-18 04:12:51', '2026-07-18 04:12:51'),
(134, '134-DS', NULL, 'Alpinestar Belize Drystar', 'Alpinestar', 'sepatu', 'sudah_diperbaiki', '43', 'Hitam', NULL, 91, 'tersedia', 'Barang ini adalah sepatu refurbished dengan merek [Merek], ukuran [Ukuran], warna [Warna], dan bahan upper [Bahan Upper] yang cocok untuk [Gender/Kategori].  \r\nKondisi fisik menunjukkan thatas (outsole) retak/getas, sementara bagian atas, jahitan, interior, tali, serta kelengkapan tidak ada kelengkapan tambahan.  \r\nKarena sol rusak, barang memerlukan penggantian sol khusus dengan biaya Rp275.000, yang merupakan perbaikan wajib.', 'katalog/e6c6fab5-af41-4ba2-b5bf-0ce30ddb2b86.jpg', '[\"katalog\\/f38c5b3e-9e9a-41a6-abbb-47de8f67b629.jpg\",\"katalog\\/b97dc1c0-f540-4a7f-a946-042c20dc4271.jpg\",\"katalog\\/078a457a-7430-4233-918c-1f340b34ec20.jpg\"]', '2026-07-18 04:16:41', '2026-07-18 04:16:41'),
(135, '135-DS', NULL, 'Slip On', NULL, 'sepatu', 'sudah_diperbaiki', '42', 'Coklat', NULL, 78, 'tersedia', 'Sepatu slip on ukuran 42 warna coklat ini dalam kondisi refurbished dengan warna upper yang mulai pudar. Sol luar (outsole) terlihat retak dan getas, serta barang diberikan tanpa kelengkapan tambahan apa pun. Untuk dapat digunakan dengan nyaman, sepatu ini wajib diperbaiki dengan mengganti sol jadi (cupsole) dengan estimasi biaya reparasi sekitar Rp 250.000.', 'katalog/848accac-f654-4df7-9a8d-328dd71f2908.jpg', '[\"katalog\\/28cf2ab3-4ffe-49ea-a639-5ecd11a8a534.jpg\",\"katalog\\/6ef60cca-56de-43e6-85d1-1b95306f5015.jpg\",\"katalog\\/a229cf03-d453-44c9-9497-2a41bc39cb7b.jpg\"]', '2026-07-18 04:19:24', '2026-07-18 04:19:24'),
(136, '136-DS', NULL, 'Eiger Stanford Shoes', 'Eiger', 'sepatu', 'sudah_diperbaiki', '38', 'Hijau', NULL, 78, 'tersedia', 'Sepatu donasi merek Eiger warna hijau ukuran 38 dalam kondisi refurbished, dengan outsole tebal dan grip yang masih bagus namun terdapat sobek atau lubang kecil pada bagian upper. Barang ini tidak dilengkapi aksesoris atau kelengkapan lainnya. Sepatu perlu diperbaiki dengan ganti alas polos (Rp 225.000) dan rapihkan jahitan (Rp 125.000) agar kembali layak pakai.', 'katalog/26f16d15-acde-42a8-b32a-7f64cae3a10d.jpg', '[\"katalog\\/f210b8d4-c659-4513-ad99-05ae95aa0a13.jpg\",\"katalog\\/8d0598cf-98ca-4eb6-8493-534654815af2.jpg\",\"katalog\\/a7ef44cc-3490-4eca-bf02-ee1cc5ef0b84.jpg\"]', '2026-07-18 04:21:58', '2026-07-18 04:21:58'),
(137, '137-DS', NULL, 'Nike LeBron Soldier 11 SFG', 'Nike', 'sepatu', 'sudah_diperbaiki', '44', 'Hitam', NULL, 81, 'tersedia', 'Nike LeBron Soldier 11 SFG warna hitam ukuran 44 ini merupakan sepatu kategori pria dengan kondisi umum *refurbished*. Bagian *outsole* masih tebal dan memiliki *grip* yang masih bagus untuk digunakan. Perlu diperhatikan bahwa sepatu ini memerlukan perbaikan lem press dengan estimasi biaya sekitar Rp210.000. Saat ini barang didonasikan dalam kondisi tanpa kelengkapan tambahan.', 'katalog/8f5aa8bb-f47a-4f35-845b-9d74171cfcf4.jpg', '[\"katalog\\/e83c0822-144c-40f5-929a-15b5c1a1d0f0.jpg\",\"katalog\\/3ed24d2b-4022-46cd-92ec-87ce0593be5d.jpg\",\"katalog\\/e40bf976-3602-4eea-b4ca-9d6302c63842.jpg\"]', '2026-07-18 04:23:34', '2026-07-18 04:23:34'),
(138, '138-DS', NULL, 'Puma Alteration Kurve', 'Puma', 'sepatu', 'sudah_diperbaiki', '42', 'Biru', NULL, 81, 'tersedia', 'Ini adalah sepatu Puma Alteration Kurve ukuran 42 berwarna biru yang kondisinya sudah diperbaiki. Outsole-nya retak dan getas sehingga perlu diganti. Penggantian sol dengan model cupsole (Rp 250.000) wajib dilakukan untuk memulihkannya. Tidak ada aksesori atau kelengkapan tambahan yang disertakan.', 'katalog/61b96a17-b11a-4e90-8a61-be94609cb084.jpg', '[\"katalog\\/a22795f7-7ac0-4c97-b351-85cf0bec6eb0.jpg\",\"katalog\\/62af1ee9-d48a-4c34-be55-8db46f5e38b5.jpg\",\"katalog\\/9b734e2a-1dd2-46a3-8102-b96ea5bc428a.jpg\"]', '2026-07-18 04:25:37', '2026-07-18 04:25:37'),
(139, '139-DS', NULL, 'Nike React Element', 'Nike', 'sepatu', 'sudah_diperbaiki', '39', 'Putih', NULL, 86, 'tersedia', 'Nike React Element ukuran 39 warna putih ini hadir dalam kondisi refurbished tanpa kelengkapan tambahan. Bagian sol luar (outsole) terlihat retak dan getas sehingga perlu diganti dengan sol jadi (cupsole) yang merupakan perbaikan wajib dengan estimasi biaya Rp 250.000. Sepatu ini cocok bagi Anda yang ingin mendapatkan produk Nike dengan sedikit proses restorasi agar kembali layak pakai.', 'katalog/0d5a1724-cf63-4639-8e3c-90c8569e90e7.jpg', '[\"katalog\\/8b7a2115-e3f7-4797-8744-63a8f241f4d6.jpg\",\"katalog\\/4013f008-52ec-4237-b29d-e3b6bdf9476c.jpg\",\"katalog\\/a756fa16-b8e2-4268-ab0b-b21aacdded60.jpg\"]', '2026-07-18 04:35:44', '2026-07-18 08:47:09'),
(140, '140-DS', NULL, 'Converse Chuck Taylor All Star', 'Converse', 'sepatu', 'sudah_diperbaiki', '41', 'Hitam', NULL, 87, 'tersedia', 'Converse Chuck Taylor All Star berwarna hitam ini merupakan produk merek Converse yang telah direfurbrish. Sol sepatu sudah diganti baru melalui proses reglue/resole, sehingga fondasi dasarnya masih dalam kondisi baik. Barang ini tidak dilengkapi dengan aksesoris atau kotak asli. Untuk memastikan kenyamanan maksimal, disarankan melakukan penggantian sol foxing serta alas dengan biaya sekitar Rp275.000, yang merupakan langkah wajib.', 'katalog/e08abfe1-a0e9-4748-9ec2-bdcd5856f5c6.jpg', '[\"katalog\\/6a9b7663-ecec-4d07-96fc-dd69d9a49ffe.jpg\",\"katalog\\/5bed90eb-e9f3-4707-8bd1-58d6267b63d0.jpg\",\"katalog\\/329128dc-74ff-48dc-a355-57d9a496ea9b.jpg\"]', '2026-07-18 04:37:48', '2026-07-18 08:47:59'),
(141, '141-DS', NULL, 'Adidas Superstar', 'Adidas', 'sepatu', 'sudah_diperbaiki', '40', 'Putih', NULL, 71, 'tersedia', 'Ini adalah sepatu Adidas Superstar ukuran 40 berwarna putih yang telah direnovasi. Upper-nya memiliki noda ringan yang dapat dibersihkan, dan terdapat jahitan renggang yang perlu diperbaiki. Perbaikan wajib berupa lem jahit seharga Rp 210.000 sangat disarankan, sementara perawatan upper opsional seharga Rp 90.000 dapat dilakukan untuk hasil terbaik. Tidak ada aksesori tambahan yang disertakan.', 'katalog/db9c674a-77d4-4241-8bcb-a63607c1cda9.jpg', '[\"katalog\\/8780fff7-12b4-4eba-8c32-f376f22d7c1a.jpg\",\"katalog\\/404b60fd-d5db-481a-841d-66f1dbee4a42.jpg\",\"katalog\\/e6b5d49c-a30b-48d5-9431-343194cad19a.jpg\"]', '2026-07-18 04:38:51', '2026-07-18 08:50:01'),
(142, '142-DS', NULL, 'Geox Respina', 'Geox', 'sepatu', 'sudah_diperbaiki', '41', 'Coklat', NULL, 82, 'tersedia', 'Sepatu Geox Respina untuk wanita dengan upper coklat yang terbuat dari bahan berkualitas. Barang ini memiliki ukuran 41 dan sedang dalam kondisi refurbished. Sol (outsole) mengalami retak dan perlu diganti dengan Cupsole bernilai Rp 250.000 untuk memulihkan kenyamanan dan keamanan dalam penggunaan. Upper, jahitan, lem, insole, interior, tali, serta aksesoris dalam kondisi baik tanpa kerusakan signifikan. Barang ini tidak disertakan dengan kelengkapan tambahan.', 'katalog/38f8fd46-b775-44ec-93ec-a0368f1bf746.jpg', '[\"katalog\\/f9d90786-cf1e-476e-8a51-307539e0da50.jpg\",\"katalog\\/eb3ede1e-d0da-4e36-96ff-b8ead6ec1440.jpg\",\"katalog\\/42b6cc28-e39d-40a7-9399-bdf61769ae31.jpg\"]', '2026-07-18 04:39:32', '2026-07-18 08:51:38'),
(143, '143-DS', NULL, 'Sepatu Hak', 'Rockport', 'sepatu', 'sudah_diperbaiki', '39', 'Hitam', NULL, 69, 'tersedia', 'Sepatu hak merek Rockport warna hitam ukuran 39 ini dalam kondisi refurbished. Kondisi upper terdapat noda ringan yang bisa dibersihkan, namun ada bagian lem yang mulai lepas pada jahitan yang perlu diperbaiki. Barang ini memerlukan perbaikan lem/jahit (sekitar Rp210.000) dan opsional upper treatment (sekitar Rp90.000) agar kembali maksimal. Produk ini dijual tanpa kelengkapan lainnya.', 'katalog/e0819c02-4acf-477c-be65-82701260c4f2.jpg', '[\"katalog\\/1f9023c9-d038-4b03-858c-17cb32feb4f6.jpg\",\"katalog\\/68c7dd7c-762b-49b0-af90-6a7f8f4384ac.jpg\",\"katalog\\/4b7a4a3d-35f2-4e43-b981-60596eade4e9.jpg\"]', '2026-07-18 04:40:31', '2026-07-18 08:53:42'),
(144, '144-DS', NULL, 'Sepatu Hak', NULL, 'sepatu', 'sudah_diperbaiki', '38', 'Hitam', NULL, 71, 'tersedia', 'Sepatu Hak ukuran 38 berwarna hitam dengan kondisi refurbished, sol tebal yang masih memiliki grip yang baik. Upper tidak ada kelengkapan, namun tidak ada celah atau kerusakan terlihat. Jahitan, lem, insole, serta aksesoris seperti tali tidak ada, sehingga diperlukan perbaikan. Rekomendasi perbaikan lem jahit diperlukan dengan biaya sekitar Rp 210.000.', 'katalog/82b5d69c-6218-43ac-8511-7a6a8cfba3dd.jpg', '[\"katalog\\/ac500fe0-7f85-467f-b110-edc9ae6e1525.jpg\",\"katalog\\/94a834c8-d1c4-4854-b96b-51e8e2c3ea72.jpg\",\"katalog\\/505a892f-5d05-4ce1-a39c-241c1685d0c5.jpg\"]', '2026-07-18 04:41:19', '2026-07-18 08:54:31'),
(145, '145-DS', NULL, 'Nike Air Jordan 6 Retro Gatorade', 'Nike', 'sepatu', 'sudah_diperbaiki', '40', 'Putih', NULL, 81, 'tersedia', 'Nike Air Jordan 6 Retro Gatorade, merek Nike, ukuran 40, warna putih, dalam kondisi refurbished. Outsole menunjukkan retakan atau getasan, sehingga diperlukan perbaikan midsole non flat dengan biaya sekitar Rp 355.000. Tidak ada kelengkapan tambahan yang disertakan.', 'katalog/871f31ac-590b-478b-bcec-02328e792e74.jpg', '[\"katalog\\/99b56c96-f1c3-4005-89f9-7852dac5b20d.jpg\",\"katalog\\/c896c4dc-6fe1-4cd4-876a-44dfc38c9552.jpg\",\"katalog\\/d735bfcd-e6bd-4aa5-b54d-c4f355f790fe.jpg\"]', '2026-07-18 04:42:33', '2026-07-18 08:55:22'),
(146, '146-DS', NULL, 'Sandal Pria', 'Birkenstock', 'sepatu', 'sudah_diperbaiki', '42', NULL, NULL, 81, 'tersedia', 'Sandal pria merek Birkenstock ukuran 42 ini berada dalam kondisi refurbished, namun solnya menunjukkan retak atau getas. Barang ini tidak dilengkapi dengan aksesori atau kelengkapan tambahan. Untuk menjadikannya layak pakai, diperlukan perbaikan midsole flat (Rp 305.000), pengganti alas polos (Rp 225.000), serta insole kulit (Rp 125.000).', 'katalog/22fc129f-34db-4631-bf06-4217baf433b6.jpg', '[\"katalog\\/549612c6-c143-41d0-8312-9de7af13797c.jpg\",\"katalog\\/2fba6130-0540-49d4-86fc-a38f2f902956.jpg\",\"katalog\\/b7a877c5-a901-480e-b3c9-53173054d174.jpg\"]', '2026-07-18 04:43:10', '2026-07-23 03:55:47'),
(147, '147-DS', NULL, 'Sandal Pria', 'Kenzo', 'sepatu', 'sudah_diperbaiki', '42', NULL, NULL, 83, 'tersedia', 'Sandal pria merek Kenzo ukuran 42 ini hadir dalam kondisi *refurbished* dan siap pakai dengan catatan perlunya perawatan pada bagian lem yang mulai lepas. Upper dan sol secara umum masih layak digunakan, namun untuk memastikan ketahanan jangka panjang, barang ini wajib melalui proses Lem Press dengan biaya estimasi Rp 210.000. Dijual tanpa kelengkapan kotak atau dustbag asli. Cocok untuk pembeli yang siap melakukan perbaikan kecil agar barang kembali optimal.', 'katalog/c9df8155-f2e9-49dd-857a-5acdbc4a5a38.jpg', '[\"katalog\\/52aabd29-78b5-424c-bf2e-e4ddba08924b.jpg\",\"katalog\\/b196d41c-0a76-46b5-8f59-c1bb0f6febea.jpg\",\"katalog\\/7cd7505e-e74a-49e6-b686-b4b6bf9078df.jpg\"]', '2026-07-18 04:43:48', '2026-07-23 03:54:01'),
(148, '148-DS', NULL, 'Sandal', 'Crocs', 'sepatu', 'sudah_diperbaiki', '44', NULL, NULL, 70, 'tersedia', 'Sandal Crocs ukuran 44 dengan kondisi refurbished, terlihat bersih pada bagian atas dan tidak ada noda. Tidak ada kelengkapan tambahan yang disertakan. Barang ini memerlukan perbaikan alas komponen serta lem. Biaya perbaikan diperkirakan Rp180.000.', 'katalog/70ce6f27-5911-4ca0-a5da-34f210e7c491.jpg', '[\"katalog\\/08fdb4c2-7d35-4135-96ec-76825ed00a21.jpg\",\"katalog\\/b73cff8b-a93b-4d5d-819f-3efa28b82cb2.jpg\",\"katalog\\/c77959de-fb84-4dfd-8e68-c7c07efcb59b.jpg\"]', '2026-07-18 04:44:57', '2026-07-23 03:52:38'),
(149, '149-DS', NULL, 'Nike Zoom Fly', 'Nike', 'sepatu', 'sudah_diperbaiki', '40', 'Pink', NULL, 81, 'tersedia', 'Donasi sepatu Nike Zoom Fly warna pink ukuran 40 ini dalam kondisi refurbished. Perlu diperhatikan bahwa bagian sol (outsole) sudah mulai tipis atau aus di beberapa titik tertentu. Sepatu ini memerlukan perbaikan lem dan jahit dengan estimasi biaya sekitar Rp210.000 untuk mengembalikan fungsinya secara maksimal. Barang ini dijual tanpa kelengkapan tambahan.', 'katalog/7f49314c-ab15-4d21-b6bf-9c70ea4af5da.jpg', '[\"katalog\\/c2b8e701-7701-4906-be56-a7f17dd1e298.jpg\",\"katalog\\/09af8db8-3865-4982-b068-04c03e10c32d.jpg\",\"katalog\\/a5318eb6-b903-4bd8-a4a9-854d9900a373.jpg\"]', '2026-07-18 04:46:42', '2026-07-23 03:51:42'),
(150, '150-DS', NULL, 'Puma X Ferarri', 'Puma', 'sepatu', 'sudah_diperbaiki', '42', 'Hitam', NULL, 70, 'tersedia', 'Barang donasi ini adalah sepatu Puma X Ferrari dengan ukuran 42 dan warna hitam. Sejak ini adalah model refurbished, jadi kondisinya masih cukup baik secara umum. Namun, terdapat beberapa kekurangan fisik seperti crack pada swoosh dan bagian upper yang mulai pecah (Quarter-M). Oleh karena itu, sepatu ini memerlukan perbaikan upper pola sedang dengan biaya sebesar Rp 225.000 untuk memulihkan kualitasnya. Cocok untuk disetor ke lembaga atau dijual kembali setelah perbaikan.', 'katalog/87b56b91-3bc2-4269-9d97-15e6cccb036d.jpg', '[\"katalog\\/c2084073-f73d-4c33-8a70-b2e989300a76.jpg\",\"katalog\\/358558fb-6fca-4c4c-a063-72f322907db1.jpg\",\"katalog\\/402c7be4-2aef-4a9d-99cb-ddf06a0a4653.jpg\"]', '2026-07-18 04:48:03', '2026-07-23 03:50:49'),
(151, '151-DS', NULL, 'Adidas Ace 16+ PureControl Ultra Boost', 'Adidas', 'sepatu', 'sudah_diperbaiki', '42', 'Hitam', NULL, 81, 'tersedia', 'Sepatu Adidas Ace 16+ PureControl Ultra Boost ukuran 42 warna hitam ini bermerek Adidas dengan kondisi umum *refurbished*. Barang dikirimkan tanpa kelengkapan kotak atau aksesoris tambahan. Terdapat keretakan pada bagian *stip* yang perlu diperhatikan. Sepatu ini wajib melakukan perbaikan lem jahit agar struktur kembali kuat dan nyaman dipakai, dengan estimasi biaya reparasi sebesar Rp 210.000. Cocok bagi Anda yang siap mengurus perbaikan terlebih dahulu untuk mendapatkan sepatu performa tinggi dengan harga terjangkau.', 'katalog/c04a2fb7-c090-496a-9198-4bf2a0e15f35.jpg', '[\"katalog\\/e33aa9be-c066-4398-a47f-9540a592c67b.jpg\",\"katalog\\/d38c2b22-49ea-4fa8-9bbe-96b20c37e9c7.jpg\",\"katalog\\/6a1c1c3c-33a6-4a3f-9261-16b7e2469952.jpg\"]', '2026-07-18 04:50:18', '2026-07-23 03:49:32'),
(152, '152-DS', NULL, 'Slip On', NULL, 'sepatu', 'sudah_diperbaiki', '41', 'Coklat', NULL, 79, 'tersedia', 'Sepatu slip‑on ini memiliki ukuran 41, warna coklat, dan sedang dalam kondisi refurbished dengan sol luar retak. Sol (outsole) memerlukan penggantian ke cupsole (biaya Rp 250.000) dan bagian atas (upper) harus diperbaiki dengan pola standar (Quarter‑S) (biaya Rp 175.000). Jahitan, bahan upper, interior, serta aksesoris lainnya tidak ada kelengkapan tambahan. Barang ini cocok untuk diperbaiki menjadi gaya sepatu yang lebih sempurna.', 'katalog/9ae0e060-4d83-41ae-a336-8eea59643469.jpg', '[\"katalog\\/38b3e6a2-9af2-4976-8591-cb4da37021c8.jpg\",\"katalog\\/7dd646d8-456a-4650-a2d0-d7ba24e5bfda.jpg\",\"katalog\\/07915cae-4a2d-4672-8bae-aa54d4aa014d.jpg\"]', '2026-07-18 04:51:18', '2026-07-23 03:48:41'),
(153, '153-DS', NULL, 'Adidas Purebounce Plus Street', 'Adidas', 'sepatu', 'sudah_diperbaiki', '45', 'Hitam', NULL, 87, 'tersedia', 'Sebuah sepatu Adidas Purebounce Plus Street ukuran 45 dengan warna hitam, dalam kondisi refurbished. Upper bersih tanpa noda, tapi alas polos memerlukan penggantian dengan biaya Rp 225.000. Tidak memiliki kelengkapan aksesoris seperti tali atau lem. Cocok untuk donasi, tapi perlu perbaikan awal sebelum digunakan. Rekomendasi: ganti alas polos dulu agar aman untuk pengguna.', 'katalog/6339abeb-5f16-4c19-9de4-6f132a4ff5a0.jpg', '[\"katalog\\/03a696a7-6ab1-452b-b540-a1b7aafce16c.jpg\",\"katalog\\/5522f63b-657e-4fd0-b8ac-2a66bc6d5dc2.jpg\",\"katalog\\/04925368-3291-4208-a371-3d0710226f1b.jpg\"]', '2026-07-18 06:50:28', '2026-07-23 03:47:25'),
(154, '154-DS', NULL, 'Nike Air Jordan 33 SE', 'Nike', 'sepatu', 'sudah_diperbaiki', '44', 'Hitam', NULL, 82, 'tersedia', 'Nike Air Jordan 33 SE, ukuran 44, warna hitam, dalam kondisi refurbished. Sol (outsole) masih baik, upper ada noda ringan yang dapat dibersihkan, jahitan dan lem terlihat baik, insole serta interior memadai, sedangkan tali dan aksesoris tidak tersedia serta tidak ada kelengkapan. Karena midsole sudah datar, perbaikan ini diperlukan dengan biaya Rp305.000. Selain itu, alas polos harus diganti dengan biaya tambahan Rp225.000.', 'katalog/b0e317ee-7e5f-474a-adcc-0a5341de6a97.jpg', '[\"katalog\\/d9643ed1-399e-444a-989e-269563fa8b34.jpg\",\"katalog\\/80fe1dd0-7508-4455-94bf-9e1d8d0eb9d6.jpg\",\"katalog\\/d3eb60fa-c868-4bac-8492-d97baa899167.jpg\"]', '2026-07-18 06:51:34', '2026-07-23 03:45:59'),
(155, '155-DS', NULL, 'Flat Shoes', 'Hush Pupies', 'sepatu', 'sudah_diperbaiki', '41', 'Coklat', NULL, 87, 'tersedia', 'Donasi Flat Shoes merek Hush Puppies berwarna coklat dengan ukuran 41. Kondisi barang ini adalah refurbished, namun bagian sol (outsole) saat ini dalam keadaan retak/getas. Barang ini memerlukan perbaikan wajib berupa penggantian sol menjadi cupsole dengan estimasi biaya sekitar Rp 250.000. Harap diperhatikan bahwa barang tidak dilengkapi dengan kemasan atau aksesoris tambahan.', 'katalog/35bfbc01-38ea-4db0-8d44-3e397da124bb.jpg', '[\"katalog\\/ce87193b-b4ce-4bde-921b-6f9c15598ea8.jpg\",\"katalog\\/421ee37c-4e00-4338-b720-0c315f7338b1.jpg\",\"katalog\\/1ec27d18-4f7c-4d56-be87-b1b10c4c2ac5.jpg\"]', '2026-07-18 06:52:18', '2026-07-23 03:44:44'),
(156, '156-DS', NULL, 'Sepatu Flat Shoes', 'Alexander Mcqueen', 'sepatu', 'sudah_diperbaiki', '44', 'Putih', NULL, 89, 'tersedia', 'Sepatu Flat Shoes merek Alexander McQueen ukuran 44 berwarna putih, kondisi refurbished dengan outsole tebal dan grip masih baik. Data spesifik mengenai upper, jahitan & lem, insole & interior, serta tali dan aksesoris tidak tersedia, dan barang ini tidak dilengkapi dengan apa pun. Untuk memakai sepatu ini, diperlukan penggantian upper pola sedang (Quarter‑M) dengan biaya Rp225.000 serta pembongkaran sole seharga Rp125.000, keduanya wajib dilakukan. Dengan perbaikan tersebut, sepatu dapat kembali digunakan secara nyaman dan aman.', 'katalog/9e2532c5-b3b4-4fbd-8364-7767839f4278.jpg', '[\"katalog\\/f2c24a6b-59c1-476c-a276-23ca8142622c.jpg\",\"katalog\\/1b7f3b24-c63d-432f-a157-9e595f16ef0a.jpg\",\"katalog\\/be4081c7-23f2-404e-8562-20571f0a456c.jpg\"]', '2026-07-18 06:53:05', '2026-07-23 03:43:43'),
(158, '158-DS', NULL, 'Work Shoes', 'Caterpilar', 'sepatu', 'sudah_diperbaiki', '42', 'Coklat', NULL, 82, 'tersedia', 'Work Shoes Caterpilar ukuran 42 coklat ini adalah donasi yang telah terrefurbished. Sol (outsole) berretak/getas sehingga memerlukan penggantian sol potong dengan biaya Rp 300.000. Condisi upper, jahitan, insole, dan tali tidak disebutkan berdampak besar, tapi rekomendasi ganti sol wajib dilakukan. Jika ingin memperbaiki upper, dapat dilakukan treatment dengan biaya Opsional Rp 90.000. Barang ini tidak melengkapi aksesoris.', 'katalog/4be2d098-c9a8-4031-8cd0-d32bc66e9cfd.jpg', '[\"katalog\\/63d034e7-a3a2-4902-b6b7-ab60085b1709.jpg\",\"katalog\\/b59475f1-f5dc-430f-a8cf-0a01a5657914.jpg\",\"katalog\\/f19a48d0-0fb7-42aa-b026-29a8bf1373ca.jpg\"]', '2026-07-18 06:54:17', '2026-07-23 03:42:04'),
(159, '159-DS', NULL, 'Pantofel', 'Playboy', 'sepatu', 'sudah_diperbaiki', '41', 'Hitam', NULL, 83, 'tersedia', 'Pantofel Playboy ukuran 41 dengan warna hitam, kini dalam kondisi refurbished. Upper menunjukkan tanda pudar, sehingga membutuhkan perawatan agar tampil kembali optimal. Untuk memastikan kualitas, sebaiknya ganti sol menjadi cupsole dengan biaya Rp250.000, sementara repaint khusus dapat dilakukan secara opsional dengan biaya Rp195.000.', 'katalog/a771cf8d-8ab4-4f7f-97cb-56f2a1a93ddc.jpg', '[\"katalog\\/9aa10868-8739-47d4-a3c3-caf91ba9d966.jpg\",\"katalog\\/1acd666c-e002-43cb-9490-cc4940dcd142.jpg\",\"katalog\\/ef4323a9-b4b1-452f-bc4c-c37788cf840d.jpg\"]', '2026-07-18 06:54:54', '2026-07-23 03:40:19'),
(160, '160-DS', NULL, 'Nike Zoom', 'Nike', 'sepatu', 'sudah_diperbaiki', '44', 'Abu', NULL, 84, 'tersedia', 'Sepatu Nike Zoom ukuran 44 berwarna abu-abu ini merupakan barang refurbish dengan sol yang sudah diganti baru (reglue/resole). Upper dan interiornya masih dalam kondisi baik, namun direkomendasikan untuk mengganti sol dengan model cupsole dengan biaya sekitar Rp250.000. Barang ini siap untuk digunakan setelah perbaikan tersebut dilakukan dan dapat menjadi donasi yang bermanfaat bagi penerima.', 'katalog/417a7556-c47a-4a00-afce-1275bb4744b2.jpg', '[\"katalog\\/98b43e99-276c-45b4-8965-4ed7a93aa72b.jpg\",\"katalog\\/867587b4-efac-4e5a-a18c-8f9274ca7b92.jpg\",\"katalog\\/11eedf2b-9372-48a6-bf50-dd0415e1c25f.jpg\"]', '2026-07-18 06:56:22', '2026-07-18 09:07:35'),
(161, '161-DS', NULL, 'Balenciaga Speed Runners', 'Balenciaga', 'sepatu', 'sudah_diperbaiki', '40', 'Hitam', NULL, 87, 'tersedia', 'User Safety: safe', 'katalog/b27ff7ea-cbf0-4229-ab71-961b3dc5e410.jpg', '[\"katalog\\/2135ab53-ef8a-434f-940f-8931ccb944dd.jpg\",\"katalog\\/dbcca065-9546-4084-9d93-8cc1602996bf.jpg\",\"katalog\\/b094dcca-be8b-4295-8476-3a047ed12ce8.jpg\"]', '2026-07-18 06:56:59', '2026-07-18 09:06:23'),
(162, '162-DS', NULL, 'Yonex SHB 65 Z3', 'Yonex', 'sepatu', 'sudah_diperbaiki', '42', 'Putih', NULL, 86, 'tersedia', 'Yonex SHB 65 Z3 ukuran 42 warna putih dalam kondisi refurbished, dengan bagian lem jahitan yang mulai lepas dan lacesguard yang mengelupas. Barang ini tidak memiliki kelengkapan tambahan dan perlu dilakukan lem jahit seharga Rp 210.000 sebagai perbaikan wajib. Penggantian upper pola standard (Quarter-S) seharga Rp 175.000 juga tersedia sebagai opsi perbaikan tambahan.', 'katalog/56d9dab3-209f-48e2-9838-529c1bc33674.jpg', '[\"katalog\\/993c3363-9723-4ffa-b914-f934b654d2de.jpg\",\"katalog\\/3216cd49-c21e-461d-8766-3cca9d300d5b.jpg\",\"katalog\\/11dff28f-07d5-4f7c-960f-317eb1461a7e.jpg\"]', '2026-07-18 06:58:08', '2026-07-18 09:04:54'),
(163, '163-DS', NULL, 'Diadora Ilario', 'Diadora', 'sepatu', 'sudah_diperbaiki', '43', 'Abu', NULL, 96, 'tersedia', 'Deskripsi Barang:  \r\nSandal Donasi Diadora Ilario ukuran 43, warna abu, kondisi refurbished. Berisi lem jahit yang mulai lepas di bagian sol yang perlu diperbaiki. Bahan upper tidak disebutkan, insole dan interior masih dalam kondisi wajar. Tidak ada kelengkapan tambahan.  \r\n\r\nRekomendasi Perbaikan:  \r\nPerbaikan wajib untuk lem jahit di sol dengan biaya Rp 210.000. Lainnya, barang masih bisa digunakan setelah diperbaiki.', 'katalog/aaa57831-cd38-43b4-81c7-2d690de8cc8f.jpg', '[\"katalog\\/6d07c52e-55af-4c62-84c4-b170241c9f44.jpg\",\"katalog\\/1d7c6ec7-f158-4fbf-9606-a7a7001d9343.jpg\",\"katalog\\/a097f4f5-86f4-4a67-b822-63bdcbad2350.jpg\"]', '2026-07-18 06:59:22', '2026-07-18 09:01:42'),
(164, '164-DS', NULL, 'Skechers GOrun Elevate-Accelerate', 'Skechers', 'sepatu', 'sudah_diperbaiki', '42', 'Hitam', NULL, 91, 'tersedia', 'Skechers GOrun Elevate-Accelerate ukuran 42 berwarna hitam, challenges dalam kondisi refurbished. Uppernya masih memelihara tampilan aslinya, namun terdapat bagian lem jahitan yang mulai lepas, membuat tampilan sedikit tidak rata. Tidak dilengkapi tali atau aksesoris tambahan. Barang ini memerlukan perbaikan Lem Jahit sebesar Rp 210.000 agar tetap nyaman dan aman dipakai.', 'katalog/70bd4767-d51b-4b6f-a9a7-786db42025ec.jpg', '[\"katalog\\/866024e2-1ef3-4027-8572-b3f74b231099.jpg\",\"katalog\\/49e62b17-af99-47eb-b11a-e31b3414f16a.jpg\",\"katalog\\/556a4299-98dd-42c5-8340-b2d8e57eef29.jpg\"]', '2026-07-18 07:00:42', '2026-07-18 09:00:15'),
(165, '165-DS', NULL, 'Skechers Monster', 'Skechers', 'sepatu', 'sudah_diperbaiki', '40', 'Putih', NULL, 88, 'tersedia', 'Sepatu Skechers Monster ukuran 40 warna putih ini hadir dalam kondisi refurbished dengan sol tebal yang masih memiliki grip baik. Barang ini tidak dilengkapi kelengkapan tambahan dan memerlukan perbaikan wajib berupa ganti upper pola standard (Quarter-S) seharga Rp175.000 serta bongkar sole seharga Rp125.000. Dengan perawatan dan reparasi tersebut, sepatu ini masih layak digunakan sebagai donasi untuk kebutuhan sehari-hari.', 'katalog/4c339eae-ce3e-4cbe-ab48-4c9ab4003e85.jpg', '[\"katalog\\/e0250dfd-6e71-4578-a5e7-b7c329c05a44.jpg\",\"katalog\\/c9ca3b32-6466-4088-932d-1aba5442e935.jpg\",\"katalog\\/fec253ef-5e99-4a03-8a80-57d7da2609b6.jpg\"]', '2026-07-18 07:03:43', '2026-07-18 08:59:19'),
(166, '166-DS', NULL, 'Sepatu Kulit', NULL, 'sepatu', 'sudah_diperbaiki', '43', 'Coklat', NULL, 89, 'tersedia', 'Ini adalah sepatu kulit ukuran 43 berwarna coklat yang sudah diperbaiki (refurbished). Bagian solnya menunjukkan lem yang mulai lepas dan memerlukan pembongkaran sol serta perbaikan lapisan kulit di sekelilingnya, dengan biaya sekitar Rp 125.000 untuk masing-masing perbaikan. Sepatu ini siap pakai setelah perbaikan tersebut dilakukan. Tidak ada tali atau aksesori tambahan yang disertakan.', 'katalog/9e427e72-77a2-4063-aa4e-ba2ad2c449f4.jpg', '[\"katalog\\/55352fd5-debd-4f09-a98e-e4ec12984023.jpg\",\"katalog\\/8341c34a-b8e1-4ff9-b6d6-8e54024c6d28.jpg\",\"katalog\\/5a8e4ae1-afa0-46e5-a34f-ac164dc2efdf.jpg\"]', '2026-07-18 07:04:43', '2026-07-18 08:57:15'),
(167, '167-DS', NULL, 'Adidas Crazy Explosive', 'Adidas', 'sepatu', 'sudah_diperbaiki', '43', 'Hitam', NULL, 76, 'tersedia', 'Sepatu Adidas Crazy Explosive untuk pria, ukuran 43, warna hitam. Sepatu ini memiliki bahan upper berkualitas dan dirancang untuk aktivitas olahraga. Namun, dalam kondisi umum refurbished, terdapat kerusakan fisik seperti retak/getas pada sol (outsole). Untuk mengoptimalkan penggunaan, sebutkan secara ringkas dan natural bahwa barang ini memerlukan perbaikan tersebut dengan rincian biayanya: Ganti Sol Jadi (Cupsole) sebesar Rp 250.000 dan Lapis Kulit Keliling sebesar Rp 125.000, kedua perbaikan tersebut wajib dilakukan. Tali dan aksesoris sepenuhnya tersedia, tetapi tidak ada kelengkapan tambahan.', 'katalog/70357f7f-02c3-47a2-8ef4-c09466967586.jpg', '[\"katalog\\/2ba04245-d624-4c5b-93da-f99f1db6e435.jpg\",\"katalog\\/8f7412bf-287a-41eb-a44e-e3e147002aea.jpg\",\"katalog\\/39815c98-eab9-4466-8471-9228c93d71fb.jpg\"]', '2026-07-18 07:05:38', '2026-07-23 03:20:41'),
(168, '168-DS', NULL, 'New Balance 997 Sport', 'New Balance', 'sepatu', 'sudah_diperbaiki', '40,5', 'Hitam', NULL, 74, 'tersedia', 'New Balance 997 Sport ukuran 40,5 berwarna hitam, masih dalam kondisi refurbished.  \r\nNamun terdapat kerusakan midsole shareholders dan laceguard.  \r\nUntuk memperbaikinya, dibutuhkan perbaikan Midsole Non Flat seharga Rp 355.000 dan penggantian Upper Pola Standard (Quarter‑S) seharga Rp 175.000.  \r\nBarang ini tidak dilengkapi aksesoris tambahan dan memerlukan perbaikan tersebut agar layak dipakai.', 'katalog/5ec87904-35a7-46f9-bd60-85cb30c4e996.jpg', '[\"katalog\\/9732fec5-10ed-49c5-b8c4-ec92babde0ad.jpg\",\"katalog\\/e96ac5fa-2eae-4cd6-9915-fdbc97e574c6.jpg\",\"katalog\\/98e8cfc2-8a0d-4216-a680-649448829237.jpg\"]', '2026-07-18 07:06:34', '2026-07-23 03:12:10'),
(169, '169-DS', NULL, 'Reebok RBK Destination Mid', 'Reebok', 'sepatu', 'sudah_diperbaiki', '42', 'Putih', NULL, 82, 'tersedia', 'Donasi sepatu Reebok RBK Destination Mid berwarna putih dengan ukuran 42. Kondisi bagian upper sudah bersih dan bebas dari noda, namun barang ini merupakan produk *refurbished* yang memerlukan perbaikan wajib pada bagian alas dan lem dengan estimasi biaya sekitar Rp180.000. Perlu diketahui bahwa barang ini tidak memiliki kelengkapan tambahan.', 'katalog/e16e3a60-b15b-4c5d-b58d-39e9b65a14f7.jpg', '[\"katalog\\/990f15a3-4056-480e-bd83-087a6e285f87.jpg\",\"katalog\\/453a6e8a-b252-47fd-916c-7d2a8d1d9dfe.jpg\",\"katalog\\/e0500fab-02b2-403d-9f88-28c2fbe1232c.jpg\"]', '2026-07-18 07:07:50', '2026-07-23 02:56:28'),
(170, '170-DS', NULL, 'Compass Gazelle Hi Black Gum', 'Compass', 'sepatu', 'sudah_diperbaiki', '42', '81', NULL, NULL, 'tersedia', 'Sepatu Compass Gazelle Hi Black Gum ini memiliki ukuran 42 dengan warna kode 81, cocok untuk semua gender. Barang dalam kondisi Refurbished dengan sol yang tebal dan grip masih bagus, sedangkan upper menampilkan noda ringan yang bisa dibersihkan. Jahitan dan lem terlihat rapi tanpa ada yang lepas, namun insole serta aksesoris tidak tersedia. Perlu dilakukan perawatan Upper (Rp90.000) untuk memperbaiki penampilan secara optimal.', 'katalog/dec66d98-5d5e-4432-a456-13d0c2202039.jpg', '[\"katalog\\/33602be2-bf26-4ccb-8807-d3aebc2b8aa3.jpg\",\"katalog\\/60e71fb3-36e6-4cc9-9333-fe8c47df2f1e.jpg\",\"katalog\\/e661c560-60e2-494a-b3c2-fd01aa7d6c69.jpg\"]', '2026-07-18 07:08:57', '2026-07-23 02:55:09'),
(171, '171-DS', NULL, 'Slip On', 'Superga', 'sepatu', 'sudah_diperbaiki', '37', NULL, NULL, 81, 'tersedia', 'Slip On Superga ukuran 37 dengan kondisi refurbished menampilkan desain klasik yang sudah dipakai. Outsole menunjukkan retak pada bagian sol, yang memerlukan penggantian. Untuk memulihkan kualitas dan keselamatan sepatu, diperlukan penggantian sol Foxing serta alas seharga Rp275.000. Selain itu, sepatu tidak menyertakan kelengkapan tambahan.', 'katalog/ef9d1d09-2e2e-4dbe-b05a-454257938090.jpg', '[\"katalog\\/e84ebc44-e066-451d-8e74-56b04ec99b53.jpg\",\"katalog\\/a81ce1d0-fd0b-4ca0-9019-2b786887009f.jpg\",\"katalog\\/fdc6168b-f4ea-4d68-8dcd-8e2929b9d85a.jpg\"]', '2026-07-18 07:09:36', '2026-07-23 02:53:56'),
(172, '172-DS', NULL, 'Sepatu Hak', 'Hush Pupies', 'sepatu', 'sudah_diperbaiki', '37', NULL, NULL, 56, 'tersedia', 'Sepatu Hak merek Hush Pupies ukuran 37 dalam kondisi refurbished, dengan lapisan dalam yang mulai mengelupas dan tidak dilengkapi aksesoris tambahan. Karena kondisi insole yang aus dan upper yang perlu diganti, sepatu ini memerlukan perbaikan: penggantian upper pola standard (Quarter‑S) sebesar Rp175.000, pemasangan insole kulit sebesar Rp125.000, serta pembongkaran sole sebesar Rp125.000. Setelah perbaikan dilakukan, sepatu siap untuk digunakan kembali.', 'katalog/637e9b23-9dae-4313-8779-627b6938e080.jpg', '[\"katalog\\/ca7239fb-737d-4f47-8a71-87d30de007a9.jpg\",\"katalog\\/25f7162a-8020-428e-a1e1-fe73cda067f7.jpg\",\"katalog\\/f6d143fb-69a6-404c-9282-2399c1e7c685.jpg\"]', '2026-07-18 07:10:14', '2026-07-23 02:52:03'),
(173, '173-DS', NULL, 'Sepatu Hak', 'Obermain', 'sepatu', 'sudah_diperbaiki', '37', NULL, NULL, 59, 'tersedia', 'Sepatu Hak dari merek Obermain dengan ukuran 37 ini dikondisikan refurbished, namun memerlukan perhatian khusus terkait kondisi fisiknya. Sol (outsole) terdapat retak/getas, sementara upper, jahitan, insole, dan tali tidak disebutkan kondisinya. Barang ini tidak dilengkapi dengan aksesori tambahan. Untuk memperbaiki kualitasnya, disarankan melakukan perbaikan Midsole Non Flat (Rp 355.000) dan penggantian alas polos (Rp 225.000), keduanya wajib dilakukan agar sepatu kembali nyaman digunakan.', 'katalog/d88e8dfc-1e32-49f5-84e2-52b8625efe05.jpg', '[\"katalog\\/dac53761-aad2-4d23-8352-d1c37b6faf37.jpg\",\"katalog\\/b5229ae8-1d30-4eb3-a37f-c272ed6635f2.jpg\",\"katalog\\/0c47b805-af21-4280-a659-5e02ca663053.jpg\"]', '2026-07-18 07:10:46', '2026-07-23 02:50:02');
INSERT INTO `donation_items` (`id`, `kode_barang`, `donation_id`, `nama`, `brand`, `kategori`, `kondisi`, `ukuran`, `warna`, `berat`, `score_kelayakan`, `status`, `deskripsi`, `foto_utama_path`, `foto_detail`, `created_at`, `updated_at`) VALUES
(174, '174-DS', NULL, 'Skechers Moonhiker', 'Skechers', 'sepatu', 'sudah_diperbaiki', '37', 'Pink', NULL, 67, 'tersedia', 'Skechers Moonhiker Ukuran 37 Warna Pink Kondisi Refurbished dengan bahan upper yang tidak jelas. Bagian sole (outsole) dan jahitan/lem memiliki kelemahan yaitu lem mulai lepas. Untuk memulihkan kualitasnya, diperlukan perbaikan berupa ganti upper pola standard (quarter-S) sebesar Rp175.000 (x2) serta bongkar sole sebesar Rp125.000. Total biaya perbaikan mencapai Rp475.000. Barang ini tidak dilengkapi dengan aksesoris tambahan.', 'katalog/bc78aeee-44ac-4e9d-8510-16ebe1ab298c.jpg', '[\"katalog\\/3bb64895-e6d3-415f-ab0b-4ae0363a3961.jpg\",\"katalog\\/79ff9d8b-5ab9-46de-8f8d-9afc14fab5f3.jpg\",\"katalog\\/8fe0dacb-a3a8-43e6-9eb2-d5739cf5f730.jpg\"]', '2026-07-18 07:11:46', '2026-07-23 02:47:15'),
(175, '175-DS', NULL, 'Nike Air Jordan 1 Mid', 'Nike', 'sepatu', 'sudah_diperbaiki', '43', NULL, NULL, 55, 'tersedia', 'Sepatu Nike Air Jordan 1 Mid ukuran 43 dalam kondisi refurbished dengan perbaikan total pada upper serta kebutuhan ganti sol menjadi cupsole (Rp 250.000). Bahan upper, warna, jahitan, lem, insole, interior, tali, serta kelengkapan tidak disebutkan. Barang memerlukan perbaikan upper keseluruhan dan pemasangan sol baru untuk kondisi final.', 'katalog/a7d4ab9e-06d8-4906-9d66-a0d34a55d9df.jpg', '[\"katalog\\/e7716291-cda7-4cc4-9fed-650ccb345d4a.jpg\",\"katalog\\/b9e359d8-a61f-47d1-892c-8900db9bd389.jpg\",\"katalog\\/7c5a9315-f55e-4d50-9c92-224155fb2ed8.jpg\"]', '2026-07-18 07:12:34', '2026-07-23 02:42:50'),
(177, '177-DS', NULL, 'Flatshoes', 'Puma', 'sepatu', 'sudah_diperbaiki', '41', 'Coklat', NULL, 81, 'tersedia', 'Ini adalah sepatu Puma Flatshoes ukuran 41 dengan warna coklat, kondisi refurbished. Sol luar (outsole) sudah retak sehingga membutuhkan penggantian sol foxing dan alas dengan biaya Rp275.000. Selain itu, diperlukan penggantian tambah TA seharga Rp125.000 dan penggantian upper pola standar quarter‑S seharga Rp175.000. Setelah perbaikan, sepatu ini akan kembali layak dipakai.', 'katalog/7367f7f3-c9d7-4137-9691-e78b463d5edd.jpg', '[\"katalog\\/75f5dcc3-6dc3-4af4-a256-728fc197d4fc.jpg\",\"katalog\\/f2af1b2a-c427-4cb2-a545-14c1ee45159e.jpg\",\"katalog\\/d225555e-5dd4-4562-b485-932059247d6f.jpg\"]', '2026-07-18 07:13:42', '2026-07-23 02:41:02'),
(178, '178-DS', NULL, 'Converse Chuck Taylor All Star', 'Converse', 'sepatu', 'sudah_diperbaiki', '44', 'BIru', NULL, 87, 'tersedia', 'Sepatu Converse Chuck Taylor All Star ukuran 44 warna biru ini berstatus refurbished dengan upper yang masih utuh namun terdapat noda membandel. Kondisi fisik secara keseluruhan layak pakai, namun sol (outsole) dan foxing memerlukan penggantian segera demi kenyamanan dan keamanan beraktivitas. Perbaikan wajib berupa ganti sol foxing serta alas telah direkomendasikan dengan estimasi biaya Rp 275.000. Barang dikirimkan tanpa kelengkapan kotak atau dustbag asli. Cocok untuk Anda yang siap memperbaiki dan merawat sepatu ikonik ini kembali prima.', 'katalog/9f65fdbd-b696-4b9f-8140-16dfa3f21721.jpg', '[\"katalog\\/72bec028-c0e3-4d0e-8523-f02eff554841.jpg\",\"katalog\\/2c7ee6a1-95d2-473c-a65d-01e66723d8a7.jpg\",\"katalog\\/b9cc6ef8-17c2-47fa-bc3e-4fa00148a9e6.jpg\"]', '2026-07-18 07:14:51', '2026-07-23 02:38:06'),
(179, '179-DS', NULL, 'Sandal Wanita', NULL, 'sepatu', 'sudah_diperbaiki', '37', 'Hitam', NULL, 81, 'tersedia', 'Ini adalah Sandal Wanita ukuran 37 berwarna hitam yang telah direnovasi. Kondisi umumnya adalah refurbished, tetapi solnya retak/getas dan tidak ada aksesori atau kelengkapan yang disertakan. Barang ini memerlukan perbaikan midsole flat (Rp 305.000) dan penggantian alas datar (Rp 225.000). Dengan perbaikan tersebut, sandal ini dapat digunakan kembali dengan nyaman dan aman.', 'katalog/12943534-aa16-44f6-8e95-4ccb9e1a339b.jpg', '[\"katalog\\/c380f247-d9ca-43c5-a94e-af62465a94b5.jpg\",\"katalog\\/b179c769-8fe7-4524-b4a7-359a50082dcb.jpg\",\"katalog\\/b3808b74-a709-402c-a998-1c6ed3b0ddc8.jpg\"]', '2026-07-18 07:15:21', '2026-07-23 02:37:01');

-- --------------------------------------------------------

--
-- Table structure for table `donation_item_services`
--

CREATE TABLE `donation_item_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `donation_item_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jasa_nama_manual` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jasa_harga` int(10) UNSIGNED DEFAULT NULL,
  `jasa_estimasi_waktu` int(10) UNSIGNED DEFAULT NULL,
  `is_mandatory` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donation_item_services`
--

INSERT INTO `donation_item_services` (`id`, `donation_item_id`, `service_id`, `jasa_nama_manual`, `jasa_harga`, `jasa_estimasi_waktu`, `is_mandatory`, `created_at`, `updated_at`) VALUES
(22, 2, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 14, 1, '2026-07-16 07:07:18', '2026-07-16 07:07:18'),
(23, 2, 4, 'Lapis Kulit 1 Pola', 175000, 14, 1, '2026-07-16 07:07:18', '2026-07-16 07:07:18'),
(24, 3, 1, 'Lem Press', 210000, 0, 1, '2026-07-16 07:07:37', '2026-07-16 07:07:37'),
(26, 5, 1, 'Lem Press', 210000, 14, 1, '2026-07-16 07:08:49', '2026-07-16 07:08:49'),
(27, 4, 1, 'Lem Jahit', 210000, 14, 1, '2026-07-16 07:09:21', '2026-07-16 07:09:21'),
(28, 6, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 14, 1, '2026-07-16 07:11:10', '2026-07-16 07:11:10'),
(29, 7, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 14, 1, '2026-07-16 07:11:29', '2026-07-16 07:11:29'),
(30, 8, 1, 'Ganti Sol Potong', 300000, 0, 1, '2026-07-16 07:13:39', '2026-07-16 07:13:39'),
(32, 11, 1, 'Lem Press', 210000, 14, 1, '2026-07-16 07:21:00', '2026-07-16 07:21:00'),
(33, 9, 1, 'Lem Jahit', 210000, 13, 1, '2026-07-16 07:21:24', '2026-07-16 07:21:24'),
(34, 12, 1, 'Lem Jahit', 210000, 14, 1, '2026-07-16 07:25:49', '2026-07-16 07:25:49'),
(35, 13, 1, 'Lem Jahit', 210000, 0, 1, '2026-07-16 07:28:11', '2026-07-16 07:28:11'),
(36, 13, 4, 'Ganti Upper Pola Standard (Quarter-S)', 175000, 0, 1, '2026-07-16 07:28:11', '2026-07-16 07:28:11'),
(37, 14, 1, 'Midsole Non Flat', 355000, 0, 1, '2026-07-16 07:29:14', '2026-07-16 07:29:14'),
(40, 15, 1, 'Ganti Sol Potong', 300000, 14, 1, '2026-07-16 07:34:30', '2026-07-16 07:34:30'),
(41, 15, 4, 'Ganti Paded', 175000, 14, 1, '2026-07-16 07:34:30', '2026-07-16 07:34:30'),
(43, 16, 4, 'Ganti Upper Pola Standard (Quarter-S)', 175000, 14, 1, '2026-07-16 07:41:08', '2026-07-16 07:41:08'),
(44, 16, 1, 'Bongkar Sole', 125000, 14, 1, '2026-07-16 07:41:08', '2026-07-16 07:41:08'),
(45, 17, 1, 'Ganti Alas Berpola', 275000, 14, 1, '2026-07-16 07:43:22', '2026-07-16 07:43:22'),
(46, 18, 1, 'Lem Press', 210000, 14, 1, '2026-07-16 07:47:05', '2026-07-16 07:47:05'),
(56, 19, 1, 'Lem Jahit', 210000, 14, 1, '2026-07-16 08:02:00', '2026-07-16 08:02:00'),
(57, 20, 1, 'Midsole Non Flat', 355000, 14, 1, '2026-07-16 08:02:14', '2026-07-16 08:02:14'),
(58, 21, 1, 'Lem Jahit', 210000, 14, 1, '2026-07-16 08:02:35', '2026-07-16 08:02:35'),
(59, 21, 2, 'Repaint Spesial', 195000, 14, 1, '2026-07-16 08:02:35', '2026-07-16 08:02:35'),
(60, 22, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 14, 1, '2026-07-16 08:02:58', '2026-07-16 08:02:58'),
(61, 22, 4, 'Lapis Kulit Keliling', 125000, 0, 1, '2026-07-16 08:02:58', '2026-07-16 08:02:58'),
(62, 23, 4, 'Ganti Upper Pola Sedang (Quarter-M)', 225000, 14, 1, '2026-07-16 08:04:17', '2026-07-16 08:04:17'),
(63, 23, 1, 'Bongkar Sole', 125000, 0, 1, '2026-07-16 08:04:17', '2026-07-16 08:04:17'),
(65, 25, 1, 'Lem Press', 210000, 14, 1, '2026-07-16 08:06:54', '2026-07-16 08:06:54'),
(66, 26, 1, 'Lem Jahit', 210000, 14, 1, '2026-07-16 08:08:11', '2026-07-16 08:08:11'),
(67, 27, 1, 'Ganti Alas Polos', 225000, 14, 1, '2026-07-16 08:09:03', '2026-07-16 08:09:03'),
(68, 28, 1, 'Lem Jahit', 210000, 0, 1, '2026-07-16 08:10:07', '2026-07-16 08:10:07'),
(69, 29, 1, 'Lem Jahit', 210000, 14, 1, '2026-07-16 08:10:51', '2026-07-16 08:10:51'),
(70, 30, 1, 'Bongkar Sole', 125000, 14, 1, '2026-07-16 08:14:30', '2026-07-16 08:14:30'),
(71, 30, 4, 'Ganti Velcrow', 75000, 0, 1, '2026-07-16 08:14:30', '2026-07-16 08:14:30'),
(72, 30, 4, 'Ganti Upper Pola Sedang (Quarter-M)', 225000, 0, 1, '2026-07-16 08:14:30', '2026-07-16 08:14:30'),
(74, 32, 1, 'Ganti Alas Polos', 225000, 0, 1, '2026-07-16 08:17:18', '2026-07-16 08:17:18'),
(75, 33, 1, 'Lem Jahit', 210000, 14, 1, '2026-07-16 08:20:27', '2026-07-16 08:20:27'),
(77, 34, 1, 'Lem Jahit', 210000, 14, 1, '2026-07-16 08:31:16', '2026-07-16 08:31:16'),
(78, 35, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 14, 1, '2026-07-16 08:32:36', '2026-07-16 08:32:36'),
(80, 37, 1, 'Ganti Alas Polos', 225000, 0, 1, '2026-07-16 08:33:34', '2026-07-16 08:33:34'),
(81, 38, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 14, 1, '2026-07-16 08:34:43', '2026-07-16 08:34:43'),
(82, 38, 4, 'Lapis Kulit Depan/Belakang', 75000, 0, 1, '2026-07-16 08:34:43', '2026-07-16 08:34:43'),
(83, 39, 1, 'Midsole Flat', 305000, 0, 1, '2026-07-16 08:35:43', '2026-07-16 08:35:43'),
(84, 36, 1, 'Ganti Alas Polos', 225000, 14, 1, '2026-07-16 08:36:05', '2026-07-16 08:36:05'),
(85, 40, 1, 'Lem Jahit', 210000, 14, 1, '2026-07-16 08:36:48', '2026-07-16 08:36:48'),
(86, 41, 1, 'Ganti Stabilizer + Lem', 225000, 14, 1, '2026-07-16 08:38:29', '2026-07-16 08:38:29'),
(87, 42, 4, 'Ganti Lining Kulit', 225000, 14, 1, '2026-07-16 08:39:19', '2026-07-16 08:39:19'),
(88, 43, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 14, 1, '2026-07-16 08:42:23', '2026-07-16 08:42:23'),
(90, 45, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 14, 1, '2026-07-16 08:43:49', '2026-07-16 08:43:49'),
(93, 46, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 14, 1, '2026-07-16 12:57:23', '2026-07-16 12:57:23'),
(94, 47, 1, 'Lem Jahit', 210000, 14, 1, '2026-07-16 13:04:08', '2026-07-16 13:04:08'),
(95, 47, 4, 'Lapis Kulit Keliling', 125000, 0, 1, '2026-07-16 13:04:08', '2026-07-16 13:04:08'),
(96, 48, 1, 'Lem Jahit', 210000, 14, 1, '2026-07-16 13:08:24', '2026-07-16 13:08:24'),
(99, 54, 1, 'Lem Jahit', 210000, 14, 1, '2026-07-16 13:30:14', '2026-07-16 13:30:14'),
(100, 55, 1, 'Midsole Non Flat', 355000, 14, 1, '2026-07-16 13:35:09', '2026-07-16 13:35:09'),
(101, 55, 4, 'Lapis Kulit Keliling', 125000, 0, 1, '2026-07-16 13:35:09', '2026-07-16 13:35:09'),
(102, 55, 1, 'Ganti Alas Polos', 225000, 0, 1, '2026-07-16 13:35:09', '2026-07-16 13:35:09'),
(103, 56, 1, 'Lem Press', 210000, 14, 1, '2026-07-16 13:40:11', '2026-07-16 13:40:11'),
(104, 60, 1, 'Midsole Non Flat', 355000, 14, 1, '2026-07-16 13:51:16', '2026-07-16 13:51:16'),
(105, 60, 4, 'Lapis Kulit Depan/Belakang', 75000, 0, 1, '2026-07-16 13:51:16', '2026-07-16 13:51:16'),
(106, 62, 1, 'Lem Jahit', 210000, 0, 1, '2026-07-16 13:58:40', '2026-07-16 13:58:40'),
(107, 63, 1, 'Lem Jahit', 210000, 0, 1, '2026-07-16 14:01:52', '2026-07-16 14:01:52'),
(108, 65, 1, 'Lem Jahit', 210000, 14, 1, '2026-07-16 14:09:49', '2026-07-16 14:09:49'),
(109, 65, 1, 'Ganti Sol Foxing', 225000, 0, 0, '2026-07-16 14:09:49', '2026-07-16 14:09:49'),
(110, 67, 1, 'Midsole Non Flat', 355000, 0, 1, '2026-07-16 14:15:40', '2026-07-16 14:15:40'),
(111, 72, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 14, 1, '2026-07-17 01:16:03', '2026-07-17 01:16:03'),
(112, 76, 1, 'Midsole Non Flat', 355000, 14, 1, '2026-07-17 01:36:07', '2026-07-17 01:36:07'),
(113, 78, 1, 'Ganti Alas Hak Cewe', 75000, 0, 1, '2026-07-17 01:40:40', '2026-07-17 01:40:40'),
(114, 80, 1, 'Ganti Sol Foxing + Alas', 275000, 0, 1, '2026-07-17 01:46:05', '2026-07-17 01:46:05'),
(115, 83, 1, 'Lem Jahit', 210000, 14, 1, '2026-07-17 01:57:43', '2026-07-17 01:57:43'),
(116, 84, 1, 'Lem Jahit', 210000, 14, 1, '2026-07-17 02:02:07', '2026-07-17 02:02:07'),
(117, 84, 1, 'Alas Komponen + Lem', 180000, 0, 1, '2026-07-17 02:02:07', '2026-07-17 02:02:07'),
(118, 86, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 14, 1, '2026-07-17 02:08:21', '2026-07-17 02:08:21'),
(119, 86, 4, 'Lapis Kulit Keliling', 125000, 0, 1, '2026-07-17 02:08:21', '2026-07-17 02:08:21'),
(122, 77, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 14, 1, '2026-07-17 02:16:02', '2026-07-17 02:16:02'),
(123, 77, 4, 'Lapis Kulit Keliling', 125000, 0, 1, '2026-07-17 02:16:02', '2026-07-17 02:16:02'),
(124, 90, 1, 'Lem Press', 210000, 14, 1, '2026-07-17 02:19:06', '2026-07-17 02:19:06'),
(126, 92, 4, 'Lem Jahit', 210000, 14, 1, '2026-07-17 02:23:14', '2026-07-17 02:23:14'),
(128, 89, 1, 'Ganti Alas Hak Cewe', 75000, 0, 1, '2026-07-17 02:23:37', '2026-07-17 02:23:37'),
(129, 88, 1, 'Ganti Alas Hak Cewe', 75000, 14, 1, '2026-07-17 02:23:52', '2026-07-17 02:23:52'),
(130, 91, 1, 'Ganti Alas Hak Cewe', 75000, 14, 1, '2026-07-17 02:25:47', '2026-07-17 02:25:47'),
(131, 85, 1, 'Midsole Flat', 305000, 14, 1, '2026-07-17 06:06:57', '2026-07-17 06:06:57'),
(132, 82, 1, 'Midsole Non Flat', 355000, 14, 1, '2026-07-17 06:09:02', '2026-07-17 06:09:02'),
(133, 82, 1, 'Ganti Alas Polos', 225000, 0, 1, '2026-07-17 06:09:02', '2026-07-17 06:09:02'),
(134, 79, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 14, 1, '2026-07-17 06:10:43', '2026-07-17 06:10:43'),
(135, 74, 4, 'Ganti Upper Pola Sedang (Quarter-M)', 225000, 14, 1, '2026-07-17 06:14:28', '2026-07-17 06:14:28'),
(136, 74, 1, 'Bongkar Sole', 125000, 0, 1, '2026-07-17 06:14:28', '2026-07-17 06:14:28'),
(137, 73, 1, 'Lem Jahit', 210000, 14, 1, '2026-07-17 06:19:15', '2026-07-17 06:19:15'),
(138, 70, 1, 'Lem Jahit', 210000, 0, 1, '2026-07-17 06:22:37', '2026-07-17 06:22:37'),
(140, 66, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 14, 1, '2026-07-17 06:28:55', '2026-07-17 06:28:55'),
(141, 66, 4, 'Lapis Kulit Keliling', 125000, 0, 1, '2026-07-17 06:28:55', '2026-07-17 06:28:55'),
(144, 64, 1, 'Ganti Sol Potong', 300000, 14, 1, '2026-07-17 06:32:12', '2026-07-17 06:32:12'),
(145, 64, 2, 'Repaint Spesial', 195000, 0, 1, '2026-07-17 06:32:12', '2026-07-17 06:32:12'),
(146, 61, 1, 'Lem Jahit', 210000, 0, 1, '2026-07-17 06:35:27', '2026-07-17 06:35:27'),
(147, 58, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 14, 1, '2026-07-17 07:08:04', '2026-07-17 07:08:04'),
(148, 58, 2, 'Repaint Standard', 170000, 0, 1, '2026-07-17 07:08:04', '2026-07-17 07:08:04'),
(149, 57, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 14, 1, '2026-07-17 07:11:12', '2026-07-17 07:11:12'),
(150, 57, 4, 'Lapis Kulit Keliling', 125000, 0, 1, '2026-07-17 07:11:12', '2026-07-17 07:11:12'),
(151, 53, 1, 'Lem Press', 210000, 14, 1, '2026-07-17 07:13:14', '2026-07-17 07:13:14'),
(152, 53, 2, 'Repaint Standard', 170000, 0, 1, '2026-07-17 07:13:14', '2026-07-17 07:13:14'),
(153, 52, 4, 'Ganti Upper Pola Sedang (Quarter-M)', 225000, 14, 1, '2026-07-17 07:15:23', '2026-07-17 07:15:23'),
(154, 52, 1, 'Bongkar Sole', 125000, 0, 1, '2026-07-17 07:15:23', '2026-07-17 07:15:23'),
(155, 51, 2, 'Repaint Spesial Bahan Spesial', 245000, 14, 1, '2026-07-17 07:16:46', '2026-07-17 07:16:46'),
(156, 50, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 14, 1, '2026-07-17 07:18:01', '2026-07-17 07:18:01'),
(157, 49, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 14, 1, '2026-07-17 07:19:18', '2026-07-17 07:19:18'),
(158, 81, 1, 'Lem Jahit', 210000, 14, 1, '2026-07-17 07:38:09', '2026-07-17 07:38:09'),
(159, 59, 1, 'Lem Jahit', 210000, 14, 1, '2026-07-17 07:39:40', '2026-07-17 07:39:40'),
(160, 75, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 14, 1, '2026-07-17 07:41:41', '2026-07-17 07:41:41'),
(161, 75, 4, 'Lapis Kulit Keliling', 125000, 0, 1, '2026-07-17 07:41:41', '2026-07-17 07:41:41'),
(162, 87, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 14, 1, '2026-07-17 07:43:05', '2026-07-17 07:43:05'),
(163, 69, 1, 'Lem Press', 210000, 14, 1, '2026-07-17 08:13:55', '2026-07-17 08:13:55'),
(164, 93, 1, 'Lem Jahit', 210000, 10, 1, '2026-07-17 13:02:59', '2026-07-17 13:02:59'),
(165, 94, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 30, 1, '2026-07-17 13:07:51', '2026-07-17 13:07:51'),
(166, 94, 4, 'Rapihkan Jahitan', 125000, 7, 1, '2026-07-17 13:07:51', '2026-07-17 13:07:51'),
(167, 95, 1, 'Ganti Sol Foxing + Alas', 275000, 21, 1, '2026-07-17 13:10:37', '2026-07-17 13:10:37'),
(168, 96, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 21, 1, '2026-07-17 13:13:45', '2026-07-17 13:13:45'),
(169, 96, 4, 'Ganti Lining Mesh', 175000, 21, 1, '2026-07-17 13:13:45', '2026-07-17 13:13:45'),
(170, 97, 1, 'Ganti Sol Foxing + Alas', 275000, 21, 1, '2026-07-17 13:16:22', '2026-07-17 13:16:22'),
(171, 98, 1, 'Lem Jahit', 210000, 10, 1, '2026-07-17 13:19:26', '2026-07-17 13:19:26'),
(172, 98, 1, 'Alas Komponen + Lem', 180000, 14, 1, '2026-07-17 13:19:26', '2026-07-17 13:19:26'),
(173, 99, 4, 'Ganti Upper Pola Standard (Quarter-S)', 175000, 21, 1, '2026-07-17 13:22:19', '2026-07-17 13:22:19'),
(174, 99, 1, 'Ganti Alas Polos', 225000, 14, 1, '2026-07-17 13:22:19', '2026-07-17 13:22:19'),
(175, 100, 1, 'Lem Jahit', 210000, 10, 1, '2026-07-17 13:25:42', '2026-07-17 13:25:42'),
(176, 101, 1, 'Lem Jahit', 210000, 14, 1, '2026-07-17 13:28:02', '2026-07-17 13:28:02'),
(177, 102, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 21, 1, '2026-07-17 13:30:36', '2026-07-17 13:30:36'),
(178, 102, 4, 'Lapis Kulit Keliling', 125000, 20, 1, '2026-07-17 13:30:36', '2026-07-17 13:30:36'),
(179, 103, 1, 'Ganti Alas Berpola', 275000, 18, 1, '2026-07-17 13:33:33', '2026-07-17 13:33:33'),
(180, 103, 4, 'Ganti Velcrow', 175000, 18, 1, '2026-07-17 13:33:33', '2026-07-17 13:33:33'),
(181, 104, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 21, 1, '2026-07-17 13:36:18', '2026-07-17 13:36:18'),
(182, 104, 4, 'Ganti Lining Kulit', 225000, 21, 1, '2026-07-17 13:36:18', '2026-07-17 13:36:18'),
(183, 105, 1, 'Lem Jahit', 210000, 14, 1, '2026-07-17 13:40:33', '2026-07-17 13:40:33'),
(184, 106, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 14, 1, '2026-07-17 13:43:52', '2026-07-17 13:43:52'),
(185, 107, 1, 'Lem Jahit', 210000, 10, 1, '2026-07-17 13:45:29', '2026-07-17 13:45:29'),
(186, 108, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 21, 1, '2026-07-17 13:49:30', '2026-07-17 13:49:30'),
(187, 108, 4, 'Ganti Lining Mesh', 175000, 21, 1, '2026-07-17 13:49:30', '2026-07-17 13:49:30'),
(188, 108, 4, 'Rapihkan Jahitan', 125000, 10, 1, '2026-07-17 13:49:30', '2026-07-17 13:49:30'),
(189, 109, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 21, 1, '2026-07-17 13:51:33', '2026-07-17 13:51:33'),
(190, 110, 1, 'Lem Jahit', 210000, 10, 1, '2026-07-17 13:53:38', '2026-07-17 13:53:38'),
(191, 111, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 20, 1, '2026-07-17 13:55:51', '2026-07-17 13:55:51'),
(192, 112, 1, 'Midsole Non Flat', 355000, 14, 1, '2026-07-17 13:58:21', '2026-07-17 13:58:21'),
(193, 113, 1, 'Alas Komponen + Lem', 180000, 14, 1, '2026-07-17 14:01:25', '2026-07-17 14:01:25'),
(194, 114, 1, 'Ganti Sol Foxing + Alas', 275000, 21, 1, '2026-07-17 14:04:47', '2026-07-17 14:04:47'),
(195, 115, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 0, 1, '2026-07-17 14:06:42', '2026-07-17 14:06:42'),
(201, 118, 4, 'Ganti Upper Pola Standard (Quarter-S)', 175000, 21, 1, '2026-07-17 14:13:52', '2026-07-17 14:13:52'),
(202, 118, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 14, 1, '2026-07-17 14:13:52', '2026-07-17 14:13:52'),
(203, 118, 4, 'Ganti Paded', 175000, 21, 1, '2026-07-17 14:13:52', '2026-07-17 14:13:52'),
(204, 118, 4, 'Ganti Upper Pola Standard (Quarter-S)', 175000, 21, 1, '2026-07-17 14:13:52', '2026-07-17 14:13:52'),
(205, 119, 1, 'Midsole', 225000, 21, 1, '2026-07-18 03:08:02', '2026-07-18 03:08:02'),
(206, 117, 1, 'Insole', 125000, 21, 1, '2026-07-18 03:09:05', '2026-07-18 03:09:05'),
(207, 117, 1, 'Midsole', 255000, 21, 1, '2026-07-18 03:09:05', '2026-07-18 03:09:05'),
(208, 117, 1, 'Ganti Alas Polos', 225000, 21, 1, '2026-07-18 03:09:05', '2026-07-18 03:09:05'),
(209, 116, 1, 'Midsole', 225000, 21, 1, '2026-07-18 03:09:26', '2026-07-18 03:09:26'),
(210, 116, 1, 'Ganti Alas Polos', 225000, 19, 1, '2026-07-18 03:09:26', '2026-07-18 03:09:26'),
(211, 120, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 21, 1, '2026-07-18 03:18:40', '2026-07-18 03:18:40'),
(212, 120, 4, 'Ganti Lining Mesh', 175000, 21, 1, '2026-07-18 03:18:40', '2026-07-18 03:18:40'),
(213, 121, 1, 'Lem Jahit', 210000, 10, 1, '2026-07-18 03:20:46', '2026-07-18 03:20:46'),
(215, 122, 1, 'Lem Jahit', 210000, 10, 1, '2026-07-18 03:23:27', '2026-07-18 03:23:27'),
(216, 123, 1, 'Lem Jahit', 210000, 14, 1, '2026-07-18 03:26:28', '2026-07-18 03:26:28'),
(217, 71, 4, 'Ganti Upper Pola Sedang (Quarter-M)', 225000, 14, 1, '2026-07-18 03:27:18', '2026-07-18 03:27:18'),
(218, 68, 4, 'Ganti Upper Pola Besar (Quarter-L)', 325000, 14, 1, '2026-07-18 03:27:52', '2026-07-18 03:27:52'),
(219, 124, 1, 'Ganti Alas Polos', 225000, 14, 1, '2026-07-18 03:30:30', '2026-07-18 03:30:30'),
(220, 125, 1, 'Lem Jahit', 210000, 10, 1, '2026-07-18 03:48:19', '2026-07-18 03:48:19'),
(221, 126, 1, 'Lem Jahit', 210000, 10, 1, '2026-07-18 03:51:08', '2026-07-18 03:51:08'),
(222, 127, 1, 'Lem Jahit', 210000, 10, 1, '2026-07-18 03:53:09', '2026-07-18 03:53:09'),
(223, 128, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 21, 1, '2026-07-18 03:55:30', '2026-07-18 03:55:30'),
(224, 129, 1, 'Lem Jahit', 210000, 10, 1, '2026-07-18 03:57:05', '2026-07-18 03:57:05'),
(225, 130, 1, 'Lem Jahit', 210000, 10, 1, '2026-07-18 04:00:18', '2026-07-18 04:00:18'),
(226, 130, 4, 'Ganti Upper Pola Standard (Quarter-S)', 175000, 21, 1, '2026-07-18 04:00:18', '2026-07-18 04:00:18'),
(227, 131, 1, 'Midsole Non Flat', 355000, 21, 1, '2026-07-18 04:03:42', '2026-07-18 04:03:42'),
(228, 131, 4, 'Ganti Upper Pola Sedang (Quarter-M)', 225000, 21, 1, '2026-07-18 04:03:42', '2026-07-18 04:03:42'),
(229, 132, 1, 'Ganti Alas Polos + Lem Sole', 275000, 21, 1, '2026-07-18 04:09:21', '2026-07-18 04:09:21'),
(232, 133, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 21, 1, '2026-07-18 04:13:40', '2026-07-18 04:13:40'),
(233, 133, 4, 'Ganti Upper Pola Standard (Quarter-S)', 175000, 21, 1, '2026-07-18 04:13:40', '2026-07-18 04:13:40'),
(235, 134, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 21, 1, '2026-07-18 04:17:34', '2026-07-18 04:17:34'),
(236, 135, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 21, 1, '2026-07-18 04:19:24', '2026-07-18 04:19:24'),
(237, 136, 1, 'Ganti Alas Polos', 225000, 14, 1, '2026-07-18 04:21:58', '2026-07-18 04:21:58'),
(238, 136, 4, 'Rapihkan Jahitan', 125000, 14, 1, '2026-07-18 04:21:58', '2026-07-18 04:21:58'),
(239, 137, 1, 'Lem Press', 210000, 10, 1, '2026-07-18 04:23:34', '2026-07-18 04:23:34'),
(241, 138, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 21, 1, '2026-07-18 04:27:22', '2026-07-18 04:27:22'),
(242, 138, 4, 'Lapis Kulit Keliling', 125000, 21, 1, '2026-07-18 04:27:22', '2026-07-18 04:27:22'),
(244, 139, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 21, 1, '2026-07-18 08:47:09', '2026-07-18 08:47:09'),
(245, 140, 1, 'Ganti Sol Foxing + Alas', 275000, 21, 1, '2026-07-18 08:47:59', '2026-07-18 08:47:59'),
(246, 141, 1, 'Lem Jahit', 210000, 10, 1, '2026-07-18 08:50:01', '2026-07-18 08:50:01'),
(247, 141, 3, 'Upper Treatment', 90000, 7, 0, '2026-07-18 08:50:01', '2026-07-18 08:50:01'),
(248, 142, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 21, 1, '2026-07-18 08:51:38', '2026-07-18 08:51:38'),
(251, 143, 1, 'Lem Jahit', 210000, 10, 1, '2026-07-18 08:53:42', '2026-07-18 08:53:42'),
(252, 143, 3, 'Upper Treatment', 90000, 5, 0, '2026-07-18 08:53:42', '2026-07-18 08:53:42'),
(253, 144, 1, 'Lem Jahit', 210000, 10, 1, '2026-07-18 08:54:31', '2026-07-18 08:54:31'),
(254, 145, 1, 'Midsole Non Flat', 355000, 21, 1, '2026-07-18 08:55:22', '2026-07-18 08:55:22'),
(255, 166, 1, 'Bongkar Sole', 125000, 10, 1, '2026-07-18 08:57:15', '2026-07-18 08:57:15'),
(256, 166, 4, 'Lapis Kulit Keliling', 125000, 20, 1, '2026-07-18 08:57:15', '2026-07-18 08:57:15'),
(257, 165, 4, 'Ganti Upper Pola Standard (Quarter-S)', 175000, 21, 1, '2026-07-18 08:59:19', '2026-07-18 08:59:19'),
(258, 165, 1, 'Bongkar Sole', 125000, 21, 1, '2026-07-18 08:59:19', '2026-07-18 08:59:19'),
(259, 164, 1, 'Lem Jahit', 210000, 10, 1, '2026-07-18 09:00:15', '2026-07-18 09:00:15'),
(260, 163, 1, 'Lem Jahit', 210000, 10, 1, '2026-07-18 09:01:42', '2026-07-18 09:01:42'),
(261, 162, 1, 'Lem Jahit', 210000, 10, 1, '2026-07-18 09:04:54', '2026-07-18 09:04:54'),
(262, 162, 4, 'Ganti Upper Pola Standard (Quarter-S)', 175000, 21, 0, '2026-07-18 09:04:54', '2026-07-18 09:04:54'),
(263, 161, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 21, 1, '2026-07-18 09:06:23', '2026-07-18 09:06:23'),
(264, 160, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 21, 1, '2026-07-18 09:07:35', '2026-07-18 09:07:35'),
(265, 179, 1, 'Midsole Flat', 305000, 21, 1, '2026-07-23 02:37:01', '2026-07-23 02:37:01'),
(266, 179, 1, 'Ganti Alas Polos', 225000, 18, 1, '2026-07-23 02:37:01', '2026-07-23 02:37:01'),
(267, 178, 1, 'Ganti Sol Foxing + Alas', 275000, 0, 1, '2026-07-23 02:38:06', '2026-07-23 02:38:06'),
(268, 177, 1, 'Ganti Sol Foxing + Alas', 275000, 18, 1, '2026-07-23 02:41:02', '2026-07-23 02:41:02'),
(269, 177, 4, 'Ganti Tambah TA', 125000, 21, 1, '2026-07-23 02:41:02', '2026-07-23 02:41:02'),
(270, 177, 4, 'Ganti Upper Pola Standard (Quarter-S)', 175000, 21, 1, '2026-07-23 02:41:02', '2026-07-23 02:41:02'),
(271, 175, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 18, 1, '2026-07-23 02:42:50', '2026-07-23 02:42:50'),
(272, 174, 4, 'Ganti Upper Pola Standard (Quarter-S)', 175000, 21, 1, '2026-07-23 02:47:15', '2026-07-23 02:47:15'),
(273, 174, 4, 'Ganti Upper Pola Standard (Quarter-S)', 175000, 21, 1, '2026-07-23 02:47:15', '2026-07-23 02:47:15'),
(274, 174, 1, 'Bongkar Sole', 125000, 21, 1, '2026-07-23 02:47:15', '2026-07-23 02:47:15'),
(275, 173, 1, 'Midsole Non Flat', 355000, 18, 1, '2026-07-23 02:50:02', '2026-07-23 02:50:02'),
(276, 173, 1, 'Ganti Alas Polos', 225000, 18, 1, '2026-07-23 02:50:02', '2026-07-23 02:50:02'),
(277, 172, 4, 'Ganti Upper Pola Standard (Quarter-S)', 175000, 21, 1, '2026-07-23 02:52:03', '2026-07-23 02:52:03'),
(278, 172, 4, 'Insole Kulit', 125000, 21, 1, '2026-07-23 02:52:03', '2026-07-23 02:52:03'),
(279, 172, 1, 'Bongkar Sole', 125000, 21, 1, '2026-07-23 02:52:03', '2026-07-23 02:52:03'),
(280, 171, 1, 'Ganti Sol Foxing + Alas', 275000, 18, 1, '2026-07-23 02:53:56', '2026-07-23 02:53:56'),
(281, 170, 3, 'Upper Treatment', 90000, 5, 1, '2026-07-23 02:55:09', '2026-07-23 02:55:09'),
(282, 169, 1, 'Alas Komponen + Lem', 180000, 18, 1, '2026-07-23 02:56:28', '2026-07-23 02:56:28'),
(283, 168, 1, 'Midsole Non Flat', 355000, 18, 1, '2026-07-23 03:12:10', '2026-07-23 03:12:10'),
(284, 168, 4, 'Ganti Upper Pola Standard (Quarter-S)', 175000, 18, 1, '2026-07-23 03:12:10', '2026-07-23 03:12:10'),
(285, 167, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 18, 1, '2026-07-23 03:20:41', '2026-07-23 03:20:41'),
(286, 167, 4, 'Lapis Kulit Keliling', 125000, 21, 1, '2026-07-23 03:20:41', '2026-07-23 03:20:41'),
(287, 159, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 18, 1, '2026-07-23 03:40:19', '2026-07-23 03:40:19'),
(288, 159, 2, 'Repaint Spesial', 195000, 18, 0, '2026-07-23 03:40:19', '2026-07-23 03:40:19'),
(289, 158, 1, 'Ganti Sol Potong', 300000, 18, 1, '2026-07-23 03:42:04', '2026-07-23 03:42:04'),
(290, 158, 3, 'Upper Treatment', 90000, 7, 0, '2026-07-23 03:42:04', '2026-07-23 03:42:04'),
(291, 156, 4, 'Ganti Upper Pola Sedang (Quarter-M)', 225000, 21, 1, '2026-07-23 03:43:43', '2026-07-23 03:43:43'),
(292, 156, 1, 'Bongkar Sole', 125000, 21, 1, '2026-07-23 03:43:43', '2026-07-23 03:43:43'),
(293, 155, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 18, 1, '2026-07-23 03:44:44', '2026-07-23 03:44:44'),
(294, 154, 1, 'Midsole Flat', 305000, 21, 1, '2026-07-23 03:45:59', '2026-07-23 03:45:59'),
(295, 154, 1, 'Ganti Alas Polos', 225000, 20, 1, '2026-07-23 03:45:59', '2026-07-23 03:45:59'),
(296, 153, 1, 'Ganti Alas Polos', 225000, 18, 1, '2026-07-23 03:47:25', '2026-07-23 03:47:25'),
(297, 152, 1, 'Ganti Sol Jadi (Cupsole)', 250000, 18, 1, '2026-07-23 03:48:41', '2026-07-23 03:48:41'),
(298, 152, 4, 'Ganti Upper Pola Standard (Quarter-S)', 175000, 21, 1, '2026-07-23 03:48:41', '2026-07-23 03:48:41'),
(299, 151, 1, 'Lem Jahit', 210000, 10, 1, '2026-07-23 03:49:32', '2026-07-23 03:49:32'),
(300, 150, 4, 'Ganti Upper Pola Sedang (Quarter-M)', 225000, 21, 1, '2026-07-23 03:50:49', '2026-07-23 03:50:49'),
(301, 149, 1, 'Lem Jahit', 210000, 10, 1, '2026-07-23 03:51:42', '2026-07-23 03:51:42'),
(302, 148, 1, 'Alas Komponen + Lem', 180000, 18, 1, '2026-07-23 03:52:38', '2026-07-23 03:52:38'),
(303, 147, 1, 'Lem Press', 210000, 10, 1, '2026-07-23 03:54:01', '2026-07-23 03:54:01'),
(304, 146, 1, 'Midsole Flat', 305000, 21, 1, '2026-07-23 03:55:47', '2026-07-23 03:55:47'),
(305, 146, 1, 'Ganti Alas Polos', 225000, 21, 1, '2026-07-23 03:55:47', '2026-07-23 03:55:47'),
(306, 146, 4, 'Insole Suede', 125000, 21, 1, '2026-07-23 03:55:47', '2026-07-23 03:55:47'),
(307, 24, 1, 'Lem Press', 210000, 14, 1, '2026-08-14 06:41:57', '2026-08-14 06:41:57');

-- --------------------------------------------------------

--
-- Table structure for table `donation_requests`
--

CREATE TABLE `donation_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `donation_item_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_pemohon` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kontak_pemohon` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_pengiriman` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `alasan` text COLLATE utf8mb4_unicode_ci,
  `selected_services` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','menunggu_pembayaran','menunggu_verifikasi','diproses','dikirim','ditolak','dibatalkan','disetujui','selesai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `bukti_pembayaran` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resi_pengiriman` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donation_requests`
--

INSERT INTO `donation_requests` (`id`, `donation_item_id`, `user_id`, `nama_pemohon`, `email`, `kontak_pemohon`, `alamat_pengiriman`, `alasan`, `selected_services`, `status`, `bukti_pembayaran`, `resi_pengiriman`, `created_at`, `updated_at`) VALUES
(1, 39, NULL, 'nur zakiyyah', NULL, '6285875012871', 'perum griya setu permai 2 blok aa9 no 25, kab bekasi, jawa barat', NULL, NULL, 'pending', NULL, NULL, '2026-06-23 05:15:42', '2026-06-23 05:15:42'),
(4, 42, NULL, 'Tobi Setiawan', 'tobisetiawan202@gmail.com', '6281398184500', 'Ds. Sumuranja RT. 11 RW. 06, Kec. Pulo Ampel, Kab. Serang', 'Saya membutuhkan sepatu ini untuk kuliah karna sepatu lama saya sudah rusak dan blum ada dana untuk repair', NULL, 'pending', NULL, NULL, '2026-07-05 14:03:41', '2026-07-05 14:03:41'),
(5, 45, 5, 'Denata Arif Nur Muhamad', 'denataarif@shoeworkshop.com', '6281717469499', 'akfgsdkjlfasidjfb', 'sjdgfasldjf', '[]', 'ditolak', NULL, NULL, '2026-07-10 02:38:17', '2026-07-11 09:27:50'),
(6, 45, 19, 'Denata Arif Nur Muhamad', 'denataarif0@gmail.com', '6281717469499', 'jl, kembar 1, no 41', 'butuh aja sih', '[]', 'dibatalkan', 'payments/QtCPkQraPGI05cUK9HKWUMdifHIo3S3FwjHVZND3.jpg', 'JNE-0232J3N2I', '2026-07-11 09:26:20', '2026-07-16 08:37:56'),
(9, 35, 25, 'Alqia Abdul', 'alqiaabdul123@gmail.com', '6283173135921', 'JL , CIBOLERANG BARAT RT 001 RW 001 KEL. CIGONDEWAH RAHAYU KEC. BANDUNG KULON KOTA BANDUNG', 'TERTARIK UNTUK MENGADOPSI SEPATUNYA UNTUK SAYA KASIHKAN KE KAKEK SAYA', '[]', 'menunggu_pembayaran', NULL, NULL, '2026-07-16 02:49:13', '2026-07-16 02:49:13'),
(10, 22, 27, 'Quality Assurance (Radit)', 'syifarpratama@gmail.com', '6285816525301', 'Shoe Workshop', 'Sepatu sudah jelek dan harus ganti tapi dananya mepet', '[]', 'dibatalkan', NULL, NULL, '2026-07-16 07:47:02', '2026-07-16 07:52:12'),
(11, 15, 18, 'Rivael Saputra', 'riva.elsaputra2023@gmail.com', '6281214790513', 'Umi Warung, Kp Cipinang Rt05 Rw02, Desa Gandasari, Kecamatan Katapang, Kabupaten Bandung, Jawa Barat', '-', '[\"40\",\"41\"]', 'menunggu_pembayaran', NULL, NULL, '2026-07-18 04:00:18', '2026-07-18 04:00:18'),
(12, 179, 16, 'Admin Analist 4', 'shoe.analist4@gmail.com', '6285794946920', 'kp patrick', 'desa sukaneka', '[\"265\",\"266\"]', 'dibatalkan', NULL, NULL, '2026-07-31 07:03:21', '2026-07-31 07:03:47'),
(13, 53, 27, 'Quality Assurance (Radit)', 'syifarpratama@gmail.com', '6285816525301', 'jl. kembar I no. 41', 'udah gaada sepatu', '[\"151\",\"152\"]', 'menunggu_verifikasi', 'payments/a784ab06-8772-4e0a-8332-f0871cb3334c.jpg', NULL, '2026-08-03 07:42:50', '2026-08-03 07:45:14'),
(14, 24, 33, 'Brandon', 'senpainao@gmail.com', '6285123295932', 'Jalan Pesantren No 127 RT 02 RW 07', 'Sepatunya bagus', '[\"64\"]', 'menunggu_pembayaran', NULL, NULL, '2026-08-14 06:40:50', '2026-08-14 06:40:50');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hero_sections`
--

CREATE TABLE `hero_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` text COLLATE utf8mb4_unicode_ci,
  `primary_cta_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primary_cta_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_cta_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_cta_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hero_sections`
--

INSERT INTO `hero_sections` (`id`, `title`, `subtitle`, `primary_cta_text`, `primary_cta_link`, `secondary_cta_text`, `secondary_cta_link`, `image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Reparasi Sepatu Profesional', 'Sepatu favoritmu rusak? Kirim fotonya, kami bantu cek dan rekomendasikan solusinya.', 'Konsultasi via WhatsApp', 'https://wa.me/62895339939800', 'Lihat Hasil Before–After', '#portfolio', 'hero/VLBGDk1GbLWmLOrsPc1WNI5IpXwquxQT3jf9w1ix.png', 1, '2026-01-26 18:56:35', '2026-07-03 08:42:57'),
(2, 'Salurkan Sepatu Layak Pakai Anda', 'Bantu sesama dengan mendonasikan sepatu bekas layak pakai Anda. Kami akan merestorasi sepatu tersebut agar kembali bersih, kokoh, dan siap disalurkan kepada mereka yang membutuhkan.', 'Mulai Donasi Sepatu', '/donatur/donations/create', 'Lihat Katalog Donasi', '/donasi-katalog', 'hero/1JPZM96vguuqMr6bmSrH6viifgFWoggEZdPxUz10.png', 1, '2026-06-12 07:40:47', '2026-07-03 08:43:10');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `layanan_categories`
--

CREATE TABLE `layanan_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `value_material` text COLLATE utf8mb4_unicode_ci,
  `value_kehidupan` text COLLATE utf8mb4_unicode_ci,
  `cta` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `layanan_categories`
--

INSERT INTO `layanan_categories` (`id`, `slug`, `order`, `name`, `subtitle`, `description`, `value_material`, `value_kehidupan`, `cta`, `created_at`, `updated_at`) VALUES
(1, 'lem-jahit', 1, 'Lem & Jahit', 'Untuk sepatu yang mulai lepas, kopong, atau perlu penguatan struktur', 'Lem dan jahit adalah fondasi kekuatan sepatu. Ketika bagian upper mulai lepas dari sol, jahitan mengendur, atau sepatu terasa \"kopong\" saat dipakai jalan, ini tandanya struktur perekat sepatu sudah melemah. Kategori ini menjaga agar sepatu tetap kokoh dipakai sehari-hari, mencegah kerusakan kecil berkembang jadi kerusakan besar yang lebih mahal diperbaiki.', 'Menahan kerusakan di tahap awal jauh lebih murah daripada menunggu sampai upper robek total atau sol lepas permanen.', 'Sepatu yang solid bikin kamu percaya diri melangkah, tidak was-was sol copot di tengah acara penting.', 'Konsultasi Gratis Cek Kerusakan', '2026-07-06 09:53:59', '2026-07-06 09:53:59'),
(2, 'sol', 2, 'Sol', 'Untuk sol yang aus, rusak, atau butuh diganti total', 'Sol adalah bagian yang paling banyak menerima beban dan gesekan setiap hari — otomatis paling cepat aus. Kategori ini mencakup segala bentuk perbaikan maupun penggantian sol, dari yang ringan (tambal alas) sampai rekonstruksi total (Goodyear Welt).', 'Mengganti sol jauh lebih murah daripada membeli sepatu baru, terutama untuk sepatu kulit atau leather boots yang harga uppernya jauh lebih mahal dari solnya.', 'Sol yang sehat menjaga postur jalan dan kenyamanan kaki — sol yang aus/botak bisa memengaruhi cara jalan dan berdampak ke tubuh dalam jangka panjang.', 'Konsultasi Gratis Cek Kerusakan', '2026-07-06 09:53:59', '2026-07-06 09:53:59'),
(3, 'upper', 3, 'Upper', 'Untuk bagian atas sepatu yang sobek, rusak, atau perlu penggantian material', 'Upper adalah \"wajah\" sepatu — bagian yang paling terlihat dan paling personal secara gaya. Kategori ini mencakup perbaikan atau penggantian material upper yang sobek, rusak, atau butuh penguatan struktur bagian atas.', 'Upper berkualitas (kulit, suede, kanvas premium) jauh lebih mahal untuk diproduksi ulang dibanding diperbaiki — apalagi untuk sepatu limited/discontinued yang tidak bisa dibeli lagi.', 'Upper menyimpan bentuk yang sudah menyesuaikan kaki pemakainya setelah dipakai lama — mengganti sepatu baru berarti mulai dari nol lagi proses \"break-in\".', 'Konsultasi Gratis Cek Kerusakan', '2026-07-06 09:53:59', '2026-07-06 09:53:59'),
(4, 'treatment', 4, 'Treatment', 'Untuk penyegaran tampilan: warna pudar, menguning, atau ingin tampilan baru', 'Treatment fokus pada penyegaran tampilan sepatu — warna pudar, menguning karena usia, atau ingin variasi warna baru. Kategori ini paling cocok untuk sepatu yang secara struktur masih sehat tapi tampilannya sudah tidak menarik lagi.', 'Repaint dan treatment warna jauh lebih murah dibanding membeli sepatu model sama dengan warna baru — terutama untuk sepatu yang sudah discontinued.', 'Sepatu dengan tampilan segar kembali membangkitkan rasa percaya diri memakainya — seperti sepatu \"baru\" tanpa kehilangan kenangan yang sudah menempel.', 'Lihat Galeri Repaint', '2026-07-06 09:53:59', '2026-07-06 09:53:59');

-- --------------------------------------------------------

--
-- Table structure for table `layanan_services`
--

CREATE TABLE `layanan_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `layanan_category_id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle_teknis` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kapan` text COLLATE utf8mb4_unicode_ci,
  `proses` text COLLATE utf8mb4_unicode_ci,
  `kenapa_penting` text COLLATE utf8mb4_unicode_ci,
  `image_before` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_after` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_preview` tinyint(1) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `layanan_services`
--

INSERT INTO `layanan_services` (`id`, `layanan_category_id`, `slug`, `name`, `subtitle_teknis`, `kapan`, `proses`, `kenapa_penting`, `image_before`, `image_after`, `is_preview`, `order`, `created_at`, `updated_at`) VALUES
(1, 1, 'lem-press', 'Lem Press', 'Perekatan ulang bagian tepi sepatu dengan alat press', 'Bagian tepi sepatu (biasanya di sekitar sol atau upper) mulai renggang tapi belum terbuka lebar.', 'Bagian yang renggang dilem ulang lalu di-press dengan alat khusus agar merekat sempurna dan rapi, meniru proses produksi asli.', 'Mencegah rekatan lepas total dan menjaga tampilan sepatu tetap presisi seperti baru.', 'storage/layanan/91ca5957-cb9b-495a-b30f-083c84967af2.jpg', 'storage/layanan/860fe6eb-5c99-407a-add8-358eb463217b.jpg', 0, 0, '2026-07-06 09:53:59', '2026-07-13 02:51:56'),
(2, 1, 'lem-jahit-standard', 'Lem Jahit', 'Penjahitan ulang + penguatan lem pada satu titik', 'Jahitan pada satu sisi/bagian sepatu mulai kendur, putus sebagian, atau ada indikasi akan lepas.', 'Bagian jahitan yang bermasalah dijahit ulang dan diperkuat dengan lem tambahan di titik rawan.', 'Jahitan adalah \"tulang\" yang menahan bentuk sepatu — memperbaikinya di awal mencegah upper lepas dari sol.', 'storage/layanan/6b5c6349-9eaf-4e10-b878-f3e10717a2f4.jpg', 'storage/layanan/8c401dac-1600-4d07-9edf-b32c15626bef.jpg', 1, 1, '2026-07-06 09:53:59', '2026-07-06 10:27:59'),
(3, 1, 'lem-jahit-double', 'Lem Jahit Double', 'Penguatan jahitan dua lapis untuk pemakaian berat', 'Kerusakan jahitan terjadi di lebih dari satu sisi/titik, atau jahitan sebelumnya sudah pernah diperbaiki tapi kembali kendur.', 'Penjahitan ulang dilakukan dua lapis/dua titik untuk daya tahan ekstra.', 'Untuk sepatu yang sering dipakai berat (kerja, olahraga), penguatan ganda membuat sepatu tahan lebih lama sebelum perlu servis ulang.', 'storage/layanan/bd104ad9-afec-47a3-a334-f6cab64de019.jpg', 'storage/layanan/55536c86-c380-4b11-919f-876ff6179b05.jpg', 0, 2, '2026-07-06 09:53:59', '2026-07-13 02:51:38'),
(4, 1, 'lem-spesial-kulit', 'Lem Spesial (Lapis Kulit)', 'Teknik lem khusus untuk material kulit premium', 'Sepatu berbahan kulit premium yang butuh penanganan lem khusus agar tidak merusak tekstur atau warna kulit asli.', 'Menggunakan jenis lem dan teknik khusus yang aman untuk material kulit, termasuk proses pengeringan yang lebih hati-hati.', 'Kulit adalah material investasi — treatment yang salah bisa merusak permukaan secara permanen, sehingga butuh penanganan khusus.', 'storage/layanan/4d4ea236-027a-483d-9f1b-d724efdff09e.jpg', 'storage/layanan/f253b287-fdb1-45cb-8544-99310ceea3a2.jpg', 0, 3, '2026-07-06 09:53:59', '2026-07-13 02:53:52'),
(5, 1, 'lem-checkup', 'Lem Checkup', 'Pemeriksaan preventif titik rekatan sepatu', 'Kamu belum yakin ada kerusakan, tapi ingin memastikan kondisi rekatan sepatu masih aman sebelum dipakai untuk acara penting atau perjalanan panjang.', 'Pemeriksaan menyeluruh titik-titik rekatan sepatu, dengan penguatan preventif di area yang mulai melemah.', 'Mencegah lebih baik daripada mengobati — checkup rutin menghindarkan kejadian sol/upper lepas di saat yang tidak diinginkan.', 'storage/layanan/ee5425f8-6abb-4fc0-ac4f-a234a3680b48.jpg', 'storage/layanan/4715c9d2-d4c4-47b6-b116-000c6e0edd9d.jpg', 0, 4, '2026-07-06 09:53:59', '2026-07-13 03:00:35'),
(6, 1, 'lem-anak', 'Lem Anak (SZ 25-30 / SZ 30-35)', 'Lem jahit standar disesuaikan ukuran sepatu anak', 'Sepatu anak yang aktif bergerak biasanya lebih cepat mengalami kerusakan rekatan dibanding sepatu dewasa.', 'Sama seperti lem jahit standar, namun disesuaikan dengan ukuran dan material sepatu anak yang lebih kecil dan seringkali lebih tipis.', 'Sepatu anak cepat dibeli baru karena dianggap \"gampang rusak\" — reparasi membantu orang tua lebih hemat karena anak masih bisa tumbuh sebelum sepatu benar-benar perlu diganti.', 'storage/layanan/a61df630-3496-4ee0-9a52-a2e751eb8449.jpg', 'storage/layanan/971f092c-2821-4067-8b9a-516d4513324e.jpg', 0, 5, '2026-07-06 09:53:59', '2026-07-13 03:08:58'),
(7, 2, 'ganti-sol-potong', 'Ganti Sol Potong', 'Penggantian sebagian sol yang aus', 'Sol asli sudah botak/aus di bagian tertentu tapi bentuk sol lainnya masih bagus.', 'Bagian sol yang aus dipotong dan diganti dengan material sol baru yang disesuaikan bentuknya.', 'Solusi presisi — hanya bagian yang rusak yang diganti, menghemat biaya dibanding ganti sol keseluruhan.', 'storage/layanan/c168b198-f85c-489c-8d11-8f5ac8825cf5.jpg', 'storage/layanan/9516f8fe-572e-4e41-b264-8457038002eb.jpg', 0, 0, '2026-07-06 09:53:59', '2026-07-13 03:10:46'),
(8, 2, 'ganti-alas-polos-berpola', 'Ganti Alas Polos / Ganti Alas Berpola', 'Penggantian alas bawah sesuai motif asli', 'Alas bawah sol (bagian yang menapak langsung ke tanah) sudah tipis atau licin.', 'Alas lama dilepas, diganti alas baru sesuai motif asli (polos atau bertekstur/pola sesuai desain original).', 'Alas yang licin berisiko membuat pengguna tergelincir — mengganti alas menjaga keamanan sekaligus estetika asli sepatu.', 'storage/layanan/bb0983f8-2e75-45f7-8a62-f8ddcf74751b.jpg', 'storage/layanan/d0fdbb34-077c-4ee8-91f1-2996aa13cec2.jpg', 0, 1, '2026-07-06 09:53:59', '2026-07-13 03:15:56'),
(9, 2, 'ganti-alas-hak', 'Ganti Alas Hak Cewe / Ganti Alas Hak Cowo', 'Penggantian material hak formal/heels', 'Bagian hak (tumit) sepatu formal/heels sudah aus, miring, atau tidak rata.', 'Penggantian material hak dengan tetap menjaga tinggi dan sudut asli agar postur jalan tidak berubah.', 'Hak yang miring memengaruhi keseimbangan tubuh dan bisa merusak postur berjalan dalam jangka panjang.', 'storage/layanan/7572aab7-f69f-4127-bab0-ba7f21e8cd9e.jpg', 'storage/layanan/88a2be94-42c2-4993-8992-3a73209b4f5a.jpg', 0, 2, '2026-07-06 09:53:59', '2026-07-13 03:17:39'),
(10, 2, 'ganti-alas-anak', 'Ganti Alas Anak', 'Penggantian alas disesuaikan ukuran anak', 'Sol sepatu anak cepat aus karena aktivitas bermain yang tinggi.', 'Sama seperti alas dewasa, disesuaikan ukuran dan bentuk sepatu anak.', 'Anak-anak butuh pijakan yang stabil saat masa pertumbuhan — alas yang baik mendukung aktivitas fisik mereka dengan aman.', 'storage/layanan/db5565fc-0722-47e9-a316-9b2e718dc8d7.jpg', 'storage/layanan/0ebccfe2-2f89-4976-a011-acb5be095b55.jpg', 0, 3, '2026-07-06 09:53:59', '2026-07-13 03:19:04'),
(11, 2, 'ganti-sol-kulit', 'Ganti Sol Kulit / Ganti Sol Kulit + Alas', 'Penggantian sol formal dengan material kulit sejenis', 'Sepatu formal/kulit premium dengan sol kulit asli yang sudah tipis atau berlubang.', 'Penggantian sol dengan material kulit sejenis, mempertahankan karakter premium sepatu.', 'Sol kulit memberikan kualitas berjalan dan tampilan formal yang tidak bisa digantikan sol sintetis — investasi mempertahankan level sepatu tetap sama.', 'storage/layanan/3ef0ffdb-11ba-478c-b748-a49e341a70b8.jpg', 'storage/layanan/d0b3bb7f-850d-4a53-889f-6566728cde74.jpg', 0, 4, '2026-07-06 09:53:59', '2026-07-13 03:25:07'),
(12, 2, 'goodyear-welt', 'Goodyear Welt', 'Rekonstruksi sol premium untuk boots/formal tahan puluhan tahun', 'Sepatu dengan konstruksi Goodyear Welt (biasanya boots/formal premium) yang membutuhkan rekonstruksi sol secara menyeluruh dan presisi tinggi.', 'Teknik jahit konstruksi khusus yang menyatukan upper, welt, dan sol dengan metode tradisional yang lebih tahan lama dan bisa diservis berkali-kali.', 'Ini adalah \"level tertinggi\" reparasi sol — sepatu dengan konstruksi ini dirancang untuk bertahan puluhan tahun jika dirawat dengan metode yang sama.', '/assets/layanan/sol/goodyear-welt-before.jpg', '/assets/layanan/sol/goodyear-welt-after.jpg', 0, 5, '2026-07-06 09:53:59', '2026-07-06 09:53:59'),
(13, 2, 'ganti-sol-jadi-cupsole', 'Ganti Sol Jadi (Cupsole) / Ganti Sol Jadi Spesial', 'Penggantian sol cup total untuk sneakers', 'Sepatu sneakers dengan sol cup yang sudah retak, terkelupas, atau hancur (biasanya karena hidrolisis/sol menguning dan rapuh).', 'Sol lama dilepas total, diganti dengan sol cup baru yang cocok dengan bentuk last sepatu.', 'Masalah sol menguning/hancur sangat umum pada sneakers lama — ganti sol menyelamatkan upper yang sebenarnya masih bagus dari harus dibuang percuma.', 'storage/layanan/f09a3c60-8df9-4229-ae7d-fd53241e0c48.jpg', 'storage/layanan/1e4fd405-48d7-46b5-a2c0-d777aa86554a.jpg', 0, 6, '2026-07-06 09:53:59', '2026-07-13 03:28:45'),
(14, 2, 'ganti-sol-foxing', 'Ganti Sol Foxing / Ganti Sol Foxing + Alas', 'Penggantian karet pinggiran sol sneakers kanvas', 'Bagian foxing (pinggiran karet yang membungkus sisi bawah sepatu, umum di sneakers kanvas) rusak atau terkelupas.', 'Penggantian karet foxing menyesuaikan bentuk dan warna asli.', 'Foxing yang rusak membuat air/kotoran mudah masuk — reparasi ini menjaga sepatu tetap terlindungi dan awet.', 'storage/layanan/c135908b-9752-4644-b5da-0fc93e1f78c4.jpg', 'storage/layanan/5c7399c7-fc26-4b26-9336-e1696deea10c.jpg', 0, 7, '2026-07-06 09:53:59', '2026-07-13 03:32:44'),
(15, 2, 'swapsole', 'Swapsole (Tipe Sol Cup / Tipe Sol Potong)', 'Penggantian sol dengan tipe berbeda dari aslinya', 'Kamu ingin mengganti keseluruhan sol dengan tipe/model sol yang berbeda dari aslinya (biasanya untuk kebutuhan gaya atau kenyamanan tambahan).', 'Sol asli dilepas total, diganti dengan tipe sol lain sesuai preferensi.', 'Bagi kolektor atau pemilik sepatu langka, swapsole memberi opsi mempertahankan upper original sambil mendapat kenyamanan sol baru.', 'storage/layanan/5511a898-fe9a-4434-9d08-0fcc55e10bd3.jpg', 'storage/layanan/4693ad20-a19e-4071-b6be-e50962dd4d66.jpg', 0, 8, '2026-07-06 09:53:59', '2026-07-13 03:33:51'),
(16, 2, 'midsole', 'Midsole (Flat / Non Flat / Hard / Lapis / Lapis Kulit)', 'Penggantian lapisan peredam kejut sepatu', 'Midsole (lapisan tengah antara upper dan outsole) sudah kompres, retak, atau kehilangan fungsi bantalan.', 'Penggantian midsole sesuai tipe kebutuhan — flat untuk kestabilan, hard untuk daya tahan, lapis untuk kenyamanan ekstra.', 'Midsole adalah \"peredam kejut\" sepatu — tanpa midsole yang baik, kaki menanggung beban langsung dan lebih cepat lelah/nyeri.', 'storage/layanan/63968456-58c5-4279-9c75-c1b56a182e7f.jpg', 'storage/layanan/81b393ed-249d-4db5-a33a-95881d305dde.jpg', 1, 9, '2026-07-06 09:53:59', '2026-07-06 10:03:01'),
(17, 2, 'resize', 'Resize / Upsize (Shoelast) / Downsize (Double Insole) / Shoelast', 'Penyesuaian ukuran internal sepatu', 'Sepatu terasa kebesaran atau kekecilan dari ukuran kaki sebenarnya.', 'Penyesuaian bentuk internal sepatu menggunakan alat shoelast atau penambahan lapisan insole untuk menyesuaikan ukuran.', 'Sepatu yang pas ukuran mencegah lecet, nyeri kaki, dan cedera jangka panjang akibat postur berjalan yang salah.', 'storage/layanan/0d655f3f-24b0-4f82-99d2-eaf4fa3669e3.jpg', 'storage/layanan/c3e5c22b-6226-46c3-9b6b-33ef8968f17e.jpg', 0, 10, '2026-07-06 09:53:59', '2026-07-13 03:35:03'),
(18, 2, 'bongkar-sole', 'Bongkar Sole', 'Proses pelepasan sol lama sebelum penggantian besar', 'Sebagai proses awal sebelum penggantian sol besar (biasanya termasuk dalam rangkaian jasa lain).', 'Melepas sol lama secara hati-hati agar upper tidak rusak saat proses pembongkaran.', 'Proses ini menentukan apakah upper akan tetap aman untuk dipasangkan sol baru — dilakukan dengan presisi agar tidak ada kerusakan tambahan.', 'storage/layanan/47c5ee55-5326-4862-98ab-d05637347f1e.jpg', 'storage/layanan/6277f9c3-2522-405b-9225-27b0b124a6b3.jpg', 0, 11, '2026-07-06 09:53:59', '2026-07-13 03:35:47'),
(19, 3, 'ganti-upper-pola-sedang', 'Ganti Upper Pola Standard/Kecil/Sedang/Besar (Quarter S/M/L)', 'Penggantian bagian upper yang sobek sesuai ukuran kerusakan', 'Bagian upper (biasanya di area quarter/samping-belakang sepatu) sobek atau rusak parah, dengan ukuran kerusakan yang bervariasi.', 'Bagian upper yang rusak dipotong dan diganti dengan material baru yang dijahit menyatu, disesuaikan ukuran area kerusakan.', 'Menyelamatkan sepatu dari sobekan yang jika dibiarkan akan melebar dan membuat sepatu tidak bisa diperbaiki lagi.', 'storage/layanan/a284b05c-4d66-4c2f-891b-090ccf82d684.jpg', 'storage/layanan/11cb6e7a-c560-4109-a38b-859727d37bba.jpg', 0, 0, '2026-07-06 09:53:59', '2026-07-13 03:37:55'),
(20, 3, 'ganti-linning-sintetis-scuba', 'Ganti Linning Sintetis / Ganti Linning Scuba', 'Penggantian lapisan dalam sepatu', 'Lapisan dalam sepatu (lining) yang bersentuhan dengan kaki sudah mengelupas, kasar, atau menimbulkan gesekan tidak nyaman.', 'Lining lama dilepas, diganti material sintetis/scuba baru yang halus dan nyaman di kulit.', 'Lining yang rusak bisa menyebabkan lecet dan bau tidak enak — mengganti lining langsung meningkatkan kenyamanan pemakaian harian.', 'storage/layanan/a9794b98-ab95-400a-a909-7fe6a27041dc.jpg', 'storage/layanan/38b70570-8b0c-4df9-8d0a-69d2fe9c7c32.jpg', 0, 1, '2026-07-06 09:53:59', '2026-07-13 03:47:25'),
(21, 3, 'ganti-lining-kulit-mesh-besar', 'Ganti Lining Kulit / Ganti Lining Mesh / Ganti Lining Pola Besar', 'Penggantian lining premium/pola besar', 'Sama seperti lining biasa namun untuk sepatu dengan material lining premium (kulit) atau berpola/berukuran lebih besar (boots, sepatu tinggi).', 'Penggantian menyesuaikan material dan pola asli sepatu.', 'Menjaga kualitas kenyamanan setara sepatu baru tanpa harus mengganti keseluruhan sepatu.', 'storage/layanan/a11e3d73-6860-48de-84ca-d1ef654f57b3.jpg', 'storage/layanan/479d2211-adf3-4454-9a4f-f09d30ee8238.jpg', 0, 2, '2026-07-06 09:53:59', '2026-07-13 03:39:15'),
(22, 3, 'ganti-lining-lidah', 'Ganti Lining Lidah', 'Penggantian lapisan dalam bagian tongue', 'Bagian lidah sepatu (tongue) yang sering bergesekan dengan tali/pergelangan kaki sudah rusak linernya.', 'Penggantian lapisan dalam bagian lidah sepatu.', 'Bagian ini sering diabaikan tapi krusial untuk kenyamanan saat sepatu diikat kencang.', 'storage/layanan/2ad54ca0-7264-4911-b3f9-e4c699fc78b0.jpg', 'storage/layanan/f38bece8-2c45-45d1-9a10-d236a71da922.jpg', 0, 3, '2026-07-06 09:53:59', '2026-07-13 03:40:19'),
(23, 3, 'ganti-lining-padded-collar', 'Ganti Lining + Padded Collar', 'Penggantian lining sekaligus busa kerah sepatu', 'Bagian kerah sepatu (collar) yang empuk sudah kempes atau linernya rusak, biasanya pada sneakers/boots.', 'Penggantian lining sekaligus busa padded collar untuk mengembalikan fungsi empuk dan support pergelangan kaki.', 'Padded collar melindungi pergelangan kaki dari gesekan dan cedera — fungsi ini penting terutama untuk sepatu olahraga/basket.', 'storage/layanan/7e06ad91-c528-49b7-9f94-73018b12da9d.jpg', 'storage/layanan/3b75c34c-3425-45de-9db8-ba975c6c4233.jpg', 0, 4, '2026-07-06 09:53:59', '2026-07-13 03:41:32'),
(24, 3, 'ganti-stabilizer-lem', 'Ganti Stabilizer + Lem', 'Pemasangan ulang penopang tumit', 'Stabilizer (penopang di bagian tumit/heel sepatu) sudah lepas atau kehilangan fungsi penopangnya.', 'Pemasangan ulang stabilizer dengan lem khusus agar kembali kokoh menopang tumit.', 'Stabilizer menjaga posisi tumit tetap tegak saat berjalan/berlari — tanpa ini, risiko cedera pergelangan kaki meningkat.', 'storage/layanan/af0ab3b2-7ed6-49f4-a67c-cf590666c276.jpg', 'storage/layanan/6cc99191-e8a0-471d-8f39-dd005bb0673e.jpg', 0, 5, '2026-07-06 09:53:59', '2026-07-13 03:42:20'),
(25, 3, 'upper-treatment', 'Upper Treatment', 'Perawatan preventif material upper', 'Upper masih dalam kondisi baik secara struktur tapi butuh perawatan berkala agar material tetap lentur dan tidak getas.', 'Pembersihan mendalam dan pemberian treatment pelembap/pelindung khusus sesuai jenis material upper.', 'Perawatan preventif ini mencegah material (terutama kulit) menjadi kaku, pecah, atau retak karena kekeringan.', 'storage/layanan/32f4b6ce-0866-450a-b071-9ae94a451f5a.jpg', 'storage/layanan/7dde19a4-c0e8-4de8-90f1-e5112e465f84.jpg', 1, 6, '2026-07-06 09:53:59', '2026-07-06 10:02:40'),
(26, 3, 'rapihkan-jahitan', 'Rapihkan Jahitan', 'Penataan ulang jahitan agar rapi dan simetris', 'Jahitan pada upper terlihat berantakan/tidak simetris meski belum ada yang putus.', 'Penataan ulang jahitan agar rapi dan presisi secara visual.', 'Detail kecil seperti jahitan rapi membuat sepatu terlihat terawat dan mempertahankan nilai estetikanya.', 'storage/layanan/ebad004c-1680-44fa-ab36-579e60e106f7.jpg', 'storage/layanan/b456d015-1dd1-4497-be92-c81cf6851f57.jpg', 0, 7, '2026-07-06 09:53:59', '2026-07-13 03:43:18'),
(27, 3, 'komponen-kecil-upper', 'Pengait Lidah / Tambah Stabilizer / Ganti Paded / Toecup', 'Perbaikan komponen kecil pendukung fungsi upper', 'Komponen-komponen kecil pendukung fungsi upper (pengait lidah, padding, pelindung ujung sepatu) mengalami kerusakan spesifik.', 'Penggantian atau penambahan komponen sesuai titik yang bermasalah.', 'Komponen kecil ini seringkali menjadi penyebab ketidaknyamanan terbesar meski terlihat \"sepele\" — memperbaikinya langsung terasa dampaknya saat dipakai.', 'storage/layanan/6edab488-ff59-47b5-887d-9a751f873556.jpg', 'storage/layanan/eb2df34c-3075-41d0-bc40-391b67c13630.jpg', 0, 8, '2026-07-06 09:53:59', '2026-07-13 03:44:11'),
(28, 3, 'ganti-steel-toe', 'Ganti Steel Toe', 'Pemasangan/penggantian pelindung ujung sepatu safety', 'Sepatu safety dengan pelindung ujung besi/baja yang sudah rusak atau ingin ditambahkan untuk kebutuhan kerja.', 'Pemasangan/penggantian komponen steel toe di bagian ujung sepatu.', 'Fungsi keselamatan kerja — komponen ini krusial untuk melindungi jari kaki dari benda berat/tajam di lingkungan kerja.', 'storage/layanan/df52ece7-232b-4bbc-a5a6-db793fb55765.jpg', 'storage/layanan/ce3244b2-ce95-4499-948b-2746efb35ae1.jpg', 0, 9, '2026-07-06 09:53:59', '2026-07-13 03:44:53'),
(29, 3, 'custom-upper-zipper', 'Custom Upper / Custom Zipper', 'Modifikasi personal pada upper', 'Kamu ingin modifikasi personal pada upper (material, warna, tambahan zipper) di luar bentuk standar.', 'Diskusi kebutuhan personalisasi lalu dieksekusi sesuai request.', 'Bagi yang ingin sepatu benar-benar mencerminkan gaya personal, bukan sekadar diperbaiki tapi \"ditingkatkan\".', 'storage/layanan/913542da-39d7-4d8e-b21e-57ddf1b69da8.jpg', 'storage/layanan/a80af357-5b15-44fd-ba5d-c484c6d7838e.jpg', 0, 10, '2026-07-06 09:53:59', '2026-07-13 03:46:17'),
(30, 4, 'repaint-standard', 'Repaint Standard / Repaint Standard Bahan Spesial', 'Pengecatan ulang sesuai warna original', 'Warna original sepatu mulai pudar/kusam tapi kamu ingin tetap warna yang sama seperti aslinya.', 'Pengecatan ulang menggunakan warna dan teknik yang menyerupai warna original sepatu, disesuaikan jenis material (standar/spesial seperti suede, nubuck).', 'Mengembalikan tampilan \"seperti baru\" tanpa mengubah identitas asli sepatu.', 'storage/layanan/27082b2d-bb47-46e8-9773-51eeac752552.jpg', 'storage/layanan/3a704ea9-08c8-456c-b3b3-a71ce25c0630.jpg', 0, 0, '2026-07-06 09:53:59', '2026-07-13 03:48:19'),
(31, 4, 'repaint-spesial', 'Repaint Spesial / Repaint Spesial Bahan Spesial', 'Pengecatan ulang dengan warna custom pilihan sendiri', 'Kamu ingin perubahan warna dari warna asli ke warna pilihan sendiri.', 'Proses repaint dengan teknik khusus untuk hasil warna custom yang solid dan tahan lama.', 'Kesempatan untuk mengekspresikan gaya personal sekaligus memberi \"hidup baru\" pada sepatu lama.', 'storage/layanan/90a56a6f-0cff-4970-acda-b8068c278db6.jpg', 'storage/layanan/09bd8d2d-2d01-4259-ba90-0cfd129a9894.jpg', 0, 1, '2026-07-06 09:53:59', '2026-07-13 03:50:48'),
(32, 4, 'repaint-patina', 'Repaint Patina / Repaint Patina Bahan Spesial', 'Efek gradasi warna alami khas kulit premium', 'Kamu ingin efek gradasi warna alami (patina) khas sepatu kulit premium/boots.', 'Teknik pewarnaan berlapis untuk menciptakan efek gradasi warna yang terlihat natural dan mewah.', 'Efek patina memberikan karakter unik dan kesan \"matang\" pada sepatu kulit, meningkatkan nilai estetika secara signifikan.', 'storage/layanan/55f758f8-ece9-4c62-b68a-c39ca5233efc.jpg', 'storage/layanan/439befd8-7a90-4be7-8149-c7c7ec3974d9.jpg', 0, 2, '2026-07-06 09:53:59', '2026-07-13 03:55:39'),
(33, 4, 'repaint-multicolor', 'Repaint Multicolor 2 Warna / Multicolor >2 Warna', 'Pengecatan kombinasi warna majemuk', 'Kamu ingin sepatu dengan kombinasi warna majemuk sesuai preferensi personal.', 'Proses pengecatan bertahap dan presisi tinggi untuk memisahkan tiap area warna dengan rapi.', 'Personalisasi maksimal — sepatu jadi benar-benar satu-satunya dengan kombinasi warna sesuai selera kamu.', 'storage/layanan/73673ad0-9c6a-4ed7-90ac-4d2a884455d8.jpg', 'storage/layanan/cb3dd735-cfe9-43f7-822c-f8e7f50824e0.jpg', 1, 3, '2026-07-06 09:53:59', '2026-07-06 10:05:07'),
(34, 4, 'repaint-premium', 'Repaint Premium', 'Finishing paling halus untuk sepatu formal/kulit kelas atas', 'Sepatu premium yang membutuhkan hasil finishing paling halus dan detail, biasanya untuk sepatu formal/kulit kelas atas.', 'Teknik pengecatan dengan standar tertinggi, termasuk proses finishing tambahan agar hasil sehalus dan seawet mungkin.', 'Untuk sepatu bernilai tinggi, kualitas hasil repaint harus setara dengan nilai investasi sepatunya sendiri.', 'storage/layanan/36861e83-682d-454c-bf47-8b57ae24df74.jpg', 'storage/layanan/33b025b4-576f-4f7a-8bf0-0fea3b772ea7.jpg', 0, 4, '2026-07-06 09:53:59', '2026-07-13 03:56:10'),
(35, 4, 'unyellowing-sole', 'Unyellowing Sole', 'Proses kimiawi mengembalikan warna sol yang menguning', 'Sol sepatu (biasanya sneakers putih/translucent) menguning karena oksidasi/usia meski sol masih dalam kondisi bagus.', 'Proses kimiawi khusus untuk mengembalikan warna sol ke kondisi lebih putih/jernih tanpa merusak struktur sol.', 'Sol menguning adalah masalah kosmetik yang paling sering membuat orang merasa sepatu \"sudah tidak layak\" — treatment ini menyelamatkan tampilan tanpa perlu ganti sol.', 'storage/layanan/46aa2cd9-e805-4509-b5ad-c809d466d25b.jpg', 'storage/layanan/7efa9afb-2c74-421e-a04d-b82a9c455cfd.jpg', 0, 5, '2026-07-06 09:53:59', '2026-07-13 03:56:50'),
(36, 4, 'laser', 'Laser', 'Ukiran motif/logo presisi tinggi pada upper', 'Kamu ingin detail custom seperti motif, logo, atau pola presisi tinggi pada upper.', 'Teknik laser untuk mengukir/membentuk motif detail pada permukaan material.', 'Menghasilkan detail personalisasi yang tidak bisa dicapai dengan teknik manual biasa.', 'storage/layanan/cb253398-be0f-45eb-997c-8e4dd7f86ca9.jpg', 'storage/layanan/8cfeca9b-2bc7-4723-ac43-3eb902ca93a0.jpg', 0, 6, '2026-07-06 09:53:59', '2026-07-13 03:57:30'),
(37, 4, 'dtf', 'DTF (Direct to Film)', 'Print transfer desain/grafis ke upper', 'Kamu ingin menambahkan desain/print grafis pada bagian upper sepatu.', 'Teknik print transfer film langsung ke material sepatu untuk hasil grafis yang tajam dan tahan lama.', 'Opsi kustomisasi visual yang fleksibel untuk berbagai jenis desain, dari simpel sampai kompleks.', 'storage/layanan/6c4d7157-544d-410a-b30b-d9d9912a74aa.jpg', 'storage/layanan/a5004ab1-0608-46e7-ace7-774abb940c89.jpg', 0, 7, '2026-07-06 09:53:59', '2026-07-13 03:59:02'),
(38, 4, 'aksesoris-finishing', 'Aksesoris & Finishing Kecil (Sole Protector, Ganti Hook, D-Ring, Eyelet, Velcrow, Heel Patch, Swoosh, Laces Guard, Stripe, dll)', 'Perbaikan/penambahan detail kecil pendukung tampilan', 'Detail-detail kecil pendukung fungsi dan tampilan sepatu (pengait tali, pelindung sol, logo/motif tambahan) rusak atau ingin diperbarui.', 'Penggantian atau penambahan komponen sesuai kebutuhan spesifik.', 'Detail kecil sering menjadi pembeda antara sepatu yang \"terlihat terawat\" dan yang \"terlihat lelah\" — finishing touch ini menyempurnakan hasil reparasi keseluruhan.', 'storage/layanan/53044ee0-f9c8-4e31-86d4-c2c3f8fa4121.jpg', 'storage/layanan/ddaa5de7-11e4-480f-8ade-30a26614d3d0.jpg', 0, 8, '2026-07-06 09:53:59', '2026-07-13 04:00:30');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_26_070820_create_services_table', 1),
(5, '2026_01_26_070824_create_hero_sections_table', 1),
(6, '2026_01_26_070824_create_trust_items_table', 1),
(7, '2026_01_26_070825_create_projects_table', 1),
(8, '2026_01_26_070825_create_workflows_table', 1),
(9, '2026_01_26_070826_create_about_sections_table', 1),
(10, '2026_01_26_070826_create_cta_sections_table', 1),
(11, '2026_01_26_070826_create_settings_table', 1),
(12, '2026_01_27_011149_create_posts_table', 1),
(13, '2026_05_18_080459_create_reviews_table', 2),
(14, '2026_06_11_000001_add_role_and_avatar_to_users_table', 3),
(15, '2026_06_11_000002_create_donations_table', 3),
(16, '2026_06_11_000003_create_daily_logins_table', 3),
(17, '2026_06_11_000004_create_rewards_table', 3),
(18, '2026_06_11_000005_create_user_rewards_table', 3),
(19, '2026_06_11_065602_add_phone_to_users_table', 3),
(20, '2026_06_12_013919_create_donation_items_table', 4),
(21, '2026_06_12_013922_create_donation_requests_table', 4),
(22, '2026_06_12_015400_add_kondisi_to_donation_items_table', 4),
(23, '2026_06_12_021416_add_ukuran_to_donation_items_table', 4),
(24, '2026_06_12_102015_add_spk_to_donations_table', 4),
(25, '2026_06_12_102533_change_foto_path_to_text_in_donations', 4),
(26, '2026_06_12_104645_add_donation_id_to_donation_items_table', 4),
(27, '2026_06_12_133300_insert_open_donasi_hero_section', 4),
(28, '2026_06_18_145913_add_details_to_donation_items_table', 5),
(29, '2026_06_18_150423_restructure_donation_item_services_table', 5),
(30, '2026_06_23_000000_create_campaigns_table', 6),
(31, '2026_06_27_105452_add_kode_barang_to_donation_items_table', 7),
(32, '2026_06_27_113033_add_email_and_alasan_to_donation_requests_table', 7),
(33, '2026_07_04_000000_create_layanan_categories_table', 8),
(34, '2026_07_04_000001_create_layanan_services_table', 8),
(35, '2026_07_06_150000_add_warna_and_services_to_donations_tables', 9),
(36, '2026_07_09_104600_change_donatur_role_to_member_in_users_table', 10),
(37, '2026_07_09_153220_alter_status_enum_in_donations_table', 10),
(38, '2026_07_09_164529_alter_and_add_columns_to_donation_requests_table', 10),
(39, '2026_07_10_092700_add_disetujui_to_donations_status', 10),
(40, '2026_07_10_104800_alter_status_add_selesai_to_donation_requests_table', 10),
(41, '2026_07_10_133135_create_notifications_table', 10),
(42, '2026_07_11_110941_add_reward_columns_to_rewards_and_donations_tables', 10),
(43, '2026_07_11_171200_fix_users_role_enum', 11),
(44, '2026_07_16_161500_add_super_admin_role_to_users_table', 12),
(45, '2026_07_17_000000_rename_lem_jahit_to_reparasi_sol_in_services', 13),
(46, '2026_07_18_032200_modify_status_enum_in_donation_items_table', 14),
(47, '2026_07_18_034600_modify_status_enum_in_daily_logins_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('0fa75924-be5b-47b8-8adb-c0ebfc0d6361', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 1, '{\"title\":\"Bukti Pembayaran Diunggah!\",\"message\":\"Denata Arif Nur Muhamad telah mengunggah bukti pembayaran untuk adopsi sepatu.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/admin\\/donation-requests\",\"icon\":\"receipt\",\"type\":\"success\"}', NULL, '2026-07-13 04:48:35', '2026-07-13 04:48:35'),
('102c1c90-da23-4670-ad6b-5605c992464e', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 1, '{\"title\":\"Donasi Baru Masuk!\",\"message\":\"Ada pengajuan donasi sepatu baru dari Rivael Saputra. Segera cek di halaman donasi.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/admin\\/donations\",\"icon\":\"volunteer_activism\",\"type\":\"info\"}', NULL, '2026-07-16 08:49:42', '2026-07-16 08:49:42'),
('132889cf-fa7f-4a0a-a4f6-9708a0e3541d', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 27, '{\"title\":\"Bukti Pembayaran Diunggah!\",\"message\":\"Quality Assurance (Radit) telah mengunggah bukti pembayaran untuk adopsi sepatu.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/admin\\/donation-requests\",\"icon\":\"receipt\",\"type\":\"success\"}', '2026-08-08 10:20:21', '2026-08-03 07:45:14', '2026-08-08 10:20:21'),
('152e8a94-6200-4c55-80b2-336eafdbd217', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 1, '{\"title\":\"Donasi Baru Masuk!\",\"message\":\"Ada pengajuan donasi sepatu baru dari Denata Arif Nur Muhamad. Segera cek di halaman donasi.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/admin\\/donations\",\"icon\":\"volunteer_activism\",\"type\":\"info\"}', NULL, '2026-07-11 09:32:56', '2026-07-11 09:32:56'),
('15f6d5ea-8a8c-48a0-ab54-cbe1693b3944', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 27, '{\"title\":\"Pengajuan Adopsi Baru!\",\"message\":\"Brandon baru saja mengajukan adopsi untuk barang kode: 024-DS.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/admin\\/donation-requests\",\"icon\":\"shopping_bag\",\"type\":\"info\"}', NULL, '2026-08-14 06:40:50', '2026-08-14 06:40:50'),
('18ebc7be-ffdd-4ba9-a176-45c9d01e991d', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 18, '{\"title\":\"Donasi Ditolak\",\"message\":\"Mohon maaf, donasi Timberland Anda belum dapat kami terima. Cek catatan admin.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/member\\/donations\",\"icon\":\"cancel\",\"type\":\"error\"}', NULL, '2026-07-18 01:50:50', '2026-07-18 01:50:50'),
('1bc76557-5414-4ba0-9b82-9859cfa1a86b', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 27, '{\"title\":\"Pengajuan Adopsi Baru!\",\"message\":\"Rivael Saputra baru saja mengajukan adopsi untuk barang kode: 015-DS.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/admin\\/donation-requests\",\"icon\":\"shopping_bag\",\"type\":\"info\"}', '2026-08-08 10:20:21', '2026-07-18 04:00:18', '2026-08-08 10:20:21'),
('2eaa43b2-333e-4bbd-9ae2-c37dee6bce0f', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 1, '{\"title\":\"Bukti Pembayaran Diunggah!\",\"message\":\"Denata Arif Nur Muhamad telah mengunggah bukti pembayaran untuk adopsi sepatu.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/admin\\/donation-requests\",\"icon\":\"receipt\",\"type\":\"success\"}', NULL, '2026-07-13 04:42:30', '2026-07-13 04:42:30'),
('30266722-d2e3-489b-af7d-9acdd76da77e', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 1, '{\"title\":\"Pengajuan Adopsi Baru!\",\"message\":\"Quality Assurance (Radit) baru saja mengajukan adopsi untuk barang kode: 053-DS.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/admin\\/donation-requests\",\"icon\":\"shopping_bag\",\"type\":\"info\"}', NULL, '2026-08-03 07:42:50', '2026-08-03 07:42:50'),
('341c1396-7fa9-4994-8617-90c760bfdb01', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 1, '{\"title\":\"Bukti Pembayaran Diunggah!\",\"message\":\"Denata Arif Nur Muhamad telah mengunggah bukti pembayaran untuk adopsi sepatu.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/admin\\/donation-requests\",\"icon\":\"receipt\",\"type\":\"success\"}', NULL, '2026-07-11 09:27:50', '2026-07-11 09:27:50'),
('361253f8-ddd7-45d2-a440-6dcf834fc5ec', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 18, '{\"title\":\"Check-in Berhasil\",\"message\":\"Anda telah check-in untuk hari ke-1 di minggu ini. Semangat!\",\"url\":\"https:\\/\\/shoeworkshop.id\\/member\\/checkin\",\"icon\":\"today\",\"type\":\"success\"}', '2026-07-16 08:46:23', '2026-07-16 08:46:14', '2026-07-16 08:46:23'),
('3a1ae8e8-939e-48fa-809b-a9dc6a68e034', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 19, '{\"title\":\"Pembayaran Divalidasi\",\"message\":\"Pembayaran Anda untuk Sepatu Sneakers Adidas Retro Running Red White divalidasi. Sepatu sedang disiapkan.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/member\\/adoption-requests\",\"icon\":\"inventory_2\",\"type\":\"info\"}', '2026-07-11 09:54:19', '2026-07-11 09:52:35', '2026-07-11 09:54:19'),
('3b11460b-642b-429f-82cb-67b37869aa8f', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 16, '{\"title\":\"Pengajuan Adopsi Baru!\",\"message\":\"Quality Assurance (Radit) baru saja mengajukan adopsi untuk barang kode: 022-DS.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/admin\\/donation-requests\",\"icon\":\"shopping_bag\",\"type\":\"info\"}', '2026-07-16 07:52:05', '2026-07-16 07:47:02', '2026-07-16 07:52:05'),
('3ccc1d95-589c-4320-9ef0-8ee341cb70f3', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 19, '{\"title\":\"Sepatu Masuk Katalog!\",\"message\":\"Sepatu donasi Anda New Balance telah direstorasi dan kini terpajang di Katalog!\",\"url\":\"https:\\/\\/shoeworkshop.id\\/member\\/donations\",\"icon\":\"storefront\",\"type\":\"success\"}', NULL, '2026-07-13 04:27:08', '2026-07-13 04:27:08'),
('408bcbd7-34c8-4c43-8473-9d63ade8d075', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 1, '{\"title\":\"Pengajuan Adopsi Baru!\",\"message\":\"Denata Arif Nur Muhamad baru saja mengajukan adopsi untuk barang kode: 044-DS.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/admin\\/donation-requests\",\"icon\":\"shopping_bag\",\"type\":\"info\"}', NULL, '2026-07-13 04:48:14', '2026-07-13 04:48:14'),
('40e99725-548d-4dae-9beb-2beba6862693', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 1, '{\"title\":\"Pengajuan Adopsi Baru!\",\"message\":\"Alqia Abdul baru saja mengajukan adopsi untuk barang kode: 035-DS.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/admin\\/donation-requests\",\"icon\":\"shopping_bag\",\"type\":\"info\"}', NULL, '2026-07-16 02:49:13', '2026-07-16 02:49:13'),
('40fe6439-4805-4086-aa14-3051dd66a3d4', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 27, '{\"title\":\"Donasi Baru Masuk!\",\"message\":\"Ada pengajuan donasi sepatu baru dari Rivael Saputra. Segera cek di halaman donasi.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/admin\\/donations\",\"icon\":\"volunteer_activism\",\"type\":\"info\"}', '2026-07-17 06:31:48', '2026-07-16 08:49:42', '2026-07-17 06:31:48'),
('42396863-6994-4f2b-9550-bb44b5dc83e4', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 19, '{\"title\":\"Pesanan Dikirim\",\"message\":\"Hore! Sepatu Sneakers Adidas Stan Smith White Navy Leather Anda telah dikirim. Lacak sekarang!\",\"url\":\"https:\\/\\/shoeworkshop.id\\/member\\/adoption-requests\",\"icon\":\"local_shipping\",\"type\":\"success\"}', NULL, '2026-07-13 04:52:22', '2026-07-13 04:52:22'),
('4ae9ec38-cf99-4118-9d2f-cd2157d8a276', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 27, '{\"title\":\"Permohonan Dibatalkan\\/Ditolak\",\"message\":\"Maaf, permohonan\\/tagihan Anda untuk Sepatu Sneakers Slip On All Black Sport Casual (Tanpa Tali) telah dibatalkan atau ditolak.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/member\\/adoption-requests\",\"icon\":\"cancel\",\"type\":\"error\"}', '2026-07-16 08:39:37', '2026-07-16 07:52:12', '2026-07-16 08:39:37'),
('57b9e591-9203-42be-86aa-b0bdb69b9ab9', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 1, '{\"title\":\"Pengajuan Adopsi Baru!\",\"message\":\"Rivael Saputra baru saja mengajukan adopsi untuk barang kode: 015-DS.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/admin\\/donation-requests\",\"icon\":\"shopping_bag\",\"type\":\"info\"}', NULL, '2026-07-18 04:00:18', '2026-07-18 04:00:18'),
('5c88f30a-6a7c-4a3b-863a-2a60b94a7a4b', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 16, '{\"title\":\"Bukti Pembayaran Diunggah!\",\"message\":\"Denata Arif Nur Muhamad telah mengunggah bukti pembayaran untuk adopsi sepatu.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/admin\\/donation-requests\",\"icon\":\"receipt\",\"type\":\"success\"}', '2026-07-17 07:56:58', '2026-07-11 09:27:50', '2026-07-17 07:56:58'),
('67c6e471-f9da-4180-88a0-8b8c7e30b63b', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 16, '{\"title\":\"Bukti Pembayaran Diunggah!\",\"message\":\"Denata Arif Nur Muhamad telah mengunggah bukti pembayaran untuk adopsi sepatu.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/admin\\/donation-requests\",\"icon\":\"receipt\",\"type\":\"success\"}', '2026-07-17 07:56:58', '2026-07-13 04:42:30', '2026-07-17 07:56:58'),
('67f7adb3-5611-4221-ab66-2a14005bde0c', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 27, '{\"title\":\"Pengajuan Adopsi Baru!\",\"message\":\"Admin Analist 4 baru saja mengajukan adopsi untuk barang kode: 179-DS.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/admin\\/donation-requests\",\"icon\":\"shopping_bag\",\"type\":\"info\"}', '2026-08-08 10:20:21', '2026-07-31 07:03:21', '2026-08-08 10:20:21'),
('6f8c9ef9-9d4e-4421-87f2-3264945792e6', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 1, '{\"title\":\"Pengajuan Adopsi Baru!\",\"message\":\"Quality Assurance (Radit) baru saja mengajukan adopsi untuk barang kode: 022-DS.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/admin\\/donation-requests\",\"icon\":\"shopping_bag\",\"type\":\"info\"}', NULL, '2026-07-16 07:47:02', '2026-07-16 07:47:02'),
('8624878a-94be-4c91-a1fe-f3ebb773d696', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 27, '{\"title\":\"Check-in Berhasil\",\"message\":\"Anda telah check-in untuk hari ke-1 di minggu ini. Semangat!\",\"url\":\"https:\\/\\/shoeworkshop.id\\/member\\/checkin\",\"icon\":\"today\",\"type\":\"success\"}', '2026-07-16 08:45:44', '2026-07-16 08:44:29', '2026-07-16 08:45:44'),
('86e591ed-8ad5-4fa2-aecf-4ce31814b6ec', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 16, '{\"title\":\"Pengajuan Adopsi Baru!\",\"message\":\"Denata Arif Nur Muhamad baru saja mengajukan adopsi untuk barang kode: 045-DS.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/admin\\/donation-requests\",\"icon\":\"shopping_bag\",\"type\":\"info\"}', '2026-07-17 07:56:58', '2026-07-11 09:26:20', '2026-07-17 07:56:58'),
('876cfadf-5236-4b64-a38f-8bd37eb431d6', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 18, '{\"title\":\"Check-in Berhasil\",\"message\":\"Anda telah check-in untuk hari ke-1 di minggu ini. Semangat!\",\"url\":\"https:\\/\\/shoeworkshop.id\\/member\\/checkin\",\"icon\":\"today\",\"type\":\"success\"}', '2026-07-18 03:52:51', '2026-07-18 03:49:42', '2026-07-18 03:52:51'),
('96a02a40-80e7-4902-92e9-800ab8c2c998', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 1, '{\"title\":\"Pengajuan Adopsi Baru!\",\"message\":\"Denata Arif Nur Muhamad baru saja mengajukan adopsi untuk barang kode: 044-DS.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/admin\\/donation-requests\",\"icon\":\"shopping_bag\",\"type\":\"info\"}', NULL, '2026-07-13 04:41:54', '2026-07-13 04:41:54'),
('977e8d18-a881-4c0d-bd33-3ddfd1bac645', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 16, '{\"title\":\"Pengajuan Adopsi Baru!\",\"message\":\"Denata Arif Nur Muhamad baru saja mengajukan adopsi untuk barang kode: 044-DS.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/admin\\/donation-requests\",\"icon\":\"shopping_bag\",\"type\":\"info\"}', '2026-07-17 07:56:58', '2026-07-13 04:41:54', '2026-07-17 07:56:58'),
('9b1418c1-715e-4407-be99-655d934eb014', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 16, '{\"title\":\"Pengajuan Adopsi Baru!\",\"message\":\"Alqia Abdul baru saja mengajukan adopsi untuk barang kode: 035-DS.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/admin\\/donation-requests\",\"icon\":\"shopping_bag\",\"type\":\"info\"}', '2026-07-16 03:00:03', '2026-07-16 02:49:13', '2026-07-16 03:00:03'),
('ad6108dd-e054-4c28-b537-46cad431d5e7', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 27, '{\"title\":\"Donasi Baru Masuk!\",\"message\":\"Ada pengajuan donasi sepatu baru dari Rivael Saputra. Segera cek di halaman donasi.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/admin\\/donations\",\"icon\":\"volunteer_activism\",\"type\":\"info\"}', '2026-08-08 10:20:21', '2026-07-18 01:49:34', '2026-08-08 10:20:21'),
('b36fbfed-de93-4fda-a5cd-3e27e4b1f4c3', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 16, '{\"title\":\"Pengajuan Adopsi Baru!\",\"message\":\"Denata Arif Nur Muhamad baru saja mengajukan adopsi untuk barang kode: 044-DS.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/admin\\/donation-requests\",\"icon\":\"shopping_bag\",\"type\":\"info\"}', '2026-07-17 07:56:58', '2026-07-13 04:48:14', '2026-07-17 07:56:58'),
('bb370119-5983-4d8e-8ec5-5ee074669b95', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 1, '{\"title\":\"Pengajuan Adopsi Baru!\",\"message\":\"Brandon baru saja mengajukan adopsi untuk barang kode: 024-DS.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/admin\\/donation-requests\",\"icon\":\"shopping_bag\",\"type\":\"info\"}', NULL, '2026-08-14 06:40:50', '2026-08-14 06:40:50'),
('c5f01048-d425-4839-bfeb-ee86f259b23a', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 1, '{\"title\":\"Donasi Baru Masuk!\",\"message\":\"Ada pengajuan donasi sepatu baru dari Rivael Saputra. Segera cek di halaman donasi.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/admin\\/donations\",\"icon\":\"volunteer_activism\",\"type\":\"info\"}', NULL, '2026-07-18 01:49:34', '2026-07-18 01:49:34'),
('ce1f7b9b-78bf-49d1-b4af-59fa84030240', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 27, '{\"title\":\"Pengajuan Adopsi Baru!\",\"message\":\"Quality Assurance (Radit) baru saja mengajukan adopsi untuk barang kode: 053-DS.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/admin\\/donation-requests\",\"icon\":\"shopping_bag\",\"type\":\"info\"}', '2026-08-08 10:20:21', '2026-08-03 07:42:50', '2026-08-08 10:20:21'),
('ce3be038-e17c-4f79-99dc-d1b95d3f80b7', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 19, '{\"title\":\"Sepatu Diterima!\",\"message\":\"Terima kasih! Sepatu New Balance Anda telah kami terima di workshop dan masuk antrean restorasi.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/member\\/donations\",\"icon\":\"volunteer_activism\",\"type\":\"success\"}', NULL, '2026-07-13 04:16:54', '2026-07-13 04:16:54'),
('d429705d-7f71-40a7-9ac9-9d49eb9f5002', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 1, '{\"title\":\"Pengajuan Adopsi Baru!\",\"message\":\"Admin Analist 4 baru saja mengajukan adopsi untuk barang kode: 179-DS.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/admin\\/donation-requests\",\"icon\":\"shopping_bag\",\"type\":\"info\"}', NULL, '2026-07-31 07:03:21', '2026-07-31 07:03:21'),
('d8f4ddf4-f801-4cfc-b384-c72f029c3376', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 16, '{\"title\":\"Bukti Pembayaran Diunggah!\",\"message\":\"Denata Arif Nur Muhamad telah mengunggah bukti pembayaran untuk adopsi sepatu.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/admin\\/donation-requests\",\"icon\":\"receipt\",\"type\":\"success\"}', '2026-07-16 03:00:14', '2026-07-13 04:48:35', '2026-07-16 03:00:14'),
('dbaf44ab-c7a7-4b38-ade3-d90f274a5724', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 1, '{\"title\":\"Bukti Pembayaran Diunggah!\",\"message\":\"Quality Assurance (Radit) telah mengunggah bukti pembayaran untuk adopsi sepatu.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/admin\\/donation-requests\",\"icon\":\"receipt\",\"type\":\"success\"}', NULL, '2026-08-03 07:45:14', '2026-08-03 07:45:14'),
('dd2dbad0-de4d-4b34-b2f7-adce98d0bec3', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 16, '{\"title\":\"Permohonan Dibatalkan\\/Ditolak\",\"message\":\"Maaf, permohonan\\/tagihan Anda untuk Sandal Wanita telah dibatalkan atau ditolak.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/member\\/adoption-requests\",\"icon\":\"cancel\",\"type\":\"error\"}', '2026-08-03 08:53:34', '2026-07-31 07:03:47', '2026-08-03 08:53:34'),
('e5c08cd6-b237-4f05-8e7d-72bcbd2d1721', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 19, '{\"title\":\"Donasi Disetujui!\",\"message\":\"Terima kasih! Pengajuan donasi sepatu New Balance Anda telah kami setujui. Silakan cek email Anda untuk instruksi pengiriman.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/member\\/donations\",\"icon\":\"volunteer_activism\",\"type\":\"success\"}', NULL, '2026-07-13 04:14:07', '2026-07-13 04:14:07'),
('e9bcacf7-1ef8-4572-999e-a5c9eced1334', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 19, '{\"title\":\"Pembayaran Divalidasi\",\"message\":\"Pembayaran Anda untuk Sepatu Sneakers Adidas Stan Smith White Navy Leather divalidasi. Sepatu sedang disiapkan.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/member\\/adoption-requests\",\"icon\":\"inventory_2\",\"type\":\"info\"}', NULL, '2026-07-13 04:49:30', '2026-07-13 04:49:30'),
('eafcf66d-ce89-493b-b725-45e95d64d872', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 4, '{\"title\":\"Donasi Ditolak\",\"message\":\"Mohon maaf, donasi nike Anda belum dapat kami terima. Cek catatan admin.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/member\\/donations\",\"icon\":\"cancel\",\"type\":\"error\"}', NULL, '2026-07-13 04:18:58', '2026-07-13 04:18:58'),
('ec8e1610-6f9e-43c2-afe8-e84acbb566a2', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 19, '{\"title\":\"Permohonan Dibatalkan\\/Ditolak\",\"message\":\"Maaf, permohonan\\/tagihan Anda untuk Sepatu Sneakers Adidas Stan Smith White Navy Leather telah dibatalkan atau ditolak.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/member\\/adoption-requests\",\"icon\":\"cancel\",\"type\":\"error\"}', NULL, '2026-07-13 04:46:00', '2026-07-13 04:46:00'),
('ef36c1ff-c077-4fba-b8b1-64668d0eff23', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 1, '{\"title\":\"Pengajuan Adopsi Baru!\",\"message\":\"Denata Arif Nur Muhamad baru saja mengajukan adopsi untuk barang kode: 045-DS.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/admin\\/donation-requests\",\"icon\":\"shopping_bag\",\"type\":\"info\"}', NULL, '2026-07-11 09:26:20', '2026-07-11 09:26:20'),
('f6d31c03-c419-4463-92ae-7bed8b1e51eb', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 16, '{\"title\":\"Donasi Baru Masuk!\",\"message\":\"Ada pengajuan donasi sepatu baru dari Denata Arif Nur Muhamad. Segera cek di halaman donasi.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/admin\\/donations\",\"icon\":\"volunteer_activism\",\"type\":\"info\"}', '2026-07-17 07:56:58', '2026-07-11 09:32:56', '2026-07-17 07:56:58'),
('fb092dcf-0589-4185-995a-f991a9e5ac17', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 19, '{\"title\":\"Pesanan Dikirim\",\"message\":\"Hore! Sepatu Sneakers Adidas Retro Running Red White Anda telah dikirim. Lacak sekarang!\",\"url\":\"https:\\/\\/shoeworkshop.id\\/member\\/adoption-requests\",\"icon\":\"local_shipping\",\"type\":\"success\"}', '2026-07-11 09:54:19', '2026-07-11 09:54:13', '2026-07-11 09:54:19'),
('fe3ae75c-0bf0-476b-9d60-e1126c836212', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 27, '{\"title\":\"Pengajuan Adopsi Baru!\",\"message\":\"Quality Assurance (Radit) baru saja mengajukan adopsi untuk barang kode: 022-DS.\",\"url\":\"https:\\/\\/shoeworkshop.id\\/admin\\/donation-requests\",\"icon\":\"shopping_bag\",\"type\":\"info\"}', '2026-07-16 08:40:17', '2026-07-16 07:47:02', '2026-07-16 08:40:17');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('denataarif@gmail.com', '$2y$12$q22z7fKULOZiGWkSgeUDNekmAgHik5gKlOskR5j8KCcNM9Ue89zj6', '2026-06-11 18:14:16');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'General',
  `status` enum('draft','published') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `thumbnail`, `content`, `category`, `status`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 'Cara Merawat Sepatu Leather Agar Tetap Mengkilap', 'cara-merawat-sepatu-leather-agar-tetap-mengkilap', 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&q=80&w=800', 'Sepatu berbahan kulit atau leather memerlukan perawatan ekstra dibandingkan bahan canvas. Langkah pertama yang harus dilakukan adalah selalu membersihkan debu setelah dipakai menggunakan sikat halus. Jangan langsung menggunakan air, tapi gunakanlah leather cleaner yang sesuai. Oleskan secara merata dan diamkan sejenak sebelum di lap dengan kain microfiber. Untuk menjaga kelembapan kulit, gunakan leather conditioner setiap satu bulan sekali.', 'Shoe Care', 'published', '2026-01-26 18:56:35', '2026-01-26 18:56:35', '2026-01-26 18:56:35'),
(2, 'Mengapa Sol Sepatu Sering Lepas?', 'mengapa-sol-sepatu-sering-lepas', 'https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?auto=format&fit=crop&q=80&w=800', 'Banyak pelanggan datang ke workshop kami dengan keluhan sol sepatu yang tiba-tiba copot atau \"mangap\". Penyebab utamanya biasanya adalah faktor usia lem atau kondisi penyimpanan yang lembap. Di Shoe Workshop, kami mengatasi masalah ini dengan pembersihan sisa lem lama secara total sebelum mengaplikasikan lem standar industri yang tahan panas dan air. Proses ini memastikan sol menempel kuat seperti baru keluar dari pabrik.', 'Workshop Stories', 'published', '2026-01-26 18:56:35', '2026-01-26 18:56:35', '2026-01-26 18:56:35'),
(3, 'Promo Ramadhan: Deep Clean 3 Sepatu Gratis 1', 'promo-ramadhan-deep-clean-3-sepatu-gratis-1', 'https://images.unsplash.com/photo-1560769629-975ec94e6a86?auto=format&fit=crop&q=80&w=800', 'Menyambut bulan suci Ramadhan, Shoe Workshop memberikan penawaran spesial untuk Anda yang ingin tampil bersih saat hari raya. Cukup bawa 3 pasang sepatu untuk layanan Deep Clean, maka Anda berhak mendapatkan 1 layanan Deep Clean tambahan secara GRATIS. Promo ini berlaku selama bulan Ramadhan untuk semua jenis sepatu canvas dan leather.', 'Update & promo', 'published', '2026-01-26 18:56:35', '2026-01-26 18:56:35', '2026-01-26 18:56:35');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `before_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `after_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `category`, `description`, `before_image`, `after_image`, `service_id`, `is_featured`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'GANTI SOL JADI SPESIAL Repaint Multicolor 2 Warna', 'Repaint', 'Hasil pengerjaan profesional untuk Repaint', 'portfolio/2e57e3b1-fa8c-4a52-a14a-c3e4c1d297cb.jpg', 'portfolio/cd2f1f80-8e60-4539-9d54-94f20df1ec5c.jpg', 2, 1, 1, '2026-01-26 18:56:35', '2026-07-13 01:38:07'),
(2, 'ALAS KOMPONEN + LEM ( BAGIAN ALAS YG HILANG SAJA )', 'Lem & Jahit', 'Hasil pengerjaan profesional untuk Ganti Sol', 'portfolio/67d33331-ece2-48f0-8ed9-b89e7ba72955.jpg', 'portfolio/aeb82be3-48f7-47ee-8393-ea1642a95b4a.jpg', 4, 0, 1, '2026-01-26 18:56:35', '2026-07-13 02:43:22'),
(3, 'MIDSOLE FLAT Deep Clean', 'Deep Clean', 'Hasil pengerjaan profesional untuk Deep Clean', 'portfolio/FKij6loabtPm9ar3FcTUsi0KWUnDsxHiMtWA6uAE.jpg', 'portfolio/mI4B6xe7qdrDs7mXGRCjbZ2QWnK5pk0VqHuKeTda.jpg', 3, 1, 1, '2026-01-26 18:56:35', '2026-07-03 10:44:50');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` tinyint(4) NOT NULL DEFAULT '5',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `order` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `location`, `avatar`, `rating`, `content`, `is_active`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Rizky Pratama', 'Jakarta', NULL, 5, 'Hasilnya memuaskan banget! Sepatu yang kusam kembali seperti baru. Pelayanan ramah dan cepat. Pasti langganan di Shoe Workshop', 1, 1, '2026-07-13 01:25:24', '2026-07-13 01:25:24'),
(2, 'Sari Dewi Triatmodjo', 'Depok', NULL, 5, 'Sol sepatu saya yang lepas berhasil diperbaiki dengan sangat rapi. Harga terjangkau dan hasilnya bagus banget. Recommended!', 1, 2, '2026-07-13 01:26:05', '2026-07-13 01:26:41'),
(3, 'Diana Putri', 'Bandung', NULL, 4, 'Pelayanannya profesional dan komunikatif. Selalu update progress pekerjaan via WhatsApp. Hasil kerja memuaskan!', 1, 3, '2026-07-13 01:26:34', '2026-07-13 01:26:34'),
(4, 'Ahmad Fauzi', 'Bekasi', NULL, 5, 'Repaint sneaker putih saya hasilnya luar biasa! Warnanya merata dan bersih. Pengerjaan cepat, dalam 3 hari sudah selesai.', 1, 4, '2026-07-13 01:27:12', '2026-07-13 01:27:34');

-- --------------------------------------------------------

--
-- Table structure for table `rewards`
--

CREATE TABLE `rewards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori_reward` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'daily_checkin',
  `nama_reward` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` enum('voucher','diskon','konsultasi','lainnya') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'voucher',
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_kupon` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_aktif` tinyint(1) NOT NULL DEFAULT '1',
  `minggu_ke` int(11) DEFAULT NULL,
  `berlaku_dari` date DEFAULT NULL,
  `berlaku_sampai` date DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rewards`
--

INSERT INTO `rewards` (`id`, `kategori_reward`, `nama_reward`, `jenis`, `deskripsi`, `kode_kupon`, `nilai`, `status_aktif`, `minggu_ke`, `berlaku_dari`, `berlaku_sampai`, `stok`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'daily_checkin', 'Voucher Sepatu Gratis', 'diskon', 'Cuci Sepatu Gratis di ShoeWorkshop', 'CUCISW', '20%', 1, 1, NULL, NULL, NULL, 1, '2026-06-11 02:14:56', '2026-06-11 02:14:56');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `order` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `icon`, `is_active`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Reparasi Sol', 'Sol lepas, jahitan terbuka? Kami perbaiki dengan lem standar industri.', '🧵', 1, 0, '2026-01-26 18:56:35', '2026-01-26 18:56:35'),
(2, 'Repaint', 'Warna sepatu pudar? Kami cat ulang dengan warna aslinya.', '🎨', 1, 1, '2026-01-26 18:56:35', '2026-01-26 18:56:35'),
(3, 'Deep Clean', 'Pembersihan menyeluruh hingga ke sela-sela terdalam sepatu Anda.', '✨', 1, 2, '2026-01-26 18:56:35', '2026-01-26 18:56:35'),
(4, 'Perbaikan Upper', 'Robek atau bolong pada bagian kain/kulit sepatu.', '👞', 1, 3, '2026-01-26 18:56:35', '2026-01-26 18:56:35');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0QxvOFmKE8JriGa3TwhMYGi36KfDhqrKdox1ijzQ', NULL, '172.71.124.232', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUWhUNGQ4TXhRWTZpbkxMSTFyYm93bE1SSVkzcHNlR25ydEwwaVVPaSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789963481),
('1H7lEMo4eXmJ0pFesSRkhFCAIbEjbJY9tx9q4fVi', NULL, '172.70.208.32', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVkFobWJVMzJwNFp4dVhmZmZTNXVEMG53QUk2UzVVWHA0akVmTDdYciI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789966064),
('1jeBOR4dJceswTMf8boMxNAgJO5nOTjgksfErFNB', NULL, '172.71.81.79', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNHJ3dEN5YjRQQ0lwZXF6YXB1alhQWXZydVFIbGdvUjJVUVV5TVFGRiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nIjtzOjU6InJvdXRlIjtzOjE0OiJ0cmFja2luZy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1789967260),
('1nCiQjc5OkhXllXmujla8t0Dsm1AdWAPZPzqqti5', NULL, '162.158.163.84', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVFZMTGRjWUZUUG92VGQzcktRdnpla2tjZ01jWHpscmRVdGxuampjMSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3JlZ2lzdGVyIjtzOjU6InJvdXRlIjtzOjg6InJlZ2lzdGVyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789971573),
('1PwTCNHj5ZYRDiowYCbOmMYz4tzlComvXM4rg5g6', NULL, '172.69.176.58', 'Mozilla/5.0 (Linux; Android 16; CPH2695 Build/BP2A.250605.015; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/152.0.7977.69 Mobile Safari/537.36 Instagram 445.0.0.45.83 Android (36/16; 320dpi; 720x1604; OPPO; CPH2695; OP5EBBL1; mt6835; id_ID; 1055488490; IABMV/1)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVU45S3JxWjNmdjgwd1ZZbjlNNzN5ZXRHcTBoZGFlbE93SWh6TDhITSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA5LTA2LTAyMDUtRlIiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789966126),
('22yGtUsycR7SqMUYcUreaPXPrx2ktyzc9LScoY5E', NULL, '172.71.141.92', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 14_6) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.0 Safari/605.1.15', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib1Y0aG01ZHI3Z0RORnk3a1VOSTBCYm1rSm5POTFQQzExWWxCbXV1NiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789954086),
('2dfTNgiTKkUQbnvUjSCjNdEyCqVQNDQFjjIEA3Iv', NULL, '104.22.104.209', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm) Chrome/116.0.1938.76 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWXhUNmtXb1hwWXBIcTN6UnRrdXNOZ1N0WVRsalhna25qbE9qaUR1UCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL2Jsb2cvaG9tZSI7czo1OiJyb3V0ZSI7czo5OiJibG9nLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789972061),
('2eJUTfajFRJ8RGLEwycBEJYcfNf8M2f7GZXZWoc7', NULL, '104.23.190.220', 'python-requests/2.27.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRHR3WDB4UmJBUGhsaFhaRXNCcjh1eDZneXBxUHFLZDlDSzlSQktvciI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL2Jsb2cvd3AtanNvbiI7czo1OiJyb3V0ZSI7czo5OiJibG9nLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789954123),
('2ip8jNElidiY2WfG82rywPGPDP3xE80b57kzlsql', NULL, '172.70.208.33', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiejBJa2NBWGVudXY5NUR0U3hublluVnhaSEprdHJXdWNYUlp6bG5rdCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA5LTE2LTA1MzktT0wiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789964972),
('2kCEOf1fh9fzYPVpvsQoqlVSmcThmm1Geq6coSOQ', NULL, '162.158.163.84', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.5 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaGNXSERHMjJ3MGI3aDFYZmpENmpDM1Fkd2JyUTQ2TEVGckFyaGRWNSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3JlZ2lzdGVyIjtzOjU6InJvdXRlIjtzOjg6InJlZ2lzdGVyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789967523),
('3lC6KUFEEdvvL310t6921RnUKxYPQ1cA8KfIzsjL', NULL, '162.158.114.223', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQm5jbVdMdWJ5YW9xc2w2cVpmc2NHRDhjcmRuWDRadDNidmFIRXpteSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789970751),
('3n1ndGByj5RQTOuncg8rxTMI7esDv7nZMTXYSQg1', NULL, '172.71.195.60', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm) Chrome/116.0.1938.76 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ0Vxdmt6V0h3U0RPejFaWW5MQkIzblpZaWVrZm4ybWRNYW0yeFJ2aCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789961144),
('42p9NNns7sBqPo5DaipBA4sRQhvjo6B3dTepklp5', NULL, '172.71.81.80', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR2FqYzdnc2Y3TjRjbXdyT0N6dlBxZ0p4YWsxS010WXBTUFdrRnN2RyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA4LTMxLTExNjYtUlEiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789964155),
('4WcOkBTCu6JC4zKM0O9zSrAkFLjLq8Q7HxN6o2LK', NULL, '172.69.89.162', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidTd5VUNTUXdNMXB3ek1CRUZDNnB5SFNoT2E5YmdpTDBNUHBvakpsQyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA5LTEwLTAzMzgtUUEiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789955140),
('5pKAR6OKD2FxxuOXzt01rLSTfbkk4G7KPbHLWPzq', NULL, '172.69.176.59', 'Mozilla/5.0 (iPhone; CPU iPhone OS 27_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/27.0 Mobile/15E148 Safari/604.1 [WAiOS/2.26.36]', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYlk5d25MZUtYSmdEclRIS0x3a3VnVlFiVlR1TllHUXhoOXlzeUI3cCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA5LTEyLTA0MTAtT0wiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789962338),
('6aYNZnwr0EjEP70IJVNRPo8D3Aw1dX8G5rT4cGW2', NULL, '162.158.107.99', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZTVDN0lrODJLdVNpQzRiU2xEZTd1ZzNvcVZ6aWVxOUNPZ2NubWNZNiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA4LTMxLTExNzUtT0wiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789963453),
('7AhT9ArKlVDFKLi5hq5lpfCwSTDk2o6xgnzqhEr5', NULL, '104.23.166.169', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZU94cllQUGd5UnNBaEo0enY0am1pSkd1VVA5SmlDMDBkWnBMak95diI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789968386),
('7lGg2UKVaKfmphZtBYQfejBZ9xrTOwxgWDyUj9Yw', NULL, '172.70.94.175', 'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiamJYT0ZkVUNydm9CQW8zNHl2Y3Q4UUg1c0tRdHJabzl0NWQ1ZHRFbiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL2tsYWltLWdhcmFuc2kiO3M6NToicm91dGUiO3M6MTQ6IndhcnJhbnR5LmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789964989),
('7qNm9ahRlVFDCzPcL51i1sCNEZkc57efjj0SXyLm', NULL, '162.158.190.74', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYXBhMVNCRlBxbmxPV0tKcVNXdkx3ZFFSV1J5eVNIUVNQUGFSQ1lhQyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789965234),
('7ZANFvBhcexIZjkjHflXsAJGyawQONLEu9lYBiQ9', NULL, '172.71.124.233', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/30.0 Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSE14bkFBWWtnYlhoSnVBeFlDbUVnSkpVQXhBWUJrUmRXUXJsN0pQOCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789958320),
('8Lt6i6NN3ia2jsQVrBhgoQUcdclNHdOJDpuU1m7W', NULL, '172.68.82.142', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidXA2Y1lIN09veVdwczBoaGY1SjNZRWFLNjRMZlA1czJYcTFoVGZsdyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA4LTA3LTAyODMtTVkiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789953966),
('8Wr0OSQqHvPpZ8dvMJMg0iIUOwQODpslyFKmCGB9', NULL, '162.158.174.166', 'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaUZ1aEFSaWdlMU5pbWU5NFRIYjNyVVRVcDUyOGJLWUJKN0U3aUphbCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nIjtzOjU6InJvdXRlIjtzOjE0OiJ0cmFja2luZy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1789966073),
('9M2l54EZUDUMiPC1i9SSYmF7ofjaoNxD3nay0EE4', NULL, '172.68.164.33', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWG9WZnJqdXk3cEhBSldzb1VYZVdyYTJoMU9UclBPV0Z3bWU5ekxaSiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789957855),
('a29eC2dth7m5kAD4OOIWUh1HR01N9KVmFW657uu5', NULL, '172.68.164.32', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.5 Mobile/15E148 Safari/604.1 [WAiOS/2.26.36]', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibmlPWElOVmVPTEhCYW5jdzU0a21kRnBhdW1DTHVjUkNKNzZyTkV5eCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA5LTAxLTAwMjItUlEiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789963262),
('ACLgjr0Jz28mrVjf5AvuAyDrt2XRJaUk7ZTGYD9L', NULL, '172.71.81.79', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaTU5OWdhSXdENjdkdDNBZkUwR2I0N2Q5MDBwQm9rWVNDTXB0UWZtWSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA5LTA1LTAxMzktUlEiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789971819),
('AsxFKcVgAHr65yauQGDScnbn0sxR3Bp9CLGlS6YL', NULL, '104.22.104.209', 'Mozilla/5.0 (compatible; proximic; +https://www.comscore.com/Web-Crawler)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQzEzb0wxOEI3dnAzUHk1OEFWSHVhdFNLOWk5dE5tQmladm9WeGllMCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789964607),
('aycIGjOC1ArRE59o6LmNNkWFkZVEMl67ZdnCEhks', NULL, '104.23.175.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNEZBVFIzb3ltM3Jsa01ZVUFFYW10Q0pBek9LSVEyekFic1RHZk9zMCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA4LTE1LTA2NjAtU0IiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789963814),
('B3xL7mWx84DDaoGYhYEW2u3nqjA4HeQRQ27020VM', NULL, '162.158.88.13', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieTdNcW1jQWpQdDRjQmRiN2FQMXpabUxqNXFOZ0Rpdkxkb1ZKd1BabCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA5LTAxLTAwMzktUUEiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789966149),
('b9pOdLi55ZniCYDrvbT6q1g9403Vj9KjfSQqI0XH', NULL, '172.69.176.58', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRGR3Uml6TWxyOTMzS0FVMk5Mcm9uQTRUbG9aQWU4RVVPUDhVZVI1SiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789954522),
('bE0NZ0kCctpQcsgRcHDJnxHERTphncoF2bji4d2v', NULL, '172.70.208.33', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQmkySm1MSHZLc3plRzFmV0FOMjZhVGVUMjU0SDRxWFBEN0RpWnRMYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA4LTMxLTExNzUtT0wiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789971101),
('BiGfMDEDVBD9Sz1FEvIBsnUxD7BdturmBKjArr5G', NULL, '104.23.190.220', 'python-requests/2.27.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNkQ0TGNubHVEWW1lYWg5SlNIVnMwV0xiWnVCSVRYbmhwTDZmUlY3RiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL2Jsb2cvd3AtanNvbiI7czo1OiJyb3V0ZSI7czo5OiJibG9nLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789954123),
('CkaSebhcUUIR2d84v6rPIxmyfWAw8oFFFiyJVAWn', NULL, '172.70.93.72', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/30.0 Chrome/143.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoickpJT0NzVE50aWxza29CUzVabkpkYXhkaUtyeTEyMU5CYmpOdlFPRCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA5LTAzLTAxMDYtUUEiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789970666),
('CPSvO2F6lwCax81eUiZNFQMxgAXcvj2Vnyj6HPZw', NULL, '162.158.193.220', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiclVYSzFPOFV6ekk5NXlmTXNvTDZ3Z0loc3dvWHN4NlRtRTNVMkVWRSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789954574),
('cwiwKC3PV3jAkDOZzj5Rm5QEIsLgXYxv8QUKDhgE', NULL, '172.70.188.57', 'Mozilla/5.0 (Linux; Android 13; CPH2235 Build/TP1A.220905.001; ) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/151.0.7922.199 Mobile Safari/537.36 WA4A/2.26.36.74', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWkNrcENseDFQOFdYNnpibWlZS253TnAwUUMzMzIwMVI3eUU0QnlhMSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA5LTE4LTA2MjItT0wiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789960156),
('cXhnL14s7xU5hBTtroANgO4uVfVxEv2qgumJJyOG', NULL, '172.71.81.80', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.6.1 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZkRndld3VWhnN0trZjl4eFVtWmpSNjRSN2RqaU1FTTJsN0xPejg5YSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nIjtzOjU6InJvdXRlIjtzOjE0OiJ0cmFja2luZy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1789971481),
('CxqgjE4R9qWMoJ7xEgkmTKzuzFuL54H9Tu4Q1veF', NULL, '162.159.98.33', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ2hZSUNCZnBRWDRKT2N4RGhHSUhkQjVhbzNsMjRVUHQwNVV3MUlVRCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789971971),
('dyFe3c88K3Lq4HCmmbXNiCpVDStFcTPxVKDR1Pak', NULL, '162.158.107.99', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWUJ4YmNMNTV3OHo3Qjd3YVFpN3M4VjdKTWkwTVNCSnJ3RUgxQms2RiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA4LTEyLTA1MjYtTVkiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789955304),
('eLpMOXObzYcodQUN1drz8ozJaGgcJVKU1lKQ8vBU', NULL, '172.68.225.4', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibUVqMkFKS0t2M2V1ZHlHdHRnbTZKaTB5YUpXeWFaa3E3UUlMU1REcSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789965247),
('ENrwDpFyvvY4POWb6dRG7qeLKqwIKqgoXzrRtAIU', NULL, '108.162.249.124', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko); compatible; ChatGPT-User/1.0; +https://openai.com/bot', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTVREc1BGWlpuYU1ZTGltRlpaVUhMczhpMlhJWlluTkJ4QWNtbEowSSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789961542),
('ESAwAbkQb5zDv1yBRBGr3AAEUzMmzkBUEBIUWPAA', NULL, '162.158.163.83', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWmRUak9GQmpoUGJsRTJNRHZQbEZpQXdLd05adXRnSHY5Rlo3dUEzaSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789967177),
('eTHDKFA8J72B7kkXYSBeXqQWXNb7KK6d6nh316xx', NULL, '172.71.152.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:156.0) Gecko/20100101 Firefox/156.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTkVkclV0QzhWNlQ5YzNoNHl2NkRlYTcxMWc1RjQzcWVQTzhwalFrSSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL2RvbmFzaS1rYXRhbG9nLzE0OCI7czo1OiJyb3V0ZSI7czoxMjoia2F0YWxvZy5zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789960344),
('EXAZGqnRxSv41pNMBAob52TBPabF42YIkO5pGa2y', NULL, '172.71.92.145', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZUFiVFFFNDNWUkVmYnZxaWRXQUplUFFRWE5JMnBBdjBQM0o1WlJ6ZiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL2RvbmFzaS1rYXRhbG9nLzE3NCI7czo1OiJyb3V0ZSI7czoxMjoia2F0YWxvZy5zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789957931),
('FcXPQKFRkVFLhTD63xY8LMaVaKjZagTNVV0Cxkkt', NULL, '104.22.100.6', 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTkpmbE5LaGdoMDhxRU9la1o1OVg5VHRzOG1xYldoVHQ2ZGd6cjFJVyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL2Jsb2ciO3M6NToicm91dGUiO3M6MTA6ImJsb2cuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789963523),
('Fiqk1OEDgFP8ODVAYIDWkNEfjfFU4tZf4NrtdxjV', 16, '172.68.82.142', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.4 Safari/605.1.15', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicWFodmFiSEtCcGdVcnVFNmlTaHN5amdNUDlIeGVkN3JGY3VCdW16TCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL2FkbWluL2xheWFuYW4tY2F0ZWdvcmllcyI7czo1OiJyb3V0ZSI7czozMDoiYWRtaW4ubGF5YW5hbi1jYXRlZ29yaWVzLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTY7fQ==', 1789971974),
('fmbvPumxcAEt4BecJB8dZKsXxDCOhsvGp2TmWqGS', NULL, '172.71.152.97', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_1) AppleWebKit/601.2.4 (KHTML, like Gecko) Version/9.0.1 Safari/601.2.4 facebookexternalhit/1.1 Facebot Twitterbot/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaFlSM2xwT0NnQ0lSaEpRaUlCRmhUR0M1TFowZnZvMVNUTFhNalcwNiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3BvcnRmb2xpbyI7czo1OiJyb3V0ZSI7czoxNToicG9ydGZvbGlvLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789968815),
('FNO2AN60YTjjSMkceRC9QjjgcLRWxxPbAiPGzqEm', NULL, '162.158.88.13', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWFNEakQ1MFdaR2FZNjFwWTZlazd3MlJOd1VCRHVZZjA3Q0JBVVRJQyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA3LTA0LTAxODUtU0IiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789954921),
('Fp3sFkHaqmOFGsTZp4AUA4XxHU3wOuHResibRpAA', NULL, '172.71.152.98', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibDFxamhjTXU0YXJPc0JjZlF5YTJ5VUczMWdYOEdyNVpxYlZJcHhmYyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA4LTAxLTAwNjAtUUEiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789956075),
('fvfMESXhURSaSmbldFFsbmlY5kauIsg8nrkxUs7x', NULL, '104.23.211.214', 'Mozilla/5.0 (compatible; proximic; +https://www.comscore.com/Web-Crawler)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS0hYT0F5OFI5RzdneWtGcDAxM29WNEFBU2c4aDVzZDJBdmp3MDJ1NCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL2RvbmFzaS1rYXRhbG9nIjtzOjU6InJvdXRlIjtzOjEzOiJrYXRhbG9nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789964526),
('gGwptczmG9unrIh0TRVzAtKvpuMsydPM3hcCEZlT', NULL, '162.158.163.83', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieUtpTXpGZlVQakpKYlFEU3NnNGdHaHZUNWZpZGtjZFppdVBLdHlaRyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA3LTA0LTAxODUtU0IiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789967282),
('gqeAVwnIo4A0LAGX5fjwww7B6g6OcCl2ABAL456k', NULL, '172.70.93.72', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/153.0.8010.24 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRFNGblVsR01PY2JaTWlsUHdOUGViZUlQSkdidEZhNWdvYjlWWHdlQyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789959424),
('gSe5NEP7CO205dDwgkiugkr3Sj9673PjbaNzM8lk', NULL, '172.68.164.33', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRHRhUVFSQnVreHI5ekF0bDJyRVJKQlAyM2JSSVhXeFRVRmJYamZVMSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9TC0yNjA5LTAyLTAwMTEtVk4iO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789958912),
('GVs8kMTW25eKkNftCTiQMkfa4i6KT5QOUzDZjbJh', NULL, '104.22.56.231', 'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQTh5NklBUks3WklXR05WVEx3blZIRDBXUks5aVVqeG5ZSDNVNkNyZCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789954109),
('GZdETlJcpjGk9eW9uKN6m9ZC436s8jB9Z30YAh02', NULL, '172.70.188.57', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQnlDWWRqSThvNlYxUEw2a0FQOHVxemZmcGJKZ1RQRzFCRXhuZkRNQyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA4LTI1LTEwMTYtVk4iO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789960921),
('GZz472NSUxBx0UpU16NU08DsGaPhkYsI8rcgVlvY', NULL, '162.158.170.122', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/30.0 Chrome/143.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYXVPWFRQMURRS1hiOTdUSUE5bGNQeDV1QXBKYlhSaUtpWmRrQlc2SCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA5LTA4LTAyODQtUlEiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789969136),
('h7gtkYWRvk26ghiuqdGmuEKsEBlxoYI1owNNXD2O', NULL, '162.158.107.100', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_6_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.6.1 Mobile/15E148 Safari/604.1 [WAiOS/2.26.35]', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYUtYTmVIMEZXQ3FjM2VscG9YMWQ0a014Y015aklYaUZidmZmQ0h5OCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA5LTE2LTA1NjQtVk4iO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789966653),
('hGNQijMHUPxJgGJnVuAoOBMSG8q6F1Z8ZGbmj4sY', NULL, '104.22.104.209', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm) Chrome/116.0.1938.76 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVVJqRHZ6ZXRvcjFqa1lPZDJuaVBubk1iVHA0ZjNYWnZJRGp2WTQwMyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL2Jsb2cvaG9tZSI7czo1OiJyb3V0ZSI7czo5OiJibG9nLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789972061),
('hqBF9RPiE9Yl9toPj5pOYGd1AwYjFReMhdO4YIK8', NULL, '104.22.118.97', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.8010.47 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUTlRUGNyWGdBaU9Nc0ZNTWkwYzRPV0JMUmlWNEoxY2lBd0JlU1gzaiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789968189),
('HtSvHUHR9L64rgtulUtcafwq1IzjFSt9iIzpn2lD', NULL, '172.70.208.33', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko); compatible; ChatGPT-User/1.0; +https://openai.com/bot', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN0pnVXZxeG1DTDlLSjlId2Z1Zm41aDdQcWdXRFh6alVDY2liY3haYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789958058),
('huTkhwXHfqRcphTySGxIZysDUhrzvvLkRK8dKOBf', NULL, '104.23.170.33', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWlV4SWtmUTBTYnlnTzUzNVJPd2ZTeUpPdkFyOWVnazRqU0p0TW5wMSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Nzc6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL2Jsb2cvY2FyYS1tZXJhd2F0LXNlcGF0dS1sZWF0aGVyLWFnYXItdGV0YXAtbWVuZ2tpbGFwIjtzOjU6InJvdXRlIjtzOjk6ImJsb2cuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1789958807),
('ia980LgSiWIfGtn7IOmIlD67UNd2s9HlMuKaRleZ', NULL, '172.69.70.160', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; Perplexity-User/1.0; +https://perplexity.ai/perplexitybot)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieDNZMmtKd29zSnhoOUhEdzRkRHlvNmFLajd3ZWpiM2h2WkVSc25xSSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTc5OiJodHRwczovL3Nob2V3b3Jrc2hvcC5pZC9pbmRleC5waHA/ZnVuY3Rpb249Y2FsbF91c2VyX2Z1bmNfYXJyYXkmcz1pbmRleCUyRiU1Q3RoaW5rJTVDYXBwJTJGaW52b2tlZnVuY3Rpb24mdmFycyU1QjAlNUQ9ZmlsZV9nZXRfY29udGVudHMmdmFycyU1QjElNUQlNUIwJTVEPSUyRnByb2MlMkZzZWxmJTJGZW52aXJvbiI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMzoiaHR0cHM6Ly9zaG9ld29ya3Nob3AuaWQvZGFzaGJvYXJkIjt9fQ==', 1789958624),
('IcMzkO33Bv6NKWXHgIWFcRERfEK0cs0N3aHznzBl', NULL, '172.69.176.58', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.6.2 Mobile/15E148 Safari/604.1 [WAiOS/2.26.36]', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieFRidDR4TnRDVTJYT0NhWkRxN0NicEx1YmFmRkYwN25TQ1VGWmJ5ZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA3LTI4LTExNjAtTVkiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789964590),
('IETcwTbnitfLn30MOXtxOxtKoEW1GDfts7pjMccf', NULL, '162.158.170.122', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRUFYN2QwTkZvQ2twNHo3Wmo0MWZIaDNMZE9CZmw0UzJ6bjJCazRkbCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA4LTAzLTAwOTUtUUEiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789971612),
('IHC0dQle4tnIGM91vb6VSosHo4YL1p5t4kyBXR9x', NULL, '162.158.163.84', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_6_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.6.1 Mobile/15E148 Safari/604.1 [WAiOS/2.26.36]', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibUVIUm9EOFZvdFMwYlNuYTE2NWcyNGtWMWVMS2tqMElwaHRwRU5FMyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9TC0yNjA3LTE5LTAwMzMtTVkiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789967902),
('im8pUg2WYj2q6ABvpGGbFZeFgiaff23olR0osU0Y', NULL, '162.158.88.13', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNzAzVVFEMWpkM0NHeDQ5ZE9tdGtUQ3VHUTEyQWpVekJndzZubE5FOSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789960370),
('Isg2aoDsXvvReTK6z60BdDCq1JkgzZ9Qtk0xKl8G', NULL, '162.158.149.152', 'Mozilla/5.0 (compatible; DomainCheck/1.0)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN1BNMEp0WHp3akx4Y2FvdWZQWU9VT1ZqZkNaRlpQTDF0NGlxcHZXbyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789953930),
('j6DsJCvMxlpD5uQ3q9vNY9bEjEAIkELTSjBBFEpl', NULL, '172.70.188.56', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiandBUjRHZW1mcDhkR3I1RmVtNzZDb0VaUVo5NTFJdjRjMVJ0RGMyciI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA5LTA5LTAyODctUlEiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789966946),
('K4Zsw3rfA40vpWk73AHbYLQSK1mI0DGgIih8PfTI', NULL, '104.22.20.155', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNkF3Vnk5akhReEZNWWozSGdRZHVrb3VkU1YyWFZTQk5tZFh6emJLTiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789961855),
('kNOQTDUcavkLS9Oi8LeGqElmu5GhAfhkwavcFEHA', NULL, '172.70.208.33', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid1JUWXhnbFI1U0lRTkd3UDg1NU9CSHVwUjNXbFJ1OUFIYTFMRWpnUiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTU6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9JTIwUy0yNjA5LTExLTAzNjktUlEiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789960486),
('KqiAIucUGFy5gfDNAjNlBTsKNSDGVQApGk2DJBD8', NULL, '172.71.152.97', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/30.0 Chrome/143.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoickt1VGlFTk5XeXJLUlE0WUt4MllJUVAzaXZCbmFoQVpFNnBidno4dCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA5LTA4LTAyNjEtT0wiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789962806),
('KZiNbjpHlqe1mzaFD133IVf5ebR2LUEKru2ynfoZ', NULL, '172.69.109.48', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36 Edg/91.0.864.54', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicGE2Q3RYT3VQNlFTQnRwWGNqTG9zdjlxQ1hqOUxOTzVrdElmS1ZINCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789963311),
('l4fVKhJIVfLLo7E5DhYCQcSaU3SzdTaeYu3Eph6x', NULL, '172.70.94.175', 'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUExpaTVhMkJCOUtIeVlQQ2QzQ3E0R0dHbjN4RUpOY3piMVhVbDVCYyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL2tsYWltLWdhcmFuc2kiO3M6NToicm91dGUiO3M6MTQ6IndhcnJhbnR5LmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789964955),
('LgFspTQzJdIQZtmGSuwvPOvnw5tfSwhoEDM4fZOH', NULL, '172.71.167.193', 'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaUpjeVNMN1M2MVJPSTZlY09wUklSV3ZyNDNHcFdVMWl4RGJ2ZlNqcCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL2tsYWltLWdhcmFuc2kiO3M6NToicm91dGUiO3M6MTQ6IndhcnJhbnR5LmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789970659),
('LOSPBF9Yj5LYh72BtII6laqxh1pfkvdut0M9IETs', NULL, '104.22.148.53', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUmJVM29HemllRHFONzVVa1h3UG5BVklKcmZsa1JYWXBvUHlZS3NOQSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Nzc6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL2Jsb2cvY2FyYS1tZXJhd2F0LXNlcGF0dS1sZWF0aGVyLWFnYXItdGV0YXAtbWVuZ2tpbGFwIjtzOjU6InJvdXRlIjtzOjk6ImJsb2cuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1789958066),
('lT2Bp9XJ9aMUE8jZGvnVCWY2hYXyoJQd8ObiKeQP', NULL, '172.70.188.57', 'Mozilla/5.0 (Linux; Android 13; 2201116SG Build/TKQ1.221114.001; ) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/153.0.8010.36 Mobile Safari/537.36 WA4A/2.26.36.74', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZlN3QVRUa2J3MDV3RVg2R2JaVXhzd0F0Wlk1U3hoTkI5QWFqWDFCUCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA4LTA3LTAyNjctT0wiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789962566),
('MXTy9vdFqFQTiwrA8FRiQT98qXId2EYEwJAsycFe', NULL, '162.158.108.62', 'Mozilla/5.0 (Linux; U; Android 11; in-id; RMX1921 Build/RKQ1.201217.002) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.5970.168 Mobile Safari/537.36 HeyTapBrowser/45.14.7.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic2JydWlDd2hjNmk0c1hSUTY3U1VLOWNPTEJDNEdKQlRJSzhXdDlnRiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9cy0yNjA4LTAzLTAwOTUtcWEiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789969935),
('my2o2ELvUD4fIpqEzTOlIcz9EAEwJuvglzQpjUvD', NULL, '162.158.114.223', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSEFOamhONDBUSHpoTGZvWURuS3QwT1ZMSURwMzJka2xiT3F3ZXJtRiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA5LTAyLTAwNjEtT0wiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789970670),
('mykUkOaCGyLHmocltnuuxQlnjPX0P9qWeUrrFQWr', NULL, '172.71.124.232', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ05ublhkUTBzUng0d0FNQlh2aTBiZ0ptT1FZUG9KYXBHNU90SjBCVCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA5LTA1LTAxNjYtVk4iO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789961307),
('NcIY6sGtcxnonfHP2gVW8LdGgg2o8s2jx1zFibRT', NULL, '172.71.81.80', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVWFDdXgxUnl2Z3dVRGJZNE9obmZ4VEt5OGg3TkR4cnFmUTNDMElZZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA5LTE3LTA1NzMtUlEiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789967573),
('NePHrBoPCxWDC1IimHORPCNDPTAUu4EXEcdWhrL6', NULL, '172.68.23.25', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.4 Safari/605.1.15 (Applebot/0.1; +http://www.apple.com/go/applebot)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVXRIbXZ4NnFTM3VKdHRSSHpvcU0xanB5UWtPZHExSWwzakltMjFyeCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789954050),
('nwJmyuzjsPC35oxuL5lONgRmlEX2jYQh3xFf2332', NULL, '172.71.124.232', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Mobile Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiSWlqY2tEd3ZuZEhTSDh3SDF0Vm94dnFBRGF5eUhBeVo5Y1I1c3FtSCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789958944),
('O0rBXYahgqKlDc3BOHoMek5Wm8aFdnOlW4Uc0CHo', NULL, '172.68.82.142', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOE9YNjJZbE1KbkVRTHVnMVNPaVhzUGxwU2o4ZHZMSjZPU3drdDBzWCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL2RvbmFzaS1rYXRhbG9nIjtzOjU6InJvdXRlIjtzOjEzOiJrYXRhbG9nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789964261),
('o2ALDgS1h92Mf0EOk6Xjh8VExojEWlIKmxLxKIFJ', NULL, '172.70.175.164', 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWlExbm1UU1BobkhjTnFjYTB5MVBRU05ralNTa3lERk1lN0l3VFpqYSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789971726),
('oCtsp6uEeAKE9MRVyPxHMdceLP4QCJf8zlY4K07O', NULL, '162.158.163.83', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.6.2 Mobile/15E148 Safari/604.1 [WAiOS/2.26.35]', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZDA5Y29na2NPcTBvVUZkWUFaYXp2WlZ6NXRwM2pUdElNNVJidFo1MSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nIjtzOjU6InJvdXRlIjtzOjE0OiJ0cmFja2luZy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1789962231),
('Ot5QeFVkmrrA5jipEPP1ygFACQwGyavTM1WLEYyW', NULL, '172.71.152.97', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU2FxMWpyT09oYmR6SDNrNjRoNGNPcVhvQkZoRFhHSGpuZW1Gb251cSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL2tsYWltLWdhcmFuc2kiO3M6NToicm91dGUiO3M6MTQ6IndhcnJhbnR5LmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789962696),
('oycdIeHNkBAIfG48JIuia2UpGsw14YZg5rfRXaC5', NULL, '104.23.175.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQTE5cTJLUmp2bllMWkx4ek9LMkZXM0tSNjNJdzVNTXdTYm9SQzdPdSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA4LTE0LTA1ODUtRlIiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789966862),
('PPtcutF4eD56ACcCMfVmXwrjThkxVUrCmeR9BlMT', NULL, '162.158.163.83', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibzZIa1hYcnZnQlN6Qzh6U3kwS3dCQlRVVnpaa1FQNUVNZldMWWttRSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL2tsYWltLWdhcmFuc2kiO3M6NToicm91dGUiO3M6MTQ6IndhcnJhbnR5LmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789964978),
('pTnshFXYK15tEG9RpWslJ5UkfavqD71iwWIXH14r', NULL, '162.158.88.13', 'Mozilla/5.0 (Linux; Android 13; V2131) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/123.0.6312.118 Mobile Safari/537.36 VivoBrowser/15.0.2.5', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYkR6alpUc1lQcTB0ajM0NDY3UE9pdUM0QkhYdGVTWnNSM1N1UkQxZCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA5LTE1LTA1MzEtT0wiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789966618),
('q1UchrgspjA4DrtRVsPxHVQWqTvlOYbKHtL5yOj9', NULL, '162.158.108.63', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWkxiazU1R2IyUzBWd1puZEQzdXhNSzRYSHYyVVg1WlhLUnJqeWVMdiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Nzc6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL2Jsb2cvY2FyYS1tZXJhd2F0LXNlcGF0dS1sZWF0aGVyLWFnYXItdGV0YXAtbWVuZ2tpbGFwIjtzOjU6InJvdXRlIjtzOjk6ImJsb2cuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1789962233),
('q5KcGiSy9I6s11nsGtgRj8JHAAmi0UTmvUL3QMT6', NULL, '162.158.163.83', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQkdvR1hvSENlMlhpR2FjTGZkRFpZdDQ5VDAzWjUwbGc0NUkzUllmciI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA5LTA1LTAxMzktUlEiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789962204),
('QhRs9ar9zSRRgEfX6ce2Irf9rMWmpMrChcBotj8x', NULL, '172.70.188.57', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTktYU2xvYmpzNkRoSXN2WTFncUFSV0FocmZaNzR6TUlnRFB6MERzOCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA4LTEyLTA1MDctVk4iO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789957499),
('QQvVJCGWxPgNJeYkGt5phvSm2mH454Lvfd8F3c4k', NULL, '162.158.158.85', 'python-requests/2.27.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid1oyYTZCY2ZObDFPeEhiTGdNa0dqU1ZQZlRselRuakVLWDVRMklNcyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL2Jsb2cvZmVlZCI7czo1OiJyb3V0ZSI7czo5OiJibG9nLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789953696),
('QsAtFECf9uUlDTyp7iIVL9Gavg7ydVgtZFVGFFzb', NULL, '104.23.175.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY0NIdnhZMmZjWURvQkE3R1o3YnkwWVk5TEtJQlZEbWR3MUNVdE1kZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3BvcnRmb2xpbyI7czo1OiJyb3V0ZSI7czoxNToicG9ydGZvbGlvLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789960157),
('r9iQlLovBgaUPttCKh6QPQ6jBc1pBO32tc6UJOTL', NULL, '172.71.152.98', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_6_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.6.1 Mobile/15E148 Safari/604.1 [WAiOS/2.26.36]', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTTJhSXV3TjZjUDhvNG16Q0dVWURtUDJROHdVNzRVOXRTd0NCZlBHViI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA5LTE3LTA1ODEtUUEiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789960600),
('RgXLLKiAxiFrCqgX28lNRC2j4Q29TLoZmr9MdHE4', NULL, '172.68.82.142', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicEx4SnhPVmphTE1XQzJ1b2dqdU9UTTdFVW5KMFdkek5mblplOENyViI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA4LTIzLTA5NDItVk4iO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789972050),
('ri8XSunbMFral5MNsdUxAJqEEOCqgCnkJ76YCvt7', NULL, '104.23.175.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibFdYZ3d3akRWVUFEV2d1WFppekhQRXA1c2lQY01RN0UzaHRXdzl3SyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789958557),
('rXvn9o2UQ2dv7dbmQQ3flUiAh9Z18835lgBEUFlQ', NULL, '162.158.158.85', 'python-requests/2.27.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ0p2ZVlYek5GMTY0TVlRYTNQNDR5anBVV3VHZHhIMU9PNWpXSGJudyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL2Jsb2cvZmVlZCI7czo1OiJyb3V0ZSI7czo5OiJibG9nLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789953696),
('sbKxTJIF7sDeOAyaqel3s3IvkjTxhce5J9mk5QyN', NULL, '104.23.170.32', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidGNvNGdTYlpoeDk3UTlnOURVRE91dmRDMTk2NXpZQzZtQzV0eG5NYyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789969115);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('SuZ7PShzTeGJD8kUsQebFyotDRK98afvlWz8DifN', NULL, '172.68.164.33', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSGRXODd4MTVUTlBRazVxVnlteXd3ZjRQb3Nuc3lzMmxRMXFaRXZYUSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA3LTI4LTExNDQtRlIiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789961034),
('T4mXWnyxXnjHaRZKWrSRiBNgfBvARaIKT6j410Rk', NULL, '162.158.163.84', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.6.2 Mobile/15E148 Safari/604.1 [WAiOS/2.26.36]', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSlhQR3dtM1VrWmtweFFjMkNiRDRNQVNTaFdsWEFyVjhQSk1iWHdUVSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA4LTEzLTA1NDItUUEiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789967935),
('tlvd2HBYd9hOHREjLlrMLMithjgK2G9uQ8nHu9vr', NULL, '104.22.24.53', 'ZoominfoBot (zoominfobot at zoominfo dot com)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicVBVTXdiUGJ1M1lMMDNueG9aNnF2Y2tETDBSZkZWMGkwZHhUNnRFZyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789970050),
('TNf0OdYNWl2zty7jJlLp7mxGrIF8Z2ExHXyIt9za', NULL, '172.71.152.97', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.7 Mobile/15E148 Safari/604.1 [WAiOS/2.26.36]', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNGZuUzhYajZMekFHRjlldThBbU5lcDdLMlBXYnViV0dFeVh3RGl2TSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA5LTAzLTAwOTMtRkEiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789967814),
('tPODBwIHWgWfSvyVrAFUOtGH5ZxopGACkSI7rrkI', NULL, '104.22.80.137', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Safari/605.1.15', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicTBkeDJLQmFlRHlTczBMdUJCNm5kbkhEUkxNNDhBR3pFRWpDcTZSeSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nIjtzOjU6InJvdXRlIjtzOjE0OiJ0cmFja2luZy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1789953108),
('tpZON5BpGzYlojmbghgdU5mRHjuIJAnTy4FcehGy', NULL, '104.23.175.226', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ2V5VWVtYmhBODlMQ2F0TVNCV01SNUJ0Mkw2TzhFNFpuRzIyTDZYTiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA4LTMwLTExNDMtUlEiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789970018),
('tTXTNHr4WtsaQN8yfAgU4oKqaAOZm8uJQXZgszkC', NULL, '172.68.164.33', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ0ppRDJPMVBxanlRZGd0MjVBaWVLdEtyZ3dLSktyNUhDTzF2R3Z0bCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA4LTA4LTAzMDAtUlEiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789967374),
('U15eULm71xbhUNCiRwvJNBd1be2afKu1vN8fpfMQ', NULL, '172.68.164.33', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.5 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieTVYUFl1b2Ziem1KTUpEaEZiMUs5aUFyaTVrZFd2TFBxRmpJSVlZcyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA3LTI4LTExNDQtRlIiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789956319),
('vo3FDv5214d9VhK23qasTPCBnsyNy73XN2yjgyzM', NULL, '162.158.170.123', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNm5USHhLZkxoaFhqcEVDNHdIQmVwNWU2R2dHUXNramtPdzd6Z3V0QSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA4LTAyLTAwNzctbXkiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789963825),
('vVfAfqPcVmIE3vjanJE28ZBuhY9TyCfqYuLlnMyc', NULL, '104.22.80.137', 'Mozilla/5.0 (Linux; Android 16; SM-A266B Build/BP4A.251205.006; ) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/151.0.7922.200 Mobile Safari/537.36 WA4A/2.26.36.74', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU09tN0xnU2FmeUFJTVFpRHlxMlNnSHF1b3J6elpWOXB4WnFOQmJrbyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA2LTI0LTEwOTAtQVciO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789956288),
('wGPuKd1NQW8OmSpYwCXiWrQKk4vYBnY33wj1mJbR', NULL, '172.70.208.32', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/30.0 Chrome/143.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ3B6YTBOUFpiaHJBNjlHVm1BUW10bDRYeGhjSU83dkFCalE4MzBYYyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA5LTA4LTAyNjEtT0wiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789971571),
('WrvBaHmbdX1mGkMe9tY6G94egCznEktWkOzofrxY', NULL, '172.69.70.160', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYjNNSEt1ZnluM0NRRWJla3hDNEVIeHZOeXRucTR5U05GR3lkeUZDUCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789958616),
('WUiPSbGqO5Gf85gBZHUL4iot5eL3pIETildNr1hf', NULL, '172.71.124.232', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVDY3c1hucW1BTzFib2owVjJBcmxnM2czV2R1WGtqZE8xTFR4cmU2YiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789966385),
('ykWyljYpMSGAnb4pOG1TyMeFHH8h3bPwOWdH5MzV', NULL, '172.68.234.33', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia0xyclFjcERUenpMREtWUVV0aERFeE1jUFlQZkg1czU0Yk1VYk1rYSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3Rlcm1zLW9mLXNlcnZpY2UiO3M6NToicm91dGUiO3M6MTY6InRlcm1zLW9mLXNlcnZpY2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789969109),
('YOpVmlKlm0o6jHFU7y62EUNAKDAkpHEE1S0Ag2dG', NULL, '162.158.230.31', 'DuckDuckBot/1.1; (+http://duckduckgo.com/duckduckbot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTmdzb0ZoQk5hQWFld3U2RUpLMFhvdnR2YVlPZEVkVmJMRmpwRjh6RSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789966815),
('yu9h7yiJHzeIUj2qdyRoPDwvxTpdxDs7QT2lYums', NULL, '172.70.208.33', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV2VMWk5IMm9pbjlsYlgxVTFHRUtweEdGNU5TUHdhSjU1TUVLeEZ0NCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA4LTMxLTExNzQtT0wiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789960419),
('ZUyFfT8DP225mST0PriQeXaoOMk64rGWrTNJTQLY', NULL, '162.158.190.74', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.0 Mobile/15E148 Safari/604.1 [WAiOS/2.26.24]', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY2s3MG9MVXVjYU1VbmVCMlZDbnNwVllUUlh2Y0JXSmVNY0VlcFFRSSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2hvZXdvcmtzaG9wLmlkL3RyYWNraW5nP3E9Uy0yNjA5LTE1LTA0OTgtT0wiO3M6NToicm91dGUiO3M6MTQ6InRyYWNraW5nLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1789960917);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'site_title', 'Shoe Workshop - Profesional Shoe Care', '2026-01-26 18:56:35', '2026-01-26 18:56:35'),
(2, 'site_description', 'Jasa reparasi dan perawatan sepatu profesional. \r\nGive Your Shoes Second Chance.', '2026-01-26 18:56:35', '2026-01-26 19:41:37'),
(3, 'whatsapp_number', '62895339939800', '2026-01-26 18:56:35', '2026-01-26 19:41:37'),
(4, 'address', 'Jalan Kembar 1 No 41 Cigereleng Regol Kota Bandung Jawa Barat 40253', '2026-01-26 18:56:35', '2026-01-26 19:41:37'),
(5, 'email', 'info.shoeworkshop@gmail.com', '2026-01-26 18:56:35', '2026-01-26 19:41:37'),
(6, 'instagram_link', 'https://instagram.com/shoe_workshop', '2026-01-26 18:56:35', '2026-01-26 19:41:37'),
(7, 'tiktok_link', 'https://tiktok.com/@shoe.workshop', '2026-01-26 18:56:35', '2026-01-26 19:41:37'),
(8, 'facebook_link', 'https://facebook.com/shoeworkshop', '2026-01-26 18:56:35', '2026-01-26 18:56:35'),
(9, 'tracking_base_url', 'https://info.shoeworkshop.id', '2026-05-19 23:53:24', '2026-07-04 03:56:38'),
(10, 'workshop_api_base_url', 'https://info.shoeworkshop.id/api/v1', '2026-06-11 01:48:29', '2026-06-11 01:48:29'),
(11, 'workshop_api_key', 'sws_live_6f8g9h0j1k2l3m4n5o6p7q8r9s0', '2026-06-11 01:48:29', '2026-06-11 01:51:47'),
(12, 'looker_studio_url', 'https://datastudio.google.com/embed/reporting/7d391dc4-03ca-47fd-be7a-1de272c5d734/page/P4E3F', '2026-07-07 08:54:10', '2026-07-07 08:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `trust_items`
--

CREATE TABLE `trust_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `order` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trust_items`
--

INSERT INTO `trust_items` (`id`, `icon`, `label`, `is_active`, `order`, `created_at`, `updated_at`) VALUES
(1, '🛡️', 'Garansi Hasil', 1, 0, '2026-01-26 18:56:35', '2026-01-26 18:56:35'),
(2, '⚡', 'Proses Cepat', 1, 1, '2026-01-26 18:56:35', '2026-01-26 18:56:35'),
(3, '💎', 'Bahan Premium', 1, 2, '2026-01-26 18:56:35', '2026-01-26 18:56:35'),
(4, '🤝', 'Terpercaya', 1, 3, '2026-01-26 18:56:35', '2026-01-26 18:56:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('super_admin','admin','user','member','donatur') COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `avatar_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `role`, `avatar_path`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Shoe Workshop', 'admin@shoeworkshop.com', NULL, NULL, '$2y$12$dyUpatglfn7uoaN9t/nCz.2gxT7eNnrSziCVPfzDl1VcriUdkNH5m', 'admin', NULL, 1, 'y7k125LYhN8MLXCHTydKJtqiJlrGqxYtNTuZd7zhycm2Npp57Yq340J7VQ8S', '2026-01-26 18:56:35', '2026-01-26 18:56:35'),
(2, 'adminxps', 'budaklzcrew@gmail.com', NULL, NULL, '$2y$12$xfliE16Qi7VB6MujkWpsMeLWpQEmVhz./4txIWwUezJdJGq39W31S', 'user', NULL, 1, NULL, '2026-02-09 05:29:29', '2026-02-09 05:29:29'),
(3, 'asdasd', 'escanadem@gmail.com', NULL, NULL, '$2y$12$mKKp2PPeF/8.rytZu32fveYQ3MrXmeBVhGZTCsxTahu6y5YZJCG3K', 'user', NULL, 1, NULL, '2026-06-06 02:26:13', '2026-06-06 02:26:13'),
(4, 'Sidik', 'waluyasidik11@gmail.com', '628112267007', '2026-07-17 07:43:16', '$2y$12$e5P4J4qDXaYaYeNhkQA4eeQXJBZakCa/z9q0GXhn6D7ZrRb.VrdBa', 'user', NULL, 1, 'igmvu9GytNCfugJibsKIHL3deFcy2lRodbUprbUEx6PSFtHF4pDkZDjDdjBL', '2026-06-11 01:44:20', '2026-07-17 07:43:16'),
(5, 'Denata Arif Nur Muhamad', 'denataarif@shoeworkshop.com', '6281717469499', NULL, '$2y$12$GF9gnJtO6UBAfGUKN2Nf6e6joYHqDvPUM3eE6vuGoJkdUBYorrkwu', 'user', NULL, 1, 'ls5byvkk9uL8vaKhwLoHDluhBtK0guTKFjRD7OPo8nFAcUg4DT5xFAijw58k', '2026-06-11 02:28:34', '2026-06-11 02:28:34'),
(6, 'Denata Arif Nur Muhamad', 'denataarif@gmailcom', '62183754018888', NULL, '$2y$12$sv8i8nZPLYX3wE5qDvgrnevuDJ0I1bxo.Z0NABGx6da3SzN.tTSv6', 'user', NULL, 1, NULL, '2026-06-11 02:50:29', '2026-06-11 02:50:29'),
(7, 'Denata Arif Nur Muhamad', 'denataarif@gmail.com', '6281717469499', NULL, '$2y$12$9tFrbN9OKyQuh10t.YBrUuPIcuQmEi6iQjjQo/yQ1GHw4yhi4EjJi', 'user', NULL, 1, NULL, '2026-06-11 02:52:34', '2026-06-11 02:52:34'),
(8, 'IsaiasTwess', 'tvollet@gmail.com', '6282461759997', NULL, '$2y$12$4uj6W7FAogHjOwZR5BSFJ.nS6.nTGNpae3.pjcNLux8PChyMn8kea', 'user', NULL, 1, NULL, '2026-06-14 18:54:51', '2026-06-14 18:54:51'),
(9, 'Davidduh', 'seomasters9ampro@gsa-online.de', '6283951157298', NULL, '$2y$12$qCGRs7fiMnNAK1oGQYNWc.I/9dyYeMne.eUhrXphdY30dTt2Anxq6', 'user', NULL, 1, NULL, '2026-06-16 23:09:58', '2026-06-16 23:09:58'),
(10, 'Riri', 'riasukaseblak@gmail.com', '6285738335011', NULL, '$2y$12$t8lAAQTNk4/RKefLG6U2heVaSU7/iL2Wp1CL3loyLIZZm.vm1el7m', 'user', NULL, 1, NULL, '2026-06-19 17:24:38', '2026-06-19 17:24:38'),
(11, 'Meindy Ashari', 'meindy.as@gmail.com', '6281283983964', NULL, '$2y$12$PKCkGDh89YQZpiyfJ6dae.2LX2mUiCm4FLQ1TeuCSWVhVl7C14PJy', 'user', NULL, 1, NULL, '2026-06-22 12:04:44', '2026-06-22 12:04:44'),
(12, 'Radit Pratama', 'radit@gmail.com', '6285794946921', NULL, '$2y$12$RggrSqMB0ldma7GgaYfXs.ly/Cb35EKRuaunFaBE9wJqn4Yd7Bauy', 'user', NULL, 1, NULL, '2026-07-04 03:15:28', '2026-07-04 03:15:28'),
(13, 'Irwan Krisnawan', 'krisn481@yahoo.co.id', '6282218043011', NULL, '$2y$12$KJoRlHMeewMmxal.LFi02.69C4tLlpJkYCtCQfjdOdu73ILN0w8mC', 'user', NULL, 1, NULL, '2026-07-05 04:21:44', '2026-07-05 04:21:44'),
(14, 'Siti Suci Printiasti', 'printiasti@gmail.com', '6281310543126', NULL, '$2y$12$Sm9vIy6UNdF/N/SPp/sB..hfLacMEyHoevIa.fb3iBN9hUTSwmv02', 'user', NULL, 1, NULL, '2026-07-06 04:35:07', '2026-07-06 04:35:07'),
(15, 'Carloswon', 'mbpascar@aol.com', '6289699283991', NULL, '$2y$12$nEjLPJe/hsU1zyqEhawX..6bU9Yf/M7JdQ3JKqFsStJZz6Zt9BjlS', 'user', NULL, 1, NULL, '2026-07-07 04:01:33', '2026-07-07 04:01:33'),
(16, 'Admin Analist 4', 'shoe.analist4@gmail.com', NULL, '2026-07-11 06:32:01', '$2y$12$aj7gVXiNFxdZAVqHiIakB.TeCqba4PaZW7LAvzURUDqCjiAX2XQHm', 'super_admin', 'avatars/8ebfad39-a1b9-4b69-8de7-a6bf0e7d9d27.jpg', 1, 'k0pamQSXpevMuF6JkZ1H67Oh9uxTSSWAP2tnH8qULDG6YyaCX0kNpKY3ovDL', '2026-07-11 06:32:01', '2026-07-16 08:59:50'),
(17, 'Rivael Saputra', 'riva.elsaputra2020@gmail.com', '6285794946920', NULL, '$2y$12$Xql6SgH4QR0QJ6NrsrBPxOZbmtH.9bVo3vZieXguhmCXf6bnhdxQK', 'user', NULL, 1, 'kXZ1eQwR3tmnafCTCb0UPrfAz1KLI3J4Z0pelMRRd3Pyic3LO0Q4E2zGbTHB', '2026-07-11 08:08:47', '2026-07-11 08:56:19'),
(18, 'Rivael Saputra', 'riva.elsaputra2023@gmail.com', '6281214790513', '2026-07-11 08:48:12', '$2y$12$G9prZKH./TwQW9da5EuhCerxOuJU86f0fbcdFxd9SVgEy8/17JA7m', 'user', 'avatars/e72f40c8-fd73-4cd5-8ed9-48b8153a8362.jpg', 1, 'C1gAGO7Dyc3beiaLu50jCYzwyCrSXpvFq4A9CWXh0STsEoVVoQvKJqIlfFWm', '2026-07-11 08:11:03', '2026-07-31 07:00:57'),
(19, 'Denata Arif Nur Muhamad', 'denataarif0@gmail.com', '6281717469499', '2026-07-11 09:21:56', '$2y$12$ggbpChDBtG8yWjFtNmOoDurmye1DScBboWswYVubWO39oyYWkB5X6', 'user', NULL, 1, 'gtrG60uJe21sfLgR12GMiJInNrd5AmjNkdWr8kdDl0dWaKGIqbaTVPtRu1r2', '2026-07-11 08:58:30', '2026-08-03 07:40:51'),
(20, 'Syahrozi', 'shoe.analyst3@gmail.com', '6281717469499', NULL, '$2y$12$mR2iRiSmllhsFqiXLmgThuWcOWmCVIhu1cy5SZlr4FJurGpOVIlvS', 'member', NULL, 1, NULL, '2026-07-11 09:50:39', '2026-07-11 09:50:39'),
(21, 'FFscamtoX', 'affiliate@fixedfloat.com', '6289912149129', NULL, '$2y$12$FsMUh5EQgvm.Djdo.a.5d.woZu5MlXG0IBMtldA2lO.YOqxYC/vvi', 'member', NULL, 1, NULL, '2026-07-12 05:35:11', '2026-07-12 05:35:11'),
(22, 'Muhammad fatihatul Rijal Munawwar', 'fatihtul25@gmail.com', '6285793306201', '2026-07-13 08:53:27', '$2y$12$25yfdOulxYp/iWxiEOT.HuJSxx696g42D.As.65LGK0ko72guYaFG', 'member', NULL, 1, NULL, '2026-07-13 08:52:35', '2026-07-13 08:53:27'),
(23, 'Feby Regina Putri', 'feby.regina23@gmail.com', '62895384172835', NULL, '$2y$12$klpl3XA19z/ASKQ0QcN3heAN/bjFhzf1i8y5oum1hkoxUCaNgL5Wy', 'member', NULL, 1, NULL, '2026-07-13 08:53:24', '2026-07-13 08:53:24'),
(24, 'Rosserial_Row', 'pa.wubale8.9.2@gmail.com', '6284385515134', NULL, '$2y$12$IqYNdEAO9EWHdvyE5xGSWuRk1zDbHz3z9E0ijuu0XRTAYkAV3Mi3m', 'member', NULL, 1, NULL, '2026-07-13 22:19:02', '2026-07-13 22:19:02'),
(25, 'Alqia Abdul', 'alqiaabdul123@gmail.com', '6283173135921', '2026-07-16 02:47:37', '$2y$12$P3ueYhWxzyU93WsuF6oVdujH7lDadsGeRbxe1wQ4zhxdF2Hv9GteW', 'member', NULL, 1, 'W6sg9UzNO53Z7A09tZ36Y8pXaa964Ebqlhd39yc2jXpq6XiZ4LtogQFqwxPB', '2026-07-16 02:43:05', '2026-07-16 02:47:37'),
(26, 'Mery Widya Lestari', 'widyalestari1239@gmail.com', '62895376753429', '2026-07-16 02:53:53', '$2y$12$IQwOb1jCY9E6thbl/fFXc.nB2HVhq2llhix1CS9l2nZiJdcxgm6IC', 'member', NULL, 1, 'c1VlMaI4fOjXWZ1Jkk6ieSKEvcHIjvKnjBvL6RyfwcUbabpT44Yy8t1yeobI', '2026-07-16 02:52:56', '2026-07-16 02:53:53'),
(27, 'Quality Assurance (Radit)', 'syifarpratama@gmail.com', '6285816525301', '2026-07-16 02:58:09', '$2y$12$lgIdMGAi..pFroPQTZ/rvuqzmFFgJo8lebe7hHIRPVm5XvlKJ6bye', 'admin', 'avatars/a320dd72-a295-4c23-9255-b5a8466f453f.jpg', 1, NULL, '2026-07-16 02:57:30', '2026-08-03 07:40:36'),
(28, 'Rizqi Ihsan', 'adityaefriansyah01@gmail.com', '6289653615622', '2026-07-16 07:58:50', '$2y$12$K8TMl77zCNBZ9pakuZO2Su7cGQNvmPg5P46tnxhwUGRjhtwR9QJK2', 'member', NULL, 1, NULL, '2026-07-16 07:57:28', '2026-07-16 07:58:50'),
(29, 'Sabila', 'sabilansha22@gmail.com', '6281384885162', '2026-07-16 08:27:57', '$2y$12$JJ1sA6jQQKC5Z2KRN4Ud7Ofr3W8oKJTI6kXxLOkeF8iy5NUoZS.zK', 'user', NULL, 1, 'AXsCZk9FCuGBnmJGlZotrmFQrqVzgB2CpwKT1VzP2vDIglGgfj92LMvU9n90', '2026-07-16 08:27:15', '2026-07-16 08:27:57'),
(30, 'Indra Maulana Ibrahim', 'indramaulanaibrahim55@gmail.com', '6289655779748', NULL, '$2y$12$z2kEye9aaYjG1X0vbqmpMuQ10sTGuWnP7zj.S/EkO3wr6xUb6zBU6', 'user', NULL, 1, '6ME2Z16xmzSGd7fdLGUgAuq3XZ9Qu8vxBWua54cpjPA47jRXdgQu5wqPs8Fm', '2026-07-17 10:49:58', '2026-08-15 14:03:02'),
(31, 'bivoa', 'b.iviton.l.yf.re.nd.lich.t.i.mew.o.r.ks.8.88.@gmail.com', '6285234742299', NULL, '$2y$12$EztwUfOAKhPUlyf3hsgaX.VQVZwstCuLxNInA6wllzX8a9rNCYVIC', 'user', NULL, 1, NULL, '2026-07-20 20:24:46', '2026-07-20 20:24:46'),
(32, 'AGUS MAN', 'xena7959@gmail.com', '6283832646639', '2026-07-22 00:23:43', '$2y$12$fw8UCqCbMQlNg0/AzEdXx.gOTlrIZrm1..o4oGT7ATroGa3eP..KS', 'user', NULL, 1, NULL, '2026-07-22 00:23:20', '2026-07-22 00:23:43'),
(33, 'Brandon', 'senpainao@gmail.com', '6285123295932', '2026-07-31 10:33:17', '$2y$12$3./msL7u2S2irX2xENBKQuvv2rdFNVFypSnOjm/uVZuuW54rVXf3y', 'user', NULL, 1, 'dGiMxaS380I6uAF4JiZGPFRd4oAK4DPAB1EWyLGjwaYfSWocVMgUyadYsr1m', '2026-07-31 10:32:50', '2026-08-05 03:05:48'),
(34, 'Sandi Nur', 'sandinurfauzan21@gmail.com', '6285136287597', '2026-07-31 10:36:40', '$2y$12$lBfRDRmlxK8g5m4.b/3Y9.ArDWjC7DWEBOWxC12OfOu6mXVnPUUgK', 'user', NULL, 1, 'CyaRNrV1KJ1KIsckloWzupUE4yvig3CiS9JWQ9X71tghShsyXlAS1lGIZjhi', '2026-07-31 10:35:22', '2026-07-31 10:36:40'),
(35, 'Sherrybap', 'lindamiller7369zlq6@travel-e-store.com', '6281467673319', NULL, '$2y$12$FYTzlsIrL6KRRlCVW2TijOAHeZKW5tnkxETJlacgFR7Zlp.JCOrgC', 'user', NULL, 1, NULL, '2026-08-02 20:21:21', '2026-08-02 20:21:21'),
(36, 'Bonaventura Aristo', 'bonaventuraaristo@gmail.com', '6285742643093', '2026-08-03 12:11:16', '$2y$12$UymOV7WyStbcHrAmtkyy2e/rm689DagxuzachJAWNbJu6YtP6TWeW', 'user', NULL, 1, 'qiHReqQO3rK9wybqgc40PGmxVjYvBjbdJVrcPeLec7RfjydfO2OUOo11b0Rv', '2026-08-03 12:10:52', '2026-08-16 06:20:55'),
(37, 'bivoa', 'biv.it.on.lyf.rendlicht.i.m.ew.o.rks8.8.8.@gmail.com', '6288989723245', NULL, '$2y$12$ayk/1n5RWFzlZER41SUGleWwLzv53R6Aec17WYSgv.oEI2ky65Uiu', 'user', NULL, 1, NULL, '2026-08-11 01:53:42', '2026-08-11 01:53:42'),
(38, 'Ibrahim Ramadhan Aji', 'abuibrama@gmail.com', '6285155029177', '2026-08-13 00:47:41', '$2y$12$WbP0wkjgt4wOgvfLLo1Bx./m9GXvM5GB88u8ad4XvyaM9uJ99G2u.', 'user', NULL, 1, NULL, '2026-08-13 00:47:11', '2026-08-13 00:47:41'),
(39, 'kiflan Arkananta', 'kiflanark0@gmail.com', '6281281793926', '2026-08-13 06:00:59', '$2y$12$xHppCy8DKsp9QL65/zCZzusyIydEAgXukpn7c67ejqL4pQ96TDuLq', 'user', NULL, 1, NULL, '2026-08-13 06:00:06', '2026-08-13 06:00:59'),
(40, 'ben', 'yipikayey83@gmail.com', '6282116513734', '2026-08-20 02:20:17', '$2y$12$lJ08D2oUz3/MmacXtyLaDO82nBSmQVWwWpDIAen8YBPG83veaN2Qa', 'user', 'avatars/ef1130c8-8bbb-4640-83d5-d2b92a59db06.jpg', 1, 'hUvw1LzYSBDrpNgRohyJh8nEZpuHMfhArc0URxBVabnREZhUU5n5zeUpfaFN', '2026-08-20 02:15:49', '2026-08-20 02:20:17'),
(41, 'JuliusVep', 'xrumakey@gmail.com', '6281847931599', NULL, '$2y$12$jHbPZhMKKL756l6wn71dW.vw0C9XqUOsGdOGTGMsAaGYke9JTfiKa', 'user', NULL, 1, NULL, '2026-08-22 06:02:33', '2026-08-22 06:02:33'),
(42, 'Raditia Eka Sundayana R', 'radityaeka4@gmail.com', '6282211116938', '2026-08-25 03:38:18', '$2y$12$Q8sXapmDlMXiMe8xlZ2cUuWuH.cemIwlN2EY0RTej2WgujdJPfvoC', 'user', 'avatars/7de65eeb-6933-404a-be32-b03cfacb2d69.jpg', 1, NULL, '2026-08-25 03:37:52', '2026-08-25 03:40:11'),
(43, 'GlennGon', 'dlanders@flash.net@outlook.com', '6287591297812', NULL, '$2y$12$/0TzOUVw75vwQXPM/8JR7ejENAfRBSysSWYo9VQRRqTyUW0IfkXa.', 'user', NULL, 1, NULL, '2026-08-25 12:59:53', '2026-08-25 12:59:53'),
(44, 'Yayat Supriatna', 'yatz.supriatna24@gmail.com', '628978204379', '2026-08-25 13:06:12', '$2y$12$xx/5rv6OcbUcTadtvoHnierl3EY3vVobsB/Mh9hZgXz6K5J7AsVAK', 'user', NULL, 1, '34d6q50pNFZWxIAXMj6EkmTZdNlp20BTkK15PvSyAOF2WKjmnRFNjHFIPP39', '2026-08-25 13:04:05', '2026-08-25 13:06:12'),
(45, 'XMC-plHycle', 'x-xmcplk@xmc.pl', '6281486685656', NULL, '$2y$12$5zwPQY8MZKW8Dtmd4PWDLeIav/AUjGKt/4R6.1mIZ5WApTpvSanXu', 'user', NULL, 1, NULL, '2026-09-01 21:58:36', '2026-09-01 21:58:36'),
(46, 'Rafa Ramadhan Andika Pratama', 'rafarizwana428@gmail.com', '6285703547096', '2026-09-14 05:07:26', '$2y$12$dR9otPE/b7Ca6qMH5qzho.b5RgnsDSdypm93nJKNq3dnx7cL8F0N6', 'user', NULL, 1, NULL, '2026-09-14 05:04:21', '2026-09-14 05:07:26'),
(47, 'RikiDuh', 'riki2000gm@gmail.com', '6284162737487', NULL, '$2y$12$/oz/nN/q0/7h4Zn0OZNY4Oiyd2v8Uv0R.sRJkU4XpKHMp8hhA1zwq', 'user', NULL, 1, NULL, '2026-09-17 02:24:28', '2026-09-17 02:24:28'),
(48, 'Stuartmob', 'mell.gallahue@gmail.com@outlook.com', '6288326485923', NULL, '$2y$12$7ddQYoLiCfOsIaBhuJnDiO.QxDvFxtfe0tg0d9EdkTbdKUdobztKK', 'user', NULL, 1, NULL, '2026-09-17 15:41:09', '2026-09-17 15:41:09');

-- --------------------------------------------------------

--
-- Table structure for table `user_rewards`
--

CREATE TABLE `user_rewards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `reward_id` bigint(20) UNSIGNED NOT NULL,
  `minggu_ke` int(10) UNSIGNED NOT NULL,
  `unique_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `claimed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `workflows`
--

CREATE TABLE `workflows` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `step_order` int(11) NOT NULL DEFAULT '0',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `workflows`
--

INSERT INTO `workflows` (`id`, `step_order`, `title`, `icon`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kirim Foto', '📸', 1, '2026-01-26 18:56:35', '2026-01-26 18:56:35'),
(2, 2, 'Analisa', '🧠', 1, '2026-01-26 18:56:35', '2026-01-26 18:56:35'),
(3, 3, 'Proses', '🛠️', 1, '2026-01-26 18:56:35', '2026-01-26 18:56:35'),
(4, 4, 'QC', '✅', 1, '2026-01-26 18:56:35', '2026-01-26 18:56:35'),
(5, 5, 'Selesai', '📦', 1, '2026-01-26 18:56:35', '2026-01-26 18:56:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_sections`
--
ALTER TABLE `about_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campaigns_is_active_index` (`is_active`);

--
-- Indexes for table `cta_sections`
--
ALTER TABLE `cta_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_logins`
--
ALTER TABLE `daily_logins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_user_tanggal` (`user_id`,`tanggal_checkin`),
  ADD KEY `daily_logins_status_index` (`status`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `donations_spk_unique` (`spk`),
  ADD KEY `donations_user_id_foreign` (`user_id`),
  ADD KEY `donations_verified_by_foreign` (`verified_by`),
  ADD KEY `donations_status_index` (`status`);

--
-- Indexes for table `donation_items`
--
ALTER TABLE `donation_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `donation_items_kode_barang_unique` (`kode_barang`),
  ADD KEY `donation_items_status_index` (`status`),
  ADD KEY `donation_items_donation_id_foreign` (`donation_id`);

--
-- Indexes for table `donation_item_services`
--
ALTER TABLE `donation_item_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `donation_item_services_donation_item_id_foreign` (`donation_item_id`),
  ADD KEY `donation_item_services_service_id_foreign` (`service_id`);

--
-- Indexes for table `donation_requests`
--
ALTER TABLE `donation_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `donation_requests_donation_item_id_foreign` (`donation_item_id`),
  ADD KEY `donation_requests_user_id_foreign` (`user_id`),
  ADD KEY `donation_requests_status_index` (`status`),
  ADD KEY `donation_requests_email_index` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hero_sections`
--
ALTER TABLE `hero_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layanan_categories`
--
ALTER TABLE `layanan_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `layanan_categories_slug_unique` (`slug`);

--
-- Indexes for table `layanan_services`
--
ALTER TABLE `layanan_services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `layanan_services_slug_unique` (`slug`),
  ADD KEY `layanan_services_layanan_category_id_foreign` (`layanan_category_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_service_id_foreign` (`service_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rewards`
--
ALTER TABLE `rewards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rewards_created_by_foreign` (`created_by`),
  ADD KEY `rewards_status_aktif_index` (`status_aktif`),
  ADD KEY `rewards_minggu_ke_index` (`minggu_ke`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `trust_items`
--
ALTER TABLE `trust_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_rewards`
--
ALTER TABLE `user_rewards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_user_reward_minggu` (`user_id`,`reward_id`,`minggu_ke`),
  ADD UNIQUE KEY `user_rewards_unique_code_unique` (`unique_code`),
  ADD KEY `user_rewards_reward_id_foreign` (`reward_id`);

--
-- Indexes for table `workflows`
--
ALTER TABLE `workflows`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_sections`
--
ALTER TABLE `about_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cta_sections`
--
ALTER TABLE `cta_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `daily_logins`
--
ALTER TABLE `daily_logins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `donation_items`
--
ALTER TABLE `donation_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `donation_item_services`
--
ALTER TABLE `donation_item_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=308;

--
-- AUTO_INCREMENT for table `donation_requests`
--
ALTER TABLE `donation_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hero_sections`
--
ALTER TABLE `hero_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `layanan_categories`
--
ALTER TABLE `layanan_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `layanan_services`
--
ALTER TABLE `layanan_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rewards`
--
ALTER TABLE `rewards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `trust_items`
--
ALTER TABLE `trust_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `user_rewards`
--
ALTER TABLE `user_rewards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `workflows`
--
ALTER TABLE `workflows`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daily_logins`
--
ALTER TABLE `daily_logins`
  ADD CONSTRAINT `daily_logins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `donations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `donations_verified_by_foreign` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `donation_items`
--
ALTER TABLE `donation_items`
  ADD CONSTRAINT `donation_items_donation_id_foreign` FOREIGN KEY (`donation_id`) REFERENCES `donations` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `donation_item_services`
--
ALTER TABLE `donation_item_services`
  ADD CONSTRAINT `donation_item_services_donation_item_id_foreign` FOREIGN KEY (`donation_item_id`) REFERENCES `donation_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `donation_item_services_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `donation_requests`
--
ALTER TABLE `donation_requests`
  ADD CONSTRAINT `donation_requests_donation_item_id_foreign` FOREIGN KEY (`donation_item_id`) REFERENCES `donation_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `donation_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `layanan_services`
--
ALTER TABLE `layanan_services`
  ADD CONSTRAINT `layanan_services_layanan_category_id_foreign` FOREIGN KEY (`layanan_category_id`) REFERENCES `layanan_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `rewards`
--
ALTER TABLE `rewards`
  ADD CONSTRAINT `rewards_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `user_rewards`
--
ALTER TABLE `user_rewards`
  ADD CONSTRAINT `user_rewards_reward_id_foreign` FOREIGN KEY (`reward_id`) REFERENCES `rewards` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_rewards_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
