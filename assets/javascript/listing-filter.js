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
			ListingFilter.$sections = $('.listing-filter--section', ListingFilter.$el );
			ListingFilter.$filters = $( '.section-options li a', ListingFilter.$ele );
			ListingFilter.$filterableItems = $( 'li', ListingFilter.$target );
			ListingFilter.initUI();
		},
		initUI: function(){
			// ListingFilter.$filters.after( '<a href="#" class="clear">&times;</a>');

			ListingFilter.$sections.on( 'click', 'li', function(e) {
				e.preventDefault();
				var $li = $(this);
				
				if ( $li.hasClass('s__active') ) {
					$li.removeClass('s__active');
				} else {
					$li.siblings('li').removeClass('s__active');
					$li.addClass('s__active');
				}
				ListingFilter.run();
			});

			ListingFilter.$ele.on('click', 'footer a', function( e ) {
				e.preventDefault();

				if ( !ListingFilter.$target.hasClass($(this).data('class')) )
					ListingFilter.$target.toggleClass('listing__students listing__linear');
			})
		},
		run: function(){
			var filterString = '';

			ListingFilter.$filterableItems.hide();

			ListingFilter.$sections.each(function() {
				var $self = $(this),
					$li = $self.find( '.s__active' ),
					section = $self.data( 'section' );

				if ( $li.length ) {
					filterString += ListingFilter.buildFilter( section, $li.find('a').attr('href').replace( '#', '' ) );
				}
			});
			console.log(filterString);

			if ( filterString !== "" ) {
				ListingFilter.$filterableItems.filter(filterString).show();
			} else {
				ListingFilter.$filterableItems.show();
			}
		},
		buildFilter: function( section, val ) {
			return '[data-' + section + '="' + val + '"]';
		},
		
		removeFilter: function( filter ) {

		}	
	};	
	
	window.SOCD.ListingFilter = ListingFilter;
	
} )( window, jQuery );