$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
if(window.location.pathname.includes('/admin/jobs')) {
    $("#deleteJob").click(function (e) {
        e.preventDefault();
        $(".modal-body p").html(`Are you sure you want to decline job?`);
        $(".deleteJobModal").css("display", "block");
        $("#closeModal").click(function (e) {
            e.preventDefault();
            $(".deleteJobModal").css("display", "none");
        });
    });
    $("#approveJob").click(function (e) {
        e.preventDefault();
        $(".modal-body p").html(`Are you sure you want to approve job?`);
        $(".approveJobModal").css("display", "block");
        $(".approveJobModal #closeModal").click(function (e) {
            e.preventDefault();
            $(".approveJobModal").css("display", "none");
        });
    });
}
if(window.location.pathname.includes('/admin/companies')) {
    $("#deleteCompany").click(function (e) {
        e.preventDefault();
        $(".modal-body p").html(`Are you sure you want to decline company?`);
        $(".deleteCompanyModal").css("display", "block");
        $(".deleteCompanyModal #closeModal").click(function (e) {
            e.preventDefault();
            $(".deleteCompanyModal").css("display", "none");
        });
    });
    $("#approveCompany").click(function (e) {
        e.preventDefault();
        $(".modal-body p").html(`Are you sure you want to approve company?`);
        $(".approveCompanyModal").css("display", "block");
        $(".approveCompanyModal #closeModal").click(function (e) {
            e.preventDefault();
            $(".approveCompanyModal").css("display", "none");
        });
    });
}
if(window.location.pathname.includes('/admin/technologies')) {
    deleteEntity('technology','.deleteTechnologyModal');
}
if(window.location.pathname.includes('/admin/cities')) {
    deleteEntity('city','.deleteCityModal');
}
if(window.location.pathname.includes('/admin/roles')) {
    deleteEntity('role','.deleteRoleModal');
}
if(window.location.pathname.includes('/admin/navs')) {
    deleteEntity('navigation','.deleteNavModal');
}
if(window.location.pathname.includes('/admin/categories')) {
    deleteEntity('category','.deleteCategoryModal');

}
if(window.location.pathname.includes('/admin/users')) {
    deleteEntity('user','.deleteUserModal');
    $(".banModal").click(function (e) {
        e.preventDefault();
        let button = $(this);
        $(".banUserModal .modal-body p").html(`Are you sure you want to ban user?`);
        $(".banUserModal .modal-footer").html(`<button type="button" class="btn btn-primary" id="closeModal" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" id="banModal">Ban</button>`);
        $(".banUserModal").css("display", "block");
        $(".banUserModal #closeModal").click(function (e) {
            e.preventDefault();
            $(".banUserModal").css("display", "none");
        });
        $(".banUserModal #banModal").click(function (e) {
            let form = button.parent();
            form.submit();
        });
    });
    $(".unBanModal").click(function (e) {
        e.preventDefault();
        let button = $(this);
        $(".banUserModal .modal-body p").html(`Are you sure you want to unban user?`);
        $(".banUserModal .modal-footer").html(`<button type="button" class="btn btn-primary" id="closeModal" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" id="unbanModal">Unban</button>`);
        $(".banUserModal").css("display", "block");
        $(".banUserModal #closeModal").click(function (e) {
            e.preventDefault();
            $(".banUserModal").css("display", "none");
        });
        $(".banUserModal #unbanModal").click(function (e) {
            let form = button.parent();
            form.submit();
        });
    });
}
if(window.location.pathname.includes('/admin/seniorities')) {
    deleteEntity('seniority','.deleteSeniorityModal');
}
if(window.location.pathname.includes('/admin/workplaces')) {
    deleteEntity('workplace','.deleteWorkplaceModal');
}
if(window.location.pathname.includes('/admin/newsletters')) {
    deleteEntity('newsletter','.deleteNewsletterModal');
}
if($("#successMessage").length) {
    toastr.success($("#successMessage").text());
}
if($("#errorMessage").length) {
    toastr.error($("#errorMessage").text());
}
function deleteEntity(entity,modalClass){
    $(".deleteBtn").each(function(){
        $(this).click(function (e) {
            e.preventDefault();
            let button = $(this);
            $(modalClass + " .modal-body p").html(`Are you sure you want to delete ${entity}?`);
            $(modalClass).css("display", "block");
            $(modalClass + " #closeModal").click(function (e) {
                e.preventDefault();
                $(modalClass).css("display", "none");
            });
            $(modalClass + " #deleteModal").click(function (e) {
                let form = button.parent();
                form.submit();
            });
        });
    });
}
