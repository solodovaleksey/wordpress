<?php
/*
 * Header content and functions
 */

function polo_do_head() {
	?>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />

	<?php
	if ( ! function_exists( '_wp_render_title_tag' ) ) {
		?>

		<title><?php wp_title( ' - ', true, 'right' ); ?></title>

	<?php } ?>

	<!--[if IE]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<![endif]-->

	<!-- mobile meta -->
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="pingback" href="<?php esc_url(bloginfo( 'pingback_url' )); ?>">

<?php
}

add_action( 'wp_head', 'polo_do_head', 1 );

function do_top_bar() {
	get_template_part( 'fragments/top-bar' );
}

add_action( 'polo_header_before', 'polo_before_header_section', 5 );
function polo_before_header_section(){
	if(is_page_template('page-templates/top-section.php')){

		get_template_part( 'fragments/before-header' );

	}
}

add_action( 'polo_header_before', 'do_top_bar', 10 );

function do_stunning_header() {
	$show_stunning_header      = reactor_option( 'stunning_header_show', true );
	if ( is_singular('portfolio') ) {
		$meta_show_stunning_header = polo_metaselect_to_switch( reactor_option( 'meta-stunning-header-show', '', 'meta_portfolio_heading_options' ) );
	} else {
		$meta_show_stunning_header = polo_metaselect_to_switch( reactor_option( 'meta-stunning-header-show', '', 'meta_page_options' ) );
	}

	if ( ! ( null === $meta_show_stunning_header ) ) {
		$show_stunning_header = $meta_show_stunning_header;
	}

	if ( isset( $show_stunning_header ) && ! ( false === $show_stunning_header ) && !is_404() ) {
		get_template_part( 'fragments/stunning-header' );
	}
}

add_action( 'polo_header_after', 'do_stunning_header' );