<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('partials/page', 'top'); ?>

    <section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="container">
            <div class="row entry-content">
                <div class="col-sm-9">
                    <?php get_template_part('partials/content', 'single-megazine'); ?>
                </div>
                <div class="col-sm-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                Monthly archive
                            </h4>
                        </div>
                        <div class="" aria-expanded="true" style="">
                            <div class="panel-body">
                                <ul class="list-unstyled list-icons margin-bottom-10 list-group list-group-bordered">
                                    <?php wp_get_archives(array('post_type' => 'megazine')); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endwhile; ?>
<?php get_footer(); ?>