/* global google */
( function() {

	var SOCD = window.SOCD;

  SOCD.Mapping = {
    infowindow: null,
    maptypeId: 'socd_style',
    mapSelector: 'homepage--map',
    featureOpts: [
      {
        "featureType": "transit.line",
        "stylers": [
          { "visibility": "off" }
        ]
      },{
        "featureType": "poi",
        "stylers": [
          { "visibility": "off" }
        ]
      },{
        "featureType": "road.arterial",
        "stylers": [
          { "visibility": "off" }
        ]
      },{
        "featureType": "road.highway",
        "elementType": "labels",
        "stylers": [
          { "visibility": "off" }
        ]
      },{
        "featureType": "administrative",
        "stylers": [
          { "visibility": "off" }
        ]
      },{
        "featureType": "water",
        "elementType": "labels",
        "stylers": [
          { "visibility": "off" }
        ]
      },{
        "featureType": "road.highway",
        "elementType": "geometry",
        "stylers": [
          { "visibility": "simplified" }
        ]
      }
    ],
    markers: SOCD.Config.places,
    init: function() {

      SOCD.Mapping.loadScript();
    },
    loadScript: function() {
      var script = document.createElement('script');

      script.type = 'text/javascript';
      script.src = 'http://maps.googleapis.com/maps/api/js?key=AIzaSyBQjFHblWw4toFdQmRIWRQIS9jppMAHKVs&sensor=false&' + 'callback=SOCD.Mapping.loaded';
      document.body.appendChild( script );
    },
    loaded: function() {
      var self = this,
        coordinates = SOCD.Config.center.coordinates.split(',');
  
      try {
        self.map = new google.maps.Map(
          document.getElementById( self.mapSelector ),
          {
            disableDefaultUI: true,
            scrollwheel: false,
            panControl: false,
            zoom: 8,
            zoomControl: false,
            mapTypeControlOptions:{
              mapTypeIds: []
            },
            mapTypeId: self.mapTypeId,
            center: new google.maps.LatLng( coordinates[0], coordinates[1] )
        } );

      } catch(error) {

        console.log( error );
      }
      
      self.infowindow = new google.maps.InfoWindow({
          content: ''
      });

      if (self.markers.length) {
        for (var i = 0; i < self.markers.length; i++) {
          var info = self.markers[i],
              coords = info.locations.coordinates.split(','),
              mark;

          mark = new google.maps.Marker({
            position: new google.maps.LatLng( coords[0], coords[1] ),
            map: self.map,
            flat: true,
            title: info.name,
            html: info.html,
          });

          google.maps.event.addListener( mark, 'click', function() {
            self.infowindow.setContent( self.infowindowContent( this.html ) );
            self.infowindow.open( self.map, this );
          });
        }
      }

      self.map.mapTypes.set( SOCD.Mapping.maptypeId, new google.maps.StyledMapType( self.featureOpts, {
        name: "School of Communication Design"
      } ));
    },
    infowindowContent: function(msg) {
      console.log(msg);
      return '<div class="homepage--map-iw">' + msg + '</div>';
    }

  };

  window.SOCD = SOCD;
})();