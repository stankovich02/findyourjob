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
    if($("#successMessage").length) {
        toastr.success($("#successMessage").text());
    }
}
