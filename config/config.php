<?php
$host = 'localhost';
$user = 'root';
$password = 'root';
$db = 'pagination';
$charset='utf8';

$dsn ="mysql:dbname=$db;host=$host;charset=$charset";

$options =[
    PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
];

$pdo = new PDO($dsn, $user,$password,$options);


