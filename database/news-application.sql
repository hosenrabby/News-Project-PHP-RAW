-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2021 at 05:52 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `news-application`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `post` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `post`) VALUES
(1, 'Programming', 1),
(2, 'Web Application', 2),
(3, 'Web Design', 1),
(4, 'UI/UX Design', 2),
(5, 'Entertainment', 1);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `post_date` varchar(20) NOT NULL,
  `post_img` varchar(100) NOT NULL,
  `author` int(11) NOT NULL,
  `category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `title`, `description`, `post_date`, `post_img`, `author`, `category`) VALUES
(1, 'Learning Essential Linux Commands for Navigating the Shell Effectively ', 'Once we learn how to deploy an Ubuntu server, how to manage users, and how to manage software packages, we should take a moment to learn some important concepts and commands that will allow us to build more of the foundational knowledge that will serve us well while understanding the advanced concepts and treading the path of expertise. These foundational concepts include core Linux commands for navigating the shell. \r\n\r\nThis article is an excerpt from the book, Mastering Ubuntu Server, Third Edition by Jeremy “Jay” La Croix – A hands-on book that will teach you how to deploy, maintain and troubleshoot Ubuntu Server.   \r\n\r\nLearning essential Linux commands\r\nBuilding a solid competency on the command line is essential and effectively gives any system administrator or engineer superpowers. Our new abilities won’t allow us to leap tall buildings in a single bound, but will definitely enable us to execute terminal commands as if we’re ninjas. While we won’t master the art of using the command line in this section (that can only come with years and experience), we will definitely become more confident. \r\n\r\nFirst, let’s talk about moving from one place to another within the Linux filesystem. Specifically, by “Linux filesystem”, I’m referring to the default structure of the various folders (also referred to as “directories”) contained within your Ubuntu installation. The Linux filesystem contains many important directories, each with their own designated purpose, which we’ll talk about in more detail in the book. Before we can explore that further, we’ll need to learn how to navigate from one directory to another. The first command we’ll cover in this section relative to navigating the filesystem will clarify the directory you’re currently working from. For that, we have the pwd command.', '07 Sep 2021', 'earning .jpg', 1, 2),
(2, 'Facebook Gaming reopens applications for its Black Gaming Creator Program', 'Facebook Gaming has reopened applications for its Black Gaming Creator Program following a brief hiatus.\r\n\r\nThe initiative was announced in December to support the black gaming community with $10 million of funding provided to inspire and equip the next generation of creators.\r\n\r\n“We firmly believe in positivity, inclusion, and diversity in everything we do,” the company wrote. “We want our creators and viewers to share their love for gaming in an environment that is enjoyable and welcoming.”\r\n\r\nThe program received thousands of applications during the first round and Facebook expects significant interest now that it’s reopened.\r\nFacebook Gaming has reopened applications for its Black Gaming Creator Program following a brief hiatus.\r\n\r\nThe initiative was announced in December to support the black gaming community with $10 million of funding provided to inspire and equip the next generation of creators.\r\n\r\n“We firmly believe in positivity, inclusion, and diversity in everything we do,” the company wrote. “We want our creators and viewers to share their love for gaming in an environment that is enjoyable and welcoming.”\r\n\r\nThe program received thousands of applications during the first round and Facebook expects significant interest now that it’s reopened.\r\n\r\n\r\nCreators such as King Bach, The Fierce Diva, KingRichard, and Max Rhyms have joined the program so far.\r\n\r\nFacebook has committed $200 million to support organisations and businesses owned by the black community, of which the Black Gaming Creator Program is just a part.\r\n\r\nApplications for the second round of the gaming program are open until 29 October 2021. Interested parties can apply here.', '07 Sep 2021', 'acebook .jpg', 1, 1),
(3, 'Developers can finally release their own Tiles for Wear OS', '\r\nGoogle continues to remind us that it hasn’t forgotten about Wear OS and will now allow developers to release their own Tiles for the wearable platform.\r\n\r\nAfter years of relatively minor updates, many people wondered if Google was giving up on wearables. Then, in May, Samsung announced that it was ditching Tizen for its upcoming Galaxy Watch 4 and would be joining forces with Google to reboot and co-develop Wear OS.\r\n\r\nNaturally, long-suffering fans have been given a spark...', '07 Sep 2021', 'eveloper.png', 1, 2),
(4, 'GDC kicks off with over 550 game dev sessions, will return as in-person event next year', 'This year’s Game Developers Conference (GDC) kicks off today as a virtual event with over 550 sessions on all things game development.\r\n\r\nGDC 2021 claims to take full advantage of the possibilities offered by virtual events. Back in 2020, around COVID-19’s historic peak, GDC was one of the first large events to be cancelled.\r\n\r\nThe organisers now have successive virtual events under their belt so it will be interesting to see how they’ve utilised their experience to...\r\n\r\nNintendo has finally announced its long-awaited new Switch model but without many of the rumoured upgrades.\r\n\r\nThe new Switch OLED, as its name suggests, boasts a new display that should improve some of the complaints about previous models having poor contrast and brightness. However, the rumoured bump to 1080p hasn’t materialised and the screen is still just 720p.\r\n\r\nNintendo has increased the screen size from 6.2-inch to 7-inch so a boosted resolution would have been even...', '07 Sep 2021', 'DC kicks.jpg', 2, 3),
(5, 'BAC kicks off with over 550 game dev sessions, will return as in-person event next year', 'Independent game developers have bemoaned the difficulty of working with PlayStation over Xbox and Nintendo.\r\n\r\nIain Garner of independent game publisher Neon Doctrine recently posted a tirade on Twitter where he suggested that getting prominent promotion on the store of a “very successful console” that “does not have Games Pass” (i.e not Xbox, and presumably meaning PlayStation) costs at least $25,000.\r\n\r\nVideo game publication Kotaku first published the story and...\r\nAhead of its E3 2021 showcase with recent acquisition Bethesda, the Xbox team has set out its vision to bring “gaming to everyone”.\r\n\r\nEnabling everyone to enjoy gaming has become an increased focus for Xbox in recent years – whether that’s through delivering groundbreaking accessibility devices and features to help those with limited mobility, a cheaper console with next-gen performance, new finance options like All Access, or the flexibility to play anywhere with cloud...', '07 Sep 2021', 'AC kicks.jpg', 2, 5),
(6, 'Huawei’s AppGallery almost doubled its distributions over the past year', 'App distribution reached 384.4 billion in 2020, an increase of 174 billion over the previous year. Gaming is driving the majority of this growth—with the number of games available on the platform increasing 500 percent over the past year.\r\n\r\nThe significant growth figures come a year on from MWC 2020 where Huawei announced plans to expand its mobile ecosystem.\r\n\r\nIn September 2020, the Chinese giant unveiled Huawei Mobile Services (HMS) 5.0 which features 56 ‘kits’ and 12,891 APIs:“It’s not just about quantity, and the fact that the number of apps integrated with HMS Core has more than doubled in one year shows that more developers are looking to Huawei’s on-device capabilities to drive innovation and provide better and more unique user experiences,” commented Zhang.\r\n\r\nChina has over 904 million mobile internet users and represents a lucrative market for developers. Huawei has been leveraging its local expertise to help global developers tap into the Chinese market; saying it has helped over a thousand so far.\r\n\r\nHuawei highlights US-based PicsArt as one success story; now boasting over 300 million downloads in Mainland China. Israel-based FaceTune and Romania-based Mondly are two other examples; receiving 2.2 million and 350,000 downloads respectively.', '07 Sep 2021', 'uawei’.jpg', 2, 4),
(7, 'Apple restricts M1 iPad Pro apps to 5GB RAM each', 'Apple is limiting apps for the new M1 iPad Pro to 5GB RAM each, despite some configurations now featuring 16GB.\r\n\r\nThe latest iPad is another step towards becoming a true laptop replacement, at least in terms of pure hardware. In fact, it’s the first iPad to feature the same desktop-class M1 processor that Apple is now using across its latest Mac lineup.\r\n\r\nWhile the iPad continues to boast impressive hardware, the software continues to be held back through an OS which – for the most part – remains designed for a smartphone rather than a device that aspires to be so much more.\r\n\r\nSome third-party apps are providing impressively close to a desktop-class experience given Apple’s restrictions. One of them is ProCreate.\r\n\r\nProCreate released an update this week to deliver optimisations for users looking to take advantage of the M1 iPad Pro’s power. The leading digital art app often updates its software alongside increases to available RAM in Apple’s latest iPads to enable users to add more layers.\r\n\r\nThe latest ProCreate update boosts the available layers from 91 on last year’s iPad Pro model to 115 on the new M1 iPad Pro.\r\n\r\nThat’s an impressive number of layers, but users quickly discovered that limit was the same regardless of whether they were using the base model of the iPad Pro with 8GB RAM or the 1TB and 2TB models which double that to 16GB RAM.', '07 Sep 2021', 'pple res.jpg', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `username`, `password`, `role`) VALUES
(1, 'Tahmid', 'Tuhin', 'tahmidtuhin', 'df4050ebe58266e1250f7dad57a241e6', 1),
(2, 'Nahida', 'Tuhin', 'nahidatuhin', '17be067319879ad76266be8b8a3ae059', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
