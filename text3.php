<?php

header("Content-Type: text/html; charset=utf-8");
// $_GET = $_GET['map'];
$_GET = "M2MMMMM100N123M6M5321N12435M5MM1N1MMM4MM332N34546M423MNMM3MMM42MMN333M6M4M5MNM2113M434MNM42113M4M4N2MM102M4MM";
$mapHight = 10;
$mapWeight = 10;
$returnArray = explode('N', $_GET);
$contStr = strlen($_GET);

//判斷$_GET給的長度是否正確
if ($contStr == 109) {
    echo "字串符合長度"."<br>";
} else {
    echo "長度不合規定";
    exit();
}

//建立預備陣列
for ($a = 0; $a < $mapHight; $a++) {
    for ($b = 0; $b < $mapWeight; $b++) {
        $preArray[$a][$b] = 0;
    }
}
for ($x=0; $x<$mapHight; $x++){
    for ($y=0; $y<$mapWeight; $y++) {
        $preArray[$x][$y] = str_split($returnArray[$y]);
    }
}

// var_dump($preArray);
// print_r($returnArray);

//判斷有幾顆炸彈
for ($a = 0; $a < $mapHight; $a++) {
    for ($b = 0; $b < $mapWeight; $b++) {
        if ($preArray[0][$a][$b] == "M") {
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

//演算法
for($a = 0; $a < $mapHight; $a++) {
    for($b = 0; $b < $mapWeight; $b++) {
        if ($preArray[0][$a][$b]=="M") {
            if($preArray[0][$a-1][$b]!="M") {
                $preArray[0][$a-1][$b]--;
            }
            if($preArray[0][$a-1][$b-1]!="M") {
                $preArray[0][$a-1][$b-1]--;
            }
            if($preArray[0][$a][$b-1]!="M") {
                $preArray[0][$a][$b-1]--;
            }
            if($preArray[0][$a+1][$b-1]!="M") {
                $preArray[0][$a+1][$b-1]--;
            }
            if($preArray[0][$a+1][$b]!="M") {
                $preArray[0][$a+1][$b]--;
            }
            if($preArray[0][$a+1][$b+1]!="M") {
                $preArray[0][$a+1][$b+1]--;
            }
            if($preArray[0][$a][$b+1]!="M") {
                $preArray[0][$a][$b+1]--;
            }
            if($preArray[0][$a-1][$b+1]!="M") {
                $preArray[0][$a-1][$b+1]--;
            }
        }
    }
}

//判斷是否為正確地雷地圖
$chk = 0;
for ($a = 0; $a < $mapHight; $a++) {
    for ($b = 0; $b < $mapWeight; $b++) {
        echo $preArray[0][$a][$b]." ";
        if ((string)$preArray[0][$a][$b] == "M") {
            $chk++;
        }
        // if ($preArray[0][$a][$b] == 0) {
        //     $chk++;
        // }
    }echo "<br>";
}
echo "<br>".$chk;