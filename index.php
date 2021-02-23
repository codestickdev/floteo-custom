<?php
/*
* Template Name: Home page
*/

session_start();
$_SESSION['searchMark'] = $searchMark;
$_SESSION['searchBody'] = $searchBody;
$_SESSION['searchFuel'] = $searchFuel;
$_SESSION['searchGearboxManual'] = $searchGearboxManual;
$_SESSION['searchGearboxAutomat'] = $searchGearboxAutomat;
$_SESSION['searchPriceMin'] = $searchPriceMin;
$_SESSION['searchPriceMax'] = $searchPriceMax;

get_header(); ?>

<div class="floteo__homeHeader--mobile">
	<?php include('_include-floteo-home-search_mobile.php'); ?>
</div>
<div class="floteo__homeHeader--desktop">
	<?php include('_include-floteo-home-search.php'); ?>
</div>

<section class="car__tiles-container">
	<?php 
		$count_cars	=	6;
		$loop = new WP_Query( array( 'post_type'=>'wynajem', 'orderby'=>'post_id', 'order'=>'ASC', 'orderby'=>'rand', 'posts_per_page'=> $count_cars, 'category_name'=>'bestsellery','meta_query' => array(
			array(
				'key' => 'niedostepny',
				'compare' => '=',
				'value' => '0'
			)
		))); $count = $loop->post_count; ?>
		<div class="car__tiles" data-number="<?php echo $count; ?>">
			<?php $count = 0; ?>
			<?php while ( $loop->have_posts() ) : $loop->the_post();
				$count++;
				?>
					<a href="<?php the_permalink(); ?>" <?php post_class('tile move-title'); ?> data-price-max="<?php the_field('cena_48msc_-_20%_-_20000') ?>" data-price-min="<?php the_field('cena_24msc_-_0%_-_40000') ?>" data-mark="<?php the_field('dane_techniczne_marka') ?>" data-body="<?php the_field('dane_techniczne_nadwozie') ?>" data-fuel="<?php echo get_field('dane_techniczne_paliwo')['value']; ?>" data-gearbox="<?php the_field('dane_techniczne_skrzynia_biegow') ?>">
						<div class="tile__flags">
							<?php if( in_category('od-reki') ) : ?>
								<div class="tile__flagHand">Od ręki</div>
							<?php elseif( in_category('bestsellery') ) : ?>
								<div class="tile__flagBestseller">Bestseller</div>
							<?php endif; ?>
						</div>
						<div class="tile__data">
            				<div class="tile__name-wrap">
								<h4 class="tile__name" title="<?php the_title(); ?>"><?php the_title(); ?></h4>
								<h4 class="tile__power"><?php the_field('dane_techniczne_moc') ?>KM <?php echo get_field('dane_techniczne_paliwo')['label']; ?></h4>
							</div>
							<div class="tile__features">
								<?php the_field('domyslna_oferta') ?>
							</div>
							<div class="tile__price">
								<p><?php the_field('domyslna_wycena_kwota') ?>PLN <span>/ msc</span></p>
							</div>
			        		<div class="tile__btn">Sprawdź szczegóły</div>
						</div>
						<div class="tile__thumb">
							<div class="tile__image">
									<?php if( has_post_thumbnail() ) : ?>
										<div class="tile__thumb-item" style="background-image: url('<?php the_post_thumbnail_url("medium"); ?>')"></div>
									<?php else:  ?>
										<div class="tile__thumb-item empty"></div>
									<?php endif; ?>
							</div>
							<!-- <div class="tile__cats">
								<?php if( in_category('od-reki') ) : ?><div class="tile__cat --hand">OD<br>RĘKI!</div><?php endif; ?>
								<?php if( in_category('nowosc') ) : ?><div class="tile__cat --new">NEW!</div><?php endif; ?>
								<?php if( in_category('bestsellery') ) : ?><div class="tile__cat --new">Bestseller</div><?php endif; ?>
								<?php if( in_category('top') ) : ?><div class="tile__cat --top">TOP!</div><?php endif; ?>
							</div> -->
						</div>
			    </a>
			<?php endwhile; wp_reset_query(); ?>			
		</div>
		<!-- <div class="car__tiles-more">
			<a href="<?php the_permalink(35); ?>" class="bttn --simple car__tiles-more-button">Zobacz całą ofertę 
				<svg viewBox="0 0 84.1 72.8">
					<polyline fill="none" stroke-width="9" stroke-miterlimit="10" stroke="currentColor" points="44.5,3.2 77.7,36.4 44.5,69.7 "/>
					<line fill="none" stroke-width="9" stroke-miterlimit="10" stroke="currentColor" x1="0" y1="36.4" x2="77.7" y2="36.4"/>
				</svg>
			</a>
			<div class="car__tiles-more-contact">
				<div class="car__tiles-more-contact-wrap">
					<img class="car__tiles-more-contact-image" src="<?php bloginfo('template_directory') ?>/img/logo_icon.svg" alt="">
					<p class="car__tiles-more-contact-text">Nasz doradca wybierze dla Ciebie najlepszą ofertę.</p>
				</div>
				<a href="<?php the_permalink(19); ?>" class="bttn car__tiles-more-contact-button">Skontaktuj się!</a>
			</div>
		</div> -->
		<br>
</section>
<?php include('_include-floteo-marks.php'); ?>

<?php include('_include-floteo-cooperation.php'); ?>
<?php include('_include-floteo-benefits.php'); ?>

<?php get_footer();
