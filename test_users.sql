-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Mar 25, 2026 at 01:50 PM
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
-- Database: `jobshorizonbdd`
--

-- --------------------------------------------------------

--
-- Table structure for table `test_users`
--

CREATE TABLE `test_users` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `role` enum('admin','company','pilote','student') DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `ville` varchar(100) DEFAULT NULL,
  `competences` text DEFAULT NULL,
  `date_create` timestamp NULL DEFAULT NULL,
  `date_login` timestamp NULL DEFAULT NULL,
  `email_notif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test_users`
--

INSERT INTO `test_users` (`id`, `nom`, `prenom`, `role`, `email`, `password`, `ville`, `competences`, `date_create`, `date_login`, `email_notif`) VALUES
(0, 'Dupont', 'Marc', 'student', 'marc@test.fr', '$2y$10$6GsRbRfZpcqDa9SWsaXe2e.gVkugfz6gzauN2gPOKPuZu.WfheNh.', 'Saint-Nazaire', 'PHP, SQL, HTML', '2026-03-16 11:00:13', '2026-03-25 10:37:58', 0),
(2, 'Martin', 'Sophie', 'pilote', 'sophie@test.fr', 'test123', 'Nantes', 'Gestion de projet, Coaching', '2026-03-16 11:00:13', NULL, 0),
(3, 'Admin', 'Gérard', 'company', 'admin@test.fr', 'admin123', 'Paris', 'Sécurité, Infrastructure', '2026-03-16 11:00:13', NULL, 0),
(4, 'Recruteur', 'Jean', 'admin', 'hr@google.fr', 'google123', 'Rennes', 'Sourcing, Recrutement', '2026-03-16 11:00:13', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `test_users`
--
ALTER TABLE `test_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `test_users`
--
ALTER TABLE `test_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
