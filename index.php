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
    <link rel="stylesheet" href="./src/Css/index.css">
</head>

<body>
    <div class="mainContainer">
  

    

        <div class="hero">



            <div class="tray" id="tray">
                <div class="fog" id="fog"></div>
                <div class="fog2" id="fog"></div>
                <div class="fog3" id="fog"></div>
                <div class="handle" id="handle"></div>
                <div class="cup" id="cup">
                    <div class="shape100" id="liq">


                        <div class="cream" id="cream">
                            <p id="rcount"></p>
                        </div>

                    </div>
                </div>
            </div>
            <h2 class="greeting">Welcome to Lattelane !<?php
                                            if ($_SESSION["first_name"] != "") {
                                                echo (" " . $_SESSION["first_name"] . "...");
                                            } ?></h2>
                   <button class='signBtn' onclick='window.location.href=`userLogin.php`'>Sign In</button>          
        </div>
        <?php
        include 'tempnav.php';
        include 'productContainer.php';
        include 'mobileNav.php';
        include 'footer.php';
        ?>
    </div>

</body>

</html>