<?php
include("book_functions.php");

$id = $_GET['id'];

if(isset($_POST['borrow'])){
    borrowBook($id, $_POST['user_name'], $_POST['borrow_date'], $_POST['return_date']);
    echo "Book borrowed successfully!";
    echo '<a href="user.php"><button>Back to User Page</button></a>';
}
?>

<h2>Borrow Book</h2>

<form method="POST">
Name: <input type="text" name="user_name" required><br><br>
Borrow Date: <input type="date" name="borrow_date" required><br><br>
Return Date: <input type="date" name="return_date" required><br><br>

<input type="submit" name="borrow" value="Confirm Borrow">
</form>