<?php
session_start(); // Start the session
$secret_key = 'FLWSECK_TEST-fb39fd889e6cba4b06a92c88905d5377-X';

// Retrieve the tx_ref and amount from the session
$tx_ref = $_SESSION['tx_ref'] ?? null;
$amount = $_SESSION['amount'] ?? null;

if ($tx_ref) {
    // Verify the transaction with Flutterwave
    $url = "https://api.flutterwave.com/v3/transactions/{$tx_ref}/verify";
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
            // Here, save transaction details in the database or take any other action needed
        } else {
            echo "Payment was not successful or amount mismatch.";
        }
    } else {
        echo "Transaction verification failed: " . $response_data['message'];
    }
} else {
    echo "Invalid transaction reference.";
}
?>
