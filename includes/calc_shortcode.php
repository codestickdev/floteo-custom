<?php


function floteocars_calc_shortcode() {
	ob_start();
?>
	<div class="loading" style="display: none">Loading&#8230;</div>
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
								$crm_data = getCrmData();
								if(!empty($crm_data)){
									foreach($crm_data as $key=>$term){
										echo '<option value="'.$term->id.'">'.$term->name.'</option>';
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

						<div class="form-group" id="cena_sam_po_rab_cont">
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

			<span class="anchor" id="calc_calculationScrollTo"></span>
			<div id="calc_calculation">

				<div class="calc_result" style="display: none">
					<div class="row custom_row">
						<div class="col-lg-5">
							<h3>Rata z rabatem Floteo</h3>
						</div>
						<div class="col-lg-4">
							<span class="value"><span id="calc_rata_po_rabacie_floteo_netto"></span> PLN netto</span> <span class="small">(<span id="calc_rata_po_rabacie_floteo"></span> PLN brutto)</span>
						</div>
						<div class="col-lg-3 text-right">
							<a href="<?php echo get_the_permalink(19);?>" class="btn btn_custom btn_style1 inline">Kontakt</a> <a href="tel:+48 880 556 566" class="btn btn_custom inline" title="+48 880 556 566"><span class="hide_desktop">Zadzwoń</span><span class="show_desktop"> +48 880 556 566</span></a>
						</div>
					</div>
					<div class="row"><hr></div>
					<div class="row">
						<div class="col-lg-12">
							<a href="#" class="floteo_info" id="floteo_info">Czym jest rabat Floteo?</a>
							<div id="floteo_info_info" style="display: none">
								Każdego miesiąca, zamawiamy dla naszych klientów setki samochodów. Ty kupujesz najprawdopodobniej jeden co parę lat. Dzięki temu, uzyskujemy ogromne rabaty charakterystyczne dla zakupów grupowych i dzielimy się nimi z naszymi klientami.<br />Teraz już wiesz, o ile taniej kupisz swój wymarzony samochód, jeśli skorzystasz z naszych flotowych rabatów. Jeden telefon do Floteo, to często dziesiątki tysięcy złotych w kieszeni. Skontaktuj się z nami już teraz!
							</div>
						</div>
					</div>
				</div>

				<div class="calc_result" style="display: none">
					<div class="row custom_row">
						<div class="col-lg-5">
							<h3>Rata standardowego leasingu</h3>
						</div>
						<div class="col-lg-4">
							<span class="value"><span id="calc_rata_z_twoim_rabatem_netto"></span> PLN netto</span> <span class="small">(<span id="calc_rata_z_twoim_rabatem"></span> PLN brutto)</span>
						</div>
						<div class="col-lg-3 text-right">
							<a href="<?php echo get_the_permalink(19);?>" class="btn btn_custom btn_style1 inline">Kontakt</a> <a href="tel:+48 880 556 566" class="btn btn_custom inline" title="+48 880 556 566"><span class="hide_desktop">Zadzwoń</span><span class="show_desktop"> +48 880 556 566</span></a>
						</div>
					</div>
				</div>

				<div class="calc_result" style="display: none">
					<div class="row custom_row">
						<div class="col-lg-5">
							<h3>Rata abonamentu Floteo</h3>
						</div>
						<div class="col-lg-4">
							<span class="value"><span id="calc_rata_w_abonamencie_netto"></span> PLN netto</span> <span class="small"> (<span  id="calc_rata_w_abonamencie"></span> PLN brutto)</span>
							<br>
							<ul>
								<li>Opłata wstępna: <span id="calc_abonament_oplata_wstepna"></span></li>
								<li>Okres: <span id="calc_abonament_ilosc_rat"></span> miesięcy</li>
								<li><span id="calc_abonament_informacje"></span> </li>
							</ul>
						</div>
						<div class="col-lg-3 text-right">
							<a href="<?php echo get_the_permalink(19);?>" class="btn btn_custom btn_style1 inline">Kontakt</a> <a href="tel:+48 880 556 566" class="btn btn_custom inline" title="+48 880 556 566"><span class="hide_desktop">Zadzwoń</span><span class="show_desktop"> +48 880 556 566</span></a>
						</div>
					</div>
					<div class="row"><hr></div>
					<div class="row">
						<div class="col-lg-12">
							<a href="#" class="floteo_info" id="floteo_info2">Czym jest abonament Floteo?</a>
							<div id="floteo_info_info2" style="display: none">
								Abonament – zwany także Wynajmem Długoterminowym – to sposób na nowy samochód co około 3 lata, z bardzo niską ratą, bez wpłaty własnej oraz bez konieczności jego wykupu.
							</div>
						</div>
					</div>
				</div>

				<p>Niniejsza kalkulacja jest poglądowa i nie stanowi oferty w myśl art. 66 §1. Kodeksu Cywilnego. Sprzedający nie odpowiada za ewentualne błędy lub nieaktualność ogłoszenia.</p>
			</div>

	</form>

	<style>
	.show_desktop{
		display: none;
	}
	.hide_desktop{
		display: block;
	}
	.loading {
		position: fixed;
		z-index: 999;
		height: 2em;
		width: 2em;
		overflow: show;
		margin: auto;
		top: 0;
		left: 0;
		bottom: 0;
		right: 0;
	}
	.loading:before {
		content: '';
		display: block;
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		/*background: radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0, .8));
		background: -webkit-radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0,.8));*/
	}
	.loading:not(:required) {
		/* hide "loading..." text */
		font: 0/0 a;
		color: transparent;
		text-shadow: none;
		background-color: transparent;
		border: 0;
	}
	.loading:not(:required):after {
		content: '';
		display: block;
		font-size: 10px;
		width: 1em;
		height: 1em;
		margin-top: -0.5em;
		-webkit-animation: spinner 1500ms infinite linear;
		-moz-animation: spinner 1500ms infinite linear;
		-ms-animation: spinner 1500ms infinite linear;
		-o-animation: spinner 1500ms infinite linear;
		animation: spinner 1500ms infinite linear;
		border-radius: 0.5em;
		-webkit-box-shadow: rgba(0,209,144, 0.75) 1.5em 0 0 0, rgba(0,209,144, 0.75) 1.1em 1.1em 0 0, rgba(0,209,144, 0.75) 0 1.5em 0 0, rgba(0,209,144, 0.75) -1.1em 1.1em 0 0, rgba(0,209,144, 0.75) -1.5em 0 0 0, rgba(0,209,144, 0.75) -1.1em -1.1em 0 0, rgba(0,209,144, 0.75) 0 -1.5em 0 0, rgba(0,209,144, 0.75) 1.1em -1.1em 0 0;
		box-shadow: rgba(0,209,144, 0.75) 1.5em 0 0 0, rgba(0,209,144, 0.75) 1.1em 1.1em 0 0, rgba(0,209,144, 0.75) 0 1.5em 0 0, rgba(0,209,144, 0.75) -1.1em 1.1em 0 0, rgba(0,209,144, 0.75) -1.5em 0 0 0, rgba(0,209,144, 0.75) -1.1em -1.1em 0 0, rgba(0,209,144, 0.75) 0 -1.5em 0 0, rgba(0,209,144, 0.75) 1.1em -1.1em 0 0;
	}
	@-webkit-keyframes spinner {
		0% {
			-webkit-transform: rotate(0deg);
			-moz-transform: rotate(0deg);
			-ms-transform: rotate(0deg);
			-o-transform: rotate(0deg);
			transform: rotate(0deg);
		}
		100% {
			-webkit-transform: rotate(360deg);
			-moz-transform: rotate(360deg);
			-ms-transform: rotate(360deg);
			-o-transform: rotate(360deg);
			transform: rotate(360deg);
		}
	}
	@-moz-keyframes spinner {
		0% {
			-webkit-transform: rotate(0deg);
			-moz-transform: rotate(0deg);
			-ms-transform: rotate(0deg);
			-o-transform: rotate(0deg);
			transform: rotate(0deg);
		}
		100% {
			-webkit-transform: rotate(360deg);
			-moz-transform: rotate(360deg);
			-ms-transform: rotate(360deg);
			-o-transform: rotate(360deg);
			transform: rotate(360deg);
		}
	}
	@-o-keyframes spinner {
		0% {
			-webkit-transform: rotate(0deg);
			-moz-transform: rotate(0deg);
			-ms-transform: rotate(0deg);
			-o-transform: rotate(0deg);
			transform: rotate(0deg);
		}
		100% {
			-webkit-transform: rotate(360deg);
			-moz-transform: rotate(360deg);
			-ms-transform: rotate(360deg);
			-o-transform: rotate(360deg);
			transform: rotate(360deg);
		}
	}
	@keyframes spinner {
		0% {
			-webkit-transform: rotate(0deg);
			-moz-transform: rotate(0deg);
			-ms-transform: rotate(0deg);
			-o-transform: rotate(0deg);
			transform: rotate(0deg);
		}
		100% {
			-webkit-transform: rotate(360deg);
			-moz-transform: rotate(360deg);
			-ms-transform: rotate(360deg);
			-o-transform: rotate(360deg);
			transform: rotate(360deg);
		}
	}
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
			margin: 20px 20px 10px 20px;
		}
		.value{
			font-weight: 700;
			font-size: 24px;
		}
		.floteo_info, .floteo_info:hover, .floteo_info:focus{
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
		.custom_row{
			display: flex;
			align-items: center;
		}
		.custom_row ul{
			margin: 0px!important;
			padding: 0px!important;
			list-style-type: none!important;
			position: relative;
			left: -15px;
    	top: -15px;
		}
		.custom_row ul li{
			line-height: 1.4!important;
			margin-bottom: 0px!important;
			position: relative;
		}
		.custom_row ul li:before{
			content: '';
			position: absolute;
			top: 50%;
			transform: translate(-0%, -50%);
			left: -15px;
			height: 18px;
			width: 18px;
			position: absolute;
    	left: -25px;
			background: url('<?php bloginfo('template_directory') ?>/img/ico_check.svg');
			background-repeat: no-repeat;
			background-size: contain;
			background-position: center center;
		}
		footer a{
			word-break: break-all;
		}
		.calc_result p{
			display: none;
		}
		.anchor{
			display: block;
		  height: 95px;
		  margin-top: -95px;
		  visibility: hidden;
		}
		input[type=number]::-webkit-inner-spin-button,
		input[type=number]::-webkit-outer-spin-button {
		  -webkit-appearance: none;
		  margin: 0;
		}
		@media(max-width: 991px){
			.custom_row{
				display: block;
			}
			.custom_row h3{
				font-size: 18px;
			}
			.custom_row .text-right{
				text-align: left;
				margin-top: 10px;
			}
			.custom_row hr{
				margin: 15px 20px 10px 20px;
			}
			.custom_row span.small{
				display: block;
			}
			.calc_result{
				padding: 15px;
				margin-bottom: 5px;
			}
			#floteocars_calc .form-control{
				font-size: 16px!important;
			}
		}
	@media(min-width: 768px) {
		.hide_desktop{
			display: none;
		}
		.show_desktop{
			display: block;
		}
	}
	</style>

	<?php
	$includedhtml = ob_get_contents();
	ob_end_clean();

	return $includedhtml;
}

add_shortcode('floteocars_calc', 'floteocars_calc_shortcode');









?>
