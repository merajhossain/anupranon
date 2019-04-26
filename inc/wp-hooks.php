<?php
function bq_enqueue_styles_scripts() {
    wp_enqueue_style( 'core', get_stylesheet_uri() );
    wp_enqueue_style( 'bootstrap', get_template_directory_uri()."/assets/plugins/bootstrap/css/bootstrap.min.css" );
    wp_enqueue_style( 'essentials', get_template_directory_uri()."/assets/css/essentials.css" );
    wp_enqueue_style( 'layout', get_template_directory_uri()."/assets/css/layout.css" );
    wp_enqueue_style( 'header-1', get_template_directory_uri()."/assets/css/header-1.css" );
    wp_enqueue_style( 'layout-shop', get_template_directory_uri()."/assets/css/layout-shop.css" );
    wp_enqueue_style( 'green', get_template_directory_uri()."/assets/css/color_scheme/green.css" );
    wp_enqueue_style( 'custom', get_template_directory_uri()."/assets/css/custom.css" );
    wp_enqueue_style( 'jquery-ui', "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" );

    wp_deregister_script("jquery");
    wp_enqueue_script( 'jquery', get_template_directory_uri()."/assets/plugins/jquery/jquery-2.1.4.min.js", array(), "2.1.4", TRUE );
    wp_enqueue_script( 'custom_front', get_template_directory_uri()."/assets/js/custom-front.js", "jquery", "1.0.0", TRUE );
    wp_localize_script( 'custom_front', 'bqFront', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
    wp_enqueue_script( 'scripts', get_template_directory_uri()."/assets/js/scripts.js", "jquery", "1.0.0", TRUE );
    wp_localize_script( 'scripts', 'bq', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'plugin_path'=>get_template_directory_uri()."/assets/plugins/"));
    wp_enqueue_script( 'photo-gallery', get_template_directory_uri()."/assets/js/photo-gallery.js", "jquery", "1.0.0", TRUE );
    wp_enqueue_script( 'jquery-ui-js', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', "jquery", "1.0.0", TRUE  );

    //wp_enqueue_script( 'shop', get_template_directory_uri()."/assets/js/view/demo.shop.js", "jquery", "1.0.0", TRUE );

}

add_action( 'wp_enqueue_scripts', 'bq_enqueue_styles_scripts' );

/*class My_Walker_Nav_Menu extends Walker_Nav_Menu {
  function start_lvl(&$output, $depth) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"dropdown-menu has-topBar sub-menu\">\n";
  }
}*/

/* Date links for custom post type archive start */
add_filter( 'getarchives_where', 'getarchives_where_filter', 10, 2 );
add_filter( 'generate_rewrite_rules', 'generate_megazines_rewrite_rules' );

function getarchives_where_filter( $where, $args ) {

    if ( isset($args['post_type']) ) {
        $where = "WHERE post_type = '$args[post_type]' AND post_status = 'publish'";
    }

    return $where;
}

function generate_megazines_rewrite_rules( $wp_rewrite ) {

    $megazine_rules = array(
        'megazines/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$' => 'index.php?post_type=megazines&year=$matches[1]&monthnum=$matches[2]&day=$matches[3]',
        'megazines/([0-9]{4})/([0-9]{1,2})/?$' => 'index.php?post_type=megazines&year=$matches[1]&monthnum=$matches[2]',
        'megazines/([0-9]{4})/?$' => 'index.php?post_type=megazines&year=$matches[1]'
    );

    $wp_rewrite->rules = $megazine_rules + $wp_rewrite->rules;
}

function get_archives_megazines_link( $link ) {

    return str_replace( get_site_url(), get_site_url() . '/megazines', $link );

};
/* Date links for custom post type archive start */
