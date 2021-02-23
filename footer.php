<?php
/**
 * The template for displaying the footer
 */
?>
</main>

<?php include('_include-floteo-search-mobile.php'); ?>

<!-- Modal -->
<div id="disabledModal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body">
				Ten model jest aktualnie niedostępny. <br />
				Sprawdź aktualne oferty innych modeli.

				<br /><br />
				<a href="/wynajem-dlugoterminowy/" class="btn btn_custom">zobacz dostępne modele</a>
			</div>
		</div>

	</div>
</div>

<div class="bttn --big footer__big-button open-find-car">
  <svg viewBox="0 0 128.7 128.7">
    <circle fill="none" stroke="currentColor" stroke-width="9" stroke-miterlimit="10" cx="57.1" cy="57.1" r="52.6"/>
    <path fill="none" stroke="currentColor" stroke-width="9" stroke-miterlimit="10" d="M90.4,57.1c0-18.4-14.9-33.3-33.3-33.3"/>
    <path fill="none" stroke="currentColor" stroke-width="9" stroke-miterlimit="10" d="M125.5,125.5c-1.9-1.9-31.8-31.8-31.8-31.8"/>
  </svg>
  ZNAJDŹ SAMOCHÓD
</div>

<footer>
  <div class="container-fluid footer">
    <div class="footer__row">
      <div class="footer__item">
        <h4 class="footer__head">Menu</h4>
        <?php
    		wp_nav_menu(array(
    			'theme_location'   => 'menu-1',
    			'container'        => 'ul',
    			'depth'            => 1,
    			'menu_class'       => 'footer__list'
    		));
    		?>
      </div>
      <div class="footer__item">
        <h4 class="footer__head">Kontakt</h4>
        <a href="<?php echo get_permalink(19); ?>" class="bttn --transparent footer__button">
          <div class="bttn__icon">
            <svg viewBox="0 0 390.6 392.1">
              <path fill="currentColor" stroke-width="6" stroke-miterlimit="10" d="M80.9,259.6c38.1,45.5,83.9,81.4,136.2,106.7c19.9,9.4,46.6,20.6,76.2,22.6c1.8,0.1,3.6,0.2,5.4,0.2
                  c19.9,0,35.9-6.9,49-21c0.1-0.1,0.2-0.2,0.3-0.4c4.6-5.6,9.9-10.6,15.4-16c3.8-3.6,7.6-7.4,11.3-11.2c17-17.8,17-40.3-0.2-57.5
                  l-48.1-48.1c-8.2-8.5-17.9-13-28.2-13c-10.2,0-20.1,4.5-28.5,12.9l-28.6,28.6c-2.6-1.5-5.4-2.9-7.9-4.2c-3.2-1.6-6.2-3.1-8.8-4.8
                  c-26.1-16.6-49.8-38.2-72.4-65.9c-11.4-14.5-19.1-26.6-24.5-39c7.5-6.8,14.6-13.9,21.4-20.9c2.4-2.5,4.9-5,7.4-7.4
                  c8.6-8.6,13.3-18.6,13.3-28.8c0-10.2-4.6-20.2-13.3-28.8l-23.8-23.8c-2.8-2.8-5.4-5.5-8.2-8.3c-5.3-5.4-10.8-11-16.2-16.1
                  C100,7.2,90.3,3,80.1,3C69.9,3,60.1,7.2,51.6,15.4L21.7,45.3C10.8,56.2,4.6,69.4,3.3,84.7c-1.5,19.1,2,39.4,11.1,64
                  C28.5,186.7,49.6,222,80.9,259.6L80.9,259.6z M22.9,86.4c1-10.6,5-19.5,12.7-27.2l29.8-29.8c4.6-4.5,9.8-6.8,14.7-6.8
                  c4.9,0,9.8,2.3,14.4,7c5.4,5,10.4,10.2,15.8,15.7c2.7,2.8,5.5,5.6,8.3,8.5l23.8,23.8c5,5,7.5,10,7.5,15c0,5-2.6,10-7.5,15
                  c-2.5,2.5-5,5-7.4,7.5c-7.4,7.5-14.4,14.6-22.1,21.4l-0.4,0.4c-6.6,6.6-5.6,13-4,17.8c0.1,0.2,0.2,0.4,0.2,0.6
                  c6.2,14.8,14.7,28.9,28.1,45.7c24,29.6,49.3,52.6,77.1,70.2c3.4,2.2,7.1,4,10.6,5.8c3.2,1.6,6.2,3.1,8.8,4.8
                  c0.3,0.2,0.6,0.3,0.9,0.5c2.6,1.4,5.2,2,7.8,2c6.4,0,10.6-4.1,11.9-5.4l29.9-29.9c4.6-4.6,9.7-7.1,14.6-7.1c6.1,0,11,3.8,14.2,7.1
                  l48.2,48.2c9.6,9.6,9.5,20-0.2,30.2c-3.4,3.6-6.9,7-10.6,10.6c-5.6,5.4-11.4,11-16.7,17.4c-9.2,9.9-20.2,14.6-34.3,14.6
                  c-1.4,0-2.8-0.1-4.2-0.2c-26.2-1.7-50.6-11.9-69-20.6c-49.8-24.1-93.4-58.2-129.7-101.6C66.3,211.4,46.2,178,32.9,142.1
                  C24.7,120.1,21.6,102.4,22.9,86.4L22.9,86.4z M22.9,86.4"/>
            </svg>
          </div>
          Nasza infolinia
        </a>
      </div>
    </div>
    <div class="footer__row">
      <div class="footer__copyrights">
        <a class="footer__copyrights-logo-wrap" href="<?php echo home_url(); ?>">
          <img class="footer__copyrights-logo" alt="Floteo" src="<?php bloginfo('template_directory') ?>/img/logo_grey.svg">
        </a>
        <p class="footer__copyrights-disclaimer">&copy; <?php echo date('Y') ?> Floteo - All rights reserved</p>
      </div>
      <div class="footer__copyrights">
        <ul class="footer__copyrights-social">
          <li><a href="<?php the_field('contact_facebook', 'options') ?>" target="_blank">
            <img class="svg" src="<?php bloginfo('template_directory') ?>/img/ico_facebook.svg" alt="">
          </a></li>
          <li><a href="<?php the_field('contact_twitter', 'options') ?>" target="_blank">
            <img class="svg" src="<?php bloginfo('template_directory') ?>/img/ico_twitter.svg" alt="">
          </a></li>
          <li><a href="<?php the_field('contact_google_plus', 'options') ?>" target="_blank">
            <img class="svg" src="<?php bloginfo('template_directory') ?>/img/ico_google.svg" alt="">
          </a></li>
          <li><a href="<?php the_field('contact_linkedin', 'options') ?>" target="_blank">
            <img class="svg" src="<?php bloginfo('template_directory') ?>/img/ico_linkedin.svg" alt="">
          </a></li>
        </ul>
      </div>
    </div>
  </div>
</footer>

<div class="modal fade" id="newsletterPupUp">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4>NIE PRZEGAP OKAZJI Z NASZYM NEWSLETTEREM!</h4>
        <p>Zero spamu – tylko najlepsze oferty - <strong>raz w miesiącu</strong></p><br>
        <div id="mc_embed_signup">
          <form action="https://floteocars.us20.list-manage.com/subscribe/post?u=b2a87b8d5bffa05c060aafc6f&amp;id=263ad6c0ff" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
            <div id="mc_embed_signup_scroll">
              <div class="mc-field-group">
              	<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Adres e-mail">
              </div>
            	<div id="mce-responses" class="clear">
            		<div class="response" id="mce-error-response" style="display:none"></div>
            		<div class="response" id="mce-success-response" style="display:none"></div>
            	</div>
              <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_b2a87b8d5bffa05c060aafc6f_263ad6c0ff" tabindex="-1" value=""></div>
              <div class="clear"><input type="submit" value="Zapisz się" name="subscribe" id="mc-embedded-subscribe" class="btn_custom"></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="carPopUp">
  <div class="car-modal">
    <div class="car-modal__close" data-dismiss="modal">
      <svg class="car-modal__close-svg" viewBox="2115.656 4371.656 11.054 11.054">
        <g><path stroke="currentColor" d="M2126.003 4372.363l-9.64 9.64"></path><path stroke="currentColor" d="M2116.363 4372.363l9.64 9.64"></path></g>
      </svg>
    </div>
              <div class="car-modal__head">
                <b>Nie znalazłeś samochodu dla siebie?</b>
                <p>Współpracujemy z ponad 200 salonami 27 marek</p>
                <br><br>
                <p>Znajdziemy Twój wymarzony samochód!</p>
                <br>
              </div>
              <div class="car-modal__body">
                <?php echo do_shortcode('[contact-form-7 id="2361" title="Nie znalazłeś samochodu dla siebie?"]') ?>
              </div>
              <img class="car-modal__logo" src="https://floteocars.pl/wp-content/themes/floteo-custom/img/logo.svg" alt="">
  </div>
</div>

<div class="carPopUpButton">
  Zlecenie
</div>

<div class="nav_wrapper" id="menu_mobile">
  <?php wp_nav_menu(array( 'theme_location' => 'menu-1', 'container' => 'ul' )); ?>
</div>

<div class="lds-ellipsis_cont" style="display: none;" id="searchLoader">
		<div class="lds-ellipsis" ><div></div><div></div><div></div><div></div></div>
	</div>

<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';fnames[5]='BIRTHDAY';ftypes[5]='birthday';}(jQuery));var $mcj = jQuery.noConflict(true);</script>

<!-- Global site tag (gtag.js) - Google Ads: 759109037 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-759109037"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'AW-759109037');
</script>
<script type="text/javascript" src="<?php echo get_site_url(); ?>/wp-content/themes/floteo-custom/plugins/multiselect/js/jquery.multi-select.js"></script>

<?php wp_footer(); ?>
</body>
</html>
