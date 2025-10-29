-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2024 at 07:47 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brainlink`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone_number` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `name`, `phone_number`) VALUES
(123456, 'Ahmed Hamdy', '011569823159');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `age` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `name`, `phone_number`, `age`) VALUES
(10026, 'Maha Ahmed', '01236250256', '77'),
(10235, 'Medhat Mohamed', '01210005698', '35'),
(15987, 'Magdy Saif', '01536218025', '23'),
(20155, 'Salama Samy', '01523601253', '49'),
(20215, 'Noura Alsayed', '01023620120', '42'),
(22701, 'Samy Sameh', '01236521486', '55'),
(22708, 'Malak Bahaa', '01023054002', '22'),
(22709, 'Salma Mohamed', '01532012365', '47'),
(23615, 'Ehsan Hassan', '01253657023', '69'),
(32532, 'Mona Mohamed', '01025631785', '32'),
(63145, 'Mohab Ahmed', '01115963287', '38'),
(66539, 'Hager Ehab', '01136985146', '80'),
(98769, 'Ola Magdy', '01532692034', '66');

-- --------------------------------------------------------

--
-- Table structure for table `scans`
--

CREATE TABLE `scans` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `mri_image` varchar(255) DEFAULT NULL,
  `mask_image` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `diagnosis` tinyint(4) DEFAULT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scans`
--

INSERT INTO `scans` (`id`, `patient_id`, `mri_image`, `mask_image`, `date`, `diagnosis`, `note`) VALUES
(25, 63145, 'uploads/mri_63145_20241029204739.tif', 'uploads/mask_63145_20241029204739.png', '2024-10-29', 0, ''),
(26, 15987, 'uploads/mri_15987_20241029205923.tif', 'uploads/mask_15987_20241029205923.png', '2024-10-29', 1, 'MRI results indicate a tumor presence. Strongly advised to start treatment planning discussions and explore options like radiotherapy or chemotherapy. Schedule follow-up MRIs regularly for tracking progress.'),
(27, 20215, 'uploads/mri_20215_20241029210151.tif', 'uploads/mask_20215_20241029210151.png', '2024-10-21', 1, 'Signs of a tumor were observed. Consider scheduling a biopsy to determine the type and stage of the tumor. MRI follow-ups are necessary every 3 months to assess the tumor\'s progression.'),
(28, 22701, 'uploads/mri_22701_20241029210421.tif', 'uploads/mask_22701_20241029210421.png', '2024-09-04', 0, ''),
(29, 66539, 'uploads/mri_66539_20241029211550.tif', 'uploads/mask_66539_20241029211550.png', '2024-01-08', 0, 'MRI shows no abnormal findings. Advised to monitor for any unusual symptoms and follow up annually or as needed.'),
(30, 32532, 'uploads/mri_32532_20241029211739.tif', 'uploads/mask_32532_20241029211739.png', '2023-08-29', 0, 'No signs of a tumor at this time. Routine screening suggested after a year to keep track of overall brain health.'),
(31, 23615, 'uploads/mri_23615_20241029212252.tif', 'uploads/mask_23615_20241029212252.png', '2023-08-05', 0, 'No tumor detected in this scan. Maintain regular check-ups as advised, and consider scheduling routine MRIs every 12 months as a precaution.'),
(32, 98769, 'uploads/mri_98769_20241029212846.tif', 'uploads/mask_98769_20241029212846.png', '2022-10-31', 1, 'Initial tumor detection on this scan. Immediate follow-up scans advised to establish growth rate and determine if intervention is needed. Consultation with an oncologist for further evaluation may be beneficial.'),
(33, 98769, 'uploads/mri_98769_20241029213030.tif', 'uploads/mask_98769_20241029213030.png', '2023-08-09', 1, 'Tumor detected, consistent with previous observations. No significant growth since the last scan in October 2022, suggesting a stable condition. Monitoring recommended every 6-12 months to ensure stability.'),
(34, 98769, 'uploads/mri_98769_20241029213453.tif', 'uploads/mask_98769_20241029213453.png', '2024-10-29', 1, 'MRI indicates a persistent tumor presence with minimal change in size or shape compared to previous scans. Recommend continued monitoring, with the next scan in 6 months. Consider discussing potential treatment options if any symptoms arise.'),
(35, 10235, 'uploads/mri_10235_20241029214653.tif', 'uploads/mask_10235_20241029214653.png', '2024-08-05', 0, ''),
(36, 20215, 'uploads/mri_20215_20241030073359.tif', 'uploads/mask_20215_20241030073359.png', '2023-05-17', 1, ''),
(37, 22708, 'uploads/mri_22708_20241030074758.tif', 'uploads/mask_22708_20241030074758.png', '2024-10-30', 0, 'Clear MRI with no tumor presence. Continue with a balanced diet and a healthy lifestyle. Yearly scans may be beneficial for ongoing health monitoring.'),
(39, 22709, 'uploads/mri_22709_20241030080134.tif', 'uploads/mask_22709_20241030080134.png', '2024-10-30', 1, 'Tumor detected in this MRI scan. Immediate consultation with an oncologist is recommended for a personalized treatment plan. Follow-up scans are advised every 3-6 months to monitor any changes.'),
(40, 10026, 'uploads/mri_10026_20241030080405.tif', 'uploads/mask_10026_20241030080405.png', '2024-10-30', 0, 'Clear MRI with no tumor presence. Continue with a balanced diet and a healthy lifestyle. Yearly scans may be beneficial for ongoing health monitoring.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `scans`
--
ALTER TABLE `scans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `scans`
--
ALTER TABLE `scans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `scans`
--
ALTER TABLE `scans`
  ADD CONSTRAINT `scans_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
