<?php
error_reporting(E_ALL);
include_once("dbconnect.php");
$email = $_GET['email'];
$verify = $_GET['verify'];
$sqlverifydb = "SELECT * FROM tbl_books WHERE book_email = ? AND book_verify = ?";
$stmt = $conn->prepare($sqlverifydb);
$stmt->execute([$email, $verify]);
$number_of_rows = $stmt->fetchColumn();

if ($number_of_rows > 0) {
   $newverify = 'verify';
   $sqlupdatedb = "UPDATE tbl_books SET book_verify = ? WHERE book_email = ?";
  try {
        $stmt = $conn->prepare($sqlupdatedb);
        $stmt->execute([$newverify, $email]);
        echo "<script>alert('Successful')</script>";
        echo "<script>window.location.replace('bookverify.php')</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Failed')</script>";
        echo "<script> window.location.replace('bookverify.php')</script>";
    }
} else {
     echo "<script>alert('Failed')</script>";
     echo "<script> window.location.replace('bookverify.php')</script>";
}
?>
