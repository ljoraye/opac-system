<?php
include("database.php");
include("book_functions.php");

// Get books (with optional search), sorted numerically by Dewey Decimal
$books = isset($_GET['search']) 
    ? mysqli_query($conn, "
        SELECT * FROM books 
        WHERE title LIKE '%{$_GET['search']}%' 
           OR author LIKE '%{$_GET['search']}%' 
           OR dewey_decimal LIKE '%{$_GET['search']}%'
        ORDER BY CAST(dewey_decimal AS DECIMAL) ASC
      ") 
    : mysqli_query($conn,"SELECT * FROM books ORDER BY CAST(dewey_decimal AS DECIMAL) ASC");
?>

<h2>Online Public Access Catalog (User)</h2>

<form method="GET">
Search: <input type="text" name="search">
<input type="submit" value="Search">
</form><br>

<table border="1">
<tr>
<th>Dewey Decimal</th>
<th>Title</th>
<th>Author</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($books)){ ?>
<tr>
<td><?php echo $row['dewey_decimal']; ?></td>
<td><?php echo $row['title']; ?></td>
<td><?php echo $row['author']; ?></td>
<td><?php echo $row['status']; ?></td>
<td>
<?php if($row['status'] == 'Available'){ ?>
    <a href="borrow.php?id=<?php echo $row['book_id']; ?>">Borrow</a>
<?php } else { ?>
    Not Available
<?php } ?>
</td>
</tr>
<?php } ?>
</table>