<?php

$footer_style = reactor_option( 'footer-color-scheme' );

$footer_logo_image        = reactor_option( 'footer-logotype-image' );
$footer_logo_image_retina = reactor_option( 'footer-logotype-image-retina' );
$footer_text              = reactor_option( 'footer-text' );
$footer_text              = polo_do_multilang_text($footer_text);

$footer_sidebar_layout = reactor_option( 'footer-sidebars-layout' );
$footer_align          = reactor_option( 'footer-top-panel-align' );

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
	$meta_footer_logo_image = reactor_option( 'meta-footer-logotype-image', '', 'meta_portfolio_heading_options' );
} elseif ( is_page_template( 'page-templates/portfolio-page-side.php' ) ) {
	$meta_footer_logo_image = reactor_option( 'meta-footer-logotype-image', '', 'meta_portfolio_page_panel_options' );
} elseif ( is_page_template( 'page-templates/one-page.php' ) ) {
	$meta_footer_logo_image = reactor_option( 'meta-footer-logotype-image', '', 'one_page_options' );
} else {
	$meta_footer_logo_image = reactor_option( 'meta-footer-logotype-image', '', 'meta_page_options' );
}
if ( is_singular( 'portfolio' ) ) {
	$meta_footer_logo_image_retina = reactor_option( 'meta-footer-logotype-image-retina', '', 'meta_portfolio_heading_options' );
} elseif ( is_page_template( 'page-templates/portfolio-page-side.php' ) ) {
	$meta_footer_logo_image_retina = reactor_option( 'meta-footer-logotype-image-retina', '', 'meta_portfolio_page_panel_options' );
} elseif ( is_page_template( 'page-templates/one-page.php' ) ) {
	$meta_footer_logo_image_retina = reactor_option( 'meta-footer-logotype-image-retina', '', 'one_page_options' );
} else {
	$meta_footer_logo_image_retina = reactor_option( 'meta-footer-logotype-image-retina', '', 'meta_page_options' );
}
if ( is_singular( 'portfolio' ) ) {
	$meta_footer_text = reactor_option( 'meta-footer-text', '', 'meta_portfolio_heading_options' );
} elseif ( is_page_template('page-templates/portfolio-page-side.php') ) {
	$meta_footer_text = reactor_option( 'meta-footer-text', '', 'meta_portfolio_page_panel_options' );
} elseif ( is_page_template('page-templates/one-page.php') ) {
	$meta_footer_text = reactor_option( 'meta-footer-text', '', 'one_page_options' );
} else {
	$meta_footer_text = reactor_option( 'meta-footer-text', '', 'meta_page_options' );
}
$meta_footer_text = polo_do_multilang_text($meta_footer_text);
if ( is_singular( 'portfolio' ) ) {
	$meta_footer_sidebars_layout = reactor_option( 'meta-footer-sidebars-layout', '', 'meta_portfolio_heading_options' );
} elseif ( is_page_template( 'page-templates/portfolio-page-side.php' ) ) {
	$meta_footer_sidebars_layout = reactor_option( 'meta-footer-sidebars-layout', '', 'meta_portfolio_page_panel_options' );
} elseif ( is_page_template( 'page-templates/one-page.php' ) ) {
	$meta_footer_sidebars_layout = reactor_option( 'meta-footer-sidebars-layout', '', 'one_page_options' );
} else {
	$meta_footer_sidebars_layout = reactor_option( 'meta-footer-sidebars-layout', '', 'meta_page_options' );
}
if ( is_singular( 'portfolio' ) ) {
	$meta_footer_align = reactor_option( 'meta-footer-top-panel-align', '', 'meta_portfolio_heading_options' );
} elseif( is_page_template( 'page-templates/one-page.php')){
	$meta_footer_align = reactor_option( 'meta-footer-top-panel-align', '', 'one_page_options' );
}else {
	$meta_footer_align = reactor_option( 'meta-footer-top-panel-align', '', 'meta_page_options' );
}

if ( isset( $meta_footer_style ) && ! empty( $meta_footer_style ) && ! ( 'default' === $meta_footer_style ) ) {
	$footer_style = $meta_footer_style;
}

if ( isset( $meta_footer_logo_image ) && ! empty( $meta_footer_logo_image ) ) {
	$footer_logo_image = $meta_footer_logo_image;
}

if ( isset( $meta_footer_logo_image ) && ! empty( $meta_footer_logo_image ) ) {
	$footer_logo_image = $meta_footer_logo_image;
}

if ( isset( $meta_footer_text ) && ! empty( $meta_footer_text ) ) {
	$footer_text = $meta_footer_text;
}

if ( isset( $meta_footer_sidebars_layout ) && ! empty( $meta_footer_sidebars_layout ) && ! ( 'default' === $meta_footer_sidebars_layout ) ) {
	$footer_sidebar_layout = $meta_footer_sidebars_layout;
}

if ( isset( $meta_footer_align ) && ! empty( $meta_footer_align ) && ! ( 'default' === $meta_footer_align ) ) {
	$footer_align = $meta_footer_align;
}

if ( 'footer-colored' === $footer_style ) {
	$sep_class = 'seperator-light m-b-20';
} else {
	$sep_class = 'seperator-dark';
}

if ( isset( $footer_align ) && ( 'right' === $footer_align ) ) {
	$align_class = 'float-right';
} else {
	$align_class = 'float-left';
}

if ( is_singular( 'portfolio' ) ) {
	$meta_footer_text_hide = reactor_option( 'hide_footer_text', '', 'meta_portfolio_heading_options' );
} elseif ( is_page_template( 'page-templates/portfolio-page-side.php' ) ) {
	$meta_footer_text_hide = reactor_option( 'hide_footer_text', '', 'meta_portfolio_page_panel_options' );
} elseif ( is_page_template( 'page-templates/one-page.php' ) ) {
	$meta_footer_text_hide = reactor_option( 'hide_footer_text', '', 'one_page_options' );
} else {
	$meta_footer_text_hide = reactor_option( 'hide_footer_text', '', 'meta_page_options' );
}

if ( is_singular( 'portfolio' ) ) {
	$meta_footer_enable = reactor_option( 'meta-footer-content-enable', '', 'meta_portfolio_heading_options' );
} elseif ( is_page_template( 'page-templates/portfolio-page-side.php' ) ) {
	$meta_footer_enable = reactor_option( 'meta-footer-content-enable', '', 'meta_portfolio_page_panel_options' );
} elseif ( is_page_template( 'page-templates/one-page.php' ) ) {
	$meta_footer_enable = reactor_option( 'meta-footer-content-enable', '', 'one_page_options' );
} else {
	$meta_footer_enable = reactor_option( 'meta-footer-content-enable', '', 'meta_page_options' );
}
$hide_separator = reactor_option( 'hide-footer-text-separator' );
if ( is_singular( 'portfolio' ) ) {
	$meta_hide_separator = polo_metaselect_to_switch( reactor_option( 'hide-footer-text-separator', '', 'meta_portfolio_heading_options' ) );
} elseif ( is_page_template( 'page-templates/one-page.php' ) ) {
	$meta_footer_enable = reactor_option( 'hide-footer-text-separator', '', 'one_page_options' );
} else {
	$meta_hide_separator = polo_metaselect_to_switch( reactor_option( 'hide-footer-text-separator', '', 'meta_page_options' ) );
}
if ( ! ( null == $meta_hide_separator ) ) {
	$hide_separator = $meta_hide_separator;
}

$output = '';

$output .= '<div class="row">';

$output .= '<div class="col-md-4 ' . $align_class . '">';

$output .= '<div class="footer-logo ' . $align_class . '">';
$output .= polo_do_logo( $footer_logo_image, $footer_logo_image_retina );
$output .= '</div>';//.footer-logo

if ( isset( $footer_text ) && ! empty( $footer_text ) && ! ( true === $meta_footer_text_hide ) ) {
	$output .= '<p>' .$footer_text . '</p>';
}

if ( true === $hide_separator || true === $meta_footer_text_hide || empty( $footer_text ) ) {
	$separator = '';
} else {
	$separator = '<div class="seperator ' . $sep_class . ' seperator-simple"></div>';
}

$output .= $separator;

$output .= polo_get_sidebar( 'sidebar-footer-1' );

$output .= '</div>';//.col-md-4

$output .= '<div class="col-md-4">';
$output .= polo_get_sidebar( 'sidebar-footer-2' );
$output .= '</div>';//.col-md-4

$output .= '<div class="col-md-4">';
$output .= polo_get_sidebar( 'sidebar-footer-3' );
$output .= '</div>';//.col-md-4

$output .= '</div>';//.row

echo apply_filters( 'polo_footer_style_4', $output );