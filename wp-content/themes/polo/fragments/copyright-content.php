<?php
//footer copyright section
$footer_copyright_enable      = reactor_option( 'footer-copyright-enable', true );
$copyright_text               = reactor_option( 'copyright-text', '&copy; 2016 POLO - Best WordPress Theme Ever. All Rights Reserved.' );
$footer_soc_links             = reactor_option( 'footer-soclinks-enable' );
$soc_icons                    = reactor_option( 'top-bar-soc-icons' );
$footer_soc_links_style = reactor_option( 'footer-social-link-style' );
$footer_soc_links_transparent = reactor_option( 'footer-soclinks-transparency-enable' );


if ( function_exists( 'icl_object_id' ) ) {
	$current_language = ICL_LANGUAGE_CODE;
	$copyright_text   = $copyright_text[ $current_language ];
}

if ( is_array( $copyright_text ) ) {
	$copyright_text = array_slice( $copyright_text, 0, 1 );
	$copyright_text = implode( $copyright_text );
}


$output = '';
/*
 * Footer copyright section
 */
if ( isset( $footer_copyright_enable ) && ( true === $footer_copyright_enable ) ) {
	$output .= '<div class="copyright-content">';

	$output .= '<div class="container">';

	$output .= '<div class="row">';

	if ( isset( $copyright_text ) && ! empty( $copyright_text ) ) {
		if ( isset( $footer_soc_links ) && ! empty( $footer_soc_links ) ) {
			$width_class = 'col-md-6';
		} else {
			$width_class = 'text-center';
		}
		$output .= '<div class="copyright-text ' . $width_class . '">';
		$output .= do_shortcode( $copyright_text );
		$output .= '</div>';// .copyright-text col-md-6
	}
	if ( isset( $footer_soc_links ) && ( true === $footer_soc_links ) ) {

		if('transparent' === $footer_soc_links_style){
			$style_class = 'social-icons text-right';
		}elseif('colored' === $footer_soc_links_style){
			$style_class = 'social-icons social-icons-colored';
		}else{
			$style_class = '';
		}

		$output .= '<div class="col-md-6 ' . $style_class . '">';

		if ( isset( $soc_icons ) && is_array( $soc_icons ) && ! empty( $soc_icons ) ) {
			if ( 'transparent' === $footer_soc_links_style ) {
				foreach ( $soc_icons as $single_socicon ) {
					$output .= '<a class="social-icon transparent social-' . $single_socicon['social-network-icon'] . '">';
					$output .= '<i class="fa fa-' . $single_socicon['social-network-icon'] . '"></i>';
					$output .= '</a>';
				}
			} else {
				$output .= '<div class="social-icons">';

				$output .= '<ul>';
				foreach ( $soc_icons as $single_socicon ) {
					$output .= '<li class="social-' . $single_socicon['social-network-icon'] . '">';
					$output .= '<a href="' . esc_url($single_socicon['social-network-url']) . '"><i class="fa fa-' . $single_socicon['social-network-icon'] . '"></i></a>';
					$output .= '</li>';
				}
				$output .= '</ul>';

				$output .= '</div>';//.social-icons
			}
		}

		$output .= '</div>';//.col-md-6
	}

	$output .= '</div>';//.row

	$output .= '</div>';//.container

	$output .= '</div>';//copyright-content
}

echo ($output);