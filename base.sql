
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `userid` int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(55)  NOT NULL,
  `last_name` varchar(55) NOT NULL,
  `email` varchar(255) NOT NULL, 
  'password' varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `pseudo`varchar(255) NOT NULL,
  PRIMARY KEY (`userid`)
)
INSERT INTO `user` (`userid`, `first_name`,`last_name`,`email`, `password`, `birthday`,`pseudo`) VALUES
(1, 'Jean','Nowo',`jnowo@gmail.com`, `Bordeaux13`, '1999-03-10','jnowo'),
(2, 'Marie','Lala',`mlala@gmail.com`, `MarieParis`, '1990-01-22','mlala');
(3, 'Pierre','Christophe',`pc@gmail.com`, `Toulon83`, '2004-09-15','rct83');



DROP TABLE IF EXISTS `Reach_my_friend`;
CREATE TABLE IF NOT EXISTS `Reach_my_friend`(
  `current_user_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_friend_user` int(20)  NOT NULL,
  `status` enum('accepted','pending','blocked') COLLATE ascii_bin NOT NULL DEFAULT 'pending',
  FOREIGN KEY (userid) REFERENCES user(userid)
)
INSERT INTO 'Reach_my_friend' (`current_user_id`,`id_friend_user`,`status`) VALUES
(1, 2, 'accepted'),
(2, 3, 'accepted');




DROP TABLE IF EXISTS `Transaction_Ami`;
CREATE TABLE IF NOT EXISTS `Transaction_Ami`(
  `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user_dept` int(20)  NOT NULL,
  `id_user_waiting` int(20) NOT NULL, 
  `status` enum('opened','closed','canceled') COLLATE ascii_bin NOT NULL DEFAULT 'opened',
  `date` date NOT NULL,
  `contexte` varchar(256) DEFAULT NULL,
  `sum` int(20) NOT NULL
  PRIMARY KEY (id)
  FOREIGN KEY (id_friend_user) REFERENCES Reach_my_friend(id_friend_user)
);