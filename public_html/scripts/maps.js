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
    zoom: 10
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
  setMapOnAll(null); 
  markers = []; 
}

/*
  Gets Locations realted to the current trip
*/
function GetTripLocations()
{
  var tripID = document.getElementById('currentTrip').innerHTML; 
  //// jquery post to a php endpoint with the trip id and return the locations related

  $.ajax(
  {
    url: 'GetLocations.php',
    type: "POST",
    data: { TripID : tripID },
    dataType: 'json',
    success: function(data, status, jq)
    {
      console.log(data); 
      console.log(status); 
      console.log(jq); 
    },
    error: function(jq, err, thrown)
    {
      console.log("error " + err); 
    }
  });

}