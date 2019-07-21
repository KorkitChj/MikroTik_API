var employeestatus;
$(document).ready(function () {
    employeestatus = $("#employeestatus").DataTable({
        "order": [],
        "ajax": {
            url: "employeestatus_retrieve.php",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [0, 5],
            "orderable": false,
        }],
    });
    $("#addMemberModalBtn").on('click', function () {
        $("#addMember")[0].reset();
        $("#addMember").unbind('submit').bind('submit', function () {
            var form = $(this);
            var name = $("#name").val();
            var username = $("#username").val();
            var password = $("#password").val();
            var site = $("#site").val();
            if (name && username && password && site) {
                $.ajax({
                    url: 'addemployee.php',
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
});

function removeMember(id = null) {
    if (id) {
        $("#removeMemberBtn").unbind('click').bind('click', function () {
            $.ajax({
                url: 'employeestatus_del.php',
                type: 'POST',
                data: { 'emp_id': id, 'type': 'one' },
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
            url: 'employeestatus_del.php',
            method: 'POST',
            data: {
                'emp_id': emp_id, 'type': 'many'
            },
            dataType: 'json',
            success: function (response) {
                if (response.success == true) {
                    swal("สำเร็จ", response.messages, "success");
                    employeestatus.ajax.reload(null, false);
                    $("#removeAllMemberModal").modal('hide');
                } else {
                    swal("ผิดพลาด", response.messages, "error");
                }
            }
        });
    }
});
function editMember(id = null) {
    if (id) {
        $.ajax({
            url: 'getSelectedMember.php',
            type: 'POST',
            data: {
                emp_id: id
            },
            dataType: 'json',
            success: function (response) {
                $("#editname").val(response.full_name);
                $("#editusername").val(response.username);
                $("#editpassword").val(response.pass_w);
                $("#editsite").val(response.location_id);
                $("#editMember").append('<input type="hidden" name="editemp_id" id="editemp_id" value="' + response.emp_id + '"/>');
                $("#editMember").unbind('submit').bind('submit', function () {
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

                    
            
