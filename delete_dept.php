<?php
include 'config.php';
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0) {
    echo "<script>
    alert('Invalid department ID.');
    window.location.href = 'index.php';
    </script>";
    exit();
}

$stmt = $conn->prepare("SELECT dept_Id FROM books WHERE dept_Id = ? LIMIT 1");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result && $result->num_rows > 0) {
    echo "<script>
    alert('Cannot delete department. It is referenced by other records.');
    window.location.href = 'index.php';
    </script>";
    exit();
}

$stmt = $conn->prepare("DELETE FROM department WHERE dept_Id = ?");
$stmt->bind_param("i", $id);
if ($stmt->execute()) {
    echo "<script>
    alert('Department Deleted Successfully.');
    window.location.href = 'index.php';
    </script>";
    exit();
} else {
    echo "Error deleting department: " . $conn->error;
    exit();
}
?>
