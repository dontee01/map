-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2016 at 12:48 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `map`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` int(6) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `hashh` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `token`, `verified`, `hashh`, `created`, `modified`) VALUES
(1, 'ola', 'ola@tst.com', '$2y$10$3Fx6UsOsXRE1VH7hHZMvAe/lvTcW2P2Ss6w./dzyF0Ktzn3j2Z43a', 724256, 0, '05ce692b8cjifz0yhbog', '2016-10-16 09:17:42', NULL),
(4, 'test', 'johntobby02@gmail.com', '$2y$10$qAn3rVdeboyUthP8MdlcEeWVmGH/HnVZayx.XU3Ickp8CCtA2vVDK', 969129, 1, 'b11a8a1220vdbd6mw04', '2016-10-16 09:34:04', NULL),
(6, 'ooo', 'oola@tst.com', '$2y$10$5oc3VVZZyWt2br5Y/qL8TOO6GUCWAjn9ASKNqynHDEihxb4iNLDsK', 770155, 0, '4275f4421ackzgr1b2rk', '2016-10-16 10:32:24', NULL),
(7, 'oo', 'ooola@tst.com', '$2y$10$5.7Am7AUt1QBdSl6yjgPA.UJe3f8G6ndad83vjFO5TChH5PEXPlzK', 198242, 0, 'b0c0a122bcszscgqz6o1', '2016-10-16 10:34:19', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token_UNIQUE` (`token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
