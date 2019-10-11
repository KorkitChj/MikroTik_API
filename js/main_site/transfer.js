$(document).on('submit', '#transfer', function (event) {
    event.preventDefault();
    var username = $("#username2").val();
    var date = $("#date").val();
    var bank = $("#bank").val();
    var money = $("#money").val();
    var file = $("#file").val();
    if (username != '' && date != '' && bank != '' && money != '' && file != '') {
        $.ajax({
            url: "process/main_site/transfer_process.php",
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (data) {
                if (data.success == "success") {
                    swal("สำเร็จ", data.messages, "success");
                    $("#transfer")[0].reset();
                    setTimeout(function () {
                        window.location.href = 'index.php';
                    }, 2000);
                } else if(data.success == "fail"){
                    swal("ผิดพลาด", data.messages, "error");
                    $("#transfer")[0].reset();
                    setTimeout(function () {
                        window.location.href = 'index.php';
                    }, 2000);
                }else{
                    swal("ผิดพลาด", data.messages, "error");
                }
            }
        });
    }
});
function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function(e) {
        $('#blah').attr('src', e.target.result);
      }
      
      reader.readAsDataURL(input.files[0]);
    }
  }
  
  $("#imgInp").change(function() {
    readURL(this);
  });
