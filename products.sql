-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2023 at 01:45 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chat_gpt`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `desc` text NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `rrp` decimal(7,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL,
  `img` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `desc`, `price`, `rrp`, `quantity`, `img`, `date_added`) VALUES
(1, 'Hanuman', '<p>Unique watch made with stainless steel, ideal for those that prefer interative watches.</p>\n<h3>Features</h3>\n<ul>\n<li>Powered by Android with built-in apps.</li>\n<li>Adjustable to fit most.</li>\n<li>Long battery life, continuous wear for up to 2 days.</li>\n<li>Lightweight design, comfort on your wrist.</li>\n</ul>', '15.00', '18.00', 1000, 'hanuman.jpg', '2023-03-31 08:30:00'),
(2, 'Angkor', '<p>Unique watch made with stainless steel, ideal for those that prefer interative watches.</p>\n<h3>Features</h3>\n<ul>\n<li>Powered by Android with built-in apps.</li>\n<li>Adjustable to fit most.</li>\n<li>Long battery life, continuous wear for up to 2 days.</li>\n<li>Lightweight design, comfort on your wrist.</li>\n</ul>', '12.90', '19.99', 1225, 'angkor.jpg', '2023-03-31 08:30:00'),
(3, 'Cambodia', '<p>Unique watch made with stainless steel, ideal for those that prefer interative watches.</p>\n<h3>Features</h3>\n<ul>\n<li>Powered by Android with built-in apps.</li>\n<li>Adjustable to fit most.</li>\n<li>Long battery life, continuous wear for up to 2 days.</li>\n<li>Lightweight design, comfort on your wrist.</li>\n</ul>', '16.80', '0.00', 2300, 'cambodia.jfif', '2023-03-31 08:30:00'),
(4, 'Tiger', '<p>Unique watch made with stainless steel, ideal for those that prefer interative watches.</p>\n<h3>Features</h3>\n<ul>\n<li>Powered by Android with built-in apps.</li>\n<li>Adjustable to fit most.</li>\n<li>Long battery life, continuous wear for up to 2 days.</li>\n<li>Lightweight design, comfort on your wrist.</li>\n</ul>', '15.50', '17.00', 700, 'tiger.jpg', '2023-03-31 08:30:00'),
(6, 'Anchor', '<p>Unique watch made with stainless steel, ideal for those that prefer interative watches.</p>\n<h3>Features</h3>\n<ul>\n<li>Powered by Android with built-in apps.</li>\n<li>Adjustable to fit most.</li>\n<li>Long battery life, continuous wear for up to 2 days.</li>\n<li>Lightweight design, comfort on your wrist.</li>\n</ul>', '16.30', '0.00', 2000, 'anchor-2.jpg', '2023-03-31 08:30:00'),
(7, 'Ganzberg', '<p>Unique watch made with stainless steel, ideal for those that prefer interative watches.</p>\n<h3>Features</h3>\n<ul>\n<li>Powered by Android with built-in apps.</li>\n<li>Adjustable to fit most.</li>\n<li>Long battery life, continuous wear for up to 2 days.</li>\n<li>Lightweight design, comfort on your wrist.</li>\n</ul>', '14.50', '15.00', 1350, 'ganzberg.jpg', '2023-03-31 08:30:00'),
(8, 'ABC', '<p>Unique watch made with stainless steel, ideal for those that prefer interative watches.</p>\n<h3>Features</h3>\n<ul>\n<li>Powered by Android with built-in apps.</li>\n<li>Adjustable to fit most.</li>\n<li>Long battery life, continuous wear for up to 2 days.</li>\n<li>Lightweight design, comfort on your wrist.</li>\n</ul>', '10.50', '0.00', 1400, 'abc.png', '2023-03-31 08:30:00'),
(9, 'Clasie', '<p>Unique watch made with stainless steel, ideal for those that prefer interative watches.</p>\n<h3>Features</h3>\n<ul>\n<li>Powered by Android with built-in apps.</li>\n<li>Adjustable to fit most.</li>\n<li>Long battery life, continuous wear for up to 2 days.</li>\n<li>Lightweight design, comfort on your wrist.</li>\n</ul>', '15.50', '0.00', 1000, 'clasie.jfif', '2023-03-31 08:30:00'),
(10, 'Black Panther', '<p>Unique watch made with stainless steel, ideal for those that prefer interative watches.</p>\n<h3>Features</h3>\n<ul>\n<li>Powered by Android with built-in apps.</li>\n<li>Adjustable to fit most.</li>\n<li>Long battery life, continuous wear for up to 2 days.</li>\n<li>Lightweight design, comfort on your wrist.</li>\n</ul>', '16.50', '0.00', 2000, 'black-panther.jfif', '2023-03-31 08:30:00'),
(11, 'Vatanak', '<p>Unique watch made with stainless steel, ideal for those that prefer interative watches.</p>\n<h3>Features</h3>\n<ul>\n<li>Powered by Android with built-in apps.</li>\n<li>Adjustable to fit most.</li>\n<li>Long battery life, continuous wear for up to 2 days.</li>\n<li>Lightweight design, comfort on your wrist.</li>\n</ul>', '15.45', '17.00', 1800, 'vattanac.jpg', '2023-03-31 08:30:00'),
(12, 'Wine Snake', '<p>Unique watch made with stainless steel, ideal for those that prefer interative watches.</p>\r\n<h3>Features</h3>\r\n<ul>\r\n<li>Powered by Android with built-in apps.</li>\r\n<li>Adjustable to fit most.</li>\r\n<li>Long battery life, continuous wear for up to 2 days.</li>\r\n<li>Lightweight design, comfort on your wrist.</li>\r\n</ul>', '5.00', '17.00', 90, 'wine-snake-1.jpg', '2023-03-31 08:30:00'),
(13, 'Wine Dragon', '<p>Unique watch made with stainless steel, ideal for those that prefer interative watches.</p>\r\n<h3>Features</h3>\r\n<ul>\r\n<li>Powered by Android with built-in apps.</li>\r\n<li>Adjustable to fit most.</li>\r\n<li>Long battery life, continuous wear for up to 2 days.</li>\r\n<li>Lightweight design, comfort on your wrist.</li>\r\n</ul>', '5.00', '15.00', 100, 'wine-snake-2.jpg', '2023-03-31 08:30:00'),
(14, 'Klang Beer', '<p>Unique watch made with stainless steel, ideal for those that prefer interative watches.</p>\r\n<h3>Features</h3>\r\n<ul>\r\n<li>Powered by Android with built-in apps.</li>\r\n<li>Adjustable to fit most.</li>\r\n<li>Long battery life, continuous wear for up to 2 days.</li>\r\n<li>Lightweight design, comfort on your wrist.</li>\r\n</ul>', '8.00', '10.00', 450, 'klang-beer.jpg', '2023-03-31 08:30:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
