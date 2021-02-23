<?php
/*
* Template Name: Configuration page
*/
get_header(); ?>

<section class="container contact_page">
	<h4 class="section_header with_line"><?php the_title(); ?></h4>

  <div class="row custom_row">
    <div class="col-md-4 col-sm-4">
      <img class="img-responsive center svg" src="<?php the_post_thumbnail_url() ?>">
    </div>
    <div class="col-md-6 col-sm-8">
      <?php the_content(); ?>
    </div>
  </div>

  <div class="row">
		<div class="col-md-7">
      <div class="wrapper contact_form">
        <p class="contact_header">Wyślij zapytanie</p>
        <?php echo do_shortcode('[contact-form-7 id="8" title="Kontakt"]'); ?>
      </div>
    </div>

    <div class="col-md-5">
      <div class="wrapper">
        <p class="contact_header">Zadzwoń do nas</p>
        <a href="tel:<?php the_field('contact_phone', 'options') ?>" class="contact_link tel"><?php the_field('contact_phone', 'options') ?></a>
      </div>

      <div class="wrapper">
        <p class="contact_header">Napisz do nas</p>
        <a href="mailto:<?php the_field('contact_email', 'options') ?>" class="contact_link mail"><?php the_field('contact_email', 'options') ?></a>
      </div>

      <div class="wrapper">
        <p class="contact_header">Odwiedź nas</p>
        <address>
          <?php the_field('contact_address', 'options') ?>
					<br><br>
					<?php the_field('contact_open_hours', 'options') ?>
        </address>
      </div>
    </div>
  </div>
</section>

<section class="container-fluid contact_baner" style="background: url('<?php the_field('configuration_bottom_baner_background') ?>')">
	<div class="container">
		<?php the_field('configuration_bottom_baner_description') ?>
		<a href="<?php echo home_url(); ?>/jak-to-dziala/" class="btn btn_custom">Zobacz więcej</a>
	</div>
</section>

<?php get_footer(); ?>
