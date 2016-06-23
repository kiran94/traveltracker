var map; 
var markers = []; 

/*
  Initialises the map with a default location
*/
function initMap() 
{
  map = new google.maps.Map(document.getElementById('map'), 
  {
    center: {lat: 51.5331414, lng: -0.4773218},
    scrollwheel: false,
    zoom: 12
  });
}

/*
  Adds a marker to the global map with the name and location
*/
function addMarker(name, location)
{
  var marker = new google.maps.Marker({
    title: name,
    position : location, 
    map : map,
    animation: google.maps.Animation.DROP,
  });
  
  markers.push(marker); 
}

/*
  Removes all markers from the map
*/
function clearMarkers()
{
  markers = []; 

  if(markers)
  {
    for(var i=0; i<markers.length; i++)
    {
      markers[i].setMap(null); 
    }
    markers.length = 0; 
  }
}

/*
  Generates a polygon
*/
function GeneratePolyline(polygonCoords)
{
  return new google.maps.Polyline({
            path: polygonCoords,
            geodesic: true,
            strokeColor: '#FF0000',
            strokeOpacity: 1.0,
            strokeWeight: 2
        });
}

/*
  Gets Locations realted to the current trip
*/
function GetTripLocations()
{
  var tripID = document.getElementById('currentTrip').innerHTML; 

  $.ajax(
  {
    url: 'GetLocations.php',
    type: "POST",
    data: { TripID : tripID },
    dataType: 'json',
    success: function(data, status, jq)
    {
      clearMarkers();
      var polygonCoords = []; 
      var bound = new google.maps.LatLngBounds();

      data.forEach(function(element) 
      {
          var currentLoc = {lat: parseFloat(element.Lat), lng: parseFloat(element.Long)};

          addMarker(element.Name, currentLoc); 
          polygonCoords.push(currentLoc); 
          bound.extend(new google.maps.LatLng(currentLoc.lat, currentLoc.lng));
      }, this);

      var polygon = GeneratePolyline(polygonCoords); 
      polygon.setMap(map); 
      map.setCenter(bound.getCenter()); 
      map.fitBounds(bound) 
     
    },
    error: function(jq, err, thrown)
    {
      console.log("error " + err); 
    }
  });
}

/// FOR TESTING
$( document ).ready(function()
{
  console.log("loaded"); 
  document.getElementById('currentTrip').innerHTML = "5b90b50c-36c5-11e6-bbd4-f388cc669bd7"; 
  GetTripLocations(); 
}); 