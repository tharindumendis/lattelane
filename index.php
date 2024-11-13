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
            if (($_SESSION['id']) == '') {
                echo "<h2>SignUp</h2>";
                //Display loging message
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"]) && isset($_POST["password"])) {
                    $email = $_POST["email"];
                    $password = $_POST["password"];
                    logIn($email, $password, $conn);
                }
                echo "
                <div class='formContainer'>
                <form action='index.php' method='post'>
                    <h1>Log in</h1>
                    <label for='email'>Email</label>
                    <input type='email' name='email' placeholder='email' required>
                    <label for='password'>Password</label>
                    <div class='passwordContainer'><input type='password' name='password' placeholder='password' required>
                        <i class='bx bxs-lock-alt' id='lockIcon'></i>
                    </div>
                    <button name-'login' value='1' >Log in</button>
                    <p>Need an account? <a href='userRegister.php' id='signupLink'>Signup</a></p>

                </form>
            </div>
                  
                ";
            } else {
                echo "<h2>CaféWall</h2>";
                echo "<div id='cafeWall'>";
                fetchBlogs($conn);
                echo "</div>";
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
            <h2 class="greeting">Welcome to Lattelane !<?php
                                            if ($_SESSION["first_name"] != "") {
                                                echo (" " . $_SESSION["first_name"] . "...");
                                            } ?></h2>
        </div>
        <?php
        include 'tempnav.php';
        include 'productContainer.php';
        include 'mobileNav.php';
        ?>
    </div>

</body>

</html>
<script>
    const tray = document.getElementById("tray");
    const fog = document.getElementById("fog");
    const fog2 = document.getElementById("fog2");
    const tfog3 = document.getElementById("fog3");
    const handle = document.getElementById("handle");
    const cup = document.getElementById("cup");
    const liq = document.getElementById("liq");
    const cream = document.getElementById("cream");
    const rcount = document.getElementById("rcount");
    let setclick = 0;
    let rotate = 10;



    tray.addEventListener("click", function() {

        rotate += 10;
        let insertvalue = rotate + "deg"
        console.log(rotate);
        console.log(insertvalue);
        if (setclick == false) {
            handle.style.backgroundColor = "#888";
            cup.style.backgroundColor = "#888";
            liq.style.background = "linear-gradient(10deg, hsl(27, 100%, 26%) 0%, rgb(42, 17, 0) 100%)";
            cream.style.rotate = insertvalue;
            rcount.innerText = "👆 ▶️ " + rotate + "°";
            setclick = true;
        } else if (setclick == 1) {
            handle.style.backgroundColor = "white";
            cup.style.backgroundColor = "white";
            liq.style.background = "linear-gradient(10deg, hsl(27, 100%, 40%) 0%, rgb(130, 58, 0) 100%)";
            setclick = false;
            cream.style.rotate = "0deg";
            rcount.innerText = "";
        }
        console.log(setclick);
    });
    let setrotate = 0;
    cream.addEventListener("click", function() {
        if (setrotate == 0) {
            cream.style.transform = "rotate(180deg)";
            setrotate = 1;
        } else if (setrotate == 1) {
            cream.style.transform = "rotate(0deg)";
            setrotate = 0;
        }
        console.log(setrotate);
    });
    const hide = document.querySelector(".hide");
    const hideBtn = document.querySelector(".hideBtn");
    const form = document.querySelector(".form");
    const likeBtn = document.querySelector('.likeBtn');

    likeBtn.addEventListener("click", function() {
            console.log("clicked");

            window.location.href = "cafeWall.php";

        }

    );
</script>