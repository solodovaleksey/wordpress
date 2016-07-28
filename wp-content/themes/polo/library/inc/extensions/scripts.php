<?php
/*
 * Theme and admin area scripts
 */
add_action('wp_enqueue_scripts', 'polo_register_scripts', 1);
add_action('wp_enqueue_scripts', 'polo_enqueue_scripts');

add_action( 'admin_enqueue_scripts', 'polo_register_admin_scripts' );
add_action( 'admin_enqueue_scripts', 'polo_enqueue_admin_scripts' );

/**
 * Register frontend scripts
 */
function polo_register_scripts(){
	wp_register_script('crum-contact-form', get_template_directory_uri() . '/assets/js/contact-form.js', array('jquery'), false, false);
	wp_register_script( 'crum-likely', get_template_directory_uri() . '/assets/js/likely.js', array( 'jquery' ), false, false );
	wp_register_script('crum-particles', get_template_directory_uri() . '/assets/js/particles.min.js', array('jquery'), false, false);
	wp_register_script('crum-partical-animation', get_template_directory_uri() . '/assets/js/partical-animation.js', array('jquery'), false, false);
	wp_register_script('crum-boostrap-tabs', get_template_directory_uri() . '/assets/js/bootstrap-tabs.js', array('jquery'), false, false);
	wp_register_script('crum-quantity-field', get_template_directory_uri() . '/assets/js/quantity-field.js', array('jquery'), false, false);
	wp_register_script('crum-ajax-pagination', get_template_directory_uri() . '/assets/js/ajax-pagination.js', array('jquery'), false, false);
}

/**
 *Enqueue frontend scripts
 */
function polo_enqueue_scripts(){
	wp_enqueue_script( 'plugins-compressed-js', POLO_ROOT_URL . '/assets/vendor/plugins-compressed.js', array('jquery'), '', true );
	wp_enqueue_script( 'global-js', POLO_ROOT_URL . '/assets/js/theme-functions.js', array('jquery'), '', true );

	// comment reply script for threaded comments
	if ( is_singular() && comments_open() && get_option('thread_comments') ) {
		wp_enqueue_script('comment-reply');
	}
}

/**
 *Register admin scripts
 */
function polo_register_admin_scripts(){
	wp_register_script('admin-scripts', get_template_directory_uri() . '/assets/js/admin.js', array('jquery'), false, false);
}

/**
 *Enqueue admin scripts
 */
function polo_enqueue_admin_scripts(){
	wp_enqueue_script('admin-scripts');
}
