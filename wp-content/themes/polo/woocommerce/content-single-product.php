<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see           http://docs.woothemes.com/document/template-structure/
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php
/**
 * woocommerce_before_single_product hook.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form();

	return;
}

$layout = get_query_var( 'layout' );

if ( '2c-b-fixed' === $layout ) {
	$image_width = $description_width = '12';
} else {
	$image_width       = '5';
	$description_width = '7';
}
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">
		<div class="col-md-<?php echo esc_attr( $image_width ); ?>">
			<?php
			/**
			 * woocommerce_before_single_product_summary hook.
			 *
			 * @hooked woocommerce_show_product_sale_flash - 10
			 * @hooked woocommerce_show_product_images - 20
			 */
			do_action( 'woocommerce_before_single_product_summary' );
			?>
		</div><!--col-md-5-->
		<div class="col-md-<?php echo esc_attr( $description_width ); ?>">
			<div class="entry-summary">
				<div class="product-description">
					<?php
					/**
					 * polo_woo_product_summary hook.
					 *
					 * @hooked polo_woo_product_summary - 5
					 * @hooked polo_woo_product_title - 10
					 * @hooked polo_woo_product_price - 15
					 * @hooked polo_woo_product_rating - 20
					 * @hooked polo_woo_product_excerpt - 30
					 * @hooked polo_woo_product_tags - 40
					 */
					do_action( 'polo_woo_product_summary' );
					?>
				</div><!--product-description-->

			</div><!-- .summary -->
		</div><!--col-md-7-->


		<meta itemprop="url" content="<?php the_permalink(); ?>" />
	</div><!--row-->

	<div class="row m-t-40">

		<?php
		/**
		 * woocommerce_after_single_product_summary hook.
		 *
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
		?>

	</div><!--row m-t-40-->

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
