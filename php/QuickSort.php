<?php

function quickSort($list){
    $length = count($list);
    $pivot = $list[$length-1];
    $i = -1;

    for($j=0;$j<$length-1;$j++){
        if($list[$j]<$pivot){
            $i++;
            $a = $list[$j];
            $list[$j] = $list[$i];
            $list[$i] = $a;
        }
    }

    $newList = array_slice($list,0,$i+1);
    if($i<$length-1){
        $newList[] = $pivot;
        foreach(array_slice($list,$i+1,$length-$i-2) as $element){
            $newList[] = $element;
        }
    }
    
    return $newList;
}

$numbers = range(1,5);
shuffle($numbers);
print_r($numbers);
echo "\n";
$numbersSorted = quickSort($numbers);
print_r($numbersSorted);
