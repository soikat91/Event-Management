<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch events
$events = $conn->query("SELECT * FROM events WHERE user_id = $user_id ORDER BY event_date ASC");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $event_date = $_POST['event_date'];

    $stmt = $conn->prepare("INSERT INTO events (user_id, name, description, event_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $user_id, $name, $description, $event_date);
    
    if ($stmt->execute()) {
        header("Location: event.php");
        exit();
    } else {
        $error = "Error creating event.";
    }
}
include "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2 class="text-center">Event List Create Update Delete</h2>

<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success">
        <?= $_SESSION['success']; unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger">
        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<!-- Create Event Form -->
<div class="card mt-3 p-3">
    <h4>Create Event</h4>
    <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="POST">
        <div class="mb-2">
            <label>Event Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <div class="mb-2">
            <label>Event Date</label>
            <input type="date" name="event_date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Event</button>
    </form>
</div>

<!-- Event List -->
<h4 class="mt-4">Your Events</h4>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        if ($events->num_rows > 0) { 
            while ($row = $events->fetch_assoc()) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']); ?></td>
                    <td><?= htmlspecialchars($row['description']); ?></td>
                    <td><?= htmlspecialchars($row['event_date']); ?></td>
                    <td>
                        <a href="edit_event.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete_event.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
        <?php } 
        } else { ?>
            <tr>
                <td colspan="4" class="text-center text-muted">No records found</td>
            </tr>
        <?php } ?>
    </tbody>
</table>


</body>
</html>

<?php
include "footer.php";
?>