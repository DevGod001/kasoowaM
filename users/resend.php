<?php
session_start();
include_once 'connect.php';
include_once 'password/mail.php';
if(isset($_GET['mail'])){
    $select="SELECT * FROM `otp` WHERE TIMESTAMPDIFF(MINUTE,`date`,NOW()) <= 30";
      $selected=mysqli_query($conn,$select);
      $row=mysqli_num_rows($selected);
      if($row>100){
      header('Location:mail?status=error');
          
          exit;
      }
      $mail=$_GET['mail'];
      $_SESSION['mail']=$mail;
      
      $otp=rand(100000,999999);
      $http = isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] : 'http';
    $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
    $link= $http . "://" . $host . "/users/mail?otp=$otp&mail=$mail";
      $message= '<h1>Welcome to Kasoowa!</h1>
<p>Thank you for registering with us. Please verify your email address to start shopping.</p>
<a href="'.$link.'" style="background-color: #28a745; color: white; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; border: none; border-radius: 5px; cursor: pointer;">Verify Your Email</a>';
$insert="INSERT INTO `otp`(`otp_code`,`mail`,`status`) VALUES($otp,'$mail','active')";
$inserted=mysqli_query($conn,$insert);
      $name="user";
      $subject="register";
      send($mail,$name,$subject,$message);
      header('Location:mail?status=sent');
      exit;
  
}

?>