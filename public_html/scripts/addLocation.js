$(document).ready(function()
{
    $('#location').on('click', function(e)
    {
        e.preventDefault();
        
        var loader = $('#loader'); 
        loader.css('display', 'block'); 
       
        if (navigator.geolocation)
        {
            var location = navigator.geolocation.getCurrentPosition(function(pos)
            {
                $("#lat").val(pos.coords.latitude);  
                document.getElementById('lat_label').innerHTML = pos.coords.latitude; 

                $('#lng').val(pos.coords.longitude); 
                document.getElementById('lng_label').innerHTML = pos.coords.longitude; 

                loader.css('display', 'none'); 
            });
        }
        else
        {
             document.getElementById('lat_label').innerHTML = "Error"; 
             document.getElementById('lng_label').innerHTML = "Error"; 
        }
    }); 


}); 