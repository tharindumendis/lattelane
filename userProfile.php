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
    <link rel="stylesheet" href="./src/css/userProfile.css">
</head>

<body>
    <div class="mainContainer">
        <?php include 'tempnav.php'; ?>
        <?php include 'mobileNav.php'; ?>
        <div class="menu">
            <?php
            if ($_SESSION['admin'] == 1) {
            }
            ?>

        </div>

        <div class="subContainer" id="subContainer">
            <div class="profileContainer">
                <h2>Profile Details</h2>
                <div class="profilePicContainer">
                    <img src="./src/images/user.png" alt="" class="profilePic">
                    <div class="profileBtn">
                       
                       
                    </div>
                </div>
                <div class="profileDetailsContainer">
                    <form action="userUpdate.php" method="post">
                        <p>First name: <input class="editInputs" type="text" name="first_name" id="" value="<?php echo $_SESSION['first_name'] ?>"></p>
                        <p>Last name: <input class="editInputs" type="text" name="last_name" id="" value="<?php echo $_SESSION['last_name'] ?>"></p>
                        <p>Email: <?php echo $_SESSION['email']; ?></p>
                        <p>Phone: <input class="editInputs" type="text" name="phone" id="" value="<?php echo $_SESSION['phone']; ?>"></p>
                        <p>Address no: <input class="editInputs" type="text" name="address_no" id="" value="<?php echo $_SESSION['address_no']; ?>"></p>
                        <p>Street: <input class="editInputs" type="text" name="street" id="" value="<?php echo $_SESSION['street']; ?>"></p>
                        <p>City: <input class="editInputs" type="text" name="city" id="" value="<?php echo $_SESSION['city']; ?>"></p>
                        <div class="editBtnContainer"><button type="submit" id="editSubmit" name="update_profile" value="update_profile">Save Edits</button>
                        <button class="editSubmit" onclick="window.location.href='logout.php'">Log Out</button></div>                       
                    </form>
                </div>
            </div>
            <div class="order-container">
                <h2>My Orders</h2>
                <table class="order-table">
                    <thead>
                        <tr>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Status/ Payment Method</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($_SESSION["id"] != "") {
                            displayBills($conn);
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>


</body>
<?php
if ($_SESSION['id'] == '') {
    echo "
            <script>
            alert('Welcome to the Café Family! Log in ➡️ to dive into your profile and join the conversation on our lively Café Wall. Share your thoughts and connect with fellow coffee enthusiasts!❤️❤️❤️');
            window.location.href = 'UserLogin.php';
            </script>
            ";
}
?>

</html>