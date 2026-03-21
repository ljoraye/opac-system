<?php
include("book_functions.php");

if(isset($_POST['add'])){
  // If "Other" is selected, use the custom category input
  $category = ($_POST['category'] === 'Other') ? $_POST['custom_category'] : $_POST['category'];

  addBook($_POST['title'], $_POST['author'], $category, $_POST['year']);
  echo "Book added successfully!<br><br>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Book</title>
  <link rel="stylesheet" href="style.css">
  <script>
    function toggleCustomCategory(select) {
      const customInput = document.getElementById('custom-category');
      if (select.value === 'Other') {
        customInput.style.display = 'block';
        customInput.querySelector('input').required = true;
      } else {
        customInput.style.display = 'none';
        customInput.querySelector('input').required = false;
      }
    }
  </script>
</head>
<body>
  <h2>Add Book</h2>
  <form method="POST">
    Title: <input type="text" name="title" required><br><br>
    Author: <input type="text" name="author" required><br><br>
    Category:
    <select name="category" required onchange="toggleCustomCategory(this)">
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
      <option value="Other">Other (please specify)</option>
    </select>
    <div id="custom-category" style="display:none; margin-top:8px;">
      <input type="text" name="custom_category" placeholder="Enter custom category">
    </div>
    <br><br>
    Year: <input type="text" name="year" required><br><br>
    <input type="submit" name="add" value="Add Book">
  </form>

  <a href="admin.php"><button style="margin-top:10px;">Back to Admin Page</button></a>
</body>
</html>