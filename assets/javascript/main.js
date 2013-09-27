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

	SOCD.ConditionalScripts.load( 'fitVids', function(){
		$( 'iframe' ).parents('div').first().fitVids();
	});

	jQuery('#main-navigation--login-form').on('submit', function(event) {
		event.preventDefault();
		var d = new Date();
			d.setTime(d.getTime() + ( 365 * 24 * 60 * 60 * 1000 ));
		document.cookie = 'wordpress_socd_io=1; expires=' + d.toGMTString() + '; domain=.' + window.location.host + '; path=/';
	});

} )( window, jQuery );