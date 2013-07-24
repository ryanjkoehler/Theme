(function( $ ){

	var SOCD_menu = {
		ele: '.main-navigation-container',
		$ele: $( '.main-navigation-container' ),
		init: function(){
			SOCD_menu.init_toggle();
		},
		init_toggle: function(){
			var $menuToggle = SOCD_menu.$ele.find( '.main-navigation-container__mobile-toggle' );
			console.log( SOCD_menu.$ele );
			$menuToggle.click( function( e ){
				e.preventDefault();
				$('body').toggleClass( 'state-mobile-menu-visible' );
			});
		}
	};

	SOCD_menu.init();

})( jQuery );