<?php
/**
 * The template for displaying archive pages
 */

session_start();


get_header(); ?>


<section class="container sort_settings">
	<div class="inner">
		<div class="row">
			<div class="col-lg-6 col-md-5">
				<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>
			</div>
		</div>
	</div>
</section>

<section class="container car_tiles" id="archiveContent">
	<div id="listingTiles" class="row-eq-height">

		<?php if ( have_posts() ) : ?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				?>

				<div class="col-md-4">
					<div class="tile" style="height: 100%;padding-bottom:70px;">

						<div class="tile_header">
							<div class="tile_body" style="padding: 0px;">
								<a href="<?php the_permalink(); ?>"><h4 title="<?php the_title(); ?>"><b style="    text-overflow: initial!important;overflow: inherit;!important; white-space: inherit!important;"><?php the_title(); ?></b></h4></a>
							</div>
							<?php if( has_post_thumbnail() ) : ?>
								<div class="thumb" style="background: url('<?php the_post_thumbnail_url(); ?>')"></div>
							<?php else: ?>
								<div class="thumb empty"></div>
							<?php endif; ?>
						</div>

						<div class="text-center" style="padding: 15px;">
							<?php the_excerpt(); ?>
							<br />
							<div class="btn-align-bottom">
							<a href="<?php the_permalink(); ?>" class="btn btn_custom">Czytaj więcej</a>
							</div>
						</div>
					</div>
				</div>

				<?php
				endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</div>

</section>

<?php get_footer();
