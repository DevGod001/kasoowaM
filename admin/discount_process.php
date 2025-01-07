<?php
error_reporting(E_ALL);
ini_set("display_errors",1);
session_start();
include_once 'connect.php';
if(isset($_POST['create'])){
    $name=mysqli_real_escape_string($conn,$_POST['name']);
    $code=mysqli_real_escape_string($conn,$_POST['code']);
    $percentage=mysqli_real_escape_string($conn,$_POST['percentage']);
    $limit=mysqli_real_escape_string($conn,$_POST['limit']);
    $minimum_checkout=mysqli_real_escape_string($conn,$_POST['minimum_checkout']);
    $status="active";
    if(empty($name) || empty($code) || empty($percentage) || empty($limit) || empty($minimum_checkout)){
        $_SESSION['notice']="please click the generate button to generate a code";
        header('Location:discount');
        exit;
    }
    $insert="INSERT INTO `discount`(`name`,`code`,`percentage`,`limit`,`redeemed`,`minimum_checkout`,`status`) VALUES('$name','$code',$percentage,$limit,0,$minimum_checkout,'$status')";
    $inserted=mysqli_query($conn,$insert);
    if($inserted){
        header('Location:discount');
        exit;
    }
}
if(isset($_GET['pause'])){
   $id= mysqli_real_escape_string($conn,$_GET['id']);
    $select="SELECT * FROM `discount` WHERE `id`=$id";
    $selected=mysqli_query($conn,$select);
    $fetch=mysqli_fetch_assoc($selected);
    $status=$fetch['status'];
    if($status == "active"){
        $update="UPDATE `discount` SET `status`='paused' WHERE `id`=$id AND `status`='active'";
        $updated=mysqli_query($conn,$update);
        if($updated){
            echo "paused";
            exit;
        }
         else{
             echo "error";
         }
    }
     else{
         if($status == 'paused'){
              $update="UPDATE `discount` SET `status`='active' WHERE `id`=$id AND `status`='paused'";
        $updated=mysqli_query($conn,$update);
        if($updated){
            echo "active";
            exit;
        }
         else{
             echo "error";
         }
         }
     }
}
if(isset($_GET['delete_row'])){
    $id=mysqli_real_escape_string($conn,$_GET['id']);
   $delete="DELETE FROM `discount` WHERE `id`=$id";
   $deleted=mysqli_query($conn,$delete);
   if($deleted){
       echo "success";
   }
    else{
        echo "error";
    }
}


?>