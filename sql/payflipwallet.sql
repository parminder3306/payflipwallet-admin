-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 13, 2020 at 05:10 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id11958796_payflipwallet`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `ceo` varchar(200) NOT NULL,
  `pin` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `ceo`, `pin`) VALUES
(1, 'Parminder Singh', '2285');

-- --------------------------------------------------------

--
-- Table structure for table `autopay`
--

CREATE TABLE `autopay` (
  `id` int(11) NOT NULL,
  `uid` varchar(200) NOT NULL,
  `opid` varchar(200) NOT NULL,
  `opname` varchar(200) NOT NULL,
  `oplogo` varchar(200) NOT NULL,
  `mobile` varchar(200) NOT NULL,
  `amount` float(7,1) NOT NULL,
  `date` varchar(200) NOT NULL,
  `type` enum('Prepaid','Postpaid') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `banktransfer`
--

CREATE TABLE `banktransfer` (
  `orderid` varchar(200) NOT NULL,
  `holder` varchar(200) NOT NULL,
  `acnumber` varchar(200) NOT NULL,
  `ifsc` varchar(200) NOT NULL,
  `amount` varchar(200) NOT NULL,
  `status` enum('Success','Processing','Refund') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `promocode` varchar(200) NOT NULL,
  `percent` varchar(200) NOT NULL,
  `apply_min` varchar(200) NOT NULL,
  `apply_max` varchar(200) NOT NULL,
  `apply_uses` varchar(200) NOT NULL,
  `redeem` varchar(200) NOT NULL,
  `users` varchar(200) NOT NULL,
  `apply` enum('AddMoney','SendMoney','Recharge','DTH','Electricity','Landline','GooglePlay') NOT NULL,
  `status` enum('Active','Expire') NOT NULL,
  `openable` enum('No','Yes') NOT NULL,
  `validity` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `promocode`, `percent`, `apply_min`, `apply_max`, `apply_uses`, `redeem`, `users`, `apply`, `status`, `openable`, `validity`) VALUES
(1, 'NEW30', '30', '10', '500', '1', '0', '2000', 'SendMoney', 'Active', 'Yes', '2020-02-16');

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `serial` varchar(200) NOT NULL,
  `token` varchar(200) NOT NULL,
  `accesskey` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`serial`, `token`, `accesskey`) VALUES
('unknown', 'null', '2395ea23b50896164a16ed63e771ab6fe7fae7a6');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `senderid` varchar(200) NOT NULL,
  `accesskey` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `message` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `mobile` varchar(200) NOT NULL,
  `amount` varchar(200) NOT NULL,
  `status` enum('Processing','Success') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `logourl` varchar(200) NOT NULL,
  `dealurl` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `details` varchar(200) NOT NULL,
  `scratchcard` enum('Yes','No') NOT NULL,
  `promocode` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL,
  `activity` enum('Recharge','DTH','Electricity','Landline','Sendmoney','Webview','Voucher') NOT NULL,
  `termconditions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `logourl`, `dealurl`, `title`, `details`, `scratchcard`, `promocode`, `date`, `activity`, `termconditions`) VALUES
(1, 'https://payflipwallet22.000webhostapp.com/new30.jpg', '', 'Earn Scratch Card On First SendMoney To Friends', 'Earn Scratch Card On First SendMoney To Friends.', 'Yes', 'NEW30', '2020-02-16', 'Sendmoney', '');

-- --------------------------------------------------------

--
-- Table structure for table `operators`
--

CREATE TABLE `operators` (
  `id` int(11) NOT NULL,
  `type` enum('Prepaid','Postpaid','Datacard','DTH','Electricity','Landline') NOT NULL,
  `opid` varchar(200) NOT NULL,
  `opname` varchar(200) NOT NULL,
  `oplogo` varchar(200) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `operators`
--

INSERT INTO `operators` (`id`, `type`, `opid`, `opname`, `oplogo`, `status`) VALUES
(1, 'Prepaid', '9', 'Aircel', 'aircel', 'Active'),
(2, 'Prepaid', '1', 'Airtel', 'airtel', 'Active'),
(3, 'Prepaid', '8', 'BSNL', 'bsnl', 'Active'),
(4, 'Prepaid', '3', 'Idea', 'idea', 'Active'),
(5, 'Prepaid', '40', 'Reliance CDMA', 'reliance', 'Active'),
(6, 'Prepaid', '5', 'Tata Docomo', 'tatadocomo', 'Active'),
(7, 'Prepaid', '4', 'Tata Indicom', 'tataindicom', 'Active'),
(8, 'Prepaid', '6', 'Telenor', 'telenor', 'Active'),
(9, 'Prepaid', '10', 'Videocon', 'videocon', 'Active'),
(10, 'Prepaid', '2', 'Vodafone', 'vodafone', 'Active'),
(11, 'Prepaid', '39', 'Reliance GSM', 'reliance', 'Active'),
(12, 'Prepaid', '112', 'Reliance Jio', 'jio', 'Active'),
(14, 'Postpaid', '23', 'Airtel', 'airtel', 'Active'),
(15, 'Postpaid', '73', 'BSNL', 'bsnl', 'Active'),
(16, 'Postpaid', '24', 'Idea', 'idea', 'Active'),
(17, 'Postpaid', '27', 'Reliance CDMA', 'reliance', 'Active'),
(18, 'Postpaid', '26', 'Reliance GSM', 'reliance', 'Active'),
(19, 'Postpaid', '28', 'Tata Docomo', 'tatadocomo', 'Active'),
(20, 'Postpaid', '25', 'Vodafone', 'vodafone', 'Active'),
(22, 'Datacard', '23', 'Airtel', 'airtel', 'Active'),
(23, 'Datacard', '8', 'BSNL', 'bsnl', 'Active'),
(24, 'Datacard', '24', 'Idea', 'idea', 'Active'),
(25, 'Datacard', '20', 'Reliance Netconnect', 'reliance', 'Active'),
(26, 'Datacard', '2', 'Vodafone', 'vodafone', 'Active'),
(27, 'Datacard', '19', 'MTS MBROWSE', 'mts', 'Active'),
(28, 'Datacard', '18', 'MTS MBLAZE', 'mts', 'Active'),
(29, 'Datacard', '82', 'Tata Photon Plus', 'tataphotonplus', 'Active'),
(30, 'Datacard', '22', 'Tata Photon Max', 'tataphotonmax', 'Active'),
(31, 'DTH', '17', 'AIRTEL DEGITAL TV', 'airteltv', 'Active'),
(32, 'DTH', '12', 'Dish TV', 'dishtv', 'Active'),
(33, 'DTH', '16', 'Reliance Big TV', 'reliancetv', 'Active'),
(34, 'DTH', '14', 'Sundirect', 'sundirect', 'Active'),
(35, 'DTH', '13', 'Tatasky', 'tatasky', 'Active'),
(36, 'DTH', '15', 'Videocon D2H', 'videocond2h', 'Active'),
(37, 'Electricity', '69', 'PSPCL', 'pspcl', 'Active'),
(38, 'Landline', '101', 'Airtel Landline', 'airtel', 'Active'),
(39, 'Landline', '102', 'BSNL Landline', 'bsnl', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `uid` varchar(200) NOT NULL,
  `orderid` varchar(200) NOT NULL,
  `details` varchar(200) NOT NULL,
  `cashback` float(7,1) NOT NULL,
  `amount` float(7,1) NOT NULL,
  `operator` varchar(100) NOT NULL,
  `symbol` varchar(100) NOT NULL,
  `number` varchar(200) NOT NULL,
  `type` enum('AddMoney','SendMoney','ReceivedMoney','PaidMoney','RefundMoney','BankMoney') NOT NULL,
  `acnumber` varchar(200) NOT NULL,
  `status` enum('Processing','Failure','Success','Refund') NOT NULL,
  `time` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `uid`, `orderid`, `details`, `cashback`, `amount`, `operator`, `symbol`, `number`, `type`, `acnumber`, `status`, `time`, `date`) VALUES
(1, '1', '5012000263', 'AddMoney', 500.0, 500.0, 'AddMoney', '+', '9855567116', 'AddMoney', '', 'Success', '07:55 PM', '16-12-2019'),
(2, '2', '2330252798', 'Cash Received', 30.0, 30.0, 'Cash Received', '+', '9999999999', 'AddMoney', '', 'Success', '08:04 PM', '16-12-2019'),
(3, '1', '3932522760', 'Cash Received', 15.0, 15.0, 'Cash Received', '+', '9855567116', 'AddMoney', '', 'Success', '06:37 PM', '19-12-2019');

-- --------------------------------------------------------

--
-- Table structure for table `redeem`
--

CREATE TABLE `redeem` (
  `id` int(11) NOT NULL,
  `uid` varchar(200) NOT NULL,
  `promocode` varchar(200) NOT NULL,
  `redeem` varchar(200) NOT NULL,
  `time` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `redeem`
--

INSERT INTO `redeem` (`id`, `uid`, `promocode`, `redeem`, `time`, `date`) VALUES
(24, '1', 'NEW30', '1', '07:56 PM', '16-12-2019'),
(25, '2', 'NEW30', '1', '08:03 PM', '16-12-2019');

-- --------------------------------------------------------

--
-- Table structure for table `referprogram`
--

CREATE TABLE `referprogram` (
  `id` int(11) NOT NULL,
  `money` varchar(200) NOT NULL,
  `url` varchar(200) NOT NULL,
  `offer` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `referprogram`
--

INSERT INTO `referprogram` (`id`, `money`, `url`, `offer`) VALUES
(1, '30', 'https://payflipwallet.com/v1/refer', 'Earn Rs.30 on First Refer to friend');

-- --------------------------------------------------------

--
-- Table structure for table `rewards`
--

CREATE TABLE `rewards` (
  `id` int(11) NOT NULL,
  `uid` varchar(200) NOT NULL,
  `cashback` float(7,1) NOT NULL,
  `orderid` varchar(200) NOT NULL,
  `symbol` varchar(200) NOT NULL,
  `time` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL,
  `status` enum('Processing','Failure','Success') NOT NULL,
  `openable` enum('No','Yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rewards`
--

INSERT INTO `rewards` (`id`, `uid`, `cashback`, `orderid`, `symbol`, `time`, `date`, `status`, `openable`) VALUES
(1, '1', 15.0, '2063150420', '+', '07:56 PM', '16-12-2019', 'Success', 'Yes'),
(2, '2', 30.0, '2992879531', '+', '08:03 PM', '16-12-2019', 'Success', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `setup`
--

CREATE TABLE `setup` (
  `id` int(11) NOT NULL,
  `provider` varchar(200) NOT NULL,
  `s_key` varchar(200) NOT NULL,
  `s_salt` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `type` enum('New','Old') NOT NULL,
  `access` enum('Active','Block') NOT NULL,
  `wincash` float(7,1) NOT NULL DEFAULT 0.0,
  `spendmoney` float(7,1) NOT NULL DEFAULT 0.0,
  `wallet` float(7,1) NOT NULL DEFAULT 0.0,
  `refercode` varchar(200) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `accesskey` varchar(200) NOT NULL,
  `time` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `type`, `access`, `wincash`, `spendmoney`, `wallet`, `refercode`, `name`, `email`, `mobile`, `password`, `accesskey`, `time`, `date`) VALUES
(1, 'New', 'Active', 15.0, 110.0, 505.0, 'PF452054', 'PARMINDER SAMRA', 'parminder67116@gmail.com', '9855567116', 'fb0284d30fd987e17a0eda3493197c0e', '2395ea23b50896164a16ed63e771ab6fe7fae7a6', '05:19 PM', '16-12-2019'),
(2, 'New', 'Active', 30.0, 100.0, 30.0, 'PF252097', 'Parminder Singh', 'test@gmail.com', '9999999999', '25d55ad283aa400af464c76d713c07ad', '6666f8577f1a7a52482427c559b2c944874bcc50', '07:55 PM', '16-12-2019');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `autopay`
--
ALTER TABLE `autopay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banktransfer`
--
ALTER TABLE `banktransfer`
  ADD PRIMARY KEY (`orderid`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`serial`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`senderid`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operators`
--
ALTER TABLE `operators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `redeem`
--
ALTER TABLE `redeem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referprogram`
--
ALTER TABLE `referprogram`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rewards`
--
ALTER TABLE `rewards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setup`
--
ALTER TABLE `setup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `autopay`
--
ALTER TABLE `autopay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `operators`
--
ALTER TABLE `operators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `redeem`
--
ALTER TABLE `redeem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `referprogram`
--
ALTER TABLE `referprogram`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rewards`
--
ALTER TABLE `rewards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setup`
--
ALTER TABLE `setup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
