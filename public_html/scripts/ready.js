$( document ).ready(function()
{
  //// run for default location
  GetTripLocations();

  $('.trip').on('click', function()
  {
      document.getElementById('currentTrip').innerHTML = $(this).attr('id'); 
      GetTripLocations();
  }); 
}); 