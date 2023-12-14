-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2023 at 02:05 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sfbs`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `adm_id` int(11) NOT NULL,
  `adm_name` varchar(255) NOT NULL,
  `adm_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`adm_id`, `adm_name`, `adm_pass`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `arena`
--

CREATE TABLE `arena` (
  `a_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `description` text NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `has_slider` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `arena`
--

INSERT INTO `arena` (`a_id`, `name`, `address`, `email`, `phone`, `description`, `latitude`, `longitude`, `thumbnail`, `has_slider`) VALUES
(28, 'Biratchowk Badminton Hall', 'Biratchowk', 'biratchowk@gmail.com', 9800000000, '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<p>\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\r\n</p>', '26.667395', '87.393181', 'badminton.jpg', 1),
(29, 'Khorsane Sports Hall', 'Khorsane', 'khorsanesport@gmail.com', 9762514888, '<p><strong>this is khorsane sports hall</strong></p>\r\n', '26.667395', '87.393181', 'football.jpg', 1),
(30, 'Baccha Hokey Playground', 'Chilly Town', 'bacchahockey@gmail.com', 984455555, '<p>this baccha hokey play ground</p>\r\n', '26.66739586190145', '87.39317638043025', 'football.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `arena_booking`
--

CREATE TABLE `arena_booking` (
  `id` int(11) NOT NULL,
  `book_number` bigint(60) DEFAULT NULL,
  `arena_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `court_cart_id` int(11) NOT NULL,
  `book_status` varchar(200) NOT NULL DEFAULT 'pending',
  `remarks` varchar(500) DEFAULT NULL,
  `book_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `arena_booking`
--

INSERT INTO `arena_booking` (`id`, `book_number`, `arena_id`, `user_id`, `court_cart_id`, `book_status`, `remarks`, `book_at`) VALUES
(17, 81696466483, 30, 8, 0, '', '', '2023-10-05 06:26:23'),
(18, 81696470259, 30, 8, 0, 'select', '', '2023-10-05 07:29:19'),
(19, 61696574969, 28, 6, 0, 'select', '', '2023-10-06 12:34:29'),
(20, 61696580755, 29, 6, 0, 'select', '', '2023-10-06 14:10:55');

-- --------------------------------------------------------

--
-- Table structure for table `assign_court`
--

CREATE TABLE `assign_court` (
  `id` int(11) NOT NULL,
  `arena_id` int(11) NOT NULL,
  `sport_id` int(11) NOT NULL,
  `court_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assign_court`
--

INSERT INTO `assign_court` (`id`, `arena_id`, `sport_id`, `court_id`, `created_at`) VALUES
(1, 28, 21, 1, '2023-09-23 23:01:02'),
(2, 29, 21, 2, '2023-09-23 23:01:02'),
(3, 29, 21, 4, '2023-09-23 23:01:02'),
(4, 28, 21, 2, '2023-09-23 23:01:02'),
(5, 28, 20, 4, '2023-09-23 23:01:02'),
(7, 30, 22, 5, '2023-09-23 23:01:33'),
(9, 30, 22, 6, '2023-09-24 21:26:45');

-- --------------------------------------------------------

--
-- Table structure for table `assign_sport`
--

CREATE TABLE `assign_sport` (
  `id` int(11) NOT NULL,
  `arena_id` int(11) NOT NULL,
  `sport_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assign_sport`
--

INSERT INTO `assign_sport` (`id`, `arena_id`, `sport_id`) VALUES
(16, 28, 19),
(17, 28, 21),
(19, 29, 21),
(20, 29, 20),
(21, 30, 22);

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `b_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`b_id`, `title`, `image`, `description`, `author`, `created_at`) VALUES
(1, 'Well Serviced Court', 'badminton.jpg', '<p><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</strong></p>', 'Happy Club', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contactId` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contactId`, `fullName`, `email`, `address`, `message`) VALUES
(1, 'Krishna Khadka', 'krishkhadka2059@gmail.com', 'Khorsane', 'Hello Hi Bye'),
(2, 'Puja Giri', 'girisandhya993@gmail.com', 'Khorsane', 'Hello 123');

-- --------------------------------------------------------

--
-- Table structure for table `courts`
--

CREATE TABLE `courts` (
  `court_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `court_category_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `discount` float NOT NULL,
  `description` text NOT NULL,
  `facilities` varchar(500) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courts`
--

INSERT INTO `courts` (`court_id`, `name`, `court_category_id`, `price`, `discount`, `description`, `facilities`, `created_at`) VALUES
(1, 'khadka badminton court', 1, 200, 15, 'this is our badminton court', '<ul><li>Washroom</li><li>AC Setting room</li></ul>', '2023-07-02 08:27:40'),
(2, 'khadka2 badminton', 0, 139, 0, '<p>gfgdgdfg</p>\r\n', 'Rem sit aute omnis c', '2023-08-13 00:43:43'),
(3, 'Idona Jimenez', 0, 139, 24, '<p>gfgdgdfg</p>\r\n', 'Rem sit aute omnis c', '2023-08-13 00:44:12'),
(4, 'Court 1', 0, 1000, 0, '', '', '2023-08-13 14:27:50'),
(5, 'Baccha Hockey Court1', 0, 400, 20, '<p>this is hockey court</p>\r\n', 'ac , toilet, ', '2023-09-23 22:59:29'),
(6, 'Bacha Hokey Court2', 0, 500, 200, '<p>this is baccha hokey court 2</p>\r\n', 'lots of facilities', '2023-09-24 21:24:42');

-- --------------------------------------------------------

--
-- Table structure for table `court_cart`
--

CREATE TABLE `court_cart` (
  `id` int(11) NOT NULL,
  `cart_number` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `court_id` int(11) NOT NULL,
  `sport_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `court_cart`
--

INSERT INTO `court_cart` (`id`, `cart_number`, `user_id`, `court_id`, `sport_id`, `date`, `time`, `status`, `created_at`) VALUES
(28, 56081, 6, 2, 21, '2023-10-04', '03:04:00', 0, '2023-10-04 20:18:29'),
(35, 26470, 8, 6, 22, '2023-10-11', '05:00:00', 1, '2023-10-05 06:26:20'),
(36, 70806, 8, 6, 22, '2023-10-16', '20:00:00', 1, '2023-10-05 07:29:15'),
(37, 27539, 6, 1, 21, '2023-10-06', '12:36:00', 0, '2023-10-06 12:34:25');

-- --------------------------------------------------------

--
-- Table structure for table `court_category`
--

CREATE TABLE `court_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `court_category`
--

INSERT INTO `court_category` (`id`, `name`, `status`) VALUES
(1, 'Badminton', 0),
(2, 'Futsal Court', 0),
(3, 'Hockey', 0);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `court_id` int(11) NOT NULL,
  `billing_number` int(11) NOT NULL,
  `billing_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `user_id`, `court_id`, `billing_number`, `billing_date`) VALUES
(11, 6, 1, 969510, '2023-10-04 01:24:29'),
(12, 6, 2, 969510, '2023-10-04 01:24:29'),
(15, 8, 6, 817709, '2023-10-04 23:01:57'),
(16, 8, 6, 621757, '2023-10-05 06:28:41'),
(17, 8, 6, 628738, '2023-10-05 06:28:48'),
(18, 8, 6, 704957, '2023-10-05 07:36:44'),
(19, 8, 6, 704957, '2023-10-05 07:36:44'),
(20, 8, 6, 528138, '2023-10-06 13:33:48'),
(21, 8, 6, 528138, '2023-10-06 13:33:48'),
(22, 8, 6, 811291, '2023-10-06 13:38:31'),
(23, 8, 6, 811291, '2023-10-06 13:38:31'),
(24, 6, 2, 983137, '2023-10-06 13:41:23'),
(25, 6, 1, 983137, '2023-10-06 13:41:23'),
(26, 6, 2, 707372, '2023-10-06 14:26:47'),
(27, 6, 1, 707372, '2023-10-06 14:26:47'),
(28, 6, 2, 752837, '2023-10-06 14:27:32'),
(29, 6, 1, 752837, '2023-10-06 14:27:32');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_id` bigint(20) NOT NULL,
  `book_number` bigint(20) NOT NULL,
  `payable_amount` double DEFAULT NULL,
  `payment_method` varchar(20) DEFAULT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'due',
  `transaction_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `user_id`, `invoice_id`, `book_number`, `payable_amount`, `payment_method`, `payment_status`, `transaction_date`) VALUES
(6, 6, 969510, 61696351086, 339, 'cash', 'paid', '2023-10-04 10:34:18'),
(7, 6, 256486, 61696430050, 1139, NULL, 'due', '2023-10-04 20:22:50'),
(8, 6, 983137, 61696574969, 339, 'cash', 'paid', '2023-10-06 13:50:27');

-- --------------------------------------------------------

--
-- Table structure for table `slider_images`
--

CREATE TABLE `slider_images` (
  `id` int(11) NOT NULL,
  `arena_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slider_images`
--

INSERT INTO `slider_images` (`id`, `arena_id`, `image`) VALUES
(1, 25, 'arena2.jpg'),
(2, 25, 'team1.jpg'),
(3, 25, 'team4.jpg'),
(4, 28, 'blog1.jpg'),
(5, 28, 'blog2.jpg'),
(6, 28, 'blog3.jpg'),
(7, 29, 'arena4.jpg'),
(8, 29, 'about1.jpg'),
(9, 30, '8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sport`
--

CREATE TABLE `sport` (
  `s_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sport`
--

INSERT INTO `sport` (`s_id`, `name`, `image`, `description`) VALUES
(20, 'Football', 'football.jpg', ''),
(21, 'Badminton', 'badminton.jpg', ''),
(22, 'Hockey', '5.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `time_slots`
--

CREATE TABLE `time_slots` (
  `id` int(11) NOT NULL,
  `court_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `isBooked` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `time_slots`
--

INSERT INTO `time_slots` (`id`, `court_id`, `date`, `time`, `isBooked`, `created_at`) VALUES
(1, 1, '2023-08-13', '02:38:41', 0, '2023-09-23 23:52:32'),
(2, 2, '2023-08-13', '13:38:41', 1, '2023-09-23 23:52:32'),
(6, 2, '2023-09-23', '19:17:26', 0, '2023-09-23 23:52:32'),
(7, 2, '2023-09-23', '12:18:31', 0, '2023-09-23 01:20:20'),
(20, 2, '2023-09-26', '20:05:00', 0, '2023-09-24 20:02:16'),
(25, 5, '2023-09-24', '20:20:00', 0, '2023-09-24 20:20:47'),
(26, 5, '2023-09-24', '22:20:00', 1, '2023-09-24 20:20:47'),
(27, 6, '2023-09-24', '21:27:00', 0, '2023-09-24 21:27:20'),
(28, 1, '2023-10-06', '17:03:00', 0, '2023-10-06 17:01:26'),
(29, 1, '2023-10-06', '20:01:00', 0, '2023-10-06 17:01:52');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `u_image` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cpassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `u_image`, `email`, `address`, `phone`, `password`, `cpassword`) VALUES
(5, 'Krishna Khadka', 'team1.jpg', 'krishna@gmail.com', 'Khorsane', '9762514888', 'chris098@', 'chris098@'),
(6, 'krishna parajuli', 'about1.png', 'krishnaprj@gmail.com', 'Chitre', '9804074883', 'krishna1234', 'krishna1234'),
(7, 'Krijal Khadka', 'hero1.png', 'krijal@gmail.com', 'Khorsane', '9874563210', 'krijal', 'krijal'),
(8, 'Mangesh Maskey', 'home2.jpg', 'royalmaskey12345@gmail.com', 'Khorsane', '98110645646', '12345', '12345'),
(9, 'Krish Khadka', 'team1.jpg', 'krishkhadka06@gmail.com', 'Khorsane', '9811064546', '12345', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`adm_id`);

--
-- Indexes for table `arena`
--
ALTER TABLE `arena`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `arena_booking`
--
ALTER TABLE `arena_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign_court`
--
ALTER TABLE `assign_court`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign_sport`
--
ALTER TABLE `assign_sport`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contactId`);

--
-- Indexes for table `courts`
--
ALTER TABLE `courts`
  ADD PRIMARY KEY (`court_id`);

--
-- Indexes for table `court_cart`
--
ALTER TABLE `court_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `court_category`
--
ALTER TABLE `court_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider_images`
--
ALTER TABLE `slider_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sport`
--
ALTER TABLE `sport`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `time_slots`
--
ALTER TABLE `time_slots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `adm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `arena`
--
ALTER TABLE `arena`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `arena_booking`
--
ALTER TABLE `arena_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `assign_court`
--
ALTER TABLE `assign_court`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `assign_sport`
--
ALTER TABLE `assign_sport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contactId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `courts`
--
ALTER TABLE `courts`
  MODIFY `court_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `court_cart`
--
ALTER TABLE `court_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `court_category`
--
ALTER TABLE `court_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `slider_images`
--
ALTER TABLE `slider_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sport`
--
ALTER TABLE `sport`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `time_slots`
--
ALTER TABLE `time_slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
