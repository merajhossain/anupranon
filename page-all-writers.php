<?php
/*
 * Template Name: All Writers
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
            $total_item = wp_count_terms('writer', array('hide_empty' => false));
            
            $page = get_query_var('page', 1);
            $per_page = 6;
            $offset = $page > 1 ? (($page - 1) * $per_page) : 0;
            
            $writers = get_terms(array(
                'taxonomy' => 'writer',
                'number' => $per_page,
                'offset' => $offset,
                'orderby' => 'name',
                'order' => 'ASC',
                'hide_empty' => false, //can be 1, '1' too
              
                
            ));
    
            //echo $total_item;
            //echo "<pre>"; print_r($writers); echo "</pre>";

            if (!empty($writers)):
                foreach ($writers as $writer):
                    $writerThumbId = get_term_thumbnail_id($writer->term_id);
                    $writerThum = wp_get_attachment_image_src($writerThumbId, 'thumbnail');
                    $writerThumSrc = $writerThum[0]; // thumbnail url

                    $writerBnName = get_term_meta($writer->term_id, 'bn_bangla_title', true);
                    $writerName = !empty($writerBnName) ? $writerBnName : $writer->name;
                    $writerSlug = $writer->slug;
                    ?>
                    <div class="col-md-4 col-xs-6">
                        <div class="text-center writer-height">
                            <a href="<?php echo esc_attr(get_term_link($writer->term_id)); ?>">
                                <?php if($writerThumSrc){ ?>
                                <img class="rounded writer-img" alt="" src="<?php echo $writerThumSrc; ?>" />
                                <?php }                                            
                                else {
                                ?>
                                <img class="rounded writer-img" alt="" src="<?php bloginfo('template_url'); ?>/assets/images/Noimage-150x150.jpg" />    
                                <?php } ?>
                            </a>
                            <h4><?php echo $writerName; ?></h4>
                            <p class="font-lato size-14"><?php echo wp_trim_words(  $writer->description, 15, '...' ) ; ?></p>
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
