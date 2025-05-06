<?php
declare(strict_types = 1);

const ERR_FILENAME = "Поле «Имя файла» обязательно для заполнения";
const ERR_CONTENTS = "Поле «Выбрать файл» обязательно для заполнения";
const ERR_TOTEMPTY = "Все поля обязательны для заполнения";

$folder = "./upload/";
$upload = $_SERVER['DOCUMENT_ROOT'] . "/upload/";

$error = false;
$count = 0;

// Поле «Выбрать файл»

if ( !is_uploaded_file($_FILES['content']['tmp_name']) ) {
    $count++;
    $error = ERR_CONTENTS;
}  else $content = $_FILES['content'];

// Поле «Имя файла»

if ( empty($_POST['name']) ) {
    $error = ERR_FILENAME;
    $count++;
} else $name = $_POST['name'];


// Оба поля пустые
// if ( $counter > 1 ) $error = ERR_TOTEMPTY;

if ( empty($_POST['name']) && !is_uploaded_file($_FILES['content']['tmp_name']) ) $error = ERR_TOTEMPTY;

if ( !$count ) {

    // Создаем папку для загрузки файлов

    if ( !file_exists( $folder ) ) {
        mkdir( $folder, 0777, true);
    }

    // Формируем новое имя файла
    // с сохранением расширения

    $more = explode(".", $_FILES['content']['name']);
    $name = $name . "." . end( $more );

    if ( move_uploaded_file( $content['tmp_name'], $folder . '/' . $name  ) ) {

        $message = "
            <div class='message ready center'>
                <p>Файл был загружен по адресу: <strong>" . $folder . $name ."</strong></p>
                <p>Размер файла: <strong>" . $content['size'] . " байт</strong></p>
                <p><a href='index.php'>Вернуться назад</a></p>
            </div>";

    } else {

        $message = "
            <div class='message error'>
                <p>При загрузке файла возникла ошибка.</p>
            </div>";
    }

} else {
    header('Location: index.php'. '?error=' . rawurlencode($error) . '&name=' . $name );
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='icon' type='image/svg+xml' sizes='any' href='./assets/images/favicon.svg'>
        <link rel='stylesheet' href='./assets/css/styles.css'>
        <title>PHP Homework #07</title>
    </head>
    <body>
        <section class='container'>
            <?= $message ? $message : NULL ?>
        </section>
    </body>
</html>
