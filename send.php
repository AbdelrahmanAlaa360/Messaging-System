<?php

/***** send.php file inserts messages to the database *****/
// Requires to edit only the session name to get the user username

session_start();
include_once 'db.config.php';

/********** To Be Edited ************/

// NOTICE: Edit variable $user to be equal to the user username using your session or other variable
// DO NOT DELETE VARIABLE $user
$user = $_SESSION["username"];

// admin username = 'admin' ,,, if admin username is different change it
$admin = 'admin';

/************************************/


if(isset($_POST["send"])){
    $title = $_POST["title"];
    $sendto = $_POST["sendto"];
    $msg = $_POST["msg"];
    $url = $_POST["url"];

    
    // if message sent to all users
    if($_POST['all'] == 'send_all'){
        $sql = "INSERT INTO messages(send_from, send_to, title, message, URL, send_on, public)
                VALUES('$user', 'all', '$title', '$msg', '$url', NOW(), 1)";
        mysqli_query($conn, $sql);

        header('Location:index.php?sent=All users');
    }
    // if message sent to admin
    else if($_POST['all'] == 'send_admin'){
        $sql = "INSERT INTO messages(send_from, send_to, title, message, URL, send_on)
                VALUES('$user', '$admin', '$title', '$msg', '$url', NOW())";
        mysqli_query($conn, $sql);

        header('Location:index.php?sent=Admin');
    }
    // if message sent to specific user
    else{
        $sql = "INSERT INTO messages(send_from, send_to, title, message, URL, send_on)
                VALUES('$user', '$sendto', '$title', '$msg', '$url', NOW())";
        mysqli_query($conn, $sql);

        /* send mail to user in this case, informing him about receiving a new message
           The send_email.php file should be edited to get the user email from your users table in your db */
        
        // uncomment the following line after editing send_email.php
        /* include 'send_email.php'; */

        header('Location:index.php?sent='.$sendto.'');
    }
}
