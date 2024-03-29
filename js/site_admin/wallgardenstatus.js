var wallstatus;
$(document).ready(function () {
    wallstatus = $("#wallstatus").DataTable({
        "order": [],
        "ajax": {
            url: "../process/site_admin_router/wallgardenstatus_retrieve_process.php",
            type: "POST",
            error: function (error) {
            },
            dataSrc: function (response) {
                return response.data
            }
        },
        "columnDefs": [{
            "targets": [0, 5],
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
$("#addWallModalBtn").on('click', function () {
    $("#addWall")[0].reset();
    $("#addWall").off('submit').on('submit', function () {
        var form = $(this);
        var domainname = $("#domainname").val();
        var action = $("#action").val();
        var comment = $("#comment").val();
        if (domainname && action && comment) {
            $.ajax({
                url: '../process/site_admin_router/wallgarden_add_process.php',
                type: 'POST',
                data: form.serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        swal("สำเร็จ", response.messages, "success");
                        $("#addWall")[0].reset();
                        wallstatus.ajax.reload(null, false);
                        $("#addWallModal").modal('hide');
                    } else {
                        swal("ผิดพลาด", response.messages, "error");
                    }
                }
            });
        }
        return false;
    });
});
function removeWall(Wall_id) {
    if (Wall_id) {
        $("#removeWallBtn").off('click').on('click', function () {
            $.ajax({
                url: '../process/site_admin_router/wallgardenstatus_del_process.php',
                type: 'POST',
                data: { 'wall_id':Wall_id, 'type': 'one' },
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        swal("สำเร็จ", response.messages, "success");
                        wallstatus.ajax.reload(null, false);
                        $("#removeWallModal").modal('hide');
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
$('#removeAllWallBtn').click(function () {
    var Wall_id = [];
    $(':checkbox:checked').each(function (i) {
        Wall_id[i] = $(this).val();
    });
    if (Wall_id.length === 0) {
        swal("ผิดพลาด", "กรุณาเลือก Checkbox!", "error");
    } else {
        $.ajax({
            url: '../process/site_admin_router/wallgardenstatus_del_process.php',
            method: 'POST',
            data: {
                'wall_id': Wall_id, 'type': 'many'
            },
            dataType: 'json',
            success: function (response) {
                if (response.success == true) {
                    swal("สำเร็จ", response.messages, "success");
                    wallstatus.ajax.reload(null, false);
                    $("#removeAllWallModal").modal('hide');
                } else {
                    swal("ผิดพลาด", response.messages, "error");
                }
            }
        });
    }
});
function editWall(Comment) {
    if (Comment) {
        $.ajax({
            url: '../process/site_admin_router/getSelectedWallGarden.php',
            type: 'POST',
            data: {
                comment: Comment
            },
            dataType: 'json',
            success: function (response) {
                $("#editdomainname").val(response.domainname);
                $("#editaction").val(response.action);
                $("#editcomment").val(response.comment);
                $("#editWall").append('<input type="hidden" name="edit_comment" id="edit_comment" value="' + response.comment + '"/>');
                $("#editWall").off('submit').on('submit', function () {
                    var form = $(this);
                    var editdomainname = $("#editdomainname").val();
                    var editaction = $("#editaction").val();
                    var editcomment = $("#editcomment").val();

                    if (editdomainname && editaction && editcomment) {
                        $.ajax({
                            url: '../process/site_admin_router/wallgardenstatus_update_process.php',
                            type: 'POST',
                            data: form.serialize(),
                            dataType: 'json',
                            success: function (response) {
                                if (response.success == true) {
                                    swal("สำเร็จ", response.messages, "success");
                                    wallstatus.ajax.reload(null, false);
                                    $("#editWallModal").modal('hide');
                                } else {
                                    swal("ผิดพลาด", response.messages, "error");
                                }
                            }
                        });
                    }
                    return false;
                });
            }
        });
    } else {
        alert("Error : Refresh the page again");
    }
}



