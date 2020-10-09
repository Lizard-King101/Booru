<?php
$host = "database"; // Host name
$username = "mysql"; // Mysql username
$password = "mysql"; // Mysql password
$db_name = "booru"; // Database name
$charset = "utf8mb4";

$post_conn = mysqli_connect($host, $username, $password, $db_name);

$dsn = "mysql:host=$host;dbname=$db_name;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $username, $password, $opt);


?>