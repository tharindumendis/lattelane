<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lattelane_db";

// Create connection
global $conn;
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
$sql = "CREATE TABLE IF NOT EXISTS Users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    city VARCHAR(50) NOT NULL,
    street VARCHAR(50) NOT NULL,
    address_no VARCHAR(50) NOT NULL,
    phone VARCHAR(10),
    email VARCHAR(50) NOT NULL unique,
    password VARCHAR(200) NOT NULL,
    admin TINYINT(1) DEFAULT 0
)";


//CREATE TABLE `lattelane_db`.`invoices` (`invoice_id` INT NOT NULL AUTO_INCREMENT , `user_id` INT NOT NULL , `product_id` INT NOT NULL , `price` INT NOT NULL , `quantity` INT NOT NULL , `total` INT NOT NULL , PRIMARY KEY (`invoice_id`)) ENGINE = InnoDB;


if ($conn->query($sql) === TRUE) {
    // "Table 'products' created successfully or already exists";
} else {
    //echo "Error creating table: " . $conn->error;
}


// Check if admin user exists
$checkAdminSQL = "SELECT * FROM Users WHERE email = 'admin@lattelane.com'";
$result = $conn->query($checkAdminSQL);

if ($result->num_rows == 0) {
    // Admin user doesn't exist, so let's create one
    $defaltAdminPassword = password_hash("admin1.", PASSWORD_DEFAULT);
    $createAdminSQL = "INSERT INTO Users (first_name, last_name, city, street, address_No, phone, email, password, admin) 
                       VALUES ('Admin', 'User', 'AdminCity', 'AdminStreet', '1', '1234567890', 'admin@lattelane.com', '$defaltAdminPassword', 1)";

    if ($conn->query($createAdminSQL) === TRUE) {
        //echo "Admin user created successfully";
    } else {
        //echo "Error creating admin user: " . $conn->error;
    }
}

// Start the session

session_start();


//Set session variables
if (isset($_SESSION["id"])) {
    //echo "Session variables are set.";
} else {

    $_SESSION["id"] = "";
    $_SESSION["first_name"] = "";
    $_SESSION["last_name"] = "";
    $_SESSION["city"] = "";
    $_SESSION["street"] = "";
    $_SESSION["address_no"] = "";
    $_SESSION["phone"] = "";
    $_SESSION["email"] = "";
    $_SESSION["password"] = "";
    $_SESSION["admin"] = "";
    $_SESSION["bill_count"] = "";
    //echo "Session variables are not set.";
}
if (isset($_SESSION["cart"])) {
    //echo "Session variables are set.";
} else {
    $_SESSION["cart"] = array();
    $_SESSION["cartTotal"] = 0;
    $_SESSION["cartQuantity"] = 0;
    //echo "Session variables are not set.";
}
