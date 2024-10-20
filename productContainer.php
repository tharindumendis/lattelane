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
    <?php include 'tempnav.php'; ?>
    <div class="topnav">
        <form action="" method="POST">
            <input type="text" placeholder="Search.." name="search" value="">
            <button type="submit">Search</button>
        </form>

    </div>
    <div class="productCardContainer" id="productCardContainer">

        <?php
        require_once 'dataBase.php';
        require_once 'functions.php';
        // SQL QUERY 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (($_POST['search']) != '') {
                $search = $_POST['search'];
                $fetchQuery = "SELECT * FROM `products` WHERE product_name LIKE '%{$search}%';";
            } else {
                $fetchQuery = "SELECT * FROM `products`;";
            }
        }else{
            $fetchQuery = "SELECT * FROM `products`;";
        }


        // FETCHING DATA FROM DATABASE
        DisplayProducts($fetchQuery, $conn);


        ?>
    </div>
</body>
</body>
</body>
<script src="./src/js/postScript.js"></script>

</html>

