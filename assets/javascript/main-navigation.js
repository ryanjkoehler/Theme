if ( !window.SOCD ){ window.SOCD = {}; }

( function( window, $, undefined ){

	var T = {
		header: Templates[ 'main-navigation--typeahead-header' ].render.bind( Templates[ 'main-navigation--typeahead-header' ] ),
		result: Templates[ 'main-navigation--typeahead-result' ].render.bind( Templates[ 'main-navigation--typeahead-result' ] )
	};

	var Menu = {
		ele: '.main-navigation-container',
		$ele: $( '.main-navigation-container' ),
		$bar: $( '.main-navigation, .ab-top-menu' ),
		$searchInput: $( '.site-search__input, #adminbar-search' ),

		init: function(){
			Menu.init_toggle();
			Menu.init_typeahead();
			Menu.init_ui();

			if ( Modernizr.touch ) Menu.init_touch();
		},
		init_toggle: function(){
			var $menuToggle = $( '.main-navigation-container__mobile-toggle', Menu.$ele );
			$menuToggle.click( function( e ){
				e.preventDefault();
				SOCD.States.toggleState( 'state-mobile-menu-visible' );
			});
		},	
		init_typeahead: function(){
			var cleanUrlRegex = /^(https?):\/\//;
			var rootUrl = SOCD.Config.site_root_url.replace( cleanUrlRegex, '' );
			var raw = SOCD.Config.typeahead_local;
			var structureTypeahead = [];
			if( SOCD.Config.current_site === 'SOCD.io' ){
				// we need to include everything as we're at the root
				for ( var type in raw ) {
					var data = [];
					if( type !== 'Course' ){						
						for( var i = 0; i < raw[type].length; i++ ){
							//but we need to append info of what course to the titles
							var item = raw[type][i];
							var siteDomain = item.url.split('/');
							siteDomain = siteDomain[ 2 ];
							var siteName = SOCD.Config.sites[ siteDomain ];
							if( siteName ){
								item.title = item.title + ' - ' + siteName;
							}
							data.push( item );
						}
						
					} else {
						data = raw[type];
					}					
					structureTypeahead.push({
						name: type,
						local: data,
						limit: 100,
						header: T.header( { name: type } ),
						template: T.result
					});
				}
			} else {				
				for ( var type in raw ) {
					var section = raw[type];
					var data = [];
					for( var i = 0; i < section.length; i++ ){
						var item = section[i];		
						var url = item.url.replace( cleanUrlRegex, '' );				
						if( url.indexOf( rootUrl  ) === 0 ){
							data.push( item );
						}
					}
					if( data.length > 0 ){
						structureTypeahead.push({
							name: type,
							local: data,
							limit: 100,
							header: T.header( { name: type } ),
							template: T.result
						});
					}
				}
			}
			Menu.$searchInput.typeahead( structureTypeahead );
		},
		init_ui: function(){
			var noCollapse = [
				'#wp-admin-bar-my-account',
				'#wp-admin-bar-my-sites',
				'.main-navigation__menu-item--profile',
				'#wp-admin-bar-socd-menu-network',
				'.main-navigation__menu-item--root'
			].join( ', ' );

			var $searchLi = Menu.$searchInput.closest( 'li' ),
				$searchForm =  Menu.$searchInput.closest( 'form' ),
				$collapsable = $searchLi.nextAll( 'li' ).not( noCollapse ).add( $searchLi.prevAll( 'li' ).not( noCollapse ) ),
				$selectable = Menu.$searchInput.add( '.tt-dropdown-menu' );

			Menu.$searchInput.addClass( 'search-form--input' );
			
			SOCD.SearchForm( $searchForm );

			Menu.$searchInput.on( 'typeahead:opened', function(){
				$collapsable.addClass( 'collapse' );
				Menu.$bar.addClass('typeahead-open');
			});

			Menu.$searchInput.on( 'typeahead:closed', function(){
				$collapsable.removeClass( 'collapse' );
				Menu.$bar.removeClass('typeahead-open');
			});			

			Menu.$searchInput.on( 'typeahead:selected', function( e, data ){
				Menu.typeahead_visit_url( data.url );
			});

			Menu.$searchInput.on( 'keydown', function( e ){	
				if( e.which === 13 && $('.tt-suggestion').length === 1 ){
					e.preventDefault();
					Menu.typeahead_visit_index( 0 );
				}
			});
		},
		init_touch: function() {
			var $menupoppers = $( '.main-navigation, .ab-top-menu, .main-navigation__menu-item--root' ).find('a');

			$menupoppers.on('click', function( event ) {
				var $el = $(this),
					$li = $el.parents('li').first();

				if ( $li.hasClass('menupop') || $li.hasClass('main-navigation__menu-item--root') || $li.find('.sub-menu').length ) {
					event.preventDefault();
					$li.toggleClass('s__hover');
				}

			});
		},
		typeahead_visit_url: function( url ){
			if( typeof url !== 'undefined' ){
				window.location.href = url;
			}
		},
		typeahead_visit_index: function( index ){
			var $typeahead_menu = $('.tt-dropdown-menu'),
				$links = $typeahead_menu.find('a'),
				$visit = $( $links.get( index ) );
			Menu.typeahead_visit_url( $visit.attr('href') );
		}
	};

	Menu.init();

	try {
		window.SOCD.Menu = Menu;
	} catch(e) {
		console.log( "Error assigning Menu module to SOCD Object, has everything loaded ok?", e );
	}

})( window, jQuery );