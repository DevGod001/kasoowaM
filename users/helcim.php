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
//echo "helcim is crrently turned off";
// header('Location:cart');
//exit;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $discount = mysqli_real_escape_string($conn, $_POST['discount']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $delivery_option=mysqli_real_escape_string($conn,$_POST['delivery_option']);
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
    $amount = $amount + (6 * $total) / 100; // Add 5% tax or fee 
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
$_SESSION['amount']=$amount;
$_SESSION['currency']=$curr;
$_SESSION['name']=$name;
$_SESSION['helcim_id']=uniqid("hel_");
$_SESSION['delivery_option']=$delivery_option;
if(str_contains($delivery_option,"Doorstep")){
   $delivery_fee=mysqli_real_escape_string($conn,$_POST['delivery_fee']);
   $amount=$delivery_fee + $amount;
}
header('Location:cart');
exit;
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
    'amount' => $amount,
    'currency' => $curr,
    'customerCode' => 'CST1008',
    'paymentMethod' => 'cc',
    'allowPartial' => 0,
    'hasConvenienceFee' => 0,
    'taxAmount' => 3.67,
    'hideExistingPaymentDetails' => 1,
    'setAsDefaultPaymentMethod' => 1,
    'terminalId' => 79267
  ]),
  CURLOPT_HTTPHEADER => [
    "accept: application/json",
    'api-token: aa#rAq%kWLOGy5PQ#OeFqZ5Hu#Zj1@5BXFB!*$Y-w8iUUYHrT3KTl1MSQ!_o8_Oc',
    "content-type: application/json"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  // Decode the JSON response
  $data = json_decode($response, true);

  // Check if 'checkoutToken' exists
  if (isset($data['checkoutToken'])) {
      $checkoutToken = $data['checkoutToken'];

      // Redirect to the HelcimPay checkout page
      header("Location:helcim_checkout.php?token=$checkoutToken");
      exit; // Ensure no further code is executed
  } else {
      
     echo "Error: Checkout token not found in response.";
  }
}
?>
