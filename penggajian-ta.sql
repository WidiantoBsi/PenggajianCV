-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Nov 2020 pada 14.04
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penggajian-ta`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `Id_Absen` char(15) NOT NULL DEFAULT '',
  `ID_Karyawan` varchar(50) DEFAULT NULL,
  `Jam_In` time DEFAULT NULL,
  `Jam_Out` time DEFAULT NULL,
  `Lembur` int(2) DEFAULT '0',
  `Bulan` date DEFAULT NULL,
  `Keterangan` enum('1','0') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`Id_Absen`, `ID_Karyawan`, `Jam_In`, `Jam_Out`, `Lembur`, `Bulan`, `Keterangan`) VALUES
('1112001', '022019001', '21:46:32', '14:19:20', 1, '2020-11-16', '1'),
('1112002', '022019002', '21:46:53', '14:19:40', 0, '2020-11-16', '1'),
('1112003', '082019003', '21:46:57', '14:20:41', 1, '2020-11-16', '1'),
('1116004', '102020005', '14:22:02', '14:23:25', 0, '2020-11-16', '1'),
('1116005', '102020004', '15:10:10', '15:10:51', 0, '2020-11-16', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `golongan`
--

CREATE TABLE `golongan` (
  `ID_Golongan` varchar(15) NOT NULL DEFAULT '',
  `Bagian` varchar(30) DEFAULT NULL,
  `Upah_Harian` int(16) DEFAULT '0',
  `Upah_Lembur` int(16) DEFAULT '0',
  `Bpjs` int(16) DEFAULT '0',
  `Insentive` int(16) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `golongan`
--

INSERT INTO `golongan` (`ID_Golongan`, `Bagian`, `Upah_Harian`, `Upah_Lembur`, `Bpjs`, `Insentive`) VALUES
('UP-001', 'Programer', 70000, 20000, 51000, 10000),
('UP-002', 'OP QC USB Otg', 55000, 15000, 25000, 5000),
('UP-003', 'OP USB 5C', 25000, 15000, 25000, 5000),
('UP-005', 'Pecking', 78000, 10000, 25500, 5000),
('UP-006', 'Admin', 80000, 25000, 25500, 15000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `ID_Karyawan` varchar(15) NOT NULL DEFAULT '',
  `Nama_Karyawan` varchar(50) DEFAULT NULL,
  `ID_Golongan` varchar(15) DEFAULT NULL,
  `Tgl_Lahir` date DEFAULT NULL,
  `Tgl_Masuk` varchar(30) DEFAULT NULL,
  `Alamat` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`ID_Karyawan`, `Nama_Karyawan`, `ID_Golongan`, `Tgl_Lahir`, `Tgl_Masuk`, `Alamat`) VALUES
('022019001', 'Widianto', 'UP-006', '1989-04-14', '02-August-2019', 'Mandosi Permai'),
('022019002', 'M. Haryadi Putra', 'UP-002', '1998-12-10', '02-August-2019', 'Tambun Cibitung'),
('082019003', 'Tomas Herianto', 'UP-003', '1990-08-13', '02-August-2019', 'Komsen Bekasi, Jatiasih'),
('102020004', 'M. Akbar Saputra', 'UP-005', '1982-11-10', '29-October-2020', 'Pekayon Bekasi'),
('102020005', 'Susanti', 'UP-006', '2020-10-30', '30-October-2020', 'Bogor');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penggajian`
--

CREATE TABLE `penggajian` (
  `ID_Gaji` varchar(15) NOT NULL DEFAULT '',
  `ID_Karyawan` varchar(15) DEFAULT NULL,
  `Total_Masuk` int(2) NOT NULL DEFAULT '0',
  `Total_Lembur` int(2) NOT NULL DEFAULT '0',
  `BPJS` varchar(15) DEFAULT NULL,
  `Snak` varchar(15) DEFAULT NULL,
  `Potongan` varchar(15) DEFAULT NULL,
  `Insentive` varchar(15) DEFAULT NULL,
  `SubTotalupah` int(25) DEFAULT NULL,
  `Tgl_Transaksi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penggajian`
--

INSERT INTO `penggajian` (`ID_Gaji`, `ID_Karyawan`, `Total_Masuk`, `Total_Lembur`, `BPJS`, `Snak`, `Potongan`, `Insentive`, `SubTotalupah`, `Tgl_Transaksi`) VALUES
('GJI-1908001', '022019001', 26, 5, '25000', '10000', '0', '5000', 1935000, '2019-08-02'),
('GJI-1908002', '022019002', 20, 5, '26000', '10000', '0', '0', 1286000, '2019-08-02'),
('GJI-1908003', '082019003', 26, 4, '26000', '5000', '0', '0', 1261000, '2019-08-02'),
('GJI-1908004', '082019003', 26, 5, '70000', '10000', '0', '0', 1325000, '2019-08-27'),
('GJI-1909005', '022019001', 21, 5, '51000', '5000', '0', '10000', 1636000, '2019-09-11'),
('GJI-1909006', '022019002', 20, 4, '25000', '5000', '0', '5000', 1195000, '2019-09-11'),
('GJI-2008007', '022019001', 28, 7, '25000', '15000', '0', '25000', 3800000, '2020-11-14'),
('GJI-2008008', '082019003', 27, 5, '25000', '10000', '0', '15000', 2800000, '2020-10-30'),
('GJI-2011009', '022019002', 1, 0, '25000', '20000', '0', '5000', 105000, '2020-11-16'),
('GJI-2011010', '082019003', 1, 1, '25000', '15000', '0', '5000', 85000, '2020-11-16'),
('GJI-2011011', '102020004', 1, 0, '25500', '12000', '0', '5000', 120500, '2020-11-16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `Id_User` varchar(25) NOT NULL,
  `ID_Grup` varchar(15) NOT NULL,
  `ID_Karyawan` varchar(50) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Status` enum('1','0') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`Id_User`, `ID_Grup`, `ID_Karyawan`, `Password`, `Status`) VALUES
('ADM-001', 'UP-006', '022019001', '$2y$10$p7jBVa1Ogy8ENOecFp9VYunMdLx4OJUt.uk03RNZ8OL12TqjSMVwa', '0'),
('ADM-002', 'UP-006', '102020005', '$2y$10$c51lgZraG4wulBxZLcN0te9AlSeXSzDYzFB1mHoZYMGLwV5Tk4P3O', '1');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`Id_Absen`),
  ADD KEY `ID_Karyawan` (`ID_Karyawan`);

--
-- Indeks untuk tabel `golongan`
--
ALTER TABLE `golongan`
  ADD PRIMARY KEY (`ID_Golongan`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`ID_Karyawan`),
  ADD KEY `ID_Golongan` (`ID_Golongan`);

--
-- Indeks untuk tabel `penggajian`
--
ALTER TABLE `penggajian`
  ADD PRIMARY KEY (`ID_Gaji`),
  ADD KEY `ID_Karyawan` (`ID_Karyawan`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id_User`),
  ADD KEY `ID_Grup` (`ID_Grup`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `FK_absensi_karyawan` FOREIGN KEY (`ID_Karyawan`) REFERENCES `karyawan` (`ID_Karyawan`);

--
-- Ketidakleluasaan untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `FK_karyawan_golongan` FOREIGN KEY (`ID_Golongan`) REFERENCES `golongan` (`ID_Golongan`);

--
-- Ketidakleluasaan untuk tabel `penggajian`
--
ALTER TABLE `penggajian`
  ADD CONSTRAINT `FK_penggajian_karyawan` FOREIGN KEY (`ID_Karyawan`) REFERENCES `karyawan` (`ID_Karyawan`);

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_user_golongan` FOREIGN KEY (`ID_Grup`) REFERENCES `golongan` (`ID_Golongan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
