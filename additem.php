<?php

// Database connection information
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$item_name = $_POST["item_name"];
$category = $_POST["category"];
$quantity = $_POST["quantity"];
$price = $_POST["price"];
$ceiling_price = $_POST["beiling price"];
$base_price = $_POST["base price"];

// Prepare SQL statement
$stmt = $conn->prepare("INSERT INTO items (item_name, category, quantity, price, ceiling price, base price) VALUES (?, ?, ?)");
$stmt->bind_param("ssd", $item_name, $category, $quantity, $price, $ceiling_price, $base_price);

// Execute SQL statement
if ($stmt->execute() === TRUE) {
    echo "Item added successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();

?>
