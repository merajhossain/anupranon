<!-- item -->
<div class="shop-item">

    <div class="shop-item">
        <?php
        $meta = get_post_meta($post->ID,'_bq_product_meta',TRUE);
        $title = empty($meta["_bn_title"]) ? get_the_title() : $meta["_bn_title"];
        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'shop_catalog');
        $thumbSrc = $thumb[0];
        
        
        $regular_price = get_post_meta( get_the_ID(), '_regular_price', true);
        $sale_price = get_post_meta( get_the_ID(), '_sale_price', true);
        $price = !empty($sale_price) && $sale_price>0 ? $sale_price : $regular_price;
        ?>
        <div class="thumbnail">
            <!-- product image(s) -->
            <a class="shop-item-image" href="<?php the_permalink(); ?>">
                <img class="img-responsive lazyOwl" src="<?php echo $thumbSrc; ?>" alt="shop first image" />
                <img class="img-responsive lazyOwl" src="<?php echo $thumbSrc; ?>" alt="shop hover image" />
            </a>
            <!-- /product image(s) -->

            <!-- hover buttons -->
            <div class="shop-option-over"><!-- replace data-item-id width the real item ID - used by js/view/demo.shop.js -->
                <a class="btn btn-default add-wishlist" href="#" data-item-id="1" data-placement="bottom" data-toggle="tooltip" title="Add To Wishlist"><i class="fa fa-heart nopadding"></i></a>
                <a class="btn btn-default add-compare" href="#" data-item-id="1" data-placement="bottom" data-toggle="tooltip" title="Add To Compare"><i class="fa fa-bar-chart-o nopadding" data-toggle="tooltip"></i></a>
            </div>
            <!-- /hover buttons -->

            <!-- product more info -->
            <div class="shop-item-info">
                <?php 
//                $featured = $product->is_featured(); 
//                if($featured) echo '<span class="label label-success">FEATURED</span>';
//                if($sale_price) echo '<span class="label label-danger">SALE</span>';
                ?>
            </div>
            <!-- /product more info -->
        </div>
        
        <div class="shop-item-summary text-center">
            <h2><?php echo $title; ?></h2>

            <!-- rating -->
            <div class="shop-item-rating-line">
                <div class="rating rating-4 size-13"><!-- rating-0 ... rating-5 --></div>
            </div>
            <!-- /rating -->

            <!-- price -->
            <div class="shop-item-price">
                <p><?php if($sale_price) echo '<span class="line-through">'.wc_price($regular_price).'</span>'; ?> <span class="current-price"><?php echo wc_price($price); ?></span></p>
            </div>
            <!-- /price -->
            <div class="shop-item-buttons text-center">
                <a class="btn btn-default button product_type_simple add_to_cart_button ajax_add_to_cart added" data-product_sku="" data-product_id="<?php echo get_the_ID(); ?>" data-quantity="1" href="/anupranan/?add-to-cart=<?php echo get_the_ID(); ?>" rel="nofollow"><i class="fa fa-cart-plus"></i> Add to Cart</a>
            </div>
        </div>

    </div>

</div>
<!-- /item -->