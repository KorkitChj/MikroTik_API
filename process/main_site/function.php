<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function mailConfig($email, $fullname,$path){
    if($path == "siteadmin"){
        require '../phpmailer/vendor/autoload.php';
    }else{
        require '../../phpmailer/vendor/autoload.php';
    }
    date_default_timezone_set('Asia/Bangkok');
    $mail = new PHPMailer;
    $mail->CharSet = 'UTF-8';
    $mail->IsSMTP();                                      
    $mail->Host = 'smtp.gmail.com';                       
    $mail->Port = 587;                                    
    $mail->SMTPAuth = true;                              
    $mail->Username = 'kokig80@gmail.com';                
    $mail->Password = 'Korkit072540';                     
    $mail->SMTPSecure = 'tls';                            

    $mail->From = 'kokig80@gmail.com';
    $mail->FromName = 'ThaiMikroTikAPI.com';
    $mail->AddAddress($email, $fullname);                                 

    $mail->IsHTML(true);                                   
    return $mail;
}
function mailQuery($mail){
    if (!$mail->Send()) {
        return 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        return 'Success';
    }
}
function sendMailRegister($email, $fullname, $password)
{
    $path = "";
    $mail = mailConfig($email, $fullname,$path);
    $mail->Subject = 'รายการลงทะเบียน';
    $mail->Body    = 'Thai Mikrotik API ยินดีให้บริการ<br><br>รหัสผ่านของคุณคือ<strong>  ' . $password . '</strong>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    return mailQuery($mail);

}
function sendMailOrder($email,$name,$phone,$date_field,$order_name,$order_price)
{
    include('../../includes/datethai_function.php');
    $mail = mailConfig($email, $name,$path);

    $mail->Subject = 'รายการสั่งซื้อ';
    $mail->Body    = 'Thai Mikrotik API ยินดีให้บริการ<br><br>
    คุณ<strong>  '.$name.'</strong><br>
    หมายเลขโทรศัพท์<strong>  '.$phone.'</strong><br>
    มีรายการสั่งซื้อ<br>
    Packet สินค้า <strong>  '.$order_name.'</strong> จำนวน 1 รายการ<br>
    ราคา สินค้า <strong>  '.$order_price.'</strong><br>
    กำหนดชำระภายใน<strong>  '.DateThai($date_field).'</strong><br>
    คุณต้องชำระเงินภายกำหนดถ้าเกินกำหนดชำระเงินเราจะลบข้อมูลของคุณออก';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    return mailQuery($mail);
}
function sendMailPasswordReset($email,$name,$link,$user){
    $path = "";
    $mail = mailConfig($email, $name,$path);
    $linkreset = "http://{$_SERVER['SERVER_NAME']}/web/password_reset?u={$user}";
    $mail->Subject = 'รีเซ็ตรหัสผ่าน';
    $mail->Body    = 'Thai Mikrotik API ยินดีให้บริการ<br><br>คลิกลิงก์เพื่อรีเซ็ตรหัสผ่าน<br>
    <strong>'.$link.'</strong><br><br>
    ถ้าคุณไม่ได้รีเซ็ตรหัสผ่านภายใน 3 ชั่วโมงลิงก์จะหมดอายุ<br>
    ถ้าต้องการรีเซ็ตรหัสผ่านกดที่ลิงก์ <strong>'.$linkreset.'</strong>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    return mailQuery($mail);
}
function randomPassword()
{
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass);
}
