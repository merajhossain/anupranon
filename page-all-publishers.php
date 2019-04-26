<?php
/*
 * Template Name: All Publishers
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
            $count_all = wp_count_terms( 'publisher', array('hide_empty' => false) );
            $page = get_query_var( 'page', 1 );
            $per_page = 6;
            $offset = $page>1 ? (($page-1)*$per_page) : 0;
            $publishers = get_terms(array(
                'taxonomy' => 'publisher',
                'number' => $per_page,
                'offset' => $offset,
                'orderby' => 'name',
                'order' => 'ASC',
                'hide_empty' => false, //can be 1, '1' too
            ));

            //echo "<pre>"; print_r($writers); echo "</pre>";

            if (!empty($publishers)):
                foreach ($publishers as $publisher):
                    $publisherThumbId = get_term_thumbnail_id($publisher->term_id);
                    $publisherThum = wp_get_attachment_image_src($publisherThumbId, 'thumbnail');
                    $publisherThumSrc = $publisherThum[0]; // thumbnail url

                    $publisherBnName = get_term_meta($publisher->term_id, 'bn_bangla_title', true);
                    $publisherName = !empty($publisherBnName) ? $publisherBnName : $publisher->name;
                    ?>
                    <div class="col-md-4 col-xs-6">
                        <div class="text-center writer-height">
                            <a href="<?php echo esc_attr(get_term_link($writer->term_id)); ?>">
                                <?php if($publisherThumSrc){ ?>
                                <img class="rounded writer-img" alt="" src="<?php echo $publisherThumSrc; ?>" />
                                <?php }                                            
                                else {
                                ?>
                                <img class="rounded writer-img" alt="" src="<?php bloginfo('template_url'); ?>/assets/images/Noimage-150x150.jpg" />    
                                <?php } ?>
                            </a>
                            <h4><?php echo $publisherName; ?></h4>
                            <p class="font-lato size-14"><?php echo wp_trim_words(  $publisher->description, 15, '...' ) ; ?></p>
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
            <?php
                $pagin_args = array(
                    "base_url" => get_permalink(get_page_by_path("all-writers")),
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
