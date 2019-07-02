var site_manage;
$(document).ready(function () {
    site_manage = $("#site_manage").DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "admin_retrieve.php",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [0, 1, 4, 5, 6, 7],
            "orderable": false,
        }],
    });
});
function removeMember(id = null) {
    if (id) {
        // click on remove button
        $("#removeBtn").unbind('click').bind('click', function () {
            $.ajax({
                url: 'admin_del.php',
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
$('#removeAllBtn').click(function () {
    var cus_id = [];
    $(':checkbox:checked').each(function (i) {
        cus_id[i] = $(this).val();
    });
    if (cus_id.length === 0) //tell you if the array is empty
    {
        swal("ผิดพลาด", "กรุณาเลือก Checkbox!", "error");
    } else {
        $.ajax({
            url: 'admin_del_check.php',
            method: 'POST',
            data: {
                cus_id: cus_id
            },
            dataType: 'json',
            success: function (response) {
                if (response.success == true) {
                    swal("สำเร็จ", response.messages, "success");
                    // refresh the table
                    site_manage.ajax.reload(null, false);
                    // close the modal
                    $("#removeAllMemberModal").modal('hide');
                } else {
                    swal("ผิดพลาด", response.messages, "error");
                }
            }
        });
    }
});