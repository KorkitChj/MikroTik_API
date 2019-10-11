$("#addImageModalBtn").click(function () {
    $("#formimage")[0].reset();
    $("#formimage").off('submit').on('submit', function () {
        var form = $(this);
        var extension = $('#image').val().split('.').pop().toLowerCase();
        if (extension != '') {
            if (jQuery.inArray(extension, ['png', 'jpg', 'jpeg']) == -1) {
                swal("ผิดพลาด", "Invalid Image File", "error");
                $('#image').val('');
                return false;
            }
        }
        var image = $("#image").val();
        if (image) {
            $.ajax({
                url: '../process/site_admin/addimage_process.php',
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (response) {
                    if(response.success == true){
                        $("#formimage")[0].reset();
                        $("#load").load(location.href + " #load>*", "");
                        $("#addImageModal").modal('hide');
                    }
                }
            });
        }
        return false;
    });
});
/*$(document).on('submit','#packet_form', function(event) {
    event.preventDefault();
    var bank = $("#bank").val();
    var date = $("#date").val();
    var money = $("#money").val();
    var slip = $("#fileslip").val();
    if(bank != '' && date != '' && money != '' && slip != ''){
        $.ajax({
            url:"../siteadmin/updatepacket_siteadmin.php",
            method:'POST',
            data:new FormData(this),
            contentType:false,
            processData:false,
            dataType:'json',
            success : function(data){
                if(data.success == true){
                    swal("สำเร็จ", data.messages, "success");
                    $("#exampleModal").modal('hide');
                    $("#packet_form")[0].reset();
                }else{
                    swal("ผิดพลาด", data.messages, "error");
                    $("#packet_form")[0].reset();
                }
            }
        });
    }
});*/