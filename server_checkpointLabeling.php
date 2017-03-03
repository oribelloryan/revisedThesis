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
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous">
    </script>
    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dist/css/starter-template.css" rel="stylesheet">
    <link href="dist/css/starter-template.css" rel="stylesheet">
    <script src="dist/js/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="dist/css/sweetalert.css">
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
      .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      top: 0;
      left: 0;
      height: 100%;
      width: 100%;
      background: rgba(255, 255, 255, .8) url('images/assets/load.gif') 50% 50% no-repeat;
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
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
          </div>
          <div class="modal-body">
            <form action="" method="POST">
              <select name="lead" class="form-control" style="width:20%;">
              <option value="PSINSP">PSINP</option>    
              <option value="PINSP">PINSP</option>
              <option value="SPO4">SPO4</option>
              <option value="SPO3">SPO3</option>         
              <option value="SPO2">SPO2</option>
              <option value="SPO1">SPO1</option>
              </select>
              <input type="text" class="form-control" name="lead_name" placeholder="Enter Full Name" style="margin-top:-7.25%;margin-left:22%;width:40%;" required>
              <select name="lead_pos" class="form-control" style="width:38%;margin-top:-7.25%;margin-left:65%;">
              <option hidden>Checkpoint Position</option>
              <option value="Team Leader">Team Leader</option>
              </select>
              <br>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
        
      </div>
    </div>

    <div class="navbar navbar-fixed-top" style="margin-top:-80px;">
      <center><img src="images/assets/header.png"" style="width:400px;"></center>
    </div>
    <div class="modal"></div>

    <a href="index.php"><img src="images/assets/home.png" style="width:50px;" align="right"></a>
    <div class="container" style="margin-top:50px;">    
      <p><h4 style="text-transform:uppercase;"><center>Operation :</p><p id="operation_name" style="text-decoration:underline;color:#317fba;text-transform:capitalize;"></p></center></h4>
      <p style="color:#bd593d;font-weight:bold;text-transform:uppercase;margin-bottom:5px;">Date Executed:</p> <span id="date_executed"></span>
      <p id = 'checkpointSpan' style="color:#bd593d;font-weight:bold;text-transform:uppercase;margin-bottom:5px;">Number of checkpoints:</p> <p id="num_officers" style="margin-bottom:20px;"></p>
      <p style="color:#bd593d;font-weight:bold;text-transform:uppercase;margin-bottom:5px;">Target Location: </p><p id="location" style="margin-bottom:20px;"></p>
      <div>
      <img src="images/assets/header.png" style="width:35px;height:35px;visibility:hidden" id="img">
      <button  id='officerCompositionBtn' class="btn pull-right btn-default " style="background-color:#bd593d;color:#ffffff;width:20%;margin-top:10px;margin-left: 80%">Add officer composition</button>
      </div>
      <div id="map" ></div>
    </div><!-- /.container -->
    <script src="js/boundary.js"></script>
    <script type="text/javascript">
        var markers = [];
        var radiusSize = 0;
        var boundary;
        var openEdit = false;
      
        function getUrl(){
            var url = window.location.href;
            var start = url.indexOf('=')+1;
            var id = url.substring(start);
            return id;
        }
        
        document.getElementById('officerCompositionBtn').onclick = function(){
          window.location = 'server_officer_designation.php?id='+oppId;
        };

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
                document.getElementById('img').src = parsed.criminal_image;
                
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

            // var boundary = new google.maps.Polygon({paths: boundaries});
    
            var boundaryLine = new google.maps.Polyline({
                path: boundaries,
                geodesic: true,
                strokeColor: '#FF0000',
                strokeOpacity: 1.0,
                strokeWeight: 2
            });

            boundary = new google.maps.Polygon({paths: boundaries});
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

                    map.setCenter(point);
                    map.setZoom(17);
                    var imageSrc = document.getElementById('img').src;
                    var text = document.createElement('text');
                    text.textContent = name
                    infowincontent.appendChild(text);
                    
                    if(imageSrc == ''){
                      imageSrc = 'images/assets/crosshair.png';
                    }

                    var image = {
                        url: imageSrc,
                     // size: new google.maps.Size(71, 71),
                        anchor: new google.maps.Point(10, 10),
                        scaledSize: new google.maps.Size(25, 25)
                    };

                    var targetMarker = new google.maps.Marker({
                        position: point,
                        icon: image,
                        map: map,
                    });
                });
            });
    // https://interceptorpnp.000webhostapp.com/
            downloadUrlCheck('server_checkpoints_target.php/?id='+getUrl(), function(data) {
            console.log(data);
                var dataPass = JSON.parse(data);
                for (var i = 0; i < dataPass.checkpoints.length; i++) {
                    var counter = dataPass.checkpoints[i];
           //console.log(counter.counter_name);
                    var point = {
                        lat: counter.lat * 1,
                        lng: counter.lng * 1
                    };
                    var location = counter.location;
                    var has_composition = counter.has_composition;
                    createMarker(counter.id, point, infoWindow, counter.name, map, location, has_composition);
                }
           
        });
       google.maps.event.addListener(infoWindow,'closeclick',function(e){
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
           },
            beforeSend: function(){
                $("body").addClass("loading");
            },
            complete: function(){
                $("body").removeClass("loading");
            }
      });
      }
        
      function addOfficerFn(e){
        window.location = 'server_officer_designation.php?checkpoint='+e.getAttribute('data-check');
      }

      function createMarker(checkpointId, point, infoWindow, name, map, loc, has){
          var contentString;
          if(has == 'yes'){
          contentString = $('<div class="marker-info-win">'+
          '<div class="marker-inner-win"><span class="info-content">'+
          '<h6 class="marker-heading">Location:'+loc+'</h6>'+
          '<h6 class="marker-heading-id" value='+checkpointId+'>Checkpoint Id:'+checkpointId+'</h6>'+ 
          '<div class="marker-data" align="center"><h6 class="editNameTxt">Name: '+name+'</h6><button style="background-color:#bd593d;color:#ffffff;" class="editName">Edit Name</button>'+
          '</div></span></div></div>');    
         }else{
          contentString = $('<div class="marker-info-win">'+
          '<div class="marker-inner-win"><span class="info-content">'+
          '<h6 class="marker-heading">Location:'+loc+'</h6>'+
          '<h6 class="marker-heading-id" value='+checkpointId+'>Checkpoint Id:'+checkpointId+'</h6>'+ 
          '<div class="marker-data" align="center"><h6 class="editNameTxt">Name: '+name+'</h6><button style="background-color:#bd593d;color:#ffffff;" class="editName">Edit Name</button>'+
          '<button style="background-color:#bd593d;color:#ffffff;" class="addOfficer" data-check='+checkpointId+' onClick="addOfficerFn(this)">Add Officer</button>'+
          '</div></span></div></div>');    
         }
         
           var image = {
            url: 'images/assets/baricade2.png', // image is 512 x 512
            scaledSize: new google.maps.Size(27,27), // scaled size
            origin: new google.maps.Point(0,0), // origin
            anchor: new google.maps.Point(14,28),
            // size: new google.maps.Size(100,100)  
            }; 

            var marker = new google.maps.Marker({
                map: map,
                id: checkpointId,
                name: name,
                position: point,
                icon: image
            });

              markers.push(marker);
            
              marker.addListener('click', function(){
                infoWindow.setContent(contentString[0]);
                infoWindow.open(map, marker);
              });

               

               var editName = contentString.find('button.editName')[0];
    
               google.maps.event.addDomListener(editName, 'click', function(){
                console.log(contentString);
                var pastValue = $('.editNameTxt').text().substr(6);
                var checkpointId = $(".marker-heading-id").attr('value');
                newContentString = $('<div class="marker-info-win">'+
              '<div class="marker-inner-win"><span class="info-content">'+
              '<h6 class="marker-heading-loc">Location:'+loc+'</h6>'+
              '<h6 class="marker-heading-id" value='+checkpointId+'>Checkpoint Id:'+checkpointId+'</h6>'+ 
              '<div class="marker-data" align="center">New checkpoint name: '+
              '<input type="text" placeholder="new checkpoint name" class="newNameTxt"><button style="background-color:#2b3f6d;color:#ffffff;" class="saveBtn">Save</button>'+
              '<button class="cancelBtn" style="background-color:#bd593d;color:#ffffff;" value='+pastValue+' >Cancel</button>'+
              '</div></span></div></div>');   

                openEdit = true;
                infoWindow.setContent(newContentString[0]);
                infoWindow.open(map, marker);
               // cancelFn(newContentString, contentString, infoWindow, marker);
                 var cancelBtn = newContentString.find('button.cancelBtn')[0];
                google.maps.event.addDomListener(cancelBtn, 'click', function(){
                  var pastValue = $('cancelBtn').attr('value');
                  infoWindow.setContent(contentString[0]);
                  infoWindow.open(map, marker);
               });
               // saveNameFn(newContentString, infoWindow, marker, loc, contentString);
                var saveBtn = newContentString.find('button.saveBtn')[0];
                var checkpointId = newContentString.find('.marker-heading-id').attr('value');
                google.maps.event.addDomListener(saveBtn, 'click', function(){
            var value = newContentString.find('input.newNameTxt')[0].value;
                          console.log(value);
                  if(value == ''){
                    swal("Please provide checkpoint name","","warning");
                  }else if(value == pastValue){
                    swal("Named Already");
                  }else{
                    console.log(checkpointId);
                    updateLabel(checkpointId, value, function(e){});

                          swal("Name Updated");
                         contentString = $('<div class="marker-info-win">'+
                    '<div class="marker-inner-win"><span class="info-content">'+
                    '<h6 class="marker-heading">Location:'+loc+'</h6>'+
                    '<h6 class="marker-heading">Checkpoint Id:'+checkpointId+'</h6>'+ 
                    '<div class="marker-data" align="center"><h6 class="editNameTxt">Name: '+value+'</h6><button style="background-color:#bd593d;color:#ffffff;" class="editName">Edit Name</button>'+
                    '</div></span></div></div>');   
                          infoWindow.setContent(contentString[0]);
                          infoWindow.open(map, marker);
                          // createMarker(checkpointId, point, infoWindow, name, map, loc);

                  }
                    });
            });
      }


      function cancelFn(e, content, infoWindow, marker){
        console.log(e);
          var cancelBtn = e.find('button.cancelBtn')[0];
                google.maps.event.addDomListener(cancelBtn, 'click', function(){
                  var pastValue = $(this).attr('value');
                  infoWindow.setContent(content[0]);
                  infoWindow.open(map, marker);
               });
      
      }

      function saveNameFn(e, infoWindow, marker, loc, content){
        var saveBtn = e.find('button.saveBtn')[0];
        var checkpointId = e.find('.marker-heading-id').attr('value');
         google.maps.event.addDomListener(saveBtn, 'click', function(){
            var value = e.find('input.newNameTxt')[0].value;
                console.log(value);
        if(value == ''){
          swal("Please provide checkpoint name","","warning");
        }else{
          console.log(checkpointId);
          updateLabel(checkpointId, value, function(e){
            if(e == 1){
               content = $('<div class="marker-info-win">'+
          '<div class="marker-inner-win"><span class="info-content">'+
          '<h6 class="marker-heading">Location:'+loc+'</h6>'+
          '<h6 class="marker-heading">Checkpoint Id:'+checkpointId+'</h6>'+ 
          '<div class="marker-data" align="center"><h6 class="editNameTxt">Name: '+value+'</h6><button style="background-color:#bd593d;color:#ffffff;" class="editName">Edit Name</button>'+
          '</div></span></div></div>');    
                infoWindow.setContent(content[0]);
                infoWindow.open(map, marker);
            }else{
              swal("Error in updating the name","","warning");
            }
          });
        }
          });
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
            if(google.maps.geometry.poly.containsLocation(google.maps.geometry.spherical.computeOffset(center,radius,d), boundary)){
              a.push(google.maps.geometry.spherical.computeOffset(center,radius,d));
            }
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
