<?php
include 'config.php';

if (isset($_GET['id'])) {
    $book_id = (int) $_GET['id'];
    if ($book_id <= 0) {
        echo "Book ID not specified.";
        exit();
    }

    $stmt = $conn->prepare("DELETE FROM books WHERE book_id = ?");
    $stmt->bind_param("i", $book_id);
    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
        exit();
    }
} else {
    echo "Book ID not specified.";
    exit();
}
?>
