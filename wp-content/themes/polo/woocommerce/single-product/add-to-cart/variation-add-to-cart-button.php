<?php
/**
 * Single variation cart button
 *
 * @see 	http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>
<div class="woocommerce-variation-add-to-cart variations_button">
	<div class="m-t-10">
		<h6><?php esc_html_e('Select quantity','polo');?></h6>
			<div class="cart-product-quantity">
		<?php if ( ! $product->is_sold_individually() ) : ?>
		<?php
			$quantity = polo_single_product_quantity( array( 'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 ),null,false );
			$quantity = str_replace('class="quantity','class="quantity m-l-5',$quantity);

			echo apply_filters('polo_variable_product_quantity',$quantity);
		?>
		<?php endif; ?>
			</div><!--cart-product-quantity-->
	</div><!--m-t-10-->
	<div class="m-t-20">

		<button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-shopping-cart"></i> <?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

	</div><!--m-t-20-->


	<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->id ); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint( $product->id ); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />
</div>
