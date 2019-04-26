<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

get_header('shop');
?>

<?php wc_get_template_part("page", "top"); ?>

<section>
    <div class="container">

        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-9 col-lg-push-3 col-md-push-3 col-sm-push-3">
                <?php
//                echo '<br/>------------------------------------------------------------------------------<br/>';
//                $total_item = $count = $GLOBALS['wp_query']->found_posts;
//                $page = get_query_var('paged', 1);
//                echo $total_item . "---" . $page;
//                echo '<br/>------------------------------------------------------------------------------<br/>';
                ?>
                <?php
                /**
                 * woocommerce_archive_description hook.
                 *
                 * @hooked woocommerce_taxonomy_archive_description - 10
                 * @hooked woocommerce_product_archive_description - 10
                 */
                do_action('woocommerce_archive_description');
                ?>

                <?php if (have_posts()) : ?>

                    <?php
                    /**
                     * woocommerce_before_shop_loop hook.
                     *
                     * @hooked woocommerce_result_count - 20
                     * @hooked woocommerce_catalog_ordering - 30
                     */
                    echo '<div class="pull-left">';
                    woocommerce_result_count();
                    echo '</div>';
                    echo '<div class="pull-right">';
                    woocommerce_catalog_ordering();
                    echo '</div>';
                    //do_action('woocommerce_before_shop_loop');
                    ?>

                    <?php woocommerce_product_loop_start(); ?>

                    <?php woocommerce_product_subcategories(); ?>

                    <?php while (have_posts()) : the_post(); ?>

                        <?php wc_get_template_part('content', 'product'); ?>

                    <?php endwhile; // end of the loop. ?>

                    <?php woocommerce_product_loop_end(); ?>

                    <?php
                    /**
                     * woocommerce_after_shop_loop hook.
                     *
                     * @hooked woocommerce_pagination - 10
                     */
                    //do_action('woocommerce_after_shop_loop');
                    ?>

                    <hr>
                    <div class="text-center">
                        <?php
                        $total_item = $count = $GLOBALS['wp_query']->found_posts;
                        $page = get_query_var('paged', 1);
                        // "base_url" => get_post_type_archive_link($GLOBALS['wp_query']->query_vars['post_type']),

                        $pagin_args = array(
                            "page_var_name" => "paged",
                            "total_item" => $total_item,
                            "cur_page" => $page,
                            "per_page" => GLOBAL_PRODUCTS_PER_PAGE,
                            "current_class" => "active",
                            "pagin_holder_start" => '<ul class="pagination">',
                            "pagin_holder_end" => '</ul>'
                        );

                        $bqPagination = new BqPagination($pagin_args);
                        echo $bqPagination->generate_pagination();
                        ?>
                    </div>

                <?php elseif (!woocommerce_product_subcategories(array('before' => woocommerce_product_loop_start(false), 'after' => woocommerce_product_loop_end(false)))) : ?>

                    <?php wc_get_template('loop/no-products-found.php'); ?>

                <?php endif; ?>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-3 col-lg-pull-9 col-md-pull-9 col-sm-pull-9">
                <?php wc_get_template_part('products', 'sidebar'); ?>
                <?php
                /**
                 * woocommerce_sidebar hook.
                 *
                 * @hooked woocommerce_get_sidebar - 10
                 */
//do_action( 'woocommerce_sidebar' );
                ?>
            </div>
        </div>
    </div>
</section>

<?php
/**
 * woocommerce_after_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');
?>

<?php get_footer('shop'); ?>
