var MemberTable;
$(document).ready(function () {
    MemberTable = $("#MemberTable").DataTable({
        "processing": true,
        "serverSide": true,
        "order": [[2, "desc"]],
        "ajax": {
            url: "../admin/checkpayment_retrieve.php",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [0, 6, 7],
            "orderable": false,
        }],
    });
});
function removeMember(id) {
    if (id) {
        $("#removeBtn").off('click').on('click', function () {
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
                        MemberTable.ajax.reload(null, false);
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
                    MemberTable.ajax.reload(null, false);
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
function confirmMember(id) {
    if (id) {
        $("#confirmBtn").off('click').on('click', function () {
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
                        MemberTable.ajax.reload(null, false);
                        $("#confirmMemberModal").modal('hide');
                    } else {
                        swal("ผิดพลาด",response.messages, "error");
                    }
                }
            });
        });
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

