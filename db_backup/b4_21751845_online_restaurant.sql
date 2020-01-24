-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: sql213.byethost.com
-- Generation Time: Jul 30, 2018 at 06:20 AM
-- Server version: 5.6.35-81.0
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `b4_21751845_online_restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_info`
--

CREATE TABLE IF NOT EXISTS `cart_info` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `cart_info`
--

INSERT INTO `cart_info` (`cart_id`, `order_id`, `food_id`, `quantity`, `price`, `status`) VALUES
(1, 1, 1, 2, 10.95, 'active'),
(2, 1, 2, 2, 3.95, 'active'),
(3, 1, 3, 1, 5.95, 'active'),
(4, 2, 1, 1, 10.95, 'active'),
(5, 3, 1, 1, 10.95, 'active'),
(6, 3, 3, 2, 5.95, 'active'),
(7, 4, 30, 1, 10.95, 'active'),
(8, 4, 29, 1, 14.95, 'active'),
(9, 4, 28, 1, 13.95, 'active'),
(10, 4, 27, 1, 9.95, 'active'),
(11, 4, 26, 1, 9.95, 'active'),
(12, 5, 22, 1, 9.95, 'active'),
(13, 5, 23, 1, 9.95, 'active'),
(14, 6, 1, 1, 10.95, 'active'),
(15, 6, 2, 1, 3.95, 'active'),
(16, 7, 1, 2, 10.95, 'active'),
(17, 8, 15, 2, 11.95, 'active'),
(18, 9, 1, 1, 10.95, 'active'),
(19, 9, 2, 1, 3.95, 'active'),
(20, 10, 7, 1, 9.95, 'active'),
(21, 10, 8, 1, 11.95, 'active'),
(22, 10, 9, 1, 9.95, 'active'),
(23, 10, 10, 1, 11.95, 'active'),
(24, 11, 1, 13, 10.95, 'active'),
(25, 12, 1, 1, 10.95, 'active'),
(26, 12, 2, 1, 3.95, 'active'),
(27, 13, 4, 1, 3.95, 'active'),
(28, 13, 3, 1, 5.95, 'active'),
(29, 13, 2, 1, 3.95, 'active'),
(30, 14, 1, 1, 10.95, 'active'),
(31, 14, 3, 1, 5.95, 'active'),
(32, 14, 2, 1, 3.95, 'active'),
(33, 15, 1, 1, 10.95, 'active'),
(34, 15, 2, 2, 3.95, 'active'),
(35, 15, 3, 2, 5.95, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `image` varchar(200) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `telephone` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `post_code` varchar(100) NOT NULL,
  `recover_link` varchar(250) NOT NULL,
  `date` varchar(150) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `block_status` int(11) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `first_name`, `last_name`, `image`, `mobile`, `telephone`, `email`, `password`, `address`, `post_code`, `recover_link`, `date`, `status`, `block_status`) VALUES
(14, 'Mir Lutfur', 'Rahman', '152391408715239140874332.jpg', '01739213556', '', 'mirlutfur.rahman@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '9-paharika', '3100', '4f7f0b8e7f588c21fd84280a67f0cadcfc94f132', '10 Apr 2018', 'active', 0),
(16, 'Ataur Rahman', 'Selim', '', '01718284187', '', 'ataur.neub@gmail.com', '81fe8bfe87576c3ecb22426f8e57847382917acf', 'sylhet', '1234', '', '10 Apr 2018', 'inactive', 0),
(17, 'Tanjil', 'Fahim', '', '01742843491', '', 'tanjil.a.fahim7@gmail.com', 'f9dda786ee7ff9f3909b4fad49eaf4c112633760', 'Kazitula', '3100', '9f8053818323546a2e660a43f3b7ad6f5ef4759d', '10 Apr 2018', 'inactive', 0),
(21, 'Raihan', 'Ahmed', '', '01712345678', '01712345678', 'rr@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Dhaka', '4100', '', '21 May 2018', 'inactive', 0),
(22, 'Tanjil', 'Fahim', '', '01010101011', '', 'savasaachi.it@gmail.com', '7c2ab9cacfbd11cfff984182c9807debdf0dac33', 'Kazitula', '3100', '', '06 Jul 2018', 'inactive', 0);

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE IF NOT EXISTS `food` (
  `food_id` int(11) NOT NULL AUTO_INCREMENT,
  `food_name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `food_summary` varchar(150) CHARACTER SET utf8 NOT NULL,
  `food_description` text CHARACTER SET utf8 NOT NULL,
  `food_price` float NOT NULL,
  `category_id` int(11) NOT NULL,
  `status` enum('active','inactive') CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`food_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_id`, `food_name`, `food_summary`, `food_description`, `food_price`, `category_id`, `status`) VALUES
(1, 'Kebab-Ke-Karishma (s)', '(For Two)', 'A selection of delicious succulent Kebabs originating from the mountainous regions of the Northwest frontier province of India. It includes: Chicken, lamb, minced kebab & lamb chops.', 10.95, 1, 'active'),
(2, 'Sheek Kebab (s)', '', 'Spicy & juicy kebabs, mildly spiced; minced lamb; grilled in a clay oven. Served with salad.', 3.95, 1, 'active'),
(3, 'Adrak Lamb Chops (s)', '(2 Pieces)', 'Ginger flavoured lamb chops grilled in a tandoor.', 5.95, 1, 'active'),
(4, 'Tikka', '', 'Boneless chicken or lamb marinated in a special sauce. Grilled in a tandoor.', 3.95, 1, 'active'),
(5, 'Samosa', '', 'Flaky pastry stuffed with delicately spiced mixed lamb or vegetable.', 3.5, 1, 'active'),
(6, 'Salmon Tikka (s)', '', 'Prime cubes of salmon matured in a mildly spiced marinade of dill fennel and traces of Mustard oil.', 4.95, 1, 'active'),
(7, 'Shashlick', '', 'Chicken or lamb marinated in spice. Served with tomatoes, spicy peppers and onions grilled on charcoal.', 9.95, 2, 'active'),
(8, 'Goan Peri Peri Chicken Half', '', 'Goan chicken on the bone marinated with chef''s Peri Peri sauce, then grilled in tandoor to perfection. Served with Salad.', 11.95, 2, 'active'),
(9, 'Tandoori Chicken Half ', '', 'Prime half chicken marinated over-night using chef''s special marinade and grilled in a tandoor.', 9.95, 2, 'active'),
(10, 'Tandoori Lamb Chops', '(4 Piece)', 'Succulent lamb chops marinated with Indian spices and grilled to perfection.', 11.95, 2, 'active'),
(11, 'King Prawn Coriander', '', 'Selected large king prawns cooked with homemade coriander paste, aromatic spices, mustard, green chillies and yoghurt creating a medium spiced dish.', 13.95, 3, 'active'),
(12, 'King Prawn Malabar', '', 'Jumbo king prawn marinated in a mix of coconut milk ground mustard fennel seeds, green chillies and curry leaf.', 13.95, 3, 'active'),
(13, 'Bengal Fish Masala', '', 'A great tilapia river fish from Bangladesh. Cooked in a very delicate sauce with mustard tomatoes & curry leaf.', 12.95, 3, 'active'),
(14, 'Goan Fish Tikka Korma', '', 'Barbequed fish cooked with fresh cream. Slow cooked with coconut milk and a touch of spice. A mild goan style curry.', 12.95, 3, 'active'),
(15, 'Mixed Grill Mirchi Masala', '', 'Tandoori chicken, chicken tikka, lamb tikka & sheek kebab cooked in a thick special sauce with red and green chillies.', 11.95, 4, 'active'),
(16, 'Murgi Sikandari Raan', '', 'Slow cooked chicken legs/drumsticks spiced with ginger, garlic, chicken and chef''s special ground spices with a hint of cream. Hot pungent curry bursting with flavour.', 11.95, 4, 'active'),
(17, 'Murgh Shahjahani', '', 'Minced chicken cooked with stripped chicken & chef''s special recipe. Medium hot, very popular in Southeast-Asia.', 12.95, 5, 'active'),
(18, 'Jeera Chicken', '', 'Marinated chicken sauted in ginger and garlic, tempered with cumin. Medium spiced, legend has it as the all time favourite of the empror Akbar as served by his personal bawardhi (chef).', 10.95, 5, 'active'),
(19, 'Murghi Masalam', '', 'Very special authentic dish exclusively made by our chef. Tender pieces of stripped chicken mixed with mince meat & boiled fried egg. Very popular in the north region.', 11.95, 5, 'active'),
(20, 'Nawabi Raan', '(Lamb Shank)', 'Slow cooked roast lamb shank, spiced and seasoned with aromatic herbs and spices. A magnificent dish truly fit for kings.', 14.95, 6, 'active'),
(21, 'Rajasthani (Lal Mass)', '', 'Lamb de-boned cooked in handi oven over slow fire with a touch of yoghurt. sundried red chillies and red onions in rich Kashmiri masalah (hot and spicy).', 10.95, 6, 'active'),
(22, 'Chicken Balti ', '', '', 9.95, 7, 'active'),
(23, 'Lamb Balti', '', '', 9.95, 7, 'active'),
(24, 'Chicken Tikka Balti', '', '', 10.95, 7, 'active'),
(25, 'Tandoori King Prawn Balti', '', '', 14.95, 7, 'active'),
(26, 'Chicken Biryani', '', 'Basmati rice cooked with mouth watering chicken pieces.', 9.95, 8, 'active'),
(27, 'Lamb Biryani', '', 'Basmati rice cooked with mouth watering lamb pieces.', 9.95, 8, 'active'),
(28, 'King Prawn Biryani', '', 'Basmati rice cooked with mouth watering king prawns.', 13.95, 8, 'active'),
(29, 'Tandoori King Prawn Biryani', '', 'Basmati rice cooked with mouth watering tandoori king prawns.', 14.95, 8, 'active'),
(30, 'Chicken Tikka Biryani', '', 'Basmati rice cooked with mouth watering chicken tikka.', 10.95, 8, 'active'),
(31, 'Special Faluda', '(For One)', 'This is a special types of faluda consisting various types of fruits.', 5.5, 5, 'active'),
(32, 'Special Chicken Chowmin', '(For One)', '', 3.95, 9, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `food_category`
--

CREATE TABLE IF NOT EXISTS `food_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `status` enum('active','inactive') CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `food_category`
--

INSERT INTO `food_category` (`category_id`, `category_name`, `status`) VALUES
(1, 'SNACKS & STARTERS', 'active'),
(2, 'GRILLED DISHES', 'active'),
(3, 'FISH & KING PRAWN DISHES', 'active'),
(4, 'CHEF''S SPECIALS', 'active'),
(5, 'SPECIALITIES OF THE HOUSE', 'active'),
(6, 'MEAT DISHES', 'active'),
(7, 'BALTI DISHES', 'active'),
(8, 'TRADITIONAL BIRYANI DISHES', 'active'),
(9, 'CHOWMIN DISHES', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(250) NOT NULL,
  `caption` varchar(250) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`image_id`, `image`, `caption`, `status`) VALUES
(23, '152690194115269019413279.jpg', 'Shaslik Special', 'active'),
(22, '152690192515269019259417.jpg', 'Egg Special', 'active'),
(21, '152690189515269018956826.jpg', 'Chef Special Dish', 'active'),
(20, '152690188415269018844933.jpg', 'Fish In Soup', 'active'),
(19, '15269018721526901872969.jpg', 'Chef Special Dish', 'active'),
(18, '152690186115269018619327.jpg', 'Prawn Mixed Soup', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `home_slides`
--

CREATE TABLE IF NOT EXISTS `home_slides` (
  `slide_id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(200) NOT NULL,
  `caption` varchar(250) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  PRIMARY KEY (`slide_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `home_slides`
--

INSERT INTO `home_slides` (`slide_id`, `image`, `caption`, `status`) VALUES
(2, '152690203515269020358690.jpg', 'Special Chicken Grill', 'active'),
(3, '152690212715269021272391.jpg', 'Chef Special', 'active'),
(5, '152690208815269020886342.jpg', 'Special Egg Masala', 'active'),
(19, '152690228515269022852175.jpg', 'Special Fish Soup', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `offer_coupon`
--

CREATE TABLE IF NOT EXISTS `offer_coupon` (
  `offer_id` int(11) NOT NULL AUTO_INCREMENT,
  `offer_title` varchar(250) CHARACTER SET utf8 NOT NULL,
  `offer_in_percentage` float NOT NULL,
  `offer_reject_msg` varchar(250) CHARACTER SET utf8 NOT NULL,
  `offer_coupon_code` varchar(250) CHARACTER SET utf8 NOT NULL,
  `offer_conditional_amount` float NOT NULL,
  `offer_start_date` varchar(250) CHARACTER SET utf8 NOT NULL,
  `offer_end_date` varchar(250) CHARACTER SET utf8 NOT NULL,
  `status` enum('active','inactive') CHARACTER SET utf8 NOT NULL,
  `offer_details` text CHARACTER SET utf8 NOT NULL,
  `visibility` int(11) NOT NULL,
  PRIMARY KEY (`offer_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `offer_coupon`
--

INSERT INTO `offer_coupon` (`offer_id`, `offer_title`, `offer_in_percentage`, `offer_reject_msg`, `offer_coupon_code`, `offer_conditional_amount`, `offer_start_date`, `offer_end_date`, `status`, `offer_details`, `visibility`) VALUES
(1, '20% Discount On Collection', 20, 'Sorry! Only valid on orders over £20', 'GET20NOW', 20, '2018-01-01', '2018-06-17', 'inactive', 'This offer only valid for on collection. And on orders over &pound;20.', 1),
(2, '5% Discount On Collection', 5, 'Sorry! Only valid on orders over £5', 'GT5GET', 5, '2018-01-01', '2019-01-01', 'active', 'This offer only valid for on collection. And on orders over &pound;5.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `opening_time`
--

CREATE TABLE IF NOT EXISTS `opening_time` (
  `opening_id` int(11) NOT NULL AUTO_INCREMENT,
  `saturday` varchar(250) CHARACTER SET utf8 NOT NULL,
  `sunday` varchar(250) NOT NULL,
  `monday` varchar(250) NOT NULL,
  `tuesday` varchar(250) NOT NULL,
  `wednesday` varchar(250) NOT NULL,
  `thursday` varchar(250) NOT NULL,
  `friday` varchar(250) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  PRIMARY KEY (`opening_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `opening_time`
--

INSERT INTO `opening_time` (`opening_id`, `saturday`, `sunday`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `status`) VALUES
(1, '12:00 PM - 3:59 PM | 6:00 PM - 11:59 PM', '12:00 PM - 5:59 PM | 6:00 PM - 11:59 PM', '12:00 PM - 5:59 PM | 6:00 PM - 11:59 PM', '12:00 PM - 5:59 PM | 6:00 PM - 11:59 PM', '12:00 PM - 5:59 PM | 6:00 PM - 11:59 PM', '12:00 PM - 5:59 PM | 6:00 PM - 11:59 PM', '12:00 PM - 5:59 PM | 6:00 PM - 11:59 PM', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `order_info`
--

CREATE TABLE IF NOT EXISTS `order_info` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `coupon_code` varchar(100) NOT NULL,
  `paid_through` enum('card','paypal') NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `advice` text NOT NULL,
  `status` enum('In Queue','Processing','Delivered','Cancelled') NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `order_info`
--

INSERT INTO `order_info` (`order_id`, `coupon_code`, `paid_through`, `date`, `time`, `customer_id`, `address`, `advice`, `status`) VALUES
(1, 'GET20NOW', 'paypal', '10 Apr 2018', '01:21 am', 14, 'test', 'test', 'Delivered'),
(2, '0', 'paypal', '10 Apr 2018', '01:24 am', 14, '', '', 'Cancelled'),
(3, '0', 'card', '10 Apr 2018', '01:25 am', 14, '9-Paharika, North Peer Moholla, housing Estate, Sylhet-3100.', 'WOW', 'Delivered'),
(4, '0', 'card', '13 Apr 2018', '01:32 am', 14, '', '', 'Cancelled'),
(5, '0', 'paypal', '13 Apr 2018', '01:39 am', 14, '', '', 'Processing'),
(6, '0', 'card', '17 Apr 2018', '03:44 am', 14, 'Kajirbazar', 'Nothing', 'Processing'),
(7, 'GET20NOW', 'paypal', '17 Apr 2018', '04:03 am', 14, '', '', 'Processing'),
(8, 'GT5GET', 'card', '19 Apr 2018', '02:19 pm', 14, '', '', 'Processing'),
(9, '0', 'card', '22 Apr 2018', '05:41 pm', 14, '', '', 'Processing'),
(10, '0', 'card', '06 Jul 2018', '02:20 am', 14, '', '', 'Cancelled'),
(11, '0', 'card', '18 Jul 2018', '01:42 am', 14, '', '', 'Cancelled'),
(12, '0', 'card', '18 Jul 2018', '01:00 pm', 14, '', '', 'Delivered'),
(13, '0', 'card', '18 Jul 2018', '06:51 pm', 14, '', '', 'Processing'),
(14, '0', 'card', '18 Jul 2018', '06:52 pm', 14, '', '', 'Cancelled'),
(15, '0', 'card', '22 Jul 2018', '12:18 am', 14, '', '', 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `ow_admin`
--

CREATE TABLE IF NOT EXISTS `ow_admin` (
  `owner_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `date` varchar(100) NOT NULL,
  PRIMARY KEY (`owner_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ow_admin`
--

INSERT INTO `ow_admin` (`owner_id`, `name`, `email`, `password`, `mobile`, `status`, `date`) VALUES
(4, 'Mir Lutfur Rahman', 'mirlutfur.rahman@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '01739213886', 'active', '12 May 2018');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE IF NOT EXISTS `subscription` (
  `subscription_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(100) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  PRIMARY KEY (`subscription_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`subscription_id`, `date`, `status`) VALUES
(1, '07/27/2018', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `vt_controller`
--

CREATE TABLE IF NOT EXISTS `vt_controller` (
  `controller_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `mobile` varchar(40) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  PRIMARY KEY (`controller_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `vt_controller`
--

INSERT INTO `vt_controller` (`controller_id`, `email`, `password`, `mobile`, `status`) VALUES
(1, 'mirlutfur.rahman@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '01739213886', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `website_basic_info`
--

CREATE TABLE IF NOT EXISTS `website_basic_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `url` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telephone` varchar(150) NOT NULL,
  `contact_us_message` varchar(250) NOT NULL,
  `contact_us_address` text NOT NULL,
  `contact_us_phone` varchar(150) NOT NULL,
  `contact_us_email` varchar(150) NOT NULL,
  `map_lat` float NOT NULL,
  `map_lng` float NOT NULL,
  `map_zoom` float NOT NULL,
  `copyright_title` varchar(150) NOT NULL,
  `developer_title` varchar(150) NOT NULL,
  `developer_url` varchar(150) NOT NULL,
  `facebook_link` varchar(150) NOT NULL,
  `instagram_link` varchar(150) NOT NULL,
  `snapchat_link` varchar(150) NOT NULL,
  `pinterest_link` varchar(150) NOT NULL,
  `twitter_link` varchar(150) NOT NULL,
  `linkedin_link` varchar(150) NOT NULL,
  `website_logo` varchar(250) NOT NULL,
  `backend_logo` varchar(250) NOT NULL,
  `developer_logo` varchar(250) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `website_basic_info`
--

INSERT INTO `website_basic_info` (`id`, `title`, `url`, `email`, `telephone`, `contact_us_message`, `contact_us_address`, `contact_us_phone`, `contact_us_email`, `map_lat`, `map_lng`, `map_zoom`, `copyright_title`, `developer_title`, `developer_url`, `facebook_link`, `instagram_link`, `snapchat_link`, `pinterest_link`, `twitter_link`, `linkedin_link`, `website_logo`, `backend_logo`, `developer_logo`, `status`) VALUES
(1, 'Veechi Technologies', 'http://veechi.byethost4.com', 'raihan.testing@gmail.com', 'Call Now: 01739213886', 'Best Bangladeshi Restaurant', '63A Brick Ln, London E1 6QL', '440123456700', 'veechi@gmail.com', 24.8898, 91.8607, 14.5, 'Veechi Technology', 'Veechi Technology', 'https://www.facebook.com/mirlutfurrahman.raihan', 'https://www.facebook.com/mirlutfurrahman.raihan', '', '', '', '', '', '152874373715287437373066.jpg', '152874349015287434906011.jpg', '152647270815264727082026.png', 'active');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
