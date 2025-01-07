<?php
session_start(); // Start the session

// Configuration
$public_key = 'FLWPUBK_TEST-4e0e7f3fe8e45c5229661e1e5ebc565a-X';
$secret_key = 'FLWSECK_TEST-fb39fd889e6cba4b06a92c88905d5377-X';

// Generate a unique transaction reference
$tx_ref = 'txn_' . uniqid();
$amount = $_SESSION['amount']; // Amount to be charged
// create my url
$url=$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/users/pay_promotion_process.php';
// Save tx_ref and amount in session for later use
$_SESSION['tx_ref'] = $tx_ref;
$_SESSION['amount'] = $amount;

$currency = $_SESSION['currency'];
$email = $_SESSION['mail'];
$phone_number = "09013350351";

// Prepare the payment request
$data = [
    'tx_ref' => $tx_ref,
    'amount' => $amount,
    'currency' => $currency,
    'redirect_url' => $url, // Redirect URL after payment
    'customer' => [
        'email' => $email,
        'phonenumber' => $phone_number,
        'name' => 'Customer Name'
    ]
];

$ch = curl_init('https://api.flutterwave.com/v3/payments');

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $secret_key,
    'Content-Type: application/json'
]);

$response = curl_exec($ch);

if ($response === false) {
    echo 'Curl error: ' . curl_error($ch);
    curl_close($ch);
    exit();
}

curl_close($ch);

// Decode the response
$response_data = json_decode($response, true);

// Check for successful response and redirect to the payment link
if (isset($response_data['data']['link'])) {
    header("Location: " . $response_data['data']['link']);
    exit();
} else {
    echo "Payment initiation failed: " . $response_data['message'];
}
?>
