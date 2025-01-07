<?php
session_start();
include_once 'connect.php';
if(isset($_GET['verify_mail'])){
$mail=mysqli_real_escape_string($conn,$_GET['mail']);
echo $mail;

}

?>