<?php

$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';

if (strlen($phone)) {
    $phone = htmlspecialchars($_POST['phone']);
    $phone = urldecode($phone);

    $EOL = "\r\n";
    $mailTo = "gluk-pop@mail.ru";  // почтовый ящик получателя
    $them = "Заявка с сайта";
    $message = "Phone: " . $phone . $EOL;
    $headers = "MIME-Version: 1.0;" . $EOL;
    $headers .= "From: example@mail.ru"; // Указать почтовый ящик из настроек сервера

    if (mail($mailTo, $them, $message, $headers)) {
        echo json_encode('сообщение успешно отправлено');
    } else {
        echo json_encode('при отправке сообщения возникли ошибки');
    }
} else {
    echo json_encode('Телефон не введен');
}