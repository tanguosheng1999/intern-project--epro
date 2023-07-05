<?php
include_once ("dbconnect.php");
$customerid = $_GET['customerid'];
$sqlquery = "SELECT * FROM tbl_customers WHERE customer_id = $customerid";
$stmt = $conn->prepare($sqlquery);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();

foreach ($rows as $customers)
{
    $customerid = $customers['customer_id'];
    $customer_name = $customers['customer_name'];
    $customer_ic = $customers['customer_ic'];
    $customer_handphone = $customers['customer_handphone'];
    $customer_email = $customers['customer_email'];
    $customer_epro = $customers['customer_epro'];
    $customer_price = $customers['customer_price'];
    $customer_remarks = $customers['customer_remarks'];
    $customer_qty = $customers['customer_qty'];
    $customer_date = date_format(date_create($customers['customer_date']), 'd/m/y h:i A');
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
            <div class="w3-right w3-padding-16">Mail</div>
            <div class="w3-center w3-padding-16">EPRO ESYSTEM</div>
        </div>
    </div>
    
    <div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:100px">
      
      <div class="w3-row w3-card">
        <div class="w3-half w3-center">
            <img class="w3-image w3-margin w3-center" style="height:100%;width:100%;max-width:330px" src="../images/books/<?php echo $customer_ic?>.jpg">
        </div>
        <div class="w3-half w3-container">
            <?php 
            echo "<h3 class='w3-center'><b>Customer Details</h3></b>
            <p><b>Name:</b> $customer_name<br><b>IC Number:</b> $customer_ic<br><b>Phone Number:</b> $customer_handphone<br><b>Email:</b> $customer_email<br><b>Epro Number:</b> $customer_epro<br><p>
            <p><b>Remarks:</b><br>$customer_remarks</p>
            <p style='font-size:160%;'>RM $customer_price</p>
            <p> <a href='index.php?customerid=$customerid' class='w3-btn w3-blue w3-round'>Add to Cart</a><p><br>
            <p>Date added<br>$customer_date</p>
            ";
            
            ?>
        </div>
        </div>
    </div>
    </div>
    <footer class="w3-row-padding w3-padding-32">
        <p class="w3-center">EPRO TRACKER&reg;</p>
    </footer>
   

</body>

</html>
