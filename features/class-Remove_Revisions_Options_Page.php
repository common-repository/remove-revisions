<?php/**
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
						// Adds the setting field for the revisions day input			add_filter( 'admin_init', array( $this, 'add_settings_field' ) );
		}				/**
		 * Adds the setting field to the writing options		 * page
		 *
		 * @since	0.1
		 * @access	public
		 * @uses	add_settings_field, __
		 * @return	void
		 */		public function add_settings_field() {						// Add the section to writing settings so we can add our
			// fields to it
			add_settings_section(				'rr_input_section',
				__( 'Remove Revions', parent::$textdomain ),
				array( $this, 'settings_section_intro' ),
				'writing'			);						// Adds the settings field			add_settings_field(				'rr_input',				__( 'Remove Revions after', parent::$textdomain ),				array( $this, 'render_settings_field' ),				'writing',				'rr_input_section'			);						// Register our setting so that $_POST handling is done for us and
			// our callback function just has to echo the <input>
			register_setting( 'writing','rr_input' );		}				/**		 * Renders the settings intro		 * 		 * @since	0.1		 * @access	public		 * @uses	_e		 * @return	void		 */		public function settings_section_intro() {						?>			<span class="description"><?php _e( 'This setting removes the revisions which are older than the given days. Leave blank or 0 to disable the old revision check.', parent::$textdomain ); ?></span>			<?php		}				/**
		 * Renders the settings input field
		 *
		 * @since	0.1
		 * @access	public
		 * @uses	get_option
		 * @return	void
		 */		public function render_settings_field() {						?>			<input id="rr_input" name="rr_input" class="small-text" type="number" min="0" step="1" value="<?php echo get_option( 'rr_input' ); ?>" /> <span><?php _e( 'Days', parent::$textdomain ); ?></p>			<?php		}
	}
}

// Kickoff
if ( function_exists( 'add_filter' ) )
	Remove_Revisions_Options_Page::get_instance();?>