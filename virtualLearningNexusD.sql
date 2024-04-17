-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2024 at 07:32 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ims_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_pass`) VALUES
(1, 'admin', 'admin@gmail.com', '30751852');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_name` text NOT NULL,
  `course_desc` text NOT NULL,
  `course_author` text NOT NULL,
  `course_img` text NOT NULL,
  `course_duration` text NOT NULL,
  `course_price` int(11) NOT NULL,
  `course_original_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `course_desc`, `course_author`, `course_img`, `course_duration`, `course_price`, `course_original_price`) VALUES
(8, 'The Complete JavaScript Course 2024: From Zero to Expert!', 'The modern JavaScript course for everyone! Master JavaScript with projects, challenges and theory. Many courses in one!', 'Adil', '../image/courseimg/javascript.jpg', '3 Hours', 1655, 1800),
(9, 'Complete PHP Bootcamp', 'This course will help you get all the Object Oriented PHP, MYSQLi and ending the course by building a CMS system.', 'Rajesh Kumar', '../image/courseimg/php.jpg', '3 Months', 700, 1700),
(10, 'Learn Python A-Z', 'This is the most comprehensive, yet straight-forward, course for the Python programming language.', 'Rahul Kumar', '../image/courseimg/Python.jpg', '4 Months', 800, 1800),
(11, 'Hands-on Artificial Intelligence', 'Learn and Master how AI works and how it is changing our lives in this Course.\r\nlives in this Course.', 'Jay Veeru', '../image/courseimg/ai.jpg', '6 Months', 900, 1900),
(12, 'Learn Vue JS', 'The skills you will learn from this course is applicable to the real world, so you can go ahead and build similar app.', 'Jay Shukla', '../image/courseimg/vue.jpg', '2 Months', 100, 1000),
(13, 'Angular JS', 'Angular is one of the most popular frameworks for building client apps with HTML, CSS and TypeScript.', 'Sonam Gupta', '../image/courseimg/angular.jpg', '4 Month', 800, 1600),
(16, 'Python Complete', 'This is complete Python COurse', 'RK', '../image/courseimg/Python.jpg', '4 hours', 500, 4000),
(17, 'Learn React Native', 'THis is react native for android and iso app development', 'GeekyShows', '../image/courseimg/Machine.jpg', '2 months', 200, 3000),
(20, 'English for IELTS exam preparation course', 'Do you need a Band score of 7 or higher? Have you tried repeatedly but have not made progress? Do you need an actual guide to Band 7 success? This course is just for you as it prepares participants for all parts of the IELTS exam: Listening, Reading, Writing, and Speaking modules. It focuses on teaching the skills and techniques required to sit for the test. ', 'Keino Campbell', '../image/courseimg/Free-Online-Classes-for-IELTS.png', '93 hours on-demand video', 90, 100),
(22, 'Building Your English Brain', 'Learn to start thinking in English so that you can stop translating in your head and become fluent in English faster.', 'Luke Dore', '../image/courseimg/download (18).png', '10 Days', 80, 100),
(23, 'English Brain', 'Learn to start thinking in English so that you can stop translating in your head and become fluent in English faster.', 'lukiii', '../image/courseimg/download.jpeg', '20 days', 18, 20);

-- --------------------------------------------------------

--
-- Table structure for table `courseorder`
--

CREATE TABLE `courseorder` (
  `co_id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `stu_email` varchar(255) NOT NULL,
  `course_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `TXNID` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `courseorder`
--

INSERT INTO `courseorder` (`co_id`, `order_id`, `stu_email`, `course_id`, `amount`, `order_date`, `status`, `TXNID`) VALUES
(3, 'ORDS98956453', 'ant@example.com', 10, 800, '2019-09-12', NULL, NULL),
(8, 'ORDS22968322', 'mario@ischool.com', 10, 800, '2019-09-13', NULL, NULL),
(9, 'ORDS78666589', 'ignou@ischool.com', 10, 800, '2019-09-19', NULL, NULL),
(20, 'ORDS79654885', 'marop@gmail.com', 9, 700, '2024-04-16', NULL, NULL),
(24, 'ORDS78383305', 'marop@gmail.com', 11, 900, '2024-04-16', NULL, NULL),
(25, 'ORDS43446666', 'mario@virtuallearningnexus.com', 16, 500, '2024-04-16', NULL, NULL),
(26, 'ORDS57072715', 'shaktiman@virtuallearningnexus.com', 12, 100, '2024-04-17', 'TXN_SUCCESS', NULL),
(27, 'ORDS19183939', 'shaktiman@virtuallearningnexus.com', 12, 100, '2024-04-17', 'TXN_SUCCESS', NULL),
(28, 'ORDS48841145', 'shaktiman@virtuallearningnexus.com', 10, 800, '2024-04-17', 'TXN_SUCCESS', NULL),
(34, 'ORDS91935272', 'witch@example.com', 8, 1655, '2024-04-17', 'TXN_SUCCESS', '8880fb8fca0e8787'),
(35, 'ORDS90171219', 'witch@example.com', 12, 100, '2024-04-17', 'TXN_SUCCESS', 'c351b98072673600'),
(36, 'ORDS36790621', 'marop@gmail.com', 20, 90, '2024-04-17', 'TXN_SUCCESS', '9809d4fdc7245a22'),
(37, 'ORDS41492068', 'marop@gmail.com', 13, 800, '2024-04-17', 'TXN_SUCCESS', 'f0068e7054af9808');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `f_id` int(11) NOT NULL,
  `f_content` text NOT NULL,
  `stu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`f_id`, `f_content`, `stu_id`) VALUES
(3, 'My experience at Virtual Learning Nexus has been transformative, empowering me and propelling me towards independence. I owe immense gratitude to the dedicated teachers who not only supported but also guided me along my journey. Additionally, I am deeply appreciative of Virtual Learning Nexus\'s commitment to providing top-tier placement opportunities, which ultimately led me to secure a position at DC Marvel. This milestone marks a significant step forward in my professional growth, and I am excited for the journey ahead.', 171),
(8, 'I am grateful to iSchool - both the faculty and the Training & Placement Department. They have made efforts ensuring maximum number of placed students. Due to the efforts made by the faculty and placement cell. I was able to bag a job in the second company.', 172),
(9, 'iSchool is a place of learning, fun, culture, lore, literature and many such life preaching activities. Studying at the iSchool brought an added value to my life.', 173),
(10, 'Think Magical, that is one thing that iSchool urges in and to far extent succeed in teaching to its students which invariably helps to achieve what you need.', 174),
(12, 'Knowledge is power. Information is liberating. Education is the premise of progress, in every society, in every family.', 180),
(13, 'This is Awesome GeekySHows Jindabaad', 182),
(16, 'VLN has been a great resource for me to expand my knowledge and skills. I love the massive selection of courses on so many different subjects. ', 188);

-- --------------------------------------------------------

--
-- Table structure for table `lesson`
--

CREATE TABLE `lesson` (
  `lesson_id` int(11) NOT NULL,
  `lesson_name` text NOT NULL,
  `lesson_desc` text NOT NULL,
  `lesson_link` text NOT NULL,
  `course_id` int(11) NOT NULL,
  `course_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `lesson`
--

INSERT INTO `lesson` (`lesson_id`, `lesson_name`, `lesson_desc`, `lesson_link`, `course_id`, `course_name`) VALUES
(32, 'Introduction to Python ', 'Introduction to Python Desc', '../lessonvid/video2.mp4', 10, 'Learn Python A-Z'),
(33, 'How Python Works', 'How Python Works Descc', '../lessonvid/video3.mp4', 10, 'Learn Python A-Z'),
(34, 'Why Python is powerful', 'Why Python is powerful Desc', '../lessonvid/video9.mp4', 10, 'Learn Python A-Z'),
(35, 'Everyone should learn Python ', 'Everyone should learn Python  Desccc', '../lessonvid/video1.mp4', 10, 'Learn Python A-Z'),
(36, 'Introduction to PHP', 'Introduction to PHP Desc', '../lessonvid/video4.mp4', 9, 'Complete PHP Bootcamp'),
(37, 'How PHP works', 'How PHP works Desc', '../lessonvid/video5.mp4', 9, 'Complete PHP Bootcamp'),
(38, 'is PHP really easy ?', 'is PHP really easy ? desc', '../lessonvid/video6.mp4', 9, 'Complete PHP Bootcamp'),
(39, 'Introduction to Guitar44', 'Introduction to Guitar desc1', '../lessonvid/video7.mp4', 8, 'Learn Guitar The Easy Way'),
(40, 'Type of Guitar', 'Type of Guitar Desc2', '../lessonvid/video8.mp4', 8, 'Learn Guitar The Easy Way'),
(41, 'Intro Hands-on Artificial Intelligence', 'Intro Hands-on Artificial Intelligence desc', '../lessonvid/video10.mp4', 11, 'Hands-on Artificial Intelligence'),
(42, 'How it works', 'How it works descccccc', '../lessonvid/video11.mp4', 11, 'Hands-on Artificial Intelligence'),
(43, 'Inro Learn Vue JS', 'Inro Learn Vue JS desc', '../lessonvid/video12.mp4', 12, 'Learn Vue JS'),
(44, 'Introduction to Angular JS', 'Introduction to Angular JS description', '../lessonvid/', 13, 'Angular JS'),
(48, 'Intro to Python Complete', 'This is lesson number 1', '../lessonvid/video11.mp4', 16, 'Python Complete'),
(49, 'Introduction to React Native', 'This intro video of React native', '../lessonvid/video11.mp4', 17, 'Learn React Native'),
(50, 'What is IELTS Speaking English?', 'ielts', '../lessonvid/video17.mp4', 20, 'English for IELTS exam preparation course'),
(51, 'Connecting your ideas', 'ielts', '../lessonvid/55 - Connecting your ideas.mp4', 20, 'English for IELTS exam preparation course'),
(52, 'Idiomatic language for IELTS Speaking', 'ieltss', '../lessonvid/video15.mp4', 20, 'English for IELTS exam preparation course'),
(53, 'watching movie', 'demo course', '../lessonvid/video7.mp4', 23, 'English Brain'),
(54, 'Pronunciation for IELTS Speaking', 'demo', '../lessonvid/video16.mp4', 20, 'English for IELTS exam preparation course'),
(55, 'Ielts Instruction', 'demo', '../lessonvid/video14.mp4', 20, 'English for IELTS exam preparation course');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stu_id` int(11) NOT NULL,
  `stu_name` varchar(255) NOT NULL,
  `stu_email` varchar(255) NOT NULL,
  `stu_pass` varchar(255) NOT NULL,
  `stu_occ` varchar(255) NOT NULL,
  `stu_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stu_id`, `stu_name`, `stu_email`, `stu_pass`, `stu_occ`, `stu_img`) VALUES
(171, 'zunayed zunu', 'zunayedzunu@gmail.com', '30751852', 'sonnasi', '../image/stu/zunu.png'),
(172, 'Ant Man', 'ant@example.com', '123456', ' Web Developer', '../image/stu/student4.jpg'),
(173, ' Dr Strange', 'doc@example.com', '123456', ' Web Developer', '../image/stu/student1.jpg'),
(174, 'Scarlet Witch', 'witch@example.com', '123456', 'Web Designer', '../image/stu/student3.jpg'),
(176, ' Shaktiman', 'shaktiman@virtuallearningnexus.com', '123456', 'Software ENgg', '../image/stu/shaktiman.jpg'),
(187, 'new', 'new@gmail.com', '301268468', 'student', ''),
(188, '     md. marop hossain', 'marop@gmail.com', '30751852', 'Economist', '../image/stu/422264587_409477395078549_1597516652857268684_n (1).jpg'),
(190, 'Saera Mahamud', 'searamahamud@northsouth.edu', '30751852', 'Student', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `courseorder`
--
ALTER TABLE `courseorder`
  ADD PRIMARY KEY (`co_id`),
  ADD UNIQUE KEY `order_id` (`order_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`lesson_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`stu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `courseorder`
--
ALTER TABLE `courseorder`
  MODIFY `co_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `lesson`
--
ALTER TABLE `lesson`
  MODIFY `lesson_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `stu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
