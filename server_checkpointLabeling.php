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
      <center><img src="images/header.png"" style="width:400px;"></center>
    </div>
    <a href="index.php"><img src="images/breached_node.png" style="width:50px;" align="right"></a>
    <div class="container" style="margin-top:50px;">    
    <p><h4 style="text-transform:uppercase;"><center>Operation :</p><p id="operation_name" style="text-decoration:underline;color:#317fba;text-transform:capitalize;"></p></center></h4>
    <p style="color:#bd593d;font-weight:bold;text-transform:uppercase;margin-bottom:5px;">Date Executed:</p> <span id="date_executed"></span>
    <p id = 'checkpointSpan' style="color:#bd593d;font-weight:bold;text-transform:uppercase;margin-bottom:5px;">Number of checkpoints:</p> <p id="num_officers" style="margin-bottom:20px;"></p>
    <div id="map" ></div>
    <div id="formradius">
    <input type="number" id="radiussize">
    <button onClick="release()">Coordinates</button>
    </div>
    </div><!-- /.container -->
    <script src="js/boundary.js"></script>
    <script type="text/javascript">
    var markers = [];
    var radiusSize = 0;
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
    // https://interceptorpnp.000webhostapp.com/
    var infoWindow = new google.maps.InfoWindow();
    downloadUrl('mobile_target_marker.php/?id='+getUrl(), function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');

            Array.prototype.forEach.call(markers, function(markerElem) {
                radiusSize = markerElem.getAttribute('radius');
           
              var name = markerElem.getAttribute('operation_id');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              perimeter(point, map);

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
     downloadUrlCheck('server_checkpoints_target.php/?id='+getUrl(), function(data) {
          
           var dataPass = JSON.parse(data);
          for (var i = 0; i < dataPass.checkpoints.length; i++) {
          var counter = dataPass.checkpoints[i];
           //console.log(counter.counter_name);
          var point = {
            lat: counter.lat * 1,
            lng: counter.lng * 1
          };
          createMarker(counter.id, point, infoWindow, counter.name, map);
          }
           
        });
    
        }

      function updateLabel(id, name, callback){
       $.ajax({
          type: "POST",
          url: "server_updateLabelAjax.php",
          dataType: "json",
          data: {
              id: id,
              name: name
            },
          success: function(msg){ 
          callback(msg);
      }
    });
      }

      function createMarker(checkpointId, point, infoWindow, name, map){
        var contentString;
       
          if(name === ''){
           contentString = $('<div class="marker-info-win">'+
          '<div class="marker-inner-win"><span class="info-content">'+
          '<h4 class="marker-heading">'+checkpointId+'</h4>'+ 
          '<input type="text" class="checkpointLabel" name="checkpointLabel">'+
          '</span><button name="save-marker" class="save-marker" title="Save Label">Save Label</button>'+
          '</div></div>');    
          }else{
          contentString = $('<div class="marker-info-win">'+
          '<div class="marker-inner-win"><span class="info-content">'+
          '<h4 class="marker-heading">'+checkpointId+'</h4>'+ 
          '<h5>Name: '+name+'</h5>'+
          '</span>'+
          '</div></div>');    
          }
              var marker = new google.maps.Marker({
                map: map,
                id: checkpointId,
                name: name,
                position: point
              });

              markers.push(marker);
              marker.addListener('click', function() {
                infoWindow.setContent(contentString[0]);
                infoWindow.open(map, marker);
              });

               var saveBtn = contentString.find('button.save-marker')[0];
               if(saveBtn !== undefined){

                google.maps.event.addDomListener(saveBtn, "click", function(event){
                var value = contentString.find('.checkpointLabel')[0];
                 console.log(saveBtn);
                 console.log(value);
                 console.log(marker.name);
                if(value.value === ''){
                alert("Add label for the checkpoint");
                }else{
                updateLabel(checkpointId, value.value, function(e){
                  alert("Updated");
                   console.log(e);
                   infoWindow.setContent(contentString[0]);
                   infoWindow.open(map, marker);
                });
                }
               });
              }else{

              }
      }

       function downloadUrlCheck(url, callback) {
         $.get( url, function( msg ) {
          callback(msg);
        });
      }

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

       setInterval(function(){
        // alert('300');
      }, 3000);

       function perimeter(loc, map){
        circle = new google.maps.Polygon({
        map: map,
        paths: circlePath(loc, radiusSize, 360),
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
