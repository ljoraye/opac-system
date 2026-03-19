<?php
include("book_functions.php");

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM books WHERE book_id=$id");
$book = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){
    $title = $_POST['title'];
    $author = $_POST['author'];
    $category = $_POST['category'];
    $year = $_POST['year'];

    // Automatically assign Dewey Decimal
    $dewey_decimal = getDeweyDecimal($category);

    $sql = "UPDATE books 
            SET title='$title', author='$author', category='$category', year_published='$year', dewey_decimal='$dewey_decimal'
            WHERE book_id=$id";

    if(mysqli_query($conn,$sql)){
        echo "Book updated successfully!<br><br>";
    } else {
        echo "Error updating book: " . mysqli_error($conn);
    }
}
?>

<h2>Edit Book</h2>
<form method="POST">
    Title: <input type="text" name="title" value="<?php echo $book['title']; ?>" required><br><br>
    Author: <input type="text" name="author" value="<?php echo $book['author']; ?>" required><br><br>
    Category: 
    <select name="category" required>
        <option value="">Select Category</option>
        <?php
        $categories = ["American Literature","English Literature","Korean Literature","Fantasy","Memoir","Romantic Comedy"];
        foreach($categories as $cat){
            $selected = $book['category'] == $cat ? "selected" : "";
            echo "<option value='$cat' $selected>$cat</option>";
        }
        ?>
    </select><br><br>
    Year: <input type="text" name="year" value="<?php echo $book['year_published']; ?>" required><br><br>
    <input type="submit" name="update" value="Update Book">
</form>
<a href="admin.php"><button>Back to Admin Page</button></a>
