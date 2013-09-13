if( !window.SOCD ){ window.SOCD = {} };

( function( window, $, undefined ){

	var SearchForm = function( _ele ){
		_ele.each( function(){
			var $ele = $(this),
				$input = $( '.search-form--input', $ele ),
				$submit = $( '.search-form--submit', $ele ),
				$clear = $( '.search__clear', $ele );
			
			$ele.addClass('search-form');
				
			if( $clear.length === 0 ){
				$clear = $('<span class="search-form--clear"><a href="#" class="search__clear"></a></span>');
				$ele.append( $clear );
				$clear = $( '.search__clear', $clear );
			}

			if( $submit.length === 0 ){
				$submit = $('<span class="search-form--submit search__submit"><input type="submit" class="search-submit" value="Search" /></span>');
				$ele.append( $submit );
			}

			$input.on( 'keypress', function( e ){
				setTimeout( function(){
					if( $input.val().length > 0 ){
						$clear.addClass('visible');
					} else {
						$clear.removeClass('visible');
					}
				}); //no time specified - only need to delay the microsecond it takes to update the val
			});
			$clear.on( 'click', function( e ){
				e.preventDefault();
				
				//play nice with typeahead
				if( $input.hasClass( 'tt-query') ){	
					$input.typeahead( 'setQuery', '' );
				} else {
					$input.val('');
					$input.focus();
				}
				$clear.removeClass('visible');
			});
		});
	};
	
	window.SOCD.SearchForm = SearchForm;
	
} )( window, jQuery );