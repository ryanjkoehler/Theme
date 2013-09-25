if ( !window.SOCD ){ window.SOCD = {}; }

( function( window, $, undefined ){

	var ConditionalScripts = {
		load: function( name, callback ){
			ConditionalScripts[name]( callback );
		},
		fitVids: function( callback ){			
			try {				
				yepnope([
					{
						test: ($('iframe').length > 0 && !$.fn.fitVids),
						yep: [
							SOCD.Config.assets_url + '/javascript/libs/jquery.fitvids.js'
						],						
						complete: function(){							
							if( typeof callback === 'function' && $.fn.fitVids ) callback();
						}
					}
				]);

			} catch( e ) {
				console.log( e, 'Error loading fitvids' );
			}
		}
	}

	window.SOCD.ConditionalScripts = ConditionalScripts
	
} )( window, jQuery );