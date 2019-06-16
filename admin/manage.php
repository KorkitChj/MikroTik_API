<?php
session_start();
?>
<?php
require('../template/template.html');
require('../include/connect_db.php');
if (!$_SESSION["admin_id"]) {
    Header("Location:../login.php");
} else { ?>
    <style>
        .btn-danger,
        .btn-success,
        .btn-warning {
            background-color: white;
            color: black;
        }

        .bg-info {
            background: #bdc3c7;
            background: linear-gradient(to bottom, #bdc3c7, #2c3e50);
            background: -webkit-linear-gradient(to bottom, #2c3e50, #bdc3c7);
        }

        th {
            color: darkblue;
        }
        td{
            color:white;
        }
        table.dataTable thead th{
            border-bottom: 0;
        }
        .pad-a{
            background-color:rgba(0, 0, 0, 0.3);
        }
    </style>
    <?php
    if (isset($_POST['cus_id'])) {
        $id = implode(", ", $_POST['cus_id']);
        $sql = "DELETE FROM siteadmin WHERE cus_id IN ($id)";
        $query = $conn->prepare($sql);
        $query->execute();
        echo "<div class=\"alert alert-danger alert-dismissible fade show\">
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
        <strong>Success!</strong> ลบข้อมูลแล้ว
        </div>";
    }
    if (isset($_GET['id_del'])) {
        $id_del = $_GET['id_del'];
        $sql = "DELETE FROM siteadmin WHERE cus_id = :id_del";
        $result =  $conn->prepare($sql);
        $result->bindparam(':id_del', $id_del);
        $result->execute();
        echo "<div class=\"alert alert-danger alert-dismissible fade show\">
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
        <strong>Success!</strong> ลบข้อมูลแล้ว
        </div>";
    }
    ?>
    <title>Manage</title>
    <div class="container-fluid">
        <div class="row">
            <div class="col ">
            </div>
        </div>
        <div class="row">
            <div class="col ">
                <nav class="navbar fixed-top navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
                    <a class="navbar-brand" href="admin.php"><span style="color:red">Admin</span><span style="color:blue">|</span><?php print_r($_SESSION["admin_name"]); ?></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item   pad">
                                <a href="admin.php" class="nav-link ">
                                    <span class="badge badge-primary"><i class="fa fa-home"></i></span>
                                    หน้าหลัก</a>
                            </li>
                            <li class="nav-item  pad">
                                <a href="checkpayment.php" class="nav-link">
                                    <span class="badge badge-primary"><i class="fas fa-user-check"></i></span>
                                    ยืนยันการชำระเงิน</a>
                            </li>
                            <li class="nav-item active  pad-a">
                                <a href="#" class="nav-link active">
                                    <span class="badge badge-danger"><i class="fas fa-tasks"></i></span>
                                    จัดการเจ้าของไซต์</a>
                            </li>
                            <li class="nav-item  pad">
                                <a href="changpw.php" class="nav-link ">
                                    <span class="badge badge-danger"><i class="fas fa-exchange-alt"></i></span>
                                    เปลี่ยนรหัสผ่าน</a>
                            </li>
                            <li class="nav-item  pad">
                                <a href="admin_logout.php" class="nav-link " onclick="return confirm('ยืนยันการออกจากระบบ')">
                                    <span class="badge badge-danger"><i class="fas fa-sign-out-alt"></i></span>
                                    ออกจากระบบ</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row ">
            <div class="col">
                <form action="#" method="post">
                    <button onClick="return confirm('คุณต้องการที่จะลบข้อมูลที่เลือกนี้หรือไม่ ?');" class="btn btn-danger" style="margin:1em 1em" name="del_all">ลบข้อมูลแถวที่เลือก</button>
                    <table id="example" class="table table-striped table-hover table-sm" style="width:100%">
                        <thead class="bg-info">
                            <tr>
                                <th></th>
                                <th>เจ้าของไซต์</th>
                                <th>สถานบริการ</th>
                                <th>ราคา</th>
                                <th>วันที่ชำระเงิน</th>
                                <th>วันหมดอายุ</th>
                                <th>สถานะ</th>
                                <th>ลบ</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result =  $conn->query("SELECT a.cus_id,username,site_name,total_cash,paid,
                            slip_name,transfer_date,appointment
                            FROM siteadmin AS a INNER JOIN orderpd AS b ON
                            a.cus_id = b.cus_id INNER JOIN payment AS c ON
                            b.order_id = c.order_id WHERE c.paid = 1");


                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                if ($row["total_cash"] != 500) {
                                    $startdate = $row["transfer_date"];
                                    $enddate = strtotime('+365 days', strtotime($startdate));
                                } elseif ($row["total_cash"] == 500) {
                                    $startdate = $row["transfer_date"];
                                    $enddate = strtotime('+183 days', strtotime($startdate));
                                }
                                if ($row["paid"] == 1) {
                                    $status = "ชำระเงินแล้ว";
                                }

                                ?>
                                <tr>
                                    <td><input type="checkbox" class="cus_checkbox" name="cus_id[]" value="<?php echo $row["cus_id"]; ?>"></td>
                                    <td><?php echo $row["username"]; ?></td>
                                    <td><?php echo $row["site_name"]; ?></td>
                                    <td><?php echo $row["total_cash"]; ?></td>
                                    <td><?php echo $row["transfer_date"]; ?></td>
                                    <td><?php echo date('Y-m-d', $enddate); ?></td>
                                    <td><?php echo $status; ?></td>
                                    <td><?php echo "<a onClick=\"return confirm('คุณต้องการที่จะลบข้อมูลนี้หรือไม่ ?');\" href=\"manage.php?id_del={$row['cus_id']}\"><button  type=\"button\" id=\delete\" class=\"update btn btn-danger btn-sm\">
                                            <span title=\"ลบข้อมูล\" class=\"glyphicon glyphicon-trash\"></span></button></a>"; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>

<?php } ?>