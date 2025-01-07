<?php
// Start session
session_start();
include_once 'connect.php';

// Ensure the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location:cart');
    exit;
}

// Validate cookies for user and cart IDs
if (!isset($_COOKIE['user_id']) || !isset($_COOKIE['cart_id'])) {
    die("Session expired. Please log in again.");
}

$user_id = $_COOKIE['user_id'];
$cart_id = $_COOKIE['cart_id'];

// If POST request, retrieve and sanitize input
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $discount = mysqli_real_escape_string($conn, $_POST['discount']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $_SESSION['address'] = $address;

    // Calculate total amount
    $select = "SELECT SUM(product_cost * quantity) AS total FROM cart WHERE uniqid='$cart_id'";
    $selected = mysqli_query($conn, $select);
    $fetch = mysqli_fetch_assoc($selected);
    $total = $fetch['total'];

    if (!empty($discount)) {
        $amount = $total - ($discount * $total) / 100;
    } else {
        $amount = $total;
    }

    $amount = $amount + (5 * $total) / 100; // Add 5% tax or fee
}

// Fetch currency and user details
$select = "SELECT * FROM users WHERE id=$user_id";
$selected = mysqli_query($conn, $select);

if (mysqli_num_rows($selected) > 0) {
    $fetch = mysqli_fetch_assoc($selected);
    $currency = $fetch['currency'];

    // Map currency symbols to codes
    switch ($currency) {
        case "&#8358":
            $curr = "NGN";
            break;
        case "$":
            $curr = "USD";
            break;
        case "&#163":
            $curr = "GBP";
            break;
        case "&#8353":
            $curr = "GHC";
            break;
        case "XAF":
            $curr = "XAF";
            break;
        default:
            $curr = "NGN";
            break;
    }

    $name = $fetch['full_name'];
    $mail = $fetch['mail'];
    $country = $fetch['country'];

    switch ($country) {
        case "united_states":
            $cou = "USA";
            break;
        case "canada":
            $cou = "CAN";
            break;
        default:
            $cou = "USA";
            break;
    }

    // Retrieve user account address
    $get = "SELECT * FROM accounts WHERE user_id=$user_id";
    $gotten = mysqli_query($conn, $get);
    $carry = mysqli_fetch_assoc($gotten);
    $address = $carry['address'];
    $address = explode(",", $address);

    $street = $address[0];
    $city_count = max(0, count($address) - 3);
    $city = $address[$city_count];
    $zip_count = max(0, count($address) - 2);
    $zip_code = $address[$zip_count];
}

// Prepare and send the API request
$curl = curl_init();

$payload = [
    'paymentType' => 'purchase',
    'paymentMethod' => 'cc-ach',
    'hasConvenienceFee' => 1,
    'amount' => number_format($amount, 2, '.', ''), // Ensure proper decimal formatting
    'currency' => $curr,
    'customerRequest' => [
        'contactName' => $name ?: "Unknown",
        'cellPhone' => '123-456-7890',
        'billingAddress' => [
            'name' => $name,
            'street1' => $street,
            'city' => $city ?: "Unknown City",
            'province' => 'AB', // Adjust province/state as needed
            'country' => $cou,
            'postalCode' => $zip_code,
            'phone' => '1234567890',
            'email' => $mail ?: "unknown@example.com"
        ]
    ]
];

curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.helcim.com/v2/helcim-pay/initialize",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($payload),
    CURLOPT_HTTPHEADER => [
        "accept: application/json",
        'api-token: ak-JB_KB6ot4r4kxyIKzhvY0Q$MZjm7_SCay#e4$D6vlR17dzzn6Xwiyp9_Jj2*C', // Replace with your real token
        "content-type: application/json"
    ]
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    error_log("cURL Error: $err");
    die("Payment processing failed. Please try again.");
} else {
    $responseData = json_decode($response, true);

    if (isset($responseData['checkoutToken'])) {
        $_SESSION['response'] = $responseData['checkoutToken'];
        header("Location: https://secure.helcim.app/helcim-pay/" . $responseData['checkoutToken']);
        exit;
    } else {
        error_log("Helcim API Error Response: " . $response);
        die("Transaction could not be processed. Contact support.");
    }
}
?>