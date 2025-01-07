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
        'amount' => 1,  // Amount for the transaction
        'currency' => 'CAD',  // Currency for the transaction
        'customerRequest' => [
            'contactName' => ' ',  // Customer name
            'cellPhone' => '123-456-7890',  // Customer phone number
            'billingAddress' => [
                'name' => ' ',
                'street1' => ' ',
                'city' => 'Calgary',
                'province' => 'AB',
                'country' => 'USA',
                'postalCode' => ' ',
                'phone' => '1234567890',
                'email' => 'dave@gmail.com'
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
       # echo $responseData['checkoutToken'];
        header("Location: https://secure.helcim.app/helcim-pay/" . $responseData['checkoutToken']);
        exit;
    }
}
?>