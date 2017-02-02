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

    <title>THE INTERCEPTOR - OPERATION ON GOING</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dist/css/starter-template.css" rel="stylesheet">

    </script>
  <style>
  #map{
       width: 100%;
       height: 550px; 
       margin: auto;
       }
  #target{
    visibility: hidden;

  }
  #checkpoints{
    visibility: hidden;
  }
  </style>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous">
      </script>


  </head>

  <body>
    <span id="target"></span>
    <span id="checkpoints" ></span>
    <div class="navbar navbar-fixed-top" style="margin-top:-80px;">
      <center><img src="images/header.png" style="width:400px;"></center>
    </div>

    <div class="container">
    <p><h4><center>Operation :<span id="operation_name"></span></center></h4></p>
    <p>Date Executed: <span id="date_executed"></span>
    <p>Number of officers: <span id="num_officers"></span>
    <div id="map" ></div>
    <div id="formradius">
    <input type="number" id="radiussize">
    <button onClick="release()">Coordinates</button>
    </div>
    </div><!-- /.container -->
    <script src="js/boundary.js"></script>
    <script type="text/javascript">
    var radiusSize = 0;
    var policeMarkers = [];
    var breachedSize = 0;
    // var breachedPoint = {
    //   lat: undefined, 
    //   lng: undefined,
    //   a.lat: function(){
    //     return this.lat;
    //   },
    //   a.lng: function(){
    //     return this.lng;
    //   }
    // };
    
  function getUrl(){
      var url = window.location.href;
      var start = url.indexOf('=')+1;
      var id = url.substring(start);
      return id;
    };
    // window.onLoad = getUrl(); https://interceptorpnp.000webhostapp.com/
    var oppId = getUrl();
    var target;
  
    $.ajax({
    type: "POST",
    url: "mobile_map_renderingajax.php",
    data: {
    id: oppId,
        },
        success: function(msg){
          var parsed = JSON.parse(msg);
          target = parsed.target;
          checkpoint = parsed.checkpoints;
          document.getElementById('operation_name').innerHTML = parsed.name;
          document.getElementById('date_executed').innerHTML = parsed.date_execute;
          document.getElementById('num_officers').innerHTML = parsed.officers;
        }
        });
    var minZoomLevel = 15;
    var centeroftheearth = {lat: 14.600353, lng: 121.036745};    
    var map;
    var markers = [];

    function initMap(){
    map = new google.maps.Map(document.getElementById('map'), {
    zoom: minZoomLevel,
    center: centeroftheearth ,
    mapTypeId: 'roadmap'
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

    perimeter(breachedPoint, breachedSize ,map);

    // https://interceptorpnp.000webhostapp.com/

    downloadUrl('mobile_target_marker.php/?id='+getUrl(), function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');

            Array.prototype.forEach.call(markers, function(markerElem) {
                radiusSize = markerElem.getAttribute('radius');
           
              var name = markerElem.getAttribute('operation_id');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));
              console.log(point);
              infoWindow = new google.maps.InfoWindow({map:map});

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              perimeter(point, radiusSize, map);

              var text = document.createElement('text');
              text.textContent = name
              infowincontent.appendChild(text);
              var image = {
                  url: 'images/crosshair.png',
           // size: new google.maps.Size(71, 71),
                  anchor: new google.maps.Point(10, 10),
                  scaledSize: new google.maps.Size(25, 25)
               };

              var targetMarker = new google.maps.Marker({
                position: point,
                icon: image,
                map: map,
              });

              targetMarker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
          });
    // https://interceptorpnp.000webhostapp.com/
     setInterval(function(){
     downloadUrl('mobile_checkpoints_target.php/?id='+getUrl(), function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
              counter=0;
            Array.prototype.forEach.call(markers, function(markerElem) {
              var name = markerElem.getAttribute('operation_id');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));
            
              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = counter;
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));
              counter++;
              var text = document.createElement('text');
              text.textContent = name
              infowincontent.appendChild(text);

                var image = {
                  url: 'images/baricade2.png',
           // size: new google.maps.Size(71, 71),
                  anchor: new google.maps.Point(10, 10),
                  scaledSize: new google.maps.Size(30, 30)
               };
              var marker = new google.maps.Marker({
                map: map,
                icon: image,
                position: point,
              });
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
            console.log(xml);
          });

         },1000);

     setInterval(function(){
    downloadUrl('server_tracking.php/?id='+getUrl(), function(data) {
           var dataPass = JSON.parse(data.response);
          for (var i = 0; i < dataPass.polices.length; i++) {
          var counter = dataPass.polices[i];
           // console.log(counter.counter_name);
          var point = {
            lat: counter.lat * 1,
            lng: counter.lng * 1
          };

          var image = {
                  url: 'images/policecap.png',
           // size: new google.maps.Size(71, 71),
                  anchor: new google.maps.Point(10, 10),
                  scaledSize: new google.maps.Size(40, 40)
               };
               policeMarker = new google.maps.Marker({
                position: point,
                icon: image,
                map: map,
                name: counter.name
              });
              policeMarkers.push(policeMarker);
              console.log(counter.breached);
              if(counter.breached){
                breachedSize = 250;
                breachedPoint = {};

                var cityCircle = new google.maps.Circle({
                strokeColor: '#FF0000',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#FF0000',
                fillOpacity: 0.35,
                map: map,
                center: point,
                radius: radiusSized * 1
                });

              }else{
                console.log(counter.breached);
              }
          }
          console.log(dataPass);
           
        });
    },1000);
       
       
      }

        policeMarker.addListener('click', function() {
                infoWindow.setContent(policeMarker.name);
                infoWindow.open(map, policeMarker);
              });
      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}

  
       function perimeter(loc, size, map){
        circle = new google.maps.Polygon({
        map: map,
        paths: circlePath(loc, size, 360),
        center: loc,
        strokeColor: '#FF0000',
        strokeOpacity: 0.35,
        strokeWeight: 2,
        clickable: true,
        fillColor: '#FF0000',
        fillOpacity: 0.05,
      });
        circle.setMap(map);
      }

       function circlePath(center,radius,points){
        var a=[],p=360/points,d=0;
        for(var i=0;i<points;++i,d+=p){
            a.push(google.maps.geometry.spherical.computeOffset(center,radius,d));
        }
        return a;
      }
     </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1SFa75QzMfOtf7rudCh6RFgaNk6ptbzo&libraries=geometry&callback=initMap">
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
