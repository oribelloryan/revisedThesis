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
    <link href="dist/css/starter-template.css" rel="stylesheet">
    
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
    var radiussize=0;
    
    function changeradius(){
        radiussize=document.getElementById("radiussize").value;
        alert(radiussize);
        document.getElementById("map").style.visibility='visible';
        document.getElementById("mensahe").innerHTML='PLOTPOINTS';
        document.getElementById("set").innerHTML='UPDATE RADIUS SIZE';
    }

    function deleteMarker() {
        clearMarkers();
        markers = [];
      }

    function clearMarkers() {
        marker.setMap(null);
      }

    var map;

    function initMap(){
        var minZoomLevel = 15;
        var centeroftheearth = {lat: 14.600353, lng: 121.036745};
       
        var directionsService;
        var directionsDisplay;
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
        
        var infoWindow = new google.maps.InfoWindow({map: map});
        

        directionsDisplay.setMap(map);
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

        var boundary = new google.maps.Polygon({paths: boundaries});
    
        var boundaryLine = new google.maps.Polyline({
            path: boundaries,
            geodesic: true,
            strokeColor: '#FF0000',
            strokeOpacity: 1.0,
            strokeWeight: 2
        });

        boundaryLine.setMap(map);
        var markerCounter = 0;
  
        console.log("counter"+markerCounter);
        google.maps.event.addListener(map, 'click', function(event) {
          var outOfCity =  google.maps.geometry.poly.containsLocation(event.latLng,boundary);
          if(markerCounter < 1){
          markerCounter++;
              if(outOfCity){
                  var isSure = confirm("Are you sure to target this area?");
                  if(isSure){
                       addMarker(event.latLng, map);
                  }else{
                       return;
                  }
              }else{
                  alert("That is not part of San Juan City");
              }
          }else{
              alert("One marker at a time");
              return false;
          }
        });
       
    }

    
    
    function addMarker(location, map) {
    // Add the marker at the clicked location, and add the next-available label
    // from the array of alphabetical characters.
        var loc = String(location);
        var indexComma = loc.indexOf(",");
        var locLat = loc.substring(1, indexComma-1);
        var indexParen = loc.indexOf(")");
        var locLng = loc.substring(indexComma+2, indexParen);
        var locTarget = locLat + "," + locLng;
        
        var targetMarker = new google.maps.Marker({
            position: location,
            map: map,
            icon: {
                path: google.maps.SymbolPath.BACKWARD_CLOSED_ARROW,
                scale: 5,
                strokeWeight:2,
                strokeColor:"#B40404"
            }
        });
       targetMarker.setAnimation(google.maps.Animation.BOUNCE);
       targetMarker.setMap(map);
       $.ajax({
           type: "GET",
           url: " https://maps.googleapis.com/maps/api/geocode/json?latlng="+locTarget+"&key=AIzaSyAjWM8z2Q0G7IzoMoD75WCGTRTTNlYiCGI",
           success: function(msg){
               document.getElementById("address").style.visibility='visible';
               document.getElementById("targetAddress").innerHTML= msg.results[0].formatted_address;
               console.log(msg);
               console.log("status" + msg.status)
           }
       });
   
        addMarker2(location, map);
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
        var mapradius=radiussize*.0000100;
        var xcor;
        var ycor;
        for (ctr=0;ctr<360;ctr++){
           xcor=location.lat()+(mapradius*Math.cos(ctr));
            ycor=location.lng()+(mapradius*Math.sin(ctr));
            var newlocation = {latlng:new google.maps.LatLng(xcor,ycor)};
            var check = {latlng:new google.maps.LatLng(xcor,ycor)};
            point1.push(newlocation);

            ctr=ctr+15;
            xcor=xcor;
            ycor=ycor;
        }
        console.log(point1[0].latlng.lat());
        var i;
        var marker;
        for (i=0;i<point1.length;i++){
            marker = new google.maps.Marker({
            position:point1[i].latlng,
            draggable: true,
            map: map
       });
           marker.setAnimation(google.maps.Animation.DROP);
        }
        var c = JSON.stringify(point1);
        var t = JSON.stringify(location)
        document.getElementById('save').style.visibility = 'visible';
        document.getElementById('targetHdn').value = t;
        document.getElementById('checkpointsHdn').value = c;
    }

    function saving(){
        var confirmation = confirm("Are you sure to save this target area?");
        var target = JSON.parse(document.getElementById('targetHdn').value);
        target.toString();
        console.log(target.lat);
        console.log(target.lng);

        var checkpoints = JSON.parse(document.getElementById('checkpointsHdn').value);
        if(confirmation == true){
            sendingData(target, checkpoints);
            sendingViaXMLHTTP('server_plottingCheckpointAjax.php', checkpoints);
        }else if(confirmation == false){
            marker.setMap(null);
            alert("False");
        }
    }

    function sendingData(location, checkpoints){
        var checkpoint = JSON.stringify(checkpoints);
        var target = JSON.stringify(location);
        $.ajax({
            type: "POST",
            url: "server_plottingAjax.php",
            data: {
                checkpoints : checkpoint,
                target : target,
            },
            success: function(msg){ 
              if(msg == "Data have been saved"){
                alert('Success!'+msg);
              }else{
                alert('Error in saving');
              }
            }
        });
    }

    function sendingViaXMLHTTP(url, param) {
       var check = JSON.stringify(param);
       var xhr = new XMLHttpRequest();
       xhr.open("POST", url , true);

      //Send the proper header information along with the request
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

      xhr.onreadystatechange = function() {//Call a function when the state changes.
      if(xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
        // Request finished. Do processing here.
        console.log('yes');
      }
      }
      xhr.send('checkpoints='+check); 
      }
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