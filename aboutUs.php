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
    <link rel="stylesheet" href="./src/Css/aboutUs.css">
</head>

<body>
    <div class="mainContainer">
    <section class="hero">
    <h1>Welcome to LatteLane Cafe!</h1>
    <p>Where every cup tells a story and every visit feels like home.</p>
</section>

<section class="about-section">
    <h2>Our Vision</h2>
    <p>To be a place where every sip sparks connection and every visit feels like home. At LatteLane Cafe, we envision a community brought together by the love of quality coffee, warm conversations, and a cozy atmosphere that nurtures creativity, comfort, and joy. We aim to inspire moments of relaxation and meaningful connection, one cup at a time.</p>
</section>

<img src="./src/images/visionimagewoman.jpg"  class="circular-image1">
<img src="./src/images/teacup.png"  class="circular-image2">

<section class="mission-section">
    <h2>Our Mission</h2>
    <p>At LatteLane Cafe, our mission is to create a thriving community centered around the love of coffee. We believe in the power of coffee to bring people together, inspire connections, and enrich lives.</p>
</section>

<section class="special">
<img src="./src/images/spillingDrink.png"  class="image3">
    <h2>Why are We so Special?</h2>
    <p>At LatteLane Cafe, our mission is to create a thriving community centered around the love of coffee. We believe in the power of coffee to bring people together, inspire connections, and enrich lives.</p>
    <button class='learnbtn' onclick='window.location.href=`index.php`'>Learn More</button> 
</section>


  

    




            
        <?php
        include 'tempnav.php';
       
        include 'mobileNav.php';
        include 'footer.php';
        ?>
    </div>

</body>

</html>