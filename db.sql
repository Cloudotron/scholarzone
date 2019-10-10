-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 10, 2019 at 03:40 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `centv4sv_scholarzone`
--

-- --------------------------------------------------------

--
-- Table structure for table `doc`
--

CREATE TABLE `doc` (
  `doc_id` int(11) NOT NULL,
  `uid` varchar(255) DEFAULT NULL,
  `doc_type` varchar(255) DEFAULT NULL,
  `doc_name` varchar(255) DEFAULT NULL,
  `dt` varchar(255) DEFAULT NULL,
  `fo` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doc`
--

INSERT INTO `doc` (`doc_id`, `uid`, `doc_type`, `doc_name`, `dt`, `fo`) VALUES
(1, '3', 'aim_in_life', '309D60boxed.jpg', '10-10-2019', NULL),
(2, '3', 'photo_file', 'D685DDboxed.jpg', '10-10-2019', NULL),
(3, '3', 'tu_fee', 'C29DBBboxed.jpg', '10-10-2019', NULL),
(4, '3', 'bona_file', '338114boxed.jpg', '10-10-2019', NULL),
(5, '3', 'cm_file', '6D9DB7m1.jpg', '10-10-2019', NULL),
(6, '3', 'cm_file', '87228Bm2.jpg', '10-10-2019', NULL),
(7, '3', 'cm_file', '84204Bm3.jpg', '10-10-2019', NULL),
(8, '3', 'vo_file', 'D7F516m4.jpg', '10-10-2019', NULL),
(9, '3', 'vo_file', '22913Fm5.jpg', '10-10-2019', NULL),
(10, '3', 'in_file', 'A67CEDboxed.jpg', '10-10-2019', NULL),
(11, '3', 'last_mark', 'BC72A0boxed.jpg', '10-10-2019', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ec_form`
--

CREATE TABLE `ec_form` (
  `eid` int(11) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `award` varchar(255) NOT NULL,
  `authority` varchar(255) NOT NULL,
  `addr` varchar(255) NOT NULL,
  `pin` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `bname` varchar(255) NOT NULL,
  `baddr` varchar(255) NOT NULL,
  `bacc` varchar(255) NOT NULL,
  `bifsc` varchar(255) NOT NULL,
  `dt` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `interviews`
--

CREATE TABLE `interviews` (
  `id` int(11) NOT NULL,
  `uid` varchar(255) DEFAULT NULL,
  `idt` varchar(255) DEFAULT NULL,
  `result` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `interviews`
--

INSERT INTO `interviews` (`id`, `uid`, `idt`, `result`, `status`) VALUES
(1, '1', '12-10-2019', '', ''),
(2, '3', '17-10-2019', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `nid` int(11) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `dt` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`nid`, `uid`, `note`, `dt`) VALUES
(1, '3', 'ffdf', '10-10-2019'),
(2, '3', 'ffdfhhhghg', '10-10-2019');

-- --------------------------------------------------------

--
-- Table structure for table `reapply`
--

CREATE TABLE `reapply` (
  `rid` int(11) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `mcard` varchar(255) NOT NULL,
  `sem` varchar(255) NOT NULL,
  `dt` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `note` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `rid` int(11) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `sem` varchar(255) NOT NULL,
  `dt` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `receipt`
--

INSERT INTO `receipt` (`rid`, `uid`, `fname`, `sem`, `dt`) VALUES
(1, '3', 'CEDDE6fade.gif', '0', '10-10-2019');

-- --------------------------------------------------------

--
-- Table structure for table `scholarship`
--

CREATE TABLE `scholarship` (
  `enroll_id` int(11) NOT NULL,
  `uid` varchar(255) DEFAULT NULL,
  `addr` varchar(255) DEFAULT NULL,
  `pin` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `foccu` varchar(255) DEFAULT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `moccu` varchar(255) DEFAULT NULL,
  `fincome` varchar(255) DEFAULT NULL,
  `course` varchar(255) DEFAULT NULL,
  `course_scheme` varchar(255) DEFAULT NULL,
  `total_phase` varchar(255) DEFAULT NULL,
  `cur_phase` varchar(255) DEFAULT NULL,
  `apply_phase` varchar(255) DEFAULT NULL,
  `col_name` varchar(255) DEFAULT NULL,
  `col_add` varchar(255) DEFAULT NULL,
  `col_phone` varchar(255) DEFAULT NULL,
  `col_pin` varchar(255) DEFAULT NULL,
  `col_web` varchar(255) DEFAULT NULL,
  `ten_per` varchar(255) DEFAULT NULL,
  `tw_per` varchar(255) DEFAULT NULL,
  `grad_per` varchar(255) DEFAULT NULL,
  `osch` varchar(255) DEFAULT NULL,
  `oamt` varchar(255) DEFAULT NULL,
  `osource` varchar(255) DEFAULT NULL,
  `bname` varchar(255) DEFAULT NULL,
  `badd` varchar(255) DEFAULT NULL,
  `bacc` varchar(255) DEFAULT NULL,
  `bifsc` varchar(255) DEFAULT NULL,
  `cname` varchar(255) DEFAULT NULL,
  `cadd` varchar(255) DEFAULT NULL,
  `cphone` varchar(255) DEFAULT NULL,
  `tname` varchar(255) DEFAULT NULL,
  `tadd` varchar(255) DEFAULT NULL,
  `tphone` varchar(255) DEFAULT NULL,
  `sub_date` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scholarship`
--

INSERT INTO `scholarship` (`enroll_id`, `uid`, `addr`, `pin`, `fname`, `foccu`, `mname`, `moccu`, `fincome`, `course`, `course_scheme`, `total_phase`, `cur_phase`, `apply_phase`, `col_name`, `col_add`, `col_phone`, `col_pin`, `col_web`, `ten_per`, `tw_per`, `grad_per`, `osch`, `oamt`, `osource`, `bname`, `badd`, `bacc`, `bifsc`, `cname`, `cadd`, `cphone`, `tname`, `tadd`, `tphone`, `sub_date`) VALUES
(1, '1', 'BLR', '560078', 'hgghgh', 'service', 'ghggh', 'service', NULL, 'MCA', 'S', '6', '0', '5', 'gfg', 'gffg', '5657565656', '567767', 'hghg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '3', 'BLR', '567789', 'gggg', 'service', 'gggg', 'service', NULL, 'bca', 'S', '6', '0', '4', 'ghgh', 'ghhg', '6677889900', '676767', 'ggghgh', '66', '67', '68', 'N', '', '', 'SBI', 'bvbvb', '32061418566', 'SBIN0007997', 'Sumanta', 'qwqwqw', '1231231231', 'Poornachandra', 'asasa', '1231231231', '10-10-2019');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `sid` int(11) NOT NULL,
  `uid` varchar(255) DEFAULT NULL,
  `status` text,
  `dt` varchar(255) DEFAULT NULL,
  `tp` varchar(255) DEFAULT NULL,
  `imp` varchar(255) DEFAULT NULL,
  `fi` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`sid`, `uid`, `status`, `dt`, `tp`, `imp`, `fi`) VALUES
(1, '3', 'Interview Scheduled at 17-10-2019', '10-10-2019', NULL, 'n', NULL),
(2, '3', 'Interview completed!', '10-10-2019', NULL, NULL, NULL),
(3, '3', 'Your Scholarship Application has been approved', '10-10-2019', NULL, 'g', NULL),
(5, '3', 'Congratulations! You have been awarded the amount of Rs. 23444 for your tuition fees. <br><br> The amount has been disbursed via: <b>Transferred to the bank account of the college</b> on 10/10/2019  <br><br> Please make sure that the college has credited to you. Once it is confirmed <b>please obtain the receipt of the payment</b> from the college and Upload the copy of receipt in \'Upload Receipt\' tab. <a href=\"http://localhost/scholarzonee/storage/03E0BBcourse.jpg\">Please find the transaction receipt here</a>', '10-10-2019', 'T', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `pass` text,
  `status` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `uform` varchar(255) DEFAULT NULL,
  `phase` varchar(255) DEFAULT NULL,
  `lang` varchar(255) DEFAULT NULL,
  `sch_status` varchar(255) DEFAULT NULL,
  `ec_status` varchar(255) DEFAULT NULL,
  `reg_dt` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `fname`, `lname`, `email`, `phone`, `pass`, `status`, `token`, `uform`, `phase`, `lang`, `sch_status`, `ec_status`, `reg_dt`) VALUES
(1, 'Sumanta', 'Sharma', 'sumanta@gmail.com', '1234512345', 'bnzd06RgjEsg/02B/e1yclBAbvq6lPYBYXFkxtN3ntl2qJFlNpnut/vDpefAWqIYNCvXeGLRnvBdUdA/CDnRxb5jw+heMHfcfqEqiyCLVlS6mKnGFAXD0ORz7kQEE6tZoerS41HuFTPhs0cGBYQOUlX7/Vxu52T4fRxHPS185HiR9GG4ovIFvpyBIuDO6dyeZfxS3ZH7jvbRTydgE2J/MNbV69Q7HEvIE3czbMA3H6ltZBhP+y+Kbv5hv6KoUPA9nE8rdCPcZPHKU8f/rRFRWk53zarifbv5hlA20fIWyse+k3ujxgXbLBJZak+M2eSeD1e59RafNVWNroUtIW6miQ==', 'I', '7195A3', '1', '2', NULL, 'INT', NULL, '10-10-2019'),
(2, 'a', 'b', 'a@b.com', '1231231231', 'TE8vLKY2DWietkL8HdIlNVaVj6M4YW5K5Je9nDwIYjquaFjO8h4e1dvtzke8RWqeVy0I+9eGttEoZv2L829sd5/6keJvICCdjP0NkVix/TA7EFtrA6pLs9Cxb1y+9rbrp8mKByfutV23aNN3GEPzwNdLvAVqxNPkgcLP7o5uPLCyrSjZv8+aum4t/kM91kTNC6XKwehVQr93Sio10CW4jfZu0VNv0IRvgC7DXJ791f3uCPJpTfEGMwUbJ/ksZkscWr+MpWOSJpBDNrz1kf4PiaCJYNf6vmlOP7vNF184KQmDUw/yJrfJ1FCUGYtm2S5U0POR8YCW7yq3VddFIoKiGw==', 'I', 'F49DD1', NULL, NULL, NULL, NULL, NULL, '10-10-2019'),
(3, 'Sumanta', 'Sharma', 's1@gmail.com', '7534567865', 'QdcCiuSNbplOfmTgheORzlSrFN/FqmufKeRJWkLXW3QZfc0bdJ4ZRuCLvtg0MvrvXKIqozqDqPZIdaNgWXhM3qvJsX04M+ExzaWJizWDwudXCzCwE4roNB/I83o7lihrSXtm7+IjCnaJrnInfuZtm0bcWiswFlekN3yfOXsieF1dnJUhGjvGNuUsihH8HvRcBMt+ai6xnplRjM2HUS5mLC7YgOo2auqdrHUFy3HIVaDUTItQZv6zfAxy3ada+kDJGTg5QN4RW8uKukFBwYo6FEqBzeIpkQ+M5OXIMWwJV3TRdh1obYtpZ/hlQqJXNzAXzi0ubfNVGDQlUMr6yQIhpw==', 'I', 'CCAF33', '1', '4', NULL, 'A', NULL, '10-10-2019');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doc`
--
ALTER TABLE `doc`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `ec_form`
--
ALTER TABLE `ec_form`
  ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `interviews`
--
ALTER TABLE `interviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `reapply`
--
ALTER TABLE `reapply`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `scholarship`
--
ALTER TABLE `scholarship`
  ADD PRIMARY KEY (`enroll_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doc`
--
ALTER TABLE `doc`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ec_form`
--
ALTER TABLE `ec_form`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `interviews`
--
ALTER TABLE `interviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reapply`
--
ALTER TABLE `reapply`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `scholarship`
--
ALTER TABLE `scholarship`
  MODIFY `enroll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
