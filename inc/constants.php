<?php
function bq_set_constants(){
    define("NO_IMG_URL", get_stylesheet_directory_uri()."/assets/images/avatar2.jpg");
    define("GLOBAL_POSTS_PER_PAGE", get_option('posts_per_page'));
    
    // Products
    define("GLOBAL_PRODUCTS_PER_PAGE", 12);
    define("GLOBAL_AVERAGE_RATING", 0);
}
add_action("init", "bq_set_constants",0);