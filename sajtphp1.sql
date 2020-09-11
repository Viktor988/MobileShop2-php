-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2019 at 06:13 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sajtphp1`
--

-- --------------------------------------------------------

--
-- Table structure for table `anketaodgovori`
--

CREATE TABLE `anketaodgovori` (
  `idOdgovora` int(10) NOT NULL,
  `idPitanja` int(11) NOT NULL,
  `odgovori` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anketaodgovori`
--

INSERT INTO `anketaodgovori` (`idOdgovora`, `idPitanja`, `odgovori`) VALUES
(1, 1, 'Samsung'),
(2, 1, 'Huawei'),
(3, 1, 'Xiaomi');

-- --------------------------------------------------------

--
-- Table structure for table `anketapitanja`
--

CREATE TABLE `anketapitanja` (
  `idPitanja` int(10) NOT NULL,
  `tekstPitanja` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `aktivna` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anketapitanja`
--

INSERT INTO `anketapitanja` (`idPitanja`, `tekstPitanja`, `aktivna`) VALUES
(1, 'Koja vam je omiljena marka telefona?', 1);

-- --------------------------------------------------------

--
-- Table structure for table `anketarezultati`
--

CREATE TABLE `anketarezultati` (
  `idRezultat` int(10) NOT NULL,
  `idPitanja` int(10) NOT NULL,
  `idOdgovora` int(10) NOT NULL,
  `rezultat` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anketarezultati`
--

INSERT INTO `anketarezultati` (`idRezultat`, `idPitanja`, `idOdgovora`, `rezultat`) VALUES
(4, 1, 1, 23),
(5, 1, 2, 32),
(6, 1, 3, 43);

-- --------------------------------------------------------

--
-- Table structure for table `faikonice`
--

CREATE TABLE `faikonice` (
  `idIkonice` int(11) NOT NULL,
  `link` varchar(100) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `text` varchar(100) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faikonice`
--

INSERT INTO `faikonice` (`idIkonice`, `link`, `text`) VALUES
(5, 'www.facebook.com/', 'fab fa-facebook'),
(6, 'https://www.instagram.com/?hl=sr', 'fab fa-instagram'),
(7, 'https://twitter.com/?lang=sr', 'fab fa-twitter-square'),
(8, 'https://plus.google.com/up/?continue=https://plus.google.com/people', 'fab fa-google-plus-g');

-- --------------------------------------------------------

--
-- Table structure for table `glasanje`
--

CREATE TABLE `glasanje` (
  `idGlasanja` int(10) NOT NULL,
  `idOdgovora` int(10) NOT NULL,
  `idkorisnik` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `glasanje`
--

INSERT INTO `glasanje` (`idGlasanja`, `idOdgovora`, `idkorisnik`) VALUES
(37, 3, 222);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `idkorisnik` int(11) NOT NULL,
  `ime_i_prezime` varchar(100) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `lozinka` varchar(100) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `lozinkaponovo` varchar(100) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `pol` varchar(20) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `iduloga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`idkorisnik`, `ime_i_prezime`, `email`, `lozinka`, `lozinkaponovo`, `pol`, `iduloga`) VALUES
(222, 'Viktor Ciriccs', 'viktorciric31@gmail.com', 'viktor981', 'viktor981', 'Muski', 2),
(223, 'Viktor Ciricc', 'dnijela@gmail.com', 'viktor98', 'viktor98', 'Zenski', 1),
(224, 'Djkk Vikkkk', 'viktorciric33@gmail.com', 'viktor98', 'viktor98', 'Zenski', 1);

-- --------------------------------------------------------

--
-- Table structure for table `korpa`
--

CREATE TABLE `korpa` (
  `idkorpa` int(200) NOT NULL,
  `idProizvod` int(50) NOT NULL,
  `idkorisnik` int(11) NOT NULL,
  `kolicina` int(10) NOT NULL,
  `Vreme` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `korpa`
--

INSERT INTO `korpa` (`idkorpa`, `idProizvod`, `idkorisnik`, `kolicina`, `Vreme`) VALUES
(1, 17, 222, 1, '2019-06-13 10:42:53'),
(2, 18, 222, 1, '2019-06-13 10:42:55'),
(3, 20, 222, 2, '2019-06-13 10:42:57'),
(4, 18, 223, 1, '2019-06-13 10:44:48');

-- --------------------------------------------------------

--
-- Table structure for table `marka`
--

CREATE TABLE `marka` (
  `idMarka` int(50) NOT NULL,
  `Naziv` varchar(50) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marka`
--

INSERT INTO `marka` (`idMarka`, `Naziv`) VALUES
(1, 'Samsung'),
(4, 'Xiaomi'),
(5, 'Huawei');

-- --------------------------------------------------------

--
-- Table structure for table `meni`
--

CREATE TABLE `meni` (
  `idMeni` int(25) NOT NULL,
  `link` varchar(50) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `text` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meni`
--

INSERT INTO `meni` (`idMeni`, `link`, `text`, `status`) VALUES
(1, 'pocetna', 'Početna', 0),
(2, 'kontakt', 'Kontakt', 0),
(3, 'autor', 'Autor', 0),
(4, 'registracija', 'Registracija', 2),
(5, 'prijava', 'Prijava', 2),
(6, 'odjava', 'Odjavite se', 3),
(7, 'admin', 'Admin', 1),
(8, 'korpaprikaz', '<i class=\"fas fa-shopping-cart\" id=\"linkkorpa\"></i>', 3);

-- --------------------------------------------------------

--
-- Table structure for table `proizvodi`
--

CREATE TABLE `proizvodi` (
  `idProizvod` int(50) NOT NULL,
  `Model` varchar(50) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `Opis` text CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `cena` decimal(10,0) NOT NULL,
  `idMarka` int(50) NOT NULL,
  `idslika` int(10) NOT NULL,
  `datumPostavljanja` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proizvodi`
--

INSERT INTO `proizvodi` (`idProizvod`, `Model`, `Opis`, `cena`, `idMarka`, `idslika`, `datumPostavljanja`) VALUES
(10, 'P20 lite', 'Crna ,6.0\", Quad Core, 3 GB, 13.0 Mpix + 5.0 Mpix ', '41000', 5, 249, '2019-06-01 15:46:18'),
(11, 'Redmi Note 5', 'Crna ,6.0\", Quad Core, 3 GB, 13.0 Mpix + 5.0 Mpix ', '29000', 4, 250, '2019-06-01 15:47:01'),
(12, 'S7', 'Crna ,6.0\", Quad Core, 3 GB, 13.0 Mpix + 5.0 Mpix ', '45000', 1, 251, '2019-06-01 15:47:38'),
(15, 'Y3', 'Crna ,6.0\", Quad Core, 3 GB, 13.0 Mpix + 5.0 Mpix ', '54000', 5, 254, '2019-06-01 15:51:20'),
(17, 'Mi mix', 'Crna ,6.0\", Quad Core, 3 GB, 13.0 Mpix + 5.0 Mpix ', '28000', 4, 256, '2019-06-01 15:54:23'),
(18, 'Y7', 'Crna ,6.0\", Quad Core, 3 GB, 13.0 Mpix + 5.0 Mpix ', '42000', 5, 257, '2019-06-01 15:57:27'),
(20, 'S4', ' Crna ,6.0\", Quad Core, 3 GB, 13.0 Mpix + 5.0 Mpix', '12000', 1, 263, '2019-09-26 16:10:53');

-- --------------------------------------------------------

--
-- Table structure for table `slike`
--

CREATE TABLE `slike` (
  `idslika` int(10) NOT NULL,
  `name` varchar(150) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `size` varchar(30) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `type` varchar(50) NOT NULL,
  `mala_slika` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `velika_slika` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slike`
--

INSERT INTO `slike` (`idslika`, `name`, `size`, `type`, `mala_slika`, `velika_slika`) VALUES
(249, 'hua1.png', '110646', '0', 'assets/slike/1559403956malahua1.png', 'assets/slike/1559403956velikahua1.png'),
(250, 'C:xampp	mpphpE1F5.tmp', '129618', '0', 'assets/slike/1559404771malaxiaomi2.png', 'assets/slike/1559404771velikaxiaomi2.png'),
(251, 'sam3.png', '131381', '0', 'assets/slike/1559404058malasam3.png', 'assets/slike/1559404058velikasam3.png'),
(252, 'xiaomi3.png', '109789', '0', 'assets/slike/1559404139malaxiaomi3.png', 'assets/slike/1559404139velikaxiaomi3.png'),
(254, 'hua3.png', '112953', '0', 'assets/slike/1559404280malahua3.png', 'assets/slike/1559404280velikahua3.png'),
(255, 'xiaomi4.png', '33262', '0', 'assets/slike/1559404319malaxiaomi4.png', 'assets/slike/1559404319velikaxiaomi4.png'),
(256, 'xiaomi3.png', '53155', '0', 'assets/slike/1559404462malaxiaomi3.png', 'assets/slike/1559404462velikaxiaomi3.png'),
(257, 'hua3.png', '30859', '0', 'assets/slike/1559404647malahua3.png', 'assets/slike/1559404647velikahua3.png'),
(263, 'xiaomi4.png', '33262', 'image/png', 'assets/slike/1560289795malaxiaomi4.png', 'assets/slike/1560289795velikaxiaomi4.png');

-- --------------------------------------------------------

--
-- Table structure for table `uloge`
--

CREATE TABLE `uloge` (
  `iduloga` int(11) NOT NULL,
  `naziv` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uloge`
--

INSERT INTO `uloge` (`iduloga`, `naziv`) VALUES
(1, 'korisnik'),
(2, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anketaodgovori`
--
ALTER TABLE `anketaodgovori`
  ADD PRIMARY KEY (`idOdgovora`),
  ADD KEY `idPitanja` (`idPitanja`);

--
-- Indexes for table `anketapitanja`
--
ALTER TABLE `anketapitanja`
  ADD PRIMARY KEY (`idPitanja`);

--
-- Indexes for table `anketarezultati`
--
ALTER TABLE `anketarezultati`
  ADD PRIMARY KEY (`idRezultat`),
  ADD KEY `idPitanja` (`idPitanja`),
  ADD KEY `idOdgovora` (`idOdgovora`);

--
-- Indexes for table `faikonice`
--
ALTER TABLE `faikonice`
  ADD PRIMARY KEY (`idIkonice`);

--
-- Indexes for table `glasanje`
--
ALTER TABLE `glasanje`
  ADD PRIMARY KEY (`idGlasanja`),
  ADD KEY `idOdgovora` (`idOdgovora`),
  ADD KEY `idkorisnik` (`idkorisnik`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`idkorisnik`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `iduloga` (`iduloga`);

--
-- Indexes for table `korpa`
--
ALTER TABLE `korpa`
  ADD PRIMARY KEY (`idkorpa`),
  ADD KEY `idProizvod` (`idProizvod`),
  ADD KEY `idkorisnik` (`idkorisnik`);

--
-- Indexes for table `marka`
--
ALTER TABLE `marka`
  ADD PRIMARY KEY (`idMarka`);

--
-- Indexes for table `meni`
--
ALTER TABLE `meni`
  ADD PRIMARY KEY (`idMeni`);

--
-- Indexes for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD PRIMARY KEY (`idProizvod`),
  ADD KEY `idMarka` (`idMarka`),
  ADD KEY `idslika` (`idslika`);

--
-- Indexes for table `slike`
--
ALTER TABLE `slike`
  ADD PRIMARY KEY (`idslika`);

--
-- Indexes for table `uloge`
--
ALTER TABLE `uloge`
  ADD PRIMARY KEY (`iduloga`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anketaodgovori`
--
ALTER TABLE `anketaodgovori`
  MODIFY `idOdgovora` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `anketapitanja`
--
ALTER TABLE `anketapitanja`
  MODIFY `idPitanja` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `anketarezultati`
--
ALTER TABLE `anketarezultati`
  MODIFY `idRezultat` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `faikonice`
--
ALTER TABLE `faikonice`
  MODIFY `idIkonice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `glasanje`
--
ALTER TABLE `glasanje`
  MODIFY `idGlasanja` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `idkorisnik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- AUTO_INCREMENT for table `korpa`
--
ALTER TABLE `korpa`
  MODIFY `idkorpa` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `marka`
--
ALTER TABLE `marka`
  MODIFY `idMarka` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `meni`
--
ALTER TABLE `meni`
  MODIFY `idMeni` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `proizvodi`
--
ALTER TABLE `proizvodi`
  MODIFY `idProizvod` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `slike`
--
ALTER TABLE `slike`
  MODIFY `idslika` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=264;

--
-- AUTO_INCREMENT for table `uloge`
--
ALTER TABLE `uloge`
  MODIFY `iduloga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anketaodgovori`
--
ALTER TABLE `anketaodgovori`
  ADD CONSTRAINT `anketaodgovori_ibfk_1` FOREIGN KEY (`idPitanja`) REFERENCES `anketapitanja` (`idPitanja`);

--
-- Constraints for table `anketarezultati`
--
ALTER TABLE `anketarezultati`
  ADD CONSTRAINT `anketarezultati_ibfk_1` FOREIGN KEY (`idOdgovora`) REFERENCES `anketaodgovori` (`idOdgovora`);

--
-- Constraints for table `glasanje`
--
ALTER TABLE `glasanje`
  ADD CONSTRAINT `glasanje_ibfk_1` FOREIGN KEY (`idOdgovora`) REFERENCES `anketaodgovori` (`idOdgovora`),
  ADD CONSTRAINT `glasanje_ibfk_2` FOREIGN KEY (`idkorisnik`) REFERENCES `korisnik` (`idkorisnik`);

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `korisnik_ibfk_1` FOREIGN KEY (`iduloga`) REFERENCES `uloge` (`iduloga`);

--
-- Constraints for table `korpa`
--
ALTER TABLE `korpa`
  ADD CONSTRAINT `korpa_ibfk_1` FOREIGN KEY (`idkorisnik`) REFERENCES `korisnik` (`idkorisnik`),
  ADD CONSTRAINT `korpa_ibfk_2` FOREIGN KEY (`idProizvod`) REFERENCES `proizvodi` (`idProizvod`);

--
-- Constraints for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD CONSTRAINT `proizvodi_ibfk_1` FOREIGN KEY (`idslika`) REFERENCES `slike` (`idslika`),
  ADD CONSTRAINT `proizvodi_ibfk_2` FOREIGN KEY (`idMarka`) REFERENCES `marka` (`idMarka`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
