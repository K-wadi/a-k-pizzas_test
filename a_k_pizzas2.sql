-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2025 at 01:39 AM
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
-- Database: `a_k_pizzas2`
--
CREATE DATABASE IF NOT EXISTS `a_k_pizzas2` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `a_k_pizzas2`;

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
(1, 'Klassieke Pizza\'s'),
(2, 'Speciale Pizza\'s'),
(3, 'Pizza\'s met Vlees'),
(4, 'Vegetarische Pizza\'s');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'khaled', 'khaledwadi747@gmail.com', 'Lekker', 'hi ik vind het heel lekker', '2025-03-21 01:17:23');

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
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `delivery_address` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `status` varchar(255) NOT NULL,
  `order_reference` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `customer_name`, `customer_email`, `customer_phone`, `delivery_address`, `created_at`, `status`, `order_reference`) VALUES
(1, 'Khaledwadi', 'khaledwadi747@gmail.com', '0643733706', 'Amsterdam 123', '2025-03-21 01:13:40', 'To Do', 'ORD-67DCAF34B7477'),
(2, 'Khaledwadi', 'khaledwadi747@gmail.com', '0643733706', 'Amsterdam123', '2025-03-21 01:21:37', 'To Do', 'ORD-67DCB1115E96E');

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

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`id`, `order_id`, `pizza_id`, `quantity`) VALUES
(1, 1, 3, 3),
(2, 2, 1, 1);

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
(1, 1, 'Margherita', 'Tomatensaus, mozzarella, basilicum', 8.50, 'margherita.jpg'),
(2, 1, 'Pepperoni', 'Tomatensaus, mozzarella, pepperoni', 10.50, 'pepperoni.jpg'),
(3, 1, 'Four Cheese', 'Tomatensaus, mozzarella, gorgonzola, parmezaan, fontina', 12.50, 'four-cheese.jpg'),
(4, 1, 'Caprese', 'Tomatensaus, mozzarella, verse tomaten, basilicum', 11.50, 'caprese.jpg'),
(5, 1, 'Funghi', 'Tomatensaus, mozzarella, champignons', 10.00, 'funghi.jpg'),
(6, 1, 'Quattro Formaggi', 'Tomatensaus, vier soorten kaas', 12.50, 'quattro-formaggi.jpg'),
(7, 1, 'Spicy Margherita', 'Pittige tomatensaus, mozzarella, basilicum', 9.50, 'spicy-margherita.jpg'),
(8, 1, 'Burrata Special', 'Tomatensaus, burrata, basilicum', 13.50, 'burrata.jpg'),
(9, 2, 'BBQ Chicken', 'BBQ saus, mozzarella, kip, rode ui, koriander', 13.50, 'bbq-chicken.jpg'),
(10, 2, 'Buffalo Chicken', 'Pittige kip, mozzarella, rode ui, ranch saus', 13.00, 'buffalo-chicken.jpg'),
(11, 2, 'Tandoori', 'Tandoori kip met kruiden, ui, paprika', 13.50, 'tandoori.jpg'),
(12, 2, 'Truffle', 'Truffelsaus, mozzarella, champignons, rucola', 15.50, 'truffle-pizza.jpg'),
(13, 2, 'Pesto Deluxe', 'Pestosaus, mozzarella, cherrytomaten, pijnboompitten', 14.00, 'pesto-veggie.jpg'),
(14, 2, 'Mexican Fire', 'Tomatensaus, mozzarella, jalapeños, maïs, paprika', 13.00, 'mexican-fire.jpg'),
(15, 2, 'Black Garlic', 'Zwarte knoflooksaus, mozzarella, champignons', 14.50, 'black-garlic.jpg'),
(16, 2, 'Special', 'Chef\'s special met vlees', 14.50, 'special.jpg'),
(17, 3, 'Hot Pepperoni', 'Extra pittige pepperoni, mozzarella, jalapeños', 11.50, 'hot-pepperoni.jpg'),
(18, 3, 'Salami', 'Italiaanse salami, mozzarella, oregano', 11.00, 'salami.jpg'),
(19, 3, 'Ham & Bacon', 'Ham, spek, mozzarella, ui', 11.50, 'ham-bacon.jpg'),
(20, 3, 'Spicy Meat', 'Pepperoni, ham, spek, gehakt, mozzarella', 14.50, 'spicy-meat.jpg'),
(21, 3, 'Deluxe Vlees', 'Mix van verschillende vleessoorten', 15.50, 'deluxe-vlees.jpg'),
(22, 3, 'Chili Cheese', 'Pittig gehakt, jalapeños, cheddar', 13.50, 'chili-cheese.jpg'),
(23, 3, 'Sambal Chicken', 'Kip met sambal, ui, paprika', 13.50, 'sambal-chicken.jpg'),
(24, 3, 'Inferno', 'Extra pittige vleespizza met jalapeños', 14.50, 'inferno.jpg'),
(25, 4, 'Vegetariana', 'Tomatensaus, mozzarella, diverse groenten', 12.50, 'vegetariana.jpg'),
(26, 4, 'Vegan Special', 'Tomatensaus, vegan kaas, groenten', 13.50, 'vegan-special.jpg'),
(27, 4, 'Vegan', 'Tomatensaus, vegan kaas, champignons', 12.50, 'vegan.jpg'),
(28, 4, 'Spinazie Ricotta', 'Spinazie, ricotta, knoflook', 13.00, 'spinazie-ricotta.jpg'),
(29, 4, 'Mushroom Deluxe', 'Mix van verschillende paddenstoelen', 14.50, 'mushroom-deluxe.jpg'),
(30, 4, 'Flaming Veggie', 'Pittige groenten, jalapeños', 13.00, 'flaming-veggie.jpg'),
(31, 4, 'Prosciutto & Figs', 'Vijgen, rucola, balsamico', 15.50, 'prosciutto-figs.jpg'),
(32, 4, 'Chili Cheese Veggie', 'Pittige groenten, cheddar', 13.50, 'chili-cheese.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
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
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_F5299398122432EB` (`order_reference`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pizza`
--
ALTER TABLE `pizza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

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
