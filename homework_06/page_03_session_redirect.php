<?php

declare(strict_types = 1);

session_start();

$_SESSION["counter"] = isset($_SESSION["counter"]) ? ++$_SESSION["counter"] : 1;

if ($_SESSION["counter"] % 3 == 0) {
    header("Location: ./page_04_session_counter.php");
}

echo "Просмотров этой страницы: <strong>" . $_SESSION["counter"] . "</strong>";

?>