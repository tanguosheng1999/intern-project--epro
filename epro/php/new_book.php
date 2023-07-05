<?php
if (isset($_POST["submit"])) {
    include_once("dbconnect.php");
    $name = $_POST["name"];
    $ic = $_POST["ic"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $epro = $_POST["epro"];
    $price = $_POST["price"];
    $remarks = $_POST["remarks"];
    $qty = $_POST["qty"];
    $sqlinsert = "INSERT INTO `tbl_customers`(`customer_name`, `customer_ic`, `customer_handphone`, `customer_email`, `customer_epro`, `customer_price`, `customer_remarks`, `customer_qty`) VALUES ('$name', '$ic', '$phone', '$email', '$epro', '$price', '$remarks','$qty')";
    
    try {
        $conn->exec($sqlinsert);
        if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {
            uploadImage($ic);
        }
        echo "<script>alert('Registration successful')</script>";
        echo "<script>window.location.replace('new_book.php')</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Registration failed')</script>";
        echo "<script>window.location.replace('new_book.php')</script>";
    }
}

function uploadImage($id)
{
    $target_dir = "../images/books/";
    $target_file = $target_dir . $id . ".jpg";
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
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
        <a href="loginadmin.php" onclick="w3_close()" class="w3-bar-item w3-button">Login</a>
        <a href="new_book.php" onclick="w3_close()" class="w3-bar-item w3-button">New Customer</a>
        <a href="trackadmin.php" onclick="w3_close()" class="w3-bar-item w3-button">Track</a>
        <a href="indexadmin.php" onclick="w3_close()" class="w3-bar-item w3-button">Extend</a>
        <a href="mycartadmin.php" onclick="w3_close()" class="w3-bar-item w3-button">Carts</a>
        <a href="mypaymentadmin.php" onclick="w3_close()" class="w3-bar-item w3-button">Payment</a>
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

        <form class="w3-container" action="new_book.php" method="post" enctype="multipart/form-data" onsubmit="return confirmDialog()">
            <div class="w3-container w3-blue">
                <h2>New Customer</h2>
            </div>
            <div class="w3-container w3-border w3-center w3-padding">
                <img class="w3-image w3-round w3-margin" src="../images/profile.png" style="height:100%;width:100%;max-width:330px"><br>
                <input type="file" onchange="previewFile()" name="fileToUpload" id="fileToUpload"><br>
            </div>
            <br>
            <label>Customer Name</label>
            <input class="w3-input" name="name" id="idname" type="text" required>
            
            <label>Customer IC</label>
            <input class="w3-input" name="ic" id="idic" type="text" required>

            <label>Phone Number</label>
            <input class="w3-input" name="phone" id="idphone" type="text" required>

            <label>Email</label>
            <input class="w3-input" name="email" id="idemail" type="text" required>
            
            <label>ID EPRO</label>
            <input class="w3-input" name="epro" id="idepro" type="number" step="any"required>
            
            <label>Price</label>
            <input class="w3-input" name="price" id="idprice" type="number" step="any"required>
            
            <label>Quantity</label>
            <input class="w3-input" name="qty" id="idqty" type="number" step="any"required>

            <p>
                <label>Remarks</label>
                <textarea class="w3-input w3-border" id="idremarks" name="remarks" rows="4" cols="50" width="100%" placeholder="Remarks" required></textarea>
            </p>
            
            <div class="w3-row">
                <input class="w3-input w3-border w3-block w3-blue w3-round" type="submit" name="submit" value="Submit">
            </div>

        </form>

    </div>
    <footer class="w3-row-padding w3-padding-32">
        <hr>
        </hr>
        <p class="w3-center">EPRO TRACKER&reg;</p>

    </footer>


</body>

</html>