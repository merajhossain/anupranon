<?php get_header(); ?>
<section class="page-header">
    <div class="container">
        <h1>404</h1>
    </div>
</section>
<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="container">
        <div class="entry-content" style="min-height: 200px;">
            <h4>Sorry, nothing found on this directory.</h4>
            <p>This part might be in development process</p>
        </div><!-- .entry-content -->
    </div>
</section>
<?php get_footer(); ?>