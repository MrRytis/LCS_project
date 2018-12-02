-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2018 at 11:55 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lcs`
--

-- --------------------------------------------------------

--
-- Table structure for table `ataskaitos`
--

CREATE TABLE `ataskaitos` (
  `Ataskaitos_numeris` int(11) NOT NULL,
  `Nuo_kada` date DEFAULT NULL,
  `Iki_kada` date DEFAULT NULL,
  `Sukurimo_data` date DEFAULT NULL,
  `Tipas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ataskaitos_tipai`
--

CREATE TABLE `ataskaitos_tipai` (
  `id` int(11) NOT NULL,
  `name` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ataskaitos_tipai`
--

INSERT INTO `ataskaitos_tipai` (`id`, `name`) VALUES
(1, 'Trasporto');

-- --------------------------------------------------------

--
-- Table structure for table `atsiskaitymai`
--

CREATE TABLE `atsiskaitymai` (
  `Suma` double DEFAULT NULL,
  `Korteles_nr` varchar(255) DEFAULT NULL,
  `Data` date DEFAULT NULL,
  `id` int(11) NOT NULL,
  `fk_Uzsakymasid` int(11) NOT NULL,
  `fk_Klientasid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `busenos`
--

CREATE TABLE `busenos` (
  `Pavadinimas` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `daiktai`
--

CREATE TABLE `daiktai` (
  `Pavadinimas` varchar(255) NOT NULL,
  `Pridejimo_data` date NOT NULL,
  `Nurasymo_Data` date DEFAULT NULL,
  `Verte` double NOT NULL,
  `id` int(11) NOT NULL,
  `fk_Kategorijaid` int(11) DEFAULT NULL,
  `fk_Busenaid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `darbuotojai`
--

CREATE TABLE `darbuotojai` (
  `Atlyginimas` double DEFAULT NULL,
  `id` int(11) NOT NULL,
  `fk_Paskyraid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `itraukti_i`
--

CREATE TABLE `itraukti_i` (
  `fk_AtaskaitaAtaskaitos_numeris` int(11) NOT NULL,
  `fk_Uzsakymasid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kategorijos`
--

CREATE TABLE `kategorijos` (
  `Pavadinimas` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kiekiai`
--

CREATE TABLE `kiekiai` (
  `Kiekis` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `fk_Uzsakymasid` int(11) NOT NULL,
  `fk_Uzsakymasid1` int(11) NOT NULL,
  `fk_Produktasid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `klientai`
--

CREATE TABLE `klientai` (
  `id` int(11) NOT NULL,
  `fk_Paskyraid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `matmenys`
--

CREATE TABLE `matmenys` (
  `id` int(11) NOT NULL,
  `name` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `matmenys`
--

INSERT INTO `matmenys` (`id`, `name`) VALUES
(1, '200x200x60'),
(2, '340x300x60'),
(3, '400x300x60'),
(4, '300x220x155'),
(5, '300x300x100'),
(6, '400x300x250'),
(7, '450x340x375');

-- --------------------------------------------------------

--
-- Table structure for table `medziagu_grupes`
--

CREATE TABLE `medziagu_grupes` (
  `Pavadinimas` varchar(255) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `naudojami_daiktai`
--

CREATE TABLE `naudojami_daiktai` (
  `Paimtas` date NOT NULL,
  `Padetas` date DEFAULT NULL,
  `id` int(11) NOT NULL,
  `fk_Darbuotojasid` int(11) NOT NULL,
  `fk_Daiktasid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `paskyros`
--

CREATE TABLE `paskyros` (
  `Vardas` varchar(255) NOT NULL,
  `Pavarde` varchar(255) NOT NULL,
  `E_pastas` varchar(255) NOT NULL,
  `Slaptazodis` varchar(255) NOT NULL,
  `Registracijos_data` date NOT NULL,
  `Paskutinio_prisijungimo_data` date DEFAULT NULL,
  `Tipas` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `fk_Paskyros_prasymasid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `paskyru_prasymai`
--

CREATE TABLE `paskyru_prasymai` (
  `Vardas` varchar(255) DEFAULT NULL,
  `Pavarde` varchar(255) DEFAULT NULL,
  `E_pastas` varchar(255) DEFAULT NULL,
  `Uzpildymo_data` date DEFAULT NULL,
  `Patvirtinta` tinyint(1) DEFAULT NULL,
  `Tipas` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `fk_Darbuotojasid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `produktai`
--

CREATE TABLE `produktai` (
  `Pavadinimas` varchar(255) DEFAULT NULL,
  `Kaina` double DEFAULT NULL,
  `Sukurimo_data` date DEFAULT NULL,
  `id` int(11) NOT NULL,
  `fk_Medziagu_grupeid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `siuntimo_budai`
--

CREATE TABLE `siuntimo_budai` (
  `id` int(11) NOT NULL,
  `name` char(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siuntimo_budai`
--

INSERT INTO `siuntimo_budai` (`id`, `name`) VALUES
(1, 'paštu'),
(2, 'kurjeriu');

-- --------------------------------------------------------

--
-- Table structure for table `tiekejai`
--

CREATE TABLE `tiekejai` (
  `Vardas` varchar(255) DEFAULT NULL,
  `Firmos_pav` varchar(255) DEFAULT NULL,
  `E_pastas` varchar(255) DEFAULT NULL,
  `Vadybininkas` varchar(255) DEFAULT NULL,
  `Fakturos_Nr` int(11) DEFAULT NULL,
  `Vadybininko_e_pastas` varchar(255) DEFAULT NULL,
  `Sukurimo_data` date DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tiekejo_produktai`
--

CREATE TABLE `tiekejo_produktai` (
  `Sukurimo_data` date DEFAULT NULL,
  `id` int(11) NOT NULL,
  `fk_Produktasid` int(11) NOT NULL,
  `fk_Tiekejasid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transportavimai`
--

CREATE TABLE `transportavimai` (
  `Pristatymo_adresas` varchar(255) DEFAULT NULL,
  `Issiuntimo_adresas` varchar(255) DEFAULT NULL,
  `Siuntimo_budas` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `fk_Uzsakymasid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `uzpildai`
--

CREATE TABLE `uzpildai` (
  `id` int(11) NOT NULL,
  `name` char(17) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uzpildai`
--

INSERT INTO `uzpildai` (`id`, `name`) VALUES
(1, 'be_užpido'),
(2, 'granulės'),
(3, 'burbulinė_plėvelė');

-- --------------------------------------------------------

--
-- Table structure for table `uzsakymai`
--

CREATE TABLE `uzsakymai` (
  `Data` date DEFAULT NULL,
  `Apmokejima_busena` tinyint(1) DEFAULT NULL,
  `Draudimas` tinyint(1) DEFAULT NULL,
  `Sekimas` tinyint(1) DEFAULT NULL,
  `Pakuotes_ismatavimai` int(11) DEFAULT NULL,
  `Pakuotes_uzpildas` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `fk_Klientasid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vartotoju_roles`
--

CREATE TABLE `vartotoju_roles` (
  `id` int(11) NOT NULL,
  `name` char(21) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vartotoju_roles`
--

INSERT INTO `vartotoju_roles` (`id`, `name`) VALUES
(1, 'ROLE_KLIENTAS'),
(2, 'ROLE_DARBUOTOJAS'),
(3, 'ROLE_ADMINISTRATORIUS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ataskaitos`
--
ALTER TABLE `ataskaitos`
  ADD PRIMARY KEY (`Ataskaitos_numeris`),
  ADD KEY `Tipas` (`Tipas`);

--
-- Indexes for table `ataskaitos_tipai`
--
ALTER TABLE `ataskaitos_tipai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `atsiskaitymai`
--
ALTER TABLE `atsiskaitymai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fk_Uzsakymasid` (`fk_Uzsakymasid`),
  ADD UNIQUE KEY `fk_Klientasid` (`fk_Klientasid`);

--
-- Indexes for table `busenos`
--
ALTER TABLE `busenos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daiktai`
--
ALTER TABLE `daiktai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Priklauso1` (`fk_Kategorijaid`),
  ADD KEY `Turi7` (`fk_Busenaid`);

--
-- Indexes for table `darbuotojai`
--
ALTER TABLE `darbuotojai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fk_Paskyraid` (`fk_Paskyraid`);

--
-- Indexes for table `itraukti_i`
--
ALTER TABLE `itraukti_i`
  ADD PRIMARY KEY (`fk_AtaskaitaAtaskaitos_numeris`,`fk_Uzsakymasid`);

--
-- Indexes for table `kategorijos`
--
ALTER TABLE `kategorijos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kiekiai`
--
ALTER TABLE `kiekiai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fk_Uzsakymasid1` (`fk_Uzsakymasid1`),
  ADD KEY `Turi_tiek` (`fk_Uzsakymasid`),
  ADD KEY `Turi6` (`fk_Produktasid`);

--
-- Indexes for table `klientai`
--
ALTER TABLE `klientai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fk_Paskyraid` (`fk_Paskyraid`);

--
-- Indexes for table `matmenys`
--
ALTER TABLE `matmenys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medziagu_grupes`
--
ALTER TABLE `medziagu_grupes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `naudojami_daiktai`
--
ALTER TABLE `naudojami_daiktai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Naudoja` (`fk_Darbuotojasid`),
  ADD KEY `Paimtas` (`fk_Daiktasid`);

--
-- Indexes for table `paskyros`
--
ALTER TABLE `paskyros`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fk_Paskyros_prasymasid` (`fk_Paskyros_prasymasid`),
  ADD KEY `Tipas` (`Tipas`);

--
-- Indexes for table `paskyru_prasymai`
--
ALTER TABLE `paskyru_prasymai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Tipas` (`Tipas`),
  ADD KEY `Patvirtina` (`fk_Darbuotojasid`);

--
-- Indexes for table `produktai`
--
ALTER TABLE `produktai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Apibudina` (`fk_Medziagu_grupeid`);

--
-- Indexes for table `siuntimo_budai`
--
ALTER TABLE `siuntimo_budai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tiekejai`
--
ALTER TABLE `tiekejai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tiekejo_produktai`
--
ALTER TABLE `tiekejo_produktai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Itraukta_i` (`fk_Produktasid`),
  ADD KEY `Tiekia` (`fk_Tiekejasid`);

--
-- Indexes for table `transportavimai`
--
ALTER TABLE `transportavimai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Siuntimo_budas` (`Siuntimo_budas`),
  ADD KEY `turi_priskirta` (`fk_Uzsakymasid`);

--
-- Indexes for table `uzpildai`
--
ALTER TABLE `uzpildai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uzsakymai`
--
ALTER TABLE `uzsakymai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Pakuotes_ismatavimai` (`Pakuotes_ismatavimai`),
  ADD KEY `Pakuotes_uzpildas` (`Pakuotes_uzpildas`),
  ADD KEY `Priklauso2` (`fk_Klientasid`);

--
-- Indexes for table `vartotoju_roles`
--
ALTER TABLE `vartotoju_roles`
  ADD PRIMARY KEY (`id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ataskaitos`
--
ALTER TABLE `ataskaitos`
  ADD CONSTRAINT `ataskaitos_ibfk_1` FOREIGN KEY (`Tipas`) REFERENCES `ataskaitos_tipai` (`id`);

--
-- Constraints for table `atsiskaitymai`
--
ALTER TABLE `atsiskaitymai`
  ADD CONSTRAINT `Susijas` FOREIGN KEY (`fk_Uzsakymasid`) REFERENCES `uzsakymai` (`id`),
  ADD CONSTRAINT `Turi_buti_apmoketas` FOREIGN KEY (`fk_Klientasid`) REFERENCES `klientai` (`id`);

--
-- Constraints for table `daiktai`
--
ALTER TABLE `daiktai`
  ADD CONSTRAINT `Priklauso1` FOREIGN KEY (`fk_Kategorijaid`) REFERENCES `kategorijos` (`id`),
  ADD CONSTRAINT `Turi7` FOREIGN KEY (`fk_Busenaid`) REFERENCES `busenos` (`id`);

--
-- Constraints for table `darbuotojai`
--
ALTER TABLE `darbuotojai`
  ADD CONSTRAINT `Turi3` FOREIGN KEY (`fk_Paskyraid`) REFERENCES `paskyros` (`id`);

--
-- Constraints for table `itraukti_i`
--
ALTER TABLE `itraukti_i`
  ADD CONSTRAINT `Itrauktas_i` FOREIGN KEY (`fk_AtaskaitaAtaskaitos_numeris`) REFERENCES `ataskaitos` (`Ataskaitos_numeris`);

--
-- Constraints for table `kiekiai`
--
ALTER TABLE `kiekiai`
  ADD CONSTRAINT `Turi6` FOREIGN KEY (`fk_Produktasid`) REFERENCES `produktai` (`id`),
  ADD CONSTRAINT `Turi_tiek` FOREIGN KEY (`fk_Uzsakymasid`) REFERENCES `uzsakymai` (`id`),
  ADD CONSTRAINT `kiekiai_ibfk_1` FOREIGN KEY (`fk_Uzsakymasid1`) REFERENCES `uzsakymai` (`id`);

--
-- Constraints for table `klientai`
--
ALTER TABLE `klientai`
  ADD CONSTRAINT `Turi2` FOREIGN KEY (`fk_Paskyraid`) REFERENCES `paskyros` (`id`);

--
-- Constraints for table `naudojami_daiktai`
--
ALTER TABLE `naudojami_daiktai`
  ADD CONSTRAINT `Naudoja` FOREIGN KEY (`fk_Darbuotojasid`) REFERENCES `darbuotojai` (`id`),
  ADD CONSTRAINT `Paimtas` FOREIGN KEY (`fk_Daiktasid`) REFERENCES `daiktai` (`id`);

--
-- Constraints for table `paskyros`
--
ALTER TABLE `paskyros`
  ADD CONSTRAINT `Turi1` FOREIGN KEY (`fk_Paskyros_prasymasid`) REFERENCES `paskyru_prasymai` (`id`),
  ADD CONSTRAINT `paskyros_ibfk_1` FOREIGN KEY (`Tipas`) REFERENCES `vartotoju_roles` (`id`);

--
-- Constraints for table `paskyru_prasymai`
--
ALTER TABLE `paskyru_prasymai`
  ADD CONSTRAINT `Patvirtina` FOREIGN KEY (`fk_Darbuotojasid`) REFERENCES `darbuotojai` (`id`),
  ADD CONSTRAINT `paskyru_prasymai_ibfk_1` FOREIGN KEY (`Tipas`) REFERENCES `vartotoju_roles` (`id`);

--
-- Constraints for table `produktai`
--
ALTER TABLE `produktai`
  ADD CONSTRAINT `Apibudina` FOREIGN KEY (`fk_Medziagu_grupeid`) REFERENCES `medziagu_grupes` (`id`);

--
-- Constraints for table `tiekejo_produktai`
--
ALTER TABLE `tiekejo_produktai`
  ADD CONSTRAINT `Itraukta_i` FOREIGN KEY (`fk_Produktasid`) REFERENCES `produktai` (`id`),
  ADD CONSTRAINT `Tiekia` FOREIGN KEY (`fk_Tiekejasid`) REFERENCES `tiekejai` (`id`);

--
-- Constraints for table `transportavimai`
--
ALTER TABLE `transportavimai`
  ADD CONSTRAINT `transportavimai_ibfk_1` FOREIGN KEY (`Siuntimo_budas`) REFERENCES `siuntimo_budai` (`id`),
  ADD CONSTRAINT `turi_priskirta` FOREIGN KEY (`fk_Uzsakymasid`) REFERENCES `uzsakymai` (`id`);

--
-- Constraints for table `uzsakymai`
--
ALTER TABLE `uzsakymai`
  ADD CONSTRAINT `Priklauso2` FOREIGN KEY (`fk_Klientasid`) REFERENCES `klientai` (`id`),
  ADD CONSTRAINT `uzsakymai_ibfk_1` FOREIGN KEY (`Pakuotes_ismatavimai`) REFERENCES `matmenys` (`id`),
  ADD CONSTRAINT `uzsakymai_ibfk_2` FOREIGN KEY (`Pakuotes_uzpildas`) REFERENCES `uzpildai` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
