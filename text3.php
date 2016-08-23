<?php

header("Content-Type: text/html; charset=utf-8");

$map = $_GET['map'];
$mapHight = 10;
$mapWeight = 10;
$returnArray = explode('N', $map);
$contStr = strlen($map);

//判斷$map給的長度是否正確,最後有沒有N
if ($contStr == 109 ) {
    echo "字串符合長度".",";
} else {
    echo "長度不合規定";
    if (substr($map, -1) == "N") {
    echo "最後一個字元不能是N";
    exit();
    }
    exit();
}

//判斷是否有非法字元
if (!preg_match("/^([0-9MN]+)$/", $map)) {
    echo "裡面有非法字元";
    exit();
}

//建立原本陣列
for ($x=0; $x<$mapHight; $x++){
        $origiArray[$x] = str_split($returnArray[$x]);
}

//建立預備陣列
for ($x=0; $x<$mapHight; $x++){
        $preArray[$x] = str_split($returnArray[$x]);
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
    echo "炸彈數量符合".",";
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
$ans = 0;
for($a = 0; $a < $mapHight; $a++) {
    for($b = 0; $b < $mapWeight; $b++) {
        if ($preArray[$a][$b]=="M") {
            if($preArray[$a-1][$b]!="M") {
                $preArray[$a-1][$b]++;
            }
            if ($preArray[$a-1][$b-1] != "M") {
                $preArray[$a-1][$b-1]++;
            }
            if ($preArray[$a][$b-1] != "M") {
                $preArray[$a][$b-1]++;
            }
            if ($preArray[$a+1][$b-1] != "M") {
                $preArray[$a+1][$b-1]++;
            }
            if ($preArray[$a+1][$b] != "M") {
                $preArray[$a+1][$b]++;
            }
            if ($preArray[$a+1][$b+1] != "M") {
                $preArray[$a+1][$b+1]++;
            }
            if ($preArray[$a][$b+1] != "M") {
                $preArray[$a][$b+1]++;
            }
            if ($preArray[$a-1][$b+1] != "M") {
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
    echo "炸彈位置有誤";
}

//找錯誤的位置
for ($a = 0; $a < $mapHight; $a++) {
    for ($b = 0; $b < $mapWeight; $b++) {
        if ($preArray[$a][$b]!=$origiArray[$a][$b]) {
            echo "第[".$a."]"."[".$b."]"."錯誤";
        }
    }
}