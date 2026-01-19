-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2026 at 05:19 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sampah`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori_berita_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `kategori_berita_id`, `user_id`, `judul`, `url`, `deskripsi`, `foto`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Gunung Sampah di Desa ABC', NULL, 'tumpukan sampah yang menggunug di desa ABC menganggu aktifitas sehari-hari warga desa', NULL, '2025-05-26 05:24:46', '2025-05-26 05:24:46'),
(2, 1, 2, 'Kategori Sampah Yang Tersedia di Bank Sampah', 'www.pengumpulansampah.com', 'jaga lingkungan bersih', 'berita_20250526_03-28-43.jpg', '2025-05-26 08:28:43', '2025-05-26 08:28:43'),
(3, 2, 2, 'Pengumpulan Sampah Minggu ke-5', 'www.pengumpulansampah.com', 'pengumupulan sampah minggu ke-5 akan dilakukan pada tanggal 4 Januari 2026', '', '2025-12-29 08:29:44', '2025-12-29 08:29:44');

-- --------------------------------------------------------

--
-- Table structure for table `detail_setoran`
--

CREATE TABLE `detail_setoran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `setoran_id` bigint(20) UNSIGNED NOT NULL,
  `sampah_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_setoran`
--

INSERT INTO `detail_setoran` (`id`, `setoran_id`, `sampah_id`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 2, '2025-05-26 05:24:46', '2025-05-26 05:24:46'),
(2, 1, 6, 3, '2025-05-26 05:24:46', '2025-12-29 08:21:16'),
(3, 2, 1, 5, '2025-05-26 07:54:38', '2025-05-26 07:54:38'),
(4, 2, 5, 4, '2025-05-26 07:54:38', '2025-05-26 07:54:38'),
(5, 2, 6, 3, '2025-05-26 07:54:38', '2025-05-26 07:54:38'),
(6, 3, 1, 5, '2025-11-14 14:04:47', '2025-11-14 14:04:47'),
(7, 3, 3, 3, '2025-11-14 14:04:47', '2025-11-14 14:04:47'),
(8, 3, 10, 4, '2025-11-14 14:04:47', '2025-11-14 14:04:47'),
(9, 4, 1, 5, '2025-11-14 16:28:50', '2025-11-14 16:28:50'),
(10, 4, 3, 3, '2025-11-14 16:28:50', '2025-11-14 16:28:50'),
(11, 4, 10, 4, '2025-11-14 16:28:50', '2025-11-14 16:28:50'),
(12, 5, 1, 2, '2025-11-19 15:14:27', '2025-11-19 15:14:27'),
(13, 5, 2, 5, '2025-11-19 15:14:27', '2025-11-19 15:14:27'),
(14, 5, 5, 1, '2025-11-19 15:14:27', '2025-11-19 15:14:27'),
(15, 6, 4, 5, '2025-12-27 16:37:15', '2025-12-27 16:37:15'),
(16, 6, 7, 2, '2025-12-27 16:37:15', '2025-12-27 16:37:15'),
(17, 6, 9, 10, '2025-12-27 16:37:15', '2025-12-27 16:37:15'),
(18, 7, 5, 2, '2025-12-27 16:42:56', '2025-12-27 16:42:56'),
(19, 7, 9, 5, '2025-12-27 16:42:56', '2025-12-27 16:42:56'),
(20, 8, 5, 3, '2025-12-27 16:55:48', '2025-12-27 16:55:48'),
(21, 8, 7, 2, '2025-12-27 16:55:48', '2025-12-27 16:55:48'),
(22, 9, 5, 3, '2025-12-27 16:57:11', '2025-12-27 16:57:11'),
(23, 9, 9, 2, '2025-12-27 16:57:11', '2025-12-27 16:57:11'),
(24, 10, 1, 2, '2025-12-27 17:01:24', '2025-12-27 17:01:24'),
(25, 11, 6, 5, '2025-12-27 17:04:47', '2025-12-27 17:04:47'),
(26, 12, 8, 1, '2025-12-27 17:11:31', '2025-12-27 17:11:31'),
(27, 13, 6, 3, '2025-12-27 17:13:31', '2025-12-27 17:13:31'),
(28, 14, 7, 5, '2025-12-27 17:16:36', '2025-12-27 17:16:36'),
(29, 15, 6, 3, '2025-12-27 17:18:31', '2025-12-27 17:18:31'),
(46, 22, 1, 2, '2025-12-29 08:07:36', '2025-12-29 08:07:36'),
(47, 22, 6, 3, '2025-12-29 08:07:36', '2025-12-29 08:07:36'),
(48, 22, 5, 2, '2025-12-29 08:07:36', '2025-12-29 08:07:36'),
(50, 23, 6, 5, '2025-12-29 08:22:17', '2025-12-29 08:22:17'),
(51, 23, 7, 6, '2025-12-29 08:22:17', '2025-12-29 08:22:17'),
(52, 24, 5, 3, '2025-12-29 16:32:10', '2025-12-29 16:32:10'),
(53, 24, 6, 2, '2025-12-29 16:32:10', '2025-12-29 16:32:10'),
(54, 24, 9, 1, '2025-12-29 16:32:10', '2025-12-29 16:32:10');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hadiah`
--

CREATE TABLE `hadiah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `coin_diperlukan` int(11) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `gambar` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hadiah`
--

INSERT INTO `hadiah` (`id`, `nama`, `coin_diperlukan`, `stok`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'Voucher Belanja Indomaret Rp. 500.000,00-', 100, 4, 'hadiah_20250502_09-57-41.png', '2025-05-26 05:24:46', '2025-05-26 08:19:42'),
(2, 'Uang Tunai Rp. 50.000,00-', 40, 9, 'hadiah_20250502_09-58-41.jpg', '2025-05-26 05:24:46', '2025-05-26 08:22:33'),
(3, 'Pulsa 50.000', 35, 4, '', '2025-05-26 08:30:59', '2025-12-29 08:16:42'),
(4, 'Sabun Cuci Piring', 15, 9, '', '2025-12-29 08:25:25', '2025-12-29 08:25:25');

-- --------------------------------------------------------

--
-- Table structure for table `jawaban_quiz`
--

CREATE TABLE `jawaban_quiz` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rekening_id` bigint(20) UNSIGNED NOT NULL,
  `quiz_attempt_id` bigint(20) UNSIGNED NOT NULL,
  `pertanyaan_id` bigint(20) UNSIGNED NOT NULL,
  `jawaban` enum('A','B','C','D') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_sampah`
--

CREATE TABLE `jenis_sampah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_sampah`
--

INSERT INTO `jenis_sampah` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Organik', '2025-05-26 05:24:46', '2025-05-26 05:24:46'),
(2, 'Non Organik', '2025-05-26 05:24:46', '2025-05-26 05:24:46'),
(3, 'test', '2025-05-26 08:33:46', '2025-05-26 08:33:46');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_berita`
--

CREATE TABLE `kategori_berita` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_berita`
--

INSERT INTO `kategori_berita` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Lingkungan', '2025-05-26 05:24:46', '2025-05-26 05:24:46'),
(2, 'Pemberitahuan Pengumpulan Sampah', '2025-12-29 08:28:08', '2025-12-29 08:28:08');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_sampah`
--

CREATE TABLE `kategori_sampah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_sampah_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_sampah`
--

INSERT INTO `kategori_sampah` (`id`, `nama`, `jenis_sampah_id`, `created_at`, `updated_at`) VALUES
(1, 'Kertas', 2, '2025-05-26 05:24:46', '2025-05-26 05:24:46'),
(2, 'Plastik', 2, '2025-05-26 05:24:46', '2025-05-26 05:24:46'),
(3, 'Logam', 2, '2025-05-26 05:24:46', '2025-05-26 05:24:46'),
(4, 'Pecah Belah', 2, '2025-05-26 05:24:46', '2025-05-26 05:24:46'),
(5, 'Cair', 1, '2025-05-26 05:24:46', '2025-05-26 05:24:46'),
(6, 'Lain - Lain Non Organik', 2, '2025-05-26 05:24:46', '2025-05-26 05:24:46'),
(7, 'test kategori sampah', 3, '2025-05-26 08:34:20', '2025-05-26 08:34:20');

-- --------------------------------------------------------

--
-- Table structure for table `log_transaksi`
--

CREATE TABLE `log_transaksi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rekening_id` bigint(20) UNSIGNED NOT NULL,
  `setoran_id` bigint(20) UNSIGNED DEFAULT NULL,
  `penarikan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('belum diterima','diterima','ditolak') NOT NULL DEFAULT 'belum diterima',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log_transaksi`
--

INSERT INTO `log_transaksi` (`id`, `rekening_id`, `setoran_id`, `penarikan_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 'diterima', '2025-05-26 05:24:46', '2025-05-26 05:24:46'),
(2, 1, NULL, 1, 'diterima', '2025-05-26 05:24:46', '2025-05-26 05:24:46'),
(4, 2, NULL, 2, 'diterima', '2025-05-26 08:00:24', '2025-05-26 08:01:13'),
(6, 2, 4, NULL, 'diterima', '2025-11-14 16:28:50', '2025-11-14 16:31:49'),
(7, 2, NULL, 3, 'diterima', '2025-11-14 16:41:55', '2025-11-14 16:43:13'),
(8, 2, 5, NULL, 'diterima', '2025-11-19 15:14:27', '2025-11-19 15:17:47'),
(12, 1, 8, NULL, 'diterima', '2025-12-27 16:55:48', '2025-12-27 16:55:48'),
(13, 1, 9, NULL, 'diterima', '2025-12-27 16:57:11', '2025-12-27 16:57:11'),
(14, 5, 10, NULL, 'diterima', '2025-12-27 17:01:24', '2025-12-27 17:01:24'),
(15, 6, 11, NULL, 'diterima', '2025-12-27 17:04:47', '2025-12-27 17:04:47'),
(20, 6, NULL, 6, 'diterima', '2025-12-27 17:36:28', '2025-12-27 17:36:28'),
(27, 12, 22, NULL, 'diterima', '2025-12-29 08:07:36', '2025-12-29 08:10:02'),
(28, 12, NULL, 7, 'diterima', '2025-12-29 08:12:05', '2025-12-29 08:13:14'),
(29, 12, 23, NULL, 'diterima', '2025-12-29 08:22:17', '2025-12-29 08:22:17'),
(30, 5, 24, NULL, 'belum diterima', '2025-12-29 16:32:10', '2025-12-29 16:32:10'),
(31, 5, NULL, 8, 'belum diterima', '2025-12-29 16:32:56', '2025-12-29 16:32:56');

-- --------------------------------------------------------

--
-- Table structure for table `metode_pembayaran`
--

CREATE TABLE `metode_pembayaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `metode_pembayaran`
--

INSERT INTO `metode_pembayaran` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Cash On Delivery', '2025-05-26 05:24:46', '2025-05-26 05:24:46');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_11_20_131838_create_jenis_sampah_table', 1),
(7, '2023_12_06_023454_create_metode_pembayarans_table', 1),
(8, '2023_12_06_055308_create_kategori_berita_table', 1),
(9, '2023_12_06_060035_create_berita_table', 1),
(10, '2025_03_05_192126_create_kategori_sampah_table', 1),
(11, '2025_03_05_201801_create_rekening_table', 1),
(12, '2025_03_05_204006_create_penarikan_table', 1),
(13, '2025_03_05_222454_create_sampah_table', 1),
(14, '2025_03_05_222526_create_setoran_table', 1),
(15, '2025_03_05_222657_create_detail_setoran_table', 1),
(16, '2025_03_05_223000_create_log_transaksi_table', 1),
(17, '2025_03_22_034032_create_quiz_table', 1),
(18, '2025_03_22_034047_create_pertanyaan_table', 1),
(19, '2025_04_28_182159_create_quiz_attempt_table', 1),
(20, '2025_04_28_183421_create_jawaban_quiz_table', 1),
(21, '2025_04_28_202115_create_hadiah_table', 1),
(22, '2025_04_28_202209_create_penukaran_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penarikan`
--

CREATE TABLE `penarikan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rekening_id` bigint(20) UNSIGNED NOT NULL,
  `total_harga` double(8,2) NOT NULL,
  `metode_pembayaran_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penarikan`
--

INSERT INTO `penarikan` (`id`, `rekening_id`, `total_harga`, `metode_pembayaran_id`, `created_at`, `updated_at`) VALUES
(1, 1, 5000.00, 1, '2025-05-26 05:24:46', '2025-05-26 05:24:46'),
(2, 2, 10000.00, 1, '2025-05-26 08:00:24', '2025-05-26 08:00:24'),
(3, 2, 15000.00, 1, '2025-11-14 16:41:55', '2025-11-14 16:41:55'),
(4, 2, 10000.00, 1, '2025-11-19 15:15:23', '2025-11-19 15:15:23'),
(5, 6, 5000.00, 1, '2025-12-27 17:34:02', '2025-12-27 17:34:02'),
(6, 6, 5000.00, 1, '2025-12-27 17:36:28', '2025-12-27 17:36:28'),
(7, 12, 10000.00, 1, '2025-12-29 08:12:05', '2025-12-29 08:12:05'),
(8, 5, 20000.00, 1, '2025-12-29 16:32:56', '2025-12-29 16:32:56');

-- --------------------------------------------------------

--
-- Table structure for table `penukaran`
--

CREATE TABLE `penukaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rekening_id` bigint(20) UNSIGNED NOT NULL,
  `hadiah_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('belum diterima','diterima','ditolak') NOT NULL DEFAULT 'belum diterima',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penukaran`
--

INSERT INTO `penukaran` (`id`, `rekening_id`, `hadiah_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'belum diterima', '2025-05-26 05:24:46', '2025-05-26 05:24:46'),
(2, 2, 2, 'diterima', '2025-05-26 08:21:02', '2025-05-26 08:22:33'),
(7, 2, 1, 'belum diterima', '2025-11-19 15:25:51', '2025-11-19 15:25:51'),
(8, 12, 3, 'diterima', '2025-12-29 08:15:31', '2025-12-29 08:16:42');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quiz_id` bigint(20) UNSIGNED NOT NULL,
  `pertanyaan` text NOT NULL,
  `opsi_a` varchar(255) NOT NULL,
  `opsi_b` varchar(255) NOT NULL,
  `opsi_c` varchar(255) NOT NULL,
  `opsi_d` varchar(255) NOT NULL,
  `jawaban_benar` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `score_per_pertanyaan` int(11) NOT NULL,
  `coin_per_pertanyaan` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_attempt`
--

CREATE TABLE `quiz_attempt` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quiz_id` bigint(20) UNSIGNED NOT NULL,
  `rekening_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('belum selesai','selesai') NOT NULL DEFAULT 'belum selesai',
  `score` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rekening`
--

CREATE TABLE `rekening` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nomor_rekening` varchar(255) NOT NULL,
  `saldo` double(8,3) NOT NULL,
  `score` int(11) NOT NULL DEFAULT 0,
  `coin` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rekening`
--

INSERT INTO `rekening` (`id`, `user_id`, `nomor_rekening`, `saldo`, `score`, `coin`, `created_at`, `updated_at`) VALUES
(1, 1, '2025030501', 26300.000, 350, 15176, '2025-05-26 05:24:46', '2025-12-27 16:57:11'),
(2, 5, '202505261452075', 24800.000, 558, 187, '2025-05-26 07:52:07', '2025-11-19 15:17:47'),
(3, 6, '202505261505126', 28750.000, 620, 250, '2025-05-26 08:05:12', '2025-12-27 17:18:31'),
(4, 7, '202505261505467', 3000.000, 260, 75, '2025-05-26 08:05:46', '2025-12-27 17:13:31'),
(5, 8, '202505261506378', 50000.000, 146, 20, '2025-05-26 08:06:37', '2025-12-29 16:32:44'),
(6, 9, '202505261507259', 0.000, 349, 125, '2025-05-26 08:07:25', '2025-12-27 17:36:28'),
(12, 15, '2025122915063215', 7300.000, 850, 385, '2025-12-29 08:06:32', '2025-12-29 08:22:17');

-- --------------------------------------------------------

--
-- Table structure for table `sampah`
--

CREATE TABLE `sampah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kategori_sampah_id` bigint(20) UNSIGNED NOT NULL,
  `satuan` varchar(255) NOT NULL,
  `harga` double(8,3) NOT NULL,
  `score` int(11) DEFAULT NULL,
  `coin` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sampah`
--

INSERT INTO `sampah` (`id`, `nama`, `kategori_sampah_id`, `satuan`, `harga`, `score`, `coin`, `created_at`, `updated_at`) VALUES
(1, 'Dus', 1, 'kg', 1200.000, 25, 10, '2025-05-26 05:24:46', '2025-05-26 05:24:46'),
(2, 'Kertas Putih/HVS', 1, 'kg', 1500.000, 25, 10, '2025-05-26 05:24:46', '2025-05-26 05:24:46'),
(3, 'Kertas Koran Utuh', 1, 'kg', 2500.000, 25, 10, '2025-05-26 05:24:46', '2025-05-26 05:24:46'),
(4, 'Duplek/Kartor/Kertas Boncos', 1, 'kg', 500.000, 25, 10, '2025-05-26 05:24:46', '2025-05-26 05:24:46'),
(5, 'Gelas A (Kondisi Bersh)', 2, 'kg', 3000.000, 50, 25, '2025-05-26 05:24:46', '2025-05-26 05:24:46'),
(6, 'Kaleng', 3, 'kg', 1000.000, 50, 25, '2025-05-26 05:24:46', '2025-05-26 05:24:46'),
(7, 'Botol Beling Bening', 4, 'kg', 150.000, 50, 25, '2025-05-26 05:24:46', '2025-05-26 05:24:46'),
(8, 'Mesin Cuci', 6, 'Pcs/Satuan', 25000.000, 100, 50, '2025-05-26 05:24:46', '2025-05-26 05:24:46'),
(9, 'Minyak Jelantah', 5, 'Pcs/Satuan', 5500.000, NULL, NULL, '2025-05-26 05:24:46', '2025-05-26 05:24:46'),
(10, 'Seng', 3, 'Kg', 600.000, 5, 1, '2025-05-26 08:25:45', '2025-05-26 08:25:45');

-- --------------------------------------------------------

--
-- Table structure for table `setoran`
--

CREATE TABLE `setoran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rekening_id` bigint(20) UNSIGNED NOT NULL,
  `total_harga` double(8,2) NOT NULL,
  `total_score` int(11) DEFAULT NULL,
  `total_coin` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setoran`
--

INSERT INTO `setoran` (`id`, `rekening_id`, `total_harga`, `total_score`, `total_coin`, `created_at`, `updated_at`) VALUES
(1, 1, 8000.00, 200, 95, '2025-05-26 05:24:46', '2025-12-29 08:21:16'),
(2, 2, 21000.00, 113, 48, '2025-05-26 07:54:38', '2025-05-26 07:54:38'),
(3, 2, 15900.00, 43, 9, '2025-11-14 14:04:47', '2025-11-14 14:04:47'),
(4, 2, 15900.00, 220, 84, '2025-11-14 16:28:50', '2025-11-14 16:28:50'),
(5, 2, 12900.00, 225, 95, '2025-11-19 15:14:27', '2025-11-19 15:14:27'),
(6, 6, 57800.00, 225, 100, '2025-12-27 16:37:15', '2025-12-27 16:37:15'),
(7, 4, 33500.00, 100, 50, '2025-12-27 16:42:56', '2025-12-27 16:42:56'),
(8, 1, 7800.00, 225, 113, '2025-12-27 16:55:48', '2025-12-27 16:55:48'),
(9, 1, 18500.00, 125, 63, '2025-12-27 16:57:11', '2025-12-27 16:57:11'),
(10, 5, 2400.00, 50, 20, '2025-12-27 17:01:24', '2025-12-27 17:01:24'),
(11, 6, 5000.00, 250, 125, '2025-12-27 17:04:47', '2025-12-27 17:04:47'),
(12, 3, 25000.00, 100, 50, '2025-12-27 17:11:31', '2025-12-27 17:11:31'),
(13, 4, 3000.00, 150, 75, '2025-12-27 17:13:31', '2025-12-27 17:13:31'),
(14, 3, 750.00, 250, 125, '2025-12-27 17:16:36', '2025-12-27 17:16:36'),
(15, 3, 3000.00, 150, 75, '2025-12-27 17:18:31', '2025-12-27 17:18:31'),
(22, 12, 11400.00, 300, 145, '2025-12-29 08:07:36', '2025-12-29 08:07:36'),
(23, 12, 5900.00, 550, 275, '2025-12-29 08:22:17', '2025-12-29 08:22:17'),
(24, 5, 16500.00, 250, 125, '2025-12-29 16:32:10', '2025-12-29 16:32:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','manager','staff','pelanggan') NOT NULL DEFAULT 'pelanggan',
  `isactive` enum('yes','no','banned') NOT NULL DEFAULT 'yes',
  `foto` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `isactive`, `foto`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Zeta', 'zeta123@gmail.com', NULL, '$2y$12$jIM2bQrGNwGRjPef65hI.OsvhnP/mW5ejLsbkbQYKM6G4TFGEbJLm', 'pelanggan', 'yes', NULL, NULL, '2025-05-26 05:24:46', '2025-05-26 05:24:46'),
(2, 'admin', 'admin@gmail.com', NULL, '$2y$12$8Iqa7RHlYMalU1yVTXhtuehbJmxJOol3pga7Biy1LJ6tD86YO2Xda', 'admin', 'yes', NULL, NULL, '2025-05-26 05:24:46', '2025-05-26 05:24:46'),
(3, 'manager', 'manager@gmail.com', NULL, '$2y$12$gPbMcyKXwl557RccpLAw0eKVdWMCHi84EpexLlAtwVQjBMAexKuru', 'manager', 'yes', NULL, NULL, '2025-05-26 05:24:46', '2025-05-26 05:24:46'),
(4, 'staff', 'staff@gmail.com', NULL, '$2y$12$c5TKHq1yQ.JUJrSqE7PLTet7gUiGvRbqWt0vLkBm81YKjsg9PCna2', 'staff', 'yes', NULL, NULL, '2025-05-26 05:24:46', '2025-05-26 05:24:46'),
(5, 'MOCH FIKRI RAMADHAN', 'libr.libr1711@gmail.com', NULL, '$2y$12$u.1Q0ZimJU6dmI4J5ty3lu/hM9xY2cDx.dwGeTnwe.EnujV8UjwwG', 'pelanggan', 'yes', NULL, NULL, '2025-05-26 07:52:07', '2025-05-26 07:52:07'),
(6, 'Bagas Ibrahim', 'bagas123@gmail.com', NULL, '$2y$12$Vvx35yfXmeXQCPjo.ulQDe/WEvs3SlmtasYhPd63YQbeMhzeWmsZ.', 'pelanggan', 'yes', NULL, NULL, '2025-05-26 08:05:12', '2025-05-26 08:05:12'),
(7, 'Safira Nur Baiti', 'safira123@gmail.com', NULL, '$2y$12$Do9WZRjig1caPzMfKQMSN.oVrr0ZYk.j..rNLmebHEO0mz8Ptknum', 'pelanggan', 'yes', NULL, NULL, '2025-05-26 08:05:46', '2025-05-26 08:05:46'),
(8, 'Lexi Anugrah', 'lexi123@gmail.com', NULL, '$2y$12$4wv17BXL6YDev0xQJf7yBOBHdOtTYVtzkZw7jsx3W.dGuU3MjKggu', 'pelanggan', 'yes', NULL, NULL, '2025-05-26 08:06:37', '2025-05-26 08:06:37'),
(9, 'Raditya Narendra Hadi', 'radit123@gmail.com', NULL, '$2y$12$.wFdHWwOSGkt4IaYwgtrxuQwv5xGEekZiZeV0ukyEXVZof/EmOrFS', 'pelanggan', 'yes', NULL, NULL, '2025-05-26 08:07:25', '2025-05-26 08:07:25'),
(15, 'demo', 'demo@demo.com', NULL, '$2y$12$sTEVWBowta/uQjzQROOeXOONzRWfw1.QEyvonJf2.kau3zggjliP6', 'pelanggan', 'yes', NULL, NULL, '2025-12-29 08:06:32', '2025-12-29 08:06:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `berita_kategori_id` (`kategori_berita_id`),
  ADD KEY `berita_user_id` (`user_id`);

--
-- Indexes for table `detail_setoran`
--
ALTER TABLE `detail_setoran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `setoran_detail_id` (`setoran_id`),
  ADD KEY `detail_setoran_sampah_id` (`sampah_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hadiah`
--
ALTER TABLE `hadiah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jawaban_quiz`
--
ALTER TABLE `jawaban_quiz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jawaban_quiz_rekening_id` (`rekening_id`),
  ADD KEY `quiz_attempt_id` (`quiz_attempt_id`),
  ADD KEY `jawaban_quiz_pertanyaan_id` (`pertanyaan_id`);

--
-- Indexes for table `jenis_sampah`
--
ALTER TABLE `jenis_sampah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_berita`
--
ALTER TABLE `kategori_berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_sampah`
--
ALTER TABLE `kategori_sampah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sampah_jenis_id` (`jenis_sampah_id`);

--
-- Indexes for table `log_transaksi`
--
ALTER TABLE `log_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rekening_log_transaksi_id` (`rekening_id`),
  ADD KEY `setoran_log_transaksi_id` (`setoran_id`),
  ADD KEY `penarikan_log_transaksi_id` (`penarikan_id`);

--
-- Indexes for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `penarikan`
--
ALTER TABLE `penarikan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rekening_penarikan_id` (`rekening_id`),
  ADD KEY `metode_pembayaran_penarikan_id` (`metode_pembayaran_id`);

--
-- Indexes for table `penukaran`
--
ALTER TABLE `penukaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penukaran_rekening_id` (`rekening_id`),
  ADD KEY `penukaran_hadiah_id` (`hadiah_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_pertanyaan_id` (`quiz_id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_attempt`
--
ALTER TABLE `quiz_attempt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_attempt_pertanyaan_id` (`quiz_id`),
  ADD KEY `quiz_rekening_id` (`rekening_id`);

--
-- Indexes for table `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sampah`
--
ALTER TABLE `sampah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sampah_kategori_id` (`kategori_sampah_id`);

--
-- Indexes for table `setoran`
--
ALTER TABLE `setoran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rekening_setoran_id` (`rekening_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_setoran`
--
ALTER TABLE `detail_setoran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hadiah`
--
ALTER TABLE `hadiah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jawaban_quiz`
--
ALTER TABLE `jawaban_quiz`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_sampah`
--
ALTER TABLE `jenis_sampah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori_berita`
--
ALTER TABLE `kategori_berita`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori_sampah`
--
ALTER TABLE `kategori_sampah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `log_transaksi`
--
ALTER TABLE `log_transaksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `penarikan`
--
ALTER TABLE `penarikan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `penukaran`
--
ALTER TABLE `penukaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz_attempt`
--
ALTER TABLE `quiz_attempt`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rekening`
--
ALTER TABLE `rekening`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sampah`
--
ALTER TABLE `sampah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `setoran`
--
ALTER TABLE `setoran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `berita`
--
ALTER TABLE `berita`
  ADD CONSTRAINT `berita_kategori_id` FOREIGN KEY (`kategori_berita_id`) REFERENCES `kategori_berita` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `berita_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_setoran`
--
ALTER TABLE `detail_setoran`
  ADD CONSTRAINT `detail_setoran_sampah_id` FOREIGN KEY (`sampah_id`) REFERENCES `sampah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `setoran_detail_id` FOREIGN KEY (`setoran_id`) REFERENCES `setoran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jawaban_quiz`
--
ALTER TABLE `jawaban_quiz`
  ADD CONSTRAINT `jawaban_quiz_pertanyaan_id` FOREIGN KEY (`pertanyaan_id`) REFERENCES `pertanyaan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jawaban_quiz_rekening_id` FOREIGN KEY (`rekening_id`) REFERENCES `rekening` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quiz_attempt_id` FOREIGN KEY (`quiz_attempt_id`) REFERENCES `quiz_attempt` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kategori_sampah`
--
ALTER TABLE `kategori_sampah`
  ADD CONSTRAINT `sampah_jenis_id` FOREIGN KEY (`jenis_sampah_id`) REFERENCES `jenis_sampah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `log_transaksi`
--
ALTER TABLE `log_transaksi`
  ADD CONSTRAINT `penarikan_log_transaksi_id` FOREIGN KEY (`penarikan_id`) REFERENCES `penarikan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rekening_log_transaksi_id` FOREIGN KEY (`rekening_id`) REFERENCES `rekening` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `setoran_log_transaksi_id` FOREIGN KEY (`setoran_id`) REFERENCES `setoran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penarikan`
--
ALTER TABLE `penarikan`
  ADD CONSTRAINT `metode_pembayaran_penarikan_id` FOREIGN KEY (`metode_pembayaran_id`) REFERENCES `metode_pembayaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rekening_penarikan_id` FOREIGN KEY (`rekening_id`) REFERENCES `rekening` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penukaran`
--
ALTER TABLE `penukaran`
  ADD CONSTRAINT `penukaran_hadiah_id` FOREIGN KEY (`hadiah_id`) REFERENCES `hadiah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penukaran_rekening_id` FOREIGN KEY (`rekening_id`) REFERENCES `rekening` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD CONSTRAINT `quiz_pertanyaan_id` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quiz_attempt`
--
ALTER TABLE `quiz_attempt`
  ADD CONSTRAINT `quiz_attempt_pertanyaan_id` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quiz_rekening_id` FOREIGN KEY (`rekening_id`) REFERENCES `rekening` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rekening`
--
ALTER TABLE `rekening`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sampah`
--
ALTER TABLE `sampah`
  ADD CONSTRAINT `sampah_kategori_id` FOREIGN KEY (`kategori_sampah_id`) REFERENCES `kategori_sampah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `setoran`
--
ALTER TABLE `setoran`
  ADD CONSTRAINT `rekening_setoran_id` FOREIGN KEY (`rekening_id`) REFERENCES `rekening` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
