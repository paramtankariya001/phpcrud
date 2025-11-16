<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dept_name = trim($_POST['dept_name']);

    // Check for duplicate (case-insensitive)
    $stmt = $conn->prepare("SELECT dept_name FROM department WHERE LOWER(dept_name) = LOWER(?)");
    $stmt->bind_param("s", $dept_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        echo "<script>
        alert('Department already exists.');
        window.location.href = 'add_dept.php';
        </script>";
        exit();
    }

    // Insert new department using prepared statement
    $stmt = $conn->prepare("INSERT INTO department (dept_name) VALUES (?)");
    $stmt->bind_param("s", $dept_name);
    if ($stmt->execute()) {
        echo "<script>
        alert('Department Added Successfully.');
        window.location.href = 'index.php';
        </script>";
        exit();
    } else {
        echo "Error: " . $conn->error;
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Department</title>
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
    <h2>Add Department</h2>
    <form method="post">
        <label for="dept_name">Department Name:</label>
        <input type="text" id="dept_name" name="dept_name" required>
        <input type="submit" value="Add Department">
    </form>
</body>
</html>
