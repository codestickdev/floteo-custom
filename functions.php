<?php
/**
 * Floteo Custom functions and definitions
 */
if (!function_exists('floteo_custom_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function floteo_custom_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Floteo Custom, use a find and replace
		 * to change 'floteo-custom' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('floteo-custom', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(array(
			'menu-1' => esc_html__('Primary', 'floteo-custom'),
		));

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));

		// Set up the WordPress core custom background feature.
		add_theme_support('custom-background', apply_filters('floteo_custom_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		)));

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 */
		add_theme_support('custom-logo', array(
			'height' => 250,
			'width' => 250,
			'flex-width' => true,
			'flex-height' => true,
		));
	}
endif;
add_action('after_setup_theme', 'floteo_custom_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function floteo_custom_content_width()
{
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters('floteo_custom_content_width', 640);
}

add_action('after_setup_theme', 'floteo_custom_content_width', 0);

/**
 * Register widget area.
 */
function floteo_custom_widgets_init()
{
	register_sidebar(array(
		'name' => esc_html__('Sidebar', 'floteo-custom'),
		'id' => 'sidebar-1',
		'description' => esc_html__('Add widgets here.', 'floteo-custom'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
}

add_action('widgets_init', 'floteo_custom_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function floteo_custom_scripts()
{
	// wp_enqueue_style('floteo-custom-style', get_stylesheet_uri());

	wp_enqueue_style('jquery-ui-css', get_stylesheet_directory_uri() . '/css/jquery-ui.min.css');
	wp_enqueue_script('jquery-ui', get_template_directory_uri() . '/js/jquery-ui.min.js', array('jquery'), '', true);
	wp_enqueue_script('cookie-js', get_template_directory_uri() . '/js/jquery.cookie.js', array('jquery'), '', true);

	wp_enqueue_style('style-css', get_stylesheet_directory_uri() . '/css/style.css?v=20190776');

	wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=latin-ext');

	wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '', true);

	// Slick
	wp_enqueue_style('Lightbox2-css', get_stylesheet_directory_uri() . '/plugins/slick/slick-theme.css');
	wp_enqueue_script('slick-js', get_template_directory_uri() . '/plugins/slick/slick.min.js', array('jquery'), '', true);

	wp_enqueue_script('input-slider-js', get_template_directory_uri() . '/js/bootstrap-slider.js', array('jquery'), '', true);

	//wp_enqueue_script( 'custom-js', get_template_directory_uri() . '/js/custom-min.js', array('jquery'), '', true );
	wp_enqueue_script('custom-js-non-min', get_template_directory_uri() . '/js/custom.js', array('jquery'), '1.981191111225978', true);

	// wp_enqueue_script('select2js', get_template_directory_uri() . '/js/select2.min.js', array('jquery', 'custom-js-non-min'), '1.15', true);
	// wp_enqueue_style('select2css', get_stylesheet_directory_uri() . '/css/select2.min.css');

	//Fa Icons
	wp_enqueue_style('fa-icons-css', 'https://use.fontawesome.com/releases/v5.7.2/css/all.css');

	//Lightbox2
	wp_enqueue_style('Lightbox2-css', get_stylesheet_directory_uri() . '/css/lightbox.css');
	wp_enqueue_script('Lightbox2-js', get_template_directory_uri() . '/js/lightbox.js', array('jquery'), '', true);

	// Product page
	wp_enqueue_script('product-page', get_template_directory_uri() . '/js/_productPage.js', array('jquery'), '', true);

	//Multiselect
	// wp_enqueue_style('Lightbox2-css', get_stylesheet_directory_uri() . '/plugins/multiselect/css/example-styles.css');
	// wp_enqueue_script('Lightbox2-js', get_template_directory_uri() . '/plugins/multiselect/js/jquery.multi-select.js', array('jquery'), '', true);

}

add_action('wp_enqueue_scripts', 'floteo_custom_scripts');

function replace_core_jquery_version()
{
	wp_deregister_script('jquery');
	// Change the URL if you want to load a local copy of jQuery from your own server.
	wp_register_script('jquery', "https://code.jquery.com/jquery-2.1.3.min.js", array(), '2.1.3');
}

add_action('wp_enqueue_scripts', 'replace_core_jquery_version');


// Wynajem dlugoterminowy CPT
add_action('init', 'create_post_type');
function create_post_type()
{
	register_post_type('wynajem',
		array(
			'labels' => array(
				'name' => __('Wynajem długoterminowy'),
				'singular_name' => __('Wynajem długoterminowy')
			),
			'public' => true,
			'has_archive' => false,
			'menu_icon' => 'dashicons-feedback',
			'rewrite' => array('slug' => 'wynajem-dlugoterminowy'),
			'hierarchical' => true,
			'supports' => array(
				'title',
				'editor',
				'thumbnail',
				'revisions',
				'page-attributes',
			),
			'taxonomies' => array(
				'category'
			),
		)
	);

	register_post_type('wynajem-krotko',
		array(
			'labels' => array(
				'name' => __('Wynajem krótkoterminowy'),
				'singular_name' => __('Wynajem krótkoterminowy')
			),
			'public' => true,
			'has_archive' => false,
			'menu_icon' => 'dashicons-feedback',
			'rewrite' => array('slug' => 'wynajem-krotkoterminowy'),
			'supports' => array(
				'title',
				'editor',
				'thumbnail',
			),
			'taxonomies' => array(
				'category'
			),
		)
	);
}


function reformat_auto_p_tags($content)
{
	$new_content = '';
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);
	foreach ($pieces as $piece) {
		if (preg_match($pattern_contents, $piece, $matches)) {
			$new_content .= $matches[1];
		} else {
			$new_content .= wptexturize(wpautop($piece));
		}
	}

	return $new_content;
}

remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');

add_filter('the_content', 'reformat_auto_p_tags', 99);
add_filter('widget_text', 'reformat_auto_p_tags', 99);


// Turn on ACF admin panel at Wordpress admin panel
if (function_exists('acf_add_options_page')) {
	if (is_admin()) {
		acf_add_options_page(array('page_title' => "Theme settings"));
	}
}

remove_filter('the_content', 'wpautop');
add_filter('the_content', 'wpautop', 12);

function floteo_box_func($atts)
{

	$a = shortcode_atts(array(
		'category-name' => '',
	), $atts);
	if (empty($a['category-name'])) {
		return "No category_name specified";
	}
	$category_name = $a['category_name'];

	ob_start();
	$loop = new WP_Query(array('post_type' => 'wynajem', 'orderby' => 'post_id', 'order' => 'ASC', 'posts_per_page' => 3, 'category_name' => $category_name, 'meta_query' => array(
		array(
			'key' => 'niedostepny',
			'compare' => '=',
			'value' => '0'
		)
	)));
	$count = $loop->post_count; ?>
	<?php if ($loop->have_posts()) : ?>
	<div class="custom-slide car_tiles" data-number="<?php echo $count; ?>">
		<?php while ($loop->have_posts()) : $loop->the_post(); ?>
			<div style="margin:0 10px!important" <?php post_class('tile move-title'); ?>
				 data-price-max="<?php the_field('cena_48msc_-_20%_-_20000') ?>"
				 data-price-min="<?php the_field('cena_24msc_-_0%_-_40000') ?>"
				 data-mark="<?php the_field('dane_techniczne_marka') ?>"
				 data-body="<?php the_field('dane_techniczne_nadwozie') ?>"
				 data-fuel="<?php echo get_field('dane_techniczne_paliwo')['value']; ?>"
				 data-gearbox="<?php the_field('dane_techniczne_skrzynia_biegow') ?>">
				<div class="tile__data">
					<div class="tile__price">
						<div class="tile__price-value"><?php the_field('domyslna_wycena_kwota') ?></div>
						<div class="tile__price-currency">PLN/mc</div>
					</div>
					<div class="tile__name-wrap">
						<h4 class="tile__name" title="<?php the_title(); ?>"><?php the_title(); ?></h4>
					</div>
					<div class="tile__features">
						&nbsp;
					</div>
					<a href="<?php the_permalink(); ?>" class="bttn --secondary tile__btn">Sprawdź ofertę</a>
				</div>
				<div class="tile__thumb">
					<div class="tile__image">
						<?php if (has_post_thumbnail()) : ?>
							<div class="tile__thumb-item"
								 style="background-image: url('<?php the_post_thumbnail_url("medium"); ?>')"></div>
						<?php else: ?>
							<div class="tile__thumb-item empty"></div>
						<?php endif; ?>
					</div>
					<div class="tile__cats">
						<?php if (in_category('od-reki')) : ?>
							<div class="tile__cat --hand">OD<br>RĘKI!</div><?php endif; ?>
						<?php if (in_category('nowosc')) : ?>
							<div class="tile__cat --new">NEW!</div><?php endif; ?>
						<?php if (in_category('top')) : ?>
							<div class="tile__cat --top">TOP!</div><?php endif; ?>
					</div>
				</div>
			</div>
		<?php endwhile;
		wp_reset_query(); ?>
	</div>
<?php endif;


	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

add_shortcode('floteo_box', 'floteo_box_func');


add_action('init', 'customRSS');
function customRSS()
{
	add_feed('cars', 'customRSSFunc');
}

function customRSSFunc()
{
	get_template_part('rss', 'cars');
	exit;
}

include_once('includes/calc_shortcode.php');

// API

function calc_models_api_func($data)
{

	$crm_data = getCrmData();
	$crm_models = array();
	if (!empty($crm_data)) {
		foreach ($crm_data as $crm_record) {
			if ($crm_record->id == $data['id']) {
				$crm_models = $crm_record->models;
			}
		}
	}

	if (empty($crm_models)) {
		return null;
	}

	$response = array();

	foreach ($crm_models as $post) {
		$response[] = ['name' => $post->name, 'id' => $post->id];
	}

	wp_send_json($response);
}

function calc_calculate_api_func($data)
{

	$oprocentowanie = 5;

	$resp = array();
	$resp['calc_rabat_floteo'] = 0;
	$resp['calc_rata_po_rabacie_floteo'] = 0;
	$resp['calc_rata_z_twoim_rabatem'] = 0;
	$resp['calc_rata_w_abonamencie'] = 0;

	$post = $_POST;

	if (!empty($post['calc_model'])) {
		$calc_model_id = intval($post['calc_model']);

		$crm_model = getCrmModelData(intval($post['calc_marka']), intval($post['calc_model']));

		$calc_model_katalogowa_cena_samochodu = $post['calc_model_katalogowa_cena_samochodu'];
		$calc_model_cena_samochodu_po_rabacie = $post['calc_model_cena_samochodu_po_rabacie'];

		if ($post['calc_stan'] == "używany") {
			$calc_model_cena_samochodu_po_rabacie = $calc_model_katalogowa_cena_samochodu;
		}


		$calc_model_okres_leasingu = $post['calc_model_okres_leasingu'];
		$calc_model_wykup = $post['calc_model_wykup'];
		$calc_model_pierwsza_wplata = $post['calc_model_pierwsza_wplata'];
		#$rabat_floteo_perc = get_field('rabat',$calc_model_id);
		$rabat_floteo_perc = $crm_model->discount;


		$resp['calc_rabat_client_perc'] = round((($calc_model_katalogowa_cena_samochodu - $calc_model_cena_samochodu_po_rabacie) * 100) / $calc_model_katalogowa_cena_samochodu, 2);

		$resp['calc_rabat_client'] = max($calc_model_katalogowa_cena_samochodu - $calc_model_cena_samochodu_po_rabacie, 0);


		$resp['calc_rabat_floteo_perc'] = $rabat_floteo_perc;
		$resp['calc_rabat_floteo'] = round($rabat_floteo_perc / 100 * $calc_model_katalogowa_cena_samochodu, 2);


		#$dane_abonamentow = get_field('dane_abonamentow',$calc_model_id);
		//$rata_abonamentu = $dane_abonamentow['rata_abonamentu'];
		$rata_abonamentu = $crm_model->installment;

		$resp['calc_rata_w_abonamencie_netto'] = $rata_abonamentu;
		$resp['calc_rata_w_abonamencie'] = round(($rata_abonamentu + (23 / 100 * $rata_abonamentu)), 2);


		$params = array(
			'calc_model_katalogowa_cena_samochodu' => ($calc_model_katalogowa_cena_samochodu - $resp['calc_rabat_floteo']),
			'calc_model_okres_leasingu' => $calc_model_okres_leasingu,
			'calc_model_wykup' => $calc_model_wykup,
			'calc_model_pierwsza_wplata' => $calc_model_pierwsza_wplata,
			'oprocentowanie' => $oprocentowanie
		);
		$rata2 = calc_calulate_rate($params);


		$params = array(
			'calc_model_katalogowa_cena_samochodu' => $calc_model_cena_samochodu_po_rabacie,
			'calc_model_okres_leasingu' => $calc_model_okres_leasingu,
			'calc_model_wykup' => $calc_model_wykup,
			'calc_model_pierwsza_wplata' => $calc_model_pierwsza_wplata,
			'oprocentowanie' => $oprocentowanie
		);
		$rata_rata_z_twoim_rabatem = calc_calulate_rate($params);

		$resp['calc_rata_po_rabacie_floteo'] = $rata2['rata'];
		$resp['calc_rata_z_twoim_rabatem'] = $rata_rata_z_twoim_rabatem['rata'];

		$resp['calc_rata_po_rabacie_floteo_netto'] = round($rata2['rata'] / 1.23, 2);
		$resp['calc_rata_z_twoim_rabatem_netto'] = round(($rata_rata_z_twoim_rabatem['rata'] / 1.23), 2);


		//$resp['calc_abonament_oplata_wstepna']=$dane_abonamentow['wplata']."%";
		//$resp['calc_abonament_ilosc_rat']=$dane_abonamentow['okres_abonamentu'];
		//$resp['calc_abonament_informacje']=$dane_abonamentow['informacje'];


		$resp['calc_abonament_oplata_wstepna'] = $crm_model->payment . "%";
		$resp['calc_abonament_ilosc_rat'] = $crm_model->period;
		$resp['calc_abonament_informacje'] = $crm_model->description;

	}
	wp_send_json($resp);

}


function calc_calulate_rate($data)
{

	$calc_model_katalogowa_cena_samochodu = $data['calc_model_katalogowa_cena_samochodu'];
	$calc_model_okres_leasingu = $data['calc_model_okres_leasingu'];
	$calc_model_wykup = $data['calc_model_wykup'];
	$calc_model_pierwsza_wplata = $data['calc_model_pierwsza_wplata'];
	$oprocentowanie = $data['oprocentowanie'];
	$ile_rat_w_roku = 12;
	$ilosc_rat = intval($calc_model_okres_leasingu / 12) * 12;
	$wykup_kwota = round(($calc_model_wykup / 100) * $calc_model_katalogowa_cena_samochodu, 2);
	$oplata_wstepna = round(($calc_model_pierwsza_wplata / 100) * $calc_model_katalogowa_cena_samochodu, 2);
	$oproc_okr = ($oprocentowanie / 100) / 12;
	$wartosc_po_opłacie_wst = $calc_model_katalogowa_cena_samochodu - $oplata_wstepna;

	// =(B13-(B10/((1+B12)^B9)))/((1-(1/((1+B12)^B9)))/B12)

	$rata = ($wartosc_po_opłacie_wst - ($wykup_kwota / ((1 + $oproc_okr) ** $ilosc_rat))) / ((1 - (1 / ((1 + $oproc_okr) ** $ilosc_rat))) / $oproc_okr);


	$resp['ilosc_rat'] = $ilosc_rat;
	$resp['wykup_kwota'] = $wykup_kwota;
	$resp['oplata_wstepna'] = $oplata_wstepna;
	$resp['oproc_okr'] = $oproc_okr;
	$resp['wartosc_po_opłacie_wst'] = $wartosc_po_opłacie_wst;
	$resp['rata'] = round($rata, 2);
	return $resp;
}


function getCrmModelData($marka, $model)
{
	$crm_data = getCrmData();
	if (!empty($crm_data)) {
		foreach ($crm_data as $crm_record) {
			if ($crm_record->id == $marka) {
				$crm_models = $crm_record->models;
				foreach ($crm_models as $crm_model) {
					if ($crm_model->id == $model) {
						return $crm_model;
					}
				}
			}
		}
	}

	return null;
}

function getCrmData()
{
	$url = "http://crm.floteocars.pl/api/calculator.json?";
	$response = wp_remote_get($url);

	if (is_array($response)) {
		$body = $response['body'];
		$body = json_decode($body);

		return $body;
	}

	return null;
}

function calc_update_api_func()
{
	set_time_limit(0);
	$debug = true;
	$url = "http://crm.floteocars.pl/api/calculator.json?";
	$response = wp_remote_get($url);

	if (is_array($response)) {
		$body = $response['body'];
		$body = json_decode($body);

		if (!empty($body)) {
			foreach ($body as $record) {
				if (!empty($record->models)) {
					$category_slug = strtolower($record->name);
					$category = get_term_by('slug', $category_slug, 'calc_marka-samochodu');

					if (empty($category)) {
						$term = wp_insert_term(
							$record->name,
							'calc_marka-samochodu'
						);

						$category = get_term_by('slug', $category_slug, 'calc_marka-samochodu');
					}

					if (!empty($category)) {
						foreach ($record->models as $model) {
							$options = array(
								'posts_per_page' => -1,
								's' => $model->name,
								'post_type' => 'calc_model',
								'post_status' => 'publish',
								'tax_query' => array(
									array(
										'taxonomy' => 'calc_marka-samochodu',
										'field' => 'term_id',
										'terms' => $category->term_id
									)
								)
							);
							$posts = get_posts($options);

							if (empty($posts)) {
								$post_status = "publish";

								$my_post = array(
									'post_title' => $model->name,
									'post_content' => "",
									'post_status' => $post_status,
									'post_category' => array($_POST['cat']),
									'post_type' => 'calc_model'
								);

								$post_id = wp_insert_post($my_post);


								wp_set_object_terms($post_id, $category->term_id, 'calc_marka-samochodu');

								$posts = get_posts($options);
							}


							if (!empty($posts)) {
								foreach ($posts as $post) {

									if (strtolower($post->post_title) == strtolower($model->name)) {
										$id = $post->ID;

										if ($debug) {
											echo "Aktualizuje: " . $category_slug . " " . $model->name . "\n";
											echo "";
										}
										$discount = $model->discount;
										$installment = $model->installment;
										$period = $model->period;
										$payment = $model->payment;
										$description = $model->description;

										update_field('rabat', $discount, $id);
										update_field('dane_abonamentow_rata_abonamentu', $installment, $id);
										update_field('dane_abonamentow_okres_abonamentu', $period, $id);
										update_field('dane_abonamentow_wplata', $payment, $id);
										update_field('dane_abonamentow_informacje', $description, $id);
									}
								}
							}
						}
					}
				}
			}
		}
	}
	exit;
}

add_action('rest_api_init', function () {
	register_rest_route('floteocars/v1', '/calc_models/(?P<id>\d+)', array(
		'methods' => 'GET',
		'callback' => 'calc_models_api_func',
	));
});

add_action('rest_api_init', function () {
	register_rest_route('floteocars/v1', '/calc_calculate', array(
		'methods' => 'POST',
		'callback' => 'calc_calculate_api_func',
	));
});


function cars_api_func()
{
	$loop = new WP_Query(array('post_type' => 'wynajem', 'orderby' => 'post_id', 'order' => 'ASC',
		'meta_query' => array(
			array(
				'key' => 'niedostepny',
				'compare' => '=',
				'value' => '0'
			)
		)));


	header("Content-Type: text/csv");
	header("Content-Disposition: attachment; filename=cars.csv");

	$output = fopen("php://output", "wb");

	$posts = $loop->posts;

	$headers = array('id', 'availability', 'title', 'description', 'link', 'image_link', 'price', 'year', 'make', 'model', 'vehicle_type', 'body_style', 'fuel_type', 'condition', 'google_product_category');

	fputcsv($output, $headers);

	foreach ($posts as $post) {
		$row = array();
		$row[] = $post->ID;
		$row[] = "in stock";
		$row[] = get_the_title($post);
		$row[] = get_the_title($post);
		$row[] = get_the_permalink($post);
		$row[] = get_the_post_thumbnail_url($post->ID, 'full');
		$row[] = get_field('domyslna_wycena_kwota', $post->ID);
		$row[] = get_field('dane_techniczne_rocznik', $post->ID);
		$row[] = get_field('dane_techniczne_marka', $post->ID);
		$row[] = get_field('dane_techniczne_model', $post->ID);
		$row[] = "CAR";
		$row[] = get_field('dane_techniczne_nadwozie', $post->ID);
		$row[] = get_field('dane_techniczne_paliwo', $post->ID)['label'];
		$row[] = "new";
		$row[] = "Vehicles & Parts > Vehicles > Motor Vehicles > Cars";
		fputcsv($output, $row);

	}
	fclose($output);
	exit;

}

add_action('rest_api_init', function () {
	register_rest_route('floteocars/v1', '/cars', array(
		'methods' => 'GET',
		'callback' => 'cars_api_func',
	));
});

add_theme_support('yoast-seo-breadcrumbs');

/*
add_action('init', function () {
	add_rewrite_rule('^wynajem-dlugoterminowy/audi?',
		'index.php?p=35',
		'top');
}, 10, 0);
*/
add_filter('rewrite_rules_array', 'wp_insertMyRewriteRules');
add_filter('query_vars', 'wp_insertMyRewriteQueryVars');

function wp_insertMyRewriteRules($rules)
{
	$newrules = array();
	$newrules['wynajem-dlugoterminowy/audi$'] = 'index.php?pagename=wynajem-dlugoterminowy&mark_page=1&searchMark%5B%5D=Audi';
	$newrules['wynajem-dlugoterminowy/bmw$'] = 'index.php?pagename=wynajem-dlugoterminowy&mark_page=1&searchMark%5B%5D=BMW';
	$newrules['wynajem-dlugoterminowy/alfa_romeo$'] = 'index.php?pagename=wynajem-dlugoterminowy&mark_page=1&searchMark%5B%5D=Alfa-Romeo';
	$newrules['wynajem-dlugoterminowy/toyota$'] = 'index.php?pagename=wynajem-dlugoterminowy&mark_page=1&searchMark%5B%5D=Toyota';
	$newrules['wynajem-dlugoterminowy/mercedes_benz$'] = 'index.php?pagename=wynajem-dlugoterminowy&mark_page=1&searchMark%5B%5D=Mercedes-Benz';
	$newrules['wynajem-dlugoterminowy/lexus$'] = 'index.php?pagename=wynajem-dlugoterminowy&mark_page=1&searchMark%5B%5D=Lexus';
	$newrules['wynajem-dlugoterminowy/opel$'] = 'index.php?pagename=wynajem-dlugoterminowy&mark_page=1&searchMark%5B%5D=Opel';
	$newrules['wynajem-dlugoterminowy/fiat$'] = 'index.php?pagename=wynajem-dlugoterminowy&mark_page=1&searchMark%5B%5D=Fiat';
	$newrules['wynajem-dlugoterminowy/ford$'] = 'index.php?pagename=wynajem-dlugoterminowy&mark_page=1&searchMark%5B%5D=Ford';
	$newrules['wynajem-dlugoterminowy/jaguar$'] = 'index.php?pagename=wynajem-dlugoterminowy&mark_page=1&searchMark%5B%5D=Jaguar';
	$newrules['wynajem-dlugoterminowy/kia$'] = 'index.php?pagename=wynajem-dlugoterminowy&mark_page=1&searchMark%5B%5D=Kia';
	$newrules['wynajem-dlugoterminowy/mazda$'] = 'index.php?pagename=wynajem-dlugoterminowy&mark_page=1&searchMark%5B%5D=Mazda';
	$newrules['wynajem-dlugoterminowy/nissan$'] = 'index.php?pagename=wynajem-dlugoterminowy&mark_page=1&searchMark%5B%5D=Nissan';
	$newrules['wynajem-dlugoterminowy/land_rover$'] = 'index.php?pagename=wynajem-dlugoterminowy&mark_page=1&searchMark%5B%5D=Land-Rover';
	$newrules['wynajem-dlugoterminowy/renault$'] = 'index.php?pagename=wynajem-dlugoterminowy&mark_page=1&searchMark%5B%5D=Renault';
	$newrules['wynajem-dlugoterminowy/skoda$'] = 'index.php?pagename=wynajem-dlugoterminowy&mark_page=1&searchMark%5B%5D=Skoda';
	$newrules['wynajem-dlugoterminowy/volkswagen$'] = 'index.php?pagename=wynajem-dlugoterminowy&mark_page=1&searchMark%5B%5D=Volkswagen';
	$newrules['wynajem-dlugoterminowy/volvo$'] = 'index.php?pagename=wynajem-dlugoterminowy&mark_page=1&searchMark%5B%5D=Volvo';

	return $newrules + $rules;
}

function wp_insertMyRewriteQueryVars($vars)
{
	array_push($vars, 'mark_page');
	array_push($vars, 'searchMark');
	return $vars;
}

function yoast_seo_canonical_change_marks($canonical)
{
	$mark = get_query_var('searchMark');
	if (!empty($mark)) {
		$page = get_permalink(get_page_by_path('wynajem-dlugoterminowy'));
		$canonical = $page . strtolower($mark[0]) . '/';
	}
	return $canonical;
}

add_filter('wpseo_canonical', 'yoast_seo_canonical_change_marks', 10, 1);

function yoast_seo_title_change_marks($title)
{
	$mark = get_query_var('searchMark');
	if (!empty($mark)) {
		if($mark[0] === 'Skoda'){
			$markName = "Škoda Auto";
		}else if ($mark[0] === 'Kia'){
			$markName = "Kia Motors";
		}else{
			$markName = $mark[0];
		}
		$title = "Wynajem długoterminowy " . $markName . " - Floteo";
	}
	return $title;
}

add_filter('wpseo_title', 'yoast_seo_title_change_marks');

function slugify($text)
{
  // replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);
  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);
  // trim
  $text = trim($text, '-');
  // remove duplicate -
  $text = preg_replace('~-+~', '-', $text);
  // lowercase
  $text = strtolower($text);
  if (empty($text)) {
    return 'n-a';
  }
  return $text;
}

