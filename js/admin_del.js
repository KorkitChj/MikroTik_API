var site_manage;
$(document).ready(function () {
    load_data();
    function load_data(is_category) {
        site_manage = $("#site_manage").DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "../admin/admin_retrieve.php",
                type: "POST",
                data:{is_category:is_category}
            },
            "columnDefs": [{
                "targets": [0, 1, 4, 7],
                "orderable": false,
            }],
        });
    }
    $(document).on('change', '#category', function () {
        var category = $(this).val();
        //console.log(category);
        //return false;
        $('#site_manage').DataTable().destroy();
        if (category != '') {
            load_data(category);
        }
        else {
            load_data();
        }
    });
});
function removeMember(id) {
    if (id) {
        // click on remove button
        $("#removeBtn").unbind('click').bind('click', function () {
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
                        // refresh the table
                        site_manage.ajax.reload(null, false);
                        // close the modal
                        $("#removeMemberModal").modal('hide');
                    } else {
                        swal("ผิดพลาด", response.messages, "error");
                    }
                }
            });
        }); // click remove btn
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
                } else {
                    swal("ผิดพลาด", response.messages, "error");
                }
            }
        });
    }
});