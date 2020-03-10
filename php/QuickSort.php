<?php

class QuickSort{
    private $list = array();
    private $first;
    private $last;

    public function __construct($list){
        $this->list = $list;
        $this->first = array_search(array_shift($list),$this->list);
        $this->last = array_search(array_pop($list),$this->list);
    }

    private function swap($i,$j){
        $temp = $this->list[$i];
        $this->list[$i] = $this->list[$j];
        $this->list[$j] = $temp;
        return True;
    }

    private function partition($first,$last){
        $i = $first-1;
        $pivot = $this->list[$last];
        for($j=$first;$j<$last;$j++){
            if($this->list[$j]<$pivot){
                $i++;
                $this->swap($i,$j);
            }
        }
        $this->swap($i+1,$last);
        return $i+1;
    }

    private function quickSort($first,$last){
        if($first<$last){
            $pivotIndex = $this->partition($first,$last);
            $this->quickSort($first,$pivotIndex-1);
            $this->quickSort($pivotIndex+1,$last);
        }
        return True;
    }

    public function sort(){
        $this->quickSort($this->first,$this->last);
        return $this->list;
    }
}

$list = range(0,100000);
shuffle($list);
$quickSort = new QuickSort($list);
$sortedList = $quickSort->sort();
print_r($sortedList);