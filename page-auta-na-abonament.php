<?php
/*
* Template Name: Auta na abonament
*/

session_start();

$searchMark = $_GET['searchMark'];
$searchModel = $_GET['searchModel'];
$searchBody = $_GET['searchBody'];
$searchFuel = $_GET['searchFuel'];
$searchGearbox = $_GET['searchGearbox'];
$searchPriceMin = $_GET['searchPriceMin'];
$searchPriceMax = $_GET['searchPriceMax'];

function getIcon($type){
	switch($type){
		case "hatchback":
			return "<img class='svg' src='".get_template_directory_uri()."/img/floteo_search_hatchback.svg'>";
		case "sedan":
			return "<img class='svg' src='".get_template_directory_uri()."/img/floteo_search_sedan.svg'>";
		case "kombi":
			return "<img class='svg' src='".get_template_directory_uri()."/img/floteo_search_kombi.svg'>";
		case "crossover":
			return "<img class='svg' src='".get_template_directory_uri()."/img/floteo_search_crossover.svg'>";
		case "suv":
			return "<img class='svg' src='".get_template_directory_uri()."/img/floteo_search_suv.svg'>";
		case "dostawcze":
			return "<img class='svg' src='".get_template_directory_uri()."/img/floteo_search_dostawczy.svg'>";
	}
}

get_header(); ?>

<section class="container-fluid subpage_search">
	<div class="container">
		<?php include('_include-floteo-search-auta.php'); ?>
	</div>
</section>

<div class="bestseller__head container-fluid">Bestsellery</div>
<section class="container-fluid bestseller__wrap">
	<?php 
		$bestLoop = new WP_Query( array( 'post_type'=>'wynajem', 'orderby'=>'post_id', 'order'=>'ASC', 'orderby'=>'rand', 'posts_per_page'=> 3, 'category_name'=>'bestsellery','meta_query' => array(
			array(
				'key' => 'niedostepny',
				'compare' => '=',
				'value' => '0'
			)
		)));

		while ( $bestLoop->have_posts() ) : $bestLoop->the_post(); 
	?>
			<a href="<?php the_permalink(); ?>" class="bestseller__item move-title">
					<div class="tile__data">
            	<div class="tile__name-wrap">
								<h4 class="tile__name" title="<?php the_title(); ?>"><?php the_title(); ?></h4>
							</div>
							<div class="tile__price">
								<div class="tile__price-value"><?php the_field('domyslna_wycena_kwota') ?></div>
								<div class="tile__price-currency">PLN/mc</div>
							</div>
						<div class="tile__body">
							<?php echo getIcon(get_field('dane_techniczne_nadwozie')); ?>
							<?php the_field('dane_techniczne_nadwozie') ?>
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
						</div>
			</a>
	<?php
		endwhile; wp_reset_query();
	?>
	<div class="bestseller__item --margin"></div>
</section>

<?php
	$loop = new WP_Query( 
		array( 
			'post_type'=>'wynajem', 
			'orderby'=>'post_id', 
			'order'=>'ASC',
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

<section class="container sort_settings">
	<div class="row">
		<div class="col-xs-12">
			<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>
			<h1 class="sort__settings-title">Auta na abonament</h1>
		</div>
		<div class="col-xs-12">
			<p class="sort__settings-text">
				Jednym z najlepszych rozwiązań nowoczesnych dla osób, które chcą posiadać nowy samochód, ale jednocześnie nie ponosić na starcie pełnego kosztu jego zakupu, jest korzystanie z auta na abonament. Nasza firma, która od zawsze dążyła do stworzenia doskonałych ofert, które byłyby w stanie zaspokoić potrzeby każdego kierowcy, nie mogła przejść obojętnie wobec takiej usługi jak samochód na abonament. Dzisiaj dzięki naszej wyjątkowej ofercie każdy klient Floteo ma okazję wynajęcia samochodu dowolnej klasy, który będzie odpowiadał jego oczekiwaniom.
			</p>
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

<input type="hidden" name="searchMarkInput" value="<?php echo $searchMark; ?>">
<input type="hidden" name="searchModelInput" value="<?php echo $searchModel; ?>">
<input type="hidden" name="searchBodyInput" value="<?php echo $searchBody; ?>">
<input type="hidden" name="searchFuelInput" value="<?php echo $searchFuel; ?>">
<input type="hidden" name="searchGearboxIput" value="<?php echo $searchGearbox; ?>">

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

				$offer = get_field('oferta_dla_klienta');
				if(is_null($offer)){
					$offer = ['firmowy'];
				}
				$isBussiness = in_array('firmowy',$offer);
				$isIndividual = in_array('prywatny',$offer);
			?>
		
			<a href="<?php the_permalink(); ?>" class="tile --archive move-title <?php the_field('dane_techniczne_marka') ?> <?php the_field('dane_techniczne_model') ?> <?php the_field('dane_techniczne_nadwozie') ?> <?php echo get_field('dane_techniczne_paliwo')['value']; ?> <?php the_field('dane_techniczne_skrzynia_biegow') ?>" data-individual="<?php echo $isIndividual; ?>" data-business="<?php echo $isBussiness; ?>" data-price="<?php the_field('domyslna_wycena_kwota') ?>" data-carname="<?php the_title(); ?>" data-hand="<?php if( in_category('od-reki') ) : ?>1<?php endif; ?>" data-best="<?php echo $best;?>">
				<div class="tile-archive__thumb">
					<?php if( has_post_thumbnail() ) : ?>
		      	<div class="thumb" style="background-image: url('<?php the_post_thumbnail_url("medium"); ?>')"></div>
		      <?php else: ?>
		      	<div class="thumb empty"></div>
		      <?php endif; ?>
					<div class="tile-archive__cats">
						<?php if( in_category('od-reki') ) : ?><div class="tile__cat --hand">OD<br>RĘKI!</div><?php endif; ?>
						<?php if( in_category('nowosc') ) : ?><div class="tile__cat --new">NEW!</div><?php endif; ?>
						<?php if( in_category('top') ) : ?><div class="tile__cat --top">TOP!</div><?php endif; ?>
					</div>
				</div>
				<div class="tile-archive__body">
					<div class="tile__price">
						<div class="tile__price-value"><?php the_field('domyslna_wycena_kwota') ?></div>
						<div class="tile__price-currency">PLN/mc</div>
					</div>
					<div class="tile-archive__data">
            	<div class="tile__name-wrap">
								<h4 class="tile__name" title="<?php the_title(); ?>"><?php the_title(); ?></h4>
							</div>
							<div class="tile__features">
								<?php the_field('domyslna_oferta') ?>
							</div>
					</div>
					<?php if( in_category('od-reki') || in_category('nowosc') || in_category('top') ) { ?>
						<div class="tile-archive__body-cats">
							<?php if( in_category('od-reki') ) : ?><div class="tile__cat --hand">OD<br>RĘKI!</div><?php endif; ?>
							<?php if( in_category('nowosc') ) : ?><div class="tile__cat --new">NEW!</div><?php endif; ?>
							<?php if( in_category('top') ) : ?><div class="tile__cat --top">TOP!</div><?php endif; ?>
						</div>
					<?php } ?>
			    <div class="bttn --secondary tile__btn">Sprawdź ofertę</div>
				</div>
			</a>
		<?php endwhile; wp_reset_query(); ?>
		
	</div>

</section>
<div class="container"><div class="row inner">
					<div class="col-md-12">
					
<h2>Czym jest usługa auto w abonamencie?</h2>
<p>Większość z nas miała okazję skorzystania z abonamentu chociaż raz w życiu. Gdy myślimy o tym pojęciu, najczęstsze skojarzenia to abonament za telefon komórkowy. Płacimy go co miesiąc, korzystając w zamian z najnowszego modelu wybranego smartfona. Bardzo istotną cechą nabycia auta w abonamencie istnieje jeszcze ogromna zaleta, a mianowicie oszczędzanie czasu i pieniędzy.</p>

<p>Przede wszystkim, gdy wybraliśmy interesujące nas auto, abonament wykupujemy na określony czas. Długość abonamentu zależy od naszych potrzeb, dlatego możliwe jest wynajęcie samochodu na okres nawet do kilku lat. Przez cały czas korzystania z danego abonamentu nie będziemy musieli powtarzać procedury wynajmu samochodu, która zawsze wiąże się ze spełnieniem określonych formalności.</p>

<p>Należy jednak zwrócić uwagę na to, że czasami pojęcie abonamentu na samochód stosowane jest także do określenia usługi, która pozwala użytkownikom samochodów wynająć go na ograniczoną liczbę przejazdów w ciągu wybranego przedziału czasowego. W tym przypadku chodzi o serwis transportowy, który udostępnia pojazdy na okres od miesiąca do pół roku.</p>
<h2>Auta na abonament: kto na tym najwięcej zyska?</h2>
<p>W dzisiejszych czasach kierowca ma dużo wariantów, które umożliwiają korzystanie z samochodów osobowych. Poza nabyciem nowego lub używanego auta płacąc całą kwotę albo używając kredytu lub pożyczki, istnieją także opcje leasingu, długoterminowego wynajmu samochodu, a także możliwość używania auta w abonamencie. Dlatego, żeby zrozumieć, czy w naszym przypadku usługa taka naprawdę jest opłacalna, należy wziąć pod uwagę następujące scenariusze.</p>

<p>Na przykład, zamierzasz spędzić za granicą dłuższy okres i w Twojej podróży bardzo przydałby się samochód. Auto na abonament w tej sytuacji jest dobrym rozwiązaniem, które pozwoli Ci znacznie obniżyć koszty, którymi obarczony jest krótkoterminowy wynajem aut, a także pozwoli Ci uniknąć czasochłonnego załatwiania formalności wymaganych do zakupu auta, którego tak naprawdę nie zamierzasz używać na stałe.</p>

<p>Jeżeli w danej chwili nie masz możliwości zakupu samochodu, a jest Ci on niezbędny do codziennego życia, dojazdu do pracy, do klientów, samochody w abonamencie mogą być dla Ciebie dobrą alternatywą. Auto na abonament warto rozważyć w sytuacji, w której masz swoje auto, ale niestety w danej chwili nie jest ono sprawne. Auto w abonamencie pozwoli Ci szybko wrócić do wygodnego życia kierowcy, który nie jest uzależniony od transportu publicznego.</p>

<p>Warto także zaznaczyć korzyści z używania auta na abonament dla osób prywatnych i firm, które mają potrzebę dosyć częstego wymieniania aut na nowsze modele. Korzystając z abonamentu, będziesz mógł wynajmować zarówno budżetowe modele aut, jak i najbardziej luksusowe samochody nawet co drugi rok.</p>
<h2>Wybierasz samochód na abonament – skorzystasz z tych zalet</h2>
<p>Oczywiście, podstawową zaletą, na którą może liczyć każda osoba, decydująca się na auto w abonamencie, jest sama możliwość otrzymania dostępu do auta w chwili, kiedy jest on tak przydatny. Nie mniej jednak, dana usługa posiada całą listę korzyści.</p>

<p>Przede wszystkim, wynajmując samochód, abonament, który zamierzasz nabyć, może być oparty o dowolne warunki, które tylko będą odpowiadać Twoim potrzebom. To Ty decydujesz o tym jak długo chcesz korzystać z samochodu i jakie wyposażenie chciałbyś otrzymać. Miesięczna opłata za abonament będzie dopasowana do Twoich potrzeb, więc jeżeli tylko będzie istniała taka potrzeba, będziesz mógł regulować koszty korzystania z auta w abonamencie. Zależnie od Twoich preferencji, możesz pożyczyć samochód bez żadnej opłaty startowej. W tym przypadku opłata ta będzie rozłożona na miesiące, przez które będziesz użytkował samochód. Istnieje także możliwość znacznego obniżenia kosztów miesięcznych. W tym celu możesz zrobić większą wpłatę na początku użytkowania auta.</p>

<p>Oczywiście, jako użytkownik samochodu, na pewno martwisz się o dodatkowe koszty, którymi będzie obarczone wynajęte auto. Abonament jest bardzo wygodną usługą, dlatego Twoim zmartwieniem będzie wyłącznie opłata paliwa. Wszystkie koszty formalne, związane z ubezpieczeniem pojazdu, a także wydatki techniczne za naprawę auta, wymianę jego części albo badania, mogą być uwzględnione w dodatkowych pakietach, oferowanych przez firmę, pożyczającą Tobie samochód. Abonament więc naprawdę pozwoli Ci zaoszczędzić czas poprzez wykupienie pakietów specjalnych obejmujących serwisowanie pojazdu lub korzystanie z dodatkowych ubezpieczeń, na przykład, z Auto Assistance lub AC.</p>

<p>Należy także pamiętać o tym, że nie masz obowiązku wykupu auta na abonament, gdy będzie się kończył okres Twojej umowy. Praktyka taka jest opcjonalna i rzadko stosowana.</p>
<h2>Ile zapłacisz za auto: abonament i jego koszty</h2>
<p>Bez wątpienia, na użytkowanie samochodu wpływa dużo czynników, dlatego oszacowanie opłaty za usługę korzystania z auta na abonament jest procesem złożonym, obejmującym wiele czynników.</p>

<p>Oczywiście, pierwszą kwestią, która będzie wpływała na wartość danej usługi, jest mianowicie sam samochód, który wybierzemy. Im tańszy jest pojazd, tym mniejsze opłaty miesięczne zapłacimy za jego wynajem miesięczny. Tu liczą się marka i model auta. Nasza firma zadbała o to, aby każdy kierowca albo właściciel firmy mógł znaleźć odpowiednie auto dla siebie. Dlatego w naszej ofercie znajdują się bardzo luksusowe modele samochodów, a także budżetowe warianty pojazdów, które nie będą wymagały dużych kosztów w utrzymaniu.</p>

<p>Kolejnym czynnikiem, który bezpośrednio wpływa na wartość usługi, jest okres, przez który zamierzamy użytkować wynajmowane auto. Abonament pozwala nam znacznie zaoszczędzić, gdy wybierzemy dłuższy okres umowy. Ponadto, jak już wcześniej wspomnieliśmy, umowy wynajęcia samochodów uwzględniają opcjonalną wpłatę własną. Wpłata taka nie jest obowiązkowa, jednak jej dokonanie umożliwia zmniejszyć miesięczne opłaty za samochód.</p>

<p>Pod uwagę należy także wziąć takie pojęcie jak roczny limit kilometrów. Jest to liczba kilometrów, której, zgodnie z naszym oszacowaniem, nie przekroczymy w ciągu roku. Istnieją różne opcje do ustalenia danego limitu, jednak reguła jest taka, że zwiększenie limitu podwyższa wartość umowy.</p>

<p>Ponadto, tak jak wspomnieliśmy wcześniej, wybór wyposażenia i konfiguracji samochodu również decyduje o wysokości opłat, które poniesie jego użytkownik. Korzystanie z pakietów dodatkowych oraz ubezpieczenia to kolejny czynnik wpływający na cenę usługi.</p>

<p>Ze względu na powyższe aspekty umowy, różne osoby wybierające ten sam model auta na abonament w identycznym terminie, mogą ostatecznie mieć zróżnicowane kwoty do zapłaty.</p>

<p>Warto również wiedzieć o tym, że Floteo pozwala swoim potencjalnym klientom wybierać dowolną konfigurację umowy, a nawet korzystać z opcji niestandardowych, które można uzgodnić z doradcą klienta.</p>
<h2>Auto w abonamencie i leasing: porównanie popularnych opcji wynajmu długoterminowego</h2>
<p>Zanim na rynku pojawiła się dość nowoczesna usługa, która oferuje firmom, a także osobom fizycznym samochody w abonamencie,  dotychczasowe możliwości korzystania z samochodów, które nie są naszą własnością, były dosyć ograniczone.</p>

<p>Przede wszystkim, osoby, które nie mogły pozwolić sobie na zakup nowego pojazdu, korzystały z kredytów. Jednak, poza częstym problemem wysokiego oprocentowania, zakup auta w kredyt w praktyce nie był dostępny dla wielu ludzi, którzy z różnych przyczyn  nie mogli spełnić warunków kredytowania. Dlatego właśnie przez dłuższy czas jedyną alternatywą dla nich pozostawał leasing.</p>

<p>Faktycznie, leasing można porównać do zakupu auta na raty. Bez wątpienia, leasing jest bardzo korzystną opcją dla każdego, kto natychmiast potrzebuje samochodu, a nie ma możliwości jego zakupu, a szczególnie na tej opcji mogą zyskać przedsiębiorcy, którzy zamierzają wykupić auto użytkowane zgodnie z umową leasingu.</p>

<p>Dzisiaj jednak leasing nie jest jedyną możliwą opcja długoterminowego wynajmu samochodu. Jeżeli nie zamierzasz kupować wynajmowanego auta po zakończeniu umowy, samochód na abonament może okazać się dużo korzystniejszym rozwiązaniem.</p>

<p>W odróżnieniu od leasingu odpowiednio skonfigurowana umowa na auto w abonamencie pozwoli Ci zapomnieć o jakichkolwiek zmartwieniach związanych z dodatkowymi opłatami, którymi zawsze jest obarczone użytkowanie samochodu. A więc, korzystając z auta na abonament, nie musisz martwić się o opłaty związanymi z przeglądami technicznymi samochodu, jego ubezpieczeniem oraz naprawą. Ponadto, jeżeli charakter Twojej działalności, albo Twój styl życia wymaga od Ciebie częstej wymiany samochodów, abonament będzie dla Ciebie wręcz opcją doskonała. Możliwość wymiany samochodu po 2-3 letnim okresie użytkowania w abonamencie to bardzo duża przewaga nad leasingiem.</p>

<p>Biorąc pod uwagę powyższe fakty, a także aktualne ceny danych usług na rynku, można łatwo dostrzec zalety użytkowania samochodu na abonament. Jedynym konkretnym przypadkiem, w którym faktycznie warto skorzystać z leasingu, jest szacowany duży roczny przebieg samochodu, a mianowicie taki, który będzie co najmniej wynosił 60 000 km.</p>
<h2>Czy możliwe jest odliczenie kosztów od podatku w przypadku użytkowania auta na abonament?</h2>
<p>Użytkownicy samochodów, pożyczonych od firm leasingowych, często zyskują na odliczeniu od podatku kosztów związanych z wynajęciem auta. Warto jednak wiedzieć o tym, że możliwość taka również istnieje w przypadku samochodu na abonament.</p>

<p>Na przykład, w 2019 roku istnieje możliwość odliczenia zarówno 100% opłaty miesięcznej, jak i 100% opłaty wstępnej, przy czym górna granica w tym przypadku wynosi 150 000 PLN netto. Odliczenie od podatku także możliwe jest w przypadku kosztów związanych z użyciem paliwa. Firmy, które zdecydowały się na auto na abonament, mogą odliczyć nawet 100% zużytego paliwa, natomiast samochody w abonamencie, użytkowane nie tylko w celach firmowych, ale również na potrzeby prywatne, pozwolą nam odliczyć 75% kosztów zużytego paliwa na rzecz kosztów uzyskania przychodów.</p>
<h2>Auto w abonamencie a wynajem długoterminowy samochodów – na czym polega różnica?</h2>
<p>Do tej pory osoby, które interesowały się możliwością wynajęcia samochodu na dłuższy okres, zazwyczaj spotykały się z usługą leasingu, która nadal jest dosyć popularna. Dzisiaj jednak rynek proponuje również nowe rozwiązania, wśród których znajdziemy ofertę wynajmu długoterminowego, czyli innymi słowy ofertę abonamentu na samochód.</p>

<p>Faktycznie, korzystanie z auta na abonament przebiega na tych samych zasadach co długoterminowy wynajem pojazdu. Mianowicie, możemy korzystać z samochodu przez najbliższe kilka lat, płacąc za tę usługę określoną ratę miesięczną. Umowa typu auto w abonamencie nie wymaga od nas wykupienia pojazdu po skończeniu okresu użytkowania, co właściwie stanowi podstawową różnicę pomiędzy abonamentem a leasingiem. Ponadto, obydwie formy pożyczania samochodów charakteryzują się takimi zaletami jak możliwość korzystania z dodatkowych pakietów, które pokrywają koszty naprawy pojazdu, przeglądów technicznych oraz ubezpieczenia, a także z opcji wynajmu samochodu bez ponoszenia opłaty własnej.</p>

<p>W rzeczywistości, abonament na samochód to po prostu inne określenie długoterminowego wynajmu samochodów, a więc faktycznie można stwierdzić, że te dwie nazwy charakteryzują tę samą usługę.</p>

<p>Warto jednak mieć na uwadze nieliczne firmy, które zaczęły używać określenia abonamentu do usługi, która oferuje zupełnie inne warunki, na których klient może wypożyczyć auto. Abonament w tym przypadku pozwala wypożyczyć samochód na krótszy termin od miesiąca do pół roku, przez który kierowca nie ma stałego dostępu do auta, lecz może korzystać z niego tylko przez określoną w umowie liczbę dni w danym okresie. Oczywiście, tego typu oferta jest przydatna dla osób, które nie chcą przepłacać za jednorazowy przejazd samochodem albo za podróż taksówką. W takim kontekście jednak abonament nie ma nic wspólnego z tradycyjnym sposobem pożyczania samochodu na dłuższy czas, natomiast określenie auto w abonamencie na Polskim rynku najczęściej jest zamiennikiem wynajmu długoterminowego.</p>
<h2>Ile zapłacisz za wynajęte auto: abonament na samochód a koszty usługi</h2>
<p>Floteo posiada podstawowy cennik, na podstawie którego możesz dowiedzieć się o kosztach auta na abonament w standardowych warunkach.</p>

<p>Powyżej możesz znaleźć ofertę samochodów, które dostępne są w różnych kategoriach cenowych. Pod każdym modelem samochodu umieściliśmy aktualne informacje dotyczące wynajmu auta  na okres 36-miesięczny. Przy szacowaniu danych cen zakładaliśmy, że limit kilometrów będzie wynosił 20 000 w skali rocznej, a także do umowy dodaliśmy dostęp do serwisowania pojazdu, z którego klient może korzystać w przeciągu całego trwania umowy bez wnoszenia opłat dodatkowych.</p>

<p>Oczywiście, tak, jak już wspominaliśmy, klient może w dowolny sposób korygować dane warunki użytkowania auta w abonamencie, tym samym podnosząc albo obniżając koszty umowy.</p>

<p>Jeżeli uważasz, że auto w abonamencie jest ciekawą usługą, i mógłbyś na niej skorzystać, zapraszamy do kontaktu z przedstawicielami naszej firmy.</p>
					

</div>
</div></div>

<?php get_footer();
