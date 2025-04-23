<?php 

/* Не 


*/

declare(strict_types = 1);

# Подстановка месяца
function month(string $month): string {
    $arr = ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"];
    if ( $month > 0 ) return $arr[$month - 1];
}

function sheduler( int $year, int $month, int $period = 1 ): void {

    $go = new DateTime( $year . "-" . $month . "-" . "01");

    # Месяцы
    for ($m = 0; $m < $period; $m++) {

        $range = $go->format('t');
        $count = 0;
        // $result = [];
    
        # Дни

        for ( $d = 1; $d <= $range;  $d++ ) {
                
            $current = new DateTime($go->format('Y-m-') . $d);    

            $weekDay = intval($current->format('N')) ;
            $weekEnd = ( $weekDay === 6 || $weekDay === 7 ? true : false );
       
            # Заголовок сетки

            if ( $current->format('j') == 1) {        
                echo "\n\n" . str_pad( month( $current->format('n') ) . "’" . $current->format('Y'), 38, " ", STR_PAD_BOTH ) . PHP_EOL;
                echo str_repeat("-", 30);
                # Список дней недели
                echo "\n  " . "\033[30m" . implode("  ", ["Пн", "Вт", "Ср", "Чт", "Пт", "Сб", "Вс"] ) . "\033[0m" . PHP_EOL;
                echo str_repeat("-", 30) . PHP_EOL;

                # Смещение для неполных недель            
                echo str_pad("", ( $weekDay - 1 ) * 4, " ", STR_PAD_LEFT); 
            } 
    
            # Разделитель недель
            $weekDivider = ( $weekDay === 7 ? PHP_EOL : NULL );
    
            # Шаблон вывода
            $template = str_pad( (string) $d, 4, " ", STR_PAD_LEFT);
            
            if ( $weekEnd ) {
                # Календарные выходные дни
                echo  "\033[31m" . $template . "\033[0m" . $weekDivider ;
                // $condition = "rest";
                $count = 0;
            }

            else if ( !$weekEnd ) {

                if ($count % 3 === 1 ) {
                    # Рабочие дни
                    echo  "\033[32m" . $template . "\033[0m";
                    // $condition = "\033[32m[work]\033[0m";

                } else {
                    # Выходные дни по графику
                    echo $template ;    
                    // $condition = "rest";   
                }

            }

            $count++;

            // Собираем массив:
            // $result[$d] = $condition; 
            // Смотрим смещение:
            // $shift = intval( count($result) - array_search( "\033[32m[work]\033[0m" , array_reverse($result, true) ) );
    
        }

        // echo str_repeat( PHP_EOL, 1);
        $go->modify('first day of next month');

        // echo "Смещение: " . $shift . PHP_EOL;
        // print_r($result) . PHP_EOL;
       
    }

}

# START

$month = 2;
$year  = 2024;
$period  = 4;

sheduler($year, $month, $period);

?>