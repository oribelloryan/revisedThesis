<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>THE INTERCEPTOR - CREATE PLAN</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">
    <script src="dist/js/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="dist/css/sweetalert.css">
    
    <style>
      #formradius{
      layout:relative;
      margin-left:200px;

      }
      #blocker{
          position:relative;
          top:500px;
          height:600px;
          width:600px;
          background-color:blue;
          }
      #map{
        width: 1000px; 
        height: 550px;
        visibility:hidden;
      }
      #save{
        visibility:hidden;
      }
      #address{
        visibility:hidden;
      }
    </style>

   </head>

    <body>

    <div class="navbar navbar-fixed-top" style="margin-top:-80px;">
      <center><img src="images/header.png" style="width:400px;"></center>
    </div>
    
    <div class="container">
    <div id="formradius">
    <p id="mensahe">PLEASE SET RADIUS FIRST</p>
    <input type="number" id="radiussize">
    <button onClick="changeradius()"><span id="set">SET RADIUS SIZE(m)</span></button>
    <button onClick="deleteMarker()">CHANGE TARGET</button>
    <button onClick="showMarker()">SHOWMARKER</button>
    <button id="save" onClick="saving()">SAVE TRANSACTION</button>
    <br/>
    <span id="address"><span>Target Address: </span> <span id="targetAddress">None</span></span>
    <input type="hidden" id="targetHdn" />
    <input type="hidden" id="checkpointsHdn" />
    </div>
    <br/>
    <div id="map" ></div>
    </div><!-- /.container -->
    <script src="js/boundary.js"></script>
    <script type="text/javascript">
      "use strict"
    var radiusSize = 0;
    var markers = [];
    var locations = [];
    var perimeterArray = [];
    var perimeter;
    var circle;
    var poly;

    function changeradius(){
        radiusSize=document.getElementById("radiussize").value;
        if(radiusSize < 250 ){
        swal("Size too small" ,"Radius size is small for recommended size", "error");
        }else{
        swal("Your radius size: "+radiusSize+" meters");
        document.getElementById("map").style.visibility='visible';
        document.getElementById("mensahe").innerHTML='PLOTPOINTS';
        document.getElementById("set").innerHTML='UPDATE RADIUS SIZE';
      }
    }

    function showMarker(){
      for(var i = 0; i < markers.length; i++){
        console.log(markers[i].customInfo);
      }
      var sorted = locations;
      var i = 0;
      sorted.forEach(function(x, y){
      var path = poly.getPath();
        // Because path is an MVCArray, we can simply append a new coordinate
        // and it will automatically appear.
        console.log(x.internalPosition);
        path.push(x);
        i++;
      });
        console.log(markers);
        setMapOnAll(map);
    }

    function getMarkersPosition(){
      var markersPosition = [];
      markers.forEach(function(x, y){
        markersPosition.push(x.getPosition());
      });
      return markersPosition;
    }

    function addPerimeter(loc){
      circle = new google.maps.Circle({
            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#FF0000',
            fillOpacity: 0.35,
            // map: map,
            center: loc,
            radius: radiusSize * 1        
          });
      perimeterArray.push(circle);
  }


    function deleteMarker() {
        swal({
        title: "Are you sure?",
        text: "You will not be able to recover this target!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Yes, change it!',
        cancelButtonText: "No!",
        closeOnConfirm: false,
       },
        function(){
          swal("Deleted!", "Change target", "success");
          clearMarkers();
          perimeterArray = [];
          markers = [];
        } );
      }

    function clearMarkers() {
        setMapOnAll(null);
      }

    function locationPass(e) {
      return e.lat+','+e.lng;
    }

    function setMapOnAll(map){
      var i; 
      var length = markers.length;
      for(i=0; i < length; i++){
        markers[i].setMap(map);
      }
      perimeterArray[0].setMap(map);
    }

    var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
     var labelIndex = 0;

    function addMarker(location) {
      var marker;
      var isOfCity = google.maps.geometry.poly.containsLocation(location, boundary);
      if(isOfCity){

      if(markers.length < 1){ 
         
         // displayRoute(location, locationAddress, directionsService, directionsDisplay);

        marker = new google.maps.Marker({
          position: location,
          map: map,
          customInfo: 'target',
          draggable: true,
          icon: {
                path: google.maps.SymbolPath.BACKWARD_CLOSED_ARROW,
                scale: 5,
                strokeWeight: 2,
                strokeColor:"#B40404"
            }
          });
        markers.push(marker);
        locations.push(location);
      }else{
        var lat;
        var lng;
        var data = location.lat() + ',' + location.lng();
         $.get( "https://roads.googleapis.com/v1/nearestRoads?points="+data+"&key=AIzaSyAjWM8z2Q0G7IzoMoD75WCGTRTTNlYiCGI", function( msg ) {
        lat = msg.snappedPoints[0].location.latitude;
        lng = msg.snappedPoints[0].location.longitude;
       
        marker = new google.maps.Marker({
          position: {lat: lat , lng: lng} ,
          label: labelIndex.toString(),
          customInfo: labelIndex.toString(),
          draggable: true,
          map: map,

        });
         labelIndex++;
          markers.push(marker);
          locations.push(location);
        });

      }
     
    }else{

    }
    }


    function snapToRoad(data){
      var lat;
      var lng;
      $.get( "https://roads.googleapis.com/v1/nearestRoads?points="+locationPass(data)+"&key=AIzaSyAjWM8z2Q0G7IzoMoD75WCGTRTTNlYiCGI", function( msg ) {
        lat = msg.snappedPoints[0].location.latitude;
        lng = msg.snappedPoints[0].location.longitude;
        var image = {
          url: 'images/crosshair.png', // image is 512 x 512
          scaledSize: new google.maps.Size(50, 50), // scaled size
            origin: new google.maps.Point(0,0), // origin
            anchor: new google.maps.Point(0, 0)     
          }; 
    });
    }

    var map;
    var boundary;
    var infoWindow;
    var locationAddress;
    var directionsService;
    var directionsDisplay;

    function initMap(){
        var minZoomLevel = 15;
        var centeroftheearth = {lat: 14.600353, lng: 121.036745};
         

        directionsService = new google.maps.DirectionsService;
        directionsDisplay = new google.maps.DirectionsRenderer;
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: minZoomLevel,
            scrollwheel: false,
            navigationControl: false,
            mapTypeControl: false,
            scaleControl: false,
            center: centeroftheearth ,
            mapTypeId: 'roadmap'
        });
        
        infoWindow = new google.maps.InfoWindow({map: map});
        
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            locationAddress = pos.lat + ',' + pos.lng;
            infoWindow.setPosition(pos);
            infoWindow.setContent(locationAddress);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }

        directionsDisplay.setMap(map);
        var strictBounds = new google.maps.LatLngBounds(
            new google.maps.LatLng(14.600561, 121.036487),
            new google.maps.LatLng(14.616383, 121.058138)
        );

        poly = new google.maps.Polyline({
          strokeColor: '#000000',
          strokeOpacity: 1.0,
          strokeWeight: 3
        });
        poly.setMap(map)

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

        boundary = new google.maps.Polygon({paths: boundaries});
    
        var boundaryLine = new google.maps.Polyline({
            path: boundaries,
            geodesic: true,
            strokeColor: '#FF0000',
            strokeOpacity: 1.0,
            strokeWeight: 2
        });

        boundaryLine.setMap(map);

     

        google.maps.event.addListener(map, 'click', function(event) {
          var isOfCity =  google.maps.geometry.poly.containsLocation(event.latLng,boundary);
          if(markers.length < 1){
              if(isOfCity){
                  swal({
                      title: "Are you sure?",
                      text: "This area will be targeted!",
                      type: "",
                      showCancelButton: true,
                      confirmButtonColor: '#DD6B55',
                      confirmButtonText: 'Yes, target it',
                      cancelButtonText: "No",
                      closeOnConfirm: false,
                      closeOnCancel: false
                    },
                    function(isConfirm){
                      if (isConfirm){
                        swal("Targeted!", "", "success");
                         addPerimeter(event.latLng);
                          circle.setMap(map);
      circle.addListener('click', function(){
        alert("cicrlce");
      });
                      } else {
                        swal("Cancelled");
                      }
                    });
              }else{
                  swal("Oops...", "That is out of bound of San Juan City", "error");
              }
          }else{
              swal("Oops...", "One target at a time!", "error");
              return false;
          }
        });
       
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
      }
   
    function addMarker2(location, map) {
    // Add the marker at the clicked location, and add the next-available label
    // from the array of alphabetical characters.
        var ctr;
        var curr;
        var point1=[];

    //var directionService = new google.maps.DirectionService();
        var mapradius = radiusSize*.0000100;
        var xcor;
        var ycor;
        for (ctr=0;ctr<360;){
            xcor = location.lat() + (mapradius*Math.cos(ctr));
            ycor = location.lng() + (mapradius*Math.sin(ctr));
            var newlocation = { latlng: new google.maps.LatLng(xcor, ycor) };
            var newLocation = new google.maps.LatLng(xcor, ycor);
            var check = { latlng:new google.maps.LatLng(xcor, ycor) };
            addMarker( newLocation );
            point1.push( newlocation );
            ctr = ctr + 3;
        }
        var i;
        var marker;
        for (i=0;i<point1.length;i++){
            marker = new google.maps.Marker({
            position:point1[i].latlng,
            // map: map
       });
           // marker.setAnimation(google.maps.Animation.DROP);
           markers.push(marker);
        }
        var c = JSON.stringify(point1);
        var t = JSON.stringify(location)
        document.getElementById('save').style.visibility = 'visible';
        document.getElementById('targetHdn').value = t;
        document.getElementById('checkpointsHdn').value = c;
    }

    function saving(){
        var confirmation = confirm("Are you sure to save this target area?");

        var markerSaving = JSON.stringify(getMarkersPosition());
        // console.log(markers);;
        if(confirmation == true){
            $.ajax({
            type: "POST",
            url: "server_plottingMockAjax.php",
            data: {
                markers: markerSaving
            },
            success: function(msg){ 
              if(msg == "Data have been saved"){
                alert('Success!'+msg);
              }else{
                alert('Error in saving');
              }
            }
        });
        }else if(confirmation == false){
            marker.setMap(null);
            alert("False");
        }
    }

    // function displayRoute(origin, destination, service, display) {
    //     service.route({
    //       origin: origin,
    //       destination: destination,
    //       travelMode: 'WALKING',
    //       avoidTolls: true,
    //       optimizeWaypoints: true,
    //       provideRouteAlternatives: true,
    //     }, function(response, status) {
    //       if(status === 'OK') {
    //         display.setDirections(response);
    //       } else {
    //         alert('Could not display directions due to: ' + status);
    //       }
    //     });
    // }

    // function computeTotalDistance(result) {
    //     var total = 0;
    //     var myroute = result.routes[0];
    //     for (var i = 0; i < myroute.legs.length; i++) {
    //       total += myroute.legs[i].distance.value;
    //     }
    //     total = total / 1000;
    //     alert(total + 'km');
    //   }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjWM8z2Q0G7IzoMoD75WCGTRTTNlYiCGI&libraries=geometry&callback=initMap">
    </script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js" integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB" crossorigin="anonymous"></script>
    <script src="dist/js/bootstrap.min.js"></script>
  </body>
</html>