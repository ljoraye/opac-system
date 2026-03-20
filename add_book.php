<?php
include("book_functions.php");

if(isset($_POST['add'])){
  addBook($_POST['title'], $_POST['author'], $_POST['category'], $_POST['year']);
  echo "Book added successfully!<br><br>";
  echo '<a href="admin.php"><button>Back to Admin Page</button></a>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Book</title>
  <link rel="stylesheet" href="pixel.css">
</head>
<body>
  <div class="popup-box">
    <h2>Add Book</h2>
    <form method="POST">
      Title: <input type="text" name="title" required><br><br>
      Author: <input type="text" name="author" required><br><br>
      Category:
      <select name="category" required>
        <option value="">Select Category</option>
        <option value="General Works">General Works</option>
        <option value="Philosophy">Philosophy</option>
        <option value="Religion">Religion</option>
        <option value="Social Sciences">Social Sciences</option>
        <option value="Language">Language</option>
        <option value="Science">Science</option>
        <option value="Technology">Technology</option>
        <option value="Arts and Recreation">Arts and Recreation</option>
        <option value="Literature">Literature</option>
        <option value="American Literature">American Literature</option>
        <option value="English Literature">English Literature</option>
        <option value="Korean Literature">Korean Literature</option>
        <option value="History">History</option>
        <option value="Biography">Biography</option>
      </select><br><br>
      Year: <input type="text" name="year" required><br><br>
      <input type="submit" name="add" value="Add Book">
    </form>
  </div>
</body>
</html>
