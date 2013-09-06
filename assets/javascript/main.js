if( !window.SOCD ){ window.SOCD = {} };

( function( window, $, undefined ){
	if( $('.listing-filter').length > 0 && $('.listing__students').length > 0 ){
		console.log( 'students' );
		SOCD.ListingFilter.init( $('.listing-filter'), $('.listing__students') );
	} else if( $('.listing-filter').length > 0 &&  $('.listing__profiles').length > 0 ){
		console.log( 'profiles' );
		SOCD.ListingFilter.init( $('.listing-filter'), $('.listing__profiles') );
	}

	SOCD.BlogFilter.init( $('.blog-filter'), $('#posts-container'), $('.navigation.stream--paging') );

} )( window, jQuery );