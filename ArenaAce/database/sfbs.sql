-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2023 at 06:18 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arena`
--

INSERT INTO `arena` (`a_id`, `name`, `address`, `email`, `phone`, `description`, `latitude`, `longitude`, `thumbnail`, `has_slider`) VALUES
(31, 'Sajilo Futsal', 'Itahari', 'sajilofutsal898@gmail.com', 9811054721, '<p>sssssssssssssssssssss</p>\r\n', '26.651248599204266', '87.27564978683463', 'basketball.jpg', 1),
(32, 'Sajilo Badminton', 'Itahari', 'sajilobadminton123@gmail.com', 9762514888, '<p>This is sajilo badminton</p>\r\n', '26.651320781854924', '87.27567256488433', 'badminton.jpg', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arena_booking`
--

INSERT INTO `arena_booking` (`id`, `book_number`, `arena_id`, `user_id`, `court_cart_id`, `book_status`, `remarks`, `book_at`) VALUES
(25, 111701914153, 31, 11, 0, 'pending', NULL, '2023-12-07 07:40:53'),
(26, 121701944288, 31, 12, 0, 'confirm', NULL, '2023-12-07 16:03:08'),
(27, 141701946582, 31, 14, 0, 'checkout', 'Invoice Detail', '2023-12-07 16:41:22'),
(29, 141701999762, 31, 14, 0, 'confirm', NULL, '2023-12-08 07:27:42'),
(30, 141702011924, 32, 14, 0, 'pending', NULL, '2023-12-08 10:50:24'),
(31, 141702024559, 32, 14, 0, 'confirm', NULL, '2023-12-08 14:20:59');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assign_court`
--

INSERT INTO `assign_court` (`id`, `arena_id`, `sport_id`, `court_id`, `created_at`) VALUES
(14, 31, 0, 0, '2023-12-07 07:39:48'),
(15, 31, 0, 0, '2023-12-07 07:39:51'),
(17, 31, 24, 7, '2023-12-07 16:35:31'),
(18, 31, 24, 8, '2023-12-07 16:35:35'),
(19, 32, 26, 9, '2023-12-08 10:49:08');

-- --------------------------------------------------------

--
-- Table structure for table `assign_sport`
--

CREATE TABLE `assign_sport` (
  `id` int(11) NOT NULL,
  `arena_id` int(11) NOT NULL,
  `sport_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assign_sport`
--

INSERT INTO `assign_sport` (`id`, `arena_id`, `sport_id`) VALUES
(26, 31, 24),
(27, 32, 26);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contactId`, `fullName`, `email`, `address`, `message`) VALUES
(3, 'Love Kumar', 'love123@gmail.com', 'Itahari', 'Hello');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courts`
--

INSERT INTO `courts` (`court_id`, `name`, `court_category_id`, `price`, `discount`, `description`, `facilities`, `created_at`) VALUES
(7, 'Sajilo Court 1', 0, 100000, 0, '', '', '2023-12-07 07:39:26'),
(8, 'Sajilo Court 2', 0, 1500, 0, '', '', '2023-12-07 16:34:31'),
(9, 'Sajilo Badminton 1', 0, 500, 0, '', '', '2023-12-08 10:48:58');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `court_cart`
--

INSERT INTO `court_cart` (`id`, `cart_number`, `user_id`, `court_id`, `sport_id`, `date`, `time`, `status`, `created_at`) VALUES
(51, 9438, 11, 7, 24, '2023-12-08', '11:00:00', 1, '2023-12-07 07:40:50'),
(52, 7450, 12, 7, 24, '2023-12-08', '11:00:00', 0, '2023-12-07 16:03:07'),
(53, 6037, 14, 8, 24, '2023-12-09', '17:00:00', 0, '2023-12-07 16:41:21'),
(54, 7789, 14, 7, 24, '2023-12-08', '12:00:00', 0, '2023-12-08 07:15:41'),
(55, 3269, 14, 7, 24, '2023-12-08', '10:00:00', 0, '2023-12-08 07:27:40'),
(56, 4232, 14, 9, 26, '2023-12-11', '16:00:00', 1, '2023-12-08 10:50:23'),
(57, 7536, 14, 9, 26, '2023-12-11', '16:30:00', 0, '2023-12-08 14:20:56');

-- --------------------------------------------------------

--
-- Table structure for table `court_category`
--

CREATE TABLE `court_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `user_id`, `court_id`, `billing_number`, `billing_date`) VALUES
(27, 14, 8, 629480, '2023-12-07 16:42:09');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `user_id`, `invoice_id`, `book_number`, `payable_amount`, `payment_method`, `payment_status`, `transaction_date`) VALUES
(15, 14, 629480, 141701946582, 3500, 'cash', 'paid', '2023-12-08 07:32:17');

-- --------------------------------------------------------

--
-- Table structure for table `slider_images`
--

CREATE TABLE `slider_images` (
  `id` int(11) NOT NULL,
  `arena_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slider_images`
--

INSERT INTO `slider_images` (`id`, `arena_id`, `image`) VALUES
(10, 31, 'fb1.jpg'),
(11, 31, 'football.jpg'),
(12, 31, 'futsal.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sport`
--

CREATE TABLE `sport` (
  `s_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sport`
--

INSERT INTO `sport` (`s_id`, `name`, `image`, `description`) VALUES
(24, 'Futsal', 'blog2.jpg', ''),
(26, 'Badminton', 'badminton.jpg', '');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `time_slots`
--

INSERT INTO `time_slots` (`id`, `court_id`, `date`, `time`, `isBooked`, `created_at`) VALUES
(35, 7, '2023-12-08', '10:00:00', 0, '2023-12-07 07:40:25'),
(36, 7, '2023-12-08', '11:00:00', 1, '2023-12-07 07:40:25'),
(37, 7, '2023-12-08', '12:00:00', 1, '2023-12-07 07:40:25'),
(38, 8, '2023-12-09', '16:00:00', 0, '2023-12-07 16:38:39'),
(39, 8, '2023-12-09', '17:00:00', 1, '2023-12-07 16:38:39'),
(40, 8, '2023-12-09', '18:00:00', 0, '2023-12-07 16:38:39'),
(41, 8, '2023-12-09', '19:00:00', 0, '2023-12-07 16:39:38'),
(42, 9, '2023-12-11', '16:00:00', 0, '2023-12-08 10:49:36'),
(43, 9, '2023-12-11', '16:30:00', 1, '2023-12-08 10:49:36');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `u_image`, `email`, `address`, `phone`, `password`, `cpassword`) VALUES
(14, 'Love Kumar', 'team1.jpg', 'love123@gmail.com', 'Itahari', '9874563210', 'Love@098', 'Love@098'),
(15, 'Pawan Ghimire', 'team2.jpg', 'pawan123@gmail.com', 'Itahari', '9756321458', 'Pawan@098', 'Pawan@098');

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
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `arena_booking`
--
ALTER TABLE `arena_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `assign_court`
--
ALTER TABLE `assign_court`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `assign_sport`
--
ALTER TABLE `assign_sport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contactId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courts`
--
ALTER TABLE `courts`
  MODIFY `court_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `court_cart`
--
ALTER TABLE `court_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `court_category`
--
ALTER TABLE `court_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `slider_images`
--
ALTER TABLE `slider_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sport`
--
ALTER TABLE `sport`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `time_slots`
--
ALTER TABLE `time_slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
