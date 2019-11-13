<?php
$title = "Locations";
include 'header.php'; ?>
<script src="https://kit.fontawesome.com/b1ac6ddda2.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="styles/onemap-leaflet.css" />
<div class="container pt-custom2">
  
    <div class="form-inline mb-2">
      <label for="location">Your Location</label>
      <input type="text" class="form-control mx-2" id="location" placeholder="Location" name="location">
      <input type="hidden" id="themeName" value="<?php if (isset($_GET['method'])) {
                                                    echo $_GET['method'];
                                                  } else {
                                                    echo "recyclingbins";
                                                  } ?>">
      <p id="demo"></p>

      <button type="button" class="btn btn-success mr-2" id="findbtn" onclick="reloadMap()">Find</button>
      <div id="errMsg"></div>
    </div>
  
  <div class="row">
    <div class="col-md-8 m-tabs">
      <div id='map' style='height:400px;'></div>
      <div>
        <div class="form-check" onclick="checkBoxes()">
          <input type="checkbox" class="form-check-input" id="exampleCheck1" <?php if (isset($_GET['q'])) {
                                                                                if ($_GET['q'] == "recyclebin") {
                                                                                  echo "checked";
                                                                                }
                                                                              } else {
                                                                                echo "checked";
                                                                              } ?>>
          <label class="form-check-label" for="exampleCheck1">Recycling Bins</label>
        </div>
        <div class="form-check" onclick="checkBoxes()">
          <input type="checkbox" class="form-check-input" id="exampleCheck2" <?php if (isset($_GET['q'])) {
                                                                                if ($_GET['q'] == "2ndhand") {
                                                                                  echo "checked";
                                                                                }
                                                                              } else {
                                                                                echo "checked";
                                                                              } ?>>
          <label class="form-check-label" for="exampleCheck2">2nd Hand Collection Point</label>
        </div>
        <div class="form-check" onclick="checkBoxes()">
          <input type="checkbox" class="form-check-input" id="exampleCheck3" <?php if (isset($_GET['q'])) {
                                                                                if ($_GET['q'] == "ewaste") {
                                                                                  echo "checked";
                                                                                }
                                                                              } else {
                                                                                echo "checked";
                                                                              } ?>>
          <label class="form-check-label" for="exampleCheck3">eWaste Bins</label>
        </div>

        <div class="form-check" onclick="checkBoxes()">
          <input type="checkbox" class="form-check-input" id="exampleCheck4" <?php if (isset($_GET['q'])) {
                                                                                if ($_GET['q'] == "lighting") {
                                                                                  echo "checked";
                                                                                }
                                                                              } else {
                                                                                echo "checked";
                                                                              } ?>>
          <label class="form-check-label" for="exampleCheck4">Lighting Recycle Points</label>
        </div>
      </div>
    </div>
    <div class="col-md-4 m-tabs">
      <div class="mb-2">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link map-tabs active" id="Info-tab" data-toggle="tab" href="#Info" onclick="getinfo()">Info</a>
          </li>
          <li class="nav-item">
            <a class="nav-link map-tabs" id="Walk-tab" data-toggle="tab" href="#Walk" onclick="routeMap()"><i class="fas fa-walking"></i></a>
          </li>
          <?php /*<li class="nav-item">
            <a class="nav-link map-tabs" id="BusMRT-tab" data-toggle="tab" href="#BusMRT" onclick="routeMap2()"><i class="fas fa-subway"></i></a>
          </li> */ ?>
          <li class="nav-item">
            <a class="nav-link map-tabs" id="Driving-tab" data-toggle="tab" href="#Driving" onclick="routeMap3()"><i class="fas fa-car"></i></a>
          </li>
        </ul>
      </div>
      <div class="map-tabs-container" id="marker_container">
        <p id="marker_data"></p>
      </div>

    </div>
  </div>
</div>
<script src="scripts/onemap-leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Turf.js/5.0.4/turf.min.js"></script>
<script src="scripts/Polyline.encoded.js"></script>
<script>
  var key = ""; // Add OneMap API Key
  var appID = ""; // Add OneMap App ID
  onemap.config(key);
  var loc = document.getElementById("location");
  var err = document.getElementById("errMsg");
  var themeName = document.getElementById("themeName").value;
  var themeObj = onemap.retrieveTheme(themeName);
  var map = onemap.initializeMap('map', "default", 17, 1.3, 103.8, 1);
  var selectedName;
  var selectedDescription;
  var selectedPlace;
  var recyclingBinIcon = L.icon({
    iconUrl: 'images/recycle-bin.png',
    iconSize: [32, 37],
    iconAnchor: [16, 37],
    popupAnchor: [0, -28]
  });
  var eWasteIcon = L.icon({
    iconUrl: 'images/ewaste.png',
    iconSize: [32, 37],
    iconAnchor: [16, 37],
    popupAnchor: [0, -28]
  });
  var secondhandIcon = L.icon({
    iconUrl: 'images/second-hand.png',
    iconSize: [32, 37],
    iconAnchor: [16, 37],
    popupAnchor: [0, -28]
  });
  var lightingIcon = L.icon({
    iconUrl: 'images/incandescent-light.png',
    iconSize: [32, 37],
    iconAnchor: [16, 37],
    popupAnchor: [0, -28]
  });





  var currLat = 0;
  var currLong = 0;
  var selectedLat = 0;
  var selectedLong = 0;

  var humanIcon = L.icon({
    iconUrl: 'images/human-marker.png',
    shadowUrl: 'images/marker-shadow.png',

    iconSize: [50, 50], // size of the icon
    shadowSize: [41, 41], // size of the shadow
    iconAnchor: [50, 100], // point of the icon which will correspond to marker's location
    shadowAnchor: [1, 41], // the same for the shadow
  });

  function getLocation() {

    var valid = true;

    navigator.geolocation.watchPosition(function(position) {

      },
      function(error) {
        if (error.code == error.PERMISSION_DENIED)
          getGeneral();
        valid = false;
      });
    if (valid == true) {


      if (navigator.geolocation) {

        navigator.geolocation.getCurrentPosition(showPosition);

      } else {

        err.innerHTML = "Geolocation is not supported by this browser.";
        getGeneral();
      }
    }
  }


  function onEachFeature(feature, layer) {
    layer.bindPopup('<h6>' + feature.properties.NAME + '</h6>');
  }

  function showPosition(position) {

    var lat = position.coords.latitude;
    var long = position.coords.longitude;
    var result = onemap.revgeocode(lat, long, 3, "all");
    var JSONObject = JSON.parse(result);

    if (JSONObject.GeocodeInfo.length > 0) {
      var place = JSONObject.GeocodeInfo[0].BUILDINGNAME + " " + JSONObject.GeocodeInfo[0].POSTALCODE;
      loc.value = place;
      currLat = lat;
      currLong = long;

      $rec = 1;
      $sec = 1;
      $ewas = 1;
      $light = 1;

      if (!$('#exampleCheck1').is(':checked')) {
        $rec = 0;
      }
      if (!$('#exampleCheck2').is(':checked')) {
        $sec = 0;
      }
      if (!$('#exampleCheck3').is(':checked')) {
        $ewas = 0;
      }
      if (!$('#exampleCheck4').is(':checked')) {
        $light = 0;
      }
      reloadMap($rec, $sec, $ewas, $light);
    } else {
      err.innerHTML = "Unable to detect your current location. Please key in your location.";
      getGeneral();
    }
  }
  var info;

  function markerOnClick(e) {


    if (polyline != null) {
      polyline.remove();
    }
    var lat = e.latlng.lat;
    var long = e.latlng.lng;

    selectedLat = lat;
    selectedLong = long;
    var data;
    var types = ["lighting", "ewaste", "secondhandcollecn", "recyclingbins"];

    for (let i = 0; i < types.length; i++) {
      data = onemap.nearbyPointFeatures(onemap.retrieveTheme(types[i]), lat, long, 1);

      if (data.features.length != 0) {
        break
      }
    }
    selectedName = data.features[0].properties.NAME;
    selectedDescription = data.features[0].properties.DESCRIPTION;

    var data = onemap.revgeocode(lat, long, 3, "all");
    var JSONObject = JSON.parse(data);
    selectedPlace = "";
    var buildingname = "" + JSONObject.GeocodeInfo[0].BUILDINGNAME;
    if (buildingname != "null") {
      selectedPlace += JSONObject.GeocodeInfo[0].BUILDINGNAME + ", ";
    }
    selectedPlace += JSONObject.GeocodeInfo[0].BLOCK + " " +
      JSONObject.GeocodeInfo[0].ROAD +
      ", Singapore " + JSONObject.GeocodeInfo[0].POSTALCODE;

    var marker_container = document.getElementById("marker_container");
    marker_container.innerHTML = "<p id='marker_data'></p>";

    var marker_data = document.getElementById("marker_data");
    info = "<b>Location Name:</b> " + selectedName + "<br> <b> Description: </b>" + selectedDescription + "<br> <b> Address: </b> " + selectedPlace;
    marker_data.innerHTML = "<b>Location Name:</b> " + selectedName;
    marker_data.innerHTML += "<br> <b> Description: </b>" + selectedDescription;
    marker_data.innerHTML += "<br> <b> Address: </b> " + selectedPlace;

    marker_container.innerHTML += "<button type='button' id='routingButton' class='btn btn-success' onclick='routeMap()'>Go There</button>";
    jQuery(".map-tabs").removeClass("active");
    jQuery("#Info-tab").addClass("active");
  }

  function reloadMap(rec = 1, sec = 1, ewas = 1, light = 1) {
    if (!$('#exampleCheck1').is(':checked')) {
      $rec = 0;
    }
    if (!$('#exampleCheck2').is(':checked')) {
      $sec = 0;
    }
    if (!$('#exampleCheck3').is(':checked')) {
      $ewas = 0;
    }
    if (!$('#exampleCheck4').is(':checked')) {
      $light = 0;
    }
    var lv = map.getZoom();
    var ltlg = map.getCenter();

    if (loc.value == "") {
      err.innerHTML = "Please fill in your location"
    } else {



      var result = onemap.search(loc.value, 1)
      var JSONObject = JSON.parse(result);
      var lat = JSONObject.results[0].LATITUDE;
      var long = JSONObject.results[0].LONGTITUDE;

      currLat = lat;
      currLong = long;

      map.remove();
      if (ltlg["lat"] == 1.3 && ltlg["lng"] == 103.8) {
        map = onemap.initializeMap('map', "default", lv, lat, long, 1);
      } else {
        map = onemap.initializeMap('map', "default", lv, ltlg["lat"], ltlg["lng"], 1);
      }
      var data;
      if (rec == 1) {

        // Add Recycle Bins
        data = onemap.nearbyPointFeatures(themeObj, lat, long, 600);
        L.geoJSON(data, {
          pointToLayer: function(feature, latlng) {
            return L.marker(latlng, {
              icon: recyclingBinIcon
            });
          },
          onEachFeature: onEachFeature
        }).on('click', markerOnClick).addTo(map);
      }
      if (sec == 1) {
        // Add Second Hand
        data = onemap.pointTheme2GeoJSON(onemap.retrieveTheme("secondhandcollecn"));
        L.geoJSON(data, {
          pointToLayer: function(feature, latlng) {
            return L.marker(latlng, {
              icon: secondhandIcon
            });
          },
          onEachFeature: onEachFeature
        }).on('click', markerOnClick).addTo(map);
      }
      if (ewas == 1) {
        // Add eWaste
        data = onemap.pointTheme2GeoJSON(onemap.retrieveTheme("ewaste"));
        L.geoJSON(data, {
          pointToLayer: function(feature, latlng) {
            return L.marker(latlng, {
              icon: eWasteIcon
            });
          },
          onEachFeature: onEachFeature
        }).on('click', markerOnClick).addTo(map);
      }
      if (light == 1) {
        // Add lighting
        data = onemap.pointTheme2GeoJSON(onemap.retrieveTheme("lighting"));
        L.geoJSON(data, {
          pointToLayer: function(feature, latlng) {
            return L.marker(latlng, {
              icon: lightingIcon
            });
          },
          onEachFeature: onEachFeature
        }).on('click', markerOnClick).addTo(map);
      }
      // Add Human
      L.marker([lat, long], {
        icon: humanIcon
      }).addTo(map);


    }
  }

  function getinfo() {
    if (selectedLat == 0) {
      var marker_data = document.getElementById("marker_data");


      marker_data.innerHTML = "Please determine your location and select a marker first!";
    } else {
      var marker_data = document.getElementById("marker_data");
      marker_data.innerHTML = info;
      if (polyline != null) {
        polyline.remove();
      }
    }
  }
  var data;

  if (themeName == "lighting" || themeName == "secondhandcollecn") {
    data = onemap.pointTheme2GeoJSON(themeObj);
  } else {
    data = onemap.nearbyPointFeatures(themeObj, 1.3, 103.8, 500);
  }

  function getGeneral() {
    var geojson = L.geoJSON(data, {
      onEachFeature: function(feature, layer) {
        layer.bindPopup('<h6>' + feature.properties.NAME + '</h6>');
      }
    });
    geojson.addTo(map);

    geojson.on('click', function(e) {
      if (polyline != null) {
        polyline.remove();
      }
      var lat = e.latlng.lat;
      var long = e.latlng.lng;

      selectedLat = lat;
      selectedLong = long;

      var data = onemap.nearbyPointFeatures(themeObj, lat, long, 1);

      selectedName = data.features[0].properties.NAME;
      selectedDescription = data.features[0].properties.DESCRIPTION;

      var data = onemap.revgeocode(lat, long, 3, "all");
      var JSONObject = JSON.parse(data);
      selectedPlace = "";
      var buildingname = "" + JSONObject.GeocodeInfo[0].BUILDINGNAME;
      if (buildingname != "null") {
        selectedPlace += JSONObject.GeocodeInfo[0].BUILDINGNAME + ", ";
      }
      selectedPlace += JSONObject.GeocodeInfo[0].BLOCK + " " +
        JSONObject.GeocodeInfo[0].ROAD +
        ", Singapore " + JSONObject.GeocodeInfo[0].POSTALCODE;

      var marker_container = document.getElementById("marker_container");
      marker_container.innerHTML = "<p id='marker_data'></p>";

      var marker_data = document.getElementById("marker_data");
      info = "<b>Location Name:</b> " + selectedName + "<br> <b> Description: </b>" + selectedDescription + "<br> <b> Address: </b> " + selectedPlace;
      marker_data.innerHTML = "<b>Location Name:</b> " + selectedName;
      marker_data.innerHTML += "<br> <b> Description: </b>" + selectedDescription;
      marker_data.innerHTML += "<br> <b> Address: </b> " + selectedPlace;

      marker_container.innerHTML += "<button type='button' id='routingButton' class='btn btn-success' onclick='routeMap()'>Go There</button>";
      jQuery(".map-tabs").removeClass("active");
      jQuery("#Info-tab").addClass("active");
    });
  }

  var polyline;

  function routeMap() {
    if (selectedLat == 0) {
      var marker_data = document.getElementById("marker_data");


      marker_data.innerHTML = "Please determine your location and select a marker first!";
    } else {

      if (polyline != null) {
        polyline.remove();
      }
      var start = currLat + "," + currLong;
      var end = selectedLat + "," + selectedLong;
      var instructions = "";
      $.ajax({
        url: 'https://developers.onemap.sg/privateapi/routingsvc/route?start=' + start + '&end=' + end + '&routeType=walk&token=' + key,
        dataType: 'json',
        async: false,
        success: function(data) {
          var encoded = data.route_geometry;

          polyline = L.Polyline.fromEncoded(encoded, {
            weight: 2,
            color: '#28a745'
          }).addTo(map);

          map.fitBounds(polyline.getBounds());
          var travel_instruction = data.route_instructions;
          for (i = 0; i < travel_instruction.length; i++) {
            instructions += travel_instruction[i][0] + " Heading " + travel_instruction[i][6] + " for " + travel_instruction[i][5] + "<br>";
          }

        }
      });


      

      $.getJSON('https://api.openweathermap.org/data/2.5/weather?lat=' + selectedLat + '&lon=' + selectedLong + '&APPID=' + appID, function(data) {
        var weather = data.weather[0].main;

        var marker_data = document.getElementById("marker_data");


        marker_data.innerHTML = "<br> <b> Address: </b> " + selectedPlace;
        marker_data.innerHTML += "<br>" + instructions;
        marker_data.innerHTML += "<a href='https://www.google.com/maps/dir/?api=1&destination=" + encodeURIComponent(selectedPlace) + "&travelmode=walking' target=_blank >Navigate via Google Maps there!</a><br>";
        marker_data.innerHTML += "<b>Weather:</b> " + weather;
        if (weather == "Rain") {
          marker_data.innerHTML += "It is raining. Do bring an umbrella!"
        }

      });
    }
  }



  function routeMap2() {
    if (selectedLat == 0) {
      var marker_data = document.getElementById("marker_data");


      marker_data.innerHTML = "Please determine your location and select a marker first!";
    } else {
      if (polyline != null) {
        polyline.remove();
      }
      var start = currLat + "," + currLong;
      var end = selectedLat + "," + selectedLong;
      var today = new Date();
      var dd = today.getDate();
      var mm = today.getMonth() + 1; //January is 0!

      var yyyy = today.getFullYear();
      if (dd < 10) {
        dd = '0' + dd;
      }
      if (mm < 10) {
        mm = '0' + mm;
      }
      var today = dd + '/' + mm + '/' + yyyy;
      var now = new moment();
      var instructions;
      $.ajax({
        url: 'https://developers.onemap.sg/privateapi/routingsvc/route?start=' + start + '&end=' + end + '&routeType=pt&token=' + key + '&date=' + today + '&time=' + now.format("HH:mm:ss") + '&mode=TRANSIT&maxWalkDistance=1000&numItineraries=3',
        dataType: 'json',
        async: false,
        success: function(data) {
          var encoded = data.route_geometry;

          polyline = L.Polyline.fromEncoded(encoded, {
            weight: 2,
            color: '#28a745'
          }).addTo(map);

          map.fitBounds(polyline.getBounds());
          var travel_instruction = data.route_instructions;
          for (i = 0; i < travel_instruction.length; i++) {
            instructions += travel_instruction[i][0] + " Heading " + travel_instruction[i][6] + " for " + travel_instruction[i][5] + "<br>";
          }

        }
      });


      

      $.getJSON('https://api.openweathermap.org/data/2.5/weather?lat=' + selectedLat + '&lon=' + selectedLong + '&APPID=' + appID, function(data) {
        var weather = data.weather[0].main;

        var marker_data = document.getElementById("marker_data");


        marker_data.innerHTML = "<br> <b> Address: </b> " + selectedPlace;
        marker_data.innerHTML += "<br>" + instructions;
        marker_data.innerHTML += "<a href='https://www.google.com/maps/dir/?api=1&destination=" + encodeURIComponent(selectedPlace) + "&travelmode=transit' target=_blank >Navigate via Google Maps there!</a><br>";
        marker_data.innerHTML += "<b>Weather:</b> " + weather;
        if (weather == "Rain") {
          marker_data.innerHTML += "It is raining. Do bring an umbrella!"
        }

      });
    }
  }

  function routeMap3() {
    if (selectedLat == 0) {
      var marker_data = document.getElementById("marker_data");


      marker_data.innerHTML = "Please determine your location and select a marker first!";
    } else {
      if (polyline != null) {
        polyline.remove();
      }
      var start = currLat + "," + currLong;
      var end = selectedLat + "," + selectedLong;

      var instructions = "";
      $.ajax({
        url: 'https://developers.onemap.sg/privateapi/routingsvc/route?start=' + start + '&end=' + end + '&routeType=drive&token=' + key,
        dataType: 'json',
        async: false,
        success: function(data) {
          var encoded = data.route_geometry;

          polyline = L.Polyline.fromEncoded(encoded, {
            weight: 2,
            color: '#28a745'
          }).addTo(map);

          map.fitBounds(polyline.getBounds());
          var travel_instruction = data.route_instructions;
          for (i = 0; i < travel_instruction.length; i++) {
            instructions += travel_instruction[i][9] + " for " + travel_instruction[i][5] + "<br>";
          }

        }
      });

      

      $.getJSON('https://api.openweathermap.org/data/2.5/weather?lat=' + selectedLat + '&lon=' + selectedLong + '&APPID=' + appID, function(data) {
        var weather = data.weather[0].main;

        var marker_data = document.getElementById("marker_data");

        marker_data.innerHTML = "<br> <b> Address: </b> " + selectedPlace;
        marker_data.innerHTML += "<br>" + instructions;
        marker_data.innerHTML += "<a href='https://www.google.com/maps/dir/?api=1&destination=" + encodeURIComponent(selectedPlace) + "&travelmode=driving' target=_blank >Navigate via Google Maps there!</a><br>";

        marker_data.innerHTML += "<b>Weather:</b> " + weather;
        if (weather == "Rain") {
          marker_data.innerHTML += "It is raining. Do bring an umbrella!"
        }

      });
    }
  }

  function checkBoxes() {
    $rec = 1;
    $sec = 1;
    $ewas = 1;
    $light = 1;

    if (!$('#exampleCheck1').is(':checked')) {
      $rec = 0;
    }
    if (!$('#exampleCheck2').is(':checked')) {
      $sec = 0;
    }
    if (!$('#exampleCheck3').is(':checked')) {
      $ewas = 0;
    }
    if (!$('#exampleCheck4').is(':checked')) {
      $light = 0;
    }
    reloadMap($rec, $sec, $ewas, $light);


  }


  getLocation();
</script>
<?php include 'footer.php'; ?>