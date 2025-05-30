<?php
require_once 'dataBase.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="src/css/addForm.css">
</head>

<body>
    <div class="mainContainer">
        <?php
        include 'tempnav.php';
        include 'mobileNav.php';
        adminPanel() ?>
        <div class="subContainer">

            <div class="formContainer">
                <form action="addProductForm.php" method="post" id="addProductForm" enctype="multipart/form-data">
                    <h2>Product Register Form</h2>
                    <label for="">Product Name</label>
                    <input type="text" name="product_name" placeholder="Product Name" require>
                    <label for="">Product Description</label>
                    <textarea type="text" name="description" placeholder="Product Description" id="description"></textarea>
                    <label for="">Product Category</label>
                    <select name="category" id="category">
                        <?php
                        $sql = "SELECT * FROM category";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row['category_name'] . '">' . $row['category_name'] . '</option>';
                            }
                        }
                        ?> </select><br>
                    <label for="">Product Price: Rs.</label>
                    <input type="text" name="price" placeholder="Product Price" require>
                    <label for="">Product Cost: Rs.</label>
                    <input type="text" name="cost" id="productCost" placeholder="Product Cost" require>
                    <label for="">Product Image </label>
                    <p>(Please upload 1 by 1 Image maximum 1.5mb )</p>
                    <input type="file" name="productImage" placeholder="Product Image" id="productimage">
                    <button class="submitbtn"> Register new product</button>
                </form>

            </div>
            <?php include 'categoryRegister.php'; ?>



        </div>
    </div>



</body>
<script src="./src/js/adminBtn.js"></script>

</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["product_name"])) {
    $productName = $_POST["product_name"];
    $description = $_POST["description"];
    $category = $_POST["category"];
    $price = $_POST["price"];
    $cost = $_POST["cost"];
    // echo "<br>";
    // print_r($_FILES);
    // echo "<br>";
    // echo "<br>";
    // echo "<br>";
    // echo "<br>";

    // Handle file upload
    if (isset($_FILES["productImage"])) {
        $targetDir = "uploads/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $fileName = $_FILES["productImage"]["name"];
        $targetFile = $targetDir . $fileName;
        if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $targetFile)) {
            //echo "File uploaded successfully.<br>";
        } else {
            //echo "Failed to upload file.<br>";
        }
    }
    // Insert data into the database
    if (isset($_FILES["productImage"])) {
        $sql = "INSERT INTO products (product_name, description, category, image_path, price, cost) 
        VALUES ('$productName', '$description', '$category', '$targetFile', $price , $cost)";
        //echo "File added successfully.<br>";
    } else {
        //echo "File did not add successfully.<br>";
        $sql = "INSERT INTO products (product_name, description, category, price, cost) 
        VALUES ('$productName', '$description', '$category', $price, $cost)";
        //echo "Query passed without files.<br>";
    }
    if ($conn->query($sql) === True) {
        echo "Data added successfully.<br>";
    } else {
        echo "Data did not add successfully.<br>";
    }
}

?>