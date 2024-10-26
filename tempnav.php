<style>
    .navContainer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #00000044;
        padding: 10px;
        width: 80%;
        margin-left: 8%;
        border-radius: 0 0 20px 20px;
        height: 70px;
        position: fixed;
        top: 0;
        z-index: 1000;

    }

    .logoContainer {
        height: 60px;
        width: 60px;
        background-color: #00000044;
        border-radius: 100%;
        background-image: url("src/images/navLogo.png");
        background-size: cover;
        background-position: center;
    }

    .logologo {
        font-weight: bold;
        color: #00000044;
    }

    .navRight {
        display: flex;
        gap: 10px;
    }

    .navRight a {
        text-decoration: none;
        color: #000000;
        font-weight: bold;
        font-size: 15px;
        background-color: #ffffffaa;
        padding: 0px 10px 0px 10px;
        border-radius: 10px;
    }

    .navRight a:hover {
        color: #000000;
    }

    .marginBar {
        width: 100%;
        height: 60px;
    }


    @media screen and (max-width: 768px) {
        .navContainer {
            display: none;
        }

    }
</style>

<nav class="navContainer">
    <div class="navLeft">
        <div class="logoContainer">`</div>
        <div class="logologo"></div>
    </div>

    <div class="navRight">
        <a href="userRegister.php">Sign Up</a>
        <a href="userLogin.php">Sign In</a>
        <a href="userLogout.php">Sign Out</a>
        <a href="userProfile.php">Profile</a>
        <a href="cafeWall.php">CafeWall</a>
        <a href="index.php">Home</a>
        <a href="addProductForm.php">Add Product</a>
        <a href="productContainer.php">Shop</a>
        <a href="cart.php">Cart</a>
        <a href="dashbord.php">Dashbord</a>

    </div>

</nav>
<div class="marginBar">


</div>