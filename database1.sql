DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
`username` VARCHAR(50) PRIMARY KEY,
`password` VARCHAR(255) NOT NULL
);
DROP TABLE IF EXISTS `rusers`;
CREATE TABLE `rusers` (
  `name` VARCHAR(255) NOT NULL,
  `username` VARCHAR(25) NOT NULL PRIMARY KEY,
  `email` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(15) NOT NULL,
  `approval` int(1) NOT NULL,
  `enable` int(1) NOT NULL
);
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `postid` int(11) AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `text` text NOT NULL,
  `published` datetime DEFAULT NULL,
  `owner` VARCHAR(50),
  `enable` int(1) NOT NULL,
  FOREIGN KEY (`owner`) REFERENCES `rusers` (`username`) ON DELETE CASCADE
);
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `commentid` int(11) AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `content` text NOT NULL,
  `time` datetime DEFAULT NULL,
  `commenter` VARCHAR(50) DEFAULT NULL,
  `postid` int(11) DEFAULT NULL,
  FOREIGN KEY (`postid`) REFERENCES `posts` (`postid`) ON DELETE CASCADE
);

