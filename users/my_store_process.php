<?php
error_reporting(E_ALL);
ini_set("display_errors",1);
session_start();
include_once 'connect.php';
$user_id=$_COOKIE['user_id'];
// here function to convert address to coordinates
function here($address){
    $api="eOaqn9xlcUDQ6aZPQS1F4ot8jtwdfK3EyF4UhjH8EKk";
    $address=urlencode($address);
    $url="https://geocode.search.hereapi.com/v1/geocode?q=$address&apiKey=$api";
    $curl=curl_init();
    curl_setopt($curl,CURLOPT_URL,$url);
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
    $response=curl_exec($curl);
    $data=json_decode($response,true);
   
    
    if(isset($data['items'][0]['position']['lat']) && isset($data['items'][0]['position']['lng'])){
        $latitude= $data['items'][0]['position']['lat'];
    $longitude= $data['items'][0]['position']['lng'];
    $return=[
     'latitude' => $latitude,
     'longitude' => $longitude
    ];
}
 else{
     $return="error";
 }
     return json_encode($return);
    curl_close($curl);
}
// submiting form
if($_SERVER['REQUEST_METHOD']=='POST'){
    $name=mysqli_real_escape_string($conn,$_POST['name']);
    $mobile=mysqli_real_escape_string($conn,$_POST['mobile']);
    $minimum_order=mysqli_real_escape_string($conn,$_POST['minimum_order']);
    if(empty($mobile)){
        $mobile=0;
    }
    $mail=mysqli_real_escape_string($conn,$_POST['mail']);
    $update="UPDATE `accounts` SET `business_name`='$name',mobile=$mobile,`mail`='$mail',`minimum_order`=$minimum_order WHERE `user_id`=$user_id";
    $updated=mysqli_query($conn,$update);
    if($updated){
        header("Location:store");
        exit;
    }
}
// update address
if(isset($_GET['update_address'])){
    $address=mysqli_real_escape_string($conn,$_GET['address']);
    
    $response=here($address);
    if(str_contains($response,"error")){
        echo "error";
        exit;
    }
   $data=json_decode($response,true);
   $latitude=$data['latitude'];
   $longitude=$data['longitude'];
   $update="UPDATE `accounts` SET `address`='$address' WHERE `user_id`=$user_id";
   $updated=mysqli_query($conn,$update);
   if($updated){
      $update="UPDATE `users` SET `latitude`='$latitude',`longitude`='$longitude' WHERE `id`=$user_id";
      $updated=mysqli_query($conn,$update);
      if($updated){
          echo "success";
      }
   }
}


?>