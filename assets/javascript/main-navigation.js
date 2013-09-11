if( !window.SOCD ){ window.SOCD = {} };

( function( window, $, undefined ){

	var T = {
		header: Templates[ 'main-navigation--typeahead-header' ].render.bind( Templates[ 'main-navigation--typeahead-header' ] ),
		result: Templates[ 'main-navigation--typeahead-result' ].render.bind( Templates[ 'main-navigation--typeahead-result' ] )
	};

	var Menu = {
		ele: '.main-navigation-container',
		$ele: $( '.main-navigation-container' ),
		$searchInput: $( '.site-search__input, #adminbar-search' ),

		init: function(){
			Menu.init_toggle();
			Menu.init_typeahead();
			Menu.init_ui();
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
			var raw = SOCD.Config.typeahead_local;
			var structureTypeahead = [];
			for( type in raw ){
				structureTypeahead.push({
					name: type,
					local: raw[type],
					limit: 100,
					header: T.header( { name: type } ),
					template: T.result
				});
			}				
			$searchBox.typeahead( structureTypeahead );
		},
		init_ui: function(){			
			var $searchBox = $( '.site-search__input', Menu.$ele );	
			$searchBox.on('typeahead:opened', function(){				
				$('.main-navigation', Menu.$ele ).addClass('typeahead-open');
			});
			$searchBox.on('typeahead:closed', function(){
				$('.main-navigation', Menu.$ele ).removeClass('typeahead-open');
			});
			$searchBox.on( 'focus', function(){				
				$('.main-navigation__menu-item--breadcrumb:not(.main-navigation__menu-item--root)').addClass('collapse');
			});
			$searchBox.on( 'blur', function(){
				$('.main-navigation', Menu.$ele ).removeClass('typeahead-open');
				$('.main-navigation__menu-item--breadcrumb:not(.main-navigation__menu-item--root)').removeClass('collapse');
			});
		}
	};

	Menu.init();

	try {
		window.SOCD.Menu = Menu;
	} catch(e) {
		console.log( "Error assigning Menu module to SOCD Object, has everything loaded ok?", e );
	}

})( window, jQuery );