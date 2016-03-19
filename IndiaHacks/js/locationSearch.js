    var place;
    var placeSearch, autocomplete;
    var componentForm = {
      street_number: 'short_name',
      route: 'long_name',
      locality: 'long_name',
      administrative_area_level_1: 'short_name',
      country: 'long_name',
      postal_code: 'short_name'
    };

    function initAutocomplete() {
      autocomplete = new google.maps.places.Autocomplete((document.getElementById('txtPlaces')));
      autocomplete.addListener('place_changed', fillInAddress);
    }

    function fillInAddress() {
      place = autocomplete.getPlace();
      var placeUrlVal = document.getElementById("placeUrl").value; 

      if(place.photos!=null)
        document.getElementById("placeUrl").value = place.photos[0].getUrl({'maxWidth': 5000, 'maxHeight': 5000});
      else
        placeUrlVal = "";

      for (var i = 0; i < place.address_components.length; i++) {

        var addressType = place.address_components[i].types[0];
        if (componentForm[addressType]) {
          var val = place.address_components[i][componentForm[addressType]];

   
          if(addressType == "country")
            document.getElementById("placeCountry").value = val;
          if(addressType == "locality")
            document.getElementById("placeState").value = val;
        }
      }
    }
    // [END region_fillform]

    // [START region_geolocation]
    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
          var geolocation = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          };
          var circle = new google.maps.Circle({
            center: geolocation,
            radius: position.coords.accuracy
          });
          autocomplete.setBounds(circle.getBounds());
        });
      }
    }
    