<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer location tracker</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
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
        .error{
            font-family:poppins;
            color:#708090;
            
        }
        .error_group *{
            user-select:none;
        }
        .error_group{
            display:flex;
            flex-direction:column;
            align-items:center;
            padding:10px;
        }
        a{
            font-family:poppins;
            color:white;
           background:#4caf50;
           padding:5px 30px;
           border-radius:5px;
           margin:20px 0;
           box-shadow:0px 4px 8px rgba(0,0,0,0.2);
           
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
                        zoom: 16,
                        center: { lat: lat, lng: lng },
                    });

                    // Add a marker
                    new google.maps.Marker({
                        position: { lat: lat, lng: lng },
                        map: map,
                        title: "My Location",
                    });
                    let c_form=new FormData();
                    c_form.append("longitude",lng);
                    c_form.append("latitude",lat);
                    let xhr=new XMLHttpRequest();
                    xhr.open("POST","location_process.php",true);
                    xhr.onreadystatechange=function(){
                        if(xhr.readyState==4 && xhr.status==200){
                            window.parent.postMessage(xhr.responseText);
                           
                        }
                        
                    }
                    xhr.send(c_form);
                }, function (error) {
                    alert("Could not verify your location. Please ensure location services are on and you have a good internet connection then reload the page.");
                    document.getElementById("map").innerHTML=`<div class="error_group"><i class="material-icons">location_off</i><br><span class="error">Could not verify your location. Please ensure location services are on and you have a good internet connection then reload the page.</span><a onclick="initMap()">Retry</a></div>`;
                    
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
            
        }
    </script>
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBfCx7I6Xfn_k_AQ87nsbj0vozcmWR7q4c&callback=initMap"></script>
</body>
</html>
