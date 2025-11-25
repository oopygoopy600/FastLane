<?php
session_start();
require_once 'db.php'; // adjust path

if (!isset($_SESSION['appointment'])) {
    header("Location: ../index.php");
    exit;
}

$data = $_SESSION['appointment'];

// Prepare SQL insert
$stmt = $conn->prepare("INSERT INTO appointments (fullname, mobile, email, appointment, date, time) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $data['fullname'], $data['mobile'], $data['email'], $data['appointment'], $data['date'], $data['time']);
$stmt->execute();
$stmt->close();
$conn->close();

// Clear session data
unset($_SESSION['appointment']);

// Redirect to thank you page
header("Location: ../pages/thankyou.html");
exit;
