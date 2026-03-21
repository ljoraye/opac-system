<?php
include("book_functions.php");

$result = mysqli_query($conn, "SELECT * FROM books");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Overdue Fees</title>
  <link rel="stylesheet" href="pixel.css">
</head>
<body>
  <h2>Overdue Fees</h2>
  <table>
    <tr><th>Title</th><th>Due Date</th><th>Overdue Fee</th></tr>
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['due_date']; ?></td>
        <td>₱<?php echo computeOverdue($row['due_date']); ?></td>
      </tr>
    <?php } ?>
  </table>
<a href="admin.php"><button>Back to Admin Page</button></a>
</body>
</html>