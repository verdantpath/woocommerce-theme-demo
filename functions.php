<?php

add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'title-tag' );
add_theme_support( 'woocommerce' );

// remove woocommerce sorting dropdown from shop page

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

// remove ratings from product on shop page

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

// remove ratings from product on product single page

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );

// add reviews under main image gallery

add_action( 'woocommerce_before_single_product_summary', 'comments_template', 30);

// remove tabs section

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

function wpt_excerpt_length( $length ) {
	return 16;
}
add_filter( 'excerpt_length', 'wpt_excerpt_length', 999 );

function register_theme_menus() {

	register_nav_menus(
		array(
			'primary-menu' 	=> __( 'Primary Menu', 'treehouse-portfolio' )
		)
	);

}
add_action( 'init', 'register_theme_menus' );


function wpt_create_widget( $name, $id, $description ) {

	register_sidebar(array(
		'name' => __( $name ),
		'id' => $id,
		'description' => __( $description ),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="module-heading">',
		'after_title' => '</h2>'
	));

}

wpt_create_widget( 'Page Sidebar', 'page', 'Displays on the side of pages with a sidebar' );
wpt_create_widget( 'Blog Sidebar', 'blog', 'Displays on the side of pages in the blog section' );


function wpt_theme_styles() {

	wp_enqueue_style( 'foundation_css', get_template_directory_uri() . '/css/foundation.css' );
	//wp_enqueue_style( 'normalize_css', get_template_directory_uri() . '/css/normalize.css' );
	wp_enqueue_style( 'googlefont_css', 'http://fonts.googleapis.com/css?family=Asap:400,700,400italic,700italic' );
	wp_enqueue_style( 'main_css', get_template_directory_uri() . '/style.css' );

}
add_action( 'wp_enqueue_scripts', 'wpt_theme_styles' );

function wpt_theme_js() {

	wp_enqueue_script( 'modernizr_js', get_template_directory_uri() . '/js/modernizr.js', '', '', false );
	wp_enqueue_script( 'foundation_js', get_template_directory_uri() . '/js/foundation.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'main_js', get_template_directory_uri() . '/js/app.js', array('jquery', 'foundation_js'), '', true );

}
add_action( 'wp_enqueue_scripts', 'wpt_theme_js' );

?>
