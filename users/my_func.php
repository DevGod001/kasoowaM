<?php
function getRoadDistance($address1, $address2, $apiKey) {
    $address1 = urlencode($address1);
    $address2 = urlencode($address2);
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins={$address1}&destinations={$address2}&key={$apiKey}";

    // Make the HTTP request
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    // Check for a valid response
    if ($data['status'] === 'OK') {
        $rows = $data['rows'][0]['elements'][0];
        if ($rows['status'] === 'OK') {
            // Distance in meters
            return $rows['distance']['value'] / 1609.34; // Convert to miles
        } else {
            throw new Exception("Error fetching road distance: " . $rows['status']);
        }
    } else {
        throw new Exception("Error fetching data: " . $data['status']);
    }
}

// Usage
$apiKey = 'AIzaSyBfCx7I6Xfn_k_AQ87nsbj0vozcmWR7q4c'; // Replace this with your actual API key
$address1 = 'high level, makurdi, benue state, nigeria';
$address2 = ' apir, 970101, makurdi, benue state,nigeria';

try {
    $distance = getRoadDistance($address1, $address2, $apiKey);
    echo "The road distance between the two addresses is approximately " . round($distance, 2) . " miles.";
} catch (Exception $e) {
    echo $e->getMessage();
}
?>