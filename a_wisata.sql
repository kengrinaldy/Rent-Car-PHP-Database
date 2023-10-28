-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Des 2022 pada 05.21
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `a_wisata`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `adminID` char(4) NOT NULL,
  `adminNAMA` varchar(30) NOT NULL,
  `adminEMAIL` varchar(60) NOT NULL,
  `adminPASSWORD` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`adminID`, `adminNAMA`, `adminEMAIL`, `adminPASSWORD`) VALUES
('A1', 'Keeny', 'ken@gmail.com', '0909');

-- --------------------------------------------------------

--
-- Struktur dari tabel `area`
--

CREATE TABLE `area` (
  `areaID` varchar(4) NOT NULL,
  `areanama` varchar(35) NOT NULL,
  `areawilayah` varchar(35) NOT NULL,
  `areaketerangan` varchar(255) NOT NULL,
  `kabupatenKODE` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `area`
--

INSERT INTO `area` (`areaID`, `areanama`, `areawilayah`, `areaketerangan`, `kabupatenKODE`) VALUES
('AR01', 'Tokyo', 'East Kanto', 'The Kanto region is a geographical area of Honshu, the largest island of Japan.In a common definition, the region includes the Greater Tokyo Area', 'KP02'),
('AR02', 'Vegas', 'California', 'The city is the most populous state of the United States by population and the third largestby region. California is also the most populous subnational entity in North America and the 34th most populous in the world', 'KP03'),
('AR03', 'Jelambar', 'Jakarta Barat', 'The center of government is in the Kembangan sub-district . Established in 1966, West Jakarta was officially formed based on Government Regulation Number 25 of 1978. ', 'KP03'),
('AR04', 'Dubai', 'UAE', 'The United Arab Emirates is an elective monarchy formed from a federation of seven emirates, consisting of Abu Dhabi, Ajman, Dubai, Fujairah, Ras Al Khaimah, Sharjah and Umm Al Quwain.', 'KP01'),
('AR05', 'Gangnam', ' Seoul', 'Seoul, officially known as the Special City of Seoul, is the capital of South Korea which is more than 600 years old and until 1945, the capital of all of Korea. ', 'KP02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `beritaID` char(4) NOT NULL,
  `beritajudul` varchar(60) NOT NULL,
  `beritainti` varchar(1000) NOT NULL,
  `penulis` char(50) NOT NULL,
  `penerbit` varchar(30) NOT NULL,
  `tanggalterbit` date NOT NULL,
  `destinasiID` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`beritaID`, `beritajudul`, `beritainti`, `penulis`, `penerbit`, `tanggalterbit`, `destinasiID`) VALUES
('BT01', 'Paul Walker Meninggal ', 'Insiden Legendaris berpulangnya seorang aktor film F&F ', 'Anton', 'JakartaPos', '2022-08-08', '0002'),
('BT02', 'Lord Rangga Meninggal', 'Tatanan dunia sedang tidak baik baik saja yagesya', 'Jinpachi', 'SundaEmpire', '2022-12-07', '0005'),
('BT03', 'Roger Sumatra', 'Sebuah serigala medan alias roger sumatra terkadang apabila bilek pov jikalau', 'Keeny', 'CenderaWasih', '2022-11-17', '0001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `destinasi`
--

CREATE TABLE `destinasi` (
  `destinasiID` varchar(5) NOT NULL,
  `destinasinama` varchar(35) NOT NULL,
  `destinasialamat` varchar(255) NOT NULL,
  `kategoriID` varchar(4) NOT NULL,
  `areaID` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `destinasi`
--

INSERT INTO `destinasi` (`destinasiID`, `destinasinama`, `destinasialamat`, `kategoriID`, `areaID`) VALUES
('0001', 'Supra', 'Japan', 'KG1', 'AR05'),
('0002', 'Viper', 'USA', 'KG1', 'AR04'),
('0003', 'Skyline ', 'Japan', 'KG2', 'AR01'),
('0004', 'Gallardo ', 'UAE', 'KG1', 'AR04'),
('0005', 'Rolls Royce ', 'Jelambar', 'KG3', 'AR03'),
('0006', 'Ferrari ', 'UAE', 'KG1', 'AR04'),
('0007', 'Lancer', 'UAE', 'KG2', 'AR04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `fotodestinasi`
--

CREATE TABLE `fotodestinasi` (
  `fotoID` varchar(5) NOT NULL,
  `fotonama` varchar(60) NOT NULL,
  `destinasiID` varchar(4) NOT NULL,
  `fotofile` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `fotodestinasi`
--

INSERT INTO `fotodestinasi` (`fotoID`, `fotonama`, `destinasiID`, `fotofile`) VALUES
('0001', 'Supra', '0001', 'Supra4.jpg'),
('0002', 'Viper', '0002', 'Viper5.jpg'),
('0003', 'Skyline ', '0003', 'Skyline3.jpg'),
('0004', 'Gallardo ', '0004', 'Gallardo1.jpg'),
('0005', 'Rolls Royce ', '0005', 'Rolls2.jpg'),
('0006', 'Ferrari ', '0006', 'f40.jpg'),
('0007', 'Lancer', '0007', 'lancer.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hotel`
--

CREATE TABLE `hotel` (
  `hotelID` char(4) NOT NULL,
  `hotelnama` varchar(60) NOT NULL,
  `hotelalamat` varchar(255) NOT NULL,
  `hotelketerangan` varchar(300) NOT NULL,
  `hotelfoto` text NOT NULL,
  `areaID` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `hotel`
--

INSERT INTO `hotel` (`hotelID`, `hotelnama`, `hotelalamat`, `hotelketerangan`, `hotelfoto`, `areaID`) VALUES
('HT01', 'Hotel HOM Abepura', 'Jl. Tanah Hitam Papua', 'Cocok untuk bersantai di hari libur', 'hom.jpg', 'AR03'),
('HT02', 'Hotel Green Kampkey', 'Jl. Kali Acai No.21', 'Hotel yang cocok untuk yang sedang cari tempat cepat', 'dgreen.jpg', 'AR01'),
('HT03', 'Hotel Horison Waena', 'Jl. Padang Bulan No.69', 'Hotel baru dengan suasana fresh', 'horison.jpg', 'AR06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kabupaten`
--

CREATE TABLE `kabupaten` (
  `kabupatenKODE` char(4) NOT NULL,
  `kabupatenNAMA` char(60) NOT NULL,
  `kabupatenALAMAT` varchar(255) NOT NULL,
  `kabupatenKET` text NOT NULL,
  `kabupatenFOTOICON` varchar(255) NOT NULL,
  `kabupatenFOTOICONKET` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kabupaten`
--

INSERT INTO `kabupaten` (`kabupatenKODE`, `kabupatenNAMA`, `kabupatenALAMAT`, `kabupatenKET`, `kabupatenFOTOICON`, `kabupatenFOTOICONKET`) VALUES
('KP01', 'Manado', 'Kota Manado', 'Manado kota laut terindah di indonesia', 'lmanado.png', 'Logo Kabupaten Manado'),
('KP02', 'Papua', 'Kota Jayapura', 'Papua tempat lahir beta', 'lpapua.png', 'Logo Kabupaten Papua'),
('KP03', 'DKI Jakarta', 'Jakarta Barat', 'Daerah administrasi tempat saya kuliah', 'ljakarta.png', 'Logo Kabupaten Jakarta');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `kategoriID` varchar(4) NOT NULL,
  `kategorinama` varchar(30) NOT NULL,
  `kategoriketerangan` varchar(250) NOT NULL,
  `kategorireferensi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`kategoriID`, `kategorinama`, `kategoriketerangan`, `kategorireferensi`) VALUES
('KG1', 'Supercar', 'Sport cars powered with fast speed trail with much horsepower', 'Power'),
('KG2', 'JDM', 'high-performance Japanese model, where exclusively in Japan or in multiple global markets', 'Speed'),
('KG3', 'Exclusive', 'No trail performance but keep up with diamonds and so rare', 'Royal');

-- --------------------------------------------------------

--
-- Struktur dari tabel `makanan`
--

CREATE TABLE `makanan` (
  `makananID` char(4) NOT NULL,
  `makananNama` char(35) NOT NULL,
  `makananKeterangan` varchar(255) NOT NULL,
  `areaID` char(4) NOT NULL,
  `fotoFile` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `makanan`
--

INSERT INTO `makanan` (`makananID`, `makananNama`, `makananKeterangan`, `areaID`, `fotoFile`) VALUES
('MK01', 'Nasi Kuning', 'Nasi kuning adalah makanan khas Indonesia dan memiliki rasa yang lebih gurih daripada nasi putih.', 'AR05', 'naskun.jpg'),
('MK02', 'Nasi Padang', 'Nasi padang adalah nasi putih yang disajikan dengan berbagai macam lauk-pauk khas Indonesia.', 'AR03', 'naspad.jpg'),
('MK03', 'Nasi Kucing', 'Nasi Kucing adalah makanan yang berasal dari Yogyakarta dan porsi nasi kucing yaitu sedikit', 'AR01', 'nascing.jpg'),
('MK04', 'Nasi Lemak', 'Nasi lemak adalah jenis makanan khas suku Melayu yang lazim ditemukan di Malaysia', 'AR02', 'namak.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `movie`
--

CREATE TABLE `movie` (
  `movieID` int(4) NOT NULL,
  `namamovie` varchar(20) NOT NULL,
  `genremovie` varchar(20) NOT NULL,
  `fotoFile` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `movie`
--

INSERT INTO `movie` (`movieID`, `namamovie`, `genremovie`, `fotoFile`) VALUES
(1212, 'Interstellar', 'Sci-Fi', 'ilar.png'),
(1313, 'Fast and Furious', 'Action', 'ff8.png'),
(1414, 'Human Centipede', 'Horror', 'hc.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `provinsi`
--

CREATE TABLE `provinsi` (
  `provinsiID` char(4) NOT NULL,
  `provinsiNama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `provinsi`
--

INSERT INTO `provinsi` (`provinsiID`, `provinsiNama`) VALUES
('PR11', 'Papua'),
('PR22', 'DKI Jakarta'),
('PR33', 'Sulawesi Utara');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rentalmobil`
--

CREATE TABLE `rentalmobil` (
  `platID` char(9) NOT NULL,
  `merkMobil` char(35) NOT NULL,
  `typeMobil` char(35) NOT NULL,
  `areaID` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rentalmobil`
--

INSERT INTO `rentalmobil` (`platID`, `merkMobil`, `typeMobil`, `areaID`) VALUES
('DB1028', 'Honda', 'Civic Type R', 'AR01'),
('DB1212', 'Toyota', 'Fortuner', 'AR06'),
('DB4944', 'BMW', 'M4 2019', 'AR02'),
('DB4969', 'Chevrolet', 'Captiva', 'AR03');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indeks untuk tabel `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`areaID`);

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`beritaID`);

--
-- Indeks untuk tabel `destinasi`
--
ALTER TABLE `destinasi`
  ADD PRIMARY KEY (`destinasiID`);

--
-- Indeks untuk tabel `fotodestinasi`
--
ALTER TABLE `fotodestinasi`
  ADD PRIMARY KEY (`fotoID`);

--
-- Indeks untuk tabel `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`hotelID`);

--
-- Indeks untuk tabel `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD PRIMARY KEY (`kabupatenKODE`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategoriID`);

--
-- Indeks untuk tabel `makanan`
--
ALTER TABLE `makanan`
  ADD PRIMARY KEY (`makananID`);

--
-- Indeks untuk tabel `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`movieID`);

--
-- Indeks untuk tabel `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`provinsiID`);

--
-- Indeks untuk tabel `rentalmobil`
--
ALTER TABLE `rentalmobil`
  ADD PRIMARY KEY (`platID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
