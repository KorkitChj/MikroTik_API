var profilestatus;
$(document).ready(function () {
    profilestatus = $("#profilestatus").DataTable({
        "order": [],
        "ajax": {
            url: "../site/profilestatus_retrieve.php",
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
    });
    $("#addProfileModalBtn").on('click', function () {
        $("#addProfile")[0].reset();
        $("#addProfile").unbind('submit').bind('submit', function () {
            var form = $(this);
            var profilename = $("#profilename").val();
            var idle = $("#idle").val();
            var session = $("#session").val();
            var shared = $("#shared").val();
            var mac = $("#mac").val();
            var limit = $("#limit").val();
            if (profilename && idle && session && shared && mac && limit) {
                $.ajax({
                    url: '../site/addprofile.php',
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
});

function removeProfile(Profile_name) {
    if (Profile_name) {
        $("#removeProfileBtn").unbind('click').bind('click', function () {
            $.ajax({
                url: '../site/profilestatus_del.php',
                type: 'POST',
                data: { 'profile_id':Profile_name, 'type': 'one' },
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
            url: '../site/profilestatus_del.php',
            method: 'POST',
            data: {
                'profile_id': Profile_id, 'type': 'many'
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
            url: '../site/getSelectedProfile.php',
            type: 'POST',
            data: {
                profile_name: Profile_name
            },
            dataType: 'json',
            success: function (response) {
                $("#editprofilename").val(response.name);
                $("#editsession").val(response.session);
                $("#editidle").val(response.idle);
                $("#editshared").val(response.shared);
                $("#editmac").val(response.mac);
                $("#editlimit").val(response.limit);
                $("#editProfile").append('<input type="hidden" name="editprofile_name" id="editprofile_name" value="' + response.name + '"/>');
                $("#editProfile").unbind('submit').bind('submit', function () {
                    var form = $(this);
                    var editprofilename = $("#editprofilename").val();
                    var editsession = $("#editsession").val();
                    var editidle = $("#editidle").val();
                    var editshared = $("#editshared").val();
                    var editmac = $("#editmac").val();
                    var editlimit = $("#editlimit").val();

                    if (editprofilename && editsession && editidle && editshared && editmac && editlimit) {
                        $.ajax({
                            url: '../site/profilestatus_update.php',
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



