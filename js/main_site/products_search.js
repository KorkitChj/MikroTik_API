products();
function products(search) {
    $.ajax({
        url: "process/main_site/products_retrieve.php",
        method: "POST",
        data: {
            data: search
        },
        beforeSend: function() {     
            $(".modalx").show();
        },
        complete: function(){
            $(".modalx").hide();
        },
        success: function (data) {
            $('.row-custom').html(data);
        }
    });
}
$(document).on('submit', '#form_search', function (event) {
    event.preventDefault();
    var search = $('#search').val();
    if (search != '') {
        products(search);
    }else {
        products();
        }
});
$(document).on('click','.close-custom',function(){
    products();
});