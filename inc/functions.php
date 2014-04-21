<?php
/**
 * Custom functions needed by the plugin.
 * 
 * @package    Theme_Junkie_Portfolio_Content
 * @since      0.1.0
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */

/* Register new image size. */
add_action( 'init', 'tjpc_add_image_size' );

/* Remove uneeded theme-support. */
add_action( 'init', 'tjpc_remove_theme_support_metabox', 11 );

/**
 * Register new image size for post type edit screen.
 * 
 * @since  0.1.0
 * @access public
 */
function tjpc_add_image_size() {

	/* Make sure the theme support post thumbnail. */
	add_theme_support( 'post-thumbnails' );

	/* Register image size. */
	add_image_size( 'tjpc-img', 70, 70, true );
}

/**
 * Remove uneeded theme-support for the post type.
 * 
 * @since  0.1.0
 * @access public
 */
function tjpc_remove_theme_support_metabox() {
	/* Remove theme-layouts Hybrid Core feature. */
	remove_post_type_support( 'portfolio', 'theme-layouts' );
}