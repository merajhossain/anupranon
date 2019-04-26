<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

get_header();
?>
<section class="page-header">
	<div class="container">
			<h1><?php _e( 'Search results for:', 'Anupranon' ); ?> <b><?php echo get_search_query(); ?></b></h1>
	</div>
</section>
<section>
	<div class="container">
		<?php if ( have_posts() ) : ?>

							<?php /* Start the Loop */ ?>
							<div class="row">
							<?php while ( have_posts() ) : the_post(); ?>

									<?php get_template_part( 'content', 'search' ); ?>

							<?php endwhile; ?>
							</div>
					<?php else : ?>

							<div class="row">
								<div class="col-md-12">
									<div class="text-center">
										<h3>Opps!, No Result Found Search Again.</h3>
									</div>
								</div>
							</div>
					<?php endif; ?>
	</div>
</section>
<?php
get_footer();
?>
