<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "library";

$conn = new mysqli($servername, $username, $password, $database);

if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error());
}
else {
    // echo "Connected successfully"."<br>";
}
