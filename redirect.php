<?php
//redirect time information
session_start();

$_SESSION['minus'] = $_POST['minus'];
$_SESSION['plus'] = $_POST['plus'];

header("Location: lmphp.php", true, 303);
?>