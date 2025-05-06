<?php
declare(strict_types = 1);
$error = ( !empty($_GET["error"]) ) ? "<div class='message error'> " . $_GET["error"] . " </div>" : NULL;
?>

<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='icon' type='image/svg+xml' sizes='any' href='./assets/images/favicon.svg'>
        <link rel='stylesheet' href='./assets/css/styles.css'>
        <title>PHP Homework #07</title>
    </head>
    <body>
        <section class='container'>
            <?= $error ? $error : NULL ?>
            <form action='./upload.php' method='post' enctype='multipart/form-data'>
                <input name='name' type='text' value='<?= ( isset($_GET["name"] ) ? $_GET["name"] : NULL  ) ?>' placeholder='Укажите имя файла'>
                <input name='content' type='file' value=''>
                <button type='submit'>Отправить</button>
            </form>
        </section>
    </body>
</html>