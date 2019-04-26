<section id="testimonials">
    <div class="container">

        <header class="text-center margin-bottom-60">
            <h2>Testimonials</h2>
            <hr />
        </header>

        <ul class="row clearfix testimonial-dotted list-unstyled">
            <?php $args = array(
                    'post_type'  => 'testmonial',
                    'order'      => 'DESC',
                    'posts_per_page' => 6,
                    );
                    $query = new WP_Query( $args );
            ?>
            <?php if($query->have_posts()): while($query->have_posts()){$query->the_post(); $post_id = $id;?>
            <li class="col-md-4">
                <div class="testimonial">
                    <figure class="pull-left">
                        <img class="rounded" src="<?php echo get_template_directory_uri(); ?>/assets/images/demo/people/300x300/humayunahmed-1.jpg" alt="" />
                    </figure>
                    <div class="testimonial-content">
                        <?php $content = get_the_content(); ?>
                        <p><a href="#" data-toggle="tooltip" title="<?php echo $content; ?>" data-placement="top"><?php echo wp_trim_words( get_the_content(), 13, '...' ); ?></a></p>
                        <cite>
                            <?php echo get_the_title(); ?>
                            <span><?php echo get_post_meta( $post_id, $key = 'Ocupation', $single = true );?></span>
                        </cite>
                    </div>
                </div>
            </li>
            <?php } endif; ?>
        </ul>

    </div>
</section>
