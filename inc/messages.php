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
	global $post, $post_ID;

	$messages['portfolio'] = array(
		0 => '',
		1 => sprintf( __( 'Project updated. <a href="%s">View Project</a>', 'tjtc' ), esc_url( get_permalink( $post_ID ) ) ),
		2 => __( 'Custom field updated.', 'tjtc' ),
		3 => __( 'Custom field deleted.', 'tjtc' ),
		4 => __( 'Project updated.', 'tjtc' ),
		5 => isset( $_GET['revision'] ) ? sprintf( __( 'Project restored to revision from %s', 'tjtc' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __( 'Project published. <a href="%s">View It</a>', 'tjtc' ), esc_url( get_permalink( $post_ID ) ) ),
		7 => __( 'Project saved.', 'tjtc' ),
		8 => sprintf( __( 'Project submitted. <a target="_blank" href="%s">Preview Project</a>', 'tjtc' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __( 'Project scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Project</a>', 'tjtc' ),
		  // translators: Publish box date format, see http://php.net/date
		  date_i18n( __( 'M j, Y @ G:i', 'tjtc' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ) ),
		10 => sprintf( __( 'Project draft updated. <a target="_blank" href="%s">Preview Project</a>', 'tjtc' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
	);

	return $messages;
}