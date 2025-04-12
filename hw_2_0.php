<?php

# --------------------------------------------------
# ДОМАШНЕЕ ЗАДАНИЕ #2
# --------------------------------------------------

// First

do {
    $a = trim(readline( "Первое число: "));

    // int

    if ( !ctype_digit($a) ) {
        fwrite(STDERR, "Введите, пожалуйста, число! ");
    }
    
} while ( !ctype_digit($a) );

// Second

do {
    
    $b = trim(readline("Второе число: "));

    // int

    if ( !ctype_digit($b) ) {
        fwrite(STDERR, "Введите, пожалуйста, число! ");
    }

    // zero

    if ( ctype_digit($b) && (int) $b === 0 ) {
        fwrite(STDERR, "Делить на 0 нельзя! ");
    }

} while ( !ctype_digit($b) || ( ctype_digit($b) && (int) $b === 0 ) ) ;

// Result

echo "------------------"  . PHP_EOL ;
echo "Результат деления: $a / $b = " . $a / $b . PHP_EOL;
echo "\n\n" ;

?>