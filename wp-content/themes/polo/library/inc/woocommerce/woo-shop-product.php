<?php
function polo_woo_shop_product_title() {

	$output = '';

	$output .= '<div class="product-title">';
	$output .= '<h3><a href="' . esc_url( get_the_permalink( get_the_ID() ) ) . '">' . esc_attr( get_the_title( get_the_ID() ) ) . '</a></h3>';
	$output .= '</div>';

	echo apply_filters( 'polo_single_product_title', $output );

}

add_action( 'polo_woo_shop_product_summary', 'polo_woo_shop_product_title', 10 );

function polo_shop_product_images() {

	global $post, $product;

	$attachment_ids = $product->get_gallery_attachment_ids();

	$output = '';

	if ( has_post_thumbnail() ) {

		$product_thumbnail = wp_get_attachment_url( get_post_thumbnail_id() );

	} else {

		$product_thumbnail = wc_placeholder_img_src();

	}

	$output .= '<a href="#"><img src="' . esc_url( polo_theme_thumb( $product_thumbnail, '380', '507', true ) ) . '"></a>';

	if ( ! empty( $attachment_ids ) ) {

		$image_link = wp_get_attachment_url( $attachment_ids[0] );
		$output .= '<a href="#"><img src="' . esc_url( polo_theme_thumb( $image_link, '380', '507', true ) ) . '"></a>';

	} else {

		$output .= '<a href="#"><img src="' . esc_url( polo_theme_thumb( $product_thumbnail, '380', '507', true ) ) . '"></a>';

	}

	echo apply_filters( 'polo_shop_item_images', $output, $post->ID );

}

add_action( 'polo_woo_shop_product_images', 'polo_shop_product_images', 5 );

add_action( 'polo_woo_shop_product_images', 'woocommerce_show_product_sale_flash', 5 );

function polo_wishlist_add() {

	$add_to_wishlist = '';

	if ( class_exists( 'YITH_WCWL_Shortcode' ) ) {

		$wishlist = new YITH_WCWL_Shortcode;

		$wishist_atts = array(
			'label'                => '',
			'icon'                 => 'fa-heart',
			'browse_wishlist_text' => '<i class="fa fa-list-alt"></i>',
		);

		$add_to_wishlist .= '<span class="product-wishlist">';
		$add_to_wishlist .= $wishlist->add_to_wishlist( $wishist_atts );
		$add_to_wishlist .= '</span>';

	}

	echo apply_filters( 'polo_add_to_wishlist', $add_to_wishlist );

}

add_action( 'polo_woo_shop_product_images', 'polo_wishlist_add', 10 );

function polo_shop_product_overview() {

	global $product;

	$output = '';

	$output .= '<div class="product-overlay">';
	$output .= '<a href="#" class="yith-wcqv-button" data-product_id="' . $product->id . '">' . esc_html__( 'Quick View', 'polo' ) . '</a>';
	$output .= '</div>';

	echo apply_filters( 'polo_product_overview', $output );

}

add_action( 'polo_woo_shop_product_images', 'polo_shop_product_overview', 20 );

function polo_shop_items_count() {

	$prod_number = reactor_option( 'woo_shop_items', 10 );

	return $prod_number;

}

function polo_shop_pages_shortcode() {

	$output = '';

	if ( function_exists( 'is_cart' ) && is_cart() || ( function_exists( 'yith_wcwl_is_wishlist_page' ) && yith_wcwl_is_wishlist_page() ) || function_exists( 'is_checkout' ) && is_checkout() ) {

		$before_footer_shortcode = reactor_option( 'woo_shortcode' );
		if ( isset( $before_footer_shortcode ) && ! empty( $before_footer_shortcode ) ) {
			$output .= '<section class="background-grey p-t-40 p-b-0">';

			$output .= '<div class="container">';

			$output .= do_shortcode( $before_footer_shortcode );

			$output .= '</div>';

			$output .= '</section>';
		}

	}

	echo apply_filters( 'polo_shop_shortcode_output', $output );

}

add_action( 'polo_content_after', 'polo_shop_pages_shortcode', 40 );

remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );

function polo_woo_cart_shipping() { ?>

	<div class="col-md-6">

		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

		<?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>

			<tr class="shipping">
				<th><?php esc_html_e( 'Shipping', 'polo' ); ?></th>
				<td data-title="<?php esc_html_e( 'Shipping', 'polo' ); ?>"><?php woocommerce_shipping_calculator(); ?></td>
			</tr>

		<?php endif; ?>

	</div><!--col-md-6-->

<?php }

add_action( 'woocommerce_cart_collaterals', 'polo_woo_cart_shipping', 5 );

function polo_filter_cart_total( $value ) {

	$value = str_replace( 'amount', 'amount color lead', $value );
	$value = str_replace( '<strong>', '', $value );
	$value = str_replace( '</strong>', '', $value );
	$value = str_replace( '<span class="amount color lead">', '<span class="amount color lead"><strong>', $value );
	$value = str_replace( '</span>', '</strong></span>', $value );

	return $value;
}

add_filter( 'woocommerce_cart_totals_order_total_html', 'polo_filter_cart_total' );

/**
 * @param       $product_id
 * @param array $size
 *
 * @return mixed
 */
function polo_do_small_image( $product_id, $size = array() ) {

	if ( has_post_thumbnail( $product_id ) ) {
		$thumb = wp_get_attachment_url( get_post_thumbnail_id( $product_id ) );
	} else {
		$thumb = wc_placeholder_img_src();
	}
	$wishlist_thumb = polo_theme_thumb( $thumb, $size['width'], $size['height'], true );

	return $wishlist_thumb;

}

function polo_wishlist_button( $class ) {
	if ( function_exists( 'yith_wcwl_is_wishlist_page' ) && yith_wcwl_is_wishlist_page() ) {
		$class = str_replace( 'button', 'button color button-3d rounded icon-left empty-card-button', $class );
	}

	return $class;
}

add_filter( 'woocommerce_loop_add_to_cart_link', 'polo_wishlist_button' );

function polo_single_product_quantity( $args = array(), $product = null, $echo = true ) {
	if ( is_null( $product ) ) {
		$product = $GLOBALS['product'];
	}

	$defaults = array(
		'input_name'  => 'quantity',
		'input_value' => '1',
		'max_value'   => apply_filters( 'woocommerce_quantity_input_max', '', $product ),
		'min_value'   => apply_filters( 'woocommerce_quantity_input_min', '', $product ),
		'step'        => apply_filters( 'woocommerce_quantity_input_step', '1', $product ),
		'id'          => $product->id
	);

	$args = apply_filters( 'woocommerce_quantity_input_args', wp_parse_args( $args, $defaults ), $product );

	// Apply sanity to min/max args - min cannot be lower than 0
	if ( '' !== $args['min_value'] && is_numeric( $args['min_value'] ) && $args['min_value'] < 0 ) {
		$args['min_value'] = 0; // Cannot be lower than 0
	}

	// Max cannot be lower than 0 or min
	if ( '' !== $args['max_value'] && is_numeric( $args['max_value'] ) ) {
		$args['max_value'] = $args['max_value'] < 0 ? 0 : $args['max_value'];
		$args['max_value'] = $args['max_value'] < $args['min_value'] ? $args['min_value'] : $args['max_value'];
	}

	ob_start();

	wc_get_template( 'global/quantity-input.php', $args );

	if ( $echo ) {
		echo ob_get_clean();
	} else {
		return ob_get_clean();
	}
}

// Per Page Dropdown
function polo_woo_show_product_perpage() {
	$per_page = reactor_option( 'woo_shop_items' );

	if ( isset( $_REQUEST['per_page'] ) ) {
		$woo_per_page = $_REQUEST['per_page'];
	} elseif ( ! isset( $_REQUEST['per_page'] ) && isset( $_COOKIE['per_page'] ) ) {
		$woo_per_page = $_COOKIE['per_page'];
	} else {
		$woo_per_page = $per_page;
	}

	$args = array(
		'post_type'      => 'product',
		'posts_per_page' => - 1
	);

	$prod       = new WP_Query( $args );
	$prod_count = count( $prod->posts );
	wp_reset_query();

	$limit = intval( $prod_count / intval( $per_page ) ) + 1;

	?>
	<p><?php printf( esc_html__( 'Showing %s items per page', 'polo' ), $woo_per_page ); ?></p>
	<form class="woocommerce-ordering" method="post">
		<select name="per_page" class="per_page" onchange="this.form.submit()">
			<?php
			$x = 1;
			while ( $x <= $limit ) {
				$value    = $per_page * $x;
				$selected = selected( $woo_per_page, $value, false );
				$label = esc_html__('Display ','polo').$value.esc_html__(' Products Per Page','polo');
				echo "<option value='{$value}' {$selected}>{$label}</option>";
				$x ++;
			}
			?>
		</select>
	</form>
	<?php
}

// Products per page
function polo_woo_products_per_page() {
	$per_page = '9';
	if ( isset( $_COOKIE['per_page'] ) ) {
		$per_page = $_COOKIE['per_page'];
	}
	if ( isset( $_POST['per_page'] ) ) {
		setcookie( 'per_page', $_POST['per_page'], time() + 1209600, '/' );
		$per_page = $_POST['per_page'];
	}

	return $per_page;
}

add_action( 'polo_woo_product_additional_filter', 'polo_woo_show_product_perpage', 5 );

add_filter( 'loop_shop_per_page', 'polo_woo_products_per_page', 9 );