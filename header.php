<?php
/**
 * The header for our theme
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo home_url() ?>/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo home_url() ?>/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo home_url() ?>/favicon-16x16.png">
	<link rel="manifest" href="<?php echo home_url() ?>/site.webmanifest">
	<link rel="mask-icon" href="<?php echo home_url() ?>/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
	<meta name="google-site-verification" content="9n-FGnu4Wz3nbPOFnqbtunBWWxHuheuXR24pFwqrKpI" />
	<script>
		var base_url = '<?php echo get_site_url(); ?>';
		var template_url = '<?php echo get_template_directory_uri(); ?>';
	</script>
	<?php wp_head(); ?>
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-131089560-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-131089560-1');
	</script>

	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
			new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
			j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
			'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-WZ6V34X');</script>
	<!-- End Google Tag Manager -->
</head>
<body <?php body_class(); ?>>
<div class="searchOverlay"></div>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WZ6V34X"
				  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<nav class="navbar <?php if( !is_front_page() ) : ?> subpage<?php endif; ?>">
  <div class="container">
    <div class="navbar-header">
      	<a class="navbar-brand" href="<?php echo home_url(); ?>/">
      		<img src="<?php bloginfo('template_directory') ?>/img/logo.svg" alt="Floteo">
		  </a>
		<div class="navbar__contact">
			<a href="tel:+48552133459" class="navbar__phone"><span>+48 552 133 459</span></a>
			<a href="mailto:kontakt@floteocars.pl" class="navbar__mail"><span>kontakt@floetocars.pl</span></a>
		</div>
		<button type="button" class="hamburger hamburger--squeeze hamburger_nav">
			<span class="hamburger-box">
				<span class="hamburger-inner"></span>
			</span>
		</button>
    </div>
		<?php
		wp_nav_menu(array(
			'theme_location'   => 'menu-1',
			'container'        => 'div',
			'depth'            => 1,
			'container_id'     => 'collapse_menu',
			'container_class'  => 'hidden-xs',
			'menu_class'       => 'navbar__links'
		));
		?>
  </div>
</nav>
<main <?php if( !is_front_page() ) : ?> class="subpage_content"<?php endif; ?>>
