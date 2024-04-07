-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2024 at 06:14 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wellness_directory`
--

-- --------------------------------------------------------

--
-- Table structure for table `abus`
--

CREATE TABLE `abus` (
  `id` int(11) NOT NULL,
  `internaute_id` int(11) DEFAULT NULL,
  `commentaire_id` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `encodage` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bloc`
--

CREATE TABLE `bloc` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categorie_de_services`
--

CREATE TABLE `categorie_de_services` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `en_avant` tinyint(1) NOT NULL,
  `valide` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categorie_de_services`
--

INSERT INTO `categorie_de_services` (`id`, `nom`, `description`, `en_avant`, `valide`) VALUES
(1, 'Aide à domicile', 'Cette catégorie englobe des services qui offrent une assistance directe au sein du domicile des individus. Les prestataires inscrits proposent diverses formes de soutien, notamment dans les tâches ménagères, les soins personnels et la compagnie. Que vous ', 1, 1),
(2, 'Beauté - Bien-être', 'Cette catégorie englobe des services qui offrent une assistance directe au sein du domicile des individus. Les prestataires inscrits proposent diverses formes de soutien, notamment dans les tâches ménagères, les soins personnels et la compagnie. Que vous ', 0, 1),
(3, 'Coaching', 'Trouvez des professionnels du coaching qualifiés dans cette catégorie. Qu\'il s\'agisse de coaching de vie, professionnel, ou personnel, les experts inscrits sont là pour vous aider à atteindre vos objectifs. Explorez notre annuaire pour connecter avec des ', 0, 0),
(4, 'Coiffure/Cheveux', 'Découvrez des experts en coiffure et en soins capillaires. Que vous cherchiez une nouvelle coupe, une coloration ou des conseils pour prendre soin de vos cheveux, cette catégorie regroupe des professionnels qualifiés prêts à répondre à vos besoins capilla', 0, 1),
(5, 'Esthétique', 'Explorez une variété de services esthétiques proposés par des professionnels qualifiés. Des soins de la peau aux traitements spécialisés, cette catégorie est dédiée à ceux qui cherchent des services esthétiques pour améliorer leur apparence et leur bien-ê', 0, 1),
(6, 'Massage', 'Découvrez les bienfaits du massage grâce à des professionnels compétents. Cette catégorie regroupe des spécialistes du massage, offrant une gamme de techniques pour soulager le stress, détendre les muscles et favoriser le bien-être général.', 0, 1),
(7, 'Ostéopathe', 'Trouvez des ostéopathes qualifiés spécialisés dans le traitement des troubles musculo-squelettiques. Cette catégorie est dédiée à ceux cherchant des soins ostéopathiques pour améliorer la mobilité et soulager les douleurs liées aux tensions musculaires et', 0, 1),
(8, 'Soins', 'Explorez une variété de services de soins offerts par des professionnels qualifiés. Que ce soit des soins de santé, de beauté ou personnels, cette catégorie regroupe des experts prêts à fournir des soins adaptés à vos besoins spécifiques.', 0, 1),
(9, 'Yoga', 'Plongez dans le monde du yoga avec des professionnels qualifiés. Que vous soyez débutant ou expérimenté, cette catégorie propose des instructeurs de yoga offrant des cours adaptés à différents niveaux pour promouvoir la santé physique et mentale.', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `internaute_id` int(11) DEFAULT NULL,
  `prestataire_id` int(11) DEFAULT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `contenu` varchar(255) NOT NULL,
  `cote` int(11) DEFAULT NULL,
  `encodage` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240208193048', '2024-02-08 20:35:26', 1160),
('DoctrineMigrations\\Version20240323122053', '2024-03-23 12:21:43', 342),
('DoctrineMigrations\\Version20240324144324', '2024-03-24 14:43:34', 121);

-- --------------------------------------------------------

--
-- Table structure for table `favori`
--

CREATE TABLE `favori` (
  `id` int(11) NOT NULL,
  `prestataire_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `internaute_id` int(11) DEFAULT NULL,
  `prestataire_id` int(11) DEFAULT NULL,
  `categorie_de_services_id` int(11) DEFAULT NULL,
  `ordre` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `internaute_id`, `prestataire_id`, `categorie_de_services_id`, `ordre`, `image`) VALUES
(3, NULL, 27, NULL, NULL, 'img/PRE/PRE_logo_10.jpeg'),
(5, NULL, 1, NULL, NULL, 'img/PRE/PRE_logo_13.jpg'),
(7, NULL, 2, NULL, NULL, 'img/PRE/PRE_logo_7.png'),
(9, NULL, 3, NULL, NULL, 'img/PRE/PRE_logo_8.jpg'),
(11, NULL, NULL, 1, NULL, 'img/categorieDeServices/cds_1.png'),
(12, NULL, NULL, 2, NULL, 'img/categorieDeServices/cds_2.jpg'),
(13, NULL, NULL, 3, NULL, 'img/categorieDeServices/cds_3.jpg'),
(14, NULL, NULL, 4, NULL, 'img/categorieDeServices/cds_4.jpeg'),
(15, NULL, NULL, 5, NULL, 'img/categorieDeServices/cds_5.jpg'),
(16, NULL, NULL, 6, NULL, 'img/categorieDeServices/cds_6.jpg'),
(17, NULL, NULL, 7, NULL, 'img/categorieDeServices/cds_7.png'),
(18, NULL, NULL, 8, NULL, 'img/categorieDeServices/cds_8.jpg'),
(19, NULL, NULL, 9, NULL, 'img/categorieDeServices/cds_9.jpg'),
(20, NULL, NULL, NULL, NULL, 'img/autres/slider-1.jpg'),
(21, NULL, NULL, NULL, NULL, 'img/autres/slider-2.jpg'),
(22, NULL, NULL, NULL, NULL, 'img/autres/slider-3.jpg'),
(23, NULL, 29, NULL, NULL, 'img/PRE/PRE_logo_6.jpg'),
(30, NULL, 36, NULL, NULL, 'img/PRE/PRE_logo_6.jpg'),
(31, 17, NULL, NULL, NULL, 'img/INT/INT_profil_9.jpg'),
(32, 18, NULL, NULL, NULL, 'img/INT/INT_profil_12.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `internaute`
--

CREATE TABLE `internaute` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `newsletter` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `internaute`
--

INSERT INTO `internaute` (`id`, `nom`, `prenom`, `newsletter`) VALUES
(1, 'Rizzo', 'Antonino', 1),
(2, 'Rizzo', 'Antonino', 1),
(3, 'Rizzo', 'Antonino', 1),
(4, 'Rizzo', 'Antonino', 1),
(5, 'Rizzo', 'Antonino', 1),
(6, 'Rizzo', 'Antonino', 1),
(7, 'Rizzo', 'Antonino', 1),
(8, 'Rizzo', 'Antonino', 1),
(9, 'Rizzo', 'Antonino', 1),
(10, 'Rizzo', 'Antonino', 1),
(11, 'Rizzo', 'Antonino', 1),
(12, 'Rizzo', 'Antonino', NULL),
(13, 'Rizzo', 'Antonino', NULL),
(14, 'Rizzo', 'Antonino', 1),
(15, 'Rizzo', 'Antonino', 1),
(16, 'test', 'test', 1),
(17, 'bello', 'toto', 1),
(18, 'herbillon ', 'Marc', 1);

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `publication` date DEFAULT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `document_pdf` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int(11) NOT NULL,
  `internaute_id` int(11) DEFAULT NULL,
  `bloc_id` int(11) DEFAULT NULL,
  `ordre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prestataire`
--

CREATE TABLE `prestataire` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `site_internet` varchar(255) DEFAULT NULL,
  `num_tel` varchar(255) DEFAULT NULL,
  `num_tva` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prestataire`
--

INSERT INTO `prestataire` (`id`, `nom`, `site_internet`, `num_tel`, `num_tva`) VALUES
(1, 'DB Esthétique', NULL, '0488012282', 'BE0664519383'),
(2, 'Esther Rizzo', '', '+32488012282', '6666'),
(3, 'Barber DG', '', '0488012282', '0664519383'),
(4, 'Esthetica', '', '0488012282', '0664519383'),
(5, 'Gentry', '', '0488012282', '0664519383'),
(27, 'Espace 22', 'https://www.espace22.be/', '0488012282', '0666777555'),
(29, 'cleaners', '', '0488122822', '0111444555'),
(36, 'cleaners', '', '0488122822', '0111444555');

-- --------------------------------------------------------

--
-- Table structure for table `prestataire_categorie_de_services`
--

CREATE TABLE `prestataire_categorie_de_services` (
  `prestataire_id` int(11) NOT NULL,
  `categorie_de_services_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prestataire_categorie_de_services`
--

INSERT INTO `prestataire_categorie_de_services` (`prestataire_id`, `categorie_de_services_id`) VALUES
(29, 1),
(36, 1),
(36, 2);

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE `promotion` (
  `id` int(11) NOT NULL,
  `categorie_de_services_id` int(11) DEFAULT NULL,
  `prestataire_id` int(11) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `document_pdf` longblob DEFAULT NULL,
  `debut` date DEFAULT NULL,
  `fin` date DEFAULT NULL,
  `affichage_de` date DEFAULT NULL,
  `affichage_jusque` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `id` int(11) NOT NULL,
  `region` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`id`, `region`) VALUES
(1, 'Namur'),
(2, 'Luxembourg'),
(3, 'Brabant flamand'),
(4, 'Liège'),
(5, 'Hainaut'),
(6, 'Brabant wallon'),
(7, 'Flandre orientale'),
(8, 'Limbourg'),
(9, 'Flandre occidentale');

-- --------------------------------------------------------

--
-- Table structure for table `stage`
--

CREATE TABLE `stage` (
  `id` int(11) NOT NULL,
  `prestataire_id` int(11) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `tarif` varchar(255) DEFAULT NULL,
  `info_complementaire` varchar(255) DEFAULT NULL,
  `debut` date DEFAULT NULL,
  `fin` date DEFAULT NULL,
  `affichage_de` date DEFAULT NULL,
  `affichage_jusque` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `internaute_id` int(11) DEFAULT NULL,
  `prestataire_id` int(11) DEFAULT NULL,
  `adresse_number` varchar(255) DEFAULT NULL,
  `adresse_rue` varchar(255) DEFAULT NULL,
  `inscription` date NOT NULL,
  `type_utilisateur` varchar(255) DEFAULT NULL,
  `nb_essais_infructueux` int(11) DEFAULT NULL,
  `banni` tinyint(1) NOT NULL,
  `inscript_confirm` tinyint(1) NOT NULL,
  `ville_code_post_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `email`, `roles`, `password`, `is_verified`, `internaute_id`, `prestataire_id`, `adresse_number`, `adresse_rue`, `inscription`, `type_utilisateur`, `nb_essais_infructueux`, `banni`, `inscript_confirm`, `ville_code_post_id`) VALUES
(1, 'ar18082@me.com', '[\"PRE\"]', '$2y$13$dGgI5va4Ovf4hZRBg6unjeIR/SViuY8I5MOK0mheAC6xfnJPKORwy', 0, NULL, 5, '11', 'rue du test', '2024-01-14', NULL, NULL, 0, 0, 14),
(2, 'ar18083@me.com', '[\"INT\"]', '$2y$13$sZjty.J0EL9bAZJJ6o4mBuxya4iL4lpyRodAaIoPUmNxryKp5oVSe', 1, 12, NULL, '11', 'dfd', '2024-01-14', NULL, NULL, 0, 0, 2),
(3, 'ar18084@me.com', '[\"INT\"]', '$2y$13$hZBgDXuYwmMv2kxX3CuBee/Wa9nETwiD54dDPvdd7H9t/SRWMQdFu', 0, 13, NULL, '11', 'dfd', '2024-01-14', NULL, NULL, 0, 0, 12),
(4, 'ar18085@me.com', '[\"INT\"]', '$2y$13$m8mx2GzG.siSSoL1BXVL6ulh1JQ3lh4q.d37gqz1Lbln6TnyIpazy', 1, 14, NULL, '11', 'dfd', '2024-01-14', NULL, NULL, 0, 0, 36),
(5, 'natacha@me.com', '[\"INT\"]', '$2y$13$6Jq.0V4jTpr4EB0tJWhnY.n30bCLyUsPzBF8F1iKkjyZVR8vZM2QS', 1, 15, NULL, '11', 'dfd', '2024-01-18', NULL, NULL, 0, 0, 44),
(6, 'natacha1@me.com', '[\"PRE\"]', '$2y$13$Wg1xb1uN7ETLUSSAN1sXJ.UOqYxdAgZX82ynmyTllpj3wLCT36Ca.', 1, NULL, 36, '7', 'rue du torchon ', '2024-01-18', NULL, NULL, 0, 0, 54),
(7, 'tom@tom.be', '[\"PRE\"]', '$2y$13$f.Pi5VHubmBvpCKZfmn4.e07ghTJpintimy.SW2tpvf2nia/3xRIi', 1, NULL, 2, NULL, NULL, '2024-02-01', NULL, NULL, 0, 0, 66),
(8, 'test10@test.be', '[\"PRE\"]', '$2y$13$S43lN0fu4j1BFGFaii.SaupGKN1z1iU9R3/HtROxWhaa/awWcm6w2', 1, NULL, 3, '3', 'rue du signe', '2024-02-20', NULL, NULL, 0, 0, 72),
(9, 'test11@test.be', '[\"INT\"]', '$2y$13$2hBuIvErtfXvLlt5WPjaEeJz5tmugLDLgEE7bWE/205lHOmi18Era', 1, 17, NULL, '212', 'rue de l\'echelle ', '2024-02-20', NULL, NULL, 0, 0, 8),
(10, 'test12@test.be', '[\"PRE\"]', '$2y$13$/thDlVloVxoeF8UtlgJlJOGYZz71HQRd7loTO9FYtwLixKAmYgTv6', 1, NULL, 27, '22', 'rue de la station', '2024-02-20', NULL, NULL, 0, 0, 8),
(11, 'test13@test.be', '[\"INT\"]', '$2y$13$al3YAsD7T/HJuxY0gufG3eTsuWFJzurK.MyJBhMf.ZEMMgOkT0LKm', 1, NULL, NULL, '101', 'Cité du onze novembre ', '2024-02-20', NULL, NULL, 0, 0, 9),
(12, 'ariz@test.be', '[\"INT\"]', '$2y$13$EbNKPta5OhWcnOZ4v7kWS.6cj2xHYuJW0dQAw2nuI0HvoVNyhk5Oy', 1, 18, NULL, '15', 'rue du dodo ', '2024-02-22', NULL, NULL, 0, 0, 106),
(13, 'test20@test.be', '[\"PRE\"]', '$2y$13$o3YnzaIJW8UtLchepWu6Ou9fjDnxC98IA.YGK9qEXgUHtlDcLINsq', 1, NULL, 1, '101', 'rue du lolo', '2024-02-22', NULL, NULL, 0, 0, 12),
(14, 'test21@test.com', '[\"INT\"]', '$2y$13$5v24TyoULX2CWbL3qmDDm.T.rsBT6atjPXkzFzYCuaVPBDIegfvsW', 1, 11, NULL, '11', 'cefe', '2024-02-22', NULL, NULL, 0, 0, 20),
(15, 'test22@test.be', '[\"INT\"]', '$2y$13$srmv6upncavT5N51mF1wLOrvNvqtLEjy1hTagRxjaFV.1q10XUXOi', 1, NULL, NULL, '11', 'rue du test', '2024-03-12', NULL, NULL, 0, 0, 26);

-- --------------------------------------------------------

--
-- Table structure for table `ville_code_post`
--

CREATE TABLE `ville_code_post` (
  `id` int(11) NOT NULL,
  `region_id` int(11) DEFAULT NULL,
  `ville` varchar(255) DEFAULT NULL,
  `code_post` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ville_code_post`
--

INSERT INTO `ville_code_post` (`id`, `region_id`, `ville`, `code_post`) VALUES
(1, 1, 'Andenne', '5300'),
(2, 1, 'Doische', '5680'),
(3, 1, 'Ciney', '5590'),
(4, 2, 'Habay', '6723'),
(5, 2, 'Paliseul', '6851'),
(6, 3, 'Wezembeek-Oppem', '1970'),
(7, 4, 'Braives', '4263'),
(8, 4, 'Beyne-Heusay', '4610'),
(9, 4, 'Ferrières', '4190'),
(10, 4, 'Verviers', '4800'),
(11, 4, 'Braives', '4260'),
(12, 5, 'Tournai', '7503'),
(13, 5, 'Thuin', '6534'),
(14, 5, 'Mons', '7031'),
(15, 5, 'Saint-Ghislain', '7333'),
(16, 5, 'Momignies', '6596'),
(17, 5, 'Chimay', '6463'),
(18, 5, 'Momignies', '6594'),
(19, 5, 'Mons', '7030'),
(20, 6, 'Rixensart', '1330'),
(21, 6, 'Genappe', '1476'),
(22, 1, 'Mettet', '5640'),
(23, 1, 'Gedinne', '5575'),
(24, 2, 'Gouvy', '6671'),
(25, 2, 'Vielsalm', '6698'),
(26, 2, 'Bouillon', '6832'),
(27, 2, 'Bouillon', '6838'),
(28, 2, 'Wellin', '6922'),
(29, 4, 'Olne', '4877'),
(30, 4, 'Juprelle', '4450'),
(31, 4, 'Burg-Reuland', '4790'),
(32, 4, 'Herve', '4650'),
(33, 4, 'Seraing', '4100'),
(34, 5, 'Rumes', '7610'),
(35, 5, 'Binche', '7131'),
(36, 5, 'Tournai', '7522'),
(37, 5, 'Gerpinnes', '6280'),
(38, 5, 'Bernissart', '7322'),
(39, 5, 'Ath', '7803'),
(40, 5, 'Lobbes', '6543'),
(41, 5, 'Péruwelz', '7601'),
(42, 5, 'Momignies', '6591'),
(43, 5, 'Erquelinnes', '6560'),
(44, 6, 'Ottignies-Louvain-la-Neuve', '1340'),
(45, 6, 'Genappe', '1474'),
(46, 1, 'Houyet', '5560'),
(47, 1, 'Mettet', '5646'),
(48, 1, 'Namur', '5020'),
(49, 1, 'Beauraing', '5573'),
(50, 1, 'Namur', '5100'),
(51, 2, 'Gouvy', '6672'),
(52, 2, 'Saint-Léger', '6747'),
(53, 2, 'Rouvroy', '6767'),
(54, 2, 'Chiny', '6813'),
(55, 2, 'Bouillon', '6830'),
(56, 2, 'Bouillon', '6833'),
(57, 2, 'Saint-Hubert', '6870'),
(58, 3, 'Rhode-Saint-Genèse', '1640'),
(59, 7, 'Renaix', '9600'),
(60, 4, 'Dalhem', '4607'),
(61, 4, 'Raeren', '4730'),
(62, 4, 'Hamoir', '4180'),
(63, 4, 'Remicourt', '4351'),
(64, 4, 'Clavier', '4560'),
(65, 4, 'Ans', '4431'),
(66, 4, 'Saint-Vith', '4780'),
(67, 4, 'Herve', '4654'),
(68, 5, 'Comines-Warneton', '7784'),
(69, 5, 'Brunehaut', '7624'),
(70, 5, 'Mouscron', '7712'),
(71, 5, 'Boussu', '7301'),
(72, 5, 'Momignies', '6592'),
(73, 6, 'Nivelles', '1404'),
(74, 6, 'Mont-Saint-Guibert', '1435'),
(75, 1, 'Florennes', '5621'),
(76, 1, 'Namur', '5010'),
(77, 1, 'Dinant', '5503'),
(78, 1, 'Hastière', '5543'),
(79, 1, 'Assesse', '5336'),
(80, 2, 'Bastogne', '6600'),
(81, 2, 'Wellin', '6921'),
(82, 2, 'Durbuy', '6941'),
(83, 2, 'Nassogne', '6951'),
(84, 2, 'Manhay', '6960'),
(85, 4, 'Pepinster', '4860'),
(86, 4, 'Crisnée', '4367'),
(87, 4, 'Seraing', '4102'),
(88, 4, 'Anthisnes', '4160'),
(89, 4, 'La Calamine', '4721'),
(90, 4, 'Lontzen', '4711'),
(91, 4, 'Blegny', '4672'),
(92, 4, 'Thimister-Clermont', '4890'),
(93, 4, 'Herstal', '4042'),
(94, 4, 'Visé', '4600'),
(95, 5, 'Charleroi', '6060'),
(96, 5, 'Fleurus', '6099'),
(97, 5, 'Jurbise', '7050'),
(98, 5, 'Leuze-en-Hainaut', '7904'),
(99, 6, 'Wavre', '1300'),
(100, 1, 'Beauraing', '5574'),
(101, 1, 'La Bruyère', '5081'),
(102, 2, 'Étalle', '6741'),
(103, 2, 'Libramont-Chevigny', '6800'),
(104, 2, 'Florenville', '6820'),
(105, 2, 'Nassogne', '6953'),
(106, 4, 'Flémalle', '4400'),
(107, 4, 'Visé', '4602'),
(108, 4, 'Oupeye', '4682'),
(109, 4, 'Baelen', '4837'),
(110, 4, 'Awans', '4340'),
(111, 4, 'Visé', '4601'),
(112, 4, 'Nandrin', '4550'),
(113, 4, 'Liège', '4000'),
(114, 4, 'Amblève', '4770'),
(115, 4, 'Fléron', '4621'),
(116, 5, 'Mons', '7020'),
(117, 5, 'Boussu', '7300'),
(118, 5, 'Belœil', '7970'),
(119, 5, 'La Louvière', '7110'),
(120, 5, 'Thuin', '6531'),
(121, 5, 'Comines-Warneton', '7780'),
(122, 5, 'Tournai', '7531'),
(123, 5, 'Tournai', '7520'),
(124, 6, 'Beauvechain', '1320'),
(125, 1, 'Havelange', '5376'),
(126, 1, 'Mettet', '5641'),
(127, 1, 'Gesves', '5340'),
(128, 2, 'Houffalize', '6663'),
(129, 2, 'Houffalize', '6666'),
(130, 2, 'Chiny', '6810'),
(131, 2, 'Herbeumont', '6887'),
(132, 4, 'Ans', '4432'),
(133, 4, 'Neupré', '4120'),
(134, 4, 'Anthisnes', '4161'),
(135, 4, 'Saint-Vith', '4783'),
(136, 4, 'Liège', '4032'),
(137, 4, 'Berloz', '4257'),
(138, 4, 'Plombières', '4852'),
(139, 4, 'Saint-Georges-sur-Meuse', '4470'),
(140, 5, 'Ath', '7801'),
(141, 5, 'Silly', '7850'),
(142, 5, 'Anderlues', '6150'),
(143, 5, 'Saint-Ghislain', '7331'),
(144, 5, 'Brunehaut', '7620'),
(145, 5, 'Soignies', '7060'),
(146, 5, 'Mons', '7000'),
(147, 5, 'Lens', '7870'),
(148, 5, 'Tournai', '7533'),
(149, 5, 'Soignies', '7062'),
(150, 5, 'Mouscron', '7711'),
(151, 5, 'Écaussinnes', '7190'),
(152, 5, 'Tournai', '7532'),
(153, 6, 'Waterloo', '1410'),
(154, 6, 'Tubize', '1480'),
(155, 1, 'Assesse', '5333'),
(156, 1, 'La Bruyère', '5080'),
(157, 8, 'Fourons', '3790'),
(158, 2, 'Houffalize', '6661'),
(159, 2, 'Sainte-Ode', '6680'),
(160, 2, 'Florenville', '6823'),
(161, 2, 'Florenville', '6824'),
(162, 2, 'Paliseul', '6850'),
(163, 2, 'Paliseul', '6852'),
(164, 4, 'Saint-Vith', '4784'),
(165, 4, 'Trois-Ponts', '4980'),
(166, 4, 'Limbourg', '4830'),
(167, 4, 'Chaudfontaine', '4053'),
(168, 4, 'La Calamine', '4720'),
(169, 5, 'Tournai', '7510'),
(170, 5, 'Lessines', '7860'),
(171, 5, 'Comines-Warneton', '7782'),
(172, 5, 'Fleurus', '6223'),
(173, 6, 'Ramillies', '1367'),
(174, 6, 'Walhain', '1457'),
(175, 6, 'Ittre', '1461'),
(176, 1, 'Rochefort', '5589'),
(177, 1, 'Anhée', '5537'),
(178, 1, 'Walcourt', '5651'),
(179, 2, 'Houffalize', '6660'),
(180, 2, 'Étalle', '6742'),
(181, 4, 'Geer', '4253'),
(182, 4, 'Seraing', '4101'),
(183, 4, 'Malmedy', '4960'),
(184, 4, 'Burg-Reuland', '4791'),
(185, 4, 'Saint-Nicolas', '4420'),
(186, 5, 'Montigny-le-Tilleul', '6110'),
(187, 5, 'Les Bons Villers', '6210'),
(188, 5, 'Thuin', '6530'),
(189, 5, 'Antoing', '7643'),
(190, 5, 'Charleroi', '6041'),
(191, 5, 'Lobbes', '6542'),
(192, 5, 'Mons', '7011'),
(193, 6, 'Jodoigne', '1370'),
(194, 6, 'Nivelles', '1401'),
(195, 6, 'Rebecq', '1430'),
(196, 1, 'Hamois', '5363'),
(197, 1, 'Bièvre', '5555'),
(198, 1, 'Dinant', '5501'),
(199, 1, 'Namur', '5024'),
(200, 1, 'Gembloux', '5031'),
(201, 1, 'Somme-Leuze', '5377'),
(202, 8, 'Fourons', '3792'),
(203, 2, 'Gouvy', '6670'),
(204, 2, 'La Roche-en-Ardenne', '6980'),
(205, 4, 'Sprimont', '4141'),
(206, 4, 'Welkenraedt', '4841'),
(207, 4, 'Remicourt', '4350'),
(208, 4, 'Hannut', '4280'),
(209, 4, 'Fléron', '4623'),
(210, 4, 'Geer', '4254'),
(211, 4, 'Faimes', '4317'),
(212, 4, 'Héron', '4218'),
(213, 5, 'Chapelle-lez-Herlaimont', '7160'),
(214, 5, 'Celles', '7760'),
(215, 5, 'Charleroi', '6061'),
(216, 5, 'Binche', '7134'),
(217, 5, 'Brugelette', '7941'),
(218, 5, 'Brugelette', '7940'),
(219, 5, 'Mons', '7021'),
(220, 5, 'Froidchapelle', '6441'),
(221, 5, 'Brunehaut', '7621'),
(222, 6, 'Ottignies-Louvain-la-Neuve', '1342'),
(223, 6, 'Braine-le-Château', '1440'),
(224, 6, 'Ittre', '1460'),
(225, 1, 'Havelange', '5372'),
(226, 1, 'Hastière', '5544'),
(227, 1, 'Assesse', '5330'),
(228, 1, 'Onhaye', '5521'),
(229, 4, 'Ouffet', '4590'),
(230, 4, 'Neupré', '4121'),
(231, 4, 'Spa', '4900'),
(232, 4, 'Braives', '4261'),
(233, 4, 'Herve', '4653'),
(234, 5, 'Lessines', '7861'),
(235, 5, 'Charleroi', '6044'),
(236, 5, 'Beaumont', '6511'),
(237, 5, 'Antoing', '7642'),
(238, 5, 'Ham-sur-Heure-Nalinnes', '6120'),
(239, 5, 'Le Rœulx', '7070'),
(240, 6, 'Wavre', '1301'),
(241, 6, 'Genappe', '1470'),
(242, 6, 'Genappe', '1473'),
(243, 1, 'Dinant', '5502'),
(244, 1, 'Fernelmont', '5380'),
(245, 1, 'Houyet', '5563'),
(246, 1, 'Viroinval', '5670'),
(247, 2, 'Bertogne', '6686'),
(248, 2, 'Musson', '6750'),
(249, 2, 'Virton', '6760'),
(250, 2, 'Tenneville', '6971'),
(251, 4, 'Modave', '4577'),
(252, 4, 'Limbourg', '4834'),
(253, 4, 'Anthisnes', '4162'),
(254, 4, 'Lierneux', '4990'),
(255, 4, 'Chaudfontaine', '4050'),
(256, 4, 'Tinlot', '4557'),
(257, 4, 'Oupeye', '4681'),
(258, 5, 'Thuin', '6533'),
(259, 5, 'Fleurus', '6221'),
(260, 5, 'Flobecq', '7880'),
(261, 5, 'Momignies', '6593'),
(262, 5, 'Écaussinnes', '7191'),
(263, 5, 'Beaumont', '6500'),
(264, 5, 'Fontaine-l\'Évêque', '6142'),
(265, 5, 'Lessines', '7862'),
(266, 5, 'Péruwelz', '7600'),
(267, 5, 'Tournai', '7504'),
(268, 5, 'Fleurus', '6220'),
(269, 6, 'Ottignies-Louvain-la-Neuve', '1341'),
(270, 1, 'Beauraing', '5576'),
(271, 1, 'Hastière', '5540'),
(272, 1, 'Hamois', '5362'),
(273, 1, 'Beauraing', '5570'),
(274, 1, 'Assesse', '5334'),
(275, 2, 'Aubange', '6790'),
(276, 2, 'Durbuy', '6940'),
(277, 3, 'Kraainem', '1950'),
(278, 4, 'Fléron', '4620'),
(279, 4, 'Comblain-au-Pont', '4171'),
(280, 4, 'Herstal', '4041'),
(281, 5, 'Bernissart', '7320'),
(282, 5, 'Belœil', '7973'),
(283, 5, 'La Louvière', '7100'),
(284, 5, 'Mons', '7012'),
(285, 5, 'Quiévrain', '7380'),
(286, 1, 'Ohey', '5352'),
(287, 1, 'Namur', '5022'),
(288, 1, 'Hastière', '5542'),
(289, 2, 'Houffalize', '6662'),
(290, 2, 'Arlon', '6700'),
(291, 2, 'Habay', '6724'),
(292, 2, 'Paliseul', '6856'),
(293, 2, 'Tenneville', '6972'),
(294, 4, 'Hamoir', '4181'),
(295, 4, 'Eupen', '4700'),
(296, 4, 'Fexhe-le-Haut-Clocher', '4347'),
(297, 4, 'Herve', '4652'),
(298, 5, 'Pecq', '7740'),
(299, 5, 'Châtelet', '6200'),
(300, 5, 'Charleroi', '6030'),
(301, 5, 'Rumes', '7618'),
(302, 5, 'Frasnes-lez-Anvaing', '7912'),
(303, 5, 'Momignies', '6590'),
(304, 5, 'Chimay', '6461'),
(305, 6, 'Rixensart', '1332'),
(306, 6, 'Nivelles', '1402'),
(307, 1, 'Florennes', '5620'),
(308, 2, 'Sainte-Ode', '6681'),
(309, 2, 'Attert', '6717'),
(310, 2, 'Virton', '6761'),
(311, 2, 'Neufchâteau', '6840'),
(312, 4, 'Blegny', '4670'),
(313, 4, 'Huy', '4500'),
(314, 4, 'Olne', '4870'),
(315, 4, 'Stavelot', '4970'),
(316, 4, 'Oreye', '4360'),
(317, 5, 'Tournai', '7512'),
(318, 5, 'Charleroi', '6031'),
(319, 5, 'Frasnes-lez-Anvaing', '7911'),
(320, 5, 'Tournai', '7548'),
(321, 5, 'Montigny-le-Tilleul', '6111'),
(322, 5, 'Tournai', '7502'),
(323, 5, 'Fleurus', '6222'),
(324, 6, 'Mont-Saint-Guibert', '1348'),
(325, 6, 'Genappe', '1472'),
(326, 1, 'Éghezée', '5310'),
(327, 1, 'Gembloux', '5032'),
(328, 1, 'Hamois', '5361'),
(329, 2, 'Messancy', '6781'),
(330, 4, 'Wanze', '4520'),
(331, 4, 'Liège', '4030'),
(332, 4, 'Donceel', '4357'),
(333, 4, 'Jalhay', '4845'),
(334, 4, 'Chaudfontaine', '4051'),
(335, 5, 'Morlanwelz', '7140'),
(336, 5, 'Tournai', '7500'),
(337, 5, 'Dour', '7370'),
(338, 5, 'Mont-de-l\'Enclus', '7750'),
(339, 5, 'Courcelles', '6182'),
(340, 5, 'Mouscron', '7700'),
(341, 5, 'Tournai', '7506'),
(342, 5, 'Manage', '7170'),
(343, 1, 'Sombreffe', '5140'),
(344, 1, 'Hamois', '5360'),
(345, 2, 'Vielsalm', '6692'),
(346, 2, 'Habay', '6721'),
(347, 2, 'Messancy', '6780'),
(348, 2, 'Érezée', '6997'),
(349, 4, 'Welkenraedt', '4840'),
(350, 4, 'Burdinne', '4210'),
(351, 4, 'Esneux', '4130'),
(352, 4, 'Engis', '4480'),
(353, 5, 'Ath', '7823'),
(354, 5, 'Ath', '7804'),
(355, 5, 'Saint-Ghislain', '7330'),
(356, 5, 'Fontaine-l\'Évêque', '6140'),
(357, 5, 'Saint-Ghislain', '7334'),
(358, 5, 'Honnelles', '7387'),
(359, 5, 'Quévy', '7041'),
(360, 5, 'Silly', '7830'),
(361, 6, 'Perwez', '1360'),
(362, 1, 'Hastière', '5541'),
(363, 1, 'Mettet', '5644'),
(364, 1, 'Havelange', '5374'),
(365, 1, 'Dinant', '5504'),
(366, 1, 'Houyet', '5562'),
(367, 8, 'Herstappe', '3717'),
(368, 2, 'Vaux-sur-Sûre', '6640'),
(369, 2, 'Daverdisse', '6929'),
(370, 3, 'Linkebeek', '1630'),
(371, 4, 'Bullange', '4760'),
(372, 4, 'Verviers', '4802'),
(373, 4, 'Soumagne', '4631'),
(374, 4, 'Soumagne', '4633'),
(375, 4, 'Soumagne', '4630'),
(376, 5, 'Sivry-Rance', '6470'),
(377, 5, 'Belœil', '7971'),
(378, 5, 'Mons', '7010'),
(379, 5, 'Seneffe', '7181'),
(380, 5, 'Belœil', '7972'),
(381, 5, 'Antoing', '7641'),
(382, 1, 'Hamois', '5364'),
(383, 1, 'Onhaye', '5520'),
(384, 2, 'Gouvy', '6673'),
(385, 2, 'Bouillon', '6834'),
(386, 2, 'Bouillon', '6836'),
(387, 2, 'Wellin', '6920'),
(388, 2, 'Wellin', '6924'),
(389, 2, 'La Roche-en-Ardenne', '6986'),
(390, 3, 'Biévène', '1547'),
(391, 4, 'Bullange', '4761'),
(392, 4, 'Herve', '4651'),
(393, 4, 'Marchin', '4570'),
(394, 4, 'Waimes', '4950'),
(395, 4, 'Eupen', '4701'),
(396, 5, 'Tournai', '7513'),
(397, 5, 'Péruwelz', '7603'),
(398, 5, 'Chimay', '6462'),
(399, 5, 'Mons', '7024'),
(400, 5, 'Mons', '7022'),
(401, 5, 'Ellezelles', '7890'),
(402, 5, 'Péruwelz', '7608'),
(403, 5, 'Binche', '7133'),
(404, 1, 'Namur', '5012'),
(405, 1, 'Ohey', '5351'),
(406, 1, 'Houyet', '5561'),
(407, 8, 'Fourons', '3791'),
(408, 2, 'Bertogne', '6687'),
(409, 2, 'Bertogne', '6688'),
(410, 2, 'Tintigny', '6730'),
(411, 4, 'Verviers', '4801'),
(412, 4, 'Lincent', '4287'),
(413, 4, 'Trois-Ponts', '4983'),
(414, 4, 'Butgenbach', '4750'),
(415, 4, 'Awans', '4342'),
(416, 4, 'Blegny', '4671'),
(417, 4, 'Grâce-Hollogne', '4460'),
(418, 4, 'Dison', '4820'),
(419, 5, 'Brunehaut', '7622'),
(420, 5, 'Chimay', '6464'),
(421, 5, 'Ath', '7811'),
(422, 5, 'Tournai', '7534'),
(423, 5, 'Fontaine-l\'Évêque', '6141'),
(424, 5, 'Tournai', '7543'),
(425, 5, 'Rumes', '7611'),
(426, 5, 'Brugelette', '7943'),
(427, 5, 'Braine-le-Comte', '7090'),
(428, 5, 'Pont-à-Celles', '6230'),
(429, 5, 'Soignies', '7063'),
(430, 5, 'Les Bons Villers', '6211'),
(431, 6, 'Chaumont-Gistoux', '1325'),
(432, 6, 'Braine-l\'Alleud', '1421'),
(433, 6, 'Court-Saint-Étienne', '1490'),
(434, 1, 'Yvoir', '5530'),
(435, 1, 'Floreffe', '5150'),
(436, 2, 'Chiny', '6812'),
(437, 2, 'Libin', '6890'),
(438, 2, 'Marche-en-Famenne', '6900'),
(439, 2, 'Nassogne', '6950'),
(440, 2, 'Hotton', '6990'),
(441, 3, 'Wemmel', '1780'),
(442, 4, 'Aubel', '4880'),
(443, 4, 'Liège', '4031'),
(444, 4, 'Oupeye', '4684'),
(445, 4, 'Theux', '4910'),
(446, 5, 'Frameries', '7080'),
(447, 5, 'Saint-Ghislain', '7332'),
(448, 5, 'Chimay', '6460'),
(449, 5, 'Pecq', '7742'),
(450, 5, 'Morlanwelz', '7141'),
(451, 5, 'Soignies', '7061'),
(452, 1, 'Havelange', '5370'),
(453, 1, 'Ohey', '5350'),
(454, 1, 'Dinant', '5500'),
(455, 1, 'Beauraing', '5572'),
(456, 1, 'Vresse-sur-Semois', '5550'),
(457, 1, 'Onhaye', '5522'),
(458, 1, 'Namur', '5002'),
(459, 1, 'Onhaye', '5524'),
(460, 8, 'Fourons', '3793'),
(461, 9, 'Messines', '8957'),
(462, 2, 'Florenville', '6821'),
(463, 2, 'La Roche-en-Ardenne', '6983'),
(464, 4, 'Bassenge', '4690'),
(465, 4, 'Raeren', '4731'),
(466, 4, 'Amblève', '4771'),
(467, 5, 'Thuin', '6532'),
(468, 5, 'Ath', '7812'),
(469, 5, 'Aiseau-Presles', '6250'),
(470, 5, 'Charleroi', '6020'),
(471, 5, 'Frasnes-lez-Anvaing', '7910'),
(472, 5, 'Leuze-en-Hainaut', '7906'),
(473, 5, 'Lessines', '7866'),
(474, 6, 'Grez-Doiceau', '1390'),
(475, 6, 'Genappe', '1471'),
(476, 1, 'Onhaye', '5523'),
(477, 1, 'Jemeppe-sur-Sambre', '5190'),
(478, 1, 'Ohey', '5354'),
(479, 1, 'Cerfontaine', '5630'),
(480, 1, 'Namur', '5004'),
(481, 1, 'Profondeville', '5170'),
(482, 2, 'Virton', '6762'),
(483, 2, 'Aubange', '6792'),
(484, 2, 'Paliseul', '6853'),
(485, 2, 'Tenneville', '6970'),
(486, 4, 'La Calamine', '4728'),
(487, 4, 'Juprelle', '4452'),
(488, 4, 'Oupeye', '4683'),
(489, 4, 'Villers-le-Bouillet', '4530'),
(490, 4, 'Chaudfontaine', '4052'),
(491, 4, 'Juprelle', '4451'),
(492, 5, 'Colfontaine', '7340'),
(493, 5, 'Courcelles', '6180'),
(494, 5, 'Tournai', '7542'),
(495, 5, 'Tournai', '7501'),
(496, 5, 'Thuin', '6536'),
(497, 5, 'Froidchapelle', '6440'),
(498, 5, 'Tournai', '7538'),
(499, 5, 'Farciennes', '6240'),
(500, 5, 'Brunehaut', '7623'),
(501, 5, 'Fleurus', '6075'),
(502, 5, 'Estaimpuis', '7730'),
(503, 5, 'Courcelles', '6183'),
(504, 5, 'Tournai', '7536'),
(505, 5, 'Charleroi', '6032'),
(506, 5, 'Ath', '7822'),
(507, 1, 'Namur', '5001'),
(508, 1, 'Walcourt', '5650'),
(509, 1, 'Assesse', '5332'),
(510, 1, 'Namur', '5000'),
(511, 1, 'Rochefort', '5580'),
(512, 2, 'Gouvy', '6674'),
(513, 2, 'Habay', '6720'),
(514, 2, 'Étalle', '6743'),
(515, 2, 'Tellin', '6927'),
(516, 2, 'La Roche-en-Ardenne', '6982'),
(517, 4, 'Sprimont', '4140'),
(518, 4, 'Juprelle', '4458'),
(519, 4, 'Oupeye', '4680'),
(520, 5, 'Brugelette', '7942'),
(521, 5, 'Charleroi', '6001'),
(522, 5, 'Charleroi', '6010'),
(523, 5, 'Pont-à-Celles', '6238'),
(524, 5, 'Bernissart', '7321'),
(525, 5, 'Ath', '7810'),
(526, 5, 'Chièvres', '7951'),
(527, 5, 'Chièvres', '7950'),
(528, 6, 'Chastre', '1450'),
(529, 6, 'Villers-la-Ville', '1495'),
(530, 1, 'Namur', '5003'),
(531, 2, 'Martelange', '6630'),
(532, 2, 'Fauvillers', '6637'),
(533, 2, 'Vielsalm', '6690'),
(534, 2, 'Bouillon', '6831'),
(535, 3, 'Drogenbos', '1620'),
(536, 4, 'Soumagne', '4632'),
(537, 4, 'Dison', '4821'),
(538, 4, 'Geer', '4252'),
(539, 4, 'Awans', '4099'),
(540, 4, 'Stoumont', '4987'),
(541, 4, 'Geer', '4250'),
(542, 4, 'Lontzen', '4710'),
(543, 5, 'Leuze-en-Hainaut', '7900'),
(544, 5, 'Tournai', '7521'),
(545, 5, 'Pecq', '7743'),
(546, 5, 'Charleroi', '6000'),
(547, 5, 'Fleurus', '6224'),
(548, 5, 'Quaregnon', '7390'),
(549, 6, 'Lasne', '1380'),
(550, 6, 'Nivelles', '1400'),
(551, 1, 'Fosses-la-Ville', '5070'),
(552, 1, 'Philippeville', '5600'),
(553, 1, 'Couvin', '5660'),
(554, 8, 'Fourons', '3798'),
(555, 2, 'Arlon', '6704'),
(556, 2, 'Messancy', '6782'),
(557, 2, 'Aubange', '6791'),
(558, 2, 'Nassogne', '6952'),
(559, 4, 'Amay', '4540'),
(560, 4, 'Neupré', '4122'),
(561, 4, 'Saint-Vith', '4782'),
(562, 4, 'Héron', '4217'),
(563, 4, 'Waremme', '4300'),
(564, 5, 'Tournai', '7511'),
(565, 5, 'Mons', '7033'),
(566, 5, 'Ath', '7802'),
(567, 5, 'Quévy', '7040'),
(568, 5, 'Lessines', '7864'),
(569, 5, 'Courcelles', '6181'),
(570, 5, 'Merbes-le-Château', '6567'),
(571, 5, 'Quiévrain', '7382'),
(572, 5, 'Hensies', '7350'),
(573, 5, 'Binche', '7130'),
(574, 5, 'Leuze-en-Hainaut', '7901'),
(575, 6, 'La Hulpe', '1310'),
(576, 6, 'Incourt', '1315'),
(577, 6, 'Rixensart', '1331'),
(578, 1, 'Beauraing', '5571'),
(579, 1, 'Houyet', '5564'),
(580, 9, 'Espierres-Helchin', '8587'),
(581, 2, 'Arlon', '6706'),
(582, 2, 'Étalle', '6740'),
(583, 4, 'Comblain-au-Pont', '4170'),
(584, 4, 'Pepinster', '4861'),
(585, 4, 'Plombières', '4850'),
(586, 4, 'Verlaine', '4537'),
(587, 4, 'Dalhem', '4606'),
(588, 4, 'Limbourg', '4831'),
(589, 4, 'Wasseiges', '4219'),
(590, 4, 'Dalhem', '4608'),
(591, 4, 'Juprelle', '4453'),
(592, 5, 'Estinnes', '7120'),
(593, 5, 'Tournai', '7540'),
(594, 5, 'Péruwelz', '7604'),
(595, 5, 'Tournai', '7530'),
(596, 5, 'Péruwelz', '7602'),
(597, 5, 'Seneffe', '7180'),
(598, 5, 'Charleroi', '6043'),
(599, 5, 'Leuze-en-Hainaut', '7903'),
(600, 6, 'Orp-Jauche', '1350'),
(601, 6, 'Hélécine', '1357'),
(602, 1, 'Gembloux', '5030'),
(603, 1, 'Namur', '5021'),
(604, 2, 'Chiny', '6811'),
(605, 2, 'Léglise', '6860'),
(606, 2, 'Bertrix', '6880'),
(607, 2, 'La Roche-en-Ardenne', '6984'),
(608, 2, 'Rendeux', '6987'),
(609, 4, 'Anthisnes', '4163'),
(610, 4, 'Plombières', '4851'),
(611, 4, 'Liège', '4020'),
(612, 4, 'Aywaille', '4920'),
(613, 5, 'Mons', '7034'),
(614, 5, 'Ath', '7800'),
(615, 5, 'Lobbes', '6540'),
(616, 5, 'Mons', '7032'),
(617, 5, 'Charleroi', '6042'),
(618, 5, 'Charleroi', '6040'),
(619, 5, 'Comines-Warneton', '7783'),
(620, NULL, 'Ottignies-Louvain-la-Neuve', '1348'),
(621, 1, 'Sambreville', '5060'),
(622, 1, 'Namur', '5101'),
(623, 1, 'Ohey', '5353'),
(624, 2, 'Meix-devant-Virton', '6769'),
(625, 4, 'Fléron', '4624'),
(626, 4, 'Herstal', '4040'),
(627, 4, 'Ans', '4430'),
(628, 5, 'Lessines', '7863'),
(629, 5, 'Antoing', '7640'),
(630, 5, 'Comines-Warneton', '7781'),
(631, 6, 'Braine-l\'Alleud', '1420'),
(632, 6, 'Braine-l\'Alleud', '1428');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abus`
--
ALTER TABLE `abus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_72C9FD01CAF41882` (`internaute_id`),
  ADD KEY `IDX_72C9FD01BA9CD190` (`commentaire_id`);

--
-- Indexes for table `bloc`
--
ALTER TABLE `bloc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categorie_de_services`
--
ALTER TABLE `categorie_de_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_67F068BCCAF41882` (`internaute_id`),
  ADD KEY `IDX_67F068BCBE3DB2B7` (`prestataire_id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `favori`
--
ALTER TABLE `favori`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_EF85A2CCBE3DB2B7` (`prestataire_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_E01FBE6ACAF41882` (`internaute_id`),
  ADD UNIQUE KEY `UNIQ_E01FBE6A4A81A587` (`categorie_de_services_id`),
  ADD KEY `IDX_E01FBE6ABE3DB2B7` (`prestataire_id`);

--
-- Indexes for table `internaute`
--
ALTER TABLE `internaute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_462CE4F5CAF41882` (`internaute_id`),
  ADD UNIQUE KEY `UNIQ_462CE4F55582E9C0` (`bloc_id`);

--
-- Indexes for table `prestataire`
--
ALTER TABLE `prestataire`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prestataire_categorie_de_services`
--
ALTER TABLE `prestataire_categorie_de_services`
  ADD PRIMARY KEY (`prestataire_id`,`categorie_de_services_id`),
  ADD KEY `IDX_603DD9ABBE3DB2B7` (`prestataire_id`),
  ADD KEY `IDX_603DD9AB4A81A587` (`categorie_de_services_id`);

--
-- Indexes for table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C11D7DD14A81A587` (`categorie_de_services_id`),
  ADD KEY `IDX_C11D7DD1BE3DB2B7` (`prestataire_id`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stage`
--
ALTER TABLE `stage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C27C9369BE3DB2B7` (`prestataire_id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1D1C63B3E7927C74` (`email`),
  ADD KEY `IDX_1D1C63B3CAF41882` (`internaute_id`),
  ADD KEY `IDX_1D1C63B3BE3DB2B7` (`prestataire_id`),
  ADD KEY `IDX_1D1C63B358B04C4` (`ville_code_post_id`);

--
-- Indexes for table `ville_code_post`
--
ALTER TABLE `ville_code_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8B1BCAA198260155` (`region_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abus`
--
ALTER TABLE `abus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bloc`
--
ALTER TABLE `bloc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categorie_de_services`
--
ALTER TABLE `categorie_de_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favori`
--
ALTER TABLE `favori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `internaute`
--
ALTER TABLE `internaute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prestataire`
--
ALTER TABLE `prestataire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `stage`
--
ALTER TABLE `stage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ville_code_post`
--
ALTER TABLE `ville_code_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=633;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `abus`
--
ALTER TABLE `abus`
  ADD CONSTRAINT `FK_72C9FD01BA9CD190` FOREIGN KEY (`commentaire_id`) REFERENCES `commentaire` (`id`),
  ADD CONSTRAINT `FK_72C9FD01CAF41882` FOREIGN KEY (`internaute_id`) REFERENCES `internaute` (`id`);

--
-- Constraints for table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `FK_67F068BCBE3DB2B7` FOREIGN KEY (`prestataire_id`) REFERENCES `prestataire` (`id`),
  ADD CONSTRAINT `FK_67F068BCCAF41882` FOREIGN KEY (`internaute_id`) REFERENCES `internaute` (`id`);

--
-- Constraints for table `favori`
--
ALTER TABLE `favori`
  ADD CONSTRAINT `FK_EF85A2CCBE3DB2B7` FOREIGN KEY (`prestataire_id`) REFERENCES `prestataire` (`id`);

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_E01FBE6A4A81A587` FOREIGN KEY (`categorie_de_services_id`) REFERENCES `categorie_de_services` (`id`),
  ADD CONSTRAINT `FK_E01FBE6ABE3DB2B7` FOREIGN KEY (`prestataire_id`) REFERENCES `prestataire` (`id`),
  ADD CONSTRAINT `FK_E01FBE6ACAF41882` FOREIGN KEY (`internaute_id`) REFERENCES `internaute` (`id`);

--
-- Constraints for table `position`
--
ALTER TABLE `position`
  ADD CONSTRAINT `FK_462CE4F55582E9C0` FOREIGN KEY (`bloc_id`) REFERENCES `bloc` (`id`),
  ADD CONSTRAINT `FK_462CE4F5CAF41882` FOREIGN KEY (`internaute_id`) REFERENCES `internaute` (`id`);

--
-- Constraints for table `prestataire_categorie_de_services`
--
ALTER TABLE `prestataire_categorie_de_services`
  ADD CONSTRAINT `FK_603DD9AB4A81A587` FOREIGN KEY (`categorie_de_services_id`) REFERENCES `categorie_de_services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_603DD9ABBE3DB2B7` FOREIGN KEY (`prestataire_id`) REFERENCES `prestataire` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `promotion`
--
ALTER TABLE `promotion`
  ADD CONSTRAINT `FK_C11D7DD14A81A587` FOREIGN KEY (`categorie_de_services_id`) REFERENCES `categorie_de_services` (`id`),
  ADD CONSTRAINT `FK_C11D7DD1BE3DB2B7` FOREIGN KEY (`prestataire_id`) REFERENCES `prestataire` (`id`);

--
-- Constraints for table `stage`
--
ALTER TABLE `stage`
  ADD CONSTRAINT `FK_C27C9369BE3DB2B7` FOREIGN KEY (`prestataire_id`) REFERENCES `prestataire` (`id`);

--
-- Constraints for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `FK_1D1C63B358B04C4` FOREIGN KEY (`ville_code_post_id`) REFERENCES `ville_code_post` (`id`),
  ADD CONSTRAINT `FK_1D1C63B3BE3DB2B7` FOREIGN KEY (`prestataire_id`) REFERENCES `prestataire` (`id`),
  ADD CONSTRAINT `FK_1D1C63B3CAF41882` FOREIGN KEY (`internaute_id`) REFERENCES `internaute` (`id`);

--
-- Constraints for table `ville_code_post`
--
ALTER TABLE `ville_code_post`
  ADD CONSTRAINT `FK_8B1BCAA198260155` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
