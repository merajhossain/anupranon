<section class="page-header">
    <div class="container">

        <?php //if (apply_filters('woocommerce_show_page_title', true)) : ?>

        <?php //endif; ?>

        <?php
        if (is_product()):
            $meta = get_post_meta(get_the_ID(), '_bq_product_meta', TRUE);
            $title = empty($meta["_bn_title"]) ? get_the_title() : $meta["_bn_title"];
            ?>
            <h1><?php echo $title; ?></h1>
        <?php else: ?>
            <h1><?php woocommerce_page_title(); ?></h1>
        <?php endif; ?>

        <?php
        /**
         * woocommerce_before_main_content hook.
         *
         * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
         * @hooked woocommerce_breadcrumb - 20
         */
        do_action('woocommerce_before_main_content');
        ?>

        <!--        <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Pages</a></li>
                    <li class="active">Books</li>
                </ol>-->

    </div>
</section>