<?php
include("book_functions.php");

$id = $_GET['id'];

if(isset($_POST['borrow'])){
  borrowBook($id, $_POST['user_name'], $_POST['borrow_date'], $_POST['return_date']);
  echo "Book borrowed successfully!<br><br>";
  echo '<a href="user.php"><button>Back to User Page</button></a>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Borrow Book</title>
  <link rel="stylesheet" href="pixel.css">
</head>
<body>
  <h2>Borrow Book</h2>
  <form method="POST">
    Name: <input type="text" name="user_name" required><br><br>
    Borrow Date: <input type="date" name="borrow_date" required><br><br>
    Return Date: <input type="date" name="return_date" required><br><br>
    <input type="submit" name="borrow" value="Confirm Borrow">
  </form>
</body>
</html>
