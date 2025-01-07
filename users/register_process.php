<?php
error_reporting(E_ALL);
ini_set("display_errors",1);
session_start();
include_once 'connect.php';
include_once 'password/mail.php';
if(isset($_GET['session'])){
if($_SERVER['REQUEST_METHOD']=='GET'){
    $mail=mysqli_real_escape_string($conn,$_GET['mail']);
    $name=mysqli_real_escape_string($conn,$_GET['name']);
    $number=mysqli_real_escape_string($conn,$_GET['number']);
    $password=mysqli_real_escape_string($conn,$_GET['password']);
    $_SESSION['mail']=$mail;
    $_SESSION['name']=$name;
    $_SESSION['number']=$number;
    $_SESSION['password']=$password;
    
}
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    
    $country=mysqli_real_escape_string($conn,$_POST['country']);
    $mail=$_SESSION['mail'];
    $name=$_SESSION['name'];
    $business=explode(' ',$name);
    $business=$business[0];
    $number=$_SESSION['number'];
    $password=$_SESSION['password'];
  switch($country){
      case "nigeria":
      $currency="&#8358;";
      break;
      case "united_states":
      case "canada":
      $currency="$";
      break;
      case "united_kingdom":
      $currency="&#163;";
      break;
     case "ghana":
     $currency="&#8353;";
     break;
     case "cameroon":
     $currency="XAF";
     break;
  }
  $select="SELECT * FROM `users` WHERE `mail`='$mail'";
  $selected=mysqli_query($conn,$select);
  $row=mysqli_num_rows($selected);
  if($row>0){
      header("Location:register");
      exit;
  }
  $hash=password_hash($password,PASSWORD_DEFAULT);
  $key=array_merge(range('A','Z'),range(0,9));
  shuffle($key);
  $key=implode('',$key);
  $key=substr($key,0,20);
  $insert="INSERT INTO `users`(`user_key`,`mail`,`username`,`full_name`,`mobile`,`password`,`country`,`currency`,`balance`,`profile`) VALUES('$key','$mail','$business','$name',$number,'$hash','$country','$currency',0,'photos/avatar.png')";
  $inserted=mysqli_query($conn,$insert);
  if($inserted){
      $select="SELECT * FROM `otp` WHERE TIMESTAMPDIFF(MINUTE,`date`,NOW()) <= 30";
      $selected=mysqli_query($conn,$select);
      $row=mysqli_num_rows($selected);
      if($row>100){
      header('Location:mail?status=error');
          
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
$subject="Welcome to kasoowa";
      send($mail,$name,$subject,$message);
      header('Location:mail?status=sent');
      exit;
  }
  else{
      echo mysqli_error($conn);
  }
    
    
}
if(isset($_GET['business'])){
    $business=$_GET['name'];
    $select="SELECT * FROM `users` WHERE `username`='$business'";
    $selected=mysqli_query($conn,$select);
    $row=mysqli_num_rows($selected);
    if(empty($business)){
        echo "";
        exit;
    }
    if($row>0){
        echo "username has already been taken,kindly use another";
        exit;
    }
    else{
        echo "";
    }
}
if(isset($_GET['gmail'])){
    $mail=mysqli_real_escape_string($conn,$_GET['mail']);
    if(empty($mail)){
        echo "";
        exit;
    }
    $select="SELECT * FROM `users` WHERE `mail`='$mail'";
    $selected=mysqli_query($conn,$select);
    $row=mysqli_num_rows($selected);
    
    if($row>0){
        echo "email has already been taken,kindly use another";
        exit;
    }
    else{
      
        exit;
    }
}
?>