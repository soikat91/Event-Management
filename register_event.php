<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_id = $_POST['event_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("INSERT INTO attendees (event_id, name, email) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $event_id, $name, $email);
    $stmt->execute();
    echo "Registered successfully!";
}
?>

<form method="POST">
    <input type="hidden" name="event_id" value="<?= $_GET['event_id'] ?>">
    <input type="text" name="name" placeholder="Your Name" required>
    <input type="email" name="email" placeholder="Your Email" required>
    <button type="submit">Register</button>
</form>
