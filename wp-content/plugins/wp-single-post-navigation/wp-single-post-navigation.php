<?php
/**
 * Main plugin file. This plugin adds next & previous navigation links on single posts to have some kind of a browse post by post nav style. Support for several popular theme frameworks and themes is integrated. And you can customize link direction and some parameters via your theme/child theme.
 *
 * @package WP Single Post Navigation
 * @author David Decker
 *
 * Plugin Name: WP Single Post Navigation
 * Plugin URI: http://genesisthemes.de/en/wp-plugins/wp-single-post-navigation/
 * Description: This plugin adds next & previous navigation links on single posts to have some kind of a browse post by post nav style. Support for several popular theme frameworks and themes is integrated. And you can customize link direction and some parameters via your theme/child theme.
 * Version: 1.4
 * Author: David Decker - DECKERWEB
 * Author URI: http://deckerweb.de/
 * License: GPLv2
 * Text Domain: wpspn
 * Domain Path: /languages/
 */

/**
 * Setting constants
 *
 * @since 1.2
 * @version 1.1
 */
define( 'WPSPN_VERSION', '1.4' );
define( 'WPSPN_PLUGIN_BASEDIR', dirname( plugin_basename( __FILE__ ) ) );


/**
 * Load the text domain for translation of the plugin
 * 
 * @since 1.2
 */
load_plugin_textdomain( 'wpspn', false, WPSPN_PLUGIN_BASEDIR . '/languages' );


add_filter( 'plugin_row_meta', 'ddw_wpspn_plugin_links', 10, 2 );
/**
 * Add various support links to plugin page
 *
 * @since 1.2
 */
function ddw_wpspn_plugin_links( $wpspn_links, $wpspn_file ) {

	if ( !current_user_can( 'install_plugins' ))
		return $wpspn_links;

	if ( $wpspn_file == WPSPN_PLUGIN_BASEDIR . '/wp-single-post-navigation.php' ) {
		$wpspn_links[] = '<a href="http://wordpress.org/extend/plugins/wp-single-post-navigation/faq/" target="_new" title="' . __( 'FAQ', 'wpspn' ) . '">' . __( 'FAQ', 'wpspn' ) . '</a>';
		$wpspn_links[] = '<a href="http://wordpress.org/tags/wp-single-post-navigation?forum_id=10" target="_new" title="' . __( 'Support', 'wpspn' ) . '">' . __( 'Support', 'wpspn' ) . '</a>';
		$wpspn_links[] = '<a href="' . __( 'http://genesisthemes.de/en/donate/', 'wpspn' ) . '" target="_new" title="' . __( 'Donate', 'wpspn' ) . '">' . __( 'Donate', 'wpspn' ) . '</a>';
	}

	return $wpspn_links;
}


add_action( 'wp_enqueue_scripts', 'ddw_wpspn_stylesheet' );
/**
 * Enqueue single post navigation stylesheet
 *
 * @since 1.0
 * @version 1.2
 */
function ddw_wpspn_stylesheet() {

	wp_enqueue_style( 'wp_single_post_navigation', plugins_url( '/css/single-post-navigation.css', __FILE__ ), false, WPSPN_VERSION, 'screen' );

}


/**
 * Create "previous post link" and add filters for it
 * Set default values for args - so it could be overwritten via theme/child theme
 *
 * @since 1.4
 */
function wpspn_previous_post_link() {

	$args = array (
		'format'       		=> '%link',     // Link format (default: %link)
		'link'                	=> '&raquo;',   // Link string (default: &raquo;)
		'in_same_cat'        	=> FALSE,       // Apply only to same category (default: FALSE)
		'excluded_categories' 	=> ''           // Exclude categories (default: empty)
	);

	$args = apply_filters( 'wpspn_previous_link_args', $args );

	previous_post_link( $args['format'], $args['link'], $args['in_same_cat'], $args['excluded_categories'] );
}


/**
 * Create "next post link" and add filters for it
 * Set default values for args - so it could be overwritten via theme/child theme
 *
 * @since 1.4
 */
function wpspn_next_post_link() {

	$args = array (
		'format'       		=> '%link',     // Link format (default: %link)
		'link'                	=> '&laquo;',   // Link string (default: &laquo;)
		'in_same_cat'        	=> FALSE,       // Apply only to same category (default: FALSE)
		'excluded_categories' 	=> ''           // Exclude categories (default: empty)
	);

	$args = apply_filters( 'wpspn_next_link_args', $args );

	next_post_link( $args['format'], $args['link'], $args['in_same_cat'], $args['excluded_categories'] );
}


/**
 * Output single post navigation links for display
 * 1) Check for constant, on TRUE reverse link direction
 * 2) In link areas/containers check for custom filters and apply on success
 *
 * @since 1.0
 * @version 1.2
 */
function ddw_wpspn_single_prev_next_links() {

	if ( is_single() && defined( 'WPSPN_REVERSE_LINK_DIRECTION' ) ) {  // Check for constant TRUE, then reverse links

		?>
		<div class="wpspn-area">
			<div id="wpspn-nextpost-reverse">
				<?php
					// Check for custom filters for "next post link" parameters
					if ( has_filter( 'wpspn_next_post_link', 'custom_wpspn_next_link' ) ) {
						custom_wpspn_next_link();

					} else {  // If nothing is found apply default parameters
						wpspn_next_post_link();
					}
				?>
			</div>
			<div id="wpspn-prevpost-reverse">
				<?php
					// Check for custom filters for "previous post link" parameters
					if ( has_filter( 'wpspn_previous_post_link', 'custom_wpspn_previous_link' ) ) {
						custom_wpspn_previous_link();

					} else {  // If nothing is found apply default parameters
						wpspn_previous_post_link();
					}
				?>
			</div>
		</div>
		<?php

	} elseif ( is_single() ) {  // Check for constant is FALSE, so DON'T reverse links (default behavior)

		?>
		<div class="wpspn-area">
			<div id="wpspn-prevpost">
				<?php
					// Check for custom filters for "previous post link" parameters
					if ( has_filter( 'wpspn_previous_post_link', 'custom_wpspn_previous_link' ) ) {
						custom_wpspn_previous_link();

					} else {  // If nothing is found apply default parameters
						wpspn_previous_post_link();
					}
				?>
			</div>
			<div id="wpspn-nextpost">
				<?php
					// Check for custom filters for "next post link" parameters
					if ( has_filter( 'wpspn_next_post_link', 'custom_wpspn_next_link' ) ) {
						custom_wpspn_next_link();

					} else {  // If nothing is found apply default parameters
						wpspn_next_post_link();
					}
				?>
			</div>
		</div>
		<?php

	}  // end elseif

}  // end of function ddw_wpspn_single_prev_next_links


/**
 * Load the hooks and display single post navigation links.
 *
 * Provide hooks for the most popular theme frameworks
 * and some single themes/parent themes.
 *
 * Fallback into wp_head if no framework/theme fits (sorry, we have no other chance, yet...)
 *
 * @since 1.2
 * @version 1.2
 */
if ( get_template() == 'genesis' ) {		// Check for Genesis Framework
	add_action( 'genesis_after', 'ddw_wpspn_single_prev_next_links' );

} elseif ( get_template() == 'thesis_182' || get_template() == 'thesis_181' || get_template() == 'thesis_18' || get_template() == 'thesis_17' || get_current_theme() == 'Thesis' ) {	// Check for Thesis Theme/Framework
	add_action( 'thesis_hook_after_footer', 'ddw_wpspn_single_prev_next_links' );

} elseif ( get_template() == 'Builder' ) {		// Check for Builder Framework
	add_action( 'builder_finish', 'ddw_wpspn_single_prev_next_links', 5 );

} elseif ( get_template() == 'catalyst' ) {		// Check for Catalyst Framework
	add_action( 'catalyst_hook_after_after_footer', 'ddw_wpspn_single_prev_next_links' );

} elseif ( get_template() == 'hybrid' ) {		// Check for Hybrid Framework
	add_action( 'hybrid_after_footer', 'ddw_wpspn_single_prev_next_links' );

} elseif ( get_template() == 'xtreme-one' ) {		// Check for Xtreme One Framework
	add_action( 'xtreme_after_siteinfo', 'ddw_wpspn_single_prev_next_links' );

} elseif ( get_template() == 'headway' ) {		// Check for Headway Framework
	add_action( 'headway_after_everything', 'ddw_wpspn_single_prev_next_links' );

} elseif ( get_template() == 'pagelines' || get_template() == 'platform' || get_template() == 'platformpro' ) {
	// Check for Pagelines Framework or Platform (free) or Platform Pro
	add_action( 'pagelines_after_footer', 'ddw_wpspn_single_prev_next_links' );

} elseif ( get_template() == 'startbox' ) {		// Check for StartBox Framework
	add_action( 'sb_after', 'ddw_wpspn_single_prev_next_links' );

} elseif ( get_template() == 'thematic' ) {		// Check for Thematic Framework
	add_action( 'thematic_after', 'ddw_wpspn_single_prev_next_links' );

} elseif ( get_template() == 'elemental' ) {		// Check for Elemental Framework
	add_action( 'bm_footer_content_after', 'ddw_wpspn_single_prev_next_links' );

} elseif ( get_template() == 'ashford' ) {		// Check for Ashford Framework
	add_action( 'ashford_close_body', 'ddw_wpspn_single_prev_next_links' );

} elseif ( get_template() == 'wonderflux' ) {		// Check for Wonderflux Framework
	add_action( 'wffooter_after_wrapper', 'ddw_wpspn_single_prev_next_links' );

} elseif ( get_template() == 'wp-framework' ) {		// Check for WP-Framework Framework
	add_action( 'body_close', 'ddw_wpspn_single_prev_next_links' );

} elseif ( get_template() == 'canvas' ) {		// Check for WooThemes Canvas Parent Theme
	add_action( 'woo_footer_after', 'ddw_wpspn_single_prev_next_links' );

} elseif ( get_template() == 'bp-default' || get_template() == 'custom-community' || get_template() == 'custom-community-pro' ) {
	// BuddyPress specific: Check for BuddyPress Default or Custom Community/Pro Theme/Template
	add_action( 'bp_after_footer', 'ddw_wpspn_single_prev_next_links' );

} elseif ( get_template() == 'twentyeleven' ) {		// Check for Twenty Eleven default theme
	add_action( 'twentyeleven_credits', 'ddw_wpspn_single_prev_next_links' );

} elseif ( get_template() == 'twentyten' ) {		// Check for Twenty Ten default theme
	add_action( 'twentyten_credits', 'ddw_wpspn_single_prev_next_links' );

} elseif ( get_template() == 'suffusion' ) {		// Check for Suffusion theme
	add_action( 'suffusion_document_footer', 'ddw_wpspn_single_prev_next_links' );

} elseif ( get_template() == 'graphene' ) {		// Check for Graphene theme
	add_action( 'graphene_after_footer', 'ddw_wpspn_single_prev_next_links' );

} elseif ( get_template() == 'easel' ) {		// Check for Easel theme
	add_action( 'easel-page-foot', 'ddw_wpspn_single_prev_next_links' );

} elseif ( get_template() == 'ifeature' ) {		// Check for iFeature3 theme
	add_action( 'chimps_afterfooter', 'ddw_wpspn_single_prev_next_links' );

} elseif ( get_template() == 'toolbox' ) {		// Check for Toolbox theme
	add_action( 'toolbox_credits', 'ddw_wpspn_single_prev_next_links' );

} elseif ( get_template() == 'dkret3' ) {		// Check for dkret3 theme
	add_action( 'dkret_after_footer', 'ddw_wpspn_single_prev_next_links' );

} elseif ( get_template() == 'grey-opaque' ) {		// Check for Grey Opaque theme
	add_action( 'greyopaque_footer_statistics', 'ddw_wpspn_single_prev_next_links' );

} elseif ( get_template() == 'oenology' ) {		// Check for Oenology theme
	add_action( 'oenology_hook_extent_after', 'ddw_wpspn_single_prev_next_links' );

} elseif ( get_template() == 'skeleton' ) {		// Check for Skeleton theme
	add_action( 'st_footer', 'ddw_wpspn_single_prev_next_links' );

} elseif ( get_template() == 'admired' ) {		// Check for Admired theme
	add_action( 'admired_credits', 'ddw_wpspn_single_prev_next_links' );

} else {	// If nothing else fits load into wp_head (sorry, there's no other chance)
	add_action( 'wp_head', 'ddw_wpspn_single_prev_next_links' );

}  // end of conditional for framework/theme check
