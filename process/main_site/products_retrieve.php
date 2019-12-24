<?php
include('../../includes/db_connect.php');
//error_reporting(0);
if (isset($_POST['data']) == "") {
    $sql = "SELECT * FROM product ORDER BY price ASC";
    $query = $conn->prepare($sql);
    $query->execute();
    $per_page = 3;
    $row = $query->rowCount();
    $pages = ceil($row / $per_page);

    if ($_GET['page'] == "") {
        $page = "1";
    } else {
        $page = $_GET['page'];
    }

    $start = ($page - 1) * $per_page;
    $sql   = $sql . " LIMIT $start,$per_page";
    $query = $conn->prepare($sql);
    $query->execute();

    $result = $query->fetchAll();
} else {
    $sql = 'SELECT * FROM product WHERE ';
    $sql .= '(product_id LIKE "%' . $_POST["data"] . '%" ';
    $sql .= 'OR product_name LIKE "%' . $_POST["data"] . '%" ';
    $sql .= 'OR price LIKE "%' . $_POST["data"] . '%" ';
    $sql .= 'OR title LIKE "%' . $_POST["data"] . '%" ';
    $sql .= 'OR function LIKE "%' . $_POST["data"] . '%" ';
    $sql .= 'OR image LIKE "%' . $_POST["data"] . '%") ';
    $sql .= 'ORDER BY product_id ASC';
    
    $query = $conn->prepare($sql);
    $query->execute();
    $per_page = 3;
    $row = $query->rowCount();
    $pages = ceil($row / $per_page);

    if ($_GET['page'] == "") {
        $page = "1";
    } else {
        $page = $_GET['page'];
    }

    $result = $query->fetchAll();
}
if (!empty($result)) {
    $output = '';
    $output .= '<div class="row grid-row d-flex justify-content-center margin-top">';
    foreach ($result as $a => $b) {
        $output .= '<div class="col-sm-4">
                <div class="card card-custom d-flex shadow-lg p-3 mb-5 mt-4">
                    <img class="card-img-top" src="img/products/' . $b['image'] . '" alt="Card image cap">
                        <div class="card-body flex-fill">
                            <h5 class="card-title">' . $b['title'] . '</h5><hr>
                            <b style="font-weight:bold">ฟังก์ชัน</b>
                            <b class="card-text">';
        $result2 = explode("/", $b['function']);
        foreach ($result2 as $c) {
            $output .= '- ' . $c . '<br></b>';
        }
        $output .= '<b style="font-weight:bold">ราคา</b>
                    <b class="card-text">' . $b['price'] . '</b><hr>
                    <center><a href="cart/product/' . $b['product_id'] . '" 
                    onclick="return confirm(\'คุณต้องการสั่งซื้อ\');" class="btn  bt-s btn-dark-cus btn-sm">สั่งซื้อ</a></center>
        </div>
    </div>
</div>';
    }
    $output .= '</div>
    <div class="row grid-row d-flex justify-content-center margin-top">
    <ul class="pagination">';
    for ($i = 1; $i <= $pages; $i++) {
        if($page == $i){
            $output .= '<li class="page-item active"><a class="page-link" href="item?page=' . $i . '">' . $i . '</a></li>';
        }else{
            $output .= '<li class="page-item"><a class="page-link" href="item?page=' . $i . '">' . $i . '</a></li>';
        }
    }
    $output .= '</ul></div>';
    echo $output;
} else {
    $output = '
    <div style="margin-top:5.3em;padding:5.3em;" class="alert alert-danger alert-dismissible col-md-12" role="alert" align="center">
    <button type="button" class="close close-custom" data-dismiss="alert">&times;</button>
    <strong>Not found!</strong> ไม่พบรายการสินค้าที่ท่านเลือก
    </div>';
    echo $output;
}
