<?php
session_start();

// Load environment variables
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Configuration - get keys from environment variables
$public_key = $_ENV['FLUTTERWAVE_PUBLIC_KEY'];
$secret_key = $_ENV['FLUTTERWAVE_SECRET_KEY'];

// Generate a unique transaction reference
$tx_ref = 'txn_' . uniqid();
$amount = 5000; // Amount to be charged

// Save tx_ref and amount in session for later use
$_SESSION['tx_ref'] = $tx_ref;
$_SESSION['amount'] = $amount;

// Configuration values - consider moving these to .env as well
$currency = 'NGN';
$email = $_ENV['DEFAULT_EMAIL'] ?? "abakpadavid2003@gmail.com";  // Could be moved to .env
$phone_number = $_ENV['DEFAULT_PHONE'] ?? "091327307993";        // Could be moved to .env
$redirect_url = $_ENV['PAYMENT_REDIRECT_URL'] ?? 
'https://yourwebsite.com/payment-confirmation.php';

// Prepare the payment request
$data = [
    'tx_ref' => $tx_ref,
    'amount' => $amount,
    'currency' => $currency,
    'redirect_url' => $redirect_url,
    'customer' => [
        'email' => $email,
        'phonenumber' => $phone_number,
        'name' => 'Customer Name'
    ]
];

// Initialize cURL request
$ch = curl_init('https://api.flutterwave.com/v3/payments');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $secret_key,
    'Content-Type: application/json'
]);

// Execute the request
$response = curl_exec($ch);

// Handle errors
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
