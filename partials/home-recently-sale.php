<section class="nopadding-bottom alternate">
    <div class="container">
        <h2 class="owl-featured noborder"><strong>Recently Sold Products</strong></h2>
            <div class="owl-carousel featured nomargin owl-padding-10" data-plugin-options='{"singleItem": false, "items": "6", "stopOnHover":false, "autoPlay":4000, "autoHeight": false, "navigation": true, "pagination": false, "lazyLoad" : true}'>
                <?php 
                    $after_date    = date( 'Y-m-d', strtotime('-7 days') );
                    $args = array(
                        'post_type' => 'shop_order',
                        'post_status' => 'publish',
                        'posts_per_page' => 10
                    );

                    $args['date_query'] = array(
                        'after' => $after_date,
                        'inclusive' => true
                    );
                    $posts = get_posts( $args );

                    foreach( $posts as $post ) {

                        $order = new WC_Order($post->ID);
                        $products = $order->get_items(); // get products in current order
                        // loop through products to find matching id's and add qty when matching current id
                        foreach ( $products as $product ) {
                            $item_id = $product['product_id'];
                            $data = get_post_meta( $item_id, '_bn_title'); 
                            $regular_price = get_post_meta( $item_id, '_regular_price', true);
                            $sale_price = get_post_meta( $item_id, '_sale_price', true);
                            $price = !empty($sale_price) && $sale_price>0 ? $sale_price : $regular_price;
                            $image = get_the_post_thumbnail_url($item_id, 'shop_catalog')
                    ?>
                    <!-- item -->
                    <div class="shop-item">

                            <div class="shop-item">

                                <div class="thumbnail">
                                        <!-- product image(s) -->
                                        <a class="shop-item-image" href="<?php echo get_post_permalink($item_id);?>">
                                                <img class="img-responsive lazyOwl" data-src="<?php echo $image; ?>" alt="shop first image" />
                                                <img class="img-responsive lazyOwl" data-src="<?php echo $image; ?>" alt="shop hover image" />
                                        </a>
                                        <!-- /product image(s) -->

                                        <!-- hover buttons -->
                                        <div class="shop-option-over"><!-- replace data-item-id width the real item ID - used by js/view/demo.shop.js -->
                                            <!--<a class="btn btn-default add-wishlist" href="#" data-item-id="1" data-placement="bottom" data-toggle="tooltip" title="Add To Wishlist"><i class="fa fa-heart nopadding"></i></a>
                                            <a class="btn btn-default add-compare" href="#" data-item-id="1" data-placement="bottom" data-toggle="tooltip" title="Add To Compare"><i class="fa fa-bar-chart-o nopadding" data-toggle="tooltip"></i></a>-->
                                        </div>
                                        <!-- /hover buttons -->

                                        <!-- product more info-->
                                        <div class="shop-item-info">
                                                <!--<span class="label label-success">NEW</span>
                                                <span class="label label-danger">SALE</span>-->
                                        </div>
                                        <!-- /product more info--->
                                </div>

                                <div class="shop-item-summary text-center">
                                        <h2><?php echo $data[0]; ?></h2>

                                        <!-- rating -->
                                        <div class="shop-item-rating-line">
                                                <div class="rating rating-4 size-11"><!-- rating-0 ... rating-5 --></div>
                                        </div>
                                        <!-- /rating -->

                                        <!-- price -->
                                        <div class="shop-item-price">
                                            <p><?php if($sale_price) echo '<span class="line-through">'.wc_price($regular_price).'</span>'; ?> <span class="current-price"><?php echo wc_price($price); ?></span></p>
                                        </div>
                                        <!-- /price -->
                                </div>

                            </div>

                    </div>
                    <!-- /item -->
                    <?php
                        }

                    }
              ?>
            </div>
            <!--<div class="center-block button-width">
                <a class="btn btn-primary view-all-btn" href="books.html">View All</a>
            </div>-->
    </div>
</section>
