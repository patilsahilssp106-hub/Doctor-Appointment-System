<?php
require_once 'config/db.php';
require_once 'includes/header.php';

// Auth Check
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Handle Cancellation
if (isset($_GET['cancel_id'])) {
    $cancel_id = intval($_GET['cancel_id']);
    // Ensure the booking belongs to the logged-in user before deleting/cancelling
    $sql_cancel = "UPDATE bookings SET status='cancelled' WHERE booking_id=$cancel_id AND user_id=$user_id";
    $conn->query($sql_cancel);
    echo "<script>window.location.href='my_bookings.php';</script>";
}

// Fetch Bookings
$sql = "SELECT b.*, t.table_no 
        FROM bookings b 
        LEFT JOIN restaurant_tables t ON b.table_id = t.table_id 
        WHERE b.user_id = $user_id 
        ORDER BY b.booking_date DESC";
$result = $conn->query($sql);
?>

<div class="container mt-5">
    <h2 class="mb-4">My Bookings History</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Booking ID</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Guests</th>
                    <th>Table No</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td>#<?php echo $row['booking_id']; ?></td>
                            <td><?php echo date('d M Y', strtotime($row['booking_date'])); ?></td>
                            <td><?php echo date('h:i A', strtotime($row['booking_time'])); ?></td>
                            <td><?php echo $row['num_guests']; ?></td>
                            <td><?php echo $row['table_no'] ?? 'N/A'; ?></td>
                            <td>
                                <?php 
                                    if($row['status'] == 'confirmed') echo '<span class="badge bg-success">Confirmed</span>';
                                    elseif($row['status'] == 'cancelled') echo '<span class="badge bg-danger">Cancelled</span>';
                                    else echo '<span class="badge bg-warning text-dark">Pending</span>';
                                ?>
                            </td>
                            <td>
                                <?php if($row['status'] == 'confirmed' || $row['status'] == 'pending'): ?>
                                    <a href="my_bookings.php?cancel_id=<?php echo $row['booking_id']; ?>" 
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Are you sure you want to cancel this booking?');">
                                       Cancel
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">You have no bookings yet.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>