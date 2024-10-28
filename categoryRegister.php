<?php
require_once 'dataBase.php';
?>


<link rel="stylesheet" href="src/css/categoryRegister.css">

<div class="catFormContainer">
    <form action="addProductForm.php" method="POST" class="categoryRegisterForm" enctype="multipart/form-data" id="categoryRegisterForm">
        <h2>Category Register Form</h2>
        <label for="">Category Name</label>
        <input type="text" name="categoryName" placeholder="Category Name" required>
        <label for="">Category Description</label>
        <textarea type="text" name="categoryDescription" placeholder="Category Description" required></textarea>
        <label for="">Category Image</label>
        <input type="file" name="categoryImage" id="categoryImage" placeholder="Category Image">
        <button type="submit" name="submit">Register new category</button>
    </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["categoryName"])) {
    //print_r($_POST);
    //echo "<br>";
    //print_r($_FILES);
    //echo "<br>";
    $categoryName = $_POST["categoryName"];
    $categoryDescription = $_POST["categoryDescription"];

    // Handle file upload
    if (isset($_FILES["categoryImage"])) {
        $targetDir = "uploads/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $fileName = $_FILES["categoryImage"]["name"];
        $targetFile = $targetDir . $fileName;
        if (move_uploaded_file($_FILES["categoryImage"]["tmp_name"], $targetFile)) {
            //echo "File uploaded successfully.<br>";
        } else {
            //echo "Failed to upload file.<br>";
        }
    }
    // Insert data into the database
    if ($targetFile != "uploads/") {
        $sql = "INSERT INTO category
            (
            category_name,
            cat_description,
            image_path)
            VALUES( '$categoryName', '$categoryDescription','$targetFile');";

        //echo "<br>.File added successfully.<br>";
    } else {
        //echo "File did not add successfully.<br>";
        $sql = "INSERT INTO category
            (
            category_name,
            cat_description,
            image_path)
            VALUES( '$categoryName', '$categoryDescription','/src/images/navLogo.png');";
        //echo "Query passed without files.<br>";
    }
    if ($conn->query($sql) === True) {
        echo "Data added successfully.<br>";
    } else {
        echo "Data did not add successfully.<br>";
    }
}
$conn->close(); ?>