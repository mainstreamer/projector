<?php
// пустой массив для хранения правильной последовательности для вывода
$sequence = [];

// запускаем
main($sequence);

function main(&$sequence){

    // читаем ввод юзера
    $response = fgets(STDIN);

    // пустой массив для хранения матрицы
    $array =[];

    // проверка на допустимые значения размера матрицы
    if (($response <= 100) && ($response > 0)) {

        // читаем введенные юзером числа для матрицы
        // формируем матрицу
        while (count($array) < $response) {
            $elements = fgets(STDIN);
            $array[] = explode(" ", $elements);
        }

        // передаем матрицу методу, который будет читать по спирали
        // также для вычислений необходим размер матрицы - параметр ($response) (не очень читабельный надо переименовать)
        // хотя можно вычислять размер и без лишнего параметра, но пусть уже будет так
        // третий параметр - ссылка на массив для формирования правильной последовательности для вывода
        spiralRead($array, $response, $sequence);

        // после того как массив с правильной последовательностью заполнен - выводим его
        foreach ($sequence as $v) {
            // intval - фикс для вывода, где-то пробелы добавляются (надо потом отдебажить)
            echo intval($v).' ';
        }
    } else {
        // если некорректный ввод сообщаем юзеру
        echo "Please check your input and try again \n";
    }
}

function spiralRead($array, $base, &$sequence) {

    // каждая итерация - виток спирали, определяется размером матрицы
    for ($i = 0; $i < $base ; $i++) {
        // каждый виток спирали состоит из 4 частей - верхней, правой, нижней, левой
        // читаем каждую часть
        // передаем в параметрах саму матрицу ($array), номер итерации (витка), размер матрицы ($base)
        // и массив куда будем добвалять по частям считанную последовательность ($sequence)
        readFirstLine($array, $i, $base, $sequence);
        readRightSide($array, $i, $base, $sequence);
        if (($base %2 == 0) || ($i != floor($base / 2))) {
            // чтобы дважде не выводить последнюю цифру
            // при нечетном колличестве строк/столбцов
            readLastLine($array, $i, $base, $sequence);
        }
        readLeftSide($array, $i, $base, $sequence);
    }
}

function readFirstLine($array, $lineNumber, $base, &$sequence) {
// читаем строку слева направо 
// в зависимости от номера витка регулирем отступы
// (определяем с какого элемента начинать и на каком остановиться)
    for ($i=$lineNumber; $i<$base-$lineNumber; $i++){
        $sequence[] = $array[$lineNumber][$i];
    }
}

function readRightSide($array, $lineNumber, $base, &$sequence) {
// читаем столбец сверху вниз
// в зависимости от номера витка регулирем отступы сверху, снизу и справа 
// каждый виток смещает колонку от правого края на одну цифру и ограничивает высоту столбца
    
    for ($i=$lineNumber+1; $i < $base-1-$lineNumber; $i++){
        $index =  $base-1-$lineNumber;
        $sequence[] = $array[$i][$index];
    }
}

function readLastLine($array, $lineNumber, $base, &$sequence) {
// читаем строку справа налево 
// в зависимости от номера витка регулирем отступы по бокам (меняется число элементов которые надо считать)
    for ($i=$base-1 - $lineNumber; $i >= $lineNumber; $i--){
        $line = $base-$lineNumber-1;
        $sequence[] = $array[$line][$i];
    }
}

function readLeftSide($array, $lineNumber, $base, &$sequence) {
// читаем самый левый столбец снизу вверх  
// в зависимости от номера витка регулирем отступ слева и высоту столбца
    for ($i=$base-1- ($lineNumber+1); $i > $lineNumber; $i--){
        $index =  $lineNumber;
        $sequence[] = $array[$i][$index];
    }
}

// скриншот принятого задания с www.hackerrank.com
// https://www.dropbox.com/s/5p9qwa3yvup33sf/Screenshot%202017-01-01%2023.10.19.png?dl=0