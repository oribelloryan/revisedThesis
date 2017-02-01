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
    <!-- <link href="starter-template.css" rel="stylesheet"> -->
    
    <style>
      #map{width: 100%; height: 600px;
      }
    </style>

  </head>

  <body>
  
    <div id="map" ></div>


    <script type="text/javascript">
   
    var data = { "type": "FeatureCollection",
                 "features": [{ 
                    "type": "Feature", 
                    "id": 1, 
                    "properties": {
                         "Name": "",
                         },
                    "geometry": { 
                         "type": "Polygon",
                         "coordinates": [ [
                                       [ 121.059246, 14.601600],
                                       [ 121.056767, 14.600801],
                                       [ 121.055544, 14.600775],
                                       [ 121.051822, 14.601350],
                                       [ 121.043282, 14.593874],
                                       [ 121.043449, 14.593647],
                                       [ 121.042602, 14.593451],
                                       [ 121.041307, 14.592989],
                                       [ 121.041601, 14.592164],
                                       [ 121.038099, 14.592166],
                                       [ 121.034731, 14.590712],
                                       [ 121.034548, 14.590977],
                                       [ 121.034167, 14.591346],
                                       [ 121.033971, 14.591645],
                                       [ 121.033672, 14.591704],
                                       [ 121.033312, 14.591675],
                                       [ 121.033215, 14.591854],
                                       [ 121.032479, 14.592585],
                                       [ 121.031697, 14.592321],
                                       [ 121.031841, 14.592820],
                                       [ 121.032115, 14.593284],
                                       [ 121.031894, 14.593433],
                                       [ 121.031376, 14.593903],
                                       [ 121.030824, 14.593935],
                                       [ 121.030589, 14.594168],
                                       [ 121.030133, 14.594322],
                                       [ 121.029838, 14.594619],
                                       [ 121.029451, 14.594839],
                                       [ 121.029121, 14.595203],
                                       [ 121.028620, 14.595016],
                                       [ 121.027038, 14.595908],
                                       [ 121.026355, 14.595159],
                                       [ 121.025411, 14.597218],
                                       [ 121.025240, 14.597361],
                                       [ 121.024796, 14.597945],
                                       [ 121.024057, 14.599388],
                                       [ 121.020836, 14.601612],
                                       [ 121.020017, 14.602053],
                                       [ 121.019835, 14.602262],
                                       [ 121.019744, 14.602647],
                                       [ 121.020062, 14.603716],
                                       [ 121.020301, 14.604409],
                                       [ 121.020725, 14.604974],
                                       [ 121.022667, 14.607852],
                                       [ 121.022263, 14.608851],
                                       [ 121.021589, 14.609448],
                                       [ 121.021455, 14.609535],
                                       [ 121.023138, 14.612066],
                                       [ 121.023318, 14.613488],
                                       [ 121.023475, 14.613727],
                                       [ 121.023901, 14.613825],
                                       [ 121.025024, 14.613325],
                                       [ 121.025327, 14.612424],
                                       [ 121.026325, 14.612229],
                                       [ 121.026875, 14.612272],
                                       [ 121.027852, 14.612250],
                                       [ 121.028738, 14.611990],
                                       [ 121.029152, 14.612201],
                                       [ 121.029234, 14.612729],
                                       [ 121.029338, 14.612977],
                                       [ 121.029710, 14.613134],
                                       [ 121.030105, 14.613100],
                                       [ 121.030454, 14.612943],
                                       [ 121.030884, 14.612898],
                                       [ 121.031372, 14.611931],
                                       [ 121.031674, 14.611672],
                                       [ 121.032232, 14.611290],
                                       [ 121.032662, 14.610865],
                                       [ 121.032949, 14.610588],
                                       [ 121.033618, 14.609675],
                                       [ 121.034167, 14.609397],
                                       [ 121.034777, 14.609397],
                                       [ 121.035254, 14.608796],
                                       [ 121.035756, 14.608553],
                                       [ 121.036210, 14.608646],
                                       [ 121.036318, 14.608634],
                                       [ 121.036592, 14.608484],
                                       [ 121.036843, 14.608403],
                                       [ 121.036891, 14.607871],
                                       [ 121.037154, 14.607513],
                                       [ 121.037285, 14.606634],
                                       [ 121.037752, 14.606249],
                                       [ 121.040903, 14.608734],
                                       [ 121.043059, 14.609585],
                                       [ 121.044077, 14.608918],
                                       [ 121.045784, 14.608617],
                                       [ 121.049993, 14.609635],
                                       [ 121.052115, 14.604469],
                                       [ 121.056957, 14.606622],
                                       [ 121.056984, 14.606622],
                                       [ 121.059250, 14.601611],

          
                                        ] ] 
                                }
                            },
                            ] 
                };

var map;
var path = [];
var polygons = [];

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
        center: new google.maps.LatLng(14.600353, 121.036745),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    createGeoJsonPolygon(data);

    marker = new google.maps.Marker({
    position: new google.maps.LatLng(14.600353, 121.036745),
    map: map
    });

}

function createGeoJsonPolygon(data) {
    var bounds = new google.maps.LatLngBounds();
    var coords = [];
    for (var i = 0, len = data.features.length; i < len; i++) {
        coords = data.features[i].geometry.coordinates[0];

        for (var j = 0; j < coords.length; j++) {
            var pt = new google.maps.LatLng(coords[j][1], coords[j][0]);
            bounds.extend(pt);
            path.push(pt);
        }
        var polygon = new google.maps.Polygon({
            path: path,
            strokeColor : '#ff1a1a',
            strokeOpacity: 1,
            strokeWeight: 1.5,
            fillColor : '#ffffff',
            fillOpacity: 0,
        });
        polygons.push(polygon);
        path = [];

    }

    polygons.forEach(function (polygon) {
        polygon.setMap(map);
        google.maps.event.addListener(polygon, 'click', function (event) {
        });
    });
}

    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1SFa75QzMfOtf7rudCh6RFgaNk6ptbzo&libraries=geometry&callback=initMap">
    </script>
  </body>
</html>
