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
