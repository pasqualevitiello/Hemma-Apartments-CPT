<?php

/**
 * Create Hemma Apartments custom post types
 *
 * @since    1.0.0
 */
function hemma_apartments_cpt() {
	    
	$labels = array(
	 	'name' => _x( 'Apartments', 'post type general name', 'hemma-cpt-apartments' ),
		'singular_name' => _x( 'Apartment', 'post type singular name', 'hemma-cpt-apartments' ),
		'menu_name' => _x( 'Apartments', 'admin menu', 'hemma-cpt-apartments' ),
		'name_admin_bar' => _x( 'Apartment', 'add new on admin bar', 'hemma-cpt-apartments' ),
		'add_new' => _x( 'Add New', 'Apartment', 'hemma-cpt-apartments' ),
		'add_new_item' => __( 'Add New Apartment', 'hemma-cpt-apartments' ),
		'new_item' => __( 'New Apartment', 'hemma-cpt-apartments' ),
		'edit_item' => __( 'Edit Apartment', 'hemma-cpt-apartments' ),
		'view_item' => __( 'View Apartment', 'hemma-cpt-apartments' ),
		'all_items' => __( 'All Apartments', 'hemma-cpt-apartments' ),
		'search_items' =>  __( 'Search Apartments', 'hemma-cpt-apartments' ),
		'parent_item_colon' => __( 'Parent Apartments:', 'hemma-cpt-apartments' ),
		'not_found' => __( 'No Apartments Found', 'hemma-cpt-apartments'),
		'not_found_in_trash' => __( 'No Apartments found in Trash', 'hemma-cpt-apartments' )
	 );
	 
	 $args = array(
			'labels' => $labels,
			'singular_label' => __( 'Apartment', 'hemma-cpt-apartments' ),
			'public' => true,
			'show_ui' => true,
			'hierarchical' => false,
			'has_archive' => false,
			'menu_icon' => 'dashicons-grid-view',
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions' ),
			'taxonomies' => array( 'apartmentcategory', 'post_tag' )
       );  
   
    register_post_type( 'apartment' , $args );  

}
add_action( 'init', 'hemma_apartments_cpt' );

/**
 * Create Hemma Apartments taxonomy
 *
 * @since    1.0.0
 */
function hemma_apartments_taxonomy() {
 
	$labels = array(
	    'name' => _x( 'Apartment Categories', 'taxonomy general name', 'hemma-cpt-apartments' ),
	    'singular_name' => _x( 'Category', 'taxonomy singular name', 'hemma-cpt-apartments' ),
	    'search_items' =>  __( 'Search Categories', 'hemma-cpt-apartments' ),
	    'popular_items' => __( 'Popular Categories', 'hemma-cpt-apartments' ),
	    'all_items' => __( 'All Categories', 'hemma-cpt-apartments' ),
	    'parent_item' => null,
	    'parent_item_colon' => null,
	    'edit_item' => __( 'Edit Category', 'hemma-cpt-apartments' ),
	    'update_item' => __( 'Update Category', 'hemma-cpt-apartments' ),
	    'add_new_item' => __( 'Add New Category', 'hemma-cpt-apartments' ),
	    'new_item_name' => __( 'New Category Name', 'hemma-cpt-apartments' ),
	    'separate_items_with_commas' => __( 'Separate categories with commas', 'hemma-cpt-apartments' ),
	    'add_or_remove_items' => __( 'Add or remove categories', 'hemma-cpt-apartments' ),
	    'choose_from_most_used' => __( 'Choose from the most used categories', 'hemma-cpt-apartments' )
	);
	 
	register_taxonomy( 'apartmentcategory', 'apartment', array(
	    'label' => __( 'Apartment Category', 'hemma-cpt-apartments' ),
	    'labels' => $labels,
	    'hierarchical' => true,
	    'show_ui' => true,
	    'query_var' => true,
	    'rewrite' => array( 'slug' => 'apartment-category' ),
	));

}
add_action( 'init', 'hemma_apartments_taxonomy', 0 );

/**
 * Adds custom apartment classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function hemma_apartment_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	$header_position = get_theme_mod( 'header_position', 'header-position-1'  );

	// Add hero class
	if  ( is_singular( array( 'apartment' ) ) || is_page_template( 'template-apartment.php' ) ) {
		$classes[] = 'is-hero';

		if ( $header_position == 'header-position-2' ) {
			$classes[] = 'is-header-static';
		}
	}

	// Handle body classes based on Customizer options
	$logo_center_class = 'is-logo-centered';
	$logo_image_class = 'is-logo-image';
	$hamburger_left_class = 'is-hamburger-left';
	$frame_layout_class = 'is-block-frame';
	$menu_desktop_class = 'is-menu-desktop';
	$preloader_class = 'is-loader';
	$gallery_class = 'gallery-first-big';
	$lightbox_class = "is-lightbox-enabled";
	$block_animation_class = 'is-block-animation';
	$no_sidebar_class = 'has-no-sidebar';

	$header_layout = get_theme_mod( 'header_layout', 'header-1'  );
	$logo_img_1x_regul = get_theme_mod( 'logo_image_1', '' );
	$logo_img_2x_regul = get_theme_mod( 'logo_image_2', '' );
	$site_layout = get_theme_mod( 'site_layout', '' );
	$accent_color = get_theme_mod( 'accent_color', '' );
	$preloader = get_theme_mod( 'preloader', false );
	$gallery_first_post = get_theme_mod( 'gallery_first_post', false );
	$enable_lightbox = get_theme_mod( 'enable_lightbox', false );
	$enable_block_animation = get_theme_mod( 'enable_block_animation', false );

	switch ( $header_layout ) {
	    case 'header-1' :
	        $classes[] = '';
	        break;
	    case 'header-2' :
	        $classes[] = join( ' ', array( $menu_desktop_class ) );
	        break;
	    case 'header-3' :
	        $classes[] = join( ' ', array( $hamburger_left_class, $logo_center_class ) );
	        break;
	    case 'header-4' :
	        $classes[] = join( ' ', array( $logo_center_class ) );
	        break;
	}

	if ( $logo_img_1x_regul !== '' || $logo_img_2x_regul !== '' ) {
		$classes[] = $logo_image_class;
	}

	if ( $site_layout == 'layout-2' ) {
		$classes[] = $frame_layout_class;
	}

	if ( $accent_color && $accent_color != 'is-default' ) {
		$classes[] = 'accent-' . $accent_color;
	}

	if ( $preloader == true ) {
		$classes[] = $preloader_class;
	}

	if ( $gallery_first_post == true ) {
		$classes[] = $gallery_class;
	}

	if ( $enable_lightbox == true ) {
		$classes[] = $lightbox_class;
	}

	if ( $enable_block_animation == true ) {
		$classes[] = $block_animation_class;
	}

	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = $no_sidebar_class;
	}

	return $classes;
}
add_filter( 'body_class', 'hemma_apartment_body_classes' );

/**
 * Adds custom apartment classes to the array of header classes.
 *
 * @param array $classes Classes for the header element.
 * @return array
 */
function hemma_apartment_header_classes( $classes ) {
	global $post;
	$header_position = get_theme_mod( 'header_position', 'header-position-1'  );

	// Add hero class
	if  ( ( is_singular( array( 'apartment' ) ) || is_page_template( 'template-apartment.php' ) ) && ( $header_position != 'header-position-2' ) ) {
		$classes[] = 'is-hero-on';
	}

	return $classes;
}
add_filter( 'post_class', 'hemma_apartment_header_classes' );

function hemma_customize_child_theme_setup() {
	/**
	 * Add the Enable comments on apartment single posts control
	 */
	hemma_Kirki::add_field( 'hemma_theme', array(
		'type'        => 'switch',
		'settings'    => 'enable_apartment_comments',
		'label'       => esc_html__( 'Comments on apartment posts', 'hemma' ),
		'description' => esc_html__( 'Enable comments on apartment single posts.', 'hemma' ),
		'section'     => 'post_settings',
		'priority'    => 10,
		'default'     => 'off',
		'choices'     => array(
			'on'  => esc_html__( 'On', 'hemma' ),
			'off' => esc_html__( 'Off', 'hemma' ),
		),
	) );

	/**
	 * Add the Apartment pages show at most control
	 */
	hemma_Kirki::add_field( 'hemma_theme', array(
		'type'        => 'number',
		'settings'    => 'apartment_posts_per_page',
		'label'       => esc_html__( 'Apartment posts per page.', 'hemma' ),
		'description' => esc_html__( 'Set the value to -1 if to show all posts.', 'hemma' ),
		'section'     => 'post_settings',
		'priority'    => 10,
		'default'     => 5,
	) );
	}
add_action( 'after_setup_theme', 'hemma_customize_child_theme_setup' );

/**
 * Add Subtitle Meta Box in Apartment pages
 */
add_action( 'cmb2_admin_init', 'opendept_register_apartment_subtitle_metabox' );
function opendept_register_apartment_subtitle_metabox() {
	$prefix = 'opendept_apartment_subtitle_';

	$cmb_subtitle = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Add Subtitle', 'hemma' ),
		'object_types'  => array( 'apartment' ),
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => false,
	) );

	$cmb_subtitle->add_field( array(
		'name' => esc_html__( 'Add Subtitle', 'hemma' ),
		'desc' => esc_html__( 'Leave empty if you don\'t want to show a subtitle', 'hemma' ),
		'id'   => $prefix . 'subtitle',
		'type' => 'text',
	) );

}

/**
 * Add Filter Posts Meta Box in Apartment pages
 */
add_action( 'cmb2_admin_init', 'opendept_register_filter_apartment_metabox' );
function opendept_register_filter_apartment_metabox() {
	$prefix = 'opendept_filter_apartment_';

	$cmb_filter = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Filter Apartments', 'hemma' ),
		'object_types'  => array( 'page' ),
		'show_on'       => array( 'key' => 'cpt-template', 'value' => array( 'template-apartment' ) ),
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => false,
	) );

	$cmb_filter->add_field( array(
	    'name'       => esc_html__( 'Filter posts by Category', 'hemma' ),
	    'desc'       => esc_html__( 'Select the apartment category you want to filter or leave "None". If you can\'t see any option in the list that\'s because you haven\'t any apartment category yet.', 'hemma' ),
	    'id'         => $prefix . 'filter_category',
	    'type'       => 'select',
	    'options_cb' => 'cmb2_get_term_options',
	    'get_terms_args' => array(
	        'taxonomy'   => 'apartmentcategory',
	        'hide_empty' => true,
	    ),
	) );
}

/**
 * Add Hero Setting Meta Box in Apartment posts and Apartment pages
 */
add_action( 'cmb2_admin_init', 'opendept_register_apartment_hero_settings_metabox' );
function opendept_register_apartment_hero_settings_metabox() {
	$prefix = 'opendept_hero_apartment_';

	$cmb_hero = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Hero Settings', 'hemma' ),
		'object_types'  => array( 'apartment' ),
		'context'       => 'side',
		'priority'      => 'core',
		'show_names'    => false,
	) );

	$cmb_hero->add_field( array(
		'name'    => esc_html__( 'Fade color', 'hemma' ),
		'desc'    => esc_html__( 'Fade background image with an overlay color', 'hemma' ),
		'id'      => $prefix . 'color',
		'type'    => 'rgba_colorpicker',
		'default' => 'rgba(53,63,73,0)',
	) );

	$cmb_hero->add_field( array(
		'name'    => esc_html__( 'Titles alignment', 'hemma' ),
		'desc'    => esc_html__( 'Align the title and the subtitle to left or center', 'hemma' ),
		'id'      => $prefix . 'align',
		'type'    => 'radio',
		'default' => 'is-centered',
		'options' => array(
			'is-left'     => esc_html__( 'Align left', 'hemma' ),
			'is-centered' => esc_html__( 'Align center', 'hemma' ),
		),
	) );

	$cmb_hero->add_field( array(
		'name' => esc_html__( 'Hero Height', 'hemma' ),
		'desc' => esc_html__( 'The minimum height of the hero', 'hemma' ),
		'id'   => $prefix . 'height',
		'type' => 'select',
		'options' => array(
	        'is-contentheight' => esc_html__( 'Content Height', 'hemma' ),
	        'is-halfheight'    => esc_html__( 'Half browser height', 'hemma' ),
	        'is-fullheight'    => esc_html__( 'Full browser height', 'hemma' ),
	    ),
	    'default' => 'is-fullheight'
	) );

	$cmb_hero->add_field( array(
	    'name' => esc_html__( 'Hero Background Color', 'hemma' ),
	    'desc' => esc_html__( 'The background color of the hero (useful if there is no image)', 'hemma' ),
	    'id'   => $prefix . 'bg_color',
	    'type' => 'select',
	    'show_option_none' => true,
	    'options' => array(
	    	'is-red'        => esc_html__( 'Red', 'hemma' ),
	    	'is-orange'     => esc_html__( 'Orange', 'hemma' ),
	    	'is-yellow'     => esc_html__( 'Yellow', 'hemma' ),
	    	'is-green'      => esc_html__( 'Green', 'hemma' ),
	    	'is-light-blue' => esc_html__( 'Light Blue', 'hemma' ),
	    	'is-blue'       => esc_html__( 'Blue', 'hemma' ),
	    	'is-purple'     => esc_html__( 'Purple', 'hemma' ),
	    	'is-pink'       => esc_html__( 'Pink', 'hemma' ),
	    	'is-brown'      => esc_html__( 'Brown', 'hemma' ),
	    	'is-dark'       => esc_html__( 'Dark', 'hemma' ),
	    ),
	) );

	$cmb_hero->add_field( array(
	    'name'    => esc_html__( 'Display mouse scroll icon', 'hemma' ),
	    'desc'    => esc_html__( 'Tick this if you want to show a mouse scroll icon at the bottom of the section', 'hemma' ),
	    'id'      => $prefix . 'mouse_icon',
	    'type'    => 'checkbox',
	) );

}

/**
 * Add Edit Apartment Meta Box in Apartment posts
 */
add_action( 'cmb2_admin_init', 'opendept_register_apartment_metabox' );
function opendept_register_apartment_metabox() {
	$prefix = 'opendept_apartment_';

	$cmb_apartment = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Edit Apartment', 'hemma' ),
		'object_types'  => array( 'apartment' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$cmb_apartment->add_field( array(
		'name' => esc_html__( 'Guests per apartment', 'hemma' ),
		'desc' => esc_html__( 'Leave empty if you don\'t want to show the guests information', 'hemma' ),
		'id'   => $prefix . 'guests',
		'type' => 'text_small',
	) );

	$cmb_apartment->add_field( array(
		'name' => esc_html__( 'Beds per apartment', 'hemma' ),
		'desc' => esc_html__( 'Leave empty if you don\'t want to show the beds information', 'hemma' ),
		'id'   => $prefix . 'beds',
		'type' => 'text_small',
	) );

	$cmb_apartment->add_field( array(
		'name' => esc_html__( 'Apartment size', 'hemma' ),
		'desc' => esc_html__( 'Leave empty if you don\'t want to show the apartment size', 'hemma' ),
		'id'   => $prefix . 'size',
		'type' => 'text_small',
	) );

}

/**
 * Add Apartment Sidebar Meta Box in Apartment posts
 */
add_action( 'cmb2_admin_init', 'opendept_register_apartment_sidebar_metabox' );
function opendept_register_apartment_sidebar_metabox() {
	$prefix = 'opendept_apartment_sidebar_';

	$cmb_apartment_sidebar = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Sidebar Settings', 'hemma' ),
		'object_types'  => array( 'apartment' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$cmb_apartment_sidebar->add_field( array(
	    'name' => esc_html__( 'Enable apartment sidebar', 'hemma' ),
	    'desc' => esc_html__( 'Tick this to show the sidebar on this page', 'hemma' ),
	    'id'   => $prefix . 'enable_sidebar',
	    'type' => 'checkbox',
	) );


	$cmb_apartment_sidebar->add_field( array(
	    'name' => esc_html__( 'Show price box', 'hemma' ),
	    'desc' => esc_html__( 'That\'s the grey zone where you can set the apartment price and the call-to-action button', 'hemma' ),
	    'id'   => $prefix . 'enable_box',
	    'type' => 'checkbox',
	) );

	$cmb_apartment_sidebar->add_field( array(
	    'name'    => esc_html__( 'Price box title', 'hemma' ),
	    'desc'    => esc_html__( 'The first paragraph in the grey box (e.g. &ldquo;Rates from&rdquo;)', 'hemma' ),
	    'id'      => $prefix . 'box_title',
	    'type'    => 'text',
	    'default' => esc_html__( 'Rates from', 'hemma' ),
	) );

	$cmb_apartment_sidebar->add_field( array(
	    'name' => esc_html__( 'Apartment Price', 'hemma' ),
	    'desc' => esc_html__( 'Price of the apartment', 'hemma' ),
	    'id'   => $prefix . 'box_price',
	    'type' => 'text_small',
	) );

	$cmb_apartment_sidebar->add_field( array(
	    'name'    => esc_html__( 'Price details', 'hemma' ),
	    'desc'    => esc_html__( 'The paragraph below the price (e.g. &ldquo;per night&rdquo;)', 'hemma' ),
	    'id'      => $prefix . 'box_price_per',
	    'type'    => 'text',
	    'default' => esc_html__( 'per night', 'hemma' ),
	) );

	$cmb_apartment_sidebar->add_field( array(
	    'name'    => esc_html__( 'Button text', 'hemma' ),
	    'desc'    => esc_html__( 'Leave empty if you don\'t want to show the button', 'hemma' ),
	    'id'      => $prefix . 'box_button_text',
	    'type'    => 'text',
	) );

	$cmb_apartment_sidebar->add_field( array(
	    'name'    => esc_html__( 'Button link', 'hemma' ),
	    'desc'    => esc_html__( 'The button link (e.g. http://www.website.com)', 'hemma' ),
	    'id'      => $prefix . 'box_button_link',
	    'type'    => 'text_url',
	) );

	$cmb_apartment_sidebar->add_field( array(
	    'name' => esc_html__( 'Button color', 'hemma' ),
	    'id'   => $prefix . 'box_button_color',
	    'type' => 'select',
	    'show_option_none' => true,
	    'options' => array(
	    	'is-red'        => esc_html__( 'Red', 'hemma' ),
	    	'is-orange'     => esc_html__( 'Orange', 'hemma' ),
	    	'is-yellow'     => esc_html__( 'Yellow', 'hemma' ),
	    	'is-green'      => esc_html__( 'Green', 'hemma' ),
	    	'is-light-blue' => esc_html__( 'Light Blue', 'hemma' ),
	    	'is-blue'       => esc_html__( 'Blue', 'hemma' ),
	    	'is-purple'     => esc_html__( 'Purple', 'hemma' ),
	    	'is-pink'       => esc_html__( 'Pink', 'hemma' ),
	    	'is-brown'      => esc_html__( 'Brown', 'hemma' ),
	    	'is-dark'       => esc_html__( 'Dark', 'hemma' ),
	    	'is-white'      => esc_html__( 'White', 'hemma' ),
	    ),
	) );

	$cmb_apartment_sidebar->add_field( array(
	    'name' => esc_html__( 'Button link opens a new page?', 'hemma' ),
	    'desc' => esc_html__( 'Tick this if you want to open the link in a new page', 'hemma' ),
	    'id'   => $prefix . 'box_button_target',
	    'type' => 'checkbox',
	) );

	$cmb_apartment_sidebar->add_field( array(
	    'name'    => esc_html__( 'Extra notes', 'hemma' ),
	    'desc'    => esc_html__( 'Use this field to add extra notes to the grey box', 'hemma' ),
	    'id'      => $prefix . 'box_notes',
	    'type'    => 'textarea',
	) );

	$cmb_apartment_sidebar->add_field( array(
	    'name'    => esc_html__( 'Other sidebar informations', 'hemma' ),
	    'id'      => $prefix . 'content',
	    'type'    => 'wysiwyg',
	    'options' => array(
	    	'media_buttons' => false,
	    	'teeny'         => true,
	    	'wpautop'       => true,
	    ),
	) );

}