(function( $ ){

	var SOCD_menu = {
		ele: '.main-navigation-container',
		$ele: $( '.main-navigation-container' ),
		init: function(){
			SOCD_menu.init_toggle();
			SOCD_menu.init_typeahead();
		},
		init_toggle: function(){
			var $menuToggle = $( '.main-navigation-container__mobile-toggle', SOCD_menu.$ele );
			$menuToggle.click( function( e ){
				e.preventDefault();
				SOCD_states.toggleState( 'state-mobile-menu-visible' );
			});
		},
		init_typeahead: function(){
			var $searchBox = $( '.site-search__input', SOCD_menu.$ele );			
			$searchBox.typeahead([
				{
					name: 'Blogs',
					local: [ 'Blog One', 'Blog Two', 'Blog Three', 'Blog Four', 'Blog Five' ]
				},
				{
					name: 'Staff',
					local: [ 'Luke Watts', 'Tom Lynch', 'Oliver Smith', 'Eva Verhoeven' ]
				},
				{
					name: 'Students',
					local: [ 'Jonny', 'Jimmy', 'Jamie', 'Jeremy', 'Jerome' ]
				},
				{
					name: 'Courses',
					local: [ 'Graphic Design: New Media', 'Graphic Design', 'Communication Design', 'Illustration' ]
				}
			]);
		}
	};

	SOCD_menu.init();

	window.SOCD_menu = SOCD_menu;

})( jQuery );