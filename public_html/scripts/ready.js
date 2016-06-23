/// FOR TESTING
$( document ).ready(function()
{
  document.getElementById('currentTrip').innerHTML = "58b3ab6e-36c5-11e6-bbd4-f388cc669bd7"; 
  GetTripLocations();

  $('.trip').on('click', function()
  {
      var tripID = $(this).attr('id'); 
      document.getElementById('currentTrip').innerHTML = tripID; 
      GetTripLocations();
  }); 


}); 