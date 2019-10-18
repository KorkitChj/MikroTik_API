var employeestatus;
$(document).ready(function () {
    employeestatus = $("#employeestatus").DataTable({
        "order": [],
        "ajax": {
            url: "../process/site_admin_router/employeestatus_retrieve_process.php",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [0,6],
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
$("#addMemberModalBtn").click(function () {
    $("#addMember")[0].reset();
    $("#addMember").off('submit').on('submit', function () {
        var form = $(this);
        var name = $("#name").val();
        var username = $("#username").val();
        var password = $("#password").val();
        var site = $("#site").val();
        var group = $("#group").val();
        if (name && username && password && site && group) {
            $.ajax({
                url: '../process/site_admin_router/employee_add_process.php',
                type: 'POST',
                data: form.serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        swal("สำเร็จ", response.messages, "success");
                        $("#addMember")[0].reset();
                        employeestatus.ajax.reload(null, false);
                        $("#addMemberModal").modal('hide');
                    } else {
                        swal("ผิดพลาด", response.messages, "error");
                    }
                }
            });
        }
        return false;
    });
});
function removeMember(id,name) {
    if (id) {
        $("#removeMemberBtn").off('click').on('click', function () {
            $.ajax({
                url: '../process/site_admin_router/employeestatus_del_process.php',
                type: 'POST',
                data: { 'emp_id': id,'name': name,'type': 'one' },
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        swal("สำเร็จ", response.messages, "success");
                        employeestatus.ajax.reload(null, false);
                        $("#removeMemberModal").modal('hide');
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
$('#removeAllMemberBtn').click(function () {
    var emp_id = [];
    $('.checkitem:checked').each(function (i) {
        emp_id[i] = $(this).val();
    });
    if (emp_id.length === 0) {
        swal("ผิดพลาด", "กรุณาเลือก Checkbox!", "error");
    } else {
        $.ajax({
            url: '../process/site_admin_router/employeestatus_del_process.php',
            method: 'POST',
            data: {
                'emp_id': emp_id, 'type': 'many'
            },
            dataType: 'json',
            success: function (response) {
                if (response.success == true) {
                    swal("สำเร็จ", response.messages, "success");
                    employeestatus.ajax.reload(null, false);
                    $("#checkall").prop("checked",false);
                    $("#removeAllMemberModal").modal('hide');
                } else {
                    swal("ผิดพลาด", response.messages, "error");
                }
            }
        });
    }
});
function editMember(id,name) {
    if (id) {
        console.log(id,name);
        $.ajax({
            url: '../process/site_admin_router/getSelectedMember.php',
            type: 'POST',
            data: {
                'emp_name': id,'name' : name
            },
            dataType: 'json',
            success: function (response) {
                $("#editname").val(response.full_name);
                $("#editusername").val(response.username);
                $("#editpassword").val(response.pass_w);
                $("#editcomment").val(response.comment);
                $("#editgroup").val(response.group);
                $("#editMember").append('<input type="hidden" name="editemp_name" id="editemp_name" value="'+response.id+'"/>');
                $("#editMember").off('submit').on('submit', function () {
                    var form = $(this);
                    var editname = $("#editname").val();
                    var editpassword = $("#editpassword").val();

                    if (editname && editpassword) {
                        $.ajax({
                            url: '../process/site_admin_router/employeestatus_update_process.php',
                            type: 'POST',
                            data: form.serialize(),
                            dataType: 'json',
                            success: function (response) {
                                if (response.success == true) {
                                    swal("สำเร็จ", response.messages, "success");
                                    employeestatus.ajax.reload(null, false);
                                    $("#editMemberModal").modal('hide');
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
function enableEmp(id) {
    if (id) {
        console.log(id);

        $.ajax({
            url: '../process/site_admin_router/disable_enable_emp_process.php',
            type: 'POST',
            data: {
                'id': id,
                'type': 'enable'
            },
            dataType: 'json',
            success: function(data) {
                employeestatus.ajax.reload();
                $("#ss").append("<b>Employee " + data.id + " เปิดแล้ว</b>  "+ time() +"<br>");
            }
        });
    }
}
function disableEmp(id) {
    if (id) {
        console.log(id);

        $.ajax({
            url: '../process/site_admin_router/disable_enable_emp_process.php',
            type: 'POST',
            data: {
                'id': id,
                'type': 'disable'
            },
            dataType: 'json',
            success: function(data) {
                employeestatus.ajax.reload();
                $("#ss").append("<b>Employee " + data.id + " ปิดแล้ว</b> "+ time() +"<br>");
            }
        });
    }
}


                    
            
