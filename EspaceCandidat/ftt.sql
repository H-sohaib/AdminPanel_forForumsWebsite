-- phpMyAdmin SQL Dump

-- version 5.2.1

-- https://www.phpmyadmin.net/

--

-- Host: 127.0.0.1

-- Generation Time: Apr 11, 2023 at 05:04 PM

-- Server version: 10.4.28-MariaDB

-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */

;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */

;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */

;

/*!40101 SET NAMES utf8mb4 */

;

--

-- Database: `ftt`

--

-- --------------------------------------------------------

--

-- Table structure for table `formation`

--

CREATE TABLE
    `formation` (
        `id` int(11) NOT NULL,
        `id_user` int(11) NOT NULL,
        `label` text NOT NULL,
        `description` text NOT NULL,
        `from_date` date NOT NULL,
        `to_date` date NOT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------

--

-- Table structure for table `users`

--

CREATE TABLE
    `users` (
        `id` int(11) NOT NULL,
        `email` text NOT NULL,
        `password` text NOT NULL,
        `firstname` text NOT NULL,
        `lastname` text NOT NULL,
        `ecole` text NOT NULL,
        `spec` text NOT NULL,
        `grade` text NOT NULL,
        `tel` text NOT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--

-- Indexes for dumped tables

--

--

-- Indexes for table `formation`

--

ALTER TABLE `formation` ADD PRIMARY KEY (`id`);

--

-- Indexes for table `users`

--

ALTER TABLE `users` ADD PRIMARY KEY (`id`);

--

-- AUTO_INCREMENT for dumped tables

--

--

-- AUTO_INCREMENT for table `formation`

--

ALTER TABLE
    `formation` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--

-- AUTO_INCREMENT for table `users`

--

ALTER TABLE `users` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */

;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */

;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */

;