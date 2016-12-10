<?php
require 'vendor/autoload.php';

$mail = new PHPMailer;
//$mail->SMTPDebug = 3;
$mail->isSMTP();
$mail->Host       =  'smtp.yandex.ru';
$mail->SMTPAuth   =   true;
$mail->Username   =  'test@winfin.org';
$mail->Password   =  'abrakadabra';
$mail->SMTPSecure =  'ssl';
$mail->Port       =   465;
// Да я перфецкионист но так правда лучше смотриться

$mail->setFrom('test@winfin.org', 'Mailer');
$mail->addAddress('vs@zorca.org', 'Joe User');
$mail->isHTML(true);
$mail->Subject = 'Тема письма';
$mail->Body    = 'Сообщение в письме';

if (!$mail->send()) {
    echo 'Сообщение не отправлено';
    echo 'Ошибка: ' . $mail->ErrorInfo;
} else {
    echo 'Сообщение успешно отправлено';
}
