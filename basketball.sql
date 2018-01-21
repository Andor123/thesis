-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2017. Aug 29. 13:24
-- Kiszolgáló verziója: 10.1.21-MariaDB
-- PHP verzió: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `basketball`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `admin_name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `admin_pass` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- A tábla adatainak kiíratása `admin`
--

INSERT INTO `admin` (`id_admin`, `admin_name`, `admin_pass`) VALUES
(1, 'Zoli', 'db6ef8247cde1d0e8001c27b5226ef96'),
(2, 'Zoli', 'dd71d14c9212c3108b642d0e9f3d1883'),
(3, 'Imi', 'f34e082ec6bdde3cd47e7a59a0e5d901'),
(4, 'Isti', 'b518d60581cfcd1c861145739d4666d6'),
(5, 'Palika', '028e268f7537513735a71487b739fdbd'),
(6, 'Laci', 'ce33fcf58c743f75fcfc2f0359189818'),
(7, 'Őzike', '95852b7d78fdf36c4019dfa82554bd27'),
(8, 'Olika', 'e777242ec78b478b27f32a4b8d0cf94c'),
(9, 'Olika', 'e777242ec78b478b27f32a4b8d0cf94c'),
(10, 'Wally', 'cff9686be6708f944e9d71cbea71add9'),
(11, 'Pisti', '8343bf2d493e72ad52183d9fc4d768b5'),
(12, 'Dani', 'e94d51a35484755a9f9672d13687f499'),
(13, 'Ákos', 'e37f6dd234f210c917c02bf5885efc2e'),
(14, 'János', 'a16b7fb43836dae5b0ccdb496ad31f1a');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `comments`
--

CREATE TABLE `comments` (
  `id_comment` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `id_merchandise` int(11) DEFAULT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `active` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- A tábla adatainak kiíratása `comments`
--

INSERT INTO `comments` (`id_comment`, `id_user`, `id_admin`, `id_merchandise`, `comment`, `active`, `datetime`) VALUES
(1, 14, 1, 1, 'Nagyon jó termék lett ez számomra', '1', '2017-07-15 12:40:59'),
(2, 14, 1, 5, 'Nagyon jó kis felső illetve nagyon kényelmes.', '1', '2017-07-15 12:44:48'),
(3, 14, 13, 2, 'Jó a lábamhoz ez a cipő.', '1', '2017-07-15 12:46:06'),
(4, 14, 1, 4, 'Nagyon jó ez a ruha.', '1', '2017-07-17 15:50:17'),
(5, 14, 13, 4, 'Nagyon jól áll rajtam.', '1', '2017-08-29 11:15:39');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `matches`
--

CREATE TABLE `matches` (
  `id_match` int(11) NOT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `match_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name_of_venue` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `datetime` datetime NOT NULL,
  `price` float NOT NULL,
  `match_description` text COLLATE utf8_unicode_ci NOT NULL,
  `number_of_tickets` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- A tábla adatainak kiíratása `matches`
--

INSERT INTO `matches` (`id_match`, `id_admin`, `match_name`, `name_of_venue`, `datetime`, `price`, `match_description`, `number_of_tickets`) VALUES
(1, 13, 'Euróliga: Crvena Zvezda - Real Madrid', 'Pionir Hall(Belgrád)', '2017-08-22 20:00:00', 500, 'LOL', 200),
(2, 13, 'NBA rájátszás: San Antonio Spurs - Houston Rockets', 'AT&T Center(San Antonio)', '2017-05-02 03:00:00', 150, 'Nyugati főcsoport', 294),
(3, 13, 'Euróliga: Olympiakos - Anadolu Efes', 'Peace and Friendship Stadium(Pireusz)', '2017-05-02 20:00:00', 250, 'Rájátszás', 250),
(4, 13, 'Német Bundesliga: Bamberg - Bayern München', 'Brose Arena(Bamberg)', '2017-05-21 15:00:00', 100, 'Play-off mérközés', 95),
(5, 13, 'Euróliga: Real Madrid - CSKA Moszkva', 'Sinan Erdem Dome(Isztambul)', '2017-05-21 17:00:00', 200, 'Final Four mérkőzés', 150),
(6, 13, 'NBA: Cleveland Cavaliers - Boston Celtics', 'Quicken Loans Arena(Cleveland)', '2017-05-22 02:30:00', 300, 'Rájátszás', 200),
(7, 13, 'NBA: Boston Celtics - Cleveland Cavaliers', 'Quicken Loans Arena(Cleveland)', '2017-10-17 20:00:00', 200, 'VTS', 250);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `merchandise`
--

CREATE TABLE `merchandise` (
  `id_merchandise` int(11) NOT NULL,
  `picture` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `merchandise_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `merchandise_description` text COLLATE utf8_unicode_ci NOT NULL,
  `number_of_merchandise` smallint(11) NOT NULL,
  `active` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- A tábla adatainak kiíratása `merchandise`
--

INSERT INTO `merchandise` (`id_merchandise`, `picture`, `merchandise_name`, `price`, `merchandise_description`, `number_of_merchandise`, `active`) VALUES
(1, 'peak.jpg', 'F643535 ROUND NECK SWEATER', 3000, 'LOL', 150, '1'),
(2, 'adidas1.jpg', 'CRAZY EXPLOSIVE PRIMEKNIT SHOES from Adidas', 4000, 'With a spinning layup or a quick-trigger jumper, Andrew Wiggins always finds the basket. Showing off his team\'s away colours, these men\'s basketball shoes feature custom Wiggins graphics. The boost™ midsole cushions dunk landings, while the unique lacing system eases pressure.\r\nboost™ is our most responsive cushioning ever: The more energy you give, the more you get\r\nBreathable and flexible adidas Primeknit upper for an enhanced fit\r\nUnique lace webbing for anatomical fit and reduced lace breakage\r\nGEOFIT® construction for anatomical fit and comfort\r\nTPU wrap around midsole and TPU shank for full-length stability; Andrew Wiggins stained-glass graphics\r\nNON MARKING rubber outsole with updated traction pattern for ultimate grip', 150, '1'),
(3, 'adidas2.jpg', 'D LILLARD 2.0 SHOES from Adidas', 5000, 'A clutch performer with a tireless work ethic, Damian Lillard began his rise to the top out of Oakland. These juniors\' basketball shoes were built to fit his style of play. Designed around one of his signature moves, the stepback jump shot, they\'re cut low for ankle mobility with extra support in the forefoot. The upper is a comfortable blend of textile and synthetic, and BOUNCE™ responds to the rigours of an 82-game season. Details on the outsole honour the city that raised him.\r\nBOUNCE™ provides energised comfort for all sports, all day\r\nTextile and synthetic upper with graphic on vamp and toe\r\nSeamless tongue construction; Moulded TPU eyestay piece; Comfortable textile lining; Translucent toe bumper\r\nPremium Damian Lillard signature details\r\nMoulded TPU heel for enhanced stability\r\nNON MARKING Rubber outsole', 100, '1'),
(4, 'nike.jpg', 'NIKE BASKETBALL (BARCELONA)', 1500, 'A Nike Basketball (Barcelona) férfipóló egy remek kosárlabdaklubnak állít emléket, miközben gondoskodik a mindennapi kényelemről is.', 150, '1'),
(5, 'nike1.jpg', 'NIKE BASKETBALL (FENERBAHÇE)', 1600, 'A Nike Basketball (Fenerbahçe) férfipóló egy remek kosárlabdaklubnak állít emléket és tökéletes kényelemről gondoskodik.', 100, '1'),
(6, 'nike2.jpg', 'NIKE BASKETBALL (MOSCOW)', 1400, 'A Nike Basketball (Moscow) férfipóló egy remek kosárlabdaklubnak állít emléket és tökéletes kényelemről gondoskodik.', 150, '1'),
(7, 'spalding.png', 'NBA OFFICIAL GAME BALL', 1500, 'The feel of the leather, the sound of the dribble, the clear conscience of determination - the athlete and the NBA Official Game Ball compete to excel and achieve. Become one with this superior basketball, constructed with products and technology made to last\r\nExclusive top grade full grain HORWEEN® leather cover\r\nOfficial NBA size and weight\r\nDesigned for indoor play only', 200, '1'),
(8, 'peak2.jpg', 'TONY PARKER TP3 SIGNATURE BASKETBALL SHOES', 2000, 'PEAK Tony Parker III is the third generation signature basketball shoes line for Tony Parker.', 200, '1');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `reference_number` int(11) NOT NULL,
  `status` enum('ordered','in progress','delivered') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ordered'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- A tábla adatainak kiíratása `orders`
--

INSERT INTO `orders` (`id_order`, `id_admin`, `id_user`, `reference_number`, `status`) VALUES
(195, 13, 14, 3119693, 'delivered'),
(196, 13, 14, 49168957, 'ordered'),
(197, 13, 14, 10707541, 'in progress'),
(198, 13, 14, 17388832, 'delivered'),
(199, 13, 14, 5921621, 'ordered'),
(200, 13, 14, 55139129, 'in progress'),
(201, 13, 14, 18857327, 'ordered'),
(202, 13, 14, 49314333, 'in progress'),
(203, 13, 14, 10514613, 'ordered'),
(204, 13, 14, 88917496, 'delivered'),
(205, 13, 14, 2553089, 'ordered'),
(206, 13, 14, 22187333, 'ordered'),
(207, 13, 14, 74460186, 'delivered'),
(208, 13, 14, 42963618, 'ordered'),
(209, 13, 14, 82730540, 'ordered'),
(210, 13, 14, 82011509, 'ordered'),
(211, 13, 14, 69609374, 'in progress'),
(212, 13, 14, 59012795, 'in progress'),
(213, 13, 14, 86943376, 'ordered'),
(214, 13, 14, 81311706, 'ordered'),
(215, 13, 14, 67118192, 'ordered'),
(216, 13, 14, 68315194, 'in progress'),
(217, 13, 14, 12723886, 'ordered'),
(218, 13, 14, 23202251, 'ordered'),
(219, 13, 14, 30130102, 'ordered'),
(220, 13, 14, 27026464, 'ordered'),
(221, 14, 14, 39501574, 'in progress'),
(222, 14, 14, 38800954, 'ordered');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `orders_cart`
--

CREATE TABLE `orders_cart` (
  `id` int(11) NOT NULL,
  `id_ticket` int(11) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `id_order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- A tábla adatainak kiíratása `orders_cart`
--

INSERT INTO `orders_cart` (`id`, `id_ticket`, `amount`, `id_order`) VALUES
(13, 147, 5, 197),
(14, 147, 10, 197),
(15, 151, 5, 199),
(16, 151, 10, 199),
(17, 153, 5, 200),
(18, 153, 10, 200),
(19, NULL, 35, 210),
(20, NULL, 35, 212),
(21, NULL, 5, 212),
(22, 186, 35, 213),
(23, 186, 5, 213),
(24, 188, 35, 214),
(25, 188, 5, 214),
(26, 192, 35, 215),
(27, 192, 5, 215),
(28, 197, 35, 215),
(29, 197, 5, 215),
(30, 197, 10, 215),
(31, 207, 5, 217),
(32, 209, 5, 219),
(33, 212, 5, 221),
(34, 212, 5, 221);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `orders_products`
--

CREATE TABLE `orders_products` (
  `id` int(11) NOT NULL,
  `id_product` int(11) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `id_order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- A tábla adatainak kiíratása `orders_products`
--

INSERT INTO `orders_products` (`id`, `id_product`, `amount`, `id_order`) VALUES
(6, 74, 5, 195),
(7, 74, 5, 195),
(8, 78, 5, 199),
(9, 78, 10, 199),
(10, 80, 5, 200),
(11, 80, 10, 200),
(12, 86, 5, 210),
(13, 88, 10, 212),
(14, 89, 10, 213),
(15, 90, 10, 214),
(16, 92, 10, 215),
(17, 95, 10, 215),
(18, 95, 5, 215),
(19, 103, 5, 217),
(20, 106, 5, 221),
(21, 106, 5, 221);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `products`
--

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_merchandise` int(11) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- A tábla adatainak kiíratása `products`
--

INSERT INTO `products` (`id_product`, `id_user`, `id_merchandise`, `amount`, `datetime`) VALUES
(73, 14, 3, 5, '2017-07-18 13:39:36'),
(74, 14, 6, 5, '2017-07-18 13:39:36'),
(75, 14, 3, 5, '2017-07-18 13:40:12'),
(76, 14, 6, 5, '2017-07-18 13:40:12'),
(77, 14, 1, 5, '2017-07-18 13:51:26'),
(78, 14, 5, 10, '2017-07-18 13:51:26'),
(79, 14, 1, 5, '2017-07-18 13:51:32'),
(80, 14, 5, 10, '2017-07-18 13:51:32'),
(81, 14, 1, 5, '2017-07-18 13:52:57'),
(82, 14, 5, 10, '2017-07-18 13:52:57'),
(83, 14, 6, 10, '2017-08-15 16:04:02'),
(84, 14, 2, 5, '2017-08-22 10:43:13'),
(85, 14, 3, 5, '2017-08-22 10:48:51'),
(86, 14, 2, 5, '2017-08-22 11:57:00'),
(87, 14, 2, 5, '2017-08-22 11:57:05'),
(88, 14, 2, 5, '2017-08-22 11:57:30'),
(89, 14, 2, 10, '2017-08-22 12:01:54'),
(90, 14, 2, 10, '2017-08-22 12:02:23'),
(91, 14, 2, 10, '2017-08-22 12:02:53'),
(92, 14, 2, 10, '2017-08-22 12:06:32'),
(93, 14, 2, 10, '2017-08-22 12:06:42'),
(94, 14, 2, 10, '2017-08-22 12:07:50'),
(95, 14, 6, 5, '2017-08-22 12:07:50'),
(96, 14, 2, 10, '2017-08-22 12:08:00'),
(97, 14, 6, 5, '2017-08-22 12:08:00'),
(98, 14, 2, 10, '2017-08-22 12:09:02'),
(99, 14, 6, 5, '2017-08-22 12:09:02'),
(100, 14, 2, 5, '2017-08-28 14:17:59'),
(101, 14, 2, 5, '2017-08-28 14:18:03'),
(102, 14, 2, 5, '2017-08-28 14:18:11'),
(103, 14, 2, 5, '2017-08-28 14:18:46'),
(104, 14, 2, 5, '2017-08-28 14:18:48'),
(105, 14, 6, 5, '2017-08-29 11:24:00'),
(106, 14, 7, 5, '2017-08-29 11:24:00'),
(107, 14, 6, 5, '2017-08-29 11:24:03'),
(108, 14, 7, 5, '2017-08-29 11:24:03');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tickets`
--

CREATE TABLE `tickets` (
  `id_ticket` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_match` int(11) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- A tábla adatainak kiíratása `tickets`
--

INSERT INTO `tickets` (`id_ticket`, `id_user`, `id_match`, `amount`, `datetime`) VALUES
(146, 14, 4, 5, '2017-07-18 13:48:09'),
(147, 14, 6, 10, '2017-07-18 13:48:09'),
(148, 14, 4, 5, '2017-07-18 13:48:17'),
(149, 14, 6, 10, '2017-07-18 13:48:17'),
(150, 14, 3, 5, '2017-07-18 13:51:26'),
(151, 14, 6, 10, '2017-07-18 13:51:26'),
(152, 14, 3, 5, '2017-07-18 13:51:32'),
(153, 14, 6, 10, '2017-07-18 13:51:32'),
(154, 14, 3, 5, '2017-07-18 13:52:57'),
(155, 14, 6, 10, '2017-07-18 13:52:57'),
(174, 14, 1, 5, '2017-08-22 10:45:36'),
(175, 14, 2, 10, '2017-08-22 10:45:36'),
(177, 14, 4, 4, '2017-08-22 10:46:13'),
(179, 14, 3, 10, '2017-08-22 10:46:50'),
(186, 14, 3, 5, '2017-08-22 12:01:54'),
(188, 14, 3, 5, '2017-08-22 12:02:22'),
(190, 14, 3, 5, '2017-08-22 12:02:53'),
(192, 14, 3, 5, '2017-08-22 12:06:32'),
(194, 14, 3, 5, '2017-08-22 12:06:42'),
(196, 14, 3, 5, '2017-08-22 12:07:50'),
(197, 14, 1, 10, '2017-08-22 12:07:50'),
(199, 14, 3, 5, '2017-08-22 12:08:00'),
(200, 14, 1, 10, '2017-08-22 12:08:00'),
(202, 14, 3, 5, '2017-08-22 12:09:02'),
(203, 14, 1, 10, '2017-08-22 12:09:02'),
(204, 14, 3, 5, '2017-08-28 14:17:59'),
(205, 14, 3, 5, '2017-08-28 14:18:03'),
(206, 14, 3, 5, '2017-08-28 14:18:11'),
(207, 14, 3, 5, '2017-08-28 14:18:46'),
(208, 14, 3, 5, '2017-08-28 14:18:48'),
(209, 14, 3, 5, '2017-08-29 11:12:46'),
(210, 14, 3, 5, '2017-08-29 11:12:50'),
(211, 14, 4, 5, '2017-08-29 11:24:00'),
(212, 14, 6, 5, '2017-08-29 11:24:00'),
(213, 14, 4, 5, '2017-08-29 11:24:03'),
(214, 14, 6, 5, '2017-08-29 11:24:03');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `first_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `datetime` datetime NOT NULL,
  `activation_code` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `password_generator` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `active` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id_user`, `first_name`, `surname`, `email`, `password`, `datetime`, `activation_code`, `password_generator`, `active`) VALUES
(14, 'Andor', 'Salamon', 'salamon.andor@gmail.com', '55a973e64933a06c6a201d49ebcbc14a', '2017-07-11 12:40:06', 'fa83a11a198d5a7f0bf77a1987bcd006', '73JCnlAr', '1'),
(15, 'Ákos', 'Salamon', 'sali@mailinator.com', 'd1853e9641597dd0b8ada4fe12bba325', '2017-07-15 12:48:42', '9778d5d219c5080b9a6a17bef029331c', 'l6ZHQIKF', '1'),
(16, 'Andrea', 'Januskó', 'andrea@mailinator.com', '7238c4cddafd3a9b10fbb47e793e86d9', '2017-07-15 12:49:28', 'd56b9fc4b0f1be8871f5e1c40c0067e7', 'zxFP8tVw', '1'),
(18, 'Panna', 'Pöttöm', 'panna@mailinator.com', 'e7340d3dd9b4c1f9b1f3399ce806cde9', '2017-07-15 13:47:56', '9b1f58766e8dfa5b889b51948917b58b', 'WWcVINA1', '1'),
(19, 'Zoltán', 'Németh', 'zoli@mailinator.com', '96472fc6a32e0f9c92a16ddc7c1c6aac', '2017-08-29 11:18:11', '7cb3c7c270c0a64cb5d19dbe79e769c9', '9K9DBQ5l', '1');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- A tábla indexei `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_merchandise` (`id_merchandise`),
  ADD KEY `id_admin` (`id_admin`);

--
-- A tábla indexei `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`id_match`),
  ADD KEY `id_admin` (`id_admin`);

--
-- A tábla indexei `merchandise`
--
ALTER TABLE `merchandise`
  ADD PRIMARY KEY (`id_merchandise`);

--
-- A tábla indexei `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_admin` (`id_admin`),
  ADD KEY `id_user` (`id_user`);

--
-- A tábla indexei `orders_cart`
--
ALTER TABLE `orders_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ticket` (`id_ticket`),
  ADD KEY `id_order` (`id_order`);

--
-- A tábla indexei `orders_products`
--
ALTER TABLE `orders_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_order` (`id_order`);

--
-- A tábla indexei `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_merchandise` (`id_merchandise`);

--
-- A tábla indexei `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id_ticket`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_match` (`id_match`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT a táblához `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT a táblához `matches`
--
ALTER TABLE `matches`
  MODIFY `id_match` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT a táblához `merchandise`
--
ALTER TABLE `merchandise`
  MODIFY `id_merchandise` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT a táblához `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;
--
-- AUTO_INCREMENT a táblához `orders_cart`
--
ALTER TABLE `orders_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT a táblához `orders_products`
--
ALTER TABLE `orders_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT a táblához `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;
--
-- AUTO_INCREMENT a táblához `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id_ticket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;
--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`id_merchandise`) REFERENCES `merchandise` (`id_merchandise`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Megkötések a táblához `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `matches_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Megkötések a táblához `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Megkötések a táblához `orders_cart`
--
ALTER TABLE `orders_cart`
  ADD CONSTRAINT `orders_cart_ibfk_1` FOREIGN KEY (`id_ticket`) REFERENCES `tickets` (`id_ticket`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_cart_ibfk_2` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Megkötések a táblához `orders_products`
--
ALTER TABLE `orders_products`
  ADD CONSTRAINT `orders_products_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_products_ibfk_2` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Megkötések a táblához `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`id_merchandise`) REFERENCES `merchandise` (`id_merchandise`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Megkötések a táblához `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`id_match`) REFERENCES `matches` (`id_match`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
