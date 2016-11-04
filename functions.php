<?php

//No directly files load

if ( ! function_exists( 'add_action' ) ) :
	exit(0);
endif;

if ( ! function_exists( 'theme_setup_features' ) ) {

	function theme_setup_features() {

		 /* nav menu registrations */

		register_nav_menus(
			array(
			    'main-menu'         => 'Main Menu',
				'footer-menu'		=> 'Footer Menu',
				'mobile-menu'		=> 'Mobile Menu',
				'extra-menu'		=> 'Extra Menu 1',
				'extra-menu-2'	    => 'Extra Menu 2',
			)
		);


		register_sidebar(
			array(
				'name'          => __( 'Home Widgets', 'theme_text_domain' ),
				'id'            => 'home-widgets',
				'description'   => 'Configura os Widgets da Homepage',
				'class'         => '',
				'before_widget' => '<li>',
				'after_widget'  => '</li>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
			)

		);

		/*
		 * add theme support for thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		/**
		 * Add feed link.
		 */
		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'post-formats', array(
		    'aside',
		    'gallery',
		    'link',
		    'image',
		    'quote',
		    'status',
		    'video',
		    'audio',
		    'chat'
		) );

		/**
		 * Support The Excerpt on pages.
		 */
		add_post_type_support( 'page', 'excerpt' );
		/**
		 * Switch default core markup for search form, comment form, and comments to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption'
			)
		);
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
	}
}

// Class to register  CPT - Credits to: https://github.com/jjgrainger/wp-custom-post-type-class/
// Documentation - https://github.com/jjgrainger/wp-custom-post-type-class

include_once('CPT.php');

//example
$books = new CPT('book');

$people = new CPT(array(
    'post_type_name' => 'person',
    'singular' => 'Person',
    'plural' => 'People',
    'slug' => 'people'
));


// Sets the thumbnail image size
//add_image_size( 'Name', width, height, array( 'center', 'center' ) );



// hide WP version
function wp_remove_version() {
	return '';
}

function new_excerpt_more($more) {
       global $post;
	return '<a class="btn-default btn-orange" href="'. get_permalink($post->ID) . '"> Leia mais + </a>';
}

add_filter('excerpt_more', 'new_excerpt_more');
add_filter('the_generator', 'wp_remove_version');
add_action( 'after_setup_theme', 'theme_setup_features' );
add_action( 'wp_enqueue_scripts', 'custom_scripts' ); // Enfileira os scripts
add_action( 'wp_enqueue_scripts', 'custom_styles' ); // enfileira os estilos




// Add SVG Mime type 

function custom_upload_mimes ( $existing_mimes=array() ) {
	$existing_mimes['svg'] = 'image/svg+xml';
	return $existing_mimes;
}

add_filter( 'upload_mimes', 'custom_upload_mimes' );


// Register and queue the Scripts
function custom_scripts() {

	wp_register_script( 'Jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', array(), '1.11.3', true );
	wp_enqueue_script( 'Jquery' );

	wp_register_script( 'uikit-jquery', get_template_directory_uri().'/assets/lib/uikit/js/jquery.js', array(), '1.11.3', true );
	wp_enqueue_script( 'uikit-jquery' );

	wp_register_script( 'uikit-js', get_template_directory_uri().'/assets/lib/uikit/js/uikit.js', array(), '', true );
	wp_enqueue_script( 'uikit-js' );

	wp_register_script( 'uikit-js-slideshow', get_template_directory_uri().'/assets/lib/uikit/js/components/slideshow.js', array(), '', true );
	wp_enqueue_script( 'uikit-js-slideshow' );

	wp_register_script( 'uikit-js-slideshowfx', get_template_directory_uri().'/assets/lib/uikit/js/components/slideshow-fx.min.js', array(), '', true );
	wp_enqueue_script( 'uikit-js-slideshowfx' );

	wp_register_script( 'main-js', get_template_directory_uri().'/assets/js/main.js', array(), '1.0.0', true );
	wp_enqueue_script( 'main-js' );


}

// Register and queue the Stlyes
function custom_styles() {

	wp_register_style( 'normalize', get_template_directory_uri().'/assets/css/normalize.css' , false , '1.0', 'all' );
	wp_enqueue_style( 'normalize' );

	wp_register_style( 'ui-kit', get_template_directory_uri().'/assets/lib/ukit/css/uikit.min.css' , false , '1.0', 'all' );
	wp_enqueue_style( 'ui-kit' );

	wp_register_style( 'ui-kit-slide-flat', get_template_directory_uri().'/assets/lib/uikit/css/uikit.almost-flat.min.css' , false , '1.0', 'all' );
	wp_enqueue_style( 'ui-kit-slide-flat' );

	wp_register_style( 'ui-kit-slideshow', get_template_directory_uri().'/assets/lib/uikit/css/components/slideshow.css' , false , '1.0', 'all' );
	wp_enqueue_style( 'ui-kit-slideshow' );

	wp_register_style( 'ui-kit-slidenav', get_template_directory_uri().'/assets/lib/uikit/css/components/slidenav.css' , false , '1.0', 'all' );
	wp_enqueue_style( 'ui-kit-slidenav' );

	wp_register_style( 'ui-kit-slidenav', get_template_directory_uri().'/assets/lib/uikit/css/components/slidenav.css' , false , '1.0', 'all' );
	wp_enqueue_style( 'ui-kit-slidenav' );

	wp_register_style( 'style', get_stylesheet_uri() , false , '1.0', 'all' );
	wp_enqueue_style( 'style' );

}
