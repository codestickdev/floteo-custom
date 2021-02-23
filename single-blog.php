<?php
/**
 * The template for displaying all single posts
 */
get_header();
?>


	<section class="container default_page">
		<h4 class="section_header with_line" ><?php echo get_the_title(); ?></h4>
		<div class="inner"><?php
			while ( have_posts() ) :
				the_post();

				?>




				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


					<header class="entry-header"></header>


					<div class="entry-content">


						<?php
						the_content();

						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'floteo-custom' ),
							'after'  => '</div>',
						) );
						?>


					</div><!-- .entry-content -->

					<?php if ( get_edit_post_link() ) : ?>
						<footer class="entry-footer">
							<?php
							edit_post_link(
								sprintf(
									wp_kses(
									/* translators: %s: Name of current post. Only visible to screen readers */
										__( 'Edit <span class="screen-reader-text">%s</span>', 'floteo-custom' ),
										array(
											'span' => array(
												'class' => array(),
											),
										)
									),
									get_the_title()
								),
								'<span class="edit-link">',
								'</span>'
							);
							?>
						</footer><!-- .entry-footer -->
					<?php endif; ?>
				</article><!-- #post-<?php the_ID(); ?> -->


				<?php

				//the_post_navigation();

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
		</div>
	</section>


<?php
get_footer();
