<?php
include("book_functions.php");

$result = mysqli_query($conn, "SELECT * FROM books");

echo "<h2>Overdue Fees</h2>";
echo "<table border='1'><tr><th>Title</th><th>Due Date</th><th>Overdue Fee</th></tr>";

while($row = mysqli_fetch_assoc($result)){
    echo "<tr>
        <td>{$row['title']}</td>
        <td>{$row['due_date']}</td>
        <td>" . computeOverdue($row['due_date']) . "₱</td>
    </tr>";
}

echo "</table>";
?>
