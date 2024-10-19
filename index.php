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
    <h1>index</h1>
    <?php
    print_r($_SESSION);
    ?>
</body>

</html>