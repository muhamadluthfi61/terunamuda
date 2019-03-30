-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Mar 2019 pada 16.16
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `terunamuda`
--

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `akhirbuku`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `akhirbuku` (
`id` int(11)
,`jumlah` bigint(13)
,`tahun` int(4)
,`bulan` int(2)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `akhirperlengkapan`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `akhirperlengkapan` (
`id` int(11)
,`jumlah` decimal(34,0)
,`tahun` int(4)
,`bulan` int(2)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`id`, `username`, `password`, `status`) VALUES
(1, 'admin', 'adminteruna', 0),
(2, 'perpus', 'adminperpus', 1),
(3, 'toko', 'admintoko', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `awalbuku`
--

CREATE TABLE `awalbuku` (
  `id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `awalbuku`
--

INSERT INTO `awalbuku` (`id`, `jumlah`, `tahun`, `bulan`) VALUES
(1, 10, 2019, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `awalperlengkapan`
--

CREATE TABLE `awalperlengkapan` (
  `id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `awalperlengkapan`
--

INSERT INTO `awalperlengkapan` (`id`, `jumlah`, `tahun`, `bulan`) VALUES
(6, 100, 2019, 3),
(7, 20, 2019, 3),
(14, 100, 2019, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `penerbit` text,
  `kurikulum` text,
  `tingkat` int(11) DEFAULT NULL,
  `jurusan` varchar(3) DEFAULT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id`, `nama`, `penerbit`, `kurikulum`, `tingkat`, `jurusan`, `jumlah`) VALUES
(1, 'Diary', NULL, NULL, NULL, NULL, 60),
(2, 'Moral Education', 'Erlangga ', 'National', 7, NULL, 0),
(3, 'Pendidikan Agama Islam dan budi pekerti', 'Erlangga', 'National', 7, NULL, 0),
(5, 'Mahir Berbahasa Indonesia', 'Erlangga', 'National', 7, NULL, 0),
(6, 'Matematika 1A dan 1 B', 'Erlangga', 'National', 7, NULL, 0),
(7, 'IPA Fisika', 'Erlangga', 'National', 7, NULL, 0),
(8, 'IPA Biologi', 'Erlangga', 'National', 7, NULL, 0),
(9, 'IPS', 'Erlangga', 'National', 7, NULL, 0),
(10, 'English Coursebook', 'Cambridge', 'Cambridge', 7, NULL, 0),
(11, 'English Workbook', NULL, 'Cambridge', 7, NULL, 0),
(12, 'Mathematics', 'Shinglee', 'Cambridge', 7, NULL, 0),
(13, 'General Science Coursebook', 'Cambridge', 'Cambridge', 7, NULL, 0),
(14, 'General Science Workbook', NULL, 'Cambridge', 7, NULL, 0),
(15, 'Moral Education', 'School handout', 'National', 8, NULL, 0),
(16, 'Ayo Belajar Agama Islam', 'Erlangga', 'National', 8, NULL, 0),
(17, 'Pendidikan Kewarganegaraan', 'Yudistira', 'National', 8, NULL, 0),
(18, 'Bahasa Indonesia', 'Erlangga', 'National', 8, NULL, 0),
(19, 'Matematika', 'Erlangga', 'National', 8, NULL, 0),
(20, 'IPA Fisika', 'Erlangga', 'National', 8, NULL, 0),
(21, 'IPA Biologi', 'Erlangga', 'National', 8, NULL, 0),
(22, 'IPS Terpadu', 'Yudistira', 'National', 8, NULL, 0),
(23, 'Pendidikan Lingkungan Hidup', 'Yudistira', 'National', 8, NULL, 0),
(24, 'English Coursebook', 'Cambridge', 'Cambridge', 8, NULL, 0),
(25, 'English Workbook', NULL, 'Cambridge', 8, NULL, 0),
(26, 'Mathematics', 'Shinglee', 'Cambridge', 8, NULL, 0),
(27, 'General Science Coursebook', 'Cambridge', 'Cambridge', 8, NULL, 0),
(28, 'General Science Workbook', NULL, 'Cambridge', 8, NULL, 0),
(29, 'Moral Education', 'School handout', 'National', 9, NULL, 0),
(30, 'Ayo Belajar Agama Islam', 'Erlangga', 'National', 9, NULL, 0),
(31, 'Pendidikan Kewarganegaraan', 'Yudistira', 'National', 9, NULL, 0),
(32, 'Bahasa Indonesia', 'Erlangga', 'National', 9, NULL, 0),
(33, 'Matematika', 'Erlangga', 'National', 9, NULL, 0),
(34, 'IPA Fisika', 'Erlangga', 'National', 9, NULL, 0),
(35, 'IPA Biologi', 'Erlangga', 'National', 9, NULL, 0),
(36, 'IPS Terpadu', 'Yudistira', 'National', 9, NULL, 0),
(37, 'Pendidikan Lingkungan Hidup', 'Yudistira', 'National', 9, NULL, 0),
(38, 'Focus UN', 'Erlangga', 'National', 9, NULL, 0),
(39, 'English ', 'Cambridge', 'Cambridge', 9, NULL, 0),
(40, 'English Workbook', NULL, 'Cambridge', 9, NULL, 0),
(41, 'Mathematics', 'Shinglee', 'Cambridge', 9, NULL, 0),
(42, 'General Science ', 'Cambridge', 'Cambridge', 9, NULL, 0),
(43, 'Pendidikan Agama', 'Erlangga', 'National', 10, 'IPS', 0),
(44, 'Pendidikan Pancasila dan Kewarganegaraan', 'Erlangga', 'National', 10, 'IPS', 0),
(45, 'Cerdas Berbahasa Indonesia', 'Erlangga', 'National', 10, 'IPS', 0),
(46, 'Matematika 1A dan 1B', 'Erlangga', 'National', 10, 'IPS', 0),
(47, 'Matematika IPA', 'Erlangga', 'National', 10, 'IPS', 0),
(48, 'Sejarah Indonesia', 'Erlangga', 'National', 10, 'IPS', 0),
(49, 'Biologi', 'Erlangga', 'National', 10, 'IPS', 0),
(50, 'Fisika', 'Erlangga', 'National', 10, 'IPS', 0),
(51, 'Kimia', 'Erlangga', 'National', 10, 'IPS', 0),
(52, 'Ekonomi', 'Erlangga', 'National', 10, 'IPS', 0),
(53, 'English', 'Cambridge', 'Cambridge', 10, 'IPS', 0),
(54, 'Mathematics', 'Cambridge', 'Cambridge', 10, 'IPS', 0),
(55, 'Biology', 'Cambridge', 'Cambridge', 10, 'IPS', 0),
(56, 'Chemistry', 'Cambridge', 'Cambridge', 10, 'IPS', 0),
(57, 'Physics', 'Cambridge', 'Cambridge', 10, 'IPS', 0),
(58, 'Pendidikan Agama', 'Erlangga', 'National', 10, 'IPA', 0),
(59, 'Pendidikan Pancasila dan Kewarganegaraan', 'Erlangga', 'National', 10, 'IPA', 0),
(60, 'Cerdas Berbahasa Indonesia', 'Erlangga', 'National', 10, 'IPA', 0),
(61, 'Matematika 1A dan 1B', 'Erlangga', 'National', 10, 'IPA', 0),
(62, 'Matematika IPS', 'Erlangga', 'National', 10, 'IPA', 0),
(63, 'Sejarah Indonesia', 'Erlangga', 'National', 10, 'IPA', 0),
(64, 'Sejarah', 'Erlangga', 'National', 10, 'IPA', 0),
(65, 'Geografi', 'Erlangga', 'National', 10, 'IPA', 0),
(66, 'Sosiologi', 'Erlangga', 'National', 10, 'IPA', 0),
(67, 'Ekonomi', 'Erlangga', 'National', 10, 'IPA', 0),
(68, 'English', 'Cambridge', 'Cambridge', 10, 'IPA', 0),
(69, 'Mathematics', 'Cambridge', 'Cambridge', 10, 'IPA', 0),
(70, 'Business Studies', 'Cambridge', 'Cambridge', 10, 'IPA', 0),
(71, 'Accounnting', 'Cambridge', 'Cambridge', 10, 'IPA', 0),
(72, 'Management', 'Cambridge', 'Cambridge', 10, 'IPA', 0),
(73, 'Moral Education', ' Yudistira handout', 'National', 11, 'IPS', 0),
(74, 'Pendidikan Kewarganegaraan 2 XI', 'Yudistira', 'National', 11, 'IPS', 0),
(75, 'Kompeten Berbahasa Indonesia 2', 'Erlangga', 'National', 11, 'IPS', 0),
(76, 'Matematika 2A & 2B', 'Erlangga', 'National', 11, 'IPS', 0),
(77, 'Ekonomi', 'Erlangga', 'National', 11, 'IPS', 0),
(78, 'Geografi', 'Erlangga', 'National', 11, 'IPS', 0),
(79, 'Sosiologi', 'Erlangga', 'National', 11, 'IPS', 0),
(80, 'Sejarah', 'Yudistira', 'National', 11, 'IPS', 0),
(81, 'Akuntasi', 'Yudistira', 'National', 11, 'IPS', 0),
(82, 'English ', 'Cambridge', 'Cambridge', 11, 'IPS', 0),
(83, 'Mathematics', 'Cambridge', 'Cambridge', 11, 'IPS', 0),
(84, 'Business Studies', 'Handout', 'Cambridge', 11, 'IPS', 0),
(85, 'Accounting', 'Handout', 'Cambridge', 11, 'IPS', 0),
(86, 'Management', 'Handout', 'Cambridge', 11, 'IPS', 0),
(87, 'Moral Education', ' Yudistira handout', 'National', 11, 'IPA', 0),
(88, 'Pendidikan Kewarganegaraan 2 XI', 'Yudistira', 'National', 11, 'IPA', 0),
(89, 'Kompeten Berbahasa Indonesia 2', 'Erlangga', 'National', 11, 'IPA', 0),
(90, 'Matematika 2A & 2B', 'Erlangga', 'National', 11, 'IPA', 0),
(91, 'Biologi 2 (Rev)', 'Erlangga', 'National', 11, 'IPA', 0),
(92, 'Fisika 2', 'Erlangga', 'National', 11, 'IPA', 0),
(93, 'Kimia 2 (Rev)', 'Erlangga', 'National', 11, 'IPA', 0),
(94, 'Sejarah 2 IPA XI', 'Yudistira', 'National', 11, 'IPA', 0),
(95, 'Pendidikan Lingkungan Hidup 2 XI', 'Yudistira', 'National', 11, 'IPA', 0),
(96, 'English ', 'Cambridge', 'Cambridge', 11, 'IPA', 0),
(97, 'Mathematics', 'Cambridge', 'Cambridge', 11, 'IPA', 0),
(98, 'Biology', 'Handout', 'Cambridge', 11, 'IPA', 0),
(99, 'Chemistry', 'Handout', 'Cambridge', 11, 'IPA', 0),
(100, 'Physics', 'Handout', 'Cambridge', 11, 'IPA', 0),
(101, 'Moral Education', ' Yudistira handout', 'National', 12, NULL, 0),
(102, 'Pendidikan Kewarganegaraan ', 'Yudistira', 'National', 12, NULL, 0),
(103, 'Kompeten Berbahasa Indonesia ', 'Erlangga', 'National', 12, NULL, 0),
(104, 'Matematika 3A & 3B', 'Erlangga', 'National', 12, NULL, 0),
(105, 'Biologi', 'Erlangga', 'National', 12, NULL, 0),
(106, 'Fisika', 'Erlangga', 'National', 12, NULL, 0),
(107, 'Kimia', 'Erlangga', 'National', 12, NULL, 0),
(108, 'Sejarah', 'Yudistira', 'National', 12, NULL, 0),
(109, 'Pendidikan Lingkingan Hidup', 'Yudistira', 'National', 12, NULL, 0),
(110, 'Fokus UN & Kertas2 Latihan UN', 'Erlangga', 'National', 12, NULL, 0),
(111, 'English ', 'Cambridge', 'Cambridge', 12, NULL, 0),
(112, 'Mathematics', 'Handout', 'Cambridge', 12, NULL, 0),
(113, 'Biology', 'Handout', 'Cambridge', 12, NULL, 0),
(114, 'Chemistry', 'Handout', 'Cambridge', 12, NULL, 0),
(115, 'Physics', 'Handout', 'Cambridge', 12, NULL, 0);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `laporanbuku`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `laporanbuku` (
`id` int(11)
,`masuk` decimal(32,0)
,`keluar` decimal(32,0)
,`total` decimal(33,0)
,`tahun` int(4)
,`bulan` int(2)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `laporanperlengkapan`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `laporanperlengkapan` (
`id` int(11)
,`masuk` decimal(32,0)
,`keluar` decimal(32,0)
,`total` decimal(33,0)
,`tahun` int(4)
,`bulan` int(2)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `meminjam`
--

CREATE TABLE `meminjam` (
  `nis` varchar(11) NOT NULL,
  `id` int(11) NOT NULL,
  `pinjam` date NOT NULL,
  `kembali` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `perlengkapan`
--

CREATE TABLE `perlengkapan` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `ukuran` text,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `perlengkapan`
--

INSERT INTO `perlengkapan` (`id`, `nama`, `ukuran`, `jumlah`) VALUES
(1, 'KEMEJA PUTIH', '12', 0),
(2, 'KEMEJA PUTIH', '14', 0),
(3, 'KEMEJA PUTIH', '16', 0),
(4, 'KEMEJA PUTIH', '18', 0),
(5, 'KEMEJA PUTIH', '20', 0),
(6, 'BAJU PE', 'S', 150),
(7, 'BAJU PE', 'M', 120),
(8, 'BAJU PE', 'L', 0),
(9, 'BAJU PE', 'XL', 0),
(10, 'BAJU PE', 'XXL', 0),
(11, 'DASI', NULL, 0),
(12, 'KAIN BIRU', NULL, 0),
(13, 'KAIN ABU ABU', NULL, 0),
(14, 'test', 'kosong', 200);

-- --------------------------------------------------------

--
-- Struktur dari tabel `perpustakaan`
--

CREATE TABLE `perpustakaan` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `pengarang` text,
  `tersedia` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `perpustakaan`
--

INSERT INTO `perpustakaan` (`id`, `nama`, `pengarang`, `tersedia`) VALUES
(1, '17 Tahun Usiaku', 'Miyuki Inoue', 1),
(2, '20.000 Leagues', NULL, 1),
(3, 'Airlangga', 'Sanoesi Pane', 1),
(4, 'Almustafa', 'Kahlil Gibran', 1),
(5, 'American Crime Stories', 'John Escott', 1),
(6, 'Anak - Anak Pangrango', 'Nun Vroto El Banbary', 1),
(7, 'Anak Anak Tukang ', 'sketsa kembang manggis', 1),
(8, 'Anne Of Avonlea', 'Kathleen Olmstead', 1),
(9, 'Annyeong Korea', 'Elvira Fidelia ', 1),
(10, 'Around The World In Eighty Days', 'Jules Verne', 1),
(11, 'Asal Usul nama tempat di Jakarta', NULL, 1),
(12, 'Ayah', 'Andrea Hirata', 1),
(13, 'Bencana Sekolah', 'Jodee Blanco', 1),
(14, 'Bhinneka Tunggal Cinta', 'Kang Maman', 1),
(15, 'Bukan Pasar Malam', 'Pramoedya Ananta Toer', 1),
(16, 'Catatan Ichiyo', 'Rei Kimura', 1),
(17, 'Cerita si Penidur', 'Aman Dt Madoindo', 1),
(18, 'Cerita si Penidur', 'Aman Dt Madoindo', 1),
(19, 'Charlie and great glass elevator ', 'Roald Dahl', 1),
(20, 'Cinta sedalam lautan, seluas cakrawala', 'Indah Hanaco', 1),
(21, 'Cinta untuk cee cee', 'Beth Hoffman', 1),
(22, 'Cry Freedom', 'John Briley', 1),
(23, 'Csi cacing dan kotoran kesayangannya ', 'ajahn brahm', 1),
(24, 'Di Pulau Harta', 'Enid Blyton', 1),
(25, 'Drama dalam tiga babak', 'Sanoesi Pane', 1),
(26, 'Five on a Hike Together', 'Enid Blyton', 1),
(27, 'Ghost Stories', 'Rosemary Border', 1),
(28, 'Going Solo ', 'Roald Dahl', 1),
(29, 'Greek Myths', NULL, 1),
(30, 'High School Love Story', 'Haula S', 1),
(31, 'High School Musical', NULL, 1),
(32, 'House at the corner', 'Enid Blyton', 1),
(33, 'IPA & IPS ', 'Chacaii', 1),
(34, 'Jalan Raya Pos, Jalan Daendels', 'Pramoedya Ananta Toer', 1),
(35, 'Jangan Ambil Anakku', 'John F Crowley', 1),
(36, 'Jermal Sebuah Novel', 'Yokie Adityo', 1),
(37, 'Jumpi ', 'Augie Fantinus', 1),
(38, 'Kakak Kelas', 'Kadek Pingetania', 1),
(39, 'Ke Sarang Penyeludup', 'Enid Blyton', 1),
(40, 'Kelas', 'Ainun Chomsum', 1),
(41, 'Kisah Anak Cahaya', 'Arsanda', 1),
(42, 'Kumpulan Cerita Asli Indonesia ', 'Edisi 5', 1),
(43, 'Kumpulan Cerita Asli Indonesia ', 'Edisi 7', 1),
(44, 'Kumpulan cerita asli Indonesia ', 'Edisi 10', 1),
(45, 'Laskar Pelangi', 'Andrea A', 1),
(46, 'Laut Atapupu', 'Arikho Binshu', 1),
(47, 'Little Woman', NULL, 1),
(48, 'Lulu and The Cat in TheBag', 'Itilary Mc Kay', 1),
(49, 'May Bird', 'Jodi Lynn', 1),
(50, 'Memperjuangkan Harta Finniston', 'Enid Blyton', 1),
(51, 'Mencari Pencuri Anak Perawan', 'Suman Hs', 1),
(52, 'Mimpi Bayang Jingga', 'Sanie B Kuncoro', 1),
(53, 'Mitsuko', 'Kara Dalkey', 1),
(54, 'Namaku Subardjo', 'Hapsari Hanggarini', 1),
(55, 'Nostalgia anak 90 an', 'Kontributor Pen Fighter', 1),
(56, 'Osis Girl', 'Aqilah Tisalsabilah', 1),
(57, 'Pak Dullah in Extemis', 'Achdiat K Mihardja', 1),
(58, 'Pengakuan', 'Anton Cheknov', 1),
(59, 'Perfect Purple', 'Indah Hanaco', 1),
(60, 'Pingkan Melipat Jarak', 'Sapardi Djoko Damono', 1),
(61, 'Please Look After Mom', 'Kyung Sook Shin', 1),
(62, 'Porcupine ', 'Meg Tilly', 1),
(63, 'Prahu Kertas', 'Supardi Djoko Damono', 1),
(64, 'Rahasia Di Pulau Kirrin', 'Enid Blyton', 1),
(65, 'Robert Anak Surapati', 'Abdoel Moeis', 1),
(66, 'Rumah Tanpa Jendela', 'Asma Nadia', 1),
(67, 'Salah Asuhan', 'Abdoel Moeis', 1),
(68, 'Salah pilih', 'Nur St Iskandar', 1),
(69, 'Sang Juara', 'Al Kadri Johan', 1),
(70, 'Sang Pemimpi', 'Andrea Itirata', 1),
(71, 'Sayap-Sayap Patah', 'Kahlil Gibran', 1),
(72, 'Sekali Lagi si Paling Badung', 'Enid Blyton', 1),
(73, 'Sekali Peristiwa di Banten Selatan', 'Pramoedya Ananta Toer', 1),
(74, 'Serba Serbi Anak 90 an', 'pen Fighters', 1),
(75, 'Seteru 1 Guru', 'Haris Priyatna', 1),
(76, 'Si Dul Anak Betawi', 'Aman Dt Madoindo', 1),
(77, 'Si Jaman & si Johan', 'Merari Siregar', 1),
(78, 'Sin', 'Faradita', 1),
(79, 'Siti Nurbaya', 'Marah Rusli', 1),
(80, 'Spirit Walker ', 'Michella Paver', 1),
(81, 'Student Hidjo', 'Mas Marco Kartodikromo', 1),
(82, 'Sukreni gadis Bali', 'AA Pandji Tisna', 1),
(83, 'Sunset & Rosie', 'Tere Liye', 1),
(84, 'Surat Kecil untuk Tuhan', 'Agnes Davonar', 1),
(85, 'Tenggelamnya Kapal Van Der Wijck', 'Hanika', 1),
(86, 'The Adventures of Robin Hood', 'John Burrows', 1),
(87, 'The BGF', 'Roald Dahl', 1),
(88, 'The Children at Green Meadows', 'Enid Blyton', 1),
(89, 'The Fly', NULL, 1),
(90, 'The Garden Party', 'Katherine Mansfield', 1),
(91, 'The Gifted Club', 'Antonius Tana', 1),
(92, 'The Help', 'Kathryn Stockett', 1),
(93, 'The Jungle Book', 'Lisa Church', 1),
(94, 'The Last of the Mohicans', 'James Fenimore Cooper', 1),
(95, 'The Mystery of Holly Lane', 'Enid Blyton', 1),
(96, 'The Mystery of Missing Necklace', 'Enid Blyton', 1),
(97, 'The Mystery of Secret Room', 'Enid Blyton', 1),
(98, 'The Mystery of Strange Bundle', 'Enid Blyton', 1),
(99, 'The Mystery of Tally-Ho', 'Enid Blyton', 1),
(100, 'The Mystery of the Disappearing Cat', 'Enid Blyton', 1),
(101, 'The Mystery og the Hidden', 'Enid Blyton', 1),
(102, 'The Odyssey', 'Tania Zamorsky', 1),
(103, 'The Old Man ', 'Ernest Hemingway', 1),
(104, 'The Put em Rights ', 'Enid Blyton', 1),
(105, 'The Riddle of Holiday House', 'Enid Blyton', 1),
(106, 'The Riddle of the Rajah\'s ruby', 'Enid Blyton', 1),
(107, 'The Secret Seven', NULL, 1),
(108, 'The Six Bad Boys', 'Enid Blyton', 1),
(109, 'The Story English Language', NULL, 1),
(110, 'The Story of King Arthur', 'Howard Pyle', 1),
(111, 'The Strange Case of dr.Jekyll and Mr Hyde', 'Rebert Louis Stevenson', 1),
(112, 'The Time Keeper', NULL, 1),
(113, 'The Time Machine', 'H G Wells', 1),
(114, 'Those Dreadful children', 'Enid Blyton', 1),
(115, 'Through the looking Glass ', 'Lewis Carroll', 1),
(116, 'Tiga menguak takdir', 'Chairil Anwar', 1),
(117, 'Ubur-ubur', 'Raditya Dika', 1),
(118, 'When life lights up', 'Serdar Ozkan', 1),
(119, 'White Lies', NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_buku`
--

CREATE TABLE `riwayat_buku` (
  `id` int(11) NOT NULL,
  `masuk` int(11) DEFAULT NULL,
  `keluar` int(11) DEFAULT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `riwayat_buku`
--

INSERT INTO `riwayat_buku` (`id`, `masuk`, `keluar`, `tanggal`) VALUES
(1, 50, 0, '2019-03-30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_perlengkapan`
--

CREATE TABLE `riwayat_perlengkapan` (
  `id` int(11) NOT NULL,
  `masuk` int(11) DEFAULT NULL,
  `keluar` int(11) DEFAULT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `riwayat_perlengkapan`
--

INSERT INTO `riwayat_perlengkapan` (`id`, `masuk`, `keluar`, `tanggal`) VALUES
(6, 20, 0, '2019-03-30'),
(6, 30, 0, '2019-03-30'),
(7, 100, 0, '2019-03-30'),
(14, 100, 0, '2019-03-30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `nis` varchar(11) NOT NULL,
  `nama` text NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `tingkat` int(11) NOT NULL,
  `rombel` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `tingkat`, `rombel`) VALUES
('1617.07-001', 'Abraham Jovandame Sibuea', 'L', 9, 'Grade 9D'),
('1617.07-002', 'Adilio Alghifari', 'L', 9, 'Grade 9D'),
('1617.07-003', 'Alexander Axell Sebastian', 'L', 9, 'Grade 9D'),
('1617.07-004', 'Auliya Khairani Passat', 'P', 9, 'Grade 9B'),
('1617.07-005', 'Aurellia Arlen Adiprasetya', 'P', 9, 'Grade 9D'),
('1617.07-006', 'Beatrice Valerie Jolly', 'P', 9, 'Grade 9D'),
('1617.07-007', 'Charleroy Hizkia Parlaungan Sihombing', 'L', 9, 'Grade 9D'),
('1617.07-008', 'Clara Monique', 'P', 9, 'Grade 9B'),
('1617.07-009', 'Darrell Zachary Gunawan', 'L', 9, 'Grade 9B'),
('1617.07-010', 'Dewa Made Syailendra Ramaditya Agusta', 'L', 9, 'Grade 9B'),
('1617.07-011', 'Elaine Keisha', 'P', 9, 'Grade 9D'),
('1617.07-012', 'Fanny Adelia Permatasari', 'P', 9, 'Grade 9D'),
('1617.07-013', 'Felicius Edward Tjendra', 'L', 9, 'Grade 9B'),
('1617.07-014', 'Firyal Aqila Rosobin', 'P', 9, 'Grade 9B'),
('1617.07-015', 'Fitriana', 'P', 9, 'Grade 9B'),
('1617.07-016', 'Gabriel Alexander Nathanael Setyawan', 'P', 9, 'Grade 9B'),
('1617.07-017', 'Gading Puspita Gantari', 'P', 9, 'Grade 9B'),
('1617.07-018', 'Galen Nayaka Nayottama', 'L', 9, 'Grade 9B'),
('1617.07-019', 'Gaxel Anyndrashanie', 'P', 9, 'Grade 9B'),
('1617.07-020', 'Gerald Graham Nathanael Ngabadi', 'L', 9, 'Grade 9D'),
('1617.07-021', 'Geraldi Albert Abrahamson', 'L', 9, 'Grade 9B'),
('1617.07-022', 'Gita Aulia Putri Sandita', 'P', 9, 'Grade 9B'),
('1617.07-023', 'Jedidiah Matthew Joel Heinrich Pawiro', 'L', 9, 'Grade 9D'),
('1617.07-024', 'Jenson Carlton Santoso', 'L', 9, 'Grade 9D'),
('1617.07-025', 'Joanne Angela Bindjamin', 'P', 9, 'Grade 9B'),
('1617.07-026', 'Jonathan Flandi Imawan', 'L', 9, 'Grade 9D'),
('1617.07-027', 'Jovan Cikahesa Candra', 'L', 9, 'Grade 9B'),
('1617.07-028', 'Jovian Nathan Sutedja', 'L', 9, 'Grade 9B'),
('1617.07-029', 'Kreskaia Diandrayesha', 'P', 9, 'Grade 9D'),
('1617.07-030', 'Naomi Haverim Pistea Purba', 'P', 9, 'Grade 9D'),
('1617.07-031', 'Natasya Alfianny Prasetyo', 'P', 9, 'Grade 9D'),
('1617.07-032', 'Ni Putu Fascha Nabila Putri Aryasa', 'P', 9, 'Grade 9D'),
('1617.07-033', 'Nichelle Pandora Huang', 'P', 9, 'Grade 9D'),
('1617.07-034', 'Patricia Kiara Saputro Handoyo', 'P', 9, 'Grade 9D'),
('1617.07-035', 'Pelangi Liem', 'P', 9, 'Grade 9D'),
('1617.07-036', 'Putu Vania Prasanthini', 'P', 9, 'Grade 9B'),
('1617.07-037', 'Rana Nafisah Dwiputri', 'P', 9, 'Grade 9B'),
('1617.07-038', 'Rekzy Meinaky', 'L', 9, 'Grade 9D'),
('1617.07-039', 'Shelena Mathilda', 'P', 9, 'Grade 9D'),
('1617.07-040', 'Steffi Aprilita Suhery Young', 'P', 9, 'Grade 9D'),
('1617.07-041', 'Theresa Angelina', 'P', 9, 'Grade 9B'),
('1617.07-042', 'Theresia Alexandra Michelle Indharmawan', 'P', 9, 'Grade 9B'),
('1617.07-043', 'Tiffany Tiany', 'P', 9, 'Grade 9B'),
('1617.07-044', 'Valerie Safira Putri Suharjo', 'P', 9, 'Grade 9D'),
('1617.07-045', 'Viola Handini', 'P', 9, 'Grade 9B'),
('1617.10-001', 'Adrian Junaidi', 'L', 12, 'Grade 12 S'),
('1617.10-002', 'David Leon Bijlsma', 'L', 12, 'Grade 12 S'),
('1617.10-003', 'David Mario Cristovel T', 'L', 12, 'Grade 12 S'),
('1617.10-004', 'Galuh Yendah Prasyad', 'L', 12, 'Grade 12 S'),
('1617.10-005', 'Harold', 'L', 12, 'Grade 12 S'),
('1617.10-006', 'Jeanette Nadia', 'P', 12, 'Grade 12 S'),
('1617.10-007', 'Muhammad Reynaldi Listyanto', 'L', 12, 'Grade 12 S'),
('1617.10-008', 'Nada Sahara Prabowo', 'P', 12, 'Grade 12 S'),
('1617.10-009', 'Timothy Tambuwun', 'L', 12, 'Grade 12 S'),
('1718.07-001', 'Alisha Rafa Maharani Gushendar', 'P', 8, 'Grade 8G'),
('1718.07-002', 'Aliyah Fazahra Ramadhani Shogie', 'P', 8, 'Grade 8G'),
('1718.07-003', 'Angela Priscillia Cecilya Christiona', 'P', 8, 'Grade 8G'),
('1718.07-004', 'Angelica Levina Setyawan', 'P', 8, 'Grade 8G'),
('1718.07-005', 'Angelina Putri Nainggolan', 'P', 8, 'Grade 8V'),
('1718.07-006', 'Angeline Andrea Priscilla Hinn', 'P', 8, 'Grade 8V'),
('1718.07-007', 'Bianca Haidi', 'P', 8, 'Grade 8V'),
('1718.07-008', 'Camilla Amabelle Setiawan', 'P', 8, 'Grade 8G'),
('1718.07-009', 'Charis Bezaleel Issachar', 'L', 8, 'Grade 8G'),
('1718.07-010', 'Cheryl Anastasya Livery', 'P', 8, 'Grade 8G'),
('1718.07-011', 'Christian Abhipraya Keintjem', 'L', 8, 'Grade 8G'),
('1718.07-012', 'Deanice Amanda Handhara', 'P', 8, 'Grade 8G'),
('1718.07-013', 'Derryl Alvino Wuisan', 'L', 8, 'Grade 8V'),
('1718.07-014', 'Edgar Sebastian', 'L', 8, 'Grade 8G'),
('1718.07-015', 'Eleora Christy So', 'P', 8, 'Grade 8G'),
('1718.07-016', 'Erick Jonathan', 'L', 8, 'Grade 8G'),
('1718.07-017', 'Fayola Saphira Zulkarnaen', 'P', 8, 'Grade 8V'),
('1718.07-018', 'Grimaldi Lumiu', 'L', 8, 'Grade 8G'),
('1718.07-019', 'Jessica Lylian Widjaja', 'P', 8, 'Grade 8V'),
('1718.07-020', 'Jesslyne Chelsea Santoso', 'P', 8, 'Grade 8V'),
('1718.07-021', 'Jordan Andhika Yori Tampubolon', 'L', 8, 'Grade 8V'),
('1718.07-022', 'Jorel Frederick Tyaga Pangaribuan', 'L', 8, 'Grade 8V'),
('1718.07-023', 'Joshua Efraim Rawatan', 'L', 8, 'Grade 8G'),
('1718.07-024', 'Khansa Aulia Hadiwijaya', 'P', 8, 'Grade 8V'),
('1718.07-025', 'Maheswari Kirana', 'P', 8, 'Grade 8V'),
('1718.07-026', 'Marcella Karina Pasha Raden Rara', 'P', 8, 'Grade 8G'),
('1718.07-027', 'Nadine Putri Arlya', 'P', 8, 'Grade 8V'),
('1718.07-028', 'Nurmala Eka Putri', 'P', 8, 'Grade 8V'),
('1718.07-029', 'Pande I Made Niko Mevano Wili Putra', 'L', 8, 'Grade 8V'),
('1718.07-030', 'Raden Ajeng Alika Nur Azizah', 'P', 8, 'Grade 8G'),
('1718.07-031', 'Raissa Marcialevina', 'P', 8, 'Grade 8G'),
('1718.07-032', 'Rivqa Michelle Djajasaputra', 'P', 8, 'Grade 8V'),
('1718.07-033', 'Samuel Adibrata Harliman', 'L', 8, 'Grade 8V'),
('1718.07-034', 'Samuel Ivan Gunarta', 'L', 8, 'Grade 8V'),
('1718.07-035', 'Steve Jansen Young', 'L', 8, 'Grade 8G'),
('1718.07-036', 'Tiva Rafsody Muhaemin', 'P', 8, 'Grade 8G'),
('1718.10-001', 'Abraham Pardomuan Naiborhu', 'L', 11, 'Grade 11 S'),
('1718.10-002', 'An Hye Sung', 'L', 11, 'Grade 11 S'),
('1718.10-003', 'Farrel Zulkarnaen', 'L', 11, 'Grade 11 S'),
('1718.10-004', 'Giunydia Ananya', 'P', 11, 'Grade 11 S'),
('1718.10-005', 'Kai Adair Adams', 'L', 11, 'Grade 11 S'),
('1718.10-006', 'Karunia Elisabeth', 'P', 11, 'Grade 11 S'),
('1718.10-007', 'Kellen Sunaryo', 'P', 11, 'Grade 11 S'),
('1718.10-008', 'Nadya Hanna Christanty', 'P', 11, 'Grade 11 S'),
('1718.10-009', 'Valentino Vito Albert Mumek', 'L', 11, 'Grade 11 S'),
('1819.07-001', 'Amadeo Nathaniel Darmawijaya', 'L', 7, 'Grade 7R'),
('1819.07-002', 'Ammara Aniqa Jasmeen Wirendra', 'P', 7, 'Grade 7P'),
('1819.07-003', 'Anaztacia Carolina Angel P.f', 'P', 7, 'Grade 7P'),
('1819.07-004', 'Andrea Nayla Sarafina Fathan', 'P', 7, 'Grade 7P'),
('1819.07-005', 'Anggita Natalie Sibuea', 'P', 7, 'Grade 7R'),
('1819.07-006', 'Audrick Abigel', 'L', 7, 'Grade 7P'),
('1819.07-007', 'Aurelio Rafif Wicaksono', 'L', 7, 'Grade 7P'),
('1819.07-008', 'Ave Claudia Juliana Elisabeth Mongan', 'P', 7, 'Grade 7P'),
('1819.07-009', 'Benedicta Rachell Dwipancarani Indharmawan', 'P', 7, 'Grade 7P'),
('1819.07-010', 'Bintang Adiguna Nugroho', 'L', 7, 'Grade 7P'),
('1819.07-011', 'Chloe Kemuning Chakkavattya', 'P', 7, 'Grade 7P'),
('1819.07-012', 'Christenson Evan Heryanto', 'L', 7, 'Grade 7R'),
('1819.07-013', 'Cindy Patricia', 'P', 7, 'Grade 7R'),
('1819.07-014', 'Emily Abigail Christanty', 'P', 7, 'Grade 7R'),
('1819.07-015', 'Emirshah Helmi Ikhsan Shaquile', 'L', 7, 'Grade 7R'),
('1819.07-016', 'Eugenia Rachel Verlina Pelafoe', 'P', 7, 'Grade 7P'),
('1819.07-017', 'Gabriel Reviano Wea', 'L', 7, 'Grade 7R'),
('1819.07-018', 'Gandhis Kinarnaya Yolanti', 'P', 7, 'Grade 7R'),
('1819.07-019', 'Henokh Michael Yosavia P', 'L', 7, 'Grade 7P'),
('1819.07-020', 'Jason Kumala', 'L', 7, 'Grade 7P'),
('1819.07-021', 'Kanaya Adelaide Keintjem', 'P', 7, 'Grade 7R'),
('1819.07-022', 'Kanaya Kolan Suputra', 'L', 7, 'Grade 7P'),
('1819.07-023', 'Karel Augustino Taberi', 'L', 7, 'Grade 7R'),
('1819.07-024', 'Kim Ho Yun', 'P', 7, 'Grade 7P'),
('1819.07-025', 'Kim Louis Alfatah', 'L', 7, 'Grade 7P'),
('1819.07-026', 'Kim Minji', 'P', 7, 'Grade 7R'),
('1819.07-027', 'Kimberly Augustin Taberi', 'P', 7, 'Grade 7P'),
('1819.07-028', 'Kimi Galih Pratomoadji', 'L', 7, 'Grade 7P'),
('1819.07-029', 'Lance Ayson Winarto', 'L', 7, 'Grade 7R'),
('1819.07-030', 'Made Yoga Chantiswara', 'L', 7, 'Grade 7P'),
('1819.07-031', 'Martha Claudia Manurung', 'P', 7, 'Grade 7R'),
('1819.07-032', 'Nadhif Zahran Bayuputra', 'L', 7, 'Grade 7R'),
('1819.07-033', 'Nadia Nuraini', 'P', 7, 'Grade 7R'),
('1819.07-034', 'Naila Marsha Febrian', 'P', 7, 'Grade 7R'),
('1819.07-035', 'Nayotama Adelio Darmawansyah', 'L', 7, 'Grade 7R'),
('1819.07-036', 'Olivia Cikahesa Candra', 'P', 7, 'Grade 7P'),
('1819.07-037', 'Pascal Anantawirya Darma', 'L', 7, 'Grade 7R'),
('1819.07-038', 'Pascha Rabbani Mulyono', 'L', 7, 'Grade 7R'),
('1819.07-039', 'Takeo Ahmad Ar Rasyad', 'L', 7, 'Grade 7R'),
('1819.07-040', 'Tara Emmanuella Laswardi', 'P', 7, 'Grade 7R'),
('1819.07-041', 'Tobias Manuel Marisi Situmeang', 'L', 7, 'Grade 7P'),
('1819.07-042', 'Tricia Julianette Chua', 'P', 7, 'Grade 7P'),
('1819.07-043', 'Vesya Cayla Sherenchie', 'P', 7, 'Grade 7R'),
('1819.10-001', 'Dzaskiya Yosina Hidayat', 'P', 10, 'Grade 10 S'),
('1819.10-002', 'Gazeta Luna', 'P', 10, 'Grade 10 S'),
('1819.10-003', 'Maria Natali', 'P', 10, 'Grade 10 S'),
('1819.10-004', 'Muhammad Indra Chaidir', 'L', 10, 'Grade 10 S'),
('1819.10-005', 'Razidane Putra Herdiyana', 'L', 10, 'Grade 10 S'),
('1819.10-006', 'Rivando Sapputro', 'L', 10, 'Grade 10 S'),
('1819.10-007', 'Thomas Adrian', 'L', 10, 'Grade 10 S');

-- --------------------------------------------------------

--
-- Struktur untuk view `akhirbuku`
--
DROP TABLE IF EXISTS `akhirbuku`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `akhirbuku`  AS  select `riwayat_buku`.`id` AS `id`,((`awalbuku`.`jumlah` + `riwayat_buku`.`masuk`) - `riwayat_buku`.`keluar`) AS `jumlah`,year(`riwayat_buku`.`tanggal`) AS `tahun`,month(`riwayat_buku`.`tanggal`) AS `bulan` from ((`riwayat_buku` join `laporanbuku` on(((`riwayat_buku`.`id` = `laporanbuku`.`id`) and (`riwayat_buku`.`masuk` = `laporanbuku`.`masuk`) and (`riwayat_buku`.`keluar` = `laporanbuku`.`keluar`)))) join `awalbuku` on((`awalbuku`.`id` = `laporanbuku`.`id`))) group by `riwayat_buku`.`id` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `akhirperlengkapan`
--
DROP TABLE IF EXISTS `akhirperlengkapan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `akhirperlengkapan`  AS  select `laporanperlengkapan`.`id` AS `id`,((`awalperlengkapan`.`jumlah` + `laporanperlengkapan`.`masuk`) - `laporanperlengkapan`.`keluar`) AS `jumlah`,`laporanperlengkapan`.`tahun` AS `tahun`,`laporanperlengkapan`.`bulan` AS `bulan` from (`awalperlengkapan` join `laporanperlengkapan` on((`awalperlengkapan`.`id` = `laporanperlengkapan`.`id`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `laporanbuku`
--
DROP TABLE IF EXISTS `laporanbuku`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laporanbuku`  AS  select `riwayat_buku`.`id` AS `id`,sum(`riwayat_buku`.`masuk`) AS `masuk`,sum(`riwayat_buku`.`keluar`) AS `keluar`,(sum(`riwayat_buku`.`masuk`) - sum(`riwayat_buku`.`keluar`)) AS `total`,year(`riwayat_buku`.`tanggal`) AS `tahun`,month(`riwayat_buku`.`tanggal`) AS `bulan` from `riwayat_buku` group by `riwayat_buku`.`id` order by `riwayat_buku`.`id`,year(`riwayat_buku`.`tanggal`),month(`riwayat_buku`.`tanggal`) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `laporanperlengkapan`
--
DROP TABLE IF EXISTS `laporanperlengkapan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laporanperlengkapan`  AS  select `riwayat_perlengkapan`.`id` AS `id`,sum(`riwayat_perlengkapan`.`masuk`) AS `masuk`,sum(`riwayat_perlengkapan`.`keluar`) AS `keluar`,(sum(`riwayat_perlengkapan`.`masuk`) - sum(`riwayat_perlengkapan`.`keluar`)) AS `total`,year(`riwayat_perlengkapan`.`tanggal`) AS `tahun`,month(`riwayat_perlengkapan`.`tanggal`) AS `bulan` from `riwayat_perlengkapan` group by `riwayat_perlengkapan`.`id` order by `riwayat_perlengkapan`.`id`,year(`riwayat_perlengkapan`.`tanggal`),month(`riwayat_perlengkapan`.`tanggal`) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `meminjam`
--
ALTER TABLE `meminjam`
  ADD KEY `meminjam_refer_perpustakaan` (`id`),
  ADD KEY `meminjam_refer_siswa` (`nis`);

--
-- Indeks untuk tabel `perlengkapan`
--
ALTER TABLE `perlengkapan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `perpustakaan`
--
ALTER TABLE `perpustakaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT untuk tabel `perlengkapan`
--
ALTER TABLE `perlengkapan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `meminjam`
--
ALTER TABLE `meminjam`
  ADD CONSTRAINT `meminjam_refer_perpustakaan` FOREIGN KEY (`id`) REFERENCES `perpustakaan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `meminjam_refer_siswa` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
