var MemberTable;
$(document).ready(function () {
    MemberTable = $("#MemberTable").DataTable({
        "order": [],
        "ajax": {
            url: "../admin/checkpayment_retrieve.php",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [0, 3, 6, 7],
            "orderable": false,
        }],
    });
});
function removeMember(id = null) {
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
                        MemberTable.ajax.reload(null, false);
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
$('#checkall').click(function(){
    $('.checkitem').prop("checked", $(this).prop("checked"))
})
$('#removeAllBtn').click(function () {
    var cus_id = [];
    $('.checkitem:checked').each(function (i) {
        cus_id[i] = $(this).val();
    });
    if (cus_id.length === 0)
    {
        swal("ผิดพลาด", "กรุณาเลือก Checkbox!", "error");
    } else {
        //console.log(cus_id);
        //return false;
        $.ajax({
            url: '../admin/admin_del_check.php',
            method: 'POST',
            data: {
                cus_id: cus_id
            },
            dataType: 'json',
            success: function (response) {
                if (response.success == true) {
                    // refresh the table
                    swal("สำเร็จ", response.messages, "success");
                    MemberTable.ajax.reload(null, false);
                    // close the modal
                    $("#removeAllMemberModal").modal('hide');
                } else {
                    swal("ผิดพลาด", response.messages, "error");
                }
            }
        });
    }
});
function confirmMember(id = null) {
    if (id) {
        // click on remove button
        $("#confirmBtn").unbind('click').bind('click', function () {
            $.ajax({
                url: '../admin/admin_confirm.php',
                type: 'post',
                data: {
                    order_id: id
                },
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        swal("สำเร็จ",response.messages, "success");
                        // refresh the table
                        MemberTable.ajax.reload(null, false);
                        // close the modal
                        $("#confirmMemberModal").modal('hide');
                    } else {
                        swal("ผิดพลาด",response.messages, "error");
                    }
                }
            });
        }); // click remove btn
    } else {
        alert('Error: Refresh the page again');
    }
}
$(document).on('click', '.displayimg', function(){
    var slip_name = $(this).attr("id");
    $.ajax({
        url:"../admin/fetch_img.php",
        method:"POST",
        data:{slip_name:slip_name},
        dataType:"json",
        success:function(data)
        {
            $('#slip').html(data.user_image);
        }
    })
});

