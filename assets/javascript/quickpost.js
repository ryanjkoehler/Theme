if( !window.SOCD ){ window.SOCD = {} };

( function( window, $, config, undefined){

	var T = {	
		form: Templates[ 'quickpost--quickpost' ].render.bind( Templates[ 'quickpost--quickpost' ] ),
		oembed: Templates[ 'quickpost--oembed' ].render.bind( Templates[ 'quickpost--oembed' ] ),
		taxonomies: Templates[ 'quickpost--taxonomies--taxonomies' ].render.bind( Templates[ 'quickpost--taxonomies--taxonomies' ] ),
		taxSuggestionTitle: Templates[ 'quickpost--taxonomies--title' ].render.bind( Templates[ 'quickpost--taxonomies--title' ] ),
		taxSuggestion: Templates[ 'quickpost--taxonomies--suggestion' ].render.bind( Templates[ 'quickpost--taxonomies--suggestion' ] ),
		taxToken: Templates[ 'quickpost--taxonomies--token' ].render.bind( Templates[ 'quickpost--taxonomies--token' ] )
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
			if( Quickpost.userOwnsBlog() ){
				Quickpost._changeBlog( Quickpost._config.current_blog );
			} else {
				Quickpost._changeBlog( Quickpost._config.user_primary_blog );
			}
		},
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
		_changeBlog: function( id ){			
			Quickpost._getTaxonomies( id, function( data ){
				Quickpost._prepareTaxonomies( data );
			});
		},
		_changeMode: function( mode ){
			var template = $( T[ mode ]() );
			Quickpost._variableFields.empty();
			Quickpost._variableFields.append( template );
			Quickpost._initModeUI( template );
		},
		_prepareTaxonomies: function( data ){
			var $taxBlock = $( '.taxonomies', Quickpost._content )
			var $taxonomies = $( T.taxonomies() );
			var $taxInput = $('.tokenizer--input', $taxonomies );
			var $taxTokenList = $( '.tokenizer--tokens', $taxonomies );
			$taxBlock.empty();
			$taxBlock.append( $taxonomies );
			
			var typeaheadData = [];

			for( var key in data.terms ){	
				var local = [];
				for( var i = 0; i < data.terms[key].length; i++ ){
					local.push( data.terms[key][i] );
				}
				typeaheadData.push({
					name: data.taxes[key].name,
					local: local,
					header: T.taxSuggestionTitle( { name: data.taxes[key].name }),
					template: T.taxSuggestion
				});
			}

			$taxInput.typeahead( typeaheadData );

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
			$.post(
				Quickpost._config.ajax_url,
				{
					action: 'socd_tax',
					tax_nonce: Quickpost._tax_nonce,
					blog_id: id
				},
				function( data ){
					if( typeof callback === 'function' ) callback( data );
				}
			).fail( function( err ){
				console.log('ERROR', err);
			});
		},
		_submit: function( callback ){
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
			var id = parseInt(_id) || parseInt(Quickpost._config.current_blog);
			var blogs = Quickpost._config.user_blogs;
			for( var i = 0; i < blogs.length; i++ ){				
				if( blogs[i].id === id ){					
					return true;
				}
			}
		}
	};

	Quickpost._init();

	window.SOCD.Quickpost = Quickpost;

})( window, jQuery, SOCD_QP_CONFIG );