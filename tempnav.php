<?php require_once 'dataBase.php'; ?>
<link rel="stylesheet" href="src/css/topNav.css">



<nav class="navContainer">
    <div class="navLeft">
        <div class="logoContainer"></div>
        <div class="logologo">
            <div class="logoText">LatteLane</div>
        </div>

    </div>

    <div class="navRight">
        <a class="navLink" href="index.php">Home</a>
        <a class="navLink" href="aboutUs.php">About Us</a>
        <a class="navLink" href="cafeWall.php">CafeWall</a>
        


        <?php if (($_SESSION["admin"]) == 1) {
            echo "<a class='navLink' href='dashboard.php'>Dashboard</a>";
        } else {
            
        }
        ?>
        <?php if (($_SESSION["id"]) == '') {
             echo "<a class='navLink' href='userLogin.php'><i class='fa-solid fa-user'></i></a>";
           
        } else {
            echo "<a class='navLink' href='userProfile.php'><i class='fa-solid fa-user'></i></a>";
        }
        ?>

         <?php if (($_SESSION["admin"]) != 1) {
            echo "<a class='navLink' href='cart.php'><i class='fa-solid fa-cart-shopping'></i></a>";
        } else {
           
        }
        ?>

    </div>

</nav>

<div class="marginBar">


</div>