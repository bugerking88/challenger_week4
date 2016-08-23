<?php

header("Content-Type: text/html; charset=utf-8");

$map = $_GET['map'];
$mapHight = 10;
$mapWeight = 10;
$returnArray = explode('N', $map);
$contStr = strlen($map);

//判斷$map給的長度是否正確
if ($contStr == 109) {
    echo "字串符合長度"."<br>";
} else {
    echo "長度不合規定";
    exit();
}

//建立預備陣列
for ($a = 0; $a < $mapHight; $a++) {
    for ($b = 0; $b < $mapWeight; $b++) {
        $tryArray[$a][$b] = "0";
    }
}

for ($x=0; $x<$mapHight; $x++){
    // for ($y=0; $y<$mapWeight; $y++) {
        $preArray[$x] = str_split($returnArray[$x]);
    // }
}

//判斷有幾顆炸彈
for ($a = 0; $a < $mapHight; $a++) {
    for ($b = 0; $b < $mapWeight; $b++) {
        if ($preArray[$a][$b] == "M") {
            $count++;
        }
    }
}
if($count == 40) {
    echo "炸彈數量符合"."<br>";
} else {
    echo "炸彈數量不正確";
    exit();
}

//陣列歸零
for ($a = 0; $a < $mapHight; $a++) {
    for ($b = 0; $b < $mapWeight; $b++) {
        if ($preArray[$a][$b] != "M") {
            $preArray[$a][$b] = "0";
        }
    }
}

//演算法
for($a = 0; $a < $mapHight; $a++) {
    for($b = 0; $b < $mapWeight; $b++) {
        if ($preArray[$a][$b]=="M") {
            if($preArray[$a-1][$b]!="M") {
                $preArray[$a-1][$b]++;
            }
            if($preArray[$a-1][$b-1]!="M") {
                $preArray[$a-1][$b-1]++;
            }
            if($preArray[$a][$b-1]!="M") {
                $preArray[$a][$b-1]++;
            }
            if($preArray[$a+1][$b-1]!="M") {
                $preArray[$a+1][$b-1]++;
            }
            if($preArray[$a+1][$b]!="M") {
                $preArray[$a+1][$b]++;
            }
            if($preArray[$a+1][$b+1]!="M") {
                $preArray[$a+1][$b+1]++;
            }
            if($preArray[$a][$b+1]!="M") {
                $preArray[$a][$b+1]++;
            }
            if($preArray[$a-1][$b+1]!="M") {
                $preArray[$a-1][$b+1]++;
            }
        }

    }
}

//判斷是否為正確地雷地圖
for ($a = 0; $a < $mapHight; $a++) {
    for ($b = 0; $b < $mapWeight; $b++) {
        $result .= $preArray[$a][$b];
    }
    if ($a != 9) {
        $result .= "N";
    }
}
if ($result == $map) {
    echo "正確";
} else {
    echo "錯誤";
}