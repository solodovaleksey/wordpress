<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see           http://docs.woothemes.com/document/template-structure/
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices(); ?>

<div class="shop-cart">

	<div class="row">
		<?php do_action( 'woocommerce_before_checkout_form', $checkout );

		// If checkout registration is disabled and not logged in, the user cannot checkout
		if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
			echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', esc_html__( 'You must be logged in to checkout.', 'polo' ) );

			return;
		}
		?>
	</div>

	<form name="checkout" method="post" class="checkout woocommerce-checkout sep-top-md" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

		<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

			<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

			<div class="row" id="customer_details">
				<div class="col-md-6 no-padding">
					<?php do_action( 'woocommerce_checkout_billing' ); ?>
				</div>

				<div class="col-md-6">
					<?php do_action( 'woocommerce_checkout_shipping' ); ?>
				</div>
			</div>

			<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

		<?php endif; ?>

		<div class="seperator"><i class="fa fa-credit-card"></i>
		</div

		<div id="order_review" class="woocommerce-checkout-review-order">
			<div class="row">

				<div class="col-md-6">

					<h4 class="upper"><?php esc_html_e( 'Your Order', 'polo' ); ?></h4>

					<?php woocommerce_order_review(); ?>

				</div>

				<div class="col-md-6">

					<h4 class="upper"><?php esc_html_e( 'Payment Method', 'polo' ); ?></h4>

					<?php woocommerce_checkout_payment(); ?>

				</div>

			</div>

		</div>

	</form>

</div><!--shop-cart-->

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
