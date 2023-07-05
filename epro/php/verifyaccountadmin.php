<?php
error_reporting(0);
include_once("dbconnect.php");
$email = $_GET['email'];
$otp = $_GET['otp'];
$sqlverify = "SELECT * FROM tbl_admins WHERE admin_email = '$email' AND admin_otp = '$otp'";
$stmt = $conn->prepare($sqlverify);
$stmt->execute();
$number_of_rows = $stmt->fetchColumn();

if ($number_of_rows  > 0) {
   $newotp = '1';
   $sqlupdate = "UPDATE tbl_admins SET admin_otp = '$newotp' WHERE admin_email = '$email'";
  try {
        $conn->exec($sqlupdate);
        echo "<script>alert('Successful')</script>";
        echo "<script>window.location.replace('loginadmin.php')</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Failed')</script>";
        echo "<script> window.location.replace('registeradmin.php')</script>";
    }
}else{
     echo "<script>alert('Failed')</script>";
     echo "<script> window.location.replace('registeradmin.php')</script>";
}

 
?>