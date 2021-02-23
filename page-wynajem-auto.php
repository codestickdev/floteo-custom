<?php
/*
* Template Name: Wynajem aut
*/

session_start();

$searchMark = $_GET['searchMark'];
$searchBody = $_GET['searchBody'];
$searchFuel = $_GET['searchFuel'];
$searchGearbox = $_GET['searchGearbox'];
$searchPriceMin = $_GET['searchPriceMin'];
$searchPriceMax = $_GET['searchPriceMax'];

function getIcon($type)
{
	switch ($type) {
		case "hatchback":
			return "<img class='svg' src='" . get_template_directory_uri() . "/img/floteo_search_hatchback.svg'>";
		case "sedan":
			return "<img class='svg' src='" . get_template_directory_uri() . "/img/floteo_search_sedan.svg'>";
		case "kombi":
			return "<img class='svg' src='" . get_template_directory_uri() . "/img/floteo_search_kombi.svg'>";
		case "crossover":
			return "<img class='svg' src='" . get_template_directory_uri() . "/img/floteo_search_crossover.svg'>";
		case "suv":
			return "<img class='svg' src='" . get_template_directory_uri() . "/img/floteo_search_suv.svg'>";
		case "dostawcze":
			return "<img class='svg' src='" . get_template_directory_uri() . "/img/floteo_search_dostawczy.svg'>";
	}
}

get_header(); ?>

<?php

$mark = get_query_var('searchMark');
if (!empty($mark)) {
	$_GET['searchMark'] = $mark;
}

?>
<h2 class="rentPage__sectitle">Wynajem długoterminowy samochodów <span><a href="/">Strona główna</a>>><a href="#"><?php echo get_the_title(); ?></a></span></h2>
<section class="subpageSplit rentPage">
	<div class="rentPage__left">
		<div class="mobileBtn"><p>Filtruj</p></div>
		<h3 class="rentPage__left--title">Wyszukiwanie zaawansowane</h3>
		<?php include('_include-floteo-search.php'); ?>
	</div>
	<div class="rentPage__right">
		<div class="archiveHeaderMobile">
			<div class="archiveheaderMobile__searchbar">
				<form id="searchEngine" class="searchbarMobile" method="get" action="<?php echo home_url(); ?>/wynajem-dlugoterminowy">
					<input class="searchbarMobile-input" type="text" placeholder="Wpisz słowa kluczowe" name="filterQuery" value="<?php if(!empty($_GET['filterQuery'])){ echo $_GET['filterQuery']; }; ?>" />
					<div class="searchbarMobile-right">
						<button type="submit" class="btn_searchbarMobile">Znajdź</button>
						<div class="custom-search open-find-car">Filtruj</div>
					</div>
				</form>
			</div>
		</div>
		<?php
		$loop = new WP_Query(
			array(
				'post_type' => 'wynajem',
				'orderby' => 'post_id',
				'order' => 'ASC',
				'meta_query' => array(
					array(
						'key' => 'niedostepny',
						'compare' => '=',
						'value' => '0'
					)
				)
			)
		);
		?>
		<input type="hidden" name="searchMarkInput" value="<?php echo $searchMark; ?>">
		<input type="hidden" name="searchBodyInput" value="<?php echo $searchBody; ?>">
		<input type="hidden" name="searchFuelInput" value="<?php echo $searchFuel; ?>">
		<input type="hidden" name="searchGearboxIput" value="<?php echo $searchGearbox; ?>">
		<div class="rentPage__right-heading">
			<h2>Wyniki wyszukiwania <span id="searchResultsCount">(<?php echo $loop->found_posts; ?>)</span></h2>
			<div class="sort__button">
				<div class="sort_button-text">Sortuj po</div>
				<select class="sort__button-select" id="sort_change">
					<option value="popular">Popularność</option>
					<option value="price_asc" selected>Cena rosnąco</option>
					<option value="price_desc">Cena malejąco</option>
					<option value="name_asc">Nazwa rosnąco</option>
					<option value="name_desc">Nazwa malejąco</option>
				</select>
			</div>
		</div>
		<section class="archiveTiles car_tiles" id="archiveContent">
			<div id="listingList">
				<?php
				$last_best = 1;

				while ($loop->have_posts()) : $loop->the_post(); ?>

					<?php
					global $post;

					$best = in_category(6, $post);

					if (empty($best)) {
						$best = 99999;
					} else {
						$best = $last_best;
						$last_best = $last_best + 1;
					}

					$offer = get_field('oferta_dla_klienta');
					if(is_null($offer)){
						$offer = ['firmowy'];
					}
					$isBussiness = in_array('firmowy',$offer);
					$isIndividual = in_array('prywatny',$offer);
					?>

				<a href="<?php the_permalink(); ?>" class="archiveTile tile --archive move-title <?php the_field('dane_techniczne_marka') ?> <?php the_field('dane_techniczne_model') ?> <?php the_field('dane_techniczne_nadwozie') ?> <?php echo get_field('dane_techniczne_paliwo')['value']; ?> <?php the_field('dane_techniczne_skrzynia_biegow') ?>" data-individual="<?php echo $isIndividual; ?>" data-business="<?php echo $isBussiness; ?>" data-price="<?php the_field('domyslna_wycena_kwota') ?>" data-carname="<?php the_title(); ?>" data-hand="<?php if( in_category('od-reki') ) : ?>1<?php endif; ?>" data-best="<?php echo $best;?>">
						<div class="archiveTile-thumb">
							<?php if (has_post_thumbnail()) : ?>
								<div class="thumb"
									style="background-image: url('/wp-content/themes/floteo-custom/img/bmw_thumb.png<?php /* the_post_thumbnail_url("medium"); */ ?>')"></div>
							<?php else: ?>
								<div class="thumb empty"></div>
							<?php endif; ?>
							<!-- <div class="archiveTile-flags">
								<?php if (in_category('od-reki')) : ?>
									<div class="tile__cat --hand">OD<br>RĘKI!</div>
								<?php endif; ?>
								<?php if (in_category('nowosc')) : ?>
									<div class="tile__cat --new">NEW!</div><?php endif; ?>
								<?php if (in_category('top')) : ?>
									<div class="tile__cat --top">TOP!</div><?php endif; ?>
							</div> -->
						</div>
						<div class="archiveTile-body">
							<div class="archiveTile-body--mobileWrap">
								<div class="archiveTile-body--data">
									<h4 class="name" title="<?php the_title(); ?>"><?php the_title(); ?></h4>
									<h4 class="name name--mobile" title="<?php the_title(); ?>"><?php the_title(); ?></h4>
									<div class="tags">
										<span><?php the_field('dane_techniczne_nadwozie'); ?></span>
										<span><?php echo get_field('dane_techniczne_paliwo')['label']; ?></span>
										<?php if( in_category('od-reki') ) : ?><span class="hand">Od ręki</span><?php endif; ?>
										<?php if( in_category('nowosc') ) : ?><span class="new">Nowe</span><?php endif; ?>
										<?php if( in_category('bestsellery') ) : ?><span class="bestseller">Bestseller</span><?php endif; ?>
									</div>
									<div class="specs">
										<div class="spec">
											<span>Silnik:</span>
											<span class="value"><?php the_field('dane_techniczne_moc') ?>KM <?php echo get_field('dane_techniczne_paliwo')['label']; ?></span>
										</div>
										<?php if(get_field('dane_techniczne_wersja_wyposazenia')): ?>
											<div class="spec">
												<span>Wyposażenie:</span>
												<span class="value"><?php the_field('dane_techniczne_wersja_wyposazenia'); ?></span>
											</div>
										<?php endif; ?>
										<div class="spec">
											<span>Rocznik:</span>
											<span class="value"><?php the_field('dane_techniczne_rocznik'); ?></span>
										</div>
									</div>
								</div>
								<div class="archiveTile-body--features">
									<?php if(get_field('domyslna_oferta')) : ?>
									<div class="features">
										<?php the_field('domyslna_oferta') ?>
									</div>
									<?php endif; ?>
									<div class="customBtn">Sprawdź ofertę</div>
								</div>
							</div>
							<div class="archiveTile-body--price">
								<div class="priceValue">
									<p>Osoba prywatna</p>
									<div class="value"><font class="tile_priceValue"><?php the_field('domyslna_wycena_kwota') ?></font>PLN <span>/ msc</span></div>
								</div>
								<div class="priceValue">
									<p>Klient biznesowy</p>
									<div class="value"><font class="tile_priceValue"><?php the_field('domyslna_wycena_kwota') ?></font>PLN <span>/ msc</span></div>
								</div>
							</div>
							<!-- <?php if (in_category('od-reki') || in_category('nowosc') || in_category('top')) { ?>
								<div class="archiveTile-flags">
									<?php if (in_category('od-reki')) : ?>
										<div class="tile__cat --hand">OD<br>RĘKI!</div><?php endif; ?>
									<?php if (in_category('nowosc')) : ?>
										<div class="tile__cat --new">NEW!</div><?php endif; ?>
									<?php if (in_category('top')) : ?>
										<div class="tile__cat --top">TOP!</div><?php endif; ?>
								</div>
							<?php } ?> -->
						</div>
					</a>
				<?php endwhile;
				wp_reset_query(); ?>

			</div>

		</section>
	</div>
</section>

<?php if (!empty($mark)) {
	if(is_array($mark))$mark = reset($mark);
	$mark = strtolower($mark);
	$mark_name = strtoupper($mark);
	?>
	<div class="container" style="display: none">
		<div class="container">
			<div class="row inner">
				<div class="col-md-12">

					<ul>
						<li><a href="/wynajem-dlugoterminowy/<?php echo $mark; ?>">Wynajem
								długoterminowy <?php echo htmlspecialchars($mark_name); ?></a></li>
						<li><a href="/wynajem-dlugoterminowy/<?php echo $mark; ?>/#Samochody_BMW_abonament">Auto na
								abonament <?php echo htmlspecialchars($mark_name); ?></a></li>
						<li><a href="/wynajem-dlugoterminowy/<?php echo $mark; ?>/#kalkulator_leasingowy">Kalkulator
								leasingowy <?php echo htmlspecialchars($mark_name); ?></a></li>
						<li><a href="/wynajem-dlugoterminowy/<?php echo $mark; ?>/#Comfort_lease"><?php echo htmlspecialchars($mark_name); ?>
								Comfort Lease</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
<?php include('_include-floteo-marks.php'); ?>
<?php include('_include-floteo-marks-descriptions.php'); ?>
<?php if (empty($mark)) { ?>
	<div class="container">
		<div class="row inner">
			<div class="col-md-12">
				<p>
					Nasza oferta długoterminowego wynajmu aut zaspokoi potrzeby nawet najbardziej wymagających klientów.
					W ofercie Floteo znajdują się najnowsze modele aut popularnych marek, począwszy od aut miejskich,
					a na autach klasy premium kończąc. Zachęcamy do zapoznania się z szeroką gamą modeli,
					którą cały czas sukcesywnie powiększamy o kolejne auta.
				</p>

				<h2>Wynajem długoterminowy samochodów - na czym polega?</h2>

				<p>Długoterminowy wynajem samochodów zyskuje coraz większą popularność zarówno wśród firm jak i osób
					prywatnych.
					Jego popularność nie wzięła się jednak z nikąd - jest ona uzasadniona. Tego typu wynajem cechuje się
					prostotą i
					korzystnymi warunkami, dzięki którym można stać się posiadaczem samochodu będącego do tej pory poza
					zasięgiem finansowym.</p>

				<p>Wynajem długoterminowy umożliwia korzystanie z auta przez czas określony w umowie wynajmu, która
					najczęściej wynosi
					od 24 do 36 miesięcy. Przez okres trwania umowy kosztem użytkownika jest stała, miesięczna opłata za
					wynajem.
					Jest to bardzo wygodna i prosta forma użytkowania nowych samochodów do celów firmowych lub
					prywatnych.
					Wynajem długoterminowy można nazwać alternatywą dla leasingu.</p>

				<p>W ramach wynajmu długoterminowego klient może dowolnie skonfigurować wyposażenie samochodu, wybrać
					dodatkowe pakiety serwisowe, ubezpieczenie czy ustalić preferencyjną długość wynajmu, bazując na
					odpowiadającej mu, miesięcznej racie. Dowolność konfiguracji jest praktycznie nieograniczona, dzięki
					czemu klient może idealnie dopasować auto do swoich potrzeb i wymagań.</p>

				<p>W ofercie wynajmu długoterminowego Floteo znajdziesz modele takich marek jak Alfa Romeo, Audi, BMW,
					Citroen, Fiat, Ford, Hyundai, Jaguar, Jeep, Kia, Land-Rover, Mazda, Mercedes-Benz, Mitsubishi,
					Nissan, Opel, Renault, Seat, Skoda, Toyota, Volkswagen czy Volvo.</p>

				<h2>Dla kogo przeznaczony jest wynajem długoterminowy?</h2>

				<p>Wynajem długoterminowy jest idealną opcją dla osób lub firm, które nie chcą zaciągać kredytu na zakup
					auta lub z jakiegoś powodu nie mają aktualnie możliwości zakupu auta na kredyt lub za gotówkę.
					Długoterminowy wynajem nie powoduje nadszarpnięcia płynności finansowej i jest opcją dużo mniej
					obciążającą budżet niż zakup nowego auta z płatnością całej kwoty z góry.</p>

				<p>Przy założeniu stałej i regularnej zmiany auta co 2-3 lata, a także w przypadku bez zainteresowania
					opcją wykupu po okresie trwania umowy, wynajem długoterminowy wydaje się być najlepszym
					rozwiązaniem.</p>

				<h2>Zalety długoterminowego wynajmu aut</h2>

				<p>Podstawową zaletą jest możliwość dowolnego skonfigurowania warunków umowy wynajmu. Wybieramy dowolne
					auto, konfigurujemy jego wyposażenie według własnego uznania, ustalamy długość okresu wynajmu,
					dzięki czemu dopasujemy wysokość miesięcznej opłaty do naszego budżetu.</p>

				<p>W okresie wynajmu jedynym faktycznym kosztem oprócz comiesięcznej opłaty jest paliwo, które
					tankujemy. Nie musimy się martwić resztą opłat za badania techniczne, naprawy, wymiany części czy
					ubezpieczenie. Oto główne zalety wynajmu długoterminowego:</p>

				<ul>
					<li>możliwość dopasowania wysokości wpłaty początkowej, która może wynosić 0 zł, a każde jej
						zwiększenie powoduje zmniejszenie comiesięcznej raty
					</li>
					<li>brak konieczności ponoszenia opłat związanych z przeglądem technicznym samochodu</li>
					<li>atrakcyjne pakiety dodatkowe, jak np. dodatkowy pakiet opon, serwis auta w cenie, obejmujący
						darmowe naprawy i wymianę części
					</li>
					<li>wykup auta po zakończeniu umowy wynajmu nie jest obowiązkowy</li>
					<li>możliwość uwzględnienia kosztów ubezpieczenia OC w comiesięcznej racie, a także dodatkowych
						ubezpieczeń jak AC, Auto Assistance czy ubezpieczenia szyb
					</li>
				</ul>

				<p>Możliwość korzystania z nowego auta jest więc dostępna przy minimalnym wkładzie finansowym, który
					zależy od nas. Jeżeli interesuje nas możliwie niska rata miesięczna, wkład własny musi być większy.
					Możemy również nie wnosić żadnego wkładu, co będzie się wiązać z nieco wyższą miesięczną ratą za
					wynajem długoterminowy auta.</p>

				<h2>Jaki jest koszt wynajmu długoterminowego samochodu?</h2>

				<p>Ostateczny koszt wynajmu zależy od bardzo wielu czynników i jest możliwy do obliczenia za pomocą
					kalkulatora na naszej stronie. Pierwsza kwestia to wybór modelu i marki wypożyczanego samochodu.
					Floteo oferuje pełną gamę modeli, począwszy od bardzo tanich w wynajmie, a także w eksploatacji
					samochodów miejskich, kończąc na bardzo luksusowych autach z kategorii premium. Dzięki tak szerokiej
					ofercie każdy z klientów, niezależnie od budżetu, którym dysponuje, znajdzie idealną ofertę,
					dopasowaną do jego potrzeb i możliwości.</p>

				<p>Na ostateczny koszt wynajmu długoterminowego wpływa przede wszystkim długość umowy. Oczywiście im
					dłuższa umowa, tym miesięczna rata za wynajem jest niższa. Wpłata własna na również pozwala na
					obniżenie miesięcznej raty, ale nie jest wymagana - można wynająć auto bez jakiejkolwiek wpłaty
					własnej.</p>

				<p>Kolejnym elementem, który ma wpływ na ostateczny koszt wynajmu jest roczny limit kilometrów. Jeżeli
					zdecydujemy się na wyższy limit, nasza rata nieznacznie wzrośnie. Oczywiście na ostateczny koszt
					wpłynie konfiguracja auta, jego wyposażenia, pakietów dodatkowych czy ubezpieczenia. Ostateczną
					kwotę w przypadku konfiguracji niestandardowej, dopasowanej idealnie do naszych wymagań otrzymamy po
					kontakcie z doradcą klienta Floteo.</p>

				<h2>Wynajem długoterminowy aut czy leasing - co się bardziej opłaca?</h2>

				<p>Wiele osób bardzo często porównuje wynajem długoterminowy z leasingiem i kalkuluje która opcja jest
					dla niego bardziej opłacalna. Oczywiście obie opcje mają swoje wady i zalety oraz kilka elementów,
					które je różnią.</p>

				<p>Długoterminowy wynajem aut jest formą zbliżoną do leasingu, jednak zawierającą więcej udogodnień dla
					wynajmującego. W trakcie wynajmu mamy możliwość korzystania z napraw, wymiany części, nie ponosząc
					przy tym dodatkowych kosztów, jeżeli taka opcja jest uwzględniona w comiesięcznej racie. Nie musimy
					również ponosić kosztów związanych z ubezpieczeniem, przeglądem czy ewentualną likwidacją szkód.</p>

				<p>Wynajem długoterminowy jest idealny dla osób lub firm, które nie rozważają wykupu po zakończeniu
					wynajmu, tylko planują wynajęcie kolejnego, nowego auta. Umowę wynajmu można precyzyjnie dopasować
					do potrzeb i wymagań finansowych. Aby dokonać rzeczowego porównania obu form finansowania,
					przygotowaliśmy tabelę porównującą wynajem długoterminowy z leasingiem.</p>

				<table class="vs">
					<tr>
						<th></th>
						<th>Wynajem długoterminowy</th>
						<th>Leasing</th>
					</tr>
					<tr>
						<td>Wpłata własna</td>
						<td><strong>0 PLN</strong></td>
						<td><strong>13 300 PLN brutto</strong></td>
					</tr>
					<tr>
						<td>Wysokość raty</td>
						<td><strong>999 PLN netto</strong></td>
						<td><strong>1 820 PLN netto</strong></td>
					</tr>
					<tr>
						<td>Okres kontraktu</td>
						<td>30 miesięcy</td>
						<td>60 miesięcy</td>
					</tr>
					<tr>
						<td>Wartość wykupu</td>
						<td><strong>106 000 PLN brutto</strong></td>
						<td><strong>1 330 PLN brutto</strong></td>
					</tr>
					<tr>
						<td>Serwis w cenie</td>
						<td>TAK</td>
						<td>NIE – 5 x 1000 PLN brutto</td>
					</tr>
					<tr>
						<td>Gwarancja</td>
						<td>24 m-ce<br/>(tylko 6 m-cy bez gwarancji)</td>
						<td>24 m-ce<br/>(większość umowy poza gwarancją)</td>
					</tr>
					<tr>
						<td>Limit przebiegu rocznego</td>
						<td>20 000 KM</td>
						<td>Brak limitu</td>
					</tr>
					<tr>
						<td>Nowy samochód raz na 2,5 roku</td>
						<td>TAK</td>
						<td>NIE</td>
					</tr>
					<tr>
						<td>Suma kosztów dla 60 m-cy</td>
						<td><strong>73 726 PLN brutto</strong></td>
						<td>5 x 1000 PLN brutto serwis, 60 x 2238 PLN brutto rata, 13 300 PLN brutto wpłata własna =
							<strong>152 580 PLN brutto</strong></td>
					</tr>
					<tr>
						<td>Wartość pojazdu po 5 latach</td>
						<td>Nie interesuje nas</td>
						<td>ok. 53 200 PLN brutto (licząc przebieg rzędu 20 000 km/rok)</td>
					</tr>
					<tr>
						<td>Bilans końcowy po sprzedaży pojazdu</td>
						<td><strong class="red">- 73 726 PLN brutto</strong> – nie musimy sprzedawać, tyle wynosi koszt
							obsługi umowy przez 5 lat
						</td>
						<td>Wydaliśmy 152 580 PLN brutto na obsługę umowy, odzyskujemy 53 200 PLN brutto ze sprzedaży
							pojazdu = <strong class="red">- 99 380 PLN brutto</strong> kosztowało nas "posiadanie
							samochodu przez 5 lat
						</td>
					</tr>
				</table>
				<p>Przykład dla samochodu Opel Insignia, o wartości katalogowej 133 000 PLN</p>

				<p>Z powyższego przykładu wynika, że leasing może się opłacać bardziej wyłącznie przy założeniu, że
					pokonujemy samochodem o wiele więcej niż 20 000 kilometrów rocznie (60 000 km i więcej). W każdym
					innym przypadku bardziej opłacalny jest wynajem długoterminowy. Wystarczy spojrzeć na bilans końcowy
					w tabeli i wziąć pod uwagę fakt, że w przypadku wynajmu użytkowalibyśmy przez 5 lat dwa nowe auta po
					2,5 roku każde, natomiast w leasingu przez 5 lat posiadalibyśmy to samo auto.</p>

				<h2>Wynajem długoterminowy a koszty i odliczenie od podatku</h2>

				<p>Wiele osób zastanawia się nad możliwością odliczenia kosztów wynajmu auta od podatku. Oczywiście jest
					to możliwe. W 2019 roku mamy możliwość odliczenia 100% opłaty wstępnej i 100% miesięcznej opłaty za
					wynajem. Górna granica to 150 000 PLN netto. W przypadku aut droższych niż wspomniana suma do
					kosztów uzyskania przychodu będziemy mogli zaliczyć maksymalnie 150 000 PLN netto.</p>

				<p>Jeżeli samochód będzie wykorzystywany wyłącznie do celów firmowych, wydatek eksploatacyjny w postaci
					paliwa będzie możliwy do odliczenia w 100%. Jeżeli natomiast auto będzie wykorzystywane zarówno do
					celów firmowych jak i prywatnych, będziemy mogli zaliczyć 75% kosztów paliwa w koszty uzyskania
					przychodów.</p>

				<h2>Wynajem długoterminowy a samochody na abonament – czym się różnią?</h2>

				<p>Coraz częściej w mediach słyszy się o samochodach na abonament. Nazwa może sugerować zupełnie nowe
					rozwiązanie z kategorii finansowania pojazdów, jednakże to nic innego, jak klasyczny wynajem
					długoterminowy pojazdów (leasing operacyjny z wysoką wartością wykupu), lecz w nowym, modnym
					opakowaniu. Podsumowując: zarówno wynajem długoterminowy, jak i samochody w abonamencie, to
					dokładnie ta sama forma finansowania pojazdu, różniąca się jedynie nomenklaturą. </p>

				<h2>Wynajem długoterminowy - cennik</h2>

				<p>Podstawowy cennik wynajmu długoterminowego jest dostępny na naszej stronie pod każdym modelem auta.
					Cena bazowa zakłada brak wpłaty własnej, limit kilometrów 20000 rocznie oraz 36-miesięczny okres
					wynajmu. W cenie zawarty jest serwis, który jest dostępny przez cały okres trwania umowy. Tak jak
					wspominaliśmy wcześniej, ostateczną cenę za wynajem może zmienić dodatkowa konfiguracja np.
					wydłużenie lub skrócenie okresu wynajmu, wpłata własna, zwiększenie limitu kilometrów, a także
					dodatki typu pakiet opon czy ubezpieczenie. Cennik wynajmu długoterminowego może ulec zmianie. Na
					bieżąco aktualizujemy ceny wynajmu na naszej stronie internetowej.</p>

				<p>Jeżeli jesteś zainteresowany wynajmem, zapraszamy do kontaktu z naszym pracownikiem.</p>

				<div style="margin-top: 20px;" class="yasr-container-custom-text-and-overall"><span
						id="yasr-custom-text-before-overall"></span>

					<div class="yasr-overall-rating">
						<div class="yasr-rater-stars star-rating" id="yasr-overall-rating-rater-f5cbd90536386"
							 data-rating="5" data-rater-starsize="16"
							 style="width: 80px; height: 16px; background-size: 16px auto;">
							<div class="star-value" style="background-size: 16px auto; width: 100%;"></div>
						</div>
					</div>
				</div>

				<script type="application/ld+json">
					{"@context":"http:\/\/schema.org\/","@type":"Product","name":"Wynajem długoterminowy samochodów","Review":{"@type":"Review","name":"Wynajem długoterminowy samochodów","author":{"@type":"Person","name":"Floteo"},"datePublished":"2018-12-09T22:25:34+00:00","reviewRating":{"@type":"Rating","ratingValue":"5"}}}
				</script>

			</div>
		</div>
	</div>
<?php } ?>
<?php get_footer();
