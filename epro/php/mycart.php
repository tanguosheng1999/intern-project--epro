<?php
include_once("dbconnect.php");
session_start();

if (isset($_SESSION['sessionid'])) {
    $useremail = $_SESSION['user_email'];
     $user_name = $_SESSION['user_name'];
    $user_phone = $_SESSION['user_phone'];
}else{
   echo "<script>alert('Please login or register')</script>";
   echo "<script> window.location.replace('login.php')</script>";
}
$sqlcart = "SELECT * FROM tbl_carts WHERE user_email = '$useremail'";
$stmt = $conn->prepare($sqlcart);
$stmt->execute();
$number_of_rows = $stmt->rowCount();
if ($number_of_rows>0){
   if (isset($_GET['submit'])) {
    if ($_GET['submit'] == "add"){
        $customerid = $_GET['customerid'];
        $qty = $_GET['qty'];
        $cartqty = $qty + 1 ;
        $updatecart = "UPDATE `tbl_carts` SET `cart_qty`= '$cartqty' WHERE user_email = '$useremail' AND customer_id = '$customerid'";
        $conn->exec($updatecart);
        echo "<script>alert('Cart updated')</script>";
    }
    if ($_GET['submit'] == "remove"){
        $customerid = $_GET['customerid'];
        $qty = $_GET['qty'];
        if ($qty == 1){
            $updatecart = "DELETE FROM `tbl_carts` WHERE user_email = '$useremail' AND customer_id = '$customerid'";
            $conn->exec($updatecart);
            echo "<script>alert('Customer removed')</script>";
        }else{
            $cartqty = $qty - 1 ;
            $updatecart = "UPDATE `tbl_carts` SET `cart_qty`= '$cartqty' WHERE user_email = '$useremail' AND customer_id = '$customerid'";
            $conn->exec($updatecart);    
            echo "<script>alert('Removed')</script>";
        }
        
    }
} 
}else{
    echo "<script>alert('No item in your cart')</script>";
   echo "<script> window.location.replace('index.php')</script>";
}



$stmtqty = $conn->prepare("SELECT * FROM tbl_carts INNER JOIN tbl_customers ON tbl_carts.customer_id = tbl_customers.customer_id WHERE tbl_carts.user_email = '$useremail'");
$stmtqty->execute();
$resultqty = $stmtqty->setFetchMode(PDO::FETCH_ASSOC);
$rowsqty = $stmtqty->fetchAll();
foreach ($rowsqty as $carts) {
   $carttotal = $carts['cart_qty'] + $carttotal;
}

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
            <div class="w3-right w3-padding-16" id = "carttotalidb" >Cart (<?php echo $carttotal?>)</div>
            <div class="w3-center w3-padding-16">EPRO ESYSTEM</div>
        </div>
    </div>
    <div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:100px">
        <div class="w3-container w3-center"><p>Cart for <?php echo $user_name?> </p></div><hr>
        <div class="w3-grid-template">
             <?php
             
             $total_payable = 0.00;
                foreach ($rowsqty as $customers){
                    $customerid = $customers['customer_id'];
                    $customer_name = $customers['customer_name'];
                    $customer_ic = $customers['customer_ic'];
                    $customer_price = $customers['customer_price'];
                    $customer_qty = $customers['cart_qty'];
                    $customer_total = $customer_qty * $customer_price;
                    $total_payable = $customer_total + $total_payable;
                    echo "<div class='w3-center w3-padding-small' id='customercard_$customerid'><div class = 'w3-card w3-round-large'>
                    <div class='w3-padding-small'><a href='customer_details.php?customerid=$customerid'><img class='w3-container w3-image' 
                    src=../images/books/$customer_ic.jpg onerror=this.onerror=null;this.src='../images/profile.png'></a></div>
                    <b>$customer_name</b><br>RM $customer_price/unit<br>
                    <a href='mycart.php?useremail=$useremail&customerid=$customerid&qty=$customer_qty&submit=remove' class='w3-btn w3-red w3-round'>-</a>
                    $customer_qty
                    <a href='mycart.php?useremail=$useremail&customerid=$customerid&qty=$customer_qty&submit=add' class='w3-btn w3-green w3-round'>+</a><br>
                    <br>
                    <b><label id='customerprid_$customerid'> Price: RM $customer_total</label></b><br></div></div>";
                }
             ?>
        </div>
        <?php 
        echo "<div class='w3-container w3-padding w3-block w3-center'><p><b><label id='totalpaymentid'> Total Amount Payable: RM $total_payable</label>
        </b></p><a href='payment.php?email=$useremail&amount=$total_payable' class='w3-button w3-round w3-blue'> Pay Now </a> </div>";
        ?>
        
    <footer class="w3-row-padding w3-padding-32">
        <hr></hr>
         <p class="w3-center">EPRO TRACKER&reg;</p>
    
    </footer>
  <script>
 function addCart(customerid, customer_price) {
	jQuery.ajax({
		type: "GET",
		url: "mycartajax.php",
		data: {
			customerid: customerid,
			submit: 'add',
			customerprice: customer_price
		},
		cache: false,
		dataType: "json",
		success: function(response) {
			var res = JSON.parse(JSON.stringify(response));
			console.log(res.data.carttotal);
			if (res.status = "success") {
				var customerid = res.data.customerid;
				document.getElementById("carttotalida").innerHTML = "Cart (" + res.data.carttotal + ")";
				document.getElementById("carttotalidb").innerHTML = "Cart (" + res.data.carttotal + ")";
				document.getElementById("qtyid_" + customerid).innerHTML = res.data.qty;
				document.getElementById("customerprid_" + customerid).innerHTML = "Price: RM " + res.data.customerprice;
				document.getElementById("totalpaymentid").innerHTML = "Total Amount Payable: RM " + res.data.totalpayable;
			} else {
				alert("Failed");
			}

		}
	});
}

function removeCart(customerid, customer_price) {
	jQuery.ajax({
		type: "GET",
		url: "mycartajax.php",
		data: {
			customerid: customerid,
			submit: 'remove',
			customerprice: customer_price
		},
		cache: false,
		dataType: "json",
		success: function(response) {
			var res = JSON.parse(JSON.stringify(response));
			if (res.status = "success") {
				console.log(res.data.carttotal);
				if (res.data.carttotal == null || res.data.carttotal == 0){
				    alert("Cart empty");
				    window.location.replace("index.php");
				}else{
				var customerid = res.data.customerid;
				document.getElementById("carttotalida").innerHTML = "Cart (" + res.data.carttotal + ")";
				document.getElementById("carttotalidb").innerHTML = "Cart (" + res.data.carttotal + ")";
				document.getElementById("qtyid_" + customerid).innerHTML = res.data.qty;
				document.getElementById("customerprid_" + customerid).innerHTML = "Price: RM " + res.data.customerprice;
				document.getElementById("totalpaymentid").innerHTML = "Total Amount Payable: RM " + res.data.totalpayable;
				console.log(res.data.qty);
				if (res.data.qty==null){
				    var element = document.getElementById("customercard_"+customerid);
				    element.parentNode.removeChild(element);
				}    
				}
				
			} else {
				alert("Failed");
			}

		}
	});
}
</script>
</body>
</html>
<!--// <a href='mycart.php?useremail=$useremail&bookid=$bookid&qty=$book_qty&submit=remove' class='w3-btn w3-blue w3-round'>-</a>-->
<!--     // $book_qty-->
<!--     // <a href='mycart.php?useremail=$useremail&bookid=$bookid&qty=$book_qty&submit=add' class='w3-btn w3-blue w3-round'>+</a><br>-->
