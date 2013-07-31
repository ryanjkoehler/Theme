(function( $ ){

	var localTemplates = {
		header: Templates[ 'main-navigation--typeahead-header' ].render.bind( Templates[ 'main-navigation--typeahead-header' ] ),
		result: Templates[ 'main-navigation--typeahead-result' ].render.bind( Templates[ 'main-navigation--typeahead-result' ] )
	};

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
					//remote: '?s=%QUERY',
					local: [ 
						{
							value: 'Blog One',
							url: 'http://blog.one',
							tokens: ['blog', 'one']
						},
						{
							title: 'Blog Two',
							url: 'http://blog.two',
							tokens: ['blog', 'two']
						},
						{
							title: 'Blog Three',
							url: 'http://blog.three',
							tokens: ['blog', 'three']
						},
						{
							title: 'Blog Four',
							url: 'http://blog.four',
							tokens: ['blog', 'four']
						}
					],					
					header: localTemplates.header( { name: 'Blogs' } ),
					template: localTemplates.result
				},
				{
					name: 'Staff',
					local: [ 'Luke Watts', 'Tom Lynch', 'Oliver Smith', 'Eva Verhoeven' ],
					header: localTemplates.header( { name: 'Staff' } ),
					template: localTemplates.result
				},
				{
					name: 'Students',
					local: [ 'Jonny', 'Jimmy', 'Jamie', 'Jeremy', 'Jerome' ],
					header: localTemplates.header( { name: 'Students' } ),
					template: localTemplates.result
				},
				{
					name: 'Courses',
					local: [ 'Graphic Design: New Media', 'Graphic Design', 'Communication Design', 'Illustration' ],
					header: localTemplates.header( { name: 'Courses' } ),
					template: localTemplates.result
				}
			]);
		}
	};

	SOCD_menu.init();

	window.SOCD_menu = SOCD_menu;

})( jQuery );