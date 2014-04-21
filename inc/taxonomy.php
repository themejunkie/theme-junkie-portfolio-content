<?php
/**
 * Register the custom taxonomy.
 *
 * @package    Theme_Junkie_Portfolio_Content
 * @since      0.1.0
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @link       http://codex.wordpress.org/Function_Reference/register_taxonomy
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */

/* Register taxonomies on the 'init' hook. */
add_action( 'init', 'tjpc_register_taxonomy' );

/**
 * Register taxonomy.
 *
 * @since  0.1.0
 * @access public
 */
function tjpc_register_taxonomy() {

	$labels = array(
		'name'              => __( 'Types', 'tjpc' ),
		'singular_name'     => __( 'Type', 'tjpc' ),
		'menu_name'         => __( 'Types', 'tjpc' ),
		'all_items'         => __( 'All Types', 'tjpc' ),
		'edit_item'         => __( 'Edit Type', 'tjpc' ), 
		'view_item'         => __( 'View Type', 'tjpc' ), 
		'update_item'       => __( 'Update Type', 'tjpc' ),
		'add_new_item'      => __( 'Add New Type', 'tjpc' ),
		'new_item_name'     => __( 'New Type', 'tjpc' ),
		'parent_item'       => __( 'Parent Type', 'tjpc' ),
		'parent_item_colon' => __( 'Parent Type:', 'tjpc' ),
		'search_items'      => __( 'Search Types', 'tjpc' ),
		'not_found'         => __( 'No types found.', 'tjpc' ),
	);

	$defaults = array(
		'labels'            => apply_filters( 'tjpc_portfolio_tax_labels', $labels ),
		'public'            => true,
		'show_in_nav_menus' => false,
		'show_admin_column' => true,
		'hierarchical'      => true,
		'rewrite'           => array( 'slug' => 'portfolio-type', 'with_front' => false )
	);

	$args = apply_filters( 'tjpc_portfolio_tax_args', $defaults );

	register_taxonomy( 'portfolio-type', array( 'portfolio' ), $args );

}