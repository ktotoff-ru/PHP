<?php 

# --------------------------------------------------
# ДОМАШНЕЕ ЗАДАНИЕ #1. РАЗДЕЛ 3
# --------------------------------------------------

// $var = true;

$var = 3.14;

// $var = 3;
// $var = 'one';
// $var = null;
// $var = [];

# Задача 1.3.1
# Напишите алгоритм, который определяет тип переменной,
# используя функции: is_bool, is_float, is_int, is_string, is_null.

if (is_bool($var)) {
    $type = "bool";
}

elseif (is_float($var)) {
    $type = "float";
}

elseif (is_int($var)) {
    $type = "int";
}

elseif (is_string($var)) {
    $type = "string";
}

elseif (is_null($var)) {
    $type = "null";
}

else {
    $type = "other";
}

$messageIfelse = "Type is " . $type;

echo "Задача 1.3.1 \n";
echo $messageIfelse . "\n\n";


# Задача 1.3.2
# Реализуйте то же самое, но при помощи switch-case

// $var = true;
// $var = 3.14;
// $var = 3;
$var = 'one';
// $var = null;
// $var = [];


switch ( true ) {

    case is_bool( $var ):
        $type = 'bool';
        break;

    case is_float( $var ):
        $type = 'float';
        break;

    case is_int( $var ):
        $type = 'int';
        break;

    case is_string( $var ):
        $type = 'string';
        break;

    case is_null( $var ):
        $type = 'null';
        break;

    default:
        $type = 'other';
}

$messageSwitch = "Type is " . $type;

echo "Задача 1.3.2 \n";
echo $messageSwitch . "\n\n";

?>