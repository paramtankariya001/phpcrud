<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
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

        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 80%;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        h2,
        h3 {
            margin-bottom: 20px;
        }
    </style>
    <script>
        function searchDept() {
            let s = document.getElementById('dept-search').value;
            let req = new XMLHttpRequest();
            req.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById('dept-table-body').innerHTML = this.responseText;
                }
            };
            req.open("GET", "search_dept.php?search=" + s, true);
            req.send();
        }
    </script>
</head>
 
<body>
    <h2> Library Management System </h2>
    <h3> Department </h3>
    <input type="text" id="dept-search" onkeyup="searchDept()" placeholder="Search Department">
    <br>
    <br>
    <a href="add_dept.php"> Add Department </a>
    <table>
        <tr>
            <th> ID </th>
            <th> Name </th>
            <th> Action </th>
        </tr>
        <tbody id="dept-table-body">
            <?php
            $sql = "SELECT * FROM department";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row["dept_Id"] . "</td>
                        <td>" . $row["dept_name"] . "</td>
                        <td>
                            <a href='edit_dept.php?id=" . $row["dept_Id"] . "'>Edit</a> |
                            <a href='delete_dept.php?id=" . $row["dept_Id"] . "'>Delete</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No departments found</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <br>
    <br>
    <h3> Books </h3>
    <a href="add_book.php"> Add Book </a>
    <table>
        <tr>
            <th> ID </th>
            <th> Title </th>
            <th> Author </th>
            <th> Department </th>
            <th> Subject </th>
            <th> Price </th>
            <th> Publication Year </th>
            <th> Action </th>
        </tr>
        <tr>
            <?php
            $sql = "SELECT books.book_id, books.title, books.author, books.Subject, books.Price, books.Publication_Year, department.dept_name FROM books LEFT JOIN department ON books.dept_id = department.dept_Id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row["book_id"] . "</td>`
                        <td>" . $row["title"] . "</td>
                        <td>" . $row["author"] . "</td>
                        <td>" . $row["dept_name"] . "</td>
                        <td>" . htmlspecialchars($row["Subject"]) . "</td>
                        <td>" . htmlspecialchars($row["Price"]) . "</td>
                        <td>" . htmlspecialchars($row["Publication_Year"]) . "</td>
                        <td>
                            <a href='edit_book.php?id=" . $row["book_id"] . "'>Edit</a> |
                            <a href='delete_book.php?id=" . $row["book_id"] . "'>Delete</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No books found</td></tr>";
            }
            ?>
    </table>
</body>

</html>