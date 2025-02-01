<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch events
$events = $conn->query("SELECT * FROM events   ORDER BY event_date ASC");

include "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    
    <!-- jQuery (Required for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

</head>
<body class="container mt-5">

<h2 class="text-center">Event Dashboard</h2>
<!-- <a href="logout.php" class="btn btn-danger">Logout</a> -->

<!-- Event List -->
<h4 class="mt-4">All Events</h4>
<table id="eventTable" class="table table-bordered">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Description</th>
            <th>Date</th>      
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sl=1;
        while ($row = $events->fetch_assoc()) { ?>
            <tr>
                <td><?= $sl++; ?></td>
                <td><?= $row['name']; ?></td>
                <td><?= $row['description']; ?></td>
                <td><?= $row['event_date']; ?></td>
              
                <td>
                    <a href="download_csv.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">CSV Download</a>                    
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#eventTable').DataTable();  // Initialize DataTables
    });
</script>

</body>
</html>
<?php
include "footer.php";
?>