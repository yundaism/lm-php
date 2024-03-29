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

//timetable to get
echo "200分前（";
$prevbus->modify('-200 minutes');
echo $prevbus->format('G:i')."）までのバスと"; 

echo "<br>";

echo "30分後（";
$nextbus->modify('+30 minutes');
echo $nextbus->format('G:i')."）までのバスを表示"; 
echo "<br>";

echo "<br>";



//get contents -> array
$regbus = file_get_contents("regbustable.txt");
$twinbus = file_get_contents("twinbustable.txt");


//split array by space
$split_regbus = explode(' ', $regbus);
$split_twinbus = explode(' ', $twinbus);

//display by line
echo "各停<br>";

foreach ($split_regbus as $single_regbus) {

    //save as time
    $bustime = new DateTime($single_regbus);

    //display if bus time is -10min or +30min from now
    if($bustime >= $prevbus && $bustime <= $nextbus){
    echo $bustime->format('G:i')."<br>";
    }
}


?>

</body>
</html>