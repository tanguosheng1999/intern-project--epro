<?php
include_once("dbconnect.php");
session_start();

if (isset($_SESSION['sessionid'])) {
	$adminemail = $_SESSION['admin_email'];
} else {
	$response = array('status' => 'failed', 'data' => null);
	sendJsonResponse($response);
	return;
}

if ($_GET['submit'] == "add") {
	if ($adminemail != "Guest") {
		$customerid = $_GET['customerid'];
		$cartqty = "1";
		$carttotal = 0;
		$stmt = $conn -> prepare("SELECT * FROM tbl_admincarts WHERE admin_email = '$adminemail' AND customer_id = '$customerid'");
		$stmt -> execute();
		$number_of_rows = $stmt -> rowCount();
		$result = $stmt -> setFetchMode(PDO::FETCH_ASSOC);
		$rows = $stmt -> fetchAll();
		if ($number_of_rows > 0) {
			foreach($rows as $carts) {
				$cartqty = $carts['cart_qty'];
			}
			$cartqty = $cartqty + 1;
			$updatecart = "UPDATE `tbl_admincarts` SET `cart_qty`= '$cartqty' WHERE admin_email = '$adminemail' AND customer_id = '$customerid'";
			$conn -> exec($updatecart);

		} else {
			$addcart = "INSERT INTO `tbl_admincarts`(`admin_email`, `customer_id`, `cart_qty`) VALUES ('$adminemail','$customerid','$cartqty')";
			try {
				$conn -> exec($addcart);

			} catch (PDOException $e) {
				$response = array('status' => 'failed', 'data' => null);
				sendJsonResponse($response);
				return;
			}
		}
		$stmtqty = $conn -> prepare("SELECT * FROM tbl_admincarts WHERE admin_email = '$adminemail'");
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
