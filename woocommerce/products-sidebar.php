<!-- CATEGORIES -->
<div class="side-nav margin-bottom-40">

    <div class="side-nav-head">
        <button class="fa fa-bars"></button>
        <h4>CATEGORIES</h4>
    </div>

    <?php
    $total_item = wp_count_terms('product_cat', array('hide_empty' => false));
    $page = get_query_var('page', 1);
    //$per_page = 6;
    $offset = $page > 1 ? (($page - 1) * $per_page) : 0;
    $productCats = get_terms(array(
        'taxonomy' => 'product_cat',
        'with_thumbnail' => true,
        'hide_empty' => false,
        'number' => $per_page,
        'offset' => $offset
    ));

    //echo $total_item;
    //echo "<pre>"; print_r($productCats); echo "</pre>";

    if (!empty($productCats)):
        echo '<ul class="list-group list-group-bordered list-group-noicon">';
        foreach ($productCats as $productCat):
            $productCatBnName = get_term_meta($productCat->term_id, 'bn_bangla_title', true);
            $productCatName = !empty($productCatBnName) ? $productCatBnName . " [" . $productCat->name . "]" : $productCat->name;
            ?>
            <li class="list-group-item active">
                <a  href="<?php echo esc_attr(get_term_link($productCat->term_id)); ?>"><?php echo $productCatName . ' <span class="pull-right">(' . $productCat->count . ')</span>'; ?></a>
            </li>
            <?php
        endforeach;
        echo '</ul>';
    endif;
    ?>

    <!--    <ul class="list-group list-group-bordered list-group-noicon uppercase">
            <li class="list-group-item active">
    
                <a class="dropdown-toggle" href="#">প�?রবন�?ধ</a>
                <ul>
                    <li><a href="#"><span class="size-11 text-muted pull-right">(331)</span> কাজী নজর�?ল ইসলাম</a></li>
                    <li><a href="#"><span class="size-11 text-muted pull-right">(123)</span> হ�?মায়েন আহমেদ</a></li>
                    <li class="active"><a href="#"><span class="size-11 text-muted pull-right">(234)</span> চন�?দন আনোয়ার</a></li>
                </ul>
            </li>
        </ul>-->

    
</div>
<!-- /CATEGORIES -->
<?php dynamic_sidebar("products-sidebar"); ?>
<!-- Discount
<div class="side-nav margin-bottom-60">

        <div class="side-nav-head">
                <button class="fa fa-bars"></button>
                <h4>DISCOUNT</h4>
        </div>
    <form class="sky-form tk" method="post" action="#">        
        <ul class="list-group">
                <li class="list-group-item"><label class="checkbox nomargin active"><input type="checkbox" name="checkbox"><i></i>1% - 5%</label></li>
                <li class="list-group-item"><label class="checkbox nomargin active"><input type="checkbox" name="checkbox"><i></i>6% - 10%</label></li>
                <li class="list-group-item"><label class="checkbox nomargin active"><input type="checkbox" name="checkbox"><i></i>11% - 15%</label></li>
                <li class="list-group-item"><label class="checkbox nomargin active"><input type="checkbox" name="checkbox"><i></i>16% - 20%</label></li>
                <li class="list-group-item"><label class="checkbox nomargin active"><input type="checkbox" name="checkbox"><i></i>21% - 25%</label></li>
                <li class="list-group-item"><label class="checkbox nomargin active"><input type="checkbox" name="checkbox"><i></i>26% - 30%</label></li>
                <li class="list-group-item"><label class="checkbox nomargin active"><input type="checkbox" name="checkbox"><i></i>31% - 35%</label></li>
                <li class="list-group-item"><label class="checkbox nomargin active"><input type="checkbox" name="checkbox"><i></i>36% - 40%</label></li>
                <li class="list-group-item"><label class="checkbox nomargin active"><input type="checkbox" name="checkbox"><i></i>41% - 45%</label></li>
                <li class="list-group-item"><label class="checkbox nomargin active"><input type="checkbox" name="checkbox"><i></i>46% - 50%</label></li>
                
        </ul>
    </form>

</div>
 Discount -->


<!-- BANNER ROTATOR -->
<div class="owl-carousel buttons-autohide controlls-over margin-bottom-60 text-center" data-plugin-options='{"singleItem": true, "autoPlay": 4000, "navigation": true, "pagination": false, "transitionStyle":"goDown"}'>
    <a href="#">
        <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/assets/images/demo/shop/banners/off_1.png" width="270" height="350" alt="">
    </a>
    <a href="#">
        <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/assets/images/demo/shop/banners/off_2.png" width="270" height="350" alt="">
    </a>
</div>
<!-- /BANNER ROTATOR -->


<!-- FEATURED -->
<div class="margin-bottom-60">

    <h2 class="owl-featured">FEATURED</h2>
    <div class="owl-carousel featured" data-plugin-options='{"singleItem": true, "stopOnHover":false, "autoPlay":false, "autoHeight": false, "navigation": true, "pagination": false}'>

        <div><!-- SLIDE 1 -->
            <ul class="list-unstyled nomargin nopadding text-left">
                <?php
                $args = array(
                    'post_type' => 'product',
                    'meta_key' => '_featured',
                    'meta_value' => 'yes',
                    'posts_per_page' => 6
                );

                $featured_query = new WP_Query($args);

                if ($featured_query->have_posts()) :
                    $sideFeaturedCnt = 0;
                    while ($featured_query->have_posts()) :
                        $sideFeaturedCnt++;
                        $featured_query->the_post();

                        $product = get_product($featured_query->post->ID);

                        $meta = get_post_meta($product->id, '_bq_product_meta', TRUE);
                        $title = empty($meta["_bn_title"]) ? get_the_title() : $meta["_bn_title"];
                        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($product->id), 'shop_catalog');
                        $thumbSrc = $thumb[0];

                        $regular_price = get_post_meta($product->id, '_regular_price', true);
                        $sale_price = get_post_meta($product->id, '_sale_price', true);
                        $price = !empty($sale_price) && $sale_price > 0 ? $sale_price : $regular_price;

                        echo '<li class="clearfix"><!-- item -->
                                    <div class="thumbnail featured clearfix pull-left">
                                        <a href="' . get_permalink($product->id) . '">
                                            <img src="' . $thumbSrc . '" width="80" height="80" alt="featured item">
                                        </a>
                                    </div>

                                    <a class="block size-1" href="' . get_permalink($product->id) . '">' . $title . '</a>
                                    <div class="rating rating-4 size-13 width-100 text-left"><!-- rating-0 ... rating-5 --></div>
                                    <div class="size-18 text-left">' . wc_price($price) . '</div>
                                </li>';

                        if ($sideFeaturedCnt > 0 && $sideFeaturedCnt < 6 && $sideFeaturedCnt % 3 == 0) {
                            echo '</ul>
                                </div>

                                <div>
                                    <ul class="list-unstyled nomargin nopadding text-left">';
                        }

                    endwhile;

                endif;

                wp_reset_query(); // Remember to reset
                ?>
            </ul>
        </div><!-- /SLIDE 2 -->

    </div>

</div>
<!-- /FEATURED -->

