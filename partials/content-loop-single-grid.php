<?php 
$portrait_thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'portrait-thumb' ); 
$thumb_url = !empty($portrait_thumb_url[0]) ? esc_url($portrait_thumb_url[0]) : NO_IMG_URL ;
?>
<div class="col-md-4">
    <div id="post-<?php the_ID(); ?>" <?php post_class("item-box"); ?> >
        <figure>
            <a class="item-hover" href="<?php the_permalink(); ?>">
                <span class="overlay color2"></span>
                <span class="inner">
                    <span class="block fa fa-plus fsize20"></span>
                    <strong>READ</strong> ARTICLE
                </span>
            </a>
            <img alt="" class="img-responsive" src="<?php echo $thumb_url; ?>" width="263" height="147" />
        </figure>
        <div class="item-box-desc">
            <h4><?php the_title(); ?></h4>
            <small><?php echo get_the_date( "F Y" ) ?></small>
            <p><?php the_excerpt(); ?></p>
        </div>
    </div>
</div>