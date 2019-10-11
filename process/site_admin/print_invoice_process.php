<?php

require('../../pdf_library/FPDF/fpdf.php');
require('../../includes/db_connect.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$statement = $conn->prepare('SELECT * FROM siteadmin AS a 
INNER JOIN orderpd AS b ON a.cus_id = b.cus_id 
INNER JOIN payment AS c ON b.order_id = c.order_id WHERE a.cus_id = :id');
$statement->execute(
    array(
        ':id' => $id
    )
);

$row = $statement->fetch(PDO::FETCH_ASSOC);
$pdf = new FPDF();


$pdf->AddPage();

$pdf->Image('../../img/api-logo1.png', 10, 10, -300);
$pdf->AddFont('angsa', '', 'angsa.php');
$pdf->SetFont('angsa', '', 20);
$pdf->Ln(15);
$pdf->Cell(0, 5, 'www.hotspotmikrotik.com', 0, 1);
$pdf->Cell(0, 5, iconv('UTF-8', 'TIS-620', '15/6 ต.โคกยาง อ.กันตัง จ.ตรัง 92110'), 0, 1);
$pdf->Cell(0, 5, 'kokig_kao@hotmail.com', 0, 1);
$pdf->Cell(0, 5, '(+66) 950244234', 0, 1);
$pdf->Ln(15);



$pdf->Line(10, 150, 200, 150);
$pdf->Cell(0, 5, iconv('UTF-8', 'TIS-620', 'ใบ Invoice'), 0, 1, 'C');
$pdf->Ln(10);
$pdf->Cell(55, 5, iconv('UTF-8', 'TIS-620', 'ชื่อ'), 0, 0);
$pdf->Cell(58, 5, iconv('UTF-8', 'TIS-620', ': ' . $row['full_name'] . ''), 0, 1);
$pdf->Cell(55, 5, iconv('UTF-8', 'TIS-620', 'ที่อยู่'), 0, 0);
$pdf->Cell(58, 5, iconv('UTF-8', 'TIS-620', ': ' . $row['add_ress'] . ''), 0, 1);
$pdf->Cell(55, 5, iconv('UTF-8', 'TIS-620', 'เบอร์โทร'), 0, 0);
$pdf->Cell(58, 5, iconv('UTF-8', 'TIS-620', ': ' . $row['work_phone'] . ''), 0, 1);
$pdf->Ln();

$pdf->Line(10, 70, 200, 70);

$pdf->Ln(5);
$pdf->Cell(55, 5, 'Order ID', 0, 0);
$pdf->Cell(58, 5, ': ' . $row['order_id'] . '', 0, 0);
$pdf->Ln();
$pdf->Cell(55, 5, 'Product ID', 0, 0);
$pdf->Cell(58, 5, ': ' . $row['product_id'] . '', 0, 1);
$pdf->Cell(55, 5, iconv('UTF-8', 'TIS-620', 'ราคาสินค้า'), 0, 0);
$pdf->Cell(58, 5, iconv('UTF-8', 'TIS-620', ': ' . $row['total_cash'] . ' บาท'), 0, 0);
$pdf->Ln();


$pdf->Cell(55, 5, iconv('UTF-8', 'TIS-620', 'ภาษี'), 0, 0);
$pdf->Cell(58, 5, iconv('UTF-8', 'TIS-620', ': 0 บาท'), 0, 1);


$pdf->Cell(55, 5, iconv('UTF-8', 'TIS-620', 'บริการ'), 0, 0);
$pdf->Cell(58, 5, iconv('UTF-8', 'TIS-620', ': 0 บาท'), 0, 1);


$pdf->Cell(55, 5, iconv('UTF-8', 'TIS-620', 'ขนส่ง'), 0, 0);
$pdf->Cell(58, 5, iconv('UTF-8', 'TIS-620', ': 0 บาท'), 0, 1);

$pdf->Ln(10);
$pdf->Cell(55, 5, iconv('UTF-8', 'TIS-620', 'ราคารวม'), 0, 0);
$pdf->Cell(58, 5, iconv('UTF-8', 'TIS-620', ': ' . $row['total_cash'] . ' บาท'), 0, 1);
//$pdf->Ln(5);
//$pdf->Line(155,155, 195, 155);
//$pdf->Cell(140, 5, '', 0, 0);
//$pdf->Cell(50, 5, ': Signature', 0, 1, 'C');


$mypdf = $pdf->Output();

header('Content-type: application/pdf');
header('Content-Disposition:attachment; filename="' . $mypdf . '"');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($mypdf));
header('Accept-Ranges: bytes');
@readfile($mypdf);
