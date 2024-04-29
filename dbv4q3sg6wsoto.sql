-- phpMyAdmin SQL Dump
-- version 5.1.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 29, 2024 at 11:38 PM
-- Server version: 8.0.34-26
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
-- Table structure for table `cuisine`
--

CREATE TABLE `cuisine` (
  `cuisine_id` int NOT NULL,
  `cuisine_name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cuisine`
--

INSERT INTO `cuisine` (`cuisine_id`, `cuisine_name`) VALUES
(1, 'Italian '),
(2, 'Mexican'),
(3, 'Chinese '),
(4, 'Indian'),
(5, 'French');

-- --------------------------------------------------------

--
-- Table structure for table `difficulty`
--

CREATE TABLE `difficulty` (
  `difficulty_id` int NOT NULL,
  `difficulty_name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `difficulty`
--

INSERT INTO `difficulty` (`difficulty_id`, `difficulty_name`) VALUES
(1, 'Easy'),
(2, 'Medium'),
(3, 'Hard');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `image_id` int NOT NULL,
  `recipe_id` int DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `recipe_id`, `file_path`) VALUES
(21, 1, '1.jpg'),
(22, 2, '2.jpg'),
(23, 3, '3.jpg'),
(24, 4, '4.jpg'),
(25, 5, '5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `ingredient_id` int NOT NULL,
  `recipe_id` int DEFAULT NULL,
  `ingredient_name` int DEFAULT NULL,
  `measurement_type` int DEFAULT NULL,
  `measurement_num` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`ingredient_id`, `recipe_id`, `ingredient_name`, `measurement_type`, `measurement_num`) VALUES
(1, 1, 34, 4, '1.000'),
(2, 1, 1, 1, '1.000'),
(3, 1, 2, 1, '2.000'),
(4, 1, 3, 8, '2.000'),
(5, 1, 69, 2, '2.000'),
(6, 1, 23, 1, '1.000'),
(7, 1, 26, 1, '1.000'),
(8, 1, 4, 11, '12.000'),
(9, 2, 33, 4, '1.000'),
(10, 2, 7, 8, '2.000'),
(11, 2, 6, 8, '1.000'),
(12, 2, 5, 1, '1.000'),
(13, 2, 70, 2, '3.000'),
(14, 2, 2, 1, '2.000'),
(15, 2, 9, 2, '3.000'),
(16, 2, 47, 4, '2.000'),
(17, 3, 3, 1, '4.000'),
(18, 3, 59, 1, '8.000'),
(19, 3, 23, 15, '6.000'),
(20, 3, 69, 8, '1.000'),
(21, 3, 71, 8, '1.000'),
(22, 4, 49, 3, '1.000'),
(23, 4, 8, 3, '2.000'),
(24, 4, 16, 3, '1.000'),
(25, 4, 15, 2, '1.000'),
(26, 4, 46, 5, '1.000'),
(27, 4, 60, 2, '3.000'),
(28, 4, 69, 8, '2.000'),
(29, 4, 29, 8, '1.000'),
(30, 5, 12, 15, '3.000'),
(31, 5, 2, 3, '2.000'),
(32, 5, 82, 3, '1.000'),
(33, 5, 41, 12, '2.000'),
(34, 5, 60, 4, '1.000'),
(35, 5, 71, 3, '1.000');

-- --------------------------------------------------------

--
-- Table structure for table `ingredient_name`
--

CREATE TABLE `ingredient_name` (
  `Ingredient_name_id` int NOT NULL,
  `ingredient_name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingredient_name`
--

INSERT INTO `ingredient_name` (`Ingredient_name_id`, `ingredient_name`) VALUES
(1, 'Onion'),
(2, 'Garlic'),
(3, 'Tomato'),
(4, 'Potato'),
(5, 'Carrot'),
(6, 'Bell pepper'),
(7, 'Broccoli'),
(8, 'Spinach'),
(9, 'Mushroom'),
(10, 'Zucchini'),
(11, 'Apple'),
(12, 'Banana'),
(13, 'Orange'),
(14, 'Lemon'),
(15, 'Avocado'),
(16, 'Strawberries'),
(17, 'Blueberries'),
(18, 'Raspberries'),
(19, 'Mango'),
(20, 'Pineapple'),
(21, 'Watermelon'),
(22, 'Grapes'),
(23, 'Basil'),
(24, 'Thyme'),
(25, 'Rosemary'),
(26, 'Oregano'),
(27, 'Cilantro'),
(28, 'Parsley'),
(29, 'Mint'),
(30, 'Cumin'),
(31, 'Paprika'),
(32, 'Garlic powder'),
(33, 'Chicken'),
(34, 'Ground Beef'),
(35, 'Pork'),
(36, 'Salmon'),
(37, 'Cod'),
(38, 'Tilapia'),
(39, 'Shrimp'),
(40, 'Tofu'),
(41, 'Eggs'),
(42, 'Turkey'),
(43, 'Lamb'),
(44, 'Black beans'),
(45, 'Kidney beans'),
(46, 'Chickpeas'),
(47, 'Rice'),
(48, 'Pasta'),
(49, 'Quinoa'),
(50, 'Bread'),
(51, 'Potatoes'),
(52, 'Couscous'),
(53, 'Oats'),
(54, 'Barley'),
(55, 'Farro'),
(56, 'Bulgur'),
(57, 'Milk'),
(58, 'Cheddar cheese'),
(59, 'Mozzarella cheese'),
(60, 'Parmesan cheese'),
(61, 'Butter'),
(62, 'Yogurt'),
(63, 'Cream'),
(64, 'Eggs'),
(65, 'Almond milk'),
(66, 'Coconut milk'),
(67, 'Greek yogurt'),
(68, 'Sour cream'),
(69, 'Olive oil'),
(70, 'Soy sauce'),
(71, 'Balsamic vinegar'),
(72, 'Red wine vinegar'),
(73, 'Apple cider vinegar'),
(74, 'Mustard'),
(75, 'Ketchup'),
(76, 'Mayonnaise'),
(77, 'Hot sauce'),
(78, 'Sriracha'),
(79, 'Tomato sauce'),
(80, 'Pesto'),
(81, 'Almonds'),
(82, 'Walnuts'),
(83, 'Pecans'),
(84, 'Pistachios'),
(85, 'Sunflower seeds'),
(86, 'Chia seeds'),
(87, 'Flaxseeds'),
(88, 'Pumpkin seeds'),
(89, 'Sesame seeds'),
(90, 'Peanuts');

-- --------------------------------------------------------

--
-- Table structure for table `meal_type`
--

CREATE TABLE `meal_type` (
  `meal_id` int NOT NULL,
  `meal_type` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meal_type`
--

INSERT INTO `meal_type` (`meal_id`, `meal_type`) VALUES
(1, 'Breakfast'),
(2, 'Lunch'),
(3, 'Dinner'),
(4, 'Snack');

-- --------------------------------------------------------

--
-- Table structure for table `measuerment_type`
--

CREATE TABLE `measuerment_type` (
  `measurement_id` int NOT NULL,
  `measurement` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `measuerment_type`
--

INSERT INTO `measuerment_type` (`measurement_id`, `measurement`) VALUES
(1, 'Teaspoon (tsp)'),
(2, 'Tablespoon (tbsp)'),
(3, 'Fluid ounce (fl oz)'),
(4, 'Cup (c)'),
(5, 'Pint (pt)'),
(6, 'Quart (qt)'),
(7, 'Gallon (gal)'),
(8, 'Milliliter (ml)'),
(9, 'Liter (L)'),
(10, 'Ounce (oz)'),
(11, 'Pound (lb)'),
(12, 'Gram (g)'),
(13, 'Kilogram (kg)'),
(14, 'Clove'),
(15, 'Whole'),
(16, 'Head'),
(17, 'Stalk'),
(18, 'Sprig'),
(20, 'Half');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `recipe_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `recipe_name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `instructions` text COLLATE utf8mb4_general_ci,
  `cooking_time` int DEFAULT NULL,
  `difficulty` int DEFAULT NULL,
  `cuisine_type` int DEFAULT NULL,
  `meal_type` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`recipe_id`, `user_id`, `recipe_name`, `instructions`, `cooking_time`, `difficulty`, `cuisine_type`, `meal_type`) VALUES
(1, 1, 'Spaghetti Bolognese', 'Cook ground beef with onion and garlic. Add tomato sauce and spices. Serve over cooked spaghetti.', 30, 2, 1, 3),
(2, 1, 'Chicken Stir-Fry', 'Stir-fry thinly sliced chicken with broccoli, bell peppers, and carrots. Add soy sauce and garlic. Serve over cooked rice.', 20, 1, 3, 2),
(3, 1, 'Caprese Salad', 'Arrange sliced tomatoes, fresh mozzarella, and basil on a plate. Drizzle with olive oil and balsamic vinegar. Season with salt and pepper.', 10, 1, 5, 1),
(4, 1, 'Vegetarian Quinoa Bowl', 'Cook quinoa and top with spinach, cherry tomatoes, avocado, chickpeas, and feta cheese. Drizzle with olive oil and lemon juice.', 25, 2, 1, 2),
(5, 1, 'Banana Walnut Muffins', 'Mix mashed bananas with flour, chopped walnuts, eggs, sugar, baking powder, melted butter, milk, and vanilla extract. Bake in muffin tins.', 35, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `user_name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hashed_password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `email`, `hashed_password`, `is_admin`) VALUES
(1, 'scottakingsley', 'test@email.com', 'password', 1),
(3, 'AdminTest', 'edittest@email.com', '$2y$10$Hh7AdJmHciTaKUWDF7KClulc9MC9Z3FO3uMnNr7jjofc9yW5Mw2pW', 2),
(4, 'TestUser', 'test@test.com', '$2y$10$2UHl94LV2hLBeGhjE1u7ReIYu2QExBYRyWhZwuM1hdw/Pd9uNZsNO', 1),
(5, 'raymiesegars', 'edittest@email.com', '$2y$10$lcMs4SmJcITVgdGFA0DjyeZsxWC.6iqGWq0PnhCKFR8FqKhWc4zYG', 1),
(6, 'BenHarwood', 'edittest@email.com', '$2y$10$RjCt7AeeNduU9pqPzvmMgObY5CaWzZ33STHxdq451A1B8UtldPADq', 1),
(7, 'TaraByas', 'edittest@email.com', '$2y$10$8wWo6g/Xwejta9mNX5KkCecg4S8dAXWp49hVrV1aI7Ynf/Q.LbLei', 1),
(8, 'derektiller', 'tillerderek@gmail.com', '$2y$10$13q7/uxChQ.yqlhy2wD2j.q8S8yZYD.rvFi.7KGTdbeu/yCjURrnu', 1),
(9, 'SKingsley2', 'stacey.kingsley@bcsemail.org', '$2y$10$bEB1JrcyuHqWWKoZvwBY.OAkIRezpcvb3xIjG7xQwRGWcsmEaiUAW', 1),
(11, 'doom_design', 'edittest@email.com', '$2y$10$CLiqpg33C.ead6yTez12Fe6RW.iTE2Q7hSJxgOwHmuxVVzxOkDIvy', 1),
(12, 'potatocakes', 'edittest@email.com', '$2y$10$xDS5dIO9qGwUjLmW6Bvu5OUXbDWamlU04OfxOPJTmzO.cxTZEpB06', 1),
(13, 'seekaydubadub', 'edittest@email.com', '$2y$10$UglnL6lMlMngxncWwMPb6ed4TYiUTovQpDdi/iwXkKOvpUJ2Nnn4q', 1),
(14, 'raymiesegars', 'raymievsegarsiv@gmail.com', '$2y$10$x.7ozeljm/M02nv2mpv9/.hHfL9zFxcqkJlazU5vx6OhLHn13GN..', 1),
(15, 'StickMan64', 'Matthew3dds@gmail.com', '$2y$10$coXuXG/dyNZyFtL.6kGAfu9No5h.7nWb3cL1nGDs9cuT8hAQgLo.2', 1),
(16, 'ScottKingsley', 'skingsley2357@gmail.com', '$2y$10$ya2BkXOdRXbVU1Z9ZdDkT./c5PmvHcf/11RjHFxObkk1gzujYIHhK', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cuisine`
--
ALTER TABLE `cuisine`
  ADD PRIMARY KEY (`cuisine_id`);

--
-- Indexes for table `difficulty`
--
ALTER TABLE `difficulty`
  ADD PRIMARY KEY (`difficulty_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`ingredient_id`),
  ADD KEY `FK_Ingredients_RecipeID` (`recipe_id`),
  ADD KEY `FK_Ingredients_IngredientName` (`ingredient_name`),
  ADD KEY `FK_Ingredients_MeasurementType` (`measurement_type`);

--
-- Indexes for table `ingredient_name`
--
ALTER TABLE `ingredient_name`
  ADD PRIMARY KEY (`Ingredient_name_id`);

--
-- Indexes for table `meal_type`
--
ALTER TABLE `meal_type`
  ADD PRIMARY KEY (`meal_id`);

--
-- Indexes for table `measuerment_type`
--
ALTER TABLE `measuerment_type`
  ADD PRIMARY KEY (`measurement_id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`recipe_id`),
  ADD KEY `FK_Recpies_Users` (`user_id`),
  ADD KEY `FK_Recpies_Meal_Type` (`meal_type`),
  ADD KEY `FK_Recpies_Difficulty` (`difficulty`),
  ADD KEY `FK_Recpies_Cuisine` (`cuisine_type`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cuisine`
--
ALTER TABLE `cuisine`
  MODIFY `cuisine_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `difficulty`
--
ALTER TABLE `difficulty`
  MODIFY `difficulty_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `ingredient_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `ingredient_name`
--
ALTER TABLE `ingredient_name`
  MODIFY `Ingredient_name_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `meal_type`
--
ALTER TABLE `meal_type`
  MODIFY `meal_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `measuerment_type`
--
ALTER TABLE `measuerment_type`
  MODIFY `measurement_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `recipe_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD CONSTRAINT `FK_Ingredients_IngredientName` FOREIGN KEY (`ingredient_name`) REFERENCES `ingredient_name` (`Ingredient_name_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_Ingredients_MeasurementType` FOREIGN KEY (`measurement_type`) REFERENCES `measuerment_type` (`measurement_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `ingredients_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `FK_Recpies_Cuisine` FOREIGN KEY (`cuisine_type`) REFERENCES `cuisine` (`cuisine_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_Recpies_Difficulty` FOREIGN KEY (`difficulty`) REFERENCES `difficulty` (`difficulty_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_Recpies_Meal_Type` FOREIGN KEY (`meal_type`) REFERENCES `meal_type` (`meal_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_Recpies_Users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
