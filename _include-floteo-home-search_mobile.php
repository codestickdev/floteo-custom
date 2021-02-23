<div class="homeheaderMobile">
    <div class="homeheaderMobile__slider">
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
        <div class="slide" style="background-image: url(/wp-content/themes/floteo-custom/img/home-heading-car-thumb.png);">
            <div class="slide__inner">
                <div class="slide__content">
                    <p class="slide__content-title"><?php the_title(); ?></p>
                    <div class="slide__content-features">
                        <?php the_field('domyslna_oferta') ?>
                    </div>
                    <div class="slide__content-price">
                        <p><?php the_field('domyslna_wycena_kwota') ?>PLN <span>/ msc</span></p>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    <?php endif; ?>
    <?php wp_reset_query(); ?>
        <div class="slide marketing-box"  style="background-image: url(/wp-content/themes/floteo-custom/img/marketing-box-bg.svg);">
            <div class="slide__inner">
                <h2>Najlepsze oferty SUV na rynku.</h2>
                <img class="car" src="<?php bloginfo('template_directory') ?>/img/marketing-box-car-photo.png"/>
                <a href="#"><span>Sprawdź ofertę</span></a>
                <img class="floteo__marketing-logo" src="<?php bloginfo('template_directory') ?>/img/logo.svg"/>
            </div>
        </div>
    </div>
    <div class="homeheaderMobile__searchbar">
        <form id="searchEngine" class="searchbarMobile" method="get" action="<?php echo home_url(); ?>/wynajem-dlugoterminowy">
            <input class="searchbarMobile-input" type="text" placeholder="Wpisz słowa kluczowe" name="filterQuery" value="<?php if(!empty($_GET['filterQuery'])){ echo $_GET['filterQuery']; }; ?>" />
            <div class="searchbarMobile-right">
                <button type="submit" class="btn_searchbarMobile">Znajdź</button>
                <div class="custom-search open-find-car"></div>
            </div>
        </form>
    </div>
</div>