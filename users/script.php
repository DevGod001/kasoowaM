<?php
error_reporting(E_ALL);
ini_set('display_errors',1); 

// function to calculate fetch miles individually from database
function fetch_miles($conn,$id){
  
    $cart_id=$_COOKIE['cart_id'];
    $select="SELECT * FROM `cart` WHERE `uniqid`='$cart_id' AND `store_id`=$id GROUP BY `store_id`";
    $selected=mysqli_query($conn,$select);
   
    if($selected){
        $fetch=mysqli_fetch_assoc($selected);
        $miles=$fetch['miles'];
    }
    return $miles;
   
}

//echo fetch_miles();

?>