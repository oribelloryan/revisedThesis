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
    </style>

  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <center><img src="images/header.png" style="width:400px;"></center>
    </div>
    
    <div class="container">
    <div id="formradius">
    <p id="mensahe">PLEASE SET RADIUS FIRST</p>
    <input type="number" id="radiussize">
    <button onClick="changeradius()">SET RADIUS SIZE(m)</button>
    <button id="save" onClick="saving()">SAVE TRANSACTION</button>
    <input type="hidden" id="targetHdn" />
    <input type="hidden" id="checkpointsHdn" />
    </div>
    <div id="map" ></div>
    </div><!-- /.container -->
    <script src="js/boundary.js"></script>
    <script type="text/javascript">

    var radiussize=0;
    function changeradius(){
        radiussize=document.getElementById("radiussize").value;
        alert(radiussize);
        document.getElementById("map").style.visibility='visible';
        document.getElementById("mensahe").innerHTML='PLOTPOINTS';

    }

    var minZoomLevel = 15;
    var centeroftheearth = {lat: 14.600353, lng: 121.036745};
    var map;

     function circlePath(center,radius,points){
        var a=[],p=360/points,d=0;
        for(var i=0;i<points;++i,d+=p){
            a.push(google.maps.geometry.spherical.computeOffset(center,radius,d));
        }
        return a;
      }

    
    function initMap(){
    map = new google.maps.Map(document.getElementById('map'), {
    zoom: minZoomLevel,
    scrollwheel: false,
    navigationControl: false,
    mapTypeControl: false,
    scaleControl: false,
    center: centeroftheearth ,
    mapTypeId: 'roadmap'
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

    var boundary = new google.maps.Polygon({paths: boundaries});
    
    var boundaryLine = new google.maps.Polyline({
          path: boundaries,
          geodesic: true,
          strokeColor: '#FF0000',
          strokeOpacity: 1.0,
          strokeWeight: 2
        });

        boundaryLine.setMap(map);

  new google.maps.Polygon({map:map,path:circlePath(map.getCenter(),250,360), draggable:true})

    google.maps.event.addListener(map, 'click', function(event) {
    var outOfCity =  google.maps.geometry.poly.containsLocation(event.latLng,boundary);
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
    });
    }

    var markerCounter = 0;
    
function addMarker(location, map) {
    // Add the marker at the clicked location, and add the next-available label
    // from the array of alphabetical characters.
       var allowedMarker = 1;
    if(markerCounter < allowedMarker){
        markerCounter++;
    var image = {
        url: 'images/crosshair.png', // image is 512 x 512
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(0, 0),
        scaledSize: new google.maps.Size(25, 25) 
    }; 

    var targetMarker = new google.maps.Marker({
    position: location,
    icon: image,
    map: map
    });
    targetMarker.setAnimation(google.maps.Animation.DROP);
    targetMarker.setMap(map);
    addMarker2(location, map);
    }else{
        alert("One marker at a time");
        return false;
    }
}

function returnData (data, array){
 // $.ajax({
 //            type: "GET",
 //            url: "https://roads.googleapis.com/v1/nearestRoads?points="+check+"&key=AIzaSyAjWM8z2Q0G7IzoMoD75WCGTRTTNlYiCGI",
 //            success: function(msg){ 
 //              if(msg === undefined){
 //              }else{
                
 //                var lat = msg.snappedPoints[0].location.latitude;
 //                var long = msg.snappedPoints[0].location.longitude;
 //                var newlocation = {latlng:new google.maps.LatLng(lat, long)};
 //                console.log(newlocation);
 //                point1.push(newlocation);
 //              }
 //            }
 //            });
 // return d.data();
 var lat;
 var lng;

 $.get( "https://roads.googleapis.com/v1/nearestRoads?points="+data+"&key=AIzaSyAjWM8z2Q0G7IzoMoD75WCGTRTTNlYiCGI", function( msg ) {
  lat = msg.snappedPoints[0].location.latitude;
  lng = msg.snappedPoints[0].location.longitude;
  var image = {
        url: 'images/crosshair.png', // image is 512 x 512
         scaledSize: new google.maps.Size(50, 50), // scaled size
    origin: new google.maps.Point(0,0), // origin
    anchor: new google.maps.Point(0, 0)     
    }; 
  var marker = new google.maps.Marker({
         position: {lat: lat, lng: lng},
         map: map,
         // icon: image
    //             url: 'images/crosshair.png',
    // // This marker is 20 pixels wide by 32 pixels high.
    //            size: new google.maps.Size(20, 32),
    //       }
         });
         marker.setAnimation(google.maps.Animation.DROP);
});
  var newlocation = { latlng : new google.maps.LatLng(lat,lng) };
  point1.push(newlocation);
}
var point1 = [];

function addMarker2(location, map) {
    // Add the marker at the clicked location, and add the next-available label
    // from the array of alphabetical characters.
    var allowedCircle = 1;
    var ctr;
    var curr;
    var path = [];    
    //var directionService = new google.maps.DirectionService();
         var mapradius=radiussize*.0000100;
         var xcor;
         var ycor;
         for (ctr=0;ctr<360;ctr++){
            // point1.push(newlocation);
          xcor = location.lat() + (mapradius*Math.cos(ctr));
          ycor = location.lng() + (mapradius*Math.sin(ctr));
          var loc = { lat : xcor, lng : ycor };

                var check = xcor + "," + ycor;
                // returnData(check, point1);

            xcor=xcor;
            ycor=ycor;
          path.push(loc);
        }

         var bermudaTriangle = new google.maps.Polygon({
          paths: path,
          strokeColor: '#FFC107',
          strokeOpacity: 0.8,
          strokeWeight: 0.5,
          fillColor: '#FFC107',
          fillOpacity: 0.35
        });
        bermudaTriangle.setMap(map);
         var i;
         var marker;
         // for (i=0;i<point1.length;i++){
         // marker = new google.maps.Marker({
         // position:point1[i].latlng,
         // map: map,
         // // icon: {
         // //  path : 'images/crosshair.png'
         // // }
         // });
         // marker.setAnimation(google.maps.Animation.DROP);
         // }
         var c = JSON.stringify(point1);
         var t = JSON.stringify(location)
        document.getElementById('save').style.visibility = 'visible';
        document.getElementById('targetHdn').value = t;
        document.getElementById('checkpointsHdn').value = c;
}

function saving(){
     var confirmation = confirm("Are you sure to save this target area?");
     var target = JSON.parse(document.getElementById('targetHdn').value);
     var checkpoints = JSON.parse(document.getElementById('checkpointsHdn').value);
        if(confirmation == true){
             sendingData(target, checkpoints);
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
            alert('Success!'+msg);
        }
    });
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