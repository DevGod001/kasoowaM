<?php 
//error_reporting(E_ALL);
//ini_set("display_errors",1);
session_start();
include_once 'connect.php';
 
    if(isset($_COOKIE['cart_id'])){
   $uniqid=$_COOKIE['cart_id'];
    }
     else{
         $uniqid="ASDFGHJKLKJHGFDSAWSERTYU";
     }

if(isset($_GET['location'])){
    $location=$_GET['location'];
    switch(strtolower($location)){
        case 'nigeria':
            $country="nigeria"; 
            break;
        case 'cameroon':
            $country="cameroon";
            break;
        case 'united states':
            $country="united_states";
            break;
        case 'ghana':
            $country="ghana";
            break;
        case 'united kingdom':
           $country="united_kingdom";
            break;
        case 'canada':
            $country="canada";
            break;
        default:
            $country=$location;
            break;
    }
   
    if(!isset($_COOKIE['ip'])){
    if(setcookie("ip",$country,time()+31536000)){
        echo "success";
        exit;
    }
    else{
        echo "error";
        exit;
    }
    
    }
     else{
         echo "set";
         exit;
     }
}



if($_SERVER['REQUEST_METHOD']=='POST'){
    $currency=mysqli_real_escape_string($conn,$_POST['currency']);
    $product_id=mysqli_real_escape_string($conn,$_POST['product_id']);
    $product_title=mysqli_real_escape_string($conn,$_POST['product_title']);
    $product_photo=mysqli_real_escape_string($conn,$_POST['product_photo']);
    $product_cost=mysqli_real_escape_string($conn,$_POST['product_cost']);
    $quantity=mysqli_real_escape_string($conn,$_POST['quantity']);#loop through
    $unit=mysqli_real_escape_string($conn,$_POST['unit']);
    $size=mysqli_real_escape_string($conn,$_POST['size']);
    $uniqid=$_COOKIE['cart_id'];
    $select="SELECT * FROM `cart` WHERE `uniqid`='$uniqid'";
    $selected=mysqli_query($conn,$select);
    $row=mysqli_num_rows($selected);
    $max=$row+$quantity;
    $miles=mysqli_real_escape_string($conn,$_POST['miles']);
   if(str_contains($miles,'error')){
       echo "error! To shop from Kasoowa, ensure your address is correct. We couldn't verify the distance to the store. Please update your address in the accounts section and try again. If the issue persists, contact our support team.";
       exit;
   }
    if($max >= 50){
        echo "error! you have 50 items in cart already,kindly checkout to add more";
             exit;
    }
    $select="SELECT * FROM `products` WHERE `id`=$product_id AND `status`='active'";
    $selected=mysqli_query($conn,$select);
   
    $row=mysqli_num_rows($selected);
    $select_cart="SELECT SUM(quantity) AS `total` FROM `cart` WHERE `uniqid`='$uniqid' AND `product_id`=$product_id";
    $cart_selected=mysqli_query($conn,$select_cart);
    $cart_fetch=mysqli_fetch_assoc($cart_selected);
    $in_cart=$cart_fetch['total'];
    if($row > 0){
         $fetch=mysqli_fetch_assoc($selected);
         $in_stock=$fetch['in_stock'];
        $store_id=$fetch['user_id'];
       
         if($quantity > $in_stock){
             $next_stock=$in_stock - $in_cart;
             if($next_stock == 0){
                 echo "error! out of stock";
             exit;
             }
             echo "error! there are currently $next_stock of this product in stock";
             exit;
         }
    }
    $select="SELECT SUM(`quantity`) + $quantity AS `total` FROM `cart` WHERE `product_id`=$product_id AND `uniqid`='$uniqid'";
    $selected=mysqli_query($conn,$select);
    $fetch=mysqli_fetch_assoc($selected);
    $total=$fetch['total'];
     $next_stock=$in_stock - $in_cart; 
    if($total > $in_stock){
         echo "error! there are currently $next_stock of this product in stock";
             exit;
    }
    
        $insert="INSERT INTO `cart`(`product_id`,`product_title`,`product_photo`,`product_cost`,`status`,`currency`,`uniqid`,`size`,`unit`,`quantity`,`miles`,`store_id`) VALUES($product_id,'$product_title','$product_photo',$product_cost,'active','$currency','$uniqid',$size,'$unit',$quantity,'$miles',$store_id)"; 
        $inserted=mysqli_query($conn,$insert);
        if($inserted){
           
               echo $quantity;
           
        }
         else{
             echo "error";
             exit;
         }
    
}
if(isset($_GET['get_max'])){
   $pid=$_GET['pid'];
  $select="SELECT SUM(quantity) AS `total` FROM `cart` WHERE `product_id`=$pid AND `uniqid`='$uniqid'";
  $selected=mysqli_query($conn,$select);
  $fetch=mysqli_fetch_assoc($selected);
  $total=$fetch['total'];
  if(empty($total)){
      $total=0;
  }
  $select="SELECT * FROM `products` WHERE `id`=$pid";
  $selected=mysqli_query($conn,$select);
  $fetch=mysqli_fetch_assoc($selected);
  $instock=$fetch['in_stock'];
  $remaining=$instock - $total;
  
  $return=[
      "status" => "success",
      "remaining" => $remaining,
      "in_stock" => $instock,
      "in_cart" => $total
      ];
      echo json_encode($return,true);
  
}
if(isset($_GET['get_in_stock'])){
    $pid=$_GET['pid'];
    $select="SELECT * FROM `products` WHERE `id`=$pid";
    $selected=mysqli_query($conn,$select);
    $fetch=mysqli_fetch_assoc($selected);
    $in_stock=$fetch['in_stock'];
   $select="SELECT SUM(quantity) AS `total` FROM `cart` WHERE `product_id`=$pid AND `uniqid`='$uniqid'";
   $selected=mysqli_query($conn,$select);
   $fetch=mysqli_fetch_assoc($selected);
   $total=$fetch['total'];
   $next=$in_stock - $total;
   if($next == 0){
       $response="Out of Stock";
   }
    else{
        $response=$next." In Stock";
        
    }
    echo $response;
}
?>