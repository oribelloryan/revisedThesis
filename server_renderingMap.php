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
    <div class="navbar navbar-fixed-top" style="margin-top:-80px;">
      <center><img src="images/header.png" style="width:400px;"></center>
    </div>
    <!--  <div id="right-panel">
      <p>Total Distance: <span id="total"></span></p>
    </div> -->
    <span id="target"></span>
    <span id="checkpoints" ></span>
    <button  id='missionCompleteBtn' class="btn pull-right btn-default " style="background-color:#bd593d;color:#ffffff;width:20%;margin-top:10px;margin-left: 80%">MISSION COMPLETE</button>
    <div class="container" style="margin-top:20px;">
    <p><h4 style="text-transform:uppercase;"><center>Operation :</p><p id="operation_name" style="text-decoration:underline;color:#317fba;text-transform:capitalize;"></p></center></h4>
    <p style="color:#bd593d;font-weight:bold;text-transform:uppercase;margin-bottom:5px;">Date Executed: </p><span id="date_executed"></span>
    <p style="color:#bd593d;font-weight:bold;text-transform:uppercase;margin-bottom:5px;">Number of checkpoint(s): </p><p id="num_officers" style="margin-bottom:20px;"></p>
    <p style="color:#bd593d;font-weight:bold;text-transform:uppercase;margin-bottom:5px;">Target Location: </p><p id="location" style="margin-bottom:20px;"></p>
     <div id="savingDiv" style=" margin: 0 auto;text-align: center; ">
   
    </div>
    <div id="map" ></div>
    <div id="formradius">
    <!-- <input type="number" id="radiussize"> -->
    <!-- <button onClick="release()">Coordinates</button> -->

    </div>
    </div><!-- /.container -->
    <script src="js/boundary.js"></script>
    <script type="text/javascript">
    var radiusSize = 0;
    var policeMarkers = [];
    var checkpointMarkers = [];
    var breachedSize = 0;
    var breachedArray = [];
    var password;
    var operationName;
    var markers = [];
    var complete = 'not complete';
    var boundary;
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
          document.getElementById('location').innerHTML = parsed.location;
          password = parsed.password;
          operationName = parsed.name;
        }
        });

    var minZoomLevel = 15;
    var centeroftheearth = {lat: 14.600353, lng: 121.036745};    
    var map;
    var markers = [];

    var missionComplete = document.getElementById('missionCompleteBtn');

    missionComplete.addEventListener('click', function(){
      swal({
           title: "Mission Complete",
           text: "Proceeding this event will finish the on-going operation",
           type: "warning",
           showCancelButton: true,
           confirmButtonColor: '#DD6B55',
           confirmButtonText: 'Proceed',
           cancelButtonText: "Cancel",
           closeOnConfirm: false,
           closeOnCancel: true
          }, function(isConfirm){

            if (isConfirm){
              swal({
                title: "Operation Password",
                text: "Please provide the operation password",
                type: "input",
                showCancelButton: true,
                closeOnConfirm: false,
                closeOnCancel: true,
                animation: "slide-from-top",
                confirmButtonColor: '#DD6B55',
                showLoaderOnConfirm: true,
                inputPlaceholder: "Operation Password"
              },
              function(inputValue){
  
                if (inputValue === "") {
                  swal.showInputError("Please provide the operation name");
                  return false;
                }else if(inputValue === password){
                   var setTimer = setInterval(function(){
                 $.ajax({
                  url: "server_mission_complete.php",
                  type: "POST",
                  data:{
                    id: oppId
                  },
                  success: function(msg){
                      swal(msg);
                      clearInterval(setTimer);
                      
                      complete = 'complete';
                      setTimeout(function(){
                        swal("Please wait... you'll be redirected");
                        window.location.href = "server_view_plan.php";
                      }, 2000);
                      
                  },
                  error: function(){  
                    swal("Error in sending request","","error");
                     clearInterval(setTimer);
                  }
                 });
                 
                  }, 1000)
                }else{
                  swal.showInputError("Wrong Password");
                }
              });
            } 
        });
    });

    function saveFn(e){
      var markersPass = JSON.stringify(getMarkersPosition());
      swal({
           title: "Deploying Breach",
           text: "This new breached will be scene by the deployed police",
           type: "",
           showCancelButton: true,
           confirmButtonColor: '#DD6B55',
           confirmButtonText: 'Proceed',
           cancelButtonText: "Cancel",
           closeOnConfirm: false,
           closeOnCancel: true
          }, function(isConfirm){

            $.ajax({
              url: "server_saving_breached.php",
              type: "POST",
              data:{
                src: 'save',
                markers: markersPass,
                id: oppId,
                checkpointId: e.getAttribute('value-id'),
                name: e.getAttribute('value-name')
              },
              success: function(data){
                commit();
                e.remove();
                swal("Success");
              }
            })
    
          
        });
    }

    function commit(){
      markers.forEach(function(item, index){
        var contentString =  "<div>"+
            "<p>Location Address: </p>"+
            "</div>";
        infowindow.setContent(contentString);
        infowindow.open(map, item);
      });
    }

    function initMap(){
    map = new google.maps.Map(document.getElementById('map'), {
    zoom: minZoomLevel,
    fullscreenControl: true,
    center: centeroftheearth ,
    mapTypeId: 'roadmap'
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

    var infoWindow = new google.maps.InfoWindow();

     google.maps.event.addListener(map, 'rightclick', function(event){
          snapToRoad(event.latLng);
        });
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
              map.setCenter(point);
              map.setZoom(17);
              // var text = document.createElement('text');
              // text.textContent = name
              // infowincontent.appendChild(text);
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

              // targetMarker.addListener('click', function() {
              //   infoWindow.setContent(infowincontent);
              //   infoWindow.open(map, marker);
              // });
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
                  url: 'images/baricade2.png',
           // size: new google.maps.Size(71, 71),
                  anchor: new google.maps.Point(10, 10),
                  scaledSize: new google.maps.Size(30, 30)
               };

               marker = new google.maps.Marker({
                map: map,
                icon: image,
                position: point,
                name: name
              });

            var policeMarkerImage = {
                  url: 'images/policecap.png',
           // size: new google.maps.Size(71, 71),
                  anchor: new google.maps.Point(10, 10),
                  scaledSize: new google.maps.Size(40, 40)
               };

            var policeMarker = new google.maps.Marker({
                position: point,
                icon: policeMarkerImage,
                // map: map,
                name: name
              });

            policeMarkers.push(policeMarker);
            checkpointMarkers.push(marker);
               // pushMarker(checkpointMarkers, marker, function(){

               // });

                google.maps.event.addListener(marker, 'click', (function(marker, infowincontent) {
                  return function(){
                  infoWindow.setContent(infowincontent);
                  infoWindow.open(map, marker);
                }
              })(marker, infowincontent));
            });
            // console.log(xml);
          });



    setInterval(function(){
    downloadUrl('server_tracking.php?id='+getUrl()+'&?name='+operationName, function(data) {
          // console.log(data);
           var dataPass = JSON.parse(data.response);
         
          for (var i = 0; i < dataPass.polices.length; i++) {
          var counter = dataPass.polices[i];
          
          for(var x = 0; x < policeMarkers.length; x++){

          if(policeMarkers[x].name == counter.name){
             // console.log(policeMarkers[x].name);
          var point = {
            lat: counter.lat * 1,
            lng: counter.lng * 1
          };
          policeMarkers[x].setPosition(point);
          policeMarkers[x].setMap(map);
          
          
        //       var infoWindow = google.maps.InfoWindow();
        //       var pointFormatted = point.lat+','+point.lng;
        //       createMarker(policeMarker, counter.name, infoWindow);
        //       markerAddress(pointFormatted, function(e){
           
        //       pushMarker(policeMarkers, policeMarker, function(){
        //          directionService(new google.maps.LatLng(policeMarkers.position), new google.maps.LatLng( checkpointMarkers.position));
        //       });
            

        //     }
          
        // }
        //   // console.log(dataPass);
           }
        }
      }
        });
    },5000);
      
        setInterval(function(){
            downloadUrl('server_breached.php?id='+getUrl(), function(data) {
              var dataPass = JSON.parse(data.response);
              // console.log(dataPass);
              for (var i = 0; i < dataPass.breached.length; i++) {
              var breached = dataPass.breached[i];
              var point = {
                  lat: breached.lat * 1,
                  lng: breached.lng * 1
              };

              if(breached.breached === 'yes'){
              swal('Breached', "At " + breached.name, 'warning');
              // var cityCircle = new google.maps.Circle({
              //      strokeColor: '#FF0000',
              //      strokeOpacity: 0.8,
              //      strokeWeight: 1,
              //      fillColor: '#FF0000',
              //      fillOpacity: 0.02,
              //      map: map,
              //      center: point,
              //      radius: radiusSize * 1
              //   }); 
              perimeterBreached(new google.maps.LatLng(point), radiusSize * 1, map);

              var image = {
                  url: 'images/barricade_breached.png',
           // size: new google.maps.Size(71, 71),
                  anchor: new google.maps.Point(10, 10),
                  scaledSize: new google.maps.Size(40, 40)
               };
               barricade_breached = new google.maps.Marker({
                position: point,
                icon: image,
                map: map,
              });
                $('#savingDiv').append('<button style="background-color:#2b3f6d;color:#ffffff;width:20%;" onclick="saveFn(this)" value-id='+breached.checkpoint_id+' value-name='+breached.name+'>SAVE BREACHED</button>');
                breachedArray.push(breached);
                map.setCenter(point);
                map.setZoom(18);
                downloadUrl('server_breachedUpdating.php?checkpoint='+breached.checkpoint_id, function(data){
                });
              }
            }
            });
        }, 3000);

        function createBreached(){
            
        }

        setInterval(function(){
          var x,y;
          if(directionService != 'complete'){
          for(x = 0; x < policeMarkers.length; x++){
            for(y = 0; y < checkpointMarkers.length; y++){
              // console.log("here");
              // console.log(checkpointMarkers[y].name);
              if(policeMarkers[x].name === checkpointMarkers[y].name){
              directionService(policeMarkers[x].getPosition(), checkpointMarkers[y].getPosition(), x);
            }
            }
          }
        }
        },5000);

      }

      //    function showPolice(){
      //     // console.log(policeMarkers);
      //     // // policeMarkers[0].setMap(map);
      //     // console.log(map);
      //     var i;
      //  for(i = 0; i < policeMarkers.length; i++){
      //     // console.log("show");
      //    policeMarkers[i].setMap(map);
      //  }
      // }

      function createMarker(marker, loc, infowindow){
      console.log(counter.name);
        var contentString = "<div>"+
            "<p>Location Address: "+loc+"</p>"+
            "</div>";

             
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.setContent(contentString);
            infowindow.open(map, marker); // click on marker opens info window
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

        function markerAddress(e, callback){
      var value;
       $.ajax({
           type: "GET",
           url: " https://maps.googleapis.com/maps/api/geocode/json?latlng="+e+"&key=AIzaSyAjWM8z2Q0G7IzoMoD75WCGTRTTNlYiCGI",
           success: function(msg){
             value = msg.results[0].formatted_address;
             callback(value);
           }
           
       });
    }
        
     function deleteMarker(e){
      // var x = confirm('Are you sure to delete this checkpoint?');
      // if(x){
     swal({
          title: "Are you sure to delete the checkpoint ?",
          text: "This could not be reverted back",
          type: "",
          showCancelButton: true,
          confirmButtonColor: '#DD6B55',
          confirmButtonText: 'Yes, delete marker',
          cancelButtonText: "No",
          closeOnConfirm: false,
          closeOnCancel: true
          },
      function(isConfirm){
      if(isConfirm){
      var value = e.getAttribute('data-value');
      // console.log(value);
      // console.log("pos"+markers[1].get('id'));
      var i;
      for(i = 0; i < markers.length; i++){
        // console.log(markers[i].get('id'));
        if(markers[i].get('id') == value){
        markers[i].setMap(null);
        markers.splice(i,1);
        swal("Checkpoint Deleted","","success");
        }
      }
      
      }
      });

    }

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

        function perimeterBreached(loc, size, map){
        newCircle = new google.maps.Polygon({
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
        newCircle.setMap(map);
      }


        function circlePath(center,radius,points){
        var a=[],p=360/points,d=0;
        for(var i=0;i<points;++i,d+=p){
            if(google.maps.geometry.poly.containsLocation(google.maps.geometry.spherical.computeOffset(center,radius,d), boundary)){
              a.push(google.maps.geometry.spherical.computeOffset(center,radius,d));
            }else{
              // var geoLat = google.maps.geometry.spherical.computeOffset(center,radius,d);
              // for (var i = 0; i < boundaries.length; i++) {
              // if(boundaries[i].lat > geoLat.lat || boundaries[i].lng < geoLat.lng){
              //   a.push(boundaries[i]);
              //   i = boundaries.lenght + 100;
              //   break;
              // }
           }
         }
        return a;
      }

      function directionService(origin, destination, index){
        var color = ['gold', 'blue', 'green', 'yellow', 'red', 'pink', 'purple', 'gold', 'green'];
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer({
          draggable: false,
          map: map,
          // panel: document.getElementById('right-panel')
        });
        directionsDisplay.setMap(map);
        directionsDisplay.setOptions( { 
          polylineOptions: {
            strokeWeight: 4,
            strokeOpacity: 1,
            strokeColor:  color[index]
        },
          suppressMarkers: true,
          preserveViewport: true,
          routeIndex: 5 } );

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
          avoidTolls: false,
          optimizeWaypoints: true,
          provideRouteAlternatives: true,
        }, function(response, status) {
          if(status === 'OK') {
            display.setDirections(response);
          } else {
            // alert('Could not display directions due to: ' + status);
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
        distanceBetween = total;
        // alert(total);
        // document.getElementById('total').innerHTML = total + ' km';
      }

      function pushMarker(array, data, callback){
          array.push(data);
      }

       function locationPass(e){
      var data = e.lat()+','+e.lng();
      return data;
      }

      function getMarkersPosition(){
      var markersPosition = [];
      markers.forEach(function(x, y){
        var pos = x.getPosition();
        var obj = {
          lat: pos.lat(),
          lng: pos.lng(),
          location: x.location
        }
        markersPosition.push(obj);
      });
      return markersPosition;
      }

       function snapToRoad(data){
      var latitude, longitude;
      var dot = locationPass(data);
      
      $.ajax({ 
        url : "https://roads.googleapis.com/v1/nearestRoads?points="+dot+"&key=AIzaSyAjWM8z2Q0G7IzoMoD75WCGTRTTNlYiCGI",
        type: "GET",
        beforeSend: function(){
            $("body").addClass("loading");
        },
        success: function( msg ) {
        latitude = msg.snappedPoints[0].location.latitude;
        longitude = msg.snappedPoints[0].location.longitude;
        var pos = {
          lat: latitude,
          lng: longitude
        };
        var ofPerimeter = google.maps.geometry.poly.containsLocation(new google.maps.LatLng(pos), newCircle);

        if(ofPerimeter){
         var image = {
          url: 'images/barricade_breached.png', // image is 512 x 512

          scaledSize: new google.maps.Size(28,28), // scaled size
            origin: new google.maps.Point(0,0), // origin
            anchor: new google.maps.Point(14,28),
            // size: new google.maps.Size(100,100)  
        }; 
        var posTarget = pos.lat+','+pos.lng;
        targetAddress(posTarget, function(e){

         var targetMarker = new google.maps.Marker({
             position: pos,
             icon: image,
             map: map,
             id: posTarget,
             location: e
         });

         var contentString = "<div>"+
         "<p>Location Address: "+e+"</p>"+
         '<input type="button" class="deleteMarker" data-value="'+posTarget+'" onClick="deleteMarker(this)" value="DELETE MARKER"/>'+
         "</div>";

         infowindow = new google.maps.InfoWindow();
         google.maps.event.addListener(targetMarker, 'click', function() {
                infowindow.setContent(contentString);
                // infowindow.setPosition(new google.maps.LatLng(pos.lat - 0.1, pos.lng - 0.1));
                infowindow.open(map, targetMarker); // click on marker opens info window

        });
         
          targetMarker.setAnimation(google.maps.Animation.DROP);
          targetMarker.setMap(map);
          markers.push(targetMarker);
           });
          }else{
            swal('Sorry', 'The targeted road is not within the perimeter', 'warning');
          }
         },
         complete: function(){
            $("body").removeClass("loading");
         }
        });
       
      
    }
      function updateSaveMarker(){
        $.ajax({
          url: "server_saving_breached.php",
          type: "POST",
          data:{
            src: "update",
            id: oppId
          },
          success: function(e){
            alert(e);
          }
        });

      }

      function targetAddress(e, callback){
      var value;
       $.ajax({
           type: "GET",
           url: " https://maps.googleapis.com/maps/api/geocode/json?latlng="+e+"&key=AIzaSyAjWM8z2Q0G7IzoMoD75WCGTRTTNlYiCGI",
           beforeSend: function(){
            $("body").addClass("loading");
            },
           success: function(msg){
             value = msg.results[0].formatted_address;
             callback(value);
           },
           complete: function(){
            $("body").removeClass("loading");
           }
       });
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
