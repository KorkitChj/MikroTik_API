var wallstatus;
$(document).ready(function () {
    wallstatus = $("#wallstatus").DataTable({
        "order": [],
        "ajax": {
            url: "wallgardenstatus_retrieve.php",
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
            "targets": [0, 5],
            "orderable": false,
        }],
    });
    $("#addWallModalBtn").on('click', function () {
        $("#addWall")[0].reset();
        $("#addWall").unbind('submit').bind('submit', function () {
            var form = $(this);
            var domainname = $("#domainname").val();
            var action = $("#action").val();
            var comment = $("#comment").val();
            if (domainname && action && comment) {
                $.ajax({
                    url: 'addwallgarden.php',
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
});

function removeWall(Wall_id) {
    if (Wall_id) {
        $("#removeWallBtn").unbind('click').bind('click', function () {
            $.ajax({
                url: 'wallgardenstatus_del.php',
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
            url: 'wallgardenstatus_del.php',
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
            url: 'getSelectedWallGarden.php',
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
                $("#editWall").unbind('submit').bind('submit', function () {
                    var form = $(this);
                    var editdomainname = $("#editdomainname").val();
                    var editaction = $("#editaction").val();
                    var editcomment = $("#editcomment").val();

                    if (editdomainname && editaction && editcomment) {
                        $.ajax({
                            url: 'wallgardenstatus_update.php',
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



