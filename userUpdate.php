<?php
require_once 'dataBase.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    // Retrieve the updated profile details from the form
    $userId = $_SESSION['id'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $phone = $_POST['phone'];
    $addressNo = $_POST['address_no'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    // Update the user's profile details in the database
    $updateQuery = "UPDATE users SET city = '$addressNo', street = '$street', city = '$city', phone = '$phone', address_no = '$addressNo', first_name = '$firstName', last_name = '$lastName' WHERE id = '$userId';";

    if ($conn->query($updateQuery)) {
        echo "Profile updated successfully";
        $_SESSION['first_name'] = $firstName;
        $_SESSION['last_name'] = $lastName;
        $_SESSION['phone'] = $phone;
        $_SESSION['address_no'] = $addressNo;
        $_SESSION['street'] = $street;
        $_SESSION['city'] = $city;

        echo "<script>alert('Profile updated successfully'); </script>";
        header("Location: userProfile.php");
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}


require_once 'functions.php';

if (isset($_POST['crearCart'])) {
    clearCart();
    header("Location: cart.php");
}
if (isset($_POST['removeFromCart'])) {
    $productId = $_POST['removeItemId'];
    removeFromCart($productId);
    header("Location: cart.php");
}
if (isset($_POST['submitInvoice'])) {
    echo "Total items count: " . $_SESSION["cartQuantity"] . "<br>";
    if (isset($_SESSION["cartQuantity"]) && $_SESSION["cartQuantity"] > 0) {
        checkout($conn);
        echo "Invoice created successfully!";
        header("Location: cart.php");
    } else {
        if (($_SESSION["id"] == "")) {
            header("Location: cart.php");
            echo "Please log in to checkout!" . '<br>' . "<a href='./userLogin.php'><button>Login</button></a>";
        } else {
            echo "<Script>alerts('Please add items to cart!')</Script>" ;
            header("Location: cart.php");
        }
    }
}
