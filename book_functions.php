<?php
include("database.php");
include("Book.php");

// Add Book
function addBook($title, $author, $category, $year){
    global $conn;

    $book = new Book($title, $author, $category, $year);

    $dewey_decimal = getDeweyDecimal($book->getCategory());

    $sql = "INSERT INTO books(title, author, category, year_published, status, dewey_decimal)
            VALUES(
                '{$book->getTitle()}',
                '{$book->getAuthor()}',
                '{$book->getCategory()}',
                '{$book->getYear()}',
                'Available',
                '$dewey_decimal'
            )";

    mysqli_query($conn, $sql);
}

// Edit Book
function editBook($id, $title, $author, $category, $year, $due_date){
    global $conn;
    $sql = "UPDATE books 
            SET title='$title', author='$author', category='$category', year_published='$year', due_date='$due_date'
            WHERE book_id=$id";

    if(mysqli_query($conn, $sql)){
        return true;
    } else {
        echo "Error updating book: " . mysqli_error($conn);
        return false;
    }
}

// Delete Book
function deleteBook($id){
    global $conn;
    $sql = "DELETE FROM books WHERE book_id=$id";
    mysqli_query($conn, $sql);
}

// Compute Overdue Fee (5 pesos/day)
function computeOverdue($return_date, $actual_return_date = null){
    if(!$return_date || $return_date == "0000-00-00") return 0;

    $end_date = $actual_return_date ? $actual_return_date : date("Y-m-d");

    $days = (strtotime($end_date) - strtotime($return_date)) / (60*60*24);

    if($days > 0) return $days * 5;
    return 0;
}

// Search Book
function searchBooks($keyword){
    global $conn;
    $sql = "SELECT * FROM books 
            WHERE title LIKE '%$keyword%' 
            OR author LIKE '%$keyword%' 
            OR dewey_decimal LIKE '%$keyword%'";
    return mysqli_query($conn, $sql);
}

// Borrowing Book
function borrowBook($book_id, $user_name, $borrow_date, $return_date){
    global $conn;

    // Save transaction
    $sql1 = "INSERT INTO borrow_records(user_name, book_id, borrow_date, return_date)
             VALUES('$user_name', '$book_id', '$borrow_date', '$return_date')";

    // Update book status
    $sql2 = "UPDATE books SET status='Borrowed' WHERE book_id=$book_id";

    mysqli_query($conn, $sql1);
    mysqli_query($conn, $sql2);
}

// Return Book
function returnBook($book_id){
    global $conn;

    $today = date("Y-m-d");

    // Update borrow record
    $sql1 = "UPDATE borrow_records 
             SET actual_return_date='$today'
             WHERE book_id=$book_id AND actual_return_date IS NULL";

    // Make book available again
    $sql2 = "UPDATE books SET status='Available' WHERE book_id=$book_id";

    mysqli_query($conn, $sql1);
    mysqli_query($conn, $sql2);
}

function getDeweyDecimal($category){
    $map = [
        "General Works"        => "000",
        "Philosophy"           => "100",
        "Religion"             => "200",
        "Social Sciences"      => "300",
        "Language"             => "400",
        "Science"              => "500",
        "Technology"           => "600",
        "Arts and Recreation"  => "700",
        "Literature"           => "800",
        "American Literature"  => "813.6",
        "English Literature"   => "823.91",
        "Korean Literature"    => "897.7",
        "History"              => "900",
        "Biography"            => "920"
    ];

    return isset($map[$category]) ? $map[$category] : "800";
}
?>