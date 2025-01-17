-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2024 at 06:58 PM
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
-- Database: `chatapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `donu`
--

CREATE TABLE `donu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donu`
--

INSERT INTO `donu` (`id`, `name`, `description`, `price`, `category_id`, `image`, `created_at`) VALUES
(1, 'Black herringbone patchwork long-sleeved short-sleeved midi dress', 'Black herringbone patchwork long-sleeved short-sleeved midi dress', 247, 20, '1722147801bc4815a06650604397cb844b37038121.png', '2024-11-23 17:02:10'),
(2, 'Black Borg Cross-Body Tote Bag', 'Black Borg Cross-Body Tote Bag', 450260, 20, 'E04477s.png', '2024-11-23 17:02:53'),
(3, 'Gold Metallic Cross-Body Bag', 'Gold Metallic Cross-Body Bag', 370803, 20, 'E04472s.png', '2024-11-23 17:03:29'),
(4, 'River Island Black Girls Heeled Boots', 'River Island Black Girls Heeled Boots', 847549, 20, 'B23038s.png', '2024-11-23 17:04:22');

-- --------------------------------------------------------

--
-- Table structure for table `dosale`
--

CREATE TABLE `dosale` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dosale`
--

INSERT INTO `dosale` (`id`, `name`, `description`, `price`, `category_id`, `image`, `created_at`) VALUES
(1, 'Women\'s Training Shoes', 'Women\'s Training Shoes', 2034686.00, 20, '71fRrYz4VhL.jpg', '2024-11-23 17:39:54'),
(2, 'Amazon Essentials .925 Sterling Silver Rhodium Plated X-Link Diamond Tennis Bracelet for Women (1/10 cttw, I-J Color, I3 Clarity, 7.25\"), Hypoallergenic Women\'s Jewelry', 'X-Link Diamond ', 2722888.00, 20, '71P8xTJoZ3L.jpg', '2024-11-23 17:41:42'),
(3, 'Mens Rings Stainless Steel Square Signet Rings for Men,Pinky Thumb Ring for Dad Father Jewelry Gift for Him,Men\'s Ring for Biker', 'Mens Rings Stainless Steel Square Signet Rings for Men,Pinky Thumb Ring for Dad Father Jewelry Gift for Him,Men\'s Ring for Biker', 506070.00, 20, '51Z7OpNHFL.png', '2024-11-23 17:44:07'),
(4, 'LADY COLOUR ♥ A Little Romance ♥ Sterling Silver Bracelets for Women Northern Lights Crystals Bracelet 7\"+2\" Extension', 'LADY COLOUR ♥ A Little Romance ♥ Sterling Silver Bracelets for Women Northern Lights Crystals Bracelet 7\"+2\" Extension', 1018123.00, 20, '61wWef51XvL.png', '2024-11-23 17:44:59');

-- --------------------------------------------------------

--
-- Table structure for table `hanghot`
--

CREATE TABLE `hanghot` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hanghot`
--

INSERT INTO `hanghot` (`id`, `name`, `description`, `price`, `category_id`, `image`, `created_at`) VALUES
(1, 'Áo khoác bomber TACVASEN ', 'Áo khoác bomber TACVASEN ', 1333474, 50, '71zwwEe2nLL.jpg', '2024-11-23 16:47:04'),
(4, 'Váy Công Chúa Lolita', 'Váy Công Chúa Lolita', 12000000, 50, '61VVRWx-l9S.jpg', '2024-11-23 16:54:53'),
(5, 'Đồng Hồ Nam Cartier Bạc', 'Đồng Hồ Nam Cartier Bạc', 2147483647, 10, 'cartier-ballon-bleu-automatic-silver-dial-mens-watch-wsbb0040.jpg', '2024-11-23 16:56:05'),
(6, 'Quần Thể Thao Pique Lacoste Nữ', 'Quần Thể Thao Pique Lacoste Nữ', 6700000, 20, 'lacoste-women-double-sided-pique-track-pants-xf0149mocb8.jpg', '2024-11-23 16:59:12');

-- --------------------------------------------------------

--
-- Table structure for table `hangnew`
--

CREATE TABLE `hangnew` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hangnew`
--

INSERT INTO `hangnew` (`id`, `name`, `description`, `price`, `category_id`, `image`, `created_at`) VALUES
(1, 'Black Zip Through Borg Fleece', 'Black Zip Through Borg Fleece', 794577.00, 50, 'B02022s.png', '2024-11-23 16:51:50'),
(2, 'Green Check Borg Shacket', 'Green Check Borg Shacket', 688633.00, 20, 'K83535s.png', '2024-11-23 17:00:00'),
(3, 'River Island Cream Girls Faux Leather Bow Bag', 'River Island Cream Girls Faux Leather Bow Bag', 529718.00, 10, 'AL8733s.png', '2024-11-23 17:00:39'),
(4, 'River Island Grey River Island Girls Cherry T-Shirt And Kickflare Set', 'River Island Grey River Island Girls Cherry T-Shirt And Kickflare Set', 635662.00, 20, 'AL8720s.png', '2024-11-23 17:01:28');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phukien`
--

CREATE TABLE `phukien` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `phukien`
--

INSERT INTO `phukien` (`id`, `name`, `description`, `price`, `category_id`, `image`, `created_at`) VALUES
(1, 'Mắt Kính Gucci', 'Mắt Kính Gucci', 200000, 20, 'gucci-demo-oversized-ladies-eyeglasses-gg1321o-002-60.jpg', '2024-11-23 17:32:50'),
(2, 'Columbia Men\'s Everyday Bifold Wallet-Multiple Card Slots', 'Columbia Men\'s Everyday Bifold Wallet-Multiple Card Slots', 770683, 20, '91VhWkK0KzL.jpg', '2024-11-23 17:33:45'),
(3, 'Color-Block Crossbody Bags for Women Leather Cross Body Purses Cute Designer Handbags', 'Color-Block Crossbody Bags for Women Leather Cross Body Purses Cute Designer Handbags', 1003032, 20, '61k0ydxg+wL.jpg', '2024-11-23 17:34:34'),
(4, 'GMT-Master II Automatic Men\'s 18kt Everose Gold Oyster Root Beer Bezel Watch', 'GMT-Master II Automatic Men\'s 18kt Everose Gold Oyster Root Beer Bezel Watch', 1101837001, 20, 'rolex-gmtmaster-ii-automatic-mens-18kt-everose-gold-oyster-root-beer-bezel-watch-126715bkso-126715chnr0001.jpg', '2024-11-23 17:36:42');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `size` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `size`, `category_id`, `image`, `created_at`) VALUES
(1, 'Trendy Bear Jacquard single-breasted casual denim jacket for men, fall ', 'Trendy Bear Jacquard single-breasted casual denim jacket for men, fall ', 495900.00, 0, 20, 'image.png', '2024-11-23 17:20:48'),
(2, 'Manfinity Hypemode Men\'s Cotton Denim Shirt Dual Pockets Without Tee', 'Manfinity Hypemode Men\'s Cotton Denim Shirt Dual Pockets Without Tee', 304900.00, 0, 20, 'image1.png', '2024-11-23 17:25:53'),
(4, 'Ripped Jeans with Letter & Cartoon Patches for Men', 'Ripped Jeans with Letter & Cartoon Patches for Men', 424300.00, 0, 20, 'image2.png', '2024-11-23 17:27:12'),
(5, 'Street 1 pc Women\'s Casual Letter Embroidered Baseball Cap for Daily Life', 'Street 1 pc Women\'s Casual Letter Embroidered Baseball Cap for Daily Life', 42400.00, 0, 20, '4.png', '2024-11-23 17:29:07');

-- --------------------------------------------------------

--
-- Table structure for table `stylist`
--

CREATE TABLE `stylist` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stylist`
--

INSERT INTO `stylist` (`id`, `name`, `image_url`) VALUES
(1, 'Stylist Lỏ', 'https://media.allure.com/photos/66e0b234f833c00d28b8e3e6/9:16/w_748%2Cc_limit/PhotosWithTitles143.jpg'),
(2, 'Stylist Lỏ', 'https://media.allure.com/photos/6668697b925f8f7ddbaa0e71/3:4/w_748%2Cc_limit/PhotosWithTitles4.jpg'),
(3, 'Stylist Lỏ', 'https://4menshop.com/images/thumbs/slides/slide-1-trang-chu-slide-1.png?t=1728066350'),
(4, 'Stylist Lỏ', 'https://media.allure.com/photos/66e0b234f833c00d28b8e3e6/9:16/w_748%2Cc_limit/PhotosWithTitles143.jpg'),
(5, 'Stylist Lỏ', 'https://media.allure.com/photos/66f4228c85f484c48c31ae26/9:16/w_748%2Cc_limit/PhotosWithTitles144.jpg'),
(6, 'Stylist Lỏ', 'https://media.allure.com/photos/66e0b234f833c00d28b8e3e6/9:16/w_748%2Cc_limit/PhotosWithTitles143.jpg'),
(7, 'Stylist Lỏ', 'https://media.allure.com/photos/6668697b925f8f7ddbaa0e71/3:4/w_748%2Cc_limit/PhotosWithTitles4.jpg'),
(8, 'Stylist Lỏ', 'https://media.allure.com/photos/66f4228c85f484c48c31ae26/9:16/w_748%2Cc_limit/PhotosWithTitles144.jpg'),
(9, 'Stylist Lỏ', 'https://media.allure.com/photos/66f4228c85f484c48c31ae26/9:16/w_748%2Cc_limit/PhotosWithTitles144.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `unique_id` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `birthday` date NOT NULL,
  `gender` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `is_admin` tinyint(4) NOT NULL,
  `is_stylist` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `fname`, `lname`, `email`, `password`, `img`, `phone`, `birthday`, `gender`, `status`, `is_admin`, `is_stylist`) VALUES
(1, 1307625535, 'ADMIN', 'ADMIN', 'tuanzeebee@gmail.com', '$2y$10$CpRuG/XCAslTveCld0S/1uOanFzbtzJq3XL5FoIfNIjjdfZQwflwO', '1732378949gp66mq.jpg', '0398694427', '2004-11-17', 'Nam', 'Không hoạt động', 1, 0),
(2, 1254967683, 'Stylist', 'Nam', 'tuanzeebee1@gmail.com', '$2y$10$XLpgxKLCqqdULZ/4u1DYEu.972IkAXDaH3/NKAg5o4g0RUZTVMiC.', '1732384010slide-1-trang-chu-slide-1.png', '0398694427', '2004-11-17', 'Nam', 'Không hoạt động', 0, 1),
(3, 1042082050, 'Stylist', 'Nữ', 'tuanzeebee2@gmail.com', '$2y$10$bHW5K73qMDcpokQSOklN2e4pnagA3r55qXD7skpzwtbwnIOuCuAoy', '1732384053PhotosWithTitles144.png', '0398694427', '2004-11-17', 'Nữ', 'Không hoạt động', 0, 1),
(4, 1688733912, 'Stylist', 'Nữ', 'tuanzeebee3@gmail.com', '$2y$10$IQI9rnAHMirNl5rJdh2.VO8rcBt/Scq5QAAkIpe0amGzINlD1qrbG', '1732384103PhotosWithTitles143 (1).png', '0398694427', '2004-11-17', 'Nữ', 'Không hoạt động', 0, 1),
(5, 1339899169, 'Stylist', 'Nữ', 'tuanzeebee4@gmail.com', '$2y$10$j5KnehGGpeVeBtvYyDzeZeQYJkbXa.9aH7OT9Zf.AXJjtdiI0k3kO', '1732384134PhotosWithTitles4.png', '0398694427', '2004-11-17', 'Nam', 'Không hoạt động', 0, 1),
(6, 1608324911, 'Stylist', 'CEO', 'tuanzeebee5@gmail.com', '$2y$10$C89NfTSVjhZYvgqDbW9p5eckzHluX0gARn7RbsPRL5eWS3JDEz.Ce', '1732384179test.jpg', '0398694427', '2004-11-17', 'Nam', 'Không hoạt động', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `verification_attempts`
--

CREATE TABLE `verification_attempts` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `attempts` int(11) DEFAULT 0,
  `last_attempt` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donu`
--
ALTER TABLE `donu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dosale`
--
ALTER TABLE `dosale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hanghot`
--
ALTER TABLE `hanghot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hangnew`
--
ALTER TABLE `hangnew`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `phukien`
--
ALTER TABLE `phukien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stylist`
--
ALTER TABLE `stylist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `verification_attempts`
--
ALTER TABLE `verification_attempts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donu`
--
ALTER TABLE `donu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dosale`
--
ALTER TABLE `dosale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hanghot`
--
ALTER TABLE `hanghot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hangnew`
--
ALTER TABLE `hangnew`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phukien`
--
ALTER TABLE `phukien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stylist`
--
ALTER TABLE `stylist`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `verification_attempts`
--
ALTER TABLE `verification_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
