<?php

if (isset($_POST['phone'])) {
    $phone = htmlspecialchars($_POST['phone']);
    $phone = urldecode($phone);
    $phone = trim($phone);


    $to = "gluk-pop@mail.ru";
    $them = "Заявка с` сайта";
    $message = "Phone: ".$phone."<br>";


    if (mail($to, $them, $message)) {
        echo "сообщение успешно отправлено";
    } else {
        echo "при отправке сообщения возникли ошибки";
    }
} else {
    echo "Телефон не введен";
}