<?php
declare(strict_types = 1);

$getString = $_GET['getstring'] ? $_GET['getstring'] : NULL;

// $fileName  = basename( __FILE__ ) . ".txt";

$fileName  = "text.txt";

header("Content-Type: text/plain");
header("Content-Disposition: attachment; filename = {$fileName}");

echo $getString;

?>