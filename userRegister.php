<?php require_once 'dataBase.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="src/Css/userForm.css">
</head>

<body>
    <div class="mainContainer">
        <?php include 'tempnav.php'; ?>
        <div class="subContainer">
            <div class="userFormContainer">
                <form action="userRegister.php" class="userForm" id="userForm" method="post" enctype="multipart/form-data">
                    <section class="userFormSection1" id="userFormSection1">
                        <h1 class="signupHead">Sign Up</h1><br><br>
                        <label for="">Name</label><br>
                        <input type="text" name="first_name" placeholder="  First Name" required><br>
                        <label for=""></label>
                        <input type="text" name="last_name" placeholder="  Last Name" required><br>
                        <label for="">Address</label><br>
                        <input type="text" name="address_no" id="" placeholder="  No" required><br>
                        <input type="text" name="street" id="" placeholder="  Street" required><br>
                        <input type="text" name="city" id="" placeholder="  City" required><br>
                        <div id="nextBtn">Next</div>
                    </section>
                    <section class="hide" id="userFormSection2">
                        <h1 class="signupHead">Sign Up</h1><br><br>
                        <label for="">Contact Details</label><br>
                        <input type="text" name="phone" id="" placeholder="  Phone">
                        <label for=""></label><br>
                        <input type="text" name="email" placeholder="  Email" required><br>
                        <label for="">Password</label><br>
                        <input type="password" name="password" placeholder="  Password" required minlength="8"><br><br>
                        <div class="navBtnContainer">
                            <div id="backBtn">Back</div>
                            <button class="submitbtn"> Sign Up</button>
                        </div>
                    </section>
                    <p class="signin">Already Have an Account? <a href="userLogin.php" id="signinLink">Sign In</a></p>
                </form>


            </div>
        </div>
    </div>

    <?php include 'mobileNav.php'; ?>

</body>
<script>
    const backBtn = document.getElementById("backBtn");
    const nextBtn = document.getElementById("nextBtn");
    const secton1 = document.getElementById("userFormSection1");
    const secton2 = document.getElementById("userFormSection2");

    nextBtn.addEventListener("click", function() {

        secton1.classList.remove("userFormSection1");
        secton1.classList.add("hide");

        secton2.classList.remove("hide");
        secton2.classList.add("userFormSection2");
    });
    backBtn.addEventListener("click", function() {
        secton1.classList.remove("hide");
        secton1.classList.add("userFormSection2");
        secton2.classList.remove("userFormSection2");
        secton2.classList.add("hide");
    });
</script>

</html>


<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $address_no = $_POST["address_no"];
    $street = $_POST["street"];
    $city = $_POST["city"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    //user existing verification
    $sql_check = "SELECT * FROM Users WHERE email = '$email'";
    $result = $conn->query($sql_check);
    if ($result->num_rows > 0) {
        echo '<script>alert("User already exists. Please log in.")</script>';
        echo "User already exists. Please log in.";
        echo '<script> function loginlink(){window.location.href = "userLogin.php";};</script>
        <button onclick="loginlink()">Log in</button>';
    } else {
        $sql = "INSERT INTO Users (first_name, last_name, address_no, street, city, phone, email, password) 
                VALUES ('$first_name', '$last_name', '$address_no', '$street', '$city', '$phone', '$email', '$password')";
        if ($conn->query($sql) === True) {
            echo "Data added successfully.<br>";

            // set session variables to new user
            $_SESSION["email"] = $email;
            $_SESSION["password"] = $password;
            $sql_check = "SELECT * FROM Users WHERE email = '$email'";
            $result = $conn->query($sql_check);
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $_SESSION["admin"] = $row["admin"];
            } else {
            }

            echo '<script> 
            function loginlink(){window.location.href = "userLogin.php";};
            loginlink();
            </script>';
        } else {
            echo "Error Please try again.<br>";
        }
    }
}

$conn->close();
