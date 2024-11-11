<?php require_once 'dataBase.php'; ?>
<link rel="stylesheet" href="src/css/topNav.css">



<nav class="navContainer">
    <div class="navLeft">
        <div class="logoContainer"></div>
        <div class="logologo">
            <div class="logoText"></div>
        </div>

    </div>

    <div class="navRight">
        <a class="navLink" href="index.php">Home</a>
        <a class="navLink" href="cafeWall.php">Cafe Wall</a>
        <a class="navLink" href="userProfile.php"><i class="fa-solid fa-user"></i></a>
        <?php if (($_SESSION["admin"]) == 1) {
            echo "<a class='navLink' href='dashboard.php'>Dashboard</a>";
            

            } else {
            echo "<a class='navLink' href='cart.php'><i class='fa-solid fa-cart-shopping'></i></a>";
            }
            ?>

        
    </div>

</nav>

<div class="marginBar">


</div>