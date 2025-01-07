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
    'amount' => 1,
    'currency' => 'USD',
    'customerCode' => 'CST1008',
    'paymentMethod' => 'cc-ach',
    'allowPartial' => 0,
    'hasConvenienceFee' => 1,
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
      header("Location: https://secure.helcim.app/helcim-pay/$checkoutToken");
      exit; // Ensure no further code is executed
  } else {
      echo "Error: Checkout token not found in response.";
  }
}
?>
