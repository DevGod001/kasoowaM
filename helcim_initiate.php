<?php
error_reporting(E_ALL);
ini_set("display_errors",1);
session_start();
include_once 'connect.php';
if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header('Location:cart');
    exit;
}
// User ID and Cart ID from Cookies
$user_id = $_COOKIE['user_id'];
$cart_id = $_COOKIE['cart_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $discount = mysqli_real_escape_string($conn, $_POST['discount']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $_SESSION['address'] = $address;

    // Calculate Total Amount
    $select = "SELECT SUM(`product_cost` * `quantity`) AS `total` FROM `cart` WHERE `uniqid`='$cart_id'";
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

// Get Currency based on User's Preference
$select = "SELECT * FROM `users` WHERE `id`=$user_id";
$selected = mysqli_query($conn, $select);
if (mysqli_num_rows($selected) > 0) {
    $fetch = mysqli_fetch_assoc($selected);
    $currency = $fetch['currency'];

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
}
$name=$fetch['full_name'];
$mail=$fetch['mail'];
$country=$fetch['country'];
switch($country){
    case "united_states":
    $cou="USA";
    break;
    case "canada":
    $cou="CAN";
    break;
    default:
    $cou="USA";
    break;
}
$get="SELECT * FROM `accounts` WHERE `user_id`=$user_id";
$gotten=mysqli_query($conn,$get);
$carry=mysqli_fetch_assoc($gotten);
$address=$carry['address'];
$address=explode(",",$address);

$street=$address[0];
$count=count($address);
$city_count=$count-3;
if($city_count < 0){
    $city_count=0;
}
$city=$address[$city_count];
$zip_count=$count-2;
if($zip_count < 0){
    $zip_count=0;
}
$zip_code=$address[$zip_count];
?>

<?php

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.helcim.com/v2/helcim-pay/initialize",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode([
        'paymentType' => 'purchase',
        'amount' => $amount,  // Amount for the transaction
        'currency' => $curr,  // Currency for the transaction
        'customerRequest' => [
            'contactName' => $name,  // Customer name
            'cellPhone' => '123-456-7890',  // Customer phone number
            'billingAddress' => [
                'name' => " ",
                'street1' => " ",
                'city' => $city,
                'province' => 'AB',
                'country' => $cou,
                'postalCode' => " ",
                'phone' => '1234567890',
                'email' => $mail
            ]
        ]
    ]),
    CURLOPT_HTTPHEADER => [
        "accept: application/json",
        'api-token: aa#rAq%kWLOGy5PQ#OeFqZ5Hu#Zj1@5BXFB!*$Y-w8iUUYHrT3KTl1MSQ!_o8_Oc',  // Token wrapped in single quotes
        "content-type: application/json"
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    // Decode the response JSON to access the checkoutToken
    $responseData = json_decode($response, true);
    
    // Output only the checkoutToken value
    if (isset($responseData['checkoutToken'])) {
        $res=$responseData['checkoutToken'];
        $_SESSION['response']=$res;
        header("Location:https://secure.helcim.app/helcim-pay/$res");
        exit;
    }
}
?>