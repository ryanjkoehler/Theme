if( !window.SOCD ){ window.SOCD = {} };

( function( window, $, undefined ){

	var T = {
		header: Templates[ 'main-navigation--typeahead-header' ].render.bind( Templates[ 'main-navigation--typeahead-header' ] ),
		result: Templates[ 'main-navigation--typeahead-result' ].render.bind( Templates[ 'main-navigation--typeahead-result' ] )
	};

	var Menu = {
		ele: '.main-navigation-container',
		$ele: $( '.main-navigation-container' ),
		init: function(){
			Menu.init_toggle();
			Menu.init_typeahead();
		},
		init_toggle: function(){
			var $menuToggle = $( '.main-navigation-container__mobile-toggle', Menu.$ele );
			$menuToggle.click( function( e ){
				e.preventDefault();
				SOCD.States.toggleState( 'state-mobile-menu-visible' );
			});
		},
		init_typeahead: function(){
			var $searchBox = $( '.site-search__input', Menu.$ele );			
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
					header: T.header( { name: 'Blogs' } ),
					template: T.result
				},
				{
					name: 'Staff',
					local: [ 'Luke Watts', 'Tom Lynch', 'Oliver Smith', 'Eva Verhoeven' ],
					header: T.header( { name: 'Staff' } ),
					template: T.result
				},
				{
					name: 'Students',
					local: [ 'Jonny', 'Jimmy', 'Jamie', 'Jeremy', 'Jerome' ],
					header: T.header( { name: 'Students' } ),
					template: T.result
				},
				{
					name: 'Courses',
					local: [ 'Graphic Design: New Media', 'Graphic Design', 'Communication Design', 'Illustration' ],
					header: T.header( { name: 'Courses' } ),
					template: T.result
				}
			]);
		}
	};

	Menu.init();

	window.SOCD.Menu = Menu;

})( window, jQuery );