<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$event_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$result = $conn->query("SELECT * FROM events WHERE id = $event_id AND user_id = $user_id");
$event = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $event_date = $_POST['event_date'];

    $stmt = $conn->prepare("UPDATE events SET name=?, description=?, event_date=? WHERE id=? AND user_id=?");
    $stmt->bind_param("sssii", $name, $description, $event_date, $event_id, $user_id);
    
    if ($stmt->execute()) {
        header("Location: event.php");
        exit();
    } else {
        $error = "Error updating event.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Edit Event</h2>
<form method="POST">
    <div class="mb-2">
        <label>Event Name</label>
        <input type="text" name="name" class="form-control" value="<?= $event['name']; ?>" required>
    </div>
    <div class="mb-2">
        <label>Description</label>
        <textarea name="description" class="form-control" required><?= $event['description']; ?></textarea>
    </div>
    <div class="mb-2">
        <label>Event Date</label>
        <input type="date" name="event_date" class="form-control" value="<?= $event['event_date']; ?>" required>
    </div>
    <button type="submit" class="btn btn-success">Update Event</button>
</form>

</body>
</html>
