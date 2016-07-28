<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) :

	wp_enqueue_script('crum-boostrap-tabs');
	?>

	<!--<div class="woocommerce-tabs wc-tabs-wrapper">-->
		<ul class="nav nav-tabs">
			<?php $j = 0;?>
			<?php foreach ( $tabs as $key => $tab ) : ?>
				<?php if(0 === $j){
					$active = 'active';
				}else{
					$active = '';
				}
				?>
				<li>
					<a href="#tab<?php echo esc_attr( $key ); ?>" data-toggle="tab"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
				</li>
				<?php $j++;?>
			<?php endforeach; ?>
		</ul>
		<div class="tab-content">
		<?php $i = 0;?>
		<?php foreach ( $tabs as $key => $tab ) : ?>
			<?php if(0 === $i){
				$active = 'active';
			}else{
				$active = '';
			}
			?>
			<div class="tab-pane <?php echo esc_attr($active);?>" id="tab<?php echo esc_attr( $key ); ?>">
				<?php call_user_func( $tab['callback'], $key, $tab ); ?>
			</div>
			<?php $i++;?>
		<?php endforeach; ?>
		</div><!--tab-content-->
	<!--</div>-->

<?php endif; ?>