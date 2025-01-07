<?php
if(isset($_GET['lat1']) && isset($_GET['lat2']) && isset($_GET['long1']) && isset($_GET['long2'])){
    $long1=$_GET['long1'];
    $long2=$_GET['long2'];
    $lat1=$_GET['lat1'];
    $lat2=$_GET['lat2'];
   
    
    
}




?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBfCx7I6Xfn_k_AQ87nsbj0vozcmWR7q4c"></script>
</head>
<style>
body{
    background:white;
}
  .map {
      
    height: 100vh;
    width: 100%;
  }
</style>
<body>
   
  <div class="map">
      
      
      
      
  </div>
  <script>
   
    const map_div = document.querySelector(".map");
   const state="<?php 
   if(isset($_GET['status'])){
   echo $_GET['status'];
   }
    else{
         echo "";
    }
   ?>";
 

    function show_map() {
      const location1 = {
        lat: <?php echo $lat1 ?>,
        lng: <?php echo $long1 ?>
      };

      const location2 = {
        lat: <?php echo $lat2 ?>,
        lng:<?php echo $long2 ?>
      };

      const center = {
        lat: (location1.lat + location2.lat) / 2,
        lng: (location1.lng + location2.lng) / 2
      };

      const map = new google.maps.Map(map_div, {
        zoom: 10,
        center: center
      });

      // Create InfoWindows for both locations
      const infoWindow1 = new google.maps.InfoWindow({
        content: '<h3>Your Location</h3><p>This is your current location.</p>'
      });

      const infoWindow2 = new google.maps.InfoWindow({
        content: '<h3>Store Location</h3><p>This is the store\'s address and location details.</p>'
      });

      // Add the first marker
      const marker1 = new google.maps.Marker({
        position: location1,
        map: map,
        title: 'Location 1'
      });

      // Add the second marker
      const marker2 = new google.maps.Marker({
        position: location2,
        map: map,
        title: 'Location 2'
      });

      // Add event listeners to show the info window when the marker is clicked
      marker1.addListener('click', function() {
        infoWindow1.open(map, marker1);
      });

      marker2.addListener('click', function() {
        infoWindow2.open(map, marker2);
      });
    }

    window.onload = function() {
      show_map();
    };
  </script>
</body>

</html>