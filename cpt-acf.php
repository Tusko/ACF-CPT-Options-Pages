<?php
/*
Plugin Name: Advanced Custom Fields : CPT Options Pages
Description: Enables ACF options pages for a post type archive.
Author: Tusko Trush
Author URI: https://frontned.im/
Version: 1.0.0
License: GPL v3

CPT ACF Options Pages
Copyright (C) 2015, Tusko Trush - tusko@photoinside.me

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function ctpacf_options_pages() {

	if( function_exists('acf_add_options_page') ) { //Check if installed acf

		$ctpacf_post_types = get_post_types( array(
			'_builtin' => false,
			'has_archive' => true
		) ); //get post types

		foreach ( $ctpacf_post_types as $cpt ) {

			if( post_type_exists( $cpt ) ) {
				
				$cpt_acf_page = array(
					'page_title' => ucfirst($cpt) . ' ACF',
					'menu_title' => ucfirst($cpt) . ' ACF',
					'menu_slug' => 'ctpacf-' . $cpt,
					'capability' => 'edit_posts',
					'position' => false,
					'parent_slug' => 'edit.php?post_type=' . $cpt,
					'icon_url' => false,
					'redirect' => false,
					'post_id' => 'cpt_' . $cpt,
					'autoload' => false	
				);
				
				acf_add_options_page( $cpt_acf_page );

			} // end if

		}

	}
	
}
	
add_action( 'init', 'ctpacf_options_pages', 99 );

?>