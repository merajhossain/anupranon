<?php
$square_thumb_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'square-thumb');
$thumb_url = !empty($square_thumb_url[0]) ? esc_url($square_thumb_url[0]) : NO_IMG_URL;
?>
<div class="row">
    <div class="col-md-3 text-center">
        <img src="<?php echo $thumb_url; ?>" class="img-responsive" alt="">
    </div>
    <div class="col-md-9">
        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
        <p>
            <?php the_excerpt(); ?>
            <small class="block"><?php echo get_the_date("F Y") ?></small>
        </p>
    </div>
</div>
<hr>