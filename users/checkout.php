<?php

error_reporting(E_ALL);
ini_set("display_errors",1);
session_start();
include_once 'connect.php';
include_once 'haversine.php';
include_once 'vendor/autoload.php';
$dotenv=Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv -> load();

// User ID and Cart ID from Cookies
$user_id = $_COOKIE['user_id'];
$cart_id = $_COOKIE['cart_id'];

if(!isset($_GET['key'])){
    header('Location:cart');
    exit;
}
if(isset($_GET['store_checkout'])){
   $sid=$_GET['sid'];
   $_SESSION['type']="store";
   $_SESSION['store_id']=$sid;
   // generating the initial total
  $select="SELECT SUM(product_cost * quantity) AS `total` FROM `cart` WHERE `store_id`=$sid AND `uniqid`='$cart_id'";
  $selected=mysqli_query($conn,$select);
  $fetch=mysqli_fetch_assoc($selected);
  $total=$fetch['total'];
  
  // Get Currency based on User's Preference
$select = "SELECT * FROM `users` WHERE `id`=$user_id";
$selected = mysqli_query($conn, $select);
if (mysqli_num_rows($selected) > 0) {
    $fetch = mysqli_fetch_assoc($selected);
    $currency = $fetch['currency'];

    switch ($currency){
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

// generating proces url
$current_file=basename($_SERVER['PHP_SELF']);
$url=$_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$url=str_replace($current_file,"checkout_process.php",$url);
   

$fee=mile_fees($fetch['country']);
   $data=json_decode($fee,true);
  $fee=$data['fee']; 
  $fixed=$data['fixed'];
   $total = $total + (6 * $total) / 100; // Add 5% tax or fee
   $get="SELECT * FROM `cart` WHERE `store_id`=$sid";
   $gotten=mysqli_query($conn,$get);
   $carry=mysqli_fetch_assoc($gotten);
   $miles=$carry['miles'];
   $del_fee=($miles + $fee) * $fixed;
   $del_fee=round($del_fee,2);
  
 // accessing delivery option
 if(isset($_SESSION['option'])){
      $option=$_SESSION['option'];
  }
   if(str_contains($option,'door')){
       $amount=$total + $del_fee;
   }
    else{
        $amount=$total;
    }
   
}
 else{
   $select="SELECT * FROM `accounts` WHERE `user_id`=$user_id";
   $selected=mysqli_query($conn,$select);
   if($selected){
       $fetch=mysqli_fetch_assoc($selected);
       $address=$fetch['address'];
   }
  if(isset($_SESSION['option'])){
      $option=$_SESSION['option'];
      echo $option;
  }
  
    $address = $address;
    
     $delivery_option=$option;
   
    $_SESSION['address'] = $address;
$_SESSION['type']="all";

    // Calculate Total Amount
    $select = "SELECT SUM(`product_cost` * `quantity`) AS `total` FROM `cart` WHERE `uniqid`='$cart_id'";
    $selected = mysqli_query($conn, $select);
    $fetch = mysqli_fetch_assoc($selected);
    $total = $fetch['total'];
    $amount=$total;
   
    $amount = $amount + (6 * $total) / 100; // Add 5% tax or fee


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
  
   $fee=mile_fees($fetch['country']);
   $data=json_decode($fee,true);
  $fee=$data['fee']; 
  $fixed=$data['fixed'];
   
}

$current_file=basename($_SERVER['PHP_SELF']);
$url=$_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$url=str_replace($current_file,"checkout_process.php",$url);
   

if(str_contains($delivery_option,"doorstep")){
    $select="SELECT * FROM `cart` WHERE `uniqid`='$cart_id' GROUP BY `store_id`";
    $selected=mysqli_query($conn,$select);
    if($selected){
        $array=[];
       while($fetch=mysqli_fetch_assoc($selected)){
           $miles=$fetch['miles'];
           $calc=($fee + $miles) * $fixed;
           $calc=round($calc,2);
           $array[]=$calc;
       }
    }
        
  $delivery_fee=array_sum($array);
 
   $amount=$delivery_fee + $amount;
}
}
$select="SELECT * FROM `users` WHERE `id`=$user_id";
$selected=mysqli_query($conn,$select);
$fetch=mysqli_fetch_assoc($selected);
unset($_SESSION['option']);


?>

<?php
// Flutterwave API Credentials
$public_key = $_ENV['FLWV_PUBLIC'];
$secret_key = $_ENV['FLWV_SECRET'];

// Generate Unique Transaction Reference
$tx_ref = 'txn_' . uniqid();
$amount = $amount; // Amount to be charged

// Save tx_ref and amount in session for later use
$_SESSION['tx_ref'] = $tx_ref;
$_SESSION['amount'] = $amount;
$currency = $curr;
$email = $fetch['mail'];
$phone_number = "091327307993"; // Example phone number

// Prepare payment request data
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

// Send payment request to Flutterwave API
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

// Decode the response from Flutterwave API
$response_data = json_decode($response, true);

// Check for successful response and redirect to the payment link
if (isset($response_data['data']['link'])) {
    header("Location: " . $response_data['data']['link']);
    exit();
} else {
    echo "Payment initiation failed: " . $response_data['message'];
}
?>
