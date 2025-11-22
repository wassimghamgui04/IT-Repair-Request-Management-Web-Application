-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2025 at 10:27 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reparationbd`
--

-- --------------------------------------------------------

--
-- Table structure for table `demande_reparation`
--

CREATE TABLE `demande_reparation` (
  `id` int(11) NOT NULL,
  `date_demande` datetime DEFAULT current_timestamp(),
  `statut` enum('en attente','attribuée','en cours','résolue','refusée') DEFAULT 'en attente',
  `description` text DEFAULT NULL,
  `id_equipement` int(11) DEFAULT NULL,
  `id_employe` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `demande_reparation`
--

INSERT INTO `demande_reparation` (`id`, `date_demande`, `statut`, `description`, `id_equipement`, `id_employe`) VALUES
(1, '2025-05-07 00:00:00', 'résolue', 'Impri', 1, 2),
(2, '2025-05-07 00:00:00', 'résolue', 'pc portable', 1, 2),
(3, '2025-05-07 00:00:00', 'refusée', 'omooom', 1, 1),
(4, '2025-05-07 00:00:00', 'attribuée', 'omom', 1, 2),
(5, '2025-05-08 00:00:00', 'résolue', 'phone casse', 3, 2),
(7, '2025-05-08 00:00:00', 'en attente', 'Dsique', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `demande_technicien`
--

CREATE TABLE `demande_technicien` (
  `id_demande` int(11) NOT NULL,
  `id_technicien` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `demande_technicien`
--

INSERT INTO `demande_technicien` (`id_demande`, `id_technicien`) VALUES
(1, 5),
(1, 8),
(2, 4),
(2, 5),
(2, 8),
(5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `equipement`
--

CREATE TABLE `equipement` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `statut` enum('en service','hors service','en reparation') NOT NULL DEFAULT 'en service',
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipement`
--

INSERT INTO `equipement` (`id`, `nom`, `type`, `statut`, `id_utilisateur`) VALUES
(1, 'phone', 'phone', 'en service', 1),
(2, 'pc', 'pc', 'en service', 1),
(3, 'phone por', 'phone', 'en service', 2);

-- --------------------------------------------------------

--
-- Table structure for table `intervention`
--

CREATE TABLE `intervention` (
  `id` int(11) NOT NULL,
  `id_demande` int(11) DEFAULT NULL,
  `id_technicien` int(11) DEFAULT NULL,
  `date_intervention` datetime DEFAULT current_timestamp(),
  `commentaire` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `intervention`
--

INSERT INTO `intervention` (`id`, `id_demande`, `id_technicien`, `date_intervention`, `commentaire`) VALUES
(1, 2, 4, '2025-05-08 00:00:00', 'suibon'),
(2, 2, 8, '2025-05-08 00:00:00', 'pps'),
(3, 2, 8, '2025-05-08 00:00:00', 'disque rep'),
(4, 1, 8, '2025-05-08 00:00:00', 'mp'),
(5, 1, 5, '2025-05-08 00:00:00', 'Sal'),
(6, 5, 4, '2025-05-08 00:00:00', 'finis');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL,
  `role` enum('employe','technicien','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `email`, `mot_de_passe`, `role`) VALUES
(1, 'salah', '24560520', '122', 'admin'),
(2, 'ahmed', 'salah@g', '999', 'employe'),
(3, 'azoz', 'azoz', '123', 'admin'),
(4, 'moh', 'moh', '111', 'technicien'),
(5, 'wassim', 'wassimplayer004@gmail.com', '123', 'technicien'),
(8, 'sal', 'dsd', 'aaa', 'technicien');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `demande_reparation`
--
ALTER TABLE `demande_reparation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_equipement` (`id_equipement`),
  ADD KEY `id_employe` (`id_employe`);

--
-- Indexes for table `demande_technicien`
--
ALTER TABLE `demande_technicien`
  ADD PRIMARY KEY (`id_demande`,`id_technicien`),
  ADD KEY `id_technicien` (`id_technicien`);

--
-- Indexes for table `equipement`
--
ALTER TABLE `equipement`
  ADD PRIMARY KEY (`id`,`id_utilisateur`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Indexes for table `intervention`
--
ALTER TABLE `intervention`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_demande` (`id_demande`),
  ADD KEY `id_technicien` (`id_technicien`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `equipement`
--
ALTER TABLE `equipement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `demande_reparation`
--
ALTER TABLE `demande_reparation`
  ADD CONSTRAINT `demande_reparation_ibfk_1` FOREIGN KEY (`id_equipement`) REFERENCES `equipement` (`id`),
  ADD CONSTRAINT `demande_reparation_ibfk_2` FOREIGN KEY (`id_employe`) REFERENCES `utilisateur` (`id`);

--
-- Constraints for table `demande_technicien`
--
ALTER TABLE `demande_technicien`
  ADD CONSTRAINT `demande_technicien_ibfk_1` FOREIGN KEY (`id_demande`) REFERENCES `demande_reparation` (`id`),
  ADD CONSTRAINT `demande_technicien_ibfk_2` FOREIGN KEY (`id_technicien`) REFERENCES `utilisateur` (`id`);

--
-- Constraints for table `equipement`
--
ALTER TABLE `equipement`
  ADD CONSTRAINT `equipement_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `intervention`
--
ALTER TABLE `intervention`
  ADD CONSTRAINT `intervention_ibfk_1` FOREIGN KEY (`id_demande`) REFERENCES `demande_reparation` (`id`),
  ADD CONSTRAINT `intervention_ibfk_2` FOREIGN KEY (`id_technicien`) REFERENCES `utilisateur` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
