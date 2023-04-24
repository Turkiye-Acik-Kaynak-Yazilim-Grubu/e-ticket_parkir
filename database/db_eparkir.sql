-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Mar 2023 pada 14.26
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_eparkir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_jenis_kendaraan`
--

CREATE TABLE `t_jenis_kendaraan` (
  `id_jenis` int(11) NOT NULL,
  `jenis_kendaraan` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_jenis_kendaraan`
--

INSERT INTO `t_jenis_kendaraan` (`id_jenis`, `jenis_kendaraan`) VALUES
(0, 'Tidak Diketahui'),
(1, 'Motor'),
(2, 'Mobil'),
(5, 'Bus');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_kendaraan`
--

CREATE TABLE `t_kendaraan` (
  `id_kendaraan` int(11) NOT NULL,
  `id_jenis_kendaraan` int(11) NOT NULL,
  `merk` varchar(128) NOT NULL,
  `plat_nomor` varchar(128) NOT NULL,
  `qrcode` varchar(128) NOT NULL,
  `nilai_qr` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_kendaraan`
--

INSERT INTO `t_kendaraan` (`id_kendaraan`, `id_jenis_kendaraan`, `merk`, `plat_nomor`, `qrcode`, `nilai_qr`, `id`) VALUES
(16, 2, 'Mercedes', 'A 1435 B', '6e44e06bc9ed1a3dea8d8a08ccc8ced0.png', '6e44e06bc9ed1a3dea8d8a08ccc8ced0', 7),
(17, 1, 'Scoopy', 'E 4289 WB', 'E 4289 WB.png', 'E 4289 WB', 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_parkir`
--

CREATE TABLE `t_parkir` (
  `id_parkir` int(11) NOT NULL,
  `tgl_parkir` date NOT NULL,
  `id_kendaraan` int(11) NOT NULL,
  `waktu_masuk` datetime NOT NULL,
  `waktu_keluar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_parkir`
--

INSERT INTO `t_parkir` (`id_parkir`, `tgl_parkir`, `id_kendaraan`, `waktu_masuk`, `waktu_keluar`) VALUES
(11, '2021-01-06', 10, '2021-01-06 15:15:40', '0000-00-00 00:00:00'),
(12, '2021-01-06', 13, '2021-01-06 15:15:57', '0000-00-00 00:00:00'),
(17, '2021-03-15', 16, '2021-03-15 21:58:43', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_user`
--

CREATE TABLE `t_user` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `title` varchar(50) NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `alamat` varchar(250) DEFAULT NULL,
  `image` varchar(128) NOT NULL,
  `lvl` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_user`
--

INSERT INTO `t_user` (`id`, `username`, `password`, `title`, `email`, `alamat`, `image`, `lvl`) VALUES
(7, '17.14.1.0055', '$2y$10$23yRjl/0Bo7bV.KD23kD6ubt53vTV8TL34N3j81Vv1z15v1HMJaM6', 'YULIA KRISNAWATHI DEWI', 'yuliadk55@gmail.com', 'Blok saptu - Kulur', 'avatar.png', 1),
(9, '18.14.1.0014', '$2y$10$DHF3gvK6rUnyigXMltXOxuCoiVr/Z713HZ36v/TRAmsSCX8AlQjlG', 'IRNA SRI NULINGGA', 'irnasri838@gmail.com', 'Blok selasa dusun dalem - WERAGATI', 'user.png', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `t_jenis_kendaraan`
--
ALTER TABLE `t_jenis_kendaraan`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `t_kendaraan`
--
ALTER TABLE `t_kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`);

--
-- Indeks untuk tabel `t_parkir`
--
ALTER TABLE `t_parkir`
  ADD PRIMARY KEY (`id_parkir`);

--
-- Indeks untuk tabel `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `t_jenis_kendaraan`
--
ALTER TABLE `t_jenis_kendaraan`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `t_kendaraan`
--
ALTER TABLE `t_kendaraan`
  MODIFY `id_kendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `t_parkir`
--
ALTER TABLE `t_parkir`
  MODIFY `id_parkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
