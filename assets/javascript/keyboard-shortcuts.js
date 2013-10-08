if ( !window.SOCD ){ window.SOCD = {}; }

( function( window, $, undefined ){

	var KeyboardShortcuts = {
		init: function(){	
			KeyboardShortcuts.menuSearch();
		},
		menuSearch: function(){
			key( '⌘+/, ctrl+/', function(){
				SOCD.Menu.focus_search();
				return false;
			});
		}
	};

	SOCD.ConditionalScripts.load( 'keymaster', function(){
		KeyboardShortcuts.init();	
	});

})( jQuery, window );