<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit;
}

// Add Table
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $table_no = $_POST['table_no'];
    $capacity = intval($_POST['capacity']);
    
    $conn->query("INSERT INTO restaurant_tables (table_no, capacity) VALUES ('$table_no', '$capacity')");
    $success = "Table added successfully!";
}

// Delete Table
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM restaurant_tables WHERE table_id=$id");
    header("Location: add_table.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Tables</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
  <div class="container">
    <a class="navbar-brand" href="dashboard.php">RestoBook Admin</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="view_bookings.php">Bookings</a></li>
        <li class="nav-item"><a class="nav-link active" href="add_table.php">Tables</a></li>
        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <div class="row">
        <!-- Add Table Form -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-dark text-white">Add New Table</div>
                <div class="card-body">
                    <?php if(isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
                    <form method="POST">
                        <div class="mb-3">
                            <label>Table Number (e.g. T10)</label>
                            <input type="text" name="table_no" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Seating Capacity</label>
                            <input type="number" name="capacity" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-dark w-100">Add Table</button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Table List -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-white">Existing Tables</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Table No</th>
                                <th>Capacity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $result = $conn->query("SELECT * FROM restaurant_tables");
                            while($row = $result->fetch_assoc()): 
                            ?>
                            <tr>
                                <td><?php echo $row['table_id']; ?></td>
                                <td><?php echo $row['table_no']; ?></td>
                                <td><?php echo $row['capacity']; ?> People</td>
                                <td>
                                    <a href="add_table.php?delete=<?php echo $row['table_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this table?');">Delete</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>