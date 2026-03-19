<?php
include("book_functions.php");
$id = $_GET['id'];
deleteBook($id);
header("Location: admin.php");
?>
