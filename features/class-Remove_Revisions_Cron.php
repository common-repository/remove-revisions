<?php/** 
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
			
			// Add the schedule event for the check			add_filter( 'check_and_remove_revisions', array( $this, 'check_and_remove_revisions' ) );			if ( ! wp_next_scheduled( 'check_and_remove_revisions' ) )
				wp_schedule_event( current_time( 'timestamp' ), 'daily', 'check_and_remove_revisions');
		}				/**
		 * Checks and removes the revisions
		 *
		 * @since	0.1
		 * @access	public
		 * @uses	get_option, add_filter, WP_Query
		 * @return	void
		 */		public function check_and_remove_revisions() {						// Check Option			if ( 0 == get_option( 'rr_input', 0 ) )				return;				// Add Date Cycle			add_filter( 'posts_where', array( $this, 'set_revisions_date_range' ) );						// Get the revisions			$revisions = new WP_Query( array(				'post_status'		=> 'inherit',				'post_type'			=> 'revision',				'showposts'			=> -1,				'posts_per_page'	=> -1			) );					// Remove Date Cycle			remove_filter( 'posts_where', array( $this, 'set_revisions_date_range' ) );			wp_reset_query();					// Remove the revisions the non-core-way			global $wpdb;			foreach ( $revisions->posts as $revision ) {				$query = $wpdb->prepare( 'DELETE FROM ' . $wpdb->posts . ' WHERE ID = %d', $revision->ID );				$wpdb->query( $query );			}		}				/**
		 * Changes the query to add the date range		 * for the query checkup		 * 		 * @since	0.1		 * @access	public		 * @param	string $where		 * @uses	get_option		 * @return	string $where
		 */
		public function set_revisions_date_range( $where = '' ) {						$where = $where . ' AND post_date <= date_sub( now() , INTERVAL ' . get_option( 'rr_input' ) . ' DAY )';			
			return $where;
		}	}}

// Kickoff
if ( function_exists( 'add_filter' ) )
	Remove_Revisions_Cron::get_instance();?>