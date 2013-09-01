/*global SOCDMapping */
var map;
var SOCD_MAPTYPE_ID = 'socd_style';

function init() {
	var coordinates = SOCDMapping.center.coordinates.split(',');
	var mapOptions = {
    disableDefaultUI: true,
    scrollwheel: false,
		zoom: 8,
    zoomControl: false,
		center: new google.maps.LatLng( coordinates[0], coordinates[1] ),
		mapTypeControlOptions:{
			mapTypeIds: []
		},
		mapTypeId: SOCD_MAPTYPE_ID
	};
	
	var map = new google.maps.Map(document.getElementById('homepage--map'), mapOptions);

	var featureOpts = [
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
];

	map.mapTypes.set(SOCD_MAPTYPE_ID, new google.maps.StyledMapType( featureOpts, {
		name: "School of Communication Design"
	} ));

	// Add Markers
	var markers = SOCDMapping.places;

	if (markers.length) {
		for (var i = 0; i < markers.length; i++) {
			var marker = markers[i],
				coords = marker.locations.coordinates.split(',');

			new google.maps.Marker({
				position: new google.maps.LatLng( coords[0], coords[1] ),
				map: map,
				title: marker.name
			})
		};
	}

}

google.maps.event.addDomListener(window, 'load', init);