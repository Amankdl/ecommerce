/*-----------------------------------------------------------------------------------

  Template Name: Asbab eCommerce HTML5 Template.
  Template URI: #
  Description: Asbab is a unique website template designed in HTML with a simple & beautiful look. There is an excellent solution for creating clean, wonderful and trending material design corporate, corporate any other purposes websites.
  Author: HasTech
  Author URI: https://themeforest.net/user/hastech/portfolio
  Version: 1.0

-----------------------------------------------------------------------------------*/

/*-------------------------------
[  Table of contents  ]
---------------------------------
    01. jQuery MeanMenu
    02. wow js active
    03. Product  Masonry (width)
    04. Sticky Header
    05. ScrollUp
    06. Search Bar
    07. Shopping Cart Area
    08. Filter Area
    09. Toogle Menu   
    10. User Menu 
    11. Menu 
    12. Menu Dropdown
    13. Overlay Close
    14. Testimonial Image Slider As Nav
    15. Brand Area
    16. Price Slider Active
    17. Accordion
    18. Ship to another
    19. Payment credit card    
    20 Slider Activations



/*--------------------------------
[ End table content ]
-----------------------------------*/


(function ($) {
    'use strict';


    /*-------------------------------------------
        01. jQuery MeanMenu
    --------------------------------------------- */

    $('.mobile-menu nav').meanmenu({
        meanMenuContainer: '.mobile-menu-area',
        meanScreenWidth: "991",
        meanRevealPosition: "right",
    });

    /*-------------------------------------------
        02. wow js active
    --------------------------------------------- */

    new WOW().init();


    /*-------------------------------------------
        03. Product  Masonry (width)
    --------------------------------------------- */

    $('.htc__product__container').imagesLoaded(function () {

        // filter items on button click
        $('.product__menu').on('click', 'button', function () {
            var filterValue = $(this).attr('data-filter');
            $grid.isotope({ filter: filterValue });
        });
        // init Isotope
        var $grid = $('.product__list').isotope({
            itemSelector: '.single__pro',
            percentPosition: true,
            transitionDuration: '0.7s',
            masonry: {
                // use outer width of grid-sizer for columnWidth
                columnWidth: '.single__pro',
            }
        });

    });

    $('.product__menu button').on('click', function (event) {
        $(this).siblings('.is-checked').removeClass('is-checked');
        $(this).addClass('is-checked');
        event.preventDefault();
    });



    /*-------------------------------------------
        04. Sticky Header
    --------------------------------------------- */
    var win = $(window);
    var sticky_id = $("#sticky-header-with-topbar");
    win.on('scroll', function () {
        var scroll = win.scrollTop();
        if (scroll < 245) {
            sticky_id.removeClass("scroll-header");
        } else {
            sticky_id.addClass("scroll-header");
        }
    });

    /*--------------------------
        05. ScrollUp
    ---------------------------- */
    $.scrollUp({
        scrollText: '<i class="zmdi zmdi-chevron-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    });


    /*------------------------------------    
        06. Search Bar
    --------------------------------------*/

    $('.search__open').on('click', function () {
        $('body').toggleClass('search__box__show__hide');
        return false;
    });

    $('.search__close__btn .search__close__btn_icon').on('click', function () {
        $('body').toggleClass('search__box__show__hide');
        return false;
    });


    /*------------------------------------    
        07. Shopping Cart Area
    --------------------------------------*/

    $('.cart__menu').on('click', function (e) {
        e.preventDefault();
        $('.shopping__cart').addClass('shopping__cart__on');
        $('.body__overlay').addClass('is-visible');

    });

    $('.offsetmenu__close__btn').on('click', function (e) {
        e.preventDefault();
        $('.shopping__cart').removeClass('shopping__cart__on');
        $('.body__overlay').removeClass('is-visible');
    });


    /*------------------------------------    
        08. Filter Area
    --------------------------------------*/

    $('.filter__menu').on('click', function (e) {
        e.preventDefault();
        $('.filter__wrap').addClass('filter__menu__on');
        $('.body__overlay').addClass('is-visible');

    });

    $('.filter__menu__close__btn').on('click', function (e) {
        e.preventDefault();
        $('.filter__wrap').removeClass('filter__menu__on');
        $('.body__overlay').removeClass('is-visible');
    });


    /*------------------------------------    
        09. Toogle Menu
    --------------------------------------*/

    $('.toggle__menu').on('click', function (e) {
        e.preventDefault();
        $('.offsetmenu').addClass('offsetmenu__on');
        $('.body__overlay').addClass('is-visible');

    });

    $('.offsetmenu__close__btn').on('click', function (e) {
        e.preventDefault();
        $('.offsetmenu').removeClass('offsetmenu__on');
        $('.body__overlay').removeClass('is-visible');
    });


    /*------------------------------------    
        10. User Menu
    --------------------------------------*/

    $('.user__menu').on('click', function (e) {
        e.preventDefault();
        $('.user__meta').addClass('user__meta__on');
        $('.body__overlay').addClass('is-visible');

    });

    $('.offsetmenu__close__btn').on('click', function (e) {
        e.preventDefault();
        $('.user__meta').removeClass('user__meta__on');
        $('.body__overlay').removeClass('is-visible');
    });



    /*------------------------------------    
        11. Menu 
    --------------------------------------*/

    $('.menu__click').on('click', function (e) {
        e.preventDefault();
        $('.off__canvars__wrap').addClass('off__canvars__wrap__on');
        $('.body__overlay').addClass('is-visible');
        $('body').addClass('off__canvars__open');
        $(this).hide();
    });

    $('.menu__close__btn').on('click', function () {
        $('.off__canvars__wrap').removeClass('off__canvars__wrap__on');
        $('.body__overlay').removeClass('is-visible');
        $('body').removeClass('off__canvars__open');
        $('.menu__click').show();
    });


    /*------------------------------------    
        12. Menu Dropdown
    --------------------------------------*/
    function offCanvasMenuDropdown() {

        $('.off__canvars__dropdown-menu').hide();

        $('.off__canvars__dropdown > a').on('click', function (e) {
            e.preventDefault();

            $(this).find('i.zmdi').toggleClass('zmdi-chevron-up');
            $(this).siblings('.off__canvars__dropdown-menu').slideToggle();
            return false;
        });
    }
    offCanvasMenuDropdown();


    /*------------------------------------    
        13. Overlay Close
    --------------------------------------*/

    $('.body__overlay').on('click', function () {
        $(this).removeClass('is-visible');
        $('.offsetmenu').removeClass('offsetmenu__on');
        $('.shopping__cart').removeClass('shopping__cart__on');
        $('.filter__wrap').removeClass('filter__menu__on');
        $('.user__meta').removeClass('user__meta__on');
        $('.off__canvars__wrap').removeClass('off__canvars__wrap__on');
        $('body').removeClass('off__canvars__open');
        $('.menu__click').show();
    });


    /*---------------------------------------------------
        14. Testimonial Image Slider As Nav
    ---------------------------------------------------*/

    $('.ht__testimonial__activation').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        swipeToSlide: true,
        dots: false,
        centerMode: true,
        focusOnSelect: true,
        centerPadding: '10px',
        responsive: [
            {
                breakpoint: 600,
                settings: {
                    dots: false,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerPadding: '10px',
                }
            },
            {
                breakpoint: 320,
                settings: {
                    autoplay: true,
                    dots: false,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerMode: false,
                    focusOnSelect: false,
                }
            }
        ]
    });


    /*-----------------------------------------------
        15. Brand Area
    -------------------------------------------------*/

    $('.brand__list').owlCarousel({
        loop: true,
        margin: 0,
        nav: false,
        autoplay: true,
        autoplayTimeout: 10000,
        items: 5,
        dots: false,
        lazyLoad: true,
        responsive: {
            0: {
                items: 2,
            },
            767: {
                items: 4,
            },
            991: {
                items: 5,
            }
        }
    });



    /*-------------------------------
        16. Price Slider Active
    --------------------------------*/

    $("#slider-range").slider({
        range: true,
        min: 10,
        max: 500,
        values: [110, 400],
        slide: function (event, ui) {
            $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
        }
    });
    $("#amount").val("$" + $("#slider-range").slider("values", 0) +
        " - $" + $("#slider-range").slider("values", 1));




    /*---------------------------------------------------
        17. Accordion
    ---------------------------------------------------*/

    function emeAccordion() {
        $('.accordion__title')
            .siblings('.accordion__title').removeClass('active')
            .first().addClass('active');
        $('.accordion__body')
            .siblings('.accordion__body').slideUp()
            .first().slideDown();
        $('.accordion').on('click', '.accordion__title', function () {
            $(this).addClass('active').siblings('.accordion__title').removeClass('active');
            $(this).next('.accordion__body').slideDown().siblings('.accordion__body').slideUp();
        });
    };
    emeAccordion();


    /*---------------------------------------------------
        18. Ship to another
    ---------------------------------------------------*/

    function shipToAnother() {
        var trigger = $('.ship-to-another-trigger'),
            container = $('.ship-to-another-content');
        trigger.on('click', function (e) {
            e.preventDefault();
            container.slideToggle();
        });
    };
    shipToAnother();



    /*---------------------------------------------------
        19. Payment credit card
    ---------------------------------------------------*/

    function paymentCreditCard() {
        var trigger = $('.paymentinfo-credit-trigger'),
            container = $('.paymentinfo-credit-content');
        trigger.on('click', function (e) {
            e.preventDefault();
            container.slideToggle();
        });
    };
    paymentCreditCard();


    /*-----------------------------------------------
        20 Slider Activations
    -------------------------------------------------*/

    if ($('.slider__activation__wrap').length) {
        $('.slider__activation__wrap').owlCarousel({
            loop: true,
            margin: 0,
            nav: true,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            smartSpeed: 1000,
            autoplay: false,
            navText: ['<i class="icon-arrow-left icons"></i>', '<i class="icon-arrow-right icons"></i>'],
            autoplayTimeout: 10000,
            items: 1,
            dots: false,
            lazyLoad: true,
            responsive: {
                0: {
                    items: 1,
                },
                767: {
                    items: 1,
                },
                991: {
                    items: 1,
                }
            }
        });
    }




})(jQuery);


function send_messaage() {
    $name = jQuery("#name").val();
    $email = jQuery("#email").val();
    $mobile = jQuery("#mobile").val();
    $comment = jQuery("#message").val();

    if ($name.trim() == "" || $email.trim() == "" || $mobile.trim() == "" || $comment.trim() == "") {
        alert("Please enter all required values");
    } else {
        jQuery.ajax({
            url: 'send_msg.php',
            type: 'post',
            data: 'name=' + $name + '&email=' + $email + '&mobile=' + $mobile + '&comment=' + $comment,
            success: function (result) {
                jQuery("#name").val("");
                jQuery("#email").val("");
                jQuery("#mobile").val("");
                jQuery("#message").val("");
                alert(result);
            }
        });
    }
}

function register() {
    $name = jQuery("#name").val();
    $email = jQuery("#email").val();
    $mobile = jQuery("#mobile").val();
    $password = jQuery("#password").val();
    if ($name.trim() == "" || $email.trim() == "" || $mobile.trim() == "" || $password.trim() == "") {
        alert("Please enter all required values");
    } else {
        jQuery.ajax({
            url: 'register_submit.php',
            type: 'post',
            data: 'name=' + $name + '&email=' + $email + '&mobile=' + $mobile + '&password=' + $password,
            success: function (result) {
                if (!isNaN(result)) {
                    result = "You are registered successfully.";
                    jQuery("#name").val("");
                    jQuery("#email").val("");
                    jQuery("#mobile").val("");
                    jQuery("#password").val("");
                }
                alert(result);
            }
        });
    }
}

function login_user(page) {
    $email = jQuery("#login_email").val();
    $password = jQuery("#login_pass").val();
    if ($email.trim() == "" || $password.trim() == "") {
        alert("Please enter all required values");
    } else {
        jQuery.ajax({
            url: 'login_user.php',
            type: 'post',
            data: 'email=' + $email + '&password=' + $password,
            success: function (result) {
                if (result === "loggedin") {
                    if(page === "checkout"){
                        location.reload();
                    }else{
                        window.location.href = "index.php";
                    }
                } else {
                    alert(result);
                }
            }
        });
    }
}

function manage_cart(pid,type) {
    if(type === "update"){
        var qty = jQuery("#"+pid+"qty").val();
        console.log(qty);
    }else{
        var qty = jQuery("#qty").val();
        if(qty == null || qty == ''){
            qty = 1;
        }
    }
    jQuery.ajax({
        url: 'manage_cart.php',
        type: 'post',
        data: 'pid=' + pid + '&qty=' + qty + '&type=' + type,
        success: function (result) {
            if(type == "delete" || type == "update"){
                location.reload();
            }            
            jQuery('.htc__qua').html(result);
        }
    });
}

function manage_wishlist(pid,type) {    
    jQuery.ajax({
        url: 'manage_wishlist.php',
        type: 'post',
        data: 'pid=' + pid + '&type=' + type,
        success: function (result) {

            if(result === "needs login"){
                window.location.href = 'login.php';
            }

            if(type == "delete"){
                window.location.reload();                
            }

            if(!isNaN(result)){
                jQuery('.htc__wishlist').html(result);
            }
        }
    });
}

function verify_email(){
    var email = jQuery('#email').val().trim();
    if(email == null || email == ''){
        jQuery('#email_error').show();
        jQuery('#email_error').html('Please enter email properly.');
    }else{
        jQuery('#email_error').hide();
        jQuery('#verify_email_btn').html('Sending otp...');
        jQuery('#verify_email_btn').attr('disabled', 'disabled');
        jQuery.ajax({
            url: 'send_otp.php',
            type: 'post',
            data: 'email=' + email + '&type=' + 'email',
            success: function (result) {    
                if(result === "done"){
                    jQuery('#email_otp_box').show();
                    jQuery('#email').attr('disabled','disabled');
                    jQuery('#verify_email_btn').hide();
                    jQuery('#email_error').show();
                    jQuery('#email_error').html('Please enter the otp you recieved on <strong>'+email+' </strong>');
                }else if(result == "not_done"){
                    jQuery('#email_error').html('Please try after sometime');
                }
            }
        });
    }
}

function verify_otp(){
    var otp = jQuery('#otp_box').val().trim();
    if(otp == null || otp == ''){
        jQuery('#email_error').html('No otp entered.');
    }else{
        jQuery('#email_error').hide();
        jQuery('#verify_otp_btn').attr('disabled', 'disabled');
        jQuery('#verify_otp_btn').html('Verifying...');
        jQuery.ajax({
            url: 'verify_otp.php',
            type: 'post',
            data: 'otp=' + otp + '&type=' + 'email',
            success: function (result) {  
                jQuery('#email_error').show();
                if(result == "verified"){
                    jQuery('#email_otp_box').hide();
                    jQuery('#verify_email_btn').hide();
                    jQuery('#email_error').attr('style', 'color: green');
                    jQuery('#email_error').html('<strong>'+jQuery('#email').val().trim()+' </strong> verified successfully.');
                }else if(result == "not_verified"){
                    jQuery('#verify_otp_btn').html('Verify OTP');
                    jQuery('#verify_otp_btn').prop("disabled", false);
                    jQuery('#email_error').html('Invalid OTP entered.');
                }else{
                    alert(result);
                }
            }
        });
    }
}