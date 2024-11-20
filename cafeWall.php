<?php
require_once 'dataBase.php';
require_once 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="src/css/cafeWall.css">
</head>

<body>
    <div class="mainContainer">
        <?php include 'tempnav.php'; ?>
        <?php include 'mobileNav.php'; ?>
        <div id="createPost">
            <form action="cafeWall.php" method="post" enctype="multipart/form-data" id="createPostForm">
                <input type="file" name="postImage" id="postImage" accept="image/*" onchange="previewImage(this)">
                <img id="preview" style="max-height: 230px; display: none;">
                <textarea name="caption" id="caption" placeholder="Once upon a time... Start your story here!"></textarea>
                <input type="submit" name="submit" value="Upload" id="uploadBtn">
            </form>
        </div>

        <div id="cafeWall">
            <?php
            fetchBlogs($conn);
            ?>
        </div>
    </div>



</body>
<script src="src/js/blogScript.js"></script>

</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_SESSION["first_name"];
    $lastName = $_SESSION["last_name"];
    $content = $_POST["caption"];
    $user_id = $_SESSION['id'];

    // Handle file upload
    if (isset($_FILES["postImage"])) {
        $targetDir = "uploads/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $fileName = $_FILES["postImage"]["name"];
        $targetFile = $targetDir . $fileName;
        if (move_uploaded_file($_FILES["postImage"]["tmp_name"], $targetFile)) {
            //echo "File uploaded successfully.<br>";
        } else {
            //echo "Failed to upload file.<br>";
        }
    }
    // Insert data into the database
    if ($targetFile != "uploads/") {
        $sql = "INSERT INTO blogs
            (
            user_id,
            user_first_name,
            user_last_name,
            image_url,
            content)
            VALUES($user_id, '$firstName', '$lastName','$targetFile','$content');";
    } else {
        //echo "File did not add successfully.<br>";
        $sql = "INSERT INTO blogs
            (
            user_id,
            user_first_name,
            user_last_name,
            image_url,
            content)
            VALUES($user_id, '$firstName', '$lastName','./src/images/defaltPost.png','$content');";
        // echo "Query passed without files.<br>";
    }

    if ($conn->query($sql) === True) {
        echo "<script>setTimeout(function() { alert('File added successfully.'); window.location.href = 'cafeWall.php'; }, 3000);</script>";
    } else {
        echo "<script>alert('Data did not add successfully.');</script>";
    }
}
?>