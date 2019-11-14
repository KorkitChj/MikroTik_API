<?php
session_start();
include("../includes/template_backend/admin/page_link_config.php");
$admin_name = $_SESSION["admin_name"];
if (!$_SESSION["admin_id"]) {
    Header("Location:../home");
}
include('../process/admin/function.php');

?>
<!DOCTYPE html>
<html>

<head>
    <?php include("../includes/template_backend/admin/head_tag_contents.php"); ?>
</head>

<body>
    <?php include("../includes/template_backend/admin/bar_top.php"); ?>
    <div class="page-wrapper chiller-theme toggled">
        <?php include("../includes/template_backend/admin/navigation.php"); ?>
        <?php include('changpw.php'); ?>
        <main class="page-content">
            <div class="container-fluid">
                <h2>User Online</h2>
                <hr>
                <div class="row">
                    <div class="form-group col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Online User Details</div>
                            <div id="user_login_status" class="panel-body">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include("../includes/template_backend/admin/footer.php"); ?>
        </main>
    </div>
    <script>
        $(document).ready(function() {
            <?php
            if ($_SESSION["cus_id"]) {
                ?>
                fetch_user_login_data();
                setInterval(function() {
                    fetch_user_login_data();
                }, 3000);

                function fetch_user_login_data() {
                    var action = "fetch_data";
                    $.ajax({
                        url: "../process/admin/useronline_process.php",
                        method: "POST",
                        data: {
                            action: action
                        },
                        success: function(data) {
                            $('#user_login_status').html(data);
                        }
                    });
                }
            <?php
            } ?>
        });
    </script>
</body>

</html>