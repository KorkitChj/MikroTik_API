var profilestatus;
$(document).ready(function () {
    profilestatus = $("#profilestatus").DataTable({
        "order": [],
        "ajax": {
            url: "../process/site_admin_router/profilestatus_retrieve_process.php",
            type: "POST",
            dataSrc: function (response) {
                if (response.success == false) {
                    swal("Disconnect", response.messages, "error");
                } else {
                    return response.data;
                }
            }
        },
        "columnDefs": [{
            "targets": [0, 6],
            "orderable": false,
        }],
        "language": {
            "sProcessing": "กำลังดำเนินการ...",
            "sLengthMenu": "แสดง _MENU_ แถว",
            "sZeroRecords": "ไม่พบค้นหา",
            "sEmptyTable": "ไม่มีข้อมูลในตาราง",
            "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ แถว",
            "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 แถว",
            "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
            "sInfoPostFix": "",
            "sSearch": "ค้นหา:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "กำลังโหลดข้อมูล...",
            "oPaginate": {
                "sFirst": "หน้าแรก",
                "sLast": "หน้าสุดท้าย",
                "sNext": "ถัดไป",
                "sPrevious": "ก่อนหน้า"
            },
            "oAria": {
                "sSortAscending": ": เปิดใช้งานการเรียงข้อมูลจากน้อยไปมาก",
                "sSortDescending": ": เปิดใช้งานการเรียงข้อมูลจากมากไปน้อย"
            }
        }
    });
});
$("#addProfileModalBtn").on('click', function () {
    $("#addProfile")[0].reset();
    $("#addProfile").off('submit').on('submit', function () {
        var form = $(this);
        var shared = $("#shared").val();
        if (shared) {
            $.ajax({
                url: '../process/site_admin_router/profile_add_process.php',
                type: 'POST',
                data: form.serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        swal("สำเร็จ", response.messages, "success");
                        $("#addProfile")[0].reset();
                        profilestatus.ajax.reload(null, false);
                        $("#addProfileModal").modal('hide');
                    } else {
                        swal("ผิดพลาด", response.messages, "error");
                    }
                }
            });
        }
        return false;
    });
});

function removeProfile(Profile_name) {
    if (Profile_name) {
        $("#removeProfileBtn").off('click').on('click', function () {
            $.ajax({
                url: '../process/site_admin_router/profilestatus_del_process.php',
                type: 'POST',
                data: {
                    'profile_id': Profile_name,
                    'type': 'one'
                },
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        swal("สำเร็จ", response.messages, "success");
                        profilestatus.ajax.reload(null, false);
                        $("#removeProfileModal").modal('hide');
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
$('#removeAllProfileBtn').click(function () {
    var Profile_id = [];
    $(':checkbox:checked').each(function (i) {
        Profile_id[i] = $(this).val();
    });
    if (Profile_id.length === 0) {
        swal("ผิดพลาด", "กรุณาเลือก Checkbox!", "error");
    } else {
        $.ajax({
            url: '../process/site_admin_router/profilestatus_del_process.php',
            method: 'POST',
            data: {
                'profile_id': Profile_id,
                'type': 'many'
            },
            dataType: 'json',
            success: function (response) {
                if (response.success == true) {
                    swal("สำเร็จ", response.messages, "success");
                    profilestatus.ajax.reload(null, false);
                    $("#removeAllProfileModal").modal('hide');
                } else {
                    swal("ผิดพลาด", response.messages, "error");
                }
            }
        });
    }
});

function editProfile(Profile_name) {
    if (Profile_name) {
        $.ajax({
            url: '../process/site_admin_router/getSelectedProfile.php',
            type: 'POST',
            data: {
                profile_name: Profile_name
            },
            dataType: 'json',
            success: function (response) {
                $("#editprofilename").val(response.name);
                $("#editsession").val(response.session);
                $("#editshared").val(response.shared);
                $("#editlimit").val(response.limit);
                $("#editdatelimit").val(response.daytouse);
                $("#editProfile").append('<input type="hidden" name="editprofile_name" id="editprofile_name" value="' + response.name + '"/>');
                $("#editProfile").off('submit').on('submit', function () {
                    var form = $(this);
                    var editshared = $("#editshared").val();
                    if (editshared) {
                        $.ajax({
                            url: '../process/site_admin_router/profilestatus_update_process.php',
                            type: 'POST',
                            data: form.serialize(),
                            dataType: 'json',
                            success: function (response) {
                                if (response.success == true) {
                                    swal("สำเร็จ", response.messages, "success");
                                    profilestatus.ajax.reload(null, false);
                                    $("#editProfileModal").modal('hide');
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