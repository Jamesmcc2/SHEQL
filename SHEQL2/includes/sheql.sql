-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Jan 19, 2016 at 01:47 AM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `sheql1`
--

-- --------------------------------------------------------

--
-- Table structure for table `sn_favorites`
--

CREATE TABLE `sn_favorites` (
  `id` int(11) NOT NULL,
  `pic_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sn_images`
--

CREATE TABLE `sn_images` (
  `id` int(11) NOT NULL,
  `file` varchar(200) NOT NULL,
  `picture_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sn_pictures`
--

CREATE TABLE `sn_pictures` (
  `pic_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `medical_code` text NOT NULL,
  `facility` text NOT NULL,
  `facility_zip_code` varchar(5) NOT NULL,
  `icd9` varchar(11) NOT NULL,
  `icd10` varchar(11) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `file` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL,
  `keywords` text NOT NULL,
  `type` varchar(250) NOT NULL,
  `summary` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` varchar(11) NOT NULL,
  `institution` varchar(250) NOT NULL,
  `physician` varchar(250) NOT NULL,
  `cost` varchar(11) NOT NULL,
  `cost2` varchar(11) NOT NULL,
  `state` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sn_users`
--

CREATE TABLE `sn_users` (
  `user_id` int(11) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `address` varchar(200) NOT NULL,
  `zip` varchar(250) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `unique_id` int(8) NOT NULL,
  `super` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sn_favorites`
--
ALTER TABLE `sn_favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sn_images`
--
ALTER TABLE `sn_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sn_pictures`
--
ALTER TABLE `sn_pictures`
  ADD PRIMARY KEY (`pic_id`);

--
-- Indexes for table `sn_users`
--
ALTER TABLE `sn_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sn_favorites`
--
ALTER TABLE `sn_favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sn_images`
--
ALTER TABLE `sn_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sn_pictures`
--
ALTER TABLE `sn_pictures`
  MODIFY `pic_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sn_users`
--
ALTER TABLE `sn_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;