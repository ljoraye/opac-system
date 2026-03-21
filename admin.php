<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}
include("database.php");
include("book_functions.php");

$books = isset($_GET['search'])
? mysqli_query($conn, "
SELECT * FROM books
WHERE title LIKE '%{$_GET['search']}%'
OR author LIKE '%{$_GET['search']}%'
OR dewey_decimal LIKE '%{$_GET['search']}%'
ORDER BY CAST(dewey_decimal AS DECIMAL) ASC
")
: mysqli_query($conn, "SELECT * FROM books ORDER BY CAST(dewey_decimal AS DECIMAL) ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - OPAC</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Library Catalog Hub – Admin Portal</h2>

  <form method="GET" style="margin-top:10px; margin-bottom:15px;">
    <input type="text" name="search" placeholder="Search by title, author, or Dewey Decimal">
    <input type="submit" value="Search">
  </form>

  <div class="table-container">
    <table>
      <tr>
        <th>Dewey Decimal</th>
        <th>ID</th>
        <th>Title</th>
        <th>Author</th>
        <th>Category</th>
        <th>Year</th>
        <th>Status</th>
        <th>Due Date</th>
        <th>Overdue Fee</th>
        <th>Actions</th>
      </tr>
      <?php while($row = mysqli_fetch_assoc($books)) {
        $borrow = mysqli_query($conn, "
          SELECT * FROM borrow_records
          WHERE book_id = {$row['book_id']} AND actual_return_date IS NULL
          ORDER BY borrow_id DESC LIMIT 1
        ");
        $br = mysqli_fetch_assoc($borrow);
        $status = isset($row['status']) ? $row['status'] : 'Available';
        $due_date = $br ? $br['return_date'] : '-';
        $overdue_fee = $br ? computeOverdue($br['return_date']) : 0;
      ?>
      <tr>
        <td><?php echo $row['dewey_decimal']; ?></td>
        <td><?php echo $row['book_id']; ?></td>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['author']; ?></td>
        <td><?php echo $row['category']; ?></td>
        <td><?php echo $row['year_published']; ?></td>
        <td>
          <?php
            if($status == 'Available'){
              echo "<span class='status-available'>Available</span>";
            } else {
              echo "<span class='status-borrowed'>Borrowed</span>";
            }
          ?>
        </td>
        <td><span class="date-cell"><?php echo $due_date; ?></span></td>
        <td><?php echo "₱" . $overdue_fee; ?></td>
        <td>
          <div class="action-links <?php echo ($status == 'Borrowed') ? 'return-visible' : ''; ?>">
            <a href="edit_book.php?id=<?php echo $row['book_id']; ?>">Edit</a>
            <span>|</span>
            <a href="delete_book.php?id=<?php echo $row['book_id']; ?>">Delete</a>
            <?php if($status == 'Borrowed') { ?>
              <span>|</span>
              <a href="return.php?id=<?php echo $row['book_id']; ?>">Return</a>
            <?php } ?>
          </div>
        </td>
      </tr>
      <?php } ?>
    </table>
  </div>

  <div style="text-align:center; margin-top:10px;">
    <a href="add_book.php"><button>Add Book</button></a>
    <a href="overdue.php"><button>Overdue Fees</button></a>
    <a href="user.php"><button>User Page</button></a>
  </div>
</body>
</html>
