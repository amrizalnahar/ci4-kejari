-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Feb 2023 pada 04.48
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
-- Database: `kejari`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_beranda`
--

CREATE TABLE `tb_beranda` (
  `id_beranda` int(12) NOT NULL,
  `judul_beranda` varchar(211) NOT NULL,
  `isi_beranda` varchar(211) NOT NULL,
  `gambar_beranda` varchar(211) NOT NULL,
  `slug_beranda` varchar(211) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_beranda`
--

INSERT INTO `tb_beranda` (`id_beranda`, `judul_beranda`, `isi_beranda`, `gambar_beranda`, `slug_beranda`, `created_at`, `updated_at`) VALUES
(1, 'Judul Pertama Kedua Ketiga', '<h2>Heheheh</h2><blockquote><p>HEHEHEH</p><p>UHuyyyy</p></blockquote>', '', 'judul-pertama-kedua-ketiga', '2023-02-22 03:33:31', '2023-02-22 03:44:41'),
(2, 'Judul dua tiga empat', '<h3>Judul tiga wehehehehe</h3><blockquote><p>Belajar sedikit demi sedikit, tetapi rutin. Penelitian membuktikan bahwa siswa yang rutin belajar setiap hari lebih mungkin mencapai sasarannya. Luangkan waktu untuk<', '', 'judul-dua-tiga-empat', '2023-02-22 03:38:26', '2023-02-22 03:44:24');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_beranda`
--
ALTER TABLE `tb_beranda`
  ADD PRIMARY KEY (`id_beranda`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_beranda`
--
ALTER TABLE `tb_beranda`
  MODIFY `id_beranda` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
