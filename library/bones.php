<?php
/* Welcome to infinitum :)
This is the core infinitum file where most of the
main functions & features reside. If you have
any custom functions, it's best to put them
in the functions.php file.

Developed by: Eddie Machado
URL: http://themble.com/infinitum/
*/

/*********************
LAUNCH infinitum
Let's fire off all the functions
and tools. I put it up here so it's
right up top and clean.
*********************/

// we're firing all out initial functions at the start
add_action( 'after_setup_theme', 'infinitum_ahoy', 16 );

function infinitum_ahoy() {

	// launching operation cleanup
	add_action( 'init', 'infinitum_head_cleanup' );

	// remove WP version from RSS
	add_filter( 'the_generator', 'infinitum_rss_version' );

	// clean up gallery output in wp
	add_filter( 'gallery_style', 'infinitum_gallery_style' );

	// enqueue base scripts and styles
	add_action( 'wp_enqueue_scripts', 'infinitum_scripts_and_styles', 999 );
	// ie conditional wrapper

	// launching this stuff after theme setup
	infinitum_theme_support();

	// adding sidebars to WordPress (these are created in functions.php)
	add_action( 'widgets_init', 'infinitum_register_sidebars' );
	// adding the infinitum search form (created in functions.php)
	add_filter( 'get_search_form', 'infinitum_wpsearch' );

	// cleaning up random code around images
	add_filter( 'the_content', 'infinitum_filter_ptags_on_images' );
	// cleaning up excerpt
	add_filter( 'excerpt_more', 'infinitum_excerpt_more' );

} /* end infinitum ahoy */

/*********************
THEME SUPPORT
*********************/

// Adding WP 3+ Functions & Theme Support
function infinitum_theme_support() {

	// wp thumbnails (sizes handled in functions.php)
	add_theme_support( 'post-thumbnails' );

	// default thumb size
	set_post_thumbnail_size(256, 128, true);

	// wp custom background (thx to @bransonwerner for update)
	add_theme_support( 'custom-background', array(
		'default-color' => '#ffffff',
	) );

	// rss thingy
	add_theme_support('automatic-feed-links');

	// wp menus
	add_theme_support( 'menus' );

	// registering WP menus
	register_nav_menus(
		array(
			'main-nav' => __( 'The Main Menu', 'infinitum' ),   // main nav in header
			'footer-links' => __( 'Footer Links', 'infinitum' ) // secondary nav in footer
		)
	);
} /* end infinitum theme support */

/*********************
WP_HEAD GOODNESS
Let's clean it up by removing all the junk we don't need.
*********************/

function infinitum_head_cleanup() {

	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// index link
	remove_action( 'wp_head', 'index_rel_link' );
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// WP version
	remove_action( 'wp_head', 'wp_generator' );
	// remove WP version from css
	add_filter( 'style_loader_src', 'infinitum_remove_wp_ver_css_js', 9999 );
	// remove Wp version from scripts
	add_filter( 'script_loader_src', 'infinitum_remove_wp_ver_css_js', 9999 );

} /* end infinitum head cleanup */

// remove WP version from RSS
function infinitum_rss_version() { return ''; }

// remove WP version from scripts
function infinitum_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

// remove injected CSS from gallery
function infinitum_gallery_style($css) {
	return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}


/*********************
SCRIPTS & ENQUEUEING
*********************/

// loading modernizr and jquery, and reply script
function infinitum_scripts_and_styles() {
global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way
if (!is_admin()) {

		// modernizr (without media query polyfill)
		wp_register_script( 'infinitum-modernizr', get_stylesheet_directory_uri() . '/library/js/modernizr.custom.min.js', array(), '2.7.0', false );

		// register main stylesheet
		wp_register_style( 'infinitum-stylesheet', get_stylesheet_directory_uri() . '/style.css', array(), '', 'all' );

		// register bootstrap stylesheet
		wp_register_style( 'bootstrap', get_template_directory_uri() . '/library/css/bootstrap.css', array(), '3.0.2', 'all' );

		// ie-only style sheet
		wp_register_style( 'infinitum-ie-only', get_stylesheet_directory_uri() . '/library/css/ie.css', array(), '' );

		// adding scripts file in the footer
		wp_register_script( 'infinitum-js', get_stylesheet_directory_uri() . '/library/js/scripts.js', array( 'jquery' ), '', true );

		// register bootsrap scripts
		wp_register_script( 'bootstrap-scripts', get_template_directory_uri().'/library/js/bootstrap.min.js', array(), '3.0.2', true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// enqueue styles and scripts
		wp_enqueue_script( 'infinitum-modernizr' );
		wp_enqueue_style( 'bootstrap' );
		wp_enqueue_style( 'infinitum-stylesheet' );
		wp_enqueue_style( 'infinitum-ie-only' );
		wp_enqueue_script( 'bootstrap-scripts' );

		$wp_styles->add_data( 'infinitum-ie-only', 'conditional', 'lt IE 9' ); // add conditional wrapper around ie stylesheet

		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'infinitum-js' );

	}  
}
	
/*********************
MENUS & NAVIGATION
*********************/

function infinitum_main_nav() {
	// display the wp3 menu if available
    wp_nav_menu( 
    	array( 
            'menu'              => 'main-nav',
            'theme_location'    => 'main-nav',
            'depth'             => 2,
            'container'         => 'div',
            'container_class'   => 'collapse navbar-collapse navbar-ex1-collapse',
            'menu_class'        => 'nav navbar-nav',
            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
            'walker'            => new wp_bootstrap_navwalker()
    	)
    );
}

// the footer menu (should you choose to use one)
function infinitum_footer_links() {
        // display the wp3 menu if available
        wp_nav_menu(array(
                'container' => '',                              // remove nav container
                'container_class' => 'footer-links clearfix',   // class of container (should you choose to use it)
                'menu' => __( 'Footer Links', 'infinitum' ),   // nav name
                'menu_class' => 'nav footer-nav clearfix',      // adding custom nav class
                'theme_location' => 'footer-links',             // where it's located in the theme
                'before' => '',                                 // before the menu
                'after' => '',                                  // after the menu
                'link_before' => '',                            // before each link
                'link_after' => '',                             // after each link
                'depth' => 0,                                   // limit the depth of the nav
                'fallback_cb' => 'infinitum_footer_links_fallback'  // fallback function
        ));
} /* end infinitum footer link */
 
// this is the fallback for header menu
function infinitum_main_nav_fallback() { 
	//wp_page_menu( 'show_home=Home&menu_class=nav' ); 
}

// this is the fallback for footer menu
function infinitum_footer_links_fallback() {
	/* you can put a default here if you like */
}

/*********************
PAGE NAVI
*********************/

// Numeric Page Navi (built into the theme by default)
function infinitum_page_navi($before = '', $after = '') {
	global $wpdb, $wp_query;
	$request = $wp_query->request;
	$posts_per_page = intval(get_query_var('posts_per_page'));
	$paged = intval(get_query_var('paged'));
	$numposts = $wp_query->found_posts;
	$max_page = $wp_query->max_num_pages;
	if ( $numposts <= $posts_per_page ) { return; }
	if(empty($paged) || $paged == 0) {
		$paged = 1;
	}
	$pages_to_show = 7;
	$pages_to_show_minus_1 = $pages_to_show-1;
	$half_page_start = floor($pages_to_show_minus_1/2);
	$half_page_end = ceil($pages_to_show_minus_1/2);
	$start_page = $paged - $half_page_start;
	if($start_page <= 0) {
		$start_page = 1;
	}
	$end_page = $paged + $half_page_end;
	if(($end_page - $start_page) != $pages_to_show_minus_1) {
		$end_page = $start_page + $pages_to_show_minus_1;
	}
	if($end_page > $max_page) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = $max_page;
	}
	if($start_page <= 0) {
		$start_page = 1;
	}
		
	echo $before.'<div class="pagination"><ul class="pagination clearfix">'."";
	if ($paged > 1) {
		$first_page_text = "&laquo";
		echo '<li class="prev"><a href="'.get_pagenum_link().'" title="First">'.$first_page_text.'</a></li>';
	}
		
	$prevposts = get_previous_posts_link('&larr; Previous');
	if($prevposts) { echo '<li>' . $prevposts  . '</li>'; }
	else { echo '<li class="disabled"><a href="#">&larr; Previous</a></li>'; }
	
	for($i = $start_page; $i  <= $end_page; $i++) {
		if($i == $paged) {
			echo '<li class="active"><a href="#">'.$i.'</a></li>';
		} else {
			echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
		}
	}
	echo '<li class="">';
	next_posts_link('Next &rarr;');
	echo '</li>';
	if ($end_page < $max_page) {
		$last_page_text = "&raquo;";
		echo '<li class="next"><a href="'.get_pagenum_link($max_page).'" title="Last">'.$last_page_text.'</a></li>';
	}
	echo '</ul></div>'.$after."";
}



/*********************
RANDOM CLEANUP ITEMS
*********************/

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function infinitum_filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// This removes the annoying […] to a Read More link
function infinitum_excerpt_more($more) {
	global $post;
	// edit here if you like
	return '...  <a class="excerpt-read-more" href="'. get_permalink($post->ID) . '" title="'. __( 'Read', 'infinitum' ) . get_the_title($post->ID).'">'. __( 'Read more &raquo;', 'infinitum' ) .'</a>';
}

add_action( 'infinitum_footer', 'infinitum_footer_info', 30 );
/**
 * function to show the footer info, copyright information
 */
function infinitum_footer_info() {         
   $output = ' <a href="http://wordpress.org" target="_blank">WordPress</a> theme by <a href="http://colorlib.com/wp/" target="_blank">Colorlib</a>.</div>';
   echo $output;
}

// Custom Backend Footer
add_filter('admin_footer_text', 'infinitum_custom_admin_footer');
function infinitum_custom_admin_footer() {
	echo '<span id="footer-thankyou">Developed and designed by <a href="http://colorlib.com/wp" target="_blank">Colorlib</a></span>.';
}

// adding it to the admin area
add_filter('admin_footer_text', 'infinitum_custom_admin_footer');

/****************************************************************************************/

?>
