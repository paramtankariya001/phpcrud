<?php
include 'config.php';
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    echo "Invalid department ID.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $dept_name = trim($_POST['dept_name']);
    $stmt = $conn->prepare("UPDATE department SET dept_name = ? WHERE dept_Id = ?");
    $stmt->bind_param("si", $dept_name, $id);
    if ($stmt->execute()) {
        echo "<script>
        alert('Department Updated Successfully.');
        window.location.href = 'index.php';
        </script>";
        exit();
    } else {
        echo "Error updating department: " . $conn->error;
        exit();
    }
}

$stmt = $conn->prepare("SELECT dept_name FROM department WHERE dept_Id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
if ($row) {
    $dept_name = $row['dept_name'];
} else {
    echo "Department not found.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Department</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        h2 {
            color: #333;
        }
        form {
            margin: 20px auto;
            width: 50%;
            text-align: left;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>Edit Department</h2>
    <form method="post">
        <label for="dept_name">Department Name:</label>
        <input type="text" id="dept_name" name="dept_name" value="<?php echo $dept_name; ?>" required>
        <input type="submit" value="Update Department">
    </form>
</body>
</html>
