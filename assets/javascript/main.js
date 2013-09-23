if( !window.SOCD ){ window.SOCD = {} };

( function( window, $, undefined ){

	if( $('.listing-filter').length > 0 && $('.listing__students').length > 0 ){
		SOCD.ListingFilter.init( $('.listing-filter'), $('.listing__students') );
	} else if( $('.listing-filter').length > 0 &&  $('.listing__profiles').length > 0 ){
		SOCD.ListingFilter.init( $('.listing-filter'), $('.listing__profiles') );
	}

	if( $('.blog-filter').length > 0 ){
		SOCD.BlogFilter.init( $('.blog-filter'), $('#posts-container'), $('.navigation.stream--paging') );
	}

	if( $('.search-form').length > 0 ){
		$('.search-form').each( function(){
			SOCD.SearchForm( $(this) );
		});
	}

	try {
		console.log(SOCD.Config.asset_url);
		yepnope([
			{
				test: $('iframe').length > 0,
				yep: [
					SOCD.Config.assets_url + '/javascript/libs/jquery.fitvids.js'
				],
				callback: function() {
					$( 'iframe' ).parents('div').first().fitVids();
				}
			}
		]);

	} catch( e ) {
		console.log( e, 'Error loading maps' );
	}

} )( window, jQuery );