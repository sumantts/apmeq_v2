-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2024 at 06:33 PM
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
-- Database: `apmeq_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `asset_details`
--

CREATE TABLE `asset_details` (
  `asset_id` int(11) NOT NULL,
  `facility_id` int(11) NOT NULL COMMENT 'PK of facility_master',
  `department_id` int(11) NOT NULL COMMENT 'PK of department_list',
  `equipment_name` varchar(255) NOT NULL,
  `asset_make` varchar(255) NOT NULL,
  `asset_model` varchar(255) NOT NULL,
  `slerial_number` varchar(255) NOT NULL,
  `asset_specifiaction` varchar(255) NOT NULL,
  `date_of_installation` date NOT NULL,
  `ins_certificate` varchar(255) NOT NULL,
  `asset_supplied_by` varchar(255) NOT NULL,
  `value_of_the_asset` varchar(255) NOT NULL,
  `total_year_in_service` varchar(255) NOT NULL,
  `technology` tinyint(1) NOT NULL,
  `asset_status` tinyint(1) NOT NULL,
  `asset_class` tinyint(1) NOT NULL,
  `device_group` tinyint(1) NOT NULL,
  `last_date_of_calibration` date NOT NULL,
  `calibration_attachment` varchar(255) NOT NULL,
  `frequency_of_calibration` varchar(255) NOT NULL,
  `last_date_of_pms` date NOT NULL,
  `pms_attachment` varchar(255) NOT NULL,
  `frequency_of_pms` varchar(255) NOT NULL,
  `qa_due_date` date NOT NULL,
  `qa_attachment` varchar(255) NOT NULL,
  `warranty_last_date` date NOT NULL,
  `amc_yes_no` tinyint(1) NOT NULL,
  `amc_last_date` date NOT NULL,
  `cmc_yes_no` tinyint(1) NOT NULL,
  `cmc_last_date` date NOT NULL,
  `asset_code` varchar(10) NOT NULL,
  `sp_details` text NOT NULL,
  `row_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset_details`
--

INSERT INTO `asset_details` (`asset_id`, `facility_id`, `department_id`, `equipment_name`, `asset_make`, `asset_model`, `slerial_number`, `asset_specifiaction`, `date_of_installation`, `ins_certificate`, `asset_supplied_by`, `value_of_the_asset`, `total_year_in_service`, `technology`, `asset_status`, `asset_class`, `device_group`, `last_date_of_calibration`, `calibration_attachment`, `frequency_of_calibration`, `last_date_of_pms`, `pms_attachment`, `frequency_of_pms`, `qa_due_date`, `qa_attachment`, `warranty_last_date`, `amc_yes_no`, `amc_last_date`, `cmc_yes_no`, `cmc_last_date`, `asset_code`, `sp_details`, `row_status`) VALUES
(1, 0, 3, 'X-Ray Table', '1', '2', '3', '4', '2024-09-10', '', '6', '7', '8', 1, 1, 1, 1, '2024-09-10', '', '1|1', '2024-09-10', '', '2|2', '2024-09-10', '', '2024-09-10', 1, '2024-09-10', 1, '2024-09-10', 'ABC_123456', 'ok', 1),
(2, 5, 3, 'X-Ray Table', '1', '2', '3', '4', '2024-09-10', '', '6', '7', '8', 1, 1, 1, 1, '2024-09-10', '', '1|1', '2024-09-10', '', '2|1', '2024-09-10', '', '2024-09-10', 1, '2024-09-10', 1, '2024-09-10', 'ASD_456', 'ok no problem', 1),
(3, 4, 3, 'ECG Machine', '1', '2', '3', '4', '2024-09-10', '', '6', '7', '8', 1, 1, 1, 2, '2024-09-10', '', '1|1', '2024-09-10', '', '1|1', '2024-09-10', '', '2024-09-10', 1, '2024-09-10', 1, '2024-09-10', '', 'ok', 1),
(4, 4, 3, 'ECG Machine', '1', '2', '3', '4', '2024-09-10', '', '6', '7', '8', 1, 1, 1, 2, '2024-09-10', '', '1|1', '2024-09-10', '', '1|1', '2024-09-10', '', '2024-09-10', 1, '2024-09-10', 1, '2024-09-10', '', 'ok 1 2 3 4', 1),
(5, 4, 3, 'X-Ray Table', '', '', '', '', '0000-00-00', '', '', '', '', 1, 2, 1, 1, '0000-00-00', '', '', '0000-00-00', '', '', '0000-00-00', '', '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', '', '', 1),
(6, 2, 3, 'X-Ray Table', '', '', '', '', '0000-00-00', '', '', '', '', 1, 1, 1, 3, '0000-00-00', '', '', '0000-00-00', '', '', '0000-00-00', '', '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', '', '', 1),
(7, 6, 3, 'X-Ray Table', '', '', '', '', '0000-00-00', '', '', '', '', 1, 3, 1, 4, '0000-00-00', '', '', '0000-00-00', '', '', '0000-00-00', '', '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', '', '', 1),
(8, 6, 3, 'X-Ray Table', '', '', '', '', '0000-00-00', '', '', '', '', 1, 4, 1, 3, '0000-00-00', '', '', '0000-00-00', '', '', '0000-00-00', '', '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', '', '', 1),
(9, 6, 3, 'X-Ray Table', '', '', '', '', '0000-00-00', '', '', '', '', 1, 2, 1, 1, '0000-00-00', '', '', '0000-00-00', '', '', '0000-00-00', '', '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', '', '', 1),
(10, 6, 3, 'X-Ray Table', '', '', '', '', '0000-00-00', '[\"66e10adb2c32b.png\",\"66e10adb3a2ea.jpg\",\"66e10adb559ed.jpg\"]', '', '', '', 1, 1, 1, 2, '0000-00-00', '', '', '0000-00-00', '', '', '0000-00-00', '', '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', '', '', 1),
(11, 5, 1, 'X-Ray Table', '', '', '', '', '0000-00-00', '[\"66e10bde6cef3.png\",\"66e10bde79eed.jpg\",\"66e10bde9269d.jpg\"]', '', '', '', 1, 4, 1, 2, '0000-00-00', '', '', '0000-00-00', '', '', '0000-00-00', '', '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', '', '', 1),
(12, 6, 3, 'X-Ray Table', '', '', '', '', '0000-00-00', '[\"66e10c9222d05.png\",\"66e10c9235555.jpg\",\"66e10c9244441.jpg\"]', '', '', '', 1, 1, 1, 1, '0000-00-00', '', '', '0000-00-00', '', '', '0000-00-00', '', '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', '', '', 1),
(13, 6, 3, 'X-Ray Table', '', '', '', '', '0000-00-00', '[\"66e1114778f30.png\",\"66e11147850ab.jpg\",\"66e1117ccd5a0.jpg\"]', '', '', '', 1, 1, 2, 2, '0000-00-00', '', '', '0000-00-00', '', '', '0000-00-00', '', '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', '', '', 1),
(14, 6, 3, 'X-Ray Table', '', '', '', '', '0000-00-00', '', '', '', '', 1, 1, 1, 2, '0000-00-00', '', '', '0000-00-00', '', '', '0000-00-00', '', '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', '', '', 1),
(15, 6, 3, 'X-Ray Table', '', '', '', '', '0000-00-00', '[\"66e113348e4b1.png\"]', '', '', '', 1, 5, 2, 4, '0000-00-00', '[\"66e1131cba397.jpg\"]', '', '0000-00-00', '', '', '0000-00-00', '', '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', '', '', 1),
(16, 6, 3, 'X-Ray Table', '', '', '', '', '0000-00-00', '[\"66e1149dc6212.jpg\"]', '', '', '', 2, 4, 1, 1, '0000-00-00', '[\"66e11491dd2fc.jpg\"]', '', '0000-00-00', '[\"66e11487ee971.jpg\"]', '', '0000-00-00', '', '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', '', '', 1),
(17, 6, 3, 'X-Ray Table', '', '', '', '', '0000-00-00', '[\"66e116b5b1381.png\"]', '', '', '', 1, 2, 1, 2, '0000-00-00', '[\"66e116add0287.jpg\"]', '', '0000-00-00', '[\"66e116a5cac98.jpg\"]', '', '0000-00-00', '[\"66e1169c3c090.png\"]', '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', '', '', 1),
(18, 6, 3, 'X-Ray Table', '', '', '', '', '0000-00-00', '[\"66e1171aac3e3.jpg\"]', '', '', '', 1, 2, 1, 2, '0000-00-00', '[\"66e11721d09d2.jpg\"]', '', '0000-00-00', '[\"66e11727f2582.jpg\"]', '', '0000-00-00', '[\"66e1172e0a997.jpg\"]', '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', '', '', 1),
(19, 6, 3, 'X-Ray', '', '', '', '', '0000-00-00', '[\"66e11ab42f9ba.png\",\"66e11ac07cd32.jpg\"]', '', '', '', 1, 2, 1, 2, '0000-00-00', '[\"66e11ad763797.jpg\",\"66e11ad784fd8.jpg\"]', '', '0000-00-00', '', '', '0000-00-00', '', '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `asset_reallocate`
--

CREATE TABLE `asset_reallocate` (
  `reallocate_id` int(11) NOT NULL,
  `department_from` int(11) NOT NULL,
  `department_to` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset_type_list`
--

CREATE TABLE `asset_type_list` (
  `asset_type_id` int(11) NOT NULL,
  `asset_type_name` varchar(255) NOT NULL,
  `asset_type_code` varchar(255) NOT NULL,
  `asset_type_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_list`
--

CREATE TABLE `category_list` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_slug` varchar(255) NOT NULL,
  `activity_status` varchar(10) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department_list`
--

CREATE TABLE `department_list` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `department_code` varchar(255) NOT NULL,
  `department_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department_list`
--

INSERT INTO `department_list` (`department_id`, `department_name`, `department_code`, `department_status`) VALUES
(1, 'SNCU', 'SNCU', 1),
(3, 'CCU', 'CCU', 1);

-- --------------------------------------------------------

--
-- Table structure for table `facility_master`
--

CREATE TABLE `facility_master` (
  `facility_id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL COMMENT 'PK of hospital_list',
  `department_id` int(11) NOT NULL COMMENT 'PK of department_list',
  `facility_name` varchar(255) NOT NULL,
  `facility_type` tinyint(1) NOT NULL,
  `facility_code` varchar(255) NOT NULL,
  `facility_address` text NOT NULL,
  `nabh_accrediated` tinyint(1) NOT NULL,
  `nabl_accrediated` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'PK of user_details'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facility_master`
--

INSERT INTO `facility_master` (`facility_id`, `hospital_id`, `department_id`, `facility_name`, `facility_type`, `facility_code`, `facility_address`, `nabh_accrediated`, `nabl_accrediated`, `user_id`) VALUES
(1, 2, 3, 'Facility 5', 1, 'FAC_HOS_1', 'jkhn', 1, 1, 1),
(2, 2, 3, 'Facility 4', 1, 'FAC_HOS_1', 'kjlkj', 1, 1, 1),
(3, 2, 1, 'Facility 2', 2, 'FAC_HOS_2', 'Bagnan', 2, 2, 1),
(4, 2, 1, 'Facility 3', 2, 'FAC_HOS_3', 'kolkata', 2, 2, 1),
(5, 2, 1, 'Facility 1', 2, 'FAC_HOS_1', 'ok', 1, 1, 1),
(6, 2, 3, 'New Facility', 1, 'N_FAC', 'Facility Address', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hospital_list`
--

CREATE TABLE `hospital_list` (
  `hospital_id` int(11) NOT NULL,
  `hospital_name` varchar(255) NOT NULL,
  `hospital_code` varchar(255) NOT NULL,
  `hospital_address` text NOT NULL,
  `hospital_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospital_list`
--

INSERT INTO `hospital_list` (`hospital_id`, `hospital_name`, `hospital_code`, `hospital_address`, `hospital_status`) VALUES
(2, 'Bagnan Hospital', 'BAG001', 'P.S - Bagnan ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer_list`
--

CREATE TABLE `manufacturer_list` (
  `manufacturer_id` int(11) NOT NULL,
  `manufacturer_name` varchar(255) NOT NULL,
  `manufacturer_code` varchar(255) NOT NULL,
  `primary_contact_number` varchar(10) NOT NULL,
  `secondary_contact_number` varchar(10) NOT NULL,
  `manufacturer_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_providers_list`
--

CREATE TABLE `service_providers_list` (
  `service_providers_id` int(11) NOT NULL,
  `service_providers_name` varchar(255) NOT NULL,
  `service_providers_code` varchar(255) NOT NULL,
  `primary_contact_number` varchar(10) NOT NULL,
  `secondary_contact_number` varchar(10) NOT NULL,
  `service_providers_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_list`
--

CREATE TABLE `supplier_list` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `supplier_code` varchar(255) NOT NULL,
  `primary_contact_number` varchar(10) NOT NULL,
  `secondary_contact_number` varchar(10) NOT NULL,
  `supplier_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_type_id` int(11) NOT NULL COMMENT 'PK of user_type',
  `hospital_id` int(11) NOT NULL COMMENT 'PK of hospital_list',
  `user_mobile` varchar(10) NOT NULL,
  `user_phone` varchar(10) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_dob` date NOT NULL,
  `user_address` text NOT NULL,
  `user_user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `user_name`, `user_type_id`, `hospital_id`, `user_mobile`, `user_phone`, `user_email`, `user_dob`, `user_address`, `user_user_name`, `user_password`, `user_status`) VALUES
(1, 'Mr. Superadmin', 1, 2, '9733935161', '256789', 'superadmin@gmail.com', '1987-10-01', 'Bagnan', 'superadmin@gmail.com', '12345678', 1),
(15, 'Mr. Hospital Admin', 2, 2, '9876543210', '', 'hospitaladmin@apmeq.com', '2024-08-28', 'Village: Bhuarah; Post Office: Agunshi; Police Station: Bagnan;\nDistrict: Howrah', 'hospitaladmin@apmeq.com', '12345678', 1),
(16, 'Mr. Department Doctor', 3, 2, '9876543211', '', 'department_doctor@apmeq.com', '2024-08-28', 'Village: Bhuarah; Post Office: Agunshi; Police Station: Bagnan;\nDistrict: Howrah', 'department_doctor@apmeq.com', '12345678', 1),
(17, 'Mr. Calibration service provider', 4, 2, '9876543212', '', 'calibration_ap@apmeq.com', '2024-08-28', 'Village: Bhuarah; Post Office: Agunshi; Police Station: Bagnan;\nDistrict: Howrah', 'calibration_ap@apmeq.com', '12345678', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `user_type_id` int(11) NOT NULL,
  `user_type_name` varchar(255) NOT NULL,
  `user_type_code` varchar(255) NOT NULL,
  `user_type_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_type_id`, `user_type_name`, `user_type_code`, `user_type_status`) VALUES
(1, 'Super Admin', 'super', 1),
(2, 'Hospital Admin', 'h_admin', 1),
(3, 'Department Doctor', 'dep_doc', 1),
(4, 'Calibration service provider', 'cal_sp', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asset_details`
--
ALTER TABLE `asset_details`
  ADD PRIMARY KEY (`asset_id`);

--
-- Indexes for table `asset_type_list`
--
ALTER TABLE `asset_type_list`
  ADD PRIMARY KEY (`asset_type_id`);

--
-- Indexes for table `category_list`
--
ALTER TABLE `category_list`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `department_list`
--
ALTER TABLE `department_list`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `facility_master`
--
ALTER TABLE `facility_master`
  ADD PRIMARY KEY (`facility_id`);

--
-- Indexes for table `hospital_list`
--
ALTER TABLE `hospital_list`
  ADD PRIMARY KEY (`hospital_id`);

--
-- Indexes for table `manufacturer_list`
--
ALTER TABLE `manufacturer_list`
  ADD PRIMARY KEY (`manufacturer_id`);

--
-- Indexes for table `service_providers_list`
--
ALTER TABLE `service_providers_list`
  ADD PRIMARY KEY (`service_providers_id`);

--
-- Indexes for table `supplier_list`
--
ALTER TABLE `supplier_list`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`user_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asset_details`
--
ALTER TABLE `asset_details`
  MODIFY `asset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `asset_type_list`
--
ALTER TABLE `asset_type_list`
  MODIFY `asset_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category_list`
--
ALTER TABLE `category_list`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `department_list`
--
ALTER TABLE `department_list`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `facility_master`
--
ALTER TABLE `facility_master`
  MODIFY `facility_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hospital_list`
--
ALTER TABLE `hospital_list`
  MODIFY `hospital_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `manufacturer_list`
--
ALTER TABLE `manufacturer_list`
  MODIFY `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `service_providers_list`
--
ALTER TABLE `service_providers_list`
  MODIFY `service_providers_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier_list`
--
ALTER TABLE `supplier_list`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
