<?php 
$host = "localhost";
$port = "3306";
$user = "root";
$pass = "";
$db   = "proyek_aplin";
$opt  = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Jadi Object!Ini Association array woy
];
?>