<?php 

try {
    $db = new PDO("mysql:dbname=$db;host=$host;port=$port;charset=utf8mb4",$user, $pass, $opt);
} catch(Exception $e) {
    echo "<pre>";
    var_dump($e);
    exit;
}
?>