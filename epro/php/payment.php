<?php
error_reporting(0);
session_start();
if (isset($_SESSION['sessionid']))
{
    $useremail = $_SESSION['user_email'];
    $user_name = $_SESSION['user_name'];
    $user_phone = $_SESSION['user_phone'];
}else{
    echo "<script>alert('Please login or register')</script>";
    echo "<script> window.location.replace('login.php')</script>";
}

$email = $_GET['email']; //email
$amount = $_GET['amount']; 

$api_key = '1f0e988c-9c9d-49b1-86d3-07882aedbd73';
$collection_id = 'omkh5wia';
$host = 'https://www.billplz-sandbox.com/api/v3/bills';

$data = array(
          'collection_id' => $collection_id,
          'email' => $useremail,
          'mobile' => $user_phone,
          'name' => $user_name,
          'amount' => ($amount + 1) * 100, // RM20
		  'description' => 'Payment for order by '.$email,
          'callback_url' => "https://eproesystem.com/esystem/epro/php/return_url",
          'redirect_url' => "https://eproesystem.com/esystem/epro/php/payment_update.php?email=$email&amount=$amount" 
);

$process = curl_init($host );
curl_setopt($process, CURLOPT_HEADER, 0);
curl_setopt($process, CURLOPT_USERPWD, $api_key . ":");
curl_setopt($process, CURLOPT_TIMEOUT, 30);
curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($process, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($process, CURLOPT_POSTFIELDS, http_build_query($data) ); 

$return = curl_exec($process);
curl_close($process);

$bill = json_decode($return, true);
header("Location: {$bill['url']}");
?>