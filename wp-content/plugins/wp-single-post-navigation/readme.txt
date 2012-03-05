=== WP Single Post Navigation ===
Contributors: daveshine
Donate link: http://genesisthemes.de/en/donate/
Tags: single post, navigation, browse, next, previous, next post, previous post, style, wordpress, buddypress, themes, frameworks, deckerweb
Requires at least: 3.0
Tested up to: 3.3.1
Stable tag: 1.4

Plugin adds next & prev nav links on single posts to have a "browse post by post nav style". Includes customizeable parameters.

== Description ==
This small and lightweight plugin adds next & previous navigation links on single posts to have some kind of a browse post by post nav style. Using the WordPress core function for previous and next post links these links only appear on single posts. The browsing is chronological. Some blog authors prefer to have such a style to offer their readers some feeling of "book reading..." So the plugin might add some nice effect :). Styling with CSS is possible, please see under FAQ here!

In the css file a Media Query setting was added to avoid the display of these browse links on screens/ viewports with a width smaller than 1100px. You can edit this via CSS, see FAQ.

Finally, since version 1.4 of the plugin you can reverse the link direction via defining a little constant in your theme or child theme. Please see the [FAQ section here](http://wordpress.org/extend/plugins/wp-single-post-navigation/faq/) for more info on that.

Also since version 1.4 of the plugin you can customize the possible parameters of the previous/next post links - these are the same parameters the WordPress functions offers :-). Again, please see [FAQ section here](http://wordpress.org/extend/plugins/wp-single-post-navigation/faq/) for more info on that!

= Theme Framework and Theme support =
* *Out of the box the plugin should work great with most themes out there.*
* *For enhanced compatibility support for the following popular frameworks (these with hooks) and some themes (these with hooks, too) was added:*
* Genesis Framework by StudioPress & CopyBlogger Media
* Thesis Framework by DIYthemes
* Builder Framework by iThemes
* Catalyst Framework by Eric Hamm/CatalystTheme.com
* Hybrid Framework by ThemeHybrid/Justin Tadlock (free)
* Xtreme One Framework by XtremeTheme.com
* Headway Framework by Headway Themes, LLC
* Pagelines Framework / Platform (free) / Platform Pro all by Pagelines.com
* StartBox Framework by Brian Richards/rzen Media (free)
* Thematic Framework by ThemeShaper/Ian Stewart (free)
* Ashford Framework by Tim Bednar (free & pro version)
* Wonderflux Framework by Jonny Allbut/Team Wonderflux (free)
* Elemental Framework by Pro Theme Design/Ben Gillbanks & Darren Hoyt
* WP-Framework by Ptah Dunbar (free)
* Canvas Theme by WooThemes
* BuddyPress Default Theme/Template by WordPress.org/Automattic (free) - includes all child themes that are based on this one!
* Custom Community (free) and Custom Community Pro by Themekraft (BuddyPress specific themes)
* Suffusion by Sayontan Sinha (free, WP.org)
* Graphene by Khairul Syahir (free, WP.org)
* Oenology by Chip Bennett (free, WP.org)
* Twenty Eleven Theme by WordPress.org/Automattic (free)
* Twenty Ten Theme by WordPress.org/Automattic (free)
* **Note:** [For more themes listed please see under "Other Notes" here ...](http://wordpress.org/extend/plugins/wp-single-post-navigation/other_notes/)

*Note:* This works no matter if you use the default framework/parent theme alone or with a child theme - the conditional check always goes for the template (= parent theme) so the appropiate child theme is always included as well.

= Localization =
* English (default) - always included
* German - always included
* .pot file (`wpspn.pot`) for translators is also always included :)
* Your translation? - [Just send it in](http://genesisthemes.de/en/contact/)

[A plugin from deckerweb.de and GenesisThemes](http://genesisthemes.de/en/)

= Feedback =
* I am open for your suggestions and feedback - Thank you for using or trying out one of my plugins!
* Drop me a line [@deckerweb](http://twitter.com/#!/deckerweb) on Twitter
* Follow me on [my Facebook page](http://www.facebook.com/deckerweb.service)
* Or follow me on [+David Decker](http://deckerweb.de/gplus) on Google Plus ;-)

= More =
* [Also see my other plugins](http://genesisthemes.de/en/wp-plugins/) or see [my WordPress.org profile page](http://profiles.wordpress.org/users/daveshine/)
* Tip: [*GenesisFinder* - Find then create. Your Genesis Framework Search Engine.](http://genesisfinder.com/)

== Installation ==
1. Upload `wp-single-post-navigation` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Visit any single post of your site or blog to see the browse links on the left and right side ...
4. Please note: This small and lightweight plugin has no options page (and don't ever will have!) - just activate and you're good to go :-).

== Frequently Asked Questions ==
= The link styles don't fit to my site and/or are invisible - what should I do? =
Don't panic. It's just some css styling - look at the next questions on how you can edit this. Thank you!
(The plugin comes only with one pre-defined style so it cannot fit with any site by default. Thank you for your understanding!)

= Can I change the color of the links and/or the link hover behaviour? =
Yes, you can!

*First alternative (highly recommended!):* Just look in the packaged CSS file `single-post-navigation.css` to find out the CSS selectors and rules and then overwrite them via your theme/child theme. In most cases you then have to apply them by adding an `!important` to the appropiate rule. -- Big advantage of this alternative: it's update secure!

*Second alternative (NOT recommeded!):* You might edit the `single-post-navigation.css` file in the plugin folder `/wp-single-post-navigation/css/`. Edit the link styles as documented in the stylesheet. (Just note that after any plugin update you have to do this again so never forget to make a BACKUP of your files to easily revert to the plugin's default!)

= Can I remove or change the styling of the tiny border lines? =
Yes, of course! Just the same procedure as above! Look for the documented style settings in the css file. - The alternative via theme/child theme is always recommended :)

= Can I adjust the media query for another display size (or even various sizes) because my site or content width is bigger/ smaller? =
Again, that's possible! Just the same procedure as above! Look for the documented style settings in the css file. - The alternative via theme/child theme is always recommended :)

= Can I swap/reverse the direction of the browsing links? =
Finally, this is now possible since version 1.4 of the plugin :). You only have to add one little line of code (a constant) to the functions.php file of your theme or child theme. (Only add this if you really want to change the direction, if not then just DO NOT add it!) Please add the following code:
`/**
 * WP Single Post Navigation: Reverse link direction
 */
define( 'WPSPN_REVERSE_LINK_DIRECTION', 'reverse_direction' );`

*Please note:* This leads to changing the general direction of the links, really book-like ("next post link" on the right side, "previous post link" on the left side). It also will lead to reversed arrows (the linked strings) so you now might also add the custom parameters like explained below in next FAQ entry:

= Can I customize the link string, set to only in the same category and can I exclude categories? =
Yes, this is now possible since version 1.4 of the plugin via custom filters which you can add to your functions.php file of the current theme or child theme. -- There's one filter function for each of the two - "previous post link" and "next post link":

**Changing parameters for "previous post link":**
`add_filter( 'wpspn_previous_post_link', 'custom_wpspn_previous_link' );
/**
 * WP Single Post Navigation: Add custom filters for "previous post link"
 */
function custom_wpspn_previous_link() {

	$args = array (
		'format'                => '%link',     // Change link format (default: %link)
		'link'                  => '&raquo;',   // Change link string (default: &raquo;)
		'in_same_cat'           => FALSE,       // Apply only to same category (default: FALSE)
		'excluded_categories'   => ''           // Exclude categories (default: empty)
	);

	previous_post_link( $args['format'], $args['link'], $args['in_same_cat'], $args['excluded_categories'] );
}`
[You can also get this code from GitHub Gist here](https://gist.github.com/1574571) // See also [WordPress codex for info on the four possible parameters...](http://codex.wordpress.org/Template_Tags/previous_post_link)

If you reversed the link direction (see above FAQ entry) you might change the link string here to: `&laquo;`

**Changing parameters for "next post link":**
`add_filter( 'wpspn_next_post_link', 'custom_wpspn_next_link' );
/**
 * WP Single Post Navigation: Add custom filters for "next post link"
 */
function custom_wpspn_next_link() {

	$args = array (
		'format'                => '%link',     // Change link format (default: %link)
		'link'                  => '&laquo;',   // Change link string (default: &laquo;)
		'in_same_cat'           => FALSE,       // Apply only to same category (default: FALSE)
		'excluded_categories'   => ''           // Exclude categories (default: empty)
	);

	next_post_link( $args['format'], $args['link'], $args['in_same_cat'], $args['excluded_categories'] );
}`
[You can also get this code from GitHub Gist here](https://gist.github.com/1574576) // See also [WordPress codex for info on the four possible parameters...](http://codex.wordpress.org/Template_Tags/next_post_link)

If you reversed the link direction (see above FAQ entry) you might change the link string here to: `&raquo;`

== Screenshots ==
1. Adding browse next & previous links to single posts - 1st example: included default style for light backgrounds
2. Adding browse next & previous links to single posts - 2nd example: user customized stylesheet for dark backgrounds

== Changelog ==

= 1.4 =
* Added support for 8 more single/parent themes (all free, WP.org or GitHub.com) - this making the plugin even more compatible and less buggy... :)
* *Finally:* Added possibility to reverse the link direction via a constant added to the theme or child theme - [please see FAQ section here for more info](http://wordpress.org/extend/plugins/wp-single-post-navigation/faq/)
* Added filters to the plugin which allow now to change the parameters for "previous post link" and "next post link" - all of the 4 parameters for the WordPress template tags/functions could be used - [please see FAQ here here for more info](http://wordpress.org/extend/plugins/wp-single-post-navigation/faq/) - *Note:* This requires v1.4 or higher of this plugin!
* Improved theme/template check for Thesis framework to include more versions of the theme for enhanced compatibility
* General code tweaks, also improved code documentation for newly added filters
* Added new rules for the customizations to CSS file, improved documentatin and code standards, furthermore fixed a documentation mistake
* Enhanced and improved readme.txt file with more info, documention and FAQ entries for customizing the parameters
* Updated German translations and also the .pot file for all translators!

= 1.3 =
* Added support for 4 more Theme Frameworks plus 2 other free themes - this making the plugin even more compatible and less buggy... :)
* Updated German translations and also the .pot file for all translators!

= 1.2 =
* Added support for 10 popular Theme Frameworks plus 6 popular Themes/Parent Themes via conditional function/hooks - this making the plugin more compatible and less buggy... :)
* Optimized CSS3 Media Query: only display the links for displays of 1100px width or bigger
* Added localization for the whole plugin, which is pretty much the plugin description section
* Added German translations (plus English included by default)
* For translators: added .pot file to the download package (`wpspn.pot` in `/languages/`)
* Improved and documented plugin code
* Big update of the readme.txt file documentation - especially the FAQ section and Theme Support in Description
* Tested & proved compatibility with WordPress 3.3 final release :-)

= 1.1.1 =
* Fixed crucial bug - added interim solution - works

= 1.1 =
* Added CSS3 Media Query to load only for bigger displays/ viewports
* Optimized and documented the stylesheet

= 1.0 =
* Initial release

== Upgrade Notice ==
= 1.4 =
Major changes and improvements - Added filters and constants for customizations via theme/child theme. Added support for 8 more (free) themes/parent themes. Some general code and documentation tweaks, also minor tweaks in CSS file. Updated readme.txt file and also .pot file for translators together with German translations.

= 1.3 =
Several changes - Added support for 4 more theme frameworks plus 2 free themes from WP.org. Updated .pot file for translators together with German translations.

= 1.2 =
Several changes - Added support for 10 popular theme frameworks plus 6 themes/parent themes. Optimzed media query, added localization and further improved code and documentation.

= 1.1.1 =
Important change - Fixed crucial bug - added interim solution - works.

= 1.1 =
Minor changes - Added CSS3 Media Query to load only for bigger displays/ viewports, optimized and documented the stylesheet.

= 1.0 =
Just released into the wild.

== Translations ==

* English - default, always included
* German: Deutsch - immer dabei! [Download auch via deckerweb.de](http://deckerweb.de/material/sprachdateien/wordpress-plugins/#wp-single-post-navigation)

*Note:* All my plugins are localized/ translateable by default. This is very important for all users worldwide. So please contribute your language to the plugin to make it even more useful. For translating I recommend the awesome ["Codestyling Localization" plugin](http://wordpress.org/extend/plugins/codestyling-localization/) and for validating the ["Poedit Editor"](http://www.poedit.net/).

== Idea Behind / Philosophy ==
It's a really simple and leightweight plugin which generates a nice visual effect. It has no options panel - an don't ever will have one. Just activate and you're done. It's one of those plugins which just works in the background and you have nothing to maintain. Now enjoy just browsing your posts :).

This plugin is the result of an idea of a friend of mine - we experimented together and I came up with this. It works really fine in real life as most users reported to date. Still, it's more of an example of this idea. This could be easily implemented in almost every theme or framework and there are lots of possibilities to customize. -- Most important: Thank you for using or trying out this plugin!

== Full List of Suppoted Theme Frameworks and Single Themes ==
No worries, if your theme isn't listed here, the plugin should still work fine as there's a fallback function included :).

**Theme Frameworks:**

* Genesis Framework by StudioPress & CopyBlogger Media (premium)
* Thesis Framework by DIYthemes (premium)
* Builder Framework by iThemes (premium)
* Catalyst Framework by Eric Hamm/CatalystTheme.com (premium)
* Hybrid Framework by ThemeHybrid/Justin Tadlock (free)
* Xtreme One Framework by XtremeTheme.com (premium)
* Headway Framework by Headway Themes, LLC (premium)
* Pagelines Framework (premium) / Platform (free) / Platform Pro (premium) all by Pagelines.com
* StartBox Framework by Brian Richards/rzen Media (free)
* Thematic Framework by ThemeShaper/Ian Stewart (free)
* Ashford Framework by Tim Bednar (free & pro version)
* Wonderflux Framework by Jonny Allbut/Team Wonderflux (free)
* Elemental Framework by Pro Theme Design/Ben Gillbanks & Darren Hoyt (premium)
* WP-Framework by Ptah Dunbar (free)
* Canvas Theme by WooThemes (premium)

**BuddyPress specific:**

* BuddyPress Default Theme/Template by WordPress.org/Automattic (free) - includes all child themes that are based on this one!
* Custom Community (free) and Custom Community Pro (premium) by Themekraft (BuddyPress specific themes)

**Single Themes/Parent Themes:**

* Twenty Eleven Theme by WordPress.org/Automattic (free)
* Twenty Ten Theme by WordPress.org/Automattic (free)
* Suffusion by Sayontan Sinha (free, WP.org)
* Graphene by Khairul Syahir (free, WP.org)
* Easel by Philip M. Hofer (Frumph) (free, WP.org)
* iFeature3 by "CyberChimps WordPress Themes" (free, WP.org)
* Toolbox by WordPress.org/Automattic (free)
* dkret3 by Joern Kretzschmar (free, WP.org)
* Grey Opaque by H.-Peter Pfeufer (free, WP.org)
* Oenology by Chip Bennett (free, WP.org)
* Skeleton by Simple Themes (free, simplethemes.com & GitHub.com)
* Admired by Brad Thomas (free, WP.org)
