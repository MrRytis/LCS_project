-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2018 at 08:41 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

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
-- Table structure for table `ataskaita`
--

CREATE TABLE `ataskaita` (
  `Ataskaitos_numeris` int(11) NOT NULL,
  `Nuo_kada` date DEFAULT NULL,
  `Iki_kada` date DEFAULT NULL,
  `Sukurimo_data` date DEFAULT NULL,
  `Tipas` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ataskaitos_tipai`
--

CREATE TABLE `ataskaitos_tipai` (
  `id` int(5) NOT NULL,
  `at_tipas` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ataskaitos_tipai`
--

INSERT INTO `ataskaitos_tipai` (`id`, `at_tipas`) VALUES
(1, 'Transporto');

-- --------------------------------------------------------

--
-- Table structure for table `atsiskaitymas`
--

CREATE TABLE `atsiskaitymas` (
  `Suma` double DEFAULT NULL,
  `Korteles_nr` varchar(255) DEFAULT NULL,
  `Data` date DEFAULT NULL,
  `id` int(11) NOT NULL,
  `fk_Uzsakymasid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `busena`
--

CREATE TABLE `busena` (
  `Pavadinimas` varchar(255) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `fk_Daiktasid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `daiktas`
--

CREATE TABLE `daiktas` (
  `Pavadinimas` varchar(255) DEFAULT NULL,
  `Pridejimo_data` date DEFAULT NULL,
  `Nurasymo_Data` date DEFAULT NULL,
  `Verte` double DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `darbuotojas`
--

CREATE TABLE `darbuotojas` (
  `Atlyginimas` double DEFAULT NULL,
  `fk_Paskyraid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `itrauktas_i`
--

CREATE TABLE `itrauktas_i` (
  `fk_AtaskaitaAtaskaitos_numeris` int(11) NOT NULL,
  `fk_Uzsakymasid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kategorija`
--

CREATE TABLE `kategorija` (
  `Pavadinimas` varchar(255) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `fk_Daiktasid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kiekis`
--

CREATE TABLE `kiekis` (
  `Kiekis` int(11) DEFAULT NULL,
  `fk_Uzsakymasid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `klientas`
--

CREATE TABLE `klientas` (
  `fk_Paskyra_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `matmenys`
--

CREATE TABLE `matmenys` (
  `id` int(5) NOT NULL,
  `matmuo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matmenys`
--

INSERT INTO `matmenys` (`id`, `matmuo`) VALUES
(1, '200x200x60'),
(2, '340x300x60');

-- --------------------------------------------------------

--
-- Table structure for table `medziagu_grupe`
--

CREATE TABLE `medziagu_grupe` (
  `Pavadinimas` varchar(255) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `naudojamas_daiktas`
--

CREATE TABLE `naudojamas_daiktas` (
  `Paimtas` date DEFAULT NULL,
  `Padetas` date DEFAULT NULL,
  `fk_Daiktasid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paskyra`
--

CREATE TABLE `paskyra` (
  `Vardas` varchar(255) DEFAULT NULL,
  `Pavarde` varchar(255) DEFAULT NULL,
  `E_pastas` varchar(255) DEFAULT NULL,
  `Slaptazodis` varchar(255) DEFAULT NULL,
  `Registracijos_data` date DEFAULT NULL,
  `Paskutinio_prisijungimo_data` date DEFAULT NULL,
  `Patvirtinta` tinyint(1) DEFAULT NULL,
  `Tipas` int(5) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prisijungimas`
--

CREATE TABLE `prisijungimas` (
  `Sausainelis` varchar(255) NOT NULL,
  `Pasibaigimo_data` date DEFAULT NULL,
  `fk_Paskyraid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `produktas`
--

CREATE TABLE `produktas` (
  `Pavadinimas` varchar(255) DEFAULT NULL,
  `Kaina` double DEFAULT NULL,
  `Sukurimo_data` date DEFAULT NULL,
  `id` int(11) NOT NULL,
  `fk_Medziagu_grupeid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `siuntimo_budai`
--

CREATE TABLE `siuntimo_budai` (
  `id` int(5) NOT NULL,
  `budas` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tiekejas`
--

CREATE TABLE `tiekejas` (
  `Vardas` varchar(255) DEFAULT NULL,
  `Firmos_pav` varchar(255) DEFAULT NULL,
  `E_pastas` varchar(255) DEFAULT NULL,
  `Vadybininkas` varchar(255) DEFAULT NULL,
  `Fakturos_Nr` int(11) DEFAULT NULL,
  `Vadybininko_e_pastas` varchar(255) DEFAULT NULL,
  `Sukurimo_data` date DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tiekejo_produktas`
--

CREATE TABLE `tiekejo_produktas` (
  `Sukurimo_data` date DEFAULT NULL,
  `fk_Tiekejasid` int(11) NOT NULL,
  `fk_Produktasid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transportavimas`
--

CREATE TABLE `transportavimas` (
  `Pristatymo_adresas` varchar(255) DEFAULT NULL,
  `Išsiuntimo_adresas` varchar(255) DEFAULT NULL,
  `Siuntimo_budas` int(5) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `fk_Uzsakymasid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `turi`
--

CREATE TABLE `turi` (
  `fk_Produktasid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `uzpildai`
--

CREATE TABLE `uzpildai` (
  `id` int(5) NOT NULL,
  `uzpildymo_tipas` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uzpildai`
--

INSERT INTO `uzpildai` (`id`, `uzpildymo_tipas`) VALUES
(1, 'Be užpildo'),
(2, 'Granules'),
(6, 'Burbuline_plevele');

-- --------------------------------------------------------

--
-- Table structure for table `uzsakymas`
--

CREATE TABLE `uzsakymas` (
  `Data` date DEFAULT NULL,
  `Apmokejima_busena` tinyint(1) DEFAULT NULL,
  `Draudimas` tinyint(1) DEFAULT NULL,
  `Sekimas` tinyint(1) DEFAULT NULL,
  `Pakuotes_ismatavimai` int(5) DEFAULT NULL,
  `Pakuotes_uzpildas` int(5) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vartotoju_tipai`
--

CREATE TABLE `vartotoju_tipai` (
  `id` int(5) NOT NULL,
  `tipas_pav` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vartotoju_tipai`
--

INSERT INTO `vartotoju_tipai` (`id`, `tipas_pav`) VALUES
(1, 'Klientas'),
(2, 'Darbuotojas'),
(3, 'Administratorius');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ataskaita`
--
ALTER TABLE `ataskaita`
  ADD PRIMARY KEY (`Ataskaitos_numeris`),
  ADD KEY `fk_ataskaitos_tipas` (`Tipas`);

--
-- Indexes for table `ataskaitos_tipai`
--
ALTER TABLE `ataskaitos_tipai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `atsiskaitymas`
--
ALTER TABLE `atsiskaitymas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fk_Uzsakymasid` (`fk_Uzsakymasid`);

--
-- Indexes for table `busena`
--
ALTER TABLE `busena`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Turi_3` (`fk_Daiktasid`);

--
-- Indexes for table `daiktas`
--
ALTER TABLE `daiktas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `darbuotojas`
--
ALTER TABLE `darbuotojas`
  ADD UNIQUE KEY `fk_Paskyraid` (`fk_Paskyraid`);

--
-- Indexes for table `itrauktas_i`
--
ALTER TABLE `itrauktas_i`
  ADD PRIMARY KEY (`fk_AtaskaitaAtaskaitos_numeris`,`fk_Uzsakymasid`);

--
-- Indexes for table `kategorija`
--
ALTER TABLE `kategorija`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Priklauso` (`fk_Daiktasid`);

--
-- Indexes for table `kiekis`
--
ALTER TABLE `kiekis`
  ADD KEY `Turi_tiek` (`fk_Uzsakymasid`);

--
-- Indexes for table `klientas`
--
ALTER TABLE `klientas`
  ADD UNIQUE KEY `fk_Paskyra_id` (`fk_Paskyra_id`);

--
-- Indexes for table `matmenys`
--
ALTER TABLE `matmenys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medziagu_grupe`
--
ALTER TABLE `medziagu_grupe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `naudojamas_daiktas`
--
ALTER TABLE `naudojamas_daiktas`
  ADD KEY `Paimtas` (`fk_Daiktasid`);

--
-- Indexes for table `paskyra`
--
ALTER TABLE `paskyra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Var_Tipas` (`Tipas`);

--
-- Indexes for table `prisijungimas`
--
ALTER TABLE `prisijungimas`
  ADD PRIMARY KEY (`Sausainelis`),
  ADD KEY `Turi` (`fk_Paskyraid`);

--
-- Indexes for table `produktas`
--
ALTER TABLE `produktas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Apibudina` (`fk_Medziagu_grupeid`);

--
-- Indexes for table `siuntimo_budai`
--
ALTER TABLE `siuntimo_budai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tiekejas`
--
ALTER TABLE `tiekejas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tiekejo_produktas`
--
ALTER TABLE `tiekejo_produktas`
  ADD KEY `Tiekia` (`fk_Tiekejasid`),
  ADD KEY `Itraukta_i` (`fk_Produktasid`);

--
-- Indexes for table `transportavimas`
--
ALTER TABLE `transportavimas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `turi_priskirta` (`fk_Uzsakymasid`),
  ADD KEY `fk_transportavimo_tipas` (`Siuntimo_budas`);

--
-- Indexes for table `turi`
--
ALTER TABLE `turi`
  ADD PRIMARY KEY (`fk_Produktasid`);

--
-- Indexes for table `uzpildai`
--
ALTER TABLE `uzpildai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uzsakymas`
--
ALTER TABLE `uzsakymas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pakuotes_uzpildas` (`Pakuotes_uzpildas`),
  ADD KEY `fk_pakuotes_matmenys` (`Pakuotes_ismatavimai`);

--
-- Indexes for table `vartotoju_tipai`
--
ALTER TABLE `vartotoju_tipai`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ataskaita`
--
ALTER TABLE `ataskaita`
  MODIFY `Ataskaitos_numeris` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ataskaitos_tipai`
--
ALTER TABLE `ataskaitos_tipai`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `atsiskaitymas`
--
ALTER TABLE `atsiskaitymas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `busena`
--
ALTER TABLE `busena`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `daiktas`
--
ALTER TABLE `daiktas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategorija`
--
ALTER TABLE `kategorija`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `matmenys`
--
ALTER TABLE `matmenys`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `medziagu_grupe`
--
ALTER TABLE `medziagu_grupe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paskyra`
--
ALTER TABLE `paskyra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produktas`
--
ALTER TABLE `produktas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tiekejas`
--
ALTER TABLE `tiekejas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transportavimas`
--
ALTER TABLE `transportavimas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uzpildai`
--
ALTER TABLE `uzpildai`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `uzsakymas`
--
ALTER TABLE `uzsakymas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vartotoju_tipai`
--
ALTER TABLE `vartotoju_tipai`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ataskaita`
--
ALTER TABLE `ataskaita`
  ADD CONSTRAINT `fk_ataskaitos_tipas` FOREIGN KEY (`Tipas`) REFERENCES `ataskaitos_tipai` (`id`);

--
-- Constraints for table `atsiskaitymas`
--
ALTER TABLE `atsiskaitymas`
  ADD CONSTRAINT `Susijas` FOREIGN KEY (`fk_Uzsakymasid`) REFERENCES `uzsakymas` (`id`);

--
-- Constraints for table `busena`
--
ALTER TABLE `busena`
  ADD CONSTRAINT `Turi_3` FOREIGN KEY (`fk_Daiktasid`) REFERENCES `daiktas` (`id`);

--
-- Constraints for table `darbuotojas`
--
ALTER TABLE `darbuotojas`
  ADD CONSTRAINT `Turi_4` FOREIGN KEY (`fk_Paskyraid`) REFERENCES `paskyra` (`id`);

--
-- Constraints for table `itrauktas_i`
--
ALTER TABLE `itrauktas_i`
  ADD CONSTRAINT `Itrauktas_i` FOREIGN KEY (`fk_AtaskaitaAtaskaitos_numeris`) REFERENCES `ataskaita` (`Ataskaitos_numeris`);

--
-- Constraints for table `kategorija`
--
ALTER TABLE `kategorija`
  ADD CONSTRAINT `Priklauso` FOREIGN KEY (`fk_Daiktasid`) REFERENCES `daiktas` (`id`);

--
-- Constraints for table `kiekis`
--
ALTER TABLE `kiekis`
  ADD CONSTRAINT `Turi_tiek` FOREIGN KEY (`fk_Uzsakymasid`) REFERENCES `uzsakymas` (`id`);

--
-- Constraints for table `klientas`
--
ALTER TABLE `klientas`
  ADD CONSTRAINT `Turi_2` FOREIGN KEY (`fk_Paskyra_id`) REFERENCES `paskyra` (`id`);

--
-- Constraints for table `naudojamas_daiktas`
--
ALTER TABLE `naudojamas_daiktas`
  ADD CONSTRAINT `Paimtas` FOREIGN KEY (`fk_Daiktasid`) REFERENCES `daiktas` (`id`);

--
-- Constraints for table `paskyra`
--
ALTER TABLE `paskyra`
  ADD CONSTRAINT `Var_Tipas` FOREIGN KEY (`Tipas`) REFERENCES `vartotoju_tipai` (`id`);

--
-- Constraints for table `prisijungimas`
--
ALTER TABLE `prisijungimas`
  ADD CONSTRAINT `Turi` FOREIGN KEY (`fk_Paskyraid`) REFERENCES `paskyra` (`id`);

--
-- Constraints for table `produktas`
--
ALTER TABLE `produktas`
  ADD CONSTRAINT `Apibudina` FOREIGN KEY (`fk_Medziagu_grupeid`) REFERENCES `medziagu_grupe` (`id`);

--
-- Constraints for table `tiekejo_produktas`
--
ALTER TABLE `tiekejo_produktas`
  ADD CONSTRAINT `Itraukta_i` FOREIGN KEY (`fk_Produktasid`) REFERENCES `produktas` (`id`),
  ADD CONSTRAINT `Tiekia` FOREIGN KEY (`fk_Tiekejasid`) REFERENCES `tiekejas` (`id`);

--
-- Constraints for table `transportavimas`
--
ALTER TABLE `transportavimas`
  ADD CONSTRAINT `fk_transportavimo_tipas` FOREIGN KEY (`Siuntimo_budas`) REFERENCES `siuntimo_budai` (`id`),
  ADD CONSTRAINT `turi_priskirta` FOREIGN KEY (`fk_Uzsakymasid`) REFERENCES `uzsakymas` (`id`);

--
-- Constraints for table `turi`
--
ALTER TABLE `turi`
  ADD CONSTRAINT `Tur_5` FOREIGN KEY (`fk_Produktasid`) REFERENCES `produktas` (`id`);

--
-- Constraints for table `uzsakymas`
--
ALTER TABLE `uzsakymas`
  ADD CONSTRAINT `fk_pakuotes_matmenys` FOREIGN KEY (`Pakuotes_ismatavimai`) REFERENCES `matmenys` (`id`),
  ADD CONSTRAINT `fk_pakuotes_uzpildas` FOREIGN KEY (`Pakuotes_uzpildas`) REFERENCES `uzpildai` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
