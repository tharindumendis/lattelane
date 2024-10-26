<?php
require_once 'dataBase.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
        }

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
            background-color: #0001;
            flex-direction: row;
            justify-content: space-evenly;
            width: 280px;
            align-items: center;
            border-radius: 10px;
            padding: 10px;
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
            position: flex;
            font-size: 50;
            margin-top: 10px;
            color: red;
            scale: 2;
            transition: 0.5s;
        }

        #likeContainer div i:hover {
            filter: drop-shadow(0 0px 1px red);
            scale: 2.5;
        }

        #likeContainer div i:active {
            filter: drop-shadow(0 0px 1px red);
            scale: 1.5;
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
        }

        #createPostForm textarea {
            width: 100%;
            height: 100px;
            resize: none;
            border-radius: 10px;
            padding: 10px;
        }

        .likeBtn {
            display: flex;
            justify-content: center;
            align-content: center;
            align-items: center;
            width: 35px;
            height: 35px;
            padding-bottom: 5px;
            border-radius: 50%;
            border-color: #fff1;
            background-color: #0000;
        }

        .likeBtn:active {
            scale: 1.5;


        }
        .fa-solid fa-heart{
            transition: 3s;
            color: blue;
        }


        @media screen and (max-width: 768px) {
            body {
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            #createPost {
                display: flex;
                padding: 20px;
                width: 100%;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                gap: 10px;
            }

            #createPostForm {
                position: relative;
            }

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
                <h3>Tharindu Mendisbtn</h3>
            </div>
            <div id="contentContainer">
                <p>this the post content Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque, consectetur!</p>
            </div>
            <div id="imageContainer"><img src="./uploads/samplepic.jpg" alt="" id="blogImage"></div>
            <div id="likeContainer">
                <p>Like : </p>
                <input type='number' id="likeCountz" value="10" readonly>
                <div><button id="likeBtnz" class="likeBtn"><i class="fa-regular fa-heart" id="likeiconZ"></i></button></div>
            </div>
        </div>
        <script>
            const likeBtnz = document.getElementById('likeBtnz');
            const likeCountz = document.getElementById('likeCountz');
            let likeCountValuez = document.getElementById('likeCountz').value;
            const likeiconZ = document.getElementById('likeiconZ');
            let likedz = false;

            likeBtnz.addEventListener('click', () => {

                if (likedz) {
                    likeBtnz.classList.remove('liked');
                    likeiconZ.classList.remove('fa-solid fa-heart');
                    likeiconZ.classList.add('fa-regular fa-heart');
                    likedz = false;
                    likeCountz.value = likeCountValuez++;
                    alert('unliked');
                } else {
                    likeBtnz.classList.add('liked');
                    likeiconZ.classList.add('fa-solid fa-heart');
                    likeiconZ.classList.remove('fa-regular fa-heart');
                    likedz = true;
                    likeCountz.value = likeCountValuez--;
                    alert('liked');
                }
            })
        </script>
        <div id="blog">
            <div id="nameContainer">
                <h3>Tharindu Mendisbtn</h3>
            </div>
            <div id="contentContainer">
                <p>this the post content Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque, consectetur!</p>
            </div>
            <div id="imageContainer"><img src="./uploads/samplepic.jpg" alt="" id="blogImage"></div>
            <div id="likeContainer">
                <p>Like : </p>
                <p id="likeCount">8</p>
                <div><button id="likeBtn" class="likeBtn" onclick="handleLike(2,'like')"><i class="fa-regular fa-heart"></i></button></div>
            </div>
        </div>
        <script>
            const likeBtn = document.getElementById('likeBtn');
            const likeCount = document.getElementById('likeCount');
            let liked = false;
            likeBtn.addEventListener('click', () => {

                if (liked) {
                    likeBtn.classList.remove('liked');
                    likeBtn.innerHTML = '<i class=`fa-regular fa-heart`></i>';
                    liked = false;
                    likeCount.innerHTML = parseInt(likeCount.innerHTML) - 1;
                    likeBtn.setAttribute('onclick', 'nolike');



                } else {
                    likeBtn.classList.add('liked');
                    likeBtn.innerHTML = "<i class='fa-solid fa-heart'></i>";
                    liked = true;
                    likeCount.innerHTML = parseInt(likeCount.innerHTML) + 1;
                    likeBtn.setAttribute('action', 'like');
                }
            })
        </script>
        <?php
        //fetch blog in db
        $fetchQuery = "SELECT * FROM blogs ;";

        $result = $conn->query($fetchQuery);

        if ($result->num_rows > 0) {
            // OUTPUT DATA OF EACH ROW 
            while ($row = $result->fetch_assoc()) {


                echo " <div id='blog'>
                <div id='nameContainer'>
                    <h3>{$row['user_first_name']} {$row['user_last_name']}</h3>
                </div>
                <div id='contentContainer'>
                    <p>{$row['content']}</p>
                </div>
                <div id='imageContainer'><img src='{$row['image_url']}'  id='blogImage'></div>
                <div id='likeContainer' class='likeContainer'>
                    <p>Like : </p><p id='likeCount{$row['blog_id']}'>{$row['likes']}</p> 
                    <div><button id='likeBtn{$row['blog_id']}'  class='likeBtn'  name='likebtn'><i class='fa-regular fa-heart' id='likeicon{$row['blog_id']}'></i></button></div>
                </div>
                </div>
                
                <script>
            const likeBtn{$row['blog_id']} = document.getElementById('likeBtn{$row['blog_id']}');
            const likeCount{$row['blog_id']} = document.getElementById('likeCount{$row['blog_id']}');
            const likeicon{$row['blog_id']} = document.getElementById('likeicon{$row['blog_id']}');
            let liked{$row['blog_id']} = false;
            likeBtn{$row['blog_id']}.addEventListener('click', () => {

                if (liked{$row['blog_id']}) {
                    likeBtn{$row['blog_id']}.innerHTML = `<i class='fa-regular fa-heart'></i>`
                    liked{$row['blog_id']} = false;
                    likeCount{$row['blog_id']}.innerHTML = parseInt(likeCount{$row['blog_id']}.innerHTML) - 1;


                    $.ajax({
                        url: 'add_to_cart.php',
                        method: 'POST',
                        data: {
                            blogid: {$row['blog_id']},
                            action: 'nolike'
                        },
                        success: function(response) {
                            console.log('Like processed:', response);
                        }
                    });


                } else {
                    likeBtn{$row['blog_id']}.innerHTML = `<i class='fa-solid fa-heart'></i>`
                    liked{$row['blog_id']} = true;
                    likeCount{$row['blog_id']}.innerHTML = parseInt(likeCount{$row['blog_id']}.innerHTML) + 1;


                    $.ajax({
                        url: 'add_to_cart.php',
                        method: 'POST',
                        data: {
                            blog_id: {$row['blog_id']},
                            action: 'like'
                        },
                        success: function(response) {
                            console.log('Like processed:', response);
                        }
                    });

                }
            })
        </script>";
            }
        }
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

    function handleLike000(blogId, action) {

        alert('Like button clicked for blog ID: ' + blogId);

        $.ajax({
            url: 'add_to_cart.php',
            method: 'POST',
            data: {
                blogid: blogId,
                action: action
            },
            success: function(response) {
                console.log('Like processed:', response);
            }
        });
    }
</script>

<script src="src/js/postScript.js"></script>

</html>
<?php

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
            user_id,
            user_first_name,
            user_last_name,
            image_url,
            content)
            VALUES($user_id, '$firstName', '$lastName','$targetFile','$content');";

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