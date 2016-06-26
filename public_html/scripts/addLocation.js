// AJAX loader
var loader; 

// Latittude DOM element 
var lat = $("#lat"); 

// Longitude DOM element
var lng = $('#lng'); 

$(document).ready(function()
{
    registerGetLocationButton(); 

    /// Need some validation front end to stop submission when lat and long are not provided
    //registerFormValidation(); 
});

/*
    Registers the click event on the get location button to get location and set to elements 
*/
function registerGetLocationButton()
{
    $('#location').on('click', function(e)
    {
        e.preventDefault();

        loader = $('#loader'); 
        loader.css('display', 'block'); 
        getLocation(); 
    }); 
}

/*
    Gets location of the users current position else sets labels to error
*/
function getLocation()
{
    if (navigator.geolocation)
    {
        navigator.geolocation.getCurrentPosition(SetLocation);
    }
    else
    {
        document.getElementById('lat_label').innerHTML = "Error"; 
        document.getElementById('lng_label').innerHTML = "Error"; 
    }
}

/*
    Sets the location to the relavant DOM elements
    @param: current geolocation
*/
function SetLocation(pos)
{
    lat.val(pos.coords.latitude);  
    document.getElementById('lat_label').innerHTML = "Lat: " + pos.coords.latitude; 

    lng.val(pos.coords.longitude); 
    document.getElementById('lng_label').innerHTML = "Long: " + pos.coords.longitude; 

    loader.css('display', 'none'); 
}