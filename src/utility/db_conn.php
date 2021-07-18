<?php
    $host_name = "localhost";
    $user_name = "root";
    $password = "";
    $db_name = "online-voting-portal";

    $conn = new mysqli($host_name, $user_name, $password, $db_name);

    if($conn->connect_error){
        die("Could not connect to database: ".$conn->connect_error);
    }
?>