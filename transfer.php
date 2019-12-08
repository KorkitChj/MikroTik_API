<?php
session_start();
include("includes/template_frontend/page_link_config.php");
include("includes/datethai_function.php");
error_reporting(0);
?>
<!DOCTYPE html>
<html>

<head>
    <?php include("includes/template_frontend/head_tag_contents.php"); ?>
</head>

<body>
    <?php include("includes/template_frontend/navigation.php"); ?>
    <div class="container margin-top">
        <div class="row">
            <div class="col-md-6 ">
                <div class="card shadow-lg p-3 mb-5 mt-5">
                    <div class="card-header">
                        <h2 align="center"><b>แจ้งโอนเงิน</b></h2>
                    </div>
                    <div class="card-body">
                        <form id="transfer" method="post" action="" enctype="multipart/form-data" name="form1">
                            <div class="form-group row">
                                <!-- <label for="username2" class="control-label col-sm">Username:&nbsp;</label> -->
                                <div class="col-sm-12 input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="far fa-user"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="username2" value="<?php echo $_SESSION['user']; ?>" name="username2" placeholder="Username" autofocus required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <!-- <label for="bank_info" class="control-label col-sm">ธนาคาร:&nbsp;</label> -->
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
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <!-- <label for="date" class="control-label col-sm">เวลาชำระ:&nbsp;</label> -->
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
                                <!-- <label for="money" class="control-label col-sm">จำนวนเงิน:&nbsp;</label> -->
                                <div class="col-sm-12 input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-money-check-alt"></i>
                                        </div>
                                    </div>
                                    <input type="number" name="money" value="<?php echo $_SESSION['price']; ?>" placeholder="จำนวนเงิน" class="form-control" id="money" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <!-- <label for="file" class="control-label col-sm">File:&nbsp;</label> -->
                                <div class="col-sm-12 input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    </div>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760">
                                    <input name="file" class="form-control-file" type="file" id="imgInp" accept="image/*" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col col-form-label"></label>
                                <div class="col-12">
                                    <button type="submit" value="form1" class="btn btn-success-cus btn-lg btn-block"><i class="fas fa-sign-in-alt"></i>&nbsp;OK</button>
                                    <button type="bottom" class="btn btn-danger-cus btn-lg btn-block" onclick="window.history.back()">ยกเลิก</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <img id="blah" src="#" alt="your image" style="height:600px;width:400px" class="img-fluid rounded shadow-lg p-3 mt-5 bg-white" alt="Responsive image" />
            </div>
        </div>
    </div>
    <script src="js/main_site/transfer.js"></script>
    <?php include("includes/template_frontend/footer.php"); ?>
    <script src="js/main_site/backtotop.js"></script>
</body>

</html>