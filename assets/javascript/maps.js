/* global google */
( function() {

	var SOCD = window.SOCD;

	SOCD.Mapping = {
		coordinates: SOCD.Config.center.coordinates.split(','),
		maptypeId: 'socd_style',
		mapSelector: 'homepage--map',
		featureOpts: [
			{
				"featureType": "transit.line",
				"stylers": [
					{ "visibility": "off" }
				]
			}, {
				"featureType": "poi",
				"stylers": [
					{ "visibility": "off" }
				]
			}, {
				"featureType": "road.arterial",
				"stylers": [
					{ "visibility": "off" }
				]
			}, {
				"featureType": "road.highway",
				"elementType": "labels",
				"stylers": [
					{ "visibility": "off" }
				]
			}, {
				"featureType": "administrative",
				"stylers": [
					{ "visibility": "off" }
				]
			}, {
				"featureType": "water",
				"elementType": "labels",
				"stylers": [
					{ "visibility": "off" }
				]
			}, {
				"featureType": "road.highway",
				"elementType": "geometry",
				"stylers": [
					{ "visibility": "simplified" }
				]
			}
		],
		markers: SOCD.Config.places,
		init: function() {
			var self = this,
			map;

			try {
				map = new google.maps.Map( document.getElementById(), self.mapSelector );
			} catch(error) {
				console.log(error);
				return false;
			}

			if ( this.markers.length ) {
				for ( var i = 0; i < markers.length; i++ ) {
					var marker = markers[i],
					coords = marker.locations.coordinates.split(',');

					new google.maps.Marker( {
						position: new google.maps.LatLng( coords[0], coords[1] ),
						map: map,
						title: marker.name
					} )
				}
			}

			map.mapTypes.set( SOCD.Mapping.maptypeId, new google.maps.StyledMapType( featureOpts, {
				name: "School of Communication Design"
			} ) );
		}
	};
} )();
