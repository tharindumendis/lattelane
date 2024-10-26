<?php
require_once 'dataBase.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #cafeWall {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 10px;
            width: 100vw;
            height: auto;
        }

        #blog {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 10px;
            width: 300px;
            height: auto;
            background-color: whitesmoke;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        #nameContainer {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            border-radius: 10px 10px 0px 0px;
            margin-top: 10px;
            padding-bottom: 5px;
            border-bottom: solid 1px black;
        }

        #imageContainer {
            display: flex;
            width: 280px;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
            overflow: hidden;
        }

        #blogImage {
            width: 100%;
            height: auto;
        }

        #likeContainer {
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            width: 100%;
            height: 30px;
            align-items: center;
            margin-bottom: 10px;
            border-radius: 10px;
        }

        #contentContainer {
            display: flex;
            justify-content: center;
            align-items: center;
            text-wrap: wrap;
            text-align: center;
            width: 100%;
            border-radius: 10px;
        }

        #contentContainer p {
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        #likeContainer div i {
            position: absolute;
            font-size: 50;
            margin-top: 10px;
            color: red;
            scale: 2;
            translate: -50%;
        }

        #likeContainer p {
            font-size: large;
        }

        #createPostForm {
            display: flex;
            position: fixed;
            padding: 20px;
            left: 0;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 10px;
            background-color: wheat;
        }

        #createPostForm textarea {
            width: 100%;
            height: 100px;
            resize: none;
            border-radius: 10px;
            padding: 10px;
        }
    </style>
</head>

<body>
    <?php include 'tempnav.php'; ?>
    <?php include 'mobileNav.html'; ?>
    <div id="createPost">
        <form action="cafeWall.php" method="post" enctype="multipart/form-data" id="createPostForm">
            <input type="file" name="postImage" id="postImage" accept="image/*" onchange="previewImage(this)">
            <img id="preview" style="max-width: 300px; display: none;">
            <textarea name="caption" id="caption"></textarea>
            <input type="submit" name="submit" value="Upload">
        </form>
    </div>



    <div id="cafeWall">
        <div id="blog">
            <div id="nameContainer">
                <h3>Tharindu Mendis</h3>
            </div>
            <div id="contentContainer">
                <p>this the post content Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque, consectetur!</p>
            </div>
            <div id="imageContainer"><img src="./uploads/samplepic.jpg" alt="" id="blogImage"></div>
            <div id="likeContainer">
                <p>Likes : 08</p>
                <div><i class="fa-regular fa-heart"></i></div>
            </div>
        </div>
        <div id="blog">
            <div id="nameContainer">
                <h3>Tharindu Mendis</h3>
            </div>
            <div id="contentContainer">
                <p>this the post content Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque, consectetur!</p>
            </div>
            <div id="imageContainer"><img src="./uploads/samplepic.jpg" alt="" id="blogImage"></div>
            <div id="likeContainer">
                <p>Likes : 08</p>
                <div><i class="fa-regular fa-heart"></i></div>
            </div>
        </div>

        <?php

        echo " <div id='blog'>
        <div id='nameContainer'>
            <h3>Tharindu Mendis</h3>
        </div>
        <div id='contentContainer'>
            <p>this the post content Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque, consectetur!</p>
        </div>
        <div id='imageContainer'><img src='./uploads/samplepic.jpg'  id='blogImage'></div>
        <div id='likeContainer'>
            <p>Likes : 08</p>
            <div><i class='fa-regular fa-heart'></i></div>
        </div>
    </div>";
        ?>


    </div>
</body>
<script>
    function previewImage(input) {
        const preview = document.getElementById('preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

</html>
<?php
require_once 'dataBase.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_SESSION["first_name"];
    $lastName = $_SESSION["last_name"];
    $content = $_POST["caption"];
    $user_id = $_SESSION['id'];
    echo "<br>";
    print_r($_FILES);
    echo "<br>";
    print_r($_POST);
    echo "<br>";

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
    if (isset($_FILES["postImage"])) {
        $sql = "INSERT INTO blogs
            (
            blog_id,
            user_id,
            user_first_name,
            user_last_name,
            image_url,
            content,
            likes)
            VALUES(,$user_id, '$firstName', '$lastName','$targetFile','$content',);";

        echo "<br>.File added successfully.<br>";
    } else {
        echo "File did not add successfully.<br>";
        $sql = "INSERT INTO blogs ( user_id, user_first_name, user_first_name, content) 
        VALUES ($user_id,'$firstName', '$lastName', '$content')";
        echo "Query passed without files.<br>";
    }
    if ($conn->query($sql) === True) {
        echo "Data added successfully.<br>";
    } else {
        print_r($sql);
        echo "Data did not add successfully.<br>";
    }
}
$conn->close(); ?>