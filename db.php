<?php
$servername = "localhost";
$username = "root"; // เปลี่ยนตามของคุณ
$password = ""; // เปลี่ยนตามของคุณ
$dbname = "iot_course_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// ตั้งค่าภาษาไทย
$conn->set_charset("utf8");
?>
