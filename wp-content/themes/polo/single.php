<?php
/*
 *Template for single post display
 */
?>

<?php
$inner_pagination = reactor_option( 'inner_pagination' );
?>

<?php get_header(); ?>

<?php polo_content_before(); ?>

<section class="content">

	<div class="container">

		<?php polo_set_layout( 'single-main-sidebar', 'single-sidebar-width', true ); ?>

		<?php polo_post_before(); ?>

		<div class="post-item">

			<?php polo_inner_content_before(); ?>

			<?php echo polo_do_post_feature( get_the_ID() ); ?>

			<div class="post-content-details">

				<div class="post-title"><h2><?php the_title(); ?></h2></div>

				<?php echo polo_post_info(); ?>

				<div class="post-description">
					<?php
					while ( have_posts() ) : the_post();

						the_content();

						if ( 'prev_next' === $inner_pagination ) {
							$pagination_class = 'pager';
						} else {
							$pagination_class = 'pagination pagination-simple';
						}

						$args = array(
							'before' => '<div class="text-center"><ul class="' . $pagination_class . '">',
							'after'  => '</ul></div>',
						);

						if ( 'prev_next' === $inner_pagination ) {
							$args['next_or_number'] = 'next';
						} else {
							$args['next_or_number'] = 'number';
						}

						wp_link_pages( $args );

					endwhile;
					?>
				</div>
				<!--post-description-->

				<?php polo_post_tags();?>

			</div>
			<!--post-content-details-->

			<?php echo polo_post_meta(); ?>

			<?php polo_inner_content_after(); ?>

		</div>
		<!--post-item-->

		<?php polo_post_after(); ?>

		<?php polo_set_layout( 'single-main-sidebar', 'single-sidebar-width', false ); ?>

	</div>
	<!--.content-->

</section><!--.content-->

<?php polo_content_after(); ?>

<?php get_footer(); ?>
