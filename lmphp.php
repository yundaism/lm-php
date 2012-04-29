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

//get contents -> array
$regbus = file_get_contents("regbustable.txt");
$twinbus = file_get_contents("twinbustable.txt");


//split array by space -> array
$split_regbus = explode(' ', $regbus);
$split_twinbus = explode(' ', $twinbus);

//display by line
echo "各停<br>";
foreach ($split_regbus as $single_regbus) {
    echo $single_regbus."<br>";
}

echo "<br>";
echo "ツインライナー<br>";
foreach ($split_twinbus as $single_twinbus) {
    echo $single_twinbus."<br>";
}



?>

</body>
</html>