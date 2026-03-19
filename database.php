<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "opac_db";

$conn = mysqli_connect("localhost","root","","opac_db");

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}
?>