<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require 'vendor/autoload.php';  // Include the PayPal SDK autoloader

// PayPal API credentials
$clientId = 'AcAfG7zScqqyXGLrFKzZilD84bwYvEbIp54cEhudjVXUvSDipJpeqqQhQbx4YRnf1MtL8E4p51e1ry55';
$secret = 'EIyeFhxHNqH8tfOr_gh2CVoAhCajiGZREhDpYl2q063JFr5OXGx8WO-gEgeeT1IOeUW7HvH_hcHuueb7';

// Create PayPal environment (use LiveEnvironment for production)
$environment = new \PayPalCheckoutSdk\Core\SandboxEnvironment($clientId, $secret);
$client = new \PayPalCheckoutSdk\Core\PayPalHttpClient($environment);

// Set up the payment details
$request = new \PayPalCheckoutSdk\Orders\OrdersCreateRequest();
$request->prefer('return=representation');

// Payment details
$request->body = [
    "intent" => "CAPTURE",
    "purchase_units" => [
        [
            "amount" => [
                "currency_code" => "USD",
                "value" => "50.00"  // Total payment amount (example: $50)
            ]
        ]
    ],
    "application_context" => [
        "return_url" => "http://yourdomain.com/execute_payment.php?success=true",
        "cancel_url" => "http://yourdomain.com/execute_payment.php?success=false"
    ]
];

try {
    // Execute the payment request
    $response = $client->execute($request);
    
    // Get the approval link from the response
    $approvalUrl = $response->result->links[1]->href;  // Index 1 is the "approval_url"
    
    // Redirect user to PayPal
    header("Location: " . $approvalUrl);
    exit();
} catch (Exception $ex) {
    // Handle error
    echo "Error: " . $ex->getMessage();
}
?>
