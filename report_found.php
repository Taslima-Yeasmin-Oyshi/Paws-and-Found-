<?php
session_start();
require_once 'includes/db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (isset($_POST['report_found'], $_POST['pet_id'])) {
    $pet_id = intval($_POST['pet_id']);
    // Mark as ReportedFound
    $stmt = $conn->prepare("UPDATE lost_pets SET status='ReportedFound' WHERE id=?");
    $stmt->bind_param("i", $pet_id);
    $stmt->execute();
    $stmt->close();
    header('Location: lost_pets.php?msg=found');
    exit;
}

header('Location: lost_pets.php?msg=error');
exit;
?>
