var addserver;
$(document).ready(function() {
    addserver = $("#addserver").DataTable({
        "order": [],
        "ajax": {
            url: "../site/addserver_retrieve.php",
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
    $("#addServerModalBtn").on('click', function () {
        $("#add_server")[0].reset();
        $("#add_server").unbind('submit').bind('submit', function () {
            var form = $(this);
            var name = $("#name").val();
            var interface = $("#interface").val();
            //console.log(name);
            //console.log(interface);
            //return false;
            if (name,interface) {
                $.ajax({
                    url: '../site/add_server.php',
                    type: 'POST',
                    data: form.serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if (response.success == true) {
                            swal("สำเร็จ", response.messages, "success");
                            $("#add_server")[0].reset();
                            addserver.ajax.reload(null, false);
                            $("#addServerModal").modal('hide');
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
function removeServer(Server_id) {
    if (Server_id) {
        $("#removeServerBtn").unbind('click').bind('click', function () {
            $.ajax({
                url: '../site/addserver_del.php',
                type: 'POST',
                data: { 'server_id':Server_id, 'type': 'one' },
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        swal("สำเร็จ", response.messages, "success");
                        addserver.ajax.reload(null, false);
                        $("#removeServerModal").modal('hide');
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
$('#removeAllServerBtn').click(function () {
    var Server_id = [];
    $('.checkitem:checked').each(function (i) {
        Server_id[i] = $(this).val();
    });
    console.log(Server_id);
    if (Server_id.length === 0) {
        swal("ผิดพลาด", "กรุณาเลือก Checkbox!", "error");
    } else {
        $.ajax({
            url: '../site/addserver_del.php',
            method: 'POST',
            data: {
                'server_id': Server_id, 'type': 'many'
            },
            dataType: 'json',
            success: function (response) {
                if (response.success == true) {
                    swal("สำเร็จ", response.messages, "success");
                    addserver.ajax.reload(null, false);
                    $("#removeAllServerModal").modal('hide');
                } else {
                    swal("ผิดพลาด", response.messages, "error");
                }
            }
        });
    }
});
function editServer(id = null) {
    if (id) {
        console.log(id);
        $.ajax({
            url: '../site/getSelectedServer.php',
            type: 'POST',
            data: {
                name: id
            },
            dataType: 'json',
            success: function(response) {
                $("#editname").val(response.name);
                $("#editinterface").val(response.interface);
                $("#editpool").val(response.pool);
                $("#editprofile").val(response.profile);
                console.log(response.name);
                $("#edit_server").append('<input type="hidden" name="edit_sv" id="edit_sv" value="' + response.id + '"/>');
                $("#edit_server").unbind('submit').bind('submit', function() {
                    var form = $(this);
                    var editname = $("#editname").val();
                    var editinterface = $("#editinterface").val();
                    if (editname && editinterface) {
                        $.ajax({
                            url: '../site/addserver_update.php',
                            type: 'POST',
                            data: form.serialize(),
                            dataType: 'json',
                            success: function(response) {
                                if (response.success == true) {
                                    swal("สำเร็จ", response.messages, "success");
                                    addserver.ajax.reload();
                                    $("#editServerModal").modal('hide');
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
function time() {
    return timea = new Date().toLocaleString(); 
}
function enableServer(id = null) {
    if (id) {
        console.log(id);

        $.ajax({
            url: '../site/disable_enable_server.php',
            type: 'POST',
            data: {
                'id': id,
                'type': 'enable'
            },
            dataType: 'json',
            success: function(data) {
                addserver.ajax.reload();
                $("#ss").append("<b>Server " + data.id + " เปิดแล้ว</b>  "+ time() +"<br>");
            }
        });
    }
}

function disableServer(id = null) {
    if (id) {
        console.log(id);

        $.ajax({
            url: '../site/disable_enable_server.php',
            type: 'POST',
            data: {
                'id': id,
                'type': 'disable'
            },
            dataType: 'json',
            success: function(data) {
                addserver.ajax.reload();
                $("#ss").append("<b>Server " + data.id + " ปิดแล้ว</b> "+ time() +"<br>");
            }
        });
    }
}