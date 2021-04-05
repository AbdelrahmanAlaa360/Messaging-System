<?php

/*In order to send email to the user informing him receiving a new message you should get the user email from 
your own database, and we have written you the code, you have to edit it basing on your table column names */

/*
 EDIT ALL COLUMNS NAMES BASED ON YOUR USERS TABLE... 
 IMPORTANT NOTICE:
 IF "MESSAGES" TABLE AND "USERS" TABLE NOT IN SAME DATABASE.. MAKE A NEW CONNECTION HERE IN THIS FILE
 TO BE EDITED => username_column_name  ,  email_column_name  , users_table_name
*/

/*

session_start();
include_once 'dbh.config.php';

$sql = "SELECT username_column_name, email_column_name FROM users_table_name WHERE username_column_name = '$user'"
$result = mysqli_query($conn, $sql)

    while($row = mysqli_fetch_assoc($result)){
        // variable $user is already declared in send.php file
        if($user == $row['username_column_name']){
            $email = $row['email_column_name']
        }
    }


<?php


$to = $email;
$subject = "New Message";
$txt = "You have received a new message at website_name";
$headers = "From: CompanyName" . "\r\n" .
"Reply-To:name@exapmle.com" . "\r\n";

mail($to, $subject, $txt, $headers);


*/

?>