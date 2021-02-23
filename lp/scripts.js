$(document).ready(function() {
  $(".tabs__pagination-item").click(function() {
    var index = $(this).index();
    setActiveTab(index);
  });

  $(".header__img").click(function() {
    setActiveTab(0);
  });

  $(".content__button.--next").click(function() {
    setActiveTab(1);
  });

  $("#form").submit(function(e) {
    e.preventDefault();

    var form = $(this);
    var url = form.attr("action");

    $.ajax({
      type: "POST",
      url: url,
      data: form.serialize(),
      success: function(result) {
        form[0].reset();

        if (result === "1") {
          $(".alert").html(
            "Dziękujemy za wypełnienie formularza.<br/>Nasi doradcy skontaktują się  najszybciej jak to możliwe."
          );
        } else {
          $(".alert").html(
            "Wystąpił błąd podczas wysłania formularza.<br/>Spróbuj ponownie później."
          );
        }

        $(".alert").addClass("--opened");

        setTimeout(function() {
          $(".alert").removeClass("--opened");
        }, 5000);
      }
    });
  });

  var elemWartoscSamochodu = $("#WartoscSamochodu");
  initPriceSlider();

  var elemWplataWlasna = $("#WplataWlasna");
  initWplataSlider();

  var elemWykup = $("#Wykup");
  initWykupSlider();

  function setPriceText(val) {
    return (
      numberWithSpaces(val.toFixed(2)) +
      " PLN netto<br/><span>(" +
      numberWithSpaces((1.23 * val).toFixed(2)) +
      " PLN brutto)</span>"
    );
  }

  function setPercentText(val) {
    var price = $('input[name="WartoscSamochodu"]').val() * (val / 100);

    return (
      val +
      "% - " +
      numberWithSpaces(price.toFixed(2)) +
      " PLN netto<br/><span>(" +
      numberWithSpaces((1.23 * price).toFixed(2)) +
      " PLN brutto)</span>"
    );
  }

  function numberWithSpaces(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }

  function setActiveTab(index) {
    $(".tab")
      .removeClass("--active")
      .eq(index)
      .addClass("--active");

    $(".tabs__pagination-item")
      .removeClass("--active")
      .eq(index)
      .addClass("--active");
  }

  function initPriceSlider() {
    var minWartoscSamochodu = parseInt(elemWartoscSamochodu.attr("data-min"));
    var maxWartoscSamochodu = parseInt(elemWartoscSamochodu.attr("data-max"));
    var stepWartoscSamochodu = parseInt(elemWartoscSamochodu.attr("data-step"));
    var inputWartoscSamochodu = elemWartoscSamochodu.find("input");
    var textWartoscSamochodu = elemWartoscSamochodu.find(
      ".content__slider-value"
    );
    var sliderWartoscSamochodu = elemWartoscSamochodu.find(
      ".content__slider-item"
    );
    var buttonsWartoscSamochodu = elemWartoscSamochodu.find(
      ".content__slider-button"
    );

    inputWartoscSamochodu.val(minWartoscSamochodu);
    textWartoscSamochodu.html(setPriceText(minWartoscSamochodu));

    sliderWartoscSamochodu.slider({
      range: "min",
      min: minWartoscSamochodu,
      max: maxWartoscSamochodu,
      step: stepWartoscSamochodu,
      value: minWartoscSamochodu,
      slide: function(event, ui) {
        inputWartoscSamochodu.val(ui.value);
        textWartoscSamochodu.html(setPriceText(ui.value));
        elemWplataWlasna
          .find(".content__slider-value")
          .html(setPercentText(elemWplataWlasna.find("input").val()));
        elemWykup
          .find(".content__slider-value")
          .html(setPercentText(elemWykup.find("input").val()));
      }
    });

    buttonsWartoscSamochodu.click(function() {
      var currentValue = parseInt(sliderWartoscSamochodu.slider("value"));
      var newValue;

      if ($(this).hasClass("--minus")) {
        newValue = currentValue - stepWartoscSamochodu;
      } else {
        newValue = currentValue + stepWartoscSamochodu;
      }

      if (newValue < minWartoscSamochodu) {
        newValue = minWartoscSamochodu;
      }

      if (newValue > maxWartoscSamochodu) {
        newValue = maxWartoscSamochodu;
      }

      sliderWartoscSamochodu.slider("value", newValue);
      inputWartoscSamochodu.val(newValue);
      textWartoscSamochodu.html(setPriceText(newValue));
      elemWplataWlasna
        .find(".content__slider-value")
        .html(setPercentText(elemWplataWlasna.find("input").val()));
      elemWykup
        .find(".content__slider-value")
        .html(setPercentText(elemWykup.find("input").val()));
    });
  }

  function initWplataSlider() {
    var minWplataWlasna = parseInt(elemWplataWlasna.attr("data-min"));
    var maxWplataWlasna = parseInt(elemWplataWlasna.attr("data-max"));
    var stepWplataWlasna = parseInt(elemWplataWlasna.attr("data-step"));
    var inputWplataWlasna = elemWplataWlasna.find("input");
    var textWplataWlasna = elemWplataWlasna.find(".content__slider-value");
    var sliderWplataWlasna = elemWplataWlasna.find(".content__slider-item");
    var buttonsWplataWlasna = elemWplataWlasna.find(".content__slider-button");

    inputWplataWlasna.val(minWplataWlasna);
    textWplataWlasna.html(setPercentText(minWplataWlasna));

    sliderWplataWlasna.slider({
      range: "min",
      min: minWplataWlasna,
      max: maxWplataWlasna,
      step: stepWplataWlasna,
      value: minWplataWlasna,
      slide: function(event, ui) {
        inputWplataWlasna.val(ui.value);
        textWplataWlasna.html(setPercentText(ui.value));
      }
    });

    buttonsWplataWlasna.click(function() {
      var currentValue = parseInt(sliderWplataWlasna.slider("value"));
      var newValue;

      if ($(this).hasClass("--minus")) {
        newValue = currentValue - stepWplataWlasna;
      } else {
        newValue = currentValue + stepWplataWlasna;
      }

      if (newValue < minWplataWlasna) {
        newValue = minWplataWlasna;
      }

      if (newValue > maxWplataWlasna) {
        newValue = maxWplataWlasna;
      }

      sliderWplataWlasna.slider("value", newValue);
      inputWplataWlasna.val(newValue);
      textWplataWlasna.html(setPercentText(newValue));
    });
  }

  function initWykupSlider() {
    var minWykup = parseInt(elemWykup.attr("data-min"));
    var maxWykup = parseInt(elemWykup.attr("data-max"));
    var stepWykup = parseInt(elemWykup.attr("data-step"));
    var inputWykup = elemWykup.find("input");
    var textWykup = elemWykup.find(".content__slider-value");
    var sliderWykup = elemWykup.find(".content__slider-item");
    var buttonsWykup = elemWykup.find(".content__slider-button");

    inputWykup.val(minWykup);
    textWykup.html(setPercentText(minWykup));

    sliderWykup.slider({
      range: "min",
      min: minWykup,
      max: maxWykup,
      step: stepWykup,
      value: minWykup,
      slide: function(event, ui) {
        inputWykup.val(ui.value);
        textWykup.html(setPercentText(ui.value));
      }
    });

    buttonsWykup.click(function() {
      var currentValue = parseInt(sliderWykup.slider("value"));
      var newValue;

      if ($(this).hasClass("--minus")) {
        newValue = currentValue - stepWykup;
      } else {
        newValue = currentValue + stepWykup;
      }

      if (newValue < minWykup) {
        newValue = minWykup;
      }

      if (newValue > maxWykup) {
        newValue = maxWykup;
      }

      sliderWykup.slider("value", newValue);
      inputWykup.val(newValue);
      textWykup.html(setPercentText(newValue));
    });
  }
});
