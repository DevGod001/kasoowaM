<?php
session_start();
include_once 'connect.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
    $longitude=mysqli_real_escape_string($conn,$_POST['longitude']);
    $latitude=mysqli_real_escape_string($conn,$_POST['latitude']);
    if(!empty($longitude) && !empty($latitude)){
        $_SESSION['longitude']=$longitude;
        $_SESSION['latitude']=$latitude;
       echo "success";
        
        exit;
    }
     else{
         echo "error";
         exit;
     }
}



?>