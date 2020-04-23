<?php
include("functions.php");

$qDb = "CREATE DATABASE IF NOT EXISTS `Dubnation`;";

$qSelDb = "USE `Dubnation`;";

$qTbUsers = "CREATE TABLE IF NOT EXISTS `user` (
    `userid` int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `first_name` varchar(55)  NOT NULL,
    `last_name` varchar(55) NOT NULL,
    `email` varchar(255) NOT NULL, 
    `password` varchar(255) NOT NULL,
    `birthday` date NOT NULL,
    `pseudo`varchar(255) NOT NULL,
    PRIMARY KEY (`userid`)
    );";
    
   
  $insertUsers = "INSERT INTO `user` (`userid`, `first_name`,`last_name`,`email`, `password`, `birthday`,`pseudo`) VALUES
  (1, 'Jean','Nowo','jnowo@gmail.com', 'Bordeaux13', '1999-03-10','jnowo'),
  (2, 'Marie','Lala','mlala@gmail.com', 'MarieParis', '1990-01-22','mlala'),
    (3, 'Pierre','Christophe','pc@gmail.com', 'Toulon83', '2004-09-15','rct83');";




$qTbFriends = "CREATE TABLE IF NOT EXISTS `Reach_my_friend`(
    `current_user_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `id_friend_user` int(20) UNSIGNED NOT NULL ,
    `status` enum('accepted','pending','blocked') COLLATE ascii_bin NOT NULL DEFAULT 'pending',
    FOREIGN KEY (current_user_id) REFERENCES user (userid),
    FOREIGN KEY (id_friend_user) REFERENCES user (userid)
    );";

$insertFriends = "INSERT INTO `Reach_my_friend` (`current_user_id`,`id_friend_user`,`status`) VALUES
  (1, 2, 'accepted'),
  (2, 3, 'accepted');";

$qTbTransaction = "CREATE TABLE IF NOT EXISTS `Transaction_Ami`(
    `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `id_user_dept` int(20) UNSIGNED  NOT NULL,
    `id_user_waiting` int(20) UNSIGNED NOT NULL,
    `status` enum('opened','closed','canceled') COLLATE ascii_bin NOT NULL DEFAULT 'opened',
    `date` date NOT NULL,
    `contexte` varchar(256) DEFAULT NULL,
    `sum` int(20) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_user_dept) REFERENCES user (userid),
    FOREIGN KEY (id_user_waiting) REFERENCES user (userid)
  );";

echo "Connexion au serveur MySQL.";
    
$con = mysqli_connect('localhost', 'admin', 'it103');
mysqli_set_charset($con, "utf8");

    
echo "création de la db";
mysqli_query($con, $qDb);
echo mysqli_info($con);
echo mysqli_error($con);
    
mysqli_query($con, $qSelDb);
echo mysqli_info($con);
echo mysqli_error($con);

  
    
echo "Création de la table Transaction Ami";
mysqli_query($con, $qTbUsers);
echo mysqli_info($con);
echo mysqli_error($con);
    
echo "insert users in database";
mysqli_query($con, $insertUsers);
echo mysqli_info($con);
echo mysqli_error($con);

echo "Création de la table Reach_my_friend.";
mysqli_query($con, $qTbFriends);
echo mysqli_info($con);
echo mysqli_error($con);
    
    
echo "insert friends";
mysqli_query($con, $insertFriends);
echo mysqli_info($con);
echo mysqli_error($con);

echo "Création de la table Transactions.";
mysqli_query($con, $qTbTransaction);
echo mysqli_info($con);
echo mysqli_error($con);

    
mysqli_close($con);
?>
