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
    <link rel="stylesheet" href="./src/css/userLogin.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


</head>

<body>
    <div>
        <?php include 'tempnav.php'; ?>
    </div>

    <div class="formContainer">
        <?php
        //Display loging message
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $password = $_POST["password"];
            logIn($email, $password, $conn);
        }
        ?>
        <form action="userLogin.php" method="post">
            <h1>Log in</h1>
            <label for="email">Email</label>
            <input type="text" name="email" placeholder="email" required>
            <label for="password">Password</label>
            <div class="passwordContainer"><input type="password" name="password" placeholder="password" required>
                <i class='bx bxs-lock-alt' id="lockIcon"></i>
            </div>
            <button>Log in</button>
            <p>Need an account? <a href="userRegister.php" id="signupLink">Sign up</a></p>

        </form>
    </div>
    <?php include 'mobileNav.html'; ?>
</body>

</html>

<script>
    function togglePasswordVisibility() {
        const lockIcon = document.getElementById('lockIcon');
        const passwordInput = document.querySelector('input[name="password"]');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            lockIcon.classList.remove('bx-lock-alt');
            lockIcon.classList.add('lockIconOpen');

        } else {
            passwordInput.type = 'password';
            lockIcon.classList.remove('lockIconOpen');
            lockIcon.classList.add('bx-lock-alt');
        }
    }
</script>