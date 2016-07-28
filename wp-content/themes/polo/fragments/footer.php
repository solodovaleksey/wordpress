<?php

$footer_style = reactor_option( 'footer-color-scheme' );
//footer content section
$footer_content_enable  = reactor_option( 'footer-content-enable' );
$footer_top_panel_style = reactor_option( 'footer-top-panel-style' );

if ( is_singular( 'portfolio' ) ) {
	$meta_footer_style = reactor_option( 'meta-footer-color-scheme', '', 'meta_portfolio_heading_options' );
} elseif ( is_page_template( 'page-templates/portfolio-page-side.php' ) ) {
	$meta_footer_style = reactor_option( 'meta-footer-color-scheme', '', 'meta_portfolio_page_panel_options' );
} elseif ( is_page_template( 'page-templates/one-page.php' ) ) {
	$meta_footer_style = reactor_option( 'meta-footer-color-scheme', '', 'one_page_options' );
} else {
	$meta_footer_style = reactor_option( 'meta-footer-color-scheme', '', 'meta_page_options' );
}
if ( is_singular( 'portfolio' ) ) {
	$meta_footer_content_enable = polo_metaselect_to_switch( reactor_option( 'meta-footer-content-enable', '', 'meta_portfolio_heading_options' ) );

} elseif ( is_page_template( 'page-templates/portfolio-page-side.php' ) ) {
	$meta_footer_content_enable = polo_metaselect_to_switch( reactor_option( 'meta-footer-content-enable', '', 'meta_portfolio_page_panel_options' ) );
} elseif ( is_page_template( 'page-templates/one-page.php' ) ) {
	$meta_footer_content_enable = polo_metaselect_to_switch( reactor_option( 'meta-footer-content-enable', '', 'one_page_options' ) );
} else {
	$meta_footer_content_enable = polo_metaselect_to_switch( reactor_option( 'meta-footer-content-enable', '', 'meta_page_options' ) );
}
if ( is_singular( 'portfolio' ) ) {
	$meta_footer_top_panel_style = reactor_option( 'meta-footer-top-panel-style', '', 'meta_portfolio_heading_options' );
} elseif ( is_page_template( 'page-templates/portfolio-page-side.php' ) ) {
	$meta_footer_top_panel_style = reactor_option( 'meta-footer-top-panel-style', '', 'meta_portfolio_page_panel_options' );
} elseif ( is_page_template( 'page-templates/one-page.php' ) ) {
	$meta_footer_top_panel_style = reactor_option( 'meta-footer-top-panel-style', '', 'one_page_options' );
} else {
	$meta_footer_top_panel_style = reactor_option( 'meta-footer-top-panel-style', '', 'meta_page_options' );
}

if ( isset( $meta_footer_style ) && ! empty( $meta_footer_style ) && ! ( 'default' === $meta_footer_style ) ) {
	$footer_style = $meta_footer_style;
}

if ( ! ( null === $meta_footer_content_enable ) ) {
	$footer_content_enable = $meta_footer_content_enable;
}

if ( isset( $meta_footer_top_panel_style ) && ! empty( $meta_footer_top_panel_style ) && ! ( 'default' === $meta_footer_top_panel_style ) ) {
	$footer_top_panel_style = $meta_footer_top_panel_style;
}

$output = '';

$classes = array();

if ( 'footer-light' === $footer_style ) {
	$classes[] = 'background-grey';
} elseif ( 'footer-colored' === $footer_style ) {
	$classes[] = 'background-colored text-light';
} else {
	$classes[] = 'background-dark text-grey';
}

$output .= '<footer id="footer" class="' . implode( ' ', $classes ) . '">';

/*
 * Footer content section
 */
if ( isset( $footer_content_enable ) && ( true === $footer_content_enable ) ) {

	if ( isset( $footer_top_panel_style ) && ! empty( $footer_top_panel_style ) ) {
		$style = $footer_top_panel_style;
	} else {
		$style = 'style_1';
	}

	$output .= '<div class="footer-content">';

	$output .= '<div class="container">';

	if ( ! ( 'style_5' === $style ) ) {
		ob_start();
		get_template_part( 'fragments/footer/' . $style );
		$output .= ob_get_clean();
	}

	$output .= '</div>';//.container

	$output .= '</div>';//.footer-content

}

if ( ! ( 'style_6' === $footer_top_panel_style ) ) {
	ob_start();
	get_template_part( 'fragments/copyright-content' );
	$output .= ob_get_clean();
}

$output .= '</footer>';

if ( ! ( 'style_5' === $footer_top_panel_style ) ) {
	echo apply_filters( 'polo_main_footer', $output );
}