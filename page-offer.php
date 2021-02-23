<?php
/*
* Template Name: Offers page
*/
get_header(); ?>

<section class="container bigger page_offer">
	<h4 class="section_header"><?php the_title(); ?></h4>
	<?php the_field('offers_naglowek_1'); ?>


	<?php $loop = new WP_Query( array( 'post_type'=>'wynajem', 'orderby'=>'post_id', 'order'=>'ASC', 'category_name'=>'segment-b, top-sales-b') ); $count = $loop->post_count; ?>
	<?php if ( $loop->have_posts() ) :  ?>
		<span class="segment_header">
			<span>segment B</span>
		</span>
		<div class="custom-slide car_tiles" data-number="<?php echo $count; ?>">
			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<div>
			    <div <?php post_class('tile'); ?> data-price-max="<?php the_field('cena_48msc_-_20%_-_20000') ?>" data-price-min="<?php the_field('cena_24msc_-_0%_-_40000') ?>" data-mark="<?php the_field('dane_techniczne_marka') ?>" data-body="<?php the_field('dane_techniczne_nadwozie') ?>" data-fuel="<?php echo get_field('dane_techniczne_paliwo')['value']; ?>" data-gearbox="<?php the_field('dane_techniczne_skrzynia_biegow') ?>">
			      <div class="tile_header">
							<?php if( in_category('od-reki') ) : ?><div class="cat hand"><span></span></div><?php endif; ?>
							<?php if( in_category('nowosc') ) : ?><div class="cat new"><span></span></div><?php endif; ?>
							<?php if( in_category('top') ) : ?><div class="cat top"><span></span></div><?php endif; ?>

							<?php if( has_post_thumbnail() ) : ?>
		            <div class="thumb" style="background: url('<?php echo get_field('vehicle_photos')[0]['url'] ?>')"></div>
		          <?php else: ?>
		            <div class="thumb empty"></div>
		          <?php endif; ?>
			      </div>
			      <div class="tile_body">
			        <h4 title="<?php the_title(); ?>"><strong><?php the_title(); ?></strong> <small class="center">za <strong><?php the_field('domyslna_wycena_kwota') ?> zł</strong> netto/mc</small></h4>
			        <div class="inner">
			          <div class="row">
			            <div class="col-xs-6"><p><strong>Rocznik:</strong> <?php the_field('dane_techniczne_rocznik') ?></p></div>
						<div class="col-xs-6"><p><strong>Paliwo:</strong> <?php echo get_field('dane_techniczne_paliwo')['label']; ?></p></div>
			            
			          </div>
			          <div class="row">			            
			            <div class="col-xs-6"><p><strong>Silnik:</strong> <?php the_field('dane_techniczne_silnik') ?></p></div>
						<div class="col-xs-6"><p><strong>Moc:</strong> <?php the_field('dane_techniczne_moc') ?> KM</p></div>
			          </div>
			        </div>
			      </div>
			      <div class="text-center">
			        <a href="<?php the_permalink(); ?>" class="btn btn_custom">Zobacz szczegóły</a>
			      </div>
			    </div>
			  </div>
			<?php endwhile; wp_reset_query(); ?>
		</div>
	<?php endif; ?>


	<?php $loop = new WP_Query( array( 'post_type'=>'wynajem', 'orderby'=>'post_id', 'order'=>'ASC', 'category_name'=>'segment-c, top-sales-c') ); $count = $loop->post_count; ?>
	<?php if ( $loop->have_posts() ) : ?>
		<span class="segment_header">
			<span>segment C</span>
		</span>
		<div class="custom-slide car_tiles" data-number="<?php echo $count; ?>">
			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<div>
			    <div <?php post_class('tile'); ?> data-price-max="<?php the_field('cena_48msc_-_20%_-_20000') ?>" data-price-min="<?php the_field('cena_24msc_-_0%_-_40000') ?>" data-mark="<?php the_field('dane_techniczne_marka') ?>" data-body="<?php the_field('dane_techniczne_nadwozie') ?>" data-fuel="<?php echo get_field('dane_techniczne_paliwo')['value']; ?>" data-gearbox="<?php the_field('dane_techniczne_skrzynia_biegow') ?>">
			      <div class="tile_header">
							<?php if( in_category('od-reki') ) : ?><div class="cat hand"><span></span></div><?php endif; ?>
							<?php if( in_category('nowosc') ) : ?><div class="cat new"><span></span></div><?php endif; ?>
							<?php if( in_category('top') ) : ?><div class="cat top"><span></span></div><?php endif; ?>

							<?php if( has_post_thumbnail() ) : ?>
		            <div class="thumb" style="background: url('<?php echo get_field('vehicle_photos')[0]['url'] ?>')"></div>
		          <?php else: ?>
		            <div class="thumb empty"></div>
		          <?php endif; ?>
			      </div>
			      <div class="tile_body">
			        <h4 title="<?php the_title(); ?>"><strong><?php the_title(); ?></strong> <small class="center">za <strong><?php the_field('domyslna_wycena_kwota') ?> zł</strong> netto/mc</small></h4>
			        <div class="inner">
			          <div class="row">
			            <div class="col-xs-6"><p><strong>Rocznik:</strong> <?php the_field('dane_techniczne_rocznik') ?></p></div>
						<div class="col-xs-6"><p><strong>Paliwo:</strong> <?php echo get_field('dane_techniczne_paliwo')['label']; ?></p></div>
			            
			          </div>
			          <div class="row">			            
			            <div class="col-xs-6"><p><strong>Silnik:</strong> <?php the_field('dane_techniczne_silnik') ?></p></div>
						<div class="col-xs-6"><p><strong>Moc:</strong> <?php the_field('dane_techniczne_moc') ?> KM</p></div>
			          </div>
			        </div>
			      </div>
			      <div class="text-center">
			        <a href="<?php the_permalink(); ?>" class="btn btn_custom">Zobacz szczegóły</a>
			      </div>
			    </div>
			  </div>
			<?php endwhile; wp_reset_query(); ?>
		</div>
	<?php endif; ?>


	<?php $loop = new WP_Query( array( 'post_type'=>'wynajem', 'orderby'=>'post_id', 'order'=>'ASC', 'category_name'=>'segment-d, top-sales-d') ); $count = $loop->post_count; ?>
	<?php if ( $loop->have_posts() ) : ?>
		<span class="segment_header">
			<span>segment D</span>
		</span>
		<div class="custom-slide car_tiles" data-number="<?php echo $count; ?>">
			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<div>
			    <div <?php post_class('tile'); ?> data-price-max="<?php the_field('cena_48msc_-_20%_-_20000') ?>" data-price-min="<?php the_field('cena_24msc_-_0%_-_40000') ?>" data-mark="<?php the_field('dane_techniczne_marka') ?>" data-body="<?php the_field('dane_techniczne_nadwozie') ?>" data-fuel="<?php echo get_field('dane_techniczne_paliwo')['value']; ?>" data-gearbox="<?php the_field('dane_techniczne_skrzynia_biegow') ?>">
			      <div class="tile_header">
							<?php if( in_category('od-reki') ) : ?><div class="cat hand"><span></span></div><?php endif; ?>
							<?php if( in_category('nowosc') ) : ?><div class="cat new"><span></span></div><?php endif; ?>
							<?php if( in_category('top') ) : ?><div class="cat top"><span></span></div><?php endif; ?>

							<?php if( has_post_thumbnail() ) : ?>
		            <div class="thumb" style="background: url('<?php echo get_field('vehicle_photos')[0]['url'] ?>')"></div>
		          <?php else: ?>
		            <div class="thumb empty"></div>
		          <?php endif; ?>
			      </div>
			      <div class="tile_body">
			        <h4 title="<?php the_title(); ?>"><strong><?php the_title(); ?></strong> <small class="center">za <strong><?php the_field('domyslna_wycena_kwota') ?> zł</strong> netto/mc</small></h4>
			        <div class="inner">
			          <div class="row">
			            <div class="col-xs-6"><p><strong>Rocznik:</strong> <?php the_field('dane_techniczne_rocznik') ?></p></div>
						<div class="col-xs-6"><p><strong>Paliwo:</strong> <?php echo get_field('dane_techniczne_paliwo')['label']; ?></p></div>
			            
			          </div>
			          <div class="row">			            
			            <div class="col-xs-6"><p><strong>Silnik:</strong> <?php the_field('dane_techniczne_silnik') ?></p></div>
						<div class="col-xs-6"><p><strong>Moc:</strong> <?php the_field('dane_techniczne_moc') ?> KM</p></div>
			          </div>
			        </div>
			      </div>
			      <div class="text-center">
			        <a href="<?php the_permalink(); ?>" class="btn btn_custom">Zobacz szczegóły</a>
			      </div>
			    </div>
			  </div>
			<?php endwhile; wp_reset_query(); ?>
		</div>
	<?php endif; ?>


	<?php $loop = new WP_Query( array( 'post_type'=>'wynajem', 'orderby'=>'post_id', 'order'=>'ASC', 'category_name'=>'segment-e, top-sales-e') ); $count = $loop->post_count; ?>
	<?php if ( $loop->have_posts() ) : ?>
		<span class="segment_header">
			<span>segment E</span>
		</span>
		<div class="custom-slide car_tiles" data-number="<?php echo $count; ?>">
			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<div>
			    <div <?php post_class('tile'); ?> data-price-max="<?php the_field('cena_48msc_-_20%_-_20000') ?>" data-price-min="<?php the_field('cena_24msc_-_0%_-_40000') ?>" data-mark="<?php the_field('dane_techniczne_marka') ?>" data-body="<?php the_field('dane_techniczne_nadwozie') ?>" data-fuel="<?php echo get_field('dane_techniczne_paliwo')['value']; ?>" data-gearbox="<?php the_field('dane_techniczne_skrzynia_biegow') ?>">
			      <div class="tile_header">
							<?php if( in_category('od-reki') ) : ?><div class="cat hand"><span></span></div><?php endif; ?>
							<?php if( in_category('nowosc') ) : ?><div class="cat new"><span></span></div><?php endif; ?>
							<?php if( in_category('top') ) : ?><div class="cat top"><span></span></div><?php endif; ?>

							<?php if( has_post_thumbnail() ) : ?>
		            <div class="thumb" style="background: url('<?php echo get_field('vehicle_photos')[0]['url'] ?>')"></div>
		          <?php else: ?>
		            <div class="thumb empty"></div>
		          <?php endif; ?>
			      </div>
			      <div class="tile_body">
			        <h4 title="<?php the_title(); ?>"><strong><?php the_title(); ?></strong> <small class="center">za <strong><?php the_field('domyslna_wycena_kwota') ?> zł</strong> netto/mc</small></h4>
			        <div class="inner">
			          <div class="row">
			            <div class="col-xs-6"><p><strong>Rocznik:</strong> <?php the_field('dane_techniczne_rocznik') ?></p></div>
						<div class="col-xs-6"><p><strong>Paliwo:</strong> <?php echo get_field('dane_techniczne_paliwo')['label']; ?></p></div>
			            
			          </div>
			          <div class="row">			            
			            <div class="col-xs-6"><p><strong>Silnik:</strong> <?php the_field('dane_techniczne_silnik') ?></p></div>
						<div class="col-xs-6"><p><strong>Moc:</strong> <?php the_field('dane_techniczne_moc') ?> KM</p></div>
			          </div>
			        </div>
			      </div>
			      <div class="text-center">
			        <a href="<?php the_permalink(); ?>" class="btn btn_custom">Zobacz szczegóły</a>
			      </div>
			    </div>
			  </div>
			<?php endwhile; wp_reset_query(); ?>
		</div>
	<?php endif; ?>


	<?php $loop = new WP_Query( array( 'post_type'=>'wynajem', 'orderby'=>'post_id', 'order'=>'ASC', 'category_name'=>'segment-premium, top-sales-premium') ); $count = $loop->post_count; ?>
	<?php if ( $loop->have_posts() ) : ?>
		<span class="segment_header">
			<span>Premium</span>
		</span>
		<div class="custom-slide car_tiles" data-number="<?php echo $count; ?>">
			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<div>
			    <div <?php post_class('tile'); ?> data-price-max="<?php the_field('cena_48msc_-_20%_-_20000') ?>" data-price-min="<?php the_field('cena_24msc_-_0%_-_40000') ?>" data-mark="<?php the_field('dane_techniczne_marka') ?>" data-body="<?php the_field('dane_techniczne_nadwozie') ?>" data-fuel="<?php echo get_field('dane_techniczne_paliwo')['value']; ?>" data-gearbox="<?php the_field('dane_techniczne_skrzynia_biegow') ?>">
			      <div class="tile_header">
							<?php if( in_category('od-reki') ) : ?><div class="cat hand"><span></span></div><?php endif; ?>
							<?php if( in_category('nowosc') ) : ?><div class="cat new"><span></span></div><?php endif; ?>
							<?php if( in_category('top') ) : ?><div class="cat top"><span></span></div><?php endif; ?>

							<?php if( has_post_thumbnail() ) : ?>
		            <div class="thumb" style="background: url('<?php echo get_field('vehicle_photos')[0]['url'] ?>')"></div>
		          <?php else: ?>
		            <div class="thumb empty"></div>
		          <?php endif; ?>
			      </div>
			      <div class="tile_body">
			        <h4 title="<?php the_title(); ?>"><strong><?php the_title(); ?></strong> <small class="center">za <strong><?php the_field('domyslna_wycena_kwota') ?> zł</strong> netto/mc</small></h4>
			        <div class="inner">
			          <div class="row">
			            <div class="col-xs-6"><p><strong>Rocznik:</strong> <?php the_field('dane_techniczne_rocznik') ?></p></div>
						<div class="col-xs-6"><p><strong>Paliwo:</strong> <?php echo get_field('dane_techniczne_paliwo')['label']; ?></p></div>
			            
			          </div>
			          <div class="row">			            
			            <div class="col-xs-6"><p><strong>Silnik:</strong> <?php the_field('dane_techniczne_silnik') ?></p></div>
						<div class="col-xs-6"><p><strong>Moc:</strong> <?php the_field('dane_techniczne_moc') ?> KM</p></div>
			          </div>
			        </div>
			      </div>
			      <div class="text-center">
			        <a href="<?php the_permalink(); ?>" class="btn btn_custom">Zobacz szczegóły</a>
			      </div>
			    </div>
			  </div>
			<?php endwhile; wp_reset_query(); ?>
		</div>
	<?php endif; ?>


	<?php $loop = new WP_Query( array( 'post_type'=>'wynajem', 'orderby'=>'post_id', 'order'=>'ASC', 'category_name'=>'segment-suv, top-sales-suv') ); $count = $loop->post_count; ?>
	<?php if ( $loop->have_posts() ) : ?>
		<span class="segment_header">
			<span>SUV</span>
		</span>
		<div class="custom-slide car_tiles" data-number="<?php echo $count; ?>">
			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<div>
			    <div <?php post_class('tile'); ?> data-price-max="<?php the_field('cena_48msc_-_20%_-_20000') ?>" data-price-min="<?php the_field('cena_24msc_-_0%_-_40000') ?>" data-mark="<?php the_field('dane_techniczne_marka') ?>" data-body="<?php the_field('dane_techniczne_nadwozie') ?>" data-fuel="<?php echo get_field('dane_techniczne_paliwo')['value']; ?>" data-gearbox="<?php the_field('dane_techniczne_skrzynia_biegow') ?>">
			      <div class="tile_header">
							<?php if( in_category('od-reki') ) : ?><div class="cat hand"><span></span></div><?php endif; ?>
							<?php if( in_category('nowosc') ) : ?><div class="cat new"><span></span></div><?php endif; ?>
							<?php if( in_category('top') ) : ?><div class="cat top"><span></span></div><?php endif; ?>

							<?php if( has_post_thumbnail() ) : ?>
		            <div class="thumb" style="background: url('<?php echo get_field('vehicle_photos')[0]['url'] ?>')"></div>
		          <?php else: ?>
		            <div class="thumb empty"></div>
		          <?php endif; ?>
			      </div>
			      <div class="tile_body">
			        <h4 title="<?php the_title(); ?>"><strong><?php the_title(); ?></strong> <small class="center">za <strong><?php the_field('domyslna_wycena_kwota') ?> zł</strong> netto/mc</small></h4>
			        <div class="inner">
			          <div class="row">
			            <div class="col-xs-6"><p><strong>Rocznik:</strong> <?php the_field('dane_techniczne_rocznik') ?></p></div>
						<div class="col-xs-6"><p><strong>Paliwo:</strong> <?php echo get_field('dane_techniczne_paliwo')['label']; ?></p></div>
			            
			          </div>
			          <div class="row">			            
			            <div class="col-xs-6"><p><strong>Silnik:</strong> <?php the_field('dane_techniczne_silnik') ?></p></div>
						<div class="col-xs-6"><p><strong>Moc:</strong> <?php the_field('dane_techniczne_moc') ?> KM</p></div>
			          </div>
			        </div>
			      </div>
			      <div class="text-center">
			        <a href="<?php the_permalink(); ?>" class="btn btn_custom">Zobacz szczegóły</a>
			      </div>
			    </div>
			  </div>
			<?php endwhile; wp_reset_query(); ?>
		</div>
	<?php endif; ?>

	<?php the_field('offers_naglowek_2'); ?>

</section><hr>

<?php get_footer();
