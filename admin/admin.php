<?php
/**
 * Admin functions for the plugin.
 *
 * @package    Theme_Junkie_Portfolio_Content
 * @since      0.1.0
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */

/* Set up the admin functionality. */
add_action( 'admin_menu', 'tjpc_admin_setup' );

/**
 * Plugin's admin functionality.
 *
 * @since  0.1.0
 * @access public
 */
function tjpc_admin_setup() {

	/* Filter the 'enter title here' placeholder. */
	add_filter( 'enter_title_here', 'tjpc_title_placeholder', 10 );

	/* Move discussion meta box to side. */
	add_action( 'do_meta_boxes', 'tjpc_move_discussion_meta_box' );

	/* Custom columns on the edit portfolio screen. */
	add_filter( 'manage_edit-portfolio_columns', 'tjpc_edit_portfolio_columns' );
	add_action( 'manage_portfolio_posts_custom_column', 'tjpc_manage_portfolio_columns', 10, 2 );
	add_filter( 'manage_edit-portfolio_sortable_columns', 'tjpc_column_sortable' );

}

/**
 * Filter the 'enter title here' placeholder.
 *
 * @param  string  $title
 * @since  0.1.0
 * @access public
 * @return string
 */
function tjpc_title_placeholder( $title ) {

	if ( 'portfolio' == get_current_screen()->post_type )
		$title = esc_attr__( 'Enter project title here', 'theme-junkie-portfolio-content' );

	return $title;
}

/**
 * Move discussion meta box to the side.
 *
 * @since  0.1.0
 * @access public
 */
function tjpc_move_discussion_meta_box() {

	/* First, we need to remove the meta box. */
	remove_meta_box( 'commentstatusdiv', 'portfolio', 'normal' );

	/* Then re-enable the meta box but move it to the side. */
	add_meta_box( 'commentstatusdiv', __( 'Discussion', 'theme-junkie-portfolio-content' ), 'post_comment_status_meta_box', 'portfolio', 'side' );

}

/**
 * Sets up custom columns on the portfolio edit screen.
 *
 * @param  array  $columns
 * @since  0.1.0
 * @access public
 * @return array
 */
function tjpc_edit_portfolio_columns( $columns ) {

	unset( $columns['title'] );
	unset( $columns['taxonomy-portfolio-type'] );

	$new_columns = array(
		'cb'    => '<input type="checkbox" />',
		'title' => __( 'Project Title', 'theme-junkie-portfolio-content' )
	);

	if ( current_theme_supports( 'post-thumbnails' ) )
		$new_columns['thumbnail'] = __( 'Thumbnail', 'theme-junkie-portfolio-content' );

	$new_columns['taxonomy-portfolio-type'] = __( 'Types', 'theme-junkie-portfolio-content' );
	$new_columns['menu_order'] = __( 'Order', 'theme-junkie-portfolio-content' );

	return array_merge( $new_columns, $columns );
}

/**
 * Displays the content of custom portfolio columns on the edit screen.
 *
 * @param  string  $column
 * @param  int     $post_id
 * @since  0.1.0
 * @access public
 */
function tjpc_manage_portfolio_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {

		case 'thumbnail' :

			if ( has_post_thumbnail() )
				the_post_thumbnail( 'tjpc-img' );

			elseif ( function_exists( 'get_the_image' ) )
				get_the_image( array( 'image_scan' => true, 'width' => 40, 'height' => 40 ) );

			break;

		case 'menu_order':

		    $order = $post->menu_order;
		    echo $order;

		    break;

		/* Just break out of the switch statement for everything else. */
		default :
			break;
	}
}

/**
 * Make Order column sortable.
 *
 * @since  0.1.0
 * @access public
 * @return object
 */
function tjpc_column_sortable( $columns ) {
	$columns['menu_order'] = 'menu_order';
	return $columns;
}
