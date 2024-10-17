-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 17, 2024 at 09:23 AM
-- Server version: 8.0.40
-- PHP Version: 8.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apmeqcom_apmeq`
--

-- --------------------------------------------------------

--
-- Table structure for table `asset_details`
--

CREATE TABLE `asset_details` (
  `asset_id` int NOT NULL,
  `facility_id` int NOT NULL COMMENT 'PK of facility_master',
  `department_id` text COLLATE utf8mb4_general_ci NOT NULL COMMENT 'PK of department_list',
  `equipment_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `asset_make` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `asset_model` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `slerial_number` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `asset_specifiaction` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date_of_installation` date NOT NULL,
  `ins_certificate` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `asset_supplied_by` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `value_of_the_asset` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `total_year_in_service` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `technology` tinyint(1) NOT NULL,
  `asset_status` tinyint(1) NOT NULL,
  `asset_class` tinyint(1) NOT NULL,
  `device_group` tinyint(1) NOT NULL,
  `last_date_of_calibration` date NOT NULL,
  `calibration_attachment` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `frequency_of_calibration` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `last_date_of_pms` date NOT NULL,
  `pms_attachment` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `frequency_of_pms` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `qa_due_date` date NOT NULL,
  `qa_attachment` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `warranty_last_date` date NOT NULL,
  `amc_yes_no` tinyint(1) NOT NULL,
  `amc_last_date` date NOT NULL,
  `cmc_yes_no` tinyint(1) NOT NULL,
  `cmc_last_date` date NOT NULL,
  `asset_code` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `sp_details` text COLLATE utf8mb4_general_ci NOT NULL,
  `row_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset_details`
--

INSERT INTO `asset_details` (`asset_id`, `facility_id`, `department_id`, `equipment_name`, `asset_make`, `asset_model`, `slerial_number`, `asset_specifiaction`, `date_of_installation`, `ins_certificate`, `asset_supplied_by`, `value_of_the_asset`, `total_year_in_service`, `technology`, `asset_status`, `asset_class`, `device_group`, `last_date_of_calibration`, `calibration_attachment`, `frequency_of_calibration`, `last_date_of_pms`, `pms_attachment`, `frequency_of_pms`, `qa_due_date`, `qa_attachment`, `warranty_last_date`, `amc_yes_no`, `amc_last_date`, `cmc_yes_no`, `cmc_last_date`, `asset_code`, `sp_details`, `row_status`) VALUES
(1, 2, '[\"1\"]', 'Autoclave', 'NAT Steel', 'ghhg', '1246598', 'NA', '2023-01-01', '', 'NAT steel', '450000', '+1 years 8 months', 2, 1, 2, 9, '2023-02-02', '', '1||', '2024-08-15', '', '|4|', '0000-00-00', '', '2024-07-10', 2, '0000-00-00', 1, '2024-11-21', '000200001', '8910420169', 1),
(2, 1, '[\"1\"]', 'Radiant Warmer', 'Phoenix Medical', 'NW101', '1', '', '2024-01-01', '', 'ABC Limited', '40000', '+0 years 8 months', 2, 1, 1, 10, '2024-06-01', '', '1|0|0', '2024-08-20', '', '0|3|0', '2025-06-01', '', '2026-01-01', 2, '0000-00-00', 2, '0000-00-00', '000100002', 'ABC Limited', 1),
(3, 1, '[\"1\"]', 'Radiant Warmer', 'Phoenix Medical', 'NW101', '2', '', '0000-00-00', '', 'ABC Limited', '40000', '-0 years 0 months', 2, 1, 1, 10, '0000-00-00', '', '1|0|0', '2024-08-20', '', '|3|', '2025-01-01', '', '2026-01-01', 0, '0000-00-00', 2, '0000-00-00', '000100003', 'ABC Limited', 1),
(4, 1, '[\"1\"]', 'Radiant Warmer', 'Phoenix Medical', 'NW101', '3', '', '2024-01-01', '', 'ABC Limited', '40000', '+0 years 8 months', 2, 1, 1, 10, '0000-00-00', '', '1||', '2024-08-20', '', '|6|', '2025-06-20', '', '2026-01-01', 2, '0000-00-00', 2, '0000-00-00', '000200004', 'ABC Limited', 1),
(5, 1, '[\"5\"]', 'USG', 'GE', 'Alpha', 'DF3508', '', '2013-09-05', '', 'GE', '500000', '+11 years 0 months', 2, 1, 2, 1, '2024-08-01', '', '1||', '2024-09-04', '', '|6|', '0000-00-00', '', '2014-09-28', 2, '0000-00-00', 1, '2024-11-02', '000100005', '8910420169', 1),
(6, 4, '[\"5\"]', 'ECG', 'BPL', 'Caridiart 08T', 'CARD123456', 'NA', '2024-01-01', '', 'Electro care service pvt ltd', '65000', '+0 years 8 months', 2, 1, 2, 4, '2024-08-01', '', '1||', '2024-09-02', '', '|6|', '0000-00-00', '', '2025-02-01', 2, '0000-00-00', 2, '0000-00-00', '000400006', '8910420169', 1),
(7, 4, '[\"1\"]', 'Baby Incubator ', 'Nice neo tech', 'Incubator T6', 'Incub12345678', 'With photo therapy ', '2023-09-20', '', 'Eastern meditech ', '100000', '+1 years 0 months', 2, 1, 1, 0, '2024-08-01', '', '1||', '0000-00-00', '', '', '0000-00-00', '', '2024-09-23', 0, '0000-00-00', 0, '0000-00-00', '000400007', '8910420169', 1),
(8, 4, '[\"5\"]', 'Otoscope ', 'Hein', 'Oto34', '34561234', 'Manual', '2020-09-29', '', 'Eastern meditech ', '45000', '+4 years 0 months', 2, 1, 2, 1, '2024-02-01', '', '|6|', '2024-07-02', '', '|4|', '0000-00-00', '', '0000-00-00', 2, '0000-00-00', 2, '0000-00-00', '000400008', '8910420169', 1),
(9, 2, '[\"1\"]', 'Ventilator ', 'Draegar', 'Babylog ', '3598456', '', '2020-09-29', '', 'Bhogilal India pvt.ltd', '1200000', '+4 years 0 months', 2, 1, 1, 5, '2023-08-01', '', '|4|', '2024-02-06', '', '|4|', '0000-00-00', '', '2021-09-14', 1, '2025-02-06', 0, '0000-00-00', '000200009', '8910420169', 1),
(10, 2, '[\"5\"]', 'ECG', 'BPL', 'Caridiart 08T', 'CARD123457', 'NA', '2022-11-01', '', 'Electro care service pvt ltd', '65000', '+1 years 10 months', 2, 1, 2, 0, '2024-02-01', '', '1||', '0000-00-00', '', '|4|', '0000-00-00', '', '2023-11-30', 2, '0000-00-00', 2, '0000-00-00', '000200010', '8910420169', 1),
(11, 3, '[\"5\"]', 'ECG', 'BPL', 'Caridiart 08T', 'CARD123458', 'NA', '2022-08-01', '', 'Electro care service pvt ltd', '65000', '+2 years 1 months', 2, 1, 2, 0, '2024-01-01', '', '1||', '2024-07-01', '', '1||', '0000-00-00', '', '2023-08-31', 0, '0000-00-00', 1, '2024-06-28', '000300011', '8910420169', 1),
(12, 3, '[\"5\"]', 'ECG', 'BPL', 'Caridiart 01', 'CARD06123', 'NA', '2000-06-28', '', 'Electro care service pvt ltd', '15000', '+24 years 3 months', 1, 2, 2, 0, '0000-00-00', '', '1||', '0000-00-00', '', '1||', '0000-00-00', '', '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', '000300012', '8910420169', 1),
(13, 3, '[\"1\"]', 'Ventilator ', 'Draegar ', 'Babylog', 'Drg123456', 'NA', '2024-03-01', '', 'Eastern meditech ', '800000', '+0 years 6 months', 2, 1, 1, 0, '0000-00-00', '', '1||', '0000-00-00', '', '1||', '0000-00-00', '', '2026-09-29', 0, '0000-00-00', 0, '0000-00-00', '000300013', '8910420169', 1),
(14, 3, '[\"1\"]', 'USG', 'GE', 'Sono View ', '76541234', 'CW, Linear probe, Convex Probe, cardiac probe, and micro convex probe', '2023-10-01', '', 'GE', '2000000', '+0 years 11 months', 2, 1, 2, 1, '0000-00-00', '', '1||', '0000-00-00', '', '1||', '0000-00-00', '', '2024-10-03', 0, '0000-00-00', 0, '0000-00-00', '000300014', '8910420169', 1),
(15, 3, '[\"1\"]', 'Multi Para Monitor', 'Dot medical ', 'Dot MPM', '23457654', '', '2023-03-01', '', 'Eastern meditech ', '45000', '+1 years 6 months', 2, 1, 2, 4, '0000-00-00', '', '1||', '0000-00-00', '', '|4|', '0000-00-00', '', '2024-06-03', 0, '0000-00-00', 0, '0000-00-00', '000300015', '8910420169', 1),
(16, 2, '[\"5\"]', 'ECG', 'BPL', 'Caridiart 08T', 'CARD123459', '', '2022-09-01', '', 'Electro care service pvt ltd', '65000', '+2 years 0 months', 2, 2, 1, 0, '2024-06-01', '', '1||', '2024-07-02', '', '|4|', '0000-00-00', '', '0000-00-00', 0, '0000-00-00', 1, '2024-06-04', '000200016', '8910420169', 1);

-- --------------------------------------------------------

--
-- Table structure for table `asset_reallocate`
--

CREATE TABLE `asset_reallocate` (
  `reallocate_id` int NOT NULL,
  `department_from` int NOT NULL,
  `department_to` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset_type_list`
--

CREATE TABLE `asset_type_list` (
  `asset_type_id` int NOT NULL,
  `asset_type_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `asset_type_code` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `asset_type_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `calib_info`
--

CREATE TABLE `calib_info` (
  `calib_id` int NOT NULL,
  `calib_info_id` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `facility_id` int NOT NULL,
  `facility_code` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `department_id` text COLLATE utf8mb4_general_ci NOT NULL,
  `device_group` tinyint(1) NOT NULL,
  `asset_class` tinyint(1) NOT NULL,
  `equipment_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `equipment_make_model` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `equipment_sl_no` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pms_due_date` date NOT NULL,
  `supplied_by` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `service_provider_details` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pms_planned_date` date NOT NULL,
  `pms_report_attached` text COLLATE utf8mb4_general_ci NOT NULL,
  `link_generated_by` int NOT NULL,
  `link_generate_time` datetime NOT NULL,
  `row_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=pending, 2=done',
  `pms_data_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `calib_info`
--

INSERT INTO `calib_info` (`calib_id`, `calib_info_id`, `facility_id`, `facility_code`, `department_id`, `device_group`, `asset_class`, `equipment_name`, `equipment_make_model`, `equipment_sl_no`, `pms_due_date`, `supplied_by`, `service_provider_details`, `pms_planned_date`, `pms_report_attached`, `link_generated_by`, `link_generate_time`, `row_status`, `pms_data_updated`) VALUES
(1, '0001', 1, '0001', '5', 5, 1, 'Radiant Warmer', '0001', '0001', '2024-10-10', 'SJ', '', '2024-10-10', '[\"6707f48476e63.png\"]', 1, '2024-10-10 20:26:48', 2, '2024-10-10 20:52:22');

-- --------------------------------------------------------

--
-- Table structure for table `call_log_register`
--

CREATE TABLE `call_log_register` (
  `call_log_id` int NOT NULL,
  `token_id` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `facility_id` int NOT NULL,
  `asset_code` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int NOT NULL COMMENT 'PK of user_details',
  `ticket_raiser_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ticket_raiser_contact` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `issue_description` text COLLATE utf8mb4_general_ci NOT NULL,
  `call_log_date_time` datetime NOT NULL,
  `resolved_date_time` datetime NOT NULL,
  `assign_to` tinyint(1) NOT NULL COMMENT '1-Engineer 2=ServiceProvider',
  `eng_contact_no` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `uploaded_report` text COLLATE utf8mb4_general_ci NOT NULL,
  `call_log_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=Raised 1=WIP \r\n 2=Resolved 3=Closed 4=Rejected',
  `ticket_class` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=critical 2=non-critical'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `call_log_register`
--

INSERT INTO `call_log_register` (`call_log_id`, `token_id`, `facility_id`, `asset_code`, `user_id`, `ticket_raiser_name`, `ticket_raiser_contact`, `issue_description`, `call_log_date_time`, `resolved_date_time`, `assign_to`, `eng_contact_no`, `uploaded_report`, `call_log_status`, `ticket_class`) VALUES
(1, '0001', 1, '000100005', 1, 'Mr. Superadmin', '9733935161', ' output is not printing', '2024-10-03 20:38:08', '2024-10-09 10:00:03', 1, '9674614071', '', 1, 1),
(9, '0009', 1, '000100002', 1, 'Mr. Superadmin', '9733935161', 'not working', '2024-10-07 20:56:53', '0000-00-00 00:00:00', 0, '', '', 0, 1),
(10, '0010', 3, '000300013', 1, 'Mr. Superadmin', '9733935161', 'not perfect', '2024-10-07 20:57:40', '0000-00-00 00:00:00', 0, '', '', 0, 0),
(11, '0011', 3, '000300011', 1, 'Mr. Superadmin', '9733935161', 'ecg graph is not printing', '2024-10-07 20:58:35', '0000-00-00 00:00:00', 0, '', '', 0, 0),
(12, '0012', 4, '000400006', 1, 'Mr. Superadmin', '9733935161', 'ECG machine not charging', '2024-10-07 20:59:30', '0000-00-00 00:00:00', 0, '', '', 0, 0),
(13, '0013', 4, '000400008', 1, 'Mr. Superadmin', '9733935161', 'Otoscope not working', '2024-10-07 21:00:03', '0000-00-00 00:00:00', 0, '', '', 0, 0),
(14, '0014', 2, '000200010', 1, 'Mr. Superadmin', '9733935161', 'ecg machine printing double layer', '2024-10-07 21:00:55', '0000-00-00 00:00:00', 0, '', '', 0, 0),
(15, '0015', 2, '000200009', 1, 'Mr. Superadmin', '9733935161', 'Ventilator o2 level is very poor', '2024-10-07 21:17:07', '0000-00-00 00:00:00', 0, '', '', 0, 0),
(16, '0016', 2, '000200010', 1, 'Mr. Superadmin', '9733935161', 'bad condition', '2024-10-07 21:18:53', '0000-00-00 00:00:00', 0, '', '', 0, 0),
(17, '0017', 1, '000100002', 1, 'Mr. Superadmin', '9733935161', 'Heater is not working ', '2024-10-11 17:27:31', '0000-00-00 00:00:00', 0, '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `category_list`
--

CREATE TABLE `category_list` (
  `category_id` int NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `category_slug` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `activity_status` varchar(10) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department_list`
--

CREATE TABLE `department_list` (
  `department_id` int NOT NULL,
  `department_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `department_code` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `department_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department_list`
--

INSERT INTO `department_list` (`department_id`, `department_name`, `department_code`, `department_status`) VALUES
(1, 'SNCU', 'SNCU', 1),
(3, 'CCU', 'CCU', 1),
(4, 'Neonatal Care Unit', 'NICU', 1),
(5, 'OPD', 'OPD', 1);

-- --------------------------------------------------------

--
-- Table structure for table `device_group_list`
--

CREATE TABLE `device_group_list` (
  `device_group_id` int NOT NULL,
  `device_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `device_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `device_group_list`
--

INSERT INTO `device_group_list` (`device_group_id`, `device_name`, `device_status`) VALUES
(1, 'Scanner', 1),
(2, 'In vitro Diagnostics', 1),
(3, 'Radiology', 1),
(4, 'Monitors', 1),
(5, 'Crtitical Care', 1),
(6, 'Opthalmology', 1),
(7, 'Surgical', 1),
(8, 'Drug Delivery', 1),
(9, 'Sterilization', 1),
(10, 'Neonatal & Pediatric', 1);

-- --------------------------------------------------------

--
-- Table structure for table `facility_master`
--

CREATE TABLE `facility_master` (
  `facility_id` int NOT NULL,
  `hospital_id` int NOT NULL COMMENT 'PK of hospital_list',
  `department_id` text COLLATE utf8mb4_general_ci NOT NULL COMMENT 'PK of department_list',
  `facility_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `facility_type` tinyint(1) NOT NULL,
  `facility_code` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `facility_address` text COLLATE utf8mb4_general_ci NOT NULL,
  `nabh_accrediated` tinyint(1) NOT NULL,
  `nabl_accrediated` tinyint(1) NOT NULL,
  `contact_person` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int NOT NULL COMMENT 'PK of user_details'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facility_master`
--

INSERT INTO `facility_master` (`facility_id`, `hospital_id`, `department_id`, `facility_name`, `facility_type`, `facility_code`, `facility_address`, `nabh_accrediated`, `nabl_accrediated`, `contact_person`, `user_id`) VALUES
(1, 2, '[\"5\",\"1\"]', 'Hospital 1', 1, '0001', 'Kolkata, 7123456', 1, 2, '+91 78901 32902', 1),
(2, 2, '[\"5\",\"1\"]', 'Hospital 2', 1, '0002', 'Kolkata, 711340', 1, 2, '+91 78901 32902', 1),
(3, 0, '[\"5\",\"1\"]', 'Hospital 3', 1, '0003', 'Howrah', 2, 2, '+91 78901 32902', 1),
(4, 0, '[\"5\",\"1\"]', 'Hospital 4', 1, '0004', 'Kolkata 45', 1, 1, '+91 78901 32902', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hospital_list`
--

CREATE TABLE `hospital_list` (
  `hospital_id` int NOT NULL,
  `hospital_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `hospital_code` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `hospital_address` text COLLATE utf8mb4_general_ci NOT NULL,
  `hospital_status` tinyint(1) NOT NULL DEFAULT '1'
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
  `manufacturer_id` int NOT NULL,
  `manufacturer_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `manufacturer_code` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `primary_contact_number` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `secondary_contact_number` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `manufacturer_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pms_info`
--

CREATE TABLE `pms_info` (
  `pms_id` int NOT NULL,
  `pms_info_id` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `facility_id` int NOT NULL,
  `facility_code` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `department_id` text COLLATE utf8mb4_general_ci NOT NULL,
  `device_group` tinyint(1) NOT NULL,
  `asset_class` tinyint(1) NOT NULL,
  `equipment_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `equipment_make_model` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `equipment_sl_no` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pms_due_date` date NOT NULL,
  `supplied_by` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `service_provider_details` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pms_planned_date` date NOT NULL,
  `pms_report_attached` text COLLATE utf8mb4_general_ci NOT NULL,
  `link_generated_by` int NOT NULL,
  `link_generate_time` datetime NOT NULL,
  `row_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=pending, 2=done',
  `pms_data_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pms_info`
--

INSERT INTO `pms_info` (`pms_id`, `pms_info_id`, `facility_id`, `facility_code`, `department_id`, `device_group`, `asset_class`, `equipment_name`, `equipment_make_model`, `equipment_sl_no`, `pms_due_date`, `supplied_by`, `service_provider_details`, `pms_planned_date`, `pms_report_attached`, `link_generated_by`, `link_generate_time`, `row_status`, `pms_data_updated`) VALUES
(1, '0001', 1, '0001', '5', 5, 1, 'Radiant Warmer', '0001', '0001', '2024-10-02', 'SJ', 'Kolkata, 7123456', '2024-10-02', '[\"66fd4f1eaa0d1.png\",\"66fd4f1ed8f00.jpg\"]', 1, '2024-10-02 19:15:52', 2, '2024-10-02 19:18:18'),
(2, '0002', 0, '', '', 0, 0, '', '', '', '0000-00-00', '', '', '0000-00-00', '', 1, '2024-10-05 09:32:31', 1, '0000-00-00 00:00:00'),
(3, '0003', 1, '0001', '5', 5, 1, 'Radiant Warmer', '0001', '0001', '2024-10-10', 'SJ', '', '2024-10-10', '', 1, '2024-10-10 08:16:34', 2, '2024-10-10 08:36:45');

-- --------------------------------------------------------

--
-- Table structure for table `qa_info`
--

CREATE TABLE `qa_info` (
  `qa_id` int NOT NULL,
  `qa_info_id` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `facility_id` int NOT NULL,
  `facility_code` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `department_id` text COLLATE utf8mb4_general_ci NOT NULL,
  `device_group` tinyint(1) NOT NULL,
  `asset_class` tinyint(1) NOT NULL,
  `equipment_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `equipment_make_model` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `equipment_sl_no` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pms_due_date` date NOT NULL,
  `supplied_by` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `service_provider_details` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pms_planned_date` date NOT NULL,
  `pms_report_attached` text COLLATE utf8mb4_general_ci NOT NULL,
  `link_generated_by` int NOT NULL,
  `link_generate_time` datetime NOT NULL,
  `row_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=pending, 2=done',
  `pms_data_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `qa_info`
--

INSERT INTO `qa_info` (`qa_id`, `qa_info_id`, `facility_id`, `facility_code`, `department_id`, `device_group`, `asset_class`, `equipment_name`, `equipment_make_model`, `equipment_sl_no`, `pms_due_date`, `supplied_by`, `service_provider_details`, `pms_planned_date`, `pms_report_attached`, `link_generated_by`, `link_generate_time`, `row_status`, `pms_data_updated`) VALUES
(1, '0001', 1, '0001', '5', 5, 1, 'Radiant Warmer', '0001', '0001', '2024-10-10', 'SJ', 'ok', '2024-10-10', '[\"670809773e9f1.png\"]', 1, '2024-10-10 22:34:39', 2, '2024-10-10 22:35:02');

-- --------------------------------------------------------

--
-- Table structure for table `rber_info`
--

CREATE TABLE `rber_info` (
  `rber_id` int NOT NULL,
  `rber_info_id` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `facility_id` int NOT NULL,
  `facility_code` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `department_id` text COLLATE utf8mb4_general_ci NOT NULL,
  `device_group` tinyint(1) NOT NULL,
  `asset_class` tinyint(1) NOT NULL,
  `equipment_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `equipment_make_model` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `equipment_sl_no` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pms_due_date` date NOT NULL,
  `supplied_by` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `service_provider_details` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pms_planned_date` date NOT NULL,
  `pms_report_attached` text COLLATE utf8mb4_general_ci NOT NULL,
  `link_generated_by` int NOT NULL,
  `link_generate_time` datetime NOT NULL,
  `row_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=pending, 2=done',
  `pms_data_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rber_info`
--

INSERT INTO `rber_info` (`rber_id`, `rber_info_id`, `facility_id`, `facility_code`, `department_id`, `device_group`, `asset_class`, `equipment_name`, `equipment_make_model`, `equipment_sl_no`, `pms_due_date`, `supplied_by`, `service_provider_details`, `pms_planned_date`, `pms_report_attached`, `link_generated_by`, `link_generate_time`, `row_status`, `pms_data_updated`) VALUES
(1, '0001', 4, '0001', '5', 5, 1, 'Radiant Warmer', '0001', '0001', '0000-00-00', 'SJ', '', '0000-00-00', '[\"670e7e4a91015.jpg\"]', 1, '2024-10-15 20:07:35', 2, '2024-10-15 20:07:52');

-- --------------------------------------------------------

--
-- Table structure for table `reloc_asset_detail`
--

CREATE TABLE `reloc_asset_detail` (
  `reloc_id` int NOT NULL,
  `facility_id` int NOT NULL COMMENT 'PK of facility_master',
  `from_dept_id` varchar(10) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'PK of department_list',
  `to_dept_id` varchar(10) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'PK of department_list',
  `asset_id` int NOT NULL COMMENT 'PK of asset_details',
  `relocate_date_time` datetime NOT NULL,
  `relocated_by` int NOT NULL COMMENT 'PK of user_details'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reloc_asset_detail`
--

INSERT INTO `reloc_asset_detail` (`reloc_id`, `facility_id`, `from_dept_id`, `to_dept_id`, `asset_id`, `relocate_date_time`, `relocated_by`) VALUES
(1, 1, '5', '1', 2, '2024-10-17 09:22:16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `service_providers_list`
--

CREATE TABLE `service_providers_list` (
  `service_providers_id` int NOT NULL,
  `service_providers_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `service_providers_code` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `primary_contact_number` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `secondary_contact_number` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `service_providers_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_list`
--

CREATE TABLE `supplier_list` (
  `supplier_id` int NOT NULL,
  `supplier_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `supplier_code` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `primary_contact_number` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `secondary_contact_number` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `supplier_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` int NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_type_id` int NOT NULL COMMENT 'PK of user_type',
  `hospital_id` int NOT NULL COMMENT 'PK of hospital_list',
  `user_mobile` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `user_phone` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_dob` date NOT NULL,
  `user_address` text COLLATE utf8mb4_general_ci NOT NULL,
  `user_user_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `user_name`, `user_type_id`, `hospital_id`, `user_mobile`, `user_phone`, `user_email`, `user_dob`, `user_address`, `user_user_name`, `user_password`, `user_status`) VALUES
(1, 'Mr. Superadmin', 1, 2, '9733935161', '256789', 'superadmin@apmeq.com', '1987-10-01', 'Bagnan', 'superadmin@apmeq.com', '12345678', 1),
(15, 'Mr. Hospital Admin', 2, 2, '9876543210', '', 'hospitaladmin@apmeq.com', '2024-08-28', 'Village: Bhuarah; Post Office: Agunshi; Police Station: Bagnan;\nDistrict: Howrah', 'hospitaladmin@apmeq.com', '12345678', 1),
(16, 'Mr. Department Doctor', 3, 2, '9876543211', '', 'department_doctor@apmeq.com', '2024-08-28', 'Village: Bhuarah; Post Office: Agunshi; Police Station: Bagnan;\nDistrict: Howrah', 'department_doctor@apmeq.com', '12345678', 1),
(17, 'Mr. Calibration service provider', 4, 2, '9876543212', '', 'calibration_ap@apmeq.com', '2024-08-28', 'Village: Bhuarah; Post Office: Agunshi; Police Station: Bagnan;\nDistrict: Howrah', 'calibration_ap@apmeq.com', '12345678', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `user_type_id` int NOT NULL,
  `user_type_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_type_code` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_type_status` tinyint(1) NOT NULL DEFAULT '1'
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
-- Indexes for table `calib_info`
--
ALTER TABLE `calib_info`
  ADD PRIMARY KEY (`calib_id`);

--
-- Indexes for table `call_log_register`
--
ALTER TABLE `call_log_register`
  ADD PRIMARY KEY (`call_log_id`);

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
-- Indexes for table `device_group_list`
--
ALTER TABLE `device_group_list`
  ADD PRIMARY KEY (`device_group_id`);

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
-- Indexes for table `pms_info`
--
ALTER TABLE `pms_info`
  ADD PRIMARY KEY (`pms_id`);

--
-- Indexes for table `qa_info`
--
ALTER TABLE `qa_info`
  ADD PRIMARY KEY (`qa_id`);

--
-- Indexes for table `rber_info`
--
ALTER TABLE `rber_info`
  ADD PRIMARY KEY (`rber_id`);

--
-- Indexes for table `reloc_asset_detail`
--
ALTER TABLE `reloc_asset_detail`
  ADD PRIMARY KEY (`reloc_id`);

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
  MODIFY `asset_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `asset_type_list`
--
ALTER TABLE `asset_type_list`
  MODIFY `asset_type_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `calib_info`
--
ALTER TABLE `calib_info`
  MODIFY `calib_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `call_log_register`
--
ALTER TABLE `call_log_register`
  MODIFY `call_log_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `category_list`
--
ALTER TABLE `category_list`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `department_list`
--
ALTER TABLE `department_list`
  MODIFY `department_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `device_group_list`
--
ALTER TABLE `device_group_list`
  MODIFY `device_group_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `facility_master`
--
ALTER TABLE `facility_master`
  MODIFY `facility_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hospital_list`
--
ALTER TABLE `hospital_list`
  MODIFY `hospital_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `manufacturer_list`
--
ALTER TABLE `manufacturer_list`
  MODIFY `manufacturer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pms_info`
--
ALTER TABLE `pms_info`
  MODIFY `pms_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `qa_info`
--
ALTER TABLE `qa_info`
  MODIFY `qa_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rber_info`
--
ALTER TABLE `rber_info`
  MODIFY `rber_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reloc_asset_detail`
--
ALTER TABLE `reloc_asset_detail`
  MODIFY `reloc_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `service_providers_list`
--
ALTER TABLE `service_providers_list`
  MODIFY `service_providers_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier_list`
--
ALTER TABLE `supplier_list`
  MODIFY `supplier_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `user_type_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
