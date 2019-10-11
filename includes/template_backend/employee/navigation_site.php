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
                <li class="<?php if ($CURRENT_PAGE == "dashboard") { ?>pad-a<?php } ?>">
                    <a href="dashboard.php">
                        <i class="glyphicon glyphicon-dashboard"></i>
                        &nbsp;Dashboard</a>
                </li>
                <li class="<?php if ($CURRENT_PAGE == "userstatus") { ?>pad-a<?php } ?>">
                    <a href="userstatus.php">
                        <i class="glyphicon glyphicon-user"></i>
                        &nbsp;รายการ Users</a>
                </li>
                <?php if ($CURRENT_PAGE == "userstatus") { ?>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#addUserModal" id="addUserModalBtn">
                            <i class="fas fa-user "></i>&nbsp;เพิ่ม User ครั้งละ 1 คน
                        </a>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#addUsersNumModal" id="addUsersNumModalBtn">
                            <i class="fas fa-users "></i>&nbsp;เพิ่ม Users แบบกลุ่มตัวเลข 0-9
                        </a>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#addUsersStringModal" id="addUsersStringModalBtn">
                            <i class="fas fa-users "></i>&nbsp;เพิ่ม Users แบบกลุ่ม A-Z
                        </a>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#addProfileModal" id="addProfileModalBtn">
                            <i class="glyphicon glyphicon-plus "></i>&nbsp;เพิ่ม Profile
                        </a>
                    </li>
                    <li>
                        <a href="employee.php">
                            <i class="glyphicon glyphicon-log-out"></i>&nbsp;
                            กลับหน้าหลัก</a>
                    </li>
                    <li>
                        <a href="#" class="logout">
                            <i class="fas fa-sign-out-alt"></i>&nbsp;
                            Logout</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
<script src="../js/site_emp/logout.js"></script>