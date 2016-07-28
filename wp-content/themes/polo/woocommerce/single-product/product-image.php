<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see           http://docs.woothemes.com/document/template-structure/
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;

$attachment_ids = $product->get_gallery_attachment_ids();

?>

	<div class="product-image">

		<?php
		if ( has_post_thumbnail()  ) {
			$output = '';
			$product_thumbnail          = wp_get_attachment_url( get_post_thumbnail_id() );
			?>

			<?php if(! empty( $attachment_ids )){
			$output .= '<div class="carousel" data-carousel-col="1" data-lightbox-type="gallery">';

				$output .= '<a href="'.esc_url($product_thumbnail).'" title="'.esc_html__('Shop product image!','polo').'" data-lightbox="gallery-item"><img alt="'.esc_html__('Shop product image!','polo').'" src="'.esc_url(polo_theme_thumb($product_thumbnail,'380','507',true)).'"></a>';

				foreach ( $attachment_ids as $single_gallery_image ) {
					$image_link = wp_get_attachment_url( $single_gallery_image );
					$output .= '<a href="'.esc_url($image_link).'" class="popup-hide" title="'.esc_html__('Shop product image!','polo').'" data-lightbox="gallery-item"><img alt="'.esc_html__('Shop product image!','polo').'" src="'.esc_url(polo_theme_thumb($image_link,'380','507',true)).'"></a>';
				}

			$output .= '</div><!--carousel-->';
			}else{

				$output .= '<img src="'.esc_url(polo_theme_thumb($product_thumbnail,'380','507',true)).'" alt="'.esc_attr(get_the_title($product->id)).'">';

			}?>

			<?php echo apply_filters( 'woocommerce_single_product_image_html', $output, $post->ID );?>

		<?php } else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'polo' ) ), $post->ID );

		}
		?>

	</div><!--product-image-->