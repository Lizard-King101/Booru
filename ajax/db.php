<?php
$host = "localhost"; // Host name
$username = "root"; // Mysql username
$password = ""; // Mysql password
$db_name = "posts"; // Database name
$user_db = "posts";
$charset = "utf8mb4";

$post_conn = mysqli_connect($host, $username, $password, $db_name);

$dsn = "mysql:host=$host;dbname=$db_name;charset=$charset";
$udsn = "mysql:host=$host;dbname=$user_db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $username, $password, $opt);
$updo = new PDO($udsn, $username, $password, $opt);


?>