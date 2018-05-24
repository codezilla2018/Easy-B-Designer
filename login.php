<?php

    $hostname="localhost";
    $password="root";
    $username="root";
    $database="buisnesscard";



    $conn = new mysqli($hostname, $username, $password, $database);

    if (!$conn) {
        die($conn->connect_error);
    }
?>