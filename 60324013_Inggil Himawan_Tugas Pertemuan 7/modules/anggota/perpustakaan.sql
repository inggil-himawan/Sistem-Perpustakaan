-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2026 at 09:19 AM
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
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `kode_anggota` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `pekerjaan` varchar(50) DEFAULT NULL,
  `tanggal_daftar` date NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` enum('Aktif','Nonaktif') DEFAULT 'Aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `kode_anggota`, `nama`, `email`, `telepon`, `alamat`, `tanggal_lahir`, `jenis_kelamin`, `pekerjaan`, `tanggal_daftar`, `foto`, `status`, `created_at`, `updated_at`) VALUES
(2, 'AGT-002', 'Siti Nurhaliza', 'siti.nur@email.com', '081234567891', 'Jl. Sudirman No. 25, Bandung', '1998-08-20', 'Perempuan', 'Pegawai', '2024-01-15', '', 'Aktif', '2026-04-21 01:05:34', '2026-04-21 01:05:34'),
(3, 'AGT-003', 'Ahmad Dhani', 'ahmad.dhani@email.com', '081234567892', 'Jl. Gatot Subroto No. 5, Surabaya', '1992-03-10', 'Laki-laki', 'Pegawai', '2024-02-01', '', 'Aktif', '2026-04-21 01:05:34', '2026-04-21 01:05:34'),
(4, 'AGT-004', 'Dewi Lestari', 'dewi.lestari@email.com', '081234567893', 'Jl. Ahmad Yani No. 30, Yogyakarta', '2000-12-05', 'Perempuan', 'Mahasiswa', '2024-02-10', '', 'Aktif', '2026-04-21 01:05:34', '2026-04-21 01:05:34'),
(5, 'AGT-005', 'Rizky Febian', 'rizky.feb@email.com', '081234567894', 'Jl. Diponegoro No. 15, Semarang', '1997-07-18', 'Laki-laki', 'Pelajar', '2024-02-15', '', 'Nonaktif', '2026-04-21 01:05:34', '2026-04-21 01:05:34'),
(13, 'AGT-009', 'sdfsdfsf', 'sfsfs@gmail.com', '085321862138', 'sdfdsfsdfsdfss', '2015-06-08', 'Perempuan', 'dfdfsdfdsf', '2026-05-04', 'foto_69f843538a82d.jpg', 'Aktif', '2026-05-04 06:57:23', '2026-05-04 06:57:23');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_penerbit` int(11) NOT NULL,
  `kode_buku` varchar(20) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `pengarang` varchar(100) NOT NULL,
  `tahun_terbit` int(11) NOT NULL,
  `isbn` varchar(20) DEFAULT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `id_kategori`, `id_penerbit`, `kode_buku`, `judul`, `pengarang`, `tahun_terbit`, `isbn`, `harga`, `stok`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'BK-001', 'Pemrograman PHP untuk Pemula', 'Budi Raharjo', 2022, '9786230011111', 85000.00, 15, 'Buku panduan dasar belajar PHP dari nol hingga mahir.', '2026-04-21 01:58:55', '2026-04-21 02:02:35'),
(2, 2, 3, 'BK-002', 'Laskar Pelangi', 'Andrea Hirata', 2005, '9786230022222', 75000.00, 20, 'Kisah inspiratif 10 anak desa di Belitong yang berjuang meraih mimpi.', '2026-04-21 01:58:55', '2026-04-21 02:02:35'),
(3, 3, 5, 'BK-003', 'Sejarah Nasional Indonesia', 'Sartono Kartodirdjo', 2018, '9786230033333', 120000.00, 8, 'Buku referensi lengkap mengenai sejarah bangsa Indonesia.', '2026-04-21 01:58:55', '2026-04-21 02:02:35'),
(4, 4, 2, 'BK-004', 'Biologi Molekuler Dasar', 'Siti Maimunah', 2020, '9786230044444', 95000.00, 12, 'Pemahaman komprehensif mengenai sel dan biologi molekuler.', '2026-04-21 01:58:55', '2026-04-21 02:02:35'),
(5, 5, 4, 'BK-005', 'Steve Jobs Biography', 'Walter Isaacson', 2011, '9786230055555', 150000.00, 5, 'Kisah hidup dan perjalanan karir pendiri Apple Inc.', '2026-04-21 01:58:55', '2026-04-21 02:02:35'),
(7, 2, 4, 'BK-007', 'Bumi Manusia', 'Pramoedya Ananta Toer', 1980, '9786230077777', 110000.00, 10, 'Novel berlatar belakang era kolonial Belanda menceritakan tokoh Minke.', '2026-04-21 01:58:55', '2026-04-21 02:02:35'),
(8, 3, 1, 'BK-008', 'Sapiens: Riwayat Singkat Umat Manusia', 'Yuval Noah Harari', 2014, '9786230088888', 135000.00, 25, 'Menelusuri sejarah evolusi manusia dari zaman batu hingga abad ke-21.', '2026-04-21 01:58:55', '2026-04-21 02:02:35'),
(9, 4, 3, 'BK-009', 'Kalkulus Lanjut', 'Edwin J. Purcell', 2019, '9786230099999', 180000.00, 4, 'Buku teks standar universitas untuk mata kuliah kalkulus tingkat lanjut.', '2026-04-21 01:58:55', '2026-04-21 02:02:35'),
(10, 5, 5, 'BK-010', 'Soekarno: Bapak Bangsa', 'Bob Hering', 2003, '9786230101010', 125000.00, 7, 'Biografi mendalam tentang presiden pertama Republik Indonesia.', '2026-04-21 01:58:55', '2026-04-21 02:02:35'),
(11, 1, 4, 'BK-011', 'Algoritma dan Struktur Data', 'Rinaldi Munir', 2016, '9786230111111', 115000.00, 22, 'Fundamental ilmu komputer yang wajib dikuasai oleh programmer.', '2026-04-21 01:58:55', '2026-04-21 02:02:35'),
(12, 2, 1, 'BK-012', 'Cantik Itu Luka', 'Eka Kurniawan', 2002, '9786230121212', 98000.00, 14, 'Karya fiksi surealis yang menggabungkan sejarah, mitos, dan tragedi.', '2026-04-21 01:58:55', '2026-04-21 02:02:35'),
(13, 3, 2, 'BK-013', 'Guns, Germs, and Steel', 'Jared Diamond', 1997, '9786230131313', 145000.00, 9, 'Menjawab mengapa peradaban Eurasia mendominasi dunia.', '2026-04-21 01:58:55', '2026-04-21 02:02:35'),
(14, 4, 5, 'BK-014', 'Fisika Kuantum untuk Mahasiswa', 'Yohanes Surya', 2015, '9786230141414', 105000.00, 11, 'Pengantar fisika modern dengan penjelasan yang lebih mudah dipahami.', '2026-04-21 01:58:55', '2026-04-21 02:02:35'),
(15, 5, 3, 'BK-015', 'Habibie & Ainun', 'B.J. Habibie', 2010, '', 85000.00, 30, 'Kisah cinta sejati dan dedikasi B.J. Habibie untuk istri dan negaranya.', '2026-04-21 01:58:55', '2026-04-21 02:02:35');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_buku`
--

CREATE TABLE `kategori_buku` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_buku`
--

INSERT INTO `kategori_buku` (`id_kategori`, `nama_kategori`, `deskripsi`, `created_at`) VALUES
(1, 'Fiksi', 'Karya sastra berupa cerita rekaan atau imajinatif', '2026-04-21 01:27:51'),
(2, 'Non-Fiksi', 'Karya berdasarkan fakta, ilmu pengetahuan, dan kenyataan', '2026-04-21 01:27:51'),
(3, 'Teknologi', 'Buku seputar komputer, pemrograman, dan teknologi informasi', '2026-04-21 01:27:51'),
(4, 'Pendidikan', 'Buku pelajaran dan referensi untuk kegiatan belajar-mengajar', '2026-04-21 01:27:51'),
(5, 'Bisnis', 'Buku tentang manajemen, kewirausahaan, dan ekonomi', '2026-04-21 01:27:51');

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `id_penerbit` int(11) NOT NULL,
  `nama_penerbit` varchar(100) NOT NULL,
  `alamat` text DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`id_penerbit`, `nama_penerbit`, `alamat`, `telepon`, `email`, `created_at`) VALUES
(1, 'Gramedia Pustaka Utama', 'Jakarta', '021-5300310', 'info@gramedia.com', '2026-04-21 01:35:06'),
(2, 'Erlangga', 'Jakarta', '021-5782877', 'cs@erlangga.co.id', '2026-04-21 01:35:06'),
(3, 'Mizan Pustaka', 'Bandung', '022-7012100', 'info@mizan.com', '2026-04-21 01:35:06'),
(4, 'Andi Offset', 'Yogyakarta', '0274-561881', 'info@andipublisher.com', '2026-04-21 01:35:06'),
(5, 'Bentang Pustaka', 'Yogyakarta', '0274-543800', 'redaksi@bentangpustaka.com', '2026-04-21 01:35:06');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `tanggal_harus_kembali` date NOT NULL,
  `status` enum('Dipinjam','Dikembalikan','Terlambat') DEFAULT 'Dipinjam',
  `denda` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_buku`, `id_anggota`, `tanggal_pinjam`, `tanggal_kembali`, `tanggal_harus_kembali`, `status`, `denda`, `created_at`, `updated_at`) VALUES
(14, 2, 2, '2026-03-10', '2026-03-30', '2026-03-24', 'Terlambat', 30000.00, '2026-04-21 07:27:07', '2026-04-21 07:27:07'),
(15, 3, 3, '2026-04-01', '2026-04-15', '2026-04-15', 'Dikembalikan', 0.00, '2026-04-21 07:27:07', '2026-04-21 07:27:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`),
  ADD UNIQUE KEY `kode_anggota` (`kode_anggota`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_penerbit` (`id_penerbit`);

--
-- Indexes for table `kategori_buku`
--
ALTER TABLE `kategori_buku`
  ADD PRIMARY KEY (`id_kategori`),
  ADD UNIQUE KEY `nama_kategori` (`nama_kategori`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id_penerbit`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `id_anggota` (`id_anggota`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `kategori_buku`
--
ALTER TABLE `kategori_buku`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id_penerbit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_buku` (`id_kategori`),
  ADD CONSTRAINT `buku_ibfk_2` FOREIGN KEY (`id_penerbit`) REFERENCES `penerbit` (`id_penerbit`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
