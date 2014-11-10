<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"/> 
        <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false" type="text/javascript"></script> 
        <link href="favicon.ico" rel="icon" type="image/x-icon" />
        <link rel="stylesheet" href="main.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>HomeMeteostation v0.<?php include("version.php"); ?></title>

    </head>
    <body onunload="GUnload()">
        <h1>Home meteostation on Arduino board v0.<?php include("version.php");  ?>
            <small>
                <a href="http://www.vk.com/fox_3">Author by Igor Polyakov</a>
                <div class="hr">
                      <li><a href="index.php">MAIN </a></li>
                      <li><a href="graph_pres.php"> pressure </a></li>
                      <li><a href="graph_temp.php">temperature </a></li>
                      <li><a href="graph_humid.php">humidity </a></li>
                      <li><a href="graph_ligth.php">light </a></li>
                      <li><a href="graph_map.php">map </a></li>
                </div>
            </small>
        </h1>
        <center>
          <div id="map_canvas" style="width: 680px; height: 320px"></div> 

          <script type="text/javascript"> 

          var userLocation = 'ulitsa 19-y Gvardeyskoy Divizii, 11, Tomsk, Tomskaya oblast, Russia';

          if (GBrowserIsCompatible()) {
             var geocoder = new GClientGeocoder();
             geocoder.getLocations(userLocation, function (locations) {         
                if (locations.Placemark)
                {
                   var north = locations.Placemark[0].ExtendedData.LatLonBox.north;
                   var south = locations.Placemark[0].ExtendedData.LatLonBox.south;
                   var east  = locations.Placemark[0].ExtendedData.LatLonBox.east;
                   var west  = locations.Placemark[0].ExtendedData.LatLonBox.west;

                   var bounds = new GLatLngBounds(new GLatLng(south, west), 
                                                  new GLatLng(north, east));

                   var map = new GMap2(document.getElementById("map_canvas"));

                   map.setCenter(bounds.getCenter(), map.getBoundsZoomLevel(bounds));
                   map.addOverlay(new GMarker(bounds.getCenter()));
                }
             });
          }
          </script> 
        </center>
    </body>
</html>
