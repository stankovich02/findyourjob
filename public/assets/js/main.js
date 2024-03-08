(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 700);
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
        nav: true,
        navText: [
            '<i class="bi bi-chevron-left"></i>',
            '<i class="bi bi-chevron-right"></i>'
        ]
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
        url: '/newsletter',
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
            }, 2000);
        },
        error: function (data) {
            $("#newsletterMsg").css('color', '#eb0202');
            if (data.responseJSON.errors) {
                $("#newsletterMsg").html(data.responseJSON.errors.email[0]);
            }
            $("#newsletterMsg").html(data.responseJSON.message);
        }
    });
});
toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};
if ($(".boostJob a")) {
    $(".boostJob a").click(function (e) {
        e.preventDefault();
        let jobId = $(this).attr('data-id');
        $.ajax({
            url: `/jobs/${parseInt(jobId)}`,
            method: 'GET',
            data: {
                jobId: jobId
            },
            success: function (data) {
                html = `

               <p>Job Title: ${data.job.name}</p>
               <p>Job Category: ${data.job.category.name}</p>
                <p>Job Location: ${data.job.city.name}</p>
                <p>Application Deadline: ${data.job.application_deadline}</p>
                <label for="boostDuration">Choose Boost Duration:</label>
                <div id="calculateBoost">
                      <select class="form-select" aria-label="Default select example" id="boostDuration">
                        <option value="0">Select Duration</option>
                        <option value="1">1 Day</option>
                        <option value="3">3 Days</option>
                        <option value="7">7 Days</option>
                        <option value="14">14 Days</option>
                    </select>
                </div>

               `;
                $(".boostJobModal .modal-body").html(html);
                $(".boostJobModal").css("display", "block");
                $(".boostJobModal #closeModal").click(function (e) {
                    e.preventDefault();
                    $(".boostJobModal").css("display", "none");
                });
                $("#boostDuration").change(function (e) {
                    let html = `
                    <div id="calculationMessage">
                    </div>`;
                    $("#calculateBoost").append(html);
                    if ($(this).val() == 0) {
                        $("#calculationMessage").remove();
                        $(".boostJobModal form").remove();
                        return;
                    }
                    if ($(".boostJobModal form")) {
                        $(".boostJobModal form").remove();
                    }
                    let duration = $(this).val();
                    let amount = 5;
                    let total = amount * duration;
                    let csrf = $('meta[name="csrf-token"]').attr('content');
                    $("#calculationMessage").html(`<h5 class="mt-5 text-success"> For ${duration} ${duration == 1 ? "Day" : "Days"}, You will be charged ${total} EUR.</h5>`);
                    let stripeModal = `
                     <form action="/jobs/boost/${jobId}" method="post">
                        <input type="hidden" name="_token" value="${csrf}">
                        <input type="hidden" name="duration" value="${duration}">
                        <input type="hidden" name="total" value="${total}">
                        <script
                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                            data-key="pk_test_51Or1PM08Wg9T2v5dxSHY09d2QRoPJlvI6AviM5HY8mKo4GJt7kUK6QayJ9bKiVy0lnXa9aJisPi4iL1qvM1QG6g8008evIG994"
                            data-amount="${total * 100}"
                            data-name="Boost Job Payment"
                            data-image="http://127.0.0.1:8000/assets/img/logo.png"
                            data-locale="auto"
                            data-email="false"
                            data-currency="eur"
                            data-label="Pay">
                        </script>
                    </form>
                    `;
                    $(".boostJobModal .modal-body").append(stripeModal);
                });
            },
            error: function (data) {
                toastr.error(data.responseJSON.message);
            }
        });
    });
}
if ($("#boostSuccess").html()) {
    toastr.success($("#boostSuccess").html());
    $("#boostSuccess").remove();
}
if ($("#boostError").html()) {
    toastr.error($("#boostError").html());
    $("#boostError").remove();
}


let eyes = document.querySelectorAll(".toggle-password");

eyes.forEach(eye => {
    eye.addEventListener("click", function () {
        eye.classList.toggle("fa-eye");
        eye.classList.toggle("fa-eye-slash");
        let input = document.querySelector(eye.getAttribute('toggle'));
        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    });
});


