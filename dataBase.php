<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lattelane";

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
$sql = "CREATE TABLE `category` (
  `cat_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  `cat_description` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) NOT NULL,
  PRIMARY KEY (`cat_id`)
);
";

if ($conn->query($sql) === TRUE) {
    // "Table 'products' created successfully or already exists";
} else {
    //echo "Error creating table: " . $conn->error;
}



//CREATE TABLE `lattelane_db`.`invoices` (`invoice_id` INT NOT NULL AUTO_INCREMENT , `user_id` INT NOT NULL , `product_id` INT NOT NULL , `price` INT NOT NULL , `quantity` INT NOT NULL , `total` INT NOT NULL , PRIMARY KEY (`invoice_id`)) ENGINE = InnoDB;
$sqlInvoice = "CREATE TABLE `invoices` (
  `invoice_id` int NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `price` int NOT NULL,
  `quantity` int NOT NULL,
  `total` int NOT NULL,
  `user_Invoice_id` int NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `payment_method` varchar(20) NOT NULL DEFAULT 'visa/ master',
  PRIMARY KEY (`invoice_id`)
);";
if ($conn->query($sqlInvoice) === TRUE) {
    // "Table 'products' created successfully or already exists";
}


$sqlUser = "CREATE TABLE IF NOT EXISTS `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `address_no` varchar(50) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `admin` tinyint(1) DEFAULT '0',
  `bill_count` int NOT NULL DEFAULT '1',
  `image_path` varchar(255) NOT NULL DEFAULT './src/images/defaltUser.png',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
);
";

if ($conn->query($sqlUser) === TRUE) {
    // "Table 'products' created successfully or already exists";
}

$sqlProducts = "CREATE TABLE IF NOT EXISTS `products` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) NOT NULL,
  `description` text,
  `category` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `active` int NOT NULL DEFAULT '1',
  `discount` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
);
";
if ($conn->query($sqlProducts) === TRUE) {
    // "Table 'products' created successfully or already exists";
}
$sqlProducts = "CREATE TABLE IF NOT EXISTS `blogs` (
  `blog_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `user_first_name` varchar(100) DEFAULT NULL,
  `user_last_name` varchar(100) DEFAULT NULL,
  `image_url` varchar(255)NULL,
  `content` varchar(255) DEFAULT NULL,
  `likes` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`blog_id`)
) ;
";
if ($conn->query($sqlProducts) === TRUE) {
    // "Table 'products' created successfully or already exists";
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
if (!isset($_SESSION)) {
    session_start();
}

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
