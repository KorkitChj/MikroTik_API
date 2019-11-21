<?php
error_reporting(0);
require_once '../../mpdf/vendor/autoload.php';
include('../../includes/db_connect.php');
include('../../includes/datethai_function.php');
$result =  $conn->prepare("SELECT b.product_name,b.title,b.price,COUNT(*) AS c,SUM(price)  AS s
FROM orderpd AS a INNER JOIN product AS b ON a.product_id = b.product_id
INNER JOIN payment AS c ON c.order_id = a.order_id
WHERE c.paid = 1 GROUP BY b.product_id ORDER BY 4 DESC");
$result->execute();
$numrow2 = $result->rowCount();

$result2 =  $conn->prepare("SELECT SUM(total_cash) AS sum FROM orderpd AS a INNER JOIN payment AS b ON a.order_id = b.order_id WHERE b.paid = 1");
$result2->execute();
$sum = $result2->fetch(PDO::FETCH_ASSOC);

$date = dateThai(date('Y-m-d H:i:s'));

$mpdf = new \Mpdf\Mpdf();
$stylesheet = file_get_contents('../../css/styles_sale.css');

if($_GET['id'] == "print"){
$hcontent =  "<div id=\"body\">
                    <main>
                        <div id=\"details\" class=\"clearfix\">
                        <div id=\"invoice\">
                        <h1 class=\"name\">รายงานการขาย</h1>
                        <div id=\"date\">วันที่{$date}</div>
                        </div>
                        <div id=\"client\">
                        <h2 class=\"name\">รายการขายดี</h2>
                        <div class=\"name\">รายการขายดีเรียงจากมากไปน้อย</div>
                        </div>
                        </div>
                        <h2 id=\"count\">{$numrow2}&nbsp;รายการ</h2>
                        <table class=\"shadow p-3 mb-5\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                        <thead>
                        <tr>
                        <th class=\"no\">#</th>
                        <th class=\"desc\">รายละเอียด</th>
                        <th class=\"unit\">ราคา<br>(บาท)</th>
                        <th class=\"qty\">จำนวน<br>(รายการ)<br><i class=\"fas fa-sort-amount-up\"></i> </th>
                        <th class=\"total\">รวมราคา<br>(บาท)</th>
                        </tr>
                        </thead>
                        <tbody>";


$i = 1; 
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
$bcontent .= "<tr>
                <td class=\"no\">{$i}</td>
                <td class=\"desc\">
                <h3>{$row['product_name']}</h3>{$row['title']}
                </td>
                <td class=\"unit\">{$row['price']}</td>
                <td class=\"qty\">{$row['c']}</td>
                <td class=\"total\">{$row['s']}</td>
            </tr>";
            $i++;
}

$fcontent = "</tbody>
            <tfoot>
            <tr>
            <td colspan=\"2\"></td>
            <td colspan=\"2\">ราคาทั้งสิน</td>
            <td>{$sum['sum']}&nbsp;บาท</td>
            </tr>
            </tfoot>
            </table>
            </div>
            </main>
            </div>";
}
$date = date('Y-m-d H:i:s');
$mpdf->WriteHTML($stylesheet,1);
$mpdf->writeHTML($hcontent,2);
$mpdf->writeHTML($bcontent,2);
$mpdf->writeHTML($fcontent,2);
                
$mpdf->Output("sale{$date}.pdf","D");

?>
