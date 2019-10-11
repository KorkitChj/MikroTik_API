var userstatus;
$(document).ready(function () {
    userstatus = $("#userstatus").DataTable({
        "order": [[1,"desc"]],
        "ajax": {
            url: "../process/site_emp/userstatus_retrieve.php",
            type: "POST",
            error: function (error) {
            },
            dataSrc: function (response) {
                return response.data
            }
        },
        "columnDefs": [
        {
            "targets": [0, 6],
            "orderable": false,
        }
    ],
    "createdRow": function (row, data, dataIndex) {
        if (data[5] != '') {
            $(row).css({ "color": "black","background-color":"#ff8080" });
        }
    }
    });
    $("#addUserModalBtn").on('click', function () {
        $("#addUser")[0].reset();
        $("#addUser").off('submit').on('submit', function () {
            var form = $(this);
            var name = $("#name").val();
            var password = $("#password").val();
            var profile = $("#profile").val();
            //var limituptime = $("#limituptime").val();
            //var comment = $("#comment").val();
            if (name && password && profile) {
                $.ajax({
                    url: '../process/site_emp/adduser.php',
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
        $("#addUsersNum").off('submit').on('submit', function () {
            var form = $(this);
            var prefix = $("#prefix").val();
            var total = $("#total").val();
            var username = $("#username").val();
            var passwordnum = $("#passwordnum").val();
            var profiles = $("#profiles").val();
            //var limituptimes = $("#limituptimes").val();
            //var comments = $("#comments").val();
            if (prefix && total && username && passwordnum && profiles) {
                $.ajax({
                    url: '../process/site_emp/addusersnum.php',
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
        $("#addUsersString").off('submit').on('submit', function () {
            var form = $(this);
            var prefixst = $("#prefixst").val();
            var totalst = $("#totalst").val();
            var usernamest = $("#usernamest").val();
            var passwordst = $("#passwordst").val();
            var profilest = $("#profilest").val();
            //var limituptimest = $("#limituptimest").val();
            //var commentst = $("#commentst").val();
            if (prefixst && totalst && usernamest && passwordst && profilest) {
                $.ajax({
                    url: '../process/site_emp/addusersstring.php',
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
    $("#addProfileModalBtn").on('click', function () {
        $("#addProfile")[0].reset();
        $("#addProfile").off('submit').on('submit', function () {
            var form = $(this);
            var shared = $("#shared").val();
            if (shared) {
                $.ajax({
                    url: '../process/site_emp/addprofile.php',
                    type: 'POST',
                    data: form.serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if (response.success == true) {
                            swal("สำเร็จ", response.messages, "success");
                            $("#addProfile")[0].reset();
                            location.reload();
                            //$("#load_data").load(location.href + " #load>*", "");
                            $("#addProfileModal").modal('hide');
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
                url: '../process/site_emp/userstatus_del.php',
                method: 'POST',
                data: {
                    'users_name': users_name, 'type': 'many'
                },
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        swal("สำเร็จ", response.messages, "success");
                        userstatus.ajax.reload(null, false);
                        $('#checkall').prop("checked", false)
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
            window.location = "../process/site_emp/prints.php"+"?users_name="+users_name;
        }
    });
});
function removeUser(user_name) {
    if (user_name) {
        $("#removeUserBtn").off('click').on('click', function () {
            $.ajax({
                url: '../process/site_emp/userstatus_del.php',
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
            url: '../process/site_emp/getSelectedUser.php',
            type: 'POST',
            data: {
                user_name: User_name
            },
            dataType: 'json',
            success: function (response) {
                $("#editname").val(response.name);
                $("#editpassword").val(response.password);
                $("#editprofile").val(response.profile);
                //$("#editlimituptime").val(response.limituptime);
                //$("#editcomment").val(response.comment);
                $("#editUser").append('<input type="hidden" name="edituser_name" id="edituser_name" value="' + response.name + '"/>');
                $("#editUser").off('submit').on('submit', function () {
                    var form = $(this);
                    var editname = $("#editname").val();
                    var editpassword = $("#editpassword").val();
                    var editprofile = $("#editprofile").val();
                    //var editlimituptime = $("#editlimituptime").val();
                    //var editcomment = $("#editcomment").val();


                    if (editname && editpassword && editprofile) {
                        $.ajax({
                            url: '../process/site_emp/userstatus_update.php',
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



