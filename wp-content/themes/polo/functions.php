<?php
/**
 * Crumina Theme Functions
 *
 */

if ( ! defined( 'POLO_ROOT_PATH' ) ) {
	define( 'POLO_ROOT_PATH', get_template_directory() );
}
if ( ! defined( 'POLO_ROOT_URL' ) ) {
	define( 'POLO_ROOT_URL', get_template_directory_uri() );
}

if(!defined('CS_ACTIVE_SHORTCODE')){
	define('CS_ACTIVE_SHORTCODE',false);
}

//theme options framework
require POLO_ROOT_PATH . '/library/codestar/cs-framework.php';

//get theme options
require POLO_ROOT_PATH . '/library/inc/functions/get-options.php';
//breadcrumbs
require POLO_ROOT_PATH . '/library/inc/functions/breadcrumbs.php';
//theme helper functions
require POLO_ROOT_PATH . '/library/inc/functions/helpers.php';
//woocommerce helpers
require POLO_ROOT_PATH . '/library/inc/woocommerce/woo-single-product.php';
require POLO_ROOT_PATH . '/library/inc/woocommerce/woo-shop-product.php';
require POLO_ROOT_PATH . '/library/inc/woocommerce/woo-widgets.php';
//Portfolio sorter
require POLO_ROOT_PATH . '/library/inc/functions/taxonomy-subnav.php';
//Mr image resize
require POLO_ROOT_PATH . '/library/inc/functions/mr-image-resize.php';
//post meta
require POLO_ROOT_PATH . '/library/inc/functions/post-functions.php';
//pagination
require POLO_ROOT_PATH . '/library/inc/functions/page-links.php';
//portfolio hover effects
require POLO_ROOT_PATH . '/library/inc/functions/portfolio-hovers.php';
//theme styles
require POLO_ROOT_PATH . '/library/inc/extensions/styles.php';
//custom color scheme
require POLO_ROOT_PATH . '/library/inc/extensions/custom-color-scheme.php';
//theme scripts
require POLO_ROOT_PATH . '/library/inc/extensions/scripts.php';
//theme sidebars
require POLO_ROOT_PATH . '/library/inc/extensions/sidebars.php';
//comments callback
require POLO_ROOT_PATH . '/library/inc/extensions/comments.php';
//TGM plugins
require POLO_ROOT_PATH . '/library/inc/plugins/tgm-config.php';

//theme menus
require POLO_ROOT_PATH . '/library/inc/menu/menus.php';
require POLO_ROOT_PATH . '/library/inc/menu/walkers.php';
require POLO_ROOT_PATH . '/library/inc/menu/mega_menu.php';
require POLO_ROOT_PATH . '/library/inc/menu/edit_mega_menu_walker.php';

//content functions
require POLO_ROOT_PATH . '/library/inc/extensions/hooks.php';
require POLO_ROOT_PATH . '/library/inc/content/content-header.php';
require POLO_ROOT_PATH . '/library/inc/content/content-footer.php';
require POLO_ROOT_PATH . '/library/inc/content/content-posts.php';
require POLO_ROOT_PATH . '/library/inc/content/content-pages.php';

//MCE shortcodes
require POLO_ROOT_PATH . '/library/inc/shortcodes/tinyMCE-shortcodes.php';

//theme update
require get_template_directory() . '/library/inc/theme-update/theme-update-checker.php';

$polo_update_checker = new ThemeUpdateChecker(
	'polo',
	'http://up.crumina.net/updates.server/wp-update-server/?action=get_metadata&slug=polo'
);

function reactor_theme_setup() {

	/**
	 * Reactor features
	 */
	add_theme_support(
		'crum-menus',
		array( 'main-menu', 'footer-links', 'top-menu' )
	);

	add_theme_support(
		'reactor-megamenu'
	);

	add_theme_support(
		'crum-sidebars',
		array( 'primary', 'secondary', 'shop-1','shop-2','footer-1', 'footer-2', 'footer-3' )
	);


	add_theme_support(
		'reactor-post-types',
		array( 'portfolio' )
	);

	add_theme_support( 'title-tag' );

	add_theme_support( 'reactor-fonts' );

	add_theme_support( 'reactor-breadcrumbs' );

	add_theme_support( 'reactor-page-links' );

	add_theme_support( 'reactor-post-meta' );

	add_theme_support( 'reactor-custom-login' );

	add_theme_support( 'reactor-taxonomy-subnav' );

	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'html5', array(
		'search-form',
		'gallery',
		'caption',
	) );


	/**
	 * WordPress features
	 */
	add_theme_support( 'menus' );

	// different post formats for tumblog style posting
	add_theme_support(
		'post-formats',
		array( 'gallery', 'image', 'quote', 'video', 'audio', )
	);

	// RSS feed links to header.php for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// editor stylesheet for TinyMCE
	add_editor_style( get_stylesheet_directory_uri() . '/assets/css/editor.css' );

	load_theme_textdomain( 'polo', POLO_ROOT_URL . '/translation' );
	$locale      = get_locale();
	$locale_file = POLO_ROOT_URL . '/translation/' . $locale . '.php';
	if ( is_readable( $locale_file ) ) {
		locate_template( $locale_file, true, true );
	}

	add_theme_support( "custom-background" );
	add_theme_support( "custom-header" );
	add_theme_support( 'automatic-feed-links' );

	/**
	 * 3rd Party Plugins Support
	 */

	// WooCommerce
	add_theme_support( 'woocommerce' );

	if ( function_exists( 'vc_set_as_theme' ) ) {
		vc_set_as_theme( $disable_updater = true );

	}
}

//theme setup
add_action( 'after_setup_theme', 'reactor_theme_setup', 10 );

//megamenu
add_action( 'admin_init', 'polo_mega_menu_init' );

//theme sidebars
add_action( 'widgets_init', 'polo_register_sidebars' );