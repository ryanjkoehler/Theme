if( !window.SOCD ){ window.SOCD = {} };

( function( window, $, undefined ){

	var PostFilter = {
		$ele: null,
		$filters: null,
		$output: null,
		posts_offset: 0,	
		init: function( _ele, _output ){
			PostFilter.$ele = _ele;			
			PostFilter.$filters = $( '.section-options li a', PostFilter.$ele );
			PostFilter.$output = _output;
			PostFilter.initUI();
		},
		initUI: function(){
			PostFilter.$filters.after( '<a href="#" class="clear">&times;</a>');

			PostFilter.$filters.on( 'click', function( e ){
				e.preventDefault();
				//we'll only have one active at a time
				PostFilter.$filters.removeClass('active');
				$(this).addClass( 'active' );			
				PostFilter.run( type, data );
			});

			PostFilter.$filters.siblings( '.clear' ).on( 'click', function( e ){
				e.preventDefault();
				$(this).siblings('a').removeClass( 'active' );
				PostFilter.run();
			});
		},
		run: function( type, data ){
			// call ajax hook to get posts
			// also recive and store pagination/offset
		},
		clear: function(){

		}
	};	
	
	window.SOCD.PostFilter = PostFilter;
	
} )( window, jQuery );