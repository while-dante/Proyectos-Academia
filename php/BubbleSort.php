<?php

#BubbleSorting Algorithm

function bubbleSortAscendingOrder($list){
    $isSorted = False;

    while(!$isSorted){
        $isSorted = True;

        for($i=0;$i+1<count($list);$i++){
            $a = $list[$i];
            $b = $list[$i+1];

            if($a > $b){
                $list[$i] = $b;
                $list[$i+1] = $a;
                $isSorted = False;
            }
        }
    }
    return $list;
}

$numbers = range(0,100);
shuffle($numbers);
print_r($numbers);
echo "\n";
$numbersSorted = bubbleSortAscendingOrder($numbers);
print_r($numbersSorted);