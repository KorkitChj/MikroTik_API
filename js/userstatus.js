var userstatus;
$(document).ready(function () {
    userstatus = $("#userstatus").DataTable({
        "order": [],
        "ajax": {
            url: "../employee/userstatus_retrieve.php",
            type: "POST",
            error: function (error) {
            },
            dataSrc: function (response) {
                return response.data
            }
        },
        "columnDefs": [{
            "targets": [0, 6],
            "orderable": false,
        }],
    });
    $("#addUserModalBtn").on('click', function () {
        $("#addUser")[0].reset();
        $("#addUser").unbind('submit').bind('submit', function () {
            var form = $(this);
            var name = $("#name").val();
            var password = $("#password").val();
            var profile = $("#profile").val();
            var limituptime = $("#limituptime").val();
            var comment = $("#comment").val();
            if (name && password && profile && limituptime && comment) {
                $.ajax({
                    url: '../employee/adduser.php',
                    method: 'POST',
                    data: form.serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if (response.success == true) {
                            swal("สำเร็จ", response.messages, "success");
                            $("#addUser")[0].reset();
                            userstatus.ajax.reload(null, false);
                            $("#addUserModal").modal('hide');
                        } else {
                            swal("ผิดพลาด", response.messages, "error");
                        }
                    }
                });
            }
            return false;
        });
    });
    $("#addUsersNumModalBtn").on('click', function () {
        $("#addUsersNum")[0].reset();
        $("#addUsersNum").unbind('submit').bind('submit', function () {
            var form = $(this);
            var prefix = $("#prefix").val();
            var total = $("#total").val();
            var username = $("#username").val();
            var passwordnum = $("#passwordnum").val();
            var profiles = $("#profiles").val();
            var limituptimes = $("#limituptimes").val();
            var comments = $("#comments").val();
            if (prefix && total && username && passwordnum && profiles && limituptimes && comments) {
                $.ajax({
                    url: '../employee/addusersnum.php',
                    method: 'POST',
                    data: form.serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if (response.success == true) {
                            swal("สำเร็จ", response.messages, "success");
                            $("#addUsersNum")[0].reset();
                            userstatus.ajax.reload(null, false);
                            $("#addUsersNumModal").modal('hide');
                        } else {
                            swal("ผิดพลาด", response.messages, "error");
                        }
                    }
                });
            }
            return false;
        });
    });
    $("#addUsersStringModalBtn").on('click', function () {
        $("#addUsersString")[0].reset();
        $("#addUsersString").unbind('submit').bind('submit', function () {
            var form = $(this);
            var prefixst = $("#prefixst").val();
            var totalst = $("#totalst").val();
            var usernamest = $("#usernamest").val();
            var passwordst = $("#passwordst").val();
            var profilest = $("#profilest").val();
            var limituptimest = $("#limituptimest").val();
            var commentst = $("#commentst").val();
            if (prefixst && totalst && usernamest && passwordst && profilest && limituptimest && commentst) {
                $.ajax({
                    url: '../employee/addusersstring.php',
                    method: 'POST',
                    data: form.serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if (response.success == true) {
                            swal("สำเร็จ", response.messages, "success");
                            $("#addUsersString")[0].reset();
                            userstatus.ajax.reload(null, false);
                            $("#addUsersStringModal").modal('hide');
                        } else {
                            swal("ผิดพลาด", response.messages, "error");
                        }
                    }
                });
            }
            return false;
        });
    });

    $('#checkall').click(function () {
        $('.checkitem').prop("checked", $(this).prop("checked"))
    })
    $('#removeAllUsersBtn').click(function () {
        var users_name = [];
        $('.checkitem:checked').each(function (i) {
            users_name[i] = $(this).val();
        });
        if (users_name.length === 0) {
            swal("ผิดพลาด", "กรุณาเลือก Checkbox!", "error");
        } else {
            //console.log(users_name);
            //return false;
            $.ajax({
                url: '../employee/userstatus_del.php',
                method: 'POST',
                data: {
                    'users_name': users_name, 'type': 'many'
                },
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        swal("สำเร็จ", response.messages, "success");
                        userstatus.ajax.reload(null, false);
                        $("#removeAllUsersModal").modal('hide');
                    } else {
                        swal("ผิดพลาด", response.messages, "error");
                    }
                }
            });
        }
    });
    $('#print').click(function () {
        var users_name = [];
        $('.checkitem:checked').each(function (i) {
            users_name[i] = $(this).val();
        });
        if (users_name.length === 0) {
            swal("ผิดพลาด", "กรุณาเลือก Checkbox!", "error");
        } else {
            //console.log(users_name);
            //return false;
            window.location = "../employee/prints.php"+"?users_name="+users_name;
        }
    });
});

function removeUser(user_name) {
    if (user_name) {
        $("#removeUserBtn").unbind('click').bind('click', function () {
            $.ajax({
                url: '../employee/userstatus_del.php',
                type: 'POST',
                data: { 'user_name': user_name, 'type': 'one' },
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        swal("สำเร็จ", response.messages, "success");
                        userstatus.ajax.reload(null, false);
                        $("#removeUserModal").modal('hide');
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
function editUser(User_name) {
    if (User_name) {
        $.ajax({
            url: '../employee/getSelectedUser.php',
            type: 'POST',
            data: {
                user_name: User_name
            },
            dataType: 'json',
            success: function (response) {
                $("#editname").val(response.name);
                $("#editpassword").val(response.password);
                $("#editprofile").val(response.profile);
                $("#editlimituptime").val(response.limituptime);
                $("#editcomment").val(response.comment);
                $("#editUser").append('<input type="hidden" name="edituser_name" id="edituser_name" value="' + response.name + '"/>');
                $("#editUser").unbind('submit').bind('submit', function () {
                    var form = $(this);
                    var editname = $("#editname").val();
                    var editpassword = $("#editpassword").val();
                    var editprofile = $("#editprofile").val();
                    var editlimituptime = $("#editlimituptime").val();
                    var editcomment = $("#editcomment").val();


                    if (editname && editpassword && editprofile && editlimituptime && editcomment) {
                        $.ajax({
                            url: 'userstatus_update.php',
                            type: 'POST',
                            data: form.serialize(),
                            dataType: 'json',
                            success: function (response) {
                                if (response.success == true) {
                                    swal("สำเร็จ", response.messages, "success");
                                    userstatus.ajax.reload(null, false);
                                    $("#editUserModal").modal('hide');
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



