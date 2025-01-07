<?php
session_start();
include_once 'connect.php';
$user_id=$_COOKIE['user_id'];
if(isset($_POST['delete_id'])){
    $id=mysqli_real_escape_string($conn,$_POST['delete_id']);
   $delete="DELETE FROM `products` WHERE `id`=$id";
   $deleted=mysqli_query($conn,$delete);
   $delete="DELETE FROM `cart` WHERE `product_id`=$id";
   $deleted=mysqli_query($conn,$delete);
    if($deleted){
    echo "success";
    
    }
}

if(isset($_POST['pause_id'])){
    $id=mysqli_real_escape_string($conn,$_POST['pause_id']);
    $initial=mysqli_real_escape_string($conn,$_POST['status']);
   $select="SELECT * FROM `products` WHERE `id`=$id AND `user_id`=$user_id";
   $selected=mysqli_query($conn,$select);
   if($selected){
       $fetch=mysqli_fetch_assoc($selected);
       $status=$fetch['status'];
      if($status == "paused"){
          $update="UPDATE `products` SET `status`='active' WHERE `id`=$id";
          $updated=mysqli_query($conn,$update);
          if($updated){
              echo 'active';
              exit;
          }
      }
       else{
            $update="UPDATE `products` SET `status`='paused' WHERE `id`=$id";
          $updated=mysqli_query($conn,$update);
          if($updated){
              echo 'paused';
              exit;
          }
       }
   }
}



if(isset($_GET['update_stock'])){
    $amount=mysqli_real_escape_string($conn,$_GET['amount']);
    $amount=str_replace('-',"",$amount);
    $id=mysqli_real_escape_string($conn,$_GET['id']);
    
    if(empty($amount)){
    $amount=0;
        
        
    }
     
        $update="UPDATE `products` SET `in_stock`=$amount WHERE `id`=$id";
        $updated=mysqli_query($conn,$update);
        if($updated){
            if($amount == 0){
                $update="UPDATE `products` SET `status`='out of stock' WHERE `id`=$id";
                $updated=mysqli_query($conn,$update);
                $delete="DELETE FROM `cart` WHERE `product_id`=$id";
                $deleted=mysqli_query($conn,$delete);
                echo "out of stock";
            }
             else{
                 
                  $update="UPDATE `products` SET `status`='active' WHERE `id`=$id";
                $updated=mysqli_query($conn,$update);
                echo "active";
             }
        }
     
}



?>