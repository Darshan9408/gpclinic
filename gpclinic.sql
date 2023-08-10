-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2023 at 04:06 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gpclinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `bmi`
--

CREATE TABLE `bmi` (
  `Id` int(11) NOT NULL,
  `Weight` varchar(30) NOT NULL,
  `Bmi` varchar(30) NOT NULL,
  `Fat` varchar(30) NOT NULL,
  `BodyFatWeight` varchar(30) NOT NULL,
  `SkeletalMuscle` varchar(30) NOT NULL,
  `SkeletalMuscleWeight` varchar(30) NOT NULL,
  `Muscle` varchar(30) NOT NULL,
  `MuscleWeight` varchar(30) NOT NULL,
  `Water` varchar(30) NOT NULL,
  `WaterContent` varchar(30) NOT NULL,
  `VisceralFat` varchar(30) NOT NULL,
  `BoneMass` varchar(30) NOT NULL,
  `Metabolism` varchar(30) NOT NULL,
  `Protein` varchar(30) NOT NULL,
  `Obesity` varchar(30) NOT NULL,
  `BodyAge` varchar(30) NOT NULL,
  `LBM` varchar(30) NOT NULL,
  `OutdoorPatientDepartmentNumber` int(11) NOT NULL,
  `PatientId` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bmi`
--

INSERT INTO `bmi` (`Id`, `Weight`, `Bmi`, `Fat`, `BodyFatWeight`, `SkeletalMuscle`, `SkeletalMuscleWeight`, `Muscle`, `MuscleWeight`, `Water`, `WaterContent`, `VisceralFat`, `BoneMass`, `Metabolism`, `Protein`, `Obesity`, `BodyAge`, `LBM`, `OutdoorPatientDepartmentNumber`, `PatientId`) VALUES
(1, '75.7', '26.5', '25.3', '19.2', '37.3', '28.2', '70.9', '53.6', '53.1', '40.2', '11.5', '2.87', '1625.7', '17.8', '21.5', '37', '56.52', 1, 4),
(2, '97.85', '32.0', '31.5', '30.8', '34.5', '33.8', '65.7', '64.3', '50.2', '49.1', '18.0', '2.72', '1996.8', '15.6', '47.1', '29', '67.04', 2, 7),
(3, '59.4', '21.0', '27.8', '16.5', '37.8', '37.8', '66.9', '39.7', '50.3', '29.9', '4.5', '3.14', '1133', '16.6', '1.0', '34', '42.87', 3, 8),
(4, '100.8', '31.5', '31.1', '31.4', '35', '35.3', '66', '66.5', '50.2', '50.6', '19.0', '2.92', '2052', '15.8', '45.5', '32', '69.42', 4, 9),
(5, '67.95', '24.7', '23.1', '15.7', '38.0', '25.8', '72.1', '49.0', '54.3', '36.9', '12.0', '3.27', '1414.5', '17.7', '12.9', '43', '52.23', 5, 10),
(6, '70.0', '23.1', '20.0', '14.2', '40.6', '28.4', '74.9', '52.5', '55', '38.5', '9.5', '3.38', '1544.9', '20', '6.4', '34', '55.84', 6, 14);

-- --------------------------------------------------------

--
-- Table structure for table `bmiunit`
--

CREATE TABLE `bmiunit` (
  `Id` int(11) NOT NULL,
  `Weight` varchar(100) NOT NULL,
  `Bmi` varchar(100) NOT NULL,
  `Fat` varchar(100) NOT NULL,
  `BodyFatWeight` varchar(100) NOT NULL,
  `SkeletalMuscle` varchar(100) NOT NULL,
  `SkeletalMuscleWeight` varchar(100) NOT NULL,
  `Muscle` varchar(100) NOT NULL,
  `MuscleWeight` varchar(100) NOT NULL,
  `Water` varchar(100) NOT NULL,
  `WaterContent` varchar(100) NOT NULL,
  `VisceralFat` varchar(100) NOT NULL,
  `BoneMass` varchar(100) NOT NULL,
  `Metabolism` varchar(30) NOT NULL,
  `Protein` varchar(100) NOT NULL,
  `Obesity` varchar(100) NOT NULL,
  `BmiId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bmiunit`
--

INSERT INTO `bmiunit` (`Id`, `Weight`, `Bmi`, `Fat`, `BodyFatWeight`, `SkeletalMuscle`, `SkeletalMuscleWeight`, `Muscle`, `MuscleWeight`, `Water`, `WaterContent`, `VisceralFat`, `BoneMass`, `Metabolism`, `Protein`, `Obesity`, `BmiId`) VALUES
(1, 'High', 'High', 'High', 'High', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Low', 'Low', 'High', 'Excellent', 'Excellent', 'Excellent', 'Obese', 1),
(2, 'Obese', 'Obese', 'Obese', 'Obese', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Low', 'Low', 'Obese', 'Excellent', 'High', 'Low', 'Obese', 2),
(3, 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 3),
(4, 'Obese', 'Obese', 'Obese', 'Obese', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Low', 'Low', 'Obese', 'Excellent', 'High', 'Low', 'Obese', 4),
(5, 'Excellent', 'Excellent', 'High', 'High', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'High', 'Excellent', 'Low', 'Excellent', 'Obese', 5),
(6, 'Excellent', 'Excellent', 'High', 'High', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'High', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 6);

-- --------------------------------------------------------

--
-- Table structure for table `consultations`
--

CREATE TABLE `consultations` (
  `Id` int(11) NOT NULL,
  `DateTime` date NOT NULL,
  `OutdoorPatientDepartmentNumber` int(11) NOT NULL,
  `Complaint` text NOT NULL,
  `Remarks` text NOT NULL,
  `TotalChargedAmount` float NOT NULL,
  `DiscountAmount` float NOT NULL,
  `PatientId` int(11) NOT NULL,
  `IsDeleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consultations`
--

INSERT INTO `consultations` (`Id`, `DateTime`, `OutdoorPatientDepartmentNumber`, `Complaint`, `Remarks`, `TotalChargedAmount`, `DiscountAmount`, `PatientId`, `IsDeleted`) VALUES
(1, '2023-07-15', 1, 'pa', 'pa', 1000, 100, 1, 0),
(2, '2023-07-15', 2, '10', '10', 10000, 100, 1, 1),
(3, '2023-07-15', 3, '1', '1', 5000, 500, 1, 1),
(4, '2023-07-15', 4, '', '', 1000, 10, 1, 1),
(5, '2023-07-17', 5, '1', '1', 5000, 500, 1, 1),
(6, '2023-07-19', 6, '', '', 100, 0, 3, 0),
(7, '2023-07-21', 7, '1', '1', 1, 1, 3, 0),
(8, '2023-07-26', 8, '', '', 1, 1, 5, 0),
(9, '2023-07-26', 9, 'GASTRITES', '', 1, 1, 6, 0),
(10, '2023-07-27', 10, '', '', 1, 1, 4, 0),
(11, '2023-07-27', 11, '', '', 1, 1, 7, 0),
(12, '2023-07-27', 12, '', '', 1, 1, 8, 0),
(13, '2023-07-27', 13, '', '', 1, 1, 9, 0),
(14, '2023-07-27', 14, '', '', 1, 1, 10, 0),
(15, '2023-07-27', 15, '', '', 1, 1, 11, 0),
(16, '2023-07-27', 16, '', '', 1, 1, 12, 0),
(17, '2023-07-27', 17, '', '', 1, 1, 13, 0),
(18, '2023-07-28', 18, '', '', 1, 1, 14, 0),
(19, '2023-07-31', 19, '', '', 1, 1, 15, 0),
(20, '2023-08-01', 20, 'C/O FEVER , COLD ', '', 1, 1, 16, 0),
(21, '2023-08-02', 21, 'CONJECTIYITES', '', 1, 1, 17, 0),
(22, '2023-08-02', 22, 'C/O CONJ', '', 1, 1, 18, 0),
(23, '2023-08-02', 23, 'C/O CONJ', '', 1, 1, 19, 0),
(24, '2023-08-02', 24, '', '', 1, 1, 20, 0),
(25, '2023-08-02', 25, 'C/O CONJ', '', 1, 1, 21, 0),
(26, '2023-08-02', 26, 'C/O CONJ', '', 1, 1, 22, 0),
(27, '2023-08-02', 27, 'C/O CONJ', '', 1, 1, 23, 0),
(28, '2023-08-02', 28, '', '', 1, 1, 24, 0),
(29, '2023-08-02', 29, '1', '1', 1, 1, 24, 0),
(30, '2023-08-02', 30, '1', '1', 1, 1, 3, 0),
(31, '2023-08-02', 31, '', '', 1, 1, 11, 0),
(32, '2023-08-02', 32, '1', '1', 1, 1, 24, 0),
(33, '2023-08-02', 33, '', '', 1, 1, 5, 0),
(34, '2023-08-02', 34, '', '', 1, 1, 7, 0),
(35, '2023-08-02', 35, '11111', '1', 1, 1, 3, 0),
(36, '2023-08-02', 36, '', '', 1, 1, 10, 0),
(38, '2023-08-02', 37, '', '', 1, 1, 17, 0),
(39, '2023-08-02', 38, '', '', 1, 1, 16, 0);

-- --------------------------------------------------------

--
-- Table structure for table `consultationservices`
--

CREATE TABLE `consultationservices` (
  `Id` int(11) NOT NULL,
  `AmountCharged` float NOT NULL,
  `ConsultationId` int(11) NOT NULL,
  `ServiceId` int(11) NOT NULL,
  `IsDeleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consultationservices`
--

INSERT INTO `consultationservices` (`Id`, `AmountCharged`, `ConsultationId`, `ServiceId`, `IsDeleted`) VALUES
(1, 1200, 1, 1, 0),
(2, 1500, 1, 2, 0),
(4, 150, 10, 4, 0),
(5, 150, 11, 4, 0),
(6, 150, 12, 4, 0),
(7, 150, 13, 4, 0),
(8, 150, 14, 4, 0),
(9, 100, 15, 5, 0),
(10, 100, 16, 5, 0),
(11, 100, 17, 5, 0),
(12, 150, 18, 4, 0),
(14, 100, 20, 6, 0),
(15, 150, 31, 4, 0),
(16, 100, 34, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Company` varchar(255) NOT NULL,
  `Type` varchar(30) NOT NULL,
  `PricePerPiece` float NOT NULL,
  `MorningDose` tinyint(1) NOT NULL,
  `AfternoonDose` tinyint(1) NOT NULL,
  `EveningDose` tinyint(1) NOT NULL,
  `NightDose` tinyint(1) NOT NULL,
  `BeforeOrAfterFood` varchar(30) NOT NULL,
  `ExtraNotes` text NOT NULL,
  `IsDeleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`Id`, `Name`, `Company`, `Type`, `PricePerPiece`, `MorningDose`, `AfternoonDose`, `EveningDose`, `NightDose`, `BeforeOrAfterFood`, `ExtraNotes`, `IsDeleted`) VALUES
(1, 'dolo', 'd', 'Tablet', 10, 1, 1, 0, 1, 'After', 'null', 1),
(2, 'peracitamol', 'p', 'Tablet', 5, 0, 0, 1, 0, 'After', 'null', 1),
(3, 'pcm', 'shu', 'Tablet', 1.8, 1, 1, 1, 0, 'Before', '', 1),
(4, 'B- LYSINE MULTIVITAMIN SYRUP', 'FLAIRS', 'Syrup', 78, 0, 1, 0, 1, 'After', 'SUGER FREE', 0),
(5, 'RQ DSR ', 'JD ', 'Capsule', 0, 1, 1, 0, 1, 'Before', '', 0),
(6, 'CLOTRIN B LOTION ', 'NULIFE ', 'Tablet', 113, 1, 0, 1, 1, 'Before', 'CLOTRIMAZOLE LOTION ', 0),
(7, 'SPININ B 16 MG ', 'NULIFE ', 'Tablet', 16, 0, 1, 0, 1, 'After', '', 0),
(8, 'INJ. NEROBINE FORTE ', 'FLARIS ', 'Tablet', 75, 0, 0, 0, 0, 'Before', '', 1),
(9, 'IBUFLAR ', 'FLARIS', 'Syrup', 35, 0, 1, 0, 1, 'After', 'IBU AND PCM ', 0),
(10, 'T CLAV 625 ', 'FLAIRS', 'Tablet', 18, 1, 1, 0, 1, 'After', 'AMOXY + POT CLAV ', 0),
(11, 'T CLAV DRY ', 'FLARIS', 'Syrup', 67, 1, 1, 1, 0, 'After', 'AMOXI + POT CLAV ', 0),
(12, 'INJ. NEROBIN FORTE ', 'FLARIS', 'Capsule', 75, 0, 0, 0, 0, 'Before', 'MULTI VIT INJECTION ', 0),
(13, 'AIR M', 'ATOPIC', 'Tablet', 6.9, 1, 0, 1, 0, 'After', 'FEXO AND MONYE', 0),
(14, 'AKILOS 100', 'UNISON', 'Tablet', 1.8, 1, 1, 0, 1, 'After', 'ACECLO', 0),
(15, 'AKILOS MR ', 'UNISON ', 'Tablet', 4.32, 1, 0, 1, 0, 'After', 'ACECLO, PCM, CHLORO', 0),
(16, 'AKILOS P ', 'UNISON ', 'Tablet', 2.49, 1, 0, 1, 0, 'After', 'ACECLO AND PCM ', 0),
(17, 'B ZON ', 'UNISON ', 'Tablet', 0.6, 0, 1, 0, 0, 'After', 'BETAMETHASONE', 0),
(18, 'CALSIDON 250', 'UNISON ', 'Tablet', 1.86, 0, 1, 0, 0, 'After', 'CALSUIUM AND D3', 0),
(19, 'CYRA 40', 'SYSTOPIC ', 'Capsule', 4.8, 1, 1, 1, 0, 'Before', 'RABEPRAZOLE ', 0),
(20, 'CYRA D', 'SYSTOPIC ', 'Capsule', 4.7, 1, 1, 1, 0, 'Before', 'RABEPRAZOLE + DOMPERIDOM ', 0),
(21, 'DAN GEL ', 'UNISON ', 'Tablet', 54, 1, 0, 1, 0, 'Before', 'DICLO GEL ', 0),
(22, 'DIOMINIC DCA', 'UNISON ', 'Tablet', 3.8, 1, 1, 1, 0, 'After', 'CAFFINE,PCM,CPM', 0),
(23, 'FDSON 12 ', 'UNISON ', 'Tablet', 2.8, 0, 1, 0, 1, 'After', 'MULTIVIT ', 0),
(24, 'FDSONE PLUS ', 'UNISON ', 'Tablet', 2.49, 0, 1, 0, 1, 'After', 'MULTIVIT ', 0),
(25, 'L DIO 1', 'UNISON ', 'Tablet', 1.95, 1, 0, 1, 1, 'After', 'LEVOCET ', 0),
(26, 'L DIO 1 M ', 'UNISON', 'Tablet', 4.77, 0, 1, 0, 1, 'After', 'LEVOCET + MONTE', 0),
(27, 'LEVOSIZ M ', 'SYSTOPIC ', 'Tablet', 6.5, 0, 1, 0, 1, 'After', 'LEVOCET + MONTE ', 0),
(28, 'MONOPIC POWDR ', 'ATOPIC ', 'Tablet', 110, 1, 1, 1, 0, 'Before', 'CLOTRIMASOLE ', 0),
(29, 'MXSON CV 625', 'UNISON ', 'Tablet', 11, 1, 1, 1, 0, 'After', 'AMOXY AND POTCLAV ', 0),
(30, 'OSON 200', 'UNISON', 'Tablet', 6.3, 0, 1, 0, 1, 'After', 'OFLOX', 0),
(31, 'OSON O', 'UNISON ', 'Tablet', 6.5, 1, 1, 0, 1, 'After', 'OFLOX AND ORNIDA ', 0),
(32, 'PPSON D ', 'UNISON ', 'Tablet', 5.16, 1, 1, 1, 0, 'Before', 'PANTO AND DOMPARIDOM ', 0),
(33, 'SYSTAFLAM SPREY ', 'SYSTOPIC ', 'Tablet', 135, 1, 1, 1, 0, 'Before', 'DICLO SPREY', 0),
(34, 'ADOXY LB ', 'ATOPIC ', 'Capsule', 9.9, 0, 1, 0, 0, 'After', 'DOXY + LB', 0),
(35, 'AT MR ', 'ATOPIC ', 'Tablet', 4.8, 1, 0, 1, 0, 'After', 'DICLO, PCM AND CHLOR', 0),
(36, 'AT P ', 'ATOPIC ', 'Tablet', 3.08, 0, 1, 1, 0, 'After', 'DICLO AND PCM ', 0),
(37, 'AT SP ', 'ATOPIC ', 'Tablet', 6.8, 0, 1, 0, 1, 'After', 'DICLO , PCM, SERRETO', 0),
(38, 'ATCID D ', 'ATOPIC ', 'Capsule', 6.2, 1, 1, 0, 1, 'After', 'PANTO + DOMPERI', 0),
(39, 'ATCID DSR ', 'ATOPIC ', 'Capsule', 8.2, 1, 1, 1, 0, 'Before', 'PANTO + DOMPERI ', 0),
(40, 'ATEF CREAM ', 'ATOPIC ', 'Tablet', 99, 1, 1, 1, 0, 'Before', 'TERBINAFINE ', 0),
(41, 'ATIFLOX OZ ', 'ATOPIC ', 'Tablet', 8.9, 0, 1, 0, 1, 'After', 'OFLOX AND ORINIDA', 0),
(42, 'ATIKET ', 'ATOPIC ', 'Tablet', 11, 0, 1, 0, 1, 'After', 'KETOKONAZOLE ', 0),
(43, 'ATIKET CREAM ', 'ATOPIC ', 'Tablet', 108, 1, 1, 1, 0, 'Before', 'KETOKONAZOLE ', 0),
(44, 'ATIKET SHAMPOO ', 'ATOPIC ', 'Tablet', 218, 1, 1, 1, 0, 'Before', 'KETOKONAZOLE ', 0),
(45, 'ATMINIC ', 'ATOPIC ', 'Tablet', 2.1, 1, 0, 1, 0, 'After', 'DEXCHLORPHENIREMINE ', 0),
(46, 'AZIPIC 250', 'ATOPIC ', 'Tablet', 12.8, 0, 1, 0, 0, 'After', 'AZITHRO', 0),
(47, 'AZIPIC 500', 'ATOPIC ', 'Tablet', 23.33, 0, 1, 0, 0, 'After', 'AZITHRP', 0),
(48, 'BETAPIC GM CREAM ', 'ATOPIC ', 'Extra', 66, 1, 0, 1, 1, 'Before', 'NIOMYCINE, BECLO, AND CLOTRA', 0),
(49, 'CLEAN SOAP ', 'ATOPIC ', 'Extra', 74, 1, 0, 1, 0, 'Before', 'OILY SKIN ', 0),
(50, 'DICLOPIC GEL ', 'ATOPIC ', 'Extra', 96, 1, 1, 1, 0, 'Before', 'DICLO GEL ', 0),
(51, 'EVERA GEL ', 'ATOPIC ', 'Extra', 199, 1, 1, 1, 0, 'Before', 'ALOVERA', 0),
(52, 'EVERA SOAP', 'ATOPIC ', 'Extra', 84, 1, 0, 1, 0, 'Before', 'SOAP', 0),
(53, 'BURNFRESH CREAM', 'SMART ', 'Extra', 55, 1, 1, 1, 0, 'Before', 'SILVER SULFA ', 0),
(54, 'C FRESH L ', 'SMART', 'Tablet', 5, 1, 0, 1, 0, 'After', 'LEVOCETIRIZINE ', 0),
(55, 'C FRESH LM ', 'SMART', 'Tablet', 11, 1, 0, 1, 0, 'After', 'LEVOCET + MONTE', 0),
(56, 'COLDFRESH P ', 'SMART', 'Tablet', 4, 1, 0, 1, 0, 'After', 'CETRIZINE,PACM, PHYN', 0),
(57, 'D FRESH MR ', 'SMART', 'Tablet', 7.5, 1, 0, 1, 0, 'After', 'DICLO POT, PCM,CHLOR', 0),
(58, 'DOLOFRESH ', 'SMART', 'Tablet', 4, 1, 0, 1, 0, 'After', 'ACECLO + PCM', 0),
(59, 'DOLOFRESH SP ', 'SMART', 'Tablet', 8, 1, 0, 1, 0, 'After', 'ACECLO,PCM,SERRETO', 0),
(60, 'DOXYTREAT LB ', 'SMART', 'Capsule', 8, 0, 1, 0, 0, 'After', 'DOXY AND LB ', 0),
(61, 'LEVOSIZ M KID ', 'SMART', 'Tablet', 3.8, 1, 0, 1, 0, 'After', 'LEVOCET + MONTE', 0),
(62, 'LOPLOCK', 'SMART', 'Tablet', 2.4, 0, 1, 0, 1, 'After', 'LOPERMIDE ', 0),
(63, 'MEFIFRESH ', 'SMART', 'Tablet', 4.5, 1, 0, 1, 0, 'After', 'DICYCLO AND MEF', 0),
(64, 'O FRESH EYES DROPS ', 'SMART', 'Extra', 45, 1, 0, 1, 1, 'Before', 'OFLOX', 0),
(65, 'ORASMUTH GEL ', 'SMART', 'Extra', 50, 1, 0, 1, 1, 'Before', 'FOR MOUTH ULCER ', 0),
(66, 'PENGNOR JOINT GEL ', 'SMART ', 'Extra', 130, 1, 0, 1, 1, 'Before', 'DICLO GEL ', 0),
(67, 'PANGORE MR 500', 'SMART', 'Tablet', 8, 1, 0, 1, 0, 'After', 'DICLO POT, PCM , CHLOR ', 0),
(68, 'POVIFRESH OINTMENT ', 'SMART', 'Extra', 65, 1, 0, 1, 0, 'Before', 'BETADINE ', 0),
(69, 'RESPIJOY D SYRUP', 'SMART', 'Syrup', 62, 1, 1, 1, 0, 'After', 'COUGH', 0),
(70, 'RESPITHIK TR SYRUP', 'SMART', 'Syrup', 65, 1, 1, 1, 0, 'After', 'COUGH', 0),
(71, 'SILVEREX GEL', 'SMART', 'Extra', 142, 1, 1, 1, 0, 'After', 'SILVER SULFA ', 0),
(72, 'TUSSIHIK D SYRUP ', 'SMART', 'Syrup', 65, 1, 1, 1, 0, 'After', 'cough', 0),
(73, 'GENTLEE CREAM ', 'SMART', 'Extra', 20, 1, 1, 1, 0, 'Before', 'GENTAMAYCIN', 0),
(74, 'GESZA', 'SMART', 'Capsule', 4, 1, 1, 1, 0, 'Before', 'RABEPRAZOLE + DOMPERIDOM', 0),
(75, 'HAXIAT GARGAL ', '', 'Extra', 72, 1, 1, 1, 1, 'After', 'MOUTHWASH', 0),
(76, 'ITRAPIC 200', 'ATOPIC ', 'Capsule', 24, 0, 1, 0, 0, 'After', 'ITRACONAZOLE ', 0),
(77, 'ITRAPIC SB 50', '', 'Capsule', 12, 0, 1, 0, 1, 'After', 'ITRACONZOLE', 0),
(78, 'L ATRIZ M ', '', 'Tablet', 6.4, 1, 0, 1, 0, 'After', 'LEVOCET + MONTE ', 0),
(79, 'MONOPIC B CREAM ', '', 'Extra', 85, 1, 1, 1, 0, 'Before', 'CLOTE + BECLO ', 0),
(80, 'MONOPIC B LOTIOB ', '', 'Extra', 126, 1, 1, 1, 0, 'Before', 'CLOTE + BECLO ', 0),
(81, 'MOXIPIC CV ', '', 'Tablet', 17.5, 1, 1, 1, 0, 'Before', 'AMOXY + POTCLAV', 0),
(82, 'RQ DSR ', '', 'Capsule', 5.99, 1, 1, 1, 0, 'Before', 'RABEPRAZOLE + DOMPERI', 0),
(83, 'TOPIO HAIR OIL', '', 'Extra', 199, 1, 0, 0, 0, 'Before', '', 0),
(84, 'TOPIO HAIR WASH ', '', 'Extra', 160, 0, 0, 0, 0, 'Before', '', 0),
(85, 'TOPZEE G CREAM ', '', 'Extra', 59, 1, 0, 1, 0, 'Before', 'GENTAMICIN AND CLOBET', 0),
(86, 'TOPZEE M CREAM ', '', 'Extra', 88, 1, 1, 1, 0, 'Before', 'MICONAZAZOL +CLOBATE', 0),
(87, 'TONOFOLIC DS', '', 'Tablet', 1.9, 0, 1, 0, 0, 'After', 'IRON AND FOLIC ACID ', 0),
(88, 'TOPP D ', '', 'Capsule', 5.6, 1, 1, 1, 0, 'Before', 'PANTO + DOM', 0),
(89, 'APITIZER', 'JD', 'Syrup', 133, 0, 1, 0, 1, 'After', 'MULTIVIT', 0),
(90, 'CETIK LM ', 'JD', 'Tablet', 6, 1, 0, 1, 0, 'After', 'LEVOCET + MONTE', 0),
(91, 'HI Q AM SYRUP ', 'JD', 'Syrup', 64, 1, 1, 1, 0, 'After', 'COUGH', 0),
(92, 'HI Q DX SYRUP ', 'JD', 'Syrup', 78, 1, 1, 1, 0, 'After', 'DRY COUGH', 0),
(93, 'J DIX 200', 'JD ', 'Tablet', 12.5, 0, 1, 0, 1, 'After', 'CEFIXIAM + LB ', 0),
(94, 'JD COLD ', 'JD', 'Tablet', 5, 1, 0, 1, 0, 'After', 'AMROXOL,PCM,CPM ', 0),
(95, 'K CV 625', 'JD ', 'Tablet', 18.2, 1, 1, 1, 0, 'After', 'AMOXY +POT CV', 0),
(96, 'KUIX O ', 'JD ', 'Tablet', 14.8, 1, 0, 1, 0, 'After', 'CEFI, OFLOX+ LB ', 0),
(97, 'MEFCURE', 'JD', 'Tablet', 3.2, 0, 1, 0, 1, 'Before', 'DICYCLO ', 0),
(98, 'PARACARE 650', 'JD', 'Tablet', 2, 1, 0, 1, 0, 'After', 'PCM', 0),
(99, 'PQ D ', 'JD ', 'Capsule', 4.9, 1, 0, 1, 0, 'Before', 'PANTO + DOM ', 0),
(100, 'QFEN P', 'JD', 'Tablet', 3.9, 1, 0, 1, 0, 'After', 'ACECLO + PCM ', 0),
(101, 'QFEN SP ', 'JD', 'Tablet', 8, 1, 0, 1, 0, 'After', 'ACECLO, PCM, SERRTIO', 0),
(102, 'RQ 20', 'JD', 'Capsule', 3.2, 1, 1, 1, 0, 'Before', 'RABEPRAZOLE', 0),
(103, 'RQD 40', 'JD ', 'Capsule', 7.5, 1, 1, 1, 0, 'Before', 'RABEPRAZOLE + DOMPERI', 0);

-- --------------------------------------------------------

--
-- Table structure for table `parameters`
--

CREATE TABLE `parameters` (
  `Id` int(11) NOT NULL,
  `Tempreture` varchar(50) NOT NULL,
  `Pulse` varchar(50) NOT NULL,
  `BloodPressure` varchar(50) NOT NULL,
  `RespiratoryRate` varchar(50) NOT NULL,
  `RandomBloodSugar` varchar(50) NOT NULL,
  `Height` varchar(50) NOT NULL,
  `Weight` varchar(50) NOT NULL,
  `ConsultationId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parameters`
--

INSERT INTO `parameters` (`Id`, `Tempreture`, `Pulse`, `BloodPressure`, `RespiratoryRate`, `RandomBloodSugar`, `Height`, `Weight`, `ConsultationId`) VALUES
(1, '100', '100', '100', '100', '100', '100', '100', 1),
(3, '', '', '', '', '', '', '', 6),
(4, '1', '1', '1', '1', '1', '1', '1', 7),
(6, 'N', '72/MIN', '114/77', '18/MIN', '77/MIN', '', '', 8),
(7, 'N', '72/M', '110/72', '14/MIN', '', '', '', 9),
(8, '', '', '', '', '', '', '', 10),
(9, '', '', '', '', '', '', '', 11),
(10, '', '', '', '', '', '', '', 12),
(11, '', '', '', '', '', '', '', 13),
(12, '', '', '', '', '', '', '', 14),
(13, '', '', '', '', '', '', '', 15),
(14, '', '', '', '', '', '', '', 16),
(15, '', '', '', '', '', '', '', 17),
(16, '', '', '', '', '', '', '', 18),
(17, '', '', '', '', '', '', '', 19),
(19, '98.5', '', '', '', '', '', '', 20),
(21, '', '', '', '', '', '', '', 21),
(23, '', '', '', '', '', '', '', 22),
(25, '', '', '', '', '', '', '', 23),
(27, '', '', '', '', '', '', '', 24),
(29, '', '', '', '', '', '', '', 25),
(31, '', '', '', '', '', '', '', 26),
(33, '', '', '', '', '', '', '', 27),
(34, '', '', '', '', '', '', '', 28),
(35, '1', '1', '1', '1', '1', '1', '1', 29),
(36, '1', '1', '1', '11', '1', '1', '1', 30),
(37, '', '', '', '', '', '', '', 31),
(38, '1', '1', '1', '1', '1', '1', '1', 32),
(39, '', '', '', '', '', '', '', 33),
(40, '', '', '', '', '', '', '', 34),
(41, '111', '1', '11', '1', '1', '1', '1', 35),
(42, '', '', '', '', '', '', '', 36),
(44, '', '', '', '', '', '', '', 38),
(45, '', '', '', '', '', '', '', 39);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `RegistrationDateTime` date NOT NULL,
  `MasterRegistrationNumber` int(11) NOT NULL,
  `Age` int(11) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Address` text NOT NULL,
  `MobileNumber` varchar(10) NOT NULL,
  `IsDeleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`Id`, `Name`, `RegistrationDateTime`, `MasterRegistrationNumber`, `Age`, `Gender`, `Address`, `MobileNumber`, `IsDeleted`) VALUES
(1, 'darshan', '2023-07-15', 1, 21, 'male', 'jamnagar', '9408216169', 1),
(2, 'prince', '2023-07-17', 2, 20, 'male', 'jamnagar', '1234567890', 1),
(3, 'abc', '2023-07-19', 3, 23, 'male', 'jam', '232323', 0),
(4, 'YASHBHAI RAMANI ', '2023-07-26', 4, 23, 'male', 'JAMNAGAR ', '', 0),
(5, 'NARANBHAI PARMAR ', '2023-07-26', 5, 70, 'male', 'JAMNAGAR', '', 0),
(6, 'MAHENDRSINH JADEJA ', '2023-07-26', 6, 32, 'male', 'JAMNAGAR ', '', 0),
(7, 'JAIMINBHAI CHOVATIYA ', '2023-07-26', 7, 20, 'male', 'JAMNAGAR ', '', 0),
(8, 'RITABEN GALANI', '2023-07-26', 8, 45, 'female', 'JAMNAGAR', '', 0),
(9, 'DHARMIKBHAI BUSA ', '2023-07-26', 9, 22, 'male', 'JAMNAGRA ', '', 0),
(10, 'JAIMINBHAI GALANI ', '2023-07-27', 10, 47, 'male', 'JAMNAGAR', '', 0),
(11, 'CHINTU MANDAL ', '2023-07-27', 11, 22, 'male', 'JAMNAGAR', '', 0),
(12, 'SUMAN KUMAR', '2023-07-27', 12, 23, 'male', 'JAMNAGAR', '', 0),
(13, 'SANJAY SHA', '2023-07-27', 13, 21, 'male', 'JAMNAGAR', '', 0),
(14, 'VISHALBHAI SARDHARA', '2023-07-28', 14, 37, 'male', 'JAMNAGAR', '', 0),
(15, 'JYOTIBEN UPADHYAY', '2023-07-31', 15, 63, 'female', 'JAMNAGAR', '', 0),
(16, 'KOMELBEN ', '2023-08-01', 16, 43, 'female', 'JAMNAGAR', '', 0),
(17, 'ABHISHEKBHAI JANI', '2023-08-02', 17, 32, 'male', 'JAMNAGAR', '', 0),
(18, 'VISHVARAJSINH', '2023-08-02', 18, 16, 'male', 'JAMNAGAR', '', 0),
(19, 'GULAMBHAI', '2023-08-02', 19, 37, 'male', 'JAMNAGAR', '', 0),
(20, 'HARISHBHAI ', '2023-08-02', 20, 64, 'male', 'JAMNAGAR', '', 0),
(21, 'PRMODBHAI ', '2023-08-02', 21, 77, 'male', 'JAMNAGAR', '', 0),
(22, 'BHARTIBEN ', '2023-08-02', 22, 50, 'female', 'JAMNAGAR', '', 0),
(23, 'NAVINBHAI', '2023-08-02', 23, 72, 'male', 'JAMNAGAR', '', 0),
(24, 'XYZ', '2023-08-02', 24, 0, 'male', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `prescriptionmedicines`
--

CREATE TABLE `prescriptionmedicines` (
  `Id` int(11) NOT NULL,
  `Quantity` float NOT NULL,
  `PricePerPiece` float NOT NULL,
  `MorningDose` tinyint(1) NOT NULL,
  `AfternoonDose` tinyint(1) NOT NULL,
  `EveningDose` tinyint(1) NOT NULL,
  `NightDose` tinyint(1) NOT NULL,
  `BeforeOrAfterFood` varchar(30) NOT NULL,
  `PrescriptionId` int(11) NOT NULL,
  `MedicineId` int(11) NOT NULL,
  `Days` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescriptionmedicines`
--

INSERT INTO `prescriptionmedicines` (`Id`, `Quantity`, `PricePerPiece`, `MorningDose`, `AfternoonDose`, `EveningDose`, `NightDose`, `BeforeOrAfterFood`, `PrescriptionId`, `MedicineId`, `Days`) VALUES
(1, 6, 5, 1, 1, 1, 1, 'Before', 1, 1, 2),
(3, 9, 1.8, 1, 1, 1, 0, 'Before', 3, 3, 3),
(4, 1, 1.8, 1, 1, 1, 0, 'Before', 4, 3, 0),
(6, 1, 0, 0, 0, 0, 1, 'After', 6, 4, 0),
(7, 9, 0, 1, 1, 0, 1, 'Before', 7, 5, 3),
(8, 6, 14.8, 1, 1, 1, 1, 'After', 17, 96, 3),
(9, 6, 6.2, 1, 1, 1, 1, 'After', 17, 38, 3),
(13, 10, 5, 1, 0, 1, 0, 'After', 19, 94, 5),
(14, 15, 3.2, 1, 1, 1, 0, 'After', 19, 102, 5),
(15, 1, 64, 1, 1, 1, 0, 'After', 19, 91, 5),
(19, 1, 45, 1, 1, 1, 1, 'Before', 21, 64, 5),
(20, 6, 1.8, 1, 0, 1, 0, 'After', 21, 14, 3),
(21, 6, 1.95, 1, 0, 1, 0, 'After', 21, 25, 3),
(25, 1, 45, 1, 1, 1, 1, 'Before', 23, 64, 5),
(26, 6, 1.95, 1, 0, 1, 0, 'After', 23, 25, 3),
(27, 6, 1.8, 1, 0, 1, 0, 'After', 23, 14, 3),
(31, 1, 45, 1, 1, 1, 1, 'Before', 25, 64, 0),
(32, 6, 1.95, 1, 0, 1, 0, 'After', 25, 25, 3),
(33, 6, 1.8, 1, 0, 1, 0, 'After', 25, 14, 3),
(35, 1, 45, 1, 1, 1, 1, 'Before', 27, 64, 5),
(39, 1, 45, 1, 1, 1, 1, 'Before', 29, 64, 5),
(40, 6, 1.8, 1, 0, 1, 0, 'After', 29, 14, 3),
(41, 6, 6, 1, 0, 1, 0, 'After', 29, 90, 3),
(45, 1, 45, 1, 1, 1, 1, 'Before', 31, 64, 5),
(46, 1, 1.95, 1, 0, 1, 0, 'After', 31, 25, 3),
(47, 1, 1.8, 1, 0, 1, 0, 'After', 31, 14, 3),
(51, 1, 45, 1, 1, 1, 1, 'Before', 33, 64, 5),
(52, 6, 1.95, 1, 0, 1, 0, 'After', 33, 25, 3),
(53, 6, 1.8, 1, 0, 1, 0, 'After', 33, 14, 3),
(54, 1, 45, 1, 1, 1, 1, 'Before', 34, 64, 5),
(55, 6, 5, 1, 1, 1, 1, 'After', 34, 54, 3),
(56, 6, 1.8, 1, 1, 1, 1, 'After', 34, 14, 3),
(57, 1, 78, 0, 0, 0, 0, 'After', 35, 4, 0),
(58, 1, 113, 0, 0, 0, 0, 'Before', 35, 6, 0),
(59, 1, 4.7, 0, 0, 0, 0, 'Before', 35, 20, 0),
(60, 1, 2.8, 1, 1, 1, 1, 'After', 36, 23, 0),
(61, 1, 1.86, 1, 1, 1, 1, 'After', 36, 18, 0),
(62, 1, 75, 1, 1, 1, 1, 'Before', 36, 12, 0),
(63, 1, 16, 1, 1, 1, 1, 'After', 36, 7, 0),
(64, 1, 4.8, 1, 1, 1, 1, 'Before', 37, 19, 0),
(65, 1, 4.7, 1, 1, 1, 1, 'Before', 37, 20, 0),
(66, 1, 78, 1, 1, 1, 1, 'After', 37, 4, 0),
(67, 1, 16, 1, 1, 1, 1, 'After', 38, 7, 0),
(68, 1, 67, 1, 1, 1, 1, 'After', 38, 11, 0),
(69, 1, 4.32, 1, 1, 1, 1, 'After', 38, 15, 0),
(70, 1, 54, 1, 0, 1, 0, 'Before', 39, 21, 0),
(71, 1, 78, 1, 1, 0, 1, 'After', 40, 4, 0),
(72, 1, 18, 1, 1, 0, 1, 'After', 40, 10, 0),
(73, 1, 113, 1, 0, 1, 1, 'After', 41, 6, 0),
(74, 1, 4.7, 1, 0, 1, 1, 'After', 41, 20, 0),
(75, 1, 16, 1, 0, 1, 1, 'Before', 41, 7, 0),
(76, 1, 0.6, 1, 0, 1, 1, 'Before', 41, 17, 0),
(77, 1, 2.49, 0, 1, 1, 0, 'Before', 42, 16, 0),
(78, 1, 0.6, 0, 1, 1, 0, 'After', 42, 17, 0),
(81, 1, 1.86, 1, 1, 0, 0, 'After', 44, 18, 0),
(82, 1, 2.49, 1, 1, 0, 0, 'Before', 44, 24, 0),
(83, 1, 54, 1, 1, 1, 0, 'Before', 45, 21, 0),
(84, 1, 3.8, 1, 1, 1, 0, 'After', 45, 22, 0);

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `Id` int(11) NOT NULL,
  `PrescribedOnDateTime` datetime NOT NULL,
  `ExtraNotes` text NOT NULL,
  `TotalPrice` float NOT NULL,
  `ConsultationId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`Id`, `PrescribedOnDateTime`, `ExtraNotes`, `TotalPrice`, `ConsultationId`) VALUES
(1, '2023-07-15 00:00:00', '100', 900, 1),
(3, '2023-07-19 00:00:00', '', 100, 6),
(4, '2023-07-21 00:00:00', '1', 1, 7),
(6, '2023-07-26 00:00:00', 'C/O 10 YREAS DM ', 1, 8),
(7, '2023-07-26 00:00:00', '', 1, 9),
(8, '2023-07-27 00:00:00', '', 1, 10),
(9, '2023-07-27 00:00:00', '', 1, 11),
(10, '2023-07-27 00:00:00', '', 1, 12),
(11, '2023-07-27 00:00:00', '', 1, 13),
(12, '2023-07-27 00:00:00', '', 1, 14),
(13, '2023-07-27 00:00:00', '', 1, 15),
(14, '2023-07-27 00:00:00', '', 1, 16),
(15, '2023-07-27 00:00:00', '', 1, 17),
(16, '2023-07-28 00:00:00', '', 1, 18),
(17, '2023-07-31 00:00:00', '', 1, 19),
(19, '2023-08-01 00:00:00', '', 1, 20),
(21, '2023-08-02 00:00:00', '', 1, 21),
(23, '2023-08-02 00:00:00', '', 1, 22),
(25, '2023-08-02 00:00:00', '', 1, 23),
(27, '2023-08-02 00:00:00', '', 1, 24),
(29, '2023-08-02 00:00:00', '', 1, 25),
(31, '2023-08-02 00:00:00', '', 1, 26),
(33, '2023-08-02 00:00:00', '', 1, 27),
(34, '2023-08-02 00:00:00', '', 1, 28),
(35, '2023-08-02 00:00:00', '1', 1, 29),
(36, '2023-08-02 00:00:00', '1', 1, 30),
(37, '2023-08-02 00:00:00', '', 1, 31),
(38, '2023-08-02 00:00:00', '1', 1, 32),
(39, '2023-08-02 00:00:00', '', 1, 33),
(40, '2023-08-02 00:00:00', '', 1, 34),
(41, '2023-08-02 00:00:00', '1', 1, 35),
(42, '2023-08-02 00:00:00', '', 1, 36),
(44, '2023-08-02 00:00:00', '', 1, 38),
(45, '2023-08-02 00:00:00', '', 1, 39);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `DefaultAmount` float NOT NULL,
  `IsDeleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`Id`, `Name`, `DefaultAmount`, `IsDeleted`) VALUES
(1, 'xray', 1000, 1),
(2, 'dresing', 150, 1),
(3, 'consultation', 100, 1),
(4, 'CONSULTATION + BMI ', 150, 0),
(5, 'FITNESS', 100, 0),
(6, 'CONSULTATION', 100, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `Username`, `Password`) VALUES
(1, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bmi`
--
ALTER TABLE `bmi`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `patientIdinbmiunit` (`PatientId`);

--
-- Indexes for table `bmiunit`
--
ALTER TABLE `bmiunit`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `BmiId` (`BmiId`);

--
-- Indexes for table `consultations`
--
ALTER TABLE `consultations`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `OutdoorPatientDepartmentNumber` (`OutdoorPatientDepartmentNumber`),
  ADD KEY `FkPatientIdInConsultations` (`PatientId`);

--
-- Indexes for table `consultationservices`
--
ALTER TABLE `consultationservices`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FkConsultationIdInConsultationServices` (`ConsultationId`),
  ADD KEY `FkServiceIdInConsultationServices` (`ServiceId`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `parameters`
--
ALTER TABLE `parameters`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FkConsultationIdInParameters` (`ConsultationId`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `MasterRegistrationNumber` (`MasterRegistrationNumber`);

--
-- Indexes for table `prescriptionmedicines`
--
ALTER TABLE `prescriptionmedicines`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FkPrescriptionIdInPrescriptionMedicines` (`PrescriptionId`),
  ADD KEY `FkMedicineIdInPrescriptionMedicines` (`MedicineId`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FkConsultationIdInPrescriptions` (`ConsultationId`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bmi`
--
ALTER TABLE `bmi`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bmiunit`
--
ALTER TABLE `bmiunit`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `consultations`
--
ALTER TABLE `consultations`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `consultationservices`
--
ALTER TABLE `consultationservices`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `parameters`
--
ALTER TABLE `parameters`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `prescriptionmedicines`
--
ALTER TABLE `prescriptionmedicines`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bmi`
--
ALTER TABLE `bmi`
  ADD CONSTRAINT `patientIdinbmiunit` FOREIGN KEY (`PatientId`) REFERENCES `patients` (`Id`);

--
-- Constraints for table `bmiunit`
--
ALTER TABLE `bmiunit`
  ADD CONSTRAINT `bmiunit_ibfk_1` FOREIGN KEY (`BmiId`) REFERENCES `bmi` (`Id`);

--
-- Constraints for table `consultations`
--
ALTER TABLE `consultations`
  ADD CONSTRAINT `FkPatientIdInConsultations` FOREIGN KEY (`PatientId`) REFERENCES `patients` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `consultationservices`
--
ALTER TABLE `consultationservices`
  ADD CONSTRAINT `FkConsultationIdInConsultationServices` FOREIGN KEY (`ConsultationId`) REFERENCES `consultations` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FkServiceIdInConsultationServices` FOREIGN KEY (`ServiceId`) REFERENCES `services` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `parameters`
--
ALTER TABLE `parameters`
  ADD CONSTRAINT `FkConsultationIdInParameters` FOREIGN KEY (`ConsultationId`) REFERENCES `consultations` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `prescriptionmedicines`
--
ALTER TABLE `prescriptionmedicines`
  ADD CONSTRAINT `FkMedicineIdInPrescriptionMedicines` FOREIGN KEY (`MedicineId`) REFERENCES `medicines` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FkPrescriptionIdInPrescriptionMedicines` FOREIGN KEY (`PrescriptionId`) REFERENCES `prescriptions` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `FkConsultationIdInPrescriptions` FOREIGN KEY (`ConsultationId`) REFERENCES `consultations` (`Id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
