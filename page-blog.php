<?php
/*
 * Template Name: Blog
 */
get_header();
?>
<section class="page-header">
    <div class="container">
        <h1>Blog</h1>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-9">

                <?php
                $page = get_query_var('page', 1);
                $per_page = GLOBAL_POSTS_PER_PAGE;
                $offset = $page > 1 ? (($page - 1) * $per_page) : 0;

                $args = array(
                    'posts_per_page' => $per_page,
                    'offset' => $offset
                );
                // The Query
                $the_query = new WP_Query($args);
                $total_item = $the_query->found_posts;


                if ($the_query->have_posts()) :
                    while ($the_query->have_posts()) : $the_query->the_post();
                        get_template_part('partials/content', "loop-single");
                    endwhile;
                    wp_reset_postdata();
                else :
                // no posts found
                endif;
                ?>
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
                            <ul class="list-unstyled list-icons margin-bottom-10">
                                <?php wp_get_archives(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- /FEATURED BOXES 3 -->
        <!-- PAGINATION -->
        <div class="text-left">
            <!-- Pagination Default -->
            <?php
            $pagin_args = array(
                "total_item" => $total_item,
                "cur_page" => $page,
                "per_page" => $per_page,
                "current_class" => "active",
                "pagin_holder_start" => '<ul class="pagination nomargin pull-right">',
                "pagin_holder_end" => '</ul>'
            );

            $bqPagination = new BqPagination($pagin_args);
            echo $bqPagination->generate_pagination();
            ?>
        </div>
        <!-- /PAGINATION -->

    </div>
</section>
<?php get_footer(); ?>