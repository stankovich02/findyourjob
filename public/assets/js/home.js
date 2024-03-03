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
if($("#companyError") && $("#companyError").text() != ""){
    console.log($("#companyError"))
    let text = $("#companyError").text();
    $("#companyError").text("");
    toastr.info(text);
}
$(".categorySingle").click(function () {
    let category = $(this).attr('data-id');
    localStorage.setItem('category', category);
    window.location.href = "/jobs";
});

