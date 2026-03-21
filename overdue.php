<?php
include("book_functions.php");

$result = mysqli_query($conn, "
  SELECT books.title, borrow_records.return_date
  FROM books
  JOIN borrow_records 
    ON books.book_id = borrow_records.book_id
  WHERE borrow_records.actual_return_date IS NULL
");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Overdue Fees</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Overdue Fees</h2>

  <div class="table-container">
    <table>
      <tr>
        <th>Title</th>
        <th>Due Date</th>
        <th>Overdue Fee</th>
      </tr>
      <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
          <td><?php echo $row['title']; ?></td>
          <td><?php echo $row['return_date']; ?></td>
          <td>₱<?php echo computeOverdue($row['return_date']); ?></td>
        </tr>
      <?php } ?>
      </table>
  </div>

  <a href="admin.php"><button>Back to Admin Page</button></a>
</body>
</html>