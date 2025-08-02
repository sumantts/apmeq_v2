-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 22, 2025 at 09:42 AM
-- Server version: 10.11.11-MariaDB
-- PHP Version: 8.3.23

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
(1, 1, '[\"2\"]', 'Radiant Warmer', 'NAT Steel', 'Difibmax', '12345678', 'NA', '2025-01-01', '', 'NAT steel', '450000', '0 years, 5 months, 29 days', 2, 1, 2, 1, '2025-07-21', '', '|3|', '2025-06-29', '', '|3|', '2025-01-01', '|3|', '', '2026-01-01', 1, '2025-06-01', 2, '0000-00-00', '000100001', 'NAT Steel Ltd.', 1, 1),
(2, 1, '[\"2\"]', 'Incubator', 'Phoneix', 'Incub', 'Phn123456', 'NA', '2025-02-01', '', 'Philips', '75000', '0 years, 4 months, 28 days', 2, 1, 2, 1, '2025-07-21', '', '|2|', '2025-02-01', '', '|2|', '2025-02-01', '|2|', '', '2026-02-01', 2, '0000-00-00', 2, '0000-00-00', '000100002', 'Phoneix Pvt. Ltd.', 1, 1),
(3, 1, '[\"2\"]', 'Multipara monitor', 'Philips', 'Pro', '12345678', 'NA', '2025-03-01', '', 'Philips', '10000', '0 years, 4 months, 0 days', 2, 1, 2, 1, '2025-03-01', '', '|2|', '2025-07-16', '', '|2|', '2025-03-01', '|2|', '', '2026-03-01', 2, '0000-00-00', 2, '0000-00-00', '000100003', 'Philips Pvt. Ltd.', 1, 1),
(4, 2, '[\"2\"]', 'ECG', 'BPL', 'Cardiart', '123123', 'NA', '2023-02-10', '', 'Bhogilal', '25000', '2 years, 4 months, 25 days', 2, 1, 2, 0, '2024-02-02', '', '1|0|0', '2024-02-02', '', '0|4|0', '0000-00-00', '', '', '2024-02-10', 0, '0000-00-00', 0, '1970-01-01', '000200004', '8910420169', 1, 1),
(5, 2, '[\"2\"]', 'BP Machine', 'Omron', 'OMBP', '1245', 'NA', '2024-02-10', '', 'Bhogilal', '3000', '+1 years 4 months', 2, 1, 2, 0, '2025-02-02', '', '1|0|0', '2025-02-02', '', '0|3|0', '1970-01-01', '', '', '2025-02-10', 0, '0000-00-00', 0, '1970-01-01', '000200005', '8910420169', 1, 1),
(6, 3, '[\"2\"]', 'Nebulizer', 'Max', 'M2', '1001', 'NA', '2025-01-01', '', 'Bhogilal', '2500', '0 years, 6 months, 6 days', 2, 1, 2, 1, '2025-01-01', '', '1|0|0', '2025-07-21', '', '0|3|0', '1970-01-01', '', '', '2025-07-01', 0, '0000-00-00', 0, '1970-01-01', '000300006', '8910420169', 1, 1),
(7, 3, '[\"2\"]', 'Difibrilator', 'Phillips', 'Difib', 'AB1234', 'NA', '2023-01-01', '', 'Bhogilal', '600000', '+2 years 6 months', 2, 1, 1, 0, '2024-01-01', '', '0|6|0', '2025-06-01', '', '0|6|0', '1970-01-01', '', '', '2024-01-01', 0, '0000-00-00', 0, '1970-01-01', '000300007', '8910420169', 1, 1),
(8, 3, '[\"1\"]', 'X-ray', 'ME xray', 'Xray123', 'ME123456', 'NA', '2023-09-01', '', 'Bhogilal', '300000', '1 years, 10 months, 7 days', 2, 1, 1, 0, '2025-01-20', '', '0|6|0', '2025-04-20', '', '0|3|0', '2025-01-01', '1|0|0', '', '2024-09-01', 0, '0000-00-00', 0, '1970-01-01', '000300008', '8910420169', 1, 1),
(9, 2, '[\"3\"]', 'X-ray', 'PHILIPS', '300mA', 'LM200i', 'N.A', '2024-01-01', '', 'Eastern Meditech', '800000', '1 years, 6 months, 22 days', 2, 1, 1, 3, '2024-01-01', '', '1||', '2024-01-01', '', '|6|', '2024-02-15', '1||', '', '2025-01-31', 0, '0000-00-00', 0, '0000-00-00', '000200009', '8910420169', 1, 1),
(10, 3, '[\"1\"]', 'Mamo graphy', 'PHILIPS', 'Mamo 1', '121245', '', '2024-11-21', '', 'Eastern Meditech', '100000', '0 years, 8 months, 2 days', 2, 1, 1, 3, '2025-01-01', '', '1||', '2025-02-04', '', '|6|', '2025-07-21', '|6|', '', '2025-11-21', 0, '0000-00-00', 0, '0000-00-00', '000300010', '8910420169', 1, 1),
(11, 2, '[\"2\"]', 'C-ARM', 'BPL', 'C-ARM', '102354', '', '2024-01-01', '', 'Eastern Meditech', '1500000', '1 years, 6 months, 22 days', 2, 1, 1, 3, '2025-06-21', '', '|6|', '2025-06-21', '', '|6|0', '2025-07-21', '|6|', '', '2025-07-21', 0, '0000-00-00', 0, '0000-00-00', '000200011', '', 1, 1);

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
(1, '0001', 7, '000300007', 3, '0003', '2', 0, 1, 'Difibrilator', 'Phillips', 'Difib', 'AB1234', '2024-07-01', 'Bhogilal', '8910420169', '', '2025-07-05', '', 1, '2025-07-05 21:59:16', 2, 0, 0, 0, '2025-07-05 21:59:16'),
(2, '0002', 8, '000300008', 3, '0003', '1', 0, 1, 'X-ray', 'ME xray', 'Xray123', 'ME123456', '2025-07-20', 'Bhogilal', '8910420169', '', '2025-07-09', '', 1, '2025-07-09 15:56:26', 2, 0, 0, 0, '2025-07-09 15:56:31'),
(3, '0003', 3, '000100003', 1, '0001', '2', 1, 2, 'Multipara monitor', 'Philips', 'Pro', '12345678', '2025-05-01', 'Philips', 'Philips Pvt. Ltd.', '', '2025-07-16', '', 1, '2025-07-16 13:15:44', 2, 0, 0, 0, '2025-07-16 13:15:44'),
(4, '0004', 2, '000100002', 1, '0001', '2', 1, 2, 'Incubator', 'Phoneix', 'Incub', 'Phn123456', '2025-04-01', 'Philips', 'Phoneix Pvt. Ltd.', '', '2025-07-21', '', 1, '2025-07-16 13:29:22', 2, 1, 0, 0, '2025-07-21 16:00:22'),
(5, '0005', 1, '000100001', 1, '0001', '2', 1, 2, 'Radiant Warmer', 'NAT Steel', 'Difibmax', '12345678', '2025-04-29', 'NAT steel', 'NAT Steel Ltd.', '', '2025-07-21', '[\"687e165ec5e29.png\"]', 1, '2025-07-21 15:55:50', 2, 1, 0, 0, '2025-07-21 15:55:57'),
(6, '0006', 9, '000200009', 2, '0002', '3', 3, 1, 'X-ray', 'PHILIPS', '300mA', 'LM200i', '2025-01-01', 'Eastern Meditech', '8910420169', '', '2025-07-21', '', 1, '2025-07-21 16:08:32', 2, 0, 0, 0, '2025-07-21 16:08:34');

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

--
-- Dumping data for table `call_log_register`
--

INSERT INTO `call_log_register` (`call_log_id`, `token_id`, `facility_id`, `asset_code`, `user_id`, `ticket_raiser_name`, `ticket_raiser_contact`, `issue_description`, `call_log_date_time`, `resolved_date_time`, `assign_to`, `eng_contact_no`, `uploaded_report`, `engineer_coment`, `call_log_comment`, `call_log_attach`, `status_by_engg`, `call_log_status`, `ticket_class`, `amc_yes_no`, `amc_last_date`, `cmc_yes_no`, `cmc_last_date`) VALUES
(1, '0001', 1, '000100003', 1, 'Mr. Superadmin', '9733935161', 'Malfunction ', '2025-07-05 23:32:24', '0000-00-00 00:00:00', 0, '', '', '', '', '', 2, 0, 0, 2, '0000-00-00', 2, '0000-00-00'),
(2, '0002', 2, '000200004', 26, 'Dr. Kamal', '8910420169', 'Paper roll jammed ', '2025-07-07 22:30:05', '0000-00-00 00:00:00', 0, '', '', '', '', '', 0, 0, 0, 0, '0000-00-00', 0, '1970-01-01'),
(3, '0003', 3, '000300006', 26, 'Dr. Kamal', '8910420169', 'Vapour not creating ', '2025-07-07 22:35:11', '0000-00-00 00:00:00', 2, '9674194486', '', '', '', '', 0, 0, 0, 0, '0000-00-00', 0, '1970-01-01'),
(4, '0004', 3, '000300008', 30, 'Hospital 1 admin', '9', 'Collimator issue ', '2025-07-15 17:10:54', '0000-00-00 00:00:00', 0, '', '', '', '', '', 0, 0, 0, 0, '0000-00-00', 0, '1970-01-01'),
(5, '0005', 2, '000200009', 30, 'Hospital 1 admin', '9', 'Collimator issue ', '2025-07-15 17:12:55', '0000-00-00 00:00:00', 2, '123456789', '', '', 'done', '', 1, 0, 0, 0, '0000-00-00', 0, '0000-00-00'),
(8, '0008', 2, '000200005', 1, 'Mr. Superadmin', '9733935161', 'issue', '2025-07-15 17:34:50', '0000-00-00 00:00:00', 0, '', '', '', '', '', 0, 0, 0, 0, '0000-00-00', 0, '1970-01-01'),
(9, '0009', 2, '000200009', 30, 'Hospital 1 admin', '9', 'Issue ', '2025-07-15 17:39:43', '0000-00-00 00:00:00', 0, '', '', '', '', '', 0, 0, 0, 0, '0000-00-00', 0, '0000-00-00'),
(10, '0010', 3, '000300007', 31, 'Hospital 2 admin', '10', 'Not charging ', '2025-07-15 17:42:44', '0000-00-00 00:00:00', 0, '', '', '', '', '', 0, 0, 0, 0, '0000-00-00', 0, '1970-01-01'),
(11, '0011', 1, '000100003', 31, 'Hospital 2 admin', '10', 'Issue ', '2025-07-15 17:43:07', '0000-00-00 00:00:00', 0, '', '', '', '', '', 0, 0, 0, 2, '0000-00-00', 2, '0000-00-00');

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
(3, 'Radiology', 'Radiology', 1);

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
(1, 'Group A', 1),
(2, 'Group B', 1),
(3, 'Diagnostic', 1),
(4, 'Therapeutic', 1);

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
(1, 0, '[\"1\"]', 'Uluberia Hospital', 1, '0001', 'Uluberia', 1, 1, 'suman jana', 1),
(2, 0, '[\"2\",\"1\"]', 'Hospital 1', 1, '0002', 'Garia, WB', 1, 2, '7890132902', 1),
(3, 0, '[\"2\",\"1\"]', 'Hospital 2', 1, '0003', 'Kolkata', 2, 2, '8910420169', 1);

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
(1, '0001', 1, '000100001', 1, '0001', '2', 1, 2, 'Radiant Warmer', 'NAT Steel', 'Difibmax', '12345678', '2024-04-01', 'NAT steel', 'NAT Steel Ltd.', 'work in progress', '2025-06-29', '', 1, '2025-06-29 22:37:21', 2, 1, 0, 0, '2025-06-29 22:45:35'),
(2, '0002', 2, '000100002', 1, '0001', '2', 1, 2, 'Incubator', 'Phoneix', 'Incub', 'Phn123456', '2025-04-01', 'Philips', 'Phoneix Pvt. Ltd.', '', '2025-06-29', '', 1, '2025-06-29 22:49:50', 2, 0, 0, 1, '2025-06-29 22:49:50'),
(3, '0003', 3, '000100003', 1, '0001', '2', 1, 2, 'Multipara monitor', 'Philips', 'Pro', '12345678', '2025-05-01', 'Philips', 'Philips Pvt. Ltd.', 'work almost done', '2025-06-29', '', 1, '2025-06-29 22:50:22', 2, 1, 0, 0, '2025-06-29 22:51:12'),
(4, '0004', 6, '000300006', 3, '0003', '2', 1, 2, 'Nebulizer', 'Max', 'M2', '1001', '2025-04-01', 'Bhogilal', '8910420169', '', '2025-07-21', '[\"687e125854165.png\"]', 1, '2025-07-05 22:02:25', 2, 1, 0, 0, '2025-07-21 15:41:00'),
(5, '0005', 8, '000300008', 3, '0003', '1', 1, 1, 'X-ray', 'ME xray', 'Xray123', 'ME123456', '2025-07-20', 'Bhogilal', '8910420169', '', '2025-07-09', '', 1, '2025-07-09 15:54:04', 2, 0, 0, 0, '2025-07-09 15:54:29'),
(6, '0006', 5, '000200005', 2, '0002', '2', 1, 2, 'BP Machine', 'Omron', 'OMBP', '1245', '2025-05-02', 'Bhogilal', '8910420169', '', '2025-07-21', '', 1, '2025-07-21 15:37:05', 2, 0, 0, 0, '2025-07-21 15:37:08');

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
(1, '0001', 9, '000200009', 2, '0002', '3', 3, 1, 'X-ray', 'PHILIPS', '300mA', 'LM200i', '2025-01-01', 'Eastern Meditech', '8910420169', '', '2025-07-15', '[\"68762b4e538b0.png\"]', 1, '2025-07-15 15:48:01', 2, 1, 0, 1, '2025-07-15 15:48:31'),
(2, '0002', 10, '000300010', 3, '0003', '1', 3, 1, 'Mamo graphy', 'PHILIPS', 'Mamo 1', '121245', '2025-05-21', 'Eastern Meditech', '8910420169', '', '2025-07-21', '', 1, '2025-07-21 16:58:39', 2, 1, 0, 1, '2025-07-21 16:58:42'),
(3, '0003', 11, '000200011', 2, '0002', '2', 3, 1, 'C-ARM', 'BPL', 'C-ARM', '102354', '2024-07-02', 'Eastern Meditech', '', 'done', '2025-07-21', '[\"687e26cb1aadd.png\"]', 1, '2025-07-21 17:04:29', 2, 1, 0, 2, '2025-07-21 17:10:19');

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
(28, 'Dr. Kamal', 3, 1, 3, '8910420169', '', 'kamal@apmeq.com', '2025-07-07', 'Chaksrikrishna, Hirapur', 'Kamal', 'Kamal', 1),
(29, 'Dr. Rajesh', 3, 1, 2, '8910420169', '', 'rajesh', '2025-07-15', ' Kolkata', 'Rajesh', 'Rajesh', 1),
(30, 'Hospital 1 admin', 2, 1, 2, '9', '', 'c', '2025-07-15', ' d', 'Hospital 1', 'Hospital 1', 1),
(31, 'Hospital 2 admin', 2, 1, 3, '10', '', '10', '2025-07-15', ' kolkata', 'Hospital 2', 'Hospital 2', 1);

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
  MODIFY `asset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `calib_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `call_log_register`
--
ALTER TABLE `call_log_register`
  MODIFY `call_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `category_list`
--
ALTER TABLE `category_list`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department_list`
--
ALTER TABLE `department_list`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `device_group_list`
--
ALTER TABLE `device_group_list`
  MODIFY `device_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `facility_master`
--
ALTER TABLE `facility_master`
  MODIFY `facility_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `pms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
