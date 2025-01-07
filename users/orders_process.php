<?php
session_start();
include_once 'connect.php';
if(isset($_GET['received'])){
    $id=mysqli_real_escape_string($conn,$_GET['id']);
    $select="SELECT * FROM `orders` WHERE `id`=$id"; 
    $selected=mysqli_query($conn,$select);
    $fetch=mysqli_fetch_assoc($selected);
    $delivery_option=$fetch['delivery_option'];
    if(str_contains($delivery_option,"doorstep")){
        $out_for_delivery=$fetch['out_for_delivery'];
        if(empty($out_for_delivery)){
            echo "you cannot mark an order as delivered when it is not yet out for delivery";
            exit;
        }
     
    }
     else{
         $update="UPDATE `orders` SET `out_for_delivery`=NOW() WHERE `id`=$id";
         $updated=mysqli_query($conn,$update);
     }
   
   $update="UPDATE `orders` SET `status`='delivered',`delivered`=NOW() WHERE `id`=$id";
   $updated=mysqli_query($conn,$update);
   if($updated){
       echo "success";
       exit;
   }
    else{
        echo "error";
        exit;
    }
}




?>