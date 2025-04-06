-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2025 at 06:42 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
  `asset_id` int(11) NOT NULL,
  `facility_id` int(11) NOT NULL COMMENT 'PK of facility_master',
  `department_id` text NOT NULL COMMENT 'PK of department_list',
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
  `last_date_of_calibration` date NOT NULL DEFAULT current_timestamp(),
  `calibration_attachment` varchar(255) NOT NULL,
  `frequency_of_calibration` varchar(255) NOT NULL,
  `last_date_of_pms` date NOT NULL DEFAULT current_timestamp(),
  `pms_attachment` varchar(255) NOT NULL,
  `frequency_of_pms` varchar(255) NOT NULL,
  `qa_due_date` date NOT NULL DEFAULT current_timestamp(),
  `frequency_of_qa` varchar(255) NOT NULL,
  `qa_attachment` varchar(255) NOT NULL,
  `warranty_last_date` date NOT NULL,
  `amc_yes_no` tinyint(1) NOT NULL,
  `amc_last_date` date NOT NULL DEFAULT current_timestamp(),
  `cmc_yes_no` tinyint(1) NOT NULL,
  `cmc_last_date` date NOT NULL DEFAULT current_timestamp(),
  `asset_code` varchar(10) NOT NULL,
  `sp_details` text NOT NULL,
  `reloc_initiated` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=No, 1=Yes',
  `row_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset_details`
--

INSERT INTO `asset_details` (`asset_id`, `facility_id`, `department_id`, `equipment_name`, `asset_make`, `asset_model`, `slerial_number`, `asset_specifiaction`, `date_of_installation`, `ins_certificate`, `asset_supplied_by`, `value_of_the_asset`, `total_year_in_service`, `technology`, `asset_status`, `asset_class`, `device_group`, `last_date_of_calibration`, `calibration_attachment`, `frequency_of_calibration`, `last_date_of_pms`, `pms_attachment`, `frequency_of_pms`, `qa_due_date`, `frequency_of_qa`, `qa_attachment`, `warranty_last_date`, `amc_yes_no`, `amc_last_date`, `cmc_yes_no`, `cmc_last_date`, `asset_code`, `sp_details`, `reloc_initiated`, `row_status`) VALUES
(14, 3, '[\"1\"]', 'USG', 'GE', 'Sono View ', '76541234', 'CW, Linear probe, Convex Probe, cardiac probe, and micro convex probe', '2023-10-01', '', 'GE', '2000000', '+1 years 5 months', 2, 1, 2, 1, '2025-01-01', '', '1||', '0000-00-00', '', '1||', '2025-02-01', '', '', '2024-10-03', 0, '2025-01-01', 0, '2025-01-01', '000300014', '8910420169', 1, 1),
(24, 7, '[\"6\"]', 'Surgical Diathermy', 'Earbe', 'Earbedia', 'DiaT123456', '', '2025-03-01', '', '', '', '+0 years 0 months', 2, 1, 1, 7, '2025-03-01', '', '1||', '0000-00-00', '', '|6|', '2025-02-01', '', '', '2027-02-28', 2, '2025-01-01', 2, '2025-01-01', '000700024', '', 0, 1),
(25, 7, '[\"3\"]', 'Multichannel Monitor', 'Philips', 'MX450', '', '', '2024-02-25', '', 'Marc Medical', '', '+1 years 0 months', 2, 1, 1, 4, '2024-02-28', '', '1|0|0', '2024-02-28', '', '|11|0', '2025-02-01', '', '', '2025-03-20', 0, '2025-01-01', 0, '2025-01-01', '000700025', '', 1, 1),
(28, 1, '[\"5\"]', 'ECG', 'BPL', 'BPL ECG', 'BPL123456', '', '2024-01-01', '', 'BPL', '80000', '+1 years 2 months', 2, 1, 2, 4, '2024-12-01', '', '|6|', '2025-03-29', '', '|3|', '2025-02-01', '', '', '2025-01-02', 0, '2025-01-01', 0, '2025-01-01', '000100028', '8910420169', 1, 1),
(29, 1, '[\"1\"]', 'Incubator', 'Phoneix', 'Incub', 'Phn123456', '', '2025-01-01', '', 'eastermedutech', '75000', '+0 years 3 months', 2, 1, 1, 5, '2025-01-01', '', '|2|', '2025-04-03', '', '|1|', '2025-02-01', '', '', '2025-12-31', 1, '2025-01-01', 1, '2025-01-01', '000100029', '8910420169', 1, 1),
(30, 8, '[\"5\"]', 'Multipara monitor', 'BPL', 'MPM', 'MPM123456', '', '2024-03-19', '', 'BPL', '86000', '+1 years 0 months', 2, 1, 2, 4, '2025-04-03', '', '|6|', '2024-11-19', '', '|3|', '2025-02-01', '', '', '2025-03-19', 0, '2025-01-01', 0, '2025-01-01', '000800030', '8910420169', 1, 1),
(31, 8, '[\"3\"]', 'Difbrilator', 'Philips', 'Difibmax', 'Difib12456', '', '2023-12-06', '', 'Philips', '200000', '+1 years 3 months', 2, 1, 1, 5, '2023-12-20', '[]', '1|1|1', '2025-04-03', '[]', '1|1|20', '2025-04-03', '|2|', '[]', '2024-12-12', 2, '2025-01-01', 2, '2025-01-01', '000800031', '8910420169', 1, 1),
(34, 1, '[\"5\"]', 'Radiant Warmer 2025', 'NAT Steel', 'Difibmax', 'Phn123456', 'NA', '2025-04-05', '', 'NAT steel', '450000', '+0 years 0 months', 2, 1, 2, 5, '2025-04-05', '', '1||', '2025-04-05', '', '1||', '2025-04-05', '1||', '', '2026-02-05', 0, '0000-00-00', 0, '0000-00-00', '000100034', 'ok', 1, 1);

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
-- Table structure for table `asset_status_code`
--

CREATE TABLE `asset_status_code` (
  `id` int(11) NOT NULL,
  `as_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset_status_code`
--

INSERT INTO `asset_status_code` (`id`, `as_name`) VALUES
(1, 'Working'),
(2, 'Not Working'),
(3, 'Not in Use'),
(4, 'Packed'),
(5, 'RBER'),
(6, 'Verified Assets'),
(7, 'Non-Verified Assets');

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
-- Table structure for table `calib_info`
--

CREATE TABLE `calib_info` (
  `calib_id` int(11) NOT NULL,
  `calib_info_id` varchar(10) NOT NULL,
  `asset_id` int(11) NOT NULL COMMENT 'PK of asset_details',
  `asset_code` varchar(255) NOT NULL,
  `facility_id` int(11) NOT NULL,
  `facility_code` varchar(255) NOT NULL,
  `department_id` text NOT NULL,
  `device_group` tinyint(1) NOT NULL,
  `asset_class` tinyint(1) NOT NULL,
  `equipment_name` varchar(255) NOT NULL,
  `equipment_make` varchar(255) NOT NULL,
  `equipment_model` varchar(255) NOT NULL,
  `equipment_sl_no` varchar(255) NOT NULL,
  `pms_due_date` date NOT NULL,
  `supplied_by` varchar(255) NOT NULL,
  `sp_details` text NOT NULL,
  `service_provider_details` varchar(255) NOT NULL,
  `pms_planned_date` date NOT NULL,
  `pms_report_attached` text NOT NULL,
  `link_generated_by` int(11) NOT NULL,
  `link_generate_time` datetime NOT NULL,
  `row_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=pending, 2=done',
  `pms_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=wip 1=resolved 2=closed',
  `pms_sp_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '	0=WIP, 1=Completed',
  `assign_to_sp_engg` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=SP,2=Engg',
  `pms_data_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `calib_info`
--

INSERT INTO `calib_info` (`calib_id`, `calib_info_id`, `asset_id`, `asset_code`, `facility_id`, `facility_code`, `department_id`, `device_group`, `asset_class`, `equipment_name`, `equipment_make`, `equipment_model`, `equipment_sl_no`, `pms_due_date`, `supplied_by`, `sp_details`, `service_provider_details`, `pms_planned_date`, `pms_report_attached`, `link_generated_by`, `link_generate_time`, `row_status`, `pms_status`, `pms_sp_status`, `assign_to_sp_engg`, `pms_data_updated`) VALUES
(1, '0001', 29, '000100029', 1, '0001', '1', 5, 1, 'Incubator', 'Phoneix', 'Incub', 'Phn123456', '2025-03-01', 'eastermedutech', '8910420169', 'calibration process initiated', '2025-03-31', '[\"67ea11dd5f6f2.png\",\"67ea11dd77f38.png\",\"67ea11dd941d3.png\"]', 1, '2025-03-31 08:53:03', 2, 1, 0, 1, '2025-03-31 09:14:18'),
(2, '0002', 30, '000800030', 8, '0008', '5', 4, 2, 'Multipara monitor', 'BPL', 'MPM', 'MPM123456', '2025-02-26', 'BPL', '8910420169', 'calib done\ncalibration completed', '2025-04-03', '', 1, '2025-04-03 09:53:18', 2, 1, 1, 0, '2025-04-03 09:58:12');

-- --------------------------------------------------------

--
-- Table structure for table `call_log_register`
--

CREATE TABLE `call_log_register` (
  `call_log_id` int(11) NOT NULL,
  `token_id` varchar(10) NOT NULL,
  `facility_id` int(11) NOT NULL,
  `asset_code` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'PK of user_details',
  `ticket_raiser_name` varchar(255) NOT NULL,
  `ticket_raiser_contact` varchar(10) NOT NULL,
  `issue_description` text NOT NULL,
  `call_log_date_time` datetime NOT NULL,
  `resolved_date_time` datetime NOT NULL,
  `assign_to` tinyint(1) NOT NULL COMMENT '1-Engineer 2=ServiceProvider',
  `eng_contact_no` varchar(10) NOT NULL,
  `uploaded_report` text NOT NULL,
  `engineer_coment` text NOT NULL,
  `call_log_comment` text NOT NULL,
  `call_log_attach` text NOT NULL COMMENT 'image uploaded by soft link',
  `status_by_engg` tinyint(1) NOT NULL COMMENT '0=wip,1=closed,2=rber, 3=Condemed',
  `call_log_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=Raised 1=WIP \r\n 2=Resolved 3=Closed 4=Rejected',
  `ticket_class` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=critical 2=non-critical',
  `amc_yes_no` tinyint(1) NOT NULL COMMENT '0=No, 1=Yes',
  `amc_last_date` date NOT NULL,
  `cmc_yes_no` tinyint(1) NOT NULL COMMENT '0=No, 1=Yes',
  `cmc_last_date` date NOT NULL
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
(3, 'CCU', 'CCU', 1),
(4, 'Neonatal Care Unit', 'NICU', 1),
(5, 'OPD', 'OPD', 1),
(6, 'OT', 'OT', 1);

-- --------------------------------------------------------

--
-- Table structure for table `device_group_list`
--

CREATE TABLE `device_group_list` (
  `device_group_id` int(11) NOT NULL,
  `device_name` varchar(255) NOT NULL,
  `device_status` tinyint(1) NOT NULL DEFAULT 1
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
  `facility_id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL COMMENT 'PK of hospital_list',
  `department_id` text NOT NULL COMMENT 'PK of department_list',
  `facility_name` varchar(255) NOT NULL,
  `facility_type` tinyint(1) NOT NULL,
  `facility_code` varchar(255) NOT NULL,
  `facility_address` text NOT NULL,
  `nabh_accrediated` tinyint(1) NOT NULL,
  `nabl_accrediated` tinyint(1) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'PK of user_details'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facility_master`
--

INSERT INTO `facility_master` (`facility_id`, `hospital_id`, `department_id`, `facility_name`, `facility_type`, `facility_code`, `facility_address`, `nabh_accrediated`, `nabl_accrediated`, `contact_person`, `user_id`) VALUES
(1, 2, '[\"5\",\"1\"]', 'Hospital 1', 1, '0001', 'Kolkata, 7123456', 1, 2, '+91 78901 32902', 1),
(2, 2, '[\"4\",\"5\",\"1\"]', 'Hospital 2', 1, '0002', 'Kolkata, 711340', 1, 2, '+91 78901 32902', 1),
(3, 2, '[\"5\",\"1\"]', 'Hospital 3', 1, '0003', 'Howrah', 2, 2, '+91 78901 32902', 1),
(4, 2, '[\"5\",\"1\"]', 'Hospital 4', 1, '0004', 'Kolkata 45', 1, 1, '+91 78901 32902', 1),
(5, 2, '[\"3\",\"4\"]', 'Jjb', 1, '0005', 'BG street ', 2, 2, '8910420169', 1),
(6, 2, '[\"5\",\"1\"]', 'Surya Hospital', 1, '0006', 'Khandokosh, Burdwan', 2, 2, '7001917240', 1),
(7, 2, '[\"3\",\"4\",\"5\",\"6\",\"1\"]', 'JK HOSPITAL', 1, '0007', 'Pradesh', 1, 2, 'S GHOSH', 1),
(8, 2, '[\"3\",\"5\"]', 'Abcd ', 1, '0008', 'Bankura 722122', 2, 2, '8910420169', 1);

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
(2, 'Bagnan Hospital', 'Bagnan_Hospital', '', 1),
(3, 'Uluberia Hospital', 'Uluberia_Hospital', ' Uluberia', 1),
(4, 'GGG hospital', 'GGG_hospital', 'kolkata', 1),
(5, 'DP hospital', 'H001', ' Bauria, 711310', 1);

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
-- Table structure for table `pms_info`
--

CREATE TABLE `pms_info` (
  `pms_id` int(11) NOT NULL,
  `pms_info_id` varchar(10) NOT NULL,
  `asset_id` int(11) NOT NULL COMMENT 'pk of asset_details',
  `asset_code` varchar(255) NOT NULL,
  `facility_id` int(11) NOT NULL,
  `facility_code` varchar(255) NOT NULL,
  `department_id` text NOT NULL,
  `device_group` tinyint(1) NOT NULL,
  `asset_class` tinyint(1) NOT NULL,
  `equipment_name` varchar(255) NOT NULL,
  `equipment_make` varchar(255) NOT NULL,
  `equipment_model` varchar(255) NOT NULL,
  `equipment_sl_no` varchar(255) NOT NULL,
  `pms_due_date` date NOT NULL,
  `supplied_by` varchar(255) NOT NULL,
  `sp_details` text NOT NULL,
  `service_provider_details` varchar(255) NOT NULL,
  `pms_planned_date` date NOT NULL,
  `pms_report_attached` text NOT NULL,
  `link_generated_by` int(11) NOT NULL,
  `link_generate_time` datetime NOT NULL,
  `row_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=pending, 2=done',
  `pms_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=wip 1=resolved, 2=closed',
  `pms_sp_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=WIP, 1=Completed',
  `assign_to_sp_engg` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=SP,2=Engg',
  `pms_data_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pms_info`
--

INSERT INTO `pms_info` (`pms_id`, `pms_info_id`, `asset_id`, `asset_code`, `facility_id`, `facility_code`, `department_id`, `device_group`, `asset_class`, `equipment_name`, `equipment_make`, `equipment_model`, `equipment_sl_no`, `pms_due_date`, `supplied_by`, `sp_details`, `service_provider_details`, `pms_planned_date`, `pms_report_attached`, `link_generated_by`, `link_generate_time`, `row_status`, `pms_status`, `pms_sp_status`, `assign_to_sp_engg`, `pms_data_updated`) VALUES
(1, '0001', 29, '000100029', 1, '0001', '1', 5, 1, 'Incubator', 'Phoneix', 'Incub', 'Phn123456', '2025-02-01', 'eastermedutech', '8910420169', '', '2025-03-29', '[]', 1, '2025-03-29 18:30:32', 2, 1, 1, 0, '2025-03-29 18:40:57'),
(2, '0002', 28, '000100028', 1, '0001', '5', 4, 2, 'ECG', 'BPL', 'BPL ECG', 'BPL123456', '2025-03-01', 'BPL', '8910420169', 'PMS in progress', '2025-03-29', '', 1, '2025-03-29 18:51:52', 2, 2, 1, 2, '2025-04-03 09:29:08');

-- --------------------------------------------------------

--
-- Table structure for table `qa_info`
--

CREATE TABLE `qa_info` (
  `qa_id` int(11) NOT NULL,
  `qa_info_id` varchar(10) NOT NULL,
  `asset_id` int(11) NOT NULL COMMENT 'pk of asset_details	',
  `asset_code` varchar(255) NOT NULL,
  `facility_id` int(11) NOT NULL,
  `facility_code` varchar(255) NOT NULL,
  `department_id` text NOT NULL,
  `device_group` tinyint(1) NOT NULL,
  `asset_class` tinyint(1) NOT NULL,
  `equipment_name` varchar(255) NOT NULL,
  `equipment_make` varchar(255) NOT NULL,
  `equipment_model` varchar(255) NOT NULL,
  `equipment_sl_no` varchar(255) NOT NULL,
  `pms_due_date` date NOT NULL,
  `supplied_by` varchar(255) NOT NULL,
  `sp_details` text NOT NULL,
  `service_provider_details` varchar(255) NOT NULL,
  `pms_planned_date` date NOT NULL,
  `pms_report_attached` text NOT NULL,
  `link_generated_by` int(11) NOT NULL,
  `link_generate_time` datetime NOT NULL,
  `row_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=pending, 2=done',
  `pms_status` tinyint(1) NOT NULL COMMENT '0=wip 1=resolved, 2=closed',
  `pms_sp_status` tinyint(1) NOT NULL COMMENT '0=WIP, 1=Completed',
  `assign_to_sp_engg` tinyint(1) NOT NULL COMMENT '1=SP,2=Engg',
  `pms_data_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `qa_info`
--

INSERT INTO `qa_info` (`qa_id`, `qa_info_id`, `asset_id`, `asset_code`, `facility_id`, `facility_code`, `department_id`, `device_group`, `asset_class`, `equipment_name`, `equipment_make`, `equipment_model`, `equipment_sl_no`, `pms_due_date`, `supplied_by`, `sp_details`, `service_provider_details`, `pms_planned_date`, `pms_report_attached`, `link_generated_by`, `link_generate_time`, `row_status`, `pms_status`, `pms_sp_status`, `assign_to_sp_engg`, `pms_data_updated`) VALUES
(1, '0001', 31, '000800031', 8, '0008', '3', 5, 1, 'Difbrilator', 'Philips', 'Difibmax', 'Difib12456', '2025-04-01', 'Philips', '8910420169', 'done', '2025-04-03', '', 1, '2025-04-03 09:12:58', 2, 1, 1, 0, '2025-04-03 09:13:10');

-- --------------------------------------------------------

--
-- Table structure for table `rber_info`
--

CREATE TABLE `rber_info` (
  `rber_id` int(11) NOT NULL,
  `rber_info_id` varchar(10) NOT NULL,
  `facility_id` int(11) NOT NULL,
  `facility_code` varchar(255) NOT NULL,
  `department_id` text NOT NULL,
  `device_group` tinyint(1) NOT NULL,
  `asset_class` tinyint(1) NOT NULL,
  `equipment_name` varchar(255) NOT NULL,
  `equipment_make_model` varchar(255) NOT NULL,
  `equipment_sl_no` varchar(255) NOT NULL,
  `pms_due_date` date NOT NULL,
  `supplied_by` varchar(255) NOT NULL,
  `service_provider_details` varchar(255) NOT NULL,
  `pms_planned_date` date NOT NULL,
  `pms_report_attached` text NOT NULL,
  `link_generated_by` int(11) NOT NULL,
  `link_generate_time` datetime NOT NULL,
  `row_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=pending, 2=done',
  `pms_data_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rber_info`
--

INSERT INTO `rber_info` (`rber_id`, `rber_info_id`, `facility_id`, `facility_code`, `department_id`, `device_group`, `asset_class`, `equipment_name`, `equipment_make_model`, `equipment_sl_no`, `pms_due_date`, `supplied_by`, `service_provider_details`, `pms_planned_date`, `pms_report_attached`, `link_generated_by`, `link_generate_time`, `row_status`, `pms_data_updated`) VALUES
(1, '0001', 4, '0001', '5', 5, 1, 'Radiant Warmer', '0001', '0001', '0000-00-00', 'SJ', '', '0000-00-00', '[\"670e7e4a91015.jpg\"]', 1, '2024-10-15 20:07:35', 2, '2024-10-15 20:07:52'),
(2, '0002', 0, '', '', 0, 0, '', '', '', '0000-00-00', '', '', '0000-00-00', '', 1, '2025-03-22 15:19:35', 1, '0000-00-00 00:00:00'),
(3, '0003', 0, '', '', 0, 0, '', '', '', '0000-00-00', '', '', '0000-00-00', '', 1, '2025-04-05 20:34:59', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `reloc_asset_detail`
--

CREATE TABLE `reloc_asset_detail` (
  `reloc_id` int(11) NOT NULL,
  `facility_id` int(11) NOT NULL COMMENT 'PK of facility_master',
  `from_dept_id` varchar(10) NOT NULL COMMENT 'PK of department_list',
  `to_dept_id` varchar(10) NOT NULL COMMENT 'PK of department_list',
  `asset_id` int(11) NOT NULL COMMENT 'PK of asset_details',
  `relocate_date_time` datetime NOT NULL,
  `relocated_by` int(11) NOT NULL COMMENT 'PK of user_details',
  `sent_to_parent_dept` tinyint(1) NOT NULL COMMENT '0=No,1=Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reloc_asset_detail`
--

INSERT INTO `reloc_asset_detail` (`reloc_id`, `facility_id`, `from_dept_id`, `to_dept_id`, `asset_id`, `relocate_date_time`, `relocated_by`, `sent_to_parent_dept`) VALUES
(1, 1, '5', '1', 2, '2025-03-15 19:36:57', 1, 0),
(2, 1, '5', '1', 3, '2025-03-15 19:37:22', 1, 1),
(3, 1, '5', '1', 3, '2025-03-15 19:37:51', 1, 1),
(4, 7, '6', '3', 24, '2025-03-17 15:51:36', 1, 1),
(5, 7, '6', '3', 24, '2025-03-19 12:38:29', 1, 0);

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
  `facility_id` int(11) NOT NULL COMMENT 'PK of facility_master	',
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

INSERT INTO `user_details` (`user_id`, `user_name`, `user_type_id`, `hospital_id`, `facility_id`, `user_mobile`, `user_phone`, `user_email`, `user_dob`, `user_address`, `user_user_name`, `user_password`, `user_status`) VALUES
(1, 'Mr. Superadmin', 1, 2, 1, '9733935161', '256789', 'superadmin@apmeq.com', '1987-10-01', 'Bagnan', 'superadmin@apmeq.com', '12345678', 1),
(15, 'Mr. Hospital Admin', 2, 2, 1, '9876543210', '', 'hospitaladmin@apmeq.com', '2024-08-28', 'Village: Bhuarah; Post Office: Agunshi; Police Station: Bagnan;\nDistrict: Howrah', 'hospitaladmin@apmeq.com', '12345678', 1),
(16, 'Mr. Department Doctor', 3, 2, 1, '9876543211', '', 'department_doctor@apmeq.com', '2024-08-28', 'Village: Bhuarah; Post Office: Agunshi; Police Station: Bagnan;\nDistrict: Howrah', 'department_doctor@apmeq.com', '12345678', 1),
(17, 'Mr. Calibration service provider', 4, 2, 1, '9876543212', '', 'calibration_ap@apmeq.com', '2024-08-28', 'Village: Bhuarah; Post Office: Agunshi; Police Station: Bagnan;\nDistrict: Howrah', 'calibration_ap@apmeq.com', '12345678', 1),
(19, 'Mr. JK Hospital Admin', 2, 2, 7, '9876543210', '', 'jkhospitaladmin@apmeq.com', '2025-03-01', 'Pradesh', 'jkhospitaladmin', 'jkhospital', 1),
(20, 'SK S A', 2, 2, 8, '8910420169', '', 'sksayan2012@gmail.com', '1985-01-16', ' howrah, 711310', 'Abcdapmeq', '711310', 1),
(21, 'A G', 3, 2, 8, '7890132902', '', 'abcd@abcd', '2000-01-19', ' Kolkata', 'AGapmeq', '711310', 1),
(22, 'Doctor', 3, 2, 8, '8910420169', '', 'hijibijia@apmeq.com', '2010-02-28', ' hgsjygftde', 'docabcd', '123456', 1),
(23, 'S A', 3, 2, 8, '12345678', '', 'Ffffff', '2025-03-22', ' Ggggg', 'docabcd1', '123456', 1);

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
-- Indexes for table `asset_status_code`
--
ALTER TABLE `asset_status_code`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `asset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `asset_status_code`
--
ALTER TABLE `asset_status_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `asset_type_list`
--
ALTER TABLE `asset_type_list`
  MODIFY `asset_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `calib_info`
--
ALTER TABLE `calib_info`
  MODIFY `calib_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `call_log_register`
--
ALTER TABLE `call_log_register`
  MODIFY `call_log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category_list`
--
ALTER TABLE `category_list`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `department_list`
--
ALTER TABLE `department_list`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `device_group_list`
--
ALTER TABLE `device_group_list`
  MODIFY `device_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `facility_master`
--
ALTER TABLE `facility_master`
  MODIFY `facility_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hospital_list`
--
ALTER TABLE `hospital_list`
  MODIFY `hospital_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `manufacturer_list`
--
ALTER TABLE `manufacturer_list`
  MODIFY `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pms_info`
--
ALTER TABLE `pms_info`
  MODIFY `pms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `qa_info`
--
ALTER TABLE `qa_info`
  MODIFY `qa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rber_info`
--
ALTER TABLE `rber_info`
  MODIFY `rber_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reloc_asset_detail`
--
ALTER TABLE `reloc_asset_detail`
  MODIFY `reloc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
