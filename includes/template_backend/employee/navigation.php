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
                    <a href="employee_status">
                        <i class="glyphicon glyphicon-home"></i>&nbsp;หน้าหลัก</a>
                </li>
                <li class="<?php if ($CURRENT_PAGE == "cpwe") { ?>pad-a<?php } ?>">
                    <a href="chang_password">
                        <i class="glyphicon glyphicon-edit"></i>&nbsp;
                        เปลี่ยนรหัสผ่าน</a>
                </li>
                <li>
                    <a href="#" class="logout">
                        <i class="fas fa-sign-out-alt"></i>&nbsp;
                        Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script src="../js/site_emp/logout.js"></script>