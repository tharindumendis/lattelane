<?php


$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "lattelane_db";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    //echo "Database created successfully or already exists<br>";
} else {
    //echo "Error creating database: " . $conn->error . "<br>";
}

// Select the database
$conn->select_db($dbname);

// Create table if not exists
$sql = "CREATE TABLE IF NOT EXISTS products (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(100) NOT NULL,
    description TEXT,
    category VARCHAR(50),
    price DECIMAL(10, 2),
    cost DECIMAL(10, 2),
    image_path VARCHAR(255)
)";

if ($conn->query($sql) === TRUE) {
    // "Table 'products' created successfully or already exists";
} else {
    //echo "Error creating table: " . $conn->error;
}
