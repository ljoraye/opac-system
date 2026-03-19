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
    : mysqli_query($conn, "SELECT * FROM books ORDER BY CAST(dewey_decimal AS DECIMAL) ASC");
?>

<h2>Online Public Access Catalog (Admin)</h2>
<a href="add_book.php">Add Book</a><br><br>

<form method="GET">
Search: <input type="text" name="search">
<input type="submit" value="Search">
</form><br>

<table border="1">
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

    // Fetch latest borrow record for this book (if currently borrowed)
    $borrow = mysqli_query($conn, "
        SELECT * FROM borrow_records 
        WHERE book_id = {$row['book_id']} AND actual_return_date IS NULL
        ORDER BY borrow_id DESC LIMIT 1
    ");
    $br = mysqli_fetch_assoc($borrow);

    // Determine status
    $status = isset($row['status']) ? $row['status'] : 'Available';

    // Determine due date and overdue fee
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
    echo "🟢 Available";
} else {
    echo "🔴 Borrowed";
}
?>
</td>

<td><?php echo $due_date; ?></td>
<td><?php echo $overdue_fee . "₱"; ?></td>

<td>
<a href="edit_book.php?id=<?php echo $row['book_id']; ?>">Edit</a> |
<a href="delete_book.php?id=<?php echo $row['book_id']; ?>">Delete</a>
<?php if($status == 'Borrowed'){ ?>
    | <a href="return.php?id=<?php echo $row['book_id']; ?>">Return</a>
<?php } ?>
</td>
</tr>
<?php } ?>
</table>