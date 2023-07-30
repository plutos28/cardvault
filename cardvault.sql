-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2023 at 04:14 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cardvault`
--

-- --------------------------------------------------------

--
-- Table structure for table `carddetails`
--

CREATE TABLE `carddetails` (
  `id` int(11) NOT NULL,
  `cardnumber` varbinary(255) NOT NULL,
  `cardholder_name` varbinary(255) NOT NULL,
  `cvv` varbinary(255) NOT NULL,
  `expiration_date` varbinary(255) NOT NULL,
  `user_id` varbinary(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carddetails`
--

INSERT INTO `carddetails` (`id`, `cardnumber`, `cardholder_name`, `cvv`, `expiration_date`, `user_id`) VALUES
(1, 0xd03f5fb41af26eca0e54563a242657c440cbbf790b8073b4df503acc4ff1495e, 0x90f8175ba8c00333e6273deb29a912aa, 0x569385dae62cc1c822c2576417e0300e, 0x231f1885757174e626d0778aac6c62c0, 0x436d62ff896cba2aaa326c2587dd8212),
(3, 0xe6d97ced28138463a2fc802ea6801caf, 0xbdcb5b798b17014d1940793ebbe17f94, 0xa6474a2e8ddb1f659d59c4a28bc839cc, 0xc48df9299f1db9e6253f436cfe068262, 0x436d62ff896cba2aaa326c2587dd8212),
(4, 0x5a4539e4f9655bdf5cc8ad528025995040cbbf790b8073b4df503acc4ff1495e, 0x7fb166e5ee50dba7dc35b5b6e81e5b29, 0xae78d3a67fd5f00b0065b852dcdc15e5, 0x4b721ff93a35f7d257ddc3023f856621, 0x436d62ff896cba2aaa326c2587dd8212),
(5, 0x6cc513e57040eef8c65c5ccabc2fe46d15ce3f6da472c4fc235d488423649636, 0x6e9b5beb25838d17a39f7253a28f0c32, 0x41579e3d233189c2e2c3af45c10c96c5, 0x171a852d8eea5030612369600356bbd1, 0xbf57537cb75950bc03ffb0d99994bc68),
(6, 0xdc87eaeda65ea8162ba0c78769a11472, 0x414f7d19f6ae695ce24e5ac0c5cee950, 0x41579e3d233189c2e2c3af45c10c96c5, 0x171a852d8eea5030612369600356bbd1, 0x436d62ff896cba2aaa326c2587dd8212);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'victor', '$2y$10$PDOelMMQFsrHfQeMiA0nF.7y7tXbVVEnJm3.yo5gk78XW02CMDPkK', '2023-07-24 11:20:24'),
(2, 'jane', '$2y$10$PzD.acn//RRye1TJ0fbVfOymNk56ncnc.Za92zlgFdBbKSgwTlOei', '2023-07-24 16:00:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carddetails`
--
ALTER TABLE `carddetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`) USING HASH;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carddetails`
--
ALTER TABLE `carddetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
