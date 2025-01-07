<?php
// Your private API key from Helcim
$privateKey = '1cc74834c0007e003361dfc03be37a83115e8dc5';  // Replace with your actual private API key

// Directly set the payment details as variables
$cardNumber = '5369020015181946';  // Example card number (replace with actual card number)
$expiryDate = '12/25';             // Card expiry date in MM/YY format
$cvv = '123';                      // CVV number
$amount = 10.00;                   // Amount in USD (e.g., $10.00)

// Split the expiry date to get the month and year
$expiry = explode('/', $expiryDate);
$expMonth = trim($expiry[0]);
$expYear = trim($expiry[1]);

// Amount must be in cents, so multiply by 100
$amountInCents = $amount * 100;  // e.g., $10.00 becomes 1000 cents

// Prepare payment data to send to Helcim API
$paymentData = [
    'amount' => $amountInCents,  // Amount in cents
    'currency' => 'USD',         // Currency (USD for US dollars)
    'card' => [
        'number' => $cardNumber,   // Card number
        'expMonth' => $expMonth,   // Expiry month 
        'expYear' => $expYear,     // Expiry year
        'cvc' => $cvv              // CVV
    ],
    'description' => 'Payment for Order #123'  // Custom order description
];

// Updated Helcim API endpoint (check documentation for the correct one)
$helcimUrl = 'https://api.helcim.com/v2/payment/purchase';  // Make sure this endpoint is correct

// Initialize cURL to send the request to Helcim API
$ch = curl_init($helcimUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $privateKey,  // Use the private key to authenticate
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($paymentData));

// Execute cURL request
$response = curl_exec($ch);

// Check for cURL errors
if ($response === false) {
    die('Error with cURL: ' . curl_error($ch));
}

// Get HTTP status code
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Decode the response from Helcim API
$responseData = json_decode($response, true);

// Output the HTTP status code and response data for debugging
echo 'HTTP Status Code: ' . $httpCode . '<br>';
echo '<pre>';
print_r($responseData);
echo '</pre>';

// Check the status of the payment
if ($httpCode === 200 && isset($responseData['status']) && $responseData['status'] === 'success') {
    echo 'Payment Successful!';
} else {
    echo 'Payment Failed: ' . (isset($responseData['message']) ? $responseData['message'] : 'Unknown error');
}
?>
