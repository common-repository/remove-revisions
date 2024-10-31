<?php
 * Feature Name:	The wp-cron job
 * Version:			0.1
 * Author:			Inpsyde GmbH
 * Author URI:		http://inpsyde.com
 * Licence:			GPLv3
 */

if ( ! class_exists( 'Remove_Revisions_Cron' ) ) {

	class Remove_Revisions_Cron extends Remove_Revisions {

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
		 * @var		NULL | Remove_Revisions_Cron
		 */
		private static $instance = NULL;
		
		/**
		 * Method for ensuring that only one instance of this object is used
		 *
		 * @since	0.1
		 * @access	public
		 * @static
		 * @return	Remove_Revisions_Cron
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
			
			// Add the schedule event for the check
				wp_schedule_event( current_time( 'timestamp' ), 'daily', 'check_and_remove_revisions');
		}
		 * Checks and removes the revisions
		 *
		 * @since	0.1
		 * @access	public
		 * @uses	get_option, add_filter, WP_Query
		 * @return	void
		 */
		 * Changes the query to add the date range
		 */
		public function set_revisions_date_range( $where = '' ) {
			return $where;
		}

// Kickoff
if ( function_exists( 'add_filter' ) )
	Remove_Revisions_Cron::get_instance();