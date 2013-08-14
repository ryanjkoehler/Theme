if( !window.SOCD ){ window.SOCD = {} };

( function( window, $, config, undefined){
	console.log( 'SOCD_QP_CONFIG', config );

	var T = {	
		form: Templates[ 'quickpost--quickpost' ].render.bind( Templates[ 'quickpost--quickpost' ] ),
		oembed: Templates[ 'quickpost--oembed' ].render.bind( Templates[ 'quickpost--oembed' ] )
	};

	var Quickpost = {
		_ele: $('.navigation-quickpost'),
		_content: $( '.quickpost--interface' ),
		_trigger: $( '.quickpost-activate' ),
		_form: null,
		_variableFields: null,
		_config: config,
		_post_formats: [],
		_endpoint: config.ajax_url,		
		_qp_nonce: config.qp_nonce,
		_oembed_nonce: config.oembed_nonce,
		_tax_nonce: config.tax_nonce,
		_initUI: function(){
			// open & close quick post
			Quickpost._trigger.click( function(){
				Quickpost._ele.toggleClass( 'open' );
			});
			// post format switching
			$( 'input[type="radio"][name="post_format"]', Quickpost._form ).click( function(){
				Quickpost._changeMode( $(this).attr('value') );	
			});
			// blog switching
			$( '.quickpost--blog-select' ).on( 'change', function(){
				Quickpost._changeBlog( $(this).val() );
			} );
			// form submission
			Quickpost._form.on( 'submit', function(){
				Quickpost._submit();
				return false;
			});			
		},
		_init: function(){
			for( var i = 0; i < config.post_formats.length; i++ ){
				var format = config.post_formats[i];
				Quickpost._post_formats.push({
					slug: format,
					isDefault: ( format === 'blog' )
				});
				//add quickpost type templates to T template object
				T[ format ] = Templates['quickpost--forms--' + format ].render.bind( Templates['quickpost--forms--' + format ] );
			}			

			Quickpost._form = $( T.form({
				post_formats: Quickpost._post_formats,
				user_blogs: Quickpost._config.user_blogs
			}));

			Quickpost._content.append( Quickpost._form );

			Quickpost._variableFields = $('.variable-fields', Quickpost._form );

			Quickpost._initUI();

			Quickpost._changeMode( $( 'input[type="radio"][name="post_format"][checked="true"]' ).attr( 'value' ) );

			//if the blog we're currently on is not in the user's blogs then default to the user's primary blog
			if( Quick )
			Quickpost.__changeBlog( )
		},
		_changeBlog: function( id ){
			console.log( id );
			Quickpost._getTaxonomies( id, function( data ){
				console.log( data );
			});
		},
		_changeMode: function( mode ){
			var template = $( T[ mode ]() );
			Quickpost._variableFields.empty();
			Quickpost._variableFields.append( template );
			Quickpost._initModeUI( template );
		},
		_changeTaxonomies: function( ){
			
		},
		_initModeUI: function( context ){
			$( 'input.oembed', context ).on( 'blur', function(){
				var oembedUrl = $(this).val();
				if( oembedUrl.length > 0 ){
					Quickpost._oembedVideo( oembedUrl );
				}
			});
		},
		_oembedVideo: function( url ){
			Quickpost._getOembed( url, function( data ){
				if( data === 0 || !data.html ){
					SOCD.Notifications.message({
						text: 'Not embeddable...',
						tone: 'negative',
						time: 3000
					});
				} else {
					var $oembedVideoSlot = $('.video-slot', Quickpost._variableFields);
					$oembedVideoSlot.empty();
					$oembedVideoSlot.append( T.oembed( data ) );
				}
			});
		},
		_getOembed: function( url, callback ){
			$.post(
				Quickpost._config.ajax_url,
				{
					action: 'socd_oembed',
					oembed_nonce: Quickpost._oembed_nonce,
					url: url
				},
				function( data ){					
					if( typeof callback === 'function' ) callback( data );
				}
			);
		},
		_getTaxonomies: function( id, callback ){
			console.log(
				{
					action: 'socd_tax',
					tax_nonce: Quickpost._tax_nonce,
					blog_id: id
				}
			);
			$.post(
				Quickpost._config.ajax_url,
				{
					action: 'socd_tax',
					tax_nonce: Quickpost._tax_nonce,
					blog_id: id
				},
				function( data ){
					console.log( 'TAX RESPONSE: ' + data );
					if( typeof callback === 'function' ) callback( data );
				}
			).fail( function( err ){
				console.log('ERROR');
				console.log( err );
			});
		},
		_submit: function( callback ){
			console.log( 'FORM', Quickpost._form.serialize() );
			$.post( 
				Quickpost._config.ajax_url,
				{
					action: 'socd_post',
					qp_nonce: Quickpost._qp_nonce,
					formdata: Quickpost._form.serialize()
				},
				function( data ){
					if( typeof callback === 'function' ) callback( data );
				}
			);
		},
		userOwnsBlog: function( _id ){
			var id = _id || Quickpost.config.current_blog;
			var blogs = Quickpost.config.user_blogs;
			console.log( id in blogs );
		}
	};

	Quickpost._init();

	window.SOCD.Quickpost = Quickpost;

})( window, jQuery, SOCD_QP_CONFIG );