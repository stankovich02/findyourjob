$("#searchAll").on('input', function () {
    if($(this).val().length > 2){
        let search = $(this).val();
        $.ajax({
            url: '/search',
            method: 'get',
            data: {
                search: search
            },
            success: function (response) {
                printSearchResults(response);
            }
        });
    }
    else{
        $("#searchResults").html("");
    }
});
function printSearchResults(response){
    let html = "";
    response.forEach(function (item) {
        let classForLink ="";
        switch (item.type) {
            case 'job':
                classForLink = "searchByJob";
                break;
            case 'technology':
                classForLink = "searchByTechnology";
                break;
            case 'company':
                classForLink = "searchByCompany";
                break;
        }
        html += `
        <a data-link="${item.link}" class="text-dark linkSearch ${classForLink}">
          <div class="search-result d-flex align-items-center">
            <div class="iconResult me-3 d-flex justify-content-center">
                <i class="${item.icon}"></i>
            </div>
            <div class="searchText">
                <h5 class="titleResult" data-id="${item.id}">${item.name}</h5>
                <p>${item.text}</p>
            </div>
          </div>
        </a>
        `;
    });
    $("#searchResults").html(html);
    $(".searchByJob").click(function () {
        let text = $(this).find('.titleResult').text();
        localStorage.setItem('keyword', text);
        window.location.href = $(this).attr('data-link');
    });
    $(".searchByTechnology").click(function () {
        let titleResult = $(this).find('.titleResult');
        let id = titleResult.attr('data-id');
        localStorage.setItem('technology', id);
        window.location.href = $(this).attr('data-link');
    });
    $(".searchByCompany").click(function () {
        let titleResult = $(this).find('.titleResult');
        let id = titleResult.attr('data-id');
        window.location.href = $(this).attr('data-link');
    });
}
if($("#verifiedAccount").length){
    toastr.success($("#verifiedAccount").text());
}
if($("#notVerified").length){
   toastr.error($("#notVerified").text());
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


