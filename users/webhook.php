<?php
session_start();
// Webhook Listener (e.g., webhook.php)
$_SESSION['webhook']="helcim";
// Retrieve raw POST data
$rawPayload = file_get_contents('php://input');
$headers = getallheaders();

// Log headers and payload (for debugging purposes only)
file_put_contents('webhook-log.txt', json_encode($headers) . "\n" . $rawPayload, FILE_APPEND);

// Decode the payload
$payload = json_decode($rawPayload, true);

// Verify required fields
if (isset($payload['id'], $payload['type']) && $payload['type'] === 'cardTransaction') {
    // Extract the transaction ID
    $transactionId = $payload['id'];

    // Example: Update order in the database, log success, or notify the user
    file_put_contents('webhook-log.txt', "Payment Success. Transaction ID: $transactionId\n", FILE_APPEND);

    // Optionally redirect the user
    header("Location:helcim_process.php");
    exit;
} else {
    // Invalid payload
    http_response_code(400);
    echo "Invalid webhook data.";
     header("Location:helcim_process.php");
    exit;
}
?>
