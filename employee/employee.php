<?php
session_start();
include("../includes/template_backend/employee/page_link_config.php");
if (!$_SESSION["emp_id"]) {
    Header("Location:../index.php");
}
include('function.php');

$emp_id = $_SESSION['emp_id'];

list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($emp_id);
?>
<!DOCTYPE html>
<html>

<head>
    <?php include("../includes/template_backend/admin/head_tag_contents.php"); ?>
</head>

<body>
    <div class="page-wrapper chiller-theme toggled">
    <?php include("../includes/template_backend/admin/bar_top.php"); ?>
        <?php include("../includes/template_backend/employee/navigation.php"); ?>
        <main class="page-content">
            <div class="container-fluid">
                <h5>Site :<?php echo $site ?></h5>
                <hr>
                <div class="row">
                    <div class="form-group col-md-12">
                        <button type="button" class="btn btn-warning btn-sm" onclick="window.location.href='employee.php'">
                            <img src="../img/refresh.png" width="20" title="Refresh">&nbsp;&nbsp;Reconnect</button>
                        <div class="float-right">
                            <span class="badge-pill badge-info">เข้าจัดการไซต์</span>
                        </div>
                        <br /><br />
                        <div class="box">
                            <div class="table-responsive">
                                <table id="connectstatus" class="table table-striped table-hover  table-sm" style="width:100%">
                                    <thead class="aa">
                                        <th width="3%">IP Address</th>
                                        <th width="2%">Port</th>
                                        <th width="3%">Site</th>
                                        <th width="2%">CPU</th>
                                        <th width="2%">RAM</th>
                                        <th width="2%">Harddisk</th>
                                        <th width="3%">Status</th>
                                        <th width="3%">Option</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($API->connect($ip . ":" . $port, $user, $pass)) {
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
                                            echo "<td><button type=\"button\" class=\"btn btn-success btn-sm\"><i class=\"fa fa-check\"></i> CONNECT</button></td>";
                                            $conn = "connect";
                                            echo "<td>                   
                                <a  href=\"../process/site_emp/site_conn.php?&conn=" . $conn . "\">
                                <button type=\"button\" class=\"btn btn-info btn-sm\" title=\"เข้าบริหารจัดการ\">
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
                                            echo "<td><button type=\"button\" class=\"btn btn-danger btn-sm\"><i class=\"fa fa-times\"></i> DISCONNECT</button></td>";
                                            $conn = "disconnect";
                                            echo "<td>
                                    <a href=\"employee.php?&conn=" . $conn . "\">
                                    <button type=\"button\" class=\"btn btn-success btn-sm\" title=\"เข้าบริหารจัดการ\">
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
            <?php include("../includes/template_backend/admin/footer.php"); ?>
        </main>
        <script>
            $(document).ready(function() {
                $('#connectstatus').dataTable({
                    "ordering": false,
                    "bProcessing": true,
                    "sAutoWidth": false,
                    "bDestroy": true,
                    "sPaginationType": "bootstrap",
                    "iDisplayStart ": 10,
                    "iDisplayLength": 10,
                    "bPaginate": false,
                    "bFilter": false,
                    "bInfo": false,
                })
            });
        </script>
    </div>
</body>

</html>