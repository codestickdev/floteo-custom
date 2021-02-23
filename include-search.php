<form id="searchEngine" method="get" action="<?php echo home_url(); ?>/wynajem-dlugoterminowy">
  <div class="row" id="searchBasic">
    <div class="col-md-3">
      <div class="form-group">
        <label>cena</label>
        <div class="row">
          <div class="col-xs-6">
            <input type="number" class="form-control" placeholder="od" name="searchPriceMin" value="<?php echo $searchPriceMin ?>">
          </div>
          <div class="col-xs-6">
            <input type="number" class="form-control" placeholder="do" name="searchPriceMax" value="<?php echo $searchPriceMax ?>">
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="form-group">
        <label>marka</label>
        <div class="select_wrapper">
          <select class="form-control" placeholder="Wszystkie" name="searchMark[]" id="filterMark"  multiple="multiple">
            <?php if( have_rows('search_engine_marks', 'options') ): ?>
            	<?php while( have_rows('search_engine_marks', 'options') ): the_row();
            		$search_engine_mark_name = get_sub_field('search_engine_mark_name');
					$selected = array();
					if(!empty($_GET['searchMark'])){
						$selected = $_GET['searchMark'];
					}

            		?>
                <option value="<?php echo $search_engine_mark_name ?>" <?php if(in_array($search_engine_mark_name,$selected)) echo 'selected="selected"';?>><?php echo $search_engine_mark_name; ?></option>
            	<?php endwhile; ?>
            <?php endif; ?>
          </select>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="form-group">
        <label>nadwozie</label>
        <div class="select_wrapper">
          <select class="form-control" name="searchBody[]" id="filterBody" multiple="multiple">
            <option value="all">Wszystkie</option>
            <option value="hatchback">Hatchback</option>
            <option value="sedan">Sedan</option>
            <option value="kombi">Kombi</option>
            <option value="suv">SUV</option>
            <option value="dostawcze">Dostawcze</option>
          </select>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <span class="btn_divider"></span>
      <?php if( is_front_page() ) : ?>
        <button type="submit" class="btn btn_custom search hidden-sm hidden-xs">
          Szukaj <img class="svg" src="<?php bloginfo('template_directory') ?>/img/ico_search.svg">
        </button>
      <?php else : ?>
        <a class="btn btn_custom search hidden-sm hidden-xs searchSubmitBtn">
          Szukaj <img class="svg" src="<?php bloginfo('template_directory') ?>/img/ico_search.svg">
        </a>
      <?php endif; ?>
    </div>
  </div>

  <div class="row collapse" id="searchAdvance"><br>
    <div class="col-md-3">
      <div class="form-group">
        <label>paliwo</label>
        <div class="select_wrapper">
          <select class="form-control" name="searchFuel" id="filterFuel">
            <option value="all">Dowolne</option>
            <option value="benzyna">Benzyna</option>
            <option value="benzynalpg">Benzyna + LPG</option>
            <option value="diesel">Diesel</option>
            <option value="hybryda">Hybryda</option>
            <option value="elektryczny">Elektryczny</option>
          </select>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-3">
      <div class="form-group">
        <label>skrzynia biegów</label>
        <div class="select_wrapper">
          <select class="form-control" name="searchGearbox" id="filterGearbox">
            <option value="all">Dowolna</option>
            <option value="manualna">Manualna</option>
            <option value="automatyczna">Automatyczna</option>
          </select>
        </div>
      </div>
    </div>

    <!-- <div class="col-lg-4 col-md-6">
      <div class="form-group checkbox_wrapper">
        <label class="main_label">skrzynia biegów</label>
        <div class="row">
          <div class="col-xs-5">
            <input class="custom_checkbox" id="filterManualna" type="checkbox" value="manualna" name="gearbox">
            <label for="filterManualna">manualna</label>
          </div>
          <div class="col-xs-5">
            <input class="custom_checkbox" id="filterAutomatyczna" type="checkbox" value="automatyczna" name="gearbox">
            <label for="filterAutomatyczna">automatyczna</label>
          </div>
        </div>
      </div>
    </div> -->
  </div>

  <div class="more_settings">
    <div class="hidden-lg hidden-md">
      <?php if( is_front_page() ) : ?>
        <button type="submit" class="btn btn_custom search">
          Szukaj <img class="svg" src="<?php bloginfo('template_directory') ?>/img/ico_search.svg">
        </button>
      <?php else : ?>
        <a class="btn btn_custom search searchSubmitBtn">
          Szukaj <img class="svg" src="<?php bloginfo('template_directory') ?>/img/ico_search.svg">
        </a>
      <?php endif; ?>
    </div>
    <div class="col-xs-7">
      <a type="button" class="link_clear">wyczyść wszystkie kryteria</a>
    </div>
    <div class="col-xs-5 text-right">
      <a data-toggle="collapse" data-target="#searchAdvance" class="link_more">więcej opcji</a>
    </div>
  </div>
</form>
