<?php
error_reporting(E_ALL);
ini_set("display_errors",1);
session_start();
include_once 'connect.php';
include_once 'haversine.php';
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




if(isset($_GET['address'])){
    $address=$_GET['address'];
   $coordinates=here($address);
   
   if(str_contains($coordinates,"error")){
       echo "error";
   } 
    else{
   $data=json_decode($coordinates,true);
  $longitude=$data['longitude'];
  $latitude=$data['latitude'];
  $_SESSION['longitude']=$longitude;
  $_SESSION['latitude']=$latitude;
   echo "success";
    }
}
if(isset($_POST['update_address'])){
    $user_id=$_COOKIE['user_id'];
    $address=mysqli_real_escape_string($conn,$_POST['update_address']);
    $country=mysqli_real_escape_string($conn,$_POST['country']);
    $address=str_replace('.',",",$address);
    $address=str_replace(', ,',",",$address);
    $country=str_replace('_'," ",$country);
    $query=$address." ".$country;
    
   $coordinates=here($query);
   if(str_contains($coordinates,'error')){
       echo "Invalid address,please check and make sure you are following the correct address format wiithout spelling and punctuation errors";
       exit;
   }
    else{
   $result=json_decode($coordinates,true);
   $latitude=round($result['latitude'],4);
   $longitude=round($result['longitude'],4);
   $update="UPDATE `users` SET `longitude`='$longitude',`latitude`='$latitude' WHERE `id`=$user_id";
   $updated=mysqli_query($conn,$update);
   if($updated){
  
   $update="UPDATE `accounts` SET `address`='$address' WHERE `user_id`=$user_id";
   $updated=mysqli_query($conn,$update);
   if($updated){
       $cart_id=$_COOKIE['cart_id'];
       $select="SELECT * FROM `cart` WHERE `uniqid`='$cart_id'";
       $selected=mysqli_query($conn,$select);
       if($selected){
          while($fetch=mysqli_fetch_assoc($selected)){
              $sid=$fetch['store_id'];
              $get="SELECT * FROM `users` WHERE `id`=$sid";
              $gotten=mysqli_query($conn,$get);
              if($gotten){
                  $carry=mysqli_fetch_assoc($gotten);
                  $lat1=$carry['latitude'];
                  $lng1=$carry['longitude'];
                
                  $response=haversineDistance($latitude,$longitude,$lat1,$lng1);
                  $change="UPDATE `cart` SET `miles`='$response' WHERE `uniqid`='$cart_id'";
                  $changed=mysqli_query($conn,$change);
                  if($changed){
                      $delete="DELETE FROM `cart` WHERE `miles`='error'";
                      $deleted=mysqli_query($conn,$delete);
                      if(!$deleted){
                          echo "error";
                          exit;
                      }
                      
                  }
                   else{
                       echo "error";
                       exit;
                   }
                  
              }
             // echo $sid;
          }
        
          
       }
       
       
      
       echo "success";
       exit;
   }
    else{
        echo "error";
        exit;
    }
    }
    }
}
?>