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
    <link rel="stylesheet" href="src/css/admin.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>
    <div class="mainContainer">
        <?php
        include 'tempnav.php';
        include 'mobileNav.php';
        adminPanel();
        // if (isset($_COOKIE['screenWidth']) && $_COOKIE['screenWidth'] < 768){
            
        // }else{
        //     include 'dashboard.php';
        // }
        

        ?>
        <div class="salesChartContainer">
            <canvas id="salesChart"></canvas>
        </div>
    </div>

    <div>
    </div>

</body>

</html>
<?php
include 'chart.php';
?>