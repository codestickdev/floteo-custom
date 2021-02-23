<form id="searchEngineMobile" class="floteo__search floteo__search-mobile" method="get" action="<?php echo home_url(); ?>/wynajem-dlugoterminowy">
  <div class="floteo__search-top">
    <div class="floteo__search-back close-find-car">
      <svg class="floteo__search-back-icon" viewBox="0 0 784.5 588.1">
        <line fill="none" stroke="#353D61" stroke-width="65" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="752" y1="294.1" x2="32.5" y2="294.1"/>
        <polyline fill="none" stroke="#353D61" stroke-width="65" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="294.1,555.6 32.5,294.1 294.1,32.5 "/>
      </svg>
      <div class="floteo__search-back-head">Znajdź samochód</div>
    </div>
    <div class="floteo__search-clear">wyczyść</div>
  </div>
  <div class="floteo__search-body">
    <div class="floteo__search-row floteo__radio-wrap">
      <input class="floteo__search-radio-input" type="radio" name="clientType" id="mobileClientTypeBussiness" value="bussiness" <?php if(empty($_GET['clientType']) || (!empty($_GET['clientType']) && $_GET['clientType']=="bussiness")){ echo "checked"; }; ?> />
      <label class="floteo__search-radio" for="mobileClientTypeBussiness">Klient biznesowy</label>
      <input class="floteo__search-radio-input" type="radio" name="clientType" id="mobileClientTypeIndividual" value="individual" <?php if(!empty($_GET['clientType']) && $_GET['clientType']=="individual"){ echo "checked"; }; ?> />
      <label class="floteo__search-radio" for="mobileClientTypeIndividual">Klient indywidualny</label>
    </div>
    <div class="floteo__search-row">
      <input class="floteo__search-input" type="text" placeholder="Wyszukaj" name="filterQuery" value="<?php if(!empty($_GET['filterQuery'])){ echo $_GET['filterQuery']; }; ?>" />
    </div>
    <div class="floteo__search-row">
      <div class="floteo__search-row-head">rata</div>
      <div class="floteo__search-input-wrap">
        <input class="floteo__search-input" type="text" placeholder="Od" name="searchPriceMin" value="<?php if(!empty($_GET['searchPriceMin'])){ echo $_GET['searchPriceMin']; }; ?>" />
        <input class="floteo__search-input" type="text" placeholder="Do" name="searchPriceMax" value="<?php if(!empty($_GET['searchPriceMax'])){ echo $_GET['searchPriceMax']; }; ?>" />
      </div>
    </div>
    <div class="floteo__search-row">
      <div class="floteo__search-row-head">marka</div>
      <select class="floteo__search-multiselect" name="searchMark[]" id="filterMarkMobile"  multiple="multiple">
        <?php if( have_rows('search_engine_marks', 'options') ): ?>
          <?php while( have_rows('search_engine_marks', 'options') ): the_row();
            $search_engine_mark_name = get_sub_field('search_engine_mark_name');
            $selected = array();
            if(!empty($_GET['searchMark'])){
              $selected = $_GET['searchMark'];
            }?>
             <option value="<?php echo $search_engine_mark_name ?>" <?php if(in_array($search_engine_mark_name,$selected)) echo 'selected="selected"';?>><?php echo $search_engine_mark_name; ?></option>
          <?php endwhile; ?>
        <?php endif; ?>
      </select>
    </div>
    <div class="floteo__search-row">
      <div class="floteo__search-row-head">paliwo</div>
      <select class="floteo__search-select" name="searchFuel" id="filterFuel">
              <option value="all">Wszystkie</option>
              <option value="benzyna">Benzyna</option>
              <option value="benzynalpg">Benzyna + LPG</option>
              <option value="diesel">Diesel</option>
              <option value="hybryda">Hybryda Benzyna</option>
              <option value="hybrydadiesel">Hybryda Diesel</option>
              <option value="elektryczny">Elektryczny</option>
      </select>
    </div>
    <div class="floteo__search-row">
      <div class="floteo__search-row-head">skrzynia biegów</div>
      <select class="floteo__search-select" name="searchGearbox" id="filterGearbox">
        <option value="all" <?php if(!empty($_GET['searchGearbox']) && $_GET['searchGearbox'] == "all"){ echo "selected"; }; ?>>Dowolna</option>
        <option value="manualna" <?php if(!empty($_GET['searchGearbox']) && $_GET['searchGearbox'] == "manualna"){ echo "selected"; }; ?>>Manualna</option>
        <option value="automatyczna" <?php if(!empty($_GET['searchGearbox']) && $_GET['searchGearbox'] == "automatyczna"){ echo "selected"; }; ?>>Automatyczna</option>
      </select>
    </div>
    <div class="floteo__search-row">
      <div class="floteo__search-row-head">nadwozie</div>
      <div class="floteo__search-checkboxes">
        <input class="floteo__search-checkbox-input" type="checkbox" name="searchBody[]" value="hatchback" id="mobileHatchback" <?php if(!empty($_GET['searchBody']) && in_array('hatchback',$_GET['searchBody'])) echo 'checked';?> />
        <label for="mobileHatchback" class="floteo__search-checkbox">
          <div class="floteo__search-checkbox-image">
            <img class="svg" src="<?php bloginfo('template_directory') ?>/img/floteo_search_hatchback.svg">
          </div>
          Miejski
        </label>
        <input class="floteo__search-checkbox-input" type="checkbox" name="searchBody[]" value="sedan" id="mobileSedan" <?php if(!empty($_GET['searchBody']) && in_array('sedan',$_GET['searchBody'])) echo 'checked';?>/>
        <label for="mobileSedan" class="floteo__search-checkbox">
          <div class="floteo__search-checkbox-image">
            <img class="svg" src="<?php bloginfo('template_directory') ?>/img/floteo_search_sedan.svg">
          </div>
          Sedan
        </label>
        <input class="floteo__search-checkbox-input" type="checkbox" name="searchBody[]" value="kombi" id="mobileKombi" <?php if(!empty($_GET['searchBody']) && in_array('kombi',$_GET['searchBody'])) echo 'checked';?>/>
        <label for="mobileKombi" class="floteo__search-checkbox">
          <div class="floteo__search-checkbox-image">
            <img class="svg" src="<?php bloginfo('template_directory') ?>/img/floteo_search_kombi.svg">
          </div>
          Kombi
        </label>
        <input class="floteo__search-checkbox-input" type="checkbox" name="searchBody[]" value="crossover" id="mobileCrossover" <?php if(!empty($_GET['searchBody']) && in_array('crossover',$_GET['searchBody'])) echo 'checked';?> />
        <label for="mobileCrossover" class="floteo__search-checkbox">
          <div class="floteo__search-checkbox-image">
            <img class="svg" src="<?php bloginfo('template_directory') ?>/img/floteo_search_crossover.svg">
          </div>
          Crossover
        </label>
        <input class="floteo__search-checkbox-input" type="checkbox" name="searchBody[]" value="suv" id="mobileSUV" <?php if(!empty($_GET['searchBody']) && in_array('suv',$_GET['searchBody'])) echo 'checked';?>/>
        <label for="mobileSUV" class="floteo__search-checkbox">
          <div class="floteo__search-checkbox-image">
            <img class="svg" src="<?php bloginfo('template_directory') ?>/img/floteo_search_suv.svg">
          </div>
          SUV
        </label>
        <input class="floteo__search-checkbox-input" type="checkbox" name="searchBody[]" value="dostawcze" id="mobileDostawczy" <?php if(!empty($_GET['searchBody']) && in_array('dostawcze',$_GET['searchBody'])) echo 'checked';?> />
        <label for="mobileDostawczy" class="floteo__search-checkbox">
          <div class="floteo__search-checkbox-image">
            <img class="svg" src="<?php bloginfo('template_directory') ?>/img/floteo_search_dostawczy.svg">
          </div>
          Dostawczy
        </label>
      </div>
    </div>
  </div>
  <button class="floteo__search-submit">
    Pokaż oferty
  </button>
</form>