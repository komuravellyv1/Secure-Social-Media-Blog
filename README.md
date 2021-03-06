README FILE:

INTRODUCTION:
This project mainly aims in applying security principles and practices and web-development technologies that learned in the class CPS 592-07. This is through by creating a blog/social media application by using PHP Language, Ubuntu OS, and MySQL Database. When developing the application, I took care of the problems or attacks by thinking like a hacker. There are some chances that attackers can steal SESSION variables used in application which result to vulnerability of the application. Which are taken care by security principles learned. Also, to prevent SQL Injection attacks Prepared statements are used when interacting with Database. Also, I took care of Database security by creating and granting the access to user. All passwords are hashed, and all input and outputs are sanitized. 

Development:
This is a blog with static web pages and relational database in the backend. On the Index page [main page] it consists of all the posts posted by users registered. Anyone can comment on these posts means no need to have an account to post a comment on the posts.
Users can register into the application by providing mandatory details {name, username, password, email, phone}. Once registered they need to be approved by the super user [admin]. Without approval users cannot login to the system. If admin approves and enables the account user can login to the system. After successful login users can create, edit, delete their own posts. They cannot do anything to other posts in the application. Also, Users can change their all details except username. Every change, update or action is securely programmed.
Admins are created directly in the database and can login to the system with the details. Once logged, he can see all the users in the system. Admin can approve, disapprove, enable, disable the users. Also, admin can change his password securely. Admin has no privilege on posts created by users.
Achievement: By doing this project I got knowledge of Security principles that are applied when developing web applications. Also, other security issues due to flaws in programming languages and network intruders to steal data on network are learned and implemented security principles in my project by keeping in mind to avoid them.
At end, I can create Robust and defensive applications by learning and practicing security principles.

2. DESIGN:
DATABASE DESIGN:
For this project I used MySQL Database on Ubuntu OS and Tomcat Server. I have created a database [venky_secad_project] and developed my tables inside. For this I mainly created 4 tables namely users for Admins, rusers for Regular users, posts for posts, comments for comments.  Also, Importantly I Created a User and granted privileges to the user instead of interacting with Database directly. Which is a security principle learned in the class {Never ever interact with the database directly. Instead create user and grant permissions}. For this project I created user[spsecad] Identified by Aruna@03. 


Database.sql

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

deployed on Ubuntu Tomcat server- by simply copying files to the serverfolder.

