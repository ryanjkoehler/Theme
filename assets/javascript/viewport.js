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

	yepnope([
		{
			test: SOCD.Viewport.isBiggerThan(320),
			yep: [
				'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false',
				'http://socd.loc/wp-content/themes/socd/assets/javascript/maps.js'
			],
			complete: function() {
				SOCD.Mapping.init();
			}
		}
	]);

	
})(window.SOCD);