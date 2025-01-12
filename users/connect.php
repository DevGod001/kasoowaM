<?php
include_once 'vendor/autoload.php';
$dotenv=Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv -> load();
$dbhost=$_ENV['HOST'];
$dbuser=$_ENV['DBUSER'];
$dbpassword=$_ENV['DBPASS'];
$dbname=$_ENV['DBNAME'];
$conn=mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname);

?>