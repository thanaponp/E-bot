-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 15, 2019 at 02:48 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bwsteamsx_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_chat_answer`
--

CREATE TABLE `tb_chat_answer` (
  `id` bigint(10) NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'ข้อความ',
  `questionid` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_chat_answer`
--

INSERT INTO `tb_chat_answer` (`id`, `text`, `questionid`) VALUES
(1, 'ok แปลว่า ตกลง', 1),
(2, 'ขอบคุณค่ะ ที่ ok', 1),
(3, 'สวัสดีค่ะ สามารถตรวจสอบราคาได้จากลิงค์นี้ค่ะ <a href=\"https://www.baanwebsite.com/promotion/17-Newest-Promotions-for-2018\" target=\"_blank\">คลิก</a>', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_chat_banned`
--

CREATE TABLE `tb_chat_banned` (
  `id` bigint(10) NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'ข้อความ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_chat_banned`
--

INSERT INTO `tb_chat_banned` (`id`, `text`) VALUES
(1, 'fuck'),
(2, 'suck'),
(3, 'bitch'),
(4, 'ass');

-- --------------------------------------------------------

--
-- Table structure for table `tb_chat_log`
--

CREATE TABLE `tb_chat_log` (
  `id` bigint(10) NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'ข้อความที่พิมพ์เข้ามา',
  `date` datetime NOT NULL,
  `session` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'session เครื่องผู้ใช้',
  `ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ip เครื่องผู้ใช้',
  `question` bigint(10) NOT NULL COMMENT 'match กับ id คำถาม',
  `answer` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'คำตอบ เป็นข้อความ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_chat_log`
--

INSERT INTO `tb_chat_log` (`id`, `text`, `date`, `session`, `ip`, `question`, `answer`) VALUES
(1, 'ok', '2019-03-06 09:47:35', 'ff06c042b0b75c018f797c74b29ca431', '::1', 1, 'ok แปลว่า ตกลง');

-- --------------------------------------------------------

--
-- Table structure for table `tb_chat_question`
--

CREATE TABLE `tb_chat_question` (
  `id` bigint(10) NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'ข้อความ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_chat_question`
--

INSERT INTO `tb_chat_question` (`id`, `text`) VALUES
(1, 'ok'),
(2, 'ราคา,ทำเว็บ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_chat_answer`
--
ALTER TABLE `tb_chat_answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_chat_banned`
--
ALTER TABLE `tb_chat_banned`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_chat_log`
--
ALTER TABLE `tb_chat_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_chat_question`
--
ALTER TABLE `tb_chat_question`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_chat_answer`
--
ALTER TABLE `tb_chat_answer`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_chat_banned`
--
ALTER TABLE `tb_chat_banned`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_chat_log`
--
ALTER TABLE `tb_chat_log`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_chat_question`
--
ALTER TABLE `tb_chat_question`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
