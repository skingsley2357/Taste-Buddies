-- phpMyAdmin SQL Dump
-- version 5.1.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 12, 2024 at 09:47 PM
-- Server version: 5.7.44-48-log
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbv4q3sg6wsoto`
--
CREATE DATABASE IF NOT EXISTS `dbv4q3sg6wsoto` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dbv4q3sg6wsoto`;

-- --------------------------------------------------------

--
-- Table structure for table `Buddies`
--

CREATE TABLE `Buddies` (
  `buddie_id` int(11) NOT NULL,
  `follower_id` int(11) DEFAULT NULL,
  `following_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE `Comments` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `recipe_id` int(11) DEFAULT NULL,
  `comment_text` varchar(255) DEFAULT NULL,
  `comment_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Cuisine`
--

CREATE TABLE `Cuisine` (
  `cuisine_id` int(11) NOT NULL,
  `cuisine_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Difficulty`
--

CREATE TABLE `Difficulty` (
  `difficulty_id` int(11) NOT NULL,
  `difficulty_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Favorites`
--

CREATE TABLE `Favorites` (
  `favorite_id` int(11) NOT NULL,
  `recipe_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Images`
--

CREATE TABLE `Images` (
  `image_id` int(11) NOT NULL,
  `recipe_id` int(11) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Ingredients`
--

CREATE TABLE `Ingredients` (
  `ingredient_id` int(11) NOT NULL,
  `recipe_id` int(11) DEFAULT NULL,
  `ingredient_name` int(11) DEFAULT NULL,
  `mesurment_type` int(11) DEFAULT NULL,
  `mesurment_num` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Ingredient_Name`
--

CREATE TABLE `Ingredient_Name` (
  `Ingredient_name_id` int(11) NOT NULL,
  `ingredient_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Meal_Type`
--

CREATE TABLE `Meal_Type` (
  `meal_id` int(11) NOT NULL,
  `meal_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Measuerment_Type`
--

CREATE TABLE `Measuerment_Type` (
  `measurement_id` int(11) NOT NULL,
  `measurement` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Recpies`
--

CREATE TABLE `Recpies` (
  `recipe_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL,
  `recipe_name` varchar(50) DEFAULT NULL,
  `instructions` varchar(255) DEFAULT NULL,
  `cooking_time` int(11) DEFAULT NULL,
  `difficulty` int(11) DEFAULT NULL,
  `cuisine_type` int(11) DEFAULT NULL,
  `meal_type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Tags`
--

CREATE TABLE `Tags` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`user_id`, `user_name`, `email`, `password`, `admin`) VALUES
(1, 'scottakingsley', 'test@email.com', 'password', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Buddies`
--
ALTER TABLE `Buddies`
  ADD PRIMARY KEY (`buddie_id`),
  ADD KEY `FK_FOLLOWING_ID` (`following_id`),
  ADD KEY `FK_FOLLOWER_ID` (`follower_id`);

--
-- Indexes for table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `FK_Comments_Users` (`user_id`),
  ADD KEY `FK_Comments_Recpies` (`recipe_id`);

--
-- Indexes for table `Cuisine`
--
ALTER TABLE `Cuisine`
  ADD PRIMARY KEY (`cuisine_id`);

--
-- Indexes for table `Difficulty`
--
ALTER TABLE `Difficulty`
  ADD PRIMARY KEY (`difficulty_id`);

--
-- Indexes for table `Favorites`
--
ALTER TABLE `Favorites`
  ADD PRIMARY KEY (`favorite_id`),
  ADD KEY `recipe_id` (`recipe_id`),
  ADD KEY `FK_Favorites_Users` (`user_id`);

--
-- Indexes for table `Images`
--
ALTER TABLE `Images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- Indexes for table `Ingredients`
--
ALTER TABLE `Ingredients`
  ADD PRIMARY KEY (`ingredient_id`),
  ADD KEY `FK_Ingredients_RecipeID` (`recipe_id`),
  ADD KEY `FK_Ingredients_IngredientName` (`ingredient_name`),
  ADD KEY `FK_Ingredients_MeasurementType` (`mesurment_type`);

--
-- Indexes for table `Ingredient_Name`
--
ALTER TABLE `Ingredient_Name`
  ADD PRIMARY KEY (`Ingredient_name_id`);

--
-- Indexes for table `Meal_Type`
--
ALTER TABLE `Meal_Type`
  ADD PRIMARY KEY (`meal_id`);

--
-- Indexes for table `Measuerment_Type`
--
ALTER TABLE `Measuerment_Type`
  ADD PRIMARY KEY (`measurement_id`);

--
-- Indexes for table `Recpies`
--
ALTER TABLE `Recpies`
  ADD PRIMARY KEY (`recipe_id`),
  ADD KEY `FK_Recpies_Users` (`user_id`),
  ADD KEY `FK_Recpies_Tags` (`tag_id`),
  ADD KEY `FK_Recpies_Meal_Type` (`meal_type`),
  ADD KEY `FK_Recpies_Difficulty` (`difficulty`),
  ADD KEY `FK_Recpies_Cuisine` (`cuisine_type`);

--
-- Indexes for table `Tags`
--
ALTER TABLE `Tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Buddies`
--
ALTER TABLE `Buddies`
  MODIFY `buddie_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Cuisine`
--
ALTER TABLE `Cuisine`
  MODIFY `cuisine_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Difficulty`
--
ALTER TABLE `Difficulty`
  MODIFY `difficulty_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Favorites`
--
ALTER TABLE `Favorites`
  MODIFY `favorite_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Images`
--
ALTER TABLE `Images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Ingredients`
--
ALTER TABLE `Ingredients`
  MODIFY `ingredient_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Ingredient_Name`
--
ALTER TABLE `Ingredient_Name`
  MODIFY `Ingredient_name_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Meal_Type`
--
ALTER TABLE `Meal_Type`
  MODIFY `meal_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Measuerment_Type`
--
ALTER TABLE `Measuerment_Type`
  MODIFY `measurement_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Recpies`
--
ALTER TABLE `Recpies`
  MODIFY `recipe_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Tags`
--
ALTER TABLE `Tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Buddies`
--
ALTER TABLE `Buddies`
  ADD CONSTRAINT `Buddies_ibfk_1` FOREIGN KEY (`following_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `Buddies_ibfk_2` FOREIGN KEY (`follower_id`) REFERENCES `Users` (`user_id`);

--
-- Constraints for table `Comments`
--
ALTER TABLE `Comments`
  ADD CONSTRAINT `FK_Comments_Recpies` FOREIGN KEY (`recipe_id`) REFERENCES `Recpies` (`recipe_id`),
  ADD CONSTRAINT `FK_Comments_Users` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`);

--
-- Constraints for table `Favorites`
--
ALTER TABLE `Favorites`
  ADD CONSTRAINT `FK_Favorites_Users` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`),
  ADD CONSTRAINT `Favorites_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `Recpies` (`recipe_id`);

--
-- Constraints for table `Images`
--
ALTER TABLE `Images`
  ADD CONSTRAINT `Images_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `Recpies` (`recipe_id`);

--
-- Constraints for table `Ingredients`
--
ALTER TABLE `Ingredients`
  ADD CONSTRAINT `FK_Ingredients_IngredientName` FOREIGN KEY (`ingredient_name`) REFERENCES `Ingredient_Name` (`Ingredient_name_id`),
  ADD CONSTRAINT `FK_Ingredients_MeasurementType` FOREIGN KEY (`mesurment_type`) REFERENCES `Measuerment_Type` (`measurement_id`),
  ADD CONSTRAINT `Ingredients_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `Recpies` (`recipe_id`);

--
-- Constraints for table `Recpies`
--
ALTER TABLE `Recpies`
  ADD CONSTRAINT `FK_Recpies_Cuisine` FOREIGN KEY (`cuisine_type`) REFERENCES `Cuisine` (`cuisine_id`),
  ADD CONSTRAINT `FK_Recpies_Difficulty` FOREIGN KEY (`difficulty`) REFERENCES `Difficulty` (`difficulty_id`),
  ADD CONSTRAINT `FK_Recpies_Meal_Type` FOREIGN KEY (`meal_type`) REFERENCES `Meal_Type` (`meal_id`),
  ADD CONSTRAINT `FK_Recpies_Tags` FOREIGN KEY (`tag_id`) REFERENCES `Tags` (`tag_id`),
  ADD CONSTRAINT `FK_Recpies_Users` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
