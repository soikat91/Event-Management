<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id=$_GET["id"];

// Fetch event data
$events = $conn->query("SELECT * FROM events WHERE id = $id");

// Set headers for CSV download
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=events.csv');

// Create CSV file
$output = fopen('php://output', 'w');
fputcsv($output, ['ID', 'Name', 'Description', 'Event Date']);

while ($row = $events->fetch_assoc()) {
    fputcsv($output, [$row['id'], $row['name'], $row['description'], $row['event_date']]);
}

fclose($output);
exit();
?>

