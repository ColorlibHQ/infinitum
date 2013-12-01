<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {

        // This gets the theme name from the stylesheet
        $themename = wp_get_theme();
        $themename = preg_replace("/\W/", "_", strtolower($themename) );

        $optionsframework_settings = get_option( 'optionsframework' );
        $optionsframework_settings['id'] = $themename;
        update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {
	
       // Test data
        $test_array = array(
                'one' => __('One', 'options_framework_theme'),
                'two' => __('Two', 'options_framework_theme'),
                'three' => __('Three', 'options_framework_theme'),
                'four' => __('Four', 'options_framework_theme'),
                'five' => __('Five', 'options_framework_theme')
        );

        // Multicheck Array
        $multicheck_array = array(
                'one' => __('French Toast', 'options_framework_theme'),
                'two' => __('Pancake', 'options_framework_theme'),
                'three' => __('Omelette', 'options_framework_theme'),
                'four' => __('Crepe', 'options_framework_theme'),
                'five' => __('Waffle', 'options_framework_theme')
        );

        // Multicheck Defaults
        $multicheck_defaults = array(
                'one' => '1',
                'five' => '1'
        );

        // Background Defaults
        $background_defaults = array(
                'color' => '',
                'image' => '',
                'repeat' => 'repeat',
                'position' => 'top center',
                'attachment'=>'scroll' );

        // Typography Defaults
        $typography_defaults = array(
                'size' => '14px',
                'face' => 'Helvetica Neue',
                'style' => 'normal',
                'color' => '#111111' );

        // Body Typography Defaults
        $heading_defaults = array(
                'size' => '36px',
                'face' => 'Helvetica Neue',
                'style' => 'normal',
                'color' => '#111111' );

        // Title Typography Defaults
        $title_defaults = array(
                'size' => '18px',
                'face' => 'Helvetica Neue',
                'style' => 'normal',
                'color' => '#ffffff' );

        // Typography Options
        $typography_options = array(
                'sizes' => array( '6','10','12','14','16','18','20','24','28','32','36','42','48' ),
                'faces' => array(
					'arial'     => 'Arial',
					'verdana'   => 'Verdana, Geneva',
					'trebuchet' => 'Trebuchet',
					'georgia'   => 'Georgia',
					'times'     => 'Times New Roman',
					'tahoma'    => 'Tahoma, Geneva',
					'palatino'  => 'Palatino',
					'helvetica' => 'Helvetica',
					'Helvetica Neue' => 'Helvetica Neue'
				),
                'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
                'color' => true
        );

     // Pull all the categories into an array
        $options_categories = array();
        $options_categories_obj = get_categories();
        foreach ($options_categories_obj as $category) {
                $options_categories[$category->cat_ID] = $category->cat_name;
        }

        // Pull all tags into an array
        $options_tags = array();
        $options_tags_obj = get_tags();
        foreach ( $options_tags_obj as $tag ) {
                $options_tags[$tag->term_id] = $tag->name;
        }


        // Pull all the pages into an array
        $options_pages = array();
        $options_pages_obj = get_pages('sort_column=post_parent,menu_order');
        $options_pages[''] = 'Select a page:';
        foreach ($options_pages_obj as $page) {
                $options_pages[$page->ID] = $page->post_title;
        }

        // If using image radio buttons, define a directory path
        $imagepath =  get_template_directory_uri() . '/images/';


		// fixed or scroll position
		$fixed_scroll = array("scroll" => "Scroll", "fixed" => "Fixed");
			
		$options = array();

		$options[] = array( "name" => __('Main', 'infinitum'),
							"type" => "heading");

		$options[] = array( "name" => __('Slider carousel on homepage', 'infinitum'),
							"desc" => __('Display the bootstrap slider carousel on homepage page template. This uses the WordPress featured images', 'infinitum'),
							"id" => "showhidden_slideroptions",
							"std" => "0",
							"type" => "checkbox");

		$options[] = array( "name" => __('Slider options', 'infinitum'),
							"desc" => __('Number of posts to show', 'infinitum'),
							"id" => "slider_options",
							"class" => "mini hidden",
							"std" => "3",
							"type" => "text");

		$options[] = array( "name" => __('Element color', 'infinitum'),
							"desc" => __('Default used if no color is selected', 'infinitum'),
							"id" => "element_color",
							"std" => "",
							"type" => "color");

		$options[] = array( "name" => __('Element color on hover', 'infinitum'),
							"desc" => __('Default used if no color is selected', 'infinitum'),
							"id" => "element_color_hover",
							"std" => "",
							"type" => "color");

		$options[] = array( "name" => __('Boxed Layout', 'infinitum'),
							"desc" => __('Show boxed layout for article body', 'infinitum'),
							"id" => "box_ardound_content",
							"std" => "1",
							"type" => "checkbox");

		$options[] = array( "name" => __('Custom Favicon', 'infinitum'),
							"desc" => __('Upload a 32px x 32px PNG/GIF image that will represent your websites favicon', 'infinitum'),
							"id" => "custom_favicon",
							"std" => "",
							"type" => "upload");

		$options[] = array( "name" => __('Typography', 'infinitum'),
							"type" => "heading");
							
	    $options[] = array( 'name' => __('Headings', 'infinitum'),
	    					'desc' => __('Used for H1 tag', 'infinitum'),
	    					'id' => "heading_typography",
							"std" => $heading_defaults,
							"type" => "typography",
							"options" => $typography_options );
							
		$options[] = array( "name" => __('Main Body Text', 'infinitum'),
							"desc" => __('Used in P tags', 'infinitum'),
							"id" => "main_body_typography",
							"std" => $typography_defaults,
							"type" => "typography",
							"options" => $typography_options );

		$options[] = array( "name" => __('Website Title Color', 'infinitum'),
							"desc" => __('Used for website title in top navigation', 'infinitum'),
							"id" => "title_typography",
							"std" => $title_defaults,
							"type" => "typography",
							"options" => $typography_options );
							
		$options[] = array( "name" => __('Link Color', 'infinitum'),
							"desc" => __('Default used if no color is selected', 'infinitum'),
							"id" => "link_color",
							"std" => "",
							"type" => "color");
						
		$options[] = array( "name" => __('Link:hover Color', 'infinitum'),
							"desc" => __('Default used if no color is selected', 'infinitum'),
							"id" => "link_hover_color",
							"std" => "",
							"type" => "color");
							
		$options[] = array( "name" => __('Link:active Color', 'infinitum'),
							"desc" => __('Default used if no color is selected', 'infinitum'),
							"id" => "link_active_color",
							"std" => "",
							"type" => "color");
							
		$options[] = array( "name" => __('Top Nav', 'infinitum'),
							"type" => "heading");
							
		$options[] = array( "name" => __('Position', 'infinitum'),
							"desc" => __('Fixed to the top of the window or scroll with content', 'infinitum'),
							"id" => "nav_position",
							"std" => "",
							"type" => "select",
							"class" => "mini", //mini, tiny, small
							"options" => $fixed_scroll);
							
		$options[] = array( "name" => __('Top nav background color', 'infinitum'),
							"desc" => __('Default used if no color is selected.', 'infinitum'),
							"id" => "top_nav_bg_color",
							"std" => "",
							"type" => "color");

		$options[] = array( "name" => __('Top nav background color on hover', 'infinitum'),
							"desc" => __('Default used if no color is selected', 'infinitum'),
							"id" => "top_nav_bg_hover_color",
							"std" => "",
							"type" => "color");
		
		$options[] = array( "name" => __('Bottom gradient color', 'infinitum'),
							"desc" => __('Top nav background color used as top gradient color', 'infinitum'),
							"id" => "top_nav_bottom_gradient_color",
							"std" => "",
							"class" => "hidden",
							"type" => "color");
							
		$options[] = array( "name" => __('Top nav item color', 'infinitum'),
							"desc" => __('Link color', 'infinitum'),
							"id" => "top_nav_link_color",
							"std" => "",
							"type" => "color");
							
		$options[] = array( "name" => __('Top nav item hover color', 'infinitum'),
							"desc" => __('Link hover color', 'infinitum'),
							"id" => "top_nav_link_hover_color",
							"std" => "",
							"type" => "color");
							
		$options[] = array( "name" => __('Top nav dropdown item color', 'infinitum'),
							"desc" => __('Dropdown item color', 'infinitum'),
							"id" => "top_nav_dropdown_item",
							"std" => "",
							"type" => "color");
							
		$options[] = array( "name" => __('Top nav dropdown item hover bg color', 'infinitum'),
							"desc" => __('Background of dropdown item hover color', 'infinitum'),
							"id" => "top_nav_dropdown_hover_bg",
							"std" => "",
							"type" => "color");
							
		$options[] = array( "name" => __('Footer', 'infinitum'),
							"type" => "heading");
							
		$options[] = array( "name" => __('Footer background', 'infinitum'),
							"desc" => __('Footer area background color', 'infinitum'),
							"id" => "footer_background_color",
							"std" => "",
							"type" => "color");

		$options[] = array( "name" => __('Footer text color', 'infinitum'),
							"desc" => __('Footer area text color', 'infinitum'),
							"id" => "footer_text_color",
							"std" => "",
							"type" => "color");

		$options[] = array(	'name' => __('Footer information', 'infinitum'),
                			'desc' => __('Copyright text in footer', 'infinitum'),
                			'id' => 'custom_footer_text',
                			'std' => '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" >' . get_bloginfo( 'name', 'display' ) . '</a>.  All rights reserved.',
                			'class' => 'mini',
                			'type' => 'textarea');

		$options[] = array( "name" => __('Social', 'infinitum'),
							"type" => "heading");

		$options[] = array( "name" => __('Social Icon Color', 'infinitum'),
							"desc" => __('Default used if no color is selected', 'infinitum'),
							"id" => "social_color",
							"std" => "",
							"type" => "color");
						
		$options[] = array( "name" => __('Social Icon:hover Color', 'infinitum'),
							"desc" => __('Default used if no color is selected', 'infinitum'),
							"id" => "social_hover_color",
							"std" => "",
							"type" => "color");	 	

		$options[] = array(	'name' => __('Add full URL for your social network profiles', 'infinitum'),
                			'desc' => __('Facebook', 'infinitum'),
                			'id' => 'social_facebook',
                			'std' => '',
                			'class' => 'mini',
                			'type' => 'text');

		$options[] = array(	'id' => 'social_twitter',
							'desc' => __('Twitter', 'infinitum'),
                			'std' => '',
                			'class' => 'mini',
                			'type' => 'text');

		$options[] = array(	'id' => 'social_google',
							'desc' => __('Google+', 'infinitum'),
                			'std' => '',
                			'class' => 'mini',
                			'type' => 'text');

		$options[] = array(	'id' => 'social_youtube',
							'desc' => __('Youtube', 'infinitum'),
                			'std' => '',
                			'class' => 'mini',
                			'type' => 'text');	                 				    

		$options[] = array(	'id' => 'social_linkedin',
							'desc' => __('LinkedIn', 'infinitum'),
                			'std' => '',
                			'class' => 'mini',
                			'type' => 'text');	 

		$options[] = array(	'id' => 'social_pinterest',
							'desc' => __('Pinterest', 'infinitum'),
                			'std' => '',
                			'class' => 'mini',
                			'type' => 'text');

		$options[] = array(	'id' => 'social_feed',
							'desc' => __('RSS Feed', 'infinitum'),
                			'std' => '',
                			'class' => 'mini',
                			'type' => 'text');

		$options[] = array(	'id' => 'social_tumblr',
							'desc' => __('Tumblr', 'infinitum'),
                			'std' => '',
                			'class' => 'mini',
                			'type' => 'text');	

        $options[] = array(	'id' => 'social_flickr',
							'desc' => __('Flickr', 'infinitum'),
                			'std' => '',
                			'class' => 'mini',
                			'type' => 'text');	

        $options[] = array(	'id' => 'social_instagram',
							'desc' => __('Instagram', 'infinitum'),
                			'std' => '',
                			'class' => 'mini',
                			'type' => 'text');	

        $options[] = array(	'id' => 'social_dribbble',
							'desc' => __('Dribbble', 'infinitum'),
                			'std' => '',
                			'class' => 'mini',
                			'type' => 'text');	

        $options[] = array(	'id' => 'social_skype',
							'desc' => __('Skype', 'infinitum'),
                			'std' => '',
                			'class' => 'mini',
                			'type' => 'text');	    

		$options[] = array( "name" => __('Other', 'infinitum'),
							"type" => "heading");

		$options[] = array( "name" => __('Homepage jumbotron background color', 'infinitum'),
							"desc" => __('Default used if no color is selected', 'infinitum'),
							"id" => "jumbotron_bg_color",
							"std" => "",
							"type" => "color");

		$options[] = array( "name" => __('Homepage jumbotron text color', 'infinitum'),
							"desc" => __('Default used if no color is selected', 'infinitum'),
							"id" => "jumbotext_color",
							"std" => "",
							"type" => "color");

		$options[] = array( "name" => __('Blog page jumbotron', 'infinitum'),
							"desc" => __('Display blog page jumbotron', 'infinitum'),
							"id" => "blog_hero",
							"std" => "0",
							"type" => "checkbox");
		
		$options[] = array( "name" => __('Custom CSS', 'infinitum'),
							"desc" => __('Additional CSS', 'infinitum'),
							"id" => "custom_css",
							"std" => "",
							"type" => "textarea");


		return $options;
}