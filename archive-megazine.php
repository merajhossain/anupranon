<?php get_header(); ?>
<section class="page-header">
    <div class="container">
        <h1>Magazines</h1>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <?php if (have_posts()) : ?>
                    <?php
                    while (have_posts()) : the_post();
                        get_template_part('partials/content', "loop-single-grid");
                    endwhile;
                    ?>
                    <?php
                else :
                    echo "Sorry no item availavle to display";
                endif;
                ?>

                <div class="text-center margin-top-60">
                    <?php
                    $total_item = $count = $GLOBALS['wp_query']->found_posts;
                    $page = get_query_var('paged', 1);
                    // "base_url" => get_post_type_archive_link($GLOBALS['wp_query']->query_vars['post_type']),
                    
                    $pagin_args = array(
                        "page_var_name" => "paged",
                        "total_item" => $total_item,
                        "cur_page" => $page,
                        "per_page" => GLOBAL_POSTS_PER_PAGE,
                        "current_class" => "active",
                        "pagin_holder_start" => '<ul class="pagination">',
                        "pagin_holder_end" => '</ul>'
                    );

                    $bqPagination = new BqPagination($pagin_args);
                    echo $bqPagination->generate_pagination();
                    ?>
                </div>
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
<?php get_footer(); ?>