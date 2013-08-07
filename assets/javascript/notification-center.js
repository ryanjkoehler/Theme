( function( window, $, undefined ){
	
	// put our template rendering functions into a quicker to access object, local to this file
	var T = {
		message: Templates[ 'notifications--message' ].render.bind( Templates[ 'notifications--message' ] )
	};

	var notifications = {	
		$ele: $( '.navigation-notifications' ),
		$content: $('.notifications-center-display'),
		notificationTime: 5000,
		centerMessageCount: 0,
		timers: [],
		clearTimers: function(){
			for( var i = 0; i < notifications.timers.length; i++ ){
				clearTimeout( notifications.timers[i] );
			}
		},
		handleMessage: function( _opts ){
			var rendered, $rendered;
			opts = _opts || {};
			var options = {
				message: opts.message,
				tone: opts.tone || 'ambivalent',
				time: opts.time || 0,
				location: opts.location || notifications.$content,
				position: opts.position || 'append'
			};

			var inNotificationCenter = ( !!opts.location ) ? false : true;

			if( typeof options.message !== 'string' ){
				throw new Error( 'SOCD_notifications message objects should have a field, \'message\'' );
				return;
			}
			

			rendered = T.message({
				message: options.message,
				tone: options.tone 
			});
			$rendered = $( rendered );

			if( options.position === 'after' ){
				options.location.after( $rendered );
			} else {
				options.location.append( $rendered );
			}

			if( options.time > 0 ){
				var timer = setTimeout( function(){
					$rendered.addClass( 'hide' );
					var tempTimer = setTimeout( function(){
						$rendered.remove();
						if( inNotificationCenter ){
							notifications.centerMessageCount--;
							if( notifications.centerMessageCount <= 0 ){
								notifications.$ele.removeClass( 'open' );
							}
						}
					}, 500 );
					notifications.timers.push( tempTimer );
				}, options.time );
				notifications.timers.push( timer );
			}

			if( inNotificationCenter ){
				// open the notification center
				notifications.centerMessageCount++;
				notifications.$ele.addClass( 'open' );
			}
			
			return $rendered;

		},
		message: function(  ){
			for( var i = 0; i < arguments.length; i++ ){
				notifications.handleMessage( arguments[i] );
			}
		}
	};

	window.SOCD_notifications = notifications;	

})( window, jQuery );