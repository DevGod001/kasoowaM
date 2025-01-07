<?php
session_start();
include_once 'connect.php';
if(isset($_POST['buyer'])){
   $address=mysqli_real_escape_string($conn,$_POST['address']);
   $product=mysqli_real_escape_string($conn,$_POST['product']);
   $longitude=$_SESSION['longitude'];
   $latitude=$_SESSION['latitude'];
   $product=str_replace('all',"",$product);
   $name=$_FILES['profile']['name'];
   $tmp=$_FILES['profile']['tmp_name'];
   $user_id=$_COOKIE['user_id'];
    $username=$_COOKIE['username'];
   $dir="profile";
   if(!is_dir($dir)){
       mkdir($dir,0777,true);
   }
   if(!empty($name)){
       $dest=$dir."/".$name;
       move_uploaded_file($tmp,$dest);
       $update="UPDATE `users` SET `profile`='$dest' WHERE `id`=$user_id";
       $updated=mysqli_query($conn,$update);
       
   }
   if(empty($product)){
       $_SESSION['buy']="please select preferred product(s) or select rather not say";
       header('Location:complete');
       exit;
   }
   $insert="INSERT INTO `accounts`(`user_id`,`username`,`account_type`,`products`,`address`) VALUES($user_id,'$username','buyer','$product','$address')";
   $inserted=mysqli_query($conn,$insert);
   if($inserted){
       $update="UPDATE `users` SET `account_type`='buyer',`latitude`=$latitude,`longitude`=$longitude WHERE `id`=$user_id";
       $updated=mysqli_query($conn,$update);
       header('Location:/');
       exit;
   }
   else{
       echo mysqli_error($conn);
   }
}
if(isset($_POST['seller'])){
    $business=mysqli_real_escape_string($conn,$_POST['business']);
    $product=mysqli_real_escape_string($conn,$_POST['product']);
    $mail=mysqli_real_escape_string($conn,$_POST['mail']);
     $longitude=$_SESSION['longitude'];
   $latitude=$_SESSION['latitude'];
   $minimum_order=mysqli_real_escape_string($conn,$_POST['minimum_order']);
 
  
    $mobile=mysqli_real_escape_string($conn,$_POST['mobile']);
    $address=mysqli_real_escape_string($conn,$_POST['address']);
    $name=$_FILES['profile']['name'];
   $tmp=$_FILES['profile']['tmp_name'];
    $dir="profile";
    $user_id=$_COOKIE['user_id'];
    $username=$_COOKIE['username'];
   if(!is_dir($dir)){
       mkdir($dir,0777,true);
   }
   if(!empty($name)){
       $dest=$dir."/".$name;
       move_uploaded_file($tmp,$dest);
       $update="UPDATE `users` SET `profile`='$dest' WHERE `id`=$user_id";
       $updated=mysqli_query($conn,$update);
       
   }
   #if(empty($product)){
     #  $_SESSION['sell']="please select product(s) you sell";
    #   header('Location:complete');
    #   exit;
  # }
   $insert="INSERT INTO `accounts`(`username`,`user_id`,`account_type`,`business_name`,`products`,`mail`,`mobile`,`address`,`minimum_order`) VALUES('$username',$user_id,'seller','$business','$product','$mail','$mobile','$address',$minimum_order)";
   $inserted=mysqli_query($conn,$insert);
   if($inserted){
         $update="UPDATE `users` SET `account_type`='seller',`latitude`='$latitude',`longitude`='$longitude' WHERE `id`=$user_id";
       $updated=mysqli_query($conn,$update);
       header('Location:/');
       exit;
   }
   else{
       echo mysqli_error($conn);
   }
}



?>