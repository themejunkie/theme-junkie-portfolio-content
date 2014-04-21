<?php
/**
 * Customizing the post type messages.
 * 
 * @package    Theme_Junkie_Portfolio_Content
 * @since      0.1.0
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */

/* Filter messages. */
add_filter( 'post_updated_messages', 'tjpc_updated_messages' );

/**
 * Portfolio update messages.
 *
 * @param  array  $messages Existing post update messages.
 * @since  0.1.0
 * @access public
 * @return array  Amended post update messages with new CPT update messages.
 */
function tjpc_updated_messages( $messages ) {
	$post             = get_post();
	$post_type        = get_post_type( $post );
	$post_type_object = get_post_type_object( $post_type );

	$messages['portfolio'] = array(
		0  => '',
		1  => __( 'Project updated.', 'tjpc' ),
		2  => __( 'Custom field updated.', 'tjpc' ),
		3  => __( 'Custom field deleted.', 'tjpc' ),
		4  => __( 'Project updated.', 'tjpc' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Project restored to revision from %s', 'tjpc' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6  => __( 'Project published.', 'tjpc' ),
		7  => __( 'Project saved.', 'tjpc' ),
		8  => __( 'Project submitted.', 'tjpc' ),
		9  => sprintf(
			__( 'Project scheduled for: <strong>%1$s</strong>.', 'tjpc' ),
			// translators: Publish box date format, see http://php.net/date
			date_i18n( __( 'M j, Y @ G:i', 'tjpc' ), strtotime( $post->post_date ) )
		),
		10 => __( 'Project draft updated.', 'tjpc' ),
	);

	if ( $post_type_object->publicly_queryable ) {

		$permalink = get_permalink( $post->ID );

		$view_link = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'View project', 'tjpc' ) );
		$messages[ $post_type ][1] .= $view_link;
		$messages[ $post_type ][6] .= $view_link;
		$messages[ $post_type ][9] .= $view_link;

		$preview_permalink = add_query_arg( 'preview', 'true', $permalink );
		$preview_link = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), __( 'Preview project', 'tjpc' ) );
		$messages[ $post_type ][8]  .= $preview_link;
		$messages[ $post_type ][10] .= $preview_link;

	}

	return $messages;
}