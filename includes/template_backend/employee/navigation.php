<a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
</a>
<nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
        <div class="sidebar-brand">
            <a href="#">Web API MikroTik</a>
            <div id="close-sidebar">
                <i class="fas fa-times"></i>
            </div>
        </div>
        <div class="sidebar-header">
            <div class="user-pic">
                <?php echo fetchlogo($emp_id)[0]; ?>
            </div>
            <div class="user-info">
                <span class="user-name">
                    <strong><a class="navbar-brand" href="#"><span style="color:gray">Employee</span>&nbsp;<?php print_r($_SESSION["emp_name"]); ?></a></strong>
                </span>
                <span class="user-role">พนักงาน</span>
                <span class="user-status">
                    <i class="fa fa-circle"></i>
                    <span>Online</span>
                </span>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li class="header-menu">
                    <span>ทั่วไป</span>
                </li>
                <li class="<?php if ($CURRENT_PAGE == "employee_con") { ?>pad-a<?php } ?>">
                    <a href="employee.php">
                        <i class="glyphicon glyphicon-home"></i>&nbsp;หน้าหลัก</a>
                </li>
                <li class="<?php if ($CURRENT_PAGE == "cpwe") { ?>pad-a<?php } ?>">
                    <a href="changpwemp.php">
                        <i class="glyphicon glyphicon-edit"></i>&nbsp;
                        เปลี่ยนรหัสผ่าน</a>
                </li>
                <!-- <li>
                    <a href="" data-toggle="modal" data-target="#exampleModal" id="btnPacket">
                        <i class="fab fa-get-pocket"></i>&nbsp;
                        แจ้งอัพเดท Packet</a>
                </li> -->
                <li>
                    <a href="#" class="logout">
                        <i class="fas fa-sign-out-alt"></i>&nbsp;
                        Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="packet_form" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">แจ้งอัพเดท Packet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="comment">Comment:</label>
                    <textarea class="form-control" placeholder="ข้อความ" rows="5" id="comment" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" id="submit_navigation" class="btn btn-primary">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div> -->
<!-- <script>
    $(document).on('submit', '#packet_form', function(event) {
        event.preventDefault();
        var comment = $("#comment").val();
        console.log(comment);
        if (comment != '') {
            $.ajax({
                url: "updatepacket.php",
                method: 'POST',
                data: {
                    'data': comment,
                    'emp_id': <?php echo $_SESSION["emp_id"] ?>
                },
                dataType: 'json',
                success: function(data) {
                    $("#exampleModal").modal('hide');
                    $("#packet_form")[0].reset();
                    swal("สำเร็จ", data.messages, "success");
                }
            });
        }
    });
</script> -->
<script src="../js/site_emp/logout.js"></script>