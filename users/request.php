<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include_once 'connect.php';


if($_SERVER['REQUEST_METHOD']=='POST'){
    $otp=mysqli_real_escape_string($conn,$_POST['otp']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    $confirm=mysqli_real_escape_string($conn,$_POST['confirm']);
 
     
    
    $select="SELECT * FROM `otp`  WHERE `otp_code`=$otp AND TIMESTAMPDIFF(MINUTE,NOW(),`date`)<=30 AND `status`='active'";
    $selected=mysqli_query($conn,$select);
    $row=mysqli_num_rows($selected);
   
    if($row==0){
        $_SESSION['notify']="invalid otp";
        header('Location:verify');
        exit;
    }
    $fetch=mysqli_fetch_assoc($selected);
    $mail=$fetch['mail'];
    $hash=password_hash($password,PASSWORD_DEFAULT);
    if(!password_verify($confirm,$hash)){
        $_SESSION['notify']="new password and confirm password must be the same";
        header('Location:verify');
        exit;
    }
    $update="UPDATE `users` SET `password`='$hash' WHERE `mail`='$mail'";
    $updated=mysqli_query($conn,$update);
    if($updated){
      header('Location:login');
      exit;
    }
}


?>