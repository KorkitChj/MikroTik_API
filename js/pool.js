var ip_pool;
$(document).ready(function () {
    ip_pool = $("#ip_pool").DataTable({
        "order": [],
        "ajax": {
            url: "../site/addpool_retrieve.php",
            type: "POST",
            dataType: 'json',
            error: function (error) {
            },
            dataSrc: function (response) {
                return response.data
            }
        },
        "columnDefs": [{
            "targets": [0,5],
            "orderable": false,
        }],
    });
});
$("#addIppoolModalBtn").on('click', function () {
    $("#add_ippool")[0].reset();
    $("#add_ippool").off('submit').on('submit', function () {
        var form = $(this);
        var name = $("#name").val();
        var ranges = $("#ranges").val();
        //console.log(name);
        //return false;
        if (name && ranges) {
            $.ajax({
                url: '../site/addpool.php',
                type: 'POST',
                data: form.serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        swal("สำเร็จ", response.messages, "success");
                        $("#add_ippool")[0].reset();
                        ip_pool.ajax.reload(null, false);
                        $("#addIppoolModal").modal('hide');
                    } else {
                        swal("ผิดพลาด", response.messages, "error");
                    }
                }
            });
        }
        return false;
    });
});
function removePool(Pool_id) {
    if (Pool_id) {
        $("#removePoolBtn").off('click').on('click', function () {
            $.ajax({
                url: '../site/addpool_del.php',
                type: 'POST',
                data: { 'pool_id':Pool_id, 'type': 'one' },
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        swal("สำเร็จ", response.messages, "success");
                        ip_pool.ajax.reload(null, false);
                        $("#removePoolModal").modal('hide');
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
$('#removeAllPoolBtn').click(function () {
    var Pool_id = [];
    $('.checkitem:checked').each(function (i) {
        Pool_id[i] = $(this).val();
    });
    console.log(Pool_id);
    if (Pool_id.length === 0) {
        swal("ผิดพลาด", "กรุณาเลือก Checkbox!", "error");
    } else {
        $.ajax({
            url: '../site/addpool_del.php',
            method: 'POST',
            data: {
                'pool_id': Pool_id, 'type': 'many'
            },
            dataType: 'json',
            success: function (response) {
                if (response.success == true) {
                    swal("สำเร็จ", response.messages, "success");
                    ip_pool.ajax.reload(null, false);
                    $("#removeAllPoolModal").modal('hide');
                } else {
                    swal("ผิดพลาด", response.messages, "error");
                }
            }
        });
    }
});
function editIppool(id) {
    if (id) {
        console.log(id);
        $.ajax({
            url: '../site/getSelectedpool.php',
            type: 'POST',
            data: {
                ip_pool: id
            },
            dataType: 'json',
            success: function (response) {
                $("#editname").val(response.name);
                $("#editranges").val(response.ranges);
                $("#editnextpool").val(response.nextpool);
                $("#edit_pool").append('<input type="hidden" name="edit_ippool" id="edit_ippool" value="' + response.id + '"/>');
                $("#edit_pool").off('submit').on('submit', function () {
                    var form = $(this);
                    var editname = $("#editname").val();
                    var editranges = $("#editranges").val();
                    var editnextpool = $("#editnextpool").val();
                    //console.log(editname);
                    if (editname && editranges) {
                        $.ajax({
                            url: '../site/addpool_update.php',
                            type: 'POST',
                            data: form.serialize(),
                            dataType: 'json',
                            success: function (response) {
                                if (response.success == true) {
                                    swal("สำเร็จ", response.messages, "success");
                                    ip_pool.ajax.reload();
                                    $("#editIppoolModal").modal('hide');
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

