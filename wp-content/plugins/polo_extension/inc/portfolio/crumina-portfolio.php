<?php
/**
 * Custom Post Types
 * Portfolio, Megamenu and custom taxonomies
 *
 * @package Reactor
 * @author  Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @author  Eddie Machado (@eddiemachado / themeble.com/bones)
 * @since   1.0.0
 * @link    http://codex.wordpress.org/Function_Reference/register_post_type#Example
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

if ( ! ( class_exists( 'Crum_Custom_Post_Types' ) ) ) {

	class Crum_Custom_Post_Types {

		function __construct() {

			add_action( 'init', array( &$this, 'crum_portfolio_register' ) );

			add_action( 'init', array( &$this, 'crum_portfolio_taxonomies' ), 0 );

		}

		/**
		 * Register portfolio post type
		 * Do not use before init
		 *
		 * @see   register_post_type
		 * @since 1.0.0
		 */
		function crum_portfolio_register() {
			if ( function_exists( 'cs_get_option' ) ) {
				$slug = cs_get_option( 'custom_portfolio_slug' ) ? cs_get_option( 'custom_portfolio_slug' ) : 'portfolio-page';
			} else {
				$slug = 'portfolio-page';
			}


			$labels = array(
				'name'               => __( 'Portfolio', 'crum' ),
				'singular_name'      => __( 'Portfolio Post', 'crum' ),
				'add_new'            => __( 'Add New', 'crum' ),
				'add_new_item'       => __( 'Add New Portfolio Post', 'crum' ),
				'edit_item'          => __( 'Edit Portfolio Post', 'crum' ),
				'new_item'           => __( 'New Portfolio Post', 'crum' ),
				'all_items'          => __( 'All Portfolio Posts', 'crum' ),
				'view_item'          => __( 'View Portfolio Post', 'crum' ),
				'search_items'       => __( 'Search Portfolio', 'crum' ),
				'not_found'          => __( 'Nothing found', 'crum' ),
				'not_found_in_trash' => __( 'Nothing found in Trash', 'crum' ),
				'parent_item_colon'  => '',
				'menu_name'          => __( 'Portfolio', 'crum' )
			);

			$args = array(
				'labels'             => $labels,
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'menu_icon'          => 'dashicons-format-gallery',
				'capability_type'    => 'post',
				'taxonomies'         => array( 'portfolio-category', 'portfolio-tag' ),
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => 8,
				'rewrite'            => array(
					'slug'       => $slug,
					'with_front' => false,
					'feed'       => true,
					'pages'      => true
				),
				'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' )
			);

			register_post_type( 'portfolio', $args );

			// this ads your post categories to your custom post type
			// register_taxonomy_for_object_type('category', 'portfolio');

			// this ads your post tags to your custom post type
			// register_taxonomy_for_object_type('post_tag', 'portfolio');
		}

		/**
		 * Create portfolio taxonomies
		 * Do not use before init
		 *
		 * @link  http://codex.wordpress.org/Function_Reference/register_taxonomy
		 * @see   register_taxonomy
		 * @since 1.0.0
		 */
		function crum_portfolio_taxonomies() {

			if ( function_exists( 'reactor_option' ) ) {
				$slug = reactor_option( 'custom_portfolio_slug', 'portfolio-page' );
			} else {
				$slug = 'portfolio-page';
			}

			// Add new taxonomy, make it hierarchical ( like categories )
			$labels = array(
				'name'              => __( 'Portfolio Categories', 'crum' ),
				'singular_name'     => __( 'Portfolio Category', 'crum' ),
				'search_items'      => __( 'Search Portfolio Categories', 'crum' ),
				'all_items'         => __( 'All Portfolio Categories', 'crum' ),
				'parent_item'       => __( 'Parent Portfolio Category', 'crum' ),
				'parent_item_colon' => __( 'Parent Portfolio Category:', 'crum' ),
				'edit_item'         => __( 'Edit Portfolio Category', 'crum' ),
				'update_item'       => __( 'Update Portfolio Category', 'crum' ),
				'add_new_item'      => __( 'Add New Portfolio Category', 'crum' ),
				'new_item_name'     => __( 'New Portfolio Category Name', 'crum' ),
				'menu_name'         => __( 'Categories', 'crum' ),
			);

			register_taxonomy( 'portfolio-category', array( 'portfolio' ),
				array(
					'hierarchical'      => true,
					'labels'            => $labels,
					'show_ui'           => true,
					'show_admin_column' => true,
					'query_var'         => true,
					'rewrite'           => array( 'slug' => $slug . '-category' ),
				) );
		}

	}

}

if ( class_exists( 'Crum_Custom_Post_Types' ) ) {
	$Crum_Custom_Post_Types = new Crum_Custom_Post_Types;
}
