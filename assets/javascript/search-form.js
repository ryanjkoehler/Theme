if( !window.SOCD ){ window.SOCD = {} };

( function( window, $, undefined ){

	var SearchForm = function( _ele ){
		var $ele = _ele,
			$input = $( 'input[type="text"]', $ele ),
			$clear = $( '.search__clear', $ele );
		
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
			$input.val('');
			$clear.removeClass('visible');
			$input.focus();
		});
	};
	
	window.SOCD.SearchForm = SearchForm;
	
} )( window, jQuery );