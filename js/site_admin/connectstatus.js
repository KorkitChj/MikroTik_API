var connectstatus;
$(document).ready(function () {
    connectstatus = $("#connectstatus").DataTable({
        "order": [],
        "ajax": {
            url: "../process/site_admin/connectstatus_retrieve_process.php",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [0,5,7],
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
                url: '../process/site_admin/addconnect_process.php',
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
function removeSite(id) {
    if (id) {
        $("#removeSiteBtn").off('click').on('click', function (){
            $.ajax({
                url: '../process/site_admin/connectstatus_del_process.php',
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
            url: '../process/site_admin/connectstatus_del_process.php',
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
            url: '../process/site_admin/getSelectedSite_process.php',
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
                            url: '../process/site_admin/connectstatus_update_process.php',
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



