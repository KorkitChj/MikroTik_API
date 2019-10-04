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

//include('service_fetch.php');

list($ip, $port, $user, $pass, $site, $conn, $API) = fetchuser($cus_id, $location_id);

if ($API->connect($ip . ":" . $port, $user, $pass)) {
    $ARRAY = $API->comm("/system/resource/print");
    $boardname =    $ARRAY['0']['board-name'];
    $version =    $ARRAY['0']['version'];
}
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
                            <div class="panel-heading">รายการ Interface</div>
                            <div id="interface_status" class="panel-body">

                            </div>
                        </div>
                        <div id="ff" class="panel panel-default"></div>
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    <?php
                    if ($_SESSION["cus_id"]) {
                        ?>
                        fetch_interface_data();
                        setInterval(function() {
                            fetch_interface_data();
                        }, 3000);

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
                        }
                    <?php
                    } ?>
                });

                function time() {
                    return timea = new Date().toLocaleString();
                }

                function enableInterface(id) {
                    if (id) {
                        $.ajax({
                            url: "enable_disable_interface.php",
                            type: "POST",
                            data: {
                                'action': id,
                                'type': 'enable'
                            },
                            dataType: 'json',
                            success: function(response) {
                                $("#ff").append("<b>Port  " + response.data + "  เปิดแล้ว</b> " + time() + " <br>");
                            }
                        });
                    }
                }

                function disableInterface(id) {
                    if (id) {
                        $.ajax({
                            url: "enable_disable_interface.php",
                            type: "POST",
                            data: {
                                'action': id,
                                'type': 'disable'
                            },
                            dataType: 'json',
                            success: function(response) {
                                $("#ff").append("<b>Port  " + response.data + "  ปิดแล้ว</b> " + time() + " <br>");
                            }
                        });
                    }
                }
            </script>
            <script src="../js/alert_disconnect.js"></script>
            <?php include("../includes/template_backend/admin/footer.php"); ?>
        </main>
        <?php include('../siteadmin/useronlinejs.php');?>
    </div>
</body>

</html>