$( document ).ready(function()
{
  //// run for default location
  GetTripLocations();

  /*
    On click of a trip, set the hidden field current trip to the new trip id and run GetTripLocations()
  */
  $('.trip').on('click', function()
  {
      document.getElementById('currentTrip').innerHTML = $(this).attr('id'); 
      GetTripLocations();
  }); 
}); 