(function( $ ){
	
	/** Demo code for menu functions.
	 *
	 *  To be refactored into something better
	 *
	 */

	var $menuSections = $('.main-navigation__menu-item--breadcrumb');
	var currVis = 0;

	var showHideMenu = function(){
		$menuSections.each( function( i ){
			if( i <= currVis ){
				$(this).show();					
			} else {
				$(this).hide();
			}
		});
	};

	$(document).on('keyup', function( e ){
		if( e.which === 189 || e.which === 187 ){
			if( e.which === 189 && currVis > 0 ){// -
				currVis--;
			} else if( e.which === 187 && currVis < $menuSections.length ){ //+
				currVis++;
			}				
			showHideMenu();
		}
	});

	$('.main-navigation__menu-item--dropdown .tab').click(function( e ){
		e.preventDefault();
		$(this).closest( '.main-navigation__menu-item--dropdown' ).siblings( '.main-navigation__menu-item--dropdown' ).removeClass( 'open' );
		$(this).closest( '.main-navigation__menu-item--dropdown' ).toggleClass( 'open' );
	})

	$('.quickpost-activate').on('click', function(){
		$(this).toggleClass('close');
		$('.quickpost').toggleClass('open');
	})

	showHideMenu();

	$('.site-search__input').typeahead( [ 
		{
			name: 'School',
			header: '<h2>Courses</h2>',
			local: [ 'BA (hons) Graphic Design', 'BA (hons) Graphic Design: New Media', 'BA (hons) Illustration', 'BA (hons) Graphic Illustration', 'BA (hons) Graphic Communication' ]
		},
		{
			name: 'Blogs',
			header: '<h2>Blogs</h2>',
			local: [ 'Arduino', 'Print Room', 'New Design', 'Tom Lynch\'s Scrapbook', 'Illustrated Man' ]
		},	
		{
			name: 'People',
			header: '<h2>People</h2>',
			local: 'Oliver Smith,Tom Lynch,Luke Watts,Eva Verhoeven,Amy Ricketts,Luke Pendrell,Ally Waller,Sophie Beard,Jamie Dobson,Brian Whitehead,Sallyane Theodosiou,Tony Mayor,Laurie Yule,Mark Povell'.split(',')
		}
	] );

})( jQuery );