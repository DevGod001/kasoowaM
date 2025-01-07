<?php
session_start();
include_once 'connect.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
    $longitude=mysqli_real_escape_string($conn,$_POST['longitude']);
    $latitude=mysqli_real_escape_string($conn,$_POST['latitude']);
    $user_id=$_COOKIE['user_id'];
   $update="UPDATE `users` SET `longitude`='$longitude',`latitude`='$latitude' WHERE `id`=$user_id";
   $updated=mysqli_query($conn,$update);
   if($updated){
       echo "success";
       exit;
   }
}



?>