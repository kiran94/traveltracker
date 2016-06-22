/*
  Initialises the map with a default location
*/
function initMap() 
{
  var map = new google.maps.Map(document.getElementById('map'), 
  {
    center: {lat: -8.4543386, lng: 114.5110503},
    scrollwheel: true,
    zoom: 8
  });
}