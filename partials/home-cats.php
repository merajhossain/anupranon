<?php
$term_slug = $home_cat;
$term = get_term_by('slug', $term_slug, 'product_cat');
$termBnName = get_term_meta($term->term_id, 'bn_bangla_title', true);

$args = array(
    'posts_per_page' => 12,
    'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => $term_slug
        )
    ),
    'post_type' => 'product'
);

$loop = new WP_Query($args);
if ($loop->have_posts()) :
    ?>
    <section class="nopadding-bottom">
        <div class="container">
            <h2 class="owl-featured noborder"><strong><?php echo $termBnName; ?></strong></h2>
            <div class="owl-carousel featured nomargin owl-padding-10" data-plugin-options='{"singleItem": false, "items": "6", "stopOnHover":false, "autoPlay":4000, "autoHeight": false, "navigation": true, "pagination": false, "lazyLoad" : true}'>
                <?php
                while ($loop->have_posts()) : $loop->the_post();
                    wc_get_template_part("home", "carousals");
                endwhile;
                ?>
            </div>
            <div class="center-block button-width">
                <a class="btn btn-primary view-all-btn" href="<?php echo get_term_link($term); ?>">View All</a>
            </div>
        </div>
    </section>
    <?php
endif;
wp_reset_postdata();
?>