<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/home2/eproesys/public_html/PHPMailer/src/Exception.php';
require '/home2/eproesys/public_html/PHPMailer/src/PHPMailer.php';
require '/home2/eproesys/public_html/PHPMailer/src/SMTP.php';

if (isset($_POST["submit"])) {
    include 'dbconnect.php';
    $email = $_POST["email"];
    $pass = sha1($_POST["password"]);
    $otp = '1';
    $stmt = $conn->prepare("SELECT * FROM tbl_admins WHERE admin_email = '$email' AND admin_password = '$pass' AND admin_otp='$otp'");
    $stmt->execute();
    $number_of_rows = $stmt->rowCount();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $rows = $stmt->fetchAll();
    if ($number_of_rows  > 0) {
        foreach ($rows as $admin)
        {
            $admin_name = $admin['admin_name'];
            $admin_phone = $admin['admin_phone'];
        }
        session_start();
        $_SESSION["sessionid"] = session_id();
        $_SESSION["admin_email"] = $email;
        $_SESSION["admin_name"] = $admin_name;
        $_SESSION["admin_phone"] = $admin_phone;
        echo "<script>alert('Login Success');</script>";
        echo "<script> window.location.replace('indexadmin.php')</script>";
    }else{
         echo "<script>alert('Login Failed');</script>";
         echo "<script> window.location.replace('loginadmin.php')</script>";
    }
}
if (isset($_POST["reset"])) {
     $email = $_POST["email"];
    sendMail($email);
     echo "<script>alert('Check your email');</script>";
     echo "<script> window.location.replace('loginadmin.php')</script>";
}


function sendMail($email){
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 0;                                               //Disable verbose debug output
    $mail->isSMTP();                                                    //Send using SMTP
    $mail->Host       = 'mail.eproesystem.com';                          //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                           //Enable SMTP authentication
    $mail->Username   = 'tracker@eproesystem.com';  
    $mail->Password   = 'tracker8888';                                 //
    $mail->SMTPSecure = 'tls';         
    $mail->Port       = 587;
    $from = "tracker@eproesystem.com";
    $to = $email;
    $subject = 'EPRO ESYSTEM - Reset password request';
    $message = "<h2>You have requested to reset your password App</h2> <p>Please click on the following link to reset your password. If your did not request for the reset. You can ignore this email<p>
    <p><button><a href ='https://eproesystem.com/esystem/epro/php/verifyaccountadmin.php?email=$email'>Verify Here</a></button>";
    
    $mail->setFrom($from,"EPRO ESYSTEM");
    $mail->addAddress($to);                                             //Add a recipient
    
    //Content
    $mail->isHTML(true);                                                //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;
    $mail->send();
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
   <body onload="loadCookies()">
      <!-- Sidebar (hidden by default) -->
       <nav class="w3-sidebar w3-bar-block w3-card w3-top w3-xlarge w3-animate-left" style="display:none;z-index:2;width:20%;min-width:200px" id="mySidebar">
        <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button">Close Menu</a>
        <a href="loginadmin.php" onclick="w3_close()" class="w3-bar-item w3-button">Login</a>
        <a href="new_book.php" onclick="w3_close()" class="w3-bar-item w3-button">New Customer</a>
        <a href="trackadmin.php" onclick="w3_close()" class="w3-bar-item w3-button">Track</a>
        <a href="indexadmin.php" onclick="w3_close()" class="w3-bar-item w3-button">Extend</a>
        <a href="mycartadmin.php" onclick="w3_close()" class="w3-bar-item w3-button">Carts</a>
        <a href="mypaymentadmin.php" onclick="w3_close()" class="w3-bar-item w3-button">Payment</a>
        <a href="bookverify.php" onclick="w3_close()" class="w3-bar-item w3-button">Booking</a>
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
         <div class="w3-row w3-card">
            <div class="w3-half w3-container">
          <img class="w3-image w3-center w3-padding" style="width:100%; height:100%;object-fit:cover;" src="../images/loginimage.png">
        </div>
            <div class="w3-half w3-container">
               <h4>Login</h4>
               <form name="loginForm" class=""  action="loginadmin.php" method="post">
                  <p>
                     <label class="w3-text-blue">
                     <b>Email</b>
                     </label>
                     <input class="w3-input w3-border w3-round" name="email" type="email" id="idemail" required>
                  </p>
                  <p>
                     <label class="w3-text-blue">
                     <b>Password</b>
                     </label>
                     <input class="w3-input w3-border w3-round" name="password" type="password" id="idpass" required>
                  </p>
                  <p>
                     <input class="w3-check" type="checkbox" id="idremember" name="remember" onclick="rememberMe()">
                     <label>Remember Me</label>
                  </p>
                  <p>
                     <button class="w3-btn w3-round w3-blue w3-block" name="submit" value="login">Login</button>
                  </p>
               </form>
               <a href="" style="text-decoration:none;" onclick="document.getElementById('id01').style.display='block';return false;">Forgot your account. Click here.</a>
               </p>
            </div>
         </div>
      </div>
      <footer class="w3-row-padding w3-padding-32">
         <hr>
         </hr>
         <p class="w3-center">EPRO TRACKER&reg;</p>
      </footer>
      <div id="id01" class="w3-modal">
      <div class="w3-modal-content" style="width:50%">
         <header class="w3-container w3-blue">
            <span onclick="document.getElementById('id01').style.display='none'" 
               class="w3-button w3-display-topright">&times;</span>
            <h4>Email to reset password</h4>
         </header>
         <div class="w3-container w3-padding">
            <form action="loginadmin.php" method="post">
               <label><b>Email</b></label>
               <input class="w3-input w3-border w3-round" name="email" type="email" id="idemail" required>
               <p>
                  <button class="w3-btn w3-round w3-blue" name="reset">Submit</button>
               </p>
            </form>
         </div>
      </div>
   </body>
</html>