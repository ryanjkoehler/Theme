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
*	returns an ID of the message that can be used to forcibly remove it at an arbitrary point in the future with removeMessage();
*	or, if multiple messages are passed, returns an array of message IDs that can be used for the same purpose
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
		_systemLifetimeMessageCount: 0,
		_systemMessages: {},
		_clearTimers: function(){
			for( var i = 0; i < Notifications.timers.length; i++ ){
				clearTimeout( Notifications.timers[i] );
			}
		},
		_handleMessage: function( _opts ){
			var inNotificationCenter, messageId, options, rendered, $rendered;

			opts = _opts || {};
			options = {
				text: opts.text,
				tone: opts.tone || 'ambivalent',
				time: opts.time || 0,
				location: opts.location || Notifications._content,
				position: opts.position || 'append'
			};

			inNotificationCenter = !( !!opts.location );

			messageId = Notifications._systemLifetimeMessageCount;

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
				Notifications._handleRemoveMessage( $rendered, options.time, inNotificationCenter );
			}

			if( inNotificationCenter ){
				// open the notification center
				Notifications._centerMessageCount++;
				Notifications._ele.addClass( 'open' );
			}
			
			Notifications._systemMessages[ messageId ] = {
				ele: $rendered,
				inNotificationCenter: inNotificationCenter
			};

			Notifications._systemLifetimeMessageCount++;

			return messageId;

		},
		_handleRemoveMessage: function( $message, when, inNotificationCenter ){
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
		removeMessage: function( id, _when ){
			var when = _when || 0;
			var messageRef = Notifications._systemMessages[ id ];

			Notifications._handleRemoveMessage( messageRef.ele, when, messageRef.inNotificationCenter );
		},
		message: function( message ){
			var createdIds;

			if( arguments.length > 1 ){
				createdIds = [];
			}

			for( var i = 0; i < arguments.length; i++ ){
				var id = Notifications._handleMessage( arguments[i] );
				if( arguments.length > 1 ){
					createdIds.push( id );
				} else {
					createdIds = id;
				}
			}
			return createdIds;
		}
	};

	window.SOCD.Notifications = Notifications;	

})( window, jQuery );