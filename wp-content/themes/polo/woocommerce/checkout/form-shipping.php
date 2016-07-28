<?php
/**
 * Checkout shipping information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-shipping.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="woocommerce-shipping-fields">
	<?php if ( true === WC()->cart->needs_shipping_address() ) : ?>

		<?php
		if ( empty( $_POST ) ) {

			$ship_to_different_address = get_option( 'woocommerce_ship_to_destination' ) === 'shipping' ? 1 : 0;
			$ship_to_different_address = apply_filters( 'woocommerce_ship_to_different_address_checked', $ship_to_different_address );

		} else {

			$ship_to_different_address = $checkout->get_value( 'ship_to_different_address' );

		}
		?>

		<h4 id="ship-to-different-address" class="upper">
			<a href="#collapseFour" data-toggle="collapse" class="collapsed" aria-expanded="false">
				<?php esc_html_e( 'Ship to a different address?', 'polo' ); ?>
				<i class="fa fa-arrow-circle-o-down"></i>
			</a>
		</h4>


		<div class="col-md-12 no-padding">
			<div style="height: 0px;" aria-expanded="false" id="collapseFour" class="panel-collapse row collapse">

				<div class="panel-body">

					<p><?php esc_html_e( 'If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing & Shipping section.', 'polo' ) ?></p>

					<div class="sep-top-xs">

						<div class="row">

							<?php do_action( 'woocommerce_before_checkout_shipping_form', $checkout ); ?>

							<?php
							$shipping_fields = array();
							$checkout_order  = array(
								'shipping_country',
								'shipping_first_name',
								'shipping_last_name',
								'shipping_company',
								'shipping_address_1',
								'shipping_address_2',
								'shipping_city',
								'shipping_state',
								'shipping_postcode',
								'shipping_email',
								'shipping_phone',
							);
							foreach ( $checkout_order as $single_field_name ) {
								$shipping_fields[ $single_field_name ] = $checkout->checkout_fields['shipping'][ $single_field_name ];
								if ( 'shipping_first_name' === $single_field_name ) {
									$shipping_fields[ $single_field_name ]['placeholder'] = esc_html__( 'First Name', 'polo' );
								} elseif ( 'shipping_last_name' === $single_field_name ) {
									$shipping_fields[ $single_field_name ]['placeholder'] = esc_html__( 'Last Name', 'polo' );
								} elseif ( 'shipping_company' === $single_field_name ) {
									$shipping_fields[ $single_field_name ]['placeholder'] = esc_html__( 'Company Name', 'polo' );
								} elseif ( 'shipping_address_1' === $single_field_name ) {
									$shipping_fields[ $single_field_name ]['placeholder'] = esc_html__( 'Address', 'polo' );
								} elseif ( 'shipping_address_2' === $single_field_name ) {
									$shipping_fields[ $single_field_name ]['placeholder'] = esc_html__( 'Apartment, suite, unit etc.', 'polo' );
								} elseif ( 'shipping_city' === $single_field_name ) {
									$shipping_fields[ $single_field_name ]['placeholder'] = esc_html__( 'Town / City', 'polo' );
								} elseif ( 'shipping_state' === $single_field_name ) {
									$shipping_fields[ $single_field_name ]['placeholder'] = esc_html__( 'State / County', 'polo' );
								} elseif ( 'shipping_postcode' === $single_field_name ) {
									$shipping_fields[ $single_field_name ]['placeholder'] = esc_html__( 'Postcode / Zip', 'polo' );
								} elseif ( 'shipping_email' === $single_field_name ) {
									$shipping_fields[ $single_field_name ]['placeholder'] = esc_html__( 'Email', 'polo' );
								} elseif ( 'shipping_phone' === $single_field_name ) {
									$shipping_fields[ $single_field_name ]['placeholder'] = esc_html__( 'Phone', 'polo' );
								}

							}

							?>

							<?php foreach ( $shipping_fields as $key => $field ) : ?>

								<?php

								if ( 'shipping_country' === $key || 'shipping_address_1' === $key || 'shipping_company' === $key ) {
									$width_class = '12';
								} else {
									$width_class = '6';
								}

								$field['return'] = true;
								$field['label']  = '';

								?>
								<div class="col-md-<?php echo esc_attr( $width_class ); ?> form-group">
									<?php
									$shipping_field = woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
									$shipping_field = str_replace( 'input-text', 'input-text form-control input-lg', $shipping_field );
									$shipping_field = str_replace( 'select2-container ', 'select2-container  fullwidth', $shipping_field );

									echo apply_filters( 'polo_woo_shipping_field', $shipping_field );
									?>
								</div>
							<?php endforeach; ?>

							<?php do_action( 'woocommerce_after_checkout_shipping_form', $checkout ); ?>

						</div><!--row-->

					</div><!--sep-top-xs-->

				</div><!--panel-body-->

			</div><!--collapseFour-->
		</div><!--col-md-12 no-padding-->

	<?php endif; ?>

	<div class="col-md-12 no-padding">

		<?php do_action( 'woocommerce_before_order_notes', $checkout ); ?>

		<?php if ( apply_filters( 'woocommerce_enable_order_notes_field', get_option( 'woocommerce_enable_order_comments', 'yes' ) === 'yes' ) ) : ?>

			<?php if ( ! WC()->cart->needs_shipping() || wc_ship_to_billing_address_only() ) : ?>

				<h3><?php esc_html_e( 'Additional Information', 'polo' ); ?></h3>

			<?php endif; ?>

			<?php foreach ( $checkout->checkout_fields['order'] as $key => $field ) : ?>

				<?php
				$field['label']   = '';
				$field['class'][] = 'form-control input-lg';
				if ( 'order_comments' === $key ) {
					$field['return'] = true;
				}
				?>

				<?php
				if ( 'order_comments' === $key ) {
					$order_comments = woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
					$order_comments = str_replace( 'rows="2"', 'rows="7"', $order_comments );
					echo apply_filters( 'polo_shiping_order_comments', $order_comments );
				} else {
					woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
				}
				?>

			<?php endforeach; ?>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_order_notes', $checkout ); ?>

	</div>
</div>
