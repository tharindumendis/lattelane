<?php
require_once 'dataBase.php';
if (isset($_SESSION["id"])) {
    $_SESSION["id"]="";
    $_SESSION["first_name"]="";
    $_SESSION["last_name"]="";
    $_SESSION["city"]="";
    $_SESSION["street"]="";
    $_SESSION["address_no"]="";
    $_SESSION["phone"]=""  ;
    $_SESSION["email"]="";
    $_SESSION["password"]="";
    $_SESSION["admin"]="";
    $_SESSION["bill_count"]="";
    //echo "Session variables are set.";
} else {

    //echo "Session variables are not set.";
}
if (isset($_SESSION["cart"])) {
    $_SESSION["cart"] = array();
    $_SESSION["cartTotal"] = 0;
    $_SESSION["cartQuantity"] = 0;
    //echo "Session variables are set.";
} else {
    //echo "Session variables are not set.";
}
header('location:index.php');
require_once 'dataBase.php';
