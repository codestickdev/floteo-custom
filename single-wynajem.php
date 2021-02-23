<?php
/*
* The template for displaying all single wynajem
*/

$category = get_the_category();
$categories = ['segment-b','segment-c','segment-d','segment-e','segment-premium','segment-suv'];
foreach($category as $catItem){
	if(in_array($catItem->slug, $categories)){
		$category_slug = $catItem->slug;
	}
}
$currentID = get_the_ID();

get_header(); ?>

<section class="container single_top">
  <div class="inner">
		<a class="back" onclick="history.back();"></a>
		<div>
			<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div id="breadcrumbs">','</div>'); } ?>
			<h4>szczegóły</h4>
		</div>
  </div>
</section>

<?php
	global $post;
	$photos = get_field('vehicle_photos');
	$i = 0;
?>

<section class="container single_content">
  <div class="inner">
    <div class="top_info">
      <div class="row">
			<?php 
			$classCats = "col-xs-0";
			$classTitle = "col-xs-12";
			$padding = "padding-bottom:10px;";
			if(
				in_category('od-reki') ||
				in_category('nowosc') ||
				in_category('top')
			) {
				$classTitle = "col-xs-12 col-sm-6 col-lg-8";
				$classCats = "col-xs-12 col-sm-6 col-lg-4";
				$padding = "padding-bottom:0;";
			} ?>
        <div class="<?php echo $classTitle; ?>" style="<?php echo $padding; ?>">
					<h1 class="single_content-head"><?php the_title(); ?> - wynajem długoterminowy</h1>
					<div class="single__content-colors">
						<?php if(get_field('dane_techniczne_kolor')) { ?>
							<div class="car__color">
								<div class="car__color-item" style="background: <?php the_field('dane_techniczne_kolor') ?>;"></div>
								<div class="car__color-text"><?php the_field('dane_techniczne_kolor_tekst') ?></div>
							</div>
						<?php } ?>
						<?php for($i = 1; $i < 5; $i++){ ?>
							<?php if(get_field('dane_techniczne_'.$i.'_kolor')) { ?>
								<div class="car__color">
									<div class="car__color-item" style="background: <?php the_field('dane_techniczne_'.$i.'_kolor') ?>;"></div>
									<div class="car__color-text"><?php the_field('dane_techniczne_'.$i.'_kolor_tekst') ?></div>
								</div>
							<?php } ?>
						<?php } ?>
					</div>
        </div>
        <div class="<?php echo $classCats; ?> single_content-cats">
						<?php
							$offer = get_field('oferta_dla_klienta');
							if(empty($offer)){
								$offer = ['firmowy'];
							}
							$isBussiness = in_array('firmowy',$offer);
							$isIndividual = in_array('prywatny',$offer);
						?>
						<?php if( $isIndividual ) : ?><div class="individual__client">Dla&nbsp;klienta<br>indywidualnego</div><?php endif; ?>
						<?php if( in_category('od-reki') ) : ?><div class="tile__cat --hand">OD<br>RĘKI!</div><?php endif; ?>
						<?php if( in_category('nowosc') ) : ?><div class="tile__cat --new">NEW!</div><?php endif; ?>
						<?php if( in_category('top') ) : ?><div class="tile__cat --top">TOP!</div><?php endif; ?>
        </div>
      </div>
    </div>
    <div class="middle_info">
      <div class="row">
        <div class="col-md-6 swipe">
					<?php if( has_post_thumbnail() ) { ?>
						<a href="<?php the_post_thumbnail_url() ?>" data-lightbox="roadtrip" data-title="">
							<div class="thumb main_thumb" style="background-image: url('<?php the_post_thumbnail_url();?>')"></div>
						</a>
					<?php } else if(get_headers(get_field('vehicle_photos')[0]['url'])[0] == 'HTTP/1.1 200 OK') { ?>
						<a href="<?php echo get_field('vehicle_photos')[0]['url'] ?>" data-lightbox="roadtrip"
							data-title="<?php echo get_field('vehicle_photos')[0]['title'] ?>">
							<div class="thumb main_thumb"
								style="background-image: url('<?php echo get_field('vehicle_photos')[0]['url'] ?>')"></div>
						</a>
					<?php } ?>

					<div class="thumbs-wrap">
						<?php if( has_post_thumbnail() ) { 
							$i = 1; ?>
								<div class="thumbMulti" style="background-image: url('<?php the_post_thumbnail_url() ?>')"></div>
						<?php }
							if(!empty($photos)){
								foreach($photos as $photo) {
									?>				
											<a href="<?php echo $photo['url']; ?>" class="thumbMulti" style="background-image: url('<?php echo $photo['url']; ?>')" data-lightbox="roadtrip" data-title="<?php echo $photo['title']; ?>"></a>
									<?php
									$i++;
								}
							}
						?>
					</div>
				</div>

		  <?php

		  function check_time($post,$time){
			  $opts = array('0%_-_20000','5%_-_20000','15%_-_20000','20%_-_20000','0%_-_30000','5%_-_30000','10%_-_30000','5%_-_30000','20%_-_30000','20%_-_30000','0%_-_40000','5%_-_40000','10%_-_40000','15%_-_40000','20%_-_40000');

			  if(!empty($opts)){
				  foreach($opts as $opt){
						$field = 'cena_'.$time.'msc_-_'.$opt;
					  $price = get_field($field,$post->id);

					  if(!empty($price)){
						  return true;
					  }
				  }
			  }

			  return false;
		  }

		  global $post;
		  $prices = get_field('cena',$post->id);
		  $selected = null;
		  $slider_values = array();
			if(!empty($prices)){
				foreach($prices as $price_row) {
					$time = $price_row['okres'];
					$slider_values[]=$time;

					if(!empty($price_row['domyslny'])){
						$selected = $time;
					}
				}
			}

		  $slider_values = array_unique($slider_values);
		  sort($slider_values);

		  if(!empty($selected)){
			  $selected = array_search($selected, $slider_values);
			}
			
		  $min = min($slider_values);
		  $max = max($slider_values);

		  if(!isset($selected)){
        $selected = reset($slider_values);
			}
			
		  ?>

        <div class="col-md-6">
					<div class="toggles__wrap">
						<div class="toggle__input-wrap">
							<div class="toggle__input-head">
								okres <span>m-ce</span>
							</div>
							<div class="toggle__input">
								<?php foreach($prices as $price) { ?>
									<input type="radio" name="okres" id="okres<?php echo $price["okres"] ?>" value="<?php echo $price["okres"] ?>" <?php echo $price["domyslny"] == true ? "checked" : ""  ?>/>
									<label for="okres<?php echo $price["okres"] ?>"><?php echo $price["okres"] ?></label>
								<?php } ?>
							</div>
						</div>

						<div class="toggle__input-wrap">
							<div class="toggle__input-head">
								wkład własny
							</div>
							<div class="price-slider">
								<div class="toggle__slider" id="priceSlider" data-min="<?php echo get_field('domyslna_wycena_wplata_min') ?>" 
									data-max="<?php echo get_field('domyslna_wycena_wplata_max') ?>" data-step="1000"></div>
								<div class="price-slider__value"></div>
							</div>
						</div>
						<div class="toggle__input-wrap" style="min-width:280px;">
							<div class="toggle__input-head">
								limit roczny <span>km/rok</span>
							</div>
							<?php if(!empty(get_field('nolimit')) && get_field('nolimit') == true) { ?>
								<div class="toggle__input --wrap">
									<input type="radio" name="limit" id="nolimit" value="nolimit" checked />
									<label for="nolimit" style="margin:3px;width:90px;">Bez limitu</label>
								</div>
							<?php } else { ?>
								<div class="toggle__input --wrap">
									<input type="radio" name="limit" id="limit10000" value="10000" <?php echo get_field('domyslna_wycena_przebieg') == "10000" ? "checked" : "" ?>/>
									<label for="limit10000">10 000</label>
									<input type="radio" name="limit" id="limit20000" value="20000" <?php echo get_field('domyslna_wycena_przebieg') == "20000" ? "checked" : "" ?>/>
									<label for="limit20000">20 000</label>
									<input type="radio" name="limit" id="limit30000" value="30000" <?php echo get_field('domyslna_wycena_przebieg') == "30000" ? "checked" : "" ?>/>
									<label for="limit30000">30 000</label>
									<input type="radio" name="limit" id="limit40000" value="40000" <?php echo get_field('domyslna_wycena_przebieg') == "40000" ? "checked" : "" ?>/>
									<label for="limit40000">40 000</label>
								</div>
								<div class="toggle__input-text"><?php the_field('nadprzebieg'); ?></div>
							<?php } ?>
						</div>

						<div class="toggle__input-wrap --width100">
							<div class="toggle__input-head">
								wybierz opcje dodatkowe
							</div>
							<div class="custom_checkbox_wrapper">
								<div class="toggle__checkbox">
									<input type="checkbox" id="checkOne" class="check" <?php if( !get_field('serwis_w_cenie') ): ?>checked<?php endif; ?>/>
									<label for="checkOne" class="checkToggle checkOneWrapper">
										<svg viewBox="0 0 110.7 110.7">
											<g>
												<path fill="currentColor" d="M71.9,8c2.9,0,5.8,0.4,8.6,1.2l-15,15c-0.6,0.6-0.9,1.4-0.9,2.2l1.3,15.3c0,0.8,0.3,1.6,0.9,2.2
													c0.6,0.6,1.4,0.9,2.2,0.9l15.3,1.3c0.8,0,1.6-0.3,2.2-0.9l15-15c3,10.4,0.4,22.1-7.8,30.3c-5.7,5.7-12.6,8.3-19.8,8.3
													c-4,0-8.1-0.8-12.1-2.4L37,96.4c-0.5,0.6-1.1,1.1-1.7,1.7c-3.1,3.1-7.2,4.7-11.3,4.7s-8.2-1.6-11.3-4.7c-6.3-6.3-6.3-16.4,0-22.7
													c0.6-0.6,1-1.2,1.7-1.7l30.1-24.6C40.1,38,41.2,26,50.1,17C56.1,11,64,8,71.9,8 M71.9,0L71.9,0C61.5,0,51.8,4,44.5,11.4
													c-9.2,9.2-12.5,21.9-9.3,35L9.4,67.4c-0.9,0.7-1.6,1.5-2.1,2c-0.1,0.1-0.2,0.2-0.3,0.3c-9.4,9.4-9.4,24.6,0,34c4.5,4.5,10.6,7,17,7
													s12.5-2.5,17-7c0.1-0.1,0.2-0.2,0.3-0.3c0.5-0.5,1.2-1.1,2-2l21.2-25.6c3.1,0.8,6.3,1.2,9.4,1.2c9.7,0,18.5-3.7,25.4-10.7
													c10-10,13.7-24.6,9.8-38.2c-0.8-2.7-2.9-4.8-5.7-5.5c-0.7-0.2-1.3-0.3-2-0.3c-2.1,0-4.1,0.8-5.7,2.3L82.5,37.9l-9-0.7l-0.7-9
													l13.4-13.4c2-2,2.8-4.9,2.1-7.7c-0.7-2.7-2.8-4.9-5.5-5.7C79.2,0.5,75.5,0,71.9,0L71.9,0z"/>
											</g>
											<circle fill="currentColor" cx="23.1" cy="86.8" r="4.7"/>
										</svg>
										<span>serwis w cenie</span>
									</label>
									<?php if(get_field('serwis_w_cenie_info') != "") { ?>
										<div class="toggle__checkbox-info" data-tooltip="<?php the_field('serwis_w_cenie_info') ?>"></div>
									<?php } ?>
								</div>
								<div class="toggle__checkbox">
									<input type="checkbox" id="checkOne2" class="<?php if( !get_field('pakiet_opon_w_cenie') ): ?>--enabled<?php endif; ?>" data-price="<?php the_field('dodatkowy_pakiet_opon') ?>" <?php if( get_field('pakiet_opon_w_cenie') ): ?>checked<?php endif; ?> class="check"/>
									<label for="checkOne2" class="checkToggle <?php if( !get_field('dodatkowy_pakiet_opon') || get_field('pakiet_opon_w_cenie') ) : ?> checkOneWrapper<?php endif; ?>">
										<svg viewBox="0 0 91.1 98.6">
											<ellipse fill="none" stroke="currentColor" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" cx="64" cy="49.3" rx="23.2" ry="45.3"/>
											<ellipse fill="none" stroke="currentColor" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" cx="64.4" cy="49.3" rx="6.7" ry="20.1"/>
											<path fill="none" stroke="currentColor" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M64,4H31.5C31.5,4,5.1,7.2,4,50.5"/>
											<path fill="none" stroke="currentColor" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M64,94.5H31.5c0,0-26.4-3.2-27.5-46.5"/>
											<line fill="none" stroke="currentColor" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="15" y1="14.4" x2="26.7" y2="23.3"/>
											<line fill="none" stroke="currentColor" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="41.8" y1="32.4" x2="25.8" y2="40.1"/>
											<line fill="none" stroke="currentColor" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="4.5" y1="53.2" x2="20.9" y2="59.2"/>
											<line fill="none" stroke="currentColor" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="42.4" y1="67.9" x2="27.9" y2="74.5"/>
										</svg>
										<span>pakiet opon</span>
									</label>
									<?php if(get_field('pakiet_opon_info') != "") { ?>
										<div class="toggle__checkbox-info" data-tooltip="<?php the_field('pakiet_opon_info') ?>"></div>
									<?php } ?>
								</div>
								<div class="toggle__checkbox">
									<input type="checkbox" id="checkOne3" class="<?php if( !get_field('ubezpieczenie_w_cenie') ): ?>--enabled<?php endif; ?>" data-price="<?php the_field('dodatkowe_ubezpieczenie') ?>" <?php if( get_field('ubezpieczenie_w_cenie') ): ?>checked<?php endif; ?> class="check"/>
									<label for="checkOne3" class="checkToggle <?php if( !get_field('dodatkowe_ubezpieczenie') || get_field('ubezpieczenie_w_cenie') ) : ?> checkOneWrapper<?php endif; ?>">
										<svg viewBox="0 0 84.6 91.8">
											<g>
												<path fill="currentColor" d="M42.3,8l34,14.2c0,0,2.6,17.1-7.4,37C57.7,81.5,42.3,83.8,42.3,83.8s-15.4-2.3-26.6-24.6
													c-10-19.9-7.4-37-7.4-37L42.3,8 M42.3,0c-1,0-2.1,0.2-3.1,0.6l-34,14.2c-2.6,1.1-4.4,3.4-4.8,6.2c-0.1,0.8-2.8,19.9,8.1,41.8
													c12.7,25.3,30.6,28.6,32.6,28.9c0.4,0.1,0.8,0.1,1.2,0.1s0.8,0,1.2-0.1c2-0.3,19.9-3.6,32.6-28.9c11-21.9,8.3-41,8.1-41.8
													c-0.4-2.8-2.3-5.1-4.8-6.2l-34-14.2C44.4,0.2,43.3,0,42.3,0L42.3,0z"/>
											</g>
											<polyline fill="none" stroke="currentColor" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="30.8,44.1 43,54 56.8,37.8 "/>
										</svg>
										<span>ubezpieczenie</span>
									</label>
									<?php if(get_field('ubezpieczenie_info') != "") { ?>
										<div class="toggle__checkbox-info" data-tooltip="<?php the_field('ubezpieczenie_info') ?>"></div>
									<?php } ?>
								</div>
								<div class="toggle__checkbox">
									<input type="checkbox" id="checkOne4" class="<?php if( get_field('assistance_w_cenie') ): ?>--enabled<?php endif; ?>" <?php if( !get_field('assistance_w_cenie') ): ?>checked<?php endif; ?> data-price="<?php the_field('dodatkowy_assistance') ?>"/>
									<label for="checkOne4" class="checkToggle  <?php if( !get_field('dodatkowy_assistance') || !get_field('assistance_w_cenie') ) : ?> checkOneWrapper<?php endif; ?>">
										<svg viewBox="0 0 60 60">
  <g fill="none" fill-rule="evenodd">
    <g fill="currentColor" fill-rule="nonzero">
      <path d="m30 0c-16.5685425 0-30 13.4314575-30 30s13.4314575 30 30 30 30-13.4314575 30-30c-.018737-16.5607751-13.4392249-29.98126296-30-30zm0 58c-15.463973 0-28-12.536027-28-28s12.536027-28 28-28 28 12.536027 28 28c-.0176345 15.4566626-12.5433374 27.9823655-28 28z"/>
      <path d="m30 4c-14.3594035 0-26 11.6405965-26 26s11.6405965 26 26 26 26-11.6405965 26-26c-.0159821-14.3527783-11.6472217-25.98401786-26-26zm0 50c-13.254834 0-24-10.745166-24-24s10.745166-24 24-24 24 10.745166 24 24c-.0154295 13.2484376-10.7515624 23.9845705-24 24z"/>
      <path d="m33.684 15.441c-.6260258-1.480044-2.0770032-2.4417497-3.684-2.4417497s-3.0579742.9617057-3.684 2.4417497l-11 26c-.8610119 2.034617.090383 4.381988 2.125 5.2429999s4.381988-.0903829 5.243-2.1249999l1.928-4.559h10.776l1.928 4.559c.861012 2.034617 3.208383 2.9860118 5.243 2.1249999s2.9860119-3.2083829 2.125-5.2429999zm9.17 28.311c-.1988812.492336-.586276.8847712-1.076 1.09-1.0170942.4104-2.1763778-.0599506-2.62-1.063l-2.186-5.169c-.1566411-.3698396-.5193562-.6100744-.921-.61h-12.1c-.4016438-.0000744-.7643589.2401604-.921.61l-2.186 5.169c-.2749894.6630997-.8842654 1.1279618-1.5964483 1.2180498-.712183.0900879-1.4180215-.2084182-1.8494655-.7821573-.431444-.573739-.5223083-1.3346974-.2380862-1.9938925l11-26c.3130129-.740022 1.0385016-1.2208748 1.842-1.2208748s1.5289871.4808528 1.842 1.2208748l11 26c.2071496.4886247.2107491 1.0397111.01 1.531z"/>
      <path d="m30.921 24.31c-.1565064-.370011-.5192508-.6104374-.921-.6104374s-.7644936.2404264-.921.6104374l-3.512 8.3c-.1308141.3088605-.0980687.6627333.0871994.9423452.1852681.279612.4983798.4477169.8338006.4476548h7.024c.3354208.0000621.6485325-.1680428.8338006-.4476548.1852681-.2796119.2180135-.6334847.0871994-.9423452zm-2.921 7.69 2-4.734 2 4.734z"/>
    </g>
  </g>
</svg>
										<span>auto zastępcze</span>
									</label>
									<?php if(get_field('assistance_info') != "") { ?>
										<div class="toggle__checkbox-info" data-tooltip="<?php the_field('assistance_info') ?>"></div>
									<?php } ?>
								</div>
          		</div>
						</div>
					</div>
        </div>
      </div>
		</div>
		
		<div class="list_type">
			<div class="row dim-and-price">
				<div class="col-md-6 dimensions">
          <p class="header">WYMIARY</p>
					<div class="dimensions__icons">
						<svg viewBox="0 0 1540.1 1299" class="dimensions__images --abe">
							<path fill="#353D61" d="M684.5,471c102,0,229.6,18.3,312.8,85.1h87.8c0,0,1.2-0.2,3.2-0.2c8.2,0,29.4,4,34.8,44.2
								c0,0,2.8,34.2,3.8,51.7c0,0,0.4,7.5,4.5,14.3c4.1,6.8,9,7.7,10.4,8.5c1.3,0.8,11.3,3.8,11.3,14.7v38.6c0,0-0.4,15.1-13.7,22
								c0,0-9.2,16.6-143.1,16.6h-16.4c2.3-5.3-38.7-8-79.7-8c-41,0-82,2.7-79.7,8H293.7c1.6-3.6-12.1-4.7-31-4.7
								c-37.8,0-96.6,4.7-96.6,4.7h-44.9l30.9-0.2l-42.9,0.2c0,0-0.6,0-1.6,0c-9.4,0-56.9-0.2-69.3-4.8c-2.6-1-5.1-3-6.4-7.9
								c-3.3-13.2-1.6-38.6-1.6-39.4c0.3-9.4,2.1-13.3,8.5-18.2c0,0,3.3-0.4,3.8-9.7c0.2-3.3,0.1-7.2,0.5-12.9
								c0.2-11.9,0.3-11.8,0.5-17.1c0.5-12,5.8-23.3,23.2-28.5c0,0,111.3-34.1,310.3-62.9c0,0,103.9-73.8,202.6-87.4
								C607.9,473.9,644.2,471,684.5,471 M684.5,441l0,30L684.5,441c-47.8,0-85.4,3.8-108.6,7c-91.8,12.6-185.1,71.8-209.8,88.4
								c-193.7,28.4-302.2,61.2-307.8,62.9c-27.1,8.1-43.3,28.5-44.5,55.9l-0.1,2c-0.2,3.9-0.2,5.6-0.4,15c-0.2,2.8-0.3,5.2-0.4,7.3
								c-10.1,11.1-12.1,23-12.5,33.6l0,0c-0.8,14.2-1,34,2.4,47.9c3.4,13.7,12.5,24.2,25.1,28.8c6.1,2.2,16.2,4.7,44.9,6
								c15,0.6,29.3,0.7,34.8,0.7c1.1,0,1.8,0,1.8,0l10.1,0c0.6,0,1.1,0,1.7,0h44.9c0.8,0,1.6,0,2.4-0.1c0.6,0,58-4.6,94.2-4.6
								c7.5,0,12.4,0.2,15.5,0.4c4.6,2.8,10,4.3,15.5,4.3h526.6c6,0,11.8-1.8,16.7-5.1c9.7-1.4,31.9-2.9,63-2.9c31.1,0,53.4,1.5,63,2.9
								c4.9,3.3,10.7,5.1,16.7,5.1h16.4c57.7,0,100.8-3,128.1-9c15-3.3,25.6-7.5,32.9-13.3c18.4-11.7,25.5-31.5,25.9-45.6
								c0-0.3,0-0.5,0-0.8v-38.6c0-8.5-2.6-29.3-26.3-40.8c-1-18.1-3.6-49.5-3.7-50.8c0-0.5-0.1-1-0.2-1.6c-3.4-24.8-12.3-43.6-26.6-55.9
								c-10.7-9.2-24.2-14.3-38-14.3c-1.9,0-3.6,0.1-5,0.2h-75.7c-40.3-30-91.6-52.5-152.7-66.8C803.1,447.2,745.8,441,684.5,441
								L684.5,441z"/>
							<circle fill="#FFF" stroke="#353d61" stroke-width="30" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" cx="215.4" cy="752.7" r="80.1"/>
							<circle fill="#FFF" stroke="#353d61" stroke-width="30" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" cx="900.1" cy="752.7" r="80.1"/>
							<line fill="none" stroke="#CCCED6" stroke-width="10" stroke-miterlimit="10" x1="5.6" y1="287.8" x2="1178.5" y2="287.8"/>
							<line fill="none" stroke="#CCCED6" stroke-width="10" stroke-miterlimit="10" x1="1055.8" y1="618.7" x2="1354" y2="618.7"/>
							<line fill="none" stroke="#CCCED6" stroke-width="10" stroke-miterlimit="10" x1="1180.5" y1="233.8" x2="1180.5" y2="337.8"/>
							<line fill="none" stroke="#CCCED6" stroke-width="10" stroke-miterlimit="10" x1="7.7" y1="227.1" x2="7.7" y2="344.6"/>
							<path fill="#00D198" d="M598.1,163h-62.8l-10.4,30.1h-33.2l56.7-158h36.8l56.7,158h-33.4L598.1,163z M566.7,71.7l-22.8,66h45.6
								L566.7,71.7z"/>
							<line fill="none" stroke="#CCCED6" stroke-width="10" stroke-miterlimit="10" x1="212.4" y1="947.8" x2="898.9" y2="947.8"/>
							<line fill="none" stroke="#CCCED6" stroke-width="10" stroke-miterlimit="10" x1="900.1" y1="893.8" x2="900.1" y2="997.8"/>
							<line fill="none" stroke="#CCCED6" stroke-width="10" stroke-miterlimit="10" x1="213.6" y1="887.1" x2="213.6" y2="1004.6"/>
							<path fill="#00D198" d="M589.5,1165h-68v-157.7h65.1c33,0,51.3,17.2,51.3,40.7c0,19.2-11.5,31.2-26.9,36.2
								c17.9,3.2,30.5,19.7,30.5,38.2C641.4,1147.3,622.2,1165,589.5,1165z M582,1032.8h-28.9v39.5H582c14.9,0,23.5-6.8,23.5-19.7
								C605.5,1040,596.9,1032.8,582,1032.8z M584.3,1096.7h-31.2v42.5h31.9c15.4,0,24.4-7.5,24.4-20.8
								C609.3,1104.9,599.6,1096.7,584.3,1096.7z"/>
							<path fill="#00D198" d="M1505.8,564.2H1446v39.5h53.1v25.1H1446v41.8h59.9v25.8h-91.5v-158h91.5V564.2z"/>
							<circle fill="CCCED6" cx="1055.8" cy="618.7" r="30.5"/>
							<path fill="none" stroke="#353d61" stroke-width="30" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M510.4,588.2c0,0,196,0,298-13.9"/>
						</svg>
						<svg viewBox="0 0 1336.4 1034.7" class="dimensions__images --cd">
							<line fill="none" stroke="#ccced6" stroke-width="10" stroke-miterlimit="10" x1="259.9" y1="430.9" x2="259.9" y2="886.2"/>
							<line fill="none" stroke="#ccced6" stroke-width="10" stroke-miterlimit="10" x1="314.1" y1="430.9" x2="196.6" y2="430.9"/>
							<line fill="none" stroke="#ccced6" stroke-width="10" stroke-miterlimit="10" x1="314.1" y1="886.2" x2="196.6" y2="886.2"/>
							<line fill="none" stroke="#ccced6" stroke-width="10" stroke-miterlimit="10" x1="460" y1="286.9" x2="1100.8" y2="286.9"/>
							<line fill="none" stroke="#ccced6" stroke-width="10" stroke-miterlimit="10" x1="1102" y1="232.9" x2="1102" y2="336.9"/>
							<line fill="none" stroke="#ccced6" stroke-width="10" stroke-miterlimit="10" x1="462.1" y1="226.2" x2="462.1" y2="343.7"/>
							<rect fill="none" x="708.2" y="25"  width="628.2" height="183.9"/>
							<path fill="#00d198" d="M796.1,32.4c35,0,63.5,18.8,74.1,51.1h-36.4c-7.5-15.1-21-22.6-38-22.6c-27.6,0-47.2,20.1-47.2,52.2
								c0,31.9,19.7,52.2,47.2,52.2c16.9,0,30.5-7.5,38-22.8h36.4c-10.6,32.5-39.1,51.1-74.1,51.1c-45.4,0-80-33.2-80-80.4
								C716.1,65.9,750.6,32.4,796.1,32.4z"/>
							<rect fill="none" y="560.1" width="196.6" height="474.5"/>
							<path fill="#00d198" d="M153.9,648.7c0,47.7-32.8,78.6-83.2,78.6H15.6V569.6h55.1C121.1,569.6,153.9,600.8,153.9,648.7z M69.6,700.5
								c33.2,0,52-19,52-51.7c0-32.8-18.8-52.4-52-52.4H47.2v104.2H69.6z"/>
							<path fill="none" stroke="#353d61" stroke-width="30" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M1099.5,574.6c-15.1-32.9-67.9-6.9-67.9-6.9l-31.5-66.8c-30.3-53.2-191-51.4-205.4-51.7l0,0c0,0-0.4,0-0.9,0
								c-0.6,0-0.9,0-0.9,0l0,0c-80.2,0-190.9,7.1-215.1,55.8l-29.5,62.7c0,0-52.8-26-67.9,6.9c0,0-16.2,32.4,34.4,49.6l-17.1,29.6
								c0,0-6.7,18.6-6.7,40.7v24l-1-1v135.6c0,6.1,4.9,11,11,11h69.9c6.1,0,11-4.9,11-11v-42c0,0,131-2,207.9-2.3
								c88.4,0.4,199.5,2.3,199.5,2.3v42c0,6.1,5.3,11,11.9,11h75.5c6.6,0,11.9-4.9,11.9-11V752.4c0.2-2.5,0.2-4.1,0.2-4.1v-53.8
								c0-22.1-6.7-40.7-6.7-40.7l-17.1-29.6C1115.7,607,1099.5,574.6,1099.5,574.6z"/>
							<path fill="none" stroke="#353d61" stroke-width="30" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M609.4,588.3c0,0,145.8,16.7,354.1,0"/>
						</svg>
					</div>
					<div class="dimensions__items">
						<div class="dimensions__item">
							<strong>A:</strong> długość <span><?php the_field('wymiary_a') ?> mm</span>
						</div>
						<div class="dimensions__item">
							<strong>B:</strong> rozstaw osi <span><?php the_field('wymiary_b') ?> mm</span>
						</div>
						<div class="dimensions__item">
							<strong>C:</strong> szerokość <span><?php the_field('wymiary_c') ?> mm</span>
						</div>
						<div class="dimensions__item">
							<strong>D:</strong> wysokość <span><?php the_field('wymiary_d') ?> mm</span>
						</div>
						<div class="dimensions__item">
							<strong>E:</strong> bagażnik <span><?php the_field('wymiary_e') ?> l</span>
						</div>
					</div>
				</div>
				<div class="col-md-6 final-price__wrap">
					<div class="final-price" id="finalPriceWrap" data-domyslna-cena="<?php echo get_field('domyslna_wycena_kwota') ?>">
						<?php
							$offer = get_field('oferta_dla_klienta');
							if(empty($offer)){
								$offer = ['firmowy'];
							}
							$isBussiness = in_array('firmowy',$offer);
							$isIndividual = in_array('prywatny',$offer);
						?>
						<div class="final-price__type-wrap">
							<?php if( $isBussiness ) { ?>
								<div class="final-price__type-item">
									<p class="final-price__type">Klient Biznesowy</p>
									<h3 class="final-price__price" id="finalPrice">
										<strong>
											<?php 
												echo round((int)get_field('domyslna_wycena_kwota'), 0);
											?>
										</strong>
										<div class="final-price__currency">
											<span class="final-price__netto">netto</span>
											<span class="final-price__curr">PLN/mc</span>
										</div>
									</h3>
								</div>
							<?php } ?>
							<?php if( $isIndividual ) { ?>
							<div class="final-price__type-item">
								<p class="final-price__type">Klient Indywidualny</p>
								<h3 class="final-price__price" id="finalPriceIndividual">
									<strong>
										<?php 
											$price = get_field('domyslna_wycena_kwota');
											$indPrice = round(1.23 * $price, 0);

											echo $indPrice;
										?>
									</strong>
									<div class="final-price__currency">
										<span class="final-price__netto">brutto</span>
										<span class="final-price__curr">PLN/mc</span>
									</div>
								</h3>
							</div>
								<?php } ?>
						</div>
						<div class="car__btn-wrap">
							<div class="btn btn_custom --final-price">
								Zadzwoń
							</div>
							<div class="btn btn_custom --buy-now" id="buyNow" data-title="<?php the_title(); ?>">
									Kup teraz
									<div class="toggle__checkbox-validate">Aby zarezerwować samochód, należy wybrać opcję ubezpieczenia</div>
							</div>
						</div>
						<?php if(get_field('100%_raty_w_koszty')) { ?>
							<div class="final-price__badge">
								<div class="final-price__badge-value">100<span>%</span></div>
								<div class="final-price__badge-text">raty w koszty</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>

    <div class="list_type type_1">
      <div class="row">
        <div class="col-md-2">
          <p class="header">DANE TECHNICZNE</p>
        </div>
        <div class="col-md-3">
					<?php
						$markaSlugify = str_replace('-','_',slugify(get_field('dane_techniczne_marka')));
					?>
          <div class="technical-data__line"><strong>Marka:</strong> <a href="/wynajem-dlugoterminowy/<?php echo $markaSlugify; ?>/"><span><?php the_field('dane_techniczne_marka') ?></span></div></a>
          <div class="technical-data__line"><strong>Model:</strong> <span><?php the_field('dane_techniczne_model') ?></span></div>
          <div class="technical-data__line"><strong>Wersja wyposażenia:</strong> <span><?php the_field('dane_techniczne_wersja_wyposazenia') ?></span></div>
        </div>
        <div class="col-md-4">
          <div class="technical-data__line"><strong>Rocznik:</strong> <span><?php the_field('dane_techniczne_rocznik') ?></span></div>
          <div class="technical-data__line"><strong>Paliwo:</strong> <span><?php echo get_field('dane_techniczne_paliwo')['label']; ?></span></div>
          <div class="technical-data__line"><strong>Nadwozie:</strong> <span class="<?php if(get_field('dane_techniczne_nadwozie') === 'suv'){ echo '--big'; } ?>"><?php the_field('dane_techniczne_nadwozie') ?></span></div>
        </div>
        <div class="col-md-3">
          <div class="technical-data__line"><strong>Skrzynia biegów:</strong> <span><?php the_field('dane_techniczne_skrzynia_biegow') ?></span></div>
          <div class="technical-data__line"><strong>Silnik:</strong> <span><?php the_field('dane_techniczne_silnik') ?></span></div>
          <div class="technical-data__line"><strong>Moc:</strong> <span><?php the_field('dane_techniczne_moc') ?></span> KM</div>
        </div>
			</div>
    </div>

    <div class="list_type type_2">
      <div class="row">
        <div class="col-md-2">
          <p class="header">WYPOSAŻENIE</p>
        </div>
        <div class="col-md-10">
          <ul class="list-unstyled list-inline">
            <?php if( have_rows('wyposazenie_lista') ): ?>
        			<?php while( have_rows('wyposazenie_lista') ): the_row();
        				$wyposazenie_opcja = get_sub_field('wyposazenie_opcja');
        				?>
        				<li title="<?php echo $wyposazenie_opcja; ?>"><?php echo $wyposazenie_opcja; ?></li>
        			<?php endwhile; ?>
        		<?php endif; ?>
          </ul>
        </div>
			</div>
    </div>

    <div class="bottom_info">
      <div class="row">
				<div class="btn btn_custom --final-price">
					Zadzwoń
				</div>
			</div>
			<div class="row">
				<div class="disclaimer">
					Niniejsze ogłoszenie jest wyłącznie informacją handlową i nie stanowi oferty w myśl art. 66 §1. Kodeksu Cywilnego. Sprzedający nie odpowiada za ewentualne błędy lub nieaktualność ogłoszenia.
				</div>
			</div>
		</div>
</section>

<section class="container single_content --last">
	<div class="inner">
		<div class="row bottom__wrap">
			<div class="col-md-3">
				<h2>
					<div class="bottom__title"><?php the_title(); ?></div>
					<div class="bottom__subtitle">Na abonament</div>
				</h2>
			</div>
			<div class="col-md-7">
				<div class="bottom__text">
					<?php the_field('na_abonament_content') ?>
				</div>
			</div>
			<div class="col-md-2" style="display:flex;">
				<a href="<?php echo get_permalink(19); ?>#subject:<?php the_title(); ?>" class="bttn --secondary bottom__bttn">Zapytaj o ofertę</a>
			</div>
		</div>
	</div>
</section>

<section class="container car__tiles-container --single">
	<?php 
		$count_cars	=	3;
		$loop = new WP_Query( array( 
			'post_type'=>'wynajem', 
			'orderby'=>'rand', 
			'order'=>'ASC',
			'posts_per_page' => $count_cars, 
			'category_name'=>$category_slug, 
			'post__not_in' => array($currentID),
			'meta_query' => array(
				array(
					'key' => 'niedostepny',
					'compare' => '=',
					'value' => '0'
				)
		))); 
		$count = $loop->post_count; 
	?>
		<h3 class="car__tiles-head">Sprawdź podobne</h3>
		<div class="car__tiles" data-number="<?php echo $count; ?>">
			<?php $count = 0; ?>
			<?php while ( $loop->have_posts() ) : $loop->the_post();
				$count++;
				?>
					<a href="<?php the_permalink(); ?>" <?php post_class('tile move-title'); ?> data-price-max="<?php the_field('cena_48msc_-_20%_-_20000') ?>" data-price-min="<?php the_field('cena_24msc_-_0%_-_40000') ?>" data-mark="<?php the_field('dane_techniczne_marka') ?>" data-body="<?php the_field('dane_techniczne_nadwozie') ?>" data-fuel="<?php echo get_field('dane_techniczne_paliwo')['value']; ?>" data-gearbox="<?php the_field('dane_techniczne_skrzynia_biegow') ?>">
						<div class="tile__data">
							<div class="tile__price">
								<div class="tile__price-value"><?php the_field('domyslna_wycena_kwota') ?></div>
								<div class="tile__price-currency">PLN/mc</div>
							</div>
            	<div class="tile__name-wrap">
								<h4 class="tile__name" title="<?php the_title(); ?>"><?php the_title(); ?></h4>
							</div>
							<div class="tile__features">
								<?php the_field('domyslna_oferta') ?>
							</div>
			        <div class="bttn --secondary tile__btn">Sprawdź ofertę</div>
						</div>
						<div class="tile__thumb">
							<div class="tile__image">
								<?php if( has_post_thumbnail() ) : ?>
									<div class="tile__thumb-item" style="background-image: url('<?php the_post_thumbnail_url(); ?>')"></div>
								<?php else:  ?>
									<div class="tile__thumb-item empty"></div>
								<?php endif; ?>
							</div>
							<div class="tile__cats">
								<?php if( in_category('od-reki') ) : ?><div class="tile__cat --hand">OD<br>RĘKI!</div><?php endif; ?>
								<?php if( in_category('nowosc') ) : ?><div class="tile__cat --new">NEW!</div><?php endif; ?>
								<?php if( in_category('top') ) : ?><div class="tile__cat --top">TOP!</div><?php endif; ?>
							</div>
						</div>
			    </a>
			<?php endwhile; wp_reset_query(); ?>			
		</div>
</section>


<div class="container-fluid bestseller__background">
	<section class="container car__tiles-container --single">
		<?php 
			$count_cars	=	3;
			$loop = new WP_Query( array( 'post_type'=>'wynajem', 'orderby'=>'post_id', 'order'=>'ASC', 'orderby'=>'rand', 'posts_per_page'=> 3, 'category_name'=>'bestsellery','meta_query' => array(
					array(
						'key' => 'niedostepny',
						'compare' => '=',
						'value' => '0'
					)
				))); $count = $loop->post_count; ?>
			<h3 class="car__tiles-head">NAJLEPSZE OFERTY WYNAJMU DŁUGOTERMINOWEGO</h3>
			<div class="car__tiles" data-number="<?php echo $count; ?>">
				<?php $count = 0; ?>
				<?php while ( $loop->have_posts() ) : $loop->the_post();
					$count++;
					?>
						<a href="<?php the_permalink(); ?>" <?php post_class('tile move-title'); ?> data-price-max="<?php the_field('cena_48msc_-_20%_-_20000') ?>" data-price-min="<?php the_field('cena_24msc_-_0%_-_40000') ?>" data-mark="<?php the_field('dane_techniczne_marka') ?>" data-body="<?php the_field('dane_techniczne_nadwozie') ?>" data-fuel="<?php echo get_field('dane_techniczne_paliwo')['value']; ?>" data-gearbox="<?php the_field('dane_techniczne_skrzynia_biegow') ?>">
							<div class="tile__data">
								<div class="tile__price">
									<div class="tile__price-value"><?php the_field('domyslna_wycena_kwota') ?></div>
									<div class="tile__price-currency">PLN/mc</div>
								</div>
            		<div class="tile__name-wrap">
									<h4 class="tile__name" title="<?php the_title(); ?>"><?php the_title(); ?></h4>
								</div>
								<div class="tile__features">
									<?php the_field('domyslna_oferta') ?>
								</div>
								<div class="bttn --secondary tile__btn">Sprawdź ofertę</div>
							</div>
							<div class="tile__thumb">
								<div class="tile__image">
									<?php if( has_post_thumbnail() ) : ?>
										<div class="tile__thumb-item" style="background-image: url('<?php the_post_thumbnail_url(); ?>')"></div>
									<?php else:  ?>
										<div class="tile__thumb-item empty"></div>
									<?php endif; ?>
								</div>
								<div class="tile__cats">
									<?php if( in_category('od-reki') ) : ?><div class="tile__cat --hand">OD<br>RĘKI!</div><?php endif; ?>
									<?php if( in_category('nowosc') ) : ?><div class="tile__cat --new">NEW!</div><?php endif; ?>
									<?php if( in_category('top') ) : ?><div class="tile__cat --top">TOP!</div><?php endif; ?>
								</div>
							</div>
						</a>
				<?php endwhile; wp_reset_query(); ?>			
			</div>
	</section>
</div>
<div class="hidden">
	<?php

	if(!empty($prices)) {
		foreach($prices as $price_row) {
			$time = $price_row['okres']; ?>
			
			<input type="text" class="inputValue" data-time="<?php echo $time; ?>" data-limit="10000" value="<?php echo $price_row['0%_-_10000'] ?>">
			<input type="text" class="inputValue" data-time="<?php echo $time; ?>" data-limit="20000" value="<?php echo $price_row['0%_-_20000'] ?>">
			<input type="text" class="inputValue" data-time="<?php echo $time; ?>" data-limit="30000" value="<?php echo $price_row['0%_-_30000'] ?>">
			<input type="text" class="inputValue" data-time="<?php echo $time; ?>" data-limit="40000" value="<?php echo $price_row['0%_-_40000'] ?>">
			<input type="text" class="inputValue" data-time="<?php echo $time; ?>" data-limit="nolimit" value="<?php echo $price_row['0%_-_nolimit'] ?>">

	<?php
		}
	}
	?>
</div>

<div class="modal fade" id="buyNowForm">
  <div class="car-modal">
    <div class="car-modal__close" data-dismiss="modal">
      <svg class="car-modal__close-svg" viewBox="2115.656 4371.656 11.054 11.054">
        <g><path stroke="currentColor" d="M2126.003 4372.363l-9.64 9.64"></path><path stroke="currentColor" d="M2116.363 4372.363l9.64 9.64"></path></g>
      </svg>
    </div>
              <div class="car-modal__head">
                <b>Zamów samochód bez wychodzenia z domu!</b>
                <p>Po wypełnieniu formularza otrzymasz maila z niezbędnymi dokumentami.</p>
                <br>
                <br>
              </div>
              <div class="car-modal__body">
                <?php echo do_shortcode('[contact-form-7 id="3217" title="Kup teraz"]') ?>
              </div>
              <img class="car-modal__logo" src="https://floteocars.pl/wp-content/themes/floteo-custom/img/logo.svg" alt="">
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalDownloadPDF" tabindex="-1" role="dialog" aria-labelledby="modalDownloadPDFLabel">
  <div class="modal-dialog" role="document">
  	<div class="modal-content">
    	<div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Wypełnij formularz.<br/>Ofertę wyślemy Tobie na e-mail.</h4>
			</div>
      <div class="modal-body">
				<?php echo do_shortcode('[contact-form-7 id="899" title="Pobierz ofertę"]'); ?>
      </div>
    </div>
  </div>
</div>

	<script type="text/javascript">
		jQuery(window).on('load',function(){
			fbq('track', 'ViewContent', {
				content_ids: '<?php echo get_the_id(); ?>',
				item_price: <?php  the_field('domyslna_wycena_kwota'); ?>,
				currency: 'PLN',
				content_type: 'product',
				content_name: '<?php echo get_the_title();?>',
				content_category: '<?php echo $category_slug;?>',
				vehicle_type: 'CAR',
				make: '<?php the_field('dane_techniczne_marka') ?>', // RECOMMENDED
				model: '<?php the_field('dane_techniczne_model') ?>', // RECOMMENDED
				year: '<?php the_field('dane_techniczne_rocznik') ?>', // RECOMMENDED
				state_of_vehicle: 'CPO', // RECOMMENDED
				//exterior_color: 'black', // RECOMMENDED
				transmission: '<?php the_field('dane_techniczne_skrzynia_biegow') ?>', // RECOMMENDED
				body_style: ' <?php the_field('dane_techniczne_nadwozie') ?>', // RECOMMENDED
				fuel_type: '<?php echo get_field('dane_techniczne_paliwo')['label']; ?>', // RECOMMENDED
				//drivetrain: '' // RECOMMDENDED
			});

		});
	</script>

<?php
global $post;
 
if(is_singular()) {
    $is_disabled = get_field('niedostepny',$post->id);
 
    if($is_disabled){
 
    ?>
    <script type="text/javascript">
        jQuery(window).on('load',function(){
            jQuery('#disabledModal').modal('show');


			fbq('track', 'ViewContent', {
				item_price: <?php  the_field('domyslna_wycena_kwota'); ?>,
				currency: 'PLN',
				content_ids: '<?php $currentID;?>',
				content_type: ' vehicle ',
				content_name: '<?php echo get_the_title();?>',
				content_category: '<?php echo $category_slug;?>',
				vehicle_type: 'CAR'
			});

        });
    </script>
 
<?php } } ?>

<?php get_footer();
