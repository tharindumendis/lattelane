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
    <link rel="stylesheet" href="src/Css/productContainer.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

    <div class="topnav">
        <form action="index.php" method="POST" class="searchContainer">
            <input type="text" placeholder="Search.." name="search" value="" class="PSearch">
            <button type="submit" class="searchBtn"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
        </form>

    </div>
    <div class="categorySection">
        <h2>Our Menu</h2>
        <div class="categoryContainer" id="scrollingCategories">
            <?php
            $fetchQuery = "SELECT * FROM `category`;";
            $result = $conn->query($fetchQuery);
            if ($result->num_rows > 0) {
                // OUTPUT DATA OF EACH ROW
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <form action='index.php' method='POST'>
            
                    <button type='submit' class='catBtn' name='category' value='{$row['category_name']}'>

                    <div class='categoryCard'>
                            <img src='{$row['image_path']}' class='categoryImg'>
                            <h2>{$row['category_name']}</h2>
                           
                        </div>
                        </button>
                    </form>  
                        ";
                }
            }
            ?>

        </div>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['category'])) {
            $search = $_POST['category'];
            echo "<div>
                    <h2>
                        $search
                    </h2>
                </div>
                    
                ";
        } ?>

    </div>
    <div class="productCardContainer" id="productCardContainer">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
            if (($_POST['search']) != '') {
                $search = $_POST['search'];
                $fetchQuery = "SELECT * FROM `products` WHERE product_name LIKE '%{$search}%' AND active = 1;";
            } else {
                $fetchQuery = "SELECT * FROM `products`WHERE active = 1;";
            }
        } else {
            $fetchQuery = "SELECT * FROM `products` WHERE active = 1;";
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['category'])) {
            $search = $_POST['category'];
            $fetchQuery = "SELECT * FROM `products` WHERE category = '$search' AND active = 1;";
        }

        // FETCHING DATA FROM DATABASE
        DisplayProducts($fetchQuery, $conn);
        ?>
    </div>
    <?php include 'mobileNav.php'; ?>
</body>
<script src="./src/js/postScript.js"></script>
<script>
    let scrollDirection = 1;
    setInterval(function() {
        const container = document.getElementById('scrollingCategories');
        container.scrollLeft += scrollDirection;
        if (container.scrollLeft >= container.scrollWidth - container.clientWidth) {
            scrollDirection = -1;
        } else if (container.scrollLeft <= 0) {
            scrollDirection = 1;
        }
    }, 2000 / 60);
</script>

</html>