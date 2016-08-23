<?php

header("Content-Type: text/html; charset=utf-8");

$map = $_GET['map'];
$mapHight = 10;
$mapWeight = 10;
$returnArray = explode('N', $map);
$contStr = strlen($map);

//判斷$map給的長度是否正確,最後有沒有N
if ($contStr == 109 ) {

} else {
    echo "不符合，因為長度不合規定,長度是".$contStr;
    if (substr($map, -1) == "N") {
    echo "，斷行次數錯誤，最後一個有N";
    }
}

//判斷是否有非法字元
if (!preg_match("/^([0-8A-Z]+)$/", $map)) {
    echo "地雷大小寫有錯";
}

//判斷是否有非法字元
if (!preg_match("/^([0-8MN]+)$/", $map)) {
    echo "，裡面有非法字元";
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
        if ($preArray[$a][$b] == "M" || $preArray[$a][$b] == "m" ) {
            $count++;
        }
    }
}
if($count == 40) {
    echo "";
} else {
    echo "不符合，炸彈數量不正確,只有".$count."顆";
    exit;
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
    echo "符合。";
} else {
    echo "數字對應有錯，";
}

//找錯誤的位置
for ($a = 0; $a < $mapHight; $a++) {
    for ($b = 0; $b < $mapWeight; $b++) {
        if ($preArray[$a][$b]!=$origiArray[$a][$b]) {
            echo "第[".$a."]"."[".$b."]"."位置的數字應該為".$preArray[$a][$b];
        }
    }
}