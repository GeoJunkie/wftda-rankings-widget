<?php

/**
 * Fired during plugin activation
 *
 * @link       http://bit.ly/Stray_Taco
 * @since      1.0.0
 *
 * @package    League_Wftda_Ranking
 * @subpackage League_Wftda_Ranking/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    League_Wftda_Ranking
 * @subpackage League_Wftda_Ranking/includes
 * @author     Mike Straw (aka Stray Taco) <stray.taco@ohiorollerderby.com>
 */
class League_Wftda_Ranking_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		$options = new League_Wftda_Ranking_Options;
		$options->initialize();
	}

}
