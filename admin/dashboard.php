<?php
session_start();
require_once '../config/db.php';

// Access Control
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit;
}

// Fetch Stats
$total_bookings = $conn->query("SELECT count(*) as count FROM bookings")->fetch_assoc()['count'];
$pending_bookings = $conn->query("SELECT count(*) as count FROM bookings WHERE status='pending'")->fetch_assoc()['count'];
$total_users = $conn->query("SELECT count(*) as count FROM users")->fetch_assoc()['count'];
$total_tables = $conn->query("SELECT count(*) as count FROM restaurant_tables")->fetch_assoc()['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .card-link {
            text-decoration: none;
            transition: transform 0.2s;
            display: block;
        }
        .card-link:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
  <div class="container">
    <a class="navbar-brand" href="dashboard.php">RestoBook Admin</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="dashboard.php">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="view_bookings.php">Bookings</a></li>
        <li class="nav-item"><a class="nav-link" href="view_users.php">Users</a></li>
        <li class="nav-item"><a class="nav-link" href="add_table.php">Tables</a></li>
        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <h2 class="mb-4">Dashboard Overview</h2>
    
    <div class="row">
        <!-- Total Bookings -->
        <div class="col-md-3">
            <a href="view_bookings.php" class="card-link">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Total Bookings</h5>
                                <p class="card-text fs-2"><?php echo $total_bookings; ?></p>
                            </div>
                            <i class="fas fa-book fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Pending Bookings -->
        <div class="col-md-3">
            <a href="view_bookings.php" class="card-link">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Pending Bookings</h5>
                                <p class="card-text fs-2"><?php echo $pending_bookings; ?></p>
                            </div>
                            <i class="fas fa-clock fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Registered Users -->
        <div class="col-md-3">
            <a href="view_users.php" class="card-link"> <!-- Linked to view_users.php -->
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Registered Users</h5>
                                <p class="card-text fs-2"><?php echo $total_users; ?></p>
                            </div>
                            <i class="fas fa-users fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Tables -->
        <div class="col-md-3">
            <a href="add_table.php" class="card-link">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Total Tables</h5>
                                <p class="card-text fs-2"><?php echo $total_tables; ?></p>
                            </div>
                            <i class="fas fa-chair fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

</body>
</html>