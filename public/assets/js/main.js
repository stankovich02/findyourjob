(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();


    // Initiate the wowjs
    new WOW().init();


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.sticky-top').css('top', '0px');
        } else {
            $('.sticky-top').css('top', '-100px');
        }
    });

    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Header carousel
    $(".header-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        items: 1,
        dots: true,
        loop: true,
        nav : true,
        navText : [
            '<i class="bi bi-chevron-left"></i>',
            '<i class="bi bi-chevron-right"></i>'
        ]
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        center: true,
        margin: 24,
        dots: true,
        loop: true,
        nav : false,
        responsive: {
            0:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:3
            }
        }
    });
})(jQuery);
function showModal(data) {
    $(".modal-body p").html(data);
    $(".modal-footer").css("display", "none");
    $(".modal").css("display", "block");
    setTimeout(() => {
        $(".modal").css("display", "none");
    }, 3000);
}
$("#newsletterButton").click(function (e) {
    e.preventDefault();
    let email = $("#newsletterEmail").val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: 'http://127.0.0.1:8000/newsletter',
        method: 'POST',
        data: {
            email: email
        },
        success: function (data) {
            $("#newsletterMsg").css('color', 'green');
            $("#newsletterMsg").html(data.message);
            setTimeout(() => {
                $("#newsletterMsg").html("");
                $("#newsletterEmail").val("");
            },2000);
        },
        error: function (data) {
            $("#newsletterMsg").css('color', '#eb0202');
            $("#newsletterMsg").html(data.responseJSON.message);
        }
    });
});


