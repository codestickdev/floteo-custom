<?php
/**
 * The template for displaying all pages
 */
get_header(); ?>

<section class="container default_page">
	<h4 class="section_header with_line" style="text-align:center;"><?php the_title(); ?></h4>
	<div class="inner">
		<?php the_content(); ?>
	</div>
</section>

<?php get_footer();
