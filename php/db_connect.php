<?php
    // Connect to database
    $host       = "localhost";
    $user       = "root";
    $password   = "root";
    $database   = "sykes_interview";
    $connection = new PDO("mysql:host=$host;dbname=$database", $user, $password);
?>