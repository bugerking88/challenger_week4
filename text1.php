<?php

$mapHight = 10;
$mapWeight = 10;

//初始
for ($a = 0; $a < $mapHight; $a++) {
    for ($b = 0; $b < $mapWeight; $b++) {
        $array[$a][$b] = "0";
    }
}

//放炸彈
for ($set = 0; $set < 40; $set++) {
    while (true) {
        $row = rand(0, 9);
        $col = rand(0, 9);
        if ($array[$row][$col] != "M") {
            $array[$row][$col] = "M";
            break;
        }
    }
}

//演算法
for($a = 0; $a < 10; $a++) {
    for($b = 0; $b < 10; $b++) {
        if ($array[$a][$b]=="M") {
            if($array[$a-1][$b]!="M") {
                $array[$a-1][$b]++;
            }
            if($array[$a-1][$b-1]!="M") {
                $array[$a-1][$b-1]++;
            }
            if($array[$a][$b-1]!="M") {
                $array[$a][$b-1]++;
            }
            if($array[$a+1][$b-1]!="M") {
                $array[$a+1][$b-1]++;
            }
            if($array[$a+1][$b]!="M") {
                $array[$a+1][$b]++;
            }
            if($array[$a+1][$b+1]!="M") {
                $array[$a+1][$b+1]++;
            }
            if($array[$a][$b+1]!="M") {
                $array[$a][$b+1]++;
            }
            if($array[$a-1][$b+1]!="M") {
                $array[$a-1][$b+1]++;
            }
        }
    }
}

//印出字串
for ($a = 0; $a < 10; $a++) {
    for ($b = 0; $b < 10; $b++) {
        echo $array[$a][$b];
    }
    if ($a != 9) {
        echo "N";
    }
}

