<?php
session_start();
$servername = "localhost:3307";
$username = "root";
$password = ""; // default password is empty
$dbname = "project"; // replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GROCERY DELIVERY</title>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="script.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
</head>
<body>
   <header>
    <div class="navbar">
        <div class="logo"> 
            <img src="logo.png" height="90px" width="90px">
        </div>
        <div class="nav-search">
            <div class="search-icon" >
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="search-input">
            <input placeholder=" ' search chips ' " id ="menu" style="width: 640px; height: 47px;">
            </div>
            </div>
      <div class="navhome">
        <a href="index.php"><h1> Home </h1></a>
      </div>
      <?php
        if(isset($_SESSION['username'])) {
          echo '<div class="navabout">
                <h1> ' . $_SESSION['username'] . ' </h1>
                </div>';
          echo '<div class="menu"></div>
                <div class="loginbutton">
                <a href="cart.php"><button i class="fa-solid fa-cart-shopping"></i> &nbsp My Cart </button></a>
                </div>';
          echo '<div class="menu"></div>
                <div class="loginbutton">
                <a href="logout.php"><button>&nbsp Logout </button></a>
                </div>';
        } else {
          echo '<div class="menu"></div>
                <div class="loginbutton">
                <a href="login.php"><button>&nbsp Login </button></a>
                </div>';
          echo '<div class="menu"></div>
                <div class="loginbutton">
                <a href="register.php"><button>&nbsp Register </button></a>
                </div>';
        }
      ?>
    </div>
    <section class="firstSection">
        <div class="leftSection">
          <img src="1.png" height="600px" width="600px">   
        </div>
        <div class="rightSection">
          Get your <span class="purple"> Needs </span>
          <div> Delivered at your doorstep ! </div>
          <span id="element"></span>
          <br><br>
          <a href="products.php?category=Medicines"> <button class="btn" style="cursor: pointer;"> Order Now</button></a>
        </div>
    </section>
   </header> 
   <main>
    <div class="categoryOne"><a href="products.php?category=Medicines">
      <div class="medi" style="cursor: pointer;"> medicines 
        <img src="2.png" height="150px" width="150px"> </a>
      </div> <a href="products.php?category=Snacks">
      <div class="snacks" style="cursor: pointer;"> Snacks & Munchies
        <img src="3.png" height="150px" width="150px"> </a>
      </div>
      </div>
      <div class="categoryTwo"><a href="products.php?category=Drinks">
      <div class="beverages" style="cursor: pointer;">Cold drinks & Juices
        <img src="4.png" height="150px" width="150px"></a>
        <a href="products.php?category=Stationery">
      </div>
      <div class="stationary" style="cursor: pointer;"> Stationery
        <img src="5.png" height="150px" width="150px"></a>
      </div>
    </div>
    <div class="copoun">
     <h1>FREE DELIVERY </h1>
    </div>    
    <div class="more-info">
      <div class="infoimg">
        <img src="pic1.png" height="350px" width="350px">
      </div>
      <div class="list">
        <ul>
          <a href="#"><li> HOME </li><br>
          <a href="#"><li> ORDER NOW </li><br>
          <a href="#"><li> OFFERS </li><br>
          <a href="#"><li> FAQS </li><br>
          <a href="#"><li> ABOUT US </li><br>
          <a href="#"><li> CONTACT US </li><br>
          </ul>        
      </div>
    </div>
    <div class="whatweprovide">
      <h1 style="font-size: 4rem;"> What We Provide </h1><br>
      <p> "Convenience at your doorstep! Our grocery delivery website brings fresh produce, pantry staples, <br>
        and household essentials right to your door with just a few clicks. Enjoy hassle-free shopping from the <br>
        comfort of your home, and let us take care of the rest!" </p>
       <div class="features">
        <div class="feature1">
          <h1>Wide Variety of Choices</h1>
          <p> Explore a diverse range of options, including organic, gluten-free, and specialty products, to 
            suit every dietary need and preference.</p>
        </div>
        <div class="feature2">
          <h1>Fast and Reliable Services</h1>
          <p>Our efficient delivery system ensures your medications reach you promptly, so you never have to worry about running out.</p>
        </div>
        <div class="feature3">
          <h1>Office and School Supplies</h1>
          <p> Find everything you need for work or study, from pens and paper to notebooks and binders, all in one place.</p>
        </div>
       </div>
    </div>
   </main>
   <footer>
    <div class="footerleft">
     <h1> Connect with Us </h1>
     <a href="#">mujgro@123.com</a><br>
     <i class="fa-brands fa-instagram"> <a href="#"> Instagram </a></i><br>
     <i class="fa-brands fa-facebook"> <a href="#"> Facebook </a></i>
    </div>
    <div class="footerright">
      <h1> Let Us Help You </h1>
     <p> mujgro1232gmail.com </p>+91 2345383007<br> Manipal University Jaipur, Rajasthan </p>
    </div>
    <div class="logo">
      <img src="logo.png" height="200px" width="200px">
    </div>
   </footer>
   <div class="copyright">
    <p> © Copyright, Made By Anshika Sethi & Parv Baweja</p>
  </div>
   <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
<script>
    var typed = new Typed('#element', {
      strings: ['Grocery', 'Medicines', 'Stationary'],
      typeSpeed: 40,
    });
  </script>
</body>
</html>
