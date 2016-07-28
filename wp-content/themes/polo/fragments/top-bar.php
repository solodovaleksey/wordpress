<?php
//theme opttions
$top_bar_enable      = reactor_option( 'top-bar-enable' );
$top_bar_transparent = reactor_option( 'top-bar-transparent' );
$top_bar_color       = reactor_option( 'top-bar-color' );
$top_bar_socicons    = reactor_option( 'top-bar-soc-icons' );

//Metabox options
if ( is_singular('portfolio') ) {
	$meta_top_bar_enable = reactor_option( 'meta-top-bar-enable', '', 'meta_portfolio_heading_options' );
} else {
	$meta_top_bar_enable = reactor_option( 'meta-top-bar-enable', '', 'meta_page_options' );
}
if ( is_singular('portfolio') ) {
	$meta_top_bar_color = reactor_option( '_meta-top-bar-color', '', 'meta_portfolio_heading_options' );
} else {
	$meta_top_bar_color = reactor_option( '_meta-top-bar-color', '', 'meta_page_options' );
}
if ( is_singular('portfolio') ) {
	$meta_top_bar_transparent = reactor_option( 'meta-top-bar-transparent', '', 'meta_portfolio_heading_options' );
} else {
	$meta_top_bar_transparent = reactor_option( 'meta-top-bar-transparent', '', 'meta_page_options' );
}

if(isset($meta_top_bar_enable) && !empty($meta_top_bar_enable) && !('default' === $meta_top_bar_enable)){
	if('true' === $meta_top_bar_enable){
		$top_bar_enable = true;
	}elseif('false' === $meta_top_bar_enable){
		$top_bar_enable = false;
	}
}

if(isset($meta_top_bar_color) && !empty($meta_top_bar_color) && !('default' === $meta_top_bar_color)){
	$top_bar_color = $meta_top_bar_color;
}

if(isset($meta_top_bar_transparent) && !empty($meta_top_bar_transparent) && !('default' === $meta_top_bar_transparent)){
	if('true' === $meta_top_bar_transparent){
		$top_bar_transparent = true;
	}elseif('false' === $meta_top_bar_transparent){
		$top_bar_transparent = false;
	}
}

$classes = array();

if ( 'dark' === $top_bar_color ) {
	$classes[] = 'topbar-dark';
} elseif ( 'custom' === $top_bar_color ) {
	$classes[] = 'topbar-custom';
} else {
	$classes[] = '';
}

if ( isset( $top_bar_transparent ) && ( true === $top_bar_transparent ) && 'white' === $top_bar_color ) {
	$classes[] = 'topbar-transparent';
}

$output = '';

$output .= '<div id="topbar" class="' . esc_attr( implode( ' ', $classes ) ) . '">';

$output .= '<div class="container">';

$output .= '<div class="row">';

$output .= '<div class="col-sm-6">';

$output .= polo_top_menu();

$output .= '</div>';//col-sm-6

if ( isset( $top_bar_socicons ) && is_array( $top_bar_socicons ) && ! empty( $top_bar_socicons ) ) {
	$output .= '<div class="social-icons social-icons-colored-hover">';

	$output .= '<ul>';

	foreach ( $top_bar_socicons as $single_socicon ) {
		if ( 'google-plus' === $single_socicon['social-network-icon'] ) {
			$output .= '<li class="social-google">';
		} else {
			$output .= '<li class="social-' . $single_socicon['social-network-icon'] . '">';
		}
		$output .= '<a href="' . esc_url($single_socicon['social-network-url']) . '"><i class="fa fa-' . $single_socicon['social-network-icon'] . '"></i></a>';
		$output .= '</li>';
	}

	$output .= '</ul>';

	$output .= '</div>';
}

$output .= '</div>';//.row

$output .= '</div>';//.container

$output .= '</div>';//#topbar

if ( isset( $top_bar_enable ) && ( true === $top_bar_enable ) ) {
	echo ($output);
}