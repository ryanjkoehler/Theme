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

	if( $( '.stream--article' ).length > 0  ){
		console.log( 'fitVids' );
		$( '.col--stream' ).fitVids();
	}

} )( window, jQuery );