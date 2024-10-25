<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="src/Css/userForm.css">
</head>

<body>
    <?php include 'tempnav.php'; ?>
    <div class="userFormContainer">
        <form action="userRegister.php" class="userForm" id="userForm" method="post" enctype="multipart/form-data">
            <h1>User Register Form</h1>
            <label for="">First Name</label>
            <input type="text" name="first_name" placeholder="First Name" required>
            <label for="">Last Name</label>
            <input type="text" name="last_name" placeholder="Last Name" required>
            <label for="">Address</label>
            <input type="text" name="address_no" id="" placeholder="No" required>
            <input type="text" name="street" id="" placeholder="Street" required>
            <input type="text" name="city" id="" placeholder="City" required>
            <label for="">Phone</label>
            <input type="text" name="phone" id="" placeholder="Phone">
            <label for="">Email</label>
            <input type="text" name="email" placeholder="Email" required>
            <label for="">Password</label>
            <input type="password" name="password" placeholder="Password" required>
            <button class="submitbtn"> Register new user</button>
        </form>
    </div>
</body>

</html>
<?php
require_once 'dataBase.php';

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

            header("Location: userLogin.php");
        } else {
            echo "Error Please try again.<br>";
        }
    }
}

$conn->close();
