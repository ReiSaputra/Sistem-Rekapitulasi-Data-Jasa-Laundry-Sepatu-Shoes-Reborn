-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2023 at 05:50 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reborn`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_id` int(11) NOT NULL,
  `client_name` varchar(120) DEFAULT NULL,
  `client_address` text DEFAULT NULL,
  `client_telephone_num` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `employee_name` varchar(120) DEFAULT NULL,
  `employee_username` varchar(120) DEFAULT NULL,
  `employee_password` varchar(120) DEFAULT NULL,
  `employee_date_of_join` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `expense_id` int(11) NOT NULL,
  `expense_id_purchase` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `history_id` int(11) NOT NULL,
  `history_status` varchar(150) DEFAULT NULL,
  `history_id_production` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `owner_id` int(11) NOT NULL,
  `owner_name` varchar(120) DEFAULT NULL,
  `owner_username` varchar(120) DEFAULT NULL,
  `owner_password` varchar(120) DEFAULT NULL,
  `owner_id_expense` int(11) DEFAULT NULL,
  `owner_id_report` int(11) DEFAULT NULL,
  `owner_id_profit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `production_detail`
--

CREATE TABLE `production_detail` (
  `production_id` int(11) NOT NULL,
  `production_nama` varchar(120) DEFAULT NULL,
  `production_deadline` date DEFAULT NULL,
  `production_detail` text DEFAULT NULL,
  `production_id_employee` int(11) DEFAULT NULL,
  `production_id_client` int(11) DEFAULT NULL,
  `production_id_treatment_dtl` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profit`
--

CREATE TABLE `profit` (
  `profit_id` int(11) NOT NULL,
  `expense_id_production` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchasing_item`
--

CREATE TABLE `purchasing_item` (
  `purchase_id` int(11) NOT NULL,
  `purchase_item_name` varchar(120) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `purchase_total` int(11) DEFAULT NULL,
  `purchase_price` int(11) DEFAULT NULL,
  `purchase_id_employee` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(11) NOT NULL,
  `report_title` varchar(150) DEFAULT NULL,
  `report_date` date DEFAULT NULL,
  `report_detail` text DEFAULT NULL,
  `report_id_employee` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `treatment_detail`
--

CREATE TABLE `treatment_detail` (
  `treatment_id` int(11) NOT NULL,
  `treatment_name` varchar(120) DEFAULT NULL,
  `treatment_price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `employee_username` (`employee_username`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `fk_history_id_production` (`history_id_production`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`owner_id`),
  ADD UNIQUE KEY `owner_username` (`owner_username`),
  ADD KEY `fk_owner_id_expense` (`owner_id_expense`),
  ADD KEY `fk_owner_id_report` (`owner_id_report`),
  ADD KEY `fk_owner_id_profit` (`owner_id_profit`);

--
-- Indexes for table `production_detail`
--
ALTER TABLE `production_detail`
  ADD PRIMARY KEY (`production_id`),
  ADD KEY `fk_production_id_employee` (`production_id_employee`),
  ADD KEY `fk_production_id_client` (`production_id_client`),
  ADD KEY `fk_production_id_treatment_dtl` (`production_id_treatment_dtl`);

--
-- Indexes for table `profit`
--
ALTER TABLE `profit`
  ADD PRIMARY KEY (`profit_id`),
  ADD KEY `fk_expense_id_production` (`expense_id_production`);

--
-- Indexes for table `purchasing_item`
--
ALTER TABLE `purchasing_item`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `fk_purchase_id_employee` (`purchase_id_employee`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `fk_report_id_employee` (`report_id_employee`);

--
-- Indexes for table `treatment_detail`
--
ALTER TABLE `treatment_detail`
  ADD PRIMARY KEY (`treatment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `owner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `production_detail`
--
ALTER TABLE `production_detail`
  MODIFY `production_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profit`
--
ALTER TABLE `profit`
  MODIFY `profit_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchasing_item`
--
ALTER TABLE `purchasing_item`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `treatment_detail`
--
ALTER TABLE `treatment_detail`
  MODIFY `treatment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `fk_history_id_production` FOREIGN KEY (`history_id_production`) REFERENCES `production_detail` (`production_id`);

--
-- Constraints for table `owner`
--
ALTER TABLE `owner`
  ADD CONSTRAINT `fk_owner_id_expense` FOREIGN KEY (`owner_id_expense`) REFERENCES `expense` (`expense_id`),
  ADD CONSTRAINT `fk_owner_id_profit` FOREIGN KEY (`owner_id_profit`) REFERENCES `profit` (`profit_id`),
  ADD CONSTRAINT `fk_owner_id_report` FOREIGN KEY (`owner_id_report`) REFERENCES `report` (`report_id`);

--
-- Constraints for table `production_detail`
--
ALTER TABLE `production_detail`
  ADD CONSTRAINT `fk_production_id_client` FOREIGN KEY (`production_id_client`) REFERENCES `client` (`client_id`),
  ADD CONSTRAINT `fk_production_id_employee` FOREIGN KEY (`production_id_employee`) REFERENCES `employee` (`employee_id`),
  ADD CONSTRAINT `fk_production_id_treatment_dtl` FOREIGN KEY (`production_id_treatment_dtl`) REFERENCES `client` (`client_id`);

--
-- Constraints for table `profit`
--
ALTER TABLE `profit`
  ADD CONSTRAINT `fk_expense_id_production` FOREIGN KEY (`expense_id_production`) REFERENCES `report` (`report_id`);

--
-- Constraints for table `purchasing_item`
--
ALTER TABLE `purchasing_item`
  ADD CONSTRAINT `fk_purchase_id_employee` FOREIGN KEY (`purchase_id_employee`) REFERENCES `employee` (`employee_id`);

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `fk_report_id_employee` FOREIGN KEY (`report_id_employee`) REFERENCES `employee` (`employee_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
