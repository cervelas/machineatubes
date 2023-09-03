-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 03, 2023 at 11:37 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `midi_actions`
--

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
(13, 8, 'VOICE_HARMONY', 'C', NULL, 8, 'ON/OFF SWITCH'),
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
-- Table structure for table `midi_equiv`
--

CREATE TABLE `midi_equiv` (
  `id` int(11) NOT NULL,
  `note_name` varchar(255) NOT NULL,
  `pitch` varchar(255) DEFAULT NULL,
  `step` varchar(255) NOT NULL,
  `do_alter` varchar(255) DEFAULT NULL,
  `octave` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `midi_equiv`
--

INSERT INTO `midi_equiv` (`id`, `note_name`, `pitch`, `step`, `do_alter`, `octave`) VALUES
(1, 'G9', '127', 'G', '', '10'),
(2, 'F#9', '126', 'F', '1', '10'),
(3, 'F9', '125', 'F', '', '10'),
(4, 'E9', '124', 'E', '', '10'),
(5, 'D#9', '123', 'D', '1', '10'),
(6, 'D9', '122', 'D', '', '10'),
(7, 'C#9', '121', 'C', '1', '10'),
(8, 'C9', '120', 'C', '', '10'),
(9, 'B8', '119', 'B', '', '9'),
(10, 'A#8', '118', 'A', '1', '9'),
(11, 'A8', '117', 'A', '', '9'),
(12, 'G#8', '116', 'G', '1', '9'),
(13, 'G8', '115', 'G', '', '9'),
(14, 'F#8', '114', 'F', '1', '9'),
(15, 'F8', '113', 'F', '', '9'),
(16, 'E8', '112', 'E', '', '9'),
(17, 'D#8', '111', 'D', '1', '9'),
(18, 'D8', '110', 'D', '', '9'),
(19, 'C#8', '109', 'C', '1', '9'),
(20, 'C8', '108', 'C', '', '9'),
(21, 'B7', '107', 'B', '', '8'),
(22, 'A#7', '106', 'A', '1', '8'),
(23, 'A7', '105', 'A', '', '8'),
(24, 'G#7', '104', 'G', '1', '8'),
(25, 'G7', '103', 'G', '', '8'),
(26, 'F#7', '102', 'F', '1', '8'),
(27, 'F7', '101', 'F', '', '8'),
(28, 'E7', '100', 'E', '', '8'),
(29, 'D#7', '99', 'D', '1', '8'),
(30, 'D7', '98', 'D', '', '8'),
(31, 'C#7', '97', 'C', '1', '8'),
(32, 'C7', '96', 'C', '', '8'),
(33, 'B6', '95', 'B', '', '7'),
(34, 'A#6', '94', 'A', '1', '7'),
(35, 'A6', '93', 'A', '', '7'),
(36, 'G#6', '92', 'G', '1', '7'),
(37, 'G6', '91', 'G', '', '7'),
(38, 'F#6', '90', 'F', '1', '7'),
(39, 'F6', '89', 'F', '', '7'),
(40, 'E6', '88', 'E', '', '7'),
(41, 'D#6', '87', 'D', '1', '7'),
(42, 'D6', '86', 'D', '', '7'),
(43, 'C#6', '85', 'C', '1', '7'),
(44, 'C6', '84', 'C', '', '7'),
(45, 'B5', '83', 'B', '', '6'),
(46, 'A#5', '82', 'A', '1', '6'),
(47, 'A5', '81', 'A', '', '6'),
(48, 'G#5', '80', 'G', '1', '6'),
(49, 'G5', '79', 'G', '', '6'),
(50, 'F#5', '78', 'F', '1', '6'),
(51, 'F5', '77', 'F', '', '6'),
(52, 'E5', '76', 'E', '', '6'),
(53, 'D#5/Eb5', '75', 'D', '1', '6'),
(54, 'D5', '74', 'D', '', '6'),
(55, 'C#5/Db5', '73', 'C', '1', '6'),
(56, 'C5', '72', 'C', '', '6'),
(57, 'B4', '71', 'B', '', '5'),
(58, 'A#4', '70', 'A', '1', '5'),
(59, 'A4 concert pitch', '69', 'A', '', '5'),
(60, 'G#4/Ab4', '68', 'G', '1', '5'),
(61, 'G4', '67', 'G', '', '5'),
(62, 'F#4/Gb4', '66', 'F', '1', '5'),
(63, 'F4', '65', 'F', '', '5'),
(64, 'E4', '64', 'E', '', '5'),
(65, 'D#4/Eb4', '63', 'D', '1', '5'),
(66, 'D4', '62', 'D', '', '5'),
(67, 'C#4/Db4', '61', 'C', '1', '5'),
(68, 'C4 (middle C)', '60', 'C', '', '5'),
(69, 'B3', '59', 'B', '', '4'),
(70, 'A#3', '58', 'A', '1', '4'),
(71, 'A3', '57', 'A', '', '4'),
(72, 'G#3/Ab3', '56', 'G', '1', '4'),
(73, 'G3', '55', 'G', '', '4'),
(74, 'F#3/Gb3', '54', 'F', '1', '4'),
(75, 'F3', '53', 'F', '', '4'),
(76, 'E3', '52', 'E', '', '4'),
(77, 'D#3/Eb3', '51', 'D', '1', '4'),
(78, 'D3', '50', 'D', '', '4'),
(79, 'C#3/Db3', '49', 'C', '1', '4'),
(80, 'C3', '48', 'C', '', '4'),
(81, 'B2', '47', 'B', '', '3'),
(82, 'A#2', '46', 'A', '1', '3'),
(83, 'A2', '45', 'A', '', '3'),
(84, 'G#2/Ab2', '44', 'G', '1', '3'),
(85, 'G2', '43', 'G', '', '3'),
(86, 'F#2/Gb2', '42', 'F', '1', '3'),
(87, 'F2', '41', 'F', '', '3'),
(88, 'E2', '40', 'E', '', '3'),
(89, 'D#2/Eb2', '39', 'D', '1', '3'),
(90, 'D2', '38', 'D', '', '3'),
(91, 'C#2/Db2', '37', 'C', '1', '3'),
(92, 'C2', '36', 'C', '', '3'),
(93, 'B1', '35', 'B', '', '2'),
(94, 'A#1', '34', 'A', '1', '2'),
(95, 'A1', '33', 'A', '', '2'),
(96, 'G#1/Ab1', '32', 'G', '1', '2'),
(97, 'G1', '31', 'G', '', '2'),
(98, 'F#1/Gb1', '30', 'F', '1', '2'),
(99, 'F1', '29', 'F', '', '2'),
(100, 'E1', '28', 'E', '', '2'),
(101, 'D#1/Eb1', '27', 'D', '1', '2'),
(102, 'D1', '26', 'D', '', '2'),
(103, 'C#1/Db1', '25', 'C', '1', '2'),
(104, 'C1', '24', 'C', '', '2'),
(105, 'B0', '23', 'B', '', '1'),
(106, 'A#0', '22', 'A', '1', '1'),
(107, 'A0', '21', 'A', '', '1'),
(108, 'D0', '14', 'D', NULL, '1'),
(109, 'D#0', '15', 'D', '1', '1'),
(110, 'C-1', '12', 'C', '', '-1'),
(111, 'C0', '24', 'C', NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `midi_percussions`
--

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

CREATE TABLE `songs` (
  `song_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `song_title` text NOT NULL,
  `song_mood` varchar(255) NOT NULL,
  `song_tempo` int(11) NOT NULL,
  `song_style` enum('16beat','bossa','disco','pop') NOT NULL,
  `song_addons` enum('simple','claps','full','hammer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

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
-- Indexes for table `midi_equiv`
--
ALTER TABLE `midi_equiv`
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
-- AUTO_INCREMENT for table `midi_equiv`
--
ALTER TABLE `midi_equiv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
