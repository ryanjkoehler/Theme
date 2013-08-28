var map = L.map('homepage--map').setView([51.505, -0.09], 8);

L.tileLayer('http://{s}.tile.cloudmade.com/c1642043366b40a7af2d02fb63680628/997/256/{z}/{x}/{y}.png', {
	minZoom: 6,
	maxZoom: 9,
	attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>'
}).addTo(map);

// Add our Markers

var coords = [
	[ 51.270363, 0.522699 ],  // Maidstone
	[ 51.388000, 0.506721], // Rochester
	[ 51.214321, -0.798802],  // Farnham
	[ 51.336036, -0.267382],  // Epsom
	[ 51.280233, 1.078909 ]   // Canterbury
];

if ( SOCDMapping.places.length >= 1 ) {
	for (var i = 0; i < coords.length; i++) {
		if (!SOCDMapping.places[i]) continue;

		var marker = L.marker( SOCDMapping.places[i].locations.coordinates.split(',') ).addTo(map);
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