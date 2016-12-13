/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
			}
		} );
	} );
	
	
	/***************************************
	******** HEADER SECTION ****************
	****************************************/


	//Show Header Logo
	wp.customize('azera_shop_header_logo', function( value ){
		value.bind(function( to ) {
			if( to !== '' ) {
				$('#parallax_header .only-logo').removeClass( 'azera_shop_only_customizer' );
			} else {
				$('#parallax_header .only-logo').addClass( 'azera_shop_only_customizer' );
			}
			$( '#parallax_header .only-logo img' ).attr('src', to);
		});
		
	});
	
	//Title
	wp.customize('azera_shop_header_title', function(value) {
		
        value.bind(function( to ) {
			if( to !== '' ) {
				$( '#parallax_header .intro-section h1' ).removeClass( 'azera_shop_only_customizer' );
			}
			else {
				$( '#parallax_header .intro-section h1' ).addClass( 'azera_shop_only_customizer' );
			}
			$( '#parallax_header .intro-section h1' ).text( to );
	    } );
		
    });
	
	//Subtitle
	wp.customize('azera_shop_header_subtitle', function(value) {
		
        value.bind(function( to ) {
			if( to !== '' ) {
				$( '#parallax_header .intro-section h5' ).removeClass( 'azera_shop_only_customizer' );
			} else {
				$( '#parallax_header .intro-section h5' ).addClass( 'azera_shop_only_customizer' );
			}
			$( '#parallax_header .intro-section h5' ).text( to );
		} );
		
    });
	
	//Button text
	wp.customize('azera_shop_header_button_text', function(value) {
		
        value.bind(function( to ) {

			if( to !== '' ) {
				$( '.intro-section button' ).removeClass( 'azera_shop_only_customizer' );
			} else {
				$( '.intro-section button' ).addClass( 'azera_shop_only_customizer' );
			}
			$( '.intro-section button' ).text( to );
		} );
		
    });


	//Button link
	wp.customize('azera_shop_header_button_link', function(value) {
		
        value.bind(function( to ) {
			$( '#parallax_header .button a' ).attr( 'href', to );
		} );
		
    });	

	/******************************************************
	*********** OUR SERVICES SECTION ***********************
	*******************************************************/
	
	
	//Title
	wp.customize('azera_shop_our_services_title', function(value) {
		
        value.bind(function( to ) {
			if( to !== '' ) {
				$( '.services' ).removeClass( 'azera_shop_only_customizer' );
				$( '.services .section-header h2' ).removeClass( 'azera_shop_only_customizer' );
				$('.services .section-header .colored-line' ).removeClass( 'azera_shop_only_customizer' );
				$( '.services .section-header h2' ).text( to );
			}
			else {
				$( '.services .section-header h2' ).addClass( 'azera_shop_only_customizer' );
				$('.services .section-header .colored-line' ).addClass( 'azera_shop_only_customizer' );
				if($( '.services .section-header .sub-heading' ).hasClass('azera_shop_only_customizer') && isEmpty($('.azera_shop_grid_column_1')) && isEmpty($('.azera_shop_grid_column_2')) && isEmpty($('.azera_shop_grid_column_3')) ){
					$( '.services' ).addClass( 'azera_shop_only_customizer' );
				}
			}
	    } );
		
    });
	
	//Subtitle
	wp.customize('azera_shop_our_services_subtitle', function(value) {
		
        value.bind(function( to ) {
			if( to !== '' ) {
				$( '.services' ).removeClass( 'azera_shop_only_customizer' );
				$( '.services .section-header .sub-heading' ).removeClass( 'azera_shop_only_customizer' );
				$( '.services .section-header .sub-heading' ).text( to );
			} else {
				$( '.services .section-header .sub-heading' ).addClass( 'azera_shop_only_customizer' );
				if($( '.services .section-header h2' ).hasClass('azera_shop_only_customizer')  && isEmpty($('.azera_shop_grid_column_1')) && isEmpty($('.azera_shop_grid_column_2')) && isEmpty($('.azera_shop_grid_column_3'))){
					$( '.services' ).addClass( 'azera_shop_only_customizer' );
				}
			}
		} );
		
    });

	/******************************************************
	******** HAPPY CUSTOMERS SECTION ***********
	*******************************************************/
	//Title
	wp.customize('azera_shop_happy_customers_title', function(value) {
		
        value.bind(function( to ) {
			
			if( to !== '' ) {
				$( '.testimonials' ).removeClass( 'azera_shop_only_customizer' );
				$( '.testimonials .section-header h2' ).removeClass( 'azera_shop_only_customizer' );
				$( '.testimonials .section-header .colored-line' ).removeClass( 'azera_shop_only_customizer' );
				$( '.testimonials .section-header h2' ).text( to );
			} else {
				$( '.testimonials .section-header h2' ).addClass( 'azera_shop_only_customizer' );
				$( '.testimonials .section-header .colored-line' ).addClass( 'azera_shop_only_customizer' );
				if( $( '.testimonials .section-header .sub-heading').hasClass('azera_shop_only_customizer') && isEmpty($('.testimonials .testimonials-wrap .azera_shop_grid_column_1')) && isEmpty($('.testimonials .testimonials-wrap .azera_shop_grid_column_2')) && isEmpty($('.testimonials .testimonials-wrap .azera_shop_grid_column_3'))){
					$( '.testimonials' ).addClass( 'azera_shop_only_customizer' );
				}
			}
	    } );
		
    });
	
	//Subtitle
	wp.customize('azera_shop_happy_customers_subtitle', function(value) {
		
        value.bind(function( to ) {
			if( to !== '' ) {
				$( '.testimonials' ).removeClass( 'azera_shop_only_customizer' );
				$( '.testimonials .section-header .sub-heading' ).removeClass( 'azera_shop_only_customizer' );
				$( '.testimonials .section-header .sub-heading' ).text( to );
			} else {
				$( '.testimonials .section-header .sub-heading' ).addClass( 'azera_shop_only_customizer' );
				if( $( '.testimonials .section-header h2').hasClass('azera_shop_only_customizer') && isEmpty($('.testimonials .testimonials-wrap .azera_shop_grid_column_1')) && isEmpty($('.testimonials .testimonials-wrap .azera_shop_grid_column_2')) && isEmpty($('.testimonials .testimonials-wrap .azera_shop_grid_column_3')) ){
					$( '.testimonials' ).addClass( 'azera_shop_only_customizer' );
				}
			}
		} );
		
    });

	/******************************************************
	**************** RIBBON SECTION *****************
	*******************************************************/
	
	wp.customize( 'azera_shop_ribbon_background', function( value ) {
		value.bind( function( to ) {
			
			if ( '' !== to ) {
				$( '.ribbon-wrap' ).attr( 'style','background-image:url('+to+')' );
			} else {
				$( '.ribbon-wrap' ).removeAttr('style');
			}
			
		} );
	} );	
	
	
	
	//Title
	wp.customize('azera_shop_ribbon_title', function(value) {
		
        value.bind(function( to ) {

			if( to !== '' ) {
				$( '.ribbon-wrap' ).removeClass( 'azera_shop_only_customizer' );
				$( '.ribbon-wrap h2' ).removeClass( 'azera_shop_only_customizer' );
				$( '.ribbon-wrap h2' ).text( to );
			} else {
				$( '.ribbon-wrap h2' ).addClass( 'azera_shop_only_customizer' );
				if( $( '.ribbon-wrap button' ).hasClass( 'azera_shop_only_customizer' ) ){
					$( '.ribbon-wrap' ).addClass( 'azera_shop_only_customizer' );
				}
			}
		} );
		
    });
	
	
	//Button text
	wp.customize('azera_shop_button_text', function(value) {
		
        value.bind(function( to ) {

			if( to !== '' ) {
				$( '.ribbon-wrap' ).removeClass( 'azera_shop_only_customizer' );
				$( '.ribbon-wrap button' ).removeClass( 'azera_shop_only_customizer' );
				$( '.ribbon-wrap button' ).text( to );
			} else {
				$( '.ribbon-wrap button' ).addClass( 'azera_shop_only_customizer' );
				if( $( '.ribbon-wrap h2' ).hasClass( 'azera_shop_only_customizer' ) ){
					$( '.ribbon-wrap' ).addClass( 'azera_shop_only_customizer' );
				}
			}
		} );
		
    });


	//Button link
	wp.customize('azera_shop_button_link', function(value) {
		
        value.bind(function( to ) {
			$( '#ribbon button' ).attr( 'onclick', to );
		} );
		
    });

	/********************************************************
	 ******************** SHOP SECTION **********************
	 *******************************************************/
	
	//Title
	wp.customize('azera_shop_shop_section_title', function(value) {

		value.bind(function( to ) {
			if( to !== '' ) {
				$( '.shop' ).removeClass( 'azera_shop_only_customizer' );
				$( '.shop .section-header h2' ).removeClass( 'azera_shop_only_customizer' );
				$('.shop .section-header .colored-line' ).removeClass( 'azera_shop_only_customizer' );
				$( '.shop .section-header h2' ).text( to );
			}
			else {
				$( '.shop .section-header h2' ).addClass( 'azera_shop_only_customizer' );
				$('.shop .section-header .colored-line' ).addClass( 'azera_shop_only_customizer' );
			}
		} );

	});


	//Subtitle
	wp.customize('azera_shop_shop_section_subtitle', function(value) {

		value.bind(function( to ) {
			if( to !== '' ) {
				$( '.shop' ).removeClass( 'azera_shop_only_customizer' );
				$( '.shop .section-header .sub-heading' ).removeClass( 'azera_shop_only_customizer' );
				$( '.shop .section-header .sub-heading' ).text( to );
			} else {
				$( '.shop .section-header .sub-heading' ).addClass( 'azera_shop_only_customizer' );
			}
		} );

	});

	/* Blog header */
	wp.customize('azera_shop_blog_header_title', function(value) {
		value.bind(function( to ) {
			$( '.archive-top-big-title' ).html( to );
		} );
	});
	wp.customize('azera_shop_blog_header_subtitle', function(value) {
		value.bind(function( to ) {
			$( '.archive-top-text' ).html( to );
		} );
	});
	wp.customize('azera_shop_blog_header_image', function(value) {
		value.bind(function( to ) {
			$('.archive-top').css('background-image', 'url(' + to + ')');
		} );
	});


	/***************************************
	******** FOOTER SECTION ****************
	****************************************/
	//Copyright
	wp.customize('azera_shop_copyright', function(value) {
        value.bind(function( to ) {
			if( to !== '' ) {
				$( '.azera_shop_copyright_content' ).removeClass( 'azera_shop_only_customizer' );
			} else {
				$( '.azera_shop_copyright_content' ).addClass( 'azera_shop_only_customizer' );
			}
			
			$( '.azera_shop_copyright_content' ).text( to );
	    } );
    });
	
	function isEmpty( el ){
		return ($.trim(el.html()) === '' ? true : false);
	}
	

} )( jQuery );