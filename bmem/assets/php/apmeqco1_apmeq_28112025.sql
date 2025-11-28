-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 28, 2025 at 08:42 PM
-- Server version: 10.3.39-MariaDB-cll-lve
-- PHP Version: 8.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apmeqco1_apmeq`
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
  `reloc_initiated` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=No, 1=Yes',
  `row_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset_details`
--

INSERT INTO `asset_details` (`asset_id`, `facility_id`, `department_id`, `equipment_name`, `asset_make`, `asset_model`, `slerial_number`, `asset_specifiaction`, `date_of_installation`, `ins_certificate`, `asset_supplied_by`, `value_of_the_asset`, `total_year_in_service`, `technology`, `asset_status`, `asset_class`, `device_group`, `last_date_of_calibration`, `calibration_attachment`, `frequency_of_calibration`, `last_date_of_pms`, `pms_attachment`, `frequency_of_pms`, `qa_due_date`, `frequency_of_qa`, `qa_attachment`, `warranty_last_date`, `amc_yes_no`, `amc_last_date`, `cmc_yes_no`, `cmc_last_date`, `asset_code`, `sp_details`, `reloc_initiated`, `row_status`) VALUES
(1, 1, '[\"3\"]', 'X-ray', 'ME xray', '300mA', '11334', 'N.A.', '2024-01-01', '', 'ME X-ray', '60000', '1 years, 7 months, 26 days', 2, 1, 1, 1, '2024-01-01', '', '0|6|0', '2024-01-01', '', '1||', '2024-01-01', '1||', '', '2025-01-01', 2, '0000-00-00', 2, '0000-00-00', '000100001', '8910420169 .ooooo', 0, 1),
(2, 2, '[\"1\"]', 'ECG', 'BPL', 'Cardiart', '1456', 'NA', '2024-05-20', '', 'BPL', '30000', '1 years, 3 months, 3 days', 2, 1, 2, 1, '2025-08-27', '', '|8|', '2025-01-08', '', '|7|', '0000-00-00', '', '', '2025-05-20', 0, '0000-00-00', 0, '0000-00-00', '000200002', '8910420169 23.37 13.09.25', 0, 1),
(3, 2, '[\"3\"]', 'Mamo graphy', 'Siemens', 'Clarity', 'TA2344', 'NA', '2024-09-01', '', 'Sapoorji', '800000', '0 years, 11 months, 24 days', 2, 1, 1, 1, '2025-08-22', '', '1||', '2025-01-01', '', '1||', '2025-08-21', '1||', '', '2025-09-01', 2, '0000-00-00', 2, '0000-00-00', '000200003', '8910420169', 0, 1),
(4, 2, '[\"2\"]', 'Nebulizer', 'Omron', 'Nebulizer', '5544', 'NA', '2024-12-15', '', 'Eastern Meditech', '5000', '0 years, 8 months, 9 days', 2, 1, 2, 2, '2025-08-21', '', '|6|', '2025-08-21', '', '|6|', '0000-00-00', '', '', '2025-12-15', 0, '0000-00-00', 0, '0000-00-00', '000200004', '8910420169', 0, 1),
(5, 3, '[\"3\"]', 'X-ray', 'PHILIPS', '500mA', '78912', 'NA', '2024-05-20', '', 'Eastern Meditech', '', '1 years, 3 months, 3 days', 2, 1, 1, 1, '2025-08-24', '', '1||', '2025-08-21', '', '|9|', '2025-08-21', '1||', '', '2025-05-20', 1, '2026-06-25', 2, '0000-00-00', '000300005', '8910420169', 0, 1),
(6, 3, '[\"3\"]', 'C-ARM', 'PHILIPS', 'C-ARM', '22222', 'NA', '2025-01-01', '', 'Eastern Meditech', '1500000', '0 years, 7 months, 22 days', 2, 1, 1, 1, '2025-01-01', '', '1||', '2025-01-01', '', '1||', '2025-01-01', '1||', '', '2026-01-01', 2, '0000-00-00', 2, '0000-00-00', '000300006', '8910420169', 0, 1),
(7, 1, '[\"3\"]', 'Radiant Warmer', 'NAT Steel', 'Difibmax', 'Phn123456', 'NA', '2025-01-01', '', 'NAT steel', '450000', '0 years, 7 months, 28 days', 2, 1, 2, 2, '2025-01-01', '', '0|1|0', '2025-01-01', '', '0|1|0', '2025-01-01', '0|1|0', '', '2026-01-01', 1, '2026-01-01', 1, '2026-01-01', '000100007', '8910420169 13.. 23.13', 0, 1),
(8, 1, '[\"1\"]', 'ECG', 'BPL', 'Caridiart 08T', '66553322', 'NA', '2025-09-14', '', 'Electro care service pvt ltd', '65000', '0 years, 0 months, 0 days', 2, 1, 2, 1, '2025-09-14', '', '1||', '2025-09-14', '', '1||', '0000-00-00', '', '', '2026-09-15', 2, '0000-00-00', 2, '0000-00-00', '000100008', '8910420169', 0, 1),
(9, 3, '[\"1\"]', 'ECG', 'GE', 'Alpha', '167773', 'NA', '2025-09-14', '', 'Eastern meditech ', '100000', '0 years, 0 months, 0 days', 2, 1, 2, 1, '2025-09-14', '', '1||', '2025-09-14', '', '1||', '0000-00-00', '', '', '2026-09-15', 2, '0000-00-00', 2, '0000-00-00', '000300009', '8910420169', 0, 1),
(10, 6, '[\"2\"]', 'Dental Chair', 'L&T', 'Dentchair', '1340986', 'NA', '2023-01-25', '[\"68d51064e80ea.jpeg\"]', 'L&T', '200000', '2 years, 8 months, 4 days', 2, 1, 2, 2, '2024-01-25', '', '1||', '2024-01-25', '', '|6|', '0000-00-00', '', '', '2024-01-25', 2, '0000-00-00', 2, '0000-00-00', '000600010', '8910420169', 0, 1),
(11, 6, '[\"3\"]', 'X-Ray', 'Philips', 'Phi-X', '12303', '', '2022-05-29', '', 'Phillips', '8,00,000', '3 years, 4 months, 0 days', 2, 1, 1, 1, '2025-05-29', '', '1||', '2025-08-29', '', '|1|', '2024-05-29', '2||', '', '2025-05-29', 2, '0000-00-00', 2, '0000-00-00', '000600011', '8910181521', 0, 1),
(12, 6, '[\"5\"]', 'OT light', 'philips', 'OT light', '12123344678', 'NA', '2024-06-02', '', 'Electrocare', '300000', '1 years, 3 months, 25 days', 2, 1, 2, 1, '2024-06-02', '', '1||', '2025-09-25', '', '|6|', '0000-00-00', '||', '', '2027-06-02', 2, '0000-00-00', 2, '0000-00-00', '000600012', '8910420169', 0, 1),
(13, 6, '[\"5\"]', 'Nebulizer', 'Resmed', 'Remi-600', '310506', 'NA', '2024-04-01', '', 'RESMED', '2800', '1 years, 5 months, 27 days', 2, 1, 1, 2, '2025-04-01', '', '1||', '2025-06-01', '', '|3|', '0000-00-00', '', '', '2026-04-25', 2, '0000-00-00', 2, '0000-00-00', '000600013', '7439331467', 0, 1);

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
  `pms_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=Due,1=done,2=wip	',
  `pms_sp_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '	0=WIP, 1=Completed',
  `assign_to_sp_engg` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=SP,2=Engg',
  `pms_data_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `calib_info`
--

INSERT INTO `calib_info` (`calib_id`, `calib_info_id`, `asset_id`, `asset_code`, `facility_id`, `facility_code`, `department_id`, `device_group`, `asset_class`, `equipment_name`, `equipment_make`, `equipment_model`, `equipment_sl_no`, `pms_due_date`, `supplied_by`, `sp_details`, `service_provider_details`, `pms_planned_date`, `pms_report_attached`, `link_generated_by`, `link_generate_time`, `row_status`, `pms_status`, `pms_sp_status`, `assign_to_sp_engg`, `pms_data_updated`) VALUES
(1, '0001', 1, '000100001', 1, '0001', '3', 1, 1, 'X-ray', 'ME xray', '300mA', '11334', '2025-01-01', 'ME X-ray', '8910420169', '21.08', '2025-08-21', '[\"68a701dddfd03.png\"]', 1, '2025-08-21 16:40:41', 2, 1, 0, 0, '2025-08-21 16:54:21'),
(2, '0002', 4, '000200004', 2, '0002', '2', 2, 2, 'Nebulizer', 'Omron', 'Nebulizer', '5544', '2025-07-01', 'Eastern Meditech', '8910420169', '21.08', '2025-08-21', '[\"68a7017795c0d.png\"]', 1, '2025-08-21 16:41:11', 2, 1, 0, 0, '2025-08-21 16:52:40'),
(3, '0003', 3, '000200003', 2, '0002', '3', 1, 1, 'Mamo graphy', 'Siemens', 'Clarity', 'TA2344', '2025-09-01', 'Sapoorji', '8910420169', 'Done ', '2025-08-22', '', 1, '2025-08-22 10:04:53', 2, 1, 0, 1, '2025-08-22 10:07:36'),
(4, '0004', 5, '000300005', 3, '0003', '3', 1, 1, 'X-ray', 'PHILIPS', '500mA', '78912', '2025-05-20', 'Eastern Meditech', '8910420169', 'Done 24.08', '2025-08-24', '[\"68ab48835d2b4.jpg\"]', 1, '2025-08-24 22:41:12', 2, 1, 0, 0, '2025-08-24 22:44:56'),
(5, '0005', 7, '000100007', 1, '0001', '3', 2, 2, 'Radiant Warmer', 'NAT Steel', 'Difibmax', 'Phn123456', '2025-02-01', 'NAT steel', '', '', '2025-08-27', '[\"68af2597ed3c3.png\"]', 1, '2025-08-27 21:02:34', 2, 0, 0, 0, '2025-08-27 21:02:34'),
(6, '0006', 2, '000200002', 2, '0002', '1', 1, 2, 'ECG', 'BPL', 'Cardiart', '1456', '2025-09-08', 'BPL', '8910420169', '27', '2025-08-27', '[\"68af32ee6123c.jpg\"]', 1, '2025-08-27 22:00:38', 2, 1, 0, 0, '2025-08-27 22:01:50'),
(7, '0007', 10, '000600010', 6, '0006', '2', 2, 2, 'Dental Chair', 'L&T', 'Dentchair', '1340986', '2025-01-25', 'L&T', '8910420169', '', '2025-09-25', '', 1, '2025-09-25 15:59:48', 2, 0, 0, 0, '2025-09-25 16:00:29');

-- --------------------------------------------------------

--
-- Table structure for table `call_log_register`
--

CREATE TABLE `call_log_register` (
  `call_log_id` int(11) NOT NULL,
  `token_id` varchar(20) NOT NULL,
  `facility_id` int(11) NOT NULL,
  `asset_code` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'PK of user_details',
  `ticket_raiser_name` varchar(255) NOT NULL,
  `ticket_raiser_contact` varchar(10) NOT NULL,
  `issue_description` text NOT NULL,
  `call_log_date_time` datetime NOT NULL,
  `resolved_date_time` datetime NOT NULL,
  `assign_to` tinyint(1) NOT NULL COMMENT '1=ServiceProvider 2=Engineer',
  `eng_contact_no` varchar(10) NOT NULL,
  `uploaded_report` text NOT NULL,
  `engineer_coment` text NOT NULL,
  `call_log_comment` text NOT NULL,
  `call_log_attach` text NOT NULL COMMENT 'image uploaded by soft link',
  `status_by_engg` tinyint(1) NOT NULL COMMENT '0=wip,1=closed,2=rber, 3=Condemed',
  `call_log_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=Raised 1=Reject\r\n 2=Done 3=RBER 4=WIP 5=Condemned',
  `cl_status_history` text NOT NULL,
  `ticket_class` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=critical 2=non-critical',
  `amc_yes_no` tinyint(1) NOT NULL COMMENT '0=No, 1=Yes',
  `amc_last_date` date NOT NULL,
  `cmc_yes_no` tinyint(1) NOT NULL COMMENT '0=No, 1=Yes',
  `cmc_last_date` date NOT NULL,
  `condemned_declare_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `call_log_register`
--

INSERT INTO `call_log_register` (`call_log_id`, `token_id`, `facility_id`, `asset_code`, `user_id`, `ticket_raiser_name`, `ticket_raiser_contact`, `issue_description`, `call_log_date_time`, `resolved_date_time`, `assign_to`, `eng_contact_no`, `uploaded_report`, `engineer_coment`, `call_log_comment`, `call_log_attach`, `status_by_engg`, `call_log_status`, `cl_status_history`, `ticket_class`, `amc_yes_no`, `amc_last_date`, `cmc_yes_no`, `cmc_last_date`, `condemned_declare_date`) VALUES
(2, '0002', 2, '000200002', 1, 'Mr. Superadmin', '9733935161', 'Battery issue', '2025-08-28 23:39:20', '0000-00-00 00:00:00', 2, '', '', 'Not done', 'Done 13.09.25', '[\"68c5b33cf0855.jpg\"]', 0, 0, '[{\"date_time\":\"2025-09-13 23:41:48\",\"date_time_text\":\"13-Sep-2025 11:41 PM\",\"old\":\"1\",\"new\":\"0\"}]', 0, 0, '0000-00-00', 0, '0000-00-00', ''),
(3, '0003', 1, '000100007', 1, 'Mr. Superadmin', '9733935161', 'Heater Issue, Observation light not functional, Timer problem', '2025-08-28 23:15:54', '0000-00-00 00:00:00', 0, '', '[\"68c5ae44539a0.png\"]', 'Heater issues are not resolved ', 'Issue solved ', '[\"68c5adcc77fd1.png\"]', 0, 0, '[{\"date_time\":\"2025-09-14 19:36:26\",\"date_time_text\":\"14-Sep-2025 07:36 PM\",\"old\":\"1\",\"new\":\"1\"}]', 0, 1, '2026-01-01', 1, '2026-01-01', ''),
(4, '0004', 2, '000200003', 1, 'Mr. Superadmin', '9733935161', 'x-ray tube issue', '2025-09-11 16:18:46', '0000-00-00 00:00:00', 0, '', '', '', 'Done', '', 0, 1, '[{\"date_time\":\"2025-09-14 15:18:09\",\"date_time_text\":\"14-Sep-2025 03:18 PM\",\"old\":\"2\",\"new\":\"2\"},{\"date_time\":\"2025-09-14 15:18:20\",\"date_time_text\":\"14-Sep-2025 03:18 PM\",\"old\":\"2\",\"new\":\"1\"},{\"date_time\":\"2025-09-17 16:19:37\",\"date_time_text\":\"17-Sep-2025 04:19 PM\",\"old\":\"3\",\"new\":\"3\"},{\"date_time\":\"2025-09-17 16:20:24\",\"date_time_text\":\"17-Sep-2025 04:20 PM\",\"old\":\"3\",\"new\":\"3\"},{\"date_time\":\"2025-09-18 09:40:47\",\"date_time_text\":\"18-Sep-2025 09:40 AM\",\"old\":\"3\",\"new\":\"5\"},{\"date_time\":\"2025-09-25 14:25:42\",\"date_time_text\":\"25-Sep-2025 02:25 PM\",\"old\":\"5\",\"new\":\"1\"}]', 0, 2, '0000-00-00', 2, '0000-00-00', ''),
(6, '14092025-150957', 1, '000100001', 1, 'Mr. Superadmin', '9733935161', 'mA is not changing ', '2025-09-14 16:50:16', '2025-09-20 17:05:18', 0, '', '[\"68c68e624fa7f.jpg\"]', '', 'Issue resolved ', '[\"68c68e28b36fd.jpg\"]', 0, 2, '[{\"date_time\":\"2025-09-14 15:14:09\",\"date_time_text\":\"14-Sep-2025 03:14 PM\",\"old\":\"2\",\"new\":\"1\"},{\"date_time\":\"2025-09-14 19:35:09\",\"date_time_text\":\"14-Sep-2025 07:35 PM\",\"old\":\"2\",\"new\":\"1\"},{\"date_time\":\"2025-09-18 08:45:22\",\"date_time_text\":\"18-Sep-2025 08:45 AM\",\"old\":\"2\",\"new\":\"2\"},{\"date_time\":\"2025-09-20 17:05:18\",\"date_time_text\":\"20-Sep-2025 05:05 PM\",\"old\":\"2\",\"new\":\"2\"}]', 0, 2, '0000-00-00', 2, '0000-00-00', ''),
(7, '25092025-160939', 6, '000600011', 32, 'Asmita', '8910420169', 'X-Ray light not working ', '2025-09-25 21:25:44', '0000-00-00 00:00:00', 1, '', '', '', 'work in progress', '[\"68d521a2793e7.jpg\"]', 0, 0, '[{\"date_time\":\"2025-09-25 21:25:21\",\"date_time_text\":\"25-Sep-2025 09:25 PM\",\"old\":\"4\",\"new\":\"\"},{\"date_time\":\"2025-09-25 21:25:25\",\"date_time_text\":\"25-Sep-2025 09:25 PM\",\"old\":\"0\",\"new\":\"\"},{\"date_time\":\"2025-09-25 21:25:44\",\"date_time_text\":\"25-Sep-2025 09:25 PM\",\"old\":\"0\",\"new\":\"\"}]', 0, 2, '0000-00-00', 2, '0000-00-00', '');

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
(1, 'OPD', 'OPD', 1),
(2, 'IPD', 'IPD', 1),
(3, 'Radiology', 'Radiology', 1),
(4, 'Pathology', 'Pathology', 1),
(5, 'OT', 'OT', 1),
(6, 'CSSD', 'CSSD', 1);

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
(1, 'Diagnostic', 1),
(2, 'Theraputic', 1);

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
(1, 0, '[\"6\",\"2\",\"1\",\"5\",\"4\",\"3\"]', 'Uluberia Hospital', 1, '0001', 'Uluberia', 1, 1, 'suman jana', 1),
(2, 0, '[\"2\",\"1\"]', 'Hospital 1', 1, '0002', 'Garia, WB', 1, 2, '7890132902', 1),
(3, 0, '[\"6\",\"2\",\"1\",\"5\",\"4\",\"3\"]', 'Hospital 2', 1, '0003', 'Kolkata', 2, 2, '8910420169', 1),
(6, 0, '[\"6\",\"2\",\"1\",\"5\",\"4\",\"3\"]', 'Purulia Hospital', 1, '0006', 'Purulia Hospital, Ranchi Road, near Bus Stand, PIN - 723101', 1, 2, '7278310506', 1);

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
(1, 'Uluberia Hospital', '', '', 1);

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
  `pms_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=Due,1=done,2=wip',
  `pms_sp_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=WIP, 1=Completed',
  `assign_to_sp_engg` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=SP,2=Engg',
  `pms_data_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pms_info`
--

INSERT INTO `pms_info` (`pms_id`, `pms_info_id`, `asset_id`, `asset_code`, `facility_id`, `facility_code`, `department_id`, `device_group`, `asset_class`, `equipment_name`, `equipment_make`, `equipment_model`, `equipment_sl_no`, `pms_due_date`, `supplied_by`, `sp_details`, `service_provider_details`, `pms_planned_date`, `pms_report_attached`, `link_generated_by`, `link_generate_time`, `row_status`, `pms_status`, `pms_sp_status`, `assign_to_sp_engg`, `pms_data_updated`) VALUES
(1, '0001', 1, '000100001', 1, '0001', '3', 1, 1, 'X-ray', 'ME xray', '300mA', '11334', '2025-01-01', 'ME X-ray', '8910420169', '', '2025-08-21', '', 1, '2025-08-21 16:39:22', 2, 0, 0, 1, '2025-08-21 16:39:24'),
(2, '0002', 5, '000300005', 3, '0003', '3', 1, 1, 'X-ray', 'PHILIPS', '500mA', '78912', '2025-08-11', 'Eastern Meditech', '8910420169', 'done 21.08', '2025-08-21', '[\"68a700185d7a9.png\"]', 1, '2025-08-21 16:39:46', 2, 1, 0, 2, '2025-08-21 16:46:42'),
(3, '0003', 4, '000200004', 2, '0002', '2', 2, 2, 'Nebulizer', 'Omron', 'Nebulizer', '5544', '2025-07-01', 'Eastern Meditech', '8910420169', 'done 21.08', '2025-08-21', '[\"68a6ffb140e20.png\"]', 1, '2025-08-21 16:40:14', 2, 1, 0, 0, '2025-08-21 16:45:03'),
(4, '0004', 11, '000600011', 6, '0006', '3', 1, 1, 'X-Ray', 'Philips', 'Phi-X', '12303', '2025-09-29', 'Phillips', '8910181521', '', '2025-09-25', '', 1, '2025-09-25 15:31:44', 2, 0, 0, 0, '2025-09-25 15:32:09'),
(5, '0005', 12, '000600012', 6, '0006', '5', 1, 2, 'OT light', 'philips', 'OT light', '12123344678', '2024-12-02', 'Electrocare', '888888888888', 'cali done 25-09-25', '2025-09-25', '[\"68d51ce948f83.jpeg\"]', 1, '2025-09-25 15:40:17', 2, 1, 0, 1, '2025-09-25 16:14:00');

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
  `pms_status` tinyint(1) NOT NULL COMMENT '0=Due,1=done,2=wip',
  `pms_sp_status` tinyint(1) NOT NULL COMMENT '0=WIP, 1=Completed',
  `assign_to_sp_engg` tinyint(1) NOT NULL COMMENT '1=SP,2=Engg',
  `pms_data_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `qa_info`
--

INSERT INTO `qa_info` (`qa_id`, `qa_info_id`, `asset_id`, `asset_code`, `facility_id`, `facility_code`, `department_id`, `device_group`, `asset_class`, `equipment_name`, `equipment_make`, `equipment_model`, `equipment_sl_no`, `pms_due_date`, `supplied_by`, `sp_details`, `service_provider_details`, `pms_planned_date`, `pms_report_attached`, `link_generated_by`, `link_generate_time`, `row_status`, `pms_status`, `pms_sp_status`, `assign_to_sp_engg`, `pms_data_updated`) VALUES
(1, '0001', 3, '000200003', 2, '0002', '3', 1, 1, 'Mamo graphy', 'Siemens', 'Clarity', 'TA2344', '2025-09-01', 'Sapoorji', '8910420169', '21.08', '2025-08-21', '[\"68a7027db4517.png\"]', 1, '2025-08-21 16:41:48', 2, 1, 0, 1, '2025-08-21 16:56:55'),
(2, '0002', 5, '000300005', 3, '0003', '3', 1, 1, 'X-ray', 'PHILIPS', '500mA', '78912', '2025-05-20', 'Eastern Meditech', '8910420169', '21.08', '2025-08-21', '[\"68a7024dcb033.png\"]', 1, '2025-08-21 16:42:36', 2, 1, 0, 0, '2025-08-21 16:56:08'),
(3, '0003', 1, '000100001', 1, '0001', '3', 1, 1, 'X-ray', 'ME xray', '300mA', '11334', '2025-01-01', 'ME X-ray', '8910420169', '', '2025-08-21', '', 1, '2025-08-21 16:57:22', 2, 0, 0, 0, '2025-08-21 16:57:25');

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
(1, 'Mr. Superadmin', 1, 1, 1, '9733935161', '256789', 'superadmin@apmeq.com', '1987-10-01', 'Bagnan', 'superadmin@apmeq.com', '12345678', 1),
(15, 'Mr. Hospital Admin', 2, 1, 1, '9876543210', '', 'hospitaladmin@apmeq.com', '2024-08-28', 'Village: Bhuarah; Post Office: Agunshi; Police Station: Bagnan;\nDistrict: Howrah', 'hospitaladmin@apmeq.com', '12345678', 1),
(16, 'Mr. Department Doctor', 3, 1, 1, '9876543211', '', 'department_doctor@apmeq.com', '2024-08-28', 'Village: Bhuarah; Post Office: Agunshi; Police Station: Bagnan;\nDistrict: Howrah', 'department_doctor@apmeq.com', '12345678', 1),
(17, 'Mr. Calibration service provider', 4, 1, 1, '9876543212', '', 'calibration_ap@apmeq.com', '2024-08-28', 'Village: Bhuarah; Post Office: Agunshi; Police Station: Bagnan;\nDistrict: Howrah', 'calibration_ap@apmeq.com', '12345678', 1),
(20, 'SK S A', 2, 1, 1, '8910420169', '', 'sksayan2012@gmail.com', '1985-01-16', ' howrah, 711310', 'Abcdapmeq', '711310', 1),
(26, 'Dr. Kamal', 3, 1, 3, '8910420169', '', 'rrr', '2025-07-07', ' ffff', 'Kamal', 'Kamal', 0),
(27, 'Dr. Kamal', 3, 1, 3, '8910420169', '', 'hhhh', '2025-07-07', 'Chaksrikrishna, Hirapur', 'Kamal', 'Kamal', 0),
(28, 'Dr. Kamal', 3, 1, 3, '8910420169', '', 'kamal@apmeq.com', '2025-07-07', 'Chaksrikrishna, Hirapur', 'Dr. Kamal', 'Kamal', 1),
(29, 'Dr. Rajesh', 3, 1, 2, '8910420169', '', 'rajesh', '2025-07-15', ' Kolkata', 'Rajesh', 'Rajesh', 1),
(30, 'Hospital 1 admin', 2, 1, 2, '9', '', 'c', '2025-07-15', ' d', 'Hospital 1', 'Hospital 1', 1),
(31, 'Hospital 2 admin', 2, 1, 3, '10', '', '10', '2025-07-15', ' kolkata', 'Hospital 2', 'Hospital 2', 1),
(32, 'Asmita', 2, 1, 6, '8910420169', '', 'asmita@gmail.com', '1996-01-07', ' Purulia', 'asmita', 'asmita', 1);

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
  MODIFY `asset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `asset_status_code`
--
ALTER TABLE `asset_status_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `asset_type_list`
--
ALTER TABLE `asset_type_list`
  MODIFY `asset_type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `calib_info`
--
ALTER TABLE `calib_info`
  MODIFY `calib_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `call_log_register`
--
ALTER TABLE `call_log_register`
  MODIFY `call_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `category_list`
--
ALTER TABLE `category_list`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department_list`
--
ALTER TABLE `department_list`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `device_group_list`
--
ALTER TABLE `device_group_list`
  MODIFY `device_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `facility_master`
--
ALTER TABLE `facility_master`
  MODIFY `facility_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hospital_list`
--
ALTER TABLE `hospital_list`
  MODIFY `hospital_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `manufacturer_list`
--
ALTER TABLE `manufacturer_list`
  MODIFY `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pms_info`
--
ALTER TABLE `pms_info`
  MODIFY `pms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `qa_info`
--
ALTER TABLE `qa_info`
  MODIFY `qa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rber_info`
--
ALTER TABLE `rber_info`
  MODIFY `rber_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reloc_asset_detail`
--
ALTER TABLE `reloc_asset_detail`
  MODIFY `reloc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_providers_list`
--
ALTER TABLE `service_providers_list`
  MODIFY `service_providers_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier_list`
--
ALTER TABLE `supplier_list`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
