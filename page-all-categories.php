<?php
/*
 * Template Name: All Categories
 */
get_header();
?>

<section>
    <div class="container">


        <div class="divider divider-center divider-color"><!-- divider -->
            <i class="fa fa-chevron-down"></i>
        </div>

        <!-- FEATURED BOXES 3 -->
        <div class="row">

            <?php
            $total_item = wp_count_terms('product_cat', array('hide_empty' => false));
            $page = get_query_var('page', 1);
            $per_page = 6;
            $offset = $page > 1 ? (($page - 1) * $per_page) : 0;
            $productCats= get_terms(array(
                'taxonomy' => 'product_cat',
                'with_thumbnail' => true,
                'hide_empty' => false,
                'number' => $per_page,
                'offset' => $offset
            ));

            //echo $total_item;
            //echo "<pre>"; print_r($writers); echo "</pre>";

            if (!empty($productCats)):
                foreach ($productCats as $productCat):
                    $productCatThumbId = get_term_thumbnail_id($productCat->term_id);
                    $productCatThum = wp_get_attachment_image_src($productCatThumbId, 'thumbnail');
                    $productCatThumSrc = $productCatThum[0]; // thumbnail url

                    $productCatBnName = get_term_meta($productCat->term_id, 'bn_bangla_title', true);
                    $productCatName = !empty($productCatBnName) ? $productCatBnName : $productCat->name;
                    ?>
                    <div class="col-md-4 col-xs-6">
                        <div class="text-center writer-height">
                            <a href="<?php echo esc_attr(get_term_link($writer->term_id)); ?>">
                                <?php if($productCatThumSrc){ ?>
                                <img class="rounded writer-img" alt="" src="<?php echo $productCatThumSrc; ?>" />
                                <?php }                                            
                                else {
                                ?>
                                <img class="rounded writer-img" alt="" src="<?php bloginfo('template_url'); ?>/assets/images/Noimage-150x150.jpg" />    
                                <?php } ?>
                            </a>
                            <h4><?php echo $productCatName; ?></h4>
                            <p class="font-lato size-20"><?php echo $productCat->description; ?></p>
                        </div>
                    </div>
                    <?php
                endforeach;
            endif;
            ?>
        </div>
        <!-- /FEATURED BOXES 3 -->
        <!-- PAGINATION -->
        <div class="text-left">
            <!-- Pagination Default -->
            <?php
            $pagin_args = array(
                "base_url" => get_permalink(get_page_by_path("all-categories")),
                "total_item" => $total_item,
                "cur_page" => $page,
                "per_page" => $per_page,
                "current_class" => "active",
                "pagin_holder_start" => '<ul class="pagination nomargin pull-right">',
                "pagin_holder_end" => '</ul>'
            );

            $bqPagination = new BqPagination($pagin_args);
            echo $bqPagination->generate_pagination();
            ?>
        </div>
        <!-- /PAGINATION -->

    </div>
</section>
<?php get_footer(); ?>
