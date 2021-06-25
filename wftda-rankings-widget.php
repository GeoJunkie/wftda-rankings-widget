<?php

/**
 * Plugin Name:       WFTDA Rankings Widget
 * Plugin URI:        https://github.com/GeoJunkie/wftda-rankings-widget
 * Description:       A widget to show a WFTDA league's ranking information.
 * Version:           2.0.0
 * Requires at least: 5.5
 * Requires PHP:      7.0
 * Author:            Mike Straw (aka Stray Taco)
 * Author URI:        http://bit.ly/Stray_Taco
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wftda-rankings-widget
 * Domain Path:       /languages
 */

/*
Copyright (C) 2021 Mike Straw
 
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
 
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License along
with this program; if not, write to the Free Software Foundation, Inc.,
51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
*/

namespace WFTDA_Rankings;

defined( 'ABSPATH' ) or exit();

// Globals
define( 'WRW_DIR', plugin_dir_path(( __FILE__ )));
define( 'WRW_PLUGIN_URL', plugin_dir_url( __FILE__));

// Main hooks
register_activation_hook( __FILE__, function() {
    require_once WRW_DIR . 'src/Activation.php';
    Activation::activate();
});

register_deactivation_hook( __FILE__, function() {
    require_once WRW_DIR . 'src/Deactivation.php';
    Deactivation::deactivate();
});