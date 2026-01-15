<?php
date_default_timezone_set('Asia/Jakarta');

$servername = "sql112.infinityfree.com";
$username = "if0_40893779";
$password = "yEvgQsEsbpSzcW";
$db = "if0_40893779_webdailyjournal"; 

//create connection
$conn = new mysqli($servername,$username,$password,$db);

//check apakah ada error connection
if($conn->connect_error){
	
	die("Connection failed : ".$conn->connect_error);
}

//echo "Connected successfully<hr>";
?>