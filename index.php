<?php get_header(); ?>
    
    <!-- SLIDER -->
    <?php get_template_part( 'partials/home', 'slider' ); ?>
    <!-- /SLIDER -->

    <!--New Released Book-->
    <?php get_template_part( 'partials/home', 'new-published' ); ?>
      <!--/New Released Book-->
    <?php 
    $home_cats = array( "article", "story", "poem", "novel", "paper-back", "other" ); 
    foreach($home_cats as $home_cat){
        include(locate_template('partials/home-cats.php'));
    }
    ?>
    <!-- tabs -->
    <?php get_template_part( 'partials/home', 'tabs' ); ?>
    <!-- /tabs -->
    
    <!-- Recently Sale -->
    <?php get_template_part( 'partials/home', 'recently-sale' ); ?>
    <!-- Recently Sale -->
                
    <!-- TESTIMONIALS -->
    <?php get_template_part( 'partials/home', 'testimonials' ); ?>
    <!-- /TESTIMONIALS -->
                
    <!-- BRANDS -->
    <?php //get_template_part( 'partials/home', 'brands' ); ?>
    <!-- BRANDS -->

<?php get_footer(); ?>