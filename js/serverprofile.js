var serverprofile;
$(document).ready(function() {
    serverprofile = $("#serverprofile").DataTable({
        "order": [],
        "ajax": {
            url: "../site/addserverprofile_retrieve.php",
            type: "POST",
            error: function (error) {
            },
            dataSrc: function (response) {
                return response.data
            }
        },
        "columnDefs": [{
            "targets": [0,7],
            "orderable": false,
        }],
    });
});
$("#addServerProfileModalBtn").on('click', function () {
    $("#add_serverprofile")[0].reset();
    $("#add_serverprofile").off('submit').on('submit', function () {
        var form = $(this);
        var name = $("#name").val();
        //console.log(name);
        //return false;
        if (name) {
            $.ajax({
                url: '../site/add_serverprofile.php',
                type: 'POST',
                data: form.serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        swal("สำเร็จ", response.messages, "success");
                        $("#add_serverprofile")[0].reset();
                        serverprofile.ajax.reload(null, false);
                        $("#addServerProfileModal").modal('hide');
                    } else {
                        swal("ผิดพลาด", response.messages, "error");
                    }
                }
            });
        }
        return false;
    });
});
function removeServerProfile(ServerP_id) {
    if (ServerP_id) {
        $("#removeServerPBtn").off('click').on('click', function () {
            $.ajax({
                url: '../site/addserverprofile_del.php',
                type: 'POST',
                data: { 'serverp_id':ServerP_id, 'type': 'one' },
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        swal("สำเร็จ", response.messages, "success");
                        serverprofile.ajax.reload(null, false);
                        $("#removeServerProfileModal").modal('hide');
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
$('#removeAllServerPBtn').click(function () {
    var serverp_id = [];
    $('.checkitem:checked').each(function (i) {
        serverp_id[i] = $(this).val();
    });
    console.log(serverp_id);
    if (serverp_id.length === 0) {
        swal("ผิดพลาด", "กรุณาเลือก Checkbox!", "error");
    } else {
        $.ajax({
            url: '../site/addserverprofile_del.php',
            method: 'POST',
            data: {
                'serverp_id': serverp_id, 'type': 'many'
            },
            dataType: 'json',
            success: function (response) {
                if (response.success == true) {
                    swal("สำเร็จ", response.messages, "success");
                    serverprofile.ajax.reload(null, false);
                    $("#removeAllServerPModal").modal('hide');
                } else {
                    swal("ผิดพลาด", response.messages, "error");
                }
            }
        });
    }
});
function editServerProfile(id) {
    if (id) {
        console.log(id);
        $.ajax({
            url: '../site/getSelectedServerProfile.php',
            type: 'POST',
            data: {
                name: id
            },
            dataType: 'json',
            success: function(response) {
                $("#editname").val(response.name);
                $("#edithotadd").val(response.address);
                $("#editdns").val(response.dns);
                $("#editrate").val(response.rate);
                console.log(response.name);
                $("#edit_serverprofile").append('<input type="hidden" name="edit_sp" id="edit_sp" value="' + response.id + '"/>');
                $("#edit_serverprofile").off('submit').on('submit', function() {
                    var form = $(this);
                    var editname = $("#editname").val();
                    if (editname) {
                        $.ajax({
                            url: '../site/addserverprofile_update.php',
                            type: 'POST',
                            data: form.serialize(),
                            dataType: 'json',
                            success: function(response) {
                                if (response.success == true) {
                                    swal("สำเร็จ", response.messages, "success");
                                    serverprofile.ajax.reload();
                                    $("#editServerProfileModal").modal('hide');
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