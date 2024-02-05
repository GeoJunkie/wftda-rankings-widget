=== WFTDA Rankings Widget ===
Contributors: mikestraw
Tags: roller derby, wftda, sports, rankings, stats
Requires at least: 3.0.1
Tested up to: 6.4.3
Stable tag: 1.1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A widget to show a WFTDA league's ranking information in a widget.

== Description ==

**NOTE:** This widget is not currently compatible with block themes. When installing on WordPress versions 6.0 or higher, you will also need to install the [Classic Widgets plugin](https://wordpress.org/plugins/classic-widgets/).

Add a widget to your site with the WFTDA stats from stats.wftda.com.

Currently, the widget will scrape the data from http://stats.wftda.com/league/{league}. Once the WFTDA makes an API available, it will use that API.

**This plugin was developed by a roller derby referee, fan, and league member. It isn't approved of, endorsed, or part of the Women's Flat Track Derby Association (WFTDA). I just made this to meet a need in my own league and wanted to share it.**

There are measures in place to ensure we don't overload the stats site:

 * We won't use live stats unless and until the API has a good way to do that
 * Rankings for each league will be stored locally when first retrieved and then refreshed only if the data is over 24 hours old

 [See the widget in action](https://ohiorollerderby.com).

## Future enhancements

* More configuration options for the widget:
  * Choice of which stats to display
  * Visual customizations
* Create a block
* Make available as a shortcode
* Add hooks for extendability
* Convert to API when available

== Installation ==

1. Install directly from WordPress.org, upload `wftda-rankings-widget.zip` under **Plugins > Add New**, or install via WP-CLI using `wp plugin install wftda-rankings-widget`
1. Activate the plugin through the 'Plugins' menu in WordPress
1. If you are installing on a site with WordPress 6.0 or higher, also install and activate the [Classic Widgets plugin](https://wordpress.org/plugins/classic-widgets/).
1. Add the widget in the Customizer
1. The League Slug should match the portion of the address of your league's stats after the last slash. e.g., if the address for your league's stats page is `https://stats.wftda.com/league/super-fantastic-derby`, enter `super-fantastic-derby` under League Slug

== Frequently Asked Questions ==

= What if it doesn't work? =

* Make sure it's installed properly
* Make sure your site can read external URLs
* Activate WP_DEBUG and check for any errors
* Ask on the support forums

= Can I help make the plugin better? =

* Absolutely! You can contribute [on GitHub](https://github.com/GeoJunkie/league-wftda-ranking)

== Screenshots ==

1. The widget as it appears on the page
2. Widget settings

== Changelog ==

= 1.1.0 - 2024-02-05 =

* Updated to account for new URL structure on stats.wftda.com

= 1.0.2 - 2020-04-12 =

* Readme updates

= 1.0.1 - 2020-04-05 =

* Converted to HTTP API
* Updated league data storage to prevent refreshes on every page load

= 1.0.0 - 2020-03-21 =

* The initial release 

== Upgrade Notice ==

= 1.0.1 =
Release to WordPress.org

= 1.0.0 = 
Initial plugin release

