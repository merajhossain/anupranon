<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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
 * @version     1.6.4
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<?php
/**
 * woocommerce_before_single_product hook.
 *
 * @hooked wc_print_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form();
    return;
}

global $product;

$meta = get_post_meta($product->id, '_bq_product_meta', TRUE);
$title = empty($meta["_bn_title"]) ? get_the_title() : $meta["_bn_title"];
$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($product->id), 'large-thumb');
$fullImg = wp_get_attachment_image_src(get_post_thumbnail_id($product->id), "full");
$thumbSrc = $thumb[0];
$fullImgSrc = $fullImg[0];

$regular_price = get_post_meta($product->id, '_regular_price', true); 
$sale_price = get_post_meta($product->id, '_sale_price', true); 
$price = !empty($sale_price) && $sale_price > 0 ? $sale_price : $regular_price;

$stock_status = get_post_meta($product->id, '_stock_status', true);
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="row">
        <!-- IMAGE -->
        <div class="col-lg-6 col-sm-6">

            <div class="thumbnail relative margin-bottom-3">

                <!-- 
                        IMAGE ZOOM 
                        
                        data-mode="mouseover|grab|click|toggle"
                -->
                <figure id="zoom-primary" class="zoom" data-mode="mouseover">

                    <a class="lightbox bottom-right" href="<?php echo $fullImgSrc; ?>" data-plugin-options='{"type":"image"}'><i class="glyphicon glyphicon-search"></i></a>

                    <img class="img-responsive" src="<?php echo $thumbSrc; ?>" alt="This is the product title" />
                </figure>

            </div>

            <?php $attachment_ids = $product->get_gallery_attachment_ids(); ?>
            <?php if (!empty($attachment_ids)): ?>
                <!-- Thumbnails (required height:100px) -->
                <div data-for="zoom-primary" class="zoom-more owl-carousel owl-padding-3 featured" data-plugin-options='{"singleItem": false, "autoPlay": false, "navigation": true, "pagination": false}'>
                    <?php
                    foreach ($attachment_ids as $attachment_id) :
                        $productGalleryImgLargeThumb = wp_get_attachment_image_src($attachment_id, 'large-thumb');
                        $productGalleryImgThumb = wp_get_attachment_image_src($attachment_id, 'portrait-thumb');
                        $productGalleryImgThumbSrc = $productGalleryImgThumb[0];
                        $productGalleryImgLargeThumbSrc = $productGalleryImgLargeThumb[0];
                        ?>
                        <a class="thumbnail active" href="<?php echo $productGalleryImgLargeThumbSrc ?>">
                            <img src="<?php echo $productGalleryImgThumbSrc ?>" height="100" alt="" />
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <!-- /Thumbnails -->

        </div>
        <!-- /IMAGE -->

        <!-- ITEM DESC -->
        <div class="col-lg-6 col-sm-6">

            <!-- buttons -->
            <div class="pull-right">
                <!-- replace data-item-id width the real item ID - used by js/view/demo.shop.js -->
                <a class="btn btn-default add-wishlist" href="#" data-item-id="1" data-toggle="tooltip" title="Add To Wishlist"><i class="fa fa-heart nopadding"></i></a>
                <a class="btn btn-default add-compare" href="#" data-item-id="1" data-toggle="tooltip" title="Add To Compare"><i class="fa fa-bar-chart-o nopadding" data-toggle="tooltip"></i></a>
            </div>
            <!-- /buttons -->

            <!-- price -->
            <div class="shop-item-price">
                <?php if ($sale_price) : ?>
                    <span class="line-through nopadding-left"><?php echo wc_price($regular_price); ?></span>
                <?php endif; ?>
                <b><?php echo wc_price($price); ?></b>
            </div>
            <!-- /price -->

            <hr />

            <div class="clearfix margin-bottom-30">
                <?php if ($stock_status == "instock"): ?>
                    <span class="pull-right text-success"><i class="fa fa-check"></i> In Stock</span>
                <?php else: ?>
                    <span class="pull-right text-danger"><i class="fa fa-warning"></i> Out of Stock</span>
                <?php endif; ?>
                <!--
                <span class="pull-right text-danger"><i class="glyphicon glyphicon-remove"></i> Out of Stock</span>
                -->

                <?php if (!empty($product->get_sku())): ?>
                    <strong>SKU:</strong> <?php echo $product->get_sku(); ?>
                <?php endif; ?>
            </div>


            <!-- short description -->
            <?php if (!empty(get_the_excerpt())) : ?>
                <p><?php echo get_the_excerpt(); ?></p>
            <?php endif; ?>
            <!-- /short description -->


            <!-- countdown -->
<!--            <div class="text-center">
                <h5>Limited Offer</h5>
                <div class="countdown" data-from="January 31, 2018 15:03:26" data-labels="years,months,weeks,days,hour,min,sec"></div>
            </div>-->
            <!-- /countdown -->


            <hr />

            <!-- FORM -->
            <form class="clearfix form-inline nomargin" method="get" action="shop-cart.html">
                <input type="hidden" name="product_id" value="1" />

                <!-- see assets/js/view/demo.shop.js -->
                <input type="hidden" id="color" name="color" value="yellow" />
                <input type="hidden" id="qty" name="qty" value="1" />
                <input type="hidden" id="size" name="size" value="5" />
                <!-- see assets/js/view/demo.shop.js -->

                <div class="btn-group pull-left product-opt-qty">
<!--                    <button type="button" class="btn btn-default dropdown-toggle product-qty-dd noradius" data-toggle="dropdown">
                        <span class="caret"></span>
                        Qty <small id="product-selected-qty">(<span>5</span>)</small>
                    </button>

                    <ul id="product-qty-dd" class="dropdown-menu clearfix" role="menu">
                        <li class="active"><a data-val="1" href="#">1</a></li>
                        <li><a data-val="2" href="#">2</a></li>
                        <li><a data-val="3" href="#">3</a></li>
                        <li><a data-val="4" href="#">4</a></li>
                        <li><a data-val="5" href="#">5</a></li>
                        <li><a data-val="6" href="#">6</a></li>
                        <li><a data-val="7" href="#">7</a></li>
                        <li><a data-val="8" href="#">8</a></li>
                        <li><a data-val="9" href="#">9</a></li>
                        <li><a data-val="10" href="#">10</a></li>
                    </ul>-->
                    <input id="" type="number" value="1" min="1"/>
                </div><!-- /btn-group -->

                
                <a rel="nofollow" href="/anupranan/?add-to-cart=<?php echo $product->id; ?>" data-quantity="3" data-product_id="<?php echo $product->id; ?>" data-product_sku="<?php echo $product->get_sku(); ?>" class="btn btn-primary pull-left product-add-cart noradius add_to_cart_button ajax_add_to_cart added"><i class="fa fa-cart-plus"></i> Add to Cart</a>

            </form>
            <!-- /FORM -->


            <hr />

<!--            <small class="text-muted">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas metus nulla, 
                commodo a sodales sed, dignissim pretium nunc. Nam et lacus neque. Ut enim 
                massa, sodales tempor convallis et.
            </small>

            <hr />-->
            
            <?php echo $product->get_categories( ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', $cat_count, 'woocommerce' ) . ' ', '</span>' ); ?>
            <hr />
            <?php echo $product->get_tags( ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', $tag_count, 'woocommerce' ) . ' ', '</span>' ); ?>

            <!-- Share -->
            <div class="pull-right">
                <?php echo do_shortcode("[woocommerce_social_media_share_buttons]") ?>
            </div>
            <!-- /Share -->


            <!-- rating -->
            <div class="rating rating-4 size-13 margin-top-10 width-100"><!-- rating-0 ... rating-5 --></div>
            <!-- /rating -->

        </div>
        <!-- /ITEM DESC -->

    </div>

    <ul id="myTab" class="nav nav-tabs nav-top-border margin-top-80" role="tablist">
        <li role="presentation" class="active"><a href="#description" role="tab" data-toggle="tab">Description</a></li>
        <li role="presentation"><a href="#specs" role="tab" data-toggle="tab">Specifications</a></li>
        <li role="presentation"><a href="#reviews" role="tab" data-toggle="tab">Reviews (2)</a></li>
    </ul>

    <div class="tab-content padding-top-20">
        <!-- DESCRIPTION -->
        
        <div role="tabpanel" class="tab-pane fade in active" id="description">
            <?php if(!empty(get_the_content())): ?>
            <?php the_content(); ?>
            <?php else: ?>
            No description added yet.
            <?php endif; ?>
        </div>
        

        <!-- SPECIFICATIONS -->
        <div role="tabpanel" class="tab-pane fade" id="specs">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Column name</th>
                            <th>Column name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Size</td>
                            <td>2XL</td>
                        </tr>
                        <tr>
                            <td>Color</td>
                            <td>Red</td>
                        </tr>
                        <tr>
                            <td>Weight</td>
                            <td>132lbs</td>
                        </tr>
                        <tr>
                            <td>Height</td>
                            <td>74cm</td>
                        </tr>
                        <tr>
                            <td>Bluetooth</td>
                            <td><i class="fa fa-check text-success"></i> YES</td>
                        </tr>
                        <tr>
                            <td>Wi-Fi</td>
                            <td><i class="glyphicon glyphicon-remove text-danger"></i> NO</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- REVIEWS -->
        <div role="tabpanel" class="tab-pane fade" id="reviews">
            <!-- REVIEW ITEM -->
            <div class="block margin-bottom-60">

                <span class="user-avatar"><!-- user-avatar -->
                    <img class="pull-left media-object" src="<?php echo get_template_directory_uri(); ?>/assets/images/avatar2.jpg" width="64" height="64" alt="">
                </span>

                <div class="media-body">
                    <h4 class="media-heading size-14">
                        John Doe &ndash; 
                        <span class="text-muted">June 29, 2014 - 11:23</span> &ndash;
                        <span class="size-14 text-muted"><!-- stars -->
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                        </span>
                    </h4>

                    <p>
                        Proin eget tortor risus. Cras ultricies ligula sed magna dictum porta. Pellentesque in ipsum id orci porta dapibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas metus nulla, commodo a sodales sed, dignissim pretium nunc. Nam et lacus neque.
                    </p>

                </div>

            </div>
            <!-- /REVIEW ITEM -->

            <!-- REVIEW ITEM -->
            <div class="block margin-bottom-60">

                <span class="user-avatar"><!-- user-avatar -->
                    <img class="pull-left media-object" src="<?php echo get_template_directory_uri(); ?>/assets/images/avatar2.jpg" width="64" height="64" alt="">
                </span>

                <div class="media-body">
                    <h4 class="media-heading size-14">
                        John Doe &ndash; 
                        <span class="text-muted">June 29, 2014 - 11:23</span> &ndash;
                        <span class="size-14 text-muted"><!-- stars -->
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </span>
                    </h4>

                    <p>
                        Proin eget tortor risus. Cras ultricies ligula sed magna dictum porta. Pellentesque in ipsum id orci porta dapibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas metus nulla, commodo a sodales sed, dignissim pretium nunc. Nam et lacus neque.
                    </p>

                </div>

            </div>
            <!-- /REVIEW ITEM -->


            <!-- REVIEW FORM -->
            <h4 class="page-header margin-bottom-40">ADD A REVIEW</h4>
            <form method="post" action="#" id="form">

                <div class="row margin-bottom-10">

                    <div class="col-md-6 margin-bottom-10">
                        <!-- Name -->
                        <input type="text" name="name" id="name" class="form-control" placeholder="Name *" maxlength="100" required="">
                    </div>

                    <div class="col-md-6">
                        <!-- Email -->
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email *" maxlength="100" required="">
                    </div>

                </div>

                <!-- Comment -->
                <div class="margin-bottom-30">
                    <textarea name="text" id="text" class="form-control" rows="6" placeholder="Comment" maxlength="1000"></textarea>
                </div>

                <!-- Stars -->
                <div class="product-star-vote clearfix">

                    <label class="radio pull-left">
                        <input type="radio" name="product-review-vote" value="1" />
                        <i></i> 1 Star
                    </label>

                    <label class="radio pull-left">
                        <input type="radio" name="product-review-vote" value="2" />
                        <i></i> 2 Stars
                    </label>

                    <label class="radio pull-left">
                        <input type="radio" name="product-review-vote" value="3" />
                        <i></i> 3 Stars
                    </label>

                    <label class="radio pull-left">
                        <input type="radio" name="product-review-vote" value="4" />
                        <i></i> 4 Stars
                    </label>

                    <label class="radio pull-left">
                        <input type="radio" name="product-review-vote" value="5" />
                        <i></i> 5 Stars
                    </label>

                </div>

                <!-- Send Button -->
                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Send Review</button>

            </form>
            <!-- /REVIEW FORM -->

        </div>
    </div>


    <hr class="margin-top-80 margin-bottom-80" />

    <h2 class="owl-featured"><strong>Related</strong> products:</h2>
    <div class="owl-carousel featured nomargin owl-padding-10" data-plugin-options='{"singleItem": false, "items": "4", "stopOnHover":false, "autoPlay":4500, "autoHeight": false, "navigation": true, "pagination": false}'>

        <!-- item -->
        <div class="shop-item nomargin">

            <div class="thumbnail">
                <!-- product image(s) -->
                <a class="shop-item-image" href="shop-single-left.html">
                    <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/assets/images/demo/shop/products/300x450/p13.jpg" alt="shop first image" />
                    <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/assets/images/demo/shop/products/300x450/p14.jpg" alt="shop hover image" />
                </a>
                <!-- /product image(s) -->

                <!-- product more info -->
                <div class="shop-item-info">
                    <span class="label label-success">NEW</span>
                    <span class="label label-danger">SALE</span>
                </div>
                <!-- /product more info -->
            </div>

            <div class="shop-item-summary text-center">
                <h2>Cotton 100% - Pink Shirt</h2>

                <!-- rating -->
                <div class="shop-item-rating-line">
                    <div class="rating rating-4 size-13"><!-- rating-0 ... rating-5 --></div>
                </div>
                <!-- /rating -->

                <!-- price -->
                <div class="shop-item-price">
                    <span class="line-through">$98.00</span>
                    $78.00
                </div>
                <!-- /price -->
            </div>

            <!-- buttons -->
            <div class="shop-item-buttons text-center">
                <a class="btn btn-default" href="shop-cart.html"><i class="fa fa-cart-plus"></i> Add to Cart</a>
            </div>
            <!-- /buttons -->
        </div>
        <!-- /item -->

        <!-- item -->
        <div class="shop-item nomargin">

            <div class="thumbnail">
                <!-- product image(s) -->
                <a class="shop-item-image" href="shop-single-left.html">
                    <!-- CAROUSEL -->
                    <div class="owl-carousel owl-padding-0 nomargin" data-plugin-options='{"singleItem": true, "autoPlay": 3000, "navigation": false, "pagination": false, "transitionStyle":"fadeUp"}'>
                        <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/assets/images/demo/shop/products/300x450/p5.jpg" alt="">
                        <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/assets/images/demo/shop/products/300x450/p1.jpg" alt="">
                    </div>
                    <!-- /CAROUSEL -->
                </a>
                <!-- /product image(s) -->
            </div>

            <div class="shop-item-summary text-center">
                <h2>Pink Dress 100% Cotton</h2>

                <!-- rating -->
                <div class="shop-item-rating-line">
                    <div class="rating rating-4 size-13"><!-- rating-0 ... rating-5 --></div>
                </div>
                <!-- /rating -->

                <!-- price -->
                <div class="shop-item-price">
                    $44.00
                </div>
                <!-- /price -->
            </div>

            <!-- buttons -->
            <div class="shop-item-buttons text-center">
                <a class="btn btn-default" href="shop-cart.html"><i class="fa fa-cart-plus"></i> Add to Cart</a>
            </div>
            <!-- /buttons -->
        </div>
        <!-- /item -->

        <!-- item -->
        <div class="shop-item nomargin">

            <div class="thumbnail">
                <!-- product image(s) -->
                <a class="shop-item-image" href="shop-single-left.html">
                    <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/assets/images/demo/shop/products/300x450/p2.jpg" alt="shop first image" />
                    <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/assets/images/demo/shop/products/300x450/p12.jpg" alt="shop hover image" />
                </a>
                <!-- /product image(s) -->

                <!-- product more info -->
                <div class="shop-item-info">
                    <span class="label label-success">NEW</span>
                    <span class="label label-danger">SALE</span>
                </div>
                <!-- /product more info -->
            </div>

            <div class="shop-item-summary text-center">
                <h2>Black Fashion Hat</h2>

                <!-- rating -->
                <div class="shop-item-rating-line">
                    <div class="rating rating-4 size-13"><!-- rating-0 ... rating-5 --></div>
                </div>
                <!-- /rating -->

                <!-- price -->
                <div class="shop-item-price">
                    <span class="line-through">$77.00</span>
                    $65.00
                </div>
                <!-- /price -->
            </div>

            <!-- buttons -->
            <div class="shop-item-buttons text-center">
                <a class="btn btn-default" href="shop-cart.html"><i class="fa fa-cart-plus"></i> Add to Cart</a>
            </div>
            <!-- /buttons -->
        </div>
        <!-- /item -->

        <!-- item -->
        <div class="shop-item nomargin">

            <div class="thumbnail">
                <!-- product image(s) -->
                <a class="shop-item-image" href="shop-single-left.html">
                    <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/assets/images/demo/shop/products/300x450/p8.jpg" alt="shop first image" />
                </a>
                <!-- /product image(s) -->

                <!-- countdown -->
                <div class="shop-item-counter">
                    <div class="countdown" data-from="December 31, 2017 08:22:01" data-labels="years,months,weeks,days,hour,min,sec"><!-- Example Date From: December 31, 2018 15:03:26 --></div>
                </div>
                <!-- /countdown -->
            </div>

            <div class="shop-item-summary text-center">
                <h2>Beach Black Lady Suit</h2>

                <!-- rating -->
                <div class="shop-item-rating-line">
                    <div class="rating rating-4 size-13"><!-- rating-0 ... rating-5 --></div>
                </div>
                <!-- /rating -->

                <!-- price -->
                <div class="shop-item-price">
                    $56.00
                </div>
                <!-- /price -->
            </div>

            <!-- buttons -->
            <div class="shop-item-buttons text-center">
                <a class="btn btn-default" href="shop-cart.html"><i class="fa fa-cart-plus"></i> Add to Cart</a>
            </div>
            <!-- /buttons -->
        </div>
        <!-- /item -->

        <!-- item -->
        <div class="shop-item nomargin">

            <div class="thumbnail">
                <!-- product image(s) -->
                <a class="shop-item-image" href="shop-single-left.html">
                    <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/assets/images/demo/shop/products/300x450/p7.jpg" alt="shop first image" />
                </a>
                <!-- /product image(s) -->
            </div>

            <div class="shop-item-summary text-center">
                <h2>Town Dress - Black</h2>

                <!-- rating -->
                <div class="shop-item-rating-line">
                    <div class="rating rating-4 size-13"><!-- rating-0 ... rating-5 --></div>
                </div>
                <!-- /rating -->

                <!-- price -->
                <div class="shop-item-price">
                    $154.00
                </div>
                <!-- /price -->
            </div>

            <!-- buttons -->
            <div class="shop-item-buttons text-center">
                <a class="btn btn-default" href="shop-cart.html"><i class="fa fa-cart-plus"></i> Add to Cart</a>
            </div>
            <!-- /buttons -->
        </div>
        <!-- /item -->

        <!-- item -->
        <div class="shop-item nomargin">

            <div class="thumbnail">
                <!-- product image(s) -->
                <a class="shop-item-image" href="shop-single-left.html">
                    <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/assets/images/demo/shop/products/300x450/p6.jpg" alt="shop first image" />
                    <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/assets/images/demo/shop/products/300x450/p14.jpg" alt="shop hover image" />
                </a>
                <!-- /product image(s) -->
            </div>

            <div class="shop-item-summary text-center">
                <h2>Chick Lady Fashion</h2>

                <!-- rating -->
                <div class="shop-item-rating-line">
                    <div class="rating rating-4 size-13"><!-- rating-0 ... rating-5 --></div>
                </div>
                <!-- /rating -->

                <!-- price -->
                <div class="shop-item-price">
                    $167.00
                </div>
                <!-- /price -->
            </div>

            <!-- buttons -->
            <div class="shop-item-buttons text-center">
                <a class="btn btn-default" href="shop-cart.html"><i class="fa fa-cart-plus"></i> Add to Cart</a>
            </div>
            <!-- /buttons -->
        </div>
        <!-- /item -->

        <!-- item -->
        <div class="shop-item nomargin">

            <div class="thumbnail">
                <!-- product image(s) -->
                <a class="shop-item-image" href="shop-single-left.html">
                    <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/assets/images/demo/shop/products/300x450/p11.jpg" alt="shop hover image" />
                    <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/assets/images/demo/shop/products/300x450/p3.jpg" alt="shop first image" />
                </a>
                <!-- /product image(s) -->
            </div>

            <div class="shop-item-summary text-center">
                <h2>Black Long Lady Shirt</h2>

                <!-- rating -->
                <div class="shop-item-rating-line">
                    <div class="rating rating-0 size-13"><!-- rating-0 ... rating-5 --></div>
                </div>
                <!-- /rating -->

                <!-- price -->
                <div class="shop-item-price">
                    $128.00
                </div>
                <!-- /price -->
            </div>

            <!-- buttons -->
            <div class="shop-item-buttons text-center">
                <a class="btn btn-default" href="shop-cart.html"><i class="fa fa-cart-plus"></i> Add to Cart</a>
            </div>
            <!-- /buttons -->
        </div>
        <!-- /item -->

    </div>

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action('woocommerce_after_single_product'); ?>
