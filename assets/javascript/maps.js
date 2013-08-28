console.log(SOCDMapping.center.coordinates.split(','));
var map = L.map('homepage--map').setView(
	SOCDMapping.center.coordinates.split(','),
	8
);

var googleLayer = new L.Google('ROADMAP');
map.addLayer( googleLayer, true );

// L.tileLayer('http://{s}.tile.cloudmade.com/c1642043366b40a7af2d02fb63680628/997/256/{z}/{x}/{y}.png', {
// 	minZoom: 6,
// 	maxZoom: 9,
// 	attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>'
// }).addTo(map);

// Add our Markers
if ( SOCDMapping.places.length > 0 ) {
	console.log(SOCDMapping.places.length, 'Places length' );
	for (var i = 0, max = SOCDMapping.places.length; i < max; i++) {
		var place = SOCDMapping.places[i];

		if (!place) continue;

		var latlng = place.locations.coordinates.split(','),
			popup = L.popup({
			closeButton: false,
		})
		.setLatLng( latlng )
		.setContent( place.name + ' ' + place.telephone_number );

		L.marker( latlng ).addTo(map).bindPopup( popup );
	};
}

// Add our map Mask
/*

var polygon = L.polygon([
	[ 85, 0 ], // North
	[ -85 , 0], // South
	[ -85 , 180], // South/East
	[ 85 , 180], // North/East		              
], {
	color: 'transparent',
	fillColor: 'lime',
	fillOpacity: .5
}).addTo(map);

var polygon = L.polygon([
	[ 85, 0 ], // North
	[ -85 , 0], // South
	[ -85 , -180], // South/East
	[ 85 , -180], // North/East		              
], {
	color: 'transparent',
	fillColor: 'red',
	fillOpacity: .5
}).addTo(map);

*/