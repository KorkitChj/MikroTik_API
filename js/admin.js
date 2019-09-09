var site_manage;
$(document).ready(function () {
    load_data();
    function load_data(is_category) {
        site_manage = $("#site_manage").DataTable({
            "processing": true,
            "serverSide": true,
            "order": [[2, "desc"]],
            "ajax": {
                url: "../admin/admin_retrieve.php",
                type: "POST",
                data:{is_category:is_category}
            },
            "columnDefs": [{
                "targets": [0, 1,4, 7],
                "orderable": false,
            }],
            "createdRow": function( row, data, dataIndex ) {
                if ( data[1] == '<i class="fas fa-check-circle ssuccess"></i>') {
                    $( row ).css({"color":"#0066ff"});
                }else{
                    $( row ).css({"background-color":"#ff9999","color":"#000000"});
                }
            }
        });
    }
    $(document).on('change', '#category', function () {
        var category = $(this).val();
        $('#site_manage').DataTable().destroy();
        if (category != '') {
            load_data(category);
        }
        else {
            load_data();
        }
    });
});
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
                url: '../admin/addimage.php',
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
function removeMember(id) {
    if (id) {
        $("#removeBtn").off('click').on('click', function (){
            $.ajax({
                url: '../admin/admin_del.php',
                type: 'post',
                data: {
                    cus_id: id
                },
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        swal("สำเร็จ", response.messages, "success");
                        site_manage.ajax.reload(null, false);
                        $("#removeMemberModal").modal('hide');
                    } else {
                        swal("ผิดพลาด", response.messages, "error");
                    }
                }
            });
        });
    } else {
        alert('Error: Refresh the page again');
    }
}
$('#checkall').click(function () {
    $('.checkitem').prop("checked", $(this).prop("checked"))
})
$('#removeAllBtn').click(function () {
    var cus_id = [];
    $('.checkitem:checked').each(function (i) {
        cus_id[i] = $(this).val();
    });
    if (cus_id.length === 0) {
        swal("ผิดพลาด", "กรุณาเลือก Checkbox!", "error");
    } else {
        $.ajax({
            url: '../admin/admin_del_check.php',
            method: 'POST',
            data: {
                cus_id: cus_id
            },
            dataType: 'json',
            success: function (response) {
                if (response.success == true) {
                    swal("สำเร็จ", response.messages, "success");
                    site_manage.ajax.reload(null, false);
                    $("#removeAllMemberModal").modal('hide');
                    $("#checkall").prop("checked",false);
                } else {
                    swal("ผิดพลาด", response.messages, "error");
                    $("#checkall").prop("checked",false);
                }
            }
        });
    }
});