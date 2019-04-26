<?php $texMeta = new Tax_Meta_Class(array()); ?>
<section>
    <div class="container">
        <ul class="nav nav-tabs nav-justified">
            <li class="active"><a href="#home_justified" data-toggle="tab">Writers</a></li>
            <li><a href="#profile_justified" data-toggle="tab">Publishers</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade in active" id="home_justified">
                <!-- FEATURED BOXES 3 -->
                <div class="row">

                    <?php
                        $writers = get_terms(array(
                            'taxonomy' => 'writer',
                            'with_thumbnail' => true,
                            'hide_empty' => false,
                            'number' => 6
                        ));

                        //echo "<pre>"; print_r($writers); echo "</pre>";

                        if (!empty($writers)):
                            foreach ($writers as $writer):
                                $writerThumbId = get_term_thumbnail_id($writer->term_id);
                                $writerThum = wp_get_attachment_image_src($writerThumbId, 'thumbnail');
                                $writerThumSrc = $writerThum[0]; // thumbnail url

                                $writerBnName = get_term_meta($writer->term_id, 'bn_bangla_title', true);
                                ?>
                                <div class="col-md-4 col-xs-6">
                                    <div class="text-center writer-height">
                                        <a href="<?php echo esc_attr(get_term_link($writer->term_id)); ?>" data-toggle="tooltip" title="<?php echo $writer->description; ?>" data-placement="bottom">
                                            <img class="rounded writer-img" alt="" src="<?php echo $writerThumSrc; ?>" />
                                        </a>
                                        <h4><?php echo $writer->name; ?></h4>
                                        <h5><?php echo $writerBnName; ?></h5>
                                        <p class="font-lato size-14"><?php echo wp_trim_words(  $writer->description, 15, '...' ) ; ?></p>
                                    </div>
                                </div>
                                <?php
                            endforeach;
                        endif;
                    ?>
                </div>
                <!-- /FEATURED BOXES 3 -->
                <div class="center-block button-width margin-top-30">
                    <a class="btn btn-primary view-all-btn" href="<?php echo get_permalink(get_page_by_path("all-writers")); ?>">View All</a>
                </div> 
            </div>
            <div class="tab-pane fade" id="profile_justified">
                <!-- FEATURED BOXES 3 -->
                <div class="row">

                    <!-- 
                    <?php
                    $publishers = get_terms(array(
                        'taxonomy' => 'publisher',
                        'with_thumbnail' => true,
                        'hide_empty' => false,
                        'number' => 6
                    ));

                    //echo "<pre>"; print_r($writers); echo "</pre>";

                    if (!empty($publishers)):
                        foreach ($publishers as $publisher):
                            $publisherThumbId = get_term_thumbnail_id($publisher->term_id);
                            $publisherThum = wp_get_attachment_image_src($publisherThumbId, 'thumbnail');
                            $publisherThumSrc = $publisherThum[0]; // thumbnail url

                            $publisherBnName = get_term_meta($publisher->term_id, 'bn_bangla_title', true);
                            ?>
                                                       <div class="col-md-4 col-xs-6">
                                                           <div class="text-center writer-height">
                                                               <a href="<?php echo esc_attr(get_term_link($publisher->term_id)); ?>">
                                                                   <img class="rounded writer-img" alt="" src="<?php echo $publisherThumSrc; ?>" />
                                                               </a>
                                                               <h4><?php echo $publisher->name; ?></h4>
                                                               <h5><?php echo $publisherBnName; ?></h5>
                                                               <p class="font-lato size-14"><?php echo wp_trim_words(  $publisher->description, 15, '...' ) ; ?></p>
                                                           </div>
                                                       </div>
                            <?php
                        endforeach;
                    endif;
                    ?>
                    -->

                    <div class="col-md-4 col-xs-6">
                        <div class="text-center writer-height">
                            <a href="#">
                                <img src="http://localhost:8080/anupranan/wp-content/uploads/2016/08/logo_dark-150x149.png" alt="" class="rounded writer-img">
                            </a>
                            <h4>Anupranon</h4>
                            <h5>অন�?প�?রানন</h5>
                            <p class="font-lato size-20"></p>
                        </div>
                    </div>
                </div>
                <!-- /FEATURED BOXES 3 -->
                <div class="center-block button-width margin-top-30">
                    <a class="btn btn-primary view-all-btn" href="<?php echo get_permalink(get_page_by_path("all-publishers")); ?>">View All</a>
                </div>                                  
            </div>
        </div>
    </div>
</section>