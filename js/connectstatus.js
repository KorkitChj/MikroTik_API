var connectstatus;
$(document).ready(function () {
    connectstatus = $("#connectstatus").DataTable({
        "order": [],
        "ajax": {
            url: "../siteadmin/connectstatus_retrieve.php",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [0, 8, 9],
            "orderable": false,
        }],
    });
    $("#addSiteModalBtn").on('click', function () {
        $("#addsite")[0].reset();
        $("#addsite").unbind('submit').bind('submit', function () {
            var form = $(this);
            var ipaddress = $("#ipaddress").val();
            var username = $("#username").val();
            var password = $("#password").val();
            var portapi = $("#portapi").val();
            var namesite = $("#namesite").val();
            if (ipaddress && username && password && portapi && namesite) {
                $.ajax({
                    url: '../siteadmin/addconnect.php',
                    type: 'POST',
                    data: form.serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if (response.success == true) {
                            swal("สำเร็จ", response.messages, "success");
                            $("#addsite")[0].reset();
                            connectstatus.ajax.reload(null, false);
                            $("#addSiteModal").modal('hide');
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

function removeSite(id = null) {
    if (id) {

        $("#removeSiteBtn").unbind('click').bind('click', function () {
            $.ajax({
                url: '../siteadmin/connectstatus_del.php',
                type: 'POST',
                data: { 'location_id': id, 'type': 'one' },
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        swal("สำเร็จ", response.messages, "success");
                        connectstatus.ajax.reload(null, false);
                        $("#removeSiteModal").modal('hide');
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
$('#removeAllSiteBtn').click(function () {
    var location_id = [];
    $(':checkbox:checked').each(function (i) {
        location_id[i] = $(this).val();
    });
    if (location_id.length === 0) {
        swal("ผิดพลาด", "กรุณาเลือก Checkbox!", "error");
    } else {
        $.ajax({
            url: '../siteadmin/connectstatus_del.php',
            method: 'POST',
            data: {
                'location_id': location_id, 'type': 'many'
            },
            dataType: 'json',
            success: function (response) {
                if (response.success == true) {
                    swal("สำเร็จ", response.messages, "success");
                    connectstatus.ajax.reload(null, false);
                    $("#removeAllSiteModal").modal('hide');
                } else {
                    swal("ผิดพลาด", response.messages, "error");
                }
            }
        });
    }
});
function editSite(id = null) {
    if (id) {
        $.ajax({
            url: '../siteadmin/getSelectedSite.php',
            type: 'POST',
            data: {
                location_id: id
            },
            dataType: 'json',
            success: function (response) {
                $("#editipaddress").val(response.ip_address);
                $("#editusername").val(response.username);
                $("#editpassword").val(response.password);
                $("#editportapi").val(response.api_port);
                $("#editnamesite").val(response.working_site);
                $("#editSite").append('<input type="hidden" name="editlocation_id" id="editlocation_id" value="' + response.location_id + '"/>');
                console.log(response.location_id);
                $("#editSite").unbind('submit').bind('submit', function () {
                    var form = $(this);
                    var editipaddress = $("#editipaddress").val();
                    var editusername = $("#editusername").val();
                    var editpassword = $("#editpassword").val();
                    var editportapi = $("#editportapi").val();
                    var editnamesite = $("#editnamesite").val();

                    if (editipaddress && editusername && editpassword && editportapi && editnamesite) {
                        $.ajax({
                            url: '../siteadmin/connectstatus_update.php',
                            type: 'POST',
                            data: form.serialize(),
                            dataType: 'json',
                            success: function (response) {
                                if (response.success == true) {
                                    swal("สำเร็จ", response.messages, "success");
                                    connectstatus.ajax.reload(null, false);
                                    $("#editSiteModal").modal('hide');
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



