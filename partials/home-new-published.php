<?php
$args = array(
    'post_type' => 'product',
    'posts_per_page' => 12,
    'order' => 'DESC'
);

$loop = new WP_Query($args);
if ($loop->have_posts()) :
    ?>
    <section class="nopadding-bottom">
        <div class="container">
            <h2 class="owl-featured noborder"><strong>নতুন প্রকাশিত বইসমূহ</strong></h2>
            <div class="owl-carousel featured nomargin owl-padding-10" data-plugin-options='{"singleItem": false, "items": "6", "stopOnHover":false, "autoPlay":4000, "autoHeight": false, "navigation": true, "pagination": false, "lazyLoad" : true}'>
                <?php
                while ($loop->have_posts()) : $loop->the_post();
                    wc_get_template_part("home", "carousals");
                endwhile;
                ?>
            </div>
            <div class="center-block button-width">
                <a class="btn btn-primary view-all-btn" href="<?php echo get_site_url().'/books'; ?>">View All</a>
            </div>
        </div>
    </section>
    <?php
endif;
wp_reset_postdata();
?>
