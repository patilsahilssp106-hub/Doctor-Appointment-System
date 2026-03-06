<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit;
}

// Update Status
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $action = $_GET['action'];
    $status = ($action == 'approve') ? 'confirmed' : (($action == 'complete') ? 'completed' : 'cancelled');
    
    $conn->query("UPDATE bookings SET status='$status' WHERE booking_id=$id");
    header("Location: view_bookings.php");
    exit;
}

$sql = "SELECT b.*, u.full_name, u.email, t.table_no 
        FROM bookings b 
        JOIN users u ON b.user_id = u.user_id 
        LEFT JOIN restaurant_tables t ON b.table_id = t.table_id 
        ORDER BY b.booking_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar (Same as Dashboard) -->
<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
  <div class="container">
    <a class="navbar-brand" href="dashboard.php">RestoBook Admin</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link active" href="view_bookings.php">Bookings</a></li>
        <li class="nav-item"><a class="nav-link" href="add_table.php">Tables</a></li>
        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <h2>All Bookings</h2>
    <table class="table table-bordered table-striped mt-3">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Table</th>
                <th>Date & Time</th>
                <th>Guests</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['booking_id']; ?></td>
                <td><?php echo $row['full_name']; ?><br><small class="text-muted"><?php echo $row['email']; ?></small></td>
                <td><?php echo $row['table_no']; ?></td>
                <td><?php echo $row['booking_date'] . ' ' . date('h:i A', strtotime($row['booking_time'])); ?></td>
                <td><?php echo $row['num_guests']; ?></td>
                <td>
                    <span class="badge bg-<?php echo ($row['status']=='confirmed'?'success':($row['status']=='cancelled'?'danger':'warning')); ?>">
                        <?php echo ucfirst($row['status']); ?>
                    </span>
                </td>
                <td>
                    <?php if($row['status'] == 'pending'): ?>
                        <a href="view_bookings.php?action=approve&id=<?php echo $row['booking_id']; ?>" class="btn btn-sm btn-success">Approve</a>
                    <?php endif; ?>
                    
                    <?php if($row['status'] == 'confirmed'): ?>
                        <a href="view_bookings.php?action=complete&id=<?php echo $row['booking_id']; ?>" class="btn btn-sm btn-info text-white">Complete</a>
                    <?php endif; ?>
                    
                    <?php if($row['status'] != 'cancelled' && $row['status'] != 'completed'): ?>
                        <a href="view_bookings.php?action=cancel&id=<?php echo $row['booking_id']; ?>" class="btn btn-sm btn-danger">Cancel</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>