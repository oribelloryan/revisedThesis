<!DOCTYPE html>
<html>
<head>
<meta name="viewport"></meta>
<title>Copy of USA Nevada state - City Level data - Google Fusion Tables</title>
<style type="text/css">
html, body, #googft-mapCanvas {
  height: 300px;
  margin: 0;
  padding: 0;
  width: 500px;
}
</style>

<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyD1SFa75QzMfOtf7rudCh6RFgaNk6ptbzo&sensor=false"></script>

<script type="text/javascript">
    //Fusion Table URL : https://www.google.com/fusiontables/data?docid=1vKMjmiVb3eHCEnQ6j5HpIYGZ3Gttth8ac317nxNg#map:id=3
    function initialize() {
        google.maps.visualRefresh = true;
        var isMobile = (navigator.userAgent.toLowerCase().indexOf('android') > -1) ||
      (navigator.userAgent.match(/(iPod|iPhone|iPad|BlackBerry|Windows Phone|iemobile)/));
        if (isMobile) {
            var viewport = document.querySelector("meta[name=viewport]");
            viewport.setAttribute('content', 'initial-scale=1.0, user-scalable=no');
        }
        var mapDiv = document.getElementById('googft-mapCanvas');
        mapDiv.style.width = isMobile ? '100%' : '900px';
        mapDiv.style.height = isMobile ? '100%' : '900px';
        var map = new google.maps.Map(mapDiv, {
            center: new google.maps.LatLng(32.48632729547162, -108.729549109375),
            zoom: 4,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(document.getElementById('googft-legend-open'));
        map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(document.getElementById('googft-legend'));

        layer = new google.maps.FusionTablesLayer({
            map: map,
            heatmap: { enabled: false },
            query: {
                select: "col3",
                from: "1vKMjmiVb3eHCEnQ6j5HpIYGZ3Gttth8ac317nxNg",
                where: ""
            },
            options: {
                styleId: 3,
                templateId: 4
            }
        });

        google.maps.event.addlistener(layer, 'click', function () {            
            var selectedPlaceName = event.latlng.place.name;
        });

        if (isMobile) {
            var legend = document.getElementById('googft-legend');
            var legendOpenButton = document.getElementById('googft-legend-open');
            var legendCloseButton = document.getElementById('googft-legend-close');
            legend.style.display = 'none';
            legendOpenButton.style.display = 'block';
            legendCloseButton.style.display = 'block';
            legendOpenButton.onclick = function () {
                legend.style.display = 'block';
                legendOpenButton.style.display = 'none';
            }
            legendCloseButton.onclick = function () {
                legend.style.display = 'none';
                legendOpenButton.style.display = 'block';
            }
        }
    }

    google.maps.event.addDomListener(window, 'load', initialize);
</script>
</head>

<body>
  <div id="googft-mapCanvas"></div>

  <div class='googft-info-window'>
<b>name:</b> {name}<br>
<b>id:</b> {id}<br>
<b>geometry:</b> {geometry}
</div>
</body>