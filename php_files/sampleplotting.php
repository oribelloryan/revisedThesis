<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Google Maps JavaScript API v3 Example: Limit Panning and Zoom</title>
    <script type="text/javascript"
    src="http://maps.google.com/maps/api/js?sensor=false"></script>
  </head>
  <body>
    <div id="map" style="width: 1330px; height: 650px;"></div>
    <script type="text/javascript">
    var minZoomLevel = 15;
    var centeroftheearth = {lat: 14.600353, lng: 121.036745};    
    var map;
    function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
    zoom: minZoomLevel,
    center: centeroftheearth ,
    mapTypeId: 'terrain'
    });

    var strictBounds = new google.maps.LatLngBounds(
    new google.maps.LatLng(14.600561, 121.036487),
    new google.maps.LatLng(14.616383, 121.058138)
    );

    google.maps.event.addListener(map, 'dragend', function() {
    if (strictBounds.contains(map.getCenter())) return;
    // We're out of bounds - Move the map back within the bounds
    var c = map.getCenter(),
    x = c.lng(),
    y = c.lat(),
    maxX = strictBounds.getNorthEast().lng(),
    maxY = strictBounds.getNorthEast().lat(),
    minX = strictBounds.getSouthWest().lng(),
    minY = strictBounds.getSouthWest().lat();
    if (x < minX) x = minX;
    if (x > maxX) x = maxX;
    if (y < minY) y = minY;
    if (y > maxY) y = maxY;
    map.setCenter(new google.maps.LatLng(y,x));
    });

    // Limit the zoom level
    google.maps.event.addListener(map, 'zoom_changed', function() {
    if (map.getZoom() < minZoomLevel) map.setZoom(minZoomLevel);
    });
     
    google.maps.event.addListener(map, 'click', function(event) {
    addMarker(event.latLng, map);  
	addMarker2(event.latLng, map);
	
    });
    //addMarker(centeroftheearth, map);
    }
	
	
    function addMarker(location, map) {
    // Add the marker at the clicked location, and add the next-available label
    // from the array of alphabetical characters.
    var marker = new google.maps.Marker({
    position: location,
	
    map: map
    });

    marker.setAnimation(google.maps.Animation.BOUNCE);

    var cityCircle = new google.maps.Circle({
    strokeColor: '#FF0000',
    strokeOpacity: 0.8,
    strokeWeight: 2,
    fillColor: '#FF0000',
    fillOpacity: 0.1,
    map: map,
    center: location,
    radius: 500
    });
	}
	
	
	var directionService = new google.maps.DirectionsService();
	 function addMarker2(location, map,ctr,i) {
    
    var point1=[];
	point1.push({latlng:new google.maps.LatLng(location.lat()+0.00013, location.lng()+0.00031)});
	var i;
	 
	for (i=0;i<point1.length;i++){
	var marker = new google.maps.Marker({ 
	position:point1[i].latlng,
    map: map
	
	});}
	
    marker.setAnimation(google.maps.Animation.Bounce);
	
   
	}
	 
	
	
	
	
	 
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9GyIjrrtsKVdm3sf1o6shJMYDIvlzU0w&libraries=drawing&libraries=geometry&callback=initMap">
    </script>
  </body>
</html>