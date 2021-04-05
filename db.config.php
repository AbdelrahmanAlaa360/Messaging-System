<?php

/***  dbConnection  ***/
/* Requires edit your database connection */

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "message_system";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

if(!$conn){
    mysqli_connect_error();
}       


/************ SQL CODES ************/

/****** Do not forget to edit your Database name in the code ************/
/* Copy SQL codes and paste them in SQL section in database to create tables 

-----------------------------------------------
CREATE THIS TABLE (messages)
SOURCE CODE:

CREATE TABLE `db_name`.`messages` (
     `id` INT(11) NOT NULL AUTO_INCREMENT ,
     `send_from` VARCHAR(255) NOT NULL ,
     `send_to` VARCHAR(255) NOT NULL ,
     `title` TEXT NOT NULL ,
     `message` TEXT NOT NULL ,
     `URL` VARCHAR(1000) NOT NULL ,
     `send_on` DATE NOT NULL ,
     `seen` BOOLEAN NOT NULL , `public` BOOLEAN NOT NULL ,
     PRIMARY KEY (`id`)) ENGINE = InnoDB;

-----------------------------------------------

CREATE THIS TABLE (public_seen)
SOURCE CODE:

CREATE TABLE `db_name`.`public_seen` (
     `Auto_id` INT(11) NOT NULL AUTO_INCREMENT ,
     `id` INT(11) NOT NULL ,
     `user` VARCHAR(255) NOT NULL ,
     PRIMARY KEY (`Auto_id`)) ENGINE = InnoDB;

-----------------------------------------------

*/