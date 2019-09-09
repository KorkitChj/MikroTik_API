var connectstatus;
$(document).ready(function () {
    connectstatus = $("#connectstatus").DataTable({
        "order": [],
        "ajax": {
            url: "../siteadmin/connectstatus_retrieve.php",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [0, 8, 10],
            "orderable": false,
        }],
    });
});
$("#addSiteModalBtn").click(function () {
    $("#addsite")[0].reset();
    $("#addsite").off('submit').on('submit', function () {
        var form = $(this);
        var extension = $('#site_image').val().split('.').pop().toLowerCase();
        if (extension != '') {
            if (jQuery.inArray(extension, ['png', 'jpg', 'jpeg']) == -1) {
                swal("ผิดพลาด", "Invalid Image File", "error");
                $('#site_image').val('');
                return false;
            }
        }
        var ipaddress = $("#ipaddress").val();
        var username = $("#username").val();
        var password = $("#password").val();
        var portapi = $("#portapi").val();
        var namesite = $("#namesite").val();
        if (ipaddress && username && namesite && password && portapi && extension) {
            $.ajax({
                url: '../siteadmin/addconnect.php',
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
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
$("#addImageModalBtn").click(function () {
    $("#formimage")[0].reset();
    $("#formimage").off('submit').on('submit', function () {
        var form = $(this);
        var extension = $('#image').val().split('.').pop().toLowerCase();
        if (extension != '') {
            if (jQuery.inArray(extension, ['png', 'jpg', 'jpeg']) == -1) {
                swal("ผิดพลาด", "Invalid Image File", "error");
                $('#image').val('');
                return false;
            }
        }
        var image = $("#image").val();
        if (image) {
            $.ajax({
                url: '../siteadmin/addimage.php',
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (response) {
                    if(response.success == true){
                        $("#formimage")[0].reset();
                        $("#load").load(location.href + " #load>*", "");
                        $("#addImageModal").modal('hide');
                    }
                }
            });
        }
        return false;
    });
});
function removeSite(id) {
    if (id) {
        $("#removeSiteBtn").off('click').on('click', function (){
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
$('#checkall').click(function () {
    $('.checkitem').prop("checked", $(this).prop("checked"))
})
$('#removeAllSiteBtn').click(function () {
    var location_id = [];
    $('.checkitem:checked').each(function (i) {
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
                    $("#checkall").prop("checked",false);
                } else {
                    swal("ผิดพลาด", response.messages, "error");
                    $("#checkall").prop("checked",false);
                }
            }
        });
    }
});
function editSite(id) {
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
                $('#site_uploaded_image').html(response.site_image);
                $("#editSite").append('<input type="hidden" name="editlocation_id" id="editlocation_id" value="' + response.location_id + '"/>');
                console.log(response.location_id);
                $("#editSite").off('submit').on('submit', function () {
                    var form = $(this);
                    var editipaddress = $("#editipaddress").val();
                    var editusername = $("#editusername").val();
                    var editpassword = $("#editpassword").val();
                    var editportapi = $("#editportapi").val();
                    var editnamesite = $("#editnamesite").val();

                    if (editipaddress && editusername && editnamesite && editpassword && editportapi) {
                        $.ajax({
                            url: '../siteadmin/connectstatus_update.php',
                            type: 'POST',
                            data: new FormData(this),
                            contentType: false,
                            processData: false,
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
$(document).on('submit','#packet_form', function(event) {
    event.preventDefault();
    var bank = $("#bank").val();
    var date = $("#date").val();
    var money = $("#money").val();
    var slip = $("#fileslip").val();
    if(bank != '' && date != '' && money != '' && slip != ''){
        $.ajax({
            url:"../siteadmin/updatepacket_siteadmin.php",
            method:'POST',
            data:new FormData(this),
            contentType:false,
            processData:false,
            dataType:'json',
            success : function(data){
                if(data.success == true){
                    swal("สำเร็จ", data.messages, "success");
                    $("#exampleModal").modal('hide');
                    $("#packet_form")[0].reset();
                }else{
                    swal("ผิดพลาด", data.messages, "error");
                    $("#packet_form")[0].reset();
                }
            }
        });
    }
});


