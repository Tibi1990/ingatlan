/***************************
*Google maps geocoder api. *
***************************/

/**
*Global variable
*/
var map;

function initialize()
{
  var markers = [];

  /***
  *When the map load,focus
  *in the center cordinates.
  *The cordinates point in Serbia.
  */
  var serbia = new google.maps.LatLng( 44.315988, 21.818848 );

  /**
  *Google map settings
  *default map options.
  */
  var mapOptions = {
    zoom: 8,
    center: serbia,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    zoomControlOptions: {
      style:google.maps.ZoomControlStyle.SMALL
    }
  };

  /**
  *Create the map,
  *whith specific html element.
  */
  map = new google.maps.Map( document.getElementById('map-canvas'), mapOptions );

  /**
  *Place search libary
  */
  var input = ( document.getElementById('pac-input') );
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  var searchBox = new google.maps.places.SearchBox( (input) );

  /**
  *[START region_getplaces]
  *Listen for the event fired when the user selects an item from the
  *pick list. Retrieve the matching places for that item.
  */
  google.maps.event.addListener( searchBox, 'places_changed', function() {
    var places = searchBox.getPlaces();
   // map.maxZoom(8);

    if (places.length == 0) {
      return;
    }

    for (var i = 0, marker; marker = markers[i]; i++) {
      marker.setMap(null);
    }

    // For each place, get the icon, place name, and location.
    markers = [];

    var bounds = new google.maps.LatLngBounds();

    for (var i = 0, place; place = places[i]; i++) {
      var image = {
        url: place.icon,
        size: new google.maps.Size(100, 100),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      // Create a marker for each place.
      var marker = new google.maps.Marker({
        map: map,
        icon: image,
        title: place.name,
        position: place.geometry.location,
        draggable: false,
        animation: google.maps.Animation.BOUNCE
      });

      markers.push(marker);
      bounds.extend(place.geometry.location);
    }

    map.fitBounds(bounds);

    /**
    *Get the marker position.
    */
    getMarkerPosition(marker.getPosition());    
  });

  // [END region_getplaces]
  // Bias the SearchBox results towards places that are within the bounds of the
  // current map's viewport.
  google.maps.event.addListener( map, 'bounds_changed', function() {
    var bounds = map.getBounds();
    searchBox.setBounds(bounds);

  /**
  *Search input REACT, first search.
  */
  // map.setZoom(12);

  /**
  *Get the marker position.
  *EXTERNAL FUNCTION
  */
  getMarkerPosition(marker.getPosition());
  });
}//End initialize function.

/**
*Hidden input,Lat Lng
*send the value marker position
*/
function getMarkerPosition(location)
{
  //Set the hidden input value
  document.getElementById("ListingLat").value = location.H;
  //Set the hidden input value
  document.getElementById("ListingLng").value = location.L;
}

/**
*Map search input must has a value.
*/
function mapValidator()
{
  var googleMapSearchInput = document.getElementById("pac-input").value;
  if(googleMapSearchInput == null || googleMapSearchInput == "")
  {
    alert("Kérlek jelöld be az ingatlan helyét a térképen!");
  }
}

/**
*When the page load
*call initialize function
*load the google map.
*/
google.maps.event.addDomListener( window, 'load', initialize );


