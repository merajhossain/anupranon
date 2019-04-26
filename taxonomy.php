<?php get_header(); echo "taxonomy"; exit;  ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php if (have_posts()) : ?>

            <header class="page-header">
                <?php
                the_archive_title('<h1 class="page-title">', '</h1>');
                the_archive_description('<div class="taxonomy-description">', '</div>');
                ?>
            </header><!-- .page-header -->

            <?php
            while (have_posts()) : the_post();
                get_template_part('partials/archive', "single-item");
            endwhile;

            // Previous/next page navigation.
            the_posts_pagination(array(
                'prev_text' => __('Previous page', 'anupranan'),
                'next_text' => __('Next page', 'anupranan'),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'anupranan') . ' </span>',
            ));

        // If no content, include the "No posts found" template.
        else :
            get_template_part('partials/content', 'none');

        endif;
        ?>

    </main><!-- .site-main -->
</div><!-- .content-area -->


<?php get_footer(); ?>
