-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2026 at 05:19 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task5`
--

-- --------------------------------------------------------

--
-- Table structure for table `aircraft`
--

CREATE TABLE `aircraft` (
  `AircraftID` int(11) NOT NULL,
  `Model` varchar(100) NOT NULL,
  `Capacity` int(11) NOT NULL,
  `AirlineID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aircraft`
--

INSERT INTO `aircraft` (`AircraftID`, `Model`, `Capacity`, `AirlineID`) VALUES
(1, 'Boeing 737', 180, 1);

-- --------------------------------------------------------

--
-- Table structure for table `aircraft_route`
--

CREATE TABLE `aircraft_route` (
  `AircraftID` int(11) NOT NULL,
  `RouteID` int(11) NOT NULL,
  `DepartureDateTime` datetime NOT NULL,
  `ArrivalDateTime` datetime NOT NULL,
  `NumberOfPassengers` int(11) DEFAULT NULL,
  `TicketPrice` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aircraft_route`
--

INSERT INTO `aircraft_route` (`AircraftID`, `RouteID`, `DepartureDateTime`, `ArrivalDateTime`, `NumberOfPassengers`, `TicketPrice`) VALUES
(1, 1, '2026-06-01 08:00:00', '2026-06-01 12:00:00', 150, 500.00);

-- --------------------------------------------------------

--
-- Table structure for table `airline`
--

CREATE TABLE `airline` (
  `AirlineID` int(11) NOT NULL,
  `AirlineName` varchar(100) NOT NULL,
  `Address` varchar(200) DEFAULT NULL,
  `ContactPerson` varchar(100) DEFAULT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `CurrentBalance` decimal(18,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `airline`
--

INSERT INTO `airline` (`AirlineID`, `AirlineName`, `Address`, `ContactPerson`, `PhoneNumber`, `CurrentBalance`) VALUES
(1, 'EgyptAir', 'Cairo, Egypt', 'Ahmed Hassan', '01101017917', 504000.00),
(2, 'Emirates', 'Dubai, UAE', 'Mohammed Ali', '0509876543', 1200000.00);

-- --------------------------------------------------------

--
-- Table structure for table `crew`
--

CREATE TABLE `crew` (
  `CrewID` int(11) NOT NULL,
  `MajorPilot` varchar(100) NOT NULL,
  `AssistantPilot` varchar(100) NOT NULL,
  `Hostess1` varchar(100) NOT NULL,
  `Hostess2` varchar(100) NOT NULL,
  `AircraftID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EmployeeID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `BirthDate` date DEFAULT NULL,
  `Gender` enum('Male','Female') NOT NULL,
  `Position` enum('Manager','Pilot','Engineer','Accountant','Administrator') NOT NULL,
  `AirlineID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EmployeeID`, `Name`, `BirthDate`, `Gender`, `Position`, `AirlineID`) VALUES
(1, 'Ammar Khaled', '1995-05-10', 'Male', 'Manager', 1);

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `RouteID` int(11) NOT NULL,
  `Origin` varchar(100) NOT NULL,
  `Destination` varchar(100) NOT NULL,
  `Distance` decimal(10,2) DEFAULT NULL,
  `Classification` enum('Domestic','International') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`RouteID`, `Origin`, `Destination`, `Distance`, `Classification`) VALUES
(1, 'Cairo', 'Dubai', 2400.00, 'International');

-- --------------------------------------------------------

--
-- Table structure for table `transactiontable`
--

CREATE TABLE `transactiontable` (
  `TransactionID` int(11) NOT NULL,
  `TransactionType` enum('Buy','Sell') NOT NULL,
  `Amount` decimal(18,2) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `TransactionDate` date NOT NULL,
  `AirlineID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactiontable`
--

INSERT INTO `transactiontable` (`TransactionID`, `TransactionType`, `Amount`, `Description`, `TransactionDate`, `AirlineID`) VALUES
(1, 'Sell', 5000.00, 'Ticket Sales', '2026-06-01', 1),
(2, 'Buy', 1000.00, 'Fuel Cost', '2026-06-01', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aircraft`
--
ALTER TABLE `aircraft`
  ADD PRIMARY KEY (`AircraftID`),
  ADD KEY `FK_Aircraft_Airline` (`AirlineID`);

--
-- Indexes for table `aircraft_route`
--
ALTER TABLE `aircraft_route`
  ADD PRIMARY KEY (`AircraftID`,`RouteID`),
  ADD KEY `FK_AR_Route` (`RouteID`);

--
-- Indexes for table `airline`
--
ALTER TABLE `airline`
  ADD PRIMARY KEY (`AirlineID`);

--
-- Indexes for table `crew`
--
ALTER TABLE `crew`
  ADD PRIMARY KEY (`CrewID`),
  ADD UNIQUE KEY `AircraftID` (`AircraftID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EmployeeID`),
  ADD KEY `FK_Employee_Airline` (`AirlineID`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`RouteID`);

--
-- Indexes for table `transactiontable`
--
ALTER TABLE `transactiontable`
  ADD PRIMARY KEY (`TransactionID`),
  ADD KEY `FK_Transaction_Airline` (`AirlineID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aircraft`
--
ALTER TABLE `aircraft`
  MODIFY `AircraftID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `airline`
--
ALTER TABLE `airline`
  MODIFY `AirlineID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `crew`
--
ALTER TABLE `crew`
  MODIFY `CrewID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `EmployeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `route`
--
ALTER TABLE `route`
  MODIFY `RouteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactiontable`
--
ALTER TABLE `transactiontable`
  MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aircraft`
--
ALTER TABLE `aircraft`
  ADD CONSTRAINT `FK_Aircraft_Airline` FOREIGN KEY (`AirlineID`) REFERENCES `airline` (`AirlineID`);

--
-- Constraints for table `aircraft_route`
--
ALTER TABLE `aircraft_route`
  ADD CONSTRAINT `FK_AR_Aircraft` FOREIGN KEY (`AircraftID`) REFERENCES `aircraft` (`AircraftID`),
  ADD CONSTRAINT `FK_AR_Route` FOREIGN KEY (`RouteID`) REFERENCES `route` (`RouteID`);

--
-- Constraints for table `crew`
--
ALTER TABLE `crew`
  ADD CONSTRAINT `FK_Crew_Aircraft` FOREIGN KEY (`AircraftID`) REFERENCES `aircraft` (`AircraftID`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `FK_Employee_Airline` FOREIGN KEY (`AirlineID`) REFERENCES `airline` (`AirlineID`);

--
-- Constraints for table `transactiontable`
--
ALTER TABLE `transactiontable`
  ADD CONSTRAINT `FK_Transaction_Airline` FOREIGN KEY (`AirlineID`) REFERENCES `airline` (`AirlineID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
