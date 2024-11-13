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
        <div class="floatingDiv">
            

            <?php
            if (($_SESSION["id"])=='') {
                echo "<button class='signBtn' onclick='window.location.href=`userLogin.php`'>SignIn <i class='fa-solid fa-right-to-bracket'></i></button>" ;
            }else{
                echo "<button class='signBtn' onclick='window.location.href=`cafeWall.php`'>CafeWall <i class='fa-solid fa-share-nodes'></i></button>" ;
            }

            ?>
        </div>

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
            <h2 class="greeting">Welcome !<?php
                                            if ($_SESSION["first_name"] != "") {
                                                echo (" " . $_SESSION["first_name"] . "...");
                                            } ?></h2>
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