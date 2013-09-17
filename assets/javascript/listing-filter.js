if( !window.SOCD ){ window.SOCD = {} };

( function( window, $, undefined ){

	var ListingFilter = {
		$ele: null,
		$filters: null,
		$target: null,
		$items: null,
		init: function( _ele, _target ){
			ListingFilter.$ele = _ele;
			ListingFilter.$target = _target;
			ListingFilter.$filters = $( '.section-options li a', ListingFilter.$ele );
			ListingFilter.$items = $( 'li', ListingFilter.$target );
			ListingFilter.initUI();
		},
		initUI: function(){
			ListingFilter.$filters.after( '<a href="#" class="clear">&times;</a>');

			ListingFilter.$filters.on( 'click', function( e ){
				e.preventDefault();
				$(this).toggleClass( 'active' );				
				ListingFilter.run();
			});

			ListingFilter.$filters.siblings( '.clear' ).on( 'click', function( e ){
				e.preventDefault();
				$(this).siblings('a').removeClass( 'active' );
				ListingFilter.run();
			});
		},
		run: function(){
			var $active = ListingFilter.$items;
			ListingFilter.$filters.filter('.active').each( function(){
				var section = $(this).closest( '.listing-filter--section' ).attr('data-section'),
					by = $(this).attr('href').replace( '#', '' );
				console.log( section );
				$active = $active.filter( '[data-' + section + '="' + by + '"]' );
			});
			ListingFilter.$items.hide();
			$active.show();
		}		
	};	
	
	window.SOCD.ListingFilter = ListingFilter;
	
} )( window, jQuery );