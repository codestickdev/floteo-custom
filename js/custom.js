(function ($) {

	$(document).ready(function () {
		setOfferText();

		// var filterItems = [$("#filterMark"), $("#filterMarkMobile")];

		// filterItems.forEach(function (item) {
		// 	item.select2({
		// 		placeholder: 'Wszystkie'
		// 	});

		// 	select2Event({
		// 		currentTarget: item
		// 	});

		// 	item.on('change', select2Event);
		// });

		// initTitleAnimation();

		// $("#filterBody").select2({
		// 	placeholder: 'Wszystkie',
		// 	templateResult: function (state) {
		// 		if (!state.id) {
		// 			return state.text;
		// 		}

		// 		var $state = $(
		// 			'<span class="custom-option"><div class="custom-option__image">' + getIcon(state.text.toLocaleLowerCase()) + "</div>" + state.text + '<div class="custom-option__checkbox"></div></span>'
		// 		);
		// 		return $state;
		// 	}
		// });

		// select2Event({
		// 	currentTarget: $("#filterBody")
		// });

		// $("#filterBody").on('change', select2Event);

		$('.floteo__search-clear').click(function () {
			$('#searchEngineMobile')[0].reset();
			$('#filterMarkMobile').val(null).trigger('change');
		});

		if ($(".bestseller__wrap").length > 0) {
			bestsellerCarousel();
		}

		// $("#filterBody").on('change', select2Event);

		$(".open-find-car").click(function () {
			$("#searchEngineMobile").addClass('--show');
		});

		$(".close-find-car").click(function () {
			$("#searchEngineMobile").removeClass('--show');
		});

		$('#searchEngine, #searchEngineMobile, #searchFast').on('submit', function () {
			$("#searchLoader").show();
		});

		$('.tile.--krotkoterminowy .bttn').click(function () {
			$('#bookCar input[name="car"]').val($(this).attr('data-title'));
			$('#bookCar input[name="car-class"]').val($(this).attr('data-class'));
			$('#bookCar input[name="car-price-doba"]').val($(this).attr('data-price-doba'));
			$('#bookCar input[name="car-price-msc"]').val($(this).attr('data-price-msc'));
			$('#bookCar').modal('show');
		});

		$('#buyNow').click(function () {
			if ($('#checkOne3').prop('checked')) {
				$('#buyNow').removeClass('invalid');
				$('#buyNowForm input[name="car"]').val($(this).attr('data-title'));
				$('#buyNowForm input[name="carLink"]').val(document.location.href);
				$('#buyNowForm input[name="ubezpieczenie"]').val($('#checkOne3').prop('checked') ? 'tak' : 'nie');
				$('#buyNowForm input[name="przebieg"]').val($('input[name="limit"]:checked').val());
				$('#buyNowForm input[name="opony"]').val($('#checkOne2').prop('checked') ? 'tak' : 'nie');
				$('#buyNowForm input[name="assistance"]').val($('#checkOne4').prop('checked') ? 'tak' : 'nie');
				$('#buyNowForm input[name="serwis"]').val($('#checkOne').prop('checked') ? 'tak' : 'nie');
				var finalPrice = $('#finalPrice strong').text();
				if ($('#finalPriceIndividual').length > 0 && $('#finalPrice').length <= 0) {
					finalPrice = $('#finalPriceIndividual strong').text();
				}
				$('#buyNowForm input[name="rata"]').val(finalPrice);
				$('#buyNowForm input[name="wplata"]').val($('.price-slider .price-slider__value').text());
				$('#buyNowForm input[name="okres"]').val($('input[name="okres"]:checked').val());
				$('#buyNowForm').modal('show');
			} else {
				$('#buyNow').addClass('invalid');
			}
		});

		if ($('#fromDate').length > 0) {
			$.datepicker.regional['pl'] = {
				closeText: 'Zamknij',
				prevText: '&#x3C;Poprzedni',
				nextText: 'Następny&#x3E;',
				currentText: 'Dziś',
				monthNames: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec',
					'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'],
				monthNamesShort: ['Sty', 'Lu', 'Mar', 'Kw', 'Maj', 'Cze',
					'Lip', 'Sie', 'Wrz', 'Pa', 'Lis', 'Gru'],
				dayNames: ['Niedziela', 'Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota'],
				dayNamesShort: ['Nie', 'Pn', 'Wt', 'Śr', 'Czw', 'Pt', 'So'],
				dayNamesMin: ['N', 'Pn', 'Wt', 'Śr', 'Cz', 'Pt', 'So'],
				weekHeader: 'Tydz',
				dateFormat: 'dd.mm.yy',
				firstDay: 1,
				isRTL: false,
				showMonthAfterYear: false,
				yearSuffix: ''
			};
			$.datepicker.setDefaults($.datepicker.regional['pl']);

			$('#fromDate').datepicker({
				minDate: getDate(new Date()),
				onSelect: function (e) {
					var date = e.split('.');
					var newDate = new Date(date[2], parseInt(date[1]) - 1, date[0]);
					newDate.setDate(newDate.getDate() + 1);
					$('#toDate').datepicker('option', 'minDate', getDate(newDate));
				}
			}).attr('readonly', 'readonly');

			$('#toDate').datepicker({
				minDate: getDate(new Date()),
				onSelect: function (e) {
					var date = e.split('.');
					var newDate = new Date(date[2], parseInt(date[1]) - 1, date[0]);
					$('#fromDate').datepicker('option', 'maxDate', getDate(newDate));
				}
			}).attr('readonly', 'readonly');

			function getDate(date) {
				return date.getDate() + '.' + (date.getMonth() + 1) + '.' + date.getFullYear();
			}
		}

		if ($('.--slider-range').length > 0) {

			$('.--slider-range').each(function (index, elem) {
				var me = $(this);

				var minInput = me.find('.--min');
				var maxInput = me.find('.--max');

				var min = 0;
				var max = 5000;

				var minVal = minInput.val() != 0 ? parseInt(minInput.val()) : min;
				var maxVal = maxInput.val() != 0 ? parseInt(maxInput.val()) : max;

				me.find('.floteo__price-slider-range').slider({
					range: true,
					min: min,
					max: max,
					step: 50,
					value: [minVal, maxVal]
				});

				me.find('.floteo__price-slider-range').on('slide', function (e) {
					minInput.val(e.value[0]);
					maxInput.val(e.value[1]);
				});
			})
		}

		var priceRanges = $('.priceSlider');
		
		$(priceRanges).each(function(){
			var currentValueWrap = $(this).parent().parent().find('.depositValue__value').find('span');
			if ($(this).length > 0) {
				var min = parseFloat($(this).attr('data-min'));
				var max = parseFloat($(this).attr('data-max'));
				var step = parseFloat($(this).attr('data-step'));
	
				$(this).on('slideEnabled', function (event, ui) {
					refresh_price();
					$(currentValueWrap).text((min || 0));
				});
	
				$(this).slider({
					value: min || 0,
					min: min || 0,
					max: max || 20000,
					step: step
				});
	
				$(this).on('slide', function (event, ui) {
					refresh_price();
					$(currentValueWrap).text(event.value);
				});
	
				$(this).on('slideStop', function (event, ui) {
					refresh_price();
					$(currentValueWrap).text(event.value);
				});
			}
		});

		$('.hamburger').click(function () {
			$(this).toggleClass('is-active');
			$('.nav_wrapper').toggleClass('open');
			// $('body').toggleClass('appleFix');
		});

		// Replace all SVG images with inline SVG
		$('img.svg').each(function () {
			var $img = $(this);
			var imgID = $img.attr('id');
			var imgClass = $img.attr('class');
			var imgURL = $img.attr('src');

			$.get(imgURL, function (data) {
				var $svg = $(data).find('svg');
				if (typeof imgID !== 'undefined') {
					$svg = $svg.attr('id', imgID);
				}
				if (typeof imgClass !== 'undefined') {
					$svg = $svg.attr('class', imgClass + ' replaced-svg');
				}
				$svg = $svg.removeAttr('xmlns:a');

				if (!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
					$svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'));
				}
				$img.replaceWith($svg);
			}, 'xml');
		});

		// order page
		$('.wpcf7 br').remove();

		// home_search show more
		$('#searchEngine .more_settings .link_more').click(function () {
			$(this).toggleClass('open');
			var val = $(this).html();
			if (val === 'więcej opcji') {
				$(this).html('mniej opcji');
			} else {
				$(this).html('więcej opcji');
			}
		});

		//
		var touchstart = 0;
		var touchend = 0;
		var activeThumbIndex = 0;

		$('.swipe').on('touchstart', function () {
			touchstart = event.changedTouches[0].screenX;
		});

		$('.swipe').on('touchend', function () {
			touchend = event.changedTouches[0].screenX;
			handleSwipe();
		});

		if ($('.thumbMulti').length > 0) {
			setActiveThumb(0);
		}

		$('.thumbMulti').on('click', function (e) {
			e.preventDefault();
			e.stopPropagation();

			setActiveThumb($(this).index());
		});

		function setActiveThumb(index) {
			activeThumbIndex = index;
			var bg = $('.thumbMulti').eq(index).css('background-image');
			bg = bg.replace('url("', '').replace('")', '');

			$('.main_thumb').css('background-image', 'url(' + bg + ')');
			$('.main_thumb').parent().attr('href', bg);

			$('.thumbMulti').removeClass('active');
			$('.thumbMulti').eq(index).addClass('active');
		}

		function handleSwipe() {
			var next;
			var minMove = 50;

			if (Math.abs(touchstart - touchend) > minMove) {
				if (touchend > touchstart) {
					next = activeThumbIndex - 1;
				} else if (touchend < touchstart) {
					next = activeThumbIndex + 1;
				}

				if (next < 0) {
					next = 0;
				} else if (next > $('.thumbMulti').length - 1) {
					next = $('.thumbMulti').length - 1;
				}

				if (next >= 0) {
					setActiveThumb(next);
				}
			}
		}


		$('.custom-slide').slick({
			centerMode: true,
			centerPadding: '60px',
			slidesToShow: 3,
			dots: true,
			arrows: true,
			responsive: [
				{
					breakpoint: 1200,
					settings: {
						slidesToShow: 2
					}
				},
				{
					breakpoint: 992,
					settings: {
						slidesToShow: 1
					}
				},
				{
					breakpoint: 768,
					settings: {
						centerMode: false,
						slidesToShow: 1,
						arrows: false
					}
				}
			]
		});

		$('.custom-slide').each(function () {
			var slideNumber = $(this).attr('data-number');
			if (slideNumber < 4) {
				$(this).addClass('slickFix');
			}
		});




		$('.custom-slide2').slick({
			centerMode: true,
			centerPadding: '60px',
			slidesToShow: 2,
			dots: true,
			arrows: true,
			responsive: [
				{
					breakpoint: 1200,
					settings: {
						slidesToShow: 2
					}
				},
				{
					breakpoint: 992,
					settings: {
						slidesToShow: 1
					}
				},
				{
					breakpoint: 768,
					settings: {
						centerMode: false,
						slidesToShow: 1,
						arrows: false
					}
				}
			]
		});

		$('.custom-slide2').each(function () {
			var slideNumber = $(this).attr('data-number');
			if (slideNumber < 4) {
				$(this).addClass('slickFix');
			}
		});

		// newsletterPupUp
		$('#newsletterPupUp .close').click(function () {
			$.cookie('newsletterCookie', 1, { expires: 30 });
		});

		// var startTimeLabel = 'startCarPopup2';
		// var modalOpenLabel = 'modalOpenLabel';
		// var currTimeLabel = 'currTimeLabel';

		// if (!window.localStorage.getItem(startTimeLabel)) {
		// 	window.localStorage.setItem(startTimeLabel, Date.now());
		// 	window.localStorage.setItem(currTimeLabel, Date.now());
		// 	window.localStorage.setItem(modalOpenLabel, false);
		// }

		// $(window).on('beforeunload', function () {
		// 	window.localStorage.setItem(currTimeLabel, Date.now());
		// });

		// var modalOpened = window.localStorage.getItem(modalOpenLabel) ? JSON.parse(window.localStorage.getItem(modalOpenLabel)) : false;

		// if (modalOpened) {
		// 	$('.carPopUpButton').addClass('--show');
		// }

		// setInterval(function () {
		// 	window.localStorage.setItem(currTimeLabel, Date.now());

		// 	var start = window.localStorage.getItem(startTimeLabel);
		// 	var time = window.localStorage.getItem(currTimeLabel);

		// 	var min3 = (3 * 60 * 1000);

		// 	if ((time - start) > min3 && modalOpened) {
		// 		modalOpened = false;
		// 		window.localStorage.setItem(startTimeLabel, Date.now());
		// 		window.localStorage.getItem(currTimeLabel, Date.now());
		// 		window.localStorage.setItem(modalOpenLabel, modalOpened);
		// 	}

		// 	start = window.localStorage.getItem(startTimeLabel);
		// 	time = window.localStorage.getItem(currTimeLabel);

		// 	if ((time - start) > min3 && !modalOpened) {
		// 		$('#carPopUp').modal('show');
		// 		$('.carPopUpButton').addClass('--show');
		// 		modalOpened = true;
		// 		window.localStorage.setItem(modalOpenLabel, modalOpened);
		// 	}
		// }, 30000);

		// $('.carPopUpButton').click(function () {
		// 	$('#carPopUp').modal('show');
		// 	modalOpened = true;
		// 	window.localStorage.setItem(modalOpenLabel, modalOpened);
		// });

		if (!$.cookie('newsletterCookie') == 1) {
			setTimeout(function () {
				$('#newsletterPupUp').modal('show')
			}, 60000);
		}

		function refresh_price() {
			var valueTime = $('input[name="okres"]:checked').val();
			var valueLimit = $('input[name="limit"]:checked').val();

			var priceValue = $('.inputValue[data-time="' + valueTime + '"][data-limit="' + valueLimit + '"]').val();

			var checkOne2_checked = $('.selectServices__box #checkOne2.--enabled').is(':checked');
			if (checkOne2_checked) {
				var tiresPrice = $('.selectServices__box #checkOne2.--enabled').attr('data-price');

				if (tiresPrice) {
					priceValue = parseInt(priceValue) + parseInt(tiresPrice);
				}
			}

			var checkOne3_checked = $('.selectServices__box #checkOne3.--enabled').is(':checked');
			if (checkOne3_checked) {
				var insurancePrice = $('.selectServices__box #checkOne3.--enabled').attr('data-price');
				if (insurancePrice) {
					priceValue = parseInt(priceValue) + parseInt(insurancePrice);
				}
			}

			var checkOne4_checked = $('.selectServices__box #checkOne4.--enabled').is(':checked');

			if (checkOne4_checked) {
				var assistancePrice = $('.selectServices__box #checkOne4.--enabled').attr('data-price');
				if (assistancePrice) {
					priceValue = parseInt(priceValue) + parseInt(assistancePrice);
				}
			}

			var priceRanges = $('.priceSlider');
		
			$(priceRanges).each(function(){
				if ($(this).length > 0) {
					var priceSliderValue = parseFloat($(this).attr("data-value"));
					if (priceSliderValue) {
						var countedVal = priceSliderValue * (1.06 / parseInt(valueTime));
						priceValue = parseInt(priceValue) - countedVal;
					}
				}
			});

			if (!priceValue) {
				$('.finalPrice strong').html('-');
				$('.finalPriceIndividual strong').html('-');
				$('.finalPriceWrap').attr('data-domyslna-cena', '-');
			} else {
				$('.finalPrice strong').html(parseInt(priceValue).toFixed(0).toString().replace('.', ','));
				$('.finalPriceWrap').attr('data-domyslna-cena', parseInt(priceValue).toFixed(0).toString().replace('.', ','));
				$('.finalPriceIndividual strong').html(Math.round(priceValue * 1.23).toFixed(0).toString().replace('.', ','));
			}
		}

		$('.--final-price').click(function () {
			if ($(this).hasClass('--allow')) {
				window.open("tel:+48880556566");
			} else {
				$(this).html(`<svg class="final-price__svg" viewBox="0 0 384.6 386.1">
					<path fill="currentColor" d="M371.7,279.9l-48.1-48.1c-8.2-8.5-17.9-13-28.2-13c-10.2,0-20.1,4.5-28.5,12.9l-28.6,28.6c-2.6-1.5-5.4-2.9-7.9-4.2
					c-3.2-1.6-6.2-3.1-8.8-4.8c-26.1-16.6-49.8-38.2-72.4-65.9c-11.4-14.5-19.1-26.6-24.5-39c7.5-6.8,14.6-13.9,21.4-20.9
					c2.4-2.5,4.9-5,7.4-7.4c8.6-8.6,13.3-18.6,13.3-28.8c0-10.2-4.6-20.2-13.3-28.8l-23.8-23.8c-2.8-2.8-5.4-5.5-8.2-8.3
					c-5.3-5.4-10.8-11-16.2-16.1C97,4.2,87.3,0,77.1,0C66.9,0,57.1,4.2,48.6,12.4L18.7,42.3C7.8,53.2,1.6,66.4,0.3,81.7
					c-1.5,19.1,2,39.4,11.1,64c14,38,35.1,73.3,66.5,111c38.1,45.5,83.9,81.4,136.2,106.7c19.9,9.4,46.6,20.6,76.2,22.6
					c1.8,0.1,3.6,0.2,5.4,0.2c19.9,0,35.9-6.9,49-21c0.1-0.1,0.2-0.2,0.3-0.4c4.6-5.6,9.9-10.6,15.4-16c3.8-3.6,7.6-7.4,11.3-11.2
					C388.9,319.7,388.9,297.1,371.7,279.9z"/>
					</svg>
					880-556-566`);
				$(this).addClass('--allow');
			}
		})

		// rent price engine
		$(".toggle__input input").change(function () {
			refresh_price();
		});

		// single checkbox
		$('.selectServices__box #checkOne2').on('change', function () {
			refresh_price();
		});

		//
		$('.selectServices__box #checkOne3').on('change', function () {
			refresh_price();

			if ($('#checkOne3').prop('checked')) {
				$('#checkOne3').parent('.toggle__checkbox').removeClass('invalid');
			}
		});

		$('.selectServices__box #checkOne4').on('change', function () {
			refresh_price();
		});

		//
		$('.custom-slide .slick-slide.slick-current').prev().addClass('slick_prev_mobile');
		$('.custom-slide').on('afterChange', function () {
			$('.custom-slide .slick-slide').removeClass('slick_prev_mobile');
			$('.custom-slide .slick-slide.slick-current').prev().addClass('slick_prev_mobile');
		});
		$('.custom-slide').on('beforeChange', function () {
			$('.custom-slide .slick-slide').removeClass('slick_prev_mobile');
			$('.custom-slide .slick-slide.slick-current').addClass('slick_prev_mobile');
		});

		// contact form
		$('.contact_form input[name="acceptance-640"]').after('<label for="acceptanceForm"><span>Wyrażam zgodę na przetwarzanie moich danych osobowych zgodnie z Ustawą z dnia 29.08.1997 roku o Ochronie Danych Osobowych; (tekst jednolity: Dz. U. 2016 r. poz. 922).</span></label>');

		// archive listing

		var archive_view = 'listingList';

		$('.sort_settings .list_view .view_list').click(function () {
			$('.sort_settings .list_view .view').removeClass('active');
			if (!$(this).hasClass('active')) {
				$(this).addClass('active');
			}

			archive_view = 'listingList';
		});
		$('.sort_settings .list_view .view_tiles').click(function () {
			$('.sort_settings .list_view .view').removeClass('active');
			if (!$(this).hasClass('active')) {
				$(this).addClass('active');
			}

			archive_view = 'listingTiles';
		});


		function searchDefault() {
			initSelectboxes();

			//
			var values = ['Fuel', 'Gearbox'];

			function searchDefaultInner() {
				$(".tile").removeClass('--count');

				var showAll = true;
				var show = [];
				var joined;
				var joinedBody;

				$.each(values, function (index, id) {
					var $el = $('#filter' + id);
					var multi = $el.attr('multiple');
					var val = $el.val();

					if (multi) {
						if (val !== null) {
							showAll = false;
							$.each(val, function (i, v) {
								show.push(v);
							});
						}
					} else {
						if (val !== 'all') {
							showAll = false;
							show.push(val);
						}
					}
				});

				var $el = $('#filterMark');
				var markVal = $el.val();
				if (markVal) {
					showAll = false;
				}

				var $el = $('#filterBody');
				var bodyVal = $el.val();
				if (bodyVal) {
					showAll = false;
				}

				if (showAll) {
					$(".tile").fadeIn("fast").addClass('--count').css('display', 'flex');
				} else {
					if (show && show.length > 0) {
						joined = '.' + show.join('.');
					}

					if (!joined) {
						joined = "";
					}

					joinedMark = [];

					if (markVal) {
						$.each(markVal, function (i, v) {
							joinedMark.push("." + v + joined);
						});

						joined = joinedMark.join(",");
					}

					joinedBody = [];

					if (bodyVal) {
						$.each(bodyVal, function (i, v) {
							var mark = joined.split(',');
							$.each(mark, function (j, x) {
								joinedBody.push("." + v + x);
							})
						});

						joined = joinedBody.join(",");
					}
					console.log(joined);

					$(".tile").hide();
					$(joined).fadeIn("fast").addClass('--count').css('display', 'flex');

				}

				var query = $('#filterQuery').val().toLocaleLowerCase().split(' ');
				var searchPriceMin = $('input[name="searchPriceMin"]').val();
				var searchPriceMax = $('input[name="searchPriceMax"]').val();
				var clientTypeVal = $('input[name="clientType"]:checked').val();
				var odRekiVal = $('input[name="odReki"]').prop('checked');

				$('.tile').each(function () {
					var priceVal = $(this).attr('data-price');
					var individual = $(this).attr('data-individual');
					var bussiness = $(this).attr('data-business');
					var priceValue = $(this).attr('data-price');
					var odReki = $(this).attr('data-hand');

					var carnameVal = $(this).attr('data-carname').toLocaleLowerCase();
					if (parseInt(priceVal) < parseInt(searchPriceMin)) {
						$(this).hide().removeClass('--count');
					}
					if (parseInt(priceVal) > parseInt(searchPriceMax)) {
						$(this).hide().removeClass('--count');
					}
					if (clientTypeVal === 'individual' && individual !== '1') {
						$(this).hide().removeClass('--count');
					}
					if (clientTypeVal === 'bussiness' && bussiness !== '1') {
						$(this).hide().removeClass('--count');
					}
					if (clientTypeVal === 'individual') {
						$(this).find('.tile_priceValue').text(Math.round(priceValue * 1.23).toFixed(0).toString().replace('.', ','));
					} else if (clientTypeVal === 'bussiness') {
						$(this).find('.tile_priceValue').text(priceValue);
					}
					if (odRekiVal && odReki !== '1') {
						$(this).hide().removeClass('--count');
					}
					for (var i = 0; i < query.length; i++) {
						if (carnameVal.indexOf(query[i]) < 0) {
							$(this).hide().removeClass('--count');
						}
					}
				});

				$("#searchResultsCount").text($(".--count").length);

			}

			//
			$(".searchSubmitBtn").on("click", function (e) {
				searchDefaultInner();
				$("#searchLoader").show();
				$('html, body').animate({ scrollTop: $('.sort_settings').offset() - $('.navbar').height() }, 500, 'swing', function () {
					$("#searchLoader").hide();
				});
				e.preventDefault();
			});

			$('.floteo__search-radio-input').on('change', function (e) {
				searchDefaultInner();
				$("#searchLoader").show();
				$('html, body').animate({ scrollTop: $('.sort_settings').offset() - $('.navbar').height() }, 500, 'swing', function () {
					$("#searchLoader").hide();
				});
				e.preventDefault();
			});

			searchDefaultInner();

			$("#sort_change").change();

			$.each(values, function (index, id) {
				if ($.fn.chosen) {
					$('#filter' + id).chosen();
				}
			});
			initTitleAnimation();
		}

		if ($('input[name="searchMarkInput"]').length > 0) {
			searchDefault();
		}

		if ($('#f_numbers').length) {
			var fin = $('#f_numbers').offset().top;
			var h;
			$(document).on("scroll", function () {
				h = $(window).scrollTop();

				if (h >= (fin - 470)) {
					$('.floteoInNumbers .number').each(function () {
						$(this).prop('Counter', 0).animate({
							Counter: $(this).attr('number')
						}, {
							duration: 4000,
							easing: 'swing',
							step: function (now) {
								$(this).text(Math.ceil(now));
							}
						});
					});
				}
			});
		}

		$('.btn_download_pdf').on('click', function (e) {
			$('#modalDownloadPDF').modal('show');

			e.preventDefault();
			e.stopPropagation();
		});

		var pdf = $('.pdf_file').attr("href");
		pdf = 'http://' + window.location.hostname + '/download.php?file=' + pdf;
		$('#sendAndDownload').attr("download", pdf);

	});

	function setOfferText() {
		var spliitedHref = window.location.href.split('#subject:');
		var subject = spliitedHref[1];

		if (subject) {
			$('input[name="subject"]').val(subject.replace(new RegExp('%20', 'g'), ' '));
		}
	}

	function getIcon(type) {
		switch (type) {
			case "hatchback":
				return `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 765 281.8">
					<g>
						<path fill="currentColor" d="M752.6,143c-1.8-3.2-1.5-14.8-1.5-14.8c1.3-19.8-1.5-41.1-1.5-41.1c-0.4-3.4-13.1-9.8-13.1-9.8
							c-3.3-1.5-5.2-3-5.2-3c-14-12.3-66-52.6-66-52.6c-7.4-6.9-17.8-12.4-17.8-12.4c-1.1-0.5-2.7-1-4.6-1.4c0.7,0.1,1.1,0.1,1.1,0.1
							c-1-0.2-2-0.4-3.1-0.6c-17.6-3.7-56.1-5.6-57-5.7c-82.8-4.4-186.5,0.9-186.5,0.9c-18,0.4-49.2,4.7-65.3,11.7
							c-56,24.3-114.6,73.2-114.6,73.2c-89.8,16.8-154.4,33-154.4,33c-15.4,4.6-41.5,17.3-49.2,33c-2,4.1-6.3,12.8-6.5,23.3
							c-1.3,17-2,15.5-2,15.5c-5.7,4.3-5.5,10.7-5.5,19c0,7.8-0.1,26.8,8.5,30c8,3,47.5,3.7,73.5,3.8c-3.2-8-5-16.8-5-26
							c0-38.8,31.5-70.3,70.3-70.3c38.8,0,70.3,31.5,70.3,70.3c0,8.7-1.6,16.9-4.4,24.6l350.9-4.6c-1.9-6.3-2.9-13.1-2.9-20
							c0-38.8,31.5-70.3,70.3-70.3s70.3,31.5,70.3,70.3c0,4.1-0.4,8.2-1.1,12.1l0.6,0.7h13.5c24.3-1,43.8-22.3,43.8-22.3
							c6-4.5,6.5-8.2,6.5-8.2v-36.8C765,159.5,752.6,143,752.6,143z M596,85.5c-45.7,9.3-324.2,15-324.2,15c-7.5,0.1-14,0-17.3-0.3
							c-4.1-0.4-4.9-2-4.9-2c-0.8-1.5-0.5-3.4,3.2-6.6c49.7-43.4,91.5-61,91.5-61C386,13,592,19.5,592,19.5c26,20.7,41.3,48,41.3,48
							C629.7,71.5,596,85.5,596,85.5z"/>
						<path fill="currentColor" d="M631.3,156.4c-34.6,0-62.7,28.1-62.7,62.7c0,7,1.2,13.7,3.3,19.9c8.3,24.8,31.8,42.8,59.4,42.8
							c33.2,0,60.5-26,62.5-58.6c0.1-1.3,0.1-2.7,0.1-4C694,184.6,665.9,156.4,631.3,156.4z M631.3,259.8c-15.8,0-29.6-9.1-36.3-22.3
							c-2.8-5.5-4.4-11.8-4.4-18.4c0-22.4,18.3-40.7,40.7-40.7c20.3,0,37.1,14.9,40.2,34.3c0.3,2.1,0.5,4.2,0.5,6.4
							C672,241.6,653.8,259.8,631.3,259.8z"/>
						<path fill="currentColor" d="M147.2,156.4c-34.6,0-62.7,28.1-62.7,62.7c0,9.3,2,18.1,5.7,26c9.9,21.6,31.7,36.6,57,36.6
							c25.8,0,48-15.7,57.6-38c3.3-7.6,5.1-15.9,5.1-24.7C209.9,184.6,181.8,156.4,147.2,156.4z M147.2,259.8c-12.6,0-23.9-5.8-31.4-14.8
							c-5.8-7-9.3-16.1-9.3-25.9c0-22.4,18.3-40.7,40.7-40.7c22.4,0,40.7,18.3,40.7,40.7c0,9.4-3.2,18.1-8.7,25.1
							C171.8,253.7,160.2,259.8,147.2,259.8z"/>
					</g>
				</svg>`;
			case "sedan":
				return `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 993.9 298.3">
					<g>
						<path fill="currentColor" d="M983.9,180.2c-1.2-0.7-5.5-1.5-9.2-7.5c-3.7-6-4-12.7-4-12.7c-0.8-15.5-3.3-45.8-3.3-45.8
							c-6-44.3-33.7-38.9-33.7-38.9h-77.7C753.4-7.2,574.1-6.1,486.7,5.9c-87.3,12-179.3,77.3-179.3,77.3C131.3,108.8,32.8,139,32.8,139
							c-15.4,4.6-20.1,14.6-20.6,25.2c-0.2,4.7-0.2,4.5-0.4,15.1c-0.4,5-0.3,8.5-0.5,11.4c-0.4,8.2-3.4,8.6-3.4,8.6
							c-5.7,4.3-7.3,7.8-7.6,16.1c0,0.7-1.5,23.1,1.4,34.8c1.1,4.3,3.3,6.1,5.6,7c12.2,4.5,62.7,4.3,62.7,4.3l10.8-0.2l-0.2,0.2h11.5
							c-4.1-9.4-6.4-19.9-6.4-30.8c0-42.5,34.5-77,77-77s77,34.5,77,77c0,11-2.3,21.4-6.4,30.8h466.1c-4.1-9.4-6.4-19.9-6.4-30.8
							c0-42.5,34.5-77,77-77s77,34.5,77,77c0,11-2.3,21.4-6.4,30.8h14.5c118.5,0,126.7-14.7,126.7-14.7c11.8-6.2,12.2-19.5,12.2-19.5
							v-34.2C993.9,183.5,985.1,180.8,983.9,180.2z M770.8,86.6l-409,8.6c-2.8,0-4.3,0-6.3-1.3c-1.7-1-2.4-2.9-2.5-4.3
							c-0.2-3.2,2.4-4.7,2.4-4.7c36.7-27.4,87-45.1,87-45.1c44.9-17.6,136.3-17.5,136.3-17.5c77.2,0,117.1,18,134.6,25.8
							c17.5,7.8,60.3,33.7,60.3,33.7s1.5,1,1.5,2.4C775.2,85.1,775,86.6,770.8,86.6z"/>
						<path fill="currentColor" d="M162.8,163.1c-37.3,0-67.6,30.3-67.6,67.6c0,11.1,2.7,21.6,7.5,30.8c11.2,21.8,34,36.8,60.2,36.8
							s49-15,60.2-36.8c4.8-9.2,7.5-19.7,7.5-30.8C230.5,193.4,200.1,163.1,162.8,163.1z M162.8,276.3c-13.3,0-25.3-5.7-33.6-14.8
							c-7.4-8.1-12-18.9-12-30.8c0-25.2,20.5-45.6,45.6-45.6s45.6,20.5,45.6,45.6c0,11.9-4.6,22.7-12,30.8
							C188.1,270.6,176.1,276.3,162.8,276.3z"/>
						<path fill="currentColor" d="M770,163.1c-37.3,0-67.6,30.3-67.6,67.6c0,11.1,2.7,21.6,7.5,30.8c11.2,21.8,34,36.8,60.2,36.8
							s49-15,60.2-36.8c4.8-9.2,7.5-19.7,7.5-30.8C837.7,193.4,807.3,163.1,770,163.1z M770,276.3c-13.3,0-25.3-5.7-33.6-14.8
							c-7.4-8.1-12-18.9-12-30.8c0-25.2,20.5-45.6,45.6-45.6s45.6,20.5,45.6,45.6c0,11.9-4.6,22.7-12,30.8
							C795.3,270.6,783.3,276.3,770,276.3z"/>
					</g>
				</svg>`;
			case "kombi":
				return `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 988.6 317.7">
					<g>
						<path fill="currentColor" d="M978.9,169.5c-0.8-1-2.1-2.9-2.8-6.1c-0.7-3.1-1-13.9-1-13.9c-0.8-15.4-3.3-33.5-3.3-33.5
							C971.4,98.5,958,88.3,958,88.3s-17.3-16.2-48.1-38.1c-19.3-13.7-34.5-24.5-34.5-24.5C839.1,4,594.2-7,507.5,4.9
							c-50.4,6.9-93.1,30-169.6,69.6c-7.6,3.9-31.4,18.3-42,19c-160.7,15.2-235.7,37.2-235.7,37.2c-20,4.3-34.2,18.6-37.5,30.3
							c-2,7.1-8.4,28.1-9.4,30.9c-2.6,7.7-4.2,8.7-4.2,8.7c-5.6,4.3-7.2,7.7-7.5,16c0,0.6-3.3,23-0.4,34.6c1.1,4.3,3.3,6.1,5.6,7
							c12.1,4.5,40.7,7.4,63.6,9.2c15.6,1.2,31.6,1.9,42.1,2.3c-1.6-6.3-2.5-12.8-2.5-19.6c0-42.5,34.5-77,77-77c42.5,0,77,34.5,77,77
							c0,5.4-0.6,10.7-1.6,15.8l443.3-3.1c-0.7-4.1-1.1-8.4-1.1-12.7c0-42.5,34.5-77,77-77c42.5,0,77,34.5,77,77c0,4.1-0.3,8.1-0.9,12
							l58.1-0.9c30.3-0.4,60.8-13.4,60.8-13.4c11.8-6.1,12.1-19.4,12.1-19.4v-42.5C988.6,176.3,983.8,175.5,978.9,169.5z M897.5,88.7
							c-2.8,2.3-17.7,11.9-23.1,11.9c0,0-515.7,17.3-530.2,13.1c0,0-9.2-1.8,0-10.1c0,0,106.3-65.1,159-71.3c0,0,101.6-21.9,294.8,2.2
							c0,0,36.6,2.2,55.9,16.1c0,0,39.7,30.6,43.6,35.4C897.5,86,899.3,87.2,897.5,88.7z"/>
						<path fill="currentColor" d="M187,182.4c-37.3,0-67.6,30.3-67.6,67.6c0,6.9,1,13.6,3,19.9c8.5,27.6,34.3,47.7,64.7,47.7
							c31.9,0,58.6-22.1,65.8-51.8c1.2-5.1,1.9-10.4,1.9-15.8C254.7,212.8,224.3,182.4,187,182.4z M187,295.7
							c-25.2,0-45.6-20.5-45.6-45.6c0,0,0,0,0,0c0-14.6,6.9-27.6,17.6-36c7.7-6.1,17.5-9.7,28.1-9.7c25.2,0,45.6,20.5,45.6,45.6
							S212.2,295.7,187,295.7z"/>
						<path fill="currentColor" d="M824.7,198c-11.7-9.7-26.8-15.6-43.2-15.6c-37.3,0-67.6,30.3-67.6,67.6c0,4.3,0.4,8.5,1.2,12.6
							c5.9,31.3,33.5,55,66.4,55c33.2,0,60.8-24,66.5-55.5c0.7-3.9,1.1-8,1.1-12.1c0-11.1-2.7-21.6-7.5-30.9
							C837.5,211,831.7,203.8,824.7,198z M781.6,295.7c-20.8,0-38.5-14.1-43.9-33.2c-1.1-4-1.7-8.1-1.7-12.5c0-18,10.5-33.6,25.7-41.1
							c6-2.9,12.8-4.6,19.9-4.6c25.2,0,45.6,20.5,45.6,45.6S806.7,295.7,781.6,295.7z"/>
					</g>
				</svg>`;
			case "crossover":
				return `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 869.8 369.9">
					<g>
						<path fill="currentColor" d="M863.4,197.8c-6.8-4-8.5-10.3-8.5-10.3c-1-3.1-1.4-14.3-1.5-22.4v-33.2c0,0,0.3-11.6-4.3-18.4l-46.3-73.1
							c0,0-14.9-19.8-21.4-24.7C774.2,10.2,767,4.8,749,4.5c0,0-174.3-13.2-309,5.6c-21.1,2.9-40.8,11.5-50.9,17.5l-139.2,82.5
							C113,128.6,73.4,140.3,73.4,140.3c-14.3,4.3-32.7,12.4-43,20.7c-9.5,7.6-16.8,24.7-17.5,34.8c-0.4,4.6-2,17.6-2.1,20.3
							c-0.4,7.6-3.1,8-3.1,8c-5.2,4-6.7,7.2-7,14.9c0,0.6-1.8,38.7,0.9,49.6c1,4,4.2,7.2,6.3,8.1c17.4,7.5,82.9,5.8,82.9,5.8l7-2.5
							c-0.1-1.4-0.1-2.8-0.1-4.3c0-46.2,37.5-83.7,83.7-83.7c45.2,0,82,35.8,83.7,80.6l315.6-3.8l42.3,1.7c2.7-43.8,39.1-78.5,83.6-78.5
							c45.5,0,82.6,36.4,83.7,81.7c10.7,2.1,35.7-1.9,43.3-3.1c6.7-1.1,30-20.5,32.7-27.5c2.1-5.5,2.6-12.5,2.6-12.5l1.1-34
							C869.8,207.9,868.4,200.7,863.4,197.8z M753.1,108.9l-421.7,17.4l-17-19.3l0,0v0l76.9-52.9c0,0,2.2-1.5,6.1-3.6
							c8.8-4.9,26-13.6,43.8-17.7c9.3-2.1,20.6-4.3,32.8-5.3c0,0,30.1-5.6,177.5-4.7c0,0,24.6-0.1,45,3.1c8.7,1.4,20.5,6.7,26.3,17.1
							c0,0,6.3,9.6,11.8,21.1S753.1,108.9,753.1,108.9L753.1,108.9L753.1,108.9z"/>
						<path fill="currentColor" d="M181.3,369.9c40.9,0,74.2-33.3,74.2-74.2c0-1,0-2-0.1-3c-1.6-39.5-34.2-71.1-74.1-71.1
							c-40.9,0-74.2,33.3-74.2,74.2c0,0.3,0,0.6,0,0.9C107.7,337.2,140.7,369.9,181.3,369.9z M129.2,294.1c0.9-28,23.9-50.5,52.1-50.5
							c27.8,0,50.6,21.9,52.1,49.4c0,0.9,0.1,1.9,0.1,2.8c0,28.8-23.4,52.2-52.2,52.2s-52.2-23.4-52.2-52.2
							C129.1,295.2,129.2,294.7,129.2,294.1z"/>
						<path fill="currentColor" d="M706.4,369.9c40.9,0,74.2-33.3,74.2-74.2c0-0.3,0-0.6,0-0.8c-0.4-40.5-33.5-73.3-74.1-73.3
							c-39.3,0-71.5,30.7-74,69.3c-0.1,1.6-0.2,3.2-0.2,4.8C632.3,336.7,665.5,369.9,706.4,369.9z M654.4,291.8c2-26.9,24.6-48.2,52-48.2
							c28.8,0,52.2,23.4,52.2,52.2c0,0.1,0,0.2,0,0.3c-0.2,28.6-23.5,51.9-52.1,51.9c-28.8,0-52.2-23.4-52.2-52.2
							C654.3,294.4,654.3,293.1,654.4,291.8z"/>
					</g>
				</svg>`;
			case "suv":
				return `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 936.2 378.8">
					<g>
						<path fill="currentColor" d="M929.8,206.6c-6.8-4-8.5-10.3-8.5-10.3c-1-3.1-1.4-14.3-1.5-22.4v-33.2c0,0,0.3-11.6-4.3-18.4L857.9,17.5
							c0,0-8.4-10.2-18.1-13.7c-6.8-2.4-13-3.8-24.8-3.8H534.3c0,0-50-1-91.8,5.3c-21,3.2-39.4,10-49.5,16l-132.9,97.6
							c-136.9,18.5-217.9,37.5-217.9,37.5c-14.3,4.3-24.1,9.5-27.7,23.1c-1.1,4.2-1.6,6.8-2.3,16.9c-0.4,4.6-2,25.9-2.1,28.6
							c-0.4,7.6-3.1,8-3.1,8c-5.2,4-6.7,7.2-7,14.9c0,0.6-0.5,37.8,2.1,48.6c1,4,4.2,7.2,6.3,8.1c17.4,7.5,92.4,6.7,92.4,6.7l7-2.5
							c-0.1-1.4-0.1-2.8-0.1-4.3c0-46.2,37.5-83.7,83.7-83.7c45.2,0,82,35.8,83.7,80.6l364.3-3.8l42.3,1.7c2.7-43.8,39.1-78.5,83.6-78.5
							c45.5,0,82.6,36.4,83.7,81.7c16.5-2.4,39.6-5.9,52.3-9.4c21.2-5.9,28.5-14.3,31.2-21.3c2.1-5.5,2.6-12.5,2.6-12.5l1.1-34
							C936.2,216.7,934.7,209.6,929.8,206.6z M468.5,27.3c0,0,55.2-4.7,285.5-1.4c0,0,9.9,0.2,15.7,6.7l11.8,17.8l30.4,67.2l-470.4,17.4
							l-21.2-23.3l79.8-64.7c0,0,15.2-12,37-16.2C446.6,29.1,457,27.3,468.5,27.3z"/>
						<path fill="currentColor" d="M191.5,230.4c-40.9,0-74.2,33.3-74.2,74.2c0,0.3,0,0.6,0,0.9c0.5,40.5,33.6,73.2,74.1,73.2
							c40.9,0,74.2-33.3,74.2-74.2c0-1,0-2-0.1-3C264,262.1,231.4,230.4,191.5,230.4z M191.5,356.8c-28.8,0-52.2-23.4-52.2-52.2
							c0-0.6,0-1.1,0-1.7c0.9-28,23.9-50.5,52.1-50.5c27.8,0,50.6,21.9,52.1,49.4c0,0.9,0.1,1.9,0.1,2.8
							C243.7,333.4,220.3,356.8,191.5,356.8z"/>
						<path fill="currentColor" d="M765.3,230.4c-39.3,0-71.5,30.7-74,69.3c-0.1,1.6-0.2,3.2-0.2,4.8c0,40.9,33.3,74.2,74.2,74.2
							s74.2-33.3,74.2-74.2c0-0.3,0-0.6,0-0.8C839,263.3,805.9,230.4,765.3,230.4z M765.3,356.8c-28.8,0-52.2-23.4-52.2-52.2
							c0-1.3,0.1-2.6,0.2-3.9c2-26.9,24.6-48.2,52-48.2c28.8,0,52.2,23.4,52.2,52.2c0,0.1,0,0.2,0,0.3C817.3,333.5,794,356.8,765.3,356.8
							z"/>
					</g>
				</svg>`;
			case "dostawcze":
				return `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1020.1 441.1">
					<g>
						<path fill="currentColor" d="M1011.2,284h-5.7c8.3-119.7-19.9-270.6-19.9-270.6C982.3-0.9,969.8,0,969.8,0H415c-11.6,0-33.6,2.1-40.8,3.3
							c-7.1,1.2-33.6,14.6-33.6,14.6C307.3,39.3,140,190.5,140,190.5c-10.7,11.9-18.5,14.9-18.5,14.9l-52.4,18.5
							c-18.5,6.5-36.9,47.6-36.9,47.6c-3,0-10.1,4.8-10.1,4.8c-6,6.5-20.2,50-22,85.1c-1.8,35.1,25,35.7,25,35.7l80.3-1.1
							c-3.3-9-5.1-18.8-5.1-29c0-46.7,37.9-84.6,84.6-84.6s84.6,37.9,84.6,84.6c0,9.4-1.5,18.3-4.3,26.8l139.7-1.9l4.3-0.1l299.7-4.2
							c-1.6-6.6-2.5-13.5-2.5-20.6c0-46.7,37.9-84.6,84.6-84.6s84.6,37.9,84.6,84.6c0,6.3-0.7,12.4-2,18.3l135.5-1.9
							c9.9,0,11.2-6.8,11.2-6.8V298C1020.1,283.4,1011.2,284,1011.2,284z M386.6,174.8c-11.2,36.8-66.3,37.6-66.3,37.6
							c-70.4,4.3-133.4,1.6-133.4,1.6c-14.5-0.7-4.1-17.2-2.3-20.7c1.8-3.4,18.7-21.7,18.7-21.7L289.2,94c23.7-21.4,49-18.6,53.8-19.8
							c4.8-1.2,50.6,0.5,50.6,0.5c13,0.7,11.6,12.6,11.6,12.6C403.7,111.5,386.6,174.8,386.6,174.8z"/>
						<path fill="currentColor" d="M184.9,292.8c-39.3,0-71.5,30.7-74,69.3c-0.1,1.6-0.2,3.2-0.2,4.8c0,10.2,2.1,20,5.8,28.8
							c11.3,26.6,37.7,45.3,68.3,45.3c31.4,0,58.3-19.6,69.1-47.2c3.3-8.3,5.1-17.4,5.1-26.9c0-0.3,0-0.6,0-0.8
							C258.6,325.6,225.5,292.8,184.9,292.8z M184.9,419.1c-18.3,0-34.3-9.4-43.7-23.7c-5.4-8.2-8.5-18-8.5-28.5c0-1.3,0.1-2.6,0.2-3.9
							c2-26.9,24.6-48.2,52-48.2c28.8,0,52.2,23.4,52.2,52.2c0,0.1,0,0.2,0,0.3c-0.1,9.9-2.9,19.1-7.7,27
							C220.1,409.2,203.7,419.1,184.9,419.1z"/>
						<path fill="currentColor" d="M790.9,292.8c-39.3,0-71.5,30.7-74,69.3c-0.1,1.6-0.2,3.2-0.2,4.8c0,7.1,1,13.9,2.9,20.4
							c8.9,31,37.5,53.7,71.3,53.7c34.5,0,63.6-23.7,71.8-55.7c1.5-5.9,2.3-12.1,2.3-18.4c0-0.3,0-0.6,0-0.8
							C864.5,325.6,831.5,292.8,790.9,292.8z M790.9,419.1c-21.6,0-40.2-13.2-48.1-32c-2.6-6.2-4-13-4-20.1c0-1.3,0.1-2.6,0.2-3.9
							c2-26.9,24.6-48.2,52-48.2c28.8,0,52.2,23.4,52.2,52.2c0,0.1,0,0.2,0,0.3c0,6.5-1.3,12.7-3.5,18.5
							C831.9,405.3,813,419.1,790.9,419.1z"/>
					</g>
				</svg>`;
		}
	}

	function select2Event(e) {
		var select2 = $(e.currentTarget);
		var selection = select2.parent().find('.select2-selection__rendered');
		var data = select2.select2('data');

		if (data && data.length > 0) {
			if (selection.find('.floteo-custom-select2-value').length > 0) {
				selection.find('.floteo-custom-select2-value').text('Wybrano: ' + data.length).show();
			} else {
				selection.append('<li class="floteo-custom-select2-value">Wybrano: ' + data.length + '</li>');
			}
			selection.find('.select2-search').css({
				width: 0,
				opacity: 0
			});
		} else {
			selection.find('.select2-search').css({
				width: 'auto',
				opacity: 1
			});
			selection.find('.floteo-custom-select2-value').hide();
		}
	}

	initSorting();

	// CALC

	function calculate() {

		var url = base_url + "/wp-json/floteocars/v1/calc_calculate/";


		var data = jQuery("#floteocars_calc").serialize();

		$(".loading").show();
		$.post(url, data)
			.done(function (result, status, xhr) {

				jQuery(".calc_result").hide();

				$(".loading").hide();

				if (result.calc_rabat_floteo) {

					$('html, body').animate({
						scrollTop: $("#calc_calculationScrollTo").offset().top
					}, 1000);

					$("#calc_rabat_floteo").html(result.calc_rabat_floteo);

					if (jQuery("#calc_stan").val() == "używany") {
						jQuery(".calc_result:eq(1)").show();
						jQuery(".calc_result:eq(2)").show();

					} else {
						jQuery(".calc_result").show();
					}

				}

				if (result.calc_rata_po_rabacie_floteo_netto) {
					$("#calc_rata_po_rabacie_floteo_netto").html(result.calc_rata_po_rabacie_floteo_netto);
				}

				if (result.calc_rata_z_twoim_rabatem_netto) {
					$("#calc_rata_z_twoim_rabatem_netto").html(result.calc_rata_z_twoim_rabatem_netto);
				}

				if (result.calc_rata_w_abonamencie_netto) {
					$("#calc_rata_w_abonamencie_netto").html(result.calc_rata_w_abonamencie_netto);
				} else {
					jQuery(".calc_result:eq(2)").hide();
				}


				if (result.calc_rabat_floteo) {
					$("#calc_rata_w_abonamencie").html(result.calc_rata_w_abonamencie);
				}

				if (result.calc_rata_po_rabacie_floteo) {
					$("#calc_rata_po_rabacie_floteo").html(result.calc_rata_po_rabacie_floteo);
				}

				if (result.calc_rata_z_twoim_rabatem) {
					jQuery(".calc_result:eq(1)").show();
					$("#calc_rata_z_twoim_rabatem").html(result.calc_rata_z_twoim_rabatem);
				}

				if (result.calc_rabat_floteo_perc) {
					$("#calc_rabat_floteo_perc").html(result.calc_rabat_floteo_perc);
				}

				if (result.calc_rabat_floteo) {
					$("#calc_rabat_floteo").html(result.calc_rabat_floteo);
				}

				if (result.calc_rabat_client_perc) {
					$("#calc_rabat_client_perc").html(result.calc_rabat_client_perc);
				}

				if (result.calc_rabat_client) {
					$("#calc_rabat_client").html(result.calc_rabat_client);
				}


				if (result.calc_abonament_oplata_wstepna) {
					$("#calc_abonament_oplata_wstepna").html(result.calc_abonament_oplata_wstepna);
				}

				if (result.calc_abonament_ilosc_rat) {
					$("#calc_abonament_ilosc_rat").html(result.calc_abonament_ilosc_rat);
				}
				if (result.calc_abonament_informacje) {
					$("#calc_abonament_informacje").html(result.calc_abonament_informacje);
				}




			})
			.fail(function (xhr, status, error) {

				//$("#message").html("Result: " + status + " " + error + " " + xhr.status + " " + xhr.statusText)
			});

	}

	function initTitleAnimation() {
		$('.move-title').off();

		$('.move-title').mouseenter(function () {
			var title = $(this).find('.tile__name-wrap');

			if (title.length > 0) {
				var titleName = title.find('.tile__name');
				var maxMove = titleName.width() - title.width();
				var maxTime = 1500;
				var maxMoveDef = 200;
				var time = maxTime * maxMove / maxMoveDef;

				if (maxMove > 0) {
					titleName.stop(true, false).animate({
						left: (-1) * maxMove
					}, time);
				}
			}
		});

		$('.move-title').mouseleave(function () {
			var title = $(this).find('.tile__name-wrap');

			if (title.length > 0) {
				var titleName = title.find('.tile__name');

				titleName.stop(true, false).animate({
					left: 0
				}, 500);
			}
		});
	}

	function initSelectboxes() {

		var selectBoxes = [{
			elem: $('select[name="searchMark"] option'),
			input: $('input[name="searchMarkInput"]').val()
		}, {
			elem: $('select[name="searchBody"] option'),
			input: $('input[name="searchBodyInput"]').val()
		}, {
			elem: $('select[name="searchFuel"] option'),
			input: $('input[name="searchFuelInput"]').val()
		}, {
			elem: $('select[name="searchGearbox"] option'),
			input: $('input[name="searchGearboxIput"]').val()
		}];

		selectBoxes.forEach(function (select) {
			select.elem.each(function () {
				var val = $(this).val();
				if (val == select.input) {
					$(this).attr('selected', 'selected');
				}
			});
		});
	}

	function bestsellerCarousel() {
		var i = 1;

		var bestsellerInterval = setInterval(function () {
			$('.bestseller__wrap').animate({
				'scrollLeft': i * ($('.bestseller__item').width() + 15)
			}, 500, 'swing', function () {
				i = (i + 1) % 3;
			});
		}, 5000);
	}

	function initSorting() {
		$("#sort_change").change(function () {

			var sort = $(this).val();

			if (sort == 'popular') {
				var sorted = $('#listingList .tile').sort(function (a, b) {
					var contentA = parseInt($(a).data('best'));
					var contentB = parseInt($(b).data('best'));
					return (contentA < contentB) ? -1 : (contentA > contentB) ? 1 : 0;
				});
				var container = $("#listingList");
				container.empty().append(sorted);

				var sorted = $('#listingTiles .listingtile').sort(function (a, b) {
					var contentA = parseInt($(a).data('best'));
					var contentB = parseInt($(b).data('best'));
					return (contentA < contentB) ? -1 : (contentA > contentB) ? 1 : 0;
				});
				var container = $("#listingTiles");
				container.empty().append(sorted);



			} else if (sort == 'price_asc') {
				var sorted = $('#listingList .tile').sort(function (a, b) {
					var contentA = parseInt($(a).data('price'));
					var contentB = parseInt($(b).data('price'));

					return (contentA < contentB) ? -1 : (contentA > contentB) ? 1 : 0;
				});
				var container = $("#listingList");
				container.empty().append(sorted);

				var sorted = $('#listingTiles .listingtile').sort(function (a, b) {
					var contentA = parseInt($(a).data('price'));
					var contentB = parseInt($(b).data('price'));

					return (contentA < contentB) ? -1 : (contentA > contentB) ? 1 : 0;
				});
				var container = $("#listingTiles");
				container.empty().append(sorted);

			} else if (sort == 'price_desc') {
				var sorted = $('#listingList .tile').sort(function (a, b) {
					var contentA = parseInt($(a).data('price'));
					var contentB = parseInt($(b).data('price'));

					return (contentA > contentB) ? -1 : (contentA < contentB) ? 1 : 0;
				});
				var container = $("#listingList");
				container.empty().append(sorted);


				var sorted = $('#listingTiles .listingtile').sort(function (a, b) {
					var contentA = parseInt($(a).data('price'));
					var contentB = parseInt($(b).data('price'));

					return (contentA > contentB) ? -1 : (contentA < contentB) ? 1 : 0;
				});
				var container = $("#listingTiles");
				container.empty().append(sorted);

			} else if (sort == 'name_desc') {
				var sorted = $('#listingList .tile').sort(function (a, b) {
					var contentA = $(a).data('carname');
					var contentB = $(b).data('carname');

					return (contentA > contentB) ? -1 : (contentA < contentB) ? 1 : 0;
				});
				var container = $("#listingList");
				container.empty().append(sorted);

				var sorted = $('#listingTiles .listingtile').sort(function (a, b) {
					var contentA = $(a).data('carname');
					var contentB = $(b).data('carname');

					return (contentA > contentB) ? -1 : (contentA < contentB) ? 1 : 0;
				});
				var container = $("#listingTiles");
				container.empty().append(sorted);

			} else if (sort == 'name_asc') {
				var sorted = $('#listingList .tile').sort(function (a, b) {
					var contentA = $(a).data('carname');
					var contentB = $(b).data('carname');

					return (contentA < contentB) ? -1 : (contentA > contentB) ? 1 : 0;
				});
				var container = $("#listingList");
				container.empty().append(sorted);

				var sorted = $('#listingTiles .carname').sort(function (a, b) {
					var contentA = $(a).data('carname');
					var contentB = $(b).data('carname');

					return (contentA < contentB) ? -1 : (contentA > contentB) ? 1 : 0;
				});
				var container = $("#listingTiles");
				container.empty().append(sorted);
			}
		});
	}


	jQuery(document).ready(function () {


		jQuery("#calc_oblicz").click(function (e) {

			e.preventDefault();

			calculate();



		});


		jQuery("#floteo_info").click(function (e) {
			e.preventDefault();
			jQuery("#floteo_info_info").slideToggle("slow");
		});

		jQuery("#floteo_info2").click(function (e) {
			e.preventDefault();
			jQuery("#floteo_info_info2").slideToggle("slow");
		});

		jQuery("#calc_stan").change(function (e) {
			calculate();

			var val = jQuery(this).val();
			if (val == 'nowy') {
				jQuery("#calc_stan_label").text('Katalogowa cena samochodu');
				jQuery("#cena_sam_po_rab_cont").show();
			} else {
				jQuery("#calc_stan_label").text('Cena samochodu');
				jQuery("#cena_sam_po_rab_cont").hide();
			}
		});

		jQuery(".floteocars_calc_option").change(function () {

			//calculate();
		});


		jQuery("#calc_marka").change(function () {
			var term_id = jQuery(this).val();
			if (term_id) {
				var url = base_url + "/wp-json/floteocars/v1/calc_models/" + term_id;
				$(".loading").show();
				$.get(url, function (data) {
					var $dropdown = $("#calc_model");
					$dropdown.find('option').remove();
					if (data) {
						$dropdown.append($("<option />").val("").text("Wybierz"));
						$.each(data, function () {
							$dropdown.append($("<option />").val(this.id).text(this.name));
						});
					} else {
						$dropdown.append($("<option />").val("").text("Wybierz"));
					}
					$(".loading").hide();

				}, 'json');
			}
		});

		jQuery('#pierwsza_wplata .add').click(function () {
			var actual_val = parseInt(jQuery(this).prev().val());
			if (actual_val < 45) {
				var new_val = 5;
				if (actual_val >= 5) {
					new_val = parseInt(actual_val) + 5;
				}
				jQuery(this).prev().val(new_val).change();
			}
		});

		$('#pierwsza_wplata  .sub').click(function () {
			var actual_val = parseInt(jQuery(this).next().val());
			if (actual_val > 1) {
				var new_val = 5;
				if (actual_val == 5) {
					new_val = 1;
				} else {
					new_val = actual_val - 5;
				}
				jQuery(this).next().val(new_val).change();
			}
		});

		jQuery('#okres_leasingu .add').click(function () {
			var actual_val = parseInt(jQuery(this).prev().val());
			if (actual_val < 84) {
				new_val = parseInt(actual_val) + 12;
				jQuery(this).prev().val(new_val);
			}
		});

		$('#okres_leasingu  .sub').click(function () {
			var actual_val = parseInt(jQuery(this).next().val());
			if (actual_val > 24) {
				new_val = actual_val - 12;
				jQuery(this).next().val(new_val).change();
			}
		});

		jQuery('#wykup .add').click(function () {
			var actual_val = parseInt(jQuery(this).prev().val());
			if (actual_val < 35) {
				var new_val = 5;
				if (actual_val >= 5) {
					new_val = parseInt(actual_val) + 5;
				}
				jQuery(this).prev().val(new_val).change();
			}
		});

		$('#wykup  .sub').click(function () {
			var actual_val = parseInt(jQuery(this).next().val());
			if (actual_val > 1) {
				var new_val = 5;
				if (actual_val == 5) {
					new_val = 1;
				} else {
					new_val = actual_val - 5;
				}
				jQuery(this).next().val(new_val).change();
			}
		});

	});

	jQuery(document).ready(function () {
		jQuery('.homeheaderMobile__slider').slick({
			dots: false,
			arrows: false,
			infinite: false,
			speed: 300,
			slidesToShow: 1
		});
	});
	
	jQuery(document).ready(function(){
		jQuery('.floteo__search-markSelect').multiSelect();
		jQuery('.floteo__search-multiSelect').multiSelect();

		jQuery('.multi-select-menuitem input').after('<span class="multi-select-check"><i class="fas fa-check"></i></span>');
		jQuery('.markSelect .multi-select-menuitems').after('<span class="multi-select-uncheck">Wyczyść zaznaczenie</span>');

		jQuery('.multi-select-uncheck').click(function(){
			$('.multi-select-menuitem input').removeAttr('checked');
		});
		$('#filterQuery').keypress(function() {
			if ($(this).val().length >= 2){
				setTimeout(function(){
					$('.searchSubmitBtn').trigger('click');
				}, 1500)
			}
		});
		jQuery('.rentPage__left .mobileBtn').on('click', function(){
			$(this).parent().toggleClass('moveon');
			$('.searchOverlay').toggleClass('active');
		});
		jQuery('.searchOverlay').on('click', function(){
			$('.rentPage__left').removeClass('moveon')
			$(this).removeClass('active');
		});
	});
})(jQuery);
