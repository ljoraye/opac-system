<?php
include("book_functions.php");

if(isset($_POST['add'])){
    // Pass Dewey Decimal to addBook function
    addBook(
        $_POST['title'], 
        $_POST['author'], 
        $_POST['category'], 
        $_POST['year'], 
    );

    echo "Book added successfully!<br><br>";
    echo '<a href="admin.php"><button>Back to Admin Page</button></a>';
}
?>

<h2>Add Book</h2>
<form method="POST">
    Title: <input type="text" name="title" required><br><br>
    Author: <input type="text" name="author" required><br><br>
    Category: 
    <select name="category" required>
        <option value="">Select Category</option>
        <option value="American Literature">American Literature</option>
        <option value="English Literature">English Literature</option>
        <option value="Korean Literature">Korean Literature</option>
        <option value="Fantasy">Fantasy</option>
        <option value="Memoir">Memoir</option>
        <option value="Romantic Comedy">Romantic Comedy</option>
    </select><br><br>
    Year: <input type="text" name="year" required><br><br>
    <input type="submit" name="add" value="Add Book">
</form>