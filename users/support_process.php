<?php
session_start();
include_once 'connect.php';
if(isset($_POST['message'])){
    $message=mysqli_real_escape_string($conn,$_POST['message']);
    echo $message;
}



?>