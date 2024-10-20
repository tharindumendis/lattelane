<?php
require_once 'dataBase.php';

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

        <form action="userLogin.php" method="post">
            <h1>Log in</h1>
            <label for="email">Email</label>
            <input type="text" name="email" placeholder="email" required>
            <label for="password">Password</label>
            <div class="passwordContainer"><input type="password" name="password" placeholder="password" required>
                <i class='bx bxs-lock-alt' id="lockIcon"></i>
            </div>
            <button>Log in</button>
            <p>Don't have an account? <a href="userRegister.php">Sign up</a></p>

        </form>
    </div>

</body>
<script>
    console.log("hello");
    const passwordInput = document.getElementsByName("password");
    const lockIcon = document.getElementById("lockIcon");
    let showPassword = false;
    lockIcon.addEventListener("click", () => {
        if (showPassword) {
            passwordInput[0].type = "password";
            lockIcon.classList.remove("lockIconOpen");
            lockIcon.classList.add("lockIcon");
            showPassword = false;
        } else {
            passwordInput[0].type = "text";
            lockIcon.classList.remove("lockIcon");
            lockIcon.classList.add("lockIconOpen");
            showPassword = true;
        }
    });
</script>

</html>
<?php
require_once 'dataBase.php';
require_once 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    logIn($email, $password, $conn);
}

?>