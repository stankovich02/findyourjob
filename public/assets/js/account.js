$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
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
$(".saveJob").click(function (e) {
    e.preventDefault();
    let id = $(this).attr('data-id');
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
