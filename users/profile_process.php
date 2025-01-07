<?php
error_reporting(E_ALL);
ini_set("display_errors",1);
session_start();
include_once 'connect.php';
$user_id=$_COOKIE['user_id'];
if(isset($_POST['current'])){
    $current=mysqli_real_escape_string($conn,$_POST['current']);
    $new=mysqli_real_escape_string($conn,$_POST['new']);
   $confirm=mysqli_real_escape_string($conn,$_POST['confirm']);
   $new=password_hash($new,PASSWORD_DEFAULT);
    $select="SELECT * FROM `users` WHERE `id`=$user_id";
   $selected=mysqli_query($conn,$select);
   $fetch=mysqli_fetch_assoc($selected);
   $pass=$fetch['password'];
   if(!password_verify($current,$pass)){
       echo "invalid current password";
       exit;
   }
   
   if(!password_verify($confirm,$new)){
       echo "new password and confirm password must match";
       exit;
   }
  $update="UPDATE `users` SET `password`='$new' WHERE `id`=$user_id";
  $updated=mysqli_query($conn,$update);
  if($updated){
      echo "account password changed successfully";
      exit;
  }
    else{
        echo "error changing password";
        exit;
    }
  
}

if(isset($_POST['upload'])){
    $name=$_FILES['photo']['name'];
    $tmp=$_FILES['photo']['tmp_name'];
    $dest="photos/".$name;
    if(move_uploaded_file($tmp,$dest)){
        $update="UPDATE `users` SET `profile`='$dest' WHERE `id`=$user_id";
        $updated=mysqli_query($conn,$update);
        if($updated){
            echo "$dest";
            exit;
        }
         else{
             echo "error";
         }
    }
     else{
         echo "error";
     }
}


?>