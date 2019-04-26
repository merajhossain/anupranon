<section class="page-header">
    <div class="container">
        <h1>
            <?php
            if (is_archive()) {
                the_archive_title();
            } else {
                global $post;
                //echo '<pre>'; print_r($post); echo '</pre>';
                $meta = get_post_meta(get_the_ID(), '_bq_'.$post->post_type.'_meta', TRUE);
                $title = empty($meta["_bn_title"]) ? get_the_title() : $meta["_bn_title"];
                echo $title;
            }
            ?>
        </h1>
    </div>
</section>