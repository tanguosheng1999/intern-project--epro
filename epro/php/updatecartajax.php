<?php
include_once("dbconnect.php");
session_start();

if (isset($_SESSION['sessionid'])) {
	$useremail = $_SESSION['user_email'];
} else {
	$response = array('status' => 'failed', 'data' => null);
	sendJsonResponse($response);
	return;
}

if ($_GET['submit'] == "add") {
	if ($useremail != "Guest") {
		$customerid = $_GET['customerid'];
		$cartqty = "1";
		$carttotal = 0;
		$stmt = $conn -> prepare("SELECT * FROM tbl_carts WHERE user_email = '$useremail' AND customer_id = '$customerid'");
		$stmt -> execute();
		$number_of_rows = $stmt -> rowCount();
		$result = $stmt -> setFetchMode(PDO::FETCH_ASSOC);
		$rows = $stmt -> fetchAll();
		if ($number_of_rows > 0) {
			foreach($rows as $carts) {
				$cartqty = $carts['cart_qty'];
			}
			$cartqty = $cartqty + 1;
			$updatecart = "UPDATE `tbl_carts` SET `cart_qty`= '$cartqty' WHERE user_email = '$useremail' AND customer_id = '$customerid'";
			$conn -> exec($updatecart);

		} else {
			$addcart = "INSERT INTO `tbl_carts`(`user_email`, `customer_id`, `cart_qty`) VALUES ('$useremail','$customerid','$cartqty')";
			try {
				$conn -> exec($addcart);

			} catch (PDOException $e) {
				$response = array('status' => 'failed', 'data' => null);
				sendJsonResponse($response);
				return;
			}
		}
		$stmtqty = $conn -> prepare("SELECT * FROM tbl_carts WHERE user_email = '$useremail'");
		$stmtqty -> execute();
		$resultqty = $stmtqty -> setFetchMode(PDO::FETCH_ASSOC);
		$rowsqty = $stmtqty -> fetchAll();
		$carttotal = 0;
		foreach($rowsqty as $carts) {
			$carttotal = $carts['cart_qty'] + $carttotal;
		}
		$mycart = array();
		$mycart['carttotal'] = $carttotal;


		$response = array('status' => 'success', 'data' => $mycart);
		sendJsonResponse($response);


	} else {
		$response = array('status' => 'failed', 'data' => null);
		sendJsonResponse($response);
	}
}


function sendJsonResponse($sentArray) {
	header('Content-Type: application/json');
	echo json_encode($sentArray);
}

?>
