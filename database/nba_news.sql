-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2019 at 10:02 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nba_news`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `day` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `text`, `date`, `user_id`, `day`) VALUES
(16, 'User admin searched for zion', '2019-03-15 16:27:50', 11, '2019-03-15'),
(17, 'User admin logout.', '2019-03-15 16:32:07', 11, '2019-03-15'),
(18, 'User korisnik logged in', '2019-03-15 16:32:15', 13, '2019-03-15'),
(19, 'User korisnik reply reerererer', '2019-03-15 16:32:25', 13, '2019-03-14'),
(20, 'User korisnik commented trtrtrtrtr', '2019-03-15 16:55:02', 13, '2019-03-15'),
(21, 'User korisnik deleted his comment ', '2019-03-15 16:55:10', 13, '2019-03-15'),
(22, 'User admin logged in', '2019-03-16 23:50:12', 11, '2019-03-16'),
(23, 'User admin logout.', '2019-03-16 23:50:48', 11, '2019-03-16'),
(24, 'User admin logged in', '2019-03-16 23:50:54', 11, '2019-03-16'),
(25, 'User admin logout.', '2019-03-17 00:00:36', 11, '2019-03-16'),
(30, 'User admin logged in', '2019-03-17 00:01:27', 11, '2019-03-16'),
(31, 'User admin logout.', '2019-03-17 00:03:45', 11, '2019-03-16'),
(32, 'User admin logged in', '2019-03-17 00:03:50', 11, '2019-03-16'),
(33, 'User admin searched for asdasdd', '2019-03-17 00:12:00', 11, '2019-03-16'),
(34, 'User admin logout.', '2019-03-17 00:12:01', 11, '2019-03-16'),
(35, 'User admin logged in', '2019-03-17 09:55:51', 11, '2019-03-17'),
(36, 'User admin commented dqwqwdwdqwdqqwd', '2019-03-17 13:27:15', 11, '2019-03-17'),
(37, 'User admin reply eqweqweqw', '2019-03-17 13:27:19', 11, '2019-03-17'),
(38, 'User admin deleted his comment ', '2019-03-17 13:31:41', 11, '2019-03-17'),
(39, 'User admin commented rewerewrewrewr', '2019-03-17 13:31:45', 11, '2019-03-17'),
(40, 'User admin reply qweqweqweqweqwe', '2019-03-17 13:31:58', 11, '2019-03-17'),
(41, 'User admin searched for Lakers', '2019-03-17 14:06:46', 11, '2019-03-17'),
(42, 'User admin searched for lakers', '2019-03-17 14:06:52', 11, '2019-03-17'),
(43, 'User admin searched for has', '2019-03-17 14:06:56', 11, '2019-03-17'),
(44, 'User admin logout.', '2019-03-17 14:50:56', 11, '2019-03-17'),
(45, 'User admin logged in', '2019-03-17 14:51:23', 11, '2019-03-17'),
(46, 'User admin logout.', '2019-03-17 14:51:28', 11, '2019-03-17'),
(47, 'User name logged in', '2019-03-17 14:51:48', 14, '2019-03-17'),
(48, 'User name logout.', '2019-03-17 14:52:00', 14, '2019-03-17'),
(49, 'User admin logged in', '2019-03-17 14:52:04', 11, '2019-03-17'),
(50, 'User admin logout.', '2019-03-17 14:55:08', 11, '2019-03-17'),
(51, 'User admin logged in', '2019-03-17 14:58:52', 11, '2019-03-17'),
(52, 'User admin commented LeBron has had on a first team All-NBA spot? That likely comes to an end this season as well.', '2019-03-17 16:02:08', 11, '2019-03-17'),
(53, 'User admin commented The Lakers say he is expected to make a full recovery before the start of his fourth NBA season', '2019-03-17 16:02:44', 11, '2019-03-17'),
(54, 'User admin logout.', '2019-03-17 16:02:48', 11, '2019-03-17'),
(55, 'User korisnik logged in', '2019-03-17 16:02:57', 13, '2019-03-17'),
(56, 'User korisnik reply Nice', '2019-03-17 16:03:12', 13, '2019-03-17'),
(57, 'User korisnik commented The Los Angeles Lakers’ playoffs hopes, as fleeting as they’ve been for weeks now,', '2019-03-17 16:03:26', 13, '2019-03-17'),
(58, 'User korisnik logout.', '2019-03-17 16:04:00', 13, '2019-03-17'),
(59, 'User name logged in', '2019-03-17 16:04:08', 14, '2019-03-17'),
(60, 'User name commented Good', '2019-03-17 16:04:20', 14, '2019-03-17'),
(61, 'User name commented Cool', '2019-03-17 16:04:38', 14, '2019-03-17'),
(62, 'User name commented Look, this is going to be very difficult for Dion', '2019-03-17 16:07:18', 14, '2019-03-17'),
(63, 'User name commented To coach Steve Kerr, the difficult times the Warriors have faced of late show just how fortunate the team has been', '2019-03-17 16:07:38', 14, '2019-03-17'),
(64, 'User name searched for curry', '2019-03-17 16:07:50', 14, '2019-03-17'),
(65, 'User name searched for pull', '2019-03-17 16:58:52', 14, '2019-03-17'),
(66, 'User name logout.', '2019-03-17 17:00:09', 14, '2019-03-17'),
(67, 'User admin logged in', '2019-03-17 17:00:15', 11, '2019-03-17'),
(68, 'User admin logout.', '2019-03-17 17:00:44', 11, '2019-03-17'),
(69, 'User admin logged in', '2019-03-17 20:36:58', 11, '2019-03-17'),
(70, 'User admin logout.', '2019-03-17 21:19:02', 11, '2019-03-17'),
(71, 'User admin logged in', '2019-03-17 21:19:07', 11, '2019-03-17'),
(72, 'User admin searched for out', '2019-03-17 21:19:39', 11, '2019-03-17'),
(73, 'User admin commented The exam revealed a minor plantar fascia tear in Brogdon’s right foot.', '2019-03-17 21:19:57', 11, '2019-03-17'),
(74, 'User admin logout.', '2019-03-17 21:20:46', 11, '2019-03-17'),
(75, 'User admin logged in', '2019-03-17 21:20:52', 11, '2019-03-17'),
(76, 'User admin logged in', '2019-03-18 14:57:30', 11, '2019-03-18'),
(77, 'User admin logout.', '2019-03-18 15:12:20', 11, '2019-03-18'),
(78, 'User admin logged in', '2019-03-18 15:32:52', 11, '2019-03-18');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_cat` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_cat`, `name`) VALUES
(1, 'Latest News'),
(2, 'Post Game');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `com_id` int(11) NOT NULL,
  `com` text COLLATE utf8_unicode_ci NOT NULL,
  `date_comment` datetime NOT NULL DEFAULT current_timestamp(),
  `id_p` int(11) NOT NULL,
  `id_u` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`com_id`, `com`, `date_comment`, `id_p`, `id_u`) VALUES
(30, 'LeBron has had on a first team All-NBA spot? That likely comes to an end this season as well.', '2019-03-17 16:02:08', 14, 11),
(31, 'The Lakers say he is expected to make a full recovery before the start of his fourth NBA season', '2019-03-17 16:02:44', 16, 11),
(32, 'The Los Angeles Lakers’ playoffs hopes, as fleeting as they’ve been for weeks now,', '2019-03-17 16:03:26', 14, 13),
(33, 'Good', '2019-03-17 16:04:21', 14, 14),
(34, 'Cool', '2019-03-17 16:04:38', 16, 14),
(35, 'Look, this is going to be very difficult for Dion', '2019-03-17 16:07:18', 17, 14),
(36, 'To coach Steve Kerr, the difficult times the Warriors have faced of late show just how fortunate the team has been', '2019-03-17 16:07:38', 20, 14),
(37, 'The exam revealed a minor plantar fascia tear in Brogdon’s right foot.', '2019-03-17 21:19:57', 15, 11);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `picture_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `small_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `title`, `picture_path`, `small_path`, `alt`) VALUES
(3, 'PIcture 1', 'images/gallery/1552323809nash-curry-beijing-131015-600.jpg', 'images/small_images/small_1552323809nash-curry-beijing-131015-600.jpg', 'nash-curry-beijing-131015-600.jpg'),
(5, 'PIcture 2', 'images/gallery/1552323989144031268_10-alltimeintl-131002-940.jpg', 'images/small_images/small_1552323989144031268_10-alltimeintl-131002-940.jpg', '144031268_10-alltimeintl-131002-940.jpg'),
(6, 'PIcture 3', 'images/gallery/1552324190GettyImages_540881430_xaxtz6fk_zl412bdr.jpg', 'images/small_images/small_1552324190GettyImages_540881430_xaxtz6fk_zl412bdr.jpg', 'GettyImages_540881430_xaxtz6fk_zl412bdr.jpg'),
(7, 'PIcture 4', 'images/gallery/1552324225usp_nba-_milwaukee_bucks_at_cleveland_cavaliers.jpg', 'images/small_images/small_1552324225usp_nba-_milwaukee_bucks_at_cleveland_cavaliers.jpg', 'usp_nba-_milwaukee_bucks_at_cleveland_cavaliers.jpg'),
(8, 'PIcture 5', 'images/gallery/1552324269download.jpg', 'images/small_images/small_1552324269download.jpg', 'download.jpg'),
(9, 'PIcture 6', 'images/gallery/1552324296Durant-Wade-NBA-Game-1.jpg', 'images/small_images/small_1552324296Durant-Wade-NBA-Game-1.jpg', 'Durant-Wade-NBA-Game-1.jpg'),
(10, 'PIcture 7', 'images/gallery/1552324332download (1).jpg', 'images/small_images/small_1552324332download (1).jpg', 'download (1).jpg'),
(11, 'PIcture 8', 'images/gallery/155232435401nbalive-charge-articleLarge-v2.jpg', 'images/small_images/small_155232435401nbalive-charge-articleLarge-v2.jpg', '01nbalive-charge-articleLarge-v2.jpg'),
(12, 'PIcture 9', 'images/gallery/1552324386images.jpg', 'images/small_images/small_1552324386images.jpg', 'images.jpg'),
(14, 'PIcture 11', 'images/gallery/1552324639images (2).jpg', 'images/small_images/small_1552324639images (2).jpg', 'images (2).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `meni`
--

CREATE TABLE `meni` (
  `id` int(11) NOT NULL,
  `nav` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `meni`
--

INSERT INTO `meni` (`id`, `nav`, `name`) VALUES
(1, '/', 'Home'),
(2, '/about', 'About'),
(3, '/gallery', 'Gallery'),
(4, '/contact', 'Contact');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `small_picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `headline` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `date_published` datetime NOT NULL DEFAULT current_timestamp(),
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `picture`, `small_picture`, `alt`, `headline`, `text`, `date_published`, `cat_id`) VALUES
(14, 'images/1552826296lebron-reacts-sideline-suns-0315.jpg', 'images/small_images/small_1552826296lebron-reacts-sideline-suns-0315.jpg', 'lebron-reacts-sideline-suns-0315.jpg', 'Kia MVP Ladder: Aberrant finish in award chase', 'All good things must come to an end, even for a four-time Kia MVP like LeBron James.\r\nThe sobering reality in his 16th season is that it has provided lesson after painful lesson for the man who dominated the NBA narrative for most of the past decade.\r\nThe Los Angeles Lakers’ playoffs hopes, as fleeting as they’ve been for weeks now, are all but over. The same is likely true for James’ personal streak of 13 straight playoff appearances.\r\nHis eight straight seasons playing in The Finals? Finished.\r\nThat stranglehold LeBron has had on a first team All-NBA spot? That likely comes to an end this season as well.\r\n\r\nIt also means his impressive run of top-five finishes in the MVP chase is likely to meet an ugly demise this season, too. He finished ninth in MVP voting his rookie season (2002-03) and sixth the following season before making the top five in every season since then … (likely) until now.\r\n\r\nIt’s not that he hasn’t posted MVP-caliber numbers -- his 27.4 points, 8.6 rebounds and eight assists per game are better than his career stats (27.2 ppg, 7.4 rpg, 7.2 apg). Individual metrics aren’t the problem, but rather the Lakers’ futility this season --  fueled in large part by his career-high 18-games missed due to injury and/or maintenance -- is what will cost him his customary spot on most MVP ballots.', '2019-03-17 13:38:16', 1),
(15, 'images/1552826393brogdon-dunk.jpg', 'images/small_images/small_1552826393brogdon-dunk.jpg', 'brogdon-dunk.jpg', 'Brogdon out indefinitely with plantar fascia tear', 'MILWAUKEE – Milwaukee Bucks guard Malcolm Brogdon underwent an MRI and subsequent examination today by team physician Dr. William Raasch at Froedtert & the Medical College of Wisconsin. The exam revealed a minor plantar fascia tear in Brogdon’s right foot.\r\n\r\nBrogdon will be listed as out and his status will be updated as appropriate.\r\n\r\nIn 64 games (all starts) for the Bucks this season, Brogdon is averaging a career-high 15.6 points, 4.5 rebounds and 3.2 assists in 28.6 minutes per game, while shooting career bests in field goal percentage (.505) and 3-point percentage (.426).\r\n\r\nHe is also shooting an NBA-high 92.8 percent from the free throw line, making him the only player in the NBA shooting better than 50.0 percent from the field, 40.0 percent from three-point distance and 90.0 percent from the foul line. A 50/40/90 season has only been done 13 times in NBA history.', '2019-03-17 13:39:53', 1),
(16, 'images/1552826529USATSI_11375423.jpg', 'images/small_images/small_1552826529USATSI_11375423.jpg', 'USATSI_11375423.jpg', 'Lakers\' Ingram has successful surgery on arm', 'LOS ANGELES (AP)  -- Lakers forward Brandon Ingram is expected to be ready for next season after undergoing surgery on his right arm.\r\n\r\nIngram had thoracic outlet decompression surgery Saturday, the Lakers say.\r\n\r\nIngram was declared out for the season earlier this month after he was diagnosed with deep venous thrombosis. A blood clot caused shoulder pain for Ingram, who averaged a career-best 18.3 points and 5.1 rebounds this season.\r\n\r\nIngram\'s surgery was performed at the Ronald Reagan UCLA Medical Center.\r\n\r\nThe Lakers say he is expected to make a full recovery before the start of his fourth NBA season in the fall.\r\n\r\nIngram was the No. 2 pick in the 2016 draft out of Duke. He turns 22 in September.', '2019-03-17 13:42:10', 1),
(17, 'images/1552826637dion-waiters-iso.jpg', 'images/small_images/small_1552826637dion-waiters-iso.jpg', 'dion-waiters-iso.jpg', 'Heat fine Waiters for postgame expletive-laden comments', 'BIRMINGHAM, Michigan (AP)  -- The Miami Heat have fined Dion Waiters an undisclosed amount for his expletive-laden comments about playing time earlier this week.\r\n\r\nWaiters made the comments to reporters from two South Florida newspapers after Miami\'s lopsided loss in Milwaukee on Tuesday night. The Heat were off Wednesday and announced the fine Thursday.\r\n\r\n\"We fined him and we addressed it as a team,\" Heat coach Erik Spoelstra said.\r\n\r\nWaiters has played in five games this season, all as a reserve. He missed just over a full year while recovering from surgery to repair a long-problematic ankle, and has repeatedly said that being patient throughout the process is a challenge for him.\r\n\r\n\"Look, this is going to be very difficult for Dion,\" Spoelstra said. \"I have empathy for everything he\'s gone through in the last year to get back to where he is right now. But this is not about him. This is only about the team and it\'s about winning.\"\r\n\r\nMiami is 21-21 this season, going into its game Friday at Detroit.', '2019-03-17 13:43:57', 2),
(18, 'images/1552826799rubio.jpg', 'images/small_images/small_1552826799rubio.jpg', 'rubio.jpg', 'Jazz\'s Ricky Rubio has hamstring strains', 'SALT LAKE CITY  -- The following is a medical update on Utah Jazz guard Ricky Rubio, forward Thabo Sefolosha and center Tony Bradley:\r\n\r\nRubio (6-4, 190, Spain) was examined Tuesday by the Utah Jazz medical staff and underwent magnetic resonance imaging (MRI) testing and the MRI revealed a mild right hamstring strain. He will be re-evaluated in one week.\r\n\r\nSefolosha (6-7, 220, Switzerland) was also examined Tuesday by the Jazz medical staff and underwent magnetic resonance imaging (MRI) testing and the MRI revealed a mild right hamstring strain. He will be re-evaluated in one week.\r\n\r\nBradley (6-11, 248, North Carolina) underwent a successful partial meniscectomy and debridement of his right knee on Tuesday. Bradley suffered the injury in the Stars’ 110-105 win against the Sioux Falls Skyforce on Jan. 4. He will be re-evaluated in one month.\r\n\r\nRubio is in his eighth NBA season, where he’s played in 40 games, holding averages of 12.8 points, 6.2 assists, 3.6 rebounds and 1.3 steals in 29.2 minutes per game.\r\n\r\nSefolosha is currently in his 13th year, second with Utah, and is averaging 3.0 points and 2.8 boards in 11.1 minutes in 2018-19.', '2019-03-17 13:46:40', 2),
(19, 'images/1552826856GettyImages-1124805868.jpg', 'images/small_images/small_1552826856GettyImages-1124805868.jpg', 'GettyImages-1124805868.jpg', 'Reports: Nuggets pull Isaiah Thomas from rotation', 'After a delayed start to his inaugural campaign with the Nuggets, guard Isaiah Thomas might be set for an early finish. Reports out of Denver confirm that coach Michael Malone intends to shorten his rotation for the stretch run, and Thomas didn\'t play in Tuesday\'s 133-107 victory against the Timberwolves.\r\n\r\n“Definitely talked to him,” Malone told reporters after the game. “I’ll keep that conversation between I.T. and myself,” Malone said. “Not an easy conversation, but that’s my job. ... Isaiah is a pro and was into the game, supporting his teammates.”\r\n\r\nPer Sean Keeler of the Denver Post, Malone -- who previously coached Thomas when both were in Sacramento -- indicated it had more to do with a holistic approach than any sleight on individual performance.\r\n\r\n“It’s never about Isaiah. It’s never about any individual,” Malone explained. “It’s about what I think is best for our team. And I made the decision to shorten the rotation, only played eight guys in the first quarter. And I’m going to continue to do that for the time being.”', '2019-03-17 13:47:36', 1),
(20, 'images/1552827211stephen-curry-pregame.jpg', 'images/small_images/small_1552827211stephen-curry-pregame.jpg', 'stephen-curry-pregame.jpg', 'Curry, Kerr speak on Warriors’ issues as Green sits again', 'Golden State’s Stephen Curry knows that the rift between teammates Kevin Durant and Draymond Green might be viewed by outsiders as something that can doom the Warriors this season.\r\n\r\nTo them, he has a message.\r\n\r\n“That’s not going to happen,” Curry said.\r\n\r\nCurry spoke publicly Saturday night for the first time about the testy exchange between Durant and Green -- they went at each other late in what became an overtime loss to the LA Clippers last Monday night, and the fallout has been a major talking point around the NBA since -- and lauded both players for the way they’re handing the situation.\r\n“I think the way we’ve handled it as a team, the way Draymond’s handled it, the way KD’s handled it, it’s been nothing but professionalism,” Curry said.\r\n\r\nGreen is getting the weekend off. The Warriors held him out of their game in Dallas on Saturday because of an ongoing issue with a toe on his right foot, a game Golden State lost 112-109. He also did not play as Golden State lost 104-92 on the road to the San Antonio Spurs on Sunday.\r\n\r\nTo coach Steve Kerr, the difficult times the Warriors have faced of late show just how fortunate the team has been overall the last few seasons. In racking up back-to-back NBA titles and three championships in the last four seasons, Golden State has made life in the NBA look simple at times.', '2019-03-17 13:53:31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `subcommnets`
--

CREATE TABLE `subcommnets` (
  `rep_id` int(11) NOT NULL,
  `reply` text COLLATE utf8_unicode_ci NOT NULL,
  `id_c` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subcommnets`
--

INSERT INTO `subcommnets` (`rep_id`, `reply`, `id_c`, `id_user`) VALUES
(12, 'Nice', 30, 13);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `profile_pic` varchar(2555) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `date_member` datetime NOT NULL DEFAULT current_timestamp(),
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `profile_pic`, `email`, `username`, `password`, `date_member`, `role_id`) VALUES
(11, 'Stefan', 'Drobnjak', 'images/profile_pic/1552853937Profilna.png', 'admin@gmail.com', 'admin', 'b4d1a9de821ccf32107a1f3c846ec5e3', '2019-03-05 18:55:39', 1),
(13, 'Name', 'Lastname', 'images/profile_pic/Default_profile_picture.jpg', 'test@gmail.com', 'korisnik', 'b4d1a9de821ccf32107a1f3c846ec5e3', '2019-03-07 12:47:10', 2),
(14, 'Name', 'Lastname', 'images/profile_pic/Default_profile_picture.jpg', 'drobnjak.stefan18@gmail.com', 'name', 'b4d1a9de821ccf32107a1f3c846ec5e3', '2019-03-12 21:30:05', 2);

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id`, `title`, `url`) VALUES
(1, 'Sacramento Kings vs New York Knicks - Full Game Highlights | March 9, 2019', 'https://www.youtube.com/embed/GrvAeuMXm9k'),
(2, 'Dallas Mavericks vs Denver Nuggets - Full Game Highlights | March 14, 2019 ', 'https://www.youtube.com/embed/7mSdGw_6Bvg'),
(3, 'LA Lakers vs Toronto Raptors - Full Game Highlights | March 14, 2019', 'https://www.youtube.com/embed/hQW1jioFYTI'),
(5, 'OKC Thunder vs Indiana Pacers - Full Game Highlights | March 14, 2019', 'https://www.youtube.com/embed/66r3PwL_33Q'),
(6, 'Memphis Grizzlies vs Washington Wizards Full Game Highlights | March 16', 'https://www.youtube.com/embed/0BYsBeXcPeA');

-- --------------------------------------------------------

--
-- Table structure for table `visitors_post`
--

CREATE TABLE `visitors_post` (
  `id` int(11) NOT NULL,
  `id_p` int(11) NOT NULL,
  `id_u` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `visitors_post`
--

INSERT INTO `visitors_post` (`id`, `id_p`, `id_u`) VALUES
(255, 14, 11),
(256, 14, 11),
(257, 14, 11),
(258, 14, 11),
(259, 14, 11),
(260, 14, 11),
(261, 14, 11),
(262, 15, NULL),
(266, 19, NULL),
(267, 19, NULL),
(268, 19, NULL),
(269, 19, NULL),
(270, 16, NULL),
(271, 16, NULL),
(272, 16, NULL),
(273, 16, NULL),
(274, 16, NULL),
(275, 16, NULL),
(276, 14, 11),
(277, 14, 11),
(278, 19, NULL),
(279, 16, NULL),
(280, 16, NULL),
(281, 14, 13),
(282, 14, 13),
(283, 14, 13),
(284, 14, 14),
(285, 14, 14),
(286, 16, NULL),
(287, 16, NULL),
(288, 14, 14),
(289, 14, 14),
(290, 17, NULL),
(291, 17, NULL),
(292, 17, NULL),
(293, 17, NULL),
(294, 17, NULL),
(295, 20, NULL),
(296, 20, NULL),
(297, 20, NULL),
(298, 20, NULL),
(299, 20, NULL),
(300, 14, NULL),
(301, 14, NULL),
(302, 14, NULL),
(303, 17, NULL),
(304, 20, NULL),
(305, 19, NULL),
(306, 19, NULL),
(307, 15, NULL),
(308, 16, NULL),
(309, 14, 11),
(310, 15, NULL),
(311, 15, NULL),
(312, 19, NULL),
(313, 19, NULL),
(314, 19, NULL),
(315, 16, NULL),
(316, 14, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_cat`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`com_id`),
  ADD KEY `id_p` (`id_p`),
  ADD KEY `id_u` (`id_u`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meni`
--
ALTER TABLE `meni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cat` (`cat_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `subcommnets`
--
ALTER TABLE `subcommnets`
  ADD PRIMARY KEY (`rep_id`),
  ADD KEY `id_c` (`id_c`),
  ADD KEY `id_c_2` (`id_c`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitors_post`
--
ALTER TABLE `visitors_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_p` (`id_p`),
  ADD KEY `id_u` (`id_u`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `meni`
--
ALTER TABLE `meni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subcommnets`
--
ALTER TABLE `subcommnets`
  MODIFY `rep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `visitors_post`
--
ALTER TABLE `visitors_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=317;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activities_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`id_p`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`id_u`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id_cat`);

--
-- Constraints for table `subcommnets`
--
ALTER TABLE `subcommnets`
  ADD CONSTRAINT `subcommnets_ibfk_1` FOREIGN KEY (`id_c`) REFERENCES `comments` (`com_id`),
  ADD CONSTRAINT `subcommnets_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id_role`);

--
-- Constraints for table `visitors_post`
--
ALTER TABLE `visitors_post`
  ADD CONSTRAINT `visitors_post_ibfk_1` FOREIGN KEY (`id_p`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `visitors_post_ibfk_2` FOREIGN KEY (`id_u`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
