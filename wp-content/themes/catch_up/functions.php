<?php
        // Translations can be filed in the /languages/ directory
        load_theme_textdomain( 'html5reset', TEMPLATEPATH . '/languages' );
 
        $locale = get_locale();
        $locale_file = TEMPLATEPATH . "/languages/$locale.php";
        if ( is_readable($locale_file) )
            require_once($locale_file);
	
	// Add RSS links to <head> section
	automatic_feed_links();
	
	// Load jQuery
	if ( !function_exists(core_mods) ) {
		function core_mods() {
			if ( !is_admin() ) {
				wp_deregister_script('jquery');
				wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"), false);
				wp_enqueue_script('jquery');
			}
		}
		core_mods();
	}

	// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');
    
    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => __('Sidebar Widgets','html5reset' ),
    		'id'   => 'sidebar-widgets',
    		'description'   => __( 'These are widgets for the sidebar.','html5reset' ),
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2>',
    		'after_title'   => '</h2>'
    	));
        register_sidebar ('custom'); 
    }
    
    if ( function_exists( 'add_theme_support' ) ) { 
      add_theme_support( 'post-thumbnails' ); 
      add_theme_support( 'post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'audio', 'chat', 'video')); // Add 3.1 post format theme support.
    }
    //creating custom POST TYPE "FOLD"
    add_action( 'init', 'create_fold' );
    function create_fold() {
      $labels = array(
        'name' => _x('fold', 'post type general name'),
        'singular_name' => _x('Fold', 'post type singular name'),
        'add_new' => _x('Add New', 'Fold'),
        'add_new_item' => __('Add New Fold'),
        'edit_item' => __('Edit Fold'),
        'new_item' => __('New Fold'),
        'view_item' => __('View Fold'),
        'search_items' => __('Search Fold'),
        'not_found' =>  __('No Fold has being found'),
        'not_found_in_trash' => __('No Fold found in Trash'),
        'parent_item_colon' => ''
      );
    
      $supports = array('title', 'editor', 'thumbnail');
    
      register_post_type( 'fold',
        array(
          'labels' => $labels,
          'public' => true,
          'supports' => $supports
        )
      );
    }
    //creating custom POST TYPE "BLOGGER"
    add_action( 'init', 'create_blogger' );
    function create_blogger() {
      $labels = array(
        'name' => _x('blogger', 'post type general name'),
        'singular_name' => _x('blogger', 'post type singular name'),
        'add_new' => _x('Add New', 'blogger'),
        'add_new_item' => __('Add New blogger'),
        'edit_item' => __('Edit blogger'),
        'new_item' => __('New blogger'),
        'view_item' => __('View blogger'),
        'search_items' => __('Search blogger'),
        'not_found' =>  __('No blogger has being found'),
        'not_found_in_trash' => __('No blogger found in Trash'),
        'parent_item_colon' => ''
      );
    
      $supports = array('title', 'editor', 'thumbnail');
    
      register_post_type( 'blogger',
        array(
          'labels' => $labels,
          'public' => true,
          'supports' => $supports
        )
      );
    }
?>