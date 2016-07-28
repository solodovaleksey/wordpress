<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.1.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/** @global WC_Checkout $checkout */

?>
<div class="woocommerce-billing-fields">
	<div class="col-md-12">
		<?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

			<h4 class="upper"><?php esc_html_e( 'Billing &amp; Shipping', 'polo' ); ?></h4>

		<?php else : ?>

			<h4 class="upper"><?php esc_html_e( 'Billing Details', 'polo' ); ?></h4>

		<?php endif; ?>
	</div>
	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

	<?php
	$checkout_fields = array();
	$checkout_order  = array(
		'billing_country',
		'billing_first_name',
		'billing_last_name',
		'billing_company',
		'billing_address_1',
		'billing_address_2',
		'billing_city',
		'billing_state',
		'billing_postcode',
		'billing_email',
		'billing_phone',
	);
	foreach ( $checkout_order as $single_field_name ) {
		$checkout_fields[ $single_field_name ] = $checkout->checkout_fields['billing'][ $single_field_name ];
		if ( 'billing_first_name' === $single_field_name ) {
			$checkout_fields[ $single_field_name ]['placeholder'] = esc_html__( 'First Name', 'polo' );
		} elseif ( 'billing_last_name' === $single_field_name ) {
			$checkout_fields[ $single_field_name ]['placeholder'] = esc_html__( 'Last Name', 'polo' );
		} elseif ( 'billing_company' === $single_field_name ) {
			$checkout_fields[ $single_field_name ]['placeholder'] = esc_html__( 'Company Name', 'polo' );
		} elseif ( 'billing_address_1' === $single_field_name ) {
			$checkout_fields[ $single_field_name ]['placeholder'] = esc_html__( 'Address', 'polo' );
		} elseif ( 'billing_address_2' === $single_field_name ) {
			$checkout_fields[ $single_field_name ]['placeholder'] = esc_html__( 'Apartment, suite, unit etc.', 'polo' );
		} elseif ( 'billing_city' === $single_field_name ) {
			$checkout_fields[ $single_field_name ]['placeholder'] = esc_html__( 'Town / City', 'polo' );
		} elseif ( 'billing_state' === $single_field_name ) {
			$checkout_fields[ $single_field_name ]['placeholder'] = esc_html__( 'State / County', 'polo' );
		} elseif ( 'billing_postcode' === $single_field_name ) {
			$checkout_fields[ $single_field_name ]['placeholder'] = esc_html__( 'Postcode / Zip', 'polo' );
		} elseif ( 'billing_email' === $single_field_name ) {
			$checkout_fields[ $single_field_name ]['placeholder'] = esc_html__( 'Email', 'polo' );
		} elseif ( 'billing_phone' === $single_field_name ) {
			$checkout_fields[ $single_field_name ]['placeholder'] = esc_html__( 'Phone', 'polo' );
		}

	}

	?>
	<?php foreach ( $checkout_fields as $key => $field ) : ?>

		<?php

		if ( 'billing_country' === $key || 'billing_address_1' === $key || 'billing_company' === $key ) {
			$width_class = '12';
		} else {
			$width_class = '6';
		}

		$field['return'] = true;
		$field['label']  = '';

		?>

		<div class="col-md-<?php echo esc_attr( $width_class ); ?> form-group">
			<?php
			$form_field = woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
			$form_field = str_replace( 'input-text', 'input-text form-control input-lg', $form_field );
			$form_field = str_replace( 'select2-container ', 'select2-container  fullwidth', $form_field );

			echo apply_filters( 'polo_woo_checkout_field', $form_field );
			?>
		</div>
	<?php endforeach; ?>

	<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>

	<?php if ( ! is_user_logged_in() && $checkout->enable_signup ) : ?>

		<?php if ( $checkout->enable_guest_checkout ) : ?>

			<p class="form-row form-row-wide create-account">
				<input class="input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ) ?> type="checkbox" name="createaccount" value="1" />
				<label for="createaccount" class="checkbox"><?php esc_html_e( 'Create an account?', 'polo' ); ?></label>
			</p>

		<?php endif; ?>

		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

		<?php if ( ! empty( $checkout->checkout_fields['account'] ) ) : ?>

			<div class="create-account">

				<p><?php esc_html_e( 'Create an account by entering the information below. If you are a returning customer please login at the top of the page.', 'polo' ); ?></p>

				<?php foreach ( $checkout->checkout_fields['account'] as $key => $field ) : ?>

					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

				<?php endforeach; ?>

				<div class="clear"></div>

			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>

	<?php endif; ?>
</div>
