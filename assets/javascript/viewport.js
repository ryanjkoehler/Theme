/*globals yepnope */
(function(SOCD) {
	var SOCD = window.SOCD;

	SOCD.Viewport = {
		isBiggerThan: function( test ) {
			return window.innerWidth >= test;
		},
		isSmallerThan: function( test ) {
			return ! this.isBiggerThan( test );
		}
	};

	try {

		yepnope([
			{
				test: (SOCD.Viewport.isBiggerThan( 380 ) && $('#homepage--map').length > 0),
				yep: [
					'http://socd.loc/wp-content/themes/socd/assets/javascript/maps.js'
				],
				callback: function() {
					SOCD.Mapping.init();
				}
			}
		]);

	} catch( e ) {
		console.log( e, 'Error loading maps' );
	}
	

})(window.SOCD);