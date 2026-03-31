-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2026 at 06:47 AM
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
-- Database: `opac_db`
--

-- --------------------------------------------------------

-- Table structure for table `books`

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `dewey_decimal` varchar(10) DEFAULT NULL,
  `year_published` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `status` varchar(20) DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `author`, `category`, `dewey_decimal`, `year_published`, `due_date`, `status`) VALUES
(4, 'Harry Potter', 'J. K. Rowling', 'American Literature', '813.6', 1997, '0000-00-00', 'Available'),
(5, 'To All The Boys Ive Loved Before', 'Jenny Han', 'American Literature', '813.6', 2014, '0000-00-00', 'Available'),
(6, 'I Want to Die but I Want to Eat Tteokbokki ', 'Baek Se-hee', 'Korean Literature', '897.7', 2018, '0000-00-00', 'Available'),
(7, 'The Fault in Our Stars', 'John Green', 'American Literature', '813.6', 2012, '0000-00-00', 'Available'),
(8, 'The Great Gatsby', 'The Great Gatsby', 'American Literature', '813.6', 1925, '0000-00-00', 'Available'),
(9, 'Harry Potter and the Sorcerer’s Stone', 'J.K. Rowling', 'English Literature', '823.91', 1997, '0000-00-00', 'Available'),
(10, 'The Hunger Games', 'The Hunger Games', 'American Literature', '813.6', 2008, '0000-00-00', 'Available'),
(11, 'Pride and Prejudice', 'Jane Austen', 'English Literature', '823.91', 1813, '0000-00-00', 'Available'),
(12, '1984', 'George Orwell', 'English Literature', '823.91', 1949, '0000-00-00', 'Available'),
(13, 'The Hobbit', 'J.R.R. Tolkien', 'English Literature', '823.91', 1937, '0000-00-00', 'Available'),
(14, 'Kim Jiyoung, Born 1982', 'Cho Nam-joo', 'Korean Literature', '897.7', 2016, '0000-00-00', 'Available'),
(15, 'Please Look After Mom', 'Shin Kyung-sook', 'Korean Literature', '897.7', 2008, '0000-00-00', 'Available'),
(16, 'Steve Jobs', 'Walter Isaacson', 'Biography', '920', 2011, '0000-00-00', 'Available'),
(17, 'The Diary of a Young Girl', 'Anne Frank', 'Biography', '920', 1947, '0000-00-00', 'Available'),
(18, 'Biography', 'Michelle Obama', 'Biography', '920', 2018, '0000-00-00', 'Available'),
(19, 'A Brief History of Time', 'Stephen Hawking', 'Science', '500', 1988, '0000-00-00', 'Available'),
(20, 'The Selfish Gene', 'The Selfish Gene', 'Science', '500', 1976, '0000-00-00', 'Available'),
(21, 'Clean Code', 'Robert C. Martin', 'Technology', '600', 2008, '0000-00-00', 'Available'),
(22, 'The Pragmatic Programmer', 'Andrew Hunt', 'Technology', '600', 1999, '0000-00-00', 'Available'),
(23, 'Sapiens: A Brief History of Humankind', 'Yuval Noah Harari', 'History', '900', 2011, '0000-00-00', 'Available'),
(24, 'Guns, Germs, and Steel', 'Jared Diamond', 'Biography', '920', 1997, '0000-00-00', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `borrow_records`
--

CREATE TABLE `borrow_records` (
  `borrow_id` int(11) NOT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `borrow_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `actual_return_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrow_records`
--

INSERT INTO `borrow_records` (`borrow_id`, `user_name`, `book_id`, `borrow_date`, `return_date`, `actual_return_date`) VALUES
(1, 'Louise Justine J. Oraye', 5, '2026-03-16', '2026-03-17', '2026-03-18'),
(2, 'Louise Justine J. Oraye', 4, '2026-03-08', '2026-03-16', '2026-03-18'),
(3, 'Louise Justine J. Oraye', 4, '2026-03-08', '2026-03-16', '2026-03-18'),
(4, 'Louise Justine J. Oraye', 4, '2026-03-08', '2026-03-16', '2026-03-18'),
(5, 'Dannah Mikayla M. Sanchez', 6, '2026-03-16', '2026-03-17', '2026-03-18'),
(6, 'Prince S. Laxamana', 5, '2026-03-14', '2026-03-18', '2026-03-18'),
(7, 'Louise Justine J. Oraye', 4, '2026-03-17', '2026-03-18', '2026-03-18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `borrow_records`
--
ALTER TABLE `borrow_records`
  ADD PRIMARY KEY (`borrow_id`),
  ADD KEY `book_id` (`book_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `borrow_records`
--
ALTER TABLE `borrow_records`
  MODIFY `borrow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrow_records`
--
ALTER TABLE `borrow_records`
  ADD CONSTRAINT `borrow_records_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
