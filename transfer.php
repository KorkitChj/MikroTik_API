<?php
require('template/template_transfer.html');
?>
<?php
require('include/connect_db.php');
error_reporting(0);
if (is_uploaded_file($_FILES['file']['tmp_name'])) {
    $e = $_FILES['file']['error'];
    if ($e != 0) {
        $msg = "";
        if ($e == 1 || $e == 2) {
            $msg = "ไฟล์ที่อัปโหลดมีขนาดเกินกำหนด";
        } else {
            $msg = "เกิดข้อผิดพลาดในการอัปโหลดไฟล์";
        }
        echo "<script>";
        echo "alert($msg);";
        echo "</script>";
    } else {
        $name = $_FILES['file']['name'];
        $tmp_name = $_FILES['file']['tmp_name'];
        $date = $_POST['date'];
        $bank = $_POST['bank'];
        $money = $_POST['money'];
        $username = $_POST['username'];
        $bk = "";
        if ($bank == 1) {
            $bk = "ไทยพาญิชย์";
        } elseif ($bank == 2) {
            $bk = "กรุงไทย";
        } elseif ($bank == 3) {
            $bk = "กสิกรไทย";
        } else {
            $bk = "กรุงเทพ";
        }
        $sqlor = "SELECT a.username FROM siteadmin AS a WHERE username = :username";
        $query = $conn->prepare($sqlor);
        $query->bindparam(':username', $username);
        if ($query->execute()) {
            $num_rows = $query->rowCount();
            if ($num_rows == 0) {
                echo "<script>";
                echo "alert(\"usernameไม่มีอยู่\");";
                echo "window.history.back()";
                echo "</script>";
                exit;
            } else {
                $sqlar = "SELECT b.cus_id FROM siteadmin AS a INNER JOIN orderpd AS b ON
                                a.cus_id = b.cus_id WHERE username = :username";
                $query1 = $conn->prepare($sqlar);
                $query1->bindparam(':username', $username);
                if ($query1->execute()) {
                    $num_rows1 = $query1->rowCount();
                    if ($num_rows1 == 0) {
                        echo "<script>";
                        echo "alert(\"คุณยังไม่ใด้สั่งซื้อ\");";
                        echo "window.history.back()";
                        echo "</script>";
                        exit;
                    } else {
                        @mkdir("slips");
                        $target = "slips/$name";
                        $newname = $name;
                        if (file_exists($target)) {
                            $oldname = pathinfo($name, PATHINFO_FILENAME);
                            $ext = pathinfo($name, PATHINFO_EXTENSION);
                            $newname = $oldname;
                            do {
                                $r = rand(1000, 9999);
                                $newname = $oldname . "-" . $r . ".$ext";
                                $target = "slips/$newname";
                            } while (file_exists($target));
                        }
                        move_uploaded_file($_FILES['file']['tmp_name'], $target);
                        $id = "";
                        while ($row = $query1->fetch(PDO::FETCH_ASSOC)) {
                            $id = $row['cus_id'];
                        }
                        $sqlid = "SELECT a.order_id FROM orderpd AS a WHERE a.cus_id = :id";
                        $query2 = $conn->prepare($sqlid);
                        $query2->bindparam(':id', $id);
                        $query2->execute();
                        if ($query2 !== false) {
                            $result = $query2->fetch(PDO::FETCH_ASSOC);
                            $orderid = $result['order_id'];
                            $sqlp = "INSERT INTO payment VALUES('',:bk,:date,:money,:newname,0,:orderid)";
                            $query3 = $conn->prepare($sqlp);
                            $query3->bindparam(':bk', $bk);
                            $query3->bindparam(':date', $date);
                            $query3->bindparam(':money', $money);
                            $query3->bindparam(':newname', $newname);
                            $query3->bindparam(':orderid', $orderid);
                            $query3->execute();
                            echo "<script>";
                            echo "alert(\"ดำเนินการเรียบร้อยแล้ว\");";
                            echo "window.location.href='login.php';";
                            echo "</script>";
                            exit;
                        }
                    }
                }
            }
        }
    }
}
?>
<title>Transfer</title>
<div class="container" style="width:100%; max-width:600px">
    <div class="row">
        <div class="col">
            <div class="card text-white bg-info border-danger">
                <div class="card-header">
                    <p align="center">แจ้งโอนเงิน</p>
                </div>
                <div class="card-body">
                    <form method="post" action="" enctype="multipart/form-data" name="form1" id="form1">
                        <div class="form-group row">
                            <label for="username" class="control-label col-sm">Username:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="far fa-user"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bank_info" class="control-label col-sm">ธนาคาร:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-university"></i>
                                    </div>
                                </div>
                                <select name="bank" id="bank" class="form-control bank_info" required>
                                    <option value="">----- เลือกธนาคาร-----</option>
                                    <option value="1">ธนาคารไทยพาญิชย์</option>
                                    <option value="2">ธนาคารกรุงไทย</option>
                                    <option value="3">ธนาคารกสิกรไทย</option>
                                    <option value="4">ธนาคารกรุงเทพ</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date" class="control-label col-sm">เวลาชำระ:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                </div>
                                <input type="datetime-local" name="date" class="form-control" id="date" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="money" class="control-label col-sm">จำนวนเงิน:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-money-check-alt"></i>
                                    </div>
                                </div>
                                <input type="number" name="money" placeholder="จำนวนเงิน" class="form-control" id="money" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="file" class="control-label col-sm">File:&nbsp;</label>
                            <div class="col-sm-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-image"></i>
                                    </div>
                                </div>
                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760">
                                <input class="btn" name="file" type="file" id="file" accept="image/*" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col col-form-label"></label>
                            <div class="col-12">
                                <button type="bottom" class="btn btn-danger btn-lg btn-block" onclick="window.history.back()">ยกเลิก</button>                
                                <button type="submit" value="form1" class="btn btn-success btn-lg btn-block"><i class="fas fa-sign-in-alt"></i>&nbsp;OK</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>