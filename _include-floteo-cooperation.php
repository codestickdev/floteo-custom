<section class="container-fluid cooperation">
	<div class="container cooperation__wrap">
    <h4 class="cooperation__numbers-head">Dlaczego my?</h4>
    <div class="cooperation__items">
      <div class="cooperation__item">
          <img class="cooperation__image" src="<?php echo get_template_directory_uri();?>/img/floteo_icon-szeroki-wybor.svg" />
          <div>
            <span class="cooperation__title"><?php the_field('box_1_title') ?></span>
            <span class="cooperation__desc">
              <?php the_field('box_1_content') ?>
            </span>
          </div>
      </div>
      <div class="cooperation__item">
          <img class="cooperation__image" src="<?php echo get_template_directory_uri();?>/img/floteo_icon-uslugi-dodatkowe.svg" />
          <div>
            <span class="cooperation__title"><?php the_field('box_2_title') ?></span>
            <span class="cooperation__desc">
              <?php the_field('box_2_content') ?>
            </span>
          </div>
      </div>
      <div class="cooperation__item">
          <img class="cooperation__image" src="<?php echo get_template_directory_uri();?>/img/floteo_icon-korzystna-cena.svg" />
          <div>
            <span class="cooperation__title"><?php the_field('box_3_title') ?></span>
            <span class="cooperation__desc">
              <?php the_field('box_3_content') ?>
            </span>
          </div>
      </div>
    </div>
    <div>
      <a href="#" class="bttn cooperation__button hidden-xs hidden-sm hidden-md">Sprawdź ofertę</a>
    </div>
    <div class="cooperation__bg" style="background-image: url('<?php the_field('home_bottom_baner_background') ?>')"></div>
  </div>
</section>