-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2025 at 07:18 PM
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
-- Database: `expense_budget_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(30) NOT NULL,
  `category` varchar(250) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `balance` float NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `description`, `status`, `balance`, `date_created`, `date_updated`) VALUES
(1, 'Main Budget', '&lt;p&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed semper imperdiet tortor et rhoncus. Etiam suscipit egestas faucibus. Aenean condimentum ullamcorper turpis, vestibulum maximus eros sollicitudin ut. Morbi interdum ante quis sollicitudin consectetur. Nulla urna urna, gravida et urna eu, pretium consectetur nunc. Quisque id sem porta, blandit lectus vel, feugiat ante. Pellentesque at suscipit tellus, eget posuere augue. Etiam tristique sit amet erat ut porttitor. Duis ut tortor sagittis, mattis mauris non, luctus mauris. Phasellus nec quam a augue eleifend varius nec vel tellus. Integer cursus in nibh in semper.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 1, 0, '2021-07-30 09:21:36', '2025-05-10 22:33:55'),
(2, 'Maintenance', '&lt;p&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;&quot;&gt;Nullam sed ipsum ut ligula ullamcorper ornare nec et tortor. Suspendisse dui erat, pulvinar ut sapien et, varius convallis tellus. Nulla facilisi. In ante felis, lacinia a ornare nec, interdum nec enim. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Donec venenatis orci in laoreet consectetur. Sed lobortis at sapien et fermentum. Pellentesque eros turpis, tincidunt id enim eu, lobortis laoreet neque. Quisque ut justo risus.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 1, 0, '2021-07-30 09:21:52', '2025-05-10 22:33:47'),
(3, 'Electricity', '&lt;p&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;&quot;&gt;Nullam sed ipsum ut ligula ullamcorper ornare nec et tortor. Suspendisse dui erat, pulvinar ut sapien et, varius convallis tellus. Nulla facilisi. In ante felis, lacinia a ornare nec, interdum nec enim. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Donec venenatis orci in laoreet consectetur. Sed lobortis at sapien et fermentum. Pellentesque eros turpis, tincidunt id enim eu, lobortis laoreet neque. Quisque ut justo risus.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 1, 0, '2021-07-30 09:22:22', '2025-05-10 22:27:22'),
(4, 'Water', '&lt;p&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;&quot;&gt;Praesent dignissim ante id sem semper scelerisque. Maecenas ac lacus egestas, cursus odio quis, tristique diam. Donec maximus congue metus at tincidunt. Suspendisse potenti. Nunc vel quam in metus aliquam placerat sed vitae lectus. Vivamus est nisl, consequat tincidunt blandit feugiat, sagittis sit amet risus. Curabitur congue est in risus mattis, malesuada tincidunt eros sodales. Donec convallis efficitur tincidunt. Etiam tellus nulla, sollicitudin tristique lacus ac, tincidunt placerat sapien.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 1, 0, '2021-07-30 09:23:22', '2025-05-10 22:27:18'),
(5, 'Others', '&lt;p style=&quot;margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px;&quot;&gt;Nulla libero urna, sodales id justo sed, feugiat semper neque. Quisque sollicitudin tellus a condimentum sagittis. Nunc aliquet libero nec justo semper, ut condimentum neque mattis. Donec tincidunt, ipsum vel pulvinar pulvinar, leo ante lobortis justo, et ultricies quam sem vitae metus. Aliquam vel sagittis lorem. Curabitur ac sem orci. Nulla nec varius turpis.&lt;/p&gt;&lt;p style=&quot;margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px;&quot;&gt;Pellentesque quis tristique augue. In convallis, ipsum nec pellentesque scelerisque, libero nunc auctor urna, nec hendrerit mauris ante a dolor. Vivamus scelerisque magna vitae massa tristique, vel eleifend odio condimentum. Nullam suscipit ornare imperdiet. Aliquam eu orci eu nisl pharetra sagittis varius eu nisi. Nullam nec ligula tellus. Ut magna odio, imperdiet id rutrum at, pretium sit amet felis.&lt;/p&gt;', 1, 0, '2021-07-30 09:23:53', '2025-05-10 22:33:43');

-- --------------------------------------------------------

--
-- Table structure for table `inflation_projections`
--

CREATE TABLE `inflation_projections` (
  `id` int(11) NOT NULL,
  `projection_year` int(11) NOT NULL,
  `projected_rate` decimal(5,2) NOT NULL COMMENT 'Projected inflation rate percentage',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inflation_rates`
--

CREATE TABLE `inflation_rates` (
  `id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) DEFAULT NULL,
  `rate` decimal(5,2) NOT NULL COMMENT 'Inflation rate percentage',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `investment_plans`
--

CREATE TABLE `investment_plans` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `plan_name` varchar(255) NOT NULL,
  `initial_amount` decimal(15,2) NOT NULL,
  `monthly_contribution` decimal(15,2) DEFAULT 0.00,
  `expected_annual_return` decimal(5,2) NOT NULL COMMENT 'Expected annual return percentage',
  `duration_years` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `investment_plan_transactions`
--

CREATE TABLE `investment_plan_transactions` (
  `id` int(11) NOT NULL,
  `investment_plan_id` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `transaction_type` enum('contribution','withdrawal') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `running_balance`
--

CREATE TABLE `running_balance` (
  `id` int(30) NOT NULL,
  `balance_type` tinyint(1) NOT NULL COMMENT '1=budget, 2=expense',
  `category_id` int(30) NOT NULL,
  `amount` float NOT NULL,
  `remarks` text NOT NULL,
  `user_id` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Personal Expense Tracker'),
(6, 'short_name', 'Expense Tracker'),
(11, 'logo', 'uploads/1627606920_modeylogo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', 'Admin', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', 'uploads/1624240500_avatar.png', NULL, 1, '2021-01-20 14:02:37', '2025-05-10 22:26:46'),
(4, 'John', 'Smith', 'jsmith', '1254737c076cf867dc53d60a0364f38e', NULL, NULL, 0, '2021-06-19 08:36:09', '2021-06-19 10:53:12'),
(5, 'Claire', 'Blake', 'cblake', '4744ddea876b11dcb1d169fadf494418', NULL, NULL, 0, '2021-06-19 10:01:51', '2021-06-19 12:03:23'),
(6, 'MUSUNURU', 'MANEESH', 'maneesh.musunuru@gmail.com', '0579f54362eac718670079c4d86af9a8', NULL, NULL, 0, '2025-05-10 21:55:30', NULL),
(7, 'Demo', 'Testing', 'maneesh@gmail.com', '0579f54362eac718670079c4d86af9a8', NULL, NULL, 0, '2025-05-10 21:59:08', NULL),
(8, 'Test', '2', 'test@gmail.com', '0579f54362eac718670079c4d86af9a8', NULL, NULL, 0, '2025-05-10 22:17:57', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inflation_projections`
--
ALTER TABLE `inflation_projections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inflation_rates`
--
ALTER TABLE `inflation_rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investment_plans`
--
ALTER TABLE `investment_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investment_plan_transactions`
--
ALTER TABLE `investment_plan_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `investment_plan_id` (`investment_plan_id`);

--
-- Indexes for table `running_balance`
--
ALTER TABLE `running_balance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `inflation_projections`
--
ALTER TABLE `inflation_projections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inflation_rates`
--
ALTER TABLE `inflation_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `investment_plans`
--
ALTER TABLE `investment_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `investment_plan_transactions`
--
ALTER TABLE `investment_plan_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `running_balance`
--
ALTER TABLE `running_balance`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `investment_plan_transactions`
--
ALTER TABLE `investment_plan_transactions`
  ADD CONSTRAINT `investment_plan_transactions_ibfk_1` FOREIGN KEY (`investment_plan_id`) REFERENCES `investment_plans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `running_balance`
--
ALTER TABLE `running_balance`
  ADD CONSTRAINT `running_balance_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
