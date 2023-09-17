-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 17, 2023 at 07:19 PM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fuzzy`
--
CREATE DATABASE IF NOT EXISTS `fuzzy` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `fuzzy`;

-- --------------------------------------------------------

--
-- Table structure for table `midi_actions`
--

DROP TABLE IF EXISTS `midi_actions`;
CREATE TABLE `midi_actions` (
  `action_id` int(11) NOT NULL,
  `channel` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `step` varchar(10) NOT NULL,
  `do_alter` tinyint(1) DEFAULT NULL,
  `octave` int(11) DEFAULT NULL,
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `midi_actions`
--

INSERT INTO `midi_actions` (`action_id`, `channel`, `name`, `step`, `do_alter`, `octave`, `comments`) VALUES
(1, 1, 'STOP_ALL', 'C', NULL, 0, ''),
(2, 1, 'STOP_SAMPLE_C', 'C', NULL, 3, ''),
(3, 1, 'STOP_SAMPLE_Ab', 'C', 1, 3, ''),
(4, 1, 'STOP_SAMPLE_D', 'D', NULL, 3, ''),
(5, 1, 'STOP_ARPEGGIATO', 'C', NULL, 4, ''),
(6, 1, 'STOP_DRUMS', 'C', NULL, 5, ''),
(7, 1, 'STOP_ADDON_HH', 'C', 1, 5, ''),
(8, 1, 'STOP_ADDON_CLAP', 'D', NULL, 5, ''),
(9, 1, 'STOP_ADDON_KICK', 'D', 1, 5, ''),
(10, 1, 'STOP_ADDON_TOMS', 'E', NULL, 5, ''),
(11, 1, 'STOP_TOPLINE', 'C', NULL, 6, 'Melody'),
(12, 1, 'STOP_VOIX', 'C', NULL, 7, ''),
(13, 1, 'VOICE_HARMONY', 'C', NULL, 8, 'ON/OFF SWITCH'),
(14, 1, 'TEMPO_80', 'C', 1, 0, ''),
(15, 1, 'TEMPO_90', 'D', NULL, 0, ''),
(16, 1, 'TEMPO_100', 'D', 1, 0, ''),
(17, 1, 'TEMPO_110', 'E', NULL, 0, ''),
(18, 1, 'TEMPO_120', 'F', NULL, 0, ''),
(19, 1, 'TEMPO_130', 'F', 1, 0, ''),
(20, 1, 'TEMPO_140', 'G', NULL, 0, ''),
(21, 1, 'TEMPO_150', 'G', 1, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `midi_avail_chords_per_tonality`
--

DROP TABLE IF EXISTS `midi_avail_chords_per_tonality`;
CREATE TABLE `midi_avail_chords_per_tonality` (
  `chord_ton_id` int(11) NOT NULL,
  `tonality` set('D','Ab','C') DEFAULT NULL,
  `chord` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `midi_avail_chords_per_tonality`
--

INSERT INTO `midi_avail_chords_per_tonality` (`chord_ton_id`, `tonality`, `chord`) VALUES
(1, 'D', 'D'),
(2, 'D', 'Em'),
(3, 'D', 'F#m'),
(4, 'D', 'G'),
(5, 'D', 'A'),
(6, 'D', 'Bm'),
(7, 'Ab', 'Ab'),
(8, 'Ab', 'Bbm'),
(9, 'Ab', 'Cm'),
(10, 'Ab', 'Db'),
(11, 'Ab', 'Eb'),
(12, 'Ab', 'Fm'),
(13, 'C', 'C'),
(14, 'C', 'Dm'),
(15, 'C', 'Em'),
(16, 'C', 'F'),
(17, 'C', 'G'),
(18, 'C', 'Am');

-- --------------------------------------------------------

--
-- Table structure for table `midi_chords`
--

DROP TABLE IF EXISTS `midi_chords`;
CREATE TABLE `midi_chords` (
  `id` bigint(20) NOT NULL,
  `function` enum('sample','autotune','arpeggiato','qlab') DEFAULT NULL,
  `channel` int(11) DEFAULT NULL,
  `tonality` enum('D','Ab','C') DEFAULT NULL,
  `style_option` varchar(255) DEFAULT NULL,
  `style` enum('pop1','pop2','pop3','disco1','disco2','disco3','16beat','bossa1','bossa2') DEFAULT NULL,
  `name` varchar(10) NOT NULL,
  `step` varchar(10) NOT NULL,
  `do_alter` tinyint(1) DEFAULT NULL,
  `octave` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `midi_chords`
--

INSERT INTO `midi_chords` (`id`, `function`, `channel`, `tonality`, `style_option`, `style`, `name`, `step`, `do_alter`, `octave`) VALUES
(1, 'sample', 2, 'C', 'pop', 'pop1', 'C', 'C', NULL, 0),
(2, 'sample', 2, 'C', 'pop', 'pop1', 'Dm', 'C', 1, 0),
(3, 'sample', 2, 'C', 'pop', 'pop1', 'Em', 'D', NULL, 0),
(4, 'sample', 2, 'C', 'pop', 'pop1', 'F', 'D', 1, 0),
(5, 'sample', 2, 'C', 'pop', 'pop1', 'G', 'E', NULL, 0),
(6, 'sample', 2, 'C', 'pop', 'pop1', 'Am', 'F', NULL, 0),
(7, 'sample', 2, 'C', 'pop', 'pop2', 'C', 'C', NULL, 1),
(8, 'sample', 2, 'C', 'pop', 'pop2', 'Dm', 'C', 1, 1),
(9, 'sample', 2, 'C', 'pop', 'pop2', 'Em', 'D', NULL, 1),
(10, 'sample', 2, 'C', 'pop', 'pop2', 'F', 'D', 1, 1),
(11, 'sample', 2, 'C', 'pop', 'pop2', 'G', 'E', NULL, 1),
(12, 'sample', 2, 'C', 'pop', 'pop2', 'Am', 'F', NULL, 1),
(13, 'sample', 2, 'C', 'pop', 'pop3', 'C', 'C', NULL, 2),
(14, 'sample', 2, 'C', 'pop', 'pop3', 'Dm', 'C', 1, 2),
(15, 'sample', 2, 'C', 'pop', 'pop3', 'Em', 'D', NULL, 2),
(16, 'sample', 2, 'C', 'pop', 'pop3', 'F', 'D', 1, 2),
(17, 'sample', 2, 'C', 'pop', 'pop3', 'G', 'E', NULL, 2),
(18, 'sample', 2, 'C', 'pop', 'pop3', 'Am', 'F', NULL, 2),
(19, 'sample', 2, 'C', 'bossa', 'bossa1', 'C', 'C', NULL, 3),
(20, 'sample', 2, 'C', 'bossa', 'bossa1', 'Dm', 'C', 1, 3),
(21, 'sample', 2, 'C', 'bossa', 'bossa1', 'Em', 'D', NULL, 3),
(22, 'sample', 2, 'C', 'bossa', 'bossa1', 'F', 'D', 1, 3),
(23, 'sample', 2, 'C', 'bossa', 'bossa1', 'G', 'E', NULL, 3),
(24, 'sample', 2, 'C', 'bossa', 'bossa1', 'Am', 'F', NULL, 3),
(25, 'sample', 2, 'C', 'bossa', 'bossa2', 'C', 'C', NULL, 4),
(26, 'sample', 2, 'C', 'bossa', 'bossa2', 'Dm', 'C', 1, 4),
(27, 'sample', 2, 'C', 'bossa', 'bossa2', 'Em', 'D', NULL, 4),
(28, 'sample', 2, 'C', 'bossa', 'bossa2', 'F', 'D', 1, 4),
(29, 'sample', 2, 'C', 'bossa', 'bossa2', 'G', 'E', NULL, 4),
(30, 'sample', 2, 'C', 'bossa', 'bossa2', 'Am', 'F', NULL, 4),
(31, 'sample', 2, 'C', '16beat', '16beat', 'C', 'C', NULL, 5),
(32, 'sample', 2, 'C', '16beat', '16beat', 'Dm', 'C', 1, 5),
(33, 'sample', 2, 'C', '16beat', '16beat', 'Em', 'D', NULL, 5),
(34, 'sample', 2, 'C', '16beat', '16beat', 'F', 'D', 1, 5),
(35, 'sample', 2, 'C', '16beat', '16beat', 'G', 'E', NULL, 5),
(36, 'sample', 2, 'C', '16beat', '16beat', 'Am', 'F', NULL, 5),
(37, 'sample', 2, 'C', 'disco', 'disco1', 'C', 'C', NULL, 6),
(38, 'sample', 2, 'C', 'disco', 'disco1', 'Dm', 'C', 1, 6),
(39, 'sample', 2, 'C', 'disco', 'disco1', 'Em', 'D', NULL, 6),
(40, 'sample', 2, 'C', 'disco', 'disco1', 'F', 'D', 1, 6),
(41, 'sample', 2, 'C', 'disco', 'disco1', 'G', 'E', NULL, 6),
(42, 'sample', 2, 'C', 'disco', 'disco1', 'Am', 'F', NULL, 6),
(43, 'sample', 2, 'C', 'disco', 'disco2', 'C', 'C', NULL, 7),
(44, 'sample', 2, 'C', 'disco', 'disco2', 'Dm', 'C', 1, 7),
(45, 'sample', 2, 'C', 'disco', 'disco2', 'Em', 'D', NULL, 7),
(46, 'sample', 2, 'C', 'disco', 'disco2', 'F', 'D', 1, 7),
(47, 'sample', 2, 'C', 'disco', 'disco2', 'G', 'E', NULL, 7),
(48, 'sample', 2, 'C', 'disco', 'disco2', 'Am', 'F', NULL, 7),
(49, 'sample', 2, 'C', 'disco', 'disco3', 'C', 'C', NULL, 8),
(50, 'sample', 2, 'C', 'disco', 'disco3', 'Dm', 'C', 1, 8),
(51, 'sample', 2, 'C', 'disco', 'disco3', 'Em', 'D', NULL, 8),
(52, 'sample', 2, 'C', 'disco', 'disco3', 'F', 'D', 1, 8),
(53, 'sample', 2, 'C', 'disco', 'disco3', 'G', 'E', NULL, 8),
(54, 'sample', 2, 'C', 'disco', 'disco3', 'Am', 'F', NULL, 8),
(55, 'arpeggiato', 5, 'C', NULL, NULL, 'C', 'C', NULL, 0),
(56, 'arpeggiato', 5, 'C', NULL, NULL, 'Dm', 'C', 1, 0),
(57, 'arpeggiato', 5, 'C', NULL, NULL, 'Em', 'D', NULL, 0),
(58, 'arpeggiato', 5, 'C', NULL, NULL, 'F', 'D', 1, 0),
(59, 'arpeggiato', 5, 'C', NULL, NULL, 'G', 'E', NULL, 0),
(60, 'arpeggiato', 5, 'C', NULL, NULL, 'Am', 'F', NULL, 0),
(61, 'arpeggiato', 5, 'Ab', NULL, NULL, 'Ab', 'C', NULL, 1),
(62, 'arpeggiato', 5, 'Ab', NULL, NULL, 'Bbm', 'C', 1, 1),
(63, 'arpeggiato', 5, 'Ab', NULL, NULL, 'Cm', 'D', NULL, 1),
(64, 'arpeggiato', 5, 'Ab', NULL, NULL, 'Db', 'D', 1, 1),
(65, 'arpeggiato', 5, 'Ab', NULL, NULL, 'Eb', 'E', NULL, 1),
(66, 'arpeggiato', 5, 'Ab', NULL, NULL, 'Fm', 'F', NULL, 1),
(67, 'arpeggiato', 5, 'D', NULL, NULL, 'D', 'C', NULL, 2),
(68, 'arpeggiato', 5, 'D', NULL, NULL, 'Em', 'C', 1, 2),
(69, 'arpeggiato', 5, 'D', NULL, NULL, 'F#m', 'D', NULL, 2),
(70, 'arpeggiato', 5, 'D', NULL, NULL, 'G', 'D', 1, 2),
(71, 'arpeggiato', 5, 'D', NULL, NULL, 'A', 'E', NULL, 2),
(72, 'arpeggiato', 5, 'D', NULL, NULL, 'Bm', 'F', NULL, 2),
(73, 'sample', 3, 'Ab', 'pop', 'pop1', 'Ab', 'C', NULL, 0),
(74, 'sample', 3, 'Ab', 'pop', 'pop1', 'Bbm', 'C', 1, 0),
(75, 'sample', 3, 'Ab', 'pop', 'pop1', 'Cm', 'D', NULL, 0),
(76, 'sample', 3, 'Ab', 'pop', 'pop1', 'Db', 'D', 1, 0),
(77, 'sample', 3, 'Ab', 'pop', 'pop1', 'Eb', 'E', NULL, 0),
(78, 'sample', 3, 'Ab', 'pop', 'pop1', 'Fm', 'F', NULL, 0),
(79, 'sample', 3, 'Ab', 'pop', 'pop2', 'Ab', 'C', NULL, 1),
(80, 'sample', 3, 'Ab', 'pop', 'pop2', 'Bbm', 'C', 1, 1),
(81, 'sample', 3, 'Ab', 'pop', 'pop2', 'Cm', 'D', NULL, 1),
(82, 'sample', 3, 'Ab', 'pop', 'pop2', 'Db', 'D', 1, 1),
(83, 'sample', 3, 'Ab', 'pop', 'pop2', 'Eb', 'E', NULL, 1),
(84, 'sample', 3, 'Ab', 'pop', 'pop2', 'Fm', 'F', NULL, 1),
(85, 'sample', 3, 'Ab', 'pop', 'pop3', 'Ab', 'C', NULL, 2),
(86, 'sample', 3, 'Ab', 'pop', 'pop3', 'Bbm', 'C', 1, 2),
(87, 'sample', 3, 'Ab', 'pop', 'pop3', 'Cm', 'D', NULL, 2),
(88, 'sample', 3, 'Ab', 'pop', 'pop3', 'Db', 'D', 1, 2),
(89, 'sample', 3, 'Ab', 'pop', 'pop3', 'Eb', 'E', NULL, 2),
(90, 'sample', 3, 'Ab', 'pop', 'pop3', 'Fm', 'F', NULL, 2),
(91, 'sample', 3, 'Ab', 'bossa', 'bossa1', 'Ab', 'C', NULL, 3),
(92, 'sample', 3, 'Ab', 'bossa', 'bossa1', 'Bbm', 'C', 1, 3),
(93, 'sample', 3, 'Ab', 'bossa', 'bossa1', 'Cm', 'D', NULL, 3),
(94, 'sample', 3, 'Ab', 'bossa', 'bossa1', 'Db', 'D', 1, 3),
(95, 'sample', 3, 'Ab', 'bossa', 'bossa1', 'Eb', 'E', NULL, 3),
(96, 'sample', 3, 'Ab', 'bossa', 'bossa1', 'Fm', 'F', NULL, 3),
(97, 'sample', 3, 'Ab', 'bossa', 'bossa2', 'Ab', 'C', NULL, 4),
(98, 'sample', 3, 'Ab', 'bossa', 'bossa2', 'Bbm', 'C', 1, 4),
(99, 'sample', 3, 'Ab', 'bossa', 'bossa2', 'Cm', 'D', NULL, 4),
(100, 'sample', 3, 'Ab', 'bossa', 'bossa2', 'Db', 'D', 1, 4),
(101, 'sample', 3, 'Ab', 'bossa', 'bossa2', 'Eb', 'E', NULL, 4),
(102, 'sample', 3, 'Ab', 'bossa', 'bossa2', 'Fm', 'F', NULL, 4),
(103, 'sample', 3, 'Ab', '16beat', '16beat', 'Ab', 'C', NULL, 5),
(104, 'sample', 3, 'Ab', '16beat', '16beat', 'Bbm', 'C', 1, 5),
(105, 'sample', 3, 'Ab', '16beat', '16beat', 'Cm', 'D', NULL, 5),
(106, 'sample', 3, 'Ab', '16beat', '16beat', 'Db', 'D', 1, 5),
(107, 'sample', 3, 'Ab', '16beat', '16beat', 'Eb', 'E', NULL, 5),
(108, 'sample', 3, 'Ab', '16beat', '16beat', 'Fm', 'F', NULL, 5),
(109, 'sample', 3, 'Ab', 'disco', 'disco1', 'Ab', 'C', NULL, 6),
(110, 'sample', 3, 'Ab', 'disco', 'disco1', 'Bbm', 'C', 1, 6),
(111, 'sample', 3, 'Ab', 'disco', 'disco1', 'Cm', 'D', NULL, 6),
(112, 'sample', 3, 'Ab', 'disco', 'disco1', 'Db', 'D', 1, 6),
(113, 'sample', 3, 'Ab', 'disco', 'disco1', 'Eb', 'E', NULL, 6),
(114, 'sample', 3, 'Ab', 'disco', 'disco1', 'Fm', 'F', NULL, 6),
(115, 'sample', 3, 'Ab', 'disco', 'disco2', 'Ab', 'C', NULL, 7),
(116, 'sample', 3, 'Ab', 'disco', 'disco2', 'Bbm', 'C', 1, 7),
(117, 'sample', 3, 'Ab', 'disco', 'disco2', 'Cm', 'D', NULL, 7),
(118, 'sample', 3, 'Ab', 'disco', 'disco2', 'Db', 'D', 1, 7),
(119, 'sample', 3, 'Ab', 'disco', 'disco2', 'Eb', 'E', NULL, 7),
(120, 'sample', 3, 'Ab', 'disco', 'disco2', 'Fm', 'F', NULL, 7),
(121, 'sample', 3, 'Ab', 'disco', 'disco3', 'Ab', 'C', NULL, 8),
(122, 'sample', 3, 'Ab', 'disco', 'disco3', 'Bbm', 'C', 1, 8),
(123, 'sample', 3, 'Ab', 'disco', 'disco3', 'Cm', 'D', NULL, 8),
(124, 'sample', 3, 'Ab', 'disco', 'disco3', 'Db', 'D', 1, 8),
(125, 'sample', 3, 'Ab', 'disco', 'disco3', 'Eb', 'E', NULL, 8),
(126, 'sample', 3, 'Ab', 'disco', 'disco3', 'Fm', 'F', NULL, 8),
(127, 'sample', 4, 'D', 'pop', 'pop1', 'D', 'C', NULL, 0),
(128, 'sample', 4, 'D', 'pop', 'pop1', 'Em', 'C', 1, 0),
(129, 'sample', 4, 'D', 'pop', 'pop1', 'F#m', 'D', NULL, 0),
(130, 'sample', 4, 'D', 'pop', 'pop1', 'G', 'D', 1, 0),
(131, 'sample', 4, 'D', 'pop', 'pop1', 'A', 'E', NULL, 0),
(132, 'sample', 4, 'D', 'pop', 'pop1', 'Bm', 'F', NULL, 0),
(133, 'sample', 4, 'D', 'pop', 'pop2', 'D', 'C', NULL, 1),
(134, 'sample', 4, 'D', 'pop', 'pop2', 'Em', 'C', 1, 1),
(135, 'sample', 4, 'D', 'pop', 'pop2', 'F#m', 'D', NULL, 1),
(136, 'sample', 4, 'D', 'pop', 'pop2', 'G', 'D', 1, 1),
(137, 'sample', 4, 'D', 'pop', 'pop2', 'A', 'E', NULL, 1),
(138, 'sample', 4, 'D', 'pop', 'pop2', 'Bm', 'F', NULL, 1),
(139, 'sample', 4, 'D', 'pop', 'pop3', 'D', 'C', NULL, 2),
(140, 'sample', 4, 'D', 'pop', 'pop3', 'Em', 'C', 1, 2),
(141, 'sample', 4, 'D', 'pop', 'pop3', 'F#m', 'D', NULL, 2),
(142, 'sample', 4, 'D', 'pop', 'pop3', 'G', 'D', 1, 2),
(143, 'sample', 4, 'D', 'pop', 'pop3', 'A', 'E', NULL, 2),
(144, 'sample', 4, 'D', 'pop', 'pop3', 'Bm', 'F', NULL, 2),
(145, 'sample', 4, 'D', 'bossa', 'bossa1', 'D', 'C', NULL, 3),
(146, 'sample', 4, 'D', 'bossa', 'bossa1', 'Em', 'C', 1, 3),
(147, 'sample', 4, 'D', 'bossa', 'bossa1', 'F#m', 'D', NULL, 3),
(148, 'sample', 4, 'D', 'bossa', 'bossa1', 'G', 'D', 1, 3),
(149, 'sample', 4, 'D', 'bossa', 'bossa1', 'A', 'E', NULL, 3),
(150, 'sample', 4, 'D', 'bossa', 'bossa1', 'Bm', 'F', NULL, 3),
(151, 'sample', 4, 'D', 'bossa', 'bossa2', 'D', 'C', NULL, 4),
(152, 'sample', 4, 'D', 'bossa', 'bossa2', 'Em', 'C', 1, 4),
(153, 'sample', 4, 'D', 'bossa', 'bossa2', 'F#m', 'D', NULL, 4),
(154, 'sample', 4, 'D', 'bossa', 'bossa2', 'G', 'D', 1, 4),
(155, 'sample', 4, 'D', 'bossa', 'bossa2', 'A', 'E', NULL, 4),
(156, 'sample', 4, 'D', 'bossa', 'bossa2', 'Bm', 'F', NULL, 4),
(157, 'sample', 4, 'D', '16beat', '16beat', 'D', 'C', NULL, 5),
(158, 'sample', 4, 'D', '16beat', '16beat', 'Em', 'C', 1, 5),
(159, 'sample', 4, 'D', '16beat', '16beat', 'F#m', 'D', NULL, 5),
(160, 'sample', 4, 'D', '16beat', '16beat', 'G', 'D', 1, 5),
(161, 'sample', 4, 'D', '16beat', '16beat', 'A', 'E', NULL, 5),
(162, 'sample', 4, 'D', '16beat', '16beat', 'Bm', 'F', NULL, 5),
(163, 'sample', 4, 'D', 'disco', 'disco1', 'D', 'C', NULL, 6),
(164, 'sample', 4, 'D', 'disco', 'disco1', 'Em', 'C', 1, 6),
(165, 'sample', 4, 'D', 'disco', 'disco1', 'F#m', 'D', NULL, 6),
(166, 'sample', 4, 'D', 'disco', 'disco1', 'G', 'D', 1, 6),
(167, 'sample', 4, 'D', 'disco', 'disco1', 'A', 'E', NULL, 6),
(168, 'sample', 4, 'D', 'disco', 'disco1', 'Bm', 'F', NULL, 6),
(169, 'sample', 4, 'D', 'disco', 'disco2', 'D', 'C', NULL, 7),
(170, 'sample', 4, 'D', 'disco', 'disco2', 'Em', 'C', 1, 7),
(171, 'sample', 4, 'D', 'disco', 'disco2', 'F#m', 'D', NULL, 7),
(172, 'sample', 4, 'D', 'disco', 'disco2', 'G', 'D', 1, 7),
(173, 'sample', 4, 'D', 'disco', 'disco2', 'A', 'E', NULL, 7),
(174, 'sample', 4, 'D', 'disco', 'disco2', 'Bm', 'F', NULL, 7),
(175, 'sample', 4, 'D', 'disco', 'disco3', 'D', 'C', NULL, 8),
(176, 'sample', 4, 'D', 'disco', 'disco3', 'Em', 'C', 1, 8),
(177, 'sample', 4, 'D', 'disco', 'disco3', 'F#m', 'D', NULL, 8),
(178, 'sample', 4, 'D', 'disco', 'disco3', 'G', 'D', 1, 7),
(179, 'sample', 4, 'D', 'disco', 'disco3', 'A', 'E', NULL, 8),
(180, 'sample', 4, 'D', 'disco', 'disco3', 'Bm', 'F', NULL, 8),
(181, 'autotune', 8, 'C', NULL, NULL, 'C', 'C', NULL, 0),
(182, 'autotune', 8, 'C', NULL, NULL, 'Dm', 'C', 1, 0),
(183, 'autotune', 8, 'C', NULL, NULL, 'Em', 'D', NULL, 0),
(184, 'autotune', 8, 'C', NULL, NULL, 'F', 'D', 1, 0),
(185, 'autotune', 8, 'C', NULL, NULL, 'G', 'E', NULL, 0),
(186, 'autotune', 8, 'C', NULL, NULL, 'Am', 'F', NULL, 0),
(187, 'autotune', 8, 'Ab', NULL, NULL, 'Ab', 'C', NULL, 1),
(188, 'autotune', 8, 'Ab', NULL, NULL, 'Bbm', 'C', 1, 1),
(189, 'autotune', 8, 'Ab', NULL, NULL, 'Cm', 'D', NULL, 1),
(190, 'autotune', 8, 'Ab', NULL, NULL, 'Db', 'D', 1, 1),
(191, 'autotune', 8, 'Ab', NULL, NULL, 'Eb', 'E', NULL, 1),
(192, 'autotune', 8, 'Ab', NULL, NULL, 'Fm', 'F', NULL, 1),
(193, 'autotune', 8, 'D', NULL, NULL, 'D', 'C', NULL, 2),
(194, 'autotune', 8, 'D', NULL, NULL, 'Em', 'C', 1, 2),
(195, 'autotune', 8, 'D', NULL, NULL, 'F#m', 'D', NULL, 2),
(196, 'autotune', 8, 'D', NULL, NULL, 'G', 'D', 1, 2),
(197, 'autotune', 1, 'D', NULL, NULL, 'A', 'E', NULL, 2),
(198, 'autotune', 1, 'D', NULL, NULL, 'Bm', 'F', NULL, 2),
(212, 'qlab', 9, NULL, NULL, NULL, 'SHORT4MID', 'C', NULL, 4),
(213, 'qlab', 9, NULL, NULL, NULL, 'SHORT3MID', 'B', NULL, 3),
(214, 'qlab', 9, NULL, NULL, NULL, 'LONG8MID', 'C', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `midi_percussions`
--

DROP TABLE IF EXISTS `midi_percussions`;
CREATE TABLE `midi_percussions` (
  `percussion_id` int(11) NOT NULL,
  `channel` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `step` varchar(10) NOT NULL,
  `do_alter` tinyint(1) DEFAULT NULL,
  `octave` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `midi_percussions`
--

INSERT INTO `midi_percussions` (`percussion_id`, `channel`, `name`, `step`, `do_alter`, `octave`) VALUES
(1, 6, 'SAMPLE_DRUMS_POP', 'C', NULL, 0),
(2, 6, 'SAMPLE_DRUMS_DISCO', 'C', 1, 0),
(3, 6, 'SAMPLE_DRUMS_BOSSA', 'D', NULL, 0),
(4, 6, 'SAMPLE_DRUMS_16BEAT', 'D', 1, 0),
(5, 6, 'ADDON_HH_1', 'C', NULL, 1),
(6, 6, 'ADDON_HH_2', 'C', 1, 1),
(7, 6, 'ADDON_HH_3', 'D', NULL, 1),
(8, 6, 'ADDON_CLAP_1', 'C', NULL, 2),
(9, 6, 'ADDON_CLAP_2', 'C', 1, 2),
(10, 6, 'ADDON_CLAP_3', 'D', NULL, 2),
(11, 6, 'ADDON_KICK_1', 'C', NULL, 3),
(12, 6, 'ADDON_KICK_2', 'C', 1, 3),
(13, 6, 'ADDON_KICK_3', 'D', NULL, 3),
(14, 6, 'ADDON_TOMS_1', 'C', NULL, 4),
(15, 6, 'ADDON_TOMS_2', 'C', 1, 4),
(16, 6, 'ADDON_TOMS_3', 'D', NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

DROP TABLE IF EXISTS `songs`;
CREATE TABLE `songs` (
  `song_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `song_title` text NOT NULL,
  `song_mood` varchar(255) NOT NULL,
  `song_tempo` varchar(255) NOT NULL,
  `song_style` varchar(255) NOT NULL,
  `song_addons` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `song_moods`
--

DROP TABLE IF EXISTS `song_moods`;
CREATE TABLE `song_moods` (
  `id` int(11) NOT NULL,
  `mood` varchar(255) NOT NULL,
  `tonality` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `song_moods`
--

INSERT INTO `song_moods` (`id`, `mood`, `tonality`) VALUES
(1, 'joyeux', 'D'),
(2, 'neutre', 'Ab'),
(3, 'triste', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `song_titles`
--

DROP TABLE IF EXISTS `song_titles`;
CREATE TABLE `song_titles` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `mood` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `pitch` varchar(255) NOT NULL,
  `channel` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `song_titles`
--

INSERT INTO `song_titles` (`id`, `filename`, `mood`, `keyword`, `titre`, `pitch`, `channel`) VALUES
(2, 'Ab0', 'Ab', 'Fan', 'Mon Idole', '0', '14'),
(3, 'Ab1', 'Ab', 'Espoir', 'Juste y croire', '1', '14'),
(4, 'Ab2', 'Ab', 'Insouciance', 'Un plaisir enfantin', '2', '14'),
(5, 'Ab3', 'Ab', 'Rêverie', 'Regard en l\'air', '3', '14'),
(6, 'Ab4', 'Ab', 'Drogue', 'Machines à dopamine', '4', '14'),
(7, 'Ab5', 'Ab', 'Laisser-aller', 'C\'est pas grave, tant qu\'on s\'amuse', '5', '14'),
(8, 'Ab6', 'Ab', 'Allégresse', 'Ce qui compte, c\'est de rire', '6', '14'),
(9, 'Ab7', 'Ab', 'Sériosité', 'Mélange dans ma tête', '7', '14'),
(10, 'Ab8', 'Ab', 'Liberté', 'Mon amie fidèle', '8', '14'),
(11, 'Ab9', 'Ab', 'Energie', 'En mode tonique', '9', '14'),
(12, 'Ab10', 'Ab', 'Dérision', 'Question d\'intention', '10', '14'),
(13, 'Ab11', 'Ab', 'Légèreté', 'Rire, c\'est mieux', '11', '14'),
(14, 'Ab12', 'Ab', 'Bouffe', 'Ma petite cuisine', '12', '14'),
(15, 'Ab13', 'Ab', 'Sportitude', 'Le mental gagant', '13', '14'),
(16, 'Ab14', 'Ab', 'Gribouillage', 'Ecrire, c\'est mon plaisir', '14', '14'),
(17, 'Ab15', 'Ab', 'Rock\'n\'roll', 'Rock Star', '15', '14'),
(18, 'Ab16', 'Ab', 'Accumulation', 'La collection déjantée', '16', '14'),
(19, 'Ab17', 'Ab', 'Désordre', 'Le bazar dans ma tête', '17', '14'),
(20, 'Ab18', 'Ab', 'Ivresse', 'Le monde des petites ironies', '18', '14'),
(21, 'Ab19', 'Ab', 'Laideur', 'Beauté moche', '19', '14'),
(22, 'Ab20', 'Ab', 'Clownitude', 'Populaire et rigolo', '20', '14'),
(23, 'Ab21', 'Ab', 'Addiction', 'Cigarette', '21', '14'),
(24, 'Ab22', 'Ab', 'Star', 'Joe Dassin', '22', '14'),
(25, 'Ab23', 'Ab', 'Twist', 'Double sens', '23', '14'),
(26, 'Ab24', 'Ab', 'Saveur', 'Lasagnes Veggie, ma folie', '24', '14'),
(27, 'Ab25', 'Ab', 'Tableau', 'L\'Art pour tous', '25', '14'),
(28, 'Ab26', 'Ab', 'Gadgets', 'Objetmania', '26', '14'),
(29, 'Ab27', 'Ab', 'Observation', 'Les gens', '27', '14'),
(30, 'Ab28', 'Ab', 'Ameublement', 'Chez Casa', '28', '14'),
(31, 'Ab29', 'Ab', 'Stressé', 'Le Trac', '29', '14'),
(32, 'Ab30', 'Ab', 'Don', 'Ma mémoire visuelle', '30', '14'),
(33, 'Ab31', 'Ab', 'Gaieté', 'Juste pour rire', '31', '14'),
(34, 'Ab32', 'Ab', 'Agacement', 'J\'aime pas les clowns', '32', '14'),
(35, 'Ab33', 'Ab', 'Coutures', 'Une pop star excentrique', '33', '14'),
(36, 'Ab34', 'Ab', 'Rangement', 'Scénarios farfelus', '34', '14'),
(37, 'Ab35', 'Ab', 'Désinvolte', 'Sans limites', '35', '14'),
(38, 'Ab36', 'Ab', 'Dépendance', 'Accro à mon phone', '36', '14'),
(39, 'Ab37', 'Ab', 'Manipulation', 'Je me laisse convaincre', '37', '14'),
(40, 'Ab38', 'Ab', 'Pensées', 'Un monde délirant', '38', '14'),
(41, 'Ab39', 'Ab', 'Bordel', 'Vivre dans le chaos', '39', '14'),
(42, 'Ab40', 'Ab', 'Amusement', 'Le squash', '40', '14'),
(43, 'C0', 'C', 'Marre', 'Overdose', '0', '12'),
(44, 'C1', 'C', 'Malheureux', 'La Déprime', '1', '12'),
(45, 'C2', 'C', 'Instruments', 'Sans Instrument', '2', '12'),
(46, 'C3', 'C', 'Rêveur', 'Les Yeux dans le Vague', '3', '12'),
(47, 'C4', 'C', 'Molécule', 'Dopamine Addiction', '4', '12'),
(48, 'C5', 'C', 'Tracas', 'Pas grave, mais c\'est dommage', '5', '12'),
(49, 'C6', 'C', 'Nul', 'Médiocrité', '6', '12'),
(50, 'C7', 'C', 'Bataille', 'Histoire de contexte', '7', '12'),
(51, 'C8', 'C', 'Libération', 'La Liberté', '8', '12'),
(52, 'C9', 'C', 'Désaccordé', 'Quel est ton ton?', '9', '12'),
(53, 'C10', 'C', 'Dessein', 'J\'ai pas fait exprès', '10', '12'),
(54, 'C11', 'C', 'Enthousiasme', 'Pas de mauvaise humeur', '11', '12'),
(55, 'C12', 'C', 'Gastronomie', 'La recette de la fête', '12', '12'),
(56, 'C13', 'C', 'Intellect', 'Le champion du cerveau', '13', '12'),
(57, 'C14', 'C', 'Spleen', 'Mélo-colie', '14', '12'),
(58, 'C15', 'C', 'Prémices', 'Le tambour', '15', '12'),
(59, 'C16', 'C', 'Pagaille', 'Mon joyeux bazar', '16', '12'),
(60, 'C17', 'C', 'Monotonie', 'Le mauvaise ordre', '17', '12'),
(61, 'C18', 'C', 'Démission', 'Le chanteur rigolo', '18', '12'),
(62, 'C19', 'C', 'Paradoxe', 'Les choses moches', '19', '12'),
(63, 'C20', 'C', 'Triomphe', 'Ma seule prière', '20', '12'),
(64, 'C21', 'C', 'Cigarette', 'Je suis accro', '21', '12'),
(65, 'C22', 'C', 'Admiration', 'J\'aime bien Joe Dassin', '22', '12'),
(66, 'C23', 'C', 'Flou', 'L\'ambiguïté', '23', '12'),
(67, 'C24', 'C', 'Cuisine', 'Lasagnes végétariennes', '24', '12'),
(68, 'C25', 'C', 'Œuvres', 'L\'art pour les nuls', '25', '12'),
(69, 'C26', 'C', 'Bibelots', 'Amour d\'objets', '26', '12'),
(70, 'C27', 'C', 'Témoin', 'Danser avec les regards', '27', '12'),
(71, 'C28', 'C', 'Affligeant', 'Les gens chez Casa', '28', '12'),
(72, 'C29', 'C', 'Stress', 'Le trac', '29', '12'),
(73, 'C30', 'C', 'Film', 'Mémoire visuelle', '30', '12'),
(74, 'C31', 'C', 'Prodige', 'Pas besoin de virtuosité', '31', '12'),
(75, 'C32', 'C', 'Basta', 'Stop les clowns', '32', '12'),
(76, 'C33', 'C', 'Moi', 'Caché sous les coutures', '33', '12'),
(77, 'C34', 'C', 'Ordre', 'Le rangement à la Hollywood', '34', '12'),
(78, 'C35', 'C', 'Désinvolture', 'Le grand saut', '35', '12'),
(79, 'C36', 'C', 'Accro', 'Esclave de mon téléphone', '36', '12'),
(80, 'C37', 'C', 'Mouton', 'J\'suis le pigeon des opinions', '37', '12'),
(81, 'C38', 'C', 'Perdu', 'D\'humeur triste', '38', '12'),
(82, 'C39', 'C', 'Fouillis', 'Le bordel ambulant', '39', '12'),
(83, 'C40', 'C', 'Sport', 'Partie de squash', '40', '12'),
(84, 'D0', 'D', 'Idole', 'Mon égérie', '0', '13'),
(85, 'D1', 'D', 'Marre', 'Overdose', '1', '13'),
(86, 'D2', 'D', 'Rêve', 'J\'suis pas fou, j\'y crois', '2', '13'),
(87, 'D3', 'D', 'Légèreté', 'Sans y croire', '3', '13'),
(88, 'D4', 'D', 'Voix', 'Vous faire danser', '4', '13'),
(89, 'D5', 'D', 'Instruments', 'Un chanteur paresseux', '5', '13'),
(90, 'D6', 'D', 'Original', 'Style singulier', '6', '13'),
(91, 'D7', 'D', 'Bonheur', 'Dopamine Party', '7', '13'),
(92, 'D8', 'D', 'Addiction', 'La danse de la dopamine', '8', '13'),
(93, 'D9', 'D', 'Soucis', 'C’est dommage mais c’est pas grave', '9', '13'),
(94, 'D10', 'D', 'Déconvenue', 'C\'est pas grave si c’est nul', '10', '13'),
(95, 'D11', 'D', 'Décalé', 'Histoire de contexte', '11', '13'),
(96, 'D12', 'D', 'Loufoque', 'Le contexte en folie', '12', '13'),
(97, 'D13', 'D', 'Délibéré', 'Une règle à suivre', '13', '13'),
(98, 'D14', 'D', 'Anticonformiste', 'Mon credo', '14', '13'),
(99, 'D15', 'D', 'Teinté', 'Quel est ton ton?', '15', '13'),
(100, 'D16', 'D', 'Folie', 'Question d\'intention', '16', '13'),
(101, 'D17', 'D', 'Joie', 'Sourire sincère', '17', '13'),
(102, 'D18', 'D', 'Offense', 'Un monde fou', '18', '13'),
(103, 'D19', 'D', 'Ingrédients', 'Passion cuisine', '19', '13'),
(104, 'D20', 'D', 'Recette', 'Cuisine-moi le bonheur', '20', '13'),
(105, 'D21', 'D', 'Sportif', 'Invincible', '21', '13'),
(106, 'D22', 'D', 'Mental', 'C\'est toi le champion', '22', '13'),
(107, 'D23', 'D', 'Ecriture', 'Les blocs-notes', '23', '13'),
(108, 'D24', 'D', 'Satisfaction', 'La magie des blocs-notes', '24', '13'),
(109, 'D25', 'D', 'Drums', 'Le tambour en plastique', '25', '13'),
(110, 'D26', 'D', 'Fierté', 'Le roi du tambour', '26', '13'),
(111, 'D27', 'D', 'Amas', 'La collection folle', '27', '13'),
(112, 'D28', 'D', 'Trésors', 'La collectionneuse', '28', '13'),
(113, 'D29', 'D', 'Bazar', 'Vive le désordre!', '29', '13'),
(114, 'D30', 'D', 'Chaos', 'Fous le bordel!', '30', '13'),
(115, 'D31', 'D', 'Signification', 'Sans prise de tête', '31', '13'),
(116, 'D32', 'D', 'Moche', 'Les choses démodées', '32', '13'),
(117, 'D33', 'D', 'Tubes', 'Pop addiction', '33', '13'),
(118, 'D34', 'D', 'Succès', 'Superstar', '34', '13'),
(119, 'D35', 'D', 'Tabac', 'Délicieuse fumée', '35', '13'),
(120, 'D36', 'D', 'Fumée', 'La fête des bouffées', '36', '13'),
(121, 'D37', 'D', 'Dassin', 'Fan de Joe', '37', '13'),
(122, 'D38', 'D', 'Fan', 'Ma providence', '38', '13'),
(123, 'D39', 'D', 'Bizarrerie', 'Ambiguïté, c\'est mon crédo', '39', '13'),
(124, 'D40', 'D', 'Béchamel', 'Les folles lasagnes', '40', '13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL,
  `user_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `midi_actions`
--
ALTER TABLE `midi_actions`
  ADD PRIMARY KEY (`action_id`);

--
-- Indexes for table `midi_avail_chords_per_tonality`
--
ALTER TABLE `midi_avail_chords_per_tonality`
  ADD PRIMARY KEY (`chord_ton_id`);

--
-- Indexes for table `midi_chords`
--
ALTER TABLE `midi_chords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `midi_percussions`
--
ALTER TABLE `midi_percussions`
  ADD PRIMARY KEY (`percussion_id`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`song_id`);

--
-- Indexes for table `song_moods`
--
ALTER TABLE `song_moods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `song_titles`
--
ALTER TABLE `song_titles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `midi_actions`
--
ALTER TABLE `midi_actions`
  MODIFY `action_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `midi_avail_chords_per_tonality`
--
ALTER TABLE `midi_avail_chords_per_tonality`
  MODIFY `chord_ton_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `midi_chords`
--
ALTER TABLE `midi_chords`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT for table `midi_percussions`
--
ALTER TABLE `midi_percussions`
  MODIFY `percussion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `song_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `song_moods`
--
ALTER TABLE `song_moods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `song_titles`
--
ALTER TABLE `song_titles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
