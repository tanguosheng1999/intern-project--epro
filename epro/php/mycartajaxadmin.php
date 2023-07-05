<?php
include_once("dbconnect.php");
session_start();

if (isset($_SESSION['sessionid'])) {
    $adminemail = $_SESSION['admin_email'];
}else{
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    return;
}
if (isset($_GET['submit'])) {
    $customerid = $_GET['customerid'];
    $customerprice = $_GET['customerprice'];
    $sqlqty = "SELECT * FROM tbl_admincarts WHERE admin_email = '$adminemail' AND customer_id = '$customerid'";
    $stmtsqlqty = $conn->prepare($sqlqty);
    $stmtsqlqty->execute();
    $resultsqlqty = $stmtsqlqty->setFetchMode(PDO::FETCH_ASSOC);
    $rowsqlqty = $stmtsqlqty->fetchAll();
    $customercurqty = 0;
    foreach ($rowsqlqty as $customers) {
        $customercurqty = $customers['cart_qty'] + $customercurqty;
    }
    if ($_GET['submit'] == "add"){
        $cartqty = $customercurqty + 1 ;
        $updatecart = "UPDATE `tbl_admincarts` SET `cart_qty`= '$cartqty' WHERE admin_email = '$adminemail' AND customer_id = '$customerid'";
        $conn->exec($updatecart);
    }
    if ($_GET['submit'] == "remove"){
        if ($customercurqty == 1){
            $updatecart = "DELETE FROM `tbl_admincarts` WHERE admin_email = '$adminemail' AND customer_id = '$customerid'";
            $conn->exec($updatecart);
        }else{
            $cartqty = $customercurqty - 1 ;
            $updatecart = "UPDATE `tbl_admincarts` SET `cart_qty`= '$cartqty' WHERE admin_email = '$adminemail' AND customer_id = '$customerid'";
            $conn->exec($updatecart);    
        }
    }
}


$stmtqty = $conn->prepare("SELECT * FROM tbl_admincarts INNER JOIN tbl_customers ON tbl_carts.customer_id = tbl_customers.customer_id WHERE tbl_admincarts.admin_email = '$adminemail'");
$stmtqty->execute();
//$resultqty = $stmtqty->setFetchMode(PDO::FETCH_ASSOC);
$rowsqty = $stmtqty->fetchAll();
$totalpayable = 0;
foreach ($rowsqty as $carts) {
   $carttotal = $carts['cart_qty'] + $carttotal;
   $customerpr = $carts['customer_price'] * $carts['cart_qty'];
   $totalpayable = $totalpayable + $customerpr;
}

$mycart = array();
$mycart['carttotal'] =$carttotal;
$mycart['customerid'] =$customerid;
$mycart['qty'] =$cartqty;
$mycart['customerprice'] = bcdiv($cartqty * $customerprice,1,2);
$mycart['totalpayable'] = bcdiv($totalpayable,1,2);


$response = array('status' => 'success', 'data' => $mycart);
sendJsonResponse($response);


function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}
?>