<?php
echo "Please enter integer number <= 100 \n";
main();

function main(){
    $response = fgets(STDIN);
    if (($response <= 100) && ($response > 0)) {
        $array = createMatrix($response);
        spiralRead($array, $response);
        return $array;
    } else {
        echo "Please check your input and try again \n";
    }
}

function createMatrix($number) {
    $matrix = [];
    $row = 0;
    for ($i = 0; $number * $number > $i; $i++)
    { 
        if ( ($i > 0) && ($i % $number == 0) ) {
            $row++;
        }
        $matrix[$row][] = rand(1,100);
    }

    drawMatrix($matrix);
    return $matrix;
}

function drawMatrix($array) {
    foreach ($array as $key => $rows) {
        foreach ($rows as $value){
            echo $value.' ';    
        }
        echo "\n";
    }
}


function spiralRead($array, $base) {
    
    echo "\n";
    for ($i = 0; $i < $base ; $i++) {
        readFirstLine($array, $i, $base);
        readRightSide($array, $i, $base);
        if (($base %2 == 0) || ($i != floor($base / 2))) {
            //to avoid double output of last number
            readLastLine($array, $i, $base);
        }
        readLeftSide($array, $i, $base);
    }
    
    echo "\n";
}


function readLeftSide($array, $lineNumber, $base) {

    for ($i=$base-1- ($lineNumber+1); $i > $lineNumber; $i--){
        $index =  $lineNumber;
        echo $array[$i][$index].' ';
    }
}

function readRightSide($array, $lineNumber, $base) {
    
    for ($i=$lineNumber+1; $i < $base-1-$lineNumber; $i++){
        $index =  $base-1-$lineNumber;
        echo $array[$i][$index].' ';
    }
}


function readFirstLine($array, $lineNumber, $base) {
    
    for ($i=$lineNumber; $i<$base-$lineNumber; $i++){
        echo $array[$lineNumber][$i].' ';
    }
}

function readLastLine($array, $lineNumber, $base) {
    
    for ($i=$base-1 - $lineNumber; $i >= $lineNumber; $i--){
        $line = $base-$lineNumber-1;
        echo $array[$line][$i].' ';
    }
}