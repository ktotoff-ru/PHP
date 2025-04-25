<?php

declare(strict_types = 1);

const INP = "Введите";
const ERR = "Данные введены некорректно. Попробуйте снова." . PHP_EOL;

# Год

do {
    $year =  trim(readline( INP . " год: "));
    if ( !ctype_digit($year) || $year < 1970 || strlen($year) != 4 ) fwrite(STDERR, ERR);
} while ( !ctype_digit($year) || $year < 1970 || strlen($year) != 4  );

# Месяц

do {
    $month =  trim(readline( INP . " месяц: "));
    if ( !ctype_digit($month) || $month < 1 || $month > 12 ) fwrite(STDERR, ERR);
} while ( !ctype_digit($month) || $month < 1 || $month > 12 );

# Количество месяцев

do {
    $period =  trim(readline( INP . " количество месяцев: "));
    if ( !ctype_digit($period) || $period < 1 ) fwrite(STDERR, ERR);
} while ( !ctype_digit($period) || $period < 1 );


$year   = (int) $year;
$month  = (int) $month;
$period = (int) $period;

$targetMonth = ($month + $period) % 12;
$targetYear  = $year + ($month + $period - $targetMonth) / 12;

$origin = new DateTime( $year . "-" . $month . "-" . "01");
$target = new DateTime( $targetYear . "-" . $targetMonth . "-" . "01");

# Подстановка месяца
function month(string $month): string  {
    $result = ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"];
    if ( $month > 0 ) return $result[$month - 1];
}

# Расчет графика смен
function sheduler(DateTime $origin, DateTime $target) : void {

    $point = DateInterval::createFromDateString('1 day');
    $range = new DatePeriod($origin, $point, $target);
    $count = 1;
    
    foreach($range as $date) {
        
        # День недели
        $weekDay = (int) $date->format('N');
        # Календарные выходные
        $weekEnd = ( $weekDay === 6 || $weekDay === 7 ? true : false );
        # Разделитель недель
        $weekDiv = ( $weekDay === 7 ? PHP_EOL : NULL );
        # Шаблон вывода даты
        $template = str_pad($date->format('j'), 4, " ", STR_PAD_LEFT);
        # Заполнение неполных недель
        $shift = ( $date->format('N') - 1 ) * 4;

        if ( (int) $date->format('j') === 1 ) {
            echo "\n\n" . mb_str_pad( month( $date->format('n') ) . "’" . $date->format('Y'), 30, " ", STR_PAD_BOTH);
            echo "\n" . str_repeat("-", 30);
            echo "\n  " . "\033[30m" . implode("  ", ["Пн", "Вт", "Ср", "Чт", "Пт", "Сб", "Вс"] ) . "\033[0m" . PHP_EOL;          
            echo str_repeat("-", 30) . PHP_EOL;
            echo str_pad("", $shift, " ", STR_PAD_LEFT);
        }

        if ( $weekEnd ) {
            # Календарные выходные
            echo  "\033[31m" . $template . "\033[0m" . $weekDiv ;
            $count = 0;

        } else if ($count % 3 == 1) {
            # Рабочие дни
            echo  "\033[32m" . $template . "\033[0m";
        } else {
            # Выходные по графику
            echo $template ;
        }

        $count++;

    }

    echo str_repeat( PHP_EOL, 3);
}

sheduler($origin, $target);
