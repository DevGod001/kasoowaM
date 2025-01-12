<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include_once 'connect.php';
include_once 'password/mail.php';
if(isset($_GET['verify_mail'])){
    $mail=mysqli_real_escape_string($conn,$_GET['mail']);
    if(empty($mail)){
        echo "";
        exit;
    }
    $select="SELECT * FROM `users` WHERE `mail` LIKE '%$mail%'";
    $selected=mysqli_query($conn,$select);
    $row=mysqli_num_rows($selected);
    if($row==0){
        echo "user email not found";
        exit;
    }
    else{
        echo "";
    }
}


if(isset($_GET['verify_password'])){
    $password=mysqli_real_escape_string($conn,$_GET['password']);
    $mail=mysqli_real_escape_string($conn,$_GET['mail']);
    if(!filter_var($mail,FILTER_VALIDATE_EMAIL)){
        echo "please enter a valid email address";
        exit;
    }
    $select="SELECT * FROM `users` WHERE `mail`='$mail'";
    $selected=mysqli_query($conn,$select);
    $row=mysqli_num_rows($selected);
    if($row==0){
        echo "user not found,please enter your registered email";
        exit;
    }
    else{
      $fetch=mysqli_fetch_assoc($selected);
      $hash=$fetch['password'];
      if(!password_verify($password,$hash)){
         
          echo "invalid password";
          exit;
      }
      else{
          echo "";
      }
    }
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    $mail=mysqli_real_escape_string($conn,$_POST['mail']);
     $password=mysqli_real_escape_string($conn,$_POST['password']);
     if(!filter_var($mail,FILTER_VALIDATE_EMAIL)){
         header('Location:login');
         exit;
     }
     $select="SELECT * FROM `users` WHERE `mail`='$mail'";
     $selected=mysqli_query($conn,$select);
     $row=mysqli_num_rows($selected);
     if($row==0){
          $_SESSION['login']="invalid email";
         header('Location:login');
         exit;
     }
     $fetch=mysqli_fetch_assoc($selected);
     $hash=$fetch['password'];
  if(!password_verify($password,$hash)){
      $_SESSION['login']="invalid password";
      header('Location:login');
      exit;
  }
  $mail_verified=$fetch['mail_verified'];
  if(empty($mail_verified) || $mail_verified=="NULL"){
      
      
       $select_otp="SELECT * FROM `otp` WHERE TIMESTAMPDIFF(MINUTE,`date`,NOW()) <= 30";
      $otp_selected=mysqli_query($conn,$select_otp);
      $otp_row=mysqli_num_rows($otp_selected);
      if($otp_row>100){
      header('Location:mail?status=error');
          $_SESSION['status']="sent";
          exit;
      }
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
  $user_id=$fetch['id'];
  $country=$fetch['country'];
  $username=$fetch['username'];
  $type=$fetch['account_type'];
  $key=$fetch['user_key'];
  
  setcookie("user_key",$key,time()+86400);
  setcookie("user_id",$user_id,time()+86400);
   setcookie("home_user_id",$user_id,time()+86400,'/');
 
  setcookie("username",$username,time()+86400);
  $select="SELECT * FROM `accounts` WHERE `user_id`=$user_id";
  $selected=mysqli_query($conn,$select);
  $fetch=mysqli_fetch_assoc($selected);
  $address=$fetch['address'];
  $address=explode(", ",$address);
  $total_address=count($address);
  $state_count=$total_address-1;
  $city_count=$state_count-2;
  if($country=="nigeria"){
      $city_count=$state_count-1;
  }
  $state=$address[$state_count];
  $city=$address[$city_count];
  $state=str_replace(".","",$state);
  $state=str_replace("state","",$state);
  setcookie("city",$city,time()+31536000);
  setcookie("state",$state,time()+31536000);
  setcookie("ip",$country,time()+31536000);
  setcookie("cart_id",$key,time()+31536000);
  setcookie("home_cart_id",$key,time()+31536000,'/');
  
  
  if(empty($type) || $type=="NULL"){
      
       header('Location:complete');
       exit;
  }
  else{
      setcookie("account_type",$type,time()+86400);
      setcookie("home_account_type",$type,time()+86400);
      
  header('Location:/');
exit;
}
}


?>