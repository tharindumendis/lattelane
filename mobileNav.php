<?php
require_once 'dataBase.php';
require_once 'functions.php';
?>

<style>
    * {
        margin: 0;
        padding: 0;
    }

    .mobileNav {
        display: none;
    }


    @media screen and (max-width: 768px) {


        .mobileNav {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            justify-content: space-evenly;
            align-items: center;
            width: 100vw;
            height: 80px;
            position: fixed;
            bottom: 0;
            top: auto;
            background-color: rgba(0, 0, 0, 0.885);
            z-index: 999;
        }


        .mobileNav a {
            cursor: pointer;
            text-decoration: none;
            color: white;
            font-size: 30px;
        }

        .navlist {
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
            width: 100%;

        }

        .navlist a {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            text-decoration: none;
            color: white;
            font-size: 24px;
            width: 60px;
            height: 60px;
        }

        .navlist a p {
            margin-top: 10px;
            font-size: 12px;
        }

    }
</style>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<div class="mobileNav">
    <nav class="navlist">
        <a href="index.php"><i class="fa-solid fa-house"></i>
            <p>Home</p>
        </a>
        <a href="cafeWall.php"><i class="fa-solid fa-message"></i>
            <p>CafeWall</p>
        </a>
        <?php

        if ($_SESSION['admin'] == 1) {
        }
        ?>
        <a href="userProfile.php"><i class="fa-solid fa-user"></i>
            <p>Profile</p>
        </a>
        <?php

        if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
            echo '<a href="dashboard.php"><i class="fa-solid fa-briefcase"></i><p>Dashbord</p></a>';
        } else {
            echo '<a href="cart.php"><i class="fa-solid fa-cart-shopping"></i><p>Cart</p></a>';
        }
        ?>


    </nav>
</div>