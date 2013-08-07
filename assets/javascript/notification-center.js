( function( window, $, undefined ){
	
	// put our template rendering functions into a quicker to access object, local to this file
	var T = {
		message: Templates[ 'notifications--message' ].render.bind( Templates[ 'notifications--message' ] )
	};

	var nCenter = {	
		$ele: $( '.navigation-notifications' ),
		$content: $('.notifications-center-display'),
		notificationTime: 5000,
		messageCount: 0,
		timers: [],
		message: function( _message, _tone, _time ){
			var timer, tone, time, rendered, $rendered;

			if( !_tone ){
				tone = 'ambivalent'; //default tone is ambivalent
			}
			if( !_time ){
				time = nCenter.notificationTime; //if no time specified, use the default
			}
			if( !_message ){
				return; //if there isn't a message - just give up
			}

			rendered = T.message({
				tone: tone,
				message: _message
			});
			
			$rendered = $( rendered );

			nCenter.$content.append( $rendered );			
			
			( function( $toHide ){
				timer = setTimeout( function(){
					$toHide.addClass( 'hide' );
					nCenter.messageCount--;
					var tempTimer = setTimeout( function(){
						$toHide.remove();
						if( nCenter.messageCount <= 0){
							nCenter.$ele.removeClass( 'open' );
						}
					}, 500 );
				
					nCenter.timers.push( tempTimer );
			
				}, nCenter.notificationTime );
			})( $rendered );

			nCenter.timers.push( timer );

			nCenter.messageCount++;

			// open the notification center
			nCenter.$ele.addClass( 'open' );
		}
	};

	window.SOCD_notification_center = nCenter;	

})( window, jQuery );