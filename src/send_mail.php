<?php

if (isset($_POST['phone']) && strlen($_POST['phone'])) {
    $phone = htmlspecialchars($_POST['phone']);
    $phone = urldecode($phone);
    $phone = trim($phone);

    $EOL = "\r\n";
    $boundary = "--" . md5(uniqid(time()));
    $mailTo = "vano56@orsk.ru";
    $them = "Заявка с сайта";
    $message = "Phone: " . $phone . $EOL;
    $headers = "MIME-Version: 1.0;" . $EOL;
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $boundary . "\"" . $EOL;
    $headers .= "From: Иван <burak-ivan@mail.ru>";

    if (mail($mailTo, $them, $message, $headers)) {
        echo json_encode('сообщение успешно отправлено');
    } else {
        echo json_encode('при отправке сообщения возникли ошибки');
    }
} else {
    echo json_encode('Телефон не введен');
}