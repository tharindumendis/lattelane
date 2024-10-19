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
    <div>
        <form action="userLogin.php" method="post">
            <label for="">Email</label>
            <input type="text" name="email" placeholder="Email" required>
            <label for="">Password</label>
            <input type="password" name="password" placeholder="Password" required>
            <button>Log in</button>
        </form>
    </div>

</body>

</html>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    //check if the user exists in the database
    $sql_check = "SELECT * FROM Users WHERE email = '$email'";
    $result = $conn->query($sql_check);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        //check if the password is correct
        if (password_verify($password, $row["password"])) {
            echo "Login successful!";

            //set session variables
            $_SESSION["first_name"] = $row["first_name"];
            $_SESSION["last_name"] = $row["last_name"];
            $_SESSION["address_no"] = $row["address_no"];
            $_SESSION["street"] = $row["street"];
            $_SESSION["city"] = $row["city"];
            $_SESSION["phone"] = $row["phone"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["password"] = $row["password"];
            $_SESSION["admin"] = $row["admin"];


            // echo "Login successful!";
            // echo $_SESSION["admin"] . "<br>";
            // echo $_SESSION["email"] . "<br>";
            // echo $_SESSION["password"] . "<br>";
            // echo $_SESSION["first_name"] . "<br>";
            // echo $_SESSION["last_name"] . "<br>";
            // echo $_SESSION["address_no"] . "<br>";
            // echo $_SESSION["street"] . "<br>";
            // echo $_SESSION["city"] . "<br>";
            // echo $_SESSION["phone"] . "<br>";
            // echo $_SESSION["email"] . "<br>";
            // echo $_SESSION["password"];

            //redirect to the user page
            header("Location: index.php");
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Login failed. Please check your email and password.";
    }
}

?>