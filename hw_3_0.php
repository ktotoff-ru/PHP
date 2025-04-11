<?php

# --------------------------------------------------
# ДОМАШНЕЕ ЗАДАНИЕ #3
# --------------------------------------------------

# Все поля обязательны
# Минимальная длина — 2 символа

$length = 2;
define( "WTF", "Серьезно? ");

# Только кириллица

$template = "/^[аа-яА-ЯЁё]/iu";
define( "ERR", "Только кириллица! ");

# Фамилия

do {
    $rawUserLast = trim(readline( "Введите фамилию: "));
    if ( !$rawUserLast || !preg_match($template, $rawUserLast) ) {
        fwrite(STDERR, ERR );
    } else if ( mb_strlen( $rawUserLast ) < $length ) {
        fwrite(STDERR, WTF);
    } 
} while ( !$rawUserLast || !preg_match( $template, $rawUserLast) || mb_strlen( $rawUserLast ) < 2 );

# Имя

do {
    $rawUserFirst = trim(readline( "Введите имя: "));
    if ( !$rawUserFirst || !preg_match($template, $rawUserFirst ) ) {
        fwrite(STDERR, ERR );
    } else if ( mb_strlen( $rawUserFirst ) < $length ) {
        fwrite(STDERR, WTF);
    }   
} while ( !$rawUserFirst || !preg_match( $template, $rawUserFirst) || mb_strlen( $rawUserFirst ) < 2 );

# Отчество

do {
    $rawUserMiddle = trim(readline( "Введите отчество: "));
    if ( !$rawUserMiddle  || !preg_match($template, $rawUserMiddle ) ) {
        fwrite(STDERR, ERR );
    } else if ( mb_strlen( $rawUserMiddle ) < $length ) {
        fwrite(STDERR, WTF);
    }   
} while ( !$rawUserMiddle || !preg_match( $template, $rawUserMiddle) || mb_strlen( $rawUserMiddle ) < 2 );

# Данные, введенные пользователем

$rawInput = $rawUserLast . " " . $rawUserFirst . " " . $rawUserMiddle;

# Функция форматирования ввода

function userNameFormat( $in, $param = false ) {
    $out = false;
    $fullUserName = mb_convert_case( $in, MB_CASE_TITLE );
    if ( $param ) {
        $array = explode(" ", $fullUserName);
        if ( $param === "initials" ) {
            $out = $array[0] . " " . mb_substr($array[1], 0, 1) . "." . mb_substr($array[2], 0, 1) . ".";
        } else if ( $param === "fio" ) {
            foreach ($array as $value) {
                $out .= mb_substr($value, 0, 1);
            }   
        } 
    } else $out = $fullUserName;
    return $out;
}

# Итог

$fullName = userNameFormat( $rawInput );
$surnameAndInitials = userNameFormat( $rawInput , "initials");
$fio = userNameFormat( $rawInput , "fio");

# Вывод

echo "------------------" . PHP_EOL ;
echo "RAW: " . $rawInput . PHP_EOL ;
echo "------------------" . "\n\n" ;

echo "Полное имя: " . $fullName . PHP_EOL ;
echo "Фамилия и инициалы: " . $surnameAndInitials . PHP_EOL ;
echo "ФИО: " . $fio . PHP_EOL ;

?>