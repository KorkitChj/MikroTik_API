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
                <?php echo fetchimage($cus_id); ?>
            </div>
            <div class="user-info">
                <span class="user-name">
                    <strong><a class="navbar-brand" href="#"><span style="color:gray">Admin</span>&nbsp;<?php print_r($_SESSION["cus_name"]); ?></a></strong>
                </span>
                <span class="user-role">ผู้ดูแล</span>
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
                <li class="<?php if ($CURRENT_PAGE == "interface") { ?>pad-a<?php } ?>">
                    <a href="interfacemonitor.php">
                        <i class="glyphicon glyphicon-signal"></i>
                        &nbsp;Interface Monitor</a>
                </li>
                <li class="<?php if ($CURRENT_PAGE == "employee") { ?>pad-a<?php } ?>">
                    <a href="employeestatus.php">
                        <i class="glyphicon glyphicon-user"></i>
                        &nbsp;เพิ่มพนักงาน</a>
                </li>
                <li class="<?php if ($CURRENT_PAGE == "employeeactive") { ?>pad-a<?php } ?>">
                    <a href="employeeactive.php">
                        <i class="glyphicon glyphicon-user"></i>
                        &nbsp;พนักงานออนไลน์</a>
                </li>
                <li class="<?php if ($CURRENT_PAGE == "serverprofile") { ?>pad-a<?php } ?>">
                    <a href="addserverprofile.php">
                        <i class="glyphicon glyphicon-flag"></i>
                        &nbsp;รายการ Server Profile</a>
                </li>
                <li class="<?php if ($CURRENT_PAGE == "hotspotprofile") { ?>pad-a<?php } ?>">
                    <a href="profilestatus.php">
                        <i class="glyphicon glyphicon-th-list"></i>
                        &nbsp;รายการ Hotspot Profile</a>
                </li>
                <li class="<?php if ($CURRENT_PAGE == "wallgarden") { ?>pad-a<?php } ?>">
                    <a href="wallgardenstatus.php">
                        <i class="glyphicon glyphicon-menu-hamburger"></i>
                        &nbsp;รายการ ByPass</a>
                </li>
                <li>
                    <a href="../siteadmin/connectstatus.php">
                        <i class="glyphicon glyphicon-log-out"></i>&nbsp;
                        กลับหน้าหลัก</a>
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