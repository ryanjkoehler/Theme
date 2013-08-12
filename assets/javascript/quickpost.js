if( !window.SOCD ){ window.SOCD = {} };

( function( window, $, config, undefined){
	console.log( 'SOCD_QP_CONFIG', config );

	var T = {	
		form: Templates[ 'quickpost--quickpost' ].render.bind( Templates[ 'quickpost--quickpost' ] )
	};

	var Quickpost = {
		_ele: $('.navigation-quickpost'),
		_content: $( '.quickpost--interface' ),
		_trigger: $( '.quickpost-activate' ),
		_config: config,
		_post_formats: [],
		_endpoint: config.ajax_url,
		_form: null,
		_nonce: config.nonce,
		_initUI: function(){
			Quickpost._trigger.click( function(){
				Quickpost._ele.toggleClass( 'open' );
			});
			Quickpost._form.on( 'submit', function(){
				Quickpost._submit();
				return false;
			});
		},
		_init: function(){
			for( var i = 0; i < config.post_formats.length; i++ ){
				Quickpost._post_formats.push({
					slug: config.post_formats[i],
					isDefault: ( config.post_formats[i] === 'blog' )
				});
			}

			console.log( Quickpost._post_formats );

			Quickpost._form = $( T.form({
				post_formats: Quickpost._post_formats,
				user_blogs: Quickpost._config.user_blogs
			}));

			Quickpost._content.append( Quickpost._form );

			Quickpost._initUI();

		},
		_submit: function( data ){
			console.log( 'FORM', Quickpost._form.serialize() );
			$.post( 
				config.ajax_url,
				{
					action: 'socd_post',
					nonce: Quickpost._nonce,
					formdata: Quickpost._form.serialize()
				},
				function( data ){
					console.log( data );
				}
			);
		}
	};

	Quickpost._init();

	window.SOCD.Quickpost = Quickpost;

})( window, jQuery, SOCD_QP_CONFIG );