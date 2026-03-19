<?php
include("book_functions.php");

$id = $_GET['id'];
returnBook($id);

header("Location: admin.php");
?>

