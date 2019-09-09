<?php
session_start();
?>
<?php
if (!$_SESSION["emp_id"]) {
    Header("Location:../login.php");
} else { ?>
    <title>Employee</title>
    <?php
        //error_reporting(0);

        require('../template/template.html');

        include('function.php');

        $emp_id = $_SESSION['emp_id'];

        list($ip, $port, $user, $pass_r, $site, $conn, $API) = fetchuser($emp_id);

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
                <!-- sidebar-header  -->
                <div class="sidebar-menu">
                    <ul>
                        <li class="header-menu">
                            <span>ทั่วไป</span>
                        </li>
                        <li class="pad-a bor-red">
                            <a href="#">
                                <i class="glyphicon glyphicon-home"></i>&nbsp;หน้าหลัก</a>
                        </li>
                        <li>
                            <a href="changpwemp.php">
                                <i class="glyphicon glyphicon-edit"></i>&nbsp;
                                เปลี่ยนรหัสผ่าน</a>
                        </li>
                        <li>
                            <a href="" data-toggle="modal" data-target="#exampleModal" id="btnPacket">
                                <i class="fab fa-get-pocket"></i>&nbsp;
                                แจ้งอัพเดท Packet</a>
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
                <h2>Site :<?php echo $site ?></h2>
                <hr>
                <div class="row">
                    <div class="form-group col-md-12">
                        <button type="button" class="btn btn-warning" onclick="window.location.href='employee.php'">
                            <img src="../img/refresh.png" width="20" title="Refresh">&nbsp;&nbsp;Reconnect</button>
                        <br /><br />
                        <div class="box">
                            <div class="table-responsive">
                                <table id="connectstatus" class="table table-striped table-hover table-bordered table-sm" style="width:100%">
                                    <thead class="aa">
                                        <th width="3%">IP Address</th>
                                        <th width="2%">Port</th>
                                        <th width="3%">Site</th>
                                        <th width="2%">CPU</th>
                                        <th width="2%">RAM</th>
                                        <th width="2%">Harddisk</th>
                                        <th width="3%">Status</th>
                                        <th width="3%">Options</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if ($API->connect($ip . ":" . $port, $user, $pass_r)) {
                                                $ARRAY = $API->comm("/system/resource/print");
                                                $ram =    $ARRAY['0']['free-memory'] / 1048576;
                                                $hdd =    $ARRAY['0']['free-hdd-space'] / 1048576;
                                                echo "<tr>";
                                                echo "<td>" . $ip . "</td>";
                                                echo "<td>" . $port . "</td>";
                                                echo "<td>" . $site . "</td>";
                                                echo "<td>" . $ARRAY['0']['cpu-load'] . "%</td>";
                                                echo "<td>" . round($ram, 1) . " MB</td>";
                                                echo "<td>" . round($hdd, 1) . " MB</td>";
                                                echo "<td><button type=\"button\" class=\"btn btn-success\"><i class=\"fa fa-check\"></i> CONNECT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></td>";
                                                $conn = "connect";
                                                echo "<td>                   
                                <a  href=\"site_conn.php?&conn=" . $conn . "\">
                                <button type=\"button\" class=\"btn btn-info\" title=\"เข้าบริหารจัดการ\">
                                <i class=\"glyphicon glyphicon-new-window\"></i></button></a>";
                                                echo "</td>";
                                                echo "</tr>";
                                            } else {
                                                echo "<tr>";
                                                echo "<td>" . $ip . "</td>";
                                                echo "<td>" . $port . "</td>";
                                                echo "<td>" . $site . "</td>";
                                                echo "<td> -% </td>";
                                                echo "<td> - MB </td>";
                                                echo "<td> - MB </td>";
                                                echo "<td><button type=\"button\" class=\"btn btn-danger\"><i class=\"fa fa-times\"></i> DISCONNECT</button></td>";
                                                $conn = "disconnect";
                                                echo "<td>
                                    <a href=\"employee.php?&conn=" . $conn . "\">
                                    <button type=\"button\" class=\"btn btn-success\" title=\"เข้าบริหารจัดการ\">
                                    <i class=\"glyphicon glyphicon-new-window\"></i></button></a>";
                                                echo "</td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- page-content" -->
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <button type="submit" id="submit" class="btn btn-primary">บันทึก</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- page-wrapper -->
    <script>
        $(document).ready(function() {
            $('#connectstatus').dataTable({
                "ordering": false,
                "bProcessing": true,
                "sAutoWidth": false,
                "bDestroy": true,
                "sPaginationType": "bootstrap", // full_numbers
                "iDisplayStart ": 10,
                "iDisplayLength": 10,
                "bPaginate": false, //hide pagination
                "bFilter": false, //hide Search bar
                "bInfo": false, // hide showing entries
            })

            $(document).on('submit','#packet_form', function(event) {
                event.preventDefault();
                var comment = $("#comment").val();
                console.log(comment);
                if(comment != ''){
                    $.ajax({
                        url:"updatepacket.php",
                        method:'POST',
                        data:{
                            'data':comment,'emp_id':<?php echo $_SESSION["emp_id"]?>
                        },
                        dataType:'json',
                        success : function(data){
                            $("#exampleModal").modal('hide');
                            $("#packet_form")[0].reset();
                            swal("สำเร็จ", data.messages, "success");
                        }
                    });
                }
            });
        });
    </script>
    <script src="../js/logout.js"></script>
<?php } ?>