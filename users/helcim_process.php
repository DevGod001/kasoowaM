<?php
error_reporting(E_ALL);
ini_set("display_errors",1);
session_start();
include_once 'connect.php';
$user_id=$_COOKIE['user_id'];
$cart_id=$_COOKIE['cart_id'];
if(isset($_GET['helcim_id'])){
$helcim_get=$_GET['helcim_id'];
$helcim_session=$_SESSION['helcim_id'];
if($helcim_get !== $helcim_session){
    header("Location:orders");
    exit;
}
    $transaction_id=uniqid("trx");
    $payer_name=$_SESSION['name'];
   $amount=$_SESSION['amount'];
   $currency=$_SESSION['currency'];
   
    $select="SELECT * FROM `cart` WHERE `uniqid`='$cart_id'"; 
    $selected=mysqli_query($conn,$select);
    $row=mysqli_num_rows($selected);
   
   if($row > 0){
       while($fetch=mysqli_fetch_assoc($selected)){
           $cost=$fetch['product_cost'];
           $id=$fetch['id'];
           $uniqid=uniqid("ord_");
           $photo=$fetch['product_photo'];
           $product=$fetch['product_title']." - ".$fetch['size'].$fetch['unit'];
           $product_id=$fetch['product_id'];
           $currency=$fetch['currency'];
           $quantity=$fetch['quantity'];
           $insert="INSERT INTO `orders`(`uniqid`,`photo`,`product`,`product_id`,`user_id`,`cost`,`currency`,`quantity`,`status`) VALUES('$uniqid','$photo','$product',$product_id,$user_id,$cost,'$currency',$quantity,'in progress')";
           $inserted=mysqli_query($conn,$insert);
           if($inserted){
               $delete="DELETE FROM `cart` WHERE `id`=$id";
               $deleted=mysqli_query($conn,$delete);
                $update="UPDATE `products` SET `in_stock` = in_stock - $quantity WHERE `id`=$product_id";
            $updated=mysqli_query($conn,$update);
            
               
           }
           
       }
      

       $trx_id=uniqid("trx_");
         $insert = "INSERT INTO `transactions`(`amount`, `currency`, `key`, `type`, `user_id`, `status`, `gateway`) VALUES ($amount, '$currency', '$trx_id', 'checkout', $user_id, 'success', 'helcim')";
                $inserted = mysqli_query($conn, $insert);
                if($inserted){
                    unset($_SESSION['helcim_id']);
                    header("Location:orders");
                    exit;
                }

   }
    else{
        echo "you have no product in cart";
        unset($_SESSION['helcim_id']);
        header("Location:orders");
        exit;
    }

}
   else{
       echo "invalid response";
       header("Location:orders");
       exit;
   }




?>