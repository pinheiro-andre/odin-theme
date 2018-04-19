<?php
/**
 * Custom template tags for Odin.
 *
 * @package Odin
 * @since 2.2.0
 */

if ( ! function_exists( 'odin_classes_page_full' ) ) {

	/**
	 * Classes page full.
	 *
	 * @since 2.2.0
	 *
	 * @return string Classes name.
	 */
	function odin_classes_page_full() {
		return 'col-md-12';
	}
}

if ( ! function_exists( 'odin_classes_page_sidebar' ) ) {

	/**
	 * Classes page with sidebar.
	 *
	 * @since 2.2.0
	 *
	 * @return string Classes name.
	 */
	function odin_classes_page_sidebar() {
		return 'col-lg-8';
	}
}

if ( ! function_exists( 'odin_classes_page_sidebar_aside' ) ) {

	/**
	 * Classes aside of page with sidebar.
	 *
	 * @since 2.2.0
	 *
	 * @return string Classes name.
	 */
	function odin_classes_page_sidebar_aside() {
		return 'col-lg-4 hidden-print widget-area';
	}
}

if ( ! function_exists( 'odin_posted_on' ) ) {

	/**
	 * Print HTML with meta information for the current post-date/time and author.
	 *
	 * @since 2.2.0
	 */
	function odin_posted_on() {
		if ( is_sticky() && is_home() && ! is_paged() ) {
			echo '<span class="featured-post">' . __( 'Sticky', 'odin' ) . ' </span>';
		}

		$num_comments = get_comments_number();
		if ( comments_open() ) {
			if ( $num_comments == 0 ) {
				$comments = __('Nenhum comentário');
			} elseif ( $num_comments > 1 ) {
				$comments = $num_comments . __(' comentários');
			} else {
				$comments = __('1 comentário');
			}
			$write_comments = '<a href="' . get_comments_link() .'">'. $comments.'</a>';
		} else {
			$write_comments =  __('Comentários estão desligados.');
		}

		// Set up and print post meta information.
		printf( '<span class="entry-date svg-i i-clock"><time class="entry-date-time" datetime="%s">%s</time></span> <span class="entry-comments svg-i i-chat"> %s</span>',
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			/*get_comments_number(),
			__( 'comentários', 'odin' )*/
			$write_comments
		);

	}
}

if ( ! function_exists( 'odin_paging_nav' ) ) {

	/**
	 * Print HTML with meta information for the current post-date/time and author.
	 *
	 * @since 2.2.0
	 */
	function odin_paging_nav() {
		$mid  = 2;     // Total of items that will show along with the current page.
		$end  = 1;     // Total of items displayed for the last few pages.
		$show = false; // Show all items.

		echo odin_pagination( $mid, $end, false );
	}
}

if ( ! function_exists( 'odin_the_custom_logo' ) ) {

	/**
	 * Displays the optional custom logo.
	 *
	 * Does nothing if the custom logo is not available.
	 *
	 * @since Odin 2.2.10
	 */
	function odin_the_custom_logo() {
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}
	}
}
