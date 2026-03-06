<?php
require_once 'config/db.php';
require_once 'includes/header.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>location.href='login.php';</script>";
    exit;
}

$msg = "";
$msg_type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $guests = intval($_POST['guests']);
    $user_id = $_SESSION['user_id'];

    // 1. Find a table that has enough capacity
    // 2. exclude tables that are already booked for this specific Date AND Time (status 'confirmed' or 'pending')
    
    $sql = "SELECT t.table_id 
            FROM restaurant_tables t 
            WHERE t.capacity >= $guests 
            AND t.table_id NOT IN (
                SELECT b.table_id 
                FROM bookings b 
                WHERE b.booking_date = '$date' 
                AND b.booking_time = '$time' 
                AND b.status IN ('confirmed', 'pending')
            ) 
            ORDER BY t.capacity ASC 
            LIMIT 1";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Table found!
        $row = $result->fetch_assoc();
        $table_id = $row['table_id'];

        $insert_sql = "INSERT INTO bookings (user_id, table_id, booking_date, booking_time, num_guests, status) 
                       VALUES ('$user_id', '$table_id', '$date', '$time', '$guests', 'confirmed')";

        if ($conn->query($insert_sql) === TRUE) {
            $msg = "Success! Your table (ID: $table_id) has been booked.";
            $msg_type = "success";
        } else {
            $msg = "Error: " . $conn->error;
            $msg_type = "danger";
        }
    } else {
        $msg = "Sorry! No tables available for $guests guests at that time.";
        $msg_type = "warning";
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h3 class="mb-0"><i class="fas fa-calendar-check me-2"></i>Book a Table</h3>
                </div>
                <div class="card-body">
                    
                    <?php if($msg): ?>
                        <div class="alert alert-<?php echo $msg_type; ?>"><?php echo $msg; ?></div>
                    <?php endif; ?>

                    <form method="POST" action="booking.php">
                        <div class="mb-3">
                            <label class="form-label">Select Date</label>
                            <input type="date" name="date" class="form-control" min="<?php echo date('Y-m-d'); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Select Time</label>
                            <select name="time" class="form-control" required>
                                <option value="" disabled selected>-- Select Time Slot --</option>
                                <option value="12:00:00">12:00 PM</option>
                                <option value="13:00:00">01:00 PM</option>
                                <option value="14:00:00">02:00 PM</option>
                                <option value="18:00:00">06:00 PM</option>
                                <option value="19:00:00">07:00 PM</option>
                                <option value="20:00:00">08:00 PM</option>
                                <option value="21:00:00">09:00 PM</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Number of Guests</label>
                            <input type="number" name="guests" class="form-control" min="1" max="10" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-dark btn-lg">Confirm Booking</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>