<?php
session_start();
?>
<?php
if (!$_SESSION["cus_id"]) {
    Header("Location:../login.php");
} else { ?>
    <title>Interface Monitor</title>
    <?php
    require('../template/template.html');
    include('../siteadmin/expired.php');
    include('../siteadmin/useronlinejs.php');
    include('../siteadmin/changpwsite.php');
    include('function.php');

    $cus_id = $_SESSION['cus_id'];
    $location_id = $_SESSION['location_id'];

    include('service_fetch.php');

    list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

    ?>
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
                        <?php echo fetchimage($cus_id);?>
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
                        <li class="pad-a bor-yellow">
                            <a href="#">
                                <i class="glyphicon glyphicon-signal"></i>
                                &nbsp;Interface Monitor</a>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="glyphicon glyphicon-user"></i>
                                &nbsp;รายการพนักงานดูแล</a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="employeestatus.php" id="addemployee">
                                            <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;เพิ่มพนักงาน
                                        </a>
                                    </li>
                                    <li>
                                        <a href="employeeactive.php" id="employeeactive">
                                            <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;พนักงานออนไลน์
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="glyphicon glyphicon-flag"></i>
                                &nbsp;Address List</a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="addresslist.php" id="addresslistBtn">
                                            <span class="glyphicon glyphicon-flag"></span>&nbsp;Add Address List
                                        </a>
                                    </li>
                                    <li>
                                        <a href="pool.php" id="addPoolBtn">
                                            <span class="glyphicon glyphicon-flag"></span>&nbsp;Add Address Pool
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="glyphicon glyphicon-wrench"></i>
                                &nbsp;Hotspot Setup</a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="addserverprofile.php" id="addserverprofileBtn">
                                            <span class="glyphicon glyphicon-flag"></span>&nbsp;Add Server Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="addserver.php" id="addserverBtn">
                                            <span class="glyphicon glyphicon-flag"></span>&nbsp;Add Server
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="profilestatus.php">
                                <i class="glyphicon glyphicon-th-list"></i>
                                &nbsp;รายการ Profile</a>
                        </li>
                        <li>
                            <a href="wallgardenstatus.php">
                                <i class="glyphicon glyphicon-menu-hamburger"></i>
                                &nbsp;รายการ ByPass</a>
                        </li>
                        <!-- <li>
                            <?php
                            if ($service == 1) {
                                echo '<a href="">
                                    <i class="glyphicon glyphicon-menu-hamburger"></i>
                                    &nbsp;รายการ AA</a>';
                            } else {
                                echo '<a href="">
                                    <i class="glyphicon glyphicon-menu-hamburger"></i>
                                    &nbsp;รายการ BB</a>';
                            }
                            ?>
                        </li> -->
                        <li>
                            <a href="../siteadmin/connectstatus.php">
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
                <h2>Interface</h2>
                <hr>
                <div style="margin-bottom:20px"><h5><a href="../siteadmin/connectstatus.php">หน้าหลัก</a>><a href="#" style="color:black;text-decoration:underline">Interface Monitor</a></h5></div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <div class="panel panel-default">
                        <button type="button" style="margin-bottom:20px" class="btn btn-warning btn-sm" onclick="window.location.href='interfacemonitor.php'"><img src="../img/refresh.png" width="20" title="Refresh">&nbsp;&nbsp;Reconnect</button>
                            <div class="panel-heading">รายการ Interface</div>
                            <div id="interface_status" class="panel-body">

                            </div>
                        </div>
                        <div id="ff" class="panel panel-default"></div>
                    </div>
                </div>
            </div>
        </main>
        <!-- page-content" -->
    </div>
    <!-- page-wrapper -->
    <script>
        $(document).ready(function() {
            <?php
            if ($_SESSION["cus_id"]) {
                ?>
                fetch_interface_data();
                setInterval(function() {
                    fetch_interface_data();
                },3000);

                function fetch_interface_data() {
                    var action = "fetch_data";
                    $.ajax({
                        url: "interface_action.php",
                        method: "POST",
                        data: {
                            action: action
                        },
                        success: function(data) {
                            $('#interface_status').html(data);
                        }
                    });
                } <?php
            } ?>
        });
        function time() {
            return timea = new Date().toLocaleString(); 
        }
        function enableInterface(id){
            if(id){
                $.ajax({
                    url: "enable_disable_interface.php",
                    type: "POST",
                    data:{'action':id,'type':'enable'},
                    dataType:'json',
                    success:function(response){
                        $("#ff").append("<b>Port  "+response.data+"  เปิดแล้ว</b> "+time()+" <br>");
                    }
                });
            }
        }
        function disableInterface(id){
            if(id){
                $.ajax({
                    url: "enable_disable_interface.php",
                    type: "POST",
                    data:{'action':id,'type':'disable'},
                    dataType:'json',
                    success:function(response){
                        $("#ff").append("<b>Port  "+response.data+"  ปิดแล้ว</b> "+time()+" <br>");
                    }
                });
            }
        }
    </script>
<?php } ?>