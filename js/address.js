var ip_table;
$(document).ready(function() {
    ip_table = $("#ip_table").DataTable({
        "order": [],
        "ajax": {
            url: "../site/addresslist_retrieve.php",
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
    $("#addIpModalBtn").on('click', function () {
        $("#add_address")[0].reset();
        $("#add_address").unbind('submit').bind('submit', function () {
            var form = $(this);
            var address = $("#address").val();
            var network = $("#network").val();
            var interface = $("#interface").val();
            if (address && network && interface) {
                $.ajax({
                    url: '../site/add_addresslist.php',
                    type: 'POST',
                    data: form.serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if (response.success == true) {
                            swal("สำเร็จ", response.messages, "success");
                            $("#add_address")[0].reset();
                            ip_table.ajax.reload(null, false);
                            $("#addIpModal").modal('hide');
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
function removeAddress(Address_id) {
    if (Address_id) {
        $("#removeAddressBtn").unbind('click').bind('click', function () {
            $.ajax({
                url: '../site/addresslist_del.php',
                type: 'POST',
                data: { 'address_id':Address_id, 'type': 'one' },
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        swal("สำเร็จ", response.messages, "success");
                        ip_table.ajax.reload(null, false);
                        $("#removeAddressModal").modal('hide');
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
$('#removeAllAddressBtn').click(function () {
    var Address_id = [];
    $('.checkitem:checked').each(function (i) {
        Address_id[i] = $(this).val();
    });
    console.log(Address_id);
    if (Address_id.length === 0) {
        swal("ผิดพลาด", "กรุณาเลือก Checkbox!", "error");
    } else {
        $.ajax({
            url: '../site/addresslist_del.php',
            method: 'POST',
            data: {
                'address_id': Address_id, 'type': 'many'
            },
            dataType: 'json',
            success: function (response) {
                if (response.success == true) {
                    swal("สำเร็จ", response.messages, "success");
                    ip_table.ajax.reload(null, false);
                    $("#removeAllAddressModal").modal('hide');
                } else {
                    swal("ผิดพลาด", response.messages, "error");
                }
            }
        });
    }
});
function editIp(id) {
    if (id) {
        console.log(id);
        $.ajax({
            url: '../site/getSelectedIp.php',
            type: 'POST',
            data: {
                ip_address: id
            },
            dataType: 'json',
            success: function(response) {
                $("#editaddress").val(response.address);
                $("#editnetwork").val(response.network);
                $("#editinterface").val(response.interface);
                $("#editcomment").val(response.comment);
                $("#edit_address").append('<input type="hidden" name="editip_address" id="editip_address" value="' + response.id + '"/>');
                $("#edit_address").unbind('submit').bind('submit', function() {
                    var form = $(this);
                    var editaddress = $("#editaddress").val();
                    var editnetwork = $("#editnetwork").val();
                    var editinterface = $("#editinterface").val();
                    //var editcomment = $("#editcomment").val();

                    if (editaddress && editnetwork && editinterface) {
                        $.ajax({
                            url: '../site/addresslist_update.php',
                            type: 'POST',
                            data: form.serialize(),
                            dataType: 'json',
                            success: function(response) {
                                if (response.success == true) {
                                    swal("สำเร็จ", response.messages, "success");
                                    ip_table.ajax.reload();
                                    $("#editIpModal").modal('hide');
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

function enableAddress(id) {
    if (id) {
        console.log(id);

        $.ajax({
            url: '../site/disable_enable_address.php',
            type: 'POST',
            data: {
                'id': id,
                'type': 'enable'
            },
            dataType: 'json',
            success: function(data) {
                ip_table.ajax.reload();
                $("#ss").append("<b>Port " + data.id + " เปิดแล้ว</b>  "+ time() +"<br>");
            }
        });
    }
}

function disableAddress(id) {
    if (id) {
        console.log(id);

        $.ajax({
            url: '../site/disable_enable_address.php',
            type: 'POST',
            data: {
                'id': id,
                'type': 'disable'
            },
            dataType: 'json',
            success: function(data) {
                ip_table.ajax.reload();
                $("#ss").append("<b>Port " + data.id + " ปิดแล้ว</b> "+ time() +"<br>");
            }
        });
    }
}