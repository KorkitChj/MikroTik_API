<?php
include('../../includes/db_connect.php');
if (isset($_POST['data']) == "") {
    $query = $conn->prepare("SELECT * FROM product ORDER BY price ASC");
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
    $result = $query->fetchAll();
}
if (!empty($result)) {
    $output = '';
    foreach ($result as $a => $b) {
        $output .= '<div class="col-sm-4">
                <div class="card card-custom overflow-auto shadow-lg p-3 mb-5">
                    <img class="card-img-top" src="img/products/' . $b['image'] . '" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">' . $b['title'] . '</h5><hr>
                            <b style="font-weight:bold">ฟังก์ชัน</b>
                            <b class="card-text">';
        $result2 = explode("/", $b['function']);
        foreach ($result2 as $c) {
            $output .= '- ' . $c . '<br></b>';
        }
        $output .= '<b style="font-weight:bold">ราคา</b>
                    <b class="card-text">' . $b['price'] . '</b><hr>
                    <a href="cart.php?id=' . $b['product_id'] . '&title=' . $b['title'] . '&price=' . $b['price'] . '&img=' . $b['image'] . '" 
                    onclick="return confirm(\'คุณต้องการสั่งซื้อ\');" class="btn btn-outline-dark btn-sm">สั่งซื้อ</a>
        </div>
    </div>
</div>';
    }
    echo $output;
} else {
    $output = '
    <div style="margin:5.3em;padding:5.3em;" class="alert alert-danger alert-dismissible col-md-12" role="alert" align="center">
    <button type="button" class="close close-custom" data-dismiss="alert">&times;</button>
    <strong>Not found!</strong> ไม่พบรายการสินค้าที่ท่านเลือก
    </div>';
    echo $output;
}
