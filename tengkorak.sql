-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 06 Okt 2018 pada 23.36
-- Versi server: 10.1.30-MariaDB
-- Versi PHP: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tengkorak`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kehadiran`
--

CREATE TABLE `kehadiran` (
  `id` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kehadiran`
--

INSERT INTO `kehadiran` (`id`, `id_peserta`, `waktu`) VALUES
(1, 1, '2018-10-06 22:22:39'),
(2, 1, '2018-10-06 22:22:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peserta`
--

CREATE TABLE `peserta` (
  `id` int(11) NOT NULL,
  `nama` text,
  `deskripsi` text,
  `jumlah_undangan` int(11) DEFAULT NULL,
  `jumlah_hadir` int(11) DEFAULT NULL,
  `status` smallint(6) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `peserta`
--

INSERT INTO `peserta` (`id`, `nama`, `deskripsi`, `jumlah_undangan`, `jumlah_hadir`, `status`) VALUES
(1, 'NET TV - Rikha', 'Media', 5, 0, 0),
(2, 'Yan Widjaya', 'Wong Film (Lewat Yan Widjaya)', 1, 0, 0),
(3, 'Shandy Gasella', 'Wong Film (Lewat Yan Widjaya)', 1, 0, 0),
(4, 'Shandy Gasella', 'Wong Film (Lewat Yan Widjaya)', 1, 0, 0),
(5, 'Ipik Tanoyo', 'Wong Film (Lewat Yan Widjaya)', 1, 0, 0),
(6, 'Dedi', 'Wong Film (Lewat Yan Widjaya)', 1, 0, 0),
(7, 'Ronny P Tjandra', 'Wong Film (Lewat Yan Widjaya)', 1, 0, 0),
(8, 'Ronny P Tjandra', 'Wong Film (Lewat Yan Widjaya)', 1, 0, 0),
(9, 'Arul', 'Wong Film (Lewat Yan Widjaya)', 1, 0, 0),
(10, 'Anggy Umbara', 'Wong Film (Lewat Yan Widjaya)', 1, 0, 0),
(11, 'Anggy Umbara', 'Wong Film (Lewat Yan Widjaya)', 1, 0, 0),
(12, 'Fajar Umbara', 'Wong Film (Lewat Yan Widjaya)', 1, 0, 0),
(13, 'Rara Ais', 'Wong Film (Lewat Yan Widjaya)', 1, 0, 0),
(14, 'Boy Rano', 'Wong Film (Lewat Yan Widjaya)', 1, 0, 0),
(15, 'Putri Ayudya', 'Wong Film (Lewat Yan Widjaya)', 1, 0, 0),
(16, 'Putri Ayudya', 'Wong Film (Lewat Yan Widjaya)', 1, 0, 0),
(17, 'Putri Ayudya', 'Wong Film (Lewat Yan Widjaya)', 1, 0, 0),
(18, 'Salim Said', 'Wong Film (Lewat Yan Widjaya)', 1, 0, 0),
(19, 'Salim Said', 'Wong Film (Lewat Yan Widjaya)', 1, 0, 0),
(20, 'Bobby Batara', 'Wong Film (Lewat Yan Widjaya)', 1, 0, 0),
(21, 'Ekky Imanjaya', 'Wong Film (Lewat Yan Widjaya)', 1, 0, 0),
(22, 'John De Rantau', 'Wong Film (Lewat Yan Widjaya)', 1, 0, 0),
(23, 'Herita', 'Wong Film (Lewat Yan Widjaya)', 1, 0, 0),
(24, 'Jujur Prananto', 'Yusron', 2, 0, 0),
(25, 'Haydar Salish', 'Yusron', 3, 0, 0),
(26, 'Angga Dwimas Sasongko', 'Yusron', 2, 0, 0),
(27, 'Joko Anwar', 'Yusron', 4, 0, 0),
(28, 'Alit', 'Yan Widjaya', 1, 0, 0),
(29, 'Bobby Batara', 'Yan Widjaya', 1, 0, 0),
(30, 'Subagiyo', 'Yan Widjaya', 1, 0, 0),
(31, 'Santi Muliani', 'Yan Widjaya', 1, 0, 0),
(32, 'Herman Wijaya', 'Yan Widjaya', 1, 0, 0),
(33, 'Ipik Tanoyo', 'Yan Widjaya', 1, 0, 0),
(34, 'Chris', 'Yan Widjaya', 1, 0, 0),
(35, 'Puput Lestari', 'Yan Widjaya', 1, 0, 0),
(36, 'Yulia', 'Yan Widjaya', 1, 0, 0),
(37, 'Wayan Diananto', 'Yan Widjaya', 1, 0, 0),
(38, 'Ramdha', 'Yan Widjaya', 1, 0, 0),
(39, 'Wempy', 'Yan Widjaya', 1, 0, 0),
(40, 'Rita Srihastuti', 'Yan Widjaya', 1, 0, 0),
(41, 'Budi', 'Yan Widjaya', 1, 0, 0),
(42, 'Ibrahim Syakroni', 'Yan Widjaya', 1, 0, 0),
(43, 'Icha', 'Yan Widjaya', 1, 0, 0),
(44, 'Shandy Gassela', 'Yan Widjaya', 1, 0, 0),
(45, 'Doddy Handoko', 'Yan Widjaya', 1, 0, 0),
(46, 'Desman', 'Yan Widjaya', 1, 0, 0),
(47, 'Musa', 'Yan Widjaya', 1, 0, 0),
(48, 'Ocha', 'Yan Widjaya', 1, 0, 0),
(49, 'Dewi', 'Yan Widjaya', 1, 0, 0),
(50, 'Rosihan', 'Yan Widjaya', 1, 0, 0),
(51, 'Adrian', 'Yan Widjaya', 1, 0, 0),
(52, 'Kicky Herlambang', 'Yan Widjaya', 1, 0, 0),
(53, 'Romi Syahril', 'Yan Widjaya', 1, 0, 0),
(54, 'Yanti', 'Yan Widjaya', 1, 0, 0),
(55, 'Nano', 'Yan Widjaya', 1, 0, 0),
(56, 'Amazon', 'Yan Widjaya', 1, 0, 0),
(57, 'Yan', 'Yan Widjaya', 1, 0, 0),
(58, 'Adil', 'Yan Widjaya', 1, 0, 0),
(59, 'Dilan', 'Yan Widjaya', 1, 0, 0),
(60, 'Glenn', 'Yan Widjaya', 1, 0, 0),
(61, 'Imam', 'Yan Widjaya', 1, 0, 0),
(62, 'Tumpak', 'Yan Widjaya', 1, 0, 0),
(63, 'Arul', 'Yan Widjaya', 1, 0, 0),
(64, 'Abbas', 'Yan Widjaya', 1, 0, 0),
(65, 'Nurie', 'Yan Widjaya', 1, 0, 0),
(66, 'Chaidir', 'Yan Widjaya', 1, 0, 0),
(67, 'Hilmi', 'Yan Widjaya', 1, 0, 0),
(68, 'Irfan', 'Yan Widjaya', 1, 0, 0),
(69, 'Yazid', 'Yan Widjaya', 1, 0, 0),
(70, 'Ebi', 'Yan Widjaya', 1, 0, 0),
(71, 'Fafa', 'Yan Widjaya', 1, 0, 0),
(72, 'Adit', 'Yan Widjaya', 1, 0, 0),
(73, 'Retno', 'Yan Widjaya', 1, 0, 0),
(74, 'Maulana', 'Yan Widjaya', 1, 0, 0),
(75, ' Ahmad Sekhu', 'Yan Widjaya', 1, 0, 0),
(76, 'Udin', 'Yan Widjaya', 1, 0, 0),
(77, 'Ade ', 'Yan Widjaya', 1, 0, 0),
(78, 'Syukri', 'Yan Widjaya', 1, 0, 0),
(79, 'Sarah', 'Yan Widjaya', 1, 0, 0),
(80, 'Irfan Muhamad', 'Yan Widjaya', 1, 0, 0),
(81, 'Galuh', 'Yan Widjaya', 1, 0, 0),
(82, 'Didang', 'Yan Widjaya', 1, 0, 0),
(83, 'Ali Nurdin', 'Yan Widjaya', 1, 0, 0),
(84, 'Fikri', 'Yan Widjaya', 1, 0, 0),
(85, 'Wina Armada', 'Yan Widjaya', 1, 0, 0),
(86, 'Merry Apriyani', 'Yan Widjaya', 1, 0, 0),
(87, 'Shelby', 'Yan Widjaya', 1, 0, 0),
(88, 'Adjie', 'Yan Widjaya', 1, 0, 0),
(89, 'Novil', 'Yan Widjaya', 1, 0, 0),
(90, 'DedhyHaryadi', 'Yan Widjaya', 1, 0, 0),
(91, 'Ita', 'Yan Widjaya', 1, 0, 0),
(92, 'Thomas', 'Yan Widjaya', 1, 0, 0),
(93, 'Aris Muda', 'Yan Widjaya', 1, 0, 0),
(94, 'Dudung', 'Yan Widjaya', 1, 0, 0),
(95, 'Amoy', 'Yan Widjaya', 1, 0, 0),
(96, 'Benny ', 'Yan Widjaya', 1, 0, 0),
(97, 'Dina', 'Yan Widjaya', 1, 0, 0),
(98, 'Putra', 'Yan Widjaya', 1, 0, 0),
(99, 'Ammy', 'Yan Widjaya', 1, 0, 0),
(100, 'Moyang', 'Yan Widjaya', 1, 0, 0),
(101, 'Martha', 'Yan Widjaya', 1, 0, 0),
(102, 'Suryati', 'Yan Widjaya', 1, 0, 0),
(103, 'Edo', 'Yan Widjaya', 1, 0, 0),
(104, 'Maria', 'Yan Widjaya', 1, 0, 0),
(105, 'Erie', 'Yan Widjaya', 1, 0, 0),
(106, 'Dewi', 'Yan Widjaya', 1, 0, 0),
(107, 'Nur Ichsan', 'Yan Widjaya', 1, 0, 0),
(108, 'Ade Irwansyah', 'Yan Widjaya', 1, 0, 0),
(109, 'Trisno', 'Yan Widjaya', 1, 0, 0),
(110, 'Heryus Saputro', 'Yan Widjaya', 1, 0, 0),
(111, 'Dudut', 'Yan Widjaya', 1, 0, 0),
(112, 'William', 'Yan Widjaya', 1, 0, 0),
(113, 'Syarah', 'Yan Widjaya', 1, 0, 0),
(114, 'Adis', 'Yan Widjaya', 1, 0, 0),
(115, 'Emi', 'Yan Widjaya', 1, 0, 0),
(116, 'Citra', 'Yan Widjaya', 1, 0, 0),
(117, 'Agus ', 'Yan Widjaya', 1, 0, 0),
(118, 'Geanca Lesmana', 'Yan Widjaya', 1, 0, 0),
(119, 'Reza', 'Yan Widjaya', 1, 0, 0),
(120, 'Lina', 'Yan Widjaya', 1, 0, 0),
(121, 'Mega', 'Yan Widjaya', 1, 0, 0),
(122, 'Meliza', 'Yan Widjaya', 1, 0, 0),
(123, 'Windu', 'Yan Widjaya', 1, 0, 0),
(124, 'Ichsan', 'Yan Widjaya', 1, 0, 0),
(125, 'Muchlis', 'Yan Widjaya', 1, 0, 0),
(126, 'Wuri', 'Yan Widjaya', 1, 0, 0),
(127, 'Eka Nusa Pertiwi', 'Eka Nusa Pertiwi', 1, 0, 0),
(128, 'Kedung Darma Romansha', 'Eka Nusa Pertiwi', 1, 0, 0),
(129, 'Eka Nusa Pertiwi', 'Eka Nusa Pertiwi', 6, 0, 0),
(130, 'Muhammad Rijal', 'ikhsan', 1, 0, 0),
(131, 'Pak Wikan', 'Ajik', 10, 0, 0),
(132, 'GiveAway NET', 'Ajik', 10, 0, 0),
(133, 'Robbert Ronny', 'Yusron', 1, 0, 0),
(134, 'Robbert Ronny', 'Yusron', 1, 0, 0),
(135, 'Giras Basuwondo', '', 1, 0, 0),
(136, 'Giras Basuwondo', '', 1, 0, 0),
(137, 'Rizky Ardi Nugroho', '', 1, 0, 0),
(138, 'Rizky Ardi Nugroho', '', 1, 0, 0),
(139, 'Proff Eddy', '', 1, 0, 0),
(140, 'Proff Eddy', '', 1, 0, 0),
(141, 'Proff Eddy', '', 1, 0, 0),
(142, 'Proff Eddy', '', 1, 0, 0),
(143, 'Proff Eddy', '', 1, 0, 0),
(144, 'Erick Firdaus Twitter', '', 1, 0, 0),
(145, 'Ardian OY', '', 1, 0, 0),
(146, 'Isna Suhendar OY', '', 1, 0, 0),
(147, 'Garin Nugroho', 'Abu', 1, 0, 0),
(148, 'Kamila Andini', 'Abu', 1, 0, 0),
(149, 'Adinda Fudia', 'Abu', 1, 0, 0),
(150, 'Orizon Astonia', 'Abu', 1, 0, 0),
(151, 'Orizon Astonia', 'Abu', 1, 0, 0),
(152, 'Andrie Sasono', 'Abu', 2, 0, 0),
(153, 'Andri Cung', 'Abu', 1, 0, 0),
(154, 'Gesata Stella', 'Abu', 1, 0, 0),
(155, 'Paul Agusta', 'Abu', 1, 0, 0),
(156, 'Dimas Jayasrana', 'Abu', 1, 0, 0),
(157, 'Adrian Jonathan Pasaribu', 'Abu', 1, 0, 0),
(158, 'Agung Sentausa', 'Abu', 1, 0, 0),
(159, 'Adstar Media', 'Ajik', 4, 0, 0),
(160, 'Robby Ertanto Soediskam', 'Abu', 1, 0, 0),
(161, 'Wulan Guritno', 'Abu', 1, 0, 0),
(162, 'Adilla Dimitri Hardjanto', 'Abu', 1, 0, 0),
(163, 'Khairan Aldhy', 'Abu', 1, 0, 0),
(164, 'Wisnu Kucing', 'Abu', 1, 0, 0),
(165, 'Daniel Rudi', 'Abu', 1, 0, 0),
(166, 'Panji Mukadis', 'Kamil', 1, 0, 0),
(167, 'Wregas Bhanuteja', 'Abu', 1, 0, 0),
(168, 'Sarah Adilah', 'Abu', 2, 0, 0),
(169, 'Kelas Pagi', 'Abu', 2, 0, 0),
(170, 'Dennis Adishwara', 'Abu', 2, 0, 0),
(171, 'Viddsee Indonesia', 'Abu', 2, 0, 0),
(172, 'Spektakel.ID', 'Abu', 2, 0, 0),
(173, 'Darwin Nugraha', 'Abu', 2, 0, 0),
(174, 'Peggy Misnan', 'Abu', 1, 0, 0),
(175, 'Hanan Cinthya', 'Abu', 1, 0, 0),
(176, 'Yosep Anggie Noen', 'Abu', 1, 0, 0),
(177, 'Sofia Setyorini', 'Abu', 1, 0, 0),
(178, 'In-Docs', 'Abu', 2, 0, 0),
(179, 'Jurnal Ruang', 'Abu', 2, 0, 0),
(180, 'UI Film Festival ', 'Abu', 2, 0, 0),
(181, 'Studio Antelope', 'Abu', 2, 0, 0),
(182, 'Jason Iskandar', 'Abu', 2, 0, 0),
(183, 'Sarah RD', 'Abu', 2, 0, 0),
(184, 'Efi SH', 'Abu', 2, 0, 0),
(185, 'Fourcolours', 'Abu', 2, 0, 0),
(186, 'LifeLike Picture', 'Abu', 2, 0, 0),
(187, 'Koriadyaning', 'Abu', 2, 0, 0),
(188, 'Melati NF', 'Abu', 2, 0, 0),
(189, 'Fania Ayuning', 'Abu', 1, 0, 0),
(190, 'Hanna Humaira', 'Abu', 1, 0, 0),
(191, 'Windu Jusuf', 'Abu', 1, 0, 0),
(192, 'Kinesaurus', 'Abu', 2, 0, 0),
(193, 'Hanung Bramantyo', 'Abu', 1, 0, 0),
(194, 'sing undan', 'Yusron', 1, 0, 0),
(195, 'Darwis Triadi 2', 'Yusron', 1, 0, 0),
(196, ' Anggun Priambodo', 'Abu', 1, 0, 0),
(197, 'Soni Sumarsono', 'Pak Gambul', 1, 0, 0),
(198, 'Chandra Bakti', 'Pak Gambul', 1, 0, 0),
(199, 'Mudzakir', 'Pak Gambul', 1, 0, 0),
(200, 'Niken W', 'Pak Gambul', 1, 0, 0),
(201, 'Dwi Hermuningsih', 'Pak Gambul', 1, 0, 0),
(202, 'Aria Bima', 'Pak Gambul', 1, 0, 0),
(203, 'Hanafi Rais', 'Pak Gambul', 1, 0, 0),
(204, 'Marlinda', 'Pak Gambul', 1, 0, 0),
(205, 'Agus Susanto', 'Pak Gambul', 1, 0, 0),
(206, 'Pupung Agustanto', 'Pak Gambul', 1, 0, 0),
(207, 'Adita Irawati', 'Pak Gambul', 1, 0, 0),
(208, 'Nicolaius Teguh Budi Harjanto', 'Pak Gambul', 1, 0, 0),
(209, 'Iwan Kurniawan', 'Pak Gambul', 1, 0, 0),
(210, 'Nezar Patria', 'Pak Gambul', 1, 0, 0),
(211, 'Yudi Ahmad Tajudin', 'Pak Gambul', 1, 0, 0),
(212, 'Hasanudin Abdurakhman', 'Pak Gambul', 1, 0, 0),
(213, 'Wicaksono', 'Pak Gambul', 1, 0, 0),
(214, 'Nukman Luthfie', 'Pak Gambul', 1, 0, 0),
(215, 'Aji Iqbal Daryono', 'Pak Gambul', 1, 0, 0),
(216, 'Semen indonesia', 'Pak Gambul', 10, 0, 0),
(217, 'Suryani', 'Kamil', 1, 0, 0),
(218, 'Teppy', 'Ikhsan', 1, 0, 0),
(219, 'Teppy', 'Ikhsan', 1, 0, 0),
(220, 'Joni Supriyanto', 'Yusron', 5, 0, 0),
(221, 'Ridho Illahi', 'Yusron', 2, 0, 0),
(222, 'test', 'test', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kehadiran_peserta` (`id_peserta`);

--
-- Indeks untuk tabel `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kehadiran`
--
ALTER TABLE `kehadiran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD CONSTRAINT `fk_kehadiran_peserta` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
