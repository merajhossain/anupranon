<?php
$landscape_thumb_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'landscape-thumb');
$thumb_url = !empty($landscape_thumb_url[0]) ? esc_url($landscape_thumb_url[0]) : NO_IMG_URL;
$comments_count = wp_count_comments(get_the_ID());
$total_comments = (!empty($comments_count) && $comments_count->approved > 0) ?  $comments_count->approved : 0;
?>
<!-- POST ITEM -->
<div id="post-<?php the_ID(); ?>" <?php post_class("blog-post-item col-md-4 col-sm-6"); ?>>

    <!-- IMAGE -->
    <figure class="margin-bottom-20">
        <img class="img-responsive" src="<?php echo $thumb_url; ?>" alt="">
    </figure>

    <h2><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h2>

    <ul class="blog-post-info list-inline">
        <li>
            <a href="#">
                <i class="fa fa-clock-o"></i> 
                <span class="font-lato"><?php echo get_the_date( "F d, Y" ) ?></span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fa fa-comment-o"></i> 
                <span class="font-lato"><?php echo $total_comments; ?></span>
            </a>
        </li>
    </ul>

    <p><?php the_excerpt(); ?></p>

    <a href="<?php the_permalink(); ?>" class="btn btn-reveal btn-default">
        <i class="fa fa-plus"></i>
        <span>Read More</span>
    </a>

</div>
<!-- /POST ITEM -->