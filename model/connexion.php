<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "insea_inscription";

// Création de la  connexion
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Tester la connexion
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if( !mysqli_set_charset($conn, "utf8") ){
    exit("Error: ". mysqli_error($conn));
}