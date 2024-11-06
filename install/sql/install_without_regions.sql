-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 12, 2021 at 05:24 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bbankapp_3_1_0`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(30) CHARACTER SET latin1 NOT NULL,
  `state_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `short_name` varchar(3) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phone_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `lang_id` int(11) DEFAULT '1',
  `image_big` varchar(255) DEFAULT NULL,
  `image_default` varchar(255) DEFAULT NULL,
  `image_slider` varchar(255) DEFAULT NULL,
  `image_mid` varchar(255) DEFAULT NULL,
  `image_small` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(2);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `name` varchar(30) CHARACTER SET latin1 NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `password`, `email`, `image`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.com', 'profile.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blog`
--

DROP TABLE IF EXISTS `tbl_blog`;
CREATE TABLE `tbl_blog` (
  `id` int(11) NOT NULL,
  `blog_title` varchar(255) NOT NULL,
  `blog_content` text NOT NULL,
  `blog_image` varchar(255) NOT NULL,
  `posted_at` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bloodbanks`
--

DROP TABLE IF EXISTS `tbl_bloodbanks`;
CREATE TABLE `tbl_bloodbanks` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `country` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `address` text NOT NULL,
  `contact` varchar(50) NOT NULL,
  `location` text,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) DEFAULT NULL,
  `addedBy` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bloodgroups`
--

DROP TABLE IF EXISTS `tbl_bloodgroups`;
CREATE TABLE `tbl_bloodgroups` (
  `id` int(11) NOT NULL,
  `blood_type` varchar(20) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_bloodgroups`
--

INSERT INTO `tbl_bloodgroups` (`id`, `blood_type`, `status`) VALUES
(1, 'A-', 1),
(2, 'A+', 1),
(3, 'B+', 1),
(4, 'B-', 1),
(5, 'AB+', 1),
(6, 'AB-', 1),
(7, 'O+', 1),
(8, 'O-', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blood_requests`
--

DROP TABLE IF EXISTS `tbl_blood_requests`;
CREATE TABLE `tbl_blood_requests` (
  `id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `blood_group` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') DEFAULT NULL,
  `no_of_bags` varchar(10) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `hospital_name` text NOT NULL,
  `request_for_gender` varchar(10) DEFAULT 'male',
  `location` text,
  `latitude` double NOT NULL DEFAULT '0',
  `longitude` double DEFAULT '0',
  `message` text NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `addedBy` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `fulfilled` tinyint(4) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_calls`
--

DROP TABLE IF EXISTS `tbl_calls`;
CREATE TABLE `tbl_calls` (
  `id` int(11) NOT NULL,
  `call_from` varchar(20) DEFAULT NULL,
  `call_to` varchar(20) DEFAULT NULL,
  `isRated` tinyint(4) NOT NULL DEFAULT '0',
  `positive` int(11) NOT NULL DEFAULT '0',
  `subject` varchar(100) DEFAULT NULL,
  `feedback` varchar(100) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_donors`
--

DROP TABLE IF EXISTS `tbl_donors`;
CREATE TABLE `tbl_donors` (
  `id` int(11) NOT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `address` text,
  `date_of_birth` varchar(20) DEFAULT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `gender` varchar(10) DEFAULT 'male',
  `country` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `habits` text,
  `type` enum('free','paid') NOT NULL DEFAULT 'free',
  `is_reminder` tinyint(2) NOT NULL DEFAULT '0',
  `lastDonationDate` varchar(20) DEFAULT NULL,
  `points` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `latitude` double NOT NULL DEFAULT '0',
  `longitude` double NOT NULL DEFAULT '0',
  `location` text,
  `views` int(11) NOT NULL DEFAULT '0',
  `addedBy` varchar(100) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_noti`
--

DROP TABLE IF EXISTS `tbl_noti`;
CREATE TABLE `tbl_noti` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `message` varchar(200) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

DROP TABLE IF EXISTS `tbl_settings`;
CREATE TABLE `tbl_settings` (
  `id` int(11) NOT NULL,
  `onesignal_app_id` text NOT NULL,
  `onesignal_rest_key` text NOT NULL,
  `app_api_key` varchar(255) NOT NULL,
  `app_name` varchar(255) NOT NULL,
  `app_logo` varchar(255) NOT NULL,
  `app_email` varchar(255) NOT NULL,
  `app_version` varchar(255) NOT NULL,
  `app_author` varchar(255) NOT NULL,
  `app_contact` varchar(255) NOT NULL,
  `app_website` varchar(255) NOT NULL,
  `app_description` text NOT NULL,
  `app_developed_by` varchar(255) NOT NULL,
  `app_privacy_policy` text NOT NULL,
  `publisher_id` text NOT NULL,
  `interstital_ad` varchar(255) NOT NULL,
  `interstital_ad_id` varchar(255) NOT NULL,
  `interstital_ad_click` varchar(255) NOT NULL,
  `banner_ad` varchar(255) NOT NULL,
  `banner_ad_id` varchar(255) NOT NULL,
  `app_id_android` varchar(100) NOT NULL,
  `donor_status` tinyint(4) DEFAULT '1',
  `request_status` tinyint(4) NOT NULL DEFAULT '1',
  `blood_bank_status` tinyint(4) NOT NULL DEFAULT '1',
  `bgroup_status` tinyint(4) NOT NULL DEFAULT '1',
  `user_status` tinyint(4) NOT NULL DEFAULT '1',
  `google_maps_api_key` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `onesignal_app_id`, `onesignal_rest_key`, `app_api_key`, `app_name`, `app_logo`, `app_email`, `app_version`, `app_author`, `app_contact`, `app_website`, `app_description`, `app_developed_by`, `app_privacy_policy`, `publisher_id`, `interstital_ad`, `interstital_ad_id`, `interstital_ad_click`, `banner_ad`, `banner_ad_id`, `app_id_android`, `donor_status`, `request_status`, `blood_bank_status`, `bgroup_status`, `user_status`, `google_maps_api_key`) VALUES
(1, '283e955c-857c-46bc-bf3a-5098039265fb', 'OGJjZjk1NmEtZDdjMS00MTllLWE1ZWQtMjg1NTc2MzVlZmFj', 'YtmpgwcUzCbeh1JlsK0gRff0njtXm9g9lAUt4pzsPZhsH8a', 'Blood Bank App', 'icon.png', 'almahirhub@gmail.com', '3.1.0', 'Mudassar', '03167545887', 'almahirhub.com', '<p>Praesent et libero non erat molestie eleifend a efficitur lorem. Nulla congue nisl nulla, id de suscipit quam lobortis sit amet. Nullam eu enim n&atilde;o mauris tincidunt lacinia eget sente-se amet augue. Etiam ullamcorper vestibulum leo, em ultrages augue consequat fermentum. Aliquam erat volutpat. Nunc vulputate convip. Donec blandit volutpat lectus id interdum. Ut ac sagittis odio, ue scelerisque odio. Ut Ultricies ex eu dictum accumsan. Etiam vel lorem commodo, aliquam ex-quis, feugiat elit. Nam ditum felis sed lacus hendrerit ullamcorper.</p>\r\n\r\n<p>Vivamus bibendum efficitur libero a pharetra. Sed vulputate eros vitae neque tempor, nec maximus augue aliquam. Vestibulum ligula metus, suscipit sente-se amet risus non, rhoncus viverra metus. Nullam viverra felis nibh, et posuere neque maximus non. Nulla consectet mi justo, ne laoreet enim auctor eget. Suspendisse potenti. Aenean laoreet nisi vel urna, conseq&uuml;at dapibus.</p>\r\n\r\n<p>Nam hendrerit odio erat, ca posuere urna luctus nec. Suspendisse euismod tincidunt nulla, sente-se amet tincidunt arcu condimentum eget. Vestibulum ante ipsum primis em orucus oruculares de faucibus e ultr&uacute;rios posuere cubilia Curae; Mauris bibendum nunc libero, em iaculis diam faucibus nec. Fusce viverra odio nec libero, commodo eleifend massa feugiat. Vivamus finibus lorem luctus erat finibus, em consequ&ecirc;ncia da mol&eacute;stia quam. Maecenas ac dolor ligula. Donec ullamcorper malesuada purus.</p>\r\n\r\n<p>Pr&eacute;mio Aenean, libero vitae congue feugiat, neque erat sagittis mi, et fermentum diam felis ac justo. Pellentesque cursus vitae orci rutrum ultricies na ue urna. Vestibulum sente-se amet ornare tellus. Cras finibus fringilla tellus, um f&aacute;rmaco n&atilde;o tincidunt. Etiam, suscipit nec dui varius tristique. Fusce, nec orci, pharetra elit lobortis gravida. Inteiro venenatis eros vel iaculis hendrerit. Donec sente-se em neque quis nisl posuere dictum. Em ve&iacute;culos de alta qualidade e ultra vitae magna. Proin tincidunt egestas laoreet. Etiam blandit dolor eu sem placerat ornare. Proin vel tellus eget risus condimentum dictum eget ne ne. Nullam sente-se no vest&iacute;bulo auctor do amet sapien um ligula. Suspendisse sed magna id risus cursus lacinia e non libero. Morbi vel lacus ut lectus ultras pulvinar.</p>\r\n', 'AlmahirHub', '<p><strong>We are committed to protecting your privacy</strong></p>\r\n\r\n<p>We collect the minimum amount of information about you that is commensurate with providing you with a satisfactory service. This policy indicates the type of processes that may result in data being collected about you. Your use of this website gives us the right to collect that information.&nbsp;</p>\r\n\r\n<p><strong>Information Collected</strong></p>\r\n\r\n<p>We may collect any or all of the information that you give us depending on the type of transaction you enter into, including your name, address, telephone number, and email address, together with data about your use of the website. Other information that may be needed from time to time to process a request may also be collected as indicated on the website.</p>\r\n\r\n<p><strong>Information Use</strong></p>\r\n\r\n<p>We use the information collected primarily to process the task for which you visited the website. Data collected in the UK is held in accordance with the Data Protection Act. All reasonable precautions are taken to prevent unauthorised access to this information. This safeguard may require you to provide additional forms of identity should you wish to obtain information about your account details.</p>\r\n\r\n<p><strong>Cookies</strong></p>\r\n\r\n<p>Your Internet browser has the in-built facility for storing small files - &quot;cookies&quot; - that hold information which allows a website to recognise your account. Our website takes advantage of this facility to enhance your experience. You have the ability to prevent your computer from accepting cookies but, if you do, certain functionality on the website may be impaired.</p>\r\n\r\n<p><strong>Disclosing Information</strong></p>\r\n\r\n<p>We do not disclose any personal information obtained about you from this website to third parties unless you permit us to do so by ticking the relevant boxes in registration or competition forms. We may also use the information to keep in contact with you and inform you of developments associated with us. You will be given the opportunity to remove yourself from any mailing list or similar device. If at any time in the future we should wish to disclose information collected on this website to any third party, it would only be with your knowledge and consent.&nbsp;</p>\r\n\r\n<p>We may from time to time provide information of a general nature to third parties - for example, the number of individuals visiting our website or completing a registration form, but we will not use any information that could identify those individuals.&nbsp;</p>\r\n\r\n<p>In addition Dummy may work with third parties for the purpose of delivering targeted behavioural advertising to the Dummy website. Through the use of cookies, anonymous information about your use of our websites and other websites will be used to provide more relevant adverts about goods and services of interest to you. For more information on online behavioural advertising and about how to turn this feature off, please visit youronlinechoices.com/opt-out.</p>\r\n\r\n<p><strong>Changes to this Policy</strong></p>\r\n\r\n<p>Any changes to our Privacy Policy will be placed here and will supersede this version of our policy. We will take reasonable steps to draw your attention to any changes in our policy. However, to be on the safe side, we suggest that you read this document each time you use the website to ensure that it still meets with your approval.</p>\r\n\r\n<p><strong>Contacting Us</strong></p>\r\n\r\n<p>If you have any questions about our Privacy Policy, or if you want to know what information we have collected about you, please email us at hd@dummy.com. You can also correct any factual errors in that information or require us to remove your details form any list under our control.</p>', 'pub-8356404931736973', 'true', 'ca-app-pub-1542366323524150/1906347617', '5', 'true', 'ca-app-pub-1542366323524150/8116532747', 'ca-app-pub-1542366323524150~6327893410', 1, 1, 1, 1, 1, 'AIzaSyDsFg6fd2lwqaxzsxN_W04Ox4_xcJfgbX4');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `latitude` double NOT NULL DEFAULT '0',
  `longitude` double NOT NULL DEFAULT '0',
  `dob` date DEFAULT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `is_profile_saved` enum('0','1') NOT NULL DEFAULT '0',
  `devId` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_blog`
--
ALTER TABLE `tbl_blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_bloodbanks`
--
ALTER TABLE `tbl_bloodbanks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_bloodgroups`
--
ALTER TABLE `tbl_bloodgroups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_blood_requests`
--
ALTER TABLE `tbl_blood_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_calls`
--
ALTER TABLE `tbl_calls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_donors`
--
ALTER TABLE `tbl_donors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_noti`
--
ALTER TABLE `tbl_noti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_blog`
--
ALTER TABLE `tbl_blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_bloodbanks`
--
ALTER TABLE `tbl_bloodbanks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_bloodgroups`
--
ALTER TABLE `tbl_bloodgroups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_blood_requests`
--
ALTER TABLE `tbl_blood_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_calls`
--
ALTER TABLE `tbl_calls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_donors`
--
ALTER TABLE `tbl_donors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_noti`
--
ALTER TABLE `tbl_noti`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
