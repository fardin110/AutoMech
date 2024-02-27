<!DOCTYPE html>
<html>
<head>
	<title>Customer Home</title>
	<link rel="stylesheet" type="text/css" href="cus-home-style.css">

</head>
<body>
<nav class="navbar">
<button class="edit-profile-button" onclick="location.href='feedback.php'">Feedback</button>
  <button class="edit-profile-button" onclick="location.href='edit-profile.php'">Edit Profile</button>
  <button class="logout-button" onclick="location.href='logout.php'">Logout</button>
</nav>
<h1 class="text-large">You have been located in...<span id="location-name"></span></h1>

<button class="name-button"
onclick="if (document.getElementById('location-name').innerHTML === 'Dhanmondi') 
{location.href='show_dmd_mech.php'} 

else if (document.getElementById('location-name').innerHTML === 'Bashundhara') 
{location.href='show_bsd_mech.php'} 

else {location.href='#'}">Search Mechanics in <span id="location-name2"></span></button>

   
    <head>
    <style>


      #map {
        height: 500px;
      }
      #location {
        font-size: 24px;
        font-weight: bold;
        margin: 10px 0;
      }

    </style>
  </head>
  <body>

    <div id="location"></div>
    <div id="map"></div>

    <!-- Load the Google Maps JavaScript API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzwKXFRQsLjn2Ua2vpMbJTpZZPGVitXu4"></script>

    <script>
      // Initialize the map
      function initMap() {
  // Get the user's location
  navigator.geolocation.getCurrentPosition(function(position) {
    // Get the latitude and longitude values
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    
    // Define the location names and their corresponding ranges
    var locationNames = {
      'Dhanmondi': {
        latRange: [23.7000, 23.8000],
        lngRange: [90.3000, 90.4000]
      },
      'Bashundhara': {
        latRange: [23.8000, 23.9000],
        lngRange: [90.4000, 90.5000]
      }
    };
    
    // Check if the latitude and longitude values fall within any of the location ranges
    for (var locName in locationNames) {
      var locRange = locationNames[locName];
      if (latitude >= locRange.latRange[0] && latitude <= locRange.latRange[1] &&
          longitude >= locRange.lngRange[0] && longitude <= locRange.lngRange[1]) {
        // Return the location name if it falls within a range
        document.getElementById('location').innerHTML = 'Area : ' + locName;
        document.getElementById('location-name').innerHTML = locName;
        document.getElementById('location-name2').innerHTML = locName;
        break;
      }
    }
    
    // If the latitude and longitude values do not fall within any of the location ranges
    if (!document.getElementById('location').innerHTML) {
      document.getElementById('location').innerHTML = 'Your location is out of reach: ' + latitude + ', ' + longitude;
      document.getElementById('location-name').innerHTML = 'Your location';
      document.getElementById('location-name2').innerHTML = 'Your location';
    }

    // Create a LatLng object for the user's location
    var latLng = new google.maps.LatLng(latitude, longitude);

    // Create the map centered at the user's location
    var map = new google.maps.Map(document.getElementById('map'), {
      center: latLng,
      zoom: 16

    });

    // Add a marker at the user's location
    var marker = new google.maps.Marker({
      position: latLng,
      map: map,
      title: 'My Location'
    });
  });
}

      // Call the initMap function when the page loads
      window.onload = initMap;
    </script>

</body>

</html>
