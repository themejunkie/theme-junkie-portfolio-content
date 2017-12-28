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
		1 => sprintf( __( 'Project updated. <a href="%s">View Project</a>', 'theme-junkie-portfolio-content' ), esc_url( get_permalink( $post_ID ) ) ),
		2 => __( 'Custom field updated.', 'theme-junkie-portfolio-content' ),
		3 => __( 'Custom field deleted.', 'theme-junkie-portfolio-content' ),
		4 => __( 'Project updated.', 'theme-junkie-portfolio-content' ),
		5 => isset( $_GET['revision'] ) ? sprintf( __( 'Project restored to revision from %s', 'theme-junkie-portfolio-content' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __( 'Project published. <a href="%s">View It</a>', 'theme-junkie-portfolio-content' ), esc_url( get_permalink( $post_ID ) ) ),
		7 => __( 'Project saved.', 'theme-junkie-portfolio-content' ),
		8 => sprintf( __( 'Project submitted. <a target="_blank" href="%s">Preview Project</a>', 'theme-junkie-portfolio-content' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __( 'Project scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Project</a>', 'theme-junkie-portfolio-content' ),
		  // translators: Publish box date format, see http://php.net/date
		  date_i18n( __( 'M j, Y @ G:i', 'theme-junkie-portfolio-content' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ) ),
		10 => sprintf( __( 'Project draft updated. <a target="_blank" href="%s">Preview Project</a>', 'theme-junkie-portfolio-content' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
	);

	return $messages;
}
