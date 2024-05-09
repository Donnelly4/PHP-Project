<?php
    $servername = 'localhost';
    $username = 'root';
    $password = 'donnelly';
    $db_name = 'wcl_players';
    //Create connection
    $conn = mysqli_connect($servername, $username, $password, $db_name);

    //Check connection
    if (!$conn) {
        die("Coonection failed: " . mysqli_connect_error());
    }
?>
