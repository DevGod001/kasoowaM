<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer location tracker</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
        }
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>
<body>
    <div id="map"></div> 
    <script>
        function initMap() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;

                    // Initialize the map
                    const map = new google.maps.Map(document.getElementById("map"), {
                        zoom: 12,
                        center: { lat: lat, lng: lng },
                    });

                    // Add a marker
                    new google.maps.Marker({
                        position: { lat: lat, lng: lng },
                        map: map,
                        title: "My Location",
                    });
                }, function (error) {
                    alert("Could not verify your location. Please ensure location services are on and you have a good internet connection.");
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }
    </script>
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBfCx7I6Xfn_k_AQ87nsbj0vozcmWR7q4c&callback=initMap"></script>
</body>
</html>
