<?php
/**
 * Customizer OPTIONS
 * @package omni
 **/

if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// CUSTOMIZE SETTINGS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================!
$options     = array();
$assets_path = get_template_directory_uri() . '/images/';
$admin_assets_path = get_template_directory_uri() . '/images/admin/';

$soc_networks_array = array(
	'fa fa-facebook'   => esc_html__( 'Facebook', 'polo' ),
	'fa fa-google'     => esc_html__( 'Google', 'polo' ),
	'fa fa-twitter'    => esc_html__( 'Twitter', 'polo' ),
	'fa fa-instagram'  => esc_html__( 'Instagram', 'polo' ),
	'fa fa-xing'       => esc_html__( 'Xing', 'polo' ),
	'fa fa-lastfm'     => esc_html__( 'LastFM', 'polo' ),
	'fa fa-dribbble'   => esc_html__( 'Dribble', 'polo' ),
	'fa fa-vk'         => esc_html__( 'Vkontakte', 'polo' ),
	'fa fa-youtube'    => esc_html__( 'Youtube', 'polo' ),
	'fa fa-windows'    => esc_html__( 'Microsoft', 'polo' ),
	'fa fa-deviantart' => esc_html__( 'Deviantart', 'polo' ),
	'fa fa-linkedin'   => esc_html__( 'LinkedIN', 'polo' ),
	'fa fa-pinterest'  => esc_html__( 'Pinterest', 'polo' ),
	'fa fa-wordpress'  => esc_html__( 'WordPress', 'polo' ),
	'fa fa-behance'    => esc_html__( 'Behance', 'polo' ),
	'fa fa-flickr'     => esc_html__( 'Flickr', 'polo' ),
	'fa fa-rss'        => esc_html__( 'RSS', 'polo' ),
);

// -----------------------------------------
// Main theme options           -
// -----------------------------------------
$options[] = array(
	'name'     => 'theme_options',
	'title'    => esc_html__( 'Main options', 'polo' ),
	'settings' => array(
		array(
			'name'    => 'theme_purchase_code',
			'control' => array(
				'type'    => 'cs_field',
				'options' => array(
					'type'  => 'text',
					'title' => esc_html__( 'Purchase code', 'polo' ),
				),
			),
		),
		array(
			'name'    => 'theme_access_token',
			'control' => array(
				'type'    => 'cs_field',
				'options' => array(
					'type'  => 'text',
					'title' => esc_html__( 'Access token', 'polo' ),
				),
			),
		),
	),
);

CSFramework_Customize::instance( $options );
