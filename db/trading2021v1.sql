-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2021 at 11:42 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trading2021v1`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_buy`
--

CREATE TABLE `tb_buy` (
  `buy_id` int(11) NOT NULL,
  `buy_code` int(11) NOT NULL,
  `buy_date` datetime NOT NULL,
  `sup_id` int(11) NOT NULL,
  `st_id` int(11) NOT NULL,
  `total` float NOT NULL,
  `total_dc` float NOT NULL,
  `buy_note` varchar(200) NOT NULL,
  `is_paid` varchar(1) NOT NULL,
  `is_cancel` varchar(1) NOT NULL,
  `us_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_buy`
--

INSERT INTO `tb_buy` (`buy_id`, `buy_code`, `buy_date`, `sup_id`, `st_id`, `total`, `total_dc`, `buy_note`, `is_paid`, `is_cancel`, `us_id`) VALUES
(82, 2021000001, '2021-09-17 14:15:46', 7, 1, 20000, 0, '', 'n', 'n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_buy_detail`
--

CREATE TABLE `tb_buy_detail` (
  `buy_id` int(11) NOT NULL,
  `buy_code` int(11) NOT NULL,
  `pro_id` varchar(20) NOT NULL,
  `qty` float NOT NULL,
  `buy_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_buy_detail`
--

INSERT INTO `tb_buy_detail` (`buy_id`, `buy_code`, `pro_id`, `qty`, `buy_price`) VALUES
(101, 2021000001, '53', 10, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_com`
--

CREATE TABLE `tb_com` (
  `com_id` int(11) NOT NULL,
  `com_name` varchar(200) NOT NULL,
  `com_phone` varchar(200) NOT NULL,
  `com_address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_cus`
--

CREATE TABLE `tb_cus` (
  `cus_id` int(11) NOT NULL,
  `cus_name` varchar(100) NOT NULL,
  `cus_phone` varchar(100) NOT NULL,
  `cus_contact_name` varchar(100) NOT NULL,
  `cus_address` varchar(200) NOT NULL,
  `cus_date` datetime NOT NULL,
  `can_edit` varchar(1) NOT NULL,
  `us_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_cus`
--

INSERT INTO `tb_cus` (`cus_id`, `cus_name`, `cus_phone`, `cus_contact_name`, `cus_address`, `cus_date`, `can_edit`, `us_id`) VALUES
(1, 'ທົ່ວໄປ', '-', '-', '-', '2021-07-21 10:26:19', 'n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_em`
--

CREATE TABLE `tb_em` (
  `em_id` int(11) NOT NULL,
  `em_name` varchar(100) NOT NULL,
  `em_phone` varchar(100) NOT NULL,
  `is_leave` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_em`
--

INSERT INTO `tb_em` (`em_id`, `em_name`, `em_phone`, `is_leave`) VALUES
(5, 'ກິຫຼ້າ', '02091596966', 'n');

-- --------------------------------------------------------

--
-- Table structure for table `tb_move`
--

CREATE TABLE `tb_move` (
  `mov_id` int(11) NOT NULL,
  `mov_date` datetime NOT NULL,
  `mov_code` int(11) NOT NULL,
  `st_id_1` int(11) NOT NULL,
  `st_id_2` int(11) NOT NULL,
  `em_id` int(11) NOT NULL,
  `is_recieve` varchar(1) NOT NULL,
  `mov_note` varchar(200) NOT NULL,
  `us_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_move_detail`
--

CREATE TABLE `tb_move_detail` (
  `mov_id` int(11) NOT NULL,
  `mov_code` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `qty` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_paid_money`
--

CREATE TABLE `tb_paid_money` (
  `paid_id` int(11) NOT NULL,
  `buy_id` int(11) NOT NULL,
  `paid_date` datetime NOT NULL,
  `t1` float NOT NULL,
  `t2` float NOT NULL,
  `paid_type` varchar(1) NOT NULL,
  `us_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pro`
--

CREATE TABLE `tb_pro` (
  `pro_id` int(11) NOT NULL,
  `pro_code` varchar(20) NOT NULL,
  `pro_name` varchar(100) NOT NULL,
  `pro_name_2` varchar(100) NOT NULL,
  `pro_detail` varchar(100) NOT NULL,
  `pt_id` int(11) NOT NULL,
  `un_id` int(11) NOT NULL,
  `pro_buy_price` float NOT NULL,
  `pro_sale_price` float NOT NULL,
  `pro_sale_price_2` float NOT NULL,
  `pro_sale_price_vip` float NOT NULL,
  `pro_low_to_order` float NOT NULL,
  `pro_is_cancel` varchar(1) NOT NULL,
  `pro_date` datetime NOT NULL,
  `us_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_pro`
--

INSERT INTO `tb_pro` (`pro_id`, `pro_code`, `pro_name`, `pro_name_2`, `pro_detail`, `pt_id`, `un_id`, `pro_buy_price`, `pro_sale_price`, `pro_sale_price_2`, `pro_sale_price_vip`, `pro_low_to_order`, `pro_is_cancel`, `pro_date`, `us_id`) VALUES
(53, '001', 'ໝູປີ້ງ', 'ໝູປີ້ງ', '', 24, 27, 2000, 5000, 4000, 0, 5, 'n', '2021-09-17 14:06:20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_protype`
--

CREATE TABLE `tb_protype` (
  `pt_id` int(11) NOT NULL,
  `pt_name` varchar(100) NOT NULL,
  `pt_date` datetime NOT NULL,
  `us_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_protype`
--

INSERT INTO `tb_protype` (`pt_id`, `pt_name`, `pt_date`, `us_id`) VALUES
(24, 'ອາຫານ', '2021-09-17 13:29:41', 1),
(25, 'ເຄືອງດືມ', '2021-09-17 13:41:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pro_in_stock`
--

CREATE TABLE `tb_pro_in_stock` (
  `my_id` int(11) NOT NULL,
  `st_id` int(11) NOT NULL,
  `pro_id` varchar(20) NOT NULL,
  `qty` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_pro_in_stock`
--

INSERT INTO `tb_pro_in_stock` (`my_id`, `st_id`, `pro_id`, `qty`) VALUES
(58, 1, '53', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_recieve_money`
--

CREATE TABLE `tb_recieve_money` (
  `re_id` int(11) NOT NULL,
  `re_date` datetime NOT NULL,
  `sale_id` int(11) NOT NULL,
  `t1` float NOT NULL,
  `t2` float NOT NULL,
  `recieve_type` varchar(1) NOT NULL,
  `us_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_recieve_money`
--

INSERT INTO `tb_recieve_money` (`re_id`, `re_date`, `sale_id`, `t1`, `t2`, `recieve_type`, `us_id`) VALUES
(60, '2021-09-17 14:18:02', 82, 10000, 10000, 'c', 1),
(61, '2021-09-17 14:19:49', 83, 5000, 5000, 'c', 1),
(62, '2021-09-17 14:28:13', 84, 35000, 35000, 'c', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tb_reg`
--

CREATE TABLE `tb_reg` (
  `reg_id` int(11) NOT NULL,
  `reg_free` int(11) NOT NULL,
  `reg_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tb_reg` (`reg_id`, `reg_free`, `reg_num`) VALUES
(1, '252565', '252565');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sale`
--

CREATE TABLE `tb_sale` (
  `sale_id` int(11) NOT NULL,
  `sale_date` datetime NOT NULL,
  `sale_code` int(11) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `price_type` varchar(10) NOT NULL,
  `total` float NOT NULL,
  `total_dc` float NOT NULL,
  `sale_note` varchar(200) NOT NULL,
  `us_id` int(11) NOT NULL,
  `sale_type` varchar(10) NOT NULL,
  `is_paid` varchar(1) NOT NULL,
  `st_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_sale`
--

INSERT INTO `tb_sale` (`sale_id`, `sale_date`, `sale_code`, `cus_id`, `price_type`, `total`, `total_dc`, `sale_note`, `us_id`, `sale_type`, `is_paid`, `st_id`) VALUES
(82, '2021-09-17 14:18:02', 2021000001, 1, 'front', 10000, 0, '-', 1, 'front', 'y', 1),
(83, '2021-09-17 14:19:49', 2021000002, 1, 'front', 5000, 0, '-', 1, 'front', 'y', 1),
(84, '2021-09-17 14:28:13', 2021000003, 1, 'front', 35000, 0, '-', 4, 'front', 'y', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sale_detail`
--

CREATE TABLE `tb_sale_detail` (
  `sale_id` int(11) NOT NULL,
  `sale_code` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `qty` float NOT NULL,
  `sale_price` float NOT NULL,
  `buy_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_sale_detail`
--

INSERT INTO `tb_sale_detail` (`sale_id`, `sale_code`, `pro_id`, `qty`, `sale_price`, `buy_price`) VALUES
(105, 2021000001, 53, 2, 5000, 2000),
(106, 2021000002, 53, 1, 5000, 2000),
(107, 2021000003, 53, 7, 5000, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_stock`
--

CREATE TABLE `tb_stock` (
  `st_id` int(11) NOT NULL,
  `st_name` varchar(100) NOT NULL,
  `st_date` datetime NOT NULL,
  `st_can_edit` varchar(1) NOT NULL,
  `us_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_stock`
--

INSERT INTO `tb_stock` (`st_id`, `st_name`, `st_date`, `st_can_edit`, `us_id`) VALUES
(1, 'ໜ້າຮ້ານ', '2021-08-17 10:18:29', 'n', 1),
(2, 'ສາງໃຫຍ່', '2021-08-17 10:19:22', 'y', 1),
(3, 'ສາງນ້ອຍ', '2021-08-17 10:20:30', 'y', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sup`
--

CREATE TABLE `tb_sup` (
  `sup_id` int(11) NOT NULL,
  `sup_name` varchar(100) NOT NULL,
  `sup_phone` varchar(100) NOT NULL,
  `sup_contact_name` varchar(100) NOT NULL,
  `sup_address` varchar(200) NOT NULL,
  `sup_date` datetime NOT NULL,
  `us_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_sup`
--

INSERT INTO `tb_sup` (`sup_id`, `sup_name`, `sup_phone`, `sup_contact_name`, `sup_address`, `sup_date`, `us_id`) VALUES
(7, 'ກິຫຼ້າ ', '02091596966', 'ກິຫຼ້ານ້ອຍ', 'ນະຄອນຫຼວງ', '2021-09-17 13:36:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_unit`
--

CREATE TABLE `tb_unit` (
  `un_id` int(11) NOT NULL,
  `un_name` varchar(50) NOT NULL,
  `un_qty` float NOT NULL,
  `un_date` datetime NOT NULL,
  `us_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_unit`
--

INSERT INTO `tb_unit` (`un_id`, `un_name`, `un_qty`, `un_date`, `us_id`) VALUES
(24, 'ແກ້ວ', 1, '2021-09-17 13:42:13', 1),
(25, 'ລັງ', 1, '2021-09-17 13:51:57', 1),
(27, 'ແພັກ', 1, '2021-09-17 13:56:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `us_id` int(11) NOT NULL,
  `us_type` varchar(6) NOT NULL,
  `us_name` varchar(100) NOT NULL,
  `us_pass` varchar(100) NOT NULL,
  `is_cancel` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`us_id`, `us_type`, `us_name`, `us_pass`, `is_cancel`) VALUES
(1, 'admin', 'admin', 'YWRtaW4=', 'n'),
(4, 'em', 'kilar', 'MTIz', 'n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_buy`
--
ALTER TABLE `tb_buy`
  ADD PRIMARY KEY (`buy_id`);

--
-- Indexes for table `tb_buy_detail`
--
ALTER TABLE `tb_buy_detail`
  ADD PRIMARY KEY (`buy_id`);

--
-- Indexes for table `tb_com`
--
ALTER TABLE `tb_com`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `tb_cus`
--
ALTER TABLE `tb_cus`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `tb_em`
--
ALTER TABLE `tb_em`
  ADD PRIMARY KEY (`em_id`);

--
-- Indexes for table `tb_move`
--
ALTER TABLE `tb_move`
  ADD PRIMARY KEY (`mov_id`);

--
-- Indexes for table `tb_move_detail`
--
ALTER TABLE `tb_move_detail`
  ADD PRIMARY KEY (`mov_id`);

--
-- Indexes for table `tb_paid_money`
--
ALTER TABLE `tb_paid_money`
  ADD PRIMARY KEY (`paid_id`);

--
-- Indexes for table `tb_pro`
--
ALTER TABLE `tb_pro`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `tb_protype`
--
ALTER TABLE `tb_protype`
  ADD PRIMARY KEY (`pt_id`);

--
-- Indexes for table `tb_pro_in_stock`
--
ALTER TABLE `tb_pro_in_stock`
  ADD PRIMARY KEY (`my_id`);

--
-- Indexes for table `tb_recieve_money`
--
ALTER TABLE `tb_recieve_money`
  ADD PRIMARY KEY (`re_id`);

--
-- Indexes for table `tb_reg`
--
ALTER TABLE `tb_reg`
  ADD PRIMARY KEY (`reg_id`);

--
-- Indexes for table `tb_sale`
--
ALTER TABLE `tb_sale`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `tb_sale_detail`
--
ALTER TABLE `tb_sale_detail`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `tb_stock`
--
ALTER TABLE `tb_stock`
  ADD PRIMARY KEY (`st_id`);

--
-- Indexes for table `tb_sup`
--
ALTER TABLE `tb_sup`
  ADD PRIMARY KEY (`sup_id`);

--
-- Indexes for table `tb_unit`
--
ALTER TABLE `tb_unit`
  ADD PRIMARY KEY (`un_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`us_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_buy`
--
ALTER TABLE `tb_buy`
  MODIFY `buy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `tb_buy_detail`
--
ALTER TABLE `tb_buy_detail`
  MODIFY `buy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `tb_com`
--
ALTER TABLE `tb_com`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_cus`
--
ALTER TABLE `tb_cus`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_em`
--
ALTER TABLE `tb_em`
  MODIFY `em_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_move`
--
ALTER TABLE `tb_move`
  MODIFY `mov_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_move_detail`
--
ALTER TABLE `tb_move_detail`
  MODIFY `mov_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_paid_money`
--
ALTER TABLE `tb_paid_money`
  MODIFY `paid_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tb_pro`
--
ALTER TABLE `tb_pro`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `tb_protype`
--
ALTER TABLE `tb_protype`
  MODIFY `pt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tb_pro_in_stock`
--
ALTER TABLE `tb_pro_in_stock`
  MODIFY `my_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tb_recieve_money`
--
ALTER TABLE `tb_recieve_money`
  MODIFY `re_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `tb_reg`
--
ALTER TABLE `tb_reg`
  MODIFY `reg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tb_sale`
--
ALTER TABLE `tb_sale`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `tb_sale_detail`
--
ALTER TABLE `tb_sale_detail`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `tb_stock`
--
ALTER TABLE `tb_stock`
  MODIFY `st_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_sup`
--
ALTER TABLE `tb_sup`
  MODIFY `sup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_unit`
--
ALTER TABLE `tb_unit`
  MODIFY `un_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `us_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
