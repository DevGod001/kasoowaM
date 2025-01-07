<?php
session_start();
include_once 'connect.php';
$secret_key = 'FLWSECK_TEST-fb39fd889e6cba4b06a92c88905d5377-X';
$amount = $_SESSION['amount'] ?? null;
$key = $_SESSION['ad_key'] ?? null;
$currency = $_SESSION['currency'] ?? null;
$user_id=$_COOKIE['user_id'];
// Retrieve transaction_id from URL parameters
$transaction_id = $_GET['transaction_id'] ?? null;
$trx_id=uniqid("trx_");
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

        // Confirm the payment amount matches what was intended
        if ($payment_status == 'successful' && $payment_amount == $amount) {
            echo "Payment was successful!";
            echo $key;
            // Here, save transaction details in the database or take any other action needed
            $update="UPDATE `products` SET `status`='active',`featured`='true' WHERE `user_id`=$user_id AND `key`='$key'";
            $updated=mysqli_query($conn,$update);
            if($updated){
                $insert="INSERT INTO `transactions`(`amount`,`currency`,`key`,`type`,`user_id`,`status`,`gateway`) VALUES($amount,'$currency','$trx_id','promotion',$user_id,'success','flutterwave')";
                $inserted=mysqli_query($conn,$insert);
                if($inserted){
                    unset($_SESSION['amount']);
        unset($_SESSION['tx_ref']);
        unset($_SESSION['ad_key']);
        unset($_SESSION['currency']);
                    header('Location:history');;
                    exit;
                }
            }
            
            
        } else {
            echo "Payment was not successful or amount mismatch.";
            $insert="INSERT INTO `transactions`(`amount`,`currency`,`key`,`type`,`user_id`,`status`,`gateway`) VALUES($amount,'$currency','$trx_id','promotion',$user_id,'failed','flutterwave')";
                $inserted=mysqli_query($conn,$insert);
            unset($_SESSION['amount']);
        unset($_SESSION['tx_ref']);
        unset($_SESSION['ad_key']);
        unset($_SESSION['currency']);
        header('Location:history');;
                    exit;
        }
    } else {
        echo "Transaction verification failed: " . $response_data['message'];
        unset($_SESSION['amount']);
        unset($_SESSION['tx_ref']);
        unset($_SESSION['ad_key']);
        unset($_SESSION['currency']);
        header('Location:history');;
                    exit;
    }
} else {
    echo "Invalid transaction ID.";
     unset($_SESSION['amount']);
        unset($_SESSION['tx_ref']);
        unset($_SESSION['ad_key']);
        unset($_SESSION['currency']);
        header('Location:history');;
                    exit;
}
