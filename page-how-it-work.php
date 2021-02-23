<?php
/*
* Template Name: How it work page
*/
get_header(); ?>

<section class="container how_it_work_page">
	<h4 class="section_header with_line"><?php the_title(); ?></h4>
  <div class="row steps">
    <h3 class="subpage_header"><?php the_field('how_it_work_steps_header') ?></h3>
		<?php if( have_rows('how_it_work_steps') ): ?>
			<?php while( have_rows('how_it_work_steps') ): the_row();
				$how_it_work_step_ico = get_sub_field('how_it_work_step_ico');
				$how_it_work_step_header = get_sub_field('how_it_work_step_header');
				?>
				<div class="col-md-3">
		      <img class="svg" src="<?php echo $how_it_work_step_ico; ?>">
		      <p><?php echo $how_it_work_step_header; ?></p>
		    </div>
			<?php endwhile; ?>
		<?php endif; ?>
  </div>

  <div class="row what_is">
    <h3 class="subpage_header"><?php the_field('how_it_work_description_header') ?></h3>
    <div class="col-md-10 col-md-offset-1">
      <?php the_field('how_it_work_description_content') ?>
    </div>
  </div>
</section>

<section class="container-fluid how_it_work_baner" style="background: url('<?php the_field('how_it_work_baner_background') ?>')">
  <div class="container">
    <h3 class="subpage_header"><?php the_field('how_it_work_baner_header') ?></h3>
    <div class="row">
      <div class="col-md-6">
        <?php the_field('how_it_work_baner_description_left') ?>
      </div>
      <div class="col-md-6">
        <?php the_field('how_it_work_baner_description_right') ?>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
