<?php

/**
 * Comments
 * in single.php
 *
 * @since 1.0.0
 */
function polo_do_post_comments() {
	// If comments are open or we have at least one comment, load up the comment template
	if ( comments_open() && is_singular() && ! ( is_page() ) ) {
		comments_template();
	}
}

add_action( 'polo_post_after', 'polo_do_post_comments', 10 );

/**
 * Comments
 * in page.php
 *
 * @since 1.0.0
 */
function polo_do_page_comments() {
	// If comments are open or we have at least one comment, load up the comment template
	if ( comments_open(get_the_ID()) && is_singular('page') ) {
		comments_template();
	}
}

add_action( 'polo_inner_content_after', 'polo_do_page_comments', 10 );