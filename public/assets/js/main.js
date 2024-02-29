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
        let social = $(this).attr('data-social');
        $(this).css("display", "none");
        $(this).parent().html(
            ` <input type="text" class="SocialLink form-control border-0 py-2" placeholder="Type link..."/>
        <button class="btn btn-primary ms-2 addLink" data-social="${social}">Update</button>`
        );
        $(".addLink").click(function () {
            let link = $(this).prev().val();
            let social = $(this).attr('data-social');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: 'http://127.0.0.1:8000/account/socials',
                method: 'PUT',
                data: {
                    social: social,
                    link: link
                },
                success: function (data) {
                    location.reload();
                },
                error: function (data) {
                    console.log(data.responseJSON.errors.link[0])
                }
            });
        });
    });

    function changeLink(element) {
        let social = $(element).attr('data-social');
        $(element).css("display", "none");
        let link = $(element).prev().html();
        $(element).parent().html(
            ` <input type="text" class="SocialLink form-control border-0 py-2" value="${link}"/>
        <button class="btn btn-primary ms-2 addLink" data-social="${social}">Update</button>`
        );
        $(".addLink").click(function () {
            let link = $(this).prev().val();
            let social = $(this).attr('data-social');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: 'http://127.0.0.1:8000/account/socials',
                method: 'PUT',
                data: {
                    social: social,
                    link: link
                },
                success: function (data) {
                    location.reload();
                },
                error: function (data) {
                    console.log(data.responseJSON.errors.link[0])
                }
            });
        });
    }

    $(".changeLink").click(function () {
        changeLink(this);
    });
    /*$("#fileInput").change(function () {
        let file = this.files[0];
        let url = $('#imageUpload').attr('data-action');
        let formData = new FormData();
        formData.append('picture', file);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            method: 'PUT',
            data: formData,
            processData: false,
            cache: false,
            contentType: false,
            success: function (data) {
                location.reload();
            },
            error: function (data) {
                $("#pictureError").css('color', 'red');
                $("#pictureError").html(data.responseJSON.errors.picture[0]);
            }
        });
    });*/

    $("#btnEdit").click(function () {
        $("#accountDetails input").removeAttr('disabled');
        if($("#accountDetails textarea")){
            $("#accountDetails textarea").removeAttr('disabled');
        }
        $(this).parent().html(`
            <button class="btn btn-primary" id="btnSave" type="submit">Save</button>
        `);
        $(this).remove();
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
    $("#filterJobs").click(function (e) {
        e.preventDefault();
        filterJobs(1);

    });
    function printJobs(data) {
        let html = "";
        data.forEach(job => {
            html += job;
        });
        html += `<nav aria-label="..." class="d-flex justify-content-center mt-5">
                        <ul class="pagination pagination-sm">
                        </ul>
                    </nav>`;
        $("#allJobs").html(html);

    }

    $(".pageLink").click(function (e) {
        e.preventDefault();
        let page = $(this).html();
        filterJobs(page);
    });
    function filterJobs(page) {
        let keyword = $("#jobKeyword").val().trim();
        let category = $("#jobCategory").val();
        let seniority = $("#jobSeniority").val();
        let cities = $("#Cities").val();
        let workType = $("#workType").val();
        let workplace = $("#workPlace").val();
        let technologies = $("#Technologies").val();
        let salary = $('#jobSalary').is(":checked");
        let data = {
            keyword: keyword,
            category: category,
            seniority: seniority,
            cities: cities,
            technologies: technologies,
            workplace: workplace,
            workType: workType,
            salary: salary,
            page: page
        };
        $.ajax({
            url: 'http://127.0.0.1:8000/jobs/filter',
            method: 'GET',
            data: data,
            success: function (data) {
                printJobs(data.html);
                makePagination(data);
            },
            error: function (data) {
                console.log(data);
            }
        });
    }

    function makePagination(data){
        let currentPage = data.jobs.current_page;
        let lastPage = data.jobs.last_page;
        let html = "";
        if(lastPage > 1) {
            for (let i = 1; i <= lastPage; i++) {
                if (i === currentPage) {
                    html += `
                    <li class="page-item active" aria-current="page">
                        <span class="page-link px-3 py-2">${i}</span>
                    </li>`;
                } else {
                    html += `<li class="page-item"><a class="page-link px-3 py-2 pageLink" href="">${i}</a></li>`;
                }
            }
        }
        $(".pagination").html(html);
        $(".pageLink").click(function (e) {
            e.preventDefault();
            let page = $(this).html();
            filterJobs(page);
        });

    }
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




