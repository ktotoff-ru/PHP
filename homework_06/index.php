<?php

declare(strict_types = 1);

// From homework #1

$heredoc = <<<EOT
Я сразу смазал карту будня, плеснувши краску из стакана;
я показал на блюде студня косые скулы океана.
На чешуе жестяной рыбы прочел я зовы новых губ.
А вы ноктюрн сыграть могли бы на флейте водосточных труб?
EOT;

$getString = urlencode($heredoc);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Домашняя работа №6</title>
    </head>
    <body style="font: normal 2rem/1.5 Arial, Helvetica, sans-serif;">
        <h2>Домашняя работа №6</h2>
        <ul>
            <li><a href="page_01_404.php">Ошибка 404</a></li>
            <li><a href="page_02_textfile.php?getstring=<? echo $getString ?>">Загрузка текстового файла</a></li>
            <li><a href="page_03_session_redirect.php">Cтарт сессии и редирект</a></li>
            <li><a href="page_04_session_counter.php">Счетчик просмотров страницы</a></li>
        </ul>
    </body>
</html>