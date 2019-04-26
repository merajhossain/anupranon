<!-- FOOTER -->
<footer id="footer">
    <div class="container">

        <div class="row margin-top-60 margin-bottom-40 size-13">

            <!-- col #1 -->
            <div class="col-md-4 col-sm-4">

                <!-- Footer Logo -->
                <img class="footer-logo" src="<?php $value = anupranan_get_theme_option( 'logo' ); echo $value; ?>" width="200" alt="" />

                <p>
                    <?php $value = anupranan_get_theme_option( 'logo-text' ); echo $value; ?>
                </p>

                <h5><?php $value = anupranan_get_theme_option( 'mobile' ); echo $value; ?></h5>

                <!-- Social Icons -->
                <div class="clearfix">

                    <a href="<?php $value = anupranan_get_theme_option( 'facebook' ); echo $value; ?>" class="social-icon social-icon-sm social-icon-border social-facebook pull-left" data-toggle="tooltip" data-placement="top" title="Facebook">
                        <i class="icon-facebook"></i>
                        <i class="icon-facebook"></i>
                    </a>

                    <a href="<?php $value = anupranan_get_theme_option( 'twitter' ); echo $value; ?>" class="social-icon social-icon-sm social-icon-border social-twitter pull-left" data-toggle="tooltip" data-placement="top" title="Twitter">
                        <i class="icon-twitter"></i>
                        <i class="icon-twitter"></i>
                    </a>

                    <a href="<?php $value = anupranan_get_theme_option( 'googleplus' ); echo $value; ?>" class="social-icon social-icon-sm social-icon-border social-gplus pull-left" data-toggle="tooltip" data-placement="top" title="Google plus">
                        <i class="icon-gplus"></i>
                        <i class="icon-gplus"></i>
                    </a>

                    <a href="<?php $value = anupranan_get_theme_option( 'likedin' ); echo $value; ?>" class="social-icon social-icon-sm social-icon-border social-linkedin pull-left" data-toggle="tooltip" data-placement="top" title="Linkedin">
                        <i class="icon-linkedin"></i>
                        <i class="icon-linkedin"></i>
                    </a>

                    <a href="<?php $value = anupranan_get_theme_option( 'rss' ); echo $value; ?>" class="social-icon social-icon-sm social-icon-border social-rss pull-left" data-toggle="tooltip" data-placement="top" title="Rss">
                        <i class="icon-rss"></i>
                        <i class="icon-rss"></i>
                    </a>

                </div>
                <!-- /Social Icons -->

            </div>
            <!-- /col #1 -->

            <!-- col #2 -->
            <div class="col-md-8 col-sm-8">

                <div class="row">

                    <div class="col-md-4 hidden-sm hidden-xs">
                        <h4 class="letter-spacing-1">RECENT NEWS</h4>
                        <ul class="list-unstyled footer-list half-paddings">
                            <?php 
                                $args = array(
                                    'post_type' => 'news',
                                    'posts_per_page' => 4,
                                    'order'   => 'DESC',
                                    
                                );
                                $post_query = new wp_query($args);
                                if($post_query->have_posts()):
                                    while($post_query->have_posts()){
                                        $post_query->the_post();
                            ?>  
                                <li>
                                    <a class="block" href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a>
                                    <?php $my_date = the_date('', '<small>', '</small>', FALSE); echo $my_date; ?>
                                </li>
                            <?php        }
                                endif;
                                wp_reset_query();
                            ?>
                        </ul>
                    </div>

                    <div class="col-md-3 hidden-sm hidden-xs">
                        <h4 class="letter-spacing-1">EXPLORE US</h4>
                       
                        <?php wp_nav_menu(
                                array(
                                        'theme_location' 	=> 'footer-menu',
                                        'container_id'      => 'bs-example-navbar-collapse-1',
                                        'menu_class' 	=> 'list-unstyled footer-list half-paddings noborder'
                                )
                            ); 
                        ?>
                    </div>

                    <div class="col-md-5">
                        <h4 class="letter-spacing-1">SECURE PAYMENT</h4>
                        <p><?php $value = anupranan_get_theme_option( 'paymentText' ); echo $value; ?></p>
                        <p>	<!-- see assets/images/cc/ for more icons -->
                            <img src="<?php $value = anupranan_get_theme_option( 'paymentlinkimage-1' ); echo $value; ?>" alt="" />
                            <img src="<?php $value = anupranan_get_theme_option( 'paymentlinkimage-2' ); echo $value; ?>" alt="" />
                            <img src="<?php $value = anupranan_get_theme_option( 'paymentlinkimage-3' ); echo $value; ?>" alt="" />
                            <img src="<?php $value = anupranan_get_theme_option( 'paymentlinkimage-4' ); echo $value; ?>" alt="" />
                            <img src="<?php $value = anupranan_get_theme_option( 'paymentlinkimage-5' ); echo $value; ?>" alt="" />
                        </p>
                    </div>

                </div>

            </div>
            <!-- /col #2 -->

        </div>

    </div>

    <div class="copyright">
        <div class="container">
            <ul class="pull-right nomargin list-inline mobile-block">
                <li><a href="<?php $value = anupranan_get_theme_option( 'copyWriteLink1' ); echo $value; ?>"><?php $value = anupranan_get_theme_option( 'copyWriteLinkname1' ); echo $value; ?></a></li>
                <li>&bull;</li>
                <li><a href="<?php $value = anupranan_get_theme_option( 'copyWriteLink2' ); echo $value; ?>"><?php $value = anupranan_get_theme_option( 'copyWriteLinkname2' ); echo $value; ?></a></li>
            </ul>

            &copy; <?php $value = anupranan_get_theme_option( 'copyWrite' ); echo $value; ?>
        </div>
    </div>

</footer>
<!-- /FOOTER -->


</div>
<!-- /wrapper -->
<!-- SCROLL TO TOP -->
<a href="#" id="toTop"></a>
<!-- PRELOADER -->
<div id="preloader">
    <div class="inner">
        <span class="loader"></span>
    </div>
</div><!-- /PRELOADER -->

<?php wp_footer(); ?>

</body>
</html>