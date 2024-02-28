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
    if($("#verifiedAccount")){
        $("#verifiedAccount").animate({
            opacity: 1,
            top: "5%"
        }, 1500, function () {

        })

        setTimeout(() => {
            $("#verifiedAccount").animate({
                top: "-50%"
            }, 2000, function () {
            });
        }, 5000);
        setTimeout(() => {
            $("#verifiedAccount").remove();
        }, 8000);

    }

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
if(window.location.pathname === "/register") {
    let accountTypes = document.querySelectorAll('.accountType');
    accountTypes.forEach((accountType) => {
        accountType.addEventListener('click', () => {
            if(accountType.id === "companyButton"){
                location.href = "/companies/create";
            }
            $("#registerBegin").animate({
                opacity: 0,
            }, 700, function () {
                $("#registerBegin").remove();

            });
            setTimeout(() => {
                $("#regFormUser").css("display", "block");

            }, 700);
            setTimeout(() => {
                $("#regFormUser").css("opacity", "1");

            }, 800);

        });
    });
}
if(window.location.pathname === "/account") {
    $(".addLink").click(function () {
        $(this).css("display", "none");
        $(this).parent().html(
            ` <input type="text" class="SocialLink form-control border-0 p-0" placeholder="Type link..."/>
        <button class="btn btn-primary btn-sm ms-2 addLink">Add</button>`
        );
        $(".addLink").click(function () {
            $(this).css("display", "none");
            let link = $(this).prev().val();
            $(this).parent().html(
                `<a href="${link}">${link}</a>
            <button class="btn btn-primary btn-sm ms-2 changeLink">Change</button>`
            );
            $(".changeLink").click(function () {
                changeLink(this);
            });
        });
    });
    function changeLink(element){
        console.log(element)
        $(element).css("display", "none");
        let link = $(element).prev().html();
        $(element).parent().html(
            ` <input type="text" class="SocialLink form-control border-0 p-0" value="${link}"/>
        <button class="btn btn-primary btn-sm ms-2 addLink">Add</button>`
        );
        $(".addLink").click(function () {
            $(this).css("display", "none");
            let link = $(this).prev().val();
            $(this).parent().html(
                `<a href="${link}">${link}</a>
            <button class="btn btn-primary btn-sm ms-2 changeLink">Change</button>`
            );
            $(".changeLink").click(function () {
                changeLink(this);
            });
        });
    }
    $(".changeLink").click(function () {
        changeLink(this);
    });
}
if(window.location.pathname === "/jobs/create") {
    fetch('http://127.0.0.1:8000/api/technologies')
        .then(response => response.json())
        .then(data => {
            let myOptions = data.map(technology => {
                return { label: technology.name, value: technology.id}
            });
            VirtualSelect.init({
                ele: '#Technologies',
                options: myOptions,
                multiple: true,
                search: true,
                maxWidth: '50%',
            });
        });
    var descriptionEditor, responsibilityEditor, requirementsEditor, benefitsEditor;

    ClassicEditor
        .create( document.querySelector( '#descriptionEditor' ) )
        .then( editor => {
            descriptionEditor = editor;
        } )
        .catch( error => {
            console.error( error );
        } );
    ClassicEditor
        .create( document.querySelector( '#responsibilityEditor' ) )
        .then( editor => {
            responsibilityEditor = editor;
        } )
        .catch( error => {
            console.error( error );
        } );
    ClassicEditor
        .create( document.querySelector( '#requirementsEditor' ) )
        .then( editor => {
            requirementsEditor = editor;
        } )
        .catch( error => {
            console.error( error );
        } );
    ClassicEditor
        .create( document.querySelector( '#benefitsEditor' ) )
        .then( editor => {
            benefitsEditor = editor;
        } )
        .catch( error => {
            console.error( error );
        }
    );
        $("#PostJob").click(function (e) {
            e.preventDefault();
            let name = $("#jobName").val();
            let category = $("#jobCategory").val();
            let seniority = $("#jobSeniority").val();
            let location = $("#jobLocation").val();
            let salary = $("#jobSalary").val();
            let workType = $("#jobWorkType").val();
            let workplace = $("#jobWorkPlace").val();
            let description = descriptionEditor.getData();
            let responsibilities = responsibilityEditor.getData();
            let requirements = requirementsEditor.getData();
            let benefits = benefitsEditor.getData();
            let technologies = $("#Technologies").val();
            let applicationDeadline = $("#jobAppDeadline").val();
            let data = {
                name: name,
                category: category,
                seniority: seniority,
                location: location,
                salary: salary,
                workType: workType,
                workplace: workplace,
                description: description,
                responsibilities: responsibilities,
                requirements: requirements,
                benefits: benefits,
                technologies: technologies,
                applicationDeadline: applicationDeadline
            };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: 'http://127.0.0.1:8000/jobs',
                method: 'POST',
                data: data,
                success: function (data) {
                    $("#responseMessage").css('color', 'green');
                    $("#responseMessage").html(data);
                },
                error: function (data) {
                    $("#responseMessage").css('color', '#eb0202');
                    let html = "";
                    for (let key in data.responseJSON.errors) {
                        html += data.responseJSON.errors[key] + "<br>";
                    }
                    $("#responseMessage").html(html);
                }
            });
        });
}
if(window.location.pathname.includes("/edit")) {
    $("#EditJob").click(function (e) {
        e.preventDefault();
        let name = $("#jobName").val();
        let category = $("#jobCategory").val();
        let seniority = $("#jobSeniority").val();
        let location = $("#jobLocation").val();
        let salary = $("#jobSalary").val();
        let workType = $("#jobWorkType").val();
        let workplace = $("#jobWorkPlace").val();
        let description = descriptionEditor.getData();
        let responsibilities = responsibilityEditor.getData();
        let requirements = requirementsEditor.getData();
        let benefits = benefitsEditor.getData();
        let technologies = $("#Technologies").val();
        let applicationDeadline = $("#jobAppDeadline").val();
        let data = {
            name: name,
            category: category,
            seniority: seniority,
            location: location,
            salary: salary,
            workType: workType,
            workplace: workplace,
            description: description,
            responsibilities: responsibilities,
            requirements: requirements,
            benefits: benefits,
            technologies: technologies,
            applicationDeadline: applicationDeadline
        };
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'http://127.0.0.1:8000/jobs/' + $("#jobID").val(),
            method: 'PUT',
            data: data,
            success: function (data) {
                $("#responseMessage").css('color', 'green');
                $("#responseMessage").html(data);
            },
            error: function (data) {
                $("#responseMessage").css('color', '#eb0202');
                let html = "";
                for (let key in data.responseJSON.errors) {
                    html += data.responseJSON.errors[key] + "<br>";
                }
                $("#responseMessage").html(html);
            }
        });
    });
}
if (window.location.pathname === "/jobs") {
    fetch('http://127.0.0.1:8000/api/cities')
        .then(response => response.json())
        .then(data => {
            let myOptions = data.map(city => {
                return { label: city.name, value: city.id}
            });
            VirtualSelect.init({
                ele: '#Cities',
                options: myOptions,
                multiple: true,
                search: true,
                maxWidth: '100%',
            });
        });
    fetch('http://127.0.0.1:8000/api/technologies')
        .then(response => response.json())
        .then(data => {
            let myOptions = data.map(technology => {
                return { label: technology.name, value: technology.id}
            });
            VirtualSelect.init({
                ele: '#Technologies',
                options: myOptions,
                multiple: true,
                search: true,
                maxWidth: '100%',
            });
        });
}
if (window.location.pathname === "/jobs" || window.location.pathname === "/account") {
    let deleteButtons = document.querySelectorAll('.deleteJob a');
    deleteButtons.forEach((deleteButton) => {
        deleteButton.addEventListener('click', (e) => {
            e.preventDefault();
            let jobName = deleteButton.parentElement.nextElementSibling.querySelector('.jobName').innerHTML;
            $(".modal-body p").html(`Are you sure you want to delete "${jobName}" job?`);
            $(".modal").css("display", "block");
            $("#closeModal").click(function () {
                $(".modal").css("display", "none");
            });
            $("#deleteModal").click(function () {
                let id = deleteButton.getAttribute('data-id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: 'http://127.0.0.1:8000/jobs/' + id,
                    method: 'DELETE',
                    success: function () {
                        location.reload();
                    },
                    error: function (data) {
                        let html = "";
                        for (let key in data.responseJSON.errors) {
                            html += data.responseJSON.errors[key] + "<br>";
                        }
                        $(".modal-body p").html(html);
                        $(".modal-footer").css("display", "none");
                        $(".modal").css("display", "block");
                        setTimeout(() => {
                            $(".modal").css("display", "none");
                        }, 3000);
                    }
                });
            });
        });
    });
}
if (window.location.pathname === "/jobs" || window.location.pathname === "/account" || window.location.pathname.includes("/companies/")) {
    $(".saveJob").click(function (e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let icon = this.querySelector('i');
        $.ajax({
            url: 'http://127.0.0.1:8000/jobs/save/' + id,
            method: 'POST',
            data: {
                jobID: id
            },
            success: function (data) {
                /*showModal(data);*/

                if(icon.className === "far fa-heart text-primary")
                    setTimeout(() => {
                        icon.className = "fas fa-heart text-primary";
                    }, 1000);
                else
                    setTimeout(() => {
                        icon.className = "far fa-heart text-primary";
                    }, 1000);
                if(window.location.pathname === "/account"){
                    location.reload();
                }

            },
            error: function (data) {
                let html = "";
                for (let key in data.responseJSON.errors) {
                    html += data.responseJSON.errors[key] + "<br>";
                }
                showModal(html);

            }
        });
    });
}
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




