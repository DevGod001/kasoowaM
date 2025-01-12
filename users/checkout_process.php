<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors",1);

include_once 'connect.php';
include_once 'haversine.php';
include_once 'vendor/autoload.php';
$dotenv=Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv -> load();
$secret_key = $_ENV['FLWV_SECRET'];

$amount = $_SESSION['amount'] ?? null;
$currency = $_SESSION['currency'] ?? null;
$user_id = $_COOKIE['user_id'];
$cart_id = $_COOKIE['cart_id'];

// Retrieve transaction_id from URL parameters
$transaction_id = $_GET['transaction_id'] ?? null;
$trx_id = uniqid("trx_");
if(!isset($_SESSION['type'])){
    header('Location:cart');
    exit;
}

    $type=$_SESSION['type'];
    

if ($transaction_id) {
    // Verify the transaction with Flutterwave using transaction_id
    $url = "https://api.flutterwave.com/v3/transactions/{$transaction_id}/verify";
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $secret_key,
        'Content-Type: application/json'
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    if ($response === false) {
        die('Curl error: ' . curl_error($ch));
    }

    $response_data = json_decode($response, true);

    // Check if the transaction was successful
    if (isset($response_data['status']) && $response_data['status'] == 'success') {
        $payment_status = $response_data['data']['status'];
        $payment_amount = $response_data['data']['amount'];
       $amount=$payment_amount;
        // Confirm the payment amount matches what was intended
        if ($payment_status == 'successful') {
            echo "Payment was successful!";
            $delivery_option=$_SESSION['delivery_option'];
            
            // Successful payment
            if($type == "store"){
                
                $sid=$_SESSION['store_id'];
                $select = "SELECT * FROM `cart` WHERE `uniqid`='$cart_id' AND `store_id`=$sid";
                $delete="DELETE FROM `cart` WHERE `uniqid`='$cart_id' AND `store_id`=$sid";
            }
             else{
                  $select = "SELECT * FROM `cart` WHERE `uniqid`='$cart_id'";
                  $delete = "DELETE FROM `cart` WHERE `uniqid`='$cart_id'";
             }
            
            
           
            $selected = mysqli_query($conn, $select);
            
            while ($fetch = mysqli_fetch_assoc($selected)) {
                $uniqid = uniqid("ord_");
                $photo = $fetch['product_photo'];
                $product = $fetch['product_title'] . " - " . $fetch['size'] . $fetch['unit'];
                $product_id = $fetch['product_id'];
                $cost = $fetch['product_cost'];
                $quantity = $fetch['quantity'];
                $final = $cost * $quantity;
                $currency=$fetch['currency'];
               $store_id=$fetch['store_id'];
               $miles=$fetch['miles'];
               $select_country="SELECT `users`.*,`accounts`.`address` FROM `users` JOIN `accounts` ON `accounts`.`user_id`=`users`.`id` WHERE `users`.`id`=$user_id";
               $country_selected=mysqli_query($conn,$select_country);
               $country_fetch=mysqli_fetch_assoc($country_selected);
               $country=$country_fetch['country'];
               $address=$country_fetch['address'];
               
              $fees=mile_fees($country);
              $fees=json_decode($fees,true);
              $fee=$fees['fee'];
              $fixed=$fees['fixed'];
              $delivery_fee=($fee + $miles) * $fixed;
              
                $insert = "INSERT INTO `orders`(`uniqid`, `photo`, `product`, `product_id`, `user_id`, `cost`,`currency`, `status`, `quantity`,`delivery_option`,`store_id`,`delivery_fee`,`delivery_address`) VALUES ('$uniqid', '$photo', '$product', $product_id, $user_id, $final,'$currency', 'in progress', $quantity,'$delivery_option',$store_id,$delivery_fee,'$address')";
                $inserted = mysqli_query($conn, $insert);
                $update="UPDATE `products` SET `in_stock`=in_stock - $quantity WHERE `id`=$product_id";
            $updated=mysqli_query($conn,$update);
            
            }

            // Delete items from the cart
            
            $deleted = mysqli_query($conn, $delete);
            
            

            if ($deleted) {
                // Insert transaction record
                $insert = "INSERT INTO `transactions`(`amount`, `currency`, `key`, `type`, `user_id`, `status`, `gateway`) VALUES ($amount, '$currency', '$trx_id', 'checkout', $user_id, 'success', 'flutterwave')";
                $inserted = mysqli_query($conn, $insert);

                if ($inserted) {
                    unset($_SESSION['amount']);
                    unset($_SESSION['tx_ref']);
                    unset($_SESSION['currency']);
                    header('Location: orders');
                    exit;
                }
            }
            // closing of successful payment
        } else {
            echo "Payment was not successful or amount mismatch.";
            // Unsuccessful payment
            $insert = "INSERT INTO `transactions`(`amount`, `currency`, `key`, `type`, `user_id`, `status`, `gateway`) VALUES ($amount, '$currency', '$trx_id', 'checkout', $user_id, 'failed', 'flutterwave')";
            $inserted = mysqli_query($conn, $insert);
            if ($inserted) {
                unset($_SESSION['amount']);
                unset($_SESSION['tx_ref']);
                unset($_SESSION['currency']);
                header('Location: orders');
                exit;
            }
        }
    } else {
        echo "Transaction verification failed: " . $response_data['message'];
        unset($_SESSION['amount']);
        unset($_SESSION['tx_ref']);
        unset($_SESSION['currency']);
        header('Location: orders');
        exit;
    }
} else {
    echo "Invalid transaction ID.";
    unset($_SESSION['amount']);
    unset($_SESSION['tx_ref']);
    unset($_SESSION['currency']);
    header('Location: orders');
    exit;
}

?>
