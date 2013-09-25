if( !window.SOCD ){ window.SOCD = {} };

( function( window, $, undefined ){

	var BlogFilter = {
		$ele: null,
		$filters: null,
		$output: null,
		$pagination: null,
		is_first_run: true,
		$initial_output: null,
		$initial_pagination: null,
		init: function( _ele, _output, _pagination ){
			BlogFilter.$ele = _ele;			
			BlogFilter.$filters = $( '.section-options li a', BlogFilter.$ele );	
			BlogFilter.$output = _output;
			BlogFilter.$pagination = _pagination;
			BlogFilter.initUI();
		},
		initUI: function(){
			BlogFilter.$filters.after( '<a href="#" class="clear">&times;</a>');

			BlogFilter.$filters.on( 'click', function( e ){
				if( $(this).hasClass('active') ){
					$(this).removeClass('active');
					BlogFilter.clear();
					return;	
				}
				var type = $(this).attr('data-type');
				var data = $(this).attr('href').replace('#','');				
				BlogFilter.run( type, data );
				BlogFilter.$filters.removeClass('active');
				$(this).addClass( 'active' );	
				return false;
			});

			BlogFilter.$filters.siblings( '.clear' ).on( 'click', function( e ){
				e.preventDefault();
				$(this).siblings('a').removeClass( 'active' );
				BlogFilter.clear();
			});
		},
		run: function( type, data ){
			var args = {}
			args['action'] = 'socd_blog_filter'			
			args[type] = data;
			console.log( type, data );

			$.post( 
				SOCD.Config.ajax_url, 
				args, 
				BlogFilter.parseResult,
				'json'
			);
		},
		parseResult: function( result ){
			BlogFilter.saveInitial();
			BlogFilter.showResults( result.posts );
		},
		clear: function(){
			BlogFilter.paged = 0;
			BlogFilter.$output.empty();
			BlogFilter.$output.append( BlogFilter.$initial_output );
			BlogFilter.$pagination.append( BlogFilter.$initial_pagination );
		},
		saveInitial: function(){
			if( BlogFilter.is_first_run ){				
				BlogFilter.$initial_output = BlogFilter.$output.html();
				BlogFilter.$initial_pagination = BlogFilter.$pagination.html();
				BlogFilter.is_first_run = false;
			}
		},
		showResults: function( posts ){
			BlogFilter.$output.empty();
			BlogFilter.$pagination.empty();
			if( !posts ){
					SOCD.Notifications.message( {
						text: 'No posts found.',
						tone: 'negative',					
						location: BlogFilter.$output					
					});
			} else {
				BlogFilter.$output.append( posts );
				SOCD.ConditionalScripts.load( 'fitVids', function(){
					BlogFilter.$output.fitVids();
				});
			}

		}
	};	
	
	window.SOCD.BlogFilter = BlogFilter;
	
} )( window, jQuery );