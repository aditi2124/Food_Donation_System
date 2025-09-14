<?php
$conn = new mysqli("localhost", "root", "", "waste food");

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM users";  // Replace 'users' with an actual table name
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "User: " . $row["username"] . "<br>";
    }
} else {
    echo "No users found.";
}

$conn->close();
?>
