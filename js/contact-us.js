if($('.contact-us-container')[0]){
  function initMap() {
      // Styles a map in night mode.
      var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 35.874277, lng: 14.457138},
        zoom: 17,
        styles: [
          {elementType: 'geometry', stylers: [{color: '#212121'}]},
          {elementType: 'labels.text.stroke', stylers: [{color: '#212121'}]},
          {elementType: 'labels.text.fill', stylers: [{color: '#757575'}]},
          {
            featureType: 'administrative.locality',
            elementType: 'labels.text.fill',
            stylers: [{color: '#bdbdbd'}]
          },
          {
            featureType: 'poi',
            elementType: 'labels',
            stylers: [{visibility: 'off'}]
          },
          {
            featureType: 'poi.park',
            elementType: 'geometry',
            stylers: [{color: '#181818'}]
          },
          {
            featureType: 'poi.park',
            elementType: 'labels.text.fill',
            stylers: [{color: '#616161'}]
          },
          {
            featureType: 'road',
            elementType: 'geometry.fill',
            stylers: [{color: '#2c2c2c'}]
          },
          {
            featureType: 'road',
            elementType: 'geometry.stroke',
            stylers: [{color: '#212a37'}]
          },
          {
            featureType: 'road',
            elementType: 'labels.text.fill',
            stylers: [{color: '#8a8a8a'}]
          },
          {
            featureType: 'road.highway',
            elementType: 'geometry',
            stylers: [{color: '#3c3c3c'}]
          },
          {
            featureType: 'road.highway',
            elementType: 'geometry.stroke',
            stylers: [{color: '#1f2835'}]
          },
          {
            featureType: 'road.highway',
            elementType: 'labels.text.fill',
            stylers: [{color: '#f3d19c'}]
          },
          {
            featureType: 'transit',
            elementType: 'geometry',
            stylers: [{color: '#2f3948'}]
          },
          {
            featureType: 'transit.station',
            elementType: 'labels.text.fill',
            stylers: [{color: '#757575'}]
          },
          {
            featureType: 'water',
            elementType: 'geometry',
            stylers: [{color: '#000000'}]
          },
          {
            featureType: 'water',
            elementType: 'labels.text.fill',
            stylers: [{color: '#3d3d3d'}]
          },
          {
            featureType: 'water',
            elementType: 'labels.text.stroke',
            stylers: [{color: '#17263c'}]
          }
        ]
      });

      var icons = {
          office:{
            icon: window.location.origin + '/bilom/wp-content/themes/stevesandco/resources/red-marker.png'
          }
      };

      var features = [
          {
              position: new google.maps.LatLng(35.874277, 14.457138),
              type: 'office'
          }
      ];

      for (var i = 0; i < features.length; i++) {
          var marker = new google.maps.Marker({
              position: features[i].position,
              icon: icons[features[i].type].icon,
              map: map
          });
      };
  }
}