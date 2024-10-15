<?php
require_once 'dataBase.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST["product_name"];
    $description = $_POST["description"];
    $category = $_POST["category"];
    $price = $_POST["price"];
    $cost = $_POST["cost"];
    echo "<br>";
    print_r($_FILES);
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";

    // Handle file upload
    if (!empty($_FILES["productImage"])) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["productImage"]["name"]);
        move_uploaded_file($_FILES["productImage"]["tmp_name"], $targetFile);
    } else {
        echo "No file uploaded.<br>";
    }

    // Insert data into the database
    if (isset($_FILES["productImage"])) {
        echo "File added successfully.<br>";
        $sql = "INSERT INTO products (product_name, description, category, image_path, price, cost) 
        VALUES ('$productName', '$description', '$category', '$targetFile', $price, $cost)";
    } else {
        echo "File did not add successfully.<br>";
        $sql = "INSERT INTO products (product_name, description, category, price, cost) 
        VALUES ('$productName', '$description', '$category', $price, $cost)";
    }
    if ($conn->query($sql) === True) {
        echo "Data added successfully.<br>";
    } else {
        echo "Data did not add successfully.<br>";
    }
} else {
    echo "Invalid request method.<br>";
}

$conn->close();
?>