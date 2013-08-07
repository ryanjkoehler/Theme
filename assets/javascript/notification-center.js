/* 
*	SOCD_Notifications
*	==================
*
* 	Site Wide Notifications
*
*	Usage: Notifications.message( message, [ message, ...message ] );
*
*	It takes an unlimited number of message arguments, where message is an object, like so:

*		{
*			text: string containing the message to be displayed
*			tone: string, the tone of the message, affects styling. choose from: 'positive' | 'negative' | 'ambivalent' (optional, defaults to 'ambivalent')
*			time: number, number of milliseconds before hiding the message
*			location: element, the element to associate the message with
*			position: string, whether to append to the element or place after. Choose from: 'after' | 'append' | 'before' ( optional, defaults to append )
*		}
*
*	It creates html based on the /assets/templates/notifications/message.html template, adding the 'tone' argument as a class.
*
*/

if( !window.SOCD ){ window.SOCD = {} };

( function( window, $, undefined ){
	
	// put our template rendering functions into a quicker to access object, local to this file
	var T = {
		message: Templates[ 'notifications--message' ].render.bind( Templates[ 'notifications--message' ] )
	};

	var Notifications = {	
		_ele: $( '.navigation-notifications' ),
		_content: $('.notifications-center-display'),
		_notificationTime: 5000,
		_centerMessageCount: 0,
		_timers: [],
		_clearTimers: function(){
			for( var i = 0; i < Notifications.timers.length; i++ ){
				clearTimeout( Notifications.timers[i] );
			}
		},
		_handleMessage: function( _opts ){
			var rendered, $rendered;
			opts = _opts || {};
			var options = {
				text: opts.text,
				tone: opts.tone || 'ambivalent',
				time: opts.time || 0,
				location: opts.location || Notifications._content,
				position: opts.position || 'append'
			};

			var inNotificationCenter = !( !!opts.location );

			if( typeof options.text !== 'string' ){
				throw new Error( 'SOCD_Notifications message objects should have a field, \'text\' which is a string containing the text of the message' );
				return;
			}

			rendered = T.message({
				message: options.text,
				tone: options.tone 
			});

			$rendered = $( rendered );

			switch( options.position ){
				case 'after':
					options.location.after( $rendered );
				break;
				case 'before':
					options.location.before( $rendered );
				break;
				default:
					options.location.append( $rendered );
				break;
			}

			if( options.time > 0 ){
				Notifications._removeMessage( $rendered, options.time, inNotificationCenter );
			}

			if( inNotificationCenter ){
				// open the notification center
				Notifications._centerMessageCount++;
				Notifications._ele.addClass( 'open' );
			}
			
			return $rendered;

		},
		_removeMessage: function( $message, when, inNotificationCenter ){
			var timer = setTimeout( function(){
				$message.addClass( 'hide' );
				var tempTimer = setTimeout( function(){
					$message.remove();
					if( inNotificationCenter ){
						//also, if there are no messages left, hide the notification center
						Notifications._centerMessageCount--;
						if( Notifications._centerMessageCount <= 0 ){
							Notifications._ele.removeClass( 'open' );
						}
					}
				}, 500 );

				Notifications._timers.push( tempTimer );

			}, when );

			Notifications._timers.push( timer );
		},
		message: function( message ){
			for( var i = 0; i < arguments.length; i++ ){
				Notifications._handleMessage( arguments[i] );
			}
		}
	};

	window.SOCD.Notifications = Notifications;	

})( window, jQuery );