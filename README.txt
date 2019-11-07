=== Plugin Name ===
Contributors: GeoJunkie
Donate link: https://www.paypal.com/paypalme/my/profile
Tags: comments, spam
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A widget to show a WFTDA league's ranking information in a widget.

== Description ==

* The future home of a rankings widget using the WFTDA stats API.

**This is a development project right now. Please don't use it on live sites yet!**

**This plugin was developed by a roller derby referee, fan, and league member. It isn't approved of, endorsed, or part of the Women's Flat Track Derby Association (WFTDA). I just made this to meet a need in my own league and wanted to share it.**

 Initially, this widget will scrape the data from http://stats.wftda.com/league/{league}. Once an API is available, it will use that API.

 This will also have measures in place to ensure we don't overload the stats site (**Not implemented yet**):
 * We won't use live stats unless and until the API has a good way to do that
 * Rankings for each league will be stored locally when first retrieved and then refreshed only if the data is over 24 hours old

## Methodology
Scraping based on this: http://scraping.pro/scraping-in-php-with-curl/

## TODO

x Implement initially using scraping (http://scraping.pro/scraping-in-php-with-curl/)
x Build test using shortcode
o Convert to widget (leave shortcode as bonus capability)
o Update README.txt
o Add hooks for extendability
o Submit to WordPress.org
o Convert to API when available


== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `league-wftda-ranking.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place `<?php do_action('plugin_name_hook'); ?>` in your templates

== Frequently Asked Questions ==

= A question that someone might have =

An answer to that question.

= What about foo bar? =

Answer to foo bar dilemma.

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png`
(or jpg, jpeg, gif).
2. This is the second screen shot

== Changelog ==

= 1.0.0 =
* In Progress
* Prerelease complete. Next steps:
    Integrate shortcode
    Add widget options:
        Activate/deactivate sections
        Show last refresh with ability to manually refresh

== Upgrade Notice ==

= 1.0.0 =
Once this is made, you should install it

== Arbitrary section ==

You may provide arbitrary sections, in the same format as the ones above.  This may be of use for extremely complicated
plugins where more information needs to be conveyed that doesn't fit into the categories of "description" or
"installation."  Arbitrary sections will be shown below the built-in sections outlined above.

== A brief Markdown Example ==

Ordered list:

1. Some feature
1. Another feature
1. Something else about the plugin

Unordered list:

* something
* something else
* third thing

Here's a link to [WordPress](http://wordpress.org/ "Your favorite software") and one to [Markdown's Syntax Documentation][markdown syntax].
Titles are optional, naturally.

[markdown syntax]: http://daringfireball.net/projects/markdown/syntax
            "Markdown is what the parser uses to process much of the readme file"

Markdown uses email style notation for blockquotes and I've been told:
> Asterisks for *emphasis*. Double it up  for **strong**.

`<?php code(); // goes in backticks ?>`
