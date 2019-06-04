<?php
session_start();
?>
<?php
if (!$_SESSION["admin_id"]) {
    Header("Location: login.php");
} else { ?>
    <title>Check Payment</title>
    <div class="container-fluid">
        <div class="row">
            <div class="col ">
            </div>
        </div>
        <div class="row">
            <div class="col ">
                <nav class="navbar fixed-top navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
                    <a class="navbar-brand" href="admin.php">Admin: <?php print_r($_SESSION["username"]); ?></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item  ">
                                <a href="admin.php" class="nav-link ">
                                    <span class="badge badge-primary"><i class="fa fa-home"></i></span>
                                    หน้าหลัก</a>
                            </li>
                            <li class="nav-item active">
                                <a href="#" class="nav-link active">
                                    <span class="badge badge-primary"><i class="fas fa-user-check"></i></span>
                                    ยืนยันการชำระเงิน</a>
                            </li>
                            <li class="nav-item">
                                <a href="manage.php" class="nav-link ">
                                    <span class="badge badge-danger"><i class="fas fa-tasks"></i></span>
                                    จัดการเจ้าของไซต์</a>
                            </li>
                            <li class="nav-item">
                                <a href="changpw.php" class="nav-link ">
                                    <span class="badge badge-danger"><i class="fas fa-exchange-alt"></i></span>
                                    เปลี่ยนรหัสผ่าน</a>
                            </li>
                            <li class="nav-item">
                                <a href="logout.php" class="nav-link ">
                                    <span class="badge badge-danger"><i class="fas fa-sign-out-alt"></i></span>
                                    ออกจากระบบ</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <?php
    require('template.html');
    ?>
    <div class="container color-custom ">
        <div class="row ">
            <div class="col d-flex justify-content-center ">
                <!--หน้าถัดจากBrandner-->
                <p>
                    <h3 style="font-weight:bold ;margin-top:1em">การตรวจสอบการชำระเงิน</h3>
                </p>
            </div>
        </div>
        <div class="row ">
            <div class="col">
                <form action="#" method="post">
                    <table id="example" class="table table-striped table-hover table-bordered costum-table-dark" style="width:100%">
                        <thead>
                            <tr>
                                <th><input type="checkbox" onclick="checkAll(this)"></th>
                                <th>เจ้าของไซต์</th>
                                <th>เลขที่ใบสั่งซื้อ</th>
                                <th>จำนวนเงินที่ชำระ</th>
                                <th>หลักฐาน</th>
                                <th>วันที่ยืนยันการชำระเงิน</th>
                                <th>วันนัดชำระ</th>
                                <th>ยืนยันรายการ</th>
                                <th>ลบรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require('connect_db.php');

                            $result =  $conn->query("SELECT username,b.order_id,total_cash,paid,
                            slip,transfer_date,appointment
                        FROM siteadmin AS a INNER JOIN orderpd AS b ON
                        a.cus_id = b.cus_id INNER JOIN payment AS c ON
                        b.order_id = c.order_id WHERE c.paid = 0");
                            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                                $startdate = $row["transfer_date"];
                                $enddate = strtotime('+7 days', strtotime($startdate));
                                echo "<tr>";
                                echo "<td><input type=\"checkbox\" name=\"\"></td>";
                                echo "<td> ", $row["username"], "</td>\n";
                                echo "<td> ", $row["order_id"], "</td>\n";
                                echo "<td> ", $row["total_cash"], "</td>\n";
                                //echo '<td><img src="/slips/' . $slip . '"/></td>\n';
                                echo "<td> ", "รูปภาพSlips", "</td>\n";
                                echo "<td> ", $row["transfer_date"], "</td>\n";
                                echo "<td>", date('Y-m-d', $enddate), "</td>\n";
                                echo '<td><button type = "button" data-toggle = "modal" data-target = "#confirm" data-uid = "1" class = "update btn btn-warning btn-sm">
                                 <span class="glyphicon glyphicon-ok"></span></button></td>';
                                echo '<td><button type = "button" data-toggle = "modal" data-target = "#cancle" data-uid = "1" class = "delete btn btn-danger  btn-sm">
                                 <span class="glyphicon glyphicon-remove"></span></button></td>';
                                echo "\t</tr>\n";
                            }
                            $result->free();
                            ?>

                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "aLengthMenu": [
                    [5, 10, 25, -1],
                    [5, 10, 25, "All"]
                ],
                "iDisplayLength": 5
            });
        });
        function checkAll(bx) {
                var cbs = document.getElementsByTagName('input');
                for (var i = 0; i < cbs.length; i++) {
                    if (cbs[i].type == 'checkbox') {
                        cbs[i].checked = bx.checked;
                    }
                }
            }
    </script>
<?php } ?>