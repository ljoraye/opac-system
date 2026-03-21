<?php
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
  <title>User - OPAC</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Archiva: Library Catalog Hub – User Portal</h2>

  <form method="GET" style="margin-top:10px;">
    <input type="text" name="search" placeholder="Search by title, author, or Dewey Decimal">
    <input type="submit" value="Search">
  </form>

  <!-- Scrollable table container -->
  <div class="table-container">
    <table>
      <tr>
        <th>Dewey Decimal</th>
        <th>Title</th>
        <th>Author</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
      <?php while($row = mysqli_fetch_assoc($books)) { ?>
      <tr>
        <td><?php echo $row['dewey_decimal']; ?></td>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['author']; ?></td>
        <td>
          <?php
            if($row['status'] == 'Available'){
              echo "<span class='status-available'>Available</span>";
            } else {
              echo "<span class='status-borrowed'>Borrowed</span>";
            }
          ?>
        </td>
        <td>
          <?php if($row['status'] == 'Available') { ?>
            <a href="borrow.php?id=<?php echo $row['book_id']; ?>">Borrow</a>
          <?php } else { ?>
            Not Available
          <?php } ?>
        </td>
      </tr>
      <?php } ?>
    </table>
  </div>

  <div style="text-align:center; margin-top:10px;">
    <a href="index.php"><button>Return to Title Page</button></a>
  </div>
</body>
</html>