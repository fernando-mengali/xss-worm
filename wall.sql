-- Adminer 5.4.2 MariaDB 10.5.29-MariaDB-ubu2004 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `com_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `msg_id_fk` int(11) DEFAULT NULL,
  `uid_fk` int(11) DEFAULT NULL,
  `ip` varchar(30) DEFAULT NULL,
  `created` int(11) DEFAULT 1269249260,
  `like_count` int(11) DEFAULT 0,
  PRIMARY KEY (`com_id`),
  KEY `msg_id_fk` (`msg_id_fk`),
  KEY `uid_fk` (`uid_fk`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `comment_like`;
CREATE TABLE `comment_like` (
  `clike_id` int(11) NOT NULL AUTO_INCREMENT,
  `com_id_fk` int(11) NOT NULL,
  `uid_fk` int(11) NOT NULL,
  PRIMARY KEY (`clike_id`),
  KEY `com_id_fk` (`com_id_fk`),
  KEY `uid_fk` (`uid_fk`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `conversation`;
CREATE TABLE `conversation` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_one` int(11) NOT NULL,
  `user_two` int(11) NOT NULL,
  `ip` varchar(30) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`c_id`),
  KEY `user_one` (`user_one`),
  KEY `user_two` (`user_two`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `conversation_reply`;
CREATE TABLE `conversation_reply` (
  `cr_id` int(11) NOT NULL AUTO_INCREMENT,
  `reply` text DEFAULT NULL,
  `user_id_fk` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `time` int(11) NOT NULL,
  `c_id_fk` int(11) NOT NULL,
  `read_status` int(11) DEFAULT 1,
  PRIMARY KEY (`cr_id`),
  KEY `user_id_fk` (`user_id_fk`),
  KEY `c_id_fk` (`c_id_fk`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `friends`;
CREATE TABLE `friends` (
  `friend_id` int(11) NOT NULL AUTO_INCREMENT,
  `friend_one` int(11) DEFAULT NULL,
  `friend_two` int(11) DEFAULT NULL,
  `role` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`friend_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `uid_fk` int(11) DEFAULT NULL,
  `ip` varchar(30) DEFAULT NULL,
  `created` int(11) DEFAULT 1269249260,
  `uploads` varchar(30) DEFAULT NULL,
  `like_count` int(11) DEFAULT 0,
  `comment_count` int(11) DEFAULT 0,
  `share_count` int(11) DEFAULT 0,
  PRIMARY KEY (`msg_id`),
  KEY `uid_fk` (`uid_fk`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `message_like`;
CREATE TABLE `message_like` (
  `like_id` int(11) NOT NULL AUTO_INCREMENT,
  `msg_id_fk` int(11) NOT NULL,
  `uid_fk` int(11) NOT NULL,
  PRIMARY KEY (`like_id`),
  KEY `uid_fk` (`uid_fk`),
  KEY `msg_id_fk` (`msg_id_fk`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `message_share`;
CREATE TABLE `message_share` (
  `share_id` int(11) NOT NULL AUTO_INCREMENT,
  `msg_id_fk` int(11) NOT NULL,
  `uid_fk` int(11) NOT NULL,
  `ouid_fk` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  PRIMARY KEY (`share_id`),
  KEY `uid_fk` (`uid_fk`),
  KEY `msg_id_fk` (`msg_id_fk`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `profile_pic` varchar(200) DEFAULT NULL,
  `friend_count` int(11) DEFAULT 0,
  `status` int(1) DEFAULT 1,
  `name` varchar(150) DEFAULT NULL,
  `profile_pic_status` int(1) DEFAULT 0,
  `conversation_count` int(11) DEFAULT 0,
  `updates_count` int(11) DEFAULT 0,
  `first_name` varchar(200) DEFAULT NULL,
  `last_name` varchar(200) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `birthday` varchar(20) DEFAULT NULL,
  `location` varchar(200) DEFAULT NULL,
  `hometown` varchar(200) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `relationship` varchar(30) DEFAULT NULL,
  `timezone` varchar(10) DEFAULT NULL,
  `provider` varchar(10) DEFAULT NULL,
  `provider_id` int(30) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `user_uploads`;
CREATE TABLE `user_uploads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_path` varchar(30) DEFAULT NULL,
  `uid_fk` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid_fk` (`uid_fk`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


-- 2026-04-23 18:06:23 UTC

-- Adminer 5.4.2 MariaDB 10.5.29-MariaDB-ubu2004 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';



INSERT INTO `conversation` (`c_id`, `user_one`, `user_two`, `ip`, `time`) VALUES
(3,	1,	2,	'10.0.0.2',	1375084692),
(6,	4,	1,	'10.0.0.2',	1374319423),
(8,	5,	1,	'10.0.0.2',	1374323177),
(9,	3,	2,	'10.0.0.5',	1374322504),
(10,	3,	1,	'10.0.0.5',	1374319545),
(11,	6,	1,	'10.0.0.2',	1374319587),
(12,	9,	1,	'10.0.0.5',	1374319639),
(13,	9,	2,	'10.0.0.5',	1374319623),
(14,	5,	2,	'10.0.0.5',	1374319702),
(15,	2,	7,	'10.0.0.5',	1374319811),
(16,	7,	1,	'10.0.0.2',	1374320572),
(19,	11,	1,	'10.0.0.2',	1375084745),
(20,	13,	1,	'10.0.0.2',	1374321381),
(21,	12,	1,	'10.0.0.5',	1374321558),
(22,	12,	13,	'10.0.0.5',	1374321609);

INSERT INTO `conversation_reply` (`cr_id`, `reply`, `user_id_fk`, `ip`, `time`, `c_id_fk`, `read_status`) VALUES
(7,	'hi',	2,	'10.0.0.5',	1374318962,	3,	0);

INSERT INTO `friends` (`friend_id`, `friend_one`, `friend_two`, `role`) VALUES
(1,	1,	1,	'me'),
(2,	2,	2,	'me'),
(3,	3,	3,	'me'),
(4,	4,	4,	'me'),
(5,	5,	5,	'me'),
(6,	6,	6,	'me'),
(7,	7,	7,	'me'),
(8,	8,	8,	'me'),
(9,	9,	9,	'me'),
(10,	3,	1,	'fri'),
(11,	3,	4,	'fri'),
(12,	3,	9,	'fri'),
(13,	3,	5,	'fri'),
(14,	3,	8,	'fri'),
(15,	3,	6,	'fri'),
(16,	3,	7,	'fri'),
(17,	1,	7,	'fri'),
(18,	1,	6,	'fri'),
(19,	1,	8,	'fri'),
(20,	1,	5,	'fri'),
(21,	1,	9,	'fri'),
(22,	1,	4,	'fri'),
(23,	1,	3,	'fri'),
(24,	2,	1,	'fri'),
(25,	5,	3,	'fri'),
(26,	5,	4,	'fri'),
(27,	5,	9,	'fri'),
(28,	5,	8,	'fri'),
(29,	5,	6,	'fri'),
(30,	5,	7,	'fri'),
(31,	2,	4,	'fri'),
(33,	2,	3,	'fri'),
(34,	2,	7,	'fri'),
(35,	2,	8,	'fri'),
(36,	4,	2,	'fri'),
(37,	4,	3,	'fri'),
(38,	4,	9,	'fri'),
(39,	4,	5,	'fri'),
(40,	2,	9,	'fri'),
(41,	4,	8,	'fri'),
(42,	4,	6,	'fri'),
(43,	4,	7,	'fri'),
(44,	2,	5,	'fri'),
(45,	4,	1,	'fri'),
(46,	2,	6,	'fri'),
(47,	7,	2,	'fri'),
(48,	7,	6,	'fri'),
(49,	7,	1,	'fri'),
(50,	7,	4,	'fri'),
(51,	7,	3,	'fri'),
(52,	7,	8,	'fri'),
(53,	7,	5,	'fri'),
(62,	7,	9,	'fri'),
(63,	9,	1,	'fri'),
(64,	9,	2,	'fri'),
(65,	9,	3,	'fri'),
(66,	9,	4,	'fri'),
(67,	9,	5,	'fri'),
(68,	9,	8,	'fri'),
(69,	9,	6,	'fri'),
(70,	9,	7,	'fri'),
(71,	5,	2,	'fri'),
(72,	5,	1,	'fri'),
(73,	6,	1,	'fri'),
(74,	3,	2,	'fri'),
(75,	6,	2,	'fri'),
(76,	6,	3,	'fri'),
(77,	6,	4,	'fri'),
(78,	6,	9,	'fri'),
(79,	6,	5,	'fri'),
(80,	6,	8,	'fri'),
(81,	6,	7,	'fri'),
(82,	10,	10,	'me'),
(84,	11,	11,	'me'),
(90,	10,	8,	'fri'),
(93,	2,	10,	'fri'),
(94,	12,	12,	'me'),
(96,	12,	1,	'fri'),
(97,	13,	13,	'me'),
(98,	12,	11,	'fri'),
(99,	12,	2,	'fri'),
(100,	12,	3,	'fri'),
(101,	12,	4,	'fri'),
(102,	12,	9,	'fri'),
(103,	12,	5,	'fri'),
(104,	12,	8,	'fri'),
(105,	12,	6,	'fri'),
(106,	12,	7,	'fri'),
(107,	13,	1,	'fri'),
(108,	2,	12,	'fri'),
(109,	2,	13,	'fri'),
(110,	12,	13,	'fri'),
(111,	2,	11,	'fri'),
(114,	1,	10,	'fri'),
(116,	1,	11,	'fri'),
(118,	1,	13,	'fri'),
(121,	1,	2,	'fri');




INSERT INTO `users` (`uid`, `username`, `password`, `email`, `profile_pic`, `friend_count`, `status`, `name`, `profile_pic_status`, `conversation_count`, `updates_count`, `first_name`, `last_name`, `gender`, `birthday`, `location`, `hometown`, `bio`, `relationship`, `timezone`, `provider`, `provider_id`) VALUES
(1,	'Hulk',	'827ccb0eea8a706c4c34a16891f84e7b',	'hulk@gmail.com',	'13751131401.jpg',	11,	1,	'Hulk',	1,	0,	7,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(2,	'superman',	'827ccb0eea8a706c4c34a16891f84e7b',	'superman@gmail.com',	'13743246892.png',	12,	1,	'Superman',	1,	1,	4,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(3,	'spiderman',	'827ccb0eea8a706c4c34a16891f84e7b',	'spidemran@gmail.com',	'13743002873.jpg',	8,	1,	'Spiderman',	1,	1,	2,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(4,	'Iron',	'827ccb0eea8a706c4c34a16891f84e7b',	'iron@gmail.com',	'17466631994.jpg',	8,	1,	'Iron Man',	0,	0,	1,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(5,	'mu',	'827ccb0eea8a706c4c34a16891f84e7b',	'mu@gmail.com',	'17466624535.jpg',	8,	1,	'Mu',	1,	1,	1,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(6,	'Flash',	'827ccb0eea8a706c4c34a16891f84e7b',	'flash@gmail.com',	'13743006356.jpg',	8,	1,	'Flash',	1,	0,	4,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(7,	'shiryu',	'827ccb0eea8a706c4c34a16891f84e7b',	'shiryu@gmail.com',	'13743008297.png',	8,	1,	'Shiryu',	1,	1,	1,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(9,	'arrow',	'827ccb0eea8a706c4c34a16891f84e7b',	'arrow@gmail.com',	'17466625415.png',	8,	1,	'Arrow',	1,	0,	1,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(11,	'woman',	'827ccb0eea8a706c4c34a16891f84e7b',	'woman@gmail.com',	'137432094211.png',	0,	1,	'Woman',	1,	1,	9,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(12,	'spiderman',	'827ccb0eea8a706c4c34a16891f84e7b',	'spiderman@gmail.com',	'13743002873.jpg',	11,	1,	'Spiderman',	1,	0,	8,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(13,	'superman',	'827ccb0eea8a706c4c34a16891f84e7b',	'superman@9lessons.info',	'137432130613.png',	1,	1,	'Man of Steel',	1,	1,	1,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL);

INSERT INTO `user_uploads` (`id`, `image_path`, `uid_fk`) VALUES
(1,	'13743039732.jpg',	2),
(2,	'13743042831.jpg',	1),
(3,	'13743042871.jpg',	1),
(4,	'13743043041.jpg',	1),
(5,	'13743043071.jpg',	1),
(6,	'13743046699.jpg',	9),
(7,	'137432132213.jpg',	13),
(8,	'137432142212.jpg',	12),
(9,	'13743261262.jpg',	2),
(10,	'13743261322.jpg',	2),
(11,	'13743285151.jpg',	1),
(12,	'13743285181.jpg',	1),
(13,	'13743285191.jpg',	1),
(14,	'13743285491.jpg',	1),
(15,	'13743292102.jpg',	2),
(16,	'13743292162.jpg',	2),
(17,	'13743292362.jpg',	2),
(18,	'13746398311.jpg',	1),
(19,	'13746398351.png',	1),
(20,	'13750797131.jpg',	1),
(21,	'13750797241.jpg',	1),
(22,	'13750798471.jpg',	1),
(23,	'13750799631.jpg',	1),
(24,	'13750803921.jpg',	1),
(25,	'13750804151.jpg',	1),
(26,	'13750807091.jpg',	1),
(27,	'13750807721.jpg',	1),
(28,	'13750808721.jpg',	1),
(29,	'13750809531.jpg',	1),
(30,	'13750809881.jpg',	1),
(31,	'13750810941.jpg',	1),
(32,	'13750811061.jpg',	1),
(33,	'13750814231.jpg',	1),
(34,	'13750814431.jpg',	1),
(35,	'13750816121.jpg',	1),
(36,	'13750817281.jpg',	1),
(37,	'13750821521.jpg',	1),
(38,	'13750821721.jpg',	1),
(39,	'13750833321.jpg',	1),
(40,	'13750833351.jpg',	1),
(41,	'13750833411.jpg',	1),
(42,	'13750833531.jpg',	1),
(43,	'13750844391.jpg',	1),
(44,	'13750844431.jpg',	1),
(45,	'13750844501.jpg',	1),
(46,	'13750844541.jpg',	1),
(47,	'13750860471.jpg',	1),
(48,	'13750860821.jpg',	1),
(49,	'13750860851.jpg',	1),
(50,	'13750860881.jpg',	1),
(51,	'13750861011.jpg',	1),
(52,	'137508837511.jpg',	11);

-- 2026-04-23 18:35:45 UTC
