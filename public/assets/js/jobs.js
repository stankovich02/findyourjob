
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
fetch('/api/cities')
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
fetch('/api/technologies')
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
        if(localStorage.getItem('technology')){
            let technology = localStorage.getItem('technology');
            document.querySelector('#Technologies').setValue(`${technology}`);
            localStorage.removeItem('technology');
            filterJobs(1);
        }
    });
$(document).ready( function () {

    if(localStorage.getItem('category')){
        let category = localStorage.getItem('category');
        $("#jobCategory").val(category);
        localStorage.removeItem('category');
        filterJobs(1);
    }
    if(localStorage.getItem('keyword')){
        let keyword = localStorage.getItem('keyword');
        $("#jobKeyword").val(keyword);
        localStorage.removeItem('keyword');
        filterJobs(1);
    }
});

$("#filterJobs").click(function (e) {
    e.preventDefault();
    filterJobs(1);

});
function printJobs(data) {
    let html = "";
    if(data.length === 0){
        html += `<h3 class="text-center mt-5 pt-3">There are no jobs that match your search criteria.</h3>`;
        $("#allJobs").html(html);
        return;
    }
    data.forEach(job => {
        html += job;
    });
    html += `<nav aria-label="..." class="d-flex justify-content-center mt-5">
                        <ul class="pagination pagination-md">
                        </ul>
                    </nav>`;
    $("#allJobs").html(html);

}

let deleteButtons = document.querySelectorAll('.deleteJob a');

deleteButtons.forEach((deleteButton) => {
    deleteButton.addEventListener('click', (e) => {
        e.preventDefault();
        let jobName = deleteButton.parentElement.nextElementSibling.querySelector('.jobName').innerHTML;
        $(".modal-body p").html(`Are you sure you want to delete "${jobName}" job?`);
        $(".deleteJobModal").css("display", "block");
        $("#closeModal").click(function (e) {
            e.preventDefault(); // Spriječava podrazumijevano ponašanje dugmeta "x"
            $(".deleteJobModal").css("display", "none");
        });
        /*    $("#deleteModal").click(function () {
                let id = deleteButton.getAttribute('data-id');
                $.ajax({
                    url: '/jobs/' + id,
                    method: 'DELETE',
                    success: function () {
                        location.reload();
                    },
                    error: function (data) {
                      toastr.error(data.message);
                    }
                });
            });*/
    });
});
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
    let latestJobs = $('#latestJobs').is(":checked");
    let data = {
        keyword: keyword,
        category: category,
        seniority: seniority,
        cities: cities,
        technologies: technologies,
        workplace: workplace,
        workType: workType,
        salary: salary,
        latestJobs: latestJobs,
        page: page
    };
    $.ajax({
        url: '/jobs/filter',
        method: 'GET',
        data: data,
        success: function (data) {
            printJobs(data.html);
            makePagination(data);
            $(document).on('click', '.deleteJob a', function (e) {
                e.preventDefault();
                console.log('clicked')
                let jobName = this.parentElement.nextElementSibling.querySelector('.jobName').innerHTML;
                $(".modal-body p").html(`Are you sure you want to delete "${jobName}" job?`);
                $(".deleteJobModal").css("display", "block");
                $("#closeModal").click(function (e) {
                    e.preventDefault();
                    $(".deleteJobModal").css("display", "none");
                });
                $("#deleteModal").click(function () {
                    let id = deleteButton.getAttribute('data-id');
                    $.ajax({
                        url: '/jobs/' + id,
                        method: 'DELETE',
                        success: function () {
                            location.reload();
                        },
                        error: function (data) {
                          toastr.error(data.message);
                        }
                    });
                });
            });
        },
        error: function (data) {
            if(data.responseJSON.errors){
                for (let key in data.responseJSON.errors) {
                  toastr.error(data.responseJSON.errors[key][0]);
                }
            }
            if(data.responseJSON.error){
                toastr.error(data.responseJSON.error);
            }
        }
    });
}

function makePagination(data){
    let currentPage = data.jobs.current_page;
    let lastPage = data.jobs.last_page;
    let html = "";
    if(lastPage > 1) {
        html += `<li class="page-item ${parseInt(currentPage) === 1  ? "disabled" : ""}">
                    <a class="page-link px-3 py-2" id="previousPage" href=""  aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>`;
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
        html += `<li class="page-item ${currentPage === lastPage ? "disabled" : ""}" id="nextPage">
            <a class="page-link px-3 py-2" href="" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>`;
    }
    $(".pagination").html(html);
    if(currentPage < lastPage){
        $("#nextPage").click(function (e) {
            e.preventDefault();
            let nextPage = $(".page-item.active").next();
            nextPage.className = "page-item active";
            let page = $(nextPage).children().text();
            filterJobs(page);
        });
    }
    if (currentPage > 1){
        $("#previousPage").click(function (e) {
            e.preventDefault();
            let previousPage = $(".page-item.active").prev();
            previousPage.className = "page-item active";
            let page = $(previousPage).children().text();
            filterJobs(page);
        });
    }
    $(".pageLink").click(function (e) {
        e.preventDefault();
        let page = $(this).html();
        filterJobs(page);
    });

}

$("#nextPage").click(function (e) {
    e.preventDefault();
    let nextPage = $(".page-item.active").next();
    nextPage.className = "page-item active";
    let page = $(nextPage).children().text();
    filterJobs(page);
});
$("#previousPage").click(function (e) {
    e.preventDefault();
    let previousPage = $(".page-item.active").prev();
    previousPage.className = "page-item active";
    let page = $(previousPage).children().text();
    filterJobs(page);
});


$(".saveJob").click(function (e) {
    e.preventDefault();
    let id = $(this).attr('data-id');
    let icon = this.querySelector('i');
    $.ajax({
        url: '/jobs/save/' + id,
        method: 'POST',
        data: {
            jobID: id
        },
        success: function (data) {
            if(icon.className === "far fa-heart text-primary")
                setTimeout(() => {
                    icon.className = "fas fa-heart text-primary";
                }, 1000);
            else
                setTimeout(() => {
                    icon.className = "far fa-heart text-primary";
                }, 1000);
            setTimeout(() => {
                toastr.success(data.message);
            }, 1000);

        },
        error: function (data) {
            if(data.responseJSON.errors){
                for (let key in data.responseJSON.errors) {
                    toastr.error(data.responseJSON.errors[key][0]);
                }
            }
            if(data.responseJSON.error){
                toastr.error(data.responseJSON.error);
            }

        }
    });
});
