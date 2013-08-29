if( !window.SOCD ){ window.SOCD = {};}

(function( $ ){

	var States = {
		ele: 'body',
		$ele: $( 'body' ),
		toggleState: function( state ){
			States.$ele.toggleClass( state );
		}
	};

	window.SOCD.States = States;

})( jQuery );