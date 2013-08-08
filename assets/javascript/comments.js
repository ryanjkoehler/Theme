// uses: https://github.com/Rovak/InlineAttachment

if( !window.SOCD ){ window.SOCD = {} };

( function( window, $, undefined){

	var Comments = {
		_inputBox: $( 'textarea#comment' ),
		_inlineAttachOptions: {
			uploadUrl: '',
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
				SOCD.Notifications.message({
					text: 'Uploading'
				});
			},
			onUploadedFile: function( json ){
				console.log( 'uploaded' );
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