<?php
/**
 * Crumina Paginate Links
 */

if ( ! function_exists( 'polo_page_links' ) ) {
	function polo_page_links( $args = '' ) {
		do_action( 'polo_page_links', $args );

		$defaults = array(
			'query' => 'wp_query',
			'type'  => 'pagination',
		);
		$args     = wp_parse_args( $args, $defaults );

		global $wp_rewrite;
		if ( ! ( 'wp_query' === $args['query'] ) ) {
			global ${$args['query']};
		} else {
			global $wp_query;
		}
		$output = '';

		$the_query = ( isset( $args['query'] ) ) ? ${$args['query']} : $wp_query;

		$pagination_base = $wp_rewrite->pagination_base;

		/* If there's not more than one page, return nothing. */
		if ( 1 >= $the_query->max_num_pages ) {
			return;
		}

		$meta_blog_style = reactor_option( 'blog_style', '', 'meta_news_page_options' );

		/**
		 * Previous Next Links
		 *
		 * @since 1.0.0
		 */
		if ( 'pager' == $args['type'] ) {

			if ( is_page_template( 'page-templates/portfolio-page.php' ) ) {
				$pager_style = polo_get_theme_settings( 'portfolio_pager_style', 'pager_style', 'meta_portfolio_page_options' );

				$pager_fullwidth      = reactor_option( 'portfolio_pager_fullwidth' );
				$meta_pager_fullwidth = polo_metaselect_to_switch( reactor_option( 'pager_fullwidth', '', 'meta_portfolio_page_options' ) );
				if ( ! ( null === $meta_pager_fullwidth ) && ! ( 'default' === $meta_blog_style ) ) {
					$pager_fullwidth = $meta_pager_fullwidth;
				}
			} else {
				if ( is_page_template( 'page-templates/portfolio-page-side.php' ) ) {
					$pager_style      = reactor_option( 'pager_style', 'default' );
					$meta_pager_style = reactor_option( 'pager_style', '', 'meta_portfolio_page_panel_options' );
					if ( isset( $meta_pager_style ) & ! empty( $meta_pager_style ) && ! ( 'default' === $meta_blog_style ) ) {
						$pager_style = $meta_pager_style;
					}

					$pager_fullwidth      = reactor_option( 'pager_fullwidth' );
					$meta_pager_fullwidth = polo_metaselect_to_switch( reactor_option( 'pager_fullwidth', '', 'meta_portfolio_page_panel_options' ) );
					if ( ! ( null === $meta_pager_fullwidth ) && ! ( 'default' === $meta_blog_style ) ) {
						$pager_fullwidth = $meta_pager_fullwidth;
					}
				} else {
					$pager_style      = reactor_option( 'pager_style', 'default' );
					$meta_pager_style = reactor_option( 'pager_style', '', 'meta_news_page_options' );
					if ( isset( $meta_pager_style ) & ! empty( $meta_pager_style ) && ! ( 'default' === $meta_blog_style ) ) {
						$pager_style = $meta_pager_style;
					}

					$pager_fullwidth      = reactor_option( 'pager_fullwidth' );
					$meta_pager_fullwidth = polo_metaselect_to_switch( reactor_option( 'pager_fullwidth', '', 'meta_news_page_options' ) );
					if ( ! ( null === $meta_pager_fullwidth ) && ! ( 'default' === $meta_blog_style ) ) {
						$pager_fullwidth = $meta_pager_fullwidth;
					}
				}
			}


			$class = array();

			$class[] = 'pager';

			if ( 'modern' === $pager_style ) {
				$class[] = 'pager-modern text-center';
			} elseif ( 'fancy' === $pager_style ) {
				$class[] = 'pager-fancy';
			}

			$class = implode( ' ', $class );


			if ( 'modern' === $pager_style ) {
				$output .= '<div class="' . $class . '">';
				$next_link = get_next_posts_link( '<span>' . esc_html__( 'Next', 'polo' ) . '<i class="fa fa-chevron-right"></i></span>', $the_query->max_num_pages );
				$prev_link = get_previous_posts_link( '<span><i class="fa fa-chevron-left"></i>' . esc_html__( 'Previous', 'polo' ) . '</span>' );
				$home_link = get_home_url();
				if ( isset( $prev_link ) && ! empty( $prev_link ) ) {
					$output .= str_replace( '<a', '<a class="pager-prev"', $prev_link );
				} else {
					$output .= '<a class="pager-prev disabled" href="#"><span><i class="fa fa-chevron-left"></i>' . esc_html__( 'Previous', 'polo' ) . '</span></a>';
				}
				$output .= '<a class="pager-all" href="' . esc_url( $home_link ) . '"><span><i class="fa fa-th"></i></span></a>';
				if ( isset( $next_link ) && ! empty( $next_link ) ) {
					$output .= str_replace( '<a', '<a class="pager-next"', $next_link );
				} else {
					$output .= '<a class="pager-next disabled" href="#"><span>' . esc_html__( 'Next', 'polo' ) . '<i class="fa fa-chevron-right"></i></span></a>';
				}
				$output .= '</div>';
			} else {
				$output .= '<ul class="' . $class . '">';
				if ( true === $pager_fullwidth ) {
					if ( 'fancy' === $pager_style ) {
						$prev_icon = '<i class="fa fa-angle-left"></i>';
						$next_icon = '<i class="fa fa-angle-right"></i>';
					} else {
						$prev_icon = '<span aria-hidden="true">&larr;</span>';
						$next_icon = '<span aria-hidden="true">&rarr;</span>';
					}
					$next_link = get_next_posts_link( esc_html__( 'Newer', 'polo' ) . ' ' . $next_icon, $the_query->max_num_pages );
					$prev_link = get_previous_posts_link( $prev_icon . ' ' . esc_html__( 'Older', 'polo' ) );
					if ( isset( $prev_link ) && ! empty( $prev_link ) ) {
						$output .= '<li class="previous">' . $prev_link . '</li>';
					} else {
						$output .= '<li class="previous disabled"><a href="#">' . $prev_icon . esc_html__( ' Older', 'polo' ) . '</a></li>';
					}
					if ( isset( $next_link ) && ! empty( $next_link ) ) {
						$output .= '<li class="next">' . $next_link . '</li>';
					} else {
						$output .= '<li class="next disabled"><a href="#">' . esc_html__( 'Newer', 'polo' ) . $next_icon . '<i class="fa fa-angle-right"></i></a></li>';
					}
				} else {
					$next_link = get_next_posts_link( esc_html__( 'Next', 'polo' ), $the_query->max_num_pages );
					$prev_link = get_previous_posts_link( esc_html__( 'Previous', 'polo' ) . ' ' );
					if ( isset( $prev_link ) && ! empty( $prev_link ) ) {
						$output .= '<li>' . $prev_link . '</li>';
					} else {
						$output .= '<li class="disabled"><a href="#">' . esc_html__( 'Previous ', 'polo' ) . '</a></li>';
					}
					if ( isset( $next_link ) && ! empty( $next_link ) ) {
						$output .= '<li>' . $next_link . '</li>';
					} else {
						$output .= '<li class="disabled"><a href="#">' . esc_html__( 'Next', 'polo' ) . '</a></li>';
					}
				}
				$output .= '</ul>';
			}


		} elseif ( 'load_more' == $args['type'] ) {

			$max_num_pages = $the_query->max_num_pages;
			$paged         = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;

			wp_localize_script(
				'crum-ajax-pagination',
				'crum_pagination_data',
				array(
					'startPage'   => $paged,
					'maxPages'    => $max_num_pages,
					'nextLink'    => next_posts( $max_num_pages, false ),
					'container'   => '#news-page',
					'loaded_text' => esc_html__( 'The End', 'polo' )
				)
			);

			$output .= '<div class="text-center"><a id="ajax-pagination-load-more" class="button border rounded" href="#ajax-pagination-load-more"><span>' . esc_html__( 'Load more', 'polo' ) . '</span></a></div><!--// end .pagination -->';

			wp_enqueue_script( 'crum-ajax-pagination' );

		} else {

			/**
			 * Numbered Pagination
			 *
			 * @link  http://codex.wordpress.org/Function_Reference/paginate_links
			 * @see   paginate_links
			 * @since 1.0.0
			 */
			if ( is_page_template( 'page-templates/portfolio-page.php' ) ) {
				$pagination_style = polo_get_theme_settings( 'portfolio_pagination_style', 'pagination_style', 'meta_portfolio_page_options' );
			} elseif ( is_page_template( 'page-templates/portfolio-page-side.php' ) ) {
				$pagination_style = polo_get_theme_settings( 'pagination_style', 'pagination_style', 'meta_portfolio_page_panel_options' );
			} else {
				$pagination_style = polo_get_theme_settings( 'pagination_style', 'pagination_style', 'meta_news_page_options' );
			}

			if ( is_page_template( 'page-templates/shop-page.php' ) ) {
				$pagination_style = 'default';
			}

			if ( 'simple' === $pagination_style ) {
				$pagination_class = 'pagination-simple';
			} elseif ( 'rounded' === $pagination_style ) {
				$pagination_class = 'pagination-rounded';
			} elseif ( 'fancy' === $pagination_style ) {
				$pagination_class = 'pagination-fancy';
			} else {
				$pagination_class = '';
			}

			$end_size = $mid_size = $add_args = $prev_next = $format = $add_fragment = $prev_text = $show_all = $next_text = '';

			$big     = 999999999; // need an unlikely integer
			$count   = 0;
			$base    = str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) );
			$total   = $the_query->max_num_pages;
			$current = max( 1, get_query_var( 'paged' ) );

			$defaults = array(
				'base'         => $base,
				'format'       => '?page=%#%',
				'total'        => $total,
				'current'      => $current,
				'show_all'     => false,
				'prev_next'    => true,
				'prev_text'    => '<span aria-hidden="true"><i class="fa fa-angle-left"></i></span>',
				'next_text'    => '<span aria-hidden="true"><i class="fa fa-angle-right"></i></span>',
				'end_size'     => 2,
				'mid_size'     => 3,
				'add_args'     => false,
				'add_fragment' => ''
			);

			$args = wp_parse_args( $args, $defaults );
			extract( $args );

			// Who knows what else people pass in $args
			$total = (int) $total;
			if ( $total < 2 ) {
				return;
			}
			$current    = (int) $current;
			$end_size   = 0 < (int) $end_size ? (int) $end_size : 1; // Out of bounds?  Make it the default.
			$mid_size   = 0 <= (int) $mid_size ? (int) $mid_size : 2;
			$add_args   = is_array( $add_args ) ? $add_args : false;
			$r          = '';
			$page_links = array();
			$n          = 0;
			$dots       = false;

			$output = "<div class='text-center'><div class='pagination-wrap'><ul class='pagination " . $pagination_class . "'>";

			if ( $prev_next && $current && 1 < $current ) :
				$link = str_replace( '%_%', 2 == $current ? '' : $format, $base );
				$link = str_replace( '%#%', $current - 1, $link );
				if ( $add_args ) {
					$link = add_query_arg( $add_args, $link );
				}
				$link .= $add_fragment;
				$page_links[] = '<li><a aria-label="Previous" href="' . esc_url( $link ) . '">' . $prev_text . '</a></li>';
			endif;
			for ( $n = 1; $n <= $total; $n ++ ) :
				$n_display = number_format_i18n( $n );
				if ( $n == $current ) :
					$page_links[] = "<li class='active'><a href='#'>$n_display</a></li>";
					$dots         = true;
				else :
					if ( $show_all || ( $n <= $end_size || ( $current && $n >= $current - $mid_size && $n <= $current + $mid_size ) || $n > $total - $end_size ) ) :
						$link = str_replace( '%_%', 1 == $n ? '' : $format, $base );
						$link = str_replace( '%#%', $n, $link );
						if ( $add_args ) {
							$link = add_query_arg( $add_args, $link );
						}
						$link .= $add_fragment;
						$page_links[] = '<li><a href="' . esc_url( $link ) . '">' . $n_display . '</a></li>';
						$dots         = true;
					elseif ( $dots && ! $show_all ) :
						$page_links[] = '<li><a class="dots"><i class="fa fa-ellipsis-h"></i></a></li>';
						$dots         = false;
					endif;
				endif;
			endfor;
			if ( $prev_next && $current && ( $current < $total || - 1 == $total ) ) :
				$link = str_replace( '%_%', $format, $base );
				$link = str_replace( '%#%', $current + 1, $link );
				if ( $add_args ) {
					$link = add_query_arg( $add_args, $link );
				}
				$link .= $add_fragment;
				$page_links[] = '<li><a aria-label="Next" href="' . esc_url( $link ) . '">' . $next_text . '</a></li>';
			endif;

			$output .= join( "\n", $page_links );
			$output .= "</ul></div></div>";
		}

		echo apply_filters( 'polo_paginate_links', $output );
	}
}