<style>
    @import url('https://fonts.googleapis.com/css2?family=Edu+AU+VIC+WA+NT+Pre:wght@400..700&display=swap');

footer{
    background-color: black;
}
.footerContainer{
    padding: 70px 30px 20px;

}
.socialIcons{
    display: flex;
    justify-content:center;
    
}
.socialIcons a{
    text-decoration: none;
    padding: 2px;
    background-color: rgb(2, 21, 38);
    margin:10px;
    border-radius: 50%;
}

.socialIcons a i{
    font-size: 2em;
    padding:6px;
    color: rgb(254, 254, 254);
    opacity:0.9;
}

/*Hover effects*/
.socialIcons a:hover{
    background-color: rgb(46, 46, 46);
    
    transition: 0.5s;
}

.socialIcons a:hover i{
    color: rgb(224, 224, 224);
    transition: 0.5s;
}
.footerNav{
    margin: 30px 0;
}

.footerNav ul{
    display: flex;
    justify-content: center;    
    list-style-type: none;
}
.footerNav ul li a{
    color:aliceblue;
    margin: 20px;
    text-decoration: none;
    font-size: 1.3em;
    opacity: 0.7;
    transition: 0.5s;
}

.footerNav ul li a:hover{
    opacity: 1;
}

.footerBottom{
    background-color:rgb(51, 51, 51);
    padding: 20px;
    text-align: center;
} 

.footerBottom P{
    color: aliceblue;
}

.designer{
    opacity: 0.7;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight:400;
    margin:0px 5px;
}
.brand{
    font-weight: 700;
    font-size: 1.5em;
    text-align: center;
    width: 100%;
    padding: 10px;
    color: rgb(255, 255, 255);
    font-family:  "Edu AU VIC WA NT Pre", cursive;
    letter-spacing: 1px;
    margin:0px 5px;
}

@media (max-width:700px){
    .footerNav ul{
        flex-direction: column;
    }
    .footerNav ul li{
        width:100%;
        text-align: center;
        margin:10px;
    }
}
</style>


<footer>
        <div class="footerNav">
            <h2 class="brand">LatteLane</h2>
            <div class="socialIcons">
                <a href="https://web.facebook.com/"><i class="fa-brands fa-facebook"></i></a>
                <a href="https://www.instagram.com/"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://www.x.com"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="https://www.whatsapp.com"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
            <div class="footerNav">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="aboutUs.php">About Us</a></li>
                    <li><a href="userLogin.php">SignIn</a></li>
                    <li><a href="cart.php">Cart</a></li>
                    <li><a href="cafeWall.php">CafeWall</a></li>
                </ul>
            </div>
       
        </div>
        <div class="footerBottom">
            <p>All Right Reserved.</p>
        </div>


    </footer>