<?php
 * Feature Name:	Options Page
 * Version:			0.1
 * Author:			Inpsyde GmbH
 * Author URI:		http://inpsyde.com
 * Licence:			GPLv3
 */

if ( ! class_exists( 'Remove_Revisions_Options_Page' ) ) {

	class Remove_Revisions_Options_Page extends Remove_Revisions {

		/**
		 * Tab holder 
		 *
		 * @since	0.1
		 * @access	public
		 * @var		array
		 */
		public $tabs = array();
		
		/**
		 * Instance holder
		 *
		 * @since	0.1
		 * @access	private
		 * @static
		 * @var		NULL | Remove_Revisions_Options_Page
		 */
		private static $instance = NULL;
		
		/**
		 * Method for ensuring that only one instance of this object is used
		 *
		 * @since	0.1
		 * @access	public
		 * @static
		 * @return	Remove_Revisions_Options_Page
		 */
		public static function get_instance() {
				
			if ( ! self::$instance )
				self::$instance = new self;
				
			return self::$instance;
		}
		
		/**
		 * Setting up some data, initialize translations and start the hooks
		 *
		 * @since	0.1
		 * @access	public
		 * @uses	is_admin, add_filter
		 * @return	void
		 */
		public function __construct() {
			
			// Options Pages are only visible in the admin area,
			// so we don't need to fire this filters
			if ( ! is_admin() )
				return;
			
		}
		 * Adds the setting field to the writing options
		 *
		 * @since	0.1
		 * @access	public
		 * @uses	add_settings_field, __
		 * @return	void
		 */
			// fields to it
			add_settings_section(
				__( 'Remove Revions', parent::$textdomain ),
				array( $this, 'settings_section_intro' ),
				'writing'
			// our callback function just has to echo the <input>
			register_setting( 'writing','rr_input' );
		 * Renders the settings input field
		 *
		 * @since	0.1
		 * @access	public
		 * @uses	get_option
		 * @return	void
		 */
	}
}

// Kickoff
if ( function_exists( 'add_filter' ) )
	Remove_Revisions_Options_Page::get_instance();