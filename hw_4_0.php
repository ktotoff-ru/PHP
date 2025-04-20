<?php

declare(strict_types = 1);
$items = [];


# Константы по заданию

const OPERATION_EXIT    = 0;
const OPERATION_ADD     = 1;
const OPERATION_DELETE  = 2;
const OPERATION_PRINT   = 3;
const OPERATION_UPDATE  = 4;

# Константы дополнительные

const ELEMENT_ERROR     = "\e[1m—— Положительное число или 0 для отмены операции! ——\e[0m" . PHP_EOL;
const ELEMENT_TITLE     = "Введите название товара";
const ELEMENT_UNSET     = "Товар \e[1m%s\e[0m удален." . PHP_EOL;
const ELEMENT_FOUND     = "Товар \e[1m%s\e[0m не найден." . PHP_EOL;
const ARR_EMPTY         = "\e[1m—— Список покупок пуст! ——\e[0m" . PHP_EOL;


# Основные операции

$operations = [
    OPERATION_EXIT      => OPERATION_EXIT   . ". Завершить программу.",
    OPERATION_ADD       => OPERATION_ADD    . ". Добавить товар в список покупок.",
    OPERATION_DELETE    => OPERATION_DELETE . ". Удалить товар из списка покупок.",
    OPERATION_PRINT     => OPERATION_PRINT  . ". Отобразить список покупок.",
    OPERATION_UPDATE    => OPERATION_UPDATE . '. Изменить список покупок.'
];


# ВЫБОР ОПЕРАЦИИ

function getOperations(array $operations): int
{
    do {
        echo "Выберите операцию:" . PHP_EOL;
        echo implode(PHP_EOL, $operations) . PHP_EOL;
        $operationNumber = trim(readline( "> "));

        if ( !array_key_exists($operationNumber, $operations) ) {
            // system('cls');
            popen('cls', 'w');
            echo PHP_EOL . "\e[1m—— Неизвестный номер операции, повторите попытку! ——\e[0m" . PHP_EOL . PHP_EOL;
        }

    } while (!array_key_exists($operationNumber, $operations));
    return (int)$operationNumber;
}

# ПЕЧАТЬ СПИСКА
# Если в списке одна позиция, она не нумеруется, а предваряется буллитом.
# Иначе — нумерванный список.
# Второй аргумент $type — для очистки экрана

function showItems(array &$items, ?bool $type = NULL ): void
{
    if ( $type ) popen('cls', 'w');

    if ( count($items) ) {
        echo "\n——————————————— \nСписок покупок: " . PHP_EOL;
        $i = 1;
        foreach ($items as $element => $value ) {        
            if ( count($items) > 1 ) {               
                echo "{$i}. {$element} — {$value} шт." . PHP_EOL;
                $i++;
            } else {
                echo " — {$element} — {$value} шт." . PHP_EOL;
            }
        }
        echo "——————————————— \nВсего позиций: " . count($items) . PHP_EOL . PHP_EOL;
    } else echo ARR_EMPTY;
}

# ДОБАВЛЕНИЕ ЭЛЕМЕНТА
# Ввод количества товара ограничен положительным числом
# Также предусмотрена отмена операции (0)

function addItem(array &$items) : void 
{
    $element = false;
    do {
        $element = !$element ? trim(readline( ELEMENT_TITLE . " для добавления в список: ")) : $element;
        $value = trim(readline( "Введите количество товара: "));
        
        # Если количество не INT — ошибка   

        if ( !ctype_digit( $value ) ) {
            fwrite( STDERR, ELEMENT_ERROR );
        }

        # Ноль для отмены операции

        elseif ( ctype_digit( $value ) && (int) $value === 0 ) {
            break;
        }

        # Иначе добавляем или пересчитываем позицию 

        else {         
            if (array_key_exists($element, $items)) {
                $items[$element] += $value;
            } else {
                $items[$element] = $value;
            }
        }   
    } while ( !ctype_digit($value) );
}

# УДАЛЕНИЕ ЭЛЕМЕНТА
# Предусмотрена отмена операции (0)

function deleteItem(array &$items): void
{
    $element = false;
    showItems($items);

    # Если список пустой, ничего не делаем

    if ( empty($items) ) {       
        return;
    } else {
        do {
            echo ELEMENT_TITLE . " для удаления (или 0 для отмены):" . PHP_EOL;
            $element =  trim(readline( "> "));

            # Ноль для отмены операции

            if ( ctype_digit($element) && (int) $element === 0 ) {
                break;
            }    

            # Элемент не найден

            else if ( !array_key_exists($element, $items) ) {
                echo str_replace('%s',  $element, ELEMENT_FOUND);      
            } 

            # Элемент найден и удален

            else {
                unset( $items[$element] );
                echo str_replace('%s',  $element, ELEMENT_UNSET);
                break;
            }
        } while ( !array_key_exists($element, $items) );
    }
}

# ИЗМЕНЕНИЕ ЭЛЕМЕНТА

function updateItems(array &$items): void
{
    $element = false;
    showItems($items);

    # Если список пустой, ничего не делаем

    if ( empty($items) ) {
        return;
    } else {
        do {
            echo ELEMENT_TITLE . " для изменения (или 0 для отмены):" . PHP_EOL;
            $element =  trim(readline( "> "));      

            # Ноль для отмены операции
            
            if ( ctype_digit($element) && (int) $element === 0 ) {
                break;
            }
            
            # Элемент не найден

            else if ( !array_key_exists($element, $items) ) {
                echo str_replace('%s',  $element, ELEMENT_FOUND);    
            }
            
            # Элемент найден и готов к переименованию

            else {
                echo "Введите новое название:" . PHP_EOL;
                $update =  trim(readline( "> "));

                # Перед удалением текущего элемента нужно сохранить количество
                
                $value = $items[$element];
                unset( $items[$element] );     
                
                # Записываем в массив новый товар с сохраненным количеством
                
                $items[$update] = $value;
                echo "Товар \e[1m{$element}\e[0m переименован в \e[1m{$update}\e[0m." . PHP_EOL;
            } 
        } while ( !array_key_exists($element, $items) );
    }
}

# ОСНОВНОЙ АЛГОРИТМ

do {
    showItems($items, empty( $items ) ? true : false );

    $operationNumber = getOperations($operations);
    echo 'Выбрана операция: '  . $operations[$operationNumber] . PHP_EOL;

    switch ($operationNumber) {

        # Добавить

        case OPERATION_ADD:
            addItem($items);
            break;

        # Удалить

        case OPERATION_DELETE:
            deleteItem($items);
            break;

        # Напечатать

        case OPERATION_PRINT:
            popen('cls', 'w');
            showItems($items, true );
            break;

        # Изменить

        case OPERATION_UPDATE:
            updateItems($items);
            break;
    }

    // echo "\n ----- \n";
} while ($operationNumber > 0);

echo 'Программа завершена' . PHP_EOL;