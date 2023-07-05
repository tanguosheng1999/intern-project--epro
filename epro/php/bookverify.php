<?php
include_once ("dbconnect.php");
$sqlquery = "SELECT * FROM tbl_books";
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
        <a href="loginadmin.php" onclick="w3_close()" class="w3-bar-item w3-button">Login</a>
        <a href="registeradmin.php" onclick="w3_close()" class="w3-bar-item w3-button">Register</a>
        <a href="new_book.php" onclick="w3_close()" class="w3-bar-item w3-button">New Customer</a>
        <a href="trackadmin.php" onclick="w3_close()" class="w3-bar-item w3-button">Track</a>
        <a href="indexadmin.php" onclick="w3_close()" class="w3-bar-item w3-button">Extend</a>
        <a href="mycartadmin.php" onclick="w3_close()" class="w3-bar-item w3-button">Carts</a>
        <a href="mypaymentadmin.php" onclick="w3_close()" class="w3-bar-item w3-button">Payment</a>
        <a href="bookverify.php" onclick="w3_close()" class="w3-bar-item w3-button">Booking</a>
        <a href="mainpage.php" onclick="w3_close()" class="w3-bar-item w3-button">Logout</a>
    </nav>
    <!-- Top menu -->
    <div class="w3-top">
      <div class="w3-white w3-xlarge" style="max-width:1200px;margin:auto">
        <div class="w3-button w3-padding-16 w3-left" onclick="w3_open()">☰</div>
        <div class="w3-right w3-padding-16">Login</div>
        <div class="w3-center w3-padding-16">EPRO ESYSTEM</div>
      </div>
    </div>
    <!-- !PAGE CONTENT! -->
    <div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:100px">
      <h1>Booking Table</h1>
      <br>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>Name</th>
            <th>No.handphone</th>
            <th>Email</th>
            <th>No.Epro</th>
            <th>Date and time</th>
            <th>Service</th>
            <th>Remarks</th>
            <th>Status</th>
            <th></th>
          </tr>
        </thead>
        <tbody> <?php
         foreach ($rows as $books ){
                $bookid = $books['book_id'];
                $book_name = $books['book_name'];
                $book_handphone = $books['book_handphone'];
                $book_email = $books['book_email'];
                $book_epro = $books['book_epro'];
                $book_datetime = $books['book_datetime'];
                $book_service = $books['book_service'];
                $book_remarks = $books['book_remarks'];
                $book_verify = $books['book_verify'];
                
                echo "
												<tr>
													<td>$bookid</td>
													<td>$book_name</td>
													<td>$book_handphone</td>
													<td>$book_email</td>
													<td>$book_epro</td>
													<td>$book_datetime</td>
													<td>$book_service</td>
													<td>$book_remarks</td>
													<td>$book_verify</td>
													<td>
            <button><a href ='https://eproesystem.com/esystem/epro/php/bookverifydb.php?email=$book_email&verify=$book_verify'>Verify</a></button>
													</td>
												</tr>";
         }
                ?> </tbody>
      </table>
    </div>
    <!-- Footer -->
    <footer class="w3-row-padding w3-padding-32">
      <hr>
      </hr>
      <p class="w3-center">Epro Tracker&reg;</p>
    </footer>
  </body>
</html>