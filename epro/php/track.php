<?php
include_once ("dbconnect.php");
session_start();
$useremail = "Guest";
$user_name = "Guest";
$user_phone = "-";
if (isset($_SESSION['sessionid']))
{
    $useremail = $_SESSION['user_email'];
    $user_name = $_SESSION['user_name'];
    $user_phone = $_SESSION['user_phone'];
}
include_once("dbconnect.php");
 if ($_GET['submit'] == "search")
    {
        $search = $_GET['search'];
        $sqlquery = "SELECT * FROM tbl_customers WHERE customer_name LIKE '%$search%' ORDER BY customer_id DESC";
    }
else
{
    $sqlquery = "SELECT * FROM tbl_customers WHERE customer_qty > 0 ORDER BY customer_id DESC";
}

$results_per_page = 10;
if (isset($_GET['pageno']))
{
    $pageno = (int)$_GET['pageno'];
    $page_first_result = ($pageno - 1) * $results_per_page;
}
else
{
    $pageno = 1;
    $page_first_result = 0;
}

$stmt = $conn->prepare($sqlquery);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();
$number_of_result = $stmt->rowCount();
$number_of_page = ceil($number_of_result / $results_per_page);
$sqlquery = $sqlquery . " LIMIT $page_first_result , $results_per_page";
$stmt = $conn->prepare($sqlquery);
$stmt->execute();
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
            <div class="w3-center w3-padding-16">EPRO ESYSTEM</div>
        </div>
    </div>
    <div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:100px">
    <div class="w3-container w3-center"><p>Welcome <?php echo $user_name?> </p></div>
    <div class="w3-container w3-card w3-padding w3-row w3-round" style="width:100%">
        <form class="w3-container" action="track.php" method="get">
            <div class="w3-twothird"><input class="w3-input w3-border w3-round w3-center" placeholder = "Enter your search term here" type="text" name="search"></div>
            <div class="w3-third"><input class="w3-input w3-border w3-blue w3-round" type="submit" name="submit" value="search"></div>
        </form>
    </div>
    <hr>
        
        <div class="w3-grid-template">
             <?php
             $cart = "cart";
                foreach ($rows as $customers){
                    $customerid = $customers['customer_id'];
                    $customer_name = $customers['customer_name'];
                    $customer_ic = $customers['customer_ic'];
                    $customer_handphone = $customers['customer_handphone'];
                    $customer_email = $customers['customer_email'];
                    $customer_epro = $customers['customer_epro'];
                    $customer_price = $customers['customer_price'];
                    $customer_remarks = $customers['customer_remarks'];
                    $customer_qty = $customers['customer_qty'];
                    $customer_date = $customers['customer_date'];
                    
                    echo "<div class='w3-center w3-padding-small'><div class = 'w3-card w3-round-large'>
                    <div class='w3-padding-small'><a href='book_details.php?customerid=$customerid'><img class='w3-container w3-image' 
                    src=../images/books/$customer_ic.jpg onerror=this.onerror=null;this.src='../images/profile.png'></a></div>
                    <b>Name: $customer_name</b><br>No.phone: $customer_handphone<br>Epro ID: $customer_epro<br>Price Epro: RM$customer_price/unit<br><br>
                    </div></div>";
                    //<a href='index.php?bookid=$bookid&submit=$cart' class='w3-btn w3-blue w3-round'>Add to Cart</a><br><br>
                }
             ?>
        </div>
    </div>
    <?php
    $num = 1;
    if ($pageno == 1) {
        $num = 1;
    } else if ($pageno == 2) {
        $num = ($num) + $results_per_page;
    } else {
        $num = $pageno * $results_per_page - 9;
    }
    echo "<div class='w3-container w3-row'>";
    echo "<center>";
    for ($page = 1; $page <= $number_of_page; $page++) {
        echo '<a href = "track.php?pageno=' . $page . '" style=
        "text-decoration: none">&nbsp&nbsp' . $page . ' </a>';
    }
    echo " ( " . $pageno . " )";
    echo "</center>";
    echo "</div>";
    ?>
    <footer class="w3-row-padding w3-padding-32">
        <hr></hr>
         <p class="w3-center">EPRO ETRACKER&reg;</p>
    
    </footer>
</body>

</html>