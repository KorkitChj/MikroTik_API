<?php
session_start();
?>
<?php
if (!$_SESSION["emp_id"]) {
    Header("Location:../login.php");
} else { ?>
    <title>Users Online</title>
    <?php
    require('../template/template.html');

    $emp_id = $_SESSION['emp_id'];

    include('function.php');

    list($ip, $port, $user, $pass_r, $site, $conn, $API) = fatchuser($emp_id);

    if ($API->connect($ip . ":" . $port, $user, $pass_r)) {
        $ARRAY3 = $API->comm("/ip/hotspot/user/print");
        $ARRAY2 = $API->comm("/system/scheduler/print");
        $ARRAY = $API->comm("/ip/hotspot/active/print");
    }
    ?>
    <style>
        #coupong {
            background: #f1f1f1;
        }

        .th {
            background: #66ccff;
        }
    </style>
    <div class="page-wrapper chiller-theme toggled">
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
                        <img src="../img/iconuser.jpg" alt="user" style="height:70px;width:60px">
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
                <!-- sidebar-header  -->
                <div class="sidebar-menu">
                    <ul>
                        <li class="header-menu">
                            <span>ทั่วไป</span>
                        </li>
                        <li>
                            <a href="dashboard.php">
                                <i class="glyphicon glyphicon-dashboard"></i>
                                &nbsp;Dashboard</a>
                        </li>
                        <li class="sidebar-dropdown pad-a bor-orange">
                            <a href="#">
                                <i class="glyphicon glyphicon-user"></i>
                                &nbsp;รายการ Users</a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="#" id="useronline">
                                            <span class="fas fa-users "></span>&nbsp;User Online
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" data-toggle="modal" data-target="#addUserModal" id="addUserModalBtn">
                                            <span class="fas fa-user "></span>&nbsp;เพิ่ม User ครั้งละ 1 คน
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" data-toggle="modal" data-target="#addUsersNumModal" id="addUsersNumModalBtn">
                                            <span class="fas fa-users "></span>&nbsp;เพิ่ม Users แบบกลุ่มตัวเลข 0-9
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" data-toggle="modal" data-target="#addUsersStringModal" id="addUsersStringModalBtn">
                                            <span class="fas fa-users "></span>&nbsp;เพิ่ม Users แบบกลุ่ม A-Z
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="employee.php">
                                <i class="glyphicon glyphicon-log-out"></i>&nbsp;
                                กลับหน้าหลัก</a>
                        </li>
                    </ul>
                </div>
                <!-- sidebar-menu  -->
            </div>
            <!-- sidebar-content  -->
            <div class="sidebar-footer">
                <a href="#" class="logout">
                    <i class="fas fa-sign-out-alt">ออกจากระบบ</i>
                </a>
            </div>
        </nav>
        <!-- sidebar-wrapper  -->
        <main class="page-content">
            <div class="container-fluid">
                <h2>รายการ Users Online</h2>
                <hr>
                <div class="row">
                    <div class="form-group col-md-12">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Profile</th>
                                        <th>Username</th>
                                        <th>Ip address</th>
                                        <th>Mac address</th>
                                        <th>start-date</th>
                                        <th>Profile</th>
                                        <th>Up time</th>
                                        <th>Data use</th>
                                        <th>Login-by</th>
                                        <th>Kick</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $num = count($ARRAY);
                                    $num2 = count($ARRAY2);
                                    $num3 = count($ARRAY3);

                                    for ($i = 0; $i < $num; $i++) {
                                        $no = $i + 1;
                                        $bytes =  $ARRAY[$i]['bytes-out'] / 1048576;

                                        echo "<tr>";
                                        echo "<td>" . $no . "</td>";
                                        echo "<td>" . $ARRAY[$i]['server'] . "</td>";
                                        echo "<td>" . $ARRAY[$i]['user'] . "</td>";
                                        echo "<td>" . $ARRAY[$i]['address'] . "</td>";
                                        echo "<td>" . $ARRAY[$i]['mac-address'] . "</td>";
                                        echo "<td>";
                                        for ($ii = 0; $ii < $num2; $ii++) {
                                            if ($ARRAY2[$ii]['name'] == $ARRAY[$i]['user']) {
                                                echo $ARRAY2[$ii]['start-date'] . ' ' . $ARRAY2[$ii]['start-time'];
                                            } else {

                                                //echo "N/A";

                                            }
                                        }
                                        echo "</td>";

                                        echo "<td>";
                                        for ($ii = 0; $ii < $num3; $ii++) {
                                            if ($ARRAY3[$ii]['name'] == $ARRAY[$i]['user']) {
                                                echo $ARRAY3[$ii]['profile'];
                                            } else {

                                                //echo "N/A";

                                            }
                                        }
                                        echo "</td>";
                                        echo "<td>" . $ARRAY[$i]['uptime'] . "</td>";
                                        echo "<td>" . round($bytes, 1) . " MB</td>";
                                        echo "<td>" . $ARRAY[$i]['login-by'] . "</td>";
                                        //  echo "<td><a href='useronline_del.php?user=".$i."'><img src='../img/kik.png' width=20px title=Freekick></a></td>";
                                        echo "<td><a href='useronline_del.php?user=" . $i . "'><button type=\"button\" class=\"btn btn-danger\"><i class=\"fa fa-power-off\"></i></button></a>";
                                        echo "</tr>";
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- page-content" -->
    </div>
    <!-- page-wrapper -->
    <script>
        $(function() {
            $("#example1").DataTable();
        });
    </script>
    <script src="../js/userstatus.js"></script>
    <script src="../js/logout.js"></script>
<?php } ?>