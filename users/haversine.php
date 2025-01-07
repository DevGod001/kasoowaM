<?php
function haversineDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo) {
    $lat1=trim($latitudeFrom);
    $lng1=trim($longitudeFrom);
    $lat2=trim($latitudeTo);
    $lng2=trim($longitudeTo);
    $lat1=urlencode($lat1);
    $lng1=urlencode($lng1);
    $lat2=urlencode($lat2);
    $lng2=urlencode($lng2);
    $api=urlencode('eOaqn9xlcUDQ6aZPQS1F4ot8jtwdfK3EyF4UhjH8EKk');
    $url="https://router.hereapi.com/v8/routes?transportMode=car&origin=$lat1,$lng1&destination=$lat2,$lng2&return=summary&apiKey=$api";
    $curl=curl_init();
    curl_setopt($curl,CURLOPT_URL,$url);
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
    $response=curl_exec($curl);
    $res=$response;
    $response=json_decode($response,true);
    if(isset($response['routes'][0]['sections'][0]['summary']['length'])){
    $distance=$response['routes'][0]['sections'][0]['summary']['length']; // distance in meters
    // dividing by 1609.34 which is the standard method to convert meters to miles
    $distance=$distance/1609.34;
    $distance=round($distance,2);
    }
       else{
           $distance="error";
       }
    return $distance;
    curl_close($curl);
}

// Example usage
//$address1Latitude = 9.0765; // Example: Latitude for Abuja
//$address1Longitude = 7.3986; // Example: Longitude for Abuja
//$address2Latitude = 9.0805; // Example: Latitude for Mambilla Barracks
//$address2Longitude = 7.5099; // Example: Longitude for Mambilla Barracks

//$distance = haversineDistance($address1Latitude, $address1Longitude, $address2Latitude, $address2Longitude);

//echo "Distance: " . $distance . " miles";
function mile_fees($country){
    switch($country){
        case 'nigeria':
        $fee=100;
        $fixed=50;
        break;
        case 'united_states':
        case 'canada':
        $fee=3;
        $fixed=1.5;
        break;
        default:
        $fee=30;
        $fixed=15;
        break;
    }
    $return=[
        'fee' => $fee,
        'fixed' => $fixed
        ];
    return json_encode($return,true);
}

//$return=haversineDistance(7.7312,8.5204,7.7484,8.5184);
//echo $return;
function payment_method($country){
  
   switch($country){
       case 'nigeria':
        case 'ghana':
        case 'cameroon':
        $url="checkout.php";
        break;
        default:
        $url="helcim.php";
        break;
   }
   return $url;
   
   
   
   
}


?>