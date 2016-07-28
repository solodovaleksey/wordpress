<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.3.8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<div class="shop-cart">


	<form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

		<?php do_action( 'woocommerce_before_cart_table' ); ?>
		<div class="table table-condensed table-striped clearfix">
			<table class="table" cellspacing="0">
				<thead>
				<tr>
					<th class="cart-product-remove">&nbsp;</th>
					<th class="cart-product-thumbnail"><?php esc_html_e( 'Product', 'polo' ); ?></th>
					<th class="cart-product-description"><?php esc_html_e( 'Description', 'polo' ); ?></th>
					<th class="cart-product-price"><?php esc_html_e( 'Unit Price', 'polo' ); ?></th>
					<th class="cart-product-quantity"><?php esc_html_e( 'Quantity', 'polo' ); ?></th>
					<th class="cart-product-subtotal"><?php esc_html_e( 'Total', 'polo' ); ?></th>
				</tr>
				</thead>
				<tbody>
				<?php do_action( 'woocommerce_before_cart_contents' ); ?>

				<?php
				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						?>
						<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

							<td class="cart-product-remove">
								<?php
								echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
									'<a href="%s" class="" title="%s" data-product_id="%s" data-product_sku="%s"><i class="fa fa-close"></i></a>',
									esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
									esc_html__( 'Remove this item', 'polo' ),
									esc_attr( $product_id ),
									esc_attr( $_product->get_sku() )
								), $cart_item_key );
								?>
							</td>

							<td class="cart-product-thumbnail">
								<?php
								$thumbnail = '<img src="'.esc_url(polo_do_small_image($product_id,array('width' => '380','height' => '507'))).'">';

								if ( ! $_product->is_visible() ) {
									echo ($thumbnail);
								} else {
									printf( '<a href="%s">%s</a>', esc_url( $_product->get_permalink( $cart_item ) ), $thumbnail );
								}
								?>
								<div class="cart-product-thumbnail-name">
									<?php echo esc_attr( get_the_title( $product_id ) ); ?>
								</div><!--cart-product-thumbnail-name-->
							</td>

							<td class="cart-product-description" data-title="<?php esc_html_e( 'Product', 'polo' ); ?>">
								<p>
									<span>
								<?php
								//if ( ! $_product->is_visible() ) {
									echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
								/*} else {
									echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $_product->get_permalink( $cart_item ) ), $_product->get_title() ), $cart_item, $cart_item_key );
								}*/ ?>

								</span>

									<?php
									echo WC()->cart->get_item_data( $cart_item );

									// Backorder notification
									if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
										echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'polo' ) . '</p>';
									}
									?>
								</p>
							</td>

							<td class="cart-product-price" data-title="<?php esc_html_e( 'Price', 'polo' ); ?>">
								<?php
								echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
								?>
							</td>

							<td class="cart-product-quantity" data-title="<?php esc_html_e( 'Quantity', 'polo' ); ?>">
								<?php
								if ( $_product->is_sold_individually() ) {
									$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
								} else {
									$product_quantity = polo_single_product_quantity( array(
										'input_name'  => "cart[{$cart_item_key}][qty]",
										'input_value' => $cart_item['quantity'],
										'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
										'min_value'   => '0'
									), $_product, false );
								}

								echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
								?>
							</td>

							<td class="cart-product-subtotal" data-title="<?php esc_html_e( 'Total', 'polo' ); ?>">
								<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
								?>
							</td>
						</tr>
						<?php
					}
				}

				do_action( 'woocommerce_cart_contents' );
				?>

				<?php do_action( 'woocommerce_after_cart_contents' ); ?>
				</tbody>
			</table>

			<div class="row">

				<div class="col-md-4">
					<?php if ( wc_coupons_enabled() ) { ?>
						<div class="form-inline">
							<div class="form-group">
								<input type="text" name="coupon_code" class="input-text form-control" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'polo' ); ?>" />
								<input type="submit" class="button border empty-card-button" name="apply_coupon" value="<?php esc_attr_e( 'Apply', 'polo' ); ?>" />
								<p class="small"><?php esc_html_e( 'Enter any valid coupon or promo code here to redeem your discount.', 'polo' ) ?></p>
							</div><!--form-group-->
						</div><!--form-inline-->

						<?php do_action( 'woocommerce_cart_coupon' ); ?>

					<?php } ?>
				</div><!--col-md-4-->

				<div class="col-md-8 text-right">
					<input type="submit" class="button color button-3d rounded icon-left empty-card-button" name="update_cart" value="<?php esc_attr_e( 'Update Cart', 'polo' ); ?>" />
				</div><!--col-md-8 text-right-->

				<?php do_action( 'woocommerce_cart_actions' ); ?>

				<?php wp_nonce_field( 'woocommerce-cart' ); ?>

			</div>

			<div class="row">
			</div>

			<?php do_action( 'woocommerce_after_cart_table' ); ?>
		</div><!--table table-condensed table-striped table-responsive-->
	</form>

	<div class="row">

		<hr class="space">

		<?php do_action( 'woocommerce_cart_collaterals' ); ?>

	</div><!--row-->

</div><!--shop-cart-->

<?php do_action( 'woocommerce_after_cart' ); ?>
