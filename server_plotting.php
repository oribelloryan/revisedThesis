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
        height: 570px;
        visibility:hidden;
      }
      #saveBtn, #address, #checkpointSpan, #changeTargetBtn, #targetSpan{
        visibility:hidden;
      }.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    background: rgba(255, 255, 255, .8) url('images/load.gif') 50% 50% no-repeat;
    }
/* When the body has the loading class, we turn
   the scrollbar off with overflow:hidden */
    body.loading {
    /*background-color: red;*/
    overflow: hidden;
  }
/* Anytime the body has the loading class, our
   modal element will be visible */
    body.loading .modal {
    display: block;
  }
    </style>

   </head>

    <body>
    <div class="navbar navbar-fixed-top" style="margin-top:-80px;">
      <center><img src="images/header.png" style="width:400px;"></center>
    </div>
    <div class="modal"></div>

    <div class="container" style="margin-top:20px;">
   
    <div id="formradius">
    <!--<p id="mensahe">PLEASE SET RADIUS FIRST</p>-->
    <label id="mensahe">PLEASE SET RADIUS FIRST</label>
    <input type="number" class="form-control" id="radiussize" style="width:10%;">
    <button onClick="changeradius('changeRadius')" class="btn btn-default" style="background-color:#2b3f6d;color:#ffffff;width:20%;margin-top:-70px;margin-left:100px;"><span id="set">SET RADIUS SIZE(m)</span></button>
    <button onClick="changeTarget('changeTarget')" id="changeTargetBtn" class="btn btn-default" style="background-color:#2b3f6d;color:#ffffff;width:20%;margin-top:-70px;margin-left:10px;">CHANGE TARGET</button>
    <button id="saveBtn" onClick="saving()" class="btn btn-default" style="background-color:#2b3f6d;color:#ffffff;width:20%;margin-top:-70px;margin-left:10px;">SAVE MAP</button>
    <br/>
    <!--<span id = "address"><span>Target Address: </span> <span id= "targetAddress">None</span> </span>-->
    <br/>
    <p id = 'checkpointSpan' style="color:#bd593d;font-weight:bold;text-transform:uppercase;margin-top:-30px;">Number of checkpoints: </p><label id = 'checkpointsCounter' style="text-decoration:underline;"></label><br>
    <p id='targetSpan' style="color:#bd593d;font-weight:bold;text-transform:uppercase;">Target Location: </p><label id = 'targetLabel' style="text-decoration:underline;"></label>
    <input type="hidden" id="targetHdn" />
    <input type="hidden" id="checkpointsHdn" />
    </div>
    <br/>
    <center><div id="map" ></div></center>
    </div><!-- /.container -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="js/boundary.js"></script>
    <script type="text/javascript">

    var radiusSize = 0;
    var markers = [];
    var locations = [];
    var poly;
    var circle;
    var perimeterOpen = false;
    var isOfCity;
    var pastRadiusSize;
    var index = 0;
    var save = document.getElementById('saveBtn');

    function changeradius(e){
        radiusSize = document.getElementById("radiussize").value;
        var radiusText = document.getElementById("set").innerHTML;
         if(radiusSize < 250 ){
                swal("Size too small" ,"Radius size is smaller than the recommended size", "error");
                document.getElementById("map").style.visibility = 'hidden';
         }else if(radiusSize > 1000){
                swal("Size too big" ,"Radius size is bigger than the recommended size", "error");
                document.getElementById("map").style.visibility = 'hidden';
         }else{
                document.getElementById("map").style.visibility = 'visible';
              if(radiusText === "SET RADIUS SIZE(m)"){
                    pastRadiusSize = radiusSize;
                    swal("Your radius size: "+radiusSize+" meters");
                    document.getElementById("mensahe").innerHTML = 'PLOTPOINTS';
                    document.getElementById("set").innerHTML = 'UPDATE RADIUS SIZE';
                    console.log('pastRadiusSize:'+pastRadiusSize);
               }else{
                  console.log("radiusSize: "+radiusSize);
                  // if(circle === undefined){
                  //   swal("nothing");
                  // }else{
                  if(pastRadiusSize === radiusSize){
                    swal("Same Radius");
                  }else{
                    if(perimeterOpen === false){
                     swal("Radius Updated");
                    }else{
                    changeTarget(e);
                    }
                  }
              
                  // }
              }
         }
    }

    function changeTarget(source){
      var title, text, confirm, swalTitle, swalText;
      if(source === 'changeRadius'){
      title = "Are you sure to update the Radius Size?";
      text = "It will delete previous perimeter data";
      confirm = "Update Radius";
      swalTitle = "Update Radius Complete";
      swalText = "Radius Updated";
      }else if(source == 'changeTarget'){
      title = "Are you sure to change target?";
      text = "The target area will be deleted";
      confirm = "Change Target";
      swalTitle = "Change Target Complete";
      swalText = "Map Cleared";
      }

      swal({
         title: title,
         text: text,
         type: "",
         showCancelButton: true,
         confirmButtonColor: '#DD6B55',
         confirmButtonText: confirm,
         cancelButtonText: "Cancel",
         closeOnConfirm: false,
         closeOnCancel: true
        },
      function(isConfirm){
        if(isConfirm){
        removeEverything();
        swal(swalTitle, swalText, "success");
    }
    });
  }
    function removeEverything(){
        setMapOnAll(null);
        circle.setMap(null);
        markers = [];
        perimeterOpen = false;
        
        document.getElementById("targetSpan").style.visibility = 'hidden';
        document.getElementById("checkpointSpan").style.visibility = 'hidden';
        document.getElementById("changeTargetBtn").style.visibility = 'hidden';
        document.getElementById("targetLabel").style.visibility = 'hidden';
        document.getElementById("checkpointsCounter").style.visibility = 'hidden';
        document.getElementById("saveBtn").style.visibility = 'hidden';
    }

     function setMapOnAll(map){
        for (var i = 0; i < markers.length; i++) {
          markers[i].setMap(map);
        }
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

         var image = {
          url: 'images/baricade2.png', // image is 512 x 512
          scaledSize: new google.maps.Size(28, 28), // scaled size
            origin: new google.maps.Point(0,0), // origin
            anchor: new google.maps.Point(0, 0)  

        }; 
         var targetMarker = new google.maps.Marker({
             position: pos,
             icon: image,
             map: map,
             id: index
         });
         checkpointsCounterFn();

       // google.maps.event.addListener(targetMarker, 'rightclick', (function(marker, content, infowindow){
          
       //    return function(){
       //    infoWindow.setContent("deletMe");
       //    infowindow.open(map, marker);
       //    };

       // })(targetMarker, "deleteContent", deleteWindow));

          targetMarker.setAnimation(google.maps.Animation.DROP);
          targetMarker.setMap(map);
          markers.push(targetMarker);
          save.style.visibility = 'visible';
         },
         complete: function(){
            $("body").removeClass("loading");
         }
        });
        // google.maps.event.addListener(marker, 'click', function() {
        //         infowindow.open(map,marker); // click on marker opens info window 
        // });
        

        // //###### remove marker #########/
        // var removeBtn   = contentString.find('button.remove-marker')[0];
        // google.maps.event.addDomListener(removeBtn, "click", function(event) {
        //     targetMarker.setMap(null);
        // });
       index++;
    }

    function locationPass(e){
      var data = e.lat()+','+e.lng();
      return data;
    }

    function deleteMarker(e){
      alert(e);
    }

    function addPerimeter(loc){
       // circle = new google.maps.Circle({
       //      strokeColor: '#FF0000',
       //      strokeOpacity: 0.8,
       //      strokeWeight: 2,
       //      fillColor: '#FF0000',
       //      fillOpacity: 0.35,
       //      map: map,
       //      center: loc,
       //      radius: radiusSize * 1        
       // });
       circle = new google.maps.Polygon({
        map: map,
        paths: circlePath(loc , radiusSize, 360),
        center: loc,
        strokeColor: '#FF0000',
        strokeOpacity: 0.35,
        strokeWeight: 2,
        clickable: false,
        fillColor: '#FF0000',
        fillOpacity: 0.05,
      });
       

        var image = {
           url: 'images/crosshair.png',
           // size: new google.maps.Size(71, 71),
           anchor: new google.maps.Point(10, 10),
           scaledSize: new google.maps.Size(25, 25)
        };

        var targetMarker = new google.maps.Marker({
             position: loc,
             icon: image,
             map: map,
             id: index
         });

        markers.push(targetMarker);
    }

    function setPerimeter(){
     
       return true;
    }


    function getMarkersPosition(){
      var markersPosition = [];
      markers.forEach(function(x, y){
        markersPosition.push(x.getPosition());
      });
      return markersPosition;
    }

    function checkpointsCounterFn(){
      var element = document.getElementById('checkpointsCounter');
      element.style.visibility = 'visible';
      element.innerHTML = markers.length;
    }

    function circlePath(center,radius,points){
        var a=[],p=360/points,d=0;
        for(var i=0;i<points;++i,d+=p){
            if(google.maps.geometry.poly.containsLocation(google.maps.geometry.spherical.computeOffset(center,radius,d), boundary)){
              a.push(google.maps.geometry.spherical.computeOffset(center,radius,d));
            }else{
          //     var geoLat = google.maps.geometry.spherical.computeOffset(center,radius,d);
          //     for (var i = 0; i < boundaries.length; i++) {
          //     if(boundaries[i].lat > geoLat.lat || boundaries[i].lng < geoLat.lng){
          //       a.push(boundaries[i]);
          //       i = boundaries.lenght + 100;
          //       break;
          //     }
          // }
         }
        }
        return a;
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
            minZoom: minZoomLevel,
            scrollwheel: false,
            navigationControl: false,
            mapTypeControl: true,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                position: google.maps.ControlPosition.TOP_CENTER
            },
            scaleControl: false,
            fullscreenControl: true,
            center: centeroftheearth ,
            mapTypeId: 'roadmap'
        });
        
        // infoWindow = new google.maps.InfoWindow({map: map});
        // infoWindow.setContent('center');
        // infoWindow.setPosition(map.getCenter());
        // if (navigator.geolocation) {
        //   navigator.geolocation.getCurrentPosition(function(position) {
        //     var pos = {
        //       lat: position.coords.latitude,
        //       lng: position.coords.longitude
        //     };
        //     locationAddress = pos.lat + ',' + pos.lng;
        //     infoWindow.setPosition(pos);
        //     infoWindow.setContent(locationAddress);
        //     map.setCenter(pos);
        //   }, function() {
        //     handleLocationError(true, infoWindow, map.getCenter());
        //   });
        // } else {
        //   // Browser doesn't support Geolocation
        //   handleLocationError(false, infoWindow, map.getCenter());
        // }

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

    //     google.maps.event.addListener(map, 'dragend', function() {
    //         if (strictBounds.contains(map.getCenter())){ return;}
    // // We're out of bounds - Move the map back within the bounds
    //             var c = map.getCenter(),
    //             x = c.lng(),
    //             y = c.lat(),
    //             maxX = strictBounds.getNorthEast().lng(),
    //             maxY = strictBounds.getNorthEast().lat(),
    //             minX = strictBounds.getSouthWest().lng(),
    //             minY = strictBounds.getSouthWest().lat();
    //             if (x < minX) x = minX;
    //             if (x > maxX) x = maxX;
    //             if (y < minY) y = minY;
    //             if (y > maxY) y = maxY;
    //             map.setCenter(new google.maps.LatLng(y,x));
    //     });

        var strictBounds = new google.maps.LatLngBounds(
            new google.maps.LatLng(14.613933, 121.059318),
            new google.maps.LatLng(14.590750, 121.018495) 
        );

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
        isOfCity =  google.maps.geometry.poly.containsLocation(event.latLng, boundary);
        if(perimeterOpen === false){
          
          
              if(isOfCity){
               targetAddress(locationPass(event.latLng), function(back){
                    swal({
                      title: "Are you sure to target:"+back+" ?",
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
                        document.getElementById('targetLabel').style.visibility = "visible";
                        document.getElementById('targetLabel').innerHTML = back;
                        checkpointSpanVisibility(true);
                        swal("Area Locked", "Targeted Place", "success");
                        addPerimeter(event.latLng);
                        perimeterOpen = setPerimeter();
                        if(radiusSize <= 400){
                        map.setCenter(event.latLng);
                        map.setZoom(17);
                        }else if(radiusSize > 400 && radiusSize < 500){
                        map.setCenter(event.latLng);
                        map.setZoom(16);
                        }
                        changeTargetBtn.style.visibility = "visible";
                        document.getElementById('targetSpan').style.visibility = "visible";
                      } else {
                        swal("Cancelled");
                      }
                    });
                });
              
              }else{
                  swal('Out of Bounds', 'That is not part of San Juan City', 'warning');
              }
        }else{
          // google.maps.event.trigger(circle, 'click');
          // google.maps.event.addListener(circle, 'click', function(e){
          //   console.log(e.latLng);
          //   snapToRoad(e.latLng);
          // });
          // console.log(event);
       
          var isOfPerimeter = google.maps.geometry.poly.containsLocation(event.latLng, circle);
            if(isOfCity){
              if(isOfPerimeter){
                  snapToRoad(event.latLng);
              }else{
                  swal('Out of Bounds', 'that is not within the perimeter', 'warning');
              }
            }else{
                  swal('Out of Bounds', 'That is not part of San Juan City', 'warning');
            }

         }
      });
    }


    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
      }
   
   
    function checkpointSpanVisibility(v){
      var c = document.getElementById('checkpointSpan');

      if(v){
        c.style.visibility = 'visible';
      }else{
        c.style.visibility = 'hidden';
      }
    }

    function saving(){
      swal({
              title: "This will save the plan to database.",
              text: "Are you sure?",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: '#DD6B55',
              confirmButtonText: 'Yes',
              cancelButtonText: "No",
              closeOnConfirm: true,
              closeOnCancel: true
              },
             function(isConfirm){
               if (isConfirm){
                var passData = JSON.stringify(getMarkersPosition());
                  $.ajax({
                    type: "POST",
                    url: "server_plottingAjax.php",
                    data: {
                       markers: passData,
                       radius: radiusSize,
                       checkpoint: markers.length
                    },
                    success: function(msg){ 
                      var msg = JSON.parse(msg);
                     if(msg.status == "ok"){
                       var time = 3;
                       var timer;
                       setInterval(function(){ 
                        time = time - 1;
                        swal("Success! You'll be redirected in " + time,'', 'success');
                        if(time < 1){
                          window.location.href = 'server_checkpointLabeling.php?operation_id='+msg.id;
                        }else if(time < 0){
                          window.location.href = 'server_checkpointLabeling.php?operation_id='+msg.id;
                        }
                      }, 1000);
                     }else{
                       swal('Error in saving');
                     }
                     },
                      beforeSend: function(){
                        $("body").addClass("loading");
                      },
                      complete: function(){
                        $("body").removeClass("loading");
                      }
                   });
              } else {
                swal("Cancelled");
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