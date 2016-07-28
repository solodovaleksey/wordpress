<?php

/**
 * Recent Posts widget w/ category exclude class
 * This allows specific Category IDs to be removed from the Sidebar Recent Posts list
 *
 * @link http://wordpress.org/support/topic/recent-posts-widget-with-category-exclude
 */
class WP_Widget_Recent_Posts_Exclude extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname'   => 'widget-blog-articles',
			'description' => esc_html__( "The most recent posts on your site", 'polo_extension' )
		);
		parent::__construct( 'crumina-recent-posts', esc_html__( 'Crumina: Recent Posts', 'polo_extension' ), $widget_ops );
		$this->alt_option_name = 'widget_recent_entries';

		add_action( 'save_post', array( &$this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( &$this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( &$this, 'flush_widget_cache' ) );
	}

	function widget( $args, $instance ) {
		$before_widget = $after_widget = $before_title = $after_title = '';

		$cache = wp_cache_get( 'widget_recent_posts', 'widget' );

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo( $cache[ $args['widget_id'] ] );

			return;
		}

		ob_start();
		extract( $args );

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_html__( 'Recent Posts', 'polo_extension' ) : $instance['title'], $instance, $this->id_base );
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) ) {
			$number = 10;
		}
		$exclude = empty( $instance['exclude'] ) ? '' : $instance['exclude'];

		$r = new WP_Query( array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'category__not_in'    => explode( ',', $exclude )
		) );

		$output = '';

		if ( $r->have_posts() ) :
			$output .= $before_widget;
			if ( $title ) {
				$output .= $before_title . $title . $after_title;
			}

			$output .= '<ul class="list-posts list-medium">';

			while ( $r->have_posts() ) : $r->the_post();

				$output .= '<li>';

				$output .= '<a href="' . get_the_permalink( get_the_ID() ) . '">' . get_the_title( get_the_ID() ) . '</a>';
				$output .= '<small>' . get_the_date( 'M m Y', get_the_ID() ) . '</small>';

				$output .= '</li>';

			endwhile;

			$output .= '</ul>';

			$output .= $after_widget;

			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();

		endif;

		echo $output;

		$cache[ $args['widget_id'] ] = ob_get_flush();
		wp_cache_set( 'widget_recent_posts', $cache, 'widget' );
	}

	function update( $new_instance, $old_instance ) {
		$instance            = $old_instance;
		$instance['title']   = strip_tags( $new_instance['title'] );
		$instance['number']  = (int) $new_instance['number'];
		$instance['exclude'] = strip_tags( $new_instance['exclude'] );
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['widget_recent_entries'] ) ) {
			delete_option( 'widget_recent_entries' );
		}

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete( 'widget_recent_posts', 'widget' );
	}

	function form( $instance ) {
		$title   = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number  = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$exclude = isset( $instance['exclude'] ) ? esc_attr( $instance['exclude'] ) : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'polo_extension' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'polo_extension' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'exclude' ) ); ?>"><?php esc_html_e( 'Exclude Category(s):', 'polo_extension' ); ?></label>
			<input type="text" value="<?php echo esc_attr( $exclude ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'exclude' ) ); ?>" id="<?php echo( $this->get_field_id( 'exclude' ) ); ?>" class="widefat" />
			<br />
			<small><?php esc_html_e( 'Category IDs, separated by commas.', 'polo_extension' ); ?></small>
		</p>
	<?php
	}
}

function WP_Widget_Recent_Posts_Exclude_init() {
	register_widget( 'WP_Widget_Recent_Posts_Exclude' );
}

add_action( 'widgets_init', 'WP_Widget_Recent_Posts_Exclude_init' );

?>