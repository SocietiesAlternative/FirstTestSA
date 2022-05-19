<?php
/**
 * Plugin Name: Gosign - Masonry Post Block
 * Plugin URI: https://www.gosign.de/
 * Description: Gosign - Masonry Post Block — is a Gutenberg plugin created by Gosign. This plugin contains Masnory Post block that shows posts in Masonry Gallery.
 * Author: Gosign.de
 * Author URI: https://www.gosign.de/wordpress-agentur/
 * Version: 2.9
 * License: GPL3+
 * License URI: https://www.gnu.org/licenses/gpl.txt
 *
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Block Initializer.
 */
require_once plugin_dir_path( __FILE__ ) . 'src/init.php';
