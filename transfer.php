<?php
require('template/template_customer.html');
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
<link rel="stylesheet" href="css/style.css">
<title>Transfer</title>
<style>
    html {
        height: 100%;
        border-top: red 0.25em solid;
    }

    body {
        background-image: url('img/16948.jpg');
        background-repeat: no-repeat;
        background-size: cover;
    }

    #border-login {
        background: #ccffff;
        background-repeat: no-repeat;
        background-size: cover;
        padding: 1.5em;
        border-radius: 5px;
        border-left:#0099ff 5px solid;
        margin: 2em 2em;
    }

    label {
        color: black;
        font-weight: bold;
    }
    p {
        color:red;
        font-weight: bold;
        font-size:2em;
    }

    p:hover {
        color:black;
    }
    .btn-danger,.btn-primary,.btn-warning{
        background-color:white;
        color:black;
    }
    input[type="text"],[type="datetime-local"],[type="number"],[type="file"],[type="file"]
    {
        border: 0;
        border-bottom: 1px solid red;
        outline: 0;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col d-flex justify-content-center">
            <div id="border-login">
                <p align="center">แจ้งโอนเงิน</p>
                <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
                    <div class="form-group row">
                        <label for="inputusername" class="col-sm-1 col-form-label"><i class="far fa-user"></i></label>
                        <div class="col-sm-11">
                            <input type="text" class="form-control " name="username" placeholder="ชื่อผู้ใช้งาน" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bank_info" class="col-sm-1 col-form-label"><i class="fas fa-university"></i></label>
                        <div class="col-sm-11">
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
                        <label for="time" class="col-sm-1 col-form-label"><i class="fas fa-clock"></i></label>
                        <div class="col-sm-11">
                            <input type="datetime-local" name="date" class="form-control" id="note" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="money" class="col-sm-1 col-form-label"><i class="fas fa-money-check-alt"></i></label>
                        <div class="col-sm-11">
                            <input type="number" name="money" placeholder="จำนวนเงิน" class="form-control" id="money" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="slips" class="col-sm-1 col-form-label"><i class="fas fa-image"></i></label>
                        <div class="col-sm-11">
                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760">
                            <input class="btn btn-primary" name="file" type="file" id="image_name" accept="image/*" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="b" class="col-sm-1 col-form-label"></label>
                        <div class="col-sm-11">
                            <button type="submit" name="MM_insert" value="form1" class="btn btn-primary">ยืนยัน</button>
                            <button type="reset" name="reset" class="btn btn-warning">รีเซ็ต</button>
                            <button type="bottom" class="btn btn-danger" onclick="window.history.back()">ยกเลิก</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>