<?php
require_once 'dataBase.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include 'tempnav.php'; ?>

    <h1>Home</h1>

    <h1>Hello !😊
        <?php
        if ($_SESSION["first_name"] != "") {
            echo ($_SESSION["first_name"] . "...");
        }
        ?></h1>
    <?php include 'productContainer.php'; ?>

    <?php include 'mobileNav.html'; ?>
</body>

</html>