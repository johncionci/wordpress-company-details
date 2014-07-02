<?php
/**
 * Plugin Name: WordPress Company Details
 * Plugin URI: https://github.com/johncionci/
 * Description: Provides an easy way for users to add details like phone, email, address, etc. to their theme.
 * Version: 0.1
 * Author: John Cionci
 * Author URI: https://github.com/johncionci/
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Copyright 2012-2014 John Cionci
 *
 * GNU General Public License, Free Software Foundation <http://creativecommons.org/licenses/GPL/2.0/>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 */

class Company_Details {

 /**
	* This hooks into 'customize_register' (available as of WP 3.4) and allows
	* you to add new sections and controls to the Theme Customize screen.
	*
	* @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	* @link http://codex.wordpress.org/Theme_Customization_API
	*/


	/**
	 * Register the Theme Customizer settings and controls
	 * @uses add_section, add_setting, add_control
	 * @param  [type] $wp_customize [description]
	 * @author John Cionci
	 * @return void
	 */
	public static function company_details_register ( $wp_customize ) {

			$wp_customize->add_section( 'company_details_section', array(
					'title' => __( 'Company Details' ),
					'priority' => 24,
					'capability' => 'edit_theme_options',
					'description' => __( 'Provides an easy way for users to add details like phone, email, address, etc. to their theme.' ),
			));

				$wp_customize->add_setting( 'company_details_phone_setting', array(
					'default'        => '',
					'capability'     => 'edit_theme_options',
					'type'           => 'option',
					'sanitize_callback' => 'sanitize_company_text_field'
				));

					$wp_customize->add_control( 'company_details_phone_control', array(
							'label'      => __( 'Company Phone Number' ),
							'section'    => 'company_details_section',
							'settings'   => 'company_details_phone_setting',
							'type'       => 'text',
					));

				$wp_customize->add_setting( 'company_details_email_setting', array(
					'default'        => '',
					'capability'     => 'edit_theme_options',
					'type'           => 'option',
					'sanitize_callback' => 'is_email'
				));

					$wp_customize->add_control( 'company_details_email_control', array(
							'label'      => __( 'Company Email Address' ),
							'section'    => 'company_details_section',
							'settings'   => 'company_details_email_setting',
							'type'       => 'text',
					));

				$wp_customize->add_setting( 'company_details_address_setting', array(
					'default'        => '',
					'capability'     => 'edit_theme_options',
					'type'           => 'option',
					'sanitize_callback' => 'sanitize_company_text_field'
				));

					$wp_customize->add_control( 'company_details_address_control', array(
							'label'      => __( 'Company Street Address' ),
							'section'    => 'company_details_section',
							'settings'   => 'company_details_address_setting',
							'type'       => 'text',
					));

	} // function company_details_register

}

	// Sanitize our general text inputs
	function sanitize_company_text_field( $input ) {
		return sanitize_text_field( $input );
	}

// Setup the Theme Customizer settings and controls
add_action( 'customize_register' , array( 'Company_Details' , 'company_details_register' ) );