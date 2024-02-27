-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2023 at 09:31 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `autoshop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `nid` varchar(17) NOT NULL,
  `auth_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `admin_email`, `contact`, `password`, `image`, `nid`, `auth_code`) VALUES
(1, 'Fardin Rahman', 'admin@gmail.com', '01688888888', 'admin101', '23543674.jpg', '11111111222222', '561454'),
(4, 'Sadman Sharif', 'admin2@gmail.com', '01777777777', 'admin101', 'Wall.jpg', '11546654851364', '651468'),
(6, 'Sanjana Raha', 'admin3@gmail.com', '01444444666', 'admin101', 'Screenshot 2022-01-10 032252.png', '48944299498', '429848');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `customer_email` varchar(50) DEFAULT NULL,
  `contact` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `vehicle_type` varchar(50) NOT NULL,
  `vehicle_model` varchar(50) NOT NULL,
  `vehicle_serial` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `customer_email`, `contact`, `password`, `image`, `vehicle_type`, `vehicle_model`, `vehicle_serial`) VALUES
(12, 'Sanjana Raha', 'sanjana@gmail.com', '01444444666', 'raha101', 'Raha.jpg', 'car', 'Range Rover', 'Dhaka Metro - GHA - 28'),
(15, 'Sadman Sharif', 'sadman@gmail.com', '01777777777', 'sadman101', 'Sadman.jpg', 'bike', 'BMW R nineT', 'Dhaka Metro - CHA - 52'),
(16, 'Fardin Rahman', 'fardin@gmail.com', '01666666666', 'fardin101', 'Fardin.jpg', 'car', 'Rolls Royce', 'Dhaka Metro - GA - 46');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `mechanic_name` varchar(50) NOT NULL,
  `mechanic_email` varchar(50) NOT NULL,
  `feedback` text NOT NULL,
  `customer_id` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `mechanic_name`, `mechanic_email`, `feedback`, `customer_id`, `created_at`) VALUES
(10, 'raha', 'sanjana@gmail.com', 'Amar mon bhalo nei', '16', '2023-04-27 18:41:54');

-- --------------------------------------------------------

--
-- Table structure for table `mechanics`
--

CREATE TABLE `mechanics` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `mechanic_email` varchar(50) DEFAULT NULL,
  `contact` varchar(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `expert_type` varchar(50) NOT NULL,
  `shop_name` varchar(50) NOT NULL,
  `shop_location` varchar(20) DEFAULT NULL,
  `accept_request` enum('YES','NO') DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mechanics`
--

INSERT INTO `mechanics` (`id`, `name`, `mechanic_email`, `contact`, `password`, `image`, `expert_type`, `shop_name`, `shop_location`, `accept_request`) VALUES
(2, 'Ranger', 'ranger@gmail.com', '01333334444', 'mech102', 'wallpaperflare.com_wallpaper.jpg', 'car', 'PRO Shop BD', 'Dhanmondi', 'NO'),
(4, 'Manik', 'manik@gmail.com', '01333333333', 'mech103', 'Screenshot 2022-01-10 032252.png', 'truck', 'Garage BD', 'Dhanmondi', 'NO'),
(5, 'Hanif', 'hanif@gmail.com', '01444444444', 'mech102', 'Wall.jpg', 'bike', 'Biker World', 'Dhanmondi', 'NO'),
(6, 'Walid', 'wdash@gmail.com', '01222222222', 'mech104', 'wallpaperflare.com_wallpaper.jpg', 'car', 'Spare Parts BD', 'Dhanmondi', 'NO'),
(7, 'Labib', 'labib@gmail.com', '01999999888', 'mech106', 'Screenshot 2022-01-10 032252.png', 'car', 'Intercity Garage', 'Bashundhara', 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `request_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `mechanic_id` int(11) NOT NULL,
  `request_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mechanics`
--
ALTER TABLE `mechanics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`request_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mechanics`
--
ALTER TABLE `mechanics`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
