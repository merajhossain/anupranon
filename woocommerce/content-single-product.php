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
$lineThrough = '';
$meta = get_post_meta($product->id, '_bq_product_meta', TRUE);
$title = empty($meta["_bn_title"]) ? get_the_title() : $meta["_bn_title"];
$publishDate = $meta["_publishDate"];
$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($product->id), 'large-thumb');
$fullImg = wp_get_attachment_image_src(get_post_thumbnail_id($product->id), "full");
$thumbSrc = $thumb[0];
$fullImgSrc = $fullImg[0];

$regular_price = get_post_meta($product->id, '_regular_price', true);
$sale_price = get_post_meta($product->id, '_sale_price', true);
$price = !empty($sale_price) && $sale_price > 0 ? $sale_price : $regular_price;
if($sale_price){
        $lineThrough = 'line-through';
}
$stock_status = get_post_meta($product->id, '_stock_status', true);


$average_rating = $product->get_average_rating() ? ceil($product->get_average_rating()) : GLOBAL_AVERAGE_RATING;

$book_cats = wp_get_post_terms($product->id, 'product_cat');
$book_tags = wp_get_post_terms($product->id, 'product_tag');
$book_writers = wp_get_post_terms($product->id, 'writer');
$book_publishers = wp_get_post_terms($product->id, 'publisher');
/**Number calculator**/
function bn2enNumber ($number){
    $replace_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
    $search_array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
    $en_number = str_replace($search_array, $replace_array, $number);

    return $en_number;
}

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
          <h3 class="margin-bottom-20"><?php echo $title; ?></h3>
          <table class="table">
            <tbody>
                <tr>
                  <td colspan="2">
                    <?php
                      $postID = get_the_ID();
                      $term_list = wp_get_post_terms( $postID, 'writer');
                      foreach ($term_list as $key => $writer) {
                        echo '<p class="margin-bottom-0">Author: <a href="'.esc_attr(get_term_link($writer->term_id)).'">'.$writer->name.'</a></p>';
                      }
                    ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <!-- rating -->
                    Rating :
                    <div class="rating rating-<?php echo $average_rating; ?> size-13 margin-top-10 width-100"><!-- rating-0 ... rating-5 --></div>
                    <!-- /rating -->
                  </td>
                  <td>
                      <?php echo do_shortcode("[woocommerce_social_media_share_buttons]") ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <p class="margin-bottom-0">Regular Price : <span class="<?php echo $lineThrough; ?> nopadding-left">&#2547; <?php
                    $usdRate = $value = anupranan_get_theme_option( 'dollarRate' );
                    $usdPrice = $regular_price;
                    $saleprice =  floor($usdPrice * $usdRate);
                    echo bn2enNumber($saleprice);
                    ?></span></p>
                  </td>
                  <td>
                    <?php if($sale_price): ?>
                        <p class="margin-bottom-0"> <?php if ($sale_price) : ?> Our Price : &#2547; <b>
                        <?php
                        $usdRate = $value = anupranan_get_theme_option( 'dollarRate' );
                        $usdPrice = $price;
                        $reg_price =  floor($usdPrice * $usdRate);
                        echo bn2enNumber($reg_price);
                        ?></b> <?php endif; ?></p>
                    <?php endif; ?>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <?php
                      $postID = get_the_ID();
                      $term_list = wp_get_post_terms( $postID, 'publisher');
                      foreach ($term_list as $key => $publisher) {
                        echo '<p class="margin-bottom-0">Publisher : <a href="'.esc_attr(get_term_link($publisher->term_id)).'">'.$publisher->name.'</a></p>';
                      }
                    ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <p class="margin-bottom-0">Publishing Date : <?php if($publishDate) { echo $publishDate;} ?></p>
                  </td>
                </tr>
                <tr>
                  <td>
                    <!-- FORM -->
                    <form class="cart clearfix form-inline nomargin" enctype="multipart/form-data" method="post">
                        <input type="hidden" name="product_id" value="1" />

                        <!-- see assets/js/view/demo.shop.js -->
                        <input type="hidden" id="color" name="color" value="yellow" />
                        <input type="hidden" id="qty" name="qty" value="1" />
                        <input type="hidden" id="size" name="size" value="5" />
                        <!-- see assets/js/view/demo.shop.js -->

                        <div class="btn-group pull-left product-opt-qty form-group">
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
                        </div><!-- /btn-group -->


                        <a rel="nofollow" id="singleProductAddToCartBtn" href="/anupranan/?add-to-cart=<?php echo $product->id; ?>" data-quantity="1" data-product_id="<?php echo $product->id; ?>" data-product_sku="<?php echo $product->get_sku(); ?>" class="btn btn-primary pull-left product-add-cart noradius add_to_cart_button ajax_add_to_cart added"><i class="fa fa-cart-plus"></i> Add to Cart</a>

                    </form>
                    <!-- /FORM -->
                  </td>
                  <td>
                    <a class="btn btn-default add-wishlist" href="#" data-item-id="1" data-toggle="tooltip" title="Add To Wishlist"><i class="fa fa-heart nopadding"></i></a>
                    <a class="btn btn-default add-compare" href="#" data-item-id="1" data-toggle="tooltip" title="Add To Compare"><i class="fa fa-bar-chart-o nopadding" data-toggle="tooltip"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>
                    <?php if ($stock_status == "instock"): ?>
                        <span class="text-success"><i class="fa fa-check"></i> In Stock</span>
                    <?php else: ?>
                        <span class="text-danger"><i class="fa fa-warning"></i> Out of Stock</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if (!$product->get_sku()): ?>
                        <strong>SKU:</strong> <?php echo $product->get_sku(); ?>
                    <?php else: ?>
                        <strong>SKU:</strong> N/A
                    <?php endif; ?>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <?php echo $product->get_categories(', ', '<span class="posted_in">' . _n('', '', $cat_count, 'woocommerce') . ' ', '</span>'); ?>
                  </td>
                </tr>
            </tbody>
          </table>
            <!-- short description -->
            <!--
            <?php if (get_the_excerpt()) : ?>
                <p><?php echo get_the_excerpt(); ?></p>
            <?php endif; ?>
            -->
            <!-- /short description -->


            <!-- countdown -->
            <!--            <div class="text-center">
                            <h5>Limited Offer</h5>
                            <div class="countdown" data-from="January 31, 2018 15:03:26" data-labels="years,months,weeks,days,hour,min,sec"></div>
                        </div>-->
            <!-- /countdown -->
<!--            <small class="text-muted">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas metus nulla,
                commodo a sodales sed, dignissim pretium nunc. Nam et lacus neque. Ut enim
                massa, sodales tempor convallis et.
            </small>
            <hr />-->
        </div>
        <!-- /ITEM DESC -->

    </div>

    <ul id="myTab" class="nav nav-tabs nav-top-border margin-top-80" role="tablist">
        <li role="presentation" class="active"><a href="#description" role="tab" data-toggle="tab">Description</a></li>
<!--    <li role="presentation"><a href="#specs" role="tab" data-toggle="tab">Specifications</a></li>-->
        <li role="presentation"><a href="#reviews" role="tab" data-toggle="tab">Reviews (<?php echo get_comments_number(); ?>)</a></li>
        <li role="presentation"><a href="#author" role="tab" data-toggle="tab">Author</a></li>
    </ul>

    <div class="tab-content padding-top-20">
        <!-- DESCRIPTION -->

        <div role="tabpanel" class="tab-pane fade in active" id="description">
            <?php //echo get_the_content(); ?>
            <?php if (get_the_content() || get_the_excerpt()): ?>
                <?php the_content(); ?>
                <br/>
                <?php the_excerpt(); ?>
            <?php else: ?>
                No description added yet.
            <?php endif; ?>
        </div>


        <!-- SPECIFICATIONS -->
        <!--
        <div role="tabpanel" class="tab-pane fade" id="specs">
            <div class="table-responsive">
                <table class="table table-hover">
                    <tbody>
                        <?php if (!empty($book_writers)): ?>
                            <tr>
                                <td>Writer</td>
                                <td>
                                    <?php
                                    foreach ($book_writers as $my_term):
                                        $termBnName = get_term_meta($my_term->term_id, 'bn_bangla_title', true);
                                        $termName = !empty($termBnName) ? $termBnName : $my_term->name;
                                        $termLink = esc_attr(get_term_link($my_term->term_id));
                                        ?>
                                        <a href="<?php echo $termLink; ?>"><?php echo $termName; ?></a>
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <?php if (!empty($book_publishers)): ?>
                            <tr>
                                <td>Publisher</td>
                                <td>
                                    <?php
                                    foreach ($book_publishers as $my_term):
                                        $termBnName = get_term_meta($my_term->term_id, 'bn_bangla_title', true);
                                        $termName = !empty($termBnName) ? $termBnName : $my_term->name;
                                        $termLink = esc_attr(get_term_link($my_term->term_id));
                                        ?>
                                        <a href="<?php echo $termLink; ?>"><?php echo $termName; ?></a>
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <?php if (!empty($book_cats)): ?>
                            <tr>
                                <td>Categories</td>
                                <td>
                                    <?php
                                    foreach ($book_cats as $my_term):
                                        $termBnName = get_term_meta($my_term->term_id, 'bn_bangla_title', true);
                                        $termName = !empty($termBnName) ? $termBnName : $my_term->name;
                                        $termLink = esc_attr(get_term_link($my_term->term_id));
                                        ?>
                                        <a href="<?php echo $termLink; ?>"><?php echo $termName; ?></a>
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <?php if (!empty($book_tags)): ?>
                            <tr>
                                <td>Tags</td>
                                <td>
                                    <?php
                                    foreach ($book_tags as $my_term):
                                        $termBnName = get_term_meta($my_term->term_id, 'bn_bangla_title', true);
                                        $termName = !empty($termBnName) ? $termBnName : $my_term->name;
                                        $termLink = esc_attr(get_term_link($my_term->term_id));
                                        ?>
                                        <a href="<?php echo $termLink; ?>"><?php echo $termName; ?></a>
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        -->

        <!-- REVIEWS -->
        <div role="tabpanel" class="tab-pane fade" id="reviews">
            <!-- REVIEW ITEM -->
            <?php
            $args = array('post_type' => 'product', 'post_id'=>$product->id);
            $comments = get_comments($args);
            wp_list_comments(array('callback' => 'woocommerce_comments'), $comments);


            ?>
            <?php //do_action( 'woocommerce_after_single_product_summary' ); ?>
            <!-- /REVIEW ITEM -->


            <!-- REVIEW FORM -->
            <?php comments_template( 'woocommerce/single-product-reviews' ); ?>
            <!-- /REVIEW FORM -->
        </div>

        <!-- REVIEWS -->
        <div role="tabpanel" class="tab-pane fade" id="author">
            
            <?php
                $postID = get_the_ID();
                $term_list = wp_get_post_terms( $postID, 'writer');
                $term_id = '';
                $authorImage ='';
                $authorName = '';
                $birthPlace = '';
                $wrFacebookUrl = '';
                $wrDescription = '';
                foreach ($term_list as $key => $writer) {
                    $term_id = $writer->term_id;
                    $wrDescription = $writer->description;
                }
                $writers = get_terms(array(
                    'taxonomy' => 'writer',
                    'with_thumbnail' => true,
                    'hide_empty' => false,
                ));
                if (!empty($writers)):
                    foreach ($writers as $writer):
                        $writerThumbId = get_term_thumbnail_id($term_id);
                        $writerThum = wp_get_attachment_image_src($writerThumbId, 'thumbnail');
                        $authorImage = $writerThum[0]; // thumbnail url
                        $authorName = get_term_meta($term_id, 'bn_bangla_title', true);
                        $birthPlace = get_term_meta($term_id, 'wr_birth_place', true);
                        $wrFacebookUrl = get_term_meta($term_id, 'wr_facebookUrl', true);
                    endforeach;
                endif;
                
            ?>
            <div class="row">
                <div class="col-md-3 col-sm-4 col-xs-2">
                    <div class="wr-image">
                        <img src="<?php echo $authorImage;?>" class="img-responsive"/>
                    </div>
                </div>
                <div class="col-md-9 col-sm-8 col-xs-10">
                    <h4 style="margin-bottom:5px;"><?php echo $authorName; ?></h4>
                    <p style="margin-bottom:10px;"><?php echo $wrFacebookUrl == ''?'<a href="https://www.facebook.com/" class="social-icon social-icon-sm social-icon-border social-facebook" data-toggle="tooltip" data-placement="top" title="" data-original-title="Facebook"><i class="icon-facebook"></i><i class="icon-facebook"></i></a>' : '<a href="'.$wrFacebookUrl.'" class="social-icon social-icon-sm social-icon-border social-facebook" data-toggle="tooltip" data-placement="top" title="" data-original-title="Facebook"><i class="icon-facebook"></i><i class="icon-facebook"></i></a>'; ?></p>
                    <p><?php echo $wrDescription; ?></p>
                </div>
            </div>
        </div>
    </div>


    <hr class="margin-top-80 margin-bottom-80" />

    <?php wc_get_template_part("single-product/related") ?>
</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action('woocommerce_after_single_product'); ?>
