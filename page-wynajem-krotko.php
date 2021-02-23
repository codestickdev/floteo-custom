<?php
/*
* Template Name: Wynajem krótkoterminowy
*/

session_start();

get_header(); ?>

<?php
	$loop = new WP_Query( 
		array( 
			'post_type'=>'wynajem-krotko', 
			'orderby'=>'post_id', 
			'order'=>'ASC',
			'meta_query' => array(
				array(
					'key' => 'dostepny',
					'compare' => '=',
					'value' => '1'
				)
			)
		)
	);
?>

<section class="container sort_settings">
	<div class="row">
		<div class="col-xs-12">
			<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>
			<h1 class="sort__settings-title">Wynajem krótkoterminowy samochodów</h1>
		</div>
	</div>
	<div class="row --special">
		<div class="col-lg-8 col-xs-6"><strong style="text-transform:uppercase;">Wyniki</strong> (<span id="searchResultsCount"><?php echo $loop->found_posts; ?></span>)</div>
			<div class="col-lg-4 col-xs-6 text-right">
				<div class="sort__button">
					<div class="sort__text">Sortuj po:</div>
					<select class="sort__select" id="sort_change">
						<option value="popular">popularność</option>
						<option value="price_asc" selected>cena rosnąco</option>
						<option value="price_desc">cena malejąco</option>
						<option value="name_asc">nazwa rosnąco</option>
						<option value="name_desc">nazwa malejąco</option>
					</select>
				</div>
		</div>
	</div>
</section>

<section class="container car_tiles" id="archiveContent">
	<div id="listingList">
		<?php
		$last_best = 1;

		while ( $loop->have_posts() ) : $loop->the_post(); ?>

			<?php
				global $post;

				$best = in_category(6,$post);
				
				if(empty($best)){
					$best = 99999;
				}else{
					$best = $last_best;
					$last_best = $last_best+1;
				}
			?>
		
			<div class="tile --archive --krotkoterminowy move-title" data-carname="<?php the_title(); ?>" data-price="<?php the_field('cena_za_dobe') ?>" data-best="<?php echo $best;?>">
				<div class="tile-archive__thumb">
					<?php if( has_post_thumbnail() ) : ?>
		      	<div class="thumb" style="background-image: url('<?php the_post_thumbnail_url("medium"); ?>')"></div>
		      <?php else: ?>
		      	<div class="thumb empty"></div>
		      <?php endif; ?>
					<div class="tile-archive__cats">
						<div class="tile__cat --h24">Dostępny</div>
					</div>
				</div>
				<div class="tile-archive__body">
					<div class="tile__price --krotko">
						<div class="tile__price-wrap">
							<div class="tile__price-value"><?php the_field('cena_za_dobe') ?></div>
							<div class="tile__price-currency">PLN/doba</div>
						</div>
						<div class="tile__price-wrap --small">
							<div class="tile__price-value --small"><?php the_field('cena_za_miesiac') ?></div>
							<div class="tile__price-currency --small">PLN netto/msc</div>
						</div>
					</div>
					<div class="tile-archive__data">
							<div class="tile__class">
								<?php the_field('klasa_samochodu'); ?>
							</div>
            	<div class="tile__name-wrap">
								<h4 class="tile__name" title="<?php the_title(); ?>"><?php the_title(); ?></h4>
							</div>
					</div>
					<div class="tile-archive__body-cats">
						<div class="tile__cat --h24">Dostępny</div>
					</div>
			    <div class="bttn --secondary tile__btn" data-title="<?php the_title(); ?>" data-price-doba="<?php the_field('cena_za_dobe') ?>" data-price-msc="<?php the_field('cena_za_miesiac') ?>" data-class="<?php the_field('klasa_samochodu') ?>">Zarezerwuj</div>
				</div>
			</div>
		<?php endwhile; wp_reset_query(); ?>
		
	</div>

</section>

<div class="modal fade" id="bookCar">
  <div class="car-modal">
    <div class="car-modal__close" data-dismiss="modal">
      <svg class="car-modal__close-svg" viewBox="2115.656 4371.656 11.054 11.054">
        <g><path stroke="currentColor" d="M2126.003 4372.363l-9.64 9.64"></path><path stroke="currentColor" d="M2116.363 4372.363l9.64 9.64"></path></g>
      </svg>
    </div>
              <div class="car-modal__head">
                <b>Rezerwacja samochodu w wynajmie krótkoterminowym</b>
                <p>Pozwól naszym doradcom skontaktować się z Tobą i przedstawić sposób działania wynajmu.</p>
                <br>
                <br>
              </div>
              <div class="car-modal__body">
                <?php echo do_shortcode('[contact-form-7 id="3218" title="Zarezerwuj samochód"]') ?>
              </div>
              <img class="car-modal__logo" src="https://floteocars.pl/wp-content/themes/floteo-custom/img/logo.svg" alt="">
  </div>
</div>

<?php get_footer();
