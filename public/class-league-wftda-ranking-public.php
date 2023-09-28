<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://bit.ly/Stray_Taco
 * @since      1.0.0
 *
 * @package    League_Wftda_Ranking
 * @subpackage League_Wftda_Ranking/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    League_Wftda_Ranking
 * @subpackage League_Wftda_Ranking/public
 * @author     Mike Straw (aka Stray Taco) <stray.taco@ohiorollerderby.com>
 */
class League_Wftda_Ranking_Public
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->scripts_defs_paths = include plugin_dir_path( __DIR__ ) . 'build/league-wftda-ranking-public.asset.php';
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in League_Wftda_Ranking_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The League_Wftda_Ranking_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__DIR__) . 'build/league-wftda-ranking-public.css', array(), $this->scripts_defs_paths['version'], 'all');
		
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in League_Wftda_Ranking_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The League_Wftda_Ranking_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__DIR__) . 'build/league-wftda-ranking-public.js', array('jquery'), $this->scripts_defs_paths['version'], false);
	}

		/**
	 * Register the widgets
	 *
	 * @since    1.0.0
	 */
	public function register_widgets()
	{

		register_widget('League_Wftda_Ranking_Widget');
	}


}
