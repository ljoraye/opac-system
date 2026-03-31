<?php
require_once 'load_env.php';

$host = $_ENV['DB_HOST'] ?? "localhost";
$user = $_ENV['DB_USER'] ?? "root";
$password = $_ENV['DB_PASSWORD'] ?? "";
$dbname = $_ENV['DB_NAME'] ?? "opac_db";

$conn = mysqli_connect($host, $user, $password, $dbname);

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}
?>
