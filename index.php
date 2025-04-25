<?php

echo "Hello, world!"  . PHP_EOL ;

// $date = date_create_from_format('j-M-Y', date('j-M-Y'));
// date_modify($date, '+10 day');
// echo date_format($date, 'd-m-Y'); // 11-06-2020
// var_dump($date);

// $date = DateTime::createFromFormat( 'j-M-Y', date('j-M-Y') );
// $date->modify('+5 day');
// echo $date->format( 'd-m-Y' );
// var_dump($date);

// var_dump( date('Y-m-d', time() + 60 * 60 * 24 * 7 ) );
// var_dump( date('Y-m-d', strtotime('+1 day') ) );

// var_dump( time() ); 

// trigger_error( 
//     'это будет ошибка',
//     E_USER_DEPRECATED
// );



// function out( ...$items ) {

//     foreach ($items as $arg) {
//         echo $arg . PHP_EOL;
//     }

// }

// echo out("php", "js", "c++", "pyton");


// function counter() {

//     static $count = 0;
//     return ++$count . PHP_EOL;

// }

// echo counter();
// echo counter();
// echo counter();
// echo counter();

// function data($bt) {
//     $kb = $bt / 1024;
//     $mb = $kb / 1024;
//     $gb = $mb / 1024;
//     return [$bt, $kb, $mb, $gb];
// }
// print_r( data(54989777) );

// Замыкание
// $message = "Text Message";
// $mFu = function() use ($message) {
//     echo $message;
// };
// echo $mFu();

// Четность
// function odd( int $number) {
//     if ($number % 2 == 0 ) {
//         return "Четное";
//     } else {
//         return "Нечетное";
//     }
// }
// echo odd(12);

// Сумма любого количества элементов
// function sum(...$items) {
//     $sum = 0;
//     for ($i = 0; $i < count($items); $i++ ) {
//         $sum += $items[$i];
//     }
//     return $sum;
// }
// echo sum(10, 5, 2, 3, 1);


?>