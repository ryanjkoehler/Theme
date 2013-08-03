(function( $ ){

	var SOCD_states = {
		ele: 'body',
		$ele: $( 'body' ),
		toggleState: function( state ){
			SOCD_states.$ele.toggleClass( state );
		}
	};

	window.SOCD_states = SOCD_states;

})( jQuery );