<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$event_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$conn->query("DELETE FROM events WHERE id = $event_id AND user_id = $user_id");

header("Location: event.php");
exit();
?>
