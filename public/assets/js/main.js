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
function editJob(element){
    let textJob = $(element).parent().next().html();
    let editor = element.parentElement.nextElementSibling.children[0];
    let id = editor.getAttribute('id');
    if(!(id == 'descriptionEditor' || id == 'responsiblityEditor' || id == 'qualificationEditor' || id == 'benefitEditor')) {
        let parent = $(element).parent();
        let parentID = parent.attr('id');
        $(element).parent().next().html(`<div id="${parentID}Editor" contenteditable="true">${textJob}</div>`);
        var Editor;
        ClassicEditor
            .create( document.querySelector( `#${parentID}Editor` ) )
            .then( editor => {
                Editor = editor;
            } )
            .catch( error => {
                console.error( error );
            } );
    }
    let parent = $(element).parent();
    $(element).css("display", "none");
    let text = parent.html();
    parent.html(text + `<button class="btn btn-primary btn-sm ms-2 saveJob">Save</button>`);
    $(".saveJob").click(function () {
        let changedText = Editor.getData();
        let parent = $(this).parent();
        parent.html(text + ` <i class="fas fa-edit editJob"></i>`);
        parent.next().html(changedText);
        $(".editJob").click(function () {
            editJob(this);
        });
    });

}
$(".editJob").click(function () {
    editJob(this);
});

if(window.location.pathname === "/jobs/create" || window.location.pathname === "/jobs/edit") {
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
    var descriptionEditor, responsibilityEditor, qualificationsEditor, benefitsEditor;

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
        .create( document.querySelector( '#qualificationsEditor' ) )
        .then( editor => {
            qualificationsEditor = editor;
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
            let qualifications = qualificationsEditor.getData();
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
                qualifications: qualifications,
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




