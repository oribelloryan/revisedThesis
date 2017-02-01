<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Draggable directions</title>
    <style>
      #right-panel {
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }

      #right-panel select, #right-panel input {
        font-size: 15px;
      }

      #right-panel select {
        width: 100%;
      }

      #right-panel i {
        font-size: 12px;
      }
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
        float: left;
        width: 63%;
        height: 100%;
      }
      #right-panel {
        float: right;
        width: 34%;
        height: 100%;
      }
      .panel {
        height: 100%;
        overflow: auto;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <div id="right-panel">
      <p>Total Distance: <span id="total"></span></p>
    </div>
    <script>


      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: {lat: 14.600353, lng: 121.036745}  // San Juan City Philippines.
        });
        
        google.maps.event.addListener(map, 'click', function(event) {
          addMarker(event.latLng, map);
          addMarker2(event.latLng, map);
        });
      }

      function addMarker(location, map){
        var marker = new google.maps.Marker({
          position : location,
          map : map
        });
      }

      function addMarker2(location, map) {
    // Add the marker at the clicked location, and add the next-available label
    // from the array of alphabetical characters.
    var ctr;
    var curr;
    var point1=[];

    //var directionService = new google.maps.DirectionService();
    var mapradius=500*.0000100;
    var xcor;
    var ycor;

    for (ctr=0;ctr<360;ctr++){
    xcor=location.lat()+(mapradius*Math.cos(ctr));
    ycor=location.lng()+(mapradius*Math.sin(ctr));
    var newlocation = new google.maps.LatLng(xcor,ycor);
    var check = new google.maps.LatLng(xcor,ycor);

    point1.push(newlocation);

    ctr=ctr;
   }

  

    var i;
    var marker;
    for (i=0;i<point1.length;i++){
     marker = new google.maps.Marker({
     position:point1[i],
    });
    marker.setAnimation(google.maps.Animation.DROP);
     }
	 
		
			
		var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer({
          draggable: true,
          map: map,
          panel: document.getElementById('right-panel')
        });

        directionsDisplay.addListener('directions_changed', function() {
          computeTotalDistance(directionsDisplay.getDirections());
        });
		
        displayRoute(point1[x], point1[x], directionsService,
            directionsDisplay);
	  }

    function displayRoute(origin, destination, service, display) {
        service.route({
          origin: origin,
          destination: destination,
          travelMode: 'DRIVING',
          avoidTolls: true,
          optimizeWaypoints: false,
          provideRouteAlternatives: false,
        }, function(response, status) {
          if(status === 'OK') {
            display.setDirections(response);
          } else {
            alert('Could not display directions due to: ' + status);
          }
        });
		}

      function computeTotalDistance(result) {
        var total = 0;
        var myroute = result.routes[0];
        for (var i = 0; i < myroute.legs.length; i++) {
          total += myroute.legs[i].distance.value;
        }
        total = total / 1000;
        document.getElementById('total').innerHTML = total + ' km';
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1SFa75QzMfOtf7rudCh6RFgaNk6ptbzo&callback=initMap">
    </script>
  </body>
</html>