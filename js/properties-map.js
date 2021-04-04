var features = [];

function initPropertiesMap() {
    // Styles a map in night mode.
    var map = new google.maps.Map(document.getElementById('ajax-map'), {
      center: {lat: 35.9375, lng: 14.3754},
      zoom: 11,
      styles: [
        {
          "elementType": "geometry",
          "stylers": [
            {
              "color": "#f5f5f5"
            }
          ]
        },
        {
          "elementType": "labels.icon",
          "stylers": [
            {
              "visibility": "off"
            }
          ]
        },
        {
          "elementType": "labels.text.fill",
          "stylers": [
            {
              "color": "#616161"
            }
          ]
        },
        {
          "elementType": "labels.text.stroke",
          "stylers": [
            {
              "color": "#f5f5f5"
            }
          ]
        },
        {
          "featureType": "administrative.land_parcel",
          "elementType": "labels",
          "stylers": [
            {
              "visibility": "off"
            }
          ]
        },
        {
          "featureType": "administrative.land_parcel",
          "elementType": "labels.text.fill",
          "stylers": [
            {
              "color": "#bdbdbd"
            }
          ]
        },
        {
          "featureType": "poi",
          "elementType": "geometry",
          "stylers": [
            {
              "color": "#eeeeee"
            }
          ]
        },
        {
          "featureType": "poi",
          "elementType": "labels.text",
          "stylers": [
            {
              "visibility": "off"
            }
          ]
        },
        {
          "featureType": "poi",
          "elementType": "labels.text.fill",
          "stylers": [
            {
              "color": "#757575"
            }
          ]
        },
        {
          "featureType": "poi.park",
          "elementType": "geometry",
          "stylers": [
            {
              "color": "#e5e5e5"
            }
          ]
        },
        {
          "featureType": "poi.park",
          "elementType": "labels.text.fill",
          "stylers": [
            {
              "color": "#9e9e9e"
            }
          ]
        },
        {
          "featureType": "road",
          "elementType": "geometry",
          "stylers": [
            {
              "color": "#ffffff"
            }
          ]
        },
        {
          "featureType": "road.arterial",
          "elementType": "labels.text.fill",
          "stylers": [
            {
              "color": "#757575"
            }
          ]
        },
        {
          "featureType": "road.highway",
          "elementType": "geometry",
          "stylers": [
            {
              "color": "#dadada"
            }
          ]
        },
        {
          "featureType": "road.highway",
          "elementType": "labels.text.fill",
          "stylers": [
            {
              "color": "#616161"
            }
          ]
        },
        {
          "featureType": "road.local",
          "elementType": "labels",
          "stylers": [
            {
              "visibility": "off"
            }
          ]
        },
        {
          "featureType": "road.local",
          "elementType": "labels.text.fill",
          "stylers": [
            {
              "color": "#9e9e9e"
            }
          ]
        },
        {
          "featureType": "transit.line",
          "elementType": "geometry",
          "stylers": [
            {
              "color": "#e5e5e5"
            }
          ]
        },
        {
          "featureType": "transit.station",
          "elementType": "geometry",
          "stylers": [
            {
              "color": "#eeeeee"
            }
          ]
        },
        {
          "featureType": "water",
          "elementType": "geometry",
          "stylers": [
            {
              "color": "#c9c9c9"
            }
          ]
        },
        {
          "featureType": "water",
          "elementType": "labels.text.fill",
          "stylers": [
            {
              "color": "#9e9e9e"
            }
          ]
        }
      ]
    });

    var icons = {
        propertyPosition:{
            icon: window.location.origin + '/wp-content/themes/stevesandco/resources/red-marker.png'
        }
    };

    var coordinatesArray = [];
    i = 0;

    $('.map-details').each(function(){
      var longitude = $(this).find('.longitude').text();
      longitude = parseFloat(longitude);

      var latitude = $(this).find('.latitude').text();
      latitude = parseFloat(latitude);

      item = {};
      item['longitude'] = longitude;
      item['latitude'] = latitude;

      coordinatesArray.push(item);
    });

    var uniqueCoordinatesArray = {};

    coordinatesArray = coordinatesArray.filter(function(currentObject){

      if(currentObject.longitude in uniqueCoordinatesArray){
        return false;
      }else{
        uniqueCoordinatesArray[currentObject.longitude] = true;
        return true;
      }

    });

    var mapMultiplePointerFeature = [];

    for(var i = 0; i < coordinatesArray.length; i++){

      item = {};
      item['position'] = new google.maps.LatLng(coordinatesArray[i].longitude, coordinatesArray[i].latitude);
      item['type'] = 'propertyPosition';

      mapMultiplePointerFeature.push(item);
    }

    features = mapMultiplePointerFeature;

    for (var i = 0; i < features.length; i++) {
        var marker = new google.maps.Marker({
            position: features[i].position,
            icon: icons[features[i].type].icon,
            map: map
        });
        marker.set('title',i);
    };

    var coordArray = [];
    i = 0;

    $('.map-details').each(function(index) {
        var longitude = $( this ).find('.longitude').text();
        var latitude = $( this ).find('.latitude').text();
        var coordinates = longitude + ',' + latitude;

        coordArray[i++] = coordinates;
    });

    var unique = [];

    $.each(coordArray, function(i, e) {
        if ($.inArray(e, unique) == -1) unique.push(e);
    });

    $.each(unique, function(key, value) {
        $('.map-details').each(function(index) {
            var longitude = $( this ).find('.longitude').text();
            var latitude = $( this ).find('.latitude').text();
            var thisCoordinates = longitude + ',' + latitude;
            
            if(thisCoordinates === value){
                $(this).parent().parent().attr('onmouseover','hover('+key+')');
                $(this).parent().parent().attr('onmouseout','out('+key+')');

            }

        });
    });

}

var iconHover = window.location.origin + '/wp-content/themes/stevesandco/resources/black-marker.svg'

function hover(id){

}

function out(id){

}