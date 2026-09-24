"use strict"; // Start of use strict

jQuery(document).on('ready', function() {

    // partners-slider-1
    if (jQuery(".partners-slider").length) {
        jQuery(".partners-slider").owlCarousel({
            autoplay: true,
            loop: true,
            autoplayHoverPause: true,
            pagination: false,
            dotsSpeed: 1000,
            smartSpeed: 1000,
            margin: 34,
            nav: false,
            items: 4,
            responsive : {
                0 : {
                    items: 1
                },
                450 : {
                    items: 2
                },
                767 : {
                    items: 3
                },
                992 : {
                    items: 3
                },
                1201 : {
                    items: 4
                },
                1366 : {
                    items: 4
                }
            }
        });
    };

   // 31. Tabs Box
    if($('.tabs-box').length){
        
        //Tabs
        $('.tabs-box .tab-buttons .tab-btn').on('click', function(e) {
            
            e.preventDefault();
            var target = $($(this).attr('data-tab'));
            
            target.parents('.tabs-box').find('.tab-buttons').find('.tab-btn').removeClass('active-btn');
            $(this).addClass('active-btn');
            target.parents('.tabs-box').find('.tabs-content').find('.tab').fadeOut(0);
            target.parents('.tabs-box').find('.tabs-content').find('.tab').removeClass('active-tab');
            $(target).fadeIn(300);
            $(target).addClass('active-tab');
        });
        
    }


    // testimonial-slider
    if (jQuery(".testimonial").length) {
        jQuery(".testimonial").owlCarousel({
            autoplay: true,
            loop: true,
            autoplayHoverPause: true,
            dotsEach: true,
            dotsSpeed: 1000,
            smartSpeed: 1000,
            pagination: true,
            nav: false,
            items: 1
        });
    };

    //Search Popup
    if($('#search-popup').length){
        
        //Show Popup
        $('.search-box-btn').on('click', function() {
            $('#search-popup').addClass('popup-visible');
        });
        
        //Hide Popup
        $('.close-search').on('click', function() {
            $('#search-popup').removeClass('popup-visible');
        });
    }

    // testimonial-slider
    if (jQuery(".pro-slider").length) {
        jQuery(".pro-slider").owlCarousel({
            autoplay: true,
            loop: true,
            autoplayHoverPause: true,
            smartSpeed: 1000,
            pagination: false,
            margin: 30,
            nav: true,
            items: 3,
            navElement: "span",
            navText: ["<span class='fa fa-angle-left'></span>","<span class='fa fa-angle-right'></span>"]
        });
    };

    // rev-slider-1
    if (jQuery("#slider1").length) {
        jQuery("#slider1").revolution({
            sliderType:"standard",
            sliderLayout:"fullwidth",
            delay:5000,
            navigation: {
                  keyboardNavigation:"on", 
                  keyboard_direction:"horizontal",
                  mouseScrollNavigation:"off",   
                  onHoverStop:"on",
                  arrows: {
                     style:"",
                     enable:true,
                     rtl:false,
                     hide_onmobile:false,
                     hide_onleave:false,
                     hide_delay:200,
                     hide_delay_mobile:1200,
                     hide_under:0,
                     hide_over:9999,
                     tmp: ''
                  }
                },
            gridwidth:1170,
            gridheight:780
        });

    };


    if (jQuery(".back2Top").length) {
        jQuery(".back2Top").on('click', function() {
            jQuery("html, body").animate({
                scrollTop: 0
            }, 500)
        });
    };

    // testimonial-slider
    if (jQuery(".mixit-gallery").length) {
        jQuery(".mixit-gallery").mixItUp({
                animation: {
                    duration: 400,
                    effects: 'fade translateZ(-360px) stagger(34ms)',
                    easing: 'cubic-bezier(0.55, 0.085, 0.68, 0.53)'
            }
        });
    };

    
    //LightBox / Fancybox
    if($('.lightbox-image').length) {
        $('.lightbox-image').fancybox({
            openEffect  : 'elastic',
            closeEffect : 'elastic',
            helpers : {
                media : {}
            }
        });
    }
    

        //Contact Form Validation
    if($('#contact-form').length){
        $('#contact-form').validate({
            rules: {
                firstname: {
                    required: true
                },
                lastname: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                website: {
                    required: true
                },
                message: {
                    required: true
                }
            }
        });
    }
    // 24. Mobile Nav Toggler
    if ($('.mainmenu-holder').length) {
        $('.mainmenu-holder .nav-footer .menu-expander').on('click', function () {
            $('.mainmenu-holder .nav-header').toggleClass('closed opened');
            return false;
        });
        $('.mainmenu-holder .nav-header .navigation li.dropdown').children('a').append(function () {
            return '<button class="dropdown-expander"><i class="fa fa-bars"></i></button>';             
        });
        $('.mainmenu-holder .nav-header .navigation .dropdown-expander').on('click', function () {
            var Self = $(this);
            Self.parent().parent().children('.submenu').toggleClass('closed opened');
            return false;
        });
    }



});



jQuery(window).on('scroll', function() {
    if (jQuery(".back2Top").length) {
        if (jQuery(this).scrollTop() > 100) {
            jQuery(".back2Top").fadeIn("slow")
        } else {
            jQuery(".back2Top").fadeOut("slow")
        }
    };
});


if (jQuery('.wow').length) {
    new WOW().init();
};

// 8. sticky header
function stickyHeader () {
    if ($('.stricky').length) {
        var strickyScrollPos = 700;
        if($(window).scrollTop() > strickyScrollPos) {
            $('.stricky').removeClass('slideIn animated');
            $('.stricky').addClass('stricky-fixed slideInDown animated');
            $('.scroll-to-top').fadeIn(500);
        }
        else if($(this).scrollTop() <= strickyScrollPos) {
            $('.stricky').removeClass('stricky-fixed slideInDown animated');
            $('.stricky').addClass('slideIn animated');
            $('.scroll-to-top').fadeOut(500);
        }
    };
}

// instance of fuction while Window Scroll event
jQuery(window).on('scroll', function () {   
    (function ($) {
        stickyHeader();
    })(jQuery);
});



