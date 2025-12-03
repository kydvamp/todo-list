-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2023 at 07:14 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todolist`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(300) NOT NULL,
  `priority` enum('low', 'medium', 'high') NOT NULL,
  `category` varchar(255),
  `due_date` date,
  `status` enum('pending', 'complete') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `nama`, `priority`, `category`, `due_date`, `status`) VALUES
(4, 'Feed Dogs', 'medium', 'home', '2023-02-28', 'pending'),
(5, 'Complete Calculus Homework', 'high', 'education', '2023-02-28', 'pending'),
(6, 'Complete Web Programming Homework', 'high', 'education', '2023-02-28', 'pending'),
(7, 'Study for Automata Exam', 'high', 'education', '2023-02-28', 'pending'),
(8, 'Drink Vitamins', 'low', 'health', '2023-02-28', 'pending'),
(9, 'Grocery Shopping', 'medium', 'home', '2023-02-28', 'pending'),
(10, 'Clean Room', 'medium', 'home', '2023-02-28', 'pending'),
(11, 'Read a Book', 'medium', 'education', '2023-02-28', 'pending'),
(12, 'Exercise', 'medium', 'health', '2023-02-28', 'pending'),
(13, 'Call Parents', 'low', 'family', '2023-02-28', 'pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

UPDATE activity SET status = 'pending' WHERE status IS NULL;
UPDATE activity SET due_date = CURDATE() WHERE due_date IS NULL;
