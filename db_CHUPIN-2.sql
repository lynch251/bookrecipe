-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 17, 2019 at 10:56 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recette`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` int(11) NOT NULL,
  `intitule_categorie` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `intitule_categorie`) VALUES
(1, 'Entrées'),
(2, 'Plats'),
(3, 'Desserts'),
(4, 'Apéritifs');

-- --------------------------------------------------------

--
-- Table structure for table `recette`
--

CREATE TABLE `recette` (
  `id_recipe` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `date_creation_recipe` datetime NOT NULL,
  `mark_recipe` int(5) DEFAULT NULL,
  `picture_recipe` blob,
  `id_user` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `ingredients` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recette`
--

INSERT INTO `recette` (`id_recipe`, `title`, `description`, `date_creation_recipe`, `mark_recipe`, `picture_recipe`, `id_user`, `id_categorie`, `ingredients`) VALUES
(160, 'Bonsoir', 'Bonsoir', '2019-02-08 08:22:13', 5, NULL, 8, 0, ''),
(176, 'Accras aux crevettes', '\r\nPRÉPARATION\r\nÉTAPE 1\r\nHachez rapidement les crevettes au mixeur.\r\n\r\nÉTAPE 2\r\nIncorporez les oignons hachés, la farine et la bière. Assaisonnez cette pâte épaisse de sel et de 4 gouttes de tabasco.\r\n\r\nÉTAPE 3\r\nChauffez l\'huile dans un wok ou dans une sauteuse.\r\n\r\nÉTAPE 4\r\nFaites glisser la pâte cuillerée par cuillerée dans l\'huile chaude.\r\n\r\nÉTAPE 5\r\nCuisez les acras par quatre à la fois (ils ne doivent pas se toucher ) 3 à 4 min .\r\n\r\nÉTAPE 6\r\nRetirez les acras avec une écumoire.\r\n\r\nÉTAPE 7\r\nEgouttez-les sur du papier absorbant et servez-les avec des quartiers de citron vert.', '2019-02-15 15:24:33', 5, 0x7075626c69632f696d616765732f3137362e6a7067, 8, 4, 'INGRÉDIENTS\r\n150 g de crevettes crues décortiquées\r\n125 g de farine spéciale gâteaux\r\n12 cl de bière\r\n2 oignons nouveaux\r\n1/2 litre d\'huile pour friture\r\ntabasco\r\ncitron vert\r\nsel\r\n'),
(183, 'Cannelés au chorizo et beaufort', 'Revisiter une recette sucrée en recette salée fait toujours son petit effet en cuisine (et inversement). Si vous êtes à la recherche d\'un amuse-bouche original qui sort de l\'ordinaire, je vous propose cette recette de cannelés au chorizo et Beaufort, à présenter à vos invités pour votre prochain apéro dînatoire. Véritable spécialité de la pâtisserie bordelaise, le cannelé est un petit gâteau à pâte tendre, au rhum et à la vanille; à la croute épaisse et caramélisée en forme de cylindre strié. Idéal pour un apéritif gourmand et convivial à partager en famille ou entre amis.<br />\r\n<br />\r\nÉTAPE 1<br />\r\nPortez le lait à ébullition avec le beurre à feu moyen. Dans un saladier, mélangez avec un fouet la farine avec un œuf entier et le jaune du deuxième oeuf, pour obtenir une pâte bien homogène. Versez le lait/beurre dans votre mélange progressivement et incorporez-les complètement jusqu\'à l\'obtention d\'une pâte bien lisse. Laissez tiédir la pâte en la mettant au frais une petite heure.<br />\r\n<br />\r\nÉTAPE 2<br />\r\nPréchauffez votre four à 210°C.<br />\r\n<br />\r\nÉTAPE 3<br />\r\nCoupez en petites lamelles votre chorizo. Ajoutez-les avec les morceaux de Beaufort dans votre pâte. Salez et poivrez. Remplissez vos moules aux deux tiers avec votre pâte. Enfournez vos cannelés pendant 45 minutes. Laissez-les tiédir sur une grille une fois démoulés. Servez vos cannelés au chorizo et au Beaufort tièdes ou froids.<br />\r\n<br />\r\n', '2019-02-17 22:34:08', 5, 0x7075626c69632f696d616765732f3138332e6a7067, 8, 4, '1/2 L de lait écrémé\r\n150 g de Beaufort en morceaux\r\n100 g de farine\r\n50 g de beurre\r\nchorizo très fin en chiffonnade\r\n2 oeufs\r\nsel, poivre\r\nMoule à cannelés');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pwd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `email`, `pwd`) VALUES
(8, 'chupin.pierre@outlook.com', '$2y$10$rXIwl8esNfJjXXJEjOmg1e3xHGjAhlwGcUk2u.SwfoaZ4O3lIQOTG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Indexes for table `recette`
--
ALTER TABLE `recette`
  ADD PRIMARY KEY (`id_recipe`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `recette`
--
ALTER TABLE `recette`
  MODIFY `id_recipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
