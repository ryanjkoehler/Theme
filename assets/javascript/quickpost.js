if( !window.SOCD ){ window.SOCD = {} };

( function( window, $, config, undefined){
	console.log( config );

	var T = {
		blogSelect: Templates[ 'quickpost--blog-select' ].render.bind( Templates[ 'quickpost--blog-select' ] ),
		paneSelect: Templates[ 'quickpost--pane-select' ].render.bind( Templates[ 'quickpost--pane-select' ] )
	};

	var Quickpost = {
		_ele: $( '.quickpost--inerface' ),
		_endpoint: config.ajax_url,
		_nonce: config.nonce,
		_init: function(){
			Quickpost._ele.append( T.blogSelect( config ) );
		},
		_submit: function( data ){
			$.post( 
				config.ajax_url,
				{
					action: 'socd_post',
					nonce: Quickpost._nonce,
					activityForm: Quickpost._ele.find('form').serialize()
				},
				function( data ){
					console.log( data );
				}
			);
		}
	};

	Quickpost._init();
	Quickpost._submit();

	window.SOCD.Quickpost = Quickpost;

})( window, jQuery, SOCD_QP_CONFIG );