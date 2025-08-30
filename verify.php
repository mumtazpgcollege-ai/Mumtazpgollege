<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { exit("405"); }

$host = "sql100.infinityfree.com";
$user = "if0_39431886";         // आपका DB username
$pass = "Mumtaz0786";     // आपका DB password
$db   = "if0_39431886_college_db";

$con = mysqli_connect($host, $user, $pass, $db);
if (!$con) { exit("db_error"); }

$challan = strtoupper(trim($_POST['challan_number'] ?? ''));
$course  = strtoupper(trim($_POST['course'] ?? ''));
$modeIn  = strtolower(trim($_POST['payment_mode'] ?? ''));

// case-insensitive query
$sql = "SELECT * FROM issued_ids 
        WHERE UPPER(TRIM(reg_id))=UPPER(TRIM(?)) 
          AND UPPER(TRIM(course))=UPPER(TRIM(?)) 
          AND LOWER(TRIM(mode))=LOWER(TRIM(?))";

$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "sss", $challan, $course, $modeIn);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($res);

if (!$row) { exit("Invalid details. Please check Challan Number, Course, or Payment Mode"); }

if (strtolower($row['status']) !== "issued") { exit("Already submitted."); }

// ✅ SUCCESS → redirect to form
header("Location: form.html");
exit;
?>