-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 21, 2026 at 12:22 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_latihanuas_pbo_ti1c_alyadhitinurizdihar`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_pendaftaran`
--

CREATE TABLE `tabel_pendaftaran` (
  `id_pendaftaran` int NOT NULL,
  `nama_calon` varchar(100) NOT NULL,
  `asal_sekolah` varchar(100) NOT NULL,
  `nilai_ujian` decimal(5,2) NOT NULL,
  `biaya_pendaftaran_dasar` decimal(12,2) NOT NULL,
  `jalur_pendaftaran` enum('Reguler','Prestasi','Kedinasan') NOT NULL,
  `pilihan_prodi` varchar(100) DEFAULT NULL,
  `lokasi_kampus` varchar(100) DEFAULT NULL,
  `jenis_prestasi` varchar(100) DEFAULT NULL,
  `tingkat_prestasi` varchar(50) DEFAULT NULL,
  `sk_ikatan_dinas` varchar(50) DEFAULT NULL,
  `instansi_sponsor` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_pendaftaran`
--

INSERT INTO `tabel_pendaftaran` (`id_pendaftaran`, `nama_calon`, `asal_sekolah`, `nilai_ujian`, `biaya_pendaftaran_dasar`, `jalur_pendaftaran`, `pilihan_prodi`, `lokasi_kampus`, `jenis_prestasi`, `tingkat_prestasi`, `sk_ikatan_dinas`, `instansi_sponsor`) VALUES
(1, 'Ahmad Fauzi', 'SMA Negeri 1 Cilacap', '78.50', '150000.00', 'Reguler', 'Teknik Informatika', 'Kampus Cilacap', NULL, NULL, NULL, NULL),
(2, 'Siti Nurhaliza', 'SMA Negeri 2 Cilacap', '82.00', '150000.00', 'Reguler', 'Sistem Informasi', 'Kampus Cilacap', NULL, NULL, NULL, NULL),
(3, 'Budi Santoso', 'SMK Negeri 1 Cilacap', '75.25', '150000.00', 'Reguler', 'Teknik Mesin', 'Kampus Cilacap', NULL, NULL, NULL, NULL),
(4, 'Dewi Lestari', 'SMA Negeri 3 Cilacap', '80.75', '150000.00', 'Reguler', 'Akuntansi', 'Kampus Cilacap', NULL, NULL, NULL, NULL),
(5, 'Eko Prasetyo', 'SMA Negeri 1 Kroya', '73.00', '150000.00', 'Reguler', 'Teknik Informatika', 'Kampus Cilacap', NULL, NULL, NULL, NULL),
(6, 'Fitriani', 'SMK Negeri 2 Cilacap', '79.50', '150000.00', 'Reguler', 'Administrasi Bisnis', 'Kampus Cilacap', NULL, NULL, NULL, NULL),
(7, 'Galih Pratama', 'SMA Negeri 1 Sidareja', '76.80', '150000.00', 'Reguler', 'Teknik Elektro', 'Kampus Cilacap', NULL, NULL, NULL, NULL),
(8, 'Hana Maulida', 'SMA Negeri 1 Cilacap', '88.00', '0.00', 'Prestasi', 'Teknik Informatika', 'Kampus Cilacap', 'Olimpiade Matematika', 'Nasional', NULL, NULL),
(9, 'Indra Gunawan', 'SMA Negeri 2 Purwokerto', '90.50', '0.00', 'Prestasi', 'Sistem Informasi', 'Kampus Cilacap', 'Lomba Karya Tulis Ilmiah', 'Provinsi', NULL, NULL),
(10, 'Joko Widodo S.', 'SMK Negeri 1 Cilacap', '85.00', '0.00', 'Prestasi', 'Teknik Mesin', 'Kampus Cilacap', 'Kompetisi Robotik', 'Nasional', NULL, NULL),
(11, 'Kartika Sari', 'SMA Negeri 1 Kroya', '87.25', '0.00', 'Prestasi', 'Akuntansi', 'Kampus Cilacap', 'Olimpiade Ekonomi', 'Kabupaten', NULL, NULL),
(12, 'Lukman Hakim', 'SMA Negeri 3 Cilacap', '91.00', '0.00', 'Prestasi', 'Teknik Informatika', 'Kampus Cilacap', 'Kejuaraan Pencak Silat', 'Nasional', NULL, NULL),
(13, 'Mira Anggraini', 'SMK Negeri 2 Cilacap', '84.50', '0.00', 'Prestasi', 'Administrasi Bisnis', 'Kampus Cilacap', 'Lomba Debat Bahasa Inggris', 'Provinsi', NULL, NULL),
(14, 'Nanda Saputra', 'SMA Negeri 1 Sidareja', '89.75', '0.00', 'Prestasi', 'Teknik Elektro', 'Kampus Cilacap', 'Olimpiade Fisika', 'Nasional', NULL, NULL),
(15, 'Oka Pratama', 'SMA Negeri 1 Cilacap', '83.00', '200000.00', 'Kedinasan', NULL, NULL, NULL, NULL, 'SK/IKD/001/2025', 'Pemerintah Kabupaten Cilacap'),
(16, 'Putri Ramadhani', 'SMA Negeri 2 Cilacap', '86.50', '200000.00', 'Kedinasan', NULL, NULL, NULL, NULL, 'SK/IKD/002/2025', 'Kementerian Perhubungan'),
(17, 'Qori Maulana', 'SMK Negeri 1 Cilacap', '81.25', '200000.00', 'Kedinasan', NULL, NULL, NULL, NULL, 'SK/IKD/003/2025', 'Pemerintah Provinsi Jawa Tengah'),
(18, 'Rani Suherman', 'SMA Negeri 3 Cilacap', '84.00', '200000.00', 'Kedinasan', NULL, NULL, NULL, NULL, 'SK/IKD/004/2025', 'Kementerian Keuangan'),
(19, 'Surya Aditya', 'SMA Negeri 1 Kroya', '79.80', '200000.00', 'Kedinasan', NULL, NULL, NULL, NULL, 'SK/IKD/005/2025', 'Pemerintah Kabupaten Cilacap'),
(20, 'Tania Wulandari', 'SMK Negeri 2 Cilacap', '82.75', '200000.00', 'Kedinasan', NULL, NULL, NULL, NULL, 'SK/IKD/006/2025', 'Kementerian Perhubungan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_pendaftaran`
--
ALTER TABLE `tabel_pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_pendaftaran`
--
ALTER TABLE `tabel_pendaftaran`
  MODIFY `id_pendaftaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
