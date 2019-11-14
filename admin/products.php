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
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="row">
                                <div class="col-md" style="margin:10px 10px">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addProductModal" id="addProductModalBtn">
                                            <span class="glyphicon glyphicon-plus"></span> เพิ่มสินค้า
                                        </button>
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#removeAllMemberModal" id="deleteAllProductsModalBtn">
                                            <span class="glyphicon glyphicon-trash"></span> ลบข้อมูลแถวที่เลือก
                                        </button>
                                        <button type="button" class="btn btn-warning btn-sm" onclick="window.location.href='products_list'">
                                            <img src="../img/refresh.png" width="20" title="Refresh">&nbsp;&nbsp;Reconnect</button>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="float-right">
                                        <div>
                                            <span class="badge-pill badge-light">รายละเอียด</span>
                                            <span class="badge-pill badge-success">รูปภาพ</span>
                                            <span class="badge-pill badge-warning">ดาวโหลด</span>
                                            <span class="badge-pill badge-info">แก้ไข</span>
                                            <span class="badge-pill badge-danger">ลบ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="table-responsive">
                                <table id="productstable" class="table table-striped table-hover table-sm" style="width:100%">
                                    <thead class="aa">
                                        <tr>
                                            <th width="1%"><label class="checkbox">
                                                    <input type="checkbox" id="checkall" />
                                                    <span class="danger"></span>
                                                </label></th>
                                            <th width="1%">#</th>
                                            <th width="2%">ชื่อสินค้า</th>
                                            <th width="1%">ราคา</th>
                                            <th width="6%">หัวข้อสินค้า</th>
                                            <th width="2%">Option</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- displayimag modal -->
                <div class="modal fade" tabindex="-1" role="dialog" id="displayimgproductModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <span id="product"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- displaydetail modal -->
                <div class="modal fade" tabindex="-1" role="dialog" id="displayproductdetailModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>รายละเอียด</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <span id="productdetail"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- add product modal -->
                <div class="modal fade" tabindex="-1" role="dialog" id="addProductModal">
                    <div class="modal-dialog modal-dialog-custom" role="document">
                        <div class="modal-content">
                            <form action="" id="addproduct" method="post" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span>เพิ่มสินค้า</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="productname" class="col-sm control-label">ชื่่อสินค้า: <span class="text-danger glyphicon glyphicon-asterisk"></span>&nbsp;</label>
                                                <div class="col-sm-12 input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="glyphicon glyphicon-apple"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" name="productname" id="productname" placeholder="ชื่อสินค้า" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="productprice" class="col-sm control-label">ราคาสินค้า: <span class="text-danger glyphicon glyphicon-asterisk"></span>&nbsp;</label>
                                                <div class="col-sm-12 input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="glyphicon glyphicon-tag"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" name="productprice" id="productprice" placeholder="ราคาสินค้า" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12 input-group">
                                                    <p>จำนวนวันใช้งาน: <span id="days"><b>0</b></span></p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="producttitle" class="col-sm control-label">หัวข้อสินค้า: <span class="text-danger glyphicon glyphicon-asterisk"></span>&nbsp;</label>
                                                <div class="col-sm-12 input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="glyphicon glyphicon-text-size"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" name="producttitle" id="producttitle" placeholder="หัวข้อสินค้า" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="productdetail" class="col-sm control-label">รายละเอียดสินค้า: <span class="text-danger glyphicon glyphicon-asterisk"></span>&nbsp;</label>
                                                <div class="col-sm-12 input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="glyphicon glyphicon-list"></i>
                                                        </div>
                                                    </div>
                                                    <textarea class="form-control" name="productdetail" id="productdetail" placeholder="รายละเอียดสินค้า ใส่ '/' ที่ต้องการขึ้นบรรทัดใหม่" rows="3" required></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="product_image" class="col-sm control-label">รูปภาพ Site: <span class="text-danger glyphicon glyphicon-asterisk"></span>&nbsp;</label>
                                                <div class="col-sm-12 input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="far fa-file-image"></i>
                                                        </div>
                                                    </div>
                                                    <input type="file" name="product_image" id="product_image" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <img id="add_product" src="#" alt="your image" class="img-fluid rounded shadow-lg p-3 mb-5 bg-white" alt="Responsive image" />
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                                        <button type="reset" class="btn btn-warning"><i class="fa fa-undo"></i>&nbsp;Reset&nbsp;</button>
                                        <button type="submit" class="btn btn-success" id="addproductBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- edit product modal -->
                <div class="modal fade" tabindex="-1" role="dialog" id="editproductModal">
                    <div class="modal-dialog modal-dialog-custom" role="document">
                        <div class="modal-content">
                            <form action="" id="editproduct" method="post" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span>แก้ไขรายการสินค้า</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="editproductname" class="col-sm control-label">ชื่่อสินค้า: <span class="text-danger glyphicon glyphicon-asterisk"></span>&nbsp;</label>
                                                <div class="col-sm-12 input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="glyphicon glyphicon-apple"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" name="editproductname" id="editproductname" placeholder="ชื่อสินค้า" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="editproductprice" class="col-sm control-label">ราคาสินค้า: <span class="text-danger glyphicon glyphicon-asterisk"></span>&nbsp;</label>
                                                <div class="col-sm-12 input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="glyphicon glyphicon-tag"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" name="editproductprice" id="editproductprice" placeholder="ราคาสินค้า" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="editproducttitle" class="col-sm control-label">หัวข้อสินค้า: <span class="text-danger glyphicon glyphicon-asterisk"></span>&nbsp;</label>
                                                <div class="col-sm-12 input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="glyphicon glyphicon-text-size"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" name="editproducttitle" id="editproducttitle" placeholder="หัวข้อสินค้า" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="editproductdetail" class="col-sm control-label">รายละเอียดสินค้า: <span class="text-danger glyphicon glyphicon-asterisk"></span>&nbsp;</label>
                                                <div class="col-sm-12 input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="glyphicon glyphicon-list"></i>
                                                        </div>
                                                    </div>
                                                    <textarea class="form-control" name="editproductdetail" id="editproductdetail" placeholder="รายละเอียดสินค้า ใส่ '/' ที่ต้องการขึ้นบรรทัดใหม่" rows="3" required></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="editproduct_image" class="col-sm control-label">รูปภาพ Site: <span class="text-danger glyphicon glyphicon-asterisk"></span>&nbsp;</label>
                                                <div class="col-sm-12 input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="far fa-file-image"></i>
                                                        </div>
                                                    </div>
                                                    <input type="file" name="editproduct_image" id="editproduct_image">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <span id="displayproduct_image"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                                        <button type="submit" class="btn btn-success" id="editproductBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- remove modal -->
                <div class="modal fade" tabindex="-1" role="dialog" id="removeproductModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span>ลบรายการสินค้า</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <p>คุณต้องการลบรายการสินค้า ?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                                <button type="button" class="btn btn-success" id="removeProductBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- remove all modal -->
                <div class="modal fade" tabindex="-1" role="dialog" id="removeAllMemberModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span>ลบสมาชิกที่เลือก</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <p>คุณต้องการลบสมาชิกที่เลือก ?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cancel&nbsp;</button>
                                <button type="button" class="btn btn-success" id="removeAllProductsBtn"><i class="fa fa-check"></i>&nbsp;Save&nbsp;</button>
                            </div>
                        </div>
                    </div>
                </div>
                <script src="../js/admin/product.js"></script>
            </div>
            <?php include("../includes/template_backend/admin/footer.php"); ?>
        </main>
    </div>
</body>

</html>