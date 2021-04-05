<?php
    
    include_once 'db.config.php';
    
    $sql = "SELECT * FROM messages WHERE id = ".$_GET['del']."";
    $result = mysqli_query($conn, $sql);
    
    while($row = mysqli_fetch_assoc($result)){
        $sql_del = "DELETE FROM messages WHERE id = ".$_GET['del']."";
        mysqli_query($conn, $sql_del);

        $sql_del = "DELETE FROM public_seen WHERE id = ".$_GET['del']."";
        mysqli_query($conn, $sql_del);

        header('Location: outbox.php?deleted');
        die();
    }
    