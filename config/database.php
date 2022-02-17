<?php
session_start();

$hostname = "localhost";
$username = "root";
$password = "";
$database = "surgerymonitoring";


// $hostname = "crucialtechno.educationhost.cloud";
// $username = "smvnjlye_elwin";
// $password = "elwin_WSM2022";
// $database = "smvnjlye_elwinWSM";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
	$conn = new mysqli($hostname, $username, $password, $database);
	$conn->set_charset("utf8mb4");
} catch (Exception $e) {
	error_log($e->getMessage());
	exit('Error connecting to database');
}
