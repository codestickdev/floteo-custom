<div class="floteo__home-search">
  <div class="floteo__boxes-left">
  <?php 
  $args = array(
    'posts_per_page'	=> 2,
    'post_type'		=> 'wynajem',
    'orderby'     => 'rand',
    'meta_query'  => array(
      array(
        'key' => 'strona_glowna_show',
				'compare' => '=',
				'value' => '1'
      )
    )
  );
  $the_query = new WP_Query( $args );
  ?>
  <?php if( $the_query->have_posts() ): ?>
    <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
    <a class="floteo__box" href="<?php the_permalink(); ?>">
      <img class="floteo__box-img" src="<?php the_field('front_page_product_thumb') ?>"/>
      <div class="floteo__box-border"></div>
      <div class="floteo__box-content">
        <p class="floteo__content-title"><?php the_title(); ?></p>
        <div class="floteo__box-features">
          <?php the_field('domyslna_oferta') ?>
        </div>
        <div class="floteo__content-price">
          <p><?php the_field('domyslna_wycena_kwota') ?>PLN <span>/ msc</span></p>
        </div>
      </div>
    </a>
    <?php endwhile; ?>
  <?php endif; ?>
  <?php wp_reset_query(); ?>
  </div>
  <div class="floteo__boxes-right">
    <div class="floteo__box floteo__search-box">
      <form id="searchEngine" class="floteo__homeSearch" method="get"
        action="<?php echo home_url(); ?>/wynajem-dlugoterminowy">
        <div class="floteo__homeSearch-body">
          <div class="floteo__homeSearch-row--top">
            <div class="floteo__homeSearch-left">
              <input class="floteo__homeSearch-input" type="text" placeholder="Wpisz słowa kluczowe" name="filterQuery"
                value="<?php if(!empty($_GET['filterQuery'])){ echo $_GET['filterQuery']; }; ?>" />
            </div>
            <div class="floteo__homeSearch-right">
              <select class="floteo__homeSearch-multiselect" name="clientType" id="clientType">
                <option value="clientTypeBussiness" for="clientTypeBussiness">Klient biznesowy</option>
                <option value="clientTypeIndividual" for="clientTypeIndividual">Klient Indywidualny</option>
              </select>
            </div>
          </div>
          <div class="floteo__homeSearch-row--bottom">
            <div class="floteo__homeSearch-left">
              <div class="floteo__price">
                  <input class="floteo__price--input floteo__price--min" type="number" placeholder="Od" name="searchPriceMin"
                  value="<?php /* if(!empty($_GET['searchPriceMin'])){ echo $_GET['searchPriceMin']; } else { echo "0"; } */?> " min="0" max="5000"/>
                  <input class="floteo__price--input floteo__price--max" type="number" placeholder="Do" name="searchPriceMax" min="0" max="5000"
                    value="<?php /*  if(!empty($_GET['searchPriceMax'])){ echo $_GET['searchPriceMax']; } else { echo "5000"; } */?>" />
              </div>
            </div>
            <div class="floteo__homeSearch-right">
              <button type="submit" class="btn_homeSearch">Wyszukaj</button>
            </div>
          </div>
        </div>
      </form>
    </div>
    <div class="floteo__box floteo__marketing-box">
      <h2>Najlepsze oferty SUV na rynku.</h2>
      <img class="car" src="<?php bloginfo('template_directory') ?>/img/marketing-box-car-photo.png"/>
      <a href="#"><span>Sprawdź ofertę</span></a>
      <img class="floteo__marketing-logo" src="<?php bloginfo('template_directory') ?>/img/logo.svg"/>
    </div>
  </div>
</div>