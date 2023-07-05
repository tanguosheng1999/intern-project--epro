<?php
if (isset($_POST['submit'])) {
    include_once("dbconnect.php");
    $name = addslashes($_POST["name"]);
    $handphone = $_POST["handphone"];
    $email = $_POST["email"];
    $epro = $_POST["epro"];
    $datetime = $_POST["datetime"];
    $service = $_POST["service"];
    $remarks = $_POST["remarks"];
    $verify = "Pending";
    $sqlinsert = "INSERT INTO `tbl_books`(`book_name`, `book_handphone`, `book_email`, `book_epro`, `book_datetime`, `book_service`, `book_remarks`, `book_verify`) VALUES ('$name', '$handphone', '$email', '$epro', '$datetime', '$service', '$remarks', '$verify')";
    
    try {
        $conn->exec($sqlinsert);
        echo "<script>alert('Registration successful')</script>";
        echo "<script>window.location.replace('bookcust.php')</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Registration failed')</script>";
        echo "<script>window.location.replace('bookcust.php')</script>";
    }
}
?>

<!DOCTYPE html>
<html>
  <title>EPRO ESYSTEM</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <script src="../js/script.js"></script>
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
         <a href="bookcust.php" class="w3-round-large w3-right w3-padding-16 w3-bar-item w3-button w3-hover-none w3-hover-text-blue">Booking Listing</a>
        <div class="w3-center w3-padding-16">Epro Esystem</div>
      </div>
    </div>
    <div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:100px">
      <form class="w3-container" action="book.php" method="post" enctype="multipart/form-data" onsubmit="return confirmDialog()">
        <div class="w3-container w3-blue">
          <h2>Booking Form</h2>
        </div>
        <br>
        <label>Name</label>
        <input class="w3-input" name="name" id="idname" type="text" required>
        <label>No.Handphone</label>
        <input class="w3-input" name="handphone" id="idhandphone" type="text" required>
        <label>Email</label>
        <input class="w3-input" name="email" id="idemail" type="text" required>
        <label>Epro.ID</label>
        <input class="w3-input" name="epro" id="idepro" type="number" required>
        <p>
          <label for="Schdule time">date and time:</label>
          <input type="datetime-local" id="datetime" name="datetime">
        </p>
        <p>
          <select class="w3-select" name="service" id="idservice" required>
            <option value="" disabled selected>Choose Service</option>
            <option value="Claim epro">Claim epro</option>
            <option value="Apply installment">Apply installment</option>
            <option value="Repair phone">Repair phone</option>
            <option value="Others">Others</option>
          </select>
        </p>
        <p>
          <label>Remarks</label>
          <textarea class="w3-input w3-border" id="idremarks" name="remarks" rows="4" cols="50" width="100%" placeholder="Remarks"></textarea>
        </p>
        <div class="w3-row">
          <input class="w3-input w3-border w3-block w3-blue w3-round" type="submit" name="submit" value="Submit">
        </div>
      </form>
    </div>
    <footer class="w3-row-padding w3-padding-32">
      <hr>
      </hr>
      <p class="w3-center">EPRO ETRACKER&reg;</p>
    </footer>
  </body>
</html>