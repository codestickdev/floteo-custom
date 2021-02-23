<form id="searchEngine" class="floteo__search floteo__archive-form" method="get" action="<?php echo home_url(); ?>/wynajem-dlugoterminowy">
  <div class="floteo__search-body">
    <div class="floteo__search-row searchInput">
      <input class="floteo__search-input" type="text" placeholder="Wpisz słowa kluczowe" id="filterQuery" name="filterQuery" value="<?php if(!empty($_GET['filterQuery'])){ echo $_GET['filterQuery']; }; ?>" />  
    </div>
    <div class="floteo__search-row floteo__radio-wrap --has-cols --width-100">
      <input class="floteo__search-radio-input" type="radio" name="clientType" id="clientTypeBussiness" value="bussiness" <?php if(empty($_GET['clientType']) || (!empty($_GET['clientType']) && $_GET['clientType']=="bussiness")){ echo "checked"; }; ?> />
      <label class="floteo__search-radio" for="clientTypeBussiness">
        <img src="/wp-content/themes/floteo-custom/img/company_ico.svg"/>
        <span>Dla firmy</span>
      </label>
      <input class="floteo__search-radio-input" type="radio" name="clientType" id="clientTypeIndividual" value="individual" <?php if(!empty($_GET['clientType']) && $_GET['clientType']=="individual"){ echo "checked"; }; ?> />
      <label class="floteo__search-radio" for="clientTypeIndividual">
        <img src="/wp-content/themes/floteo-custom/img/individual_ico.svg"/>
        <span>Os. indywidualna</span>
      </label>
    </div>
    <div class="floteo__search-row">
        <div class="floteo__search-archive-item">
          <div class="floteo__search-row-head">Rata samochodu netto</div>
          <div class="floteo__search-input-wrap --slider-range">
            <div class="floteo__price-slider-range"></div>
            <div class="floteo__search-slider-range-inputs">
              <div class="floteo__search-slider-input-wrap">
                <input class="floteo__search-slider-input --min" type="text" placeholder="0" name="searchPriceMin" value="<?php if(!empty($_GET['searchPriceMin'])){ echo $_GET['searchPriceMin']; }; ?>" />
              </div>
              <div class="floteo__search-slider-space"></div>
              <div class="floteo__search-slider-input-wrap">
                <input class="floteo__search-slider-input --max" type="text" placeholder="5000" name="searchPriceMax" value="<?php if(!empty($_GET['searchPriceMax'])){ echo $_GET['searchPriceMax']; }; ?>" />
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="floteo__search-row --block markSelect">
      <div class="floteo__search-row-head">Marka samochodu</div>
        <select class="floteo__search-markSelect" name="searchMark[]" id="filterMark" multiple="multiple">
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
    <div class="floteo__search-row --block multiSelect-new">
      <div class="floteo__search-row-head">Nadwozie samochodu</div>
      <select class="floteo__search-multiSelect" name="searchBody[]" id="filterBody" multiple="multiple">
        <option value="hatchback" <?php if(!empty($_GET['searchBody']) && in_array('hatchback',$_GET['searchBody'])) echo 'selected';?>>Hatchback</option>
        <option value="sedan" <?php if(!empty($_GET['searchBody']) && in_array('sedan',$_GET['searchBody'])) echo 'selected';?>>Sedan</option>
        <option value="kombi" <?php if(!empty($_GET['searchBody']) && in_array('kombi',$_GET['searchBody'])) echo 'selected';?>>Kombi</option>
        <option value="crossover" <?php if(!empty($_GET['searchBody']) && in_array('crossover',$_GET['searchBody'])) echo 'selected';?>>Crossover</option>
        <option value="suv" <?php if(!empty($_GET['searchBody']) && in_array('suv',$_GET['searchBody'])) echo 'selected';?>>SUV</option>
        <option value="dostawcze" <?php if(!empty($_GET['searchBody']) && in_array('dostawcze',$_GET['searchBody'])) echo 'selected';?>>Dostawcze</option>
      </select>
    </div>
    <div class="floteo__search-row --block fuelSelect multiSelect-new">
      <div class="floteo__search-row-head">Rodzaj paliwa</div>
      <select class="floteo__search-multiSelect" name="searchFuel" id="filterFuel" multiple="multiple">
            <!-- <option value="all" <?php if(!empty($_GET['searchFuel']) && in_array('all',$_GET['searchFuel'])) echo 'selected';?>>Wszystkie</option> -->
            <option value="benzyna" <?php if(!empty($_GET['searchFuel']) && in_array('benzyna',$_GET['searchFuel'])) echo 'selected';?>>Benzyna</option>
            <option value="benzynalpg" <?php if(!empty($_GET['searchFuel']) && in_array('benzynalpg',$_GET['searchFuel'])) echo 'selected';?>>Benzyna + LPG</option>
            <option value="diesel" <?php if(!empty($_GET['searchFuel']) && in_array('diesel',$_GET['searchFuel'])) echo 'selected';?>>Diesel</option>
            <option value="hybryda" <?php if(!empty($_GET['searchFuel']) && in_array('hybryda',$_GET['searchFuel'])) echo 'selected';?>>Hybryda Benzyna</option>
            <option value="hybrydadiesel" <?php if(!empty($_GET['searchFuel']) && in_array('hybrydadiesel',$_GET['searchFuel'])) echo 'selected';?>>Hybryda Diesel</option>
            <option value="elektryczny" <?php if(!empty($_GET['searchFuel']) && in_array('elektryczny',$_GET['searchFuel'])) echo 'selected';?>>Elektryczny</option>
      </select>
    </div>
    <div class="floteo__search-row --block multiSelect-new">
      <div class="floteo__search-row-head">Skrzynia biegów</div>
      <select class="floteo__search-multiSelect" name="searchGearbox" id="filterGearbox" multiple="multiple">
        <!-- <option value="all" <?php if(!empty($_GET['searchGearbox']) && in_array('all',$_GET['searchGearbox'])) echo 'selected';?>>Dowolna</option> -->
        <option value="manualna" <?php if(!empty($_GET['searchGearbox']) && in_array('manualna',$_GET['searchGearbox'])) echo 'selected';?>>Manualna</option>
        <option value="automatyczna" <?php if(!empty($_GET['searchGearbox']) && in_array('automatyczna',$_GET['searchGearbox'])) echo 'selected';?>>Automatyczna</option>
      </select>
    </div>
    <button class="btn btn_custom search searchSubmitBtn">Filtruj</button>
  </div>
</form>
