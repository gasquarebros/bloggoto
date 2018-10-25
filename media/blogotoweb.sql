-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2018 at 04:44 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blogotoweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `pos_cart_attributes`
--

CREATE TABLE `pos_cart_attributes` (
  `id` int(11) NOT NULL,
  `cartid` bigint(20) NOT NULL,
  `itemid` bigint(20) NOT NULL,
  `attribute_id` varchar(255) DEFAULT NULL,
  `attribute_name` varchar(255) DEFAULT NULL,
  `attribute_value_id` varchar(255) DEFAULT NULL,
  `attribute_value_name` varchar(255) DEFAULT NULL,
  `attribute_value_image` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_cart_details`
--

CREATE TABLE `pos_cart_details` (
  `cart_id` bigint(20) NOT NULL,
  `cart_customer_id` int(11) DEFAULT NULL,
  `cart_session_id` varchar(255) DEFAULT NULL,
  `cart_total_items` smallint(6) DEFAULT NULL,
  `cart_delivery_charge` decimal(10,2) DEFAULT NULL,
  `cart_sub_total` decimal(10,2) DEFAULT NULL,
  `cart_grand_total` decimal(10,2) DEFAULT NULL,
  `cart_created_on` datetime DEFAULT NULL,
  `cart_created_ip` char(20) DEFAULT NULL,
  `cart_updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pos_cart_items`
--

CREATE TABLE `pos_cart_items` (
  `cart_item_id` bigint(20) NOT NULL,
  `cart_item_customer_id` bigint(11) DEFAULT NULL,
  `cart_item_session_id` varchar(155) DEFAULT NULL,
  `cart_item_cart_id` bigint(20) DEFAULT NULL,
  `cart_item_product_id` varchar(155) DEFAULT NULL,
  `cart_item_product_name` varchar(155) DEFAULT NULL,
  `cart_item_product_sku` varchar(155) NOT NULL,
  `cart_item_product_image` varchar(155) DEFAULT NULL,
  `cart_item_qty` smallint(6) DEFAULT NULL,
  `cart_item_unit_price` decimal(10,2) DEFAULT NULL,
  `cart_item_product_orginal_price` decimal(10,2) NOT NULL,
  `cart_item_total_price` decimal(10,2) DEFAULT NULL,
  `cart_item_product_type` varchar(255) DEFAULT NULL,
  `cart_item_product_discount` double DEFAULT NULL,
  `cart_item_subproduct_id` int(11) DEFAULT NULL,
  `cart_item_subproduct_name` varchar(255) DEFAULT NULL,
  `cart_item_merchant_id` int(11) DEFAULT NULL,
  `cart_item_merchant_name` varchar(255) DEFAULT NULL,
  `cart_item_shiiping_id` int(11) DEFAULT NULL,
  `cart_item_shipping_product_price` double DEFAULT NULL,
  `cart_item_created_on` datetime DEFAULT NULL,
  `cart_item_updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pos_cart_item_shipping`
--

CREATE TABLE `pos_cart_item_shipping` (
  `id` int(11) NOT NULL,
  `cartid` bigint(20) DEFAULT NULL,
  `shipping_id` int(11) DEFAULT NULL,
  `shipping_name` varchar(255) DEFAULT NULL,
  `is_combined` tinyint(1) NOT NULL DEFAULT '0',
  `shipping_method_price` double DEFAULT NULL,
  `ship_track_url` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_orders`
--

CREATE TABLE `pos_orders` (
  `order_primary_id` bigint(20) NOT NULL,
  `order_id` varchar(50) DEFAULT NULL,
  `order_local_no` varchar(100) DEFAULT NULL,
  `order_customer_id` int(11) DEFAULT NULL,
  `order_delivery_charge` decimal(10,2) DEFAULT NULL,
  `order_discount_applied` enum('Yes','No') NOT NULL DEFAULT 'No',
  `order_discount_amount` float DEFAULT NULL,
  `order_discount_type` enum('coupon','voucher','redeem') DEFAULT NULL,
  `order_promocode_name` varchar(150) NOT NULL,
  `order_sub_total` decimal(10,2) DEFAULT NULL,
  `order_total_amount` decimal(10,2) DEFAULT NULL,
  `order_payment_mode` varchar(255) NOT NULL,
  `order_payment_getway_type` enum('stripe','paypal') DEFAULT NULL,
  `order_payment_getway_status` enum('Success','Failure') DEFAULT NULL,
  `order_additional_delivery` decimal(10,2) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `order_cancel_remark` varchar(255) NOT NULL,
  `order_cancel_date` datetime DEFAULT NULL,
  `order_cancel_source` enum('User','Admin','Callcenter','Business') NOT NULL,
  `order_cancel_by` int(11) DEFAULT NULL,
  `order_status` tinyint(4) DEFAULT NULL,
  `order_source` enum('Web','Mobile','CallCenter') DEFAULT NULL,
  `order_contact_number` varchar(255) DEFAULT NULL,
  `order_created_on` datetime DEFAULT NULL,
  `order_created_by` int(11) NOT NULL,
  `order_created_ip` varchar(255) DEFAULT NULL,
  `order_updated_by` int(11) NOT NULL,
  `order_updated_on` datetime NOT NULL,
  `order_updated_ip` varchar(255) NOT NULL,
  `order_refund` tinyint(1) NOT NULL DEFAULT '0',
  `order_refund_date` datetime DEFAULT NULL,
  `order_remarks` longtext NOT NULL,
  `order_tracking_remarks` longtext,
  `payment_refer_id` text,
  `payment_signature` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pos_orders`
--

INSERT INTO `pos_orders` (`order_primary_id`, `order_id`, `order_local_no`, `order_customer_id`, `order_delivery_charge`, `order_discount_applied`, `order_discount_amount`, `order_discount_type`, `order_promocode_name`, `order_sub_total`, `order_total_amount`, `order_payment_mode`, `order_payment_getway_type`, `order_payment_getway_status`, `order_additional_delivery`, `order_date`, `order_cancel_remark`, `order_cancel_date`, `order_cancel_source`, `order_cancel_by`, `order_status`, `order_source`, `order_contact_number`, `order_created_on`, `order_created_by`, `order_created_ip`, `order_updated_by`, `order_updated_on`, `order_updated_ip`, `order_refund`, `order_refund_date`, `order_remarks`, `order_tracking_remarks`, `payment_refer_id`, `payment_signature`) VALUES
(1, '0E60C1DD-9AFF-4E7A-9D2F-6506CB560EF1', '12312312321', 4, '12.00', 'No', NULL, NULL, '', '100.00', '112.00', '1', 'stripe', 'Success', NULL, '2018-09-22 00:00:00', '', NULL, '', NULL, 5, 'Web', '123456789', '2018-09-22 00:00:00', 0, NULL, 4, '2018-09-22 00:00:00', '', 0, NULL, 'test', NULL, NULL, NULL),
(2, 'D4E22CF2-92DE-41F6-9862-FC3DBC5C4E7B', '121018002622F266', 4, NULL, 'No', NULL, NULL, '', '2446.00', '2569.00', 'online', NULL, 'Failure', NULL, '2018-10-12 00:26:22', '', NULL, 'User', NULL, 2, 'Web', '123123213', '2018-10-12 00:26:22', 4, '::1', 0, '0000-00-00 00:00:00', '', 0, NULL, '', NULL, NULL, NULL),
(3, '23F9B977-C380-42ED-92B2-AFC3DD6A0D76', '121018212605F231', 4, NULL, 'No', NULL, NULL, '', '2446.00', '2569.00', 'online', NULL, 'Failure', NULL, '2018-10-12 21:26:05', '', NULL, 'User', NULL, 2, 'Web', '12312312321', '2018-10-12 21:26:05', 4, '::1', 0, '0000-00-00 00:00:00', '', 0, NULL, '', NULL, NULL, NULL),
(4, '4B5A6A6C-9C3C-400F-B086-C314E75BD819', '121018213249F498', 4, '123.00', 'No', NULL, NULL, '', '2446.00', '2569.00', 'online', NULL, 'Failure', NULL, '2018-10-12 21:32:49', '', NULL, 'User', NULL, 2, 'Web', '12312312321', '2018-10-12 21:32:49', 4, '::1', 0, '0000-00-00 00:00:00', '', 0, NULL, '', NULL, NULL, NULL),
(5, 'DFC4D5EF-1DCA-47DF-B86A-55FE0E723FEB', '121018213344F136', 4, '123.00', 'No', NULL, NULL, '', '2446.00', '2569.00', 'online', NULL, 'Failure', NULL, '2018-10-12 21:33:44', '', NULL, 'User', NULL, 2, 'Web', '12312312321', '2018-10-12 21:33:44', 4, '::1', 0, '0000-00-00 00:00:00', '', 0, NULL, '', NULL, NULL, NULL),
(6, 'CF5AC414-BFFF-4D82-B1A6-2478EDCBDC8A', '121018213750F828', 4, '123.00', 'No', NULL, NULL, '', '2446.00', '2569.00', 'online', NULL, 'Failure', NULL, '2018-10-12 21:37:50', '', NULL, 'User', NULL, 2, 'Web', '12312312321', '2018-10-12 21:37:50', 4, '::1', 0, '0000-00-00 00:00:00', '', 0, NULL, '', NULL, NULL, NULL),
(7, '01E61E74-C2D5-45F7-A5AB-B8EB0D56EC30', '121018213933F705', 4, '123.00', 'No', NULL, NULL, '', '2446.00', '2569.00', 'online', NULL, 'Failure', NULL, '2018-10-12 21:39:33', '', NULL, 'User', NULL, 2, 'Web', '12312312321', '2018-10-12 21:39:33', 4, '::1', 0, '0000-00-00 00:00:00', '', 0, NULL, '', NULL, NULL, NULL),
(8, 'A9B4ADB0-6ADA-45A4-B986-6DB3D188B0E9', '121018214102F390', 4, '123.00', 'No', NULL, NULL, '', '2446.00', '2569.00', 'online', NULL, 'Failure', NULL, '2018-10-12 21:41:02', '', NULL, 'User', NULL, 2, 'Web', '12312312321', '2018-10-12 21:41:02', 4, '::1', 0, '0000-00-00 00:00:00', '', 0, NULL, '', NULL, NULL, NULL),
(9, '1C67D807-3674-4A02-A1EF-55694D1BE57E', '121018214148F151', 4, '123.00', 'No', NULL, NULL, '', '2446.00', '2569.00', 'online', NULL, 'Failure', NULL, '2018-10-12 21:41:48', '', NULL, 'User', NULL, 2, 'Web', '12312312321', '2018-10-12 21:41:48', 4, '::1', 0, '0000-00-00 00:00:00', '', 0, NULL, '', NULL, NULL, NULL),
(10, '66384645-853C-4A70-8834-04DD3CBD46D5', '121018214338F160', 4, '123.00', 'No', NULL, NULL, '', '2446.00', '2569.00', 'online', NULL, 'Failure', NULL, '2018-10-12 21:43:38', '', NULL, 'User', NULL, 2, 'Web', '12312312321', '2018-10-12 21:43:38', 4, '::1', 0, '0000-00-00 00:00:00', '', 0, NULL, '', NULL, NULL, NULL),
(11, '6D033692-CF3D-4A2B-AFEE-950CB9640943', '121018214435F573', 4, '123.00', 'No', NULL, NULL, '', '2446.00', '2569.00', 'online', NULL, 'Failure', NULL, '2018-10-12 21:44:35', '', NULL, 'User', NULL, 2, 'Web', '12312312321', '2018-10-12 21:44:35', 4, '::1', 0, '0000-00-00 00:00:00', '', 0, NULL, '', NULL, NULL, NULL),
(12, '24915BC0-6795-4B5A-AC11-D5D1D524370D', '121018214529F261', 4, '123.00', 'No', NULL, NULL, '', '2446.00', '2569.00', 'online', NULL, 'Failure', NULL, '2018-10-12 21:45:29', '', NULL, 'User', NULL, 2, 'Web', '12312312321', '2018-10-12 21:45:29', 4, '::1', 0, '0000-00-00 00:00:00', '', 0, NULL, '', NULL, NULL, NULL),
(13, 'CBD50EBB-1E8E-41B4-AD9C-E4A66D358AD6', '121018214708F426', 4, '123.00', 'No', NULL, NULL, '', '2446.00', '2569.00', 'online', NULL, 'Failure', NULL, '2018-10-12 21:47:08', '', NULL, 'User', NULL, 2, 'Web', '12312312321', '2018-10-12 21:47:08', 4, '::1', 0, '0000-00-00 00:00:00', '', 0, NULL, '', NULL, NULL, NULL),
(14, 'CEB4E18C-0671-49AB-A405-BB06C35DC564', '121018214832F932', 4, '123.00', 'No', NULL, NULL, '', '2446.00', '2569.00', 'online', NULL, 'Failure', NULL, '2018-10-12 21:48:32', '', NULL, 'User', NULL, 2, 'Web', '12312312321', '2018-10-12 21:48:32', 4, '::1', 0, '0000-00-00 00:00:00', '', 0, NULL, '', NULL, NULL, NULL),
(15, 'C50AB269-4914-4ECA-A5B8-F6D5CA09C194', '121018215118F179', 4, '123.00', 'No', NULL, NULL, '', '2446.00', '2569.00', 'online', NULL, 'Failure', NULL, '2018-10-12 21:51:18', '', NULL, 'User', NULL, 2, 'Web', '12312312321', '2018-10-12 21:51:18', 4, '::1', 0, '0000-00-00 00:00:00', '', 0, NULL, '', NULL, NULL, NULL),
(16, '7EDE0CFB-BC68-4B03-9A5B-82E218485942', '121018215201F977', 4, '123.00', 'No', NULL, NULL, '', '2446.00', '2569.00', 'online', NULL, 'Failure', NULL, '2018-10-12 21:52:01', '', NULL, 'User', NULL, 2, 'Web', '12312312321', '2018-10-12 21:52:01', 4, '::1', 0, '0000-00-00 00:00:00', '', 0, NULL, '', NULL, NULL, NULL),
(17, '7C74CA95-BD50-457F-984A-D5FBC572A07C', '121018215237F124', 4, '123.00', 'No', NULL, NULL, '', '2446.00', '2569.00', 'online', NULL, 'Failure', NULL, '2018-10-12 21:52:37', '', NULL, 'User', NULL, 2, 'Web', '12312312321', '2018-10-12 21:52:37', 4, '::1', 0, '0000-00-00 00:00:00', '', 0, NULL, '', NULL, NULL, NULL),
(18, '06AAC57A-40D9-40F4-9578-350B28D130EC', '121018215357F423', 4, '123.00', 'No', NULL, NULL, '', '2446.00', '2569.00', 'online', NULL, 'Failure', NULL, '2018-10-12 21:53:57', '', NULL, 'User', NULL, 2, 'Web', '12312312321', '2018-10-12 21:53:57', 4, '::1', 0, '0000-00-00 00:00:00', '', 0, NULL, '', NULL, NULL, NULL),
(19, '2E77308D-9220-477D-BBA0-DA8AAD889652', '121018220752F973', 4, '123.00', 'No', NULL, NULL, '', '2446.00', '2569.00', 'online', NULL, 'Failure', NULL, '2018-10-12 22:07:52', '', NULL, 'User', NULL, 2, 'Web', '12312312321', '2018-10-12 22:07:52', 4, '::1', 0, '0000-00-00 00:00:00', '', 0, NULL, '', NULL, NULL, NULL),
(20, '865038BC-695F-4A7A-9C9F-26E16E7848DB', '121018220922F2', 4, '123.00', 'No', NULL, NULL, '', '2446.00', '2569.00', 'online', NULL, 'Failure', NULL, '2018-10-12 22:09:22', '', NULL, 'User', NULL, 2, 'Web', '12312312321', '2018-10-12 22:09:22', 4, '::1', 0, '0000-00-00 00:00:00', '', 0, NULL, '', NULL, NULL, NULL),
(21, 'CAA26202-DCBF-43DB-B507-2E2F91BE856E', '141018000741F228', 4, '246.00', 'No', NULL, NULL, '', '1346.00', '1592.00', 'online', NULL, 'Failure', NULL, '2018-10-14 00:07:41', '', NULL, 'User', NULL, 2, 'Web', '1231321232131', '2018-10-14 00:07:41', 4, '::1', 0, '0000-00-00 00:00:00', '', 0, NULL, '', NULL, NULL, NULL),
(22, '1F060669-444C-4F0E-B55D-36E8E4259E06', '141018002032F178', 4, '369.00', 'No', NULL, NULL, '', '2569.00', '2938.00', 'online', NULL, 'Failure', NULL, '2018-10-14 00:20:32', '', NULL, 'User', NULL, 2, 'Web', '123123', '2018-10-14 00:20:32', 4, '::1', 0, '0000-00-00 00:00:00', '', 0, NULL, '', NULL, NULL, NULL),
(23, '8D5D1049-77BB-4DEE-BA41-CEC4F7E7E3D3', '141018093709F735', 4, '123.00', 'No', NULL, NULL, '', '123.00', '246.00', 'online', NULL, 'Failure', NULL, '2018-10-14 09:37:09', '', NULL, 'User', NULL, 2, 'Web', '123213', '2018-10-14 09:37:09', 4, '::1', 0, '0000-00-00 00:00:00', '', 0, NULL, '', NULL, NULL, NULL),
(24, '973C1F8D-CC79-4572-A090-31D82A3A8FC1', '141018095111F995', 4, '123.00', 'No', NULL, NULL, '', '123.00', '246.00', 'online', NULL, 'Failure', NULL, '2018-10-14 09:51:11', '', NULL, 'User', NULL, 2, 'Web', '32312123', '2018-10-14 09:51:11', 4, '::1', 0, '0000-00-00 00:00:00', '', 0, NULL, '', NULL, NULL, NULL),
(25, '4B7DE934-A02B-4090-BF1C-A4FE41792533', '141018100218F31', 4, '123.00', 'No', NULL, NULL, '', '123.00', '246.00', 'online', NULL, 'Failure', NULL, '2018-10-14 10:02:18', '', NULL, 'User', NULL, 6, 'Web', '132123', '2018-10-14 10:02:18', 4, '::1', 0, '0000-00-00 00:00:00', '', 0, NULL, '', NULL, NULL, NULL),
(26, '093A6552-9A42-46BB-919A-AD00DC068781', '141018103152F620', 4, '1107.00', 'No', NULL, NULL, '', '3307.00', '4414.00', 'online', NULL, 'Failure', NULL, '2018-10-14 10:31:52', '', NULL, 'User', NULL, 6, 'Web', '111121212121', '2018-10-14 10:31:52', 4, '::1', 0, '0000-00-00 00:00:00', '', 0, NULL, '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pos_orders_customer_details`
--

CREATE TABLE `pos_orders_customer_details` (
  `order_customer_primary_key` bigint(20) NOT NULL,
  `order_customer_order_primary_id` int(11) NOT NULL,
  `order_customer_order_id` varchar(155) DEFAULT NULL,
  `order_customer_address_id` int(11) DEFAULT NULL,
  `order_customer_id` bigint(20) DEFAULT NULL,
  `order_customer_fname` varchar(100) DEFAULT NULL,
  `order_customer_lname` varchar(100) DEFAULT NULL,
  `order_customer_email` varchar(100) DEFAULT NULL,
  `order_customer_mobile_no` varchar(100) DEFAULT NULL,
  `order_customer_unit_no1` char(20) DEFAULT NULL,
  `order_customer_unit_no2` char(20) DEFAULT NULL,
  `order_customer_address_line1` varchar(155) DEFAULT NULL,
  `order_customer_address_line2` varchar(155) DEFAULT NULL,
  `order_customer_city` varchar(100) DEFAULT NULL,
  `order_customer_state` varchar(100) DEFAULT NULL,
  `order_customer_country` varchar(100) DEFAULT NULL,
  `order_customer_postal_code` varchar(50) DEFAULT NULL,
  `order_customer_created_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pos_orders_customer_details`
--

INSERT INTO `pos_orders_customer_details` (`order_customer_primary_key`, `order_customer_order_primary_id`, `order_customer_order_id`, `order_customer_address_id`, `order_customer_id`, `order_customer_fname`, `order_customer_lname`, `order_customer_email`, `order_customer_mobile_no`, `order_customer_unit_no1`, `order_customer_unit_no2`, `order_customer_address_line1`, `order_customer_address_line2`, `order_customer_city`, `order_customer_state`, `order_customer_country`, `order_customer_postal_code`, `order_customer_created_on`) VALUES
(1, 1, '0E60C1DD-9AFF-4E7A-9D2F-6506CB560EF1', NULL, 5, 'testuser', 'testuser', 'testuser@test.com', '123123123', '12', '12', 'testing address ', 'test second line', 'madurai', 'tamil nadu', 'India', '625001', '2018-09-22 00:00:00'),
(2, 5, 'DFC4D5EF-1DCA-47DF-B86A-55FE0E723FEB', 5, 4, 'asd', 'asdsa', 'gasquarebros@gmail.com', '', 'asd', '0', 'test', NULL, '', '', '', '510559', '2018-10-12 21:33:44'),
(3, 8, 'A9B4ADB0-6ADA-45A4-B986-6DB3D188B0E9', 5, 4, 'asd', 'asdsa', 'gasquarebros@gmail.com', '', 'asd', '0', 'test', NULL, '', '', '', '510559', '2018-10-12 21:41:02'),
(4, 9, '1C67D807-3674-4A02-A1EF-55694D1BE57E', 5, 4, 'asd', 'asdsa', 'gasquarebros@gmail.com', '', 'asd', '0', 'test', NULL, '', '', '', '510559', '2018-10-12 21:41:49'),
(5, 10, '66384645-853C-4A70-8834-04DD3CBD46D5', 5, 4, 'asd', 'asdsa', 'gasquarebros@gmail.com', '', 'asd', '0', 'test', NULL, '', '', '', '510559', '2018-10-12 21:43:38'),
(6, 11, '6D033692-CF3D-4A2B-AFEE-950CB9640943', 5, 4, 'asd', 'asdsa', 'gasquarebros@gmail.com', '', 'asd', '0', 'test', NULL, '', '', '', '510559', '2018-10-12 21:44:35'),
(7, 12, '24915BC0-6795-4B5A-AC11-D5D1D524370D', 5, 4, 'asd', 'asdsa', 'gasquarebros@gmail.com', '', 'asd', '0', 'test', NULL, '', '', '', '510559', '2018-10-12 21:45:29'),
(8, 13, 'CBD50EBB-1E8E-41B4-AD9C-E4A66D358AD6', 5, 4, 'asd', 'asdsa', 'gasquarebros@gmail.com', '', 'asd', '0', 'test', NULL, '', '', '', '510559', '2018-10-12 21:47:08'),
(9, 14, 'CEB4E18C-0671-49AB-A405-BB06C35DC564', 5, 4, 'asd', 'asdsa', 'gasquarebros@gmail.com', '', 'asd', '0', 'test', NULL, '', '', '', '510559', '2018-10-12 21:48:32'),
(10, 15, 'C50AB269-4914-4ECA-A5B8-F6D5CA09C194', 5, 4, 'asd', 'asdsa', 'gasquarebros@gmail.com', '', 'asd', '0', 'test', NULL, '', '', '', '510559', '2018-10-12 21:51:18'),
(11, 16, '7EDE0CFB-BC68-4B03-9A5B-82E218485942', 5, 4, 'asd', 'asdsa', 'gasquarebros@gmail.com', '', 'asd', '0', 'test', NULL, '', '', '', '510559', '2018-10-12 21:52:01'),
(12, 17, '7C74CA95-BD50-457F-984A-D5FBC572A07C', 5, 4, 'asd', 'asdsa', 'gasquarebros@gmail.com', '', 'asd', '0', 'test', NULL, '', '', '', '510559', '2018-10-12 21:52:38'),
(13, 18, '06AAC57A-40D9-40F4-9578-350B28D130EC', 5, 4, 'asd', 'asdsa', 'gasquarebros@gmail.com', '', 'asd', '0', 'test', NULL, '', '', '', '510559', '2018-10-12 21:53:57'),
(14, 19, '2E77308D-9220-477D-BBA0-DA8AAD889652', 5, 4, 'asd', 'asdsa', 'gasquarebros@gmail.com', '', 'asd', '0', 'test', NULL, '', '', '', '510559', '2018-10-12 22:07:52'),
(15, 20, '865038BC-695F-4A7A-9C9F-26E16E7848DB', 5, 4, 'asd', 'asdsa', 'gasquarebros@gmail.com', '', 'asd', '0', 'test', NULL, '', '', '', '510559', '2018-10-12 22:09:22'),
(16, 21, 'CAA26202-DCBF-43DB-B507-2E2F91BE856E', 5, 4, 'asd', 'asdsa', 'gasquarebros@gmail.com', '', 'asd', '0', 'test', NULL, '', '', '', '510559', '2018-10-14 00:07:41'),
(17, 22, '1F060669-444C-4F0E-B55D-36E8E4259E06', 5, 4, 'asd', 'asdsa', 'gasquarebros@gmail.com', '', 'asd', '0', 'test', NULL, '', '', '', '510559', '2018-10-14 00:20:33'),
(18, 23, '8D5D1049-77BB-4DEE-BA41-CEC4F7E7E3D3', 5, 4, 'asd', 'asdsa', 'gasquarebros@gmail.com', '', 'asd', '0', 'test', NULL, '', '', '', '510559', '2018-10-14 09:37:09'),
(19, 24, '973C1F8D-CC79-4572-A090-31D82A3A8FC1', 5, 4, 'asd', 'asdsa', 'gasquarebros@gmail.com', '', 'asd', '0', 'test', NULL, '', '', '', '510559', '2018-10-14 09:51:12'),
(20, 25, '4B7DE934-A02B-4090-BF1C-A4FE41792533', 5, 4, 'asd', 'asdsa', 'gasquarebros@gmail.com', '', 'asd', '0', 'test', NULL, '', '', '', '510559', '2018-10-14 10:02:18'),
(21, 26, '093A6552-9A42-46BB-919A-AD00DC068781', 5, 4, 'asd', 'asdsa', 'gasquarebros@gmail.com', '', 'asd', '0', 'test', NULL, '', '', '', '510559', '2018-10-14 10:31:53');

-- --------------------------------------------------------

--
-- Table structure for table `pos_order_items`
--

CREATE TABLE `pos_order_items` (
  `item_id` bigint(20) NOT NULL,
  `item_order_primary_id` int(11) DEFAULT NULL,
  `item_order_id` varchar(155) DEFAULT NULL,
  `item_product_id` varchar(155) DEFAULT NULL,
  `item_subproductid` int(11) DEFAULT NULL,
  `item_subproduct_name` varchar(255) DEFAULT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `item_image` varchar(155) DEFAULT NULL,
  `item_sku` varchar(100) DEFAULT NULL,
  `item_slug` varchar(255) DEFAULT NULL,
  `item_specification` mediumtext NOT NULL,
  `item_qty` int(11) DEFAULT NULL,
  `item_unit_price` decimal(10,2) DEFAULT NULL,
  `item_total_amount` decimal(10,2) DEFAULT NULL,
  `shiiping_id` int(11) DEFAULT NULL,
  `item_order_status` int(11) NOT NULL DEFAULT '1',
  `item_created_on` datetime DEFAULT NULL,
  `item_placed_on` datetime DEFAULT NULL,
  `item_remarks` text,
  `item_merchant_id` int(11) DEFAULT NULL,
  `item_merchant_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pos_order_items`
--

INSERT INTO `pos_order_items` (`item_id`, `item_order_primary_id`, `item_order_id`, `item_product_id`, `item_subproductid`, `item_subproduct_name`, `item_name`, `item_image`, `item_sku`, `item_slug`, `item_specification`, `item_qty`, `item_unit_price`, `item_total_amount`, `shiiping_id`, `item_order_status`, `item_created_on`, `item_placed_on`, `item_remarks`, `item_merchant_id`, `item_merchant_name`) VALUES
(1, 1, '0E60C1DD-9AFF-4E7A-9D2F-6506CB560EF1', '43', 45, 'Testing combo2 sub', 'Testing combo1', NULL, 'Testing combo1', NULL, '', 1, '100.00', '110.00', 1, 2, '2018-09-22 00:00:00', '2018-09-22 00:00:00', NULL, 4, 'gasquare'),
(2, 1, '0E60C1DD-9AFF-4E7A-9D2F-6506CB560EF1', '43', 45, 'Testing combo2 sub', 'Testing combo1', NULL, 'Testing combo1', NULL, '', 1, '100.00', '110.00', 1, 2, '2018-09-22 00:00:00', '2018-09-22 00:00:00', NULL, 3, 'gasquare'),
(3, 5, 'DFC4D5EF-1DCA-47DF-B86A-55FE0E723FEB', '73', 74, 'Test new sub11', 'test new from frontend', '', 'test-new-frontend', '', '', 3, '1223.00', '3669.00', 5, 1, '2018-10-12 21:33:44', '2018-10-12 21:33:44', '', 4, 'gasquare'),
(4, 6, 'CF5AC414-BFFF-4D82-B1A6-2478EDCBDC8A', '73', 74, 'Test new sub11', 'test new from frontend', '', 'test-new-frontend', '', '', 3, '1223.00', '3669.00', 6, 1, '2018-10-12 21:37:50', '2018-10-12 21:37:50', '', 4, 'gasquare'),
(5, 7, '01E61E74-C2D5-45F7-A5AB-B8EB0D56EC30', '73', 74, 'Test new sub11', 'test new from frontend', '', 'test-new-frontend', '', '', 3, '1223.00', '3669.00', 7, 1, '2018-10-12 21:39:33', '2018-10-12 21:39:33', '', 4, 'gasquare'),
(6, 8, 'A9B4ADB0-6ADA-45A4-B986-6DB3D188B0E9', '73', 74, 'Test new sub11', 'test new from frontend', '', 'test-new-frontend', '', '', 3, '1223.00', '3669.00', 8, 1, '2018-10-12 21:41:02', '2018-10-12 21:41:02', '', 4, 'gasquare'),
(7, 9, '1C67D807-3674-4A02-A1EF-55694D1BE57E', '73', 74, 'Test new sub11', 'test new from frontend', '', 'test-new-frontend', '', '', 3, '1223.00', '3669.00', 9, 1, '2018-10-12 21:41:49', '2018-10-12 21:41:49', '', 4, 'gasquare'),
(8, 10, '66384645-853C-4A70-8834-04DD3CBD46D5', '73', 74, 'Test new sub11', 'test new from frontend', '', 'test-new-frontend', '', '', 3, '1223.00', '3669.00', 10, 1, '2018-10-12 21:43:38', '2018-10-12 21:43:38', '', 4, 'gasquare'),
(9, 11, '6D033692-CF3D-4A2B-AFEE-950CB9640943', '73', 74, 'Test new sub11', 'test new from frontend', '', 'test-new-frontend', '', '', 3, '1223.00', '3669.00', 11, 1, '2018-10-12 21:44:35', '2018-10-12 21:44:35', '', 4, 'gasquare'),
(10, 12, '24915BC0-6795-4B5A-AC11-D5D1D524370D', '73', 74, 'Test new sub11', 'test new from frontend', '', 'test-new-frontend', '', '', 3, '1223.00', '3669.00', 12, 1, '2018-10-12 21:45:29', '2018-10-12 21:45:29', '', 4, 'gasquare'),
(11, 13, 'CBD50EBB-1E8E-41B4-AD9C-E4A66D358AD6', '73', 74, 'Test new sub11', 'test new from frontend', '', 'test-new-frontend', '', '', 3, '1223.00', '3669.00', 13, 1, '2018-10-12 21:47:08', '2018-10-12 21:47:08', '', 4, 'gasquare'),
(12, 14, 'CEB4E18C-0671-49AB-A405-BB06C35DC564', '73', 74, 'Test new sub11', 'test new from frontend', '', 'test-new-frontend', '', '', 3, '1223.00', '3669.00', 14, 1, '2018-10-12 21:48:32', '2018-10-12 21:48:32', '', 4, 'gasquare'),
(13, 15, 'C50AB269-4914-4ECA-A5B8-F6D5CA09C194', '73', 74, 'Test new sub11', 'test new from frontend', '', 'test-new-frontend', '', '', 3, '1223.00', '3669.00', 15, 1, '2018-10-12 21:51:18', '2018-10-12 21:51:18', '', 4, 'gasquare'),
(14, 16, '7EDE0CFB-BC68-4B03-9A5B-82E218485942', '73', 74, 'Test new sub11', 'test new from frontend', '', 'test-new-frontend', '', '', 3, '1223.00', '3669.00', 16, 1, '2018-10-12 21:52:01', '2018-10-12 21:52:01', '', 4, 'gasquare'),
(15, 17, '7C74CA95-BD50-457F-984A-D5FBC572A07C', '73', 74, 'Test new sub11', 'test new from frontend', '', 'test-new-frontend', '', '', 3, '1223.00', '3669.00', 17, 1, '2018-10-12 21:52:37', '2018-10-12 21:52:37', '', 4, 'gasquare'),
(16, 18, '06AAC57A-40D9-40F4-9578-350B28D130EC', '73', 74, 'Test new sub11', 'test new from frontend', '', 'test-new-frontend', '', '', 3, '1223.00', '3669.00', 18, 1, '2018-10-12 21:53:57', '2018-10-12 21:53:57', '', 4, 'gasquare'),
(17, 19, '2E77308D-9220-477D-BBA0-DA8AAD889652', '73', 74, 'Test new sub11', 'test new from frontend', '', 'test-new-frontend', '', '', 3, '1223.00', '3669.00', 19, 1, '2018-10-12 22:07:52', '2018-10-12 22:07:52', '', 4, 'gasquare'),
(18, 20, '865038BC-695F-4A7A-9C9F-26E16E7848DB', '73', 74, 'Test new sub11', 'test new from frontend', '', 'test-new-frontend', '', '', 3, '1223.00', '3669.00', 20, 1, '2018-10-12 22:09:22', '2018-10-12 22:09:22', '', 4, 'gasquare'),
(19, 21, 'CAA26202-DCBF-43DB-B507-2E2F91BE856E', '73', 75, 'test new sub21', 'test new from frontend', '', 'test-new-frontend', '', '', 1, '123.00', '123.00', 21, 1, '2018-10-14 00:07:41', '2018-10-14 00:07:41', '', 4, 'gasquare'),
(20, 21, 'CAA26202-DCBF-43DB-B507-2E2F91BE856E', '73', 74, 'Test new sub11', 'test new from frontend', '', 'test-new-frontend', '', '', 1, '1223.00', '1223.00', 22, 1, '2018-10-14 00:07:41', '2018-10-14 00:07:41', '', 4, 'gasquare'),
(21, 22, '1F060669-444C-4F0E-B55D-36E8E4259E06', '73', 75, 'test new sub21', 'test new from frontend', '', 'test-new-frontend', '', '', 1, '123.00', '123.00', 23, 1, '2018-10-14 00:20:33', '2018-10-14 00:20:33', '', 4, 'gasquare'),
(22, 22, '1F060669-444C-4F0E-B55D-36E8E4259E06', '73', 74, 'Test new sub11', 'test new from frontend', '', 'test-new-frontend', '', '', 2, '1223.00', '2446.00', 24, 1, '2018-10-14 00:20:33', '2018-10-14 00:20:33', '', 4, 'gasquare'),
(23, 23, '8D5D1049-77BB-4DEE-BA41-CEC4F7E7E3D3', '73', 75, 'test new sub21', 'test new from frontend', '', 'test-new-frontend', '', '', 1, '123.00', '123.00', 25, 1, '2018-10-14 09:37:09', '2018-10-14 09:37:09', '', 4, 'gasquare'),
(24, 24, '973C1F8D-CC79-4572-A090-31D82A3A8FC1', '73', 75, 'test new sub21', 'test new from frontend', '', 'test-new-frontend', '', '', 1, '123.00', '123.00', 26, 1, '2018-10-14 09:51:12', '2018-10-14 09:51:12', '', 4, 'gasquare'),
(25, 25, '4B7DE934-A02B-4090-BF1C-A4FE41792533', '73', 75, 'test new sub21', 'test new from frontend', '', 'test-new-frontend', '', '', 1, '123.00', '123.00', 27, 1, '2018-10-14 10:02:18', '2018-10-14 10:02:18', '', 4, 'gasquare'),
(26, 26, '093A6552-9A42-46BB-919A-AD00DC068781', '73', 75, 'test new sub21', 'test new from frontend', '', 'test-new-frontend', '', '', 7, '123.00', '861.00', 28, 1, '2018-10-14 10:31:52', '2018-10-14 10:31:52', '', 4, 'gasquare'),
(27, 26, '093A6552-9A42-46BB-919A-AD00DC068781', '73', 74, 'Test new sub11', 'test new from frontend', '', 'test-new-frontend', '', '', 2, '1223.00', '2446.00', 29, 1, '2018-10-14 10:31:53', '2018-10-14 10:31:53', '', 4, 'gasquare');

-- --------------------------------------------------------

--
-- Table structure for table `pos_order_item_modifiers`
--

CREATE TABLE `pos_order_item_modifiers` (
  `id` int(11) NOT NULL,
  `order_modifier_itemid` int(11) NOT NULL,
  `order_modifier_orderid` varchar(255) NOT NULL,
  `order_modifier_order_primary_id` int(11) NOT NULL,
  `order_modifier_id` int(11) DEFAULT NULL,
  `order_modifier_name` varchar(255) DEFAULT NULL,
  `order_modifier_value_id` int(11) DEFAULT NULL,
  `order_modifier_value_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_order_item_modifiers`
--

INSERT INTO `pos_order_item_modifiers` (`id`, `order_modifier_itemid`, `order_modifier_orderid`, `order_modifier_order_primary_id`, `order_modifier_id`, `order_modifier_name`, `order_modifier_value_id`, `order_modifier_value_name`) VALUES
(1, 1, '1', 1, 1, 'test', 2, 'testingvalue21'),
(2, 3, 'DFC4D5EF-1DCA-47DF-B86A-55FE0E723FEB', 5, NULL, 'test', 3, 'testingvalue22'),
(3, 6, 'A9B4ADB0-6ADA-45A4-B986-6DB3D188B0E9', 8, NULL, 'test', 3, 'testingvalue22'),
(4, 7, '1C67D807-3674-4A02-A1EF-55694D1BE57E', 9, NULL, 'test', 3, 'testingvalue22'),
(5, 8, '66384645-853C-4A70-8834-04DD3CBD46D5', 10, 1, 'test', 3, 'testingvalue22'),
(6, 9, '6D033692-CF3D-4A2B-AFEE-950CB9640943', 11, 1, 'test', 3, 'testingvalue22'),
(7, 10, '24915BC0-6795-4B5A-AC11-D5D1D524370D', 12, 1, 'test', 3, 'testingvalue22'),
(8, 11, 'CBD50EBB-1E8E-41B4-AD9C-E4A66D358AD6', 13, 1, 'test', 3, 'testingvalue22'),
(9, 12, 'CEB4E18C-0671-49AB-A405-BB06C35DC564', 14, 1, 'test', 3, 'testingvalue22'),
(10, 13, 'C50AB269-4914-4ECA-A5B8-F6D5CA09C194', 15, 1, 'test', 3, 'testingvalue22'),
(11, 14, '7EDE0CFB-BC68-4B03-9A5B-82E218485942', 16, 1, 'test', 3, 'testingvalue22'),
(12, 15, '7C74CA95-BD50-457F-984A-D5FBC572A07C', 17, 1, 'test', 3, 'testingvalue22'),
(13, 16, '06AAC57A-40D9-40F4-9578-350B28D130EC', 18, 1, 'test', 3, 'testingvalue22'),
(14, 17, '2E77308D-9220-477D-BBA0-DA8AAD889652', 19, 1, 'test', 3, 'testingvalue22'),
(15, 18, '865038BC-695F-4A7A-9C9F-26E16E7848DB', 20, 1, 'test', 3, 'testingvalue22'),
(16, 19, 'CAA26202-DCBF-43DB-B507-2E2F91BE856E', 21, 1, 'test', 2, 'testingvalue21'),
(17, 20, 'CAA26202-DCBF-43DB-B507-2E2F91BE856E', 21, 1, 'test', 3, 'testingvalue22'),
(18, 21, '1F060669-444C-4F0E-B55D-36E8E4259E06', 22, 1, 'test', 2, 'testingvalue21'),
(19, 22, '1F060669-444C-4F0E-B55D-36E8E4259E06', 22, 1, 'test', 3, 'testingvalue22'),
(20, 23, '8D5D1049-77BB-4DEE-BA41-CEC4F7E7E3D3', 23, 1, 'test', 2, 'testingvalue21'),
(21, 24, '973C1F8D-CC79-4572-A090-31D82A3A8FC1', 24, 1, 'test', 2, 'testingvalue21'),
(22, 25, '4B7DE934-A02B-4090-BF1C-A4FE41792533', 25, 1, 'test', 2, 'testingvalue21'),
(23, 26, '093A6552-9A42-46BB-919A-AD00DC068781', 26, 1, 'test', 2, 'testingvalue21'),
(24, 27, '093A6552-9A42-46BB-919A-AD00DC068781', 26, 1, 'test', 3, 'testingvalue22');

-- --------------------------------------------------------

--
-- Table structure for table `pos_order_item_shipping`
--

CREATE TABLE `pos_order_item_shipping` (
  `id` int(11) NOT NULL,
  `shipping_orderid` varchar(255) DEFAULT NULL,
  `shipping_order_primary_id` int(11) DEFAULT NULL,
  `shipping_id` int(11) DEFAULT NULL,
  `shipping_name` varchar(255) DEFAULT NULL,
  `is_combined` tinyint(1) NOT NULL DEFAULT '0',
  `shipping_method_price` double DEFAULT NULL,
  `shipping_track_url` text,
  `shipping_track_code` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_order_item_shipping`
--

INSERT INTO `pos_order_item_shipping` (`id`, `shipping_orderid`, `shipping_order_primary_id`, `shipping_id`, `shipping_name`, `is_combined`, `shipping_method_price`, `shipping_track_url`, `shipping_track_code`) VALUES
(1, '0E60C1DD-9AFF-4E7A-9D2F-6506CB560EF1', 1, 1, 'forex', 0, 0, NULL, 'asdsadsad'),
(2, 'D4E22CF2-92DE-41F6-9862-FC3DBC5C4E7B', 2, 6, 'forex', 0, 123, NULL, NULL),
(3, '23F9B977-C380-42ED-92B2-AFC3DD6A0D76', 3, 6, 'forex', 0, 123, NULL, NULL),
(4, '4B5A6A6C-9C3C-400F-B086-C314E75BD819', 4, 6, 'forex', 0, 123, NULL, NULL),
(5, 'DFC4D5EF-1DCA-47DF-B86A-55FE0E723FEB', 5, 6, 'forex', 0, 123, NULL, NULL),
(6, 'CF5AC414-BFFF-4D82-B1A6-2478EDCBDC8A', 6, 6, 'forex', 0, 123, NULL, NULL),
(7, '01E61E74-C2D5-45F7-A5AB-B8EB0D56EC30', 7, 6, 'forex', 0, 123, NULL, NULL),
(8, 'A9B4ADB0-6ADA-45A4-B986-6DB3D188B0E9', 8, 6, 'forex', 0, 123, NULL, NULL),
(9, '1C67D807-3674-4A02-A1EF-55694D1BE57E', 9, 6, 'forex', 0, 123, NULL, NULL),
(10, '66384645-853C-4A70-8834-04DD3CBD46D5', 10, 6, 'forex', 0, 123, NULL, NULL),
(11, '6D033692-CF3D-4A2B-AFEE-950CB9640943', 11, 6, 'forex', 0, 123, NULL, NULL),
(12, '24915BC0-6795-4B5A-AC11-D5D1D524370D', 12, 6, 'forex', 0, 123, NULL, NULL),
(13, 'CBD50EBB-1E8E-41B4-AD9C-E4A66D358AD6', 13, 6, 'forex', 0, 123, NULL, NULL),
(14, 'CEB4E18C-0671-49AB-A405-BB06C35DC564', 14, 6, 'forex', 0, 123, NULL, NULL),
(15, 'C50AB269-4914-4ECA-A5B8-F6D5CA09C194', 15, 6, 'forex', 0, 123, NULL, NULL),
(16, '7EDE0CFB-BC68-4B03-9A5B-82E218485942', 16, 6, 'forex', 0, 123, NULL, NULL),
(17, '7C74CA95-BD50-457F-984A-D5FBC572A07C', 17, 6, 'forex', 0, 123, NULL, NULL),
(18, '06AAC57A-40D9-40F4-9578-350B28D130EC', 18, 6, 'forex', 0, 123, NULL, NULL),
(19, '2E77308D-9220-477D-BBA0-DA8AAD889652', 19, 6, 'forex', 0, 123, NULL, NULL),
(20, '865038BC-695F-4A7A-9C9F-26E16E7848DB', 20, 6, 'forex', 0, 123, NULL, NULL),
(21, 'CAA26202-DCBF-43DB-B507-2E2F91BE856E', 21, 14, 'forex', 0, 123, NULL, NULL),
(22, 'CAA26202-DCBF-43DB-B507-2E2F91BE856E', 21, 15, 'forex', 0, 123, NULL, NULL),
(23, '1F060669-444C-4F0E-B55D-36E8E4259E06', 22, 22, 'forex', 0, 123, NULL, NULL),
(24, '1F060669-444C-4F0E-B55D-36E8E4259E06', 22, 23, 'forex', 0, 123, NULL, NULL),
(25, '8D5D1049-77BB-4DEE-BA41-CEC4F7E7E3D3', 23, 24, 'forex', 0, 123, NULL, NULL),
(26, '973C1F8D-CC79-4572-A090-31D82A3A8FC1', 24, 25, 'forex', 0, 123, NULL, NULL),
(27, '4B7DE934-A02B-4090-BF1C-A4FE41792533', 25, 26, 'forex', 0, 123, NULL, NULL),
(28, '093A6552-9A42-46BB-919A-AD00DC068781', 26, 26, 'forex', 0, 123, NULL, NULL),
(29, '093A6552-9A42-46BB-919A-AD00DC068781', 26, 27, 'forex', 0, 123, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pos_order_item_status`
--

CREATE TABLE `pos_order_item_status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A',
  `sequence` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_order_item_status`
--

INSERT INTO `pos_order_item_status` (`id`, `name`, `status`, `sequence`) VALUES
(1, 'processing', 'A', 1),
(2, 'completed', 'A', 2),
(3, 'cancelled', 'A', 3),
(4, 'expired', 'A', 4),
(5, 'in delivery', 'A', 5);

-- --------------------------------------------------------

--
-- Table structure for table `pos_order_methods`
--

CREATE TABLE `pos_order_methods` (
  `order_method_id` int(11) NOT NULL,
  `order_method_name` varchar(50) NOT NULL,
  `order_method_enable` enum('A','I') NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pos_order_shipping_address`
--

CREATE TABLE `pos_order_shipping_address` (
  `order_shipping_id` int(11) NOT NULL,
  `order_shipping_address_id` int(11) DEFAULT NULL,
  `order_shipping_first_name` varchar(255) DEFAULT NULL,
  `order_shipping_last_name` varchar(255) DEFAULT NULL,
  `order_shipping_postal_code` varchar(255) DEFAULT NULL,
  `order_shipping_building_name` varchar(255) DEFAULT NULL,
  `order_shipping_address` text,
  `order_shipping_floor` varchar(255) DEFAULT NULL,
  `order_shipping_unit` varchar(255) DEFAULT NULL,
  `order_shipping_company_name` varchar(255) DEFAULT NULL,
  `order_shipping_special_info` text,
  `order_shipping_order_id` varchar(255) DEFAULT NULL,
  `order_shipping_order_primary_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_order_shipping_address`
--

INSERT INTO `pos_order_shipping_address` (`order_shipping_id`, `order_shipping_address_id`, `order_shipping_first_name`, `order_shipping_last_name`, `order_shipping_postal_code`, `order_shipping_building_name`, `order_shipping_address`, `order_shipping_floor`, `order_shipping_unit`, `order_shipping_company_name`, `order_shipping_special_info`, `order_shipping_order_id`, `order_shipping_order_primary_id`) VALUES
(1, 1, 'Testing ', 'Shpping Name', '625001', 'building name', '', 'floor', '#12-13', NULL, 'Testing Order surrender it', '0E60C1DD-9AFF-4E7A-9D2F-6506CB560EF1', 1),
(2, 5, 'asd', 'asdsa', '510559', 'test', NULL, 'asd', '0', 'asdsad', 'asdsad', 'CBD50EBB-1E8E-41B4-AD9C-E4A66D358AD6', 13),
(3, 5, 'asd', 'asdsa', '510559', 'test', NULL, 'asd', '0', 'asdsad', 'asdsad', 'CEB4E18C-0671-49AB-A405-BB06C35DC564', 14),
(4, 5, 'asd', 'asdsa', '510559', 'test', NULL, 'asd', '0', 'asdsad', 'asdsad', 'C50AB269-4914-4ECA-A5B8-F6D5CA09C194', 15),
(5, 5, 'asd', 'asdsa', '510559', 'test', NULL, 'asd', '0', 'asdsad', 'asdsad', '7EDE0CFB-BC68-4B03-9A5B-82E218485942', 16),
(6, 5, 'asd', 'asdsa', '510559', 'test', NULL, 'asd', '0', 'asdsad', 'asdsad', '7C74CA95-BD50-457F-984A-D5FBC572A07C', 17),
(7, 5, 'asd', 'asdsa', '510559', 'test', NULL, 'asd', '0', 'asdsad', 'asdsad', '06AAC57A-40D9-40F4-9578-350B28D130EC', 18),
(8, 5, 'asd', 'asdsa', '510559', 'test', NULL, 'asd', '0', 'asdsad', 'asdsad', '2E77308D-9220-477D-BBA0-DA8AAD889652', 19),
(9, 5, 'asd', 'asdsa', '510559', 'test', NULL, 'asd', '0', 'asdsad', 'asdsad', '865038BC-695F-4A7A-9C9F-26E16E7848DB', 20),
(10, 5, 'asd', 'asdsa', '510559', 'test', NULL, 'asd', '0', 'asdsad', 'asdsad', 'CAA26202-DCBF-43DB-B507-2E2F91BE856E', 21),
(11, 5, 'asd', 'asdsa', '510559', 'test', NULL, 'asd', '0', 'asdsad', 'asdsad', '1F060669-444C-4F0E-B55D-36E8E4259E06', 22),
(12, 5, 'asd', 'asdsa', '510559', 'test', NULL, 'asd', '0', 'asdsad', 'asdsad', '8D5D1049-77BB-4DEE-BA41-CEC4F7E7E3D3', 23),
(13, 5, 'asd', 'asdsa', '510559', 'test', NULL, 'asd', '0', 'asdsad', 'asdsad', '973C1F8D-CC79-4572-A090-31D82A3A8FC1', 24),
(14, 5, 'asd', 'asdsa', '510559', 'test', NULL, 'asd', '0', 'asdsad', 'asdsad', '4B7DE934-A02B-4090-BF1C-A4FE41792533', 25),
(15, 5, 'asd', 'asdsa', '510559', 'test', NULL, 'asd', '0', 'asdsad', 'asdsad', '093A6552-9A42-46BB-919A-AD00DC068781', 26);

-- --------------------------------------------------------

--
-- Table structure for table `pos_order_status`
--

CREATE TABLE `pos_order_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(50) NOT NULL,
  `status_order` tinyint(4) DEFAULT NULL,
  `status_enabled` enum('A','I') NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pos_order_status`
--

INSERT INTO `pos_order_status` (`status_id`, `status_name`, `status_order`, `status_enabled`) VALUES
(1, 'Processing', 1, 'A'),
(2, 'Pending', 2, 'A'),
(3, 'Unsuccessful', 3, 'A'),
(4, 'Cancelled', 4, 'A'),
(5, 'Completed', 5, 'A'),
(6, 'Failed', 6, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `pos_products`
--

CREATE TABLE `pos_products` (
  `product_primary_id` bigint(20) NOT NULL COMMENT 'Product Primaru id',
  `product_id` varchar(155) DEFAULT NULL COMMENT 'product public  key',
  `product_parent_id` int(11) DEFAULT NULL,
  `product_type` enum('simple','attribute') DEFAULT 'simple',
  `product_customer_id` int(11) DEFAULT NULL,
  `product_category_id` varchar(155) DEFAULT NULL COMMENT 'Product category unique id',
  `product_subcategory_id` varchar(255) DEFAULT NULL,
  `product_name` varchar(150) DEFAULT NULL,
  `product_alias` varchar(255) DEFAULT NULL,
  `product_sku` varchar(100) DEFAULT NULL,
  `product_short_description` mediumtext,
  `product_long_description` mediumtext,
  `product_sequence` int(11) DEFAULT NULL,
  `product_thumbnail` varchar(100) DEFAULT NULL,
  `product_status` enum('A','I') DEFAULT 'A',
  `product_publish_status` enum('Yes','No') NOT NULL DEFAULT 'No',
  `product_slug` varchar(155) DEFAULT NULL,
  `product_condition` enum('new','used') DEFAULT 'new',
  `product_quantity` int(11) NOT NULL DEFAULT '0',
  `product_cost` decimal(10,2) DEFAULT NULL,
  `product_price` decimal(10,2) DEFAULT NULL,
  `product_alt_price` decimal(10,2) DEFAULT NULL,
  `product_special_price` decimal(10,2) DEFAULT NULL,
  `product_special_price_from_date` date DEFAULT NULL,
  `product_special_price_to_date` date DEFAULT NULL,
  `product_meta_title` varchar(255) DEFAULT NULL,
  `product_meta_keywords` varchar(255) DEFAULT NULL,
  `product_meta_description` varchar(255) DEFAULT NULL,
  `product_created_on` datetime DEFAULT NULL,
  `product_created_by` smallint(6) DEFAULT NULL,
  `product_created_ip` char(20) DEFAULT NULL,
  `product_updated_on` datetime DEFAULT NULL,
  `product_updated_by` int(11) DEFAULT NULL,
  `product_updated_ip` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pos_products`
--

INSERT INTO `pos_products` (`product_primary_id`, `product_id`, `product_parent_id`, `product_type`, `product_customer_id`, `product_category_id`, `product_subcategory_id`, `product_name`, `product_alias`, `product_sku`, `product_short_description`, `product_long_description`, `product_sequence`, `product_thumbnail`, `product_status`, `product_publish_status`, `product_slug`, `product_condition`, `product_quantity`, `product_cost`, `product_price`, `product_alt_price`, `product_special_price`, `product_special_price_from_date`, `product_special_price_to_date`, `product_meta_title`, `product_meta_keywords`, `product_meta_description`, `product_created_on`, `product_created_by`, `product_created_ip`, `product_updated_on`, `product_updated_by`, `product_updated_ip`) VALUES
(43, '0E60C1DD-9AFF-4E7A-9D2F-6506CB560EF1', NULL, 'attribute', 4, '7F177386-CC5D-438A-A768-F6516A611224', '66A12239-5E5E-463F-81C0-098F90C32613', 'Testing combo1', 'Testing combo1', 'Testing combo1', 'Testing combo1', 'Testing combo1', 1, 'f224d4f90208e109a4798e1f8ea09336.jpg', 'A', 'No', 'testing-combo1', 'new', 123, '0.00', '123.00', '0.00', '21.00', '2018-09-12', '2018-09-26', 'Testing combo1', 'Testing combo1', 'Testing combo1', '2018-09-01 13:10:54', 1, '::1', '2018-09-22 12:52:44', 4, '::1'),
(44, 'F8F95DE9-5A4C-4D26-95E1-9FFC49D364D0', 43, 'simple', 4, '7F177386-CC5D-438A-A768-F6516A611224', '66A12239-5E5E-463F-81C0-098F90C32613', 'Testing combo1 sub', '', 'Testing combo1 sub', 'Testing combo1', 'Testing combo1', NULL, NULL, 'A', 'No', 'testing-combo1-sub', 'new', 123, NULL, '123.00', NULL, '123.00', NULL, NULL, NULL, NULL, NULL, '2018-09-01 13:10:55', 1, '::1', '2018-09-22 12:52:45', 4, '::1'),
(45, '9764235C-BD7F-4DC4-8A6B-3630F9ED06FF', 43, 'simple', 4, '7F177386-CC5D-438A-A768-F6516A611224', '66A12239-5E5E-463F-81C0-098F90C32613', 'Testing combo2 sub', '', 'Testing combo2 sub', 'Testing combo1', 'Testing combo1', NULL, NULL, 'A', 'No', 'testing-combo2-sub', 'new', 1234, NULL, '1233.00', NULL, '1234.00', NULL, NULL, NULL, NULL, NULL, '2018-09-01 13:10:55', 1, '::1', '2018-09-22 12:52:45', 4, '::1'),
(73, '5BA6F980-05F0-464B-A1F7-3D02486B44B4', NULL, 'attribute', 4, '7F177386-CC5D-438A-A768-F6516A611224', '28A3AC4C-9229-4C87-847F-843A0FFE612B', 'test new from frontend', 'test new from frontend', 'test-new-frontend', 'test new from frontend', 'test new from frontend', 1, '731a4eef0ca0f80621ed6e860a5052e9.jpg', 'A', 'No', 'test-new-from-frontend', 'new', 123123, '0.00', '1000.00', '0.00', '0.00', '1970-01-01', '1970-01-01', 'test new from frontend', 'test new from frontend', 'test new from frontend', '2018-09-30 15:41:33', 4, '::1', '2018-09-30 15:45:15', 4, '::1'),
(74, 'AA10E5AE-0012-4AFB-8A1C-514E326FB329', 73, 'simple', 4, '7F177386-CC5D-438A-A768-F6516A611224', '28A3AC4C-9229-4C87-847F-843A0FFE612B', 'Test new sub11', '', 'test-new-sub11', 'test new from frontend', 'test new from frontend', NULL, NULL, 'A', 'No', 'test-new-sub11', 'new', 123016, NULL, '1235.00', NULL, '1223.00', NULL, NULL, NULL, NULL, NULL, '2018-09-30 15:41:33', 4, '::1', '2018-09-30 15:45:15', 4, '::1'),
(75, '96DDA57E-F8A1-4A9C-B852-4A50567643AD', 73, 'simple', 4, '7F177386-CC5D-438A-A768-F6516A611224', '28A3AC4C-9229-4C87-847F-843A0FFE612B', 'test new sub21', '', 'test-new-sub21', 'test new from frontend', 'test new from frontend', NULL, NULL, 'A', 'No', 'test-new-sub21', 'new', 111, NULL, '123.00', NULL, '123.00', NULL, NULL, NULL, NULL, NULL, '2018-09-30 15:41:33', 4, '::1', '2018-09-30 15:45:15', 4, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `pos_product_assigned_attributes`
--

CREATE TABLE `pos_product_assigned_attributes` (
  `prod_ass_att_id` int(11) NOT NULL,
  `prod_ass_att_parent_productid` int(11) NOT NULL,
  `prod_ass_att_product_id` int(11) NOT NULL,
  `prod_ass_att_attribute_id` varchar(255) DEFAULT NULL,
  `prod_ass_att_attribute_name` varchar(255) DEFAULT NULL,
  `prod_ass_att_attribute_value_id` varchar(255) DEFAULT NULL,
  `prod_ass_att_attribute_value_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_product_assigned_attributes`
--

INSERT INTO `pos_product_assigned_attributes` (`prod_ass_att_id`, `prod_ass_att_parent_productid`, `prod_ass_att_product_id`, `prod_ass_att_attribute_id`, `prod_ass_att_attribute_name`, `prod_ass_att_attribute_value_id`, `prod_ass_att_attribute_value_name`) VALUES
(36, 40, 40, '8', '', '9778B7D5-2ABD-49BF-8EC3-6039A12F3588', ''),
(37, 40, 40, '8', '', 'BCADD08A-2FEB-4598-960C-A4291DE31C4D', ''),
(38, 37, 37, '8', '', '9778B7D5-2ABD-49BF-8EC3-6039A12F3588', ''),
(39, 37, 37, '8', '', 'BCADD08A-2FEB-4598-960C-A4291DE31C4D', ''),
(52, 43, 44, '8', '', '9778B7D5-2ABD-49BF-8EC3-6039A12F3588', ''),
(53, 43, 45, '8', '', 'BCADD08A-2FEB-4598-960C-A4291DE31C4D', ''),
(60, 73, 74, '08B910B2-4276-49E9-8310-AB4832A1D228', '', 'A77DF41E-072D-49EB-B0E1-6A2908703833', ''),
(61, 73, 75, '08B910B2-4276-49E9-8310-AB4832A1D228', '', 'BCADD08A-2FEB-4598-960C-A4291DE31C4D', '');

-- --------------------------------------------------------

--
-- Table structure for table `pos_product_assigned_modifiers`
--

CREATE TABLE `pos_product_assigned_modifiers` (
  `assigned_mod_primary_id` int(11) NOT NULL,
  `assigned_mod_product_id` int(11) DEFAULT NULL,
  `assigned_mod_modifier_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_product_assigned_modifiers`
--

INSERT INTO `pos_product_assigned_modifiers` (`assigned_mod_primary_id`, `assigned_mod_product_id`, `assigned_mod_modifier_id`) VALUES
(20, 37, '08B910B2-4276-49E9-8310-AB4832A1D228'),
(21, 40, '08B910B2-4276-49E9-8310-AB4832A1D228'),
(22, 40, '08B910B2-4276-49E9-8310-AB4832A1D228'),
(23, 37, '08B910B2-4276-49E9-8310-AB4832A1D228'),
(24, 43, '08B910B2-4276-49E9-8310-AB4832A1D228'),
(25, 43, '08B910B2-4276-49E9-8310-AB4832A1D228'),
(26, 43, '08B910B2-4276-49E9-8310-AB4832A1D228'),
(27, 43, '08B910B2-4276-49E9-8310-AB4832A1D228'),
(28, 43, '08B910B2-4276-49E9-8310-AB4832A1D228'),
(29, 43, '08B910B2-4276-49E9-8310-AB4832A1D228'),
(30, 43, '08B910B2-4276-49E9-8310-AB4832A1D228'),
(31, 61, '08B910B2-4276-49E9-8310-AB4832A1D228'),
(32, 64, '08B910B2-4276-49E9-8310-AB4832A1D228'),
(33, 67, '08B910B2-4276-49E9-8310-AB4832A1D228'),
(34, 73, '08B910B2-4276-49E9-8310-AB4832A1D228'),
(35, 73, '08B910B2-4276-49E9-8310-AB4832A1D228'),
(36, 73, '08B910B2-4276-49E9-8310-AB4832A1D228'),
(37, 73, '08B910B2-4276-49E9-8310-AB4832A1D228'),
(38, 73, '08B910B2-4276-49E9-8310-AB4832A1D228'),
(39, 73, '08B910B2-4276-49E9-8310-AB4832A1D228');

-- --------------------------------------------------------

--
-- Table structure for table `pos_product_assigned_shipping_methods`
--

CREATE TABLE `pos_product_assigned_shipping_methods` (
  `prod_ass_ship_method_id` int(11) NOT NULL,
  `prod_ass_ship_method_shipid` int(11) DEFAULT NULL,
  `prod_ass_ship_method_prodid` int(11) DEFAULT NULL,
  `prod_ass_ship_method_price` double DEFAULT NULL,
  `prod_ass_ship_method_is_combined` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_product_assigned_shipping_methods`
--

INSERT INTO `pos_product_assigned_shipping_methods` (`prod_ass_ship_method_id`, `prod_ass_ship_method_shipid`, `prod_ass_ship_method_prodid`, `prod_ass_ship_method_price`, `prod_ass_ship_method_is_combined`) VALUES
(15, 1, 26, 123, 1),
(16, 1, 26, 321, 0),
(17, 1, 26, 123, 0),
(28, 1, 32, 123, 1),
(29, 1, 32, 214, 0),
(33, 1, 40, 123, 1),
(34, 1, 37, 123, 1),
(35, 1, 37, 11, 0),
(45, 1, 43, 123, 1),
(46, 1, 50, 12, 0),
(47, 1, 61, 12, 0),
(48, 1, 64, 12, 0),
(49, 1, 67, 12, 0),
(55, 1, 73, 123, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pos_product_assigned_tags`
--

CREATE TABLE `pos_product_assigned_tags` (
  `tag_id` varchar(155) DEFAULT NULL COMMENT 'group unique id ',
  `tag_product_primary_id` varchar(155) DEFAULT NULL COMMENT 'product primary id',
  `tag_product_id` varchar(100) DEFAULT NULL COMMENT 'product uniqueid',
  `tag_updated_on` datetime DEFAULT NULL,
  `tag_updated_by` int(11) DEFAULT NULL,
  `tag_updated_ip` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pos_product_associate_products`
--

CREATE TABLE `pos_product_associate_products` (
  `prod_ass_id` int(11) NOT NULL,
  `prod_ass_product_id` int(11) NOT NULL,
  `prod_ass_sub_product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_product_associate_products`
--

INSERT INTO `pos_product_associate_products` (`prod_ass_id`, `prod_ass_product_id`, `prod_ass_sub_product_id`) VALUES
(32, 40, 40),
(33, 40, 40),
(34, 37, 37),
(35, 37, 37),
(48, 43, 44),
(49, 43, 45),
(50, 61, 62),
(51, 61, 63),
(52, 64, 65),
(53, 64, 66),
(54, 67, 68),
(55, 67, 69),
(66, 73, 74),
(67, 73, 75);

-- --------------------------------------------------------

--
-- Table structure for table `pos_product_categories`
--

CREATE TABLE `pos_product_categories` (
  `pro_cate_primary_id` bigint(20) NOT NULL COMMENT 'Primary Key',
  `pro_cate_id` varchar(155) DEFAULT NULL COMMENT 'Unique id for Public',
  `pro_cate_name` varchar(155) DEFAULT NULL,
  `pro_cate_sequence` int(11) DEFAULT NULL,
  `pro_cate_short_description` varchar(255) DEFAULT NULL,
  `pro_cate_description` mediumtext,
  `pro_cate_image` varchar(100) DEFAULT NULL,
  `pro_cate_status` enum('A','I') DEFAULT NULL,
  `pro_cate_slug` varchar(155) DEFAULT NULL,
  `pro_cate_created_on` datetime DEFAULT NULL,
  `pro_cate_created_by` smallint(6) DEFAULT NULL,
  `pro_cate_created_ip` char(20) DEFAULT NULL,
  `pro_cate_updated_on` datetime DEFAULT NULL,
  `pro_cate_updated_by` smallint(6) DEFAULT NULL,
  `pro_cate_updated_ip` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pos_product_categories`
--

INSERT INTO `pos_product_categories` (`pro_cate_primary_id`, `pro_cate_id`, `pro_cate_name`, `pro_cate_sequence`, `pro_cate_short_description`, `pro_cate_description`, `pro_cate_image`, `pro_cate_status`, `pro_cate_slug`, `pro_cate_created_on`, `pro_cate_created_by`, `pro_cate_created_ip`, `pro_cate_updated_on`, `pro_cate_updated_by`, `pro_cate_updated_ip`) VALUES
(11, '7F177386-CC5D-438A-A768-F6516A611224', 'Fashion', 1, 'Fashion', 'Fashion', '', 'A', 'fashion', '2018-07-22 19:09:54', 1, '::1', NULL, NULL, NULL),
(12, 'E1881D81-00F1-47CB-A672-4C305D442ACA', 'Electronics', 2, 'Electronics', 'Electronics', '', 'A', 'electronics', '2018-07-22 19:33:07', 1, '::1', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pos_product_gallery`
--

CREATE TABLE `pos_product_gallery` (
  `pro_gallery_primary_id` bigint(20) NOT NULL,
  `pro_gallery_image` varchar(155) DEFAULT NULL,
  `pro_gallery_default_image` enum('Yes','No') DEFAULT 'No',
  `pro_gallery_product_primary_id` int(11) DEFAULT NULL,
  `pro_gallery_product_id` varchar(155) DEFAULT NULL,
  `pro_gallery_updated_on` datetime DEFAULT NULL,
  `pro_gallery_updated_by` smallint(6) DEFAULT NULL,
  `pro_gallery_updated_ip` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pos_product_gallery`
--

INSERT INTO `pos_product_gallery` (`pro_gallery_primary_id`, `pro_gallery_image`, `pro_gallery_default_image`, `pro_gallery_product_primary_id`, `pro_gallery_product_id`, `pro_gallery_updated_on`, `pro_gallery_updated_by`, `pro_gallery_updated_ip`) VALUES
(1, '', 'No', 67, '488B0E59-CD50-4D2C-ABFE-4AC7CEBAE5B0', '2018-09-30 15:29:08', 4, '::1'),
(2, '', 'No', 73, '5BA6F980-05F0-464B-A1F7-3D02486B44B4', '2018-09-30 15:41:34', 4, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `pos_product_modifiers`
--

CREATE TABLE `pos_product_modifiers` (
  `pro_modifier_primary_id` bigint(20) NOT NULL COMMENT 'Primary Key',
  `pro_modifier_category_id` varchar(255) DEFAULT NULL,
  `pro_modifier_id` varchar(155) DEFAULT NULL COMMENT 'Unique id for Public',
  `pro_modifier_name` varchar(155) DEFAULT NULL,
  `pro_modifier_sequence` int(11) DEFAULT NULL,
  `pro_modifier_short_description` varchar(255) DEFAULT NULL,
  `pro_modifier_description` mediumtext,
  `pro_modifier_max_select` smallint(6) NOT NULL DEFAULT '1',
  `pro_modifier_min_select` smallint(6) NOT NULL DEFAULT '1',
  `pro_modifier_image` varchar(100) DEFAULT NULL,
  `pro_modifier_display` enum('image','text') NOT NULL DEFAULT 'text',
  `pro_modifier_status` enum('A','I') DEFAULT NULL,
  `pro_modifier_created_on` datetime DEFAULT NULL,
  `pro_modifier_created_by` smallint(6) DEFAULT NULL,
  `pro_modifier_created_ip` char(20) DEFAULT NULL,
  `pro_modifier_updated_on` datetime DEFAULT NULL,
  `pro_modifier_updated_by` smallint(6) DEFAULT NULL,
  `pro_modifier_updated_ip` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pos_product_modifiers`
--

INSERT INTO `pos_product_modifiers` (`pro_modifier_primary_id`, `pro_modifier_category_id`, `pro_modifier_id`, `pro_modifier_name`, `pro_modifier_sequence`, `pro_modifier_short_description`, `pro_modifier_description`, `pro_modifier_max_select`, `pro_modifier_min_select`, `pro_modifier_image`, `pro_modifier_display`, `pro_modifier_status`, `pro_modifier_created_on`, `pro_modifier_created_by`, `pro_modifier_created_ip`, `pro_modifier_updated_on`, `pro_modifier_updated_by`, `pro_modifier_updated_ip`) VALUES
(1, '7F177386-CC5D-438A-A768-F6516A611224', '08B910B2-4276-49E9-8310-AB4832A1D228', 'test', 1, NULL, NULL, 1, 1, NULL, 'text', 'A', '2018-07-24 00:56:35', 1, '::1', '2018-07-28 22:06:31', 1, '::1'),
(2, 'E1881D81-00F1-47CB-A672-4C305D442ACA', '5858B0AD-E715-4655-BD9C-99CCA059B9F7', 'test', 2, NULL, NULL, 1, 1, NULL, 'text', 'A', '2018-07-28 14:43:22', 1, '::1', '2018-07-28 22:06:23', 1, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `pos_product_modifier_values`
--

CREATE TABLE `pos_product_modifier_values` (
  `pro_modifier_value_primary_id` bigint(20) NOT NULL COMMENT 'subcategory primary key',
  `pro_modifier_value_id` varchar(155) DEFAULT NULL COMMENT 'uniquecategory unique public id',
  `pro_modifier_value_modifier_primary_id` int(11) DEFAULT NULL COMMENT 'modifier primary key',
  `pro_modifier_value_modifier_id` varchar(100) DEFAULT NULL COMMENT 'modifier unique public id',
  `pro_modifier_value_name` varchar(155) DEFAULT NULL,
  `pro_modifier_value_price` decimal(10,2) DEFAULT NULL,
  `pro_modifier_value_sequence` int(11) DEFAULT NULL,
  `pro_modifier_value_short_description` varchar(255) DEFAULT NULL,
  `pro_modifier_value_description` mediumtext,
  `pro_modifier_value_image` varchar(100) DEFAULT NULL,
  `pro_modifier_value_status` enum('A','I') DEFAULT NULL,
  `pro_modifier_value_is_default` enum('Yes','No') DEFAULT 'No',
  `pro_modifier_value_source` enum('Manual','Revel') NOT NULL DEFAULT 'Manual',
  `pro_modifier_value_created_on` datetime DEFAULT NULL,
  `pro_modifier_value_created_by` smallint(6) DEFAULT NULL,
  `pro_modifier_value_created_ip` char(20) DEFAULT NULL,
  `pro_modifier_value_updated_on` datetime DEFAULT NULL,
  `pro_modifier_value_updated_by` smallint(6) DEFAULT NULL,
  `pro_modifier_value_updated_ip` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pos_product_modifier_values`
--

INSERT INTO `pos_product_modifier_values` (`pro_modifier_value_primary_id`, `pro_modifier_value_id`, `pro_modifier_value_modifier_primary_id`, `pro_modifier_value_modifier_id`, `pro_modifier_value_name`, `pro_modifier_value_price`, `pro_modifier_value_sequence`, `pro_modifier_value_short_description`, `pro_modifier_value_description`, `pro_modifier_value_image`, `pro_modifier_value_status`, `pro_modifier_value_is_default`, `pro_modifier_value_source`, `pro_modifier_value_created_on`, `pro_modifier_value_created_by`, `pro_modifier_value_created_ip`, `pro_modifier_value_updated_on`, `pro_modifier_value_updated_by`, `pro_modifier_value_updated_ip`) VALUES
(1, '9778B7D5-2ABD-49BF-8EC3-6039A12F3588', 1, '08B910B2-4276-49E9-8310-AB4832A1D228', 'testing valuess', '1.00', 1, NULL, NULL, '', 'A', 'No', 'Manual', '2018-07-24 01:30:53', 1, '::1', '2018-07-24 01:35:27', 1, '::1'),
(2, 'BCADD08A-2FEB-4598-960C-A4291DE31C4D', 1, '08B910B2-4276-49E9-8310-AB4832A1D228', 'testingvalue21', '8.00', 2, NULL, NULL, 'b0e51ac7121eafad9a9cc29d193e646a.jpg', 'A', 'No', 'Manual', '2018-08-13 01:41:12', 1, '::1', '2018-08-13 01:43:36', 1, '::1'),
(3, 'A77DF41E-072D-49EB-B0E1-6A2908703833', 1, '08B910B2-4276-49E9-8310-AB4832A1D228', 'testingvalue22', '8.00', 3, NULL, NULL, '2edbf094e0bf020dd6febf66a05ce76a.jpg', 'A', 'No', 'Manual', '2018-08-13 01:43:21', 1, '::1', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pos_product_subcategories`
--

CREATE TABLE `pos_product_subcategories` (
  `pro_subcate_primary_id` bigint(20) NOT NULL COMMENT 'subcategory primary key',
  `pro_subcate_id` varchar(155) DEFAULT NULL COMMENT 'uniquecategory unique public id',
  `pro_subcate_category_primary_id` int(11) DEFAULT NULL COMMENT 'category primary key',
  `pro_subcate_category_id` varchar(155) DEFAULT NULL COMMENT 'category unique public id',
  `pro_subcate_name` varchar(155) DEFAULT NULL,
  `pro_subcate_sequence` int(11) DEFAULT NULL,
  `pro_subcate_short_description` varchar(255) DEFAULT NULL,
  `pro_subcate_description` mediumtext,
  `pro_subcate_image` varchar(100) DEFAULT NULL,
  `pro_subcate_active_image` varchar(255) DEFAULT NULL,
  `pro_subcate_default_image` varchar(255) DEFAULT NULL,
  `pro_subcate_status` enum('A','I') DEFAULT NULL,
  `pro_subcate_slug` varchar(155) DEFAULT NULL,
  `pro_subcate_created_on` datetime DEFAULT NULL,
  `pro_subcate_created_by` smallint(6) DEFAULT NULL,
  `pro_subcate_created_ip` char(20) DEFAULT NULL,
  `pro_subcate_updated_on` datetime DEFAULT NULL,
  `pro_subcate_updated_by` smallint(6) DEFAULT NULL,
  `pro_subcate_updated_ip` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pos_product_subcategories`
--

INSERT INTO `pos_product_subcategories` (`pro_subcate_primary_id`, `pro_subcate_id`, `pro_subcate_category_primary_id`, `pro_subcate_category_id`, `pro_subcate_name`, `pro_subcate_sequence`, `pro_subcate_short_description`, `pro_subcate_description`, `pro_subcate_image`, `pro_subcate_active_image`, `pro_subcate_default_image`, `pro_subcate_status`, `pro_subcate_slug`, `pro_subcate_created_on`, `pro_subcate_created_by`, `pro_subcate_created_ip`, `pro_subcate_updated_on`, `pro_subcate_updated_by`, `pro_subcate_updated_ip`) VALUES
(3, '28A3AC4C-9229-4C87-847F-843A0FFE612B', 11, NULL, 'Women - clothing', 2, 'Women - clothing', 'Women - clothing', '', NULL, NULL, 'A', 'women-clothing', '2018-07-22 19:30:41', 1, '::1', NULL, NULL, NULL),
(4, '66A12239-5E5E-463F-81C0-098F90C32613', 11, NULL, 'Men - clothing', 1, 'Men - clothing', 'Men - clothing', '', NULL, NULL, 'A', 'men-clothing', '2018-07-22 19:31:10', 1, '::1', '2018-07-22 19:59:00', 1, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `pos_product_tags`
--

CREATE TABLE `pos_product_tags` (
  `pro_tag_primary_id` bigint(20) NOT NULL COMMENT 'Primary Key',
  `pro_tag_id` varchar(155) DEFAULT NULL COMMENT 'Unique id for Public',
  `pro_tag_name` varchar(155) DEFAULT NULL,
  `pro_tag_image` varchar(100) NOT NULL,
  `pro_tag_status` enum('A','I') DEFAULT NULL,
  `pro_tag_created_on` datetime DEFAULT NULL,
  `pro_tag_created_by` smallint(6) DEFAULT NULL,
  `pro_tag_created_ip` char(20) DEFAULT NULL,
  `pro_tag_updated_on` datetime DEFAULT NULL,
  `pro_tag_updated_by` smallint(6) DEFAULT NULL,
  `pro_tag_updated_ip` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pos_shipping_address`
--

CREATE TABLE `pos_shipping_address` (
  `address_id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT '0',
  `building_name` varchar(255) DEFAULT NULL,
  `floor` varchar(255) DEFAULT NULL,
  `unit` int(10) DEFAULT NULL,
  `address` text,
  `company_name` varchar(255) DEFAULT NULL,
  `special_info` text,
  `is_default` int(1) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  `created_ip` varchar(50) DEFAULT NULL,
  `updated_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_ip` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_shipping_address`
--

INSERT INTO `pos_shipping_address` (`address_id`, `userid`, `first_name`, `last_name`, `postal_code`, `building_name`, `floor`, `unit`, `address`, `company_name`, `special_info`, `is_default`, `created_by`, `created_on`, `created_ip`, `updated_on`, `updated_ip`) VALUES
(5, 4, 'asd', 'asdsa', '510559', 'test', 'asd', 0, NULL, 'asdsad', 'asdsad', 1, 4, '2018-10-10 00:34:12', '::1', '2018-10-09 16:34:12', NULL),
(9, 4, 'asdasd', 'asdsad', '510559', 'asdasd', 'asda', 0, NULL, 'asdasd', 'asdsad', 0, 4, '2018-10-10 00:44:19', '::1', '2018-10-09 16:44:19', NULL),
(10, 4, 'asdasd', 'asdsad', '510559', 'asdasd', 'asda', 0, NULL, 'asdasd', 'asdsad', 0, 4, '2018-10-11 00:12:04', '::1', '2018-10-09 16:44:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pos_shipping_methods`
--

CREATE TABLE `pos_shipping_methods` (
  `ship_method_id` int(11) NOT NULL,
  `ship_method_name` varchar(255) DEFAULT NULL,
  `ship_method_status` enum('A','I') NOT NULL DEFAULT 'I',
  `ship_method_created_on` datetime DEFAULT NULL,
  `ship_method_created_by` int(11) DEFAULT NULL,
  `ship_method_created_ip` varchar(255) DEFAULT NULL,
  `ship_method_updated_on` datetime DEFAULT NULL,
  `ship_method_updated_by` int(11) DEFAULT NULL,
  `ship_method_updated_ip` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_shipping_methods`
--

INSERT INTO `pos_shipping_methods` (`ship_method_id`, `ship_method_name`, `ship_method_status`, `ship_method_created_on`, `ship_method_created_by`, `ship_method_created_ip`, `ship_method_updated_on`, `ship_method_updated_by`, `ship_method_updated_ip`) VALUES
(1, 'forex', 'A', '2018-08-05 18:19:38', 1, '::1', '2018-08-05 18:21:27', 1, '::1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pos_cart_attributes`
--
ALTER TABLE `pos_cart_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cartidindex` (`cartid`),
  ADD KEY `cartitemidindex` (`itemid`);

--
-- Indexes for table `pos_cart_details`
--
ALTER TABLE `pos_cart_details`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `cart_id` (`cart_customer_id`,`cart_session_id`);

--
-- Indexes for table `pos_cart_items`
--
ALTER TABLE `pos_cart_items`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD KEY `cart_item_cart_primary_id` (`cart_item_cart_id`),
  ADD KEY `cart_item_customer_id` (`cart_item_customer_id`,`cart_item_session_id`);

--
-- Indexes for table `pos_cart_item_shipping`
--
ALTER TABLE `pos_cart_item_shipping`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipping cart id` (`cartid`);

--
-- Indexes for table `pos_orders`
--
ALTER TABLE `pos_orders`
  ADD PRIMARY KEY (`order_primary_id`),
  ADD KEY `order_id` (`order_id`,`order_date`,`order_status`),
  ADD KEY `order_company_id` (`order_customer_id`),
  ADD KEY `order_source` (`order_source`),
  ADD KEY `order_discount_applied` (`order_discount_applied`),
  ADD KEY `order_cancel_date` (`order_cancel_date`),
  ADD KEY `order_local_no` (`order_local_no`);

--
-- Indexes for table `pos_orders_customer_details`
--
ALTER TABLE `pos_orders_customer_details`
  ADD PRIMARY KEY (`order_customer_primary_key`),
  ADD KEY `order_customer_id` (`order_customer_id`,`order_customer_email`,`order_customer_mobile_no`,`order_customer_country`),
  ADD KEY `order_customer_postal_code` (`order_customer_postal_code`),
  ADD KEY `order_customer_order_id` (`order_customer_order_id`),
  ADD KEY `order_customer_address_id` (`order_customer_address_id`),
  ADD KEY `order_customer_unit_no1` (`order_customer_unit_no1`,`order_customer_unit_no2`),
  ADD KEY `order_customer_order_primary_id` (`order_customer_order_primary_id`),
  ADD KEY `order_customer_email` (`order_customer_email`),
  ADD KEY `order_customer_mobile_no` (`order_customer_mobile_no`);

--
-- Indexes for table `pos_order_items`
--
ALTER TABLE `pos_order_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `item_id` (`item_id`,`item_order_id`,`item_product_id`),
  ADD KEY `item_order_primary_id` (`item_order_primary_id`);

--
-- Indexes for table `pos_order_item_modifiers`
--
ALTER TABLE `pos_order_item_modifiers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_order_item_shipping`
--
ALTER TABLE `pos_order_item_shipping`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipping order primary id` (`shipping_order_primary_id`),
  ADD KEY `shipping order guid` (`shipping_orderid`);

--
-- Indexes for table `pos_order_item_status`
--
ALTER TABLE `pos_order_item_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_order_methods`
--
ALTER TABLE `pos_order_methods`
  ADD PRIMARY KEY (`order_method_id`),
  ADD KEY `status_name` (`order_method_name`),
  ADD KEY `status_enabled` (`order_method_enable`);

--
-- Indexes for table `pos_order_shipping_address`
--
ALTER TABLE `pos_order_shipping_address`
  ADD PRIMARY KEY (`order_shipping_id`);

--
-- Indexes for table `pos_order_status`
--
ALTER TABLE `pos_order_status`
  ADD PRIMARY KEY (`status_id`),
  ADD KEY `status_name` (`status_name`),
  ADD KEY `status_enabled` (`status_enabled`);

--
-- Indexes for table `pos_products`
--
ALTER TABLE `pos_products`
  ADD PRIMARY KEY (`product_primary_id`),
  ADD KEY `product_id` (`product_id`,`product_category_id`,`product_name`),
  ADD KEY `product_slug` (`product_slug`),
  ADD KEY `product_sku` (`product_sku`),
  ADD KEY `product_special_price` (`product_special_price`,`product_special_price_from_date`,`product_special_price_to_date`),
  ADD KEY `product_type` (`product_type`),
  ADD KEY `product_publish_status` (`product_publish_status`);

--
-- Indexes for table `pos_product_assigned_attributes`
--
ALTER TABLE `pos_product_assigned_attributes`
  ADD PRIMARY KEY (`prod_ass_att_id`),
  ADD KEY `product assigned attribute product id` (`prod_ass_att_product_id`),
  ADD KEY `product assigned attribute attribute id` (`prod_ass_att_attribute_id`),
  ADD KEY `product assigned attribute attribute value id` (`prod_ass_att_attribute_value_id`),
  ADD KEY `prod_ass_att_parent_productid` (`prod_ass_att_parent_productid`);

--
-- Indexes for table `pos_product_assigned_modifiers`
--
ALTER TABLE `pos_product_assigned_modifiers`
  ADD PRIMARY KEY (`assigned_mod_primary_id`);

--
-- Indexes for table `pos_product_assigned_shipping_methods`
--
ALTER TABLE `pos_product_assigned_shipping_methods`
  ADD PRIMARY KEY (`prod_ass_ship_method_id`),
  ADD KEY `product_assigned_shipping` (`prod_ass_ship_method_shipid`),
  ADD KEY `product_assigned_shipping_product` (`prod_ass_ship_method_prodid`);

--
-- Indexes for table `pos_product_assigned_tags`
--
ALTER TABLE `pos_product_assigned_tags`
  ADD KEY `pag_group_id` (`tag_id`),
  ADD KEY `pag_product_primary_id` (`tag_product_primary_id`),
  ADD KEY `pag_product_id` (`tag_product_id`);

--
-- Indexes for table `pos_product_associate_products`
--
ALTER TABLE `pos_product_associate_products`
  ADD PRIMARY KEY (`prod_ass_id`),
  ADD KEY `product associate parent` (`prod_ass_product_id`),
  ADD KEY `product associate sub product` (`prod_ass_sub_product_id`);

--
-- Indexes for table `pos_product_categories`
--
ALTER TABLE `pos_product_categories`
  ADD PRIMARY KEY (`pro_cate_primary_id`),
  ADD KEY `pro_cate_id` (`pro_cate_id`,`pro_cate_name`,`pro_cate_sequence`,`pro_cate_status`);

--
-- Indexes for table `pos_product_gallery`
--
ALTER TABLE `pos_product_gallery`
  ADD PRIMARY KEY (`pro_gallery_primary_id`),
  ADD KEY `pro_gallery_image` (`pro_gallery_image`,`pro_gallery_product_primary_id`,`pro_gallery_product_id`),
  ADD KEY `pro_gallery_default_image` (`pro_gallery_default_image`);

--
-- Indexes for table `pos_product_modifiers`
--
ALTER TABLE `pos_product_modifiers`
  ADD PRIMARY KEY (`pro_modifier_primary_id`),
  ADD KEY `pro_cate_id` (`pro_modifier_id`,`pro_modifier_name`,`pro_modifier_sequence`,`pro_modifier_status`);

--
-- Indexes for table `pos_product_modifier_values`
--
ALTER TABLE `pos_product_modifier_values`
  ADD PRIMARY KEY (`pro_modifier_value_primary_id`),
  ADD KEY `pro_subcate_id` (`pro_modifier_value_id`,`pro_modifier_value_name`,`pro_modifier_value_sequence`,`pro_modifier_value_status`),
  ADD KEY `pro_subcate_category_primary_id` (`pro_modifier_value_modifier_primary_id`),
  ADD KEY `pro_subcate_category_id` (`pro_modifier_value_modifier_id`),
  ADD KEY `pro_modifier_value_price` (`pro_modifier_value_price`),
  ADD KEY `pro_modifier_value_source` (`pro_modifier_value_source`),
  ADD KEY `pro_modifier_value_is_default` (`pro_modifier_value_is_default`);

--
-- Indexes for table `pos_product_subcategories`
--
ALTER TABLE `pos_product_subcategories`
  ADD PRIMARY KEY (`pro_subcate_primary_id`),
  ADD KEY `pro_subcate_id` (`pro_subcate_id`,`pro_subcate_name`,`pro_subcate_sequence`,`pro_subcate_status`),
  ADD KEY `pro_subcate_category_primary_id` (`pro_subcate_category_primary_id`),
  ADD KEY `pro_subcate_category_id` (`pro_subcate_category_id`);

--
-- Indexes for table `pos_product_tags`
--
ALTER TABLE `pos_product_tags`
  ADD PRIMARY KEY (`pro_tag_primary_id`),
  ADD KEY `pro_tag_id` (`pro_tag_id`),
  ADD KEY `pro_tag_name` (`pro_tag_name`);

--
-- Indexes for table `pos_shipping_address`
--
ALTER TABLE `pos_shipping_address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `pos_shipping_methods`
--
ALTER TABLE `pos_shipping_methods`
  ADD PRIMARY KEY (`ship_method_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pos_cart_attributes`
--
ALTER TABLE `pos_cart_attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `pos_cart_details`
--
ALTER TABLE `pos_cart_details`
  MODIFY `cart_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pos_cart_items`
--
ALTER TABLE `pos_cart_items`
  MODIFY `cart_item_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `pos_cart_item_shipping`
--
ALTER TABLE `pos_cart_item_shipping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `pos_orders`
--
ALTER TABLE `pos_orders`
  MODIFY `order_primary_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `pos_orders_customer_details`
--
ALTER TABLE `pos_orders_customer_details`
  MODIFY `order_customer_primary_key` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `pos_order_items`
--
ALTER TABLE `pos_order_items`
  MODIFY `item_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `pos_order_item_modifiers`
--
ALTER TABLE `pos_order_item_modifiers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pos_order_item_shipping`
--
ALTER TABLE `pos_order_item_shipping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `pos_order_item_status`
--
ALTER TABLE `pos_order_item_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pos_order_methods`
--
ALTER TABLE `pos_order_methods`
  MODIFY `order_method_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_order_shipping_address`
--
ALTER TABLE `pos_order_shipping_address`
  MODIFY `order_shipping_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pos_order_status`
--
ALTER TABLE `pos_order_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pos_products`
--
ALTER TABLE `pos_products`
  MODIFY `product_primary_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Product Primaru id', AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `pos_product_assigned_attributes`
--
ALTER TABLE `pos_product_assigned_attributes`
  MODIFY `prod_ass_att_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `pos_product_assigned_modifiers`
--
ALTER TABLE `pos_product_assigned_modifiers`
  MODIFY `assigned_mod_primary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `pos_product_assigned_shipping_methods`
--
ALTER TABLE `pos_product_assigned_shipping_methods`
  MODIFY `prod_ass_ship_method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `pos_product_associate_products`
--
ALTER TABLE `pos_product_associate_products`
  MODIFY `prod_ass_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `pos_product_categories`
--
ALTER TABLE `pos_product_categories`
  MODIFY `pro_cate_primary_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pos_product_gallery`
--
ALTER TABLE `pos_product_gallery`
  MODIFY `pro_gallery_primary_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pos_product_modifiers`
--
ALTER TABLE `pos_product_modifiers`
  MODIFY `pro_modifier_primary_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pos_product_modifier_values`
--
ALTER TABLE `pos_product_modifier_values`
  MODIFY `pro_modifier_value_primary_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'subcategory primary key', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pos_product_subcategories`
--
ALTER TABLE `pos_product_subcategories`
  MODIFY `pro_subcate_primary_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'subcategory primary key', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pos_product_tags`
--
ALTER TABLE `pos_product_tags`
  MODIFY `pro_tag_primary_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT for table `pos_shipping_address`
--
ALTER TABLE `pos_shipping_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pos_shipping_methods`
--
ALTER TABLE `pos_shipping_methods`
  MODIFY `ship_method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pos_cart_attributes`
--
ALTER TABLE `pos_cart_attributes`
  ADD CONSTRAINT `pos_cart_attributes_ibfk_1` FOREIGN KEY (`itemid`) REFERENCES `pos_cart_items` (`cart_item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pos_cart_item_shipping`
--
ALTER TABLE `pos_cart_item_shipping`
  ADD CONSTRAINT `pos_cart_item_shipping_ibfk_1` FOREIGN KEY (`cartid`) REFERENCES `pos_cart_details` (`cart_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
