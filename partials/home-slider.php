<section class="padding-top-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-sm-12 nomargin-bottom">
                <?php
                $args = array(
                    'post_type' => 'slider',
                    'order' => 'ASC',
                    'posts_per_page' => 3
                );
                $slider_query = new WP_Query($args);

                if ($slider_query->have_posts()):
                    ?>
                    <!------slider start--------->
                    <!-- OWL SLIDER -->
                    <div class="owl-carousel buttons-autohide controlls-over nomargin" data-plugin-options='{"items": 1, "autoHeight": false, "navigation": true, "pagination": false, "transitionStyle":"fade", "progressBar":"true"}'>


                        <?php
                        // The Loop
                        $sliderCnt = 0;
                        while ($slider_query->have_posts()) {
                            $slider_query->the_post();
                            if ($sliderCnt == 0) {
                                $activeClass = 'active';
                            } else {
                                $activeClass = '';
                            }
                            $postId = get_the_ID();

                            if (has_post_thumbnail()) {
                                $sliderImg = wp_get_attachment_image_src(get_post_thumbnail_id(), 'home-slider');
                                $sliderImgSrc = $sliderImg[0]; // thumbnail url
                            } else {
                                
                            }

                            //$sliderUrl = get_post_meta($postId, 'slider_url', TRUE) ? get_post_meta($postId, 'slider_url', TRUE) : '';
                            echo '  <a href="#">
                                            <img src="' . $sliderImgSrc . '" class="img-responsive"  height="402" alt="' . get_the_title() . '">
                                        </a>';
                            $sliderCnt++;
                        }

                        /* Restore original Post Data */
                        wp_reset_postdata();
                        ?>


                    </div>
                    <!-- /OWL SLIDER -->            
                <?php endif; ?>
            </div>

            <div class="col-lg-3 col-sm-12 display-none">
                <!-- OWL SLIDER -->
                <?php
                $args = array(
                    'post_type' => 'ad_slider',
                    'order' => 'ASC',
                    'posts_per_page' => 3
                );
                $slider_query = new WP_Query($args);

                if ($slider_query->have_posts()):
                    ?>
                    <!------slider start--------->
                    <!-- OWL SLIDER -->
                    <div class="owl-carousel buttons-autohide controlls-over text-center" data-plugin-options='{"singleItem": true, "autoPlay": 4000, "navigation": true, "pagination": false, "transitionStyle":"fadeUp"}'>


                        <?php
                        // The Loop
                        $sliderCnt = 0;
                        while ($slider_query->have_posts()) {
                            $slider_query->the_post();
                            if ($sliderCnt == 0) {
                                $activeClass = 'active';
                            } else {
                                $activeClass = '';
                            }
                            $postId = get_the_ID();

                            if (has_post_thumbnail()) {
                                $sliderImg = wp_get_attachment_image_src(get_post_thumbnail_id(), 'home-slider');
                                $sliderImgSrc = $sliderImg[0]; // thumbnail url
                            } else {
                                
                            }

                            //$sliderUrl = get_post_meta($postId, 'slider_url', TRUE) ? get_post_meta($postId, 'slider_url', TRUE) : '';
                            echo '  <a href="#">
                                            <img src="' . $sliderImgSrc . '" class="img-responsive" alt="' . get_the_title() . '" width="270" height="350">
                                        </a>';
                            $sliderCnt++;
                        }

                        /* Restore original Post Data */
                        wp_reset_postdata();
                        ?>


                    </div>
                    <!-- /OWL SLIDER -->            
                <?php endif; ?>
            </div>

            <!------slider end--------->
        </div>
        <!-- INFO BAR
        <div class="info-bar info-bar-clean info-bar-bordered nomargin-bottom ">
            <div class="container">

                <div class="row">
                    
                    <div class="col-sm-3">
                        <i class="glyphicon glyphicon-globe"></i>
                        <h4>FREE SHIPPING &amp; RETURN</h4>
                        <p>Lorem ipsum dolor sit amet</p>
                    </div>
                    <div class="col-sm-3">
                        <i class="glyphicon glyphicon-usd"></i>
                        <h4>MONEY BACK GUARANTEE</h4>
                        <p>Lorem ipsum dolor sit amet.</p>
                    </div>

                    <div class="col-sm-3">
                        <i class="glyphicon glyphicon-flag"></i>
                        <h4>ONLINE SUPPORT 24/7</h4>
                        <p>Lorem ipsum dolor sit amet.</p>
                    </div>

                    <div class="col-sm-3">
                        <i><img src="<?php //echo get_template_directory_uri(); ?>/assets/images/icon2.png"/></i>
                        <h4>cash on delivery</h4>
                        <p>Pay cash at your doorstep</p>
                    </div>

                </div>

            </div>
        </div>
      INFO BAR -->

    </div>
</section>