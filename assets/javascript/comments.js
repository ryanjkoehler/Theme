// uses: https://github.com/Rovak/InlineAttachment

if( !window.SOCD ){ window.SOCD = {} };

( function( window, $, undefined){

	var Comments = {
		_inputBox: $( 'textarea#comment' ),
		_uploadingMessageId: undefined,
		_errorMessageId: undefined,
		_inlineAttachOptions: {
			uploadUrl: 'upload.php',
			uploadFieldName: 'file',
			downloadFieldName: 'file',
			allowedTypes: [
				'image/jpeg',
				'image/png',
				'image/jpg',
				'image/gif'
			],
			progressText: '![Uploading File.]()',
			urlText: '![file]({filename})',
			onReceivedFile: function( file ){
				if( typeof Comments._uploadingMessageId !== 'undefined' ){
					SOCD.Notifications.removeMessage( Comments._uploadingMessageId );
				}
				if( typeof Comments._errorMessageId !== 'undefined' ){
					SOCD.Notifications.removeMessage( Comments._errorMessageId );
				}
				Comments._uploadingMessageId = SOCD.Notifications.message({
					text: 'Uploading File.',
					location: Comments._inputBox,
					position: 'after'
				});				
			},
			onUploadedFile: function( json ){
				SOCD.Notifications.removeMessage( Comments._uploadingMessageId );
				if( typeof Comments._errorMessageId !== 'undefined' ){
					SOCD.Notifications.removeMessage( Comments._errorMessageId );
				}
				
				SOCD.Notifications.message({
					text: 'Upload Successful.',
					location: Comments._inputBox,
					position: 'after',
					tone: 'positive',
					time: 5000
				});

			},
			customErrorHandler: function(){				
				if( typeof Comments._uploadingMessageId !== 'undefined' ){
					SOCD.Notifications.removeMessage( Comments._uploadingMessageId );
				}

				Comments._errorMessageId = SOCD.Notifications.message({
					text: 'There was a problem uploading this file.',
					location: Comments._inputBox,
					position: 'after',					
					tone: 'negative'
				});
				return false; // necessary to prevent default error handler firing
			},
			errorText: 'Error uploading file.'
		},
		_init: function(){
			console.log( 'init Comments' );
			Comments._inputBox = $( 'textarea#comment' );
			Comments._inputBox.inlineattach( Comments._inlineAttachOptions );
		}
	};

	if( $('#comments').length ){		
		Comments._init();
	}

	window.SOCD.Comments = Comments;

})( window, jQuery );