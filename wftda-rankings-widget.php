<?php

/**
 * @link    https://bit.ly/Stray_Taco
 * @since   0.1.0
 * @package League_Wftda_Ranking
 *
 * @wordpress-plugin
 * Plugin Name:       WFTDA Rankings Widget
 * Plugin URI:        https://wordpress.org/plugins/wftda-rankings-widget/
 * Description:       A widget to show a WFTDA league's ranking information in a widget.
 * Version:           2.0.0-dev
 * Author:            Mike Straw (aka Stray Taco)
 * Author URI:        http://bit.ly/Stray_Taco
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       league-wftda-ranking
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (! defined('WPINC') ) {
    die;
}

/**
 * Current plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 */
define('LEAGUE_WFTDA_RANKING_VERSION', '2.0.0-dev');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-league-wftda-ranking-activator.php
 */
function activate_league_wftda_ranking()
{
    include_once plugin_dir_path(__FILE__) . 'includes/class-league-wftda-ranking-activator.php';
    League_Wftda_Ranking_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-league-wftda-ranking-deactivator.php
 */
function deactivate_league_wftda_ranking()
{
    include_once plugin_dir_path(__FILE__) . 'includes/class-league-wftda-ranking-deactivator.php';
    League_Wftda_Ranking_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_league_wftda_ranking');
register_deactivation_hook(__FILE__, 'deactivate_league_wftda_ranking');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-league-wftda-ranking.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since 1.0.0
 */
function run_league_wftda_ranking()
{

    $plugin = new League_Wftda_Ranking();
    $plugin->run();

}
run_league_wftda_ranking();
