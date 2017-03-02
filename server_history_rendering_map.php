<?php
  include('db_conn.php');
?>
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
    <script src="dist/js/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="dist/css/sweetalert.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    
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
  </head>

  <body>
    <div class="navbar navbar-fixed-top" style="margin-top:-80px;">
      <center><img src="images/assets/header.png" style="width:400px;"></center>
    </div>
    <a href="server_history.php"><img src="images/assets/back.png" style="width:50px;margin-left: 10px" align="right"></a>
    <a href="index.php"><img src="images/assets/home.png" style="width:50px;" align="right"></a>
    <!--  <div id="right-panel">
      <p>Total Distance: <span id="total"></span></p>
    </div> -->
    <span id="target"></span>
    <span id="checkpoints" ></span>
  <!--   <button  id='missionCompleteBtn' class="btn pull-right btn-default " style="background-color:#bd593d;color:#ffffff;width:20%;margin-top:10px;margin-left: 80%">MISSION COMPLETE</button> -->
    <div class="container" style="margin-top:20px;">
    <p><h4 style="text-transform:uppercase;"><center>Operation :</p><p id="operation_name" style="text-decoration:underline;color:#317fba;text-transform:capitalize;"></p></center></h4>
    <p style="color:#bd593d;font-weight:bold;text-transform:uppercase;margin-bottom:5px;">Date Executed: </p><span id="date_executed"></span>
    <p style="color:#bd593d;font-weight:bold;text-transform:uppercase;margin-bottom:5px;">Number of checkpoint(s): </p><p id="num_officers" style="margin-bottom:20px;"></p>
    <p style="color:#bd593d;font-weight:bold;text-transform:uppercase;margin-bottom:5px;">Target Location: </p><p id="location" style="margin-bottom:20px;"></p>
    <div id="tableDiv">
    <p style="color:#bd593d;font-weight:bold;text-transform:uppercase;margin-bottom:5px;">Checkpoint Composition and Location </p>
    <?php
      $id = $_GET['operation_id'];
      $sql = "SELECT * FROM tbl_operations AS t JOIN criminal_profiling AS cp ON t.operation_id = cp.operation_id JOIN checkpoints AS c ON t.operation_id = c.operation_id JOIN checkpoint_composition AS cc ON c.id = cc.checkpoint_id WHERE t.operation_id = $id";
      $result = $conn->query($sql);
      // $row = $result->fetch(PDO::FETCH_ASSOC);
      echo "<table id='tableId'>";
      // echo "<thead>";
      echo "<tr style='display:none;' data-tableexport-display='always'>";
      echo "<th><center>Republic of the Philippines<br>
      PHILIPPINE NATIONAL POLICE<br>
      EASTERN POLICE DISTRICT<br>
      SAN JUAN CITY POLICE STATION<br>
      Santolan Road, City of San Juan</center></th>";
      echo "<th>Date Executed:<p id='pdf_date_executed'></p></th>";
      echo "</tr>";
      echo "<tr>";
      echo "<th>Location</th>";
      echo "<th>Composition</th>";
      echo "<th>Designation</th>";
      echo "<th>Contact</th>";
      echo "<th>Marked Vehicle</th>";
      echo "</tr>";
      // echo "</thead>";
      // echo "<tbody>";
      while($r = $result->fetch(PDO::FETCH_ASSOC)){
      echo "<tr>";
      echo "<td>".$r['location']."</td>";
      echo "<td>".$r['title']." ".$r['name']."</td>";
      echo "<td>".$r['designation']."</td>";
      echo "<td>".$r['contact']."</td>";
      echo "<td>".$r['marked_vehicle']."</td>";
      echo "</tr>";
      }
      // echo "</tbody>";
      echo "</table>";
    ?>
    </div>
    <div>
    <label>Generate: </label>
    <a href="#" id="generateBtn"> CSV</a>
    <a href="#" id="newGenearateBtn" onClick="doExport('#tableId',
                      {type: 'pdf',
                      fileName:  'Operation_'+document.getElementById('operation_name').innerHTML,
                      theadSelector: 'tr',
                      htmlContent: false,
                        jspdf: {orientation: 'l',
                          margins: {right: 10, left: 10, top: 10, bottom: 40},
                          autotable: {
                          styles: {overflow: 'linebreak'},
                          tableWidth: 'wrap',
                         headerStyles: {fillColor: [52, 73, 94],
                                textColor: 255,
                                fontStyle: 'bold',
                                halign: 'center' }
                          }}});">PDF</a>
    </div>
    <div id="map" ></div>
    <div id="formradius">
    <!-- <input type="number" id="radiussize"> -->
    <!-- <button onClick="release()">Coordinates</button> -->
    </div>
    </div><!-- /.container -->
    <script src="js/boundary.js"></script>

    <script type="text/javascript">
     function doExport(selector, params) {
      var options = {
        //ignoreRow: [1,11,12,-2],
        //ignoreColumn: [0,-1],
        //pdfmake: {enabled: true},
        tableName: 'Operation_'+document.getElementById('operation_name').innerHTML,
        worksheetName: 'Operation_'+document.getElementById('operation_name').innerHTML
      };

      $.extend(true, options, params);

      $(selector).tableExport(options);
    }

    $('#generateBtn').click(function(){
        $("#tableId").tableExport();
    });
   
    // $('#newGenearateBtn').click(function(){
    //     $("tableId").tableExport({type: 'pdf'});
    // });

    var radiusSize = 0;
    var policeMarkers = [];
    var checkpointMarkers = [];
    var breachedSize = 0;
    var breachedArray = [];
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
          document.getElementById('operation_name').innerHTML = parsed.name;
          document.getElementById('date_executed').innerHTML = parsed.date_execute;
          document.getElementById('num_officers').innerHTML = parsed.officers;
          document.getElementById('location').innerHTML = parsed.location;
          document.getElementById('pdf_date_executed').innerHTML = parsed.date_execute;
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
    var infoWindow = new google.maps.InfoWindow();
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
              // console.log(point);
             
              perimeter(point, radiusSize, map);

              var image = {
                  url: 'images/assets/crosshair.png',
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

     downloadUrl('mobile_checkpoints_target.php/?id='+getUrl(), function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
             
            Array.prototype.forEach.call(markers, function(markerElem) {
              var name = markerElem.getAttribute('name');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));
            
              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name;
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));
             
              var text = document.createElement('text');
              text.textContent = name;
              infowincontent.appendChild(text);

               var image = {
              url: 'images/assets/baricade2.png', // image is 512 x 512

              scaledSize: new google.maps.Size(28,28), // scaled size
              origin: new google.maps.Point(0,0), // origin
              anchor: new google.maps.Point(14,28),
            // size: new google.maps.Size(100,100)  
              }; 

               marker = new google.maps.Marker({
                map: map,
                icon: image,
                position: point,
                name: name
              });
               pushMarker(checkpointMarkers, marker, function(){

               });
                google.maps.event.addListener(marker, 'click', (function(marker, infowincontent) {
                  return function(){
                  infoWindow.setContent(infowincontent);
                  infoWindow.open(map, marker);
                }
              })(marker, infowincontent));
            });
            // console.log(xml);
          });

     downloadUrl('server_operationdetails.php/?id='+getUrl(), function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
             
            Array.prototype.forEach.call(markers, function(markerElem) {
              var name = markerElem.getAttribute('name');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));
            
              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name;
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));
             
              var text = document.createElement('text');
              text.textContent = name;
              infowincontent.appendChild(text);

              perimeter(point, radiusSize, map);

               var image = {
              url: 'images/assets/barricade_breached.png', // image is 512 x 512

              scaledSize: new google.maps.Size(28,28), // scaled size
              origin: new google.maps.Point(0,0), // origin
              anchor: new google.maps.Point(14,28),
            // size: new google.maps.Size(100,100)  
              }; 

               marker = new google.maps.Marker({
                map: map,
                icon: image,
                position: point,
                name: name
              });

                google.maps.event.addListener(marker, 'click', (function(marker, infowincontent) {
                  return function(){
                  infoWindow.setContent(infowincontent);
                  infoWindow.open(map, marker);
                }
              })(marker, infowincontent));
            });
            // console.log(xml);
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

     
  
       function perimeter(loc, size, map){
        circle = new google.maps.Polygon({
        map: map,
        paths: circlePath(loc, size, 360),
        center: loc,
        strokeColor: '#FF0000',
        strokeOpacity: 0.35,
        strokeWeight: 2,
        clickable: false,
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

    function directionService(origin, destination){
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer({
          draggable: true,
          map: map,
          panel: document.getElementById('right-panel')
        });

        directionsDisplay.addListener('directions_changed', function() {
          computeTotalDistance(directionsDisplay.getDirections());
        });
    
        displayRoute(origin, destination, directionsService,
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

      function pushMarker(array, data, callback){
          array.push(data);
       
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

    <!-- <script src="js/FileSaver.js"></script>
    <script src="js/tableexport.js"></script> -->
    <script type="text/javascript" src="libs/js-xlsx/xlsx.core.min.js"></script>
    <script type="text/javascript" src="libs/FileSaver/FileSaver.min.js"></script>
    <!--
    <script type="text/javascript" src="../libs/pdfmake/pdfmake.min.js"></script>
    <script type="text/javascript" src="../libs/pdfmake/vfs_fonts.js"></script>
    -->
    <script type="text/javascript" src="libs/jsPDF/jspdf.min.js"></script>
    <script type="text/javascript" src="libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
    <script type="text/javascript" src="libs/html2canvas/html2canvas.min.js"></script>
    <script type="text/javascript" src="tableExport.js"></script>
  </body>
</html>
