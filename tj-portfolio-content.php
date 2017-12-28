<?php
/**
 * Plugin Name:  Junkie Portfolio
 * Plugin URI:   https://www.theme-junkie.com/
 * Description:  Enable portfolio post type to your WordPress website.
 * Version:      1.0.0
 * Author:       Theme Junkie
 * Author URI:   http://www.theme-junkie.com/
 * Author Email: support@theme-junkie.com
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License as published by the Free Software Foundation; either version 2 of the License,
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package    Theme_Junkie_Portfolio_Content
 * @since      0.1.0
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class Tj_Portfolio_Content {

	/**
	 * PHP5 constructor method.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function __construct() {

		/* Set constant path to the plugin directory. */
		add_action( 'plugins_loaded', array( &$this, 'constants' ), 1 );

		/* Internationalize the text strings used. */
		add_action( 'plugins_loaded', array( &$this, 'i18n' ), 2 );

		/* Load the admin functions files. */
		add_action( 'plugins_loaded', array( &$this, 'admin' ), 3 );

		/* Load the plugin functions files. */
		add_action( 'plugins_loaded', array( &$this, 'includes' ), 4 );

		/* Loads the admin styles and scripts. */
		add_action( 'admin_enqueue_scripts', array( &$this, 'admin_scripts' ) );

	}

	/**
	 * Defines constants used by the plugin.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function constants() {

		/* Set constant path to the plugin directory. */
		define( 'TJPC_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );

		/* Set the constant path to the plugin directory URI. */
		define( 'TJPC_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );

		/* Set the constant path to the admin directory. */
		define( 'TJPC_ADMIN', TJPC_DIR . trailingslashit( 'admin' ) );

		/* Set the constant path to the inc directory. */
		define( 'TJPC_INC', TJPC_DIR . trailingslashit( 'inc' ) );

		/* Set the constant path to the assets directory. */
		define( 'TJPC_ASSETS', TJPC_URI . trailingslashit( 'assets' ) );

	}

	/**
	 * Loads the translation files.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function i18n() {
		load_plugin_textdomain( 'theme-junkie-portfolio-content', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Loads the admin functions.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function admin() {
		require_once( TJPC_ADMIN . 'admin.php' );
		require_once( TJPC_ADMIN . 'metabox.php' );
	}

	/**
	 * Loads the initial files needed by the plugin.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function includes() {
		require_once( TJPC_INC . 'post-type.php' );
		require_once( TJPC_INC . 'taxonomy.php' );
		require_once( TJPC_INC . 'functions.php' );
		require_once( TJPC_INC . 'messages.php' );
	}

	/**
	 * Loads the admin styles and scripts.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function admin_scripts() {

		/* Check if current screen is Portfolio page. */
		if ( 'portfolio' != get_current_screen()->post_type )
			return;

		/* Loads the meta boxes style. */
		wp_enqueue_style( 'tjpc-metaboxes-style', trailingslashit( TJPC_ASSETS ) . 'css/admin.css', array( 'dashicons' ), null );

		/* Loads required media files for the media manager. */
		wp_enqueue_media();

		/* Custom js for gallery meta box. */
		wp_enqueue_script( 'tjpc-media', trailingslashit( TJPC_ASSETS ) . 'js/media.js', array( 'jquery', 'jquery-ui-sortable' ), null, true );

		/* Localize custom JS. */
		wp_localize_script( 'tjpc-media', 'tjpc_media',
			array(
				'title'  => __( 'Upload or Choose Your Image Files', 'theme-junkie-portfolio-content' ),
				'button' => __( 'Add to Gallery', 'theme-junkie-portfolio-content' ),
				'attr'   => __( 'Remove image', 'theme-junkie-portfolio-content' )
			)
		);

	}

}

new Tj_Portfolio_Content;
