var employeestatus;
$(document).ready(function () {
    employeestatus = $("#employeestatus").DataTable({
        "order": [],
        "ajax": {
            url: "../site/employeestatus_retrieve.php",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [0,7],
            "orderable": false,
        }],
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
                url: '../site/addemployee.php',
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
                url: '../site/employeestatus_del.php',
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
            url: '../site/employeestatus_del.php',
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
            url: '../site/getSelectedMember.php',
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
                            url: 'employeestatus_update.php',
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
            url: '../site/disable_enable_emp.php',
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
            url: '../site/disable_enable_emp.php',
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
function viewMessage(Message){
    //console.log(Message);
    if(Message){
        $.ajax({
            url: '../site/message.php',
            type: 'POST',
            data: {
                'id': Message
            },
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $("#message").html("<h4>"+data+"</h4>");
                $("#messageMemberModal").modal('show');
            }
        });
    }
}

                    
            
