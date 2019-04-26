<?php
add_action( 'init', 'ad_slider_init' );
/**
 * Register a book post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function ad_slider_init() {
	$labels = array(
		'name'               => _x( 'Ad Sliders', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Ad Slider', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Ad Sliders', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Ad Slider', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'ad slider', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Ad Slider', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Ad Slider', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Ad Slider', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Ad Slider', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Ad Slider', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Ad Slider', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Ad Slider:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No books found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No books found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'ad_slider' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'ad_slider', $args );
}