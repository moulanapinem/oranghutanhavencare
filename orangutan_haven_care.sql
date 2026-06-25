-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Jun 2026 pada 12.54
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orangutan_haven_care`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `donasi`
--

CREATE TABLE `donasi` (
  `id_donasi` int(11) NOT NULL,
  `nama_donatur` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `no_ewallet` varchar(20) DEFAULT NULL,
  `no_rekening` varchar(30) DEFAULT NULL,
  `nominal` decimal(12,2) NOT NULL,
  `metode_pembayaran` varchar(50) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `status` enum('pending','lunas','ditolak') DEFAULT 'pending',
  `tanggal_donasi` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `donasi`
--

INSERT INTO `donasi` (`id_donasi`, `nama_donatur`, `email`, `no_hp`, `no_ewallet`, `no_rekening`, `nominal`, `metode_pembayaran`, `pesan`, `bukti_bayar`, `status`, `tanggal_donasi`) VALUES
(3, 'yulia imup', 'moulanapinem@gmail.com', '085832903101', '085832903101', '', 1000000.00, 'DANA', '', NULL, 'lunas', '2026-06-10 11:26:26'),
(4, 'moulana', 'moulanapinem@gmail.com', '085832903101', '085832903101', '', 50000.00, 'DANA', '', NULL, 'lunas', '2026-06-10 11:41:12'),
(5, 'moulana', 'moulanapinem@gmail.com', '085832903101', '', '', 1000000.00, 'QRIS', 'semangatya ', NULL, 'lunas', '2026-06-19 10:48:20'),
(6, 'yulia imup', 'moulanapinem@gmail.com', '085832903101', '085832903101', '', 1000000.00, 'DANA', '', NULL, 'lunas', '2026-06-19 10:49:26'),
(7, 'moulana', 'moulanapinem@gmail.com', '085832903101', '', '1234432432', 1000000.00, 'Transfer Bank', '', NULL, 'lunas', '2026-06-19 10:50:31'),
(8, 'yulia imup', 'moulanapinem@gmail.com', '085832903101', '', '1234432432', 50000.00, 'Transfer Bank', '', NULL, 'lunas', '2026-06-19 11:06:35'),
(9, 'yulia imup', 'moulanapinem@gmail.com', '085832903101', '', '1234432432', 250000.00, 'Transfer Bank', '', NULL, 'lunas', '2026-06-19 11:11:03'),
(10, 'yulia imup', 'moulanapinem@gmail.com', '085832903101', '', '1234432432', 250000.00, 'Transfer Bank', '', NULL, 'lunas', '2026-06-19 11:12:18'),
(11, 'yulia imup', 'moulanapinem@gmail.com', '085832903101', '', '1234432432', 100000.00, 'Transfer Bank', '', NULL, 'lunas', '2026-06-19 11:12:50'),
(12, 'moulana', 'moulanapinem@gmail.com', '', '', '1234432432', 250000.00, 'Transfer Bank', '', NULL, 'lunas', '2026-06-19 11:14:12'),
(13, 'moulana', 'moulanapinem@gmail.com', '085832903101', '085832903101', '', 250000.00, 'DANA', '', NULL, 'lunas', '2026-06-21 04:22:47'),
(14, 'alprian', 'moulanapinem@gmail.com', '085832903101', '', '1234432432', 250000.00, 'Transfer Bank', '', 'bukti_6a3768d173aa6.png', 'lunas', '2026-06-21 04:30:09'),
(15, 'tanpa nama', '', '', '', '1234432432', 50000.00, 'Transfer Bank', '', '', 'lunas', '2026-06-22 20:19:01'),
(16, 'ewe', '', '', '', '', 250000.00, 'Transfer Bank', '', '', 'lunas', '2026-06-22 20:22:41'),
(17, 'yulia imup', 'moulanapinem@gmail.com', '085832903101', '', '', 250000.00, 'QRIS', '', '', 'lunas', '2026-06-24 10:49:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orangutan`
--

CREATE TABLE `orangutan` (
  `id_orangutan` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `umur` int(11) DEFAULT NULL,
  `tahun_ditemukan` year(4) DEFAULT NULL,
  `jenis_kelamin` enum('Jantan','Betina') NOT NULL,
  `status` varchar(100) DEFAULT NULL,
  `kondisi` text DEFAULT NULL,
  `cerita` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `tanggal_input` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `orangutan`
--

INSERT INTO `orangutan` (`id_orangutan`, `nama`, `umur`, `tahun_ditemukan`, `jenis_kelamin`, `status`, `kondisi`, `cerita`, `foto`, `tanggal_input`) VALUES
(4, 'KRISMON', 30, NULL, 'Jantan', 'Tidak Dapat Dilepasliarkan', 'Trauma dan kelemahan fisik akibat hidup 19 tahun di kandang sempit.', 'Krismon diselamatkan pada 30 Mei 2016 setelah dipelihara secara ilegal selama kurang lebih 19 tahun di dalam kandang besi yang sangat sempit. Namanya berasal dari istilah Krisis Moneter yang terjadi pada tahun 1997 di Indonesia.\r\n\r\nAkibat hidup terlalu lama di ruang terbatas, Krismon mengalami trauma serta kelemahan fisik dan mental yang cukup serius sehingga tidak memungkinkan untuk dilepasliarkan kembali ke alam liar.\r\n\r\nSejak berada di Orangutan Haven, Krismon menjalani latihan dan fisioterapi bersama para perawatnya. Dengan latihan rutin dan perawatan yang berkelanjutan, kondisi fisiknya terus membaik.\r\n\r\nSaat ini Krismon mulai terbiasa berada di luar ruangan, memanjat tali dan menara yang tersedia di Orangutan Haven, serta menunjukkan perkembangan dan kepercayaan diri yang semakin baik setiap harinya.', 'Cuplikan layar 2026-06-04 151108.png', '2026-06-04 07:54:47'),
(5, 'LEUSER', 27, NULL, 'Jantan', 'Tidak Dapat Dilepasliarkan', 'Buta total akibat luka tembak dan membutuhkan perawatan jangka panjang.', 'Leuser diselamatkan pada 20 Februari 2004 ketika masih berusia sekitar 5 tahun karena sebelumnya dipelihara secara ilegal. Setelah menjalani perawatan, ia sempat dilepasliarkan ke Taman Nasional Bukit Tigapuluh, Jambi.\r\n\r\nLeuser sempat hidup dengan baik di hutan selama beberapa tahun. Namun suatu hari ia masuk ke area pertanian warga dan ditembak sebanyak 62 kali. Akibat kejadian tersebut, Leuser mengalami kebutaan total sehingga tidak mampu lagi mencari makan dan bertahan hidup di alam liar.\r\n\r\nKarena kondisinya, Leuser kembali mendapatkan perawatan jangka panjang. Ia menjadi orangutan pertama yang diberi kesempatan keluar ke salah satu pulau di Orangutan Haven. Pada awalnya, ia sangat menikmati kebebasan tersebut sampai tidak kembali ke rumahnya selama 6 minggu.\r\n\r\nSaat ini Leuser menjalani kehidupan baru yang lebih aman dan damai. Ia menikmati aktivitas memanjat tali dan kayu di pulau tempat tinggalnya, serta merespons panggilan perawat ketika waktu makan tiba.', 'Leuser1-scaled.jpeg', '2026-06-04 09:08:17'),
(6, 'FAHZREN', 28, NULL, 'Jantan', 'Tidak Dapat Dilepasliarkan', 'Sudah dewasa dan terlalu terbiasa berinteraksi dengan manusia.', 'Fahzren diperkirakan lahir pada tahun 1998 dan dipulangkan kembali ke Indonesia pada 9 Oktober 2013 setelah sebelumnya diselundupkan secara ilegal ke Malaysia saat masih bayi.\r\n\r\nSelama berada di Malaysia, Fahzren digunakan dalam berbagai pertunjukan hewan yang melibatkan aktivitas seperti bersepeda, bermain golf, dan atraksi lainnya. Sesuai dengan peraturan perdagangan satwa internasional, Fahzren akhirnya dipulangkan ke negara asalnya, Indonesia.\r\n\r\nKarena saat kembali ke Indonesia Fahzren sudah menjadi orangutan jantan dewasa yang besar dan sangat terbiasa berinteraksi dengan manusia, para ahli menilai bahwa ia tidak akan mampu beradaptasi kembali untuk hidup mandiri di alam liar. Selain itu, interaksi yang terlalu dekat dengan manusia berpotensi membahayakan jika ia bertemu masyarakat di hutan.\r\n\r\nSaat ini Fahzren tinggal di Orangutan Haven sebagai penghuni permanen. Ia dikenal sebagai orangutan yang cerdas dan memiliki rasa ingin tahu yang tinggi. Karena pengalamannya di masa lalu, Fahzren sering membongkar atau merusak beberapa vegetasi dan fasilitas di pulau tempat tinggalnya. Ia juga suka menunjukkan dominasinya agar orang lain mengetahui bahwa dirinya adalah \"bos\". Namun sejak tinggal di Orangutan Haven, Fahzren menjadi jauh lebih tenang, santai, dan nyaman dibandingkan sebelumnya.', 'images (1).jpg', '2026-06-04 09:10:16'),
(7, 'DINA', 11, NULL, 'Betina', 'Tidak Dapat Dilepasliarkan', 'Hampir buta total akibat infeksi otak yang disebabkan oleh malaria saat masih bayi.', 'Dina adalah orangutan betina yang diperkirakan lahir pada tahun 2015 dan diselamatkan pada 27 Juli 2016 dari perdagangan satwa liar ilegal ketika usianya masih kurang dari satu tahun.\r\n\r\nSetelah tiba di pusat rehabilitasi, Dina didiagnosis menderita malaria yang menyebabkan infeksi pada otaknya. Kondisi tersebut membuat tubuhnya hampir lumpuh total dari leher ke bawah dan memerlukan perawatan intensif dalam waktu yang lama.\r\n\r\nBerkat perawatan medis dan perhatian yang intensif selama berbulan-bulan, Dina berhasil mendapatkan kembali seluruh kemampuan geraknya. Saat ini ia tidak lagi menunjukkan tanda-tanda kelumpuhan fisik. Namun, penglihatannya tidak pernah pulih sepenuhnya dan ia tetap mengalami kebutaan hampir total.\r\n\r\nSelama bertahun-tahun para perawat melatih Dina untuk beradaptasi dengan kondisinya dan meningkatkan kemampuannya dalam menjelajahi lingkungan sekitar. Kini Dina menikmati kehidupan barunya di Orangutan Haven. Pada hari yang panas, ia sangat senang bergelantungan di jembatan dan bermain air untuk mendinginkan tubuhnya. Karena sifatnya yang aktif dan penuh rasa ingin tahu, Dina sering dijuluki sebagai penjelajah di Orangutan Haven.', 'images (2).jpg', '2026-06-04 09:11:48'),
(8, 'LEWIS', 35, NULL, 'Jantan', 'Tidak Dapat Dilepasliarkan', 'Buta akibat luka tembak dan memerlukan perawatan jangka panjang.', 'Lewis adalah orangutan jantan yang diperkirakan lahir pada tahun 1991 dan diselamatkan pada 30 Agustus 2016. Sebelum mendapatkan perawatan, Lewis mengalami kejadian tragis ketika ditembak sebanyak 40 kali oleh beberapa petani di tepi hutan.\r\n\r\nMeskipun mengalami luka yang sangat parah, Lewis berhasil bertahan hidup dan menjalani proses pemulihan di pusat karantina dan rehabilitasi orangutan. Berkat perawatan yang intensif, ia mampu melewati masa-masa sulit tersebut dan memulai kehidupan baru yang lebih aman.\r\n\r\nLewis dikenal sebagai orangutan yang sangat tinggi dengan lengan yang panjang. Ia juga memiliki kebiasaan unik, yaitu terkadang berjalan tegak menggunakan dua kaki seperti manusia. Karena mengalami gangguan penglihatan, Lewis sering menggunakan tangan dan lengannya untuk meraba lingkungan di sekitarnya.\r\n\r\nSaat ini Lewis tinggal di Orangutan Haven dan menikmati kehidupan yang lebih tenang. Ketika pertama kali dilepas ke pulau tempat tinggalnya, ia menjelajahi lingkungan barunya dengan tenang dan penuh rasa ingin tahu. Kisah Lewis menunjukkan ketangguhan dan kemampuan luar biasa orangutan untuk beradaptasi meskipun menghadapi berbagai kesulitan.', 'IMG20250629091644-Satria-Sembiring-scaled-545x727x0x163x545x400x1773990376.jpg', '2026-06-04 09:13:02'),
(9, 'DEK NONG', 27, NULL, 'Betina', 'Tidak Dapat Dilepasliarkan', 'Mengalami masalah persendian (arthritis) dan kelainan pada pergelangan tangan kiri.', 'Dek Nong adalah orangutan betina yang diperkirakan lahir pada tahun 1999 dan diselamatkan pada 7 September 2007 setelah dipelihara secara ilegal sebagai hewan peliharaan. Setelah menjalani rehabilitasi, ia sempat dilepasliarkan kembali ke alam liar pada tahun berikutnya.\r\n\r\nNamun selama hidup di hutan, Dek Nong menghadapi berbagai tantangan. Pada tahun 2009 ia mengalami kelumpuhan misterius yang penyebab pastinya tidak diketahui. Meskipun demikian, Dek Nong berhasil pulih dengan sangat baik berkat perawatan yang diberikan.\r\n\r\nAkibat kondisi tersebut, pergelangan tangan kirinya tetap berada pada posisi yang tidak normal dan beberapa persendiannya masih mengalami gangguan ringan. Meski begitu, secara umum Dek Nong berada dalam kondisi sehat dan mampu beraktivitas dengan baik.\r\n\r\nDek Nong dikenal sebagai orangutan yang sangat cerdas dan memiliki rasa ingin tahu yang tinggi. Ia selalu memperhatikan aktivitas di sekitar pulau tempat tinggalnya. Ketika pertama kali diperbolehkan keluar ke pulau konservasi di Orangutan Haven, ia menjelajahi jembatan, menara, dan berbagai fasilitas dengan hati-hati sambil menikmati kebebasan barunya.', 'images (3).jpg', '2026-06-04 09:14:06');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `donasi`
--
ALTER TABLE `donasi`
  ADD PRIMARY KEY (`id_donasi`);

--
-- Indeks untuk tabel `orangutan`
--
ALTER TABLE `orangutan`
  ADD PRIMARY KEY (`id_orangutan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `donasi`
--
ALTER TABLE `donasi`
  MODIFY `id_donasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `orangutan`
--
ALTER TABLE `orangutan`
  MODIFY `id_orangutan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
