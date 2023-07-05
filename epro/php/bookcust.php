<?php
include_once("dbconnect.php");
 if ($_GET['submit'] == "search")
    {
        $search = $_GET['search'];
        $sqlquery = "SELECT * FROM tbl_books WHERE book_name LIKE '%$search%'";
    }
else
{
    $sqlquery = "SELECT * FROM tbl_books ORDER BY book_datetime DESC";
}

// include_once ("dbconnect.php");
// $sqlquery = "SELECT * FROM tbl_books ORDER BY book_datetime DESC";
$stmt = $conn->prepare($sqlquery);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Epro Esystem</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="../js/script.js"></script>
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
    <style>
      table {
        border-collapse: collapse;
        width: 100%;
        color: #588c7e;
        font-family: monospace;
        font-size: 15px;
        text-align: left;
      }

      th {
        background-color: #4da2ef;
        color: white;
      }

      tr:nth-child(even) {
        background-color: #f2f2f2;
      }
    </style>
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
         <a href="book.php" class="w3-right w3-padding-16 w3-bar-item w3-button w3-hover-none w3-hover-text-blue">New Books</a>
        <div class="w3-center w3-padding-16">EPRO ESYSTEM</div>
      </div>
    </div>
    <!-- !PAGE CONTENT! -->
    <div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:100px">
        <div class="w3-container w3-card w3-padding w3-row w3-round" style="width:100%">
        <form class="w3-container" action="bookcust.php" method="get">
            <div class="w3-twothird"><input class="w3-input w3-border w3-round w3-center" placeholder = "Enter your search term here" type="text" name="search"></div>
            <div class="w3-third"><input class="w3-input w3-border w3-blue w3-round" type="submit" name="submit" value="search"></div>
        </form>
    </div>
    <br>
         <div class="w3-container w3-card w3-row w3-round w3-center w3-blue" style="width:100%">
      <h1>Booking Listing</h1>
      </div>
      <br>
      <div class="w3-grid-template">
      <?php
         foreach ($rows as $books ){
                $bookid = $books['book_id'];
                $book_name = $books['book_name'];
                $book_handphone = $books['book_handphone'];
                $book_email = $books['book_email'];
                $book_epro = $books['book_epro'];
                $book_datetime = date_format(date_create($books['book_datetime']), 'd/m/y h:i A');
                $book_service = $books['book_service'];
                $book_remarks = $books['book_remarks'];
                $book_verify = $books['book_verify'];
                
                 echo "<div class='w3-center w3-padding-small'><div class = 'w3-card w3-round-large'>
                <div class='w3-padding-small'></div>
                <b>Name: $book_name</b><br>No.phone: $book_handphone<br>Email: $book_email<br>Epro ID: $book_epro<br>Date and Time: $book_datetime<br>Service: $book_service<br>Remarks: $book_remarks<br><br>
                <b>Status: $book_verify</b>
                <br><br>
                </div></div>";
            }
        ?>
    </div>
    <!-- Footer -->
    <footer class="w3-row-padding w3-padding-32">
      <hr>
      </hr>
      <p class="w3-center">Epro Tracker&reg;</p>
    </footer>
  </body>
</html>