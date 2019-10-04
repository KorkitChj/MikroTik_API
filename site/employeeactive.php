<?php
session_start();
include("../includes/template_backend/site_admin/a_config.php");
if (!$_SESSION["cus_id"]) {
    Header("Location:../index.php");
}
include('../siteadmin/expired.php');
include('function.php');
error_reporting(0);
$cus_id = $_SESSION['cus_id'];
$location_id = $_SESSION['location_id'];

list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

if ($API->connect($ip . ":" . $port, $user, $pass)) {
    $ARRAY = $API->comm("/user/group/print");
}

//include('service_fetch.php');

?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once("../includes/template_backend/admin/head-tag-contents.php"); ?>
</head>

<body>
    <?php include("../includes/template_backend/site_admin/bar_top.php"); ?>
    <div class="page-wrapper chiller-theme toggled">
        <?php include("../includes/template_backend/site_admin/navigation_site.php"); ?>
        <?php include('../siteadmin/changpwsite.php'); ?>
        <main class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="form-group col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Online Employee Details</div>
                            <div id="employee_status" class="panel-body">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="../js/alert_disconnect.js"></script>
            <?php include("../includes/template_backend/admin/footer.php"); ?>
        </main>
        <?php include('../siteadmin/useronlinejs.php'); ?>
        <script>
            $(document).ready(function() {
                <?php
                if ($_SESSION["cus_id"]) {
                    ?>
                    fetch_employee_data();
                    setInterval(function() {
                        fetch_employee_data();
                    }, 10000);

                    function fetch_employee_data() {
                        var action = "fetch_data";
                        $.ajax({
                            url: "employeeonline_action.php",
                            method: "POST",
                            data: {
                                action: action
                            },
                            success: function(data) {
                                $('#employee_status').html(data);
                            }
                        });
                    }
                <?php
                } ?>
            });
        </script>
    </div>
</body>

</html>