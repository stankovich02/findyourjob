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
    });

$(window).on('load', function () {
    if(localStorage.getItem('category')){
        let category = localStorage.getItem('category');
        $("#jobCategory").val(category);
        localStorage.removeItem('category');
        filterJobs(1);
    }
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
            $.ajax({
                url: '/jobs/' + id,
                method: 'DELETE',
                success: function () {
                    location.reload();
                },
                error: function (data) {
                   //toastr data.error
                }
            });
        });
    });
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
            /*showModal(data);*/

            if(icon.className === "far fa-heart text-primary")
                setTimeout(() => {
                    icon.className = "fas fa-heart text-primary";
                }, 1000);
            else
                setTimeout(() => {
                    icon.className = "far fa-heart text-primary";
                }, 1000);
           //data.message toastr

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
