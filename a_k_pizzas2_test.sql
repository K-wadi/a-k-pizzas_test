-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2025 at 05:14 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `a_k_pizzas2_test`
--
CREATE DATABASE IF NOT EXISTS `a_k_pizzas2_test` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `a_k_pizzas2_test`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Vlees'),
(2, 'Vegetarisch'),
(3, 'Vis'),
(4, 'Specials');

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
('DoctrineMigrations\\Version20250305111935', '2025-03-12 03:11:10', 182),
('DoctrineMigrations\\Version20250311110238', '2025-03-12 03:11:10', 19),
('DoctrineMigrations\\Version20250311114359', '2025-03-12 03:11:10', 4);

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
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `pizza_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pizza`
--

CREATE TABLE `pizza` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pizza`
--

INSERT INTO `pizza` (`id`, `category_id`, `name`, `description`, `price`, `image`) VALUES
(1, 1, 'BBQ Chicken', 'Kip met BBQ saus', 12.50, 'bbq-chicken.jpg'),
(2, 1, 'Buffalo Chicken', 'Pittige kip', 13.00, 'buffalo-chicken.jpg'),
(3, 1, 'Ham & Bacon', 'Ham en spek', 11.50, 'ham-bacon.jpg'),
(4, 1, 'Hot Pepperoni', 'Extra pittige pepperoni', 11.50, 'hot-pepperoni.jpg'),
(5, 1, 'Salami', 'Italiaanse salami', 11.00, 'salami.jpg'),
(6, 1, 'Tandoori', 'Tandoori kip met kruiden', 13.50, 'tandoori.jpg'),
(7, 1, 'Spicy Meat', 'Mix van pittig vlees', 14.00, 'spicy-meat.jpg'),
(8, 1, 'Mexican Fire', 'Pittige Mexicaanse pizza', 12.50, 'mexican-fire.jpg'),
(9, 2, 'Margherita', 'Tomaat en mozzarella', 10.00, 'margherita.jpg'),
(10, 2, 'Four Cheese', 'Vier soorten kaas', 13.00, 'four-cheese.jpg'),
(11, 2, 'Pesto Veggie', 'Pesto en groenten', 12.00, 'pesto-veggie.jpg'),
(12, 2, 'Spinazie Ricotta', 'Spinazie en ricotta', 12.50, 'spinazie-ricotta.jpg'),
(13, 2, 'Truffle Pizza', 'Truffel en kaas', 15.50, 'truffle-pizza.jpg'),
(14, 2, 'Caprese', 'Tomaat, basilicum en mozzarella', 11.50, 'caprese.jpg'),
(15, 2, 'Black Garlic', 'Zwarte knoflook en groenten', 14.00, 'black-garlic.jpg'),
(16, 2, 'Flaming Veggie', 'Pittige groenten', 13.00, 'flaming-veggie.jpg'),
(17, 3, 'Seafood', 'Zeevruchten', 14.00, 'seafood-pizza.jpg'),
(18, 3, 'Smoked Salmon', 'Gerookte zalm', 15.00, 'salami.jpg'),
(19, 3, 'Tuna Special', 'Tonijn met rode ui', 13.50, 'spicy.jpg'),
(20, 3, 'Anchovy Deluxe', 'Ansjovis en kappertjes', 14.50, 'special.jpg'),
(21, 3, 'Garlic Shrimp', 'Knoflook garnalen', 16.00, 'seafood-pizza.jpg'),
(22, 3, 'Pesto Fish', 'Pesto en vis', 13.00, 'pesto-veggie.jpg'),
(23, 3, 'Spicy Prawn', 'Pittige garnalen', 14.00, 'spicy.jpg'),
(24, 3, 'Sambal Chicken', 'Pittige kip met sambal', 13.50, 'sambal-chicken.jpg'),
(25, 4, 'Inferno', 'Extra pittige pizza', 15.00, 'inferno.jpg'),
(26, 4, 'Nutella Pizza', 'Chocolade topping', 10.00, 'nutella.jpg'),
(27, 4, 'Mushroom Deluxe', 'Paddenstoelen mix', 13.50, 'mushroom-deluxe.jpg'),
(28, 4, 'Quattro Formaggi', 'Vier kazen', 14.50, 'quattro-formaggi.jpg'),
(29, 4, 'Spicy Margherita', 'Pittige variant van de klassieke pizza', 12.00, 'spicy-margherita.jpg'),
(30, 4, 'Deluxe Vlees', 'Mix van vlees met extra kaas', 14.00, 'deluxe-vlees.jpg'),
(31, 4, 'Vegan Special', 'Volledig plantaardige pizza', 13.50, 'vegan-special.jpg'),
(32, 4, 'Special Edition', 'Limited edition smaak', 16.00, 'special.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(1, 'newuser@example.com', '[]', '$2y$13$cJgoC2Hx.zkFs6PH.tLCV.cK4rXRxcHZHyXy6IKArGIIQUEUzNRt6'),
(8, 'newuser@pizza.com', '[]', '$2y$13$fUC/.n2G.jYJwDD1qA/AiuDeeUVM6V/RN88ZtkDM3dd8gElad0St6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F5299398A76ED395` (`user_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_52EA1F098D9F6D38` (`order_id`),
  ADD KEY `IDX_52EA1F09D41D1D42` (`pizza_id`);

--
-- Indexes for table `pizza`
--
ALTER TABLE `pizza`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CFDD826F12469DE2` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pizza`
--
ALTER TABLE `pizza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_F5299398A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `FK_52EA1F098D9F6D38` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`),
  ADD CONSTRAINT `FK_52EA1F09D41D1D42` FOREIGN KEY (`pizza_id`) REFERENCES `pizza` (`id`);

--
-- Constraints for table `pizza`
--
ALTER TABLE `pizza`
  ADD CONSTRAINT `FK_CFDD826F12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
