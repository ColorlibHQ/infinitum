<?php
/*
This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images, 
sidebars, comments, ect.
*/

// Set content width
if ( ! isset( $content_width ) ) 
    $content_width = 750;


// Get infinitum Core Up & Running!
require_once('library/bones.php');            // core functions (don't remove)

// Shortcodes
require_once('library/shortcodes.php');

// Register Custom Navigation Walker
require_once('library/wp_bootstrap_navwalker.php');

/*
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */

define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/' );
require_once dirname( __FILE__ ) . '/admin/options-framework.php';

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'infinitum-featured', 750, 420, true );
add_image_size( 'infinitum-featured-home', 1140, 360, true);
add_image_size( 'infinitum-featured-carousel', 1140, 400, true);

/*
 * This one shows/hides the an option when a checkbox is clicked.
 *
 */

add_action( 'optionsframework_custom_scripts', 'optionsframework_custom_scripts' );

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

  jQuery('#example_showhidden').click(function() {
      jQuery('#section-example_text_hidden').fadeToggle(400);
  });

  if (jQuery('#example_showhidden:checked').val() !== undefined) {
    jQuery('#section-example_text_hidden').show();
  }

  jQuery('#showhidden_slideroptions').click(function() {
      jQuery('#section-slider_options').fadeToggle(400);
  });
  
  if (jQuery('#showhidden_slideroptions:checked').val() !== undefined) {
    jQuery('#section-slider_options').show();
  }

});
</script>

<?php
}

/************* CUSTOM HEADER *************/

$args = array(
  'flex-width'    => true,
  'width'         => 250,
  'flex-height'   => true,
  'height'        => 50,
  'header-text'   => false,
);
add_theme_support( 'custom-header', $args );


/************* WOOCOMMERCE *************/

add_theme_support( 'woocommerce' );

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
  echo '<div id="main" class="col-md-8">';
}

function my_theme_wrapper_end() {
  echo '</div>';
}

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function infinitum_register_sidebars() {
    register_sidebar(array(
    	'id' => 'sidebar1',
    	'name' => 'Main Sidebar',
    	'description' => 'Used on every page BUT the homepage page template.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s panel panel-default">',
    	'after_widget' => '</div>',
    	'before_title' => '<div class="panel-heading"><h4 class="widgettitle">',
    	'after_title' => '</h4></div>',
    ));
    
    register_sidebar(array(
    	'id' => 'home1',
    	'name' => 'Homepage Widget 1',
    	'description' => 'Used only on the homepage page template.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));

    register_sidebar(array(
      'id' => 'home2',
      'name' => 'Homepage Widget 2',
      'description' => 'Used only on the homepage page template.',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h4 class="widgettitle">',
      'after_title' => '</h4>',
    ));

    register_sidebar(array(
      'id' => 'home3',
      'name' => 'Homepage Widget 3',
      'description' => 'Used only on the homepage page template.',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h4 class="widgettitle">',
      'after_title' => '</h4>',
    ));
    
    register_sidebar(array(
      'id' => 'footer1',
      'name' => 'Footer 1',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h4 class="widgettitle">',
      'after_title' => '</h4>',
    ));

    register_sidebar(array(
      'id' => 'footer2',
      'name' => 'Footer 2',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h4 class="widgettitle">',
      'after_title' => '</h4>',
    ));

    register_sidebar(array(
      'id' => 'footer3',
      'name' => 'Footer 3',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h4 class="widgettitle">',
      'after_title' => '</h4>',
    ));
    
    
    /* 
    to add more sidebars or widgetized areas, just copy
    and edit the above sidebar code. In order to call 
    your new sidebar just use the following code:    
    
    */
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function infinitum_wpsearch($form) {
    $form = '<form method="get" class="form-search" action="' . home_url( '/' ) . '">
  <div class="row">
    <div class="col-lg-12">
      <div class="input-group">
        <input type="text" class="form-control search-query" value="' . get_search_query() . '" name="s" id="s" placeholder="'. esc_attr__('Search...','infinitum') .'">
        <span class="input-group-btn">
          <button type="submit" class="btn btn-primary" name="submit" id="searchsubmit" value="Go"><span class="glyphicon glyphicon-search"></span></button>
        </span>
      </div>
    </div>
  </div>
</form>';
    return $form;
} // don't remove this bracket!

/****************** password protected post form *****/

add_filter( 'the_password_form', 'custom_password_form' );

function custom_password_form() {
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$o = '<form class="protected-post-form" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post">
  <div class="row">
    <div class="col-lg-10">
        ' . __( "<p>This post is password protected. To view it please enter your password below:</p>" ,'infinitum') . '
        <label for="' . $label . '">' . __( "Password:" ,'infinitum') . ' </label>
      <div class="input-group">
        <input class="form-control" value="' . get_search_query() . '" name="post_password" id="' . $label . '" type="password">
        <span class="input-group-btn"><button type="submit" class="btn btn-primary" name="submit" id="searchsubmit" vvalue="' . esc_attr__( "Submit",'infinitum' ) . '">' . __( "Submit" ,'infinitum') . '</button>
        </span>
      </div>
    </div>
  </div>
</form>
	';
	return $o;
}

/*********** update standard wp tag cloud widget so it looks better ************/

add_filter( 'widget_tag_cloud_args', 'my_widget_tag_cloud_args' );

function my_widget_tag_cloud_args( $args ) {
	$args['number'] = 20; // show less tags
	$args['largest'] = 9.75; // make largest and smallest the same - i don't like the varying font-size look
	$args['smallest'] = 9.75;
	$args['unit'] = 'px';
	return $args;
}

// Add Bootstrap classes for table
add_filter( 'the_content', 'infinitum_add_custom_table_class' );
function infinitum_add_custom_table_class( $content ) {
    return str_replace( '<table>', '<table class="table table-hover">', $content );
}

// filter tag clould output so that it can be styled by CSS
function add_tag_class( $taglinks ) {
    $tags = explode('</a>', $taglinks);
    $regex = "#(.*tag-link[-])(.*)(' title.*)#e";
        foreach( $tags as $tag ) {
        	$tagn[] = preg_replace($regex, "('$1$2 label label-primary tag-'.get_tag($2)->slug.'$3')", $tag );
        }
    $taglinks = implode('</a>', $tagn);
    return $taglinks;
}

add_action('wp_tag_cloud', 'add_tag_class');

add_filter('wp_tag_cloud','wp_tag_cloud_filter', 10, 2);

function wp_tag_cloud_filter($return, $args)
{
  return '<div id="tag-cloud">'.$return.'</div>';
}

// Enable shortcodes in widgets
add_filter('widget_text', 'do_shortcode');

// Disable jump in 'read more' link
function remove_more_jump_link($link) {
	$offset = strpos($link, '#more-');
	if ($offset) {
		$end = strpos($link, '"',$offset);
	}
	if ($end) {
		$link = substr_replace($link, '', $offset, $end-$offset);
	}
	return $link;
}
add_filter('the_content_more_link', 'remove_more_jump_link');

// Remove height/width attributes on images so they can be responsive
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );

function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

// Add the Meta Box to the homepage template
function add_homepage_meta_box() {  
	global $post;
	// Only add homepage meta box if template being used is the homepage template
	// $post_id = isset($_GET['post']) ? $_GET['post'] : (isset($_POST['post_ID']) ? $_POST['post_ID'] : "");
	$post_id = $post->ID;
	$template_file = get_post_meta($post_id,'_wp_page_template',TRUE);
	if ($template_file == 'page-homepage.php')
	{
	    add_meta_box(  
	        'homepage_meta_box', // $id  
	        'Optional Homepage Tagline', // $title  
	        'show_homepage_meta_box', // $callback  
	        'page', // $page  
	        'normal', // $context  
	        'high'); // $priority  
    }
}  
add_action('add_meta_boxes', 'add_homepage_meta_box');

// Field Array  
$prefix = 'custom_';  
$custom_meta_fields = array(  
    array(  
        'label'=> 'Homepage tagline area',  
        'desc'  => 'Displayed underneath page title. Only used on homepage template. HTML can be used.',  
        'id'    => $prefix.'tagline',  
        'type'  => 'textarea' 
    )  
);  

// The Homepage Meta Box Callback  
function show_homepage_meta_box() {  
global $custom_meta_fields, $post;  
// Use nonce for verification  
  wp_nonce_field( basename( __FILE__ ), 'wpbs_nonce' );
    
    // Begin the field table and loop  
    echo '<table class="form-table">';  
    foreach ($custom_meta_fields as $field) {  
        // get value of this field if it exists for this post  
        $meta = get_post_meta($post->ID, $field['id'], true);  
        // begin a table row with  
        echo '<tr> 
                <th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
                <td>';  
                switch($field['type']) {  
                    // text  
                    case 'text':  
                        echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="60" /> 
                            <br /><span class="description">'.$field['desc'].'</span>';  
                    break;
                    
                    // textarea  
                    case 'textarea':  
                        echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="80" rows="4">'.$meta.'</textarea> 
                            <br /><span class="description">'.$field['desc'].'</span>';  
                    break;  
                } //end switch  
        echo '</td></tr>';  
    } // end foreach  
    echo '</table>'; // end table  
}  

// Save the Data  
function save_homepage_meta($post_id) {  
    global $custom_meta_fields;  
  
    // verify nonce  
    if (!isset( $_POST['wpbs_nonce'] ) || !wp_verify_nonce($_POST['wpbs_nonce'], basename(__FILE__)))  
        return $post_id;  
    // check autosave  
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)  
        return $post_id;  
    // check permissions  
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can('edit_page', $post_id))  
            return $post_id;  
        } elseif (!current_user_can('edit_post', $post_id)) {  
            return $post_id;  
    }  
  
    // loop through fields and save the data  
    foreach ($custom_meta_fields as $field) {  
        $old = get_post_meta($post_id, $field['id'], true);  
        $new = $_POST[$field['id']];  
        if ($new && $new != $old) {  
            update_post_meta($post_id, $field['id'], $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field['id'], $old);  
        }  
    } // end foreach  
}  
add_action('save_post', 'save_homepage_meta');  

// Add thumbnail class to thumbnail links
function add_class_attachment_link($html){
    $postid = get_the_ID();
    $html = str_replace('<a','<a class="thumbnail"',$html);
    return $html;
}
add_filter('wp_get_attachment_link','add_class_attachment_link',10,1);

// Add editor style to WordPress Dashboard
add_editor_style('editor-style.css');

//Display social links
function infinitum_social(){
  $output = '<div id="social" class="social">';
  $output .= infinitum_social_item(of_get_option('social_facebook'), 'Facebook', 'facebook-alt');
  $output .= infinitum_social_item(of_get_option('social_twitter'), 'Twitter', 'twitter');
  $output .= infinitum_social_item(of_get_option('social_google'), 'Google Plus', 'googleplus-alt');
  $output .= infinitum_social_item(of_get_option('social_youtube'), 'YouTube', 'youtube');
  $output .= infinitum_social_item(of_get_option('social_linkedin'), 'LinkedIn', 'linkedin');
  $output .= infinitum_social_item(of_get_option('social_pinterest'), 'Pinterest', 'pinterest');
  $output .= infinitum_social_item(of_get_option('social_feed'), 'Feed', 'feed');
  $output .= infinitum_social_item(of_get_option('social_tumblr'), 'Tumblr', 'tumblr');
  $output .= infinitum_social_item(of_get_option('social_flickr'), 'Flickr', 'flickr');
  $output .= infinitum_social_item(of_get_option('social_instagram'), 'Instagram', 'instagram');
  $output .= infinitum_social_item(of_get_option('social_dribbble'), 'Dribbble', 'dribbble');
  $output .= infinitum_social_item(of_get_option('social_skype'), 'Skype', 'skype');
  $output .= '</div>';
  echo $output;
}

function infinitum_social_item($url, $title = '', $icon = ''){
  if($url != ''):
    $output = '<a class="social-profile" href="'.$url.'" title="'.$title.'">';
    if($icon != '') $output .= '<span class="social_icon genericon genericon-'.$icon.'"></span>';
    $output .= '</a>';
    return $output;
  endif;
}

// Get theme options
function get_infinitum_theme_options(){
  $theme_options_styles = '';

      $color = of_get_option('element_color');
      if ( $color ) {
        $theme_options_styles .= '
        .btn-primary,
        .label-primary { 
          background-color: '. $color . ';
          border-color: transparent;
        }';
      }

      $color = of_get_option('element_color_hover');
      if ( $color ) {
        $theme_options_styles .= '
        .btn-primary:hover, 
        .label-primary[href]:hover,
        .label-primary[href]:focus,
        .btn-primary:hover,
        .btn-primary:focus,
        .btn-primary:active,
        .btn-primary.active,
        .pagination > .active > a, 
        .pagination > .active > span, 
        .pagination > .active > a:hover, 
        .pagination > .active > span:hover, 
        .pagination > .active > a:focus, 
        .pagination > .active > span:focus { 
          background-color: '. $color . ';
          border-color: transparent;
        }';
      }
    
      $typography = of_get_option('heading_typography');
      if ( $typography['face'] != 'Default' ) {
        $theme_options_styles .= '
        h1{ 
          font-family: ' . $typography['face'] . '; 
          font-weight: ' . $typography['style'] . '; 
          color: ' . $typography['color'] . ';
          font-size: ' . $typography['size'] . '; 
        }';
      }
      
      $typography = of_get_option('main_body_typography');
      if ( $typography['face'] != 'Default' ) {
        $theme_options_styles .= '
        body{ 
          font-family: ' . $typography['face'] . '; 
          font-weight: ' . $typography['style'] . '; 
          color: ' . $typography['color'] . ';
          font-size: ' . $typography['size'] . '; 
        }';
      }

      $typography = of_get_option('title_typography');
      if ( $typography['face'] != 'Default' ) {
        $theme_options_styles .= '
        .navbar-default .navbar-brand { 
          font-family: ' . $typography['face'] . '; 
          font-weight: ' . $typography['style'] . ';
          font-size: ' . $typography['size'] . ';
          color: ' . $typography['color'] . ';
        }';
      }
      
      $color = of_get_option('link_color');
      if ($color) {
        $theme_options_styles .= '
        a{ 
          color: ' . $color . '; 
        }';
      }
      
      $color = of_get_option('link_hover_color');
      if ($color) {
        $theme_options_styles .= '
        a:hover{ 
          color: ' . $color . '; 
        }';
      }
      
      $color = of_get_option('link_active_color');
      if ($color) {
        $theme_options_styles .= '
        a:active{ 
          color: ' . $color . '; 
        }';
      }
      
      $topbar_position = of_get_option('nav_position');
      if ($topbar_position == 'scroll') {
        $theme_options_styles .= '
        .navbar{ 
          position: static; 
        }
        body{
          padding-top: 0;
        }
        ' 
        ;
      }
      
      $color = of_get_option('top_nav_bg_color');
      if ( $color ) {
        $theme_options_styles .= '
        .navbar-default { 
          background-color: '. $color . ';
        }';
      }

      $color = of_get_option('top_nav_bg_hover_color');
      if ( $color ) {
        $theme_options_styles .= '
        .navbar-default .navbar-nav > .open > a,
        .navbar-default .navbar-nav > .open > a:hover,
        .navbar-default .navbar-nav > .open > a:focus, 
        .navbar-default .navbar-nav > .active > a, 
        .navbar-default .navbar-nav > .active > a:hover, 
        .navbar-default .navbar-nav > .active > a:focus, 
        .navbar-default .navbar-toggle:hover,
        .navbar-default .navbar-toggle:focus { 
          background-color: '. $color . ';
        }';
      }

      $color = of_get_option('footer_background_color');
      if ( $color ) {
        $theme_options_styles .= '
        .footer-outer { 
          background-color: '. $color . ';
        }';
      }

      $color = of_get_option('footer_text_color');
      if ( $color ) {
        $theme_options_styles .= '
        .footer-outer { 
          color: '. $color . ';
        }';
      }

      $color = of_get_option('top_title_color');
      if ( $color ) {
        $theme_options_styles .= '
        .navbar-default .navbar-brand { 
          color: '. $color . ';
        }';
      }
      
      $color = of_get_option('top_nav_link_color');
      if ($color) {
        $theme_options_styles .= '
        .navbar-default .navbar-nav > li > a,
        .navbar-default .navbar-nav > .open > a, 
        .navbar-default .navbar-nav > .open > a:hover, 
        .navbar-default .navbar-nav > .open > a:focus,
        .navbar-default .navbar-nav > .active > a, 
        .navbar-default .navbar-nav > .active > a:hover, 
        .navbar-default .navbar-nav > .active > a:focus { 
          color: '. $color . ';
        }';
      }
      
      $color = of_get_option('top_nav_link_hover_color');
      if ($color) {
        $theme_options_styles .= '
        .navbar-default .navbar-nav > li > a:hover { 
          color: '. $color . ';
        }';
      }
      
      $color = of_get_option('top_nav_dropdown_hover_bg');
      if ($color) {
        $theme_options_styles .= '
          .dropdown-menu li > a:hover, 
          .dropdown-menu .active > a, 
          .dropdown-menu .active > a:hover {
            background-color: ' . $color . ';
          }
        ';
      }
      
      $color = of_get_option('top_nav_dropdown_item');
      if ($color){
        $theme_options_styles .= '
          .dropdown-menu a{
            color: ' . $color . ' !important;
          }
        ';
      }
      
      $color = of_get_option('jumbotron_bg_color');
      if ($color) {
        $theme_options_styles .= '
        .jumbotron { 
          background-color: '. $color . ';
        }';
      }

      $color = of_get_option('jumbotext_color');
      if ($color) {
        $theme_options_styles .= '
        .jumbotron h1, 
        .jumbotron  { 
          color: '. $color . ';
        }';
      }
      
      $box_ardound_content = of_get_option('box_ardound_content');
      if ($box_ardound_content){
        $theme_options_styles .= '
        #main article, 
        .page-template-page-homepage-php #main article{
          background: #fff;
          padding: 25px;
          border: 1px solid rgba(0, 0, 0, 0);
          border-color: #ddd;
          margin-bottom: 50px;
        }
        #main article{
          margin-bottom: 25px;
        }
        .pagination > .disabled > a,
        .pagination > li > a {
          background: #fff;
        }';
      }

      $color = of_get_option('social_color');
      if ($color) {
        $theme_options_styles .= '
        .social-profile { 
          color: ' . $color . '; 
        }';
      }

      
      $color = of_get_option('social_hover_color');
      if ($color) {
        $theme_options_styles .= '
        .social-profile:hover{ 
          color: ' . $color . '; 
        }';
      }
      
      $additional_css = of_get_option('custom_css');
      if( $additional_css ){
        $theme_options_styles .= $additional_css;
      }
          
      if($theme_options_styles){
        echo '<style>' 
        . $theme_options_styles . '
        </style>';
      }
    
} // end get_wpbs_theme_options function


?>