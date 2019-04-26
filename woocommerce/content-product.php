<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $product, $wishlists;

//echo '<pre>'; print_r($product); echo '</pre>'; exit;


// Ensure visibility
if (empty($product) || !$product->is_visible()) {
    return;
}
?>

<li <?php post_class("col-lg-3 col-sm-3"); ?>>
    <div class="shop-item">
        <?php
        $meta = get_post_meta($product->id,'_bq_product_meta',TRUE);
        $title = empty($meta["_bn_title"]) ? get_the_title() : $meta["_bn_title"];
        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($product->id), 'shop_catalog');
        $thumbSrc = $thumb[0];
        
        $regular_price = get_post_meta( $product->id, '_regular_price', true);
        $sale_price = get_post_meta( $product->id, '_sale_price', true);
        $price = !empty($sale_price) && $sale_price>0 ? $sale_price : $regular_price;
        
        //echo wc_get_product_ids_on_sale();
        //echo $product->ID.'<pre>'; print_r($product); echo '</pre>';
        ?>
        
        <div class="thumbnail">
            <!-- product image(s) -->
            <a class="shop-item-image" href="<?php echo get_permalink( $product->id ) ?>">
                <img class="img-responsive lazyOwl" src="<?php echo $thumbSrc; ?>" alt="shop first image" />
                <img class="img-responsive lazyOwl" src="<?php echo $thumbSrc; ?>" alt="shop hover image" />
            </a>
            <!-- /product image(s) -->

            <?php if(!is_product_category( 'magazine' )): ?>
            <!-- hover buttons -->
            <div class="shop-option-over"><!-- replace data-item-id width the real item ID - used by js/view/demo.shop.js -->
                <a class="btn btn-default add-wishlist" href="#" data-item-id="1" data-toggle="tooltip" title="Add To Wishlist"><i class="fa fa-heart nopadding"></i></a>
                <a class="btn btn-default add-compare" href="#" data-item-id="1" data-toggle="tooltip" title="Add To Compare"><i class="fa fa-bar-chart-o nopadding" data-toggle="tooltip"></i></a>
            </div>
            <!-- /hover buttons -->

            <!-- product more info -->
            <div class="shop-item-info">
                <?php 
                $featured = $product->is_featured(); 
                if($featured) echo '<span class="label label-success">FEATURED</span>';
                if($sale_price) echo '<span class="label label-danger">SALE</span>';
                ?>
            </div>
            <!-- /product more info -->
            <?php endif; ?>
        </div>
        
        
        
        <div class="shop-item-summary text-center">
            <h2><?php echo $title; ?></h2>

            
            <?php if(!is_product_category( 'magazine' )): ?>
            <!-- rating -->
            <div class="shop-item-rating-line">
                <div class="rating rating-4 size-13"><!-- rating-0 ... rating-5 --></div>
            </div>
            <!-- /rating -->

            <!-- price -->
            <div class="shop-item-price">
                <?php if($sale_price) echo '<span class="line-through">'.wc_price($regular_price).'</span>'; ?>
                <b><?php echo wc_price($price); ?></b>
            </div>
            <!-- /price -->
            <?php endif; ?>
            
            
        </div>

        <?php if(!is_product_category( 'magazine' )): ?>
        
        <div class="shop-item-buttons text-center">
            <a class="btn btn-default button product_type_simple add_to_cart_button ajax_add_to_cart added" data-product_sku="" data-product_id="<?php echo $product->id; ?>" data-quantity="1" href="/anupranan/?add-to-cart=<?php echo $product->id; ?>" rel="nofollow"><i class="fa fa-cart-plus"></i> Add to Cart</a>
            <?php //echo do_shortcode( "[yith_wcwl_add_to_wishlist]" ); ?>
            
        </div>
        
        <?php endif; ?>
        
    <?php
    /**
     * woocommerce_before_shop_loop_item hook.
     *
     * @hooked woocommerce_template_loop_product_link_open - 10
     */
    //do_action('woocommerce_before_shop_loop_item');

    /**
     * woocommerce_before_shop_loop_item_title hook.
     *
     * @hooked woocommerce_show_product_loop_sale_flash - 10
     * @hooked woocommerce_template_loop_product_thumbnail - 10
     */
    //do_action('woocommerce_before_shop_loop_item_title');

    /**
     * woocommerce_shop_loop_item_title hook.
     *
     * @hooked woocommerce_template_loop_product_title - 10
     */
    //do_action('woocommerce_shop_loop_item_title');

    /**
     * woocommerce_after_shop_loop_item_title hook.
     *
     * @hooked woocommerce_template_loop_rating - 5
     * @hooked woocommerce_template_loop_price - 10
     */
    //do_action('woocommerce_after_shop_loop_item_title');

    /**
     * woocommerce_after_shop_loop_item hook.
     *
     * @hooked woocommerce_template_loop_product_link_close - 5
     * @hooked woocommerce_template_loop_add_to_cart - 10
     */
    //do_action('woocommerce_after_shop_loop_item');
    ?>
    </div>
</li>
