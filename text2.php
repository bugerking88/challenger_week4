<?php

// $time1 = microtime(true);
$mapHight = 50;
$mapWeight = 60;

for ($a = 0; $a < $mapHight; $a++) {
    for ($b = 0; $b < $mapWeight; $b++) {
        $array[$a][$b] = "0";
    }
}

//放炸彈
for ($set = 0; $set < 1200; $set++) {
    while (true) {
        $col = rand(0, 49);
        $row = rand(0, 59);
        if ($array[$col][$row] != "M") {
            $array[$col][$row] = "M";
            break;
        }
    }
}

//演算法
for($a = 0; $a < $mapHight; $a++) {
    for($b = 0; $b < $mapWeight; $b++) {
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
for ($a = 0; $a < $mapHight; $a++) {
    for ($b = 0; $b < $mapWeight; $b++) {
        echo $array[$a][$b];
    }
    if ($a != 49) {
        echo "N";
    }
}

// $time2 = microtime(true);
// echo "$time2"-"$time1";