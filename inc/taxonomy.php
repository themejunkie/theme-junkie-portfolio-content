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
		'name'              => __( 'Types', 'theme-junkie-portfolio-content' ),
		'singular_name'     => __( 'Type', 'theme-junkie-portfolio-content' ),
		'menu_name'         => __( 'Types', 'theme-junkie-portfolio-content' ),
		'all_items'         => __( 'All Types', 'theme-junkie-portfolio-content' ),
		'edit_item'         => __( 'Edit Type', 'theme-junkie-portfolio-content' ),
		'view_item'         => __( 'View Type', 'theme-junkie-portfolio-content' ),
		'update_item'       => __( 'Update Type', 'theme-junkie-portfolio-content' ),
		'add_new_item'      => __( 'Add New Type', 'theme-junkie-portfolio-content' ),
		'new_item_name'     => __( 'New Type', 'theme-junkie-portfolio-content' ),
		'parent_item'       => __( 'Parent Type', 'theme-junkie-portfolio-content' ),
		'parent_item_colon' => __( 'Parent Type:', 'theme-junkie-portfolio-content' ),
		'search_items'      => __( 'Search Types', 'theme-junkie-portfolio-content' ),
		'not_found'         => __( 'No types found.', 'theme-junkie-portfolio-content' ),
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
