-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 25 Nov 2015 pada 12.58
-- Versi Server: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `tutorialweb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

DROP TABLE IF EXISTS `mahasiswa`;
CREATE TABLE `mahasiswa` (
  `nim` int(11) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `jurusan` varchar(30) NOT NULL,
  `semester` varchar(2) NOT NULL,
  `tahun_masuk` varchar(5) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `password`, `nama`, `tempat_lahir`, `tanggal_lahir`, `email`, `jenis_kelamin`, `agama`, `jurusan`, `semester`, `tahun_masuk`, `alamat`, `status`) VALUES
(101001, '1c76fee9418816ee07f81c9d3386f754', 'Fatoni Arif', 'Lamongan', '1999-05-15', 'pino@gmail.com', 'Laki-Laki', 'Islam', 'Teknik Informatika', '3', '2014', 'Lamongan', 1),
(101002, '66ec9e6680c63a892714f4880ecc1ec5', 'Mundzir Masruri', 'Lamongan', '1988-01-01', 'mundzir@gmail.com', 'Laki-Laki', 'Islam', 'Perikanan', '3', '2014', 'Lamongan', 2),
(101003, '43430f697dd40ba87ea732c26f1567d3', 'Abdul Ghofur', 'Gresik', '1990-04-15', 'abdul.g@yahoo.com', 'Laki-Laki', 'Islam', 'Teknik Sipil', '3', '2014', 'Lamongan', 1),
(101004, '3295487fd764c16d5b00d19ae3bc8d49', 'Susi Indrawati', 'Lamongan', '1990-11-20', 'susi.indra99@yahoo.co.id', 'Perempuan', 'Islam', 'Teknik Sipil', '3', '2014', 'Lamongan', 1),
(101005, '5eb066e7b2885403ae8e635624bd04a7', 'Wati Jayanti', 'Kalimantan', '1990-10-11', 'w.jayanti@gmail.com', 'Perempuan', 'Islam', 'Ekonomi', '3', '2014', 'Gresik', 2),
(101006, 'daaca03d6db28547ef318f9b40f48571', 'Arif Syamsudin', 'Lamongan', '1999-02-16', 'arif.syam90@gmail.com', 'Laki-Laki', 'Kristen', 'Ekonomi', '3', '2014', 'Lamongan', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `nim` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101007;