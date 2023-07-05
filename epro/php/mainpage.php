<!DOCTYPE html>
<html>
  <head>
    <title>Epro Esystem</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../js/script.js"></script>
  </head>
  <body>
    <!-- Sidebar (hidden by default) -->
     <nav class="w3-sidebar w3-bar-block w3-card w3-top w3-xlarge w3-animate-left" style="display:none;z-index:2;width:20%;min-width:200px" id="mySidebar">
        <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button">Close Menu</a>
        <a href="login.php" onclick="w3_close()" class="w3-bar-item w3-button">Login</a>
        <a href="register.php" onclick="w3_close()" class="w3-bar-item w3-button">Register</a>
        <a href="track.php" onclick="w3_close()" class="w3-bar-item w3-button">Track</a>
        <a href="index.php" onclick="w3_close()" class="w3-bar-item w3-button">Extend</a>
        <a href="mycart.php" onclick="w3_close()" class="w3-bar-item w3-button">Carts</a>
        <a href="mypayment.php" onclick="w3_close()" class="w3-bar-item w3-button">Payment</a>
        <a href="bookcust.php" onclick="w3_close()" class="w3-bar-item w3-button">Booking</a>
        <a href="mainpage.php" onclick="w3_close()" class="w3-bar-item w3-button">Logout</a>
    </nav>
    <!-- Top menu -->
    <div class="w3-top">
      <div class="w3-white w3-xlarge" style="max-width:1200px;margin:auto">
        <div class="w3-button w3-padding-16 w3-left" onclick="w3_open()">☰</div>
        <a href="#about" class="w3-round-large w3-right w3-padding-16 w3-bar-item w3-button w3-hover-none w3-hover-text-blue">About</a>
    <div class="w3-dropdown-hover w3-right">
    <button class="w3-bar-item w3-button w3-hover-blue w3-padding-16 w3-hover-text-white">Login<i class="fa fa-caret-down"></i></button>
    <div class="w3-dropdown-content w3-bar-block w3-card-4">
      <a href="loginadmin.php" class="w3-bar-item w3-button w3-blue" style="font-size:15px;">Admin</a>
      <a href="login.php" class="w3-bar-item w3-button w3-blue" style="font-size:15px">User</a>
    </div>
  </div>
        <div class="w3-center w3-padding-16">EPRO ESYSTEM</div>
      </div>
    </div>
    <!-- !PAGE CONTENT! -->
    <div class="w3-main w3-content w3-padding" style="max-width:1200px">
        <img class=" w3-animate-zoom" src="../images/epro logo.png" alt="epro logo" style="max-width:1184px; high:100px">
        
        <!-- About Section -->
      <div class="w3-row w3-padding-64" style="max-width:1200px;margin:auto" id="about">
          <h1 class="w3-center"><b>About EPRO</b></h1>
        <div class="w3-container w3-half">
            <p class="w3-large w3-text-grey" style="text-align: justify;">Epro esystem is a card given by customers who have purchased a 1-year warranty from our company. If the customer has any damage, the customer must bring this card with them to claim it. Epro Warranty Wed-based System (E-TRACKER) is proposed to allow customer and organization to create, store, make payment and track their warranty in a website. The system will provide the facility that will enable the customer to make payment and track their warranty. This system is will also help organization to check the customer warranty. Hence, this system is beneficial to the organization to check the warranty customer and customer also can make payment and track their warranty through this web-based system.</p>
        </div>
        <div class="w3-container w3-half">
            <img src="../images/1 year warranty.webp" alt="Paris" width="700" height="460" class="w3-hover-opacity">
        </div>
      </div>
      
          <div class="w3-row-padding w3-padding-64 w3-center" style="margin:0 -16px">
          <div class="w3-container w3-third">
            <h2><img src="../images/extend warranty.png" alt="1 year warranty" width="400" height="400" class="w3-hover-opacity"></h2>
             <h2 style="font-size: 15px; font-weight:bold">Extend a Warranty</h2>
          </div>
          <div class="w3-container w3-third">
            <h2><img src="../images/tracking.png" alt="Paris" width="400" height="400" class="w3-hover-opacity"></h2>
             <h2 style="font-size: 15px; font-weight:bold">Tracking a Warranty</h2>
          </div>
          <div class="w3-container w3-third">
            <h2><img src="../images/book a service 1.png" alt="San Francisco" width="400" height="400" class="w3-hover-opacity"></h2>
             <h2 style="font-size: 15px; font-weight:bold">Book a Service</h2>
          </div>
        </div>
        
        <div id="About" class="About w3-container w3-text-black w3-center">
<h1 style="font-size:calc(20px + 2vw);">DEVELOPER OF EPRO ESYSTEM</h1>
<br>
<br>
<img class="p1" src="../images/me.jpeg" alt="Avatar" style="width:180px">
<p style="font-weight: bold;">Tan Guo Sheng</p>
<p>guosheng0000@gmail.com</p>
<p>Developer of Prepaid Technologies</p>
<p>Undergraduate Student in UUM</p>
<a href="https://github.com/tanguosheng1999" class="w3-button w3-hover-none w3-hover-border-black"><i class="fa fa-github w3-xxlarge"></i></a>
<a href="https://www.facebook.com/profile.php?id=100003840633146" class="w3-button w3-hover-none w3-hover-border-black"><i class="fa fa-facebook w3-xxlarge"></i></a>
<a href="https://www.instagram.com/tgs_0317/" class="w3-button w3-hover-none w3-hover-border-black"><i class="fa fa-instagram w3-xxlarge"></i></a>
</div>
        
    </div>
    <!-- Footer -->
    <footer class="w3-row-padding w3-padding-32">
      <hr>
      </hr>
      <p class="w3-center">Epro Esystem&reg;</p>
    </footer>
  </body>
</html>