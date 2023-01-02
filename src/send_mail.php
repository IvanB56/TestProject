<?php

if (isset($_POST['phone']) && strlen($_POST['phone'])) {
    $phone = htmlspecialchars($_POST['phone']);
    $phone = urldecode($phone);
    $phone = trim($phone);

    $EOL = "\r\n";
    $boundary = "--" . md5(uniqid(time()));
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