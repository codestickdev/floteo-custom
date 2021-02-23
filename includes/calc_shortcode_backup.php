<?php


function floteocars_calc_shortcode_backup() {
	ob_start();
?>

	<form id="floteocars_calc" method="get" action="<?php echo home_url(); ?>/wynajem-dlugoterminowy">
		<div class="row" id="">


			<div class="col-md-offset-3 col-md-6">
				<div class="col-md-12">
					<div class="form-group">
						<div class="col-md-6">
							<label>Stan pojazdu</label>
						</div>
						<div class="col-md-6">
						<div class="select_wrapper">
							<select class="form-control floteocars_calc_option" name="calc_stan" id="calc_stan">
								<option value="">Wybierz</option>
								<option value="nowy">Nowy</option>
								<option value="używany">Używany</option>

							</select>
						</div>
							</div>
						<div class="clearfix"></div>

					</div>

					<div class="form-group">
						<div class="col-md-6">
						<label>Marka</label>
						</div>
						<div class="col-md-6">
						<div class="select_wrapper">
							<select class="form-control floteocars_calc_option" name="calc_marka" id="calc_marka">
								<option value="">Wybierz</option>
								<?php
								$terms = get_terms( array(
									'taxonomy' => 'calc_marka-samochodu',
									'hide_empty' => false,
								) );

								if(!empty($terms)){
									foreach($terms as $term){
										echo '<option value="'.$term->term_id.'">'.$term->name.'</option>';
									}
								}
								?>
							</select>
						</div>
							</div>
						<div class="clearfix"></div>

					</div>


					<div class="form-group">
						<div class="col-md-6">
						<label>Model</label>
							</div>
						<div class="col-md-6">

						<div class="select_wrapper">
								<select class="form-control floteocars_calc_option" name="calc_model" id="calc_model">
									<option value="">Wybierz</option>
								</select>
							</div>
							</div>
						<div class="clearfix"></div>
						</div>



						<div class="form-group">
							<div class="col-md-6">
							<label id="calc_stan_label">Katalogowa cena samochodu</label>
								</div>
							<div class="col-md-6">
							<div class="select_wrapper">
								<input type="number" class="form-control floteocars_calc_option" name="calc_model_katalogowa_cena_samochodu">
							</div>
								</div>
							<div class="clearfix"></div>

						</div>

						<div class="form-group">
							<div class="col-md-6">
							<label>Cena samochodu po rabacie</label>
								</div>
							<div class="col-md-6">
							<div class="select_wrapper">
								<input type="number" class="form-control floteocars_calc_option" name="calc_model_cena_samochodu_po_rabacie">
							</div>
								</div>
							<div class="clearfix"></div>

						</div>


						<div class="form-group">
							<div class="col-md-6">
							<label>Pierwsza wpłata %</label>
								</div>
							<div class="col-md-6">
							<div class="select_wrapper">
								<div id="pierwsza_wplata">
									<button type="button" class="sub inline">-</button><input type="number" id="1" value="10" min="1" max="45" class="form-control floteocars_calc_option inline" name="calc_model_pierwsza_wplata" style="max-width: 185px;"/><button type="button" class="add">+</button>
								</div>
							</div>
								</div>
							<div class="clearfix"></div>

						</div>


						<div class="form-group">
							<div class="col-md-6">
							<label>Okres leasingu(msc)</label>
								</div>
							<div class="col-md-6">

							<div class="select_wrapper">
								<div id="okres_leasingu">
									<button type="button" class="sub inline">-</button><input type="number" value="60" min="24" max="84" class="form-control floteocars_calc_option inline" name="calc_model_okres_leasingu" style="    max-width: 185px;"/><button type="button" class="add inline">+</button>
								</div>
							</div>
								</div>
							<div class="clearfix"></div>

						</div>


						<div class="form-group">
							<div class="col-md-6">
							<label>Wykup %</label>
								</div>
							<div class="col-md-6">

							<div class="select_wrapper">
								<div id="wykup">
									<button type="button" class="sub inline">-</button><input type="number" value="10" min="1" max="35" class="form-control floteocars_calc_option inline" name="calc_model_wykup" style="    max-width: 185px;"/><button type="button" class="add inline">+</button>
								</div>
							</div>
								</div>
							<div class="clearfix"></div>

						</div>

					<div class="form-group">
					<div class="col-md-12">

						<div class="text-center">
							<br />
							<a href="#" id="calc_oblicz" class="btn btn_custom">Oblicz ratę i koszt leasingu</a>

						</div>
					</div>


					</div>



				</div>


			</div>



			<div class="clearfix"></div>







			<div class="clearfix"></div>
			<div id="calc_calculation">


				<div class="calc_result" style="display: none">
					<div class="col-lg-12">
						<div class="col-lg-6">
							<h3>Rata leasingu z rabatem Floteo</h3>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="clearfix"></div>
					<hr>
					<div class="col-lg-offset-6 col-lg-6 text-right">
						<a href="#" class="floteo_info">Czym jest rabat floteo?</a>
						<div id="floteo_info_info" style="display: none">
							Każdego miesiąca, zamawiamy dla naszych klientów setki samochodów. Ty kupujesz najprawdopodobniej jeden co parę lat. Dzięki temu, uzyskujemy ogromne rabatycharakterystyczne dla zakupów grupowych i dzielimy się nimi z naszymi klientami.<br />Teraz już wiesz, o ile taniej kupisz swój wymarzony samochód, jeśli skorzystasz z naszych flotowych rabatów. Jeden telefon do Floteo, to często dziesiątki tysięcy złotych w kieszeni. Skontaktuj się z nami już teraz!
						</div>
					</div>
					<div class="col-lg-12">
						<div class="col-lg-3">
							<span class="small">wartość rabatu</span>
							<br />
							<span class="value"><span id="calc_rabat_floteo_perc"></span>%</span>
						</div>
						<div class="col-lg-3">
							<span class="small">wartość upustu</span>
							<br />
							<span class="value"><span id="calc_rabat_floteo"></span> zł</span>
						</div>
						<div class="col-lg-5">
							<span class="small">rata po rabacie</span>
							<br />
							<span class="value"><span id="calc_rata_po_rabacie_floteo_netto"></span> PLN netto</span> <span class="small">(<span id="calc_rata_po_rabacie_floteo"></span> PLN brutto)</span>

						</div>
						<div class="clearfix"></div>
					</div>
					<div class="clearfix"></div>

					<hr>

					<div class="col-lg-4">
						<a href="<?php echo get_the_permalink(19);?>" class="btn btn_custom btn_style1 inline">Kontakt</a> <a href="tel:+48 880 556 566" class="btn btn_custom inline">Zadzwoń</a>
					</div>

					<div class="clearfix"></div>
				</div>



				<div class="calc_result" style="display: none">
					<div class="col-lg-12">
						<div class="col-lg-6">
							<h3>Rata leasingu z Twoim rabatem</h3>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="clearfix"></div>
					<hr>

					<div class="col-lg-12">
						<div class="col-lg-3">
							<span class="small">wartość rabatu</span>
							<br />
							<span class="value"><span id="calc_rabat_client_perc"></span>%</span>
						</div>
						<div class="col-lg-3">
							<span class="small">wartość upustu</span>
							<br />
							<span class="value"><span id="calc_rabat_client"></span> zł</span>
						</div>
						<div class="col-lg-5">
							<span class="small">rata po rabacie</span>
							<br />
							<span class="value"><span id="calc_rata_z_twoim_rabatem_netto"></span> PLN netto</span> <span class="small">(<span id="calc_rata_z_twoim_rabatem"></span> PLN brutto)</span>

						</div>
						<div class="clearfix"></div>
					</div>
					<div class="clearfix"></div>

					<hr>

					<div class="col-lg-4">
						<a href="<?php echo get_the_permalink(19);?>" class="btn btn_custom btn_style1 inline">Kontakt</a> <a href="tel:+48 880 556 566" class="btn btn_custom inline">Zadzwoń</a>
					</div>

					<div class="clearfix"></div>
				</div>





				<div class="calc_result" style="display: none">
					<div class="col-lg-12">
						<div class="col-lg-6">
							<h3>Rata abonamentu Floteo</h3>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="clearfix"></div>
					<hr>

					<div class="col-lg-12">
						<div class="col-lg-3">
							<span class="small">opłata wstępna</span>
							<br />
							<span class="value"><span id="calc_abonament_oplata_wstepna"> zł</span></span>
						</div>
						<div class="col-lg-3">
							<span class="small">ilość rat</span>
							<br />
							<span class="value"><span id="calc_abonament_ilosc_rat"></span</span>
						</div>
						<div class="col-lg-5">
							<span class="small">rata po rabacie</span>
							<br />
							<span class="value"><span id="calc_rata_w_abonamencie_netto"></span> PLN netto</span> <span class="small"> (<span  id="calc_rata_w_abonamencie"></span> PLN brutto)</span>

						</div>
						<div class="clearfix"></div>
					</div>
					<div class="clearfix"></div>

					<hr>

					<div class="col-lg-8">
						<a href="<?php echo get_the_permalink(19);?>" class="btn btn_custom btn_style1 inline">Kontakt</a> <a href="tel:+48 880 556 566" class="btn btn_custom inline">Zadzwoń</a>
					</div>

					<div class="clearfix"></div>
				</div>




				<p>
					Niniejsza kalkulacja jest poglądowa i nie stanowi oferty w myśl art. 66 §1. Kodeksu Cywilnego. Sprzedający nie odpowiada za ewentualne błędy lub nieaktualność ogłoszenia.
				</p>
			</div>

	</form>

	<style>
		.inline{
			display: inline-block;
		}
		#floteocars_calc{
			margin-top: 15px;;
		}
		#calc_calculation{
			padding: 20px;;
		}
		.calc_result{
			background: white;
			border-radius: 5px;
			padding: 15px 30px;
			margin: 0 auto;
			margin-bottom: 30px;
		}
		.btn_custom{
			max-width: 100%;
		}
		hr{
			margin: 20px;
		}
		.value{
			font-weight: 700;
			font-size: 24px;
		}
		.floteo_info{
			font-size: 12px;
			text-decoration: underline;
		}
		.with_line::after{
			content: '';
			position: absolute;
			bottom: -25px;
			left: 48%!important;
			width: 35px!important;
			height: 2px;
			background-color: #00D197!important;
		}

	</style>

	<?php
	$includedhtml = ob_get_contents();
	ob_end_clean();

	return $includedhtml;
}

add_shortcode('floteocars_calc', 'floteocars_calc_shortcode');









?>
