-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql310.byetcluster.com
-- Generation Time: Sep 21, 2022 at 05:18 AM
-- Server version: 10.3.27-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

create database "berixShop";
use berixShop;

--
-- Database: `berixShop`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(1, 'Asos'),
(2, 'Boss'),
(3, 'Hollister tech'),
(4, 'Nike'),
(5, 'Berghaus'),
(6, 'The North Face'),
(7, 'Bershka'),
(8, 'Sixth June'),
(9, 'PulL&Bear'),
(10, 'Dickies'),
(11, 'Adidas'),
(12, 'Hugo'),
(13, 'Reclaimed'),
(14, 'Topman'),
(15, 'Versace'),
(16, 'FCUK'),
(17, 'Reebok'),
(18, 'New Girl Order'),
(19, 'Missguided'),
(20, 'French Connection'),
(21, 'Stradivarius'),
(22, 'Topshop'),
(23, 'In The Style');

-- --------------------------------------------------------

--
-- Table structure for table `carousel_pics`
--

CREATE TABLE `carousel_pics` (
  `id` int(11) NOT NULL,
  `src` varchar(18) NOT NULL,
  `alt` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `carousel_pics`
--

INSERT INTO `carousel_pics` (`id`, `src`, `alt`) VALUES
(1, 'carouselSlika1.png', 'Slika1'),
(2, 'carouselSlika2.jpg', 'Slika2'),
(3, 'carouselSlika3.png', 'Slika3');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Hoodies and Sweatshirts'),
(2, 'Jackets and Coats'),
(3, 'Jeans'),
(4, 'Joggers'),
(5, 'Jumpers and Cardigans'),
(6, 'Tracksuits and Sweatpants');

-- --------------------------------------------------------

--
-- Table structure for table `choices`
--

CREATE TABLE `choices` (
  `id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `choices`
--

INSERT INTO `choices` (`id`, `survey_id`, `name`) VALUES
(1, 1, 'Shoes'),
(2, 1, 'Jewelry'),
(3, 1, 'Swimwear'),
(4, 2, '25$'),
(5, 2, '50$'),
(6, 2, '100$'),
(7, 2, '150$'),
(8, 2, '200$'),
(9, 2, '300$'),
(10, 2, '500$'),
(11, 3, 'Hats'),
(12, 3, 'Jackets'),
(13, 3, 'Cardigans'),
(14, 3, 'T-shirts'),
(15, 4, 'Not that good :('),
(16, 4, 'Could be better'),
(17, 4, 'Just average'),
(18, 4, 'You guys are good!'),
(19, 4, 'Glorious!!');

-- --------------------------------------------------------

--
-- Table structure for table `footer_pic_elements`
--

CREATE TABLE `footer_pic_elements` (
  `id` int(11) NOT NULL,
  `src` varchar(40) NOT NULL,
  `fa_fa` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `footer_pic_elements`
--

INSERT INTO `footer_pic_elements` (`id`, `src`, `fa_fa`) VALUES
(2, 'assets/css/style.css', 'fab fa-css3-alt'),
(3, 'assets/css/style.scss', 'fab fa-sass'),
(4, 'assets/js/main.js', 'fab fa-js'),
(5, 'assets/pdf/docs.pdf', 'fas fa-file-pdf'),
(6, 'assets/xml/sitemap.xml', 'fas fa-sitemap');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `src` varchar(13) NOT NULL,
  `alt` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `src`, `alt`) VALUES
(1, 'hoodie1.png', 'Hoodie1'),
(2, 'hoodie2.png', 'Hoodie2'),
(3, 'hoodie3.png', 'Hoodie3'),
(4, 'hoodie4.png', 'Hoodie4'),
(5, 'hoodie5.png', 'Hoodie5'),
(6, 'j&c1.png', 'j&c1'),
(7, 'j&c2.png', 'j&c2'),
(8, 'j&c3.png', 'j&c3'),
(9, 'j&c4.png', 'j&c4'),
(10, 'j&c5.png', 'j&c5'),
(11, 'jeans1.png', 'jeans1'),
(12, 'jeans2.png', 'jeans2'),
(13, 'jeans3.png', 'jeans3'),
(14, 'jeans4.png', 'jeans4'),
(15, 'jeans5.png', 'jeans5'),
(16, 'joggers1.png', 'joggers1'),
(17, 'joggers2.png', 'joggers2'),
(18, 'joggers3.png', 'joggers3'),
(19, 'joggers4.png', 'joggers4'),
(20, 'joggers5.png', 'joggers5'),
(21, 'jumpers1.png', 'jumpers1'),
(22, 'jumpers3.png', 'jumpers3'),
(23, 'jumpers4.png', 'jumpers4'),
(24, 'jumpers5.png', 'jumpers5'),
(25, 'jumpers2.png', 'jumpers2'),
(26, 'hoodie6.png', 'Hoodie6'),
(27, 'hoodie7.png', 'Hoodie7'),
(28, 'hoodie8.png', 'Hoodie8'),
(29, 'hoodie9.png', 'Hoodie9'),
(30, 'hoodie10.png', 'Hoodie10'),
(31, 'j&c6.png', 'j&c6'),
(32, 'j&c7.png', 'j&c7'),
(33, 'j&c8.png', 'j&c8'),
(34, 'j&c9.png', 'j&c9'),
(35, 'j&c10.png', 'j&c10'),
(36, 'jeans7.png', 'jeans7'),
(37, 'jeans8.png', 'jeans8'),
(38, 'jeans9.png', 'jeans9'),
(39, 'jeans6.png', 'jeans6'),
(40, 'jeans10.png', 'jeans10'),
(41, 'jumpers6.png', 'jumpers6'),
(42, 'jumpers7.png', 'jumpers7'),
(43, 'jumpers8.png', 'jumpers8'),
(44, 'jumpers9.png', 'jumpers9'),
(45, 'jumpers10.png', 'jumpers10'),
(46, 'ts1.png', 'ts1'),
(47, 'ts2.png', 'ts2'),
(48, 'ts3.png', 'ts3'),
(49, 'ts4.png', 'ts4'),
(50, 'ts5.png', 'ts5');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `message` varchar(500) NOT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `middle_name` varchar(20) DEFAULT NULL,
  `phone_number` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `email`, `message`, `first_name`, `last_name`, `middle_name`, `phone_number`) VALUES
(5, NULL, 'Here is a message', NULL, NULL, NULL, NULL),
(8, NULL, 'And here is another one', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nav_items`
--

CREATE TABLE `nav_items` (
  `id` int(11) NOT NULL,
  `name` varchar(13) NOT NULL,
  `href` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nav_items`
--

INSERT INTO `nav_items` (`id`, `name`, `href`) VALUES
(1, 'Home', 'indexContent.php'),
(3, 'Shop', 'shopContent.php'),
(4, 'Contact', '#contact'),
(5, 'Author', 'authorContent.php'),
(7, 'Docs', '../../assets/pdf/docs.pdf'),
(8, 'Login', '#'),
(9, 'Logout', 'logout.php'),
(10, 'Admin', 'admin.php');

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` int(11) NOT NULL,
  `old_price` decimal(6,2) DEFAULT NULL,
  `new_price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `old_price`, `new_price`) VALUES
(1, '230.99', '199.99'),
(2, NULL, '99.99'),
(3, '112.00', '89.99'),
(4, '187.00', '129.99'),
(5, NULL, '29.99'),
(6, '380.00', '299.99'),
(7, '189.00', '139.99'),
(8, '429.00', '369.99'),
(9, '179.00', '119.99'),
(10, '276.00', '113.99'),
(11, NULL, '29.99'),
(12, '59.00', '36.99'),
(13, '78.00', '36.99'),
(14, NULL, '68.99'),
(15, '85.00', '34.99'),
(16, '29.00', '15.99'),
(17, NULL, '24.99'),
(18, '59.00', '49.99'),
(19, NULL, '13.99'),
(20, '45.00', '24.99'),
(21, NULL, '27.99'),
(22, '67.00', '28.99'),
(23, NULL, '28.99'),
(24, '429.00', '347.99'),
(25, '29.00', '16.99'),
(26, NULL, '27.99'),
(27, '43.00', '21.99'),
(28, NULL, '17.99'),
(29, '35.00', '22.99'),
(30, '147.00', '78.99'),
(31, NULL, '99.99'),
(32, NULL, '38.99'),
(33, '79.00', '42.99'),
(34, '127.00', '68.99'),
(35, '236.00', '189.99'),
(36, NULL, '33.99'),
(37, NULL, '42.99'),
(38, '48.00', '23.99'),
(39, NULL, '35.00'),
(40, NULL, '33.99'),
(41, '68.00', '47.99'),
(42, NULL, '17.99'),
(43, '79.00', '42.99'),
(44, NULL, '99.99'),
(45, '235.00', '178.99'),
(46, NULL, '28.99'),
(47, '37.00', '22.99'),
(48, '53.00', '22.99'),
(49, NULL, '18.99'),
(50, '14.00', '7.99');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(95) NOT NULL,
  `image_id` int(11) NOT NULL,
  `price_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image_id`, `price_id`, `rating`, `gender`, `category_id`, `brand_id`) VALUES
(1, 'ASOS Dark Future oversized sweatshirt in charcoal wash with chest logo', 1, 1, 4, 'M', 1, 1),
(2, 'ASOS DESIGN organic sweatshirt in burgundy', 2, 2, 2, 'M', 1, 1),
(3, 'BOSS Welogo crew neck sweatshirt in black', 3, 3, 3, 'M', 1, 2),
(4, 'Hollister tech chest logo vertical colour block hoodie', 4, 4, 5, 'M', 1, 3),
(5, 'Nike pullover hoodie with swoosh logo in black BV2654-010', 5, 5, 3, 'M', 1, 4),
(6, 'ASOS DESIGN padded trench coat with quilted lining in black', 6, 6, 4, 'M', 2, 1),
(7, 'ASOS DESIGN organic sweatshirt in burgundy', 7, 7, 1, 'M', 2, 1),
(8, 'Berghaus Tramantanta 91 jacket in purple', 8, 8, 4, 'M', 2, 5),
(9, 'ASOS DESIGN puffer gilet in charcoal', 9, 9, 3, 'M', 2, 1),
(10, 'The North Face 1996 Retro Nuptse vest in camo', 10, 10, 4, 'M', 2, 6),
(11, 'ASOS DESIGN baggy jeans in mid wash blue', 11, 11, 1, 'M', 3, 1),
(12, 'Bershka 90\'s fit patchwork jeans in light blue', 12, 12, 4, 'M', 3, 7),
(13, 'Sixth June distressed skinny jeans with inside panel in blue wash', 13, 13, 4, 'M', 3, 8),
(14, 'Bershka 90\'s fit jeans in light blue with rips', 14, 14, 3, 'M', 3, 7),
(15, 'ASOS DESIGN classic rigid jeans in tinted light wash blue', 15, 15, 2, 'M', 3, 1),
(16, 'Pull&Bear Join Life joggers with zip pockets in black', 16, 16, 4, 'M', 4, 9),
(17, 'Pull&Bear jogger with contrast zips in grey', 17, 17, 2, 'M', 4, 9),
(18, 'Adidas Originals Adicolour 3-stripe tracksuit in black', 18, 18, 5, 'M', 4, 11),
(19, 'HUGO Durimi cargo joggers in black', 19, 19, 3, 'M', 4, 12),
(20, 'Dickies Bienville joggers in black', 20, 20, 3, 'M', 4, 10),
(21, 'ASOS DESIGN oversized fisherman rib jumper with mixed stripes', 21, 21, 2, 'M', 5, 1),
(22, 'Reclaimed Vintage inspired knitted spiced cardigan in netural', 22, 22, 5, 'M', 5, 13),
(23, 'Topman fluffy knitted cardigan in navy', 23, 23, 3, 'M', 5, 14),
(24, 'Versace Jeans Couture emblem logo knitted jumper in black', 24, 24, 5, 'M', 5, 15),
(25, 'ASOS DESIGN knitted oversized jumper in space dye yarn', 25, 25, 4, 'M', 5, 1),
(26, 'adidas Originals \'Leopard Luxe\' oversized sweatshirt in off white', 26, 26, 2, 'Z', 1, 11),
(27, 'adidas Originals adicolor boyfriend fit colour block logo hoodie in orange', 27, 27, 4, 'Z', 1, 11),
(28, 'FCUK oversized hoodie in black co-ord', 28, 28, 4, 'Z', 1, 16),
(29, 'Reebok natural dye central logo hoodie in beige', 29, 29, 5, 'Z', 1, 17),
(30, 'New Girl Order x Hello Kitty fleece hoodie with all over kitty print co-ord', 30, 30, 4, 'Z', 1, 18),
(31, 'ASOS LUXE Lounge relaxed oversized jacket in mink', 31, 31, 3, 'Z', 2, 1),
(32, 'Bershka organic cotton oversized denim jacket in black', 32, 32, 3, 'Z', 2, 7),
(33, 'Missguided tailored duster trench coat in blue', 33, 33, 4, 'Z', 2, 19),
(34, 'Nike cropped borg fleece jacket in cream', 34, 34, 5, 'Z', 2, 4),
(35, 'French Connection faux fur hood parka in blue', 35, 35, 5, 'Z', 2, 20),
(36, 'ASOS DESIGN high rise \'slouchy\' mom jean in dirty mid blue', 36, 36, 4, 'Z', 3, 1),
(37, 'ASOS DESIGN Petite \'original\' mom jean in clean black with extreme rips', 37, 37, 5, 'Z', 3, 1),
(38, 'Bershka organic cotton mom jean in washed black', 38, 38, 2, 'Z', 3, 7),
(39, 'ASOS DESIGN high rise \'slouchy\' dadjean in washed black', 39, 39, 3, 'Z', 3, 1),
(40, 'Stradivarius organic cotton slim mom jean with stretch in washed blue', 40, 40, 4, 'Z', 3, 21),
(41, 'Bershka oversized jumper in camel', 41, 41, 4, 'Z', 5, 7),
(42, 'Missguided roll neck jumper with cable sleeves in chocolate', 42, 42, 4, 'Z', 5, 19),
(43, 'Topshop crop cable knit vest in cream', 43, 43, 5, 'Z', 5, 22),
(44, 'Topshop zip-through cable knit cardigan in oatmeal', 44, 44, 3, 'Z', 5, 22),
(45, 'In The Style x Saffron Barker cable knitted split side vest in cream', 45, 45, 4, 'Z', 5, 23),
(46, 'ASOS DESIGN tracksuit sweat - basic jogger with contrast binding in organic cotton in grey marl', 46, 46, 3, 'Z', 6, 1),
(47, 'ASOS DESIGN tracksuit sweatshirt - ribbed legging short in mauve', 47, 47, 4, 'Z', 6, 1),
(48, 'ASOS DESIGN straight leg jogger with deep waistband and pintuck in organic cotton in grey marl', 48, 48, 2, 'Z', 6, 1),
(49, 'Nike metallic swoosh neutral jogger in dark brown', 49, 49, 5, 'Z', 6, 4);

-- --------------------------------------------------------

--
-- Table structure for table `surveys`
--

CREATE TABLE `surveys` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `surveys`
--

INSERT INTO `surveys` (`id`, `name`, `active`) VALUES
(1, 'What new category of products would you like to see in our assortment?', 1),
(2, 'What is your spending budget?', 1),
(3, 'What is your favorite item?', 0),
(4, 'How do you feel about us?', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `middle_name` varchar(20) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(70) NOT NULL,
  `phone_number` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `first_name`, `last_name`, `middle_name`, `email`, `password`, `phone_number`) VALUES
(21, 4, 'Admin', 'Admin', '', 'admin@gmail.com', '12b47a5e88ed6388539a38cd9ce5f416', NULL),
(22, 3, 'Aleksa', 'Berisavac', NULL, 'a@a', 'ed553824923007c1d44e7dff3d393a98', NULL),
(25, 3, 'Isidora', 'Teofilovic', NULL, 'isidorateo75@gmail.com', 'ed553824923007c1d44e7dff3d393a98', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `name`) VALUES
(3, 'user'),
(4, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `choice_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `user_id`, `choice_id`) VALUES
(15, 22, 1),
(16, 22, 19);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carousel_pics`
--
ALTER TABLE `carousel_pics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `choices`
--
ALTER TABLE `choices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `survey_id` (`survey_id`);

--
-- Indexes for table `footer_pic_elements`
--
ALTER TABLE `footer_pic_elements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nav_items`
--
ALTER TABLE `nav_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `image_id` (`image_id`),
  ADD KEY `price_id` (`price_id`);

--
-- Indexes for table `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `choice_id` (`choice_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `choices`
--
ALTER TABLE `choices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `nav_items`
--
ALTER TABLE `nav_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `surveys`
--
ALTER TABLE `surveys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `choices`
--
ALTER TABLE `choices`
  ADD CONSTRAINT `choices_ibfk_1` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`),
  ADD CONSTRAINT `products_ibfk_4` FOREIGN KEY (`price_id`) REFERENCES `prices` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_roles` (`id`);

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`choice_id`) REFERENCES `choices` (`id`),
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
