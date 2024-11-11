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
    echo "<script>
        if(confirm('⚠️Are you sure you want to ❌clear your 🛒cart?')) {
            window.location.href = 'userUpdate.php?clearCart=1';
        } else {
            window.location.href = 'cart.php';
        }
    </script>";
    exit();
}

if (isset($_GET['clearCart']) && $_GET['clearCart'] == 1) {
    clearCart();
    header("Location: cart.php");
    exit();
}
if (isset($_POST['removeFromCart'])) {
    $productId = $_POST['removeItemId'];
    removeFromCart($productId);
    header("Location: cart.php");
}
if (isset($_POST['submitInvoice'])) {
    if (isset($_SESSION["cartQuantity"]) && $_SESSION["cartQuantity"] > 0 && ($_SESSION["id"] != "")) {
        checkout($conn);
        echo "<script> alert('Order Placed successfully!')</script>";

        header("Refresh: 0; URL=cart.php");
    } else {
        if (($_SESSION["id"] == "")) {
            echo "<script> alert('please Login to Place Order')</script>";

            header("Refresh: 0; URL=userLogin.php");
        } else {
            echo "<Script>alert('Please add items to cart!')</Script>";
            header("Refresh: 0; URL=cart.php");
        }
    }
}



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['status'])) {
    $status = $_POST['status'];
    $userId = $_POST['userId'];

    $sql = "UPDATE users SET admin = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $status, $userId);

    if ($stmt->execute()) {
        echo "Admin status updated successfully";
    } else {
        echo "Error updating admin status";
    }

    $stmt->close();
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $userId = $_POST['userId'];

    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    if ($stmt->execute()) {
        echo "Admin status updated successfully";
    } else {
        echo "Error updating admin status";
    }

    $stmt->close();
}
