<?php
require_once 'dataBase.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./src/Css/index.css">
</head>

<body>
    <div class="mainContainer">
        <?php include 'tempnav.php'; ?>

        <h2>Hello !😊<?php
                        if ($_SESSION["first_name"] != "") {
                            echo ($_SESSION["first_name"] . "...");
                        }
                        ?></h2>



        <?php include 'productContainer.php'; ?>

        <?php include 'mobileNav.html'; ?>

    </div>

</body>

</html>