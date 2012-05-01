<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">

	<title>Language Marathon - PHP</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

<?php
//php_language marathon

//set timezone
date_default_timezone_set('Asia/Tokyo');

//set time
$now = new DateTime(now);
$prevbus = new DateTime(now);
$nextbus = new DateTime(now);

//display current time
echo "現在時刻　";
echo $now->format('G:i'); 
echo "<br>";

echo "<br>";

//insert displaying bus time duration in minutes
$minus = 10;
$plus = 30;

//timetable to get
echo $minus."分前（";
$prevbus->modify('-'.$minus.' minutes');
echo $prevbus->format('G:i')."）までのバスと"; 

echo "<br>";

echo $plus."分後（";
$nextbus->modify('+'.$plus.' minutes');
echo $nextbus->format('G:i')."）までのバスを表示"; 
echo "<br>";

echo "<br>";


//get contents -> array
$regbus = file_get_contents("regbustable.txt");
$twinbus = file_get_contents("twinbustable.txt");

//split array by space
$split_regbus = explode(' ', $regbus);
$split_twinbus = explode(' ', $twinbus);

//displayed bus time counter
$count_r = 0;
$count_t = 0;

//time for local bus
echo "各停<br>";

foreach ($split_regbus as $single_regbus) {
    
    //save as time
    $bustime = new DateTime($single_regbus);
    
    //display if bus time is -10min or +30min from now
    if($bustime >= $prevbus && $bustime <= $nextbus){
        echo $bustime->format('G:i')."<br>";
        $count_r++;
    }
    
}

//if there is no bus for the 40min
if($count_r == 0){
    echo "指定された時刻にはバスの運行がありません。<br>";
}

//time for twinliner
echo "<br>";
echo "ツインライナー<br>";
foreach ($split_twinbus as $single_twinbus) {

    $bustime_t = new DateTime($single_twinbus);

    if($bustime_t >= $prevbus && $bustime_t <= $nextbus){
        echo $bustime_t->format('G:i')."<br>";
        $count_t++;
    }
}

if($count_t == 0){
    echo "指定された時刻にはバスの運行がありません。";
}

?>

</body>
</html>