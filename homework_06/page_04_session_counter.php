<?php

declare(strict_types = 1);

session_start();

$_SESSION["counter"] = isset($_SESSION["counter"]) ? $_SESSION["counter"] : 0;

echo "Просмотров страницы page_03_session_redirect.php: <strong>" . $_SESSION["counter"] . "</strong>";

?>