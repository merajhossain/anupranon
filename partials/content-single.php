<?php
$landscape_thumb_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'landscape-thumb');
$thumb_url = !empty($landscape_thumb_url[0]) ? esc_url($landscape_thumb_url[0]) : NO_IMG_URL;
$comments_count = wp_count_comments(get_the_ID());
$total_comments = (!empty($comments_count) && $comments_count->approved > 0) ?  $comments_count->approved : 0;
?>
<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="container">
        <div class="entry-content">
            <?php the_content(); ?>
        </div><!-- .entry-content -->
    </div>
</section>