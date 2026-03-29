<?php
include("book_functions.php");
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM books WHERE book_id=$id");
$book = mysqli_fetch_assoc($result);
if(isset($_POST['update'])){
    $title = $_POST['title'];
    $author = $_POST['author'];
    $category = ($_POST['category'] === 'Other') ? $_POST['custom_category'] : $_POST['category'];
    $year = $_POST['year'];
    $dewey_decimal = getDeweyDecimal($category);
    $sql = "UPDATE books
            SET title='$title', author='$author', category='$category',
            year_published='$year', dewey_decimal='$dewey_decimal'
            WHERE book_id=$id";
    if(mysqli_query($conn, $sql)){
        echo "Book updated successfully!<br><br>";
    } else {
        echo "Error updating book: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Book</title>
    <link rel="stylesheet" href="archiva.css">
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
    <h2>Edit Book</h2>
    <form method="POST">
        Title: <input type="text" name="title" value="<?php echo $book['title']; ?>" required><br><br>
        Author: <input type="text" name="author" value="<?php echo $book['author']; ?>" required><br><br>
        Category:
        <select name="category" required onchange="toggleCustomCategory(this)">
            <?php
            $categories = [
                "General Works","Philosophy","Religion","Social Sciences","Language","Science",
                "Technology","Arts and Recreation","Literature","American Literature",
                "English Literature","Korean Literature","History","Biography","Other"
            ];
            foreach($categories as $cat){
                $selected = $book['category'] == $cat ? "selected" : "";
                echo "<option value='$cat' $selected>$cat</option>";
            }
            // If current category is not in the list, add it as selected
            if(!in_array($book['category'], $categories)){
                echo "<option value='{$book['category']}' selected>{$book['category']}</option>";
            }
            ?>
        </select>
        <div id="custom-category" style="display:<?php echo (!in_array($book['category'], array_diff($categories, ['Other']))) ? 'block' : 'none'; ?>; margin-top:8px;">
            <input type="text" name="custom_category" placeholder="Enter custom category" value="<?php echo !in_array($book['category'], $categories) ? $book['category'] : ''; ?>">
        </div><br><br>
        Year: <input type="text" name="year" value="<?php echo $book['year_published']; ?>" required><br><br>
        <input type="submit" name="update" value="Update Book">
    </form>
    <div style="margin-top:10px;">
        <a href="admin.php"><button type="button">Back to Admin Page</button></a>
    </div>
</body>
</html>