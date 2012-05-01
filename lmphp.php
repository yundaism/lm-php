<?php
session_start();
?>

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

$minus = $_SESSION['minus'];
$plus = $_SESSION['plus'];

if(!$_SESSION['minus'] || !$_SESSION['plus']){
//insert displaying bus time duration in minutes
$minus = 10;
$plus = 30;
}

//set timezone
date_default_timezone_set('Asia/Tokyo');

//set time
$now = new DateTime(now);
$prevbus = new DateTime(now);
$nextbus = new DateTime(now);

//display current time
echo "<p class=\"deco\">現在時刻　";
echo $now->format('G:i'); 
echo "</p>";

?>

<form method="POST" action="redirect.php">
<p><input type="text" size="2" value="<?php echo $minus; ?>" name="minus">分前 から <input type="text" size="2" value="<?php echo $plus; ?>" name="plus">分後 までのバスを調べる。</p>
<input type="submit" value="送信">
</form>

<br>

<?php

//timetable to get
echo "<span class=\"red\">".$minus."分前</span>（";
$prevbus->modify('-'.$minus.' minutes');
echo $prevbus->format('G:i')."）までのバスと"; 


echo "<span class=\"red\">".$plus."分後</span>（";
$nextbus->modify('+'.$plus.' minutes');
echo $nextbus->format('G:i')."）までのバスを表示中。"; 
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
echo "<p class=\"deco\">各停</p>";

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
echo "<p class=\"deco\">ツインライナー</p>";
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