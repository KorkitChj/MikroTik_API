var MemberTable;
$(document).ready(function () {
    MemberTable = $("#MemberTable").DataTable({
        "processing": true,
        "serverSide": true,
        "order": [[1, "desc"]],
        "ajax": {
            url: "../process/admin/order_upgrade_retrieve_process.php",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [0, 6, 7],
            "orderable": false,
        }],
        "language": {
            "sProcessing":    "กำลังดำเนินการ...",
            "sLengthMenu":    "แสดง _MENU_ แถว",
            "sZeroRecords":   "ไม่พบค้นหา",
            "sEmptyTable":    "ไม่มีข้อมูลในตาราง",
            "sInfo":          "แสดง _START_ ถึง _END_ ของ _TOTAL_ แถว",
            "sInfoEmpty":     "แสดง 0 ถึง 0 ของ 0 แถว",
            "sInfoFiltered":  "(กรองข้อมูล _MAX_ ทุกแถว)",
            "sInfoPostFix":   "",
            "sSearch":        "ค้นหา:",
            "sUrl":           "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "กำลังโหลดข้อมูล...",
            "oPaginate": {
                "sFirst":    "หน้าแรก",
                "sLast":    "หน้าสุดท้าย",
                "sNext":    "ถัดไป",
                "sPrevious": "ก่อนหน้า"
            },
            "oAria": {
                "sSortAscending":  ": เปิดใช้งานการเรียงข้อมูลจากน้อยไปมาก",
                "sSortDescending": ": เปิดใช้งานการเรียงข้อมูลจากมากไปน้อย"
            }
        }
    });
});
function removeMember(id) {
    if (id) {
        $("#removeBtn").off('click').on('click', function () {
            $.ajax({
                url: '../process/admin/order_upgrade_del_process.php',
                type: 'post',
                data: {
                    pu_id: id
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
            url: '../process/admin/order_upgrade_del_check_process.php',
            method: 'POST',
            data: {
                pu_id: cus_id
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
$(document).on('click', '.displayimg', function(){
    var slip_name = $(this).attr("id");
    $.ajax({
        url:"../process/admin/fetch_img_process.php",
        method:"POST",
        data:{slip_name:slip_name},
        dataType:"json",
        success:function(data)
        {
            $('#slip').html(data.user_image);
        }
    })
});
function confirmMember(puid,cus_id) {
    if (puid && cus_id) {
        $("#confirmBtn").off('click').on('click', function () {
            $.ajax({
                url: '../process/admin/order_upgrade_confirm_process.php',
                type: 'post',
                data: {puid: puid,cusid:cus_id},
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

