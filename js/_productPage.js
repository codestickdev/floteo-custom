(function($){

    /* ---- Sliders ---- */

    $(document).ready(function(){
        $('.carpageSlider__slideWrap').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            infinite: false, 
            centerMode: true,
            variableWidth: true,
        });
        $('.carpageFinancial__slidesWrap').slick({
            arrows: true,
            dots: false,
            infinite: false,
            speed: 500,
            fade: true,
            cssEase: 'linear',
            prevArrow: $('.arrow--prev'),
            nextArrow: $('.arrow--next'),
            asNavFor: $('.carpageSlider__slideWrap'),
        });
    });

    $(document).ready(function(){
        $('.carSpecs').first().addClass('carSpecs--toggle');

        $('.arrow--prev, .arrow--next').on('click', function(){
            $(this).css('pointer-events', 'none');

            $('.carSpecs').removeClass('carSpecs--toggle');
            var carSlide = $('.carSlider__slide.slick-current').attr('car-data');
            var carPosition = $('.carSlider__slide.slick-current').attr('car-position');

            $('.carpageSlider__arrows').find('.currentCar').text(carPosition);
            setTimeout(function(){
                $('.arrow--prev, .arrow--next').css('pointer-events', 'all');
                $('.carSpecs[car-data="'+ carSlide +'"]').addClass('carSpecs--toggle');
            }, 500);
        });
    });
    $(document).ready(function(){
        var contentHeight = $('.carpageContent__content').first().outerHeight();
        $('.carpageContent__content').first().addClass('carpageContent__content--toggle');
        $('.carpageContent__cover').css('height', contentHeight);

        $('.arrow--prev, .arrow--next').on('click', function(){
            $('.carpageContent__content').removeClass('carpageContent__content--toggle');
            var carSlide = $('.carSlider__slide.slick-current').attr('car-data');

            setTimeout(function(){
                $('.carpageContent__content[spec-data="'+ carSlide +'"]').addClass('carpageContent__content--toggle');
                var contentHeight = $('.carpageContent__content[spec-data="'+ carSlide +'"]').outerHeight();
                $('.carpageContent__cover').css('height', contentHeight);
            }, 500);
        });
    });

    /* ---- Calculator ---- */

    $(document).ready(function(){
        $('.selectMethod__wrap').each(function(){
            var button = $(this).find('.selectMethod__method');

            $(button).on('click', function(){
                $('.selectMethod__method').removeClass('selectMethod__method--active');
                $(this).addClass('selectMethod__method--active');
            });
        });

        $('.selectPerson__wrap').each(function(){
            var button = $(this).find('.selectPerson__position');

            $(button).on('click', function(){
                $('.selectPerson__position').removeClass('selectPerson__position--active');
                $(this).addClass('selectPerson__position--active');
            });
        });

        $('.selectPeriod__position').on('click', function(){
            var checkbox = $(this).find('input');

            if($(checkbox).prop("checked") == true){
                $(this).parent().find('.selectPeriod__position').removeClass('selectPeriod__position--active');
                $(this).addClass('selectPeriod__position--active');
            }
        });

        $('.selectKilometers__position').on('click', function(){
            var checkbox = $(this).find('input');

            if($(checkbox).prop("checked") == true){
                $(this).parent().find('.selectKilometers__position').removeClass('selectKilometers__position--active');
                $(this).addClass('selectKilometers__position--active');
            }
        });
        $('.scrollButton').on('click', function(){
            var leftPos = $(this).parent().find('.selectKilometers__wrap').scrollLeft();
            $(".selectKilometers__wrap").animate({scrollLeft: leftPos + 200}, 300);
        });

        $('.selectServices__box').on('click', function(){
            var checkbox = $(this).find('input');

            if($(checkbox).prop("checked") == true){
                $(this).addClass('selectServices__box--checked');
            }else{
                $(this).removeClass('selectServices__box--checked');
            }
        });
    });
})(jQuery);