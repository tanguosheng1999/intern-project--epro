<?php
include_once ("dbconnect.php");
session_start();
if (isset($_SESSION['sessionid']))
{
    $adminemail = $_SESSION['admin_email'];
    $admin_name = $_SESSION['admin_name'];
    $admin_phone = $_SESSION['admin_phone'];
}else{
    echo "<script>alert('Please login or register')</script>";
    echo "<script> window.location.replace('loginadmin.php')</script>";
}
$sqlpayment = "SELECT * FROM tbl_payments ORDER BY payment_date DESC";
$stmt = $conn->prepare($sqlpayment);
$stmt->execute();
$number_of_rows = $stmt->rowCount();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();

function subString($str)
{
    if (strlen($str) > 15)
    {
        return $substr = substr($str, 0, 15) . '...';
    }
    else
    {
        return $str;
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
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" type="text/css" href="../css/style.css">
   <script src="../js/script.js"></script>
   <body onload="loadCookies()">
      <!-- Sidebar (hidden by default) -->
      <nav class="w3-sidebar w3-bar-block w3-card w3-top w3-xlarge w3-animate-left" style="display:none;z-index:2;width:20%;min-width:200px" id="mySidebar">
        <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button">Close Menu</a>
        <a href="loginadmin.php" onclick="w3_close()" class="w3-bar-item w3-button">Login</a>
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
            <div class="w3-center w3-padding-16">EPRO ESYSTEM</div>
         </div>
      </div>
      <div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:100px">
          <div class="w3-grid-template">
               <?php
               $totalpaid = 0.0;
               $count = 0;
                foreach ($rows as $payments){
                    $payment_email = $payments['payment_email'];
                    $paymentid = $payments['payment_id'];
                    $paymentreceipt = $payments['payment_receipt'];
                    $paymentpaid = number_format($payments['payment_paid'], 2, '.', '');
                    $totalpaid = $paymentpaid + $totalpaid;
                    $count++;
                    $paymentdate = date_format(date_create($payments['payment_date']),"d/m/Y h:i A");
                     echo "<div class='w3-left w3-padding-small'><div class = 'w3-card w3-round-large w3-padding'>
                    <div class='w3-container w3-center w3-padding-small'><b>Receipt ID: $paymentreceipt</b></div><br>
                    Book ordered: $count<br><i class='fa fa-envelope'></i> :$payment_email<br>Paid: RM $paymentpaid<br>Date: $paymentdate<br>
                    <div class='w3-button w3-blue w3-round w3-block'><a style='text-decoration: none;' href='https://eproesystem.com/esystem/epro/php/payment_detailsadmin.php?receipt=$paymentreceipt'>Details</a></div>
                    </div></div>";
                }
                $totalpaid = number_format($totalpaid, 2, '.', '');
                $totalpaid = number_format($totalpaid, 2, '.', '');
            echo "</div><br><hr><div class='w3-container w3-center'><h4>Your Orders</h4><p>Total Paid: RM $totalpaid<p></div>";
               ?>
          </div>
      </div>
      <footer class="w3-row-padding w3-padding-32">
         <hr>
         </hr>
         <p class="w3-center">EPRO ETRACKER&reg;</p>
      </footer>
      <div id="id01" class="w3-modal">
      <div class="w3-modal-content" style="width:50%">
         <header class="w3-container w3-blue">
            <span onclick="document.getElementById('id01').style.display='none'" 
               class="w3-button w3-display-topright">&times;</span>
            <h4>Email to reset password</h4>
         </header>
         <div class="w3-container w3-padding">
            <form action="loginadmin.php" method="post">
               <label><b>Email</b></label>
               <input class="w3-input w3-border w3-round" name="email" type="email" id="idemail" required>
               <p>
                  <button class="w3-btn w3-round w3-blue" name="reset">Submit</button>
               </p>
            </form>
         </div>
      </div>
   </body>
</html>