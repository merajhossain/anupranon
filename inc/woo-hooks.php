<?php
add_action( 'init', 'custom_taxonomy_Writer' );
function custom_taxonomy_Writer()  {
    $labels = array(
        'name'                       => 'Writers',
        'singular_name'              => 'Writer',
        'menu_name'                  => 'Writer',
        'all_items'                  => 'All Writers',
        'parent_item'                => 'Parent Writer',
        'parent_item_colon'          => 'Parent Writer:',
        'new_item_name'              => 'New Writer Name',
        'add_new_item'               => 'Add New Writer',
        'edit_item'                  => 'Edit Writer',
        'update_item'                => 'Update Writer',
        'separate_items_with_commas' => 'Separate Writer with commas',
        'search_items'               => 'Search Writers',
        'add_or_remove_items'        => 'Add or remove Writers',
        'choose_from_most_used'      => 'Choose from the most used Writers',
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'rewrite'           => array( 'slug' => 'writer' ),
        'query_var' => true
    );
    register_taxonomy( 'writer', 'product', $args );
    register_taxonomy_for_object_type( 'writer', 'product' );
}

add_action( 'init', 'custom_taxonomy_Publisher' );
function custom_taxonomy_Publisher()  {
    $labels = array(
        'name'                       => 'Publishers',
        'singular_name'              => 'Publisher',
        'menu_name'                  => 'Publisher',
        'all_items'                  => 'All Publishers',
        'parent_item'                => 'Parent Publisher',
        'parent_item_colon'          => 'Parent Publisher:',
        'new_item_name'              => 'New Publisher Name',
        'add_new_item'               => 'Add New Publisher',
        'edit_item'                  => 'Edit Publisher',
        'update_item'                => 'Update Publisher',
        'separate_items_with_commas' => 'Separate Publisher with commas',
        'search_items'               => 'Search Publishers',
        'add_or_remove_items'        => 'Add or remove Publishers',
        'choose_from_most_used'      => 'Choose from the most used Publishers',
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'rewrite'           => array( 'slug' => 'publisher' ),
        'query_var' => true
    );
    register_taxonomy( 'publisher', 'product', $args );
    register_taxonomy_for_object_type( 'publisher', 'product' );
}

add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.GLOBAL_PRODUCTS_PER_PAGE.';' ), 20 );

add_filter( 'woocommerce_breadcrumb_defaults', 'jk_woocommerce_breadcrumbs' );
function jk_woocommerce_breadcrumbs() {
    return array(
            'delimiter'   => '  ',
            'wrap_before' => '<ol class="breadcrumb">',
            'wrap_after'  => '</ol>',
            'before'      => '<li>',
            'after'       => '</li>',
            'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
        );
}

// define the woocommerce_before_shop_loop_item callback 
function action_woocommerce_before_shop_loop_item(  ){
    //echo "beforeeeeee";
}
remove_action( 'woocommerce_before_shop_loop_item', 'action_woocommerce_before_shop_loop_item', 10, 0 );
add_action( 'woocommerce_before_shop_loop_item', 'action_woocommerce_before_shop_loop_item', 10, 0 );

add_action( 'woocommerce_after_shop_loop_item_title', array( WC_Wishlists_Plugin, 'add_to_wishlist_button' ), 10 );

// define the woocommerce_before_shop_loop_item_title callback 
function action_woocommerce_before_shop_loop_item_title(  ){
    //echo "beforeeeeee";
}
remove_action( 'woocommerce_before_shop_loop_item_title', 'action_woocommerce_before_shop_loop_item_title', 10, 0 );
//add_action( 'woocommerce_before_shop_loop_item_title', 'action_woocommerce_before_shop_loop_item_title', 10, 0 );

// define the woocommerce_before_shop_loop_item callback 
function action_woocommerce_shop_loop_item_title(  ){
    //echo "beforeeeeee";
}
remove_action( 'woocommerce_shop_loop_item_title', 'action_woocommerce_shop_loop_item_title', 10, 0 );
//add_action( 'woocommerce_shop_loop_item_title', 'action_woocommerce_shop_loop_item_title', 10, 0 );

// define the woocommerce_before_shop_loop_item callback 
function action_woocommerce_after_shop_loop_item_title(  ){
    //echo "beforeeeeee";
}
remove_action( 'woocommerce_after_shop_loop_item_title', 'action_woocommerce_after_shop_loop_item_title', 10, 0 );
//add_action( 'woocommerce_after_shop_loop_item_title', 'action_woocommerce_after_shop_loop_item_title', 10, 0 );

// define the woocommerce_before_shop_loop_item callback 
function action_woocommerce_after_shop_loop_item(  ){
    //echo "beforeeeeee";
}
remove_action( 'woocommerce_after_shop_loop_item', 'action_woocommerce_after_shop_loop_item', 10, 0 );
add_action( 'woocommerce_after_shop_loop_item', 'action_woocommerce_after_shop_loop_item', 10, 0 );


add_filter('woocommerce_default_catalog_orderby', 'custom_default_catalog_orderby');

function custom_default_catalog_orderby() {
     return 'date'; // Can also use title and price
}
