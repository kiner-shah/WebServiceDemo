<?php
// References: https://davidwalsh.name/web-service-php-mysql-xml-json
error_reporting(E_ERROR | E_PARSE);
$base = $_POST["first"];
$power = $_POST["second"];
$ans = pow($base, $power);
date_default_timezone_set('Asia/Kolkata');
$date = date('d-m-Y h:i:s a', time());
// output in JSON
//header("Content-type: application/json");
//echo json_encode(array('calculated_power'=>$ans, 'timestamp'=>$date));
$fp = fopen('results.json', 'w');
fwrite($fp, json_encode(array('calculated_power'=>$ans, 'timestamp'=>$date)));
fclose($fp);
header('Location: index.php');
?>