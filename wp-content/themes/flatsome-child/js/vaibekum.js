/* HỖ TRỢ ONLINE */
jQuery(document).ready(function($) {

    var hover = true;
    $(".vbk-support").hover(function() {
        if (hover === true) {
            $('.contact-show-info').addClass('open-show-support-online');
            hover = false;
        } else {
            $('.contact-show-info').removeClass('open-show-support-online');
            hover = true;
        }
    });
    $(".owl-carousel").owlCarousel({
        loop: true,
        responsiveClass: true,
        margin: 0,
        dots: false,
        nav: true,
        navText: ['<svg class="flickity-button-icon" viewBox="0 0 100 100"><path d="M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z" class="arrow"></path></svg>', '<svg class="flickity-button-icon" viewBox="0 0 100 100"><path d="M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z" class="arrow" transform="translate(100, 100) rotate(180) "></path></svg>'],
        responsive: {
            0: {
                items: 2,
            },
            550: {
                items: 3,
            },
            850: {
                items: 5,
            }
        }
    });
    $('button.owl-prev').addClass('flickity-button flickity-prev-next-button previous');
    $('button.owl-next').addClass('flickity-button flickity-prev-next-button next');
    $('.menu li.menu-item-has-children>a').append('<i class="fas fa-angle-right"></i>');


    if ($(window).width() <= 992) {
        $('.menu li').click(function(e) {

            if ($(this).hasClass('has-child')) {

                e.preventDefault();
                $(this).find('ul').toggle();
                return false;
            }
        });

    }
    $('.wrap_add_cart a.ajax_add_to_cart').click(function() {
        $(document.body).on('added_to_cart', function() {
            $('.wrap_add_cart>a.added_to_cart').html('<i class="far fa-eye"></i>');
        })
    });

})

/* MOBILE */
$(document).ready(function() {
    if ($(window).width() < 768) {
        var showMobile = true
        $('#mega_menu li > .toggle').on('click', function(e) {
            if (showMobile == true) {
                $('.sub-menu').addClass('show-mobile');
                showMobile = false;
            } else {
                $('.sub-menu').removeClass('show-mobile');
                showMobile = true;
            }
        });
    }
});

$(document).ready(function() {

    if ($(window).width() < 320) {
        var showMobile = true
        $('#mega_menu li > .toggle').on('click', function(e) {
            if (showMobile == true) {
                $('.sub-menu').addClass('show-mobile');
                showMobile = false;
            } else {
                $('.sub-menu').removeClass('show-mobile');
                showMobile = true;
            }
        });
    }
});

$(document).ready(function() {

    if ($(window).width() < 1024) {
        var showMobile = true
        $('#mega_menu li > .toggle').on('click', function(e) {
            if (showMobile == true) {
                $('.sub-menu').addClass('show-mobile');
                showMobile = false;
            } else {
                $('.sub-menu').removeClass('show-mobile');
                showMobile = true;
            }
        })
    }

});

var hover = true;
$(".vbk-support").hover(function() {
    if (hover === true) {
        $('.contact-show-info').addClass('open-show-support-online');
        hover = false;
    } else {
        $('.contact-show-info').removeClass('open-show-support-online');
        hover = true;
    }
});

