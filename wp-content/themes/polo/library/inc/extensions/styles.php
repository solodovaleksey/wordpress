<?php
/*
 * Theme styles and custom CSS
 */

add_action( 'wp_enqueue_scripts', 'polo_register_styles', 1 );
add_action( 'wp_enqueue_scripts', 'polo_enqueue_styles', 15 );

//custom styles
add_action( 'wp_enqueue_scripts', 'polo_custom_styles', 99 );

//admin styles
add_action( 'admin_enqueue_scripts', 'polo_enqueue_admin_styles' );

function polo_custom_google_fonts_list() {
	$google_fonts = array();

	$tags = array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' );

	$google_fonts['body'] = reactor_option( 'body-typography' );
	$google_fonts['h1']   = reactor_option( 'h1-typography' );
	$google_fonts['h2']   = reactor_option( 'h2-typography' );
	$google_fonts['h3']   = reactor_option( 'h3-typography' );
	$google_fonts['h4']   = reactor_option( 'h4-typography' );
	$google_fonts['h5']   = reactor_option( 'h5-typography' );
	$google_fonts['h6']   = reactor_option( 'h6-typography' );

	$page_meta = get_post_meta( get_the_ID(), 'meta_page_typography', true );

	if ( isset( $page_meta['body-typography'] ) && ! empty( $page_meta['body-typography'] ) && ! ( 'crum_default' === $page_meta['body-typography']['family'] ) ) {
		$google_fonts['body'] = $page_meta['body-typography'];
	}

	foreach ( $tags as $single_tag ) {
		if ( isset( $page_meta[ $single_tag . '-typography' ] ) && ! empty( $page_meta[ $single_tag . '-typography' ] ) && ! ( 'crum_default' === $page_meta[ $single_tag . '-typography' ]['family'] ) ) {
			$google_fonts[ $single_tag ] = $page_meta[ $single_tag . '-typography' ];
		}
	}

	return $google_fonts;
}

if ( ! function_exists( 'polo_google_fonts' ) ) {
	function polo_google_fonts() {
		$fonts_url = '';

		/* Translators: If there are characters in your language that are not
		* supported by Raleway, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$raleway = _x( 'on', 'Raleway font: on or off', 'polo' );

		/* Translators: If there are characters in your language that are not
		* supported by Open Sans, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$open_sans = _x( 'on', 'Open Sans font: on or off', 'polo' );

		if ( 'off' !== $raleway || 'off' !== $open_sans ) {
			$font_families = array();

			if ( 'off' !== $raleway ) {
				$font_families[] = 'Open+Sans:400,300,800,700,600';
			}

			if ( 'off' !== $open_sans ) {
				$font_families[] = 'Raleway:100,300,600,700,800';
			}

			$query_args = array(
				'family' => ( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
			);

			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		}

		return esc_url_raw( $fonts_url );

	}
}

/**
 * Register frontend styles
 */
function polo_register_styles() {
	/*-- Bootstrap Core CSS --*/
	wp_register_style( 'theme-bootstrap', POLO_ROOT_URL . '/assets/vendor/bootstrap/css/bootstrap.min.css', array(), '3.3.6', 'all' );
	wp_register_style( 'crum-awesome', POLO_ROOT_URL . '/assets/vendor/fontawesome/css/font-awesome.min.css', array(), '4.4.0', 'all' );
	wp_register_style( 'animateit', POLO_ROOT_URL . '/assets/vendor/animateit/animate.min.css', array(), false, 'all' );
	/*-- Vendor css --*/
	wp_register_style( 'owl-carousel', POLO_ROOT_URL . '/assets/vendor/owlcarousel/owl.carousel.css', array(), '2.0.0', 'all' );
	wp_register_style( 'magnific-popup', POLO_ROOT_URL . '/assets/vendor/magnific-popup/magnific-popup.css', array(), '1.0.0', 'all' );

	wp_register_style( 'share-likely', POLO_ROOT_URL . '/assets/css/likely.css', array(), false, 'all' );
	wp_register_style( 'crum-demo', POLO_ROOT_URL . '/assets/css/demo.css', array(), false, 'all' );
	wp_register_style( 'crum-theme-elements', POLO_ROOT_URL . '/assets/css/theme-elements.css', array(), false, 'all' );

	/*
	 * Color scheme
	 */
	if ( is_singular( 'portfolio' ) ) {
		$color_scheme = polo_get_theme_settings( 'theme-color-scheme', 'meta-theme-color-scheme', 'meta_portfolio_heading_options' );
	} else {
		$color_scheme = polo_get_theme_settings( 'theme-color-scheme', 'meta-theme-color-scheme', 'meta_page_options' );
	}
	if ( isset( $color_scheme ) && ! empty( $color_scheme ) ) {
		$scheme = $color_scheme;
	} else {
		$scheme = 'blue';
	}
	if ( ! ( 'custom' === $color_scheme ) ) {
		wp_register_style( 'crum-custom-' . $scheme, POLO_ROOT_URL . '/assets/css/color-variations/' . $scheme . '.css', array(), false, 'all' );
	}
}

/**
 * Enqueue frontend styles
 */
function polo_enqueue_styles() {

	/*-- Bootstrap Core CSS --*/
	wp_enqueue_style( 'theme-bootstrap' );
	wp_enqueue_style( 'crum-awesome' );
	wp_enqueue_style( 'animateit' );

	/*-- Vendor css --*/
	wp_enqueue_style( 'owl-carousel' );
	wp_enqueue_style( 'magnific-popup' );
	wp_enqueue_style( 'share-likely' );

	wp_enqueue_style( 'crum-theme-elements' );
	wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css', array(), false, 'all' );
	//wp_enqueue_style( 'crum-theme-font' );
	wp_enqueue_style( 'crum-theme-font', polo_google_fonts(), array(), '1.0.0' );


	/*
	 * Custom color scheme
	 */
	if ( is_singular( 'portfolio' ) ) {
		$color_scheme = polo_get_theme_settings( 'theme-color-scheme', 'meta-theme-color-scheme', 'meta_portfolio_heading_options' );
	} else {
		$color_scheme = polo_get_theme_settings( 'theme-color-scheme', 'meta-theme-color-scheme', 'meta_page_options' );
	}
	if ( isset( $color_scheme ) && ! empty( $color_scheme ) ) {
		$scheme = $color_scheme;
	} else {
		$scheme = 'blue';
	}
	if ( ! ( 'custom' === $color_scheme ) ) {
		wp_enqueue_style( 'crum-custom-' . $scheme );
	}

	$typography_custom_fonts = polo_custom_google_fonts_list();
	foreach ( $typography_custom_fonts as $tag => $single_font ) {
		if ( isset( $single_font['family'] ) && ! ( 'crum_default' === $single_font['family'] ) ) {
			$typography_selected_styles = 'latin,greek,greek-ext,vietnamese,cyrillic-ext,latin-ext,cyrillic';
			$enqueue_fonts              = $single_font['family'] . '&subset=' . $typography_selected_styles;
			wp_enqueue_style( 'crum-typo-google-fonts-' . $tag, esc_url( add_query_arg( 'family', ( $enqueue_fonts ), 'https://fonts.googleapis.com/css' ) ), array(), null );
		}
	}

}


/**
 * Enqueue admin styles
 */
function polo_enqueue_admin_styles() {
	wp_enqueue_style( 'crum-admin-styles', POLO_ROOT_URL . '/assets/css/admin.css', array(), false, 'all' );
}

/**
 * Inline CSS
 */
function polo_custom_styles() {

	$custom_css = '';

	/*
	 * Custom top bar styles
	 */
	$top_bar_color        = reactor_option( 'top-bar-color' );
	$top_bar_custom_bg    = reactor_option( 'top-bar-custom-bg-color' );
	$top_bar_custom_color = reactor_option( 'top-bar-custom-color' );

	if ( is_singular( 'portfolio' ) ) {
		$meta_top_bar_enable = reactor_option( 'meta-top-bar-enable', '', 'meta_portfolio_heading_options' );
	} else {
		$meta_top_bar_enable = reactor_option( 'meta-top-bar-enable', '', 'meta_page_options' );
	}
	if ( is_singular( 'portfolio' ) ) {
		$meta_top_bar_color = reactor_option( '_meta-top-bar-color', '', 'meta_portfolio_heading_options' );
	} else {
		$meta_top_bar_color = reactor_option( '_meta-top-bar-color', '', 'meta_page_options' );
	}
	if ( is_singular( 'portfolio' ) ) {
		$meta_top_bar_custom_bg = reactor_option( 'meta-top-bar-color', '', 'meta_portfolio_heading_options' );
	} else {
		$meta_top_bar_custom_bg = reactor_option( 'meta-top-bar-color', '', 'meta_page_options' );
	}
	if ( is_singular( 'portfolio' ) ) {
		$meta_top_bar_custom_color = reactor_option( 'meta-top-bar-custom-color', '', 'meta_portfolio_heading_options' );
	} else {
		$meta_top_bar_custom_color = reactor_option( 'meta-top-bar-custom-color', '', 'meta_page_options' );
	}

	if ( isset( $meta_top_bar_color ) && ! empty( $meta_top_bar_color ) && ! ( 'default' === $meta_top_bar_color ) ) {
		$top_bar_color = $meta_top_bar_color;
	}

	if ( isset( $meta_top_bar_custom_bg ) && ! empty( $meta_top_bar_custom_bg ) && ! ( 'default' === $meta_top_bar_color ) && ! ( 'default' == $meta_top_bar_enable ) ) {
		$top_bar_custom_bg = $meta_top_bar_custom_bg;
	}

	if ( isset( $meta_top_bar_custom_color ) && ! empty( $meta_top_bar_custom_color ) && ! ( 'default' === $meta_top_bar_color ) && ! ( 'default' == $meta_top_bar_enable ) ) {
		$top_bar_custom_color = $meta_top_bar_custom_color;
	}

	if ( isset( $top_bar_color ) && ( 'custom' === $top_bar_color ) ) {
		if ( isset( $top_bar_custom_bg ) && ! empty( $top_bar_custom_bg ) ) {
			$custom_css .= '#topbar';
			$custom_css .= '{background-color:' . $top_bar_custom_bg . ' !important;}';
			$custom_css .= '#topbar';
			$custom_css .= '{border-bottom-color:' . $top_bar_custom_bg . '}';
		}
		if ( isset( $top_bar_custom_color ) && ! empty( $top_bar_custom_color ) ) {
			$custom_css .= '#topbar, .topbar-custom a, .topbar-custom .social-icons li a';
			$custom_css .= '{color:' . $top_bar_custom_color . '; !important}';
			$custom_css .= '.topbar-custom .top-menu > li > a:hover ';
			$custom_css .= '{color:' . adjustBrightness( $top_bar_custom_color, - 30 ) . '}';
		}
	}

	$st_head_style    = reactor_option( 'stunning-header-style' );
	$st_head_bg_image = reactor_option( 'st-header-bg-image' );

	if ( is_singular( 'portfolio' ) ) {
		$meta_st_head_style = reactor_option( 'meta-stunning-header-style', '', 'meta_portfolio_heading_options' );
	} else {
		$meta_st_head_style = reactor_option( 'meta-stunning-header-style', '', 'meta_page_options' );
	}
	if ( is_singular( 'portfolio' ) ) {
		$meta_st_head_bg_image = reactor_option( 'meta-st-header-bg-image', '', 'meta_portfolio_heading_options' );
	} else {
		$meta_st_head_bg_image = reactor_option( 'meta-st-header-bg-image', '', 'meta_page_options' );
	}

	if ( isset( $meta_st_head_style ) && ! empty( $meta_st_head_style ) ) {
		$st_head_style = $meta_st_head_style;
	}

	if ( isset( $meta_st_head_bg_image ) && ! empty( $meta_st_head_bg_image ) ) {
		$st_head_bg_image = $meta_st_head_bg_image;
	}

	if ( isset( $st_head_bg_image ) && ! empty( $st_head_bg_image ) && isset( $st_head_style ) && ( ( 'default' === $st_head_style ) || ( 'pattern' === $st_head_style ) ) ) {
		$custom_css .= '#page-title';
		$custom_css .= '{background-image:url("' . wp_get_attachment_url( $st_head_bg_image ) . '")}';
	}

	$st_head_video_embed = reactor_option( 'st-header-embed-video-bg' );

	if ( isset( $st_head_video_embed ) && ! empty( $st_head_video_embed ) ) {
		$custom_css .= '.stunning-header-video-embed';
		$custom_css .= '{visibility: visible; margin: auto; position: absolute; z-index: -1; top: 50%; left: 0%; transform: translate(0%, -50%); width: 1905px; height: auto;}';
	}

	$st_head_height = reactor_option( 'st-header-height' );

	if ( is_singular( 'portfolio' ) ) {
		$meta_st_head_height = reactor_option( 'meta-st-header-height', '', 'meta_portfolio_heading_options' );
	} else {
		$meta_st_head_height = reactor_option( 'meta-st-header-height', '', 'meta_page_options' );
	}

	if ( isset( $meta_st_head_height ) && ! empty( $meta_st_head_height ) ) {
		$st_head_height = $meta_st_head_height;
	}

	if ( isset( $st_head_height ) && ! empty( $st_head_height ) ) {
		$custom_css .= '#page-title{';
		$custom_css .= 'height:' . $st_head_height . 'px}';
	}

	$st_head_text_color = reactor_option( 'st-header-text-color' );

	if ( is_singular( 'portfolio' ) ) {
		$meta_st_head_text_color = reactor_option( 'meta-st-header-text-color', '', 'meta_portfolio_heading_options' );
	} else {
		$meta_st_head_text_color = reactor_option( 'meta-st-header-text-color', '', 'meta_page_options' );
	}

	if ( isset( $meta_st_head_text_color ) && ! empty( $meta_st_head_text_color ) ) {
		$st_head_text_color = $meta_st_head_text_color;
	}

	if ( isset( $st_head_text_color ) && ! empty( $st_head_text_color ) ) {
		$custom_css .= '.custom-heading-colored{';
		$custom_css .= 'color:' . $st_head_text_color . '}';
		$custom_css .= '.breadcrumb a{color:inherit !important}';
		$custom_css .= '.page-title h1{color:inherit}';
	}

	$custom_css .= polo_typography_customization( 'h1' );
	$custom_css .= polo_typography_customization( 'h2' );
	$custom_css .= polo_typography_customization( 'h3' );
	$custom_css .= polo_typography_customization( 'h4' );
	$custom_css .= polo_typography_customization( 'h5' );
	$custom_css .= polo_typography_customization( 'h6' );
	$custom_css .= polo_typography_customization( 'body' );

	$boxed_body = reactor_option( 'boxed-body' );
	if ( is_singular( 'portfolio' ) ) {
		$meta_boxed_body = polo_metaselect_to_switch( reactor_option( 'meta-boxed-body', '', 'meta_portfolio_heading_options' ) );
	} else {
		$meta_boxed_body = polo_metaselect_to_switch( reactor_option( 'meta-boxed-body', '', 'meta_page_options' ) );
	}

	if ( ! ( null === $meta_boxed_body ) ) {
		$boxed_body = $meta_boxed_body;
	}

	if ( true === $boxed_body ) {
		$boxed_body_bg = reactor_option( 'boxed_body_background' );
		if ( is_singular( 'portfolio' ) ) {
			$meta_boxed_body_bg = reactor_option( 'boxed_body_background', '', 'meta_portfolio_heading_options' );
		} else {
			$meta_boxed_body_bg = reactor_option( 'boxed_body_background', '', 'meta_page_options' );
		}

		if ( is_array( $boxed_body_bg ) && ! empty( $boxed_body_bg ) ) {
			foreach ( $boxed_body_bg as $attr => $value ) {
				if ( isset( $meta_boxed_body_bg[ $attr ] ) && ! empty( $meta_boxed_body_bg[ $attr ] ) ) {
					$boxed_body_bg[ $attr ] = $meta_boxed_body_bg[ $attr ];
				}
			}
		} elseif ( empty( $boxed_body_bg ) && ! empty( $meta_boxed_body_bg ) ) {
			$boxed_body_bg = $meta_boxed_body_bg;
		}

		if ( isset( $boxed_body_bg ) && ! empty( $boxed_body_bg ) ) {

			$custom_css .= '.boxed-body-custom-background{';

			if ( isset( $boxed_body_bg['color'] ) && ! empty( $boxed_body_bg['color'] ) ) {
				$custom_css .= 'background-color:' . $boxed_body_bg['color'] . ';';
				if ( empty( $meta_boxed_body_bg['image'] ) ) {
					$boxed_body_bg['image'] = '';
				}
			}
			if ( isset( $boxed_body_bg['image'] ) && ! empty( $boxed_body_bg['image'] ) ) {
				$custom_css .= 'background-image:url(' . $boxed_body_bg['image'] . ');';
			}
			if ( isset( $boxed_body_bg['repeat'] ) && ! empty( $boxed_body_bg['repeat'] ) ) {
				$custom_css .= 'background-repeat:' . $boxed_body_bg['repeat'] . ';';
			}
			if ( isset( $boxed_body_bg['position'] ) && ! empty( $boxed_body_bg['position'] ) ) {
				$custom_css .= 'background-position:' . $boxed_body_bg['position'] . ';';
			}
			if ( isset( $boxed_body_bg['attachment'] ) && ! empty( $boxed_body_bg['attachment'] ) ) {
				$custom_css .= 'background-attachment:' . $boxed_body_bg['attachment'] . ';';
			}

			$custom_css .= '}';
		}
	} elseif ( false === $boxed_body ) {
		$normal_body_bg = reactor_option( 'normal_body_background' );
		if ( is_singular( 'portfolio' ) ) {
			$meta_normal_body_bg = reactor_option( 'normal_body_background', '', 'meta_portfolio_heading_options' );
		} else {
			$meta_normal_body_bg = reactor_option( 'normal_body_background', '', 'meta_page_options' );
		}
		if ( is_array( $normal_body_bg ) && ! empty( $normal_body_bg ) ) {
			foreach ( $normal_body_bg as $key => $attribute ) {
				if ( isset( $meta_normal_body_bg[ $key ] ) && ! empty( $meta_normal_body_bg[ $key ] ) ) {
					$normal_body_bg[ $key ] = $meta_normal_body_bg[ $key ];
				}
			}
		} elseif ( empty( $normal_body_bg ) && ! empty( $meta_normal_body_bg ) ) {
			$normal_body_bg = $meta_normal_body_bg;
		}

		if ( isset( $normal_body_bg ) && ! empty( $normal_body_bg ) ) {

			$custom_css .= '.body-custom-background{';

			if ( isset( $normal_body_bg['color'] ) && ! empty( $normal_body_bg['color'] ) ) {
				$custom_css .= 'background-color:' . $normal_body_bg['color'] . ';';
				if ( empty( $meta_normal_body_bg['image'] ) ) {
					$normal_body_bg['image'] = '';
				}
			}
			if ( isset( $normal_body_bg['image'] ) && ! empty( $normal_body_bg['image'] ) ) {
				$custom_css .= 'background-image:url(' . $normal_body_bg['image'] . ');';
			}
			if ( isset( $normal_body_bg['repeat'] ) && ! empty( $normal_body_bg['repeat'] ) ) {
				$custom_css .= 'background-repeat:' . $normal_body_bg['repeat'] . ';';
			}
			if ( isset( $normal_body_bg['position'] ) && ! empty( $normal_body_bg['position'] ) ) {
				$custom_css .= 'background-position:' . $normal_body_bg['position'] . ';';
			}
			if ( isset( $normal_body_bg['attachment'] ) && ! empty( $normal_body_bg['attachment'] ) ) {
				$custom_css .= 'background-attachment:' . $normal_body_bg['attachment'] . ';';
			}
			$custom_css .= '}';
		}
	}

	$custom_css_code = reactor_option( 'css-code' );
	if ( isset( $custom_css_code ) && ! empty( $custom_css_code ) ) {
		$custom_css .= $custom_css_code;
	}

	wp_add_inline_style( 'theme-base-style', $custom_css );

}