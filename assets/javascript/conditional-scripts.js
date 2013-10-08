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
		},
		keymaster: function( callback ){
			try {
				yepnope([
					{
						test: ( true ),
						yep: [
							SOCD.Config.assets_url + '/javascript/libs/keymaster.min.js'
						],
						complete: function(){
							if( typeof callback === 'function' ) callback();
						}
					}
				]);
			} catch( e ){
				console.log( e, 'Error loading keymaster. Gozer will be pissed.' );
			}
		}
	}

	window.SOCD.ConditionalScripts = ConditionalScripts
	
} )( window, jQuery );