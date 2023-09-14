-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 14, 2023 at 04:45 PM
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
-- Table structure for table `song_titles`
--

DROP TABLE IF EXISTS `song_titles`;
CREATE TABLE IF NOT EXISTS `song_titles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `mood` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `pitch` varchar(255) NOT NULL,
  `channel` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

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
(18, 'C0', 'C', 'Marre', 'Overdose', '0', '12'),
(19, 'C1', 'C', 'Malheureux', 'La Déprime', '1', '12'),
(20, 'C2', 'C', 'Instruments', 'Sans Instrument', '2', '12'),
(21, 'C3', 'C', 'Rêveur', 'Les Yeux dans le Vague', '3', '12'),
(22, 'C4', 'C', 'Molécule', 'Dopamine Addiction', '4', '12'),
(23, 'C5', 'C', 'Tracas', 'Pas grave, mais c\'est dommage', '5', '12'),
(24, 'C6', 'C', 'Nul', 'Médiocrité', '6', '12'),
(25, 'C7', 'C', 'Bataille', 'Histoire de contexte', '7', '12'),
(26, 'C8', 'C', 'Libération', 'La Liberté', '8', '12'),
(27, 'C9', 'C', 'Désaccordé', 'Quel est ton ton?', '9', '12'),
(28, 'C10', 'C', 'Dessein', 'J\'ai pas fait exprès', '10', '12'),
(29, 'C11', 'C', 'Enthousiasme', 'Pas de mauvaise humeur', '11', '12'),
(30, 'C12', 'C', 'Gastronomie', 'La recette de la fête', '12', '12'),
(31, 'C13', 'C', 'Intellect', 'Le champion du cerveau', '13', '12'),
(32, 'C14', 'C', 'Spleen', 'Mélo-colie', '14', '12'),
(33, 'C15', 'C', 'Prémices', 'Le tambour', '15', '12'),
(34, 'D0', 'D', 'Idole', 'Mon égérie', '0', '13'),
(35, 'D1', 'D', 'Marre', 'Overdose', '1', '13'),
(36, 'D2', 'D', 'Rêve', 'J\'suis pas fou, j\'y crois', '2', '13'),
(37, 'D3', 'D', 'Légèreté', 'Sans y croire', '3', '13'),
(38, 'D4', 'D', 'Voix', 'Vous faire danser', '4', '13'),
(39, 'D5', 'D', 'Instruments', 'Un chanteur paresseux', '5', '13'),
(40, 'D6', 'D', 'Original', 'Style singulier', '6', '13'),
(41, 'D7', 'D', 'Bonheur', 'Dopamine Party', '7', '13'),
(42, 'D8', 'D', 'Addiction', 'La danse de la dopamine', '8', '13'),
(43, 'D9', 'D', 'Soucis', 'C’est dommage mais c’est pas grave', '9', '13'),
(44, 'D10', 'D', 'Déconvenue', 'C\'est pas grave si c’est nul', '10', '13'),
(45, 'D11', 'D', 'Décalé', 'Histoire de contexte', '11', '13'),
(46, 'D12', 'D', 'Loufoque', 'Le contexte en folie', '12', '13'),
(47, 'D13', 'D', 'Délibéré', 'Une règle à suivre', '13', '13'),
(48, 'D14', 'D', 'Anticonformiste', 'Mon credo', '14', '13'),
(49, 'D15', 'D', 'Teinté', 'Quel est ton ton?', '15', '13');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
