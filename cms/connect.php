<?php

$host     = 'localhost';
$db       = 'schelden';
$user     = 'root';
$password = '';

$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

try {
    $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

    $conn = new PDO($dsn, $user, $password, $options);

    if ($conn) {

    }
} catch (PDOException $e) {
    echo $e->getMessage();
}