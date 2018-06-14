<?php
/**
 * Plugin Name: Advanced Custom Fields : CPT Options Pages
 * Plugin URI: https://wordpress.org/plugins/acf-cpt-options-pages/
 * Description: Enables ACF options pages for a post type archive.
 * Author: Tusko Trush
 * Author URI: https://frontend.im/
 * Version: 2.0.2
 * License: GPL v3
 * Text Domain: acf-cpt-options-pages
 * Domain Path: /languages
 *
 * CPT ACF Options Pages
 * Copyright (C) 2018, Tusko Trush - tusko@trush.email
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 **/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if(!defined('CPT_ACF_PLUGIN')) {
	define( 'CPT_ACF_PLUGIN_DIR', plugin_dir_url( __FILE__ ));
	define( 'CPT_ACF_PLUGIN', plugin_basename(__FILE__));
	define( 'CPT_ACF_DOMAIN', dirname( plugin_basename( __FILE__ ) ));
}

if(!class_exists('ACFCPT_OptionsPages')) {
	include 'class.acf-cpt-options-pages.php';

	function acf_cpt_admin_init(){
		$ACFCPT_OptionsPages = new ACFCPT_OptionsPages;
	}

	add_action ('init', 'acf_cpt_admin_init', 99, 3);
}