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
				test: SOCD.Viewport.isBiggerThan( 380 ),
				yep: [
					'http://socd.loc/wp-content/themes/socd/assets/javascript/maps.js'
				],
				complete: function() {
					SOCD.Mapping.init();
				}
			}
		]);
	} catch (e) {
		console.log("Yepnope not available");
	}

})(window.SOCD);