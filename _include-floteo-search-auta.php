<form id="searchEngine" class="floteo__search floteo__archive-form" method="get" action="<?php echo home_url(); ?>/auta-na-abonament">
  <div class="floteo__search-body">
    <div class="floteo__search-row floteo__radio-wrap --has-cols --width-100">
      <input class="floteo__search-radio-input" type="radio" name="clientType" id="clientTypeBussiness" value="bussiness" <?php if(empty($_GET['clientType']) || (!empty($_GET['clientType']) && $_GET['clientType']=="bussiness")){ echo "checked"; }; ?> />
      <label class="floteo__search-radio" for="clientTypeBussiness">Klient biznesowy</label>
      <input class="floteo__search-radio-input" type="radio" name="clientType" id="clientTypeIndividual" value="individual" <?php if(!empty($_GET['clientType']) && $_GET['clientType']=="individual"){ echo "checked"; }; ?> />
      <label class="floteo__search-radio" for="clientTypeIndividual">Klient indywidualny</label>
    </div>
    <div class="floteo__search-row">
        <div class="floteo__search-archive-item">
          <div class="floteo__search-row-head">&nbsp;</div>
          <input class="floteo__search-input" type="text" placeholder="Wyszukaj" id="filterQuery" name="filterQuery" value="<?php if(!empty($_GET['filterQuery'])){ echo $_GET['filterQuery']; }; ?>" />
        </div>
        <div class="floteo__search-archive-item">
          <div class="floteo__search-row-head">rata</div>
          <div class="floteo__search-input-wrap --slider-range">
            <div class="floteo__search-slider-range-inputs">
              <input class="floteo__search-slider-input --min" type="text" placeholder="Od" name="searchPriceMin" value="<?php if(!empty($_GET['searchPriceMin'])){ echo $_GET['searchPriceMin']; }; ?>" />
              <input class="floteo__search-slider-input --max" type="text" placeholder="Do" name="searchPriceMax" value="<?php if(!empty($_GET['searchPriceMax'])){ echo $_GET['searchPriceMax']; }; ?>" />
            </div>
            <div class="floteo__price-slider-range"></div>
            <div class="floteo__od-reki">
              <input type="checkbox" name="odReki" id="odReki"  <?php if(!empty($_GET['odReki']) && $_GET['odReki']=="on"){ echo "checked"; }; ?> />
              <label for="odReki">Od ręki</label>
            </div>
          </div>
        </div>
    </div>
    <div class="floteo__search-row --has-cols">
      <div class="floteo__search-col">
        <div class="floteo__search-row-head">marka</div>
        <select class="floteo__search-multiselect" name="searchMark[]" id="filterMark" multiple="multiple">
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
      <div class="floteo__search-col">
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
      <div class="floteo__search-col">
        <div class="floteo__search-row-head">nadwozie</div>
        <select class="floteo__search-multiselect" name="searchBody[]" id="filterBody" multiple="multiple">
          <option value="hatchback" <?php if(!empty($_GET['searchBody']) && in_array('hatchback',$_GET['searchBody'])) echo 'selected';?>>Hatchback</option>
          <option value="sedan" <?php if(!empty($_GET['searchBody']) && in_array('sedan',$_GET['searchBody'])) echo 'selected';?>>Sedan</option>
          <option value="kombi" <?php if(!empty($_GET['searchBody']) && in_array('kombi',$_GET['searchBody'])) echo 'selected';?>>Kombi</option>
          <option value="crossover" <?php if(!empty($_GET['searchBody']) && in_array('crossover',$_GET['searchBody'])) echo 'selected';?>>Crossover</option>
          <option value="suv" <?php if(!empty($_GET['searchBody']) && in_array('suv',$_GET['searchBody'])) echo 'selected';?>>SUV</option>
          <option value="dostawcze" <?php if(!empty($_GET['searchBody']) && in_array('dostawcze',$_GET['searchBody'])) echo 'selected';?>>Dostawcze</option>
        </select>
      </div>
      <div class="floteo__search-col">
        <div class="floteo__search-row-head">skrzynia biegów</div>
        <select class="floteo__search-select" name="searchGearbox" id="filterGearbox">
          <option value="all">Dowolna</option>
          <option value="manualna">Manualna</option>
          <option value="automatyczna">Automatyczna</option>
        </select>
      </div>
      <button class="btn btn_custom search searchSubmitBtn">
        <img class="svg" src="<?php bloginfo('template_directory') ?>/img/ico_search.svg">
      </button>
    </div>
  </div>
</form>
