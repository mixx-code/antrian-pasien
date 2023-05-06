-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Bulan Mei 2023 pada 10.15
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `antrian_puskesmas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `antrian`
--

CREATE TABLE `antrian` (
  `id_antrian` int(11) NOT NULL,
  `poli` varchar(10) NOT NULL,
  `nik` varchar(18) NOT NULL,
  `no_antrian` varchar(11) NOT NULL,
  `tanggal_antrian` date NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `antrian`
--

INSERT INTO `antrian` (`id_antrian`, `poli`, `nik`, `no_antrian`, `tanggal_antrian`, `status`) VALUES
(56, 'PLGG', '0987654321098765', '1', '2023-05-06', 'proses'),
(57, 'PLGG', '9373728382978329', '2', '2023-05-06', 'tunggu'),
(62, 'PLUM', '3674030102021111', '15', '2023-05-06', 'proses'),
(63, 'PLUM', '3674030101750042', '1', '2023-05-06', 'tunggu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengunjung`
--

CREATE TABLE `pengunjung` (
  `id_pengunjung` int(11) NOT NULL,
  `nik` varchar(18) NOT NULL,
  `poli` varchar(10) NOT NULL,
  `tanggal_kunjungan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengunjung`
--

INSERT INTO `pengunjung` (`id_pengunjung`, `nik`, `poli`, `tanggal_kunjungan`) VALUES
(1, '3674030102021111', 'PLGG', '2023-05-06'),
(2, '3674030101750042', 'PLGG', '2023-05-06'),
(3, '0987654321098765', 'PLGG', '2023-05-06'),
(4, '3674030102021111', 'PLGG', '2023-05-06'),
(6, '3674030102021111', 'PLUM', '2023-05-06'),
(7, '3674030102021111', 'PLGG', '2023-05-06'),
(8, '3674030102021111', 'PLUM', '2023-05-06'),
(9, '3674030102021111', 'PLGG', '2023-05-06'),
(11, '3674030102021111', 'PLUM', '2023-05-06'),
(12, '3674030101750042', 'PLUM', '2023-05-06'),
(13, '3674030102021111', 'PLUM', '2023-05-06'),
(14, '3674030101750042', 'PLUM', '2023-05-06'),
(15, '3674030102021111', 'PLUM', '2023-05-07'),
(16, '3674030101750042', 'PLUM', '2023-05-06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `poli`
--

CREATE TABLE `poli` (
  `poli` varchar(10) NOT NULL,
  `nama_poli` varchar(20) NOT NULL,
  `jumlah_maksimal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `poli`
--

INSERT INTO `poli` (`poli`, `nama_poli`, `jumlah_maksimal`) VALUES
('PLAN', 'Poli Anak', 20),
('PLGG', 'Poli Gigi', 15),
('PLIM', 'Poli Imunisasi', 15),
('PLUM', 'Poli Umum', 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `nik` varchar(18) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`nik`, `nama`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `no_telp`, `username`, `password`, `role`) VALUES
('0987654321098765', 'yasmin coba lagi', 'perempuan', '2001-10-09', 'jauh', '089636475528', 'yasmin', 'yasmin', 'pasien'),
('3674030101750042', 'kucing cantik', 'laki-laki', '2023-05-11', 'jauh', '089636475524', 'kucing', 'kucing', 'pasien'),
('3674030102021111', 'rizki febriansyah', 'laki-laki', '2002-02-01', 'parigi lama', '089636475538', 'rizki', '$2y$10$w2uGM91o0oxm0f.VQk5U..gjjU./QMrksjDUWppUO8EoTAdwCTPlG', 'pasien'),
('3674030102028752', 'ayam', 'perempuan', '2023-05-19', 'kandang', '089636475521', 'ayam', '$2y$10$0r6/BFefh1nlhJHuGZM5beNVtvTrGh6YI/Ac3ZDGmeA5lQbQOlwY2', 'admin'),
('367403010203333', 'coba', 'perempuan', '2019-02-06', 'COBA', '089636471234', 'coba', '$2y$10$Q4oO2FeU3hbHqWjG130k5OF0xrLic82BaPhN4FThS.vU2Htrqk.D6', 'admin'),
('9373728382978329', 'Kiki', 'laki-laki', '2023-05-06', 'Tangerang ', '089636475521', 'kiki', '$2y$10$OujGKT49XxutyhvTu7FN0e5/mz2QyFDiciV4jZd7btR8HWQA98TIK', 'pasien');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id_antrian`),
  ADD KEY `poli` (`poli`),
  ADD KEY `nik` (`nik`);

--
-- Indeks untuk tabel `pengunjung`
--
ALTER TABLE `pengunjung`
  ADD PRIMARY KEY (`id_pengunjung`),
  ADD KEY `nik` (`nik`),
  ADD KEY `poli` (`poli`);

--
-- Indeks untuk tabel `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`poli`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`nik`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `antrian`
--
ALTER TABLE `antrian`
  MODIFY `id_antrian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT untuk tabel `pengunjung`
--
ALTER TABLE `pengunjung`
  MODIFY `id_pengunjung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `antrian`
--
ALTER TABLE `antrian`
  ADD CONSTRAINT `antrian_ibfk_1` FOREIGN KEY (`poli`) REFERENCES `poli` (`poli`),
  ADD CONSTRAINT `antrian_ibfk_2` FOREIGN KEY (`nik`) REFERENCES `user` (`nik`);

--
-- Ketidakleluasaan untuk tabel `pengunjung`
--
ALTER TABLE `pengunjung`
  ADD CONSTRAINT `pengunjung_ibfk_2` FOREIGN KEY (`nik`) REFERENCES `user` (`nik`),
  ADD CONSTRAINT `pengunjung_ibfk_3` FOREIGN KEY (`poli`) REFERENCES `poli` (`poli`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
