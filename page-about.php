<?php
/*
* Template Name: About page
*/
get_header(); ?>

<section class="container about_page">
	<h4 class="section_header with_line"><?php the_title(); ?></h4>
  <div class="row custom_row">
    <div class="col-sm-3 col-sm-offset-1">
      <img class="img-responsive center svg" src="<?php the_field('about_mission_ico') ?>">
    </div>
    <div class="col-sm-7 col-sm-offset-1">
      <?php the_field('about_mission_description') ?>
    </div>
  </div>

  <div class="row custom_row">
    <div class="col-sm-3 col-sm-push-8">
      <img class="img-responsive center svg" src="<?php the_field('about_why_us_ico') ?>">
    </div>
    <div class="col-sm-7 col-sm-pull-3">
      <?php the_field('about_why_us_description') ?>
    </div>
  </div>
</section>

<section class="container-fluid about_baner" style="background: url('<?php the_field('about_baner_background') ?>')">
  <div class="container">
    <?php the_field('about_baner_description') ?>
    <ul class="list-unstyled list-inline">
			<?php  $images = get_field('about_baner_logos');
			if( $images ): ?>
        <?php foreach( $images as $image ): ?>
					<li><img class="img-responsive center" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"></li>
        <?php endforeach; ?>
			<?php endif; ?>
    </ul>
		<ul class="list-unstyled list-inline lease_logos">
			<?php  $images = get_field('about_baner_logos_lease');
			if( $images ): ?>
        <?php foreach( $images as $image ): ?>
					<li><img class="img-responsive center" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"></li>
        <?php endforeach; ?>
			<?php endif; ?>
    </ul>
    <div class="btn_wrapper">
      <a href="<?php echo home_url(); ?>/wynajem-dlugoterminowy" class="btn btn_custom">Znajdź samochód</a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
